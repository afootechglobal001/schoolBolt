function _changePassword() {
	try {
		let issueCount=0;
		const oldPassword=$('#oldPassword').val();
		const newPassword=$('#newPassword').val();
		const cnewPassword=$('#cnewPassword').val();

		$('#oldPassword, #newPassword, #cnewPassword').removeClass('issue');
		$('#issue_oldPassword, #issue_newPassword, #issue_cnewPassword').html('');

		if (!oldPassword) {
			$('#oldPassword').addClass('issue');
			$('#issue_oldPassword').html('USER ERROR! Kindly Provide Old Password To Continue');
			issueCount++;
		}

		if (!newPassword) {
			$('#newPassword').addClass('issue');
			$('#issue_newPassword').html('USER ERROR! Kindly Provide New Password To Continue');
			issueCount++;
		}

		if (!cnewPassword) {
			$('#cnewPassword').addClass('issue');
			$('#issue_cnewPassword').html('USER ERROR! Kindly Provide Confirm New Password To Continue');
			issueCount++;
		}

		if (newPassword && cnewPassword) {
			if (newPassword.length < 8) {
				$('#newPassword').addClass("issue");
				$('#issue_newPassword').html('USER ERROR! Password must be at least 8 characters');
				issueCount++;
			}

			if (newPassword !== cnewPassword) {
				$('#newPassword, #cnewPassword').addClass('issue');
				$('#issue_cnewPassword, #issue_cnewPassword').html('USER ERROR! Passwords do not match');
				issueCount++;
			}

			if (!newPassword.match(/^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/ )) {
			$('#newPassword').addClass("issue");
				$('#newPassword').addClass("issue");
				$('#issue_newPassword').html('USER ERROR! Password Not Accepted, Please follow the instructon above');
				issueCount++;
			}
		}


		if (issueCount>0){
			return;
		}

		//////////////// get btn text ////////////////
		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"oldPassword": oldPassword,
				"newPassword": newPassword,
				"cnewPassword": cnewPassword
			};
	
			$.ajax({
				type: "POST",
				url: endPoint +'/admin/settings/change-password',
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false, 
				headers: getAuthHeaders(true),
				success: function (info) {
					const success = info.success;
					const message = info.message;
				
					if (success == true) {
						_actionAlert(message, true);
						_getForm({page: 'accessKeyValidationForm', url: adminPortalLocalUrl});
					} else {
						_actionAlert(message, false);				
					}	
					$("#submitBtn").html(btn_text).prop("disabled", false);
				},
				error: function (error) {
					_actionAlert('An error occurred while processing your request! Please Try Again', false);
					$("#submitBtn").html(btn_text).prop("disabled", false);
				}
			});
		
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$("#submitBtn").prop("disabled", false);
	}	
}
