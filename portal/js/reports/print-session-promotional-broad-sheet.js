///// Fetch Account Students By Class /////
function _printSessionPromotionalBroadSheet(session, departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession"),
	);

  	const branchId = getEachBranchDetailsSession?.branchId;

	try {
		const btnText = $(`#printPromotionalBtn_${classId}_${armId}`).html();
		$(`#printPromotionalBtn_${classId}_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printPromotionalBtn_${classId}_${armId}`).prop("disabled", true);

		//// call endpoint //////
		_callFetchEndPoints({
		url: `reports/print-session-promotional-broad-sheet?branchId=${branchId}&session=${session}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success > 0) {
				sessionStorage.setItem("printPromotionalBroadSheetSession", JSON.stringify(response));
				window.open(`${websiteUrl}/reports/print-session-promotional-broad-sheet`, '_blank');
			} else {
				_showCustomConfirm({
					title: "Unable to Proceed",
					message: response.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
			}
			$(`#printPromotionalBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() =>
			_printSessionPromotionalBroadSheet(session, departmentId, classId, armId),
			); // retry if needed
			$(`#printPromotionalBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callAjaxError(() =>
		_printSessionPromotionalBroadSheet(session, departmentId, classId, armId),
		); // retry if needed
		$(`#printPromotionalBtn_${classId}_${armId}`).prop("disabled", false);
	}
}