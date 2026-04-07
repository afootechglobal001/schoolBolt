$(document).ready(function () {
  $("#viewLogin input, #viewLogin select").on("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      _confirmLoginEmail(false);
    }
  });

  $("#viewOtp input").on("keydown", function (e) {
    if (e.key === "Enter") {
      e.preventDefault();
      _proceedToLogin();
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
      timer--;

      let minutes = Math.floor(timer / 60);
      let seconds = timer % 60;

      if (timer >= 60) {
        // Show MM:SS when 1 min or more
        seconds = seconds < 10 ? "0" + seconds : seconds;
        $("#resendCountdown").html(
          'Resend in <strong id="timer">' + minutes + ":" + seconds + '</strong> min'
        );
      } else {
        // Show seconds only when below 1 minute
        $("#resendCountdown").html(
          'Resend in <strong id="timer">' + seconds + '</strong> sec'
        );
      }

    } else {
      clearInterval(countdown);
      $("#resendCountdown").hide();
      $("#resendOtpBtn").fadeIn(500);
    }
  }, 1000);

  return () => clearInterval(countdown);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Confirm Login Email ///
function _confirmLoginEmail(isResend = false) {
  let parentProceedLoginSession = JSON.parse(
    localStorage.getItem("parentProceedLoginSession")
  );
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
    _callCatchError(() => _confirmLoginEmail((isResend = false)));
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
        if (!isResend) {
          _btnDisable("proceedLoginBtn", btnText, false);
          localStorage.setItem(
            "parentProceedLoginSession",
            JSON.stringify(response)
          );
          _showLoader("OTP Sent Successfully!. Please wait...");
          window.location.href = parentOtpVerificationUrl;
        } else {
          _hideLoader();
          _counDownOtp(180);
        }
      } else {
        _btnDisable("proceedLoginBtn", btnText, false);
        _showCustomConfirm({
          title: "Invalid Credentials!",
          message: response.message,
          alertType: "error",
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
function _proceedToLogin() {
  let parentProceedLoginSession = JSON.parse(
    localStorage.getItem("parentProceedLoginSession")
  );
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const otp = $("#otp").val();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("otp", "OTP");

    if (issueCount > 0) return;

    // Gather form data
    const formData = {
      otp,
      parentTypeId: parentProceedLoginSession.parentTypeId,
      email: parentProceedLoginSession.email,
    };

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
        _showLoader("Login Successful. Redirecting, please wait…");
        window.location.href = parentPortalUrl;
        _btnDisable("submitBtn", btnText, false);
      } else {
        _btnDisable("submitBtn", btnText, false);
        _hideLoader();
        _showCustomConfirm({
          title: "Invalid OTP",
          message: response.message,
          alertType: "error",
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


/// Proceed To Login ///
function _proceedViewStudentResult() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const studentId = $("#studentId").val();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("studentId", "STUDENT ID");

    if (issueCount > 0) return;

    // Gather form data
    const formData = {
      studentId,
    };

    _proceedViewStudentCallback(formData);
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedViewStudentResult());
  }
}

/// Proceed To Login Callback ///
function _proceedViewStudentCallback(formData) {
  ///// get btn text/////
  const btnText = $("#proceedResult").html();
  _btnDisable("proceedResult", btnText, true);

  //// call endpoint //////
  _callRawEndPoints({
    url: `parent/auth/view-student-result-verification`,
    formData,
  })
    .then((response) => {
      if (response.success) {
        localStorage.setItem("proceedViewResultSessionData", JSON.stringify(response));
        window.location.href = parentViewResultUrl;
        _btnDisable("proceedResult", btnText, false);
      } else {
        _btnDisable("proceedResult", btnText, false);

        if (response.response===104) {
          _showCustomConfirm({
            title: "Student Not Found",
            message: "The student ID you entered does not exist. Please check and try again.",
            alertType: "error",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
        } else if (response.response===200) {
          const staffContactForAccount = response?.staffContactForAccount;
          const studentData = response?.studentData;
          const accountWhatsappNumber = staffContactForAccount?.mobileNumber;
          const studentFullName = studentData?.fullName;

          _showCustomConfirm({
            title: "Unable To View Result",
            message: response.message,
            alertType: "error",
            falseActionBtn: true,
            trueActionBtnText: "WHATSAPP",
            falseActionBtnText: "CANCEL",
            trueActionCallback: () => {
              window.open("https://api.whatsapp.com/send?text=Hello, I am the parent of " + studentFullName + ". I would like to request access to view my child's academic result. Kindly assist me. Thank you.&phone=+234" + accountWhatsappNumber, "_blank");
            },
            closeOnOverlayClick: true,
          });
        }
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      _callAjaxError(() => _proceedViewStudentCallback(formData)); // retry if needed
      _btnDisable("proceedResult", btnText, false);
    });
}
