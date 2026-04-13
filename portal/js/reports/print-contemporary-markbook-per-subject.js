function _printContemporaryMarkBookPerSubject(departmentId, classId, armId, subjectId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));

	$("#get-more-div-secondary")
        .css({
            display: "flex",
            justifyContent: "center",
            alignItems: "center",
			flexDirection: "column",
        })
	.append(`
		<div>
			<div class="alert alert-success" style="text-align: center;">
				<span>COMPILING CONTEMPORARY MARK BOOK DATA...</span><br>
				<p>Please DO NOT close this panel as the process may take up to a minute.</p>
			</div>
		</div>
	`)
	.fadeIn(500);

	try {
		const btnText = $("#printBtn").html();
		$("#printBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-contemporary-mark-book-per-subject?branchId=${getEachStaffDetailsSession?.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printContemporaryMarkBookSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-contemporary-mark-book-per-subject`, '_blank')
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				_alertClose(2);
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
				$("#printBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printBtn").prop("disabled", false);
	}
}