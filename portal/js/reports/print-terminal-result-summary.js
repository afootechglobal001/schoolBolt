function _printTerminalResultSummary() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = getViewTerminalResultSummarySession?.session;
	const termId = getViewTerminalResultSummarySession?.termData?.termId;
	const departmentId = getViewTerminalResultSummarySession?.departmentData?.departmentId;
	const classId = getViewTerminalResultSummarySession?.classData?.classId;
	const armId = getViewTerminalResultSummarySession?.armData?.armId;

	try {
		const btnText = $("#printBtn").html();
		$("#printBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/view-terminal-result-summary?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printTerminalResultSummarySession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-terminal-result-summary`);
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
				$("#printBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printBtn").prop("disabled", false);
	}
}