function _printComputeFee(branchId, departmentId, classId, currentSession, termId) {
	try {
		const btnText = $(`#printFeesBtn_${classId}`).html();
		$(`#printFeesBtn_${classId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printFeesBtn_${classId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-compute?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&session=${currentSession}&termId=${termId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printComputeFeeByClassSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/compute-fee-list`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printFeesBtn_${classId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$(`#printFeesBtn_${classId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printFeesBtn_${classId}`).html(btnText).prop("disabled", false);
	}
}