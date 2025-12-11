function _printAllStudentProgressReport() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = getViewTerminalResultSummarySession?.session;
	const termId = getViewTerminalResultSummarySession?.termData?.termId;
	const departmentId = getViewTerminalResultSummarySession?.departmentData?.departmentId;
	const classId = getViewTerminalResultSummarySession?.classData?.classId;
	const armId = getViewTerminalResultSummarySession?.armData?.armId;

	try {
		const btnText = $("#progressReportBtn").html();
		$("#progressReportBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#progressReportBtn").prop("disabled", true);
		
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-all-student-progressive-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0 && info.eachStudentResultData.length > 0) {
					sessionStorage.setItem("printAllStudentProgressResultSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-all-student-progressive-result`, '_blank');
				} else {
					_actionAlert('No data available to print.', false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#progressReportBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#progressReportBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#progressReportBtn").prop("disabled", false);
	}
}