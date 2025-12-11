function _printAssessmentPerSubject() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	let getComputeScoreRecordDetailsSession = JSON.parse(sessionStorage.getItem("getComputeScoreRecordDetailsSession"));

	const departmentId = getComputeScoreRecordDetailsSession?.departmentData?.departmentId;
	const classId = getComputeScoreRecordDetailsSession?.classData?.classId;
	const armId = getComputeScoreRecordDetailsSession?.armData?.armId;
	const subjectId = getComputeScoreRecordDetailsSession?.subjectData?.subjectId;
	try {
		let issueCount=0;
		const assessmentId = $('#assessmentId').val();

		$('#assessmentId').removeClass('issue');
		$('#issue_assessmentId').html('');

		if (!assessmentId) {
			$('#assessmentId').addClass('issue');
			$('#issue_assessmentId').html('USER ERROR! Kindy select assessment to continue');
			issueCount++;
		}

		if (issueCount>0){
			return;
		}

		const btn_text = $("#printBtn").html();
		$("#printBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printBtn").prop("disabled", true);
		
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/print-assessment-per-subject?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printAssessmentSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-assessment-per-subject`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printBtn").html(btn_text).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printBtn").html(btn_text).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printBtn").prop("disabled", false);
	}
}