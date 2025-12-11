function _printTeachersByClass() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		const btnText = $("#printTeachersByClassBtn").html();
		$("#printTeachersByClassBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#printTeachersByClassBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/department/fetch-branch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("printStaffByClassSession", JSON.stringify(info));
					window.open(`${websiteUrl}/reports/print-staff-by-class`, '_blank');
				} else {
					_actionAlert(info.message, false);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
				$("#printTeachersByClassBtn").html(btnText).prop("disabled", false);
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
				$("#printTeachersByClassBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
		$("#printTeachersByClassBtn").prop("disabled", false);
	}
}