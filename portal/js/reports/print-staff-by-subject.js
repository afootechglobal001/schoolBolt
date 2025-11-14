function _printTeachersBySubject() {
	let fetchSubjectsParams = JSON.parse(sessionStorage.getItem("fetchSubjectsParams"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/subject/fetch-branch-class-subjects?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchSubjectsParams.departmentId}&classId=${fetchSubjectsParams.classId}&armId=${fetchSubjectsParams.armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStaffBySubjectSession", JSON.stringify(info));
					windowPop(`${websiteUrl}/reports/print-staff-by-subject`);
					_alertClose(2);
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
				_alertClose(2);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}