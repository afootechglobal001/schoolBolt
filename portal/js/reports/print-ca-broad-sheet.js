function _printCaBroadSheet(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const session = fetchPresetDataSession?.session;
	const termId = fetchPresetDataSession?.termData?.termId;
	const assessmentId = fetchPresetDataSession?.assessmentData?.assessmentId;

	try {
		const btnText = $(`#printCaBtn_${classId}_${armId}`).html();
		$(`#printCaBtn_${classId}_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printCaBtn_${classId}_${armId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-ca-broad-sheet?branchId=${getEachBranchDetailsSession.branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printBroadSheetsession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-ca-broad-sheet`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printCaBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$(`#printCaBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printCaBtn_${classId}_${armId}`).prop("disabled", false);
	}
}