function _printTerminalBroadSheet(departmentId, classId, armId) {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

    const session = fetchPresetDataSession?.session;
    const termId = fetchPresetDataSession?.termData?.termId;
    try {

		const btnText = $(`#printTerminalBtn_${classId}_${armId}`).html();
		$(`#printTerminalBtn_${classId}_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printTerminalBtn_${classId}_${armId}`).prop("disabled", true);
        
        $.ajax({
            type: "GET",
            url: `${endPoint}/reports/print-terminal-broad-sheet?branchId=${getEachBranchDetailsSession.branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
            dataType: "json",
            cache: false,
            headers: getAuthHeaders(),

            success: function(info) {
                if (info.success > 0) {
                    sessionStorage.setItem("printTerminalBroadSheetsession", JSON.stringify(info));
                    window.open(`${websiteUrl}/reports/print-terminal-broad-sheet`, '_blank');
                } else {
                    _showCustomConfirm({
                        title: "Access Denied!",
                        message: info.message,
                        alertType: "error",
                        trueActionBtnText: "OK",
                        closeOnOverlayClick: true,
                    });
                    const response = info.response;
					if (response < 100) {
						_logOut();
					} 
                }
                $(`#printTerminalBtn_${classId}_${armId}`).html(btnText).prop("disabled", false);
            },

            error: function(xhr, textStatus, errorThrown) {
                clearInterval(progressInterval);
                console.error("AJAX Error: ", textStatus, errorThrown);
                _actionAlert("Check your internet connection and try again.", false);
            }
        });
    } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printTerminalBtn_${classId}_${armId}`).prop("disabled", false);
	}
}

