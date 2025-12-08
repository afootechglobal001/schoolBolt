function _nextLoginPage(props) {
  const { page = "", divid = "" } = props;
  $("#login_id, #reset_pass_id").removeClass("active-li");
  $("#" + divid).addClass("active-li");
  _getPage({ page: page, url: adminLocalUrl });
}

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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////// ADMIN LOGIN FUNCTION ////////
function _confirmLogin() {
  try {
    const userName = $("#userName").val().trim();
    const password = $("#password").val().trim();

    $("#userName, #password").removeClass("issue");

    if (!userName || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(userName)) {
      $("#userName").addClass("issue");
      _actionAlert("Provide a correct email address to continue", false);
      return;
    }

    if (!password) {
      $("#password").addClass("issue");
      _actionAlert("Provide a correct password to continue", false);
      return;
    }

    //////////////// get btn text ////////////////
    const btn_text = $("#submit_btn").html();
    $("#submit_btn").html(
      '<img src="' +
        websiteUrl +
        '/images/loading.gif" width="12px" alt="Loading"/>'
    );
    $("#submit_btn").prop("disabled", true);
    ////////////////////////////////////////////////

    const formData = {
      userName: userName,
      password: password,
    };

    $.ajax({
      type: "POST",
      url: endPoint + "/admin/auth/login",
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
      success: function (data) {
        if (data.success) {
          assignRole(data);
        } else {
          _actionAlert(data.message, false);
        }
        $("#submit_btn").html(btn_text).prop("disabled", false);
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
        $("#submit_btn").html(btn_text).prop("disabled", false);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    $("#submit_btn").prop("disabled", false);
  }
}

function assignRole(data) {
  const staffLoginData = data.data[0];
  const rolePermissionIds = staffLoginData.rolePermissionIds;

  const userRoles = {};
  // Convert string to array of numbers
  const permissions = rolePermissionIds
    .split(",")
    .map((id) => parseInt(id.trim(), 10));

  /////Dashboard Permissions
  permissions.includes(1)
    ? (userRoles.canViewSuperAdminDashboard = true)
    : false;
  permissions.includes(2)
    ? (userRoles.canViewAdministratorDashboard = true)
    : false;
  permissions.includes(3)
    ? (userRoles.canViewSubjectTeacherDashboard = true)
    : false;
  permissions.includes(4)
    ? (userRoles.canViewClassTeacherDashboard = true)
    : false;
  permissions.includes(5) ? (userRoles.canViewIctStaffDashboard = true) : false;
  permissions.includes(6) ? (userRoles.canViewBursaryDashboard = true) : false;

  /////School Permissions
  permissions.includes(7) ? (userRoles.canViewAllBranches = true) : false;
  permissions.includes(8) ? (userRoles.canViewAllStaff = true) : false;
  permissions.includes(9) ? (userRoles.canViewGeneralSettings = true) : false;
  permissions.includes(20)
    ? (userRoles.canViewGeneralNotifications = true)
    : false;
  permissions.includes(21)
    ? (userRoles.canViewAllSchoolBranchesAccounts = true)
    : false;
  /////Class teacher Permissions
  permissions.includes(10)
    ? (userRoles.canManageStudentsAttendance = true)
    : false;
  permissions.includes(11)
    ? (userRoles.canManageClassTeachersComments = true)
    : false;

  /////branch Permissions
  permissions.includes(12) ? (userRoles.canViewBranchSettings = true) : false;
  permissions.includes(13) ? (userRoles.canViewBranchStaff = true) : false;
  permissions.includes(14) ? (userRoles.canViewBranchStudents = true) : false;
  permissions.includes(15) ? (userRoles.canViewBranchClasses = true) : false;
  permissions.includes(16) ? (userRoles.canViewBranchSubjects = true) : false;
  permissions.includes(17) ? (userRoles.canViewBranchResults = true) : false;
  permissions.includes(18) ? (userRoles.canViewBranchProfile = true) : false;
  permissions.includes(19) ? (userRoles.canViewBranchAccount = true) : false;
  permissions.includes(22) ? (userRoles.canViewBranchActivities = true) : false;
  permissions.includes(23) ? (userRoles.canApproveFees = true) : false;

  /// Developer Permissions
  permissions.includes(24) ? (userRoles.canDeleteStaff = true) : false;
  permissions.includes(25) ? (userRoles.canChangeStaffPassword = true) : false;

  // Store in sessionStorage
  sessionStorage.setItem("userRoles", JSON.stringify(userRoles));
  sessionStorage.setItem("staffLoginData", JSON.stringify(staffLoginData));
  _actionAlert(data.message, true);
  window.location.href = adminPortalUrl;
}

function _proceedResetPassword(sessionEmail = null, btnId = "proceedBtn") {
  try {
    let issueCount = 0;
    let email = sessionEmail || $("#email").val().trim();

    if (!sessionEmail) {
      $("#email").removeClass("issue");
      $("#issue_email").html("");

      if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        $("#email").addClass("issue");
        $("#issue_email").html(
          "USER ERROR! Kindy provide correct email address to continue"
        );
        issueCount++;
      }

      if (issueCount > 0) return;
    }

    ////////////// get btn text ////////////////
    const btnText = $("#" + btnId).html();
    $("#" + btnId).html(
      '<img src="' +
        websiteUrl +
        '/images/loading.gif" width="12px" alt="Loading"/>'
    );
    $("#" + btnId).prop("disabled", true);
    ////////////////////////////////////////////////

    const formData = {
      email: email,
    };

    $.ajax({
      type: "POST",
      url: endPoint + "/admin/auth/reset-password",
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
          sessionStorage.setItem("staffEmailSession", JSON.stringify(info));
          _getPage({ page: "send-link-mail", url: adminLocalUrl });
        } else {
          _actionAlert(info.message, false);
        }
        $("#" + btnId)
          .html(btnText)
          .prop("disabled", false);
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false
        );
        $("#" + btnId)
          .html(btnText)
          .prop("disabled", false);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    $("#" + btnId).prop("disabled", false);
  }
}

//////LINK VERIFICATION FUNCTION////////
function _verifyLink(ref) {
  $("#page-content")
    .html(
      '<div class="ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif"/></div>'
    )
    .css({
      display: "flex",
      "flex-direction": "column",
      gap: "20px",
      "align-items": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/auth/verify-link?ref=${ref}`,
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
      if (info.success == true) {
        sessionStorage.setItem(
          "staffCompleteResetEmailSession",
          JSON.stringify(info)
        );
        _getPage({ page: "complete-reset-password", url: adminLocalUrl });
      } else {
        _getPage({ page: "verify-ref-response", url: adminLocalUrl });
      }
    },
  });
}

function _completeResetPassword() {
  let staffCompleteResetEmailSession = JSON.parse(
    sessionStorage.getItem("staffCompleteResetEmailSession")
  );
  try {
    let issueCount = 0;
    const newPassword = $("#newPassword").val();
    const cnewPassword = $("#cnewPassword").val();

    $("#newPassword, #cnewPassword").removeClass("issue");
    $("#issue_newPassword, #issue_cnewPassword").html("");

    if (!newPassword) {
      $("#newPassword").addClass("issue");
      $("#issue_newPassword").html(
        "USER ERROR! Kindly Provide New Password To Continue"
      );
      issueCount++;
    }

    if (!cnewPassword) {
      $("#cnewPassword").addClass("issue");
      $("#issue_cnewPassword").html(
        "USER ERROR! Kindly Provide Confirm New Password To Continue"
      );
      issueCount++;
    }

    if (newPassword && cnewPassword) {
      if (newPassword.length < 8) {
        $("#newPassword").addClass("issue");
        $("#issue_newPassword").html(
          "USER ERROR! Password must be at least 8 characters"
        );
        issueCount++;
      }

      if (newPassword !== cnewPassword) {
        $("#newPassword, #cnewPassword").addClass("issue");
        $("#issue_cnewPassword, #issue_cnewPassword").html(
          "USER ERROR! Passwords do not match"
        );
        issueCount++;
      }

      if (
        !newPassword.match(
          /^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/
        )
      ) {
        $("#newPassword").addClass("issue");
        $("#newPassword").addClass("issue");
        $("#issue_newPassword").html(
          "USER ERROR! Password Not Accepted, Please follow the instructon above"
        );
        issueCount++;
      }
    }

    if (issueCount > 0) {
      return;
    }

    //////////////// get btn text ////////////////
    const btn_text = $("#completeBtn").html();
    $("#completeBtn").html(
      '<img src="' +
        websiteUrl +
        '/images/loading.gif" width="12px" alt="Loading"/>'
    );
    $("#completeBtn").prop("disabled", true);

    const formData = {
      newPassword: newPassword,
      cnewPassword: cnewPassword,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/admin/auth/complete-reset-password?email=${staffCompleteResetEmailSession.email}`,
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
      processData: false,
      success: function (info) {
        const success = info.success;
        const message = info.message;

        if (success == true) {
          _actionAlert(message, true);
          _getForm({ page: "password_reset_successful", url: adminLocalUrl });
        } else {
          _actionAlert(message, false);
        }
        $("#submitBtn").html(btn_text).prop("disabled", false);
      },
      error: function (error) {
        _actionAlert(
          "An error occurred while processing your request! Please Try Again",
          false
        );
        $("#submitBtn").html(btn_text).prop("disabled", false);
      },
    });
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#submitBtn").prop("disabled", false);
  }
}
