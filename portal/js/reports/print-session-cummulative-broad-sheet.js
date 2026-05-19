///// Fetch Account Students By Class /////
function _printSessionCumulativeBroadSheet(session, departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession"),
	);

  	const branchId = getEachBranchDetailsSession?.branchId;

	try {
		const btnText = $(`#printCumulativeBtn_${classId}_${armId}`).html();
		$(`#printCumulativeBtn_${classId}_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printCumulativeBtn_${classId}_${armId}`).prop("disabled", true);

		//// call endpoint //////
		_callFetchEndPoints({
		url: `reports/print-session-cummulative-broad-sheet?branchId=${branchId}&session=${session}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success > 0) {
				sessionStorage.setItem("printSessionCumulativeBroadSheetSession", JSON.stringify(response));
				window.open(`${websiteUrl}/reports/print-session-cummulative-broad-sheet`, '_blank');
			} else {
				_actionAlert(response.message, false);
				_showCustomConfirm({
					title: "Unable to Proceed",
					message: response.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
			}
			$(`#printCumulativeBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() =>
			_printSessionCumulativeBroadSheet(session, departmentId, classId, armId),
			); // retry if needed
			$(`#printCumulativeBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callAjaxError(() =>
		_printSessionCumulativeBroadSheet(session, departmentId, classId, armId),
		); // retry if needed
		$(`#printCumulativeBtn_${classId}_${armId}`).prop("disabled", false);
	}
}