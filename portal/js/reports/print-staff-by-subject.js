function _printTeachersBySubject() {
	let fetchSubjectsParams = JSON.parse(sessionStorage.getItem("fetchSubjectsParams"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	try {
		const btnText = $("#printTeachersBySubjectBtn").html();
		$("#printTeachersBySubjectBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printTeachersBySubjectBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/subject/fetch-branch-class-subjects?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchSubjectsParams.departmentId}&classId=${fetchSubjectsParams.classId}&armId=${fetchSubjectsParams.armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStaffBySubjectSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-staff-by-subject`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printTeachersBySubjectBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printTeachersBySubjectBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printTeachersBySubjectBtn").prop("disabled", false);
	}
}