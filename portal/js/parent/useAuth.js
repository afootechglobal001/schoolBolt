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
			'id': 'father',
			'value': 'FATHER',
		},
		{
			'id': 'mother',
			'value': 'MOTHER',
		},
	];

	for (let i = 0; i < data.length; i++) {
		const id = data[i].id;
		const value = data[i].value;
		$('#searchList_' + fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">' + value + '</li>');
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


////// PARENT LOGIN FUNCTION ////////
function _confirmLogin() {
	try {
		const parentTypeId = $('#parentTypeId').val().trim();
		const email = $("#email").val().trim();
		const phone = $("#phone").val().trim();

		$('#parentTypeId, #email, #phone').removeClass("issue");

		if (!parentTypeId) {
			$('#parentTypeId').addClass('issue');
			_actionAlert('Select parent type to continue', false);
			return;
		} 

		if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
			$('#email').addClass('issue');
			_actionAlert('Provide a correct email address to continue', false);
			return;
		} 	

		const phonePattern = /^(0)(7|8|9)(0|1)\d{8}$/;
		if (!phone || !phonePattern.test(phone)) {
			$('#phone').addClass('issue');
			_actionAlert('Provide a correct phone number to continue', false);
			return;
		}
		
		//////////////// get btn text ////////////////
		const btnText = $("#loginBtn").html();
		$("#loginBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#loginBtn").prop("disabled", true);
		////////////////////////////////////////////////
		
		const formData = {
			"parentTypeId": parentTypeId,
			"email": email,
			"phone": phone
		};

		$.ajax({
			type: "POST",
			url: endPoint+'/parent/auth/login',
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
			success: function (info) {
				if (info.success) {
					sessionStorage.setItem("parentSessionData", JSON.stringify(info));
					_actionAlert(info.message, true);
					window.location.href = parentPortalUrl;
				} else {
					_actionAlert(info.message, false);
				}
				$("#loginBtn").html(btnText).prop("disabled", false);
			},
			error: function () {
				_actionAlert("Unable to reach the server. Please check your connection.", false);
				$("#loginBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Unexpected error:", error);
		_actionAlert("An unexpected error occurred. Please try again.", false);
		$("#loginBtn").prop("disabled", false);
	}
}
