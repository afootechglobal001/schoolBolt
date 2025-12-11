function _printBranchFeesSettings() {
  	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		const btnText = $("#printFeesSettingsBtn").html();
		$("#printFeesSettingsBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printFeesSettingsBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession?.branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printFeesSettingsSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/fees-settings-list`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printFeesSettingsBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printFeesSettingsBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printFeesSettingsBtn").html(btnText).prop("disabled", false);
	}
}