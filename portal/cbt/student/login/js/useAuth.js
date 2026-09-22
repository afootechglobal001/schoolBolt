$(document).ready(function () {
  function trim(s) {
    return s.replace(/^\s*/, "").replace(/\s*$/, "");
  }
  $("#viewLogin").keydown(function (e) {
    if (e.keyCode == 13) {
      _confirmCbtAdminLogin();
    }
  });
});


////// ADMIN LOGIN FUNCTION ////////
function _confirmCbtAdminLogin(){
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
		_proceedCbtAdminLoginCallback(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _confirmCbtAdminLogin());
	}
}

//// //// ADMIN LOGIN CALLBACK FUNCTION ////////
function _proceedCbtAdminLoginCallback(formData) {
    ///// get btn text /////
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    ///// call endpoint //////
    _callRawEndPoints({
        url: `cbt/admin/auth/login`,
        formData,
    })
    .then((response) => {
        _assignRole(response);
    })
    .catch((error) => {
        console.error("Error:", error);
        if (error.status == 0) {
            _callAjaxError(() => _proceedCbtAdminLoginCallback(formData), error.message);
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
}

/// assign role to user ///
function _assignRole(response) {
    const staffLoginData = response?.data;
    const rolePermissionIds = staffLoginData.rolePermissionIds;

    const userRoles = {};
    // Convert string to array of numbers
    const permissions = rolePermissionIds
        .split(",")
        .map((id) => parseInt(id.trim(), 10));

    ///// Dashboard Permissions
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

    permissions.includes(5)
        ? (userRoles.canViewIctStaffDashboard = true)
        : false;

    /// CBT Permission
    permissions.includes(40)
        ? (userRoles.canSetCbtExam = true)
        : false;

    permissions.includes(41)
        ? (userRoles.canActivateCbtExam = true)
        : false;

    permissions.includes(42)
        ? (userRoles.canViewCbtExam = true)
        : false;

    // Store in sessionStorage
    sessionStorage.setItem("userRoles", JSON.stringify(userRoles));
    sessionStorage.setItem("staffLoginData", JSON.stringify(staffLoginData));
    _actionAlert(response?.message, true);
    window.location.href = cbtAdminUrl;
}