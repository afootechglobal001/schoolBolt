$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }
  $("#viewLogin").keydown(function (e) {
    if (e.keyCode == 13) {
      _confirmLogin();
    }
  });
  $("#viewResetPassword").keydown(function (e) {
    if (e.keyCode == 13) {
      _proceedResetPassword();
    }
  });
  $("#viewOtpPassword").keydown(function (e) {
    if (e.keyCode == 13) {
      _proceedOtpVerification();
    }
  });
  $("#viewCompleteResetPassword").keydown(function (e) {
    if (e.keyCode == 13) {
      _completeResetPassword();
    }
  });
});

/// next login page function ///
function _nextAdminLoginPage(props) {
  const { page = "" } = props;
  _getPage({page: page, url: adminMiddleWareUrl});
}


////// ADMIN LOGIN FUNCTION ////////
function _confirmLogin(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const userName = $('#userName').val().trim();
		const password = $("#password").val().trim();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("userName", "EMAIL ADDRESS");
    issueCount += _validateEmail("userName", "EMAIL ADDRESS");
		issueCount += _validateEmptyValue("password", "PASSWORD");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			userName,
			password,
		};

		////// confirm action////
		_proceedLoginCallback(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _confirmLogin());
	}
}

//// //// ADMIN LOGIN CALLBACK FUNCTION ////////
//// //// ADMIN LOGIN CALLBACK FUNCTION ////////
function _proceedLoginCallback(formData) {

    ///// get btn text /////
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    // =====================================
    // DUMMY LOGIN RESPONSE FOR TESTING
    // =====================================
    const response = {
        response: 200,
        success: true,
        message: "LOGIN SUCCESSFUL!",
        data: {
            staffId: "STF00220260703122232",
            accessKey: "fe5a0cda504ecd6c9f446f74b921f430",
            firstName: "EMMANUEL",
            lastName: "IKONG",
            emailAddress: "seunemmanuel107@gmail.com",
            phoneNumber: "08131252996",
            roleId: "R001",
            statusId: 1,
            lastLoginTime: "2026-08-09 20:45:59",
            createdBy: "STAFF001",
            updatedBy: null,
            createdTime: "2026-07-03 10:22:31",
            updatedTime: "2026-07-28 21:06:13",

            roleData: {
                roleId: "R001",
                roleName: "SUPER ADMIN",
                rolePermissionIds: "1,10,11,12,41"
            },

            statusData: {
                statusId: 1,
                statusName: "ACTIVE"
            },

            createdByData: {
                fullname: "OLUWAGBENGA AFOLABI",
                emailAddress: "sunaf4real@gmail.com"
            },

            updatedByData: null
        }
    };

    // Simulate API delay
    setTimeout(() => {
        sessionStorage.setItem(
            "staffLoginData",
            JSON.stringify(response.data)
        );

        _actionAlert(response.message, true);

        window.location.href = portalUrl;
    }, 1000);



    /*
    ///// call endpoint //////
    _callRawEndPoints({
        url: `admin/auth/login`,
        formData,
    })
    .then((response) => {
        sessionStorage.setItem("staffLoginData", JSON.stringify(response?.data));
        _actionAlert(response?.message, true);
        window.location.href = portalUrl;
    })
    .catch((error) => {
        console.error("Error:", error);

        if (error.status == 0) {
            _callAjaxError(() => _proceedLoginCallback(formData), error.message);
            _btnDisable("submitBtn", btnText, false);
        } else {
            _showCustomConfirm({
                title: "Unable to Login!",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });

            _btnDisable("submitBtn", btnText, false);
        }
    });
    */
}

//// Proceed Reset Password ///
function _proceedResetPassword(isResendOtp = false) {
  let staffResetPasswordSession = JSON.parse(localStorage.getItem("staffResetPasswordSession"));

  try {
    let issueCount = 0;
    let emailAddress = $("#emailAddress").val()?.trim();

    // Use session values when resending ///
    if (isResendOtp) {
      emailAddress = staffResetPasswordSession?.emailAddress;
    }

    if (!isResendOtp) {
      ///// empty field validation//////////
      issueCount += _validateEmptyValue("emailAddress", "EMAIL ADDRESS");
      issueCount += _validateEmail("emailAddress", "EMAIL ADDRESS");
    }

    if (issueCount > 0) return;

    // Gather form data
    const formData = {
      emailAddress,
    };

    _proceedResetPasswordCallback(formData, isResendOtp);
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedResetPassword(isResendOtp = false));
  }
}

///// Proceed Reset Password ////
function _proceedResetPasswordCallback(formData, isResendOtp) {
  try { 
    ///// get btn text/////
    let btnText = "";
    if (!isResendOtp) {
      btnText = $("#proceedBtn").html();
      _btnDisable("proceedBtn", btnText, true);
    } else {
      _showLoader("Resending OTP... Please wait...");
    }

     //// call endpoint //////
  _callRawEndPoints({
    url: `admin/auth/reset-password`,
    formData,
  })
    .then((response) => {
      const data = response;
      if (!isResendOtp) {
        _btnDisable("proceedBtn", btnText, false);
        localStorage.setItem(
          "staffResetPasswordSession",
          JSON.stringify(data)
        );
        _showLoader("OTP Sent Successfully!. Please wait...");
        window.location.href = userVerificationUrl;
      } else {
        _hideLoader();
        _actionAlert(response.message, true);
        _counDownOtp(180);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      if (error.status == 0) {
        if (!isResendOtp) {
          _callAjaxError(() => _proceedResetPasswordCallback(formData), error.message); // retry if needed
          _btnDisable("proceedBtn", btnText, false);
        } else {
          _actionAlert('Check your internet connection and try again', false);
          _hideLoader();
        }
      } else {
        if (!isResendOtp) {
          _showCustomConfirm({
            title: "Unable to reset password!",
            message: error.message,
            alertType: "error",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("proceedBtn", btnText, false);
          _hideLoader();
        } else {
        _actionAlert(error.message, false);
          _hideLoader();
        }
      }
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedResetPasswordCallback(formData));
    _hideLoader();
  }
}

//// Proceed OTP Verification ////
function _proceedOtpVerification() {
  try {
    let issueCount = 0;
    const otp = $("#otp").val().trim();

    ///// empty field validation//////////
    if (!otp) {
      $("#otp_box .otp_text_field").addClass("issue");
      $('#issue_otp').html('USER ERROR! OTP REQUIRED');
      issueCount++;
    } else if (otp.length < 6 || !/^\d+$/.test(otp)) {
      $("#otp_box .otp_text_field").addClass("issue");
      $('#issue_otp').html('USER ERROR! OTP must be a 6-digit number');
      issueCount++;
    } else {
      $("#otp_box .otp_text_field").removeClass("issue");
      $('#issue_otp').html('');
    }

    if (issueCount > 0) return;

    // Gather form data
    const formData = {
      otp,
    };

    _proceedOtpVerificationCallback(formData);
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedOtpVerification());
  }
}

/// Proceed OTP Verification Callback ////
function _proceedOtpVerificationCallback(formData) {
  let staffResetPasswordSession = JSON.parse(
    localStorage.getItem("staffResetPasswordSession")
  );

  const staffId = staffResetPasswordSession?.staffId;
  try { 
    btnText = $("#verifyBtn").html();
    _btnDisable("verifyBtn", btnText, true);

    //// call endpoint //////
    _callRawEndPoints({
      url: `admin/auth/otp-verification?staffId=${staffId}`,
      formData,
    })
    .then((response) => {
      const data = response;
      
      _btnDisable("verifyBtn", btnText, false);
      localStorage.setItem("saveAcceesKeySession", JSON.stringify(data?.accessKey));
      _showLoader("OTP Verified Successfully!. Please wait...");
      
      // Remove OTP Session
      localStorage.removeItem("staffResetPasswordSession");
      window.location.replace(completeResetPasswordUrl);
    })
    .catch((error) => {
      console.error("Error:", error);
      if (error.status==0) {
        _callAjaxError(() => _proceedOtpVerificationCallback(formData), error.message); // retry if needed
        _btnDisable("verifyBtn", btnText, false);
      } else {
        _showCustomConfirm({
          title: "Invalid OTP!",
          message: error.message,
          alertType: "error",
          trueActionBtnText: "OK",
          closeOnOverlayClick: true,
        });
        _btnDisable("verifyBtn", btnText, false);
      }
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedOtpVerificationCallback(formData));
  }
}

/// Complete Proceed Password ///
function _completeResetPassword() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const password = $("#password").val().trim();
    const confirmPassword = $("#confirmPassword").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("password", "CREATE NEW PASSWORD");
    issueCount += _validateEmptyValue("confirmPassword", "CONFIRM NEW PASSWORD");

    if (password && confirmPassword) {
      if (password.length < 8) {
				$('#password').addClass("issue");
				$('#issue_password').html('USER ERROR! Password must be at least 8 characters');
				issueCount++;
			}

      if (password !== confirmPassword) {
				$('#password, #confirmPassword').addClass('issue');
				$('#issue_password, #issue_confirmPassword').html('USER ERROR! Passwords do not match');
				issueCount++;
			}

      if (!password.match(/^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/ )) {
				$('#password').addClass("issue");
				$('#issue_password').html('USER ERROR! Password Not Accepted, Please follow the instructon above');
				issueCount++;
			}
    }

    if (issueCount > 0) return;

    // Gather form data
    const formData = {
      password,
      confirmPassword,
    };

    _completeResetPasswordCallback(formData);
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _completeResetPassword());
  }
}

/// Complete Reset Pssword Callback ///
function _completeResetPasswordCallback(formData) {
  let saveAcceesKeySession = JSON.parse(
    localStorage.getItem("saveAcceesKeySession")
  );
 
  try {
    ///// get btn text/////
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    //// call endpoint //////
    _callRawEndPoints({
      url: `admin/auth/create-new-password?accessKey=${saveAcceesKeySession}`,
      formData,
    })
      .then((response) => {
        localStorage.removeItem("saveAcceesKeySession");
        _showCustomConfirm({
          callback: () => {
            window.location.href = adminUrl;
          },
          title: "Success!",
          message: response.message,
          alertType: "success",
          trueActionBtnText: "Okay, Thanks",
          closeOnOverlayClick: false,
        });
        _btnDisable("submitBtn", btnText, false);
      })
      .catch((error) => {
        console.error("Error:", error);
        if (error.status==0) {
          _actionAlert('Check your internet connection and try again', false);
          _btnDisable("submitBtn", btnText, false);
        } else {
          _actionAlert(error.message, false);
          _btnDisable("submitBtn", btnText, false);
        }
      });
    } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _completeResetPasswordCallback(formData));
  }
}