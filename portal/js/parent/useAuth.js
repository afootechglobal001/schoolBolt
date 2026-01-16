$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }
  $("#viewLogin").keydown(function (e) {
    if (e.keyCode == 13) {
      _confirmLoginEmail();
    }
  });
});

function _getSelectParentType(fieldId) {
  const data = [
    {
      id: "father",
      value: "FATHER",
    },
    {
      id: "mother",
      value: "MOTHER",
    },
  ];

  for (let i = 0; i < data.length; i++) {
    const id = data[i].id;
    const value = data[i].value;
    $("#searchList_" + fieldId).append(
      "<li onclick=\"_clickOption('searchList_" +
        fieldId +
        "', '" +
        id +
        "', '" +
        value +
        "')\">" +
        value +
        "</li>"
    );
  }
}

function isNumberCheck(e) {
  var key = e.keyCode || e.which;

  if (!(key >= 48 && key <= 57)) {
    if (e.preventDefault) {
      e.preventDefault();
    } else {
      e.returnValue = false;
    }
  }
}

function _counDownOtp(timer) {
  $("#resendOtpBtn").hide();
  $("#resendCountdown").fadeIn(500);
  const countdown = setInterval(() => {
    if (timer > 0) {
      timer = timer - 1;
      $("#timer").html(timer);
    } else {
      $("#resendCountdown").hide();
      $("#resendOtpBtn").fadeIn(500);
      clearInterval(countdown);
    }
  }, 1000);
  return () => clearInterval(countdown);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Confirm Login Email ///
function _confirmLoginEmail(isResend = false){
  let parentProceedLoginSession = JSON.parse(localStorage.getItem("parentProceedLoginSession"));
	try {
		////////get all needed values////////////
		let issueCount = 0;
		let parentTypeId = $("#parentTypeId").val()?.trim();
    let email = $("#email").val()?.trim();

    // Use session values when resending ///
    if (isResend) {
      parentTypeId = parentProceedLoginSession.parentTypeId;
      email = parentProceedLoginSession.email;
    }

		///// empty field validation//////////
		if (!isResend) {
      issueCount += _validateEmptyValue("parentTypeId", "PARENT TYPE");
      issueCount += _validateEmptyValue("email", "EMAIL ADDRESS");
    }

		if (issueCount > 0) return;

		// Gather form data
		const formData = { parentTypeId, email };

		_confirmLoginCallback(formData, isResend);
		
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _confirmLoginEmail(isResend = false));
	}
}

///  Confirm Login Callback ///
function _confirmLoginCallback(formData, isResend) {
	///// get btn text/////
  let btnText = "";
  if (!isResend) {
    btnText = $("#proceedLoginBtn").html();
    _btnDisable("proceedLoginBtn", btnText, true);
  } else {
    _showLoader("Resending OTP, please wait...");
  }
	//// call endpoint //////
	_callRawEndPoints({
		url: `parent/auth/verification`,
		formData,
	})
    .then((response) => {
  if (response.success) {
    _showCustomConfirm({
      callback: () => {
        if (!isResend) {
          localStorage.setItem("parentProceedLoginSession", JSON.stringify(response));
          window.location.href = parentOtpVerificationUrl;
        } else {
          _hideLoader();
          _counDownOtp(30);
        }
      },
      title: 'Success!',
      message: 'Your OTP has been successfully sent to your email. Please proceed to enter the code to continue.',
      alertType: 'success',
      trueActionBtnText: 'Proceed.',
      closeOnOverlayClick: false,
    });

    if (!isResend) {
      _btnDisable("proceedLoginBtn", btnText, false);
    } else {
      _hideLoader();
    }
    
		} else {
			_btnDisable("proceedLoginBtn", btnText, false);
			_showCustomConfirm({
				title: "PROCEED LOGIN",
				message: response.message,
				alertType: "warning",
				trueActionBtnText: "OK",
        closeOnOverlayClick: true,
			});
		}
  })
  .catch((error) => {
		console.error("Error:", error);
		_callAjaxError(() => _confirmLoginCallback(formData)); // retry if needed
    if (!isResend) {
		  _btnDisable("proceedLoginBtn", btnText, false);
    } else {
      _hideLoader();
    }
  });
}

/// Proceed To Login ///
function _proceedToLogin(){
  let parentProceedLoginSession = JSON.parse(localStorage.getItem("parentProceedLoginSession"));
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const otp = $("#otp").val();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("otp", "OTP");

		if (issueCount > 0) return;

		// Gather form data
		const formData = { otp, parentTypeId: parentProceedLoginSession.parentTypeId, email: parentProceedLoginSession.email };

		_proceedToLoginCallback(formData);
		
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedToLogin());
	}
}

/// Proceed To Login Callback ///
function _proceedToLoginCallback(formData) {
	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
	//// call endpoint //////
	_callRawEndPoints({
		url: `parent/auth/login`,
		formData,
	})
    .then((response) => {
  if (response.success) {
      localStorage.setItem("parentSessionData", JSON.stringify(response));
      _showLoader("Login Successful.. Redirecting, please wait...");
      window.location.href = parentPortalUrl;
      _btnDisable("submitBtn", btnText, false);
		} else {
			_btnDisable("submitBtn", btnText, false);
      _hideLoader();
			_showCustomConfirm({
				title: "PROCEED LOGIN",
				message: response.message,
				alertType: "warning",
				trueActionBtnText: "OK",
        closeOnOverlayClick: true,
			});
		}
    })
    .catch((error) => {
		console.error("Error:", error);
		_callAjaxError(() => _proceedToLoginCallback(formData)); // retry if needed
		_btnDisable("submitBtn", btnText, false);
    _hideLoader();
    });
}