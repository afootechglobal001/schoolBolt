$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }
  $("#viewLogin").keydown(function (e) {
    if (e.keyCode == 13) {
      _confirmLogin();
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

function _confirmLoginEmail(isResend = false) {
  let parentProceedLoginSession = JSON.parse(
    sessionStorage.getItem("parentProceedLoginSession") || "{}"
  );

  try {
    let parentTypeId = $("#parentTypeId").val();
    let email = $("#email").val();

    $("#parentTypeId, #email").removeClass("issue");

    // Use session values when resending
    if (isResend) {
      parentTypeId = parentProceedLoginSession.parentTypeId;
      email = parentProceedLoginSession.email;
    }

    if (!parentTypeId) {
      $("#parentTypeId").addClass("issue");
      _actionAlert("Select parent type to continue", false);
      return;
    }

    if (!email || email.indexOf("@") <= 0) {
      $("#email").addClass("issue");
      _actionAlert("Provide correct email address to continue", false);
      return;
    }

    ////////////////// UI HANDLING //////////////////
    let btnText = "";

    if (!isResend) {
      btnText = $("#proceedLoginBtn").html();
      $("#proceedLoginBtn")
        .html(
          `<img src="${websiteUrl}/images/loading.gif" width="12px">`
        )
        .prop("disabled", true);
    } else {
      // show loader in modal for resend
      _showLoader("Resending OTP, please wait...");
    }
    /////////////////////////////////////////////////

    const formData = { parentTypeId, email };

    $.ajax({
      type: "POST",
      url: endPoint + "/parent/auth/verification",
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: {
        apiKey,
        userOsBrowser,
        userIpAddress,
        userDeviceId,
        clientId,
        clientAddress,
      },

      success: function (info) {
        if (info.success) {
          sessionStorage.setItem(
            "parentProceedLoginSession",
            JSON.stringify(info)
          );

          _actionAlert(info.message, true);

          if (!isResend) {
            _getForm({ page: "otpVerificationForm", url: parentPortalLocalUrl });
          } else {
            // restart countdown for resend
            _counDownOtp(30);
          }
        } else {
          _actionAlert(info.message, false);
        }
      },

      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
      },

      complete: function () {
        if (!isResend) {
          $("#proceedLoginBtn").html(btnText).prop("disabled", false);
        } else {
          _hideLoader();
        }
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    $("#proceedLoginBtn").prop("disabled", false);
    _hideLoader();
  }
}


////// PARENT LOGIN FUNCTION ////////
function _proceedToLogin() {
  let parentProceedLoginSession = JSON.parse(
    sessionStorage.getItem("parentProceedLoginSession")
  );
  try {
    const otp = $("#otp").val();

    $("#otp").removeClass("issue");

    if (!otp) {
      $("#otp").addClass("issue");
      _actionAlert("Provide Correct OTP To Continue", false);
      return;
    }

    //////////////// get btn text ////////////////
    const btnText = $("#submitBtn").html();
    $("#submitBtn").html(
      '<img src="' +
        websiteUrl +
        '/images/loading.gif" width="12px" alt="Loading"/>'
    );
    $("#submitBtn").prop("disabled", true);
    ////////////////////////////////////////////////

    const formData = {
      parentTypeId: parentProceedLoginSession.parentTypeId,
      email: parentProceedLoginSession.email,
      otp: otp,
    };

    $.ajax({
      type: "POST",
      url: endPoint + "/parent/auth/login",
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: {
        apiKey: apiKey,
        userOsBrowser: userOsBrowser,
        userIpAddress: userIpAddress,
        userDeviceId: userDeviceId,
        clientId: clientId,
        clientAddress: clientAddress,
      },
      success: function (info) {
        if (info.success) {
          localStorage.setItem("parentSessionData", JSON.stringify(info));
          _actionAlert(info.message, true);
          window.location.href = parentPortalUrl;
        } else {
          _actionAlert(info.message, false);
        }
        $("#submitBtn").html(btnText).prop("disabled", false);
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
        $("#submitBtn").html(btnText).prop("disabled", false);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    $("#submitBtn").prop("disabled", false);
  }
}
