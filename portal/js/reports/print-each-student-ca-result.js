function _printEachStudentCaResult(branchId, session, termId, departmentId, classId, armId, assessmentId, studentId) {
	try {
		const btnText = $(`#printAssBtn_${studentId}`).html();
		$(`#printAssBtn_${studentId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printAssBtn_${studentId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-each-student-ca-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}&studentId=${studentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printSingleAssessementSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-each-student-ca-result`, '_blank');
					
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printAssBtn_${studentId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$(`#printAssBtn_${studentId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printAssBtn_${studentId}`).prop("disabled", false);
	}
}