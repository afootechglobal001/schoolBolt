function _nextLoginPage(props) {
	const {
        page = '',
        divid = '',
    } = props;
	$('#login_id, #reset_pass_id').removeClass('active-li');
	$('#' + divid).addClass('active-li');
	_getPage({page: page, url: adminLocalUrl});
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
		const userName = $('#userName').val().trim();
		const password = $("#password").val().trim();

		$('#userName, #password').removeClass("issue");

		if (!userName || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(userName)) {
			$('#userName').addClass('issue');
			_actionAlert('Provide a correct email address to continue', false);
			return;
		} 	

		if (!password) {
			$('#password').addClass('issue');
			_actionAlert('Provide a correct password to continue', false);
			return;
		} 
		
		//////////////// get btn text ////////////////
		const btn_text = $("#submit_btn").html();
		$("#submit_btn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#submit_btn").prop("disabled", true);
		////////////////////////////////////////////////
		
		const formData = {
			"userName": userName,
			"password": password
		};

		$.ajax({
			type: "POST",
			url: endPoint+'/admin/auth/login',
			data: JSON.stringify(formData),
			dataType: "json", 
			cache: false,
			headers: {
				'apiKey': apiKey,
				'userOsBrowser': userOsBrowser,
				'userIpAddress': userIpAddress,
				'userDeviceId': userDeviceId,
				'clientId': clientId,
				'clientAddress': clientAddress
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
				_actionAlert("Unable to reach the server. Please check your connection.", false);
				$("#submit_btn").html(btn_text).prop("disabled", false);
			}
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
	const permissions = rolePermissionIds.split(',').map(id => parseInt(id.trim(), 10));

	/////Dashboard Permissions
	permissions.includes(1) ? userRoles.canViewSuperAdminDashboard = true : false;
	permissions.includes(2) ? userRoles.canViewAdministratorDashboard = true : false;
	permissions.includes(3) ? userRoles.canViewSubjectTeacherDashboard = true : false;
	permissions.includes(4) ? userRoles.canViewClassTeacherDashboard = true : false;
	permissions.includes(5) ? userRoles.canViewIctStaffDashboard = true : false;
	permissions.includes(6) ? userRoles.canViewBursaryDashboard = true : false;

 	/////Branch Permissions
	permissions.includes(7) ? userRoles.canViewBranch = true : false;
	permissions.includes(8) ? userRoles.canCreateBranch = true : false;
	permissions.includes(9) ? userRoles.canModifyBranch = true : false;

	/////Administrative Permissions
	permissions.includes(10) ? userRoles.canViewStaff = true : false;
	permissions.includes(11) ? userRoles.canCreateStaff = true : false;
	permissions.includes(12) ? userRoles.canModifyStaff = true : false;

	/////Student Permissions
	permissions.includes(13) ? userRoles.canViewStudent = true : false;
	permissions.includes(14) ? userRoles.canCreateStudent = true : false;
	permissions.includes(15) ? userRoles.canModifyStudent = true : false;

	/////Department Permissions
	permissions.includes(16) ? userRoles.canViewDepartment = true : false;
	permissions.includes(17) ? userRoles.canCreateDepartment = true : false;
	permissions.includes(18) ? userRoles.canModifyDepartment = true : false;

	/////Class Permissions
	permissions.includes(19) ? userRoles.canViewClass = true : false;
	permissions.includes(20) ? userRoles.canCreateClass = true : false;
	permissions.includes(21) ? userRoles.canModifyClass = true : false;

	/////Arms Permissions
	permissions.includes(22) ? userRoles.canViewArm = true : false;
	permissions.includes(23) ? userRoles.canCreateArm = true : false;
	permissions.includes(24) ? userRoles.canModifyArm = true : false;

	/////Subjects Permissions
	permissions.includes(25) ? userRoles.canViewSubject = true : false;
	permissions.includes(26) ? userRoles.canCreateSubject = true : false;
	permissions.includes(27) ? userRoles.canModifySubject = true : false;

	/////Class Teacher's Permissions
	permissions.includes(28) ? userRoles.canViewStudentAttendance = true : false;
	permissions.includes(29) ? userRoles.canCreateStudentAttendance = true : false;
	permissions.includes(30) ? userRoles.canModifyStudentAttendance = true : false;
	permissions.includes(31) ? userRoles.canViewClassTeachersCommemt = true : false;
	permissions.includes(32) ? userRoles.canCreateClassTeachersCommemt = true : false;
	permissions.includes(33) ? userRoles.canModifyClassTeachersCommemt = true : false;

	/////Report Permissions
	permissions.includes(41) ? userRoles.canViewViewReport  = true : false;

	/////Role Permissions
	permissions.includes(42) ? userRoles.canViewRole = true : false;
	permissions.includes(43) ? userRoles.canCreateRole = true : false;
	permissions.includes(44) ? userRoles.canModifyRole = true : false;

	/////Fees Permissions
	permissions.includes(45) ? userRoles.canViewFees = true : false;
	permissions.includes(46) ? userRoles.ComputeAndModifyFees = true : false;

	/////settings Permissions
	permissions.includes(47) ? userRoles.canViewGeneralSettings = true : false;

	/////Notifications Permissions
	permissions.includes(48) ? userRoles.canViewGeneralNotifications = true : false;

	// Store in sessionStorage
	sessionStorage.setItem('userRoles', JSON.stringify(userRoles));
	sessionStorage.setItem("staffLoginData", JSON.stringify(staffLoginData));
	_actionAlert(data.message, true);
	window.location.href = adminPortalUrl;
}