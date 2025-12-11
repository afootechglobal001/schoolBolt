function _printScoreSheet(departmentId, classId, armId, subjectId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	try {
		const btnText = $(`#printScoreSheetBtn_${subjectId}`).html();
		$(`#printScoreSheetBtn_${subjectId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printScoreSheetBtn_${subjectId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-score-sheet?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStudentScoreSheetSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-score-sheet`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printScoreSheetBtn_${subjectId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$(`#printScoreSheetBtn_${subjectId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printScoreSheetBtn_${subjectId}`).prop("disabled", false);
	}
}