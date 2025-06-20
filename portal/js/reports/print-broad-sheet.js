function _printBroadSheet(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const session = fetchPresetDataSession?.session;
	const termId = fetchPresetDataSession?.termData?.termId;
	const assessmentId = fetchPresetDataSession?.assessmentData?.assessmentId;
	
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-broad-sheet?branchId=${getEachBranchDetailsSession.branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printAssessmentSession", JSON.stringify(info));
					sessionStorage.setItem("printBroadSheetsession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/broad-sheet`);
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}