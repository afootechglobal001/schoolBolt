function _printAllStudentTerminalResult() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = getViewTerminalResultSummarySession?.session;
	const termId = getViewTerminalResultSummarySession?.termData?.termId;
	const departmentId = getViewTerminalResultSummarySession?.departmentData?.departmentId;
	const classId = getViewTerminalResultSummarySession?.classData?.classId;
	const armId = getViewTerminalResultSummarySession?.armData?.armId;

	try {
		const btnText = $("#printAllTerminalBtn").html();
		$("#printAllTerminalBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printAllTerminalBtn").prop("disabled", true);
		
		let callUrl="";
		if (termId==='1') {
			callUrl=`${endPoint}/reports/print-all-student-first-term-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`;
		} else if (termId==='2') {
			callUrl=`${endPoint}/reports/print-all-student-second-term-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`;
		} else if (termId==='3') {
			callUrl=`${endPoint}/reports/print-all-student-third-term-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`;
		}

		$.ajax({
			type: "GET",
			url: callUrl,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0 && info.eachStudentResultData.length > 0) {
					sessionStorage.setItem("printAllStudentTerminalResultSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-all-student-terminal-result`, '_blank');
				} else {
					_actionAlert('No data available to print.', false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printAllTerminalBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printAllTerminalBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printAllTerminalBtn").prop("disabled", false);
	}
}