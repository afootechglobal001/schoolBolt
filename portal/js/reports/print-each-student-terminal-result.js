function printEachStudentTerminalResult(branchId, session, termId, departmentId, classId, armId, studentId) {
	try {
		const btnText = $(`#printEachAssBtn_${studentId}`).html();
		$(`#printEachAssBtn_${studentId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#printEachAssBtn_${studentId}`).prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-each-student-terminal-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printEachStudentTerminalResultSession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-each-student-terminal-result`);
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$(`#printEachAssBtn_${studentId}`).html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
				$(`#printEachAssBtn_${studentId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$(`#printEachAssBtn_${studentId}`).prop("disabled", false);
	}
}