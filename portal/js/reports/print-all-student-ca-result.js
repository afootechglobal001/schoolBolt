function _printAllStudentCaResult() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let getViewResultSummarySession = JSON.parse(sessionStorage.getItem("getViewResultSummarySession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = getViewResultSummarySession?.session;
	const termId = getViewResultSummarySession?.termData?.termId;
	const departmentId = getViewResultSummarySession?.departmentData?.departmentId;
	const classId = getViewResultSummarySession?.classData?.classId;
	const armId = getViewResultSummarySession?.armData?.armId;
	const assessmentId = getViewResultSummarySession?.assessmentData?.assessmentId;

	try {
		const btnText = $("#printAllBtn").html();
		$("#printAllBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printAllBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-all-student-ca-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printAllStudentCaResultSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-all-student-ca-result`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printAllBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printAllBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printAllBtn").prop("disabled", false);
	}
}