function _nextLoginPage(props) {
	const {
        page = '',
        divid = '',
    } = props;
	$('#login_id, #reset_pass_id').removeClass('active-li');
	$('#' + divid).addClass('active-li');
	_getPage({page: page, url: adminLocalUrl});
}
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
					sessionStorage.setItem("staffLoginData", JSON.stringify(data.data[0]));
					_actionAlert(data.message, true);
					window.location.href = adminPortalUrl;
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
