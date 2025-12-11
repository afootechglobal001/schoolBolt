function _printContemporaryMarkBookPerSubject(departmentId, classId, armId, subjectId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));

	try {
		const btnText = $(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).html();
		$(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-contemporary-mark-book-per-subject?branchId=${getEachStaffDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printContemporaryMarkBookSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-contemporary-mark-book-per-subject`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printMarkBookBtn_${classId}_${armId}_${subjectId}`).prop("disabled", false);
	}
}