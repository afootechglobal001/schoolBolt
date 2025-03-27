function _getSelectSubjectDepartment(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
					const data = info.data;
					const success = info.success;

				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						if (data[i].checked) {
							const id = data[i].departmentId;
							const value = data[i].departmentName;
							$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\'); _fetchSelectSujectDepartmentClass();">'+ value +'</li>');
						}
					}
				} else {
					_actionAlert(info.message, false); 
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}


function _fetchSelectSujectDepartmentClass(){
	_getSelectSubjectClass('classId');
}

function _getSelectSubjectClass(fieldId){
	const departmentId = $('#departmentId').val();
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/admin/settings/departments/fetch-department-classes?departmentId='+ departmentId,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;

				if (success === true) {
					$('#searchList_'+ fieldId).html('');
					const checkedClasses = data.filter(item => item.checked === true);
					for (let i = 0; i < checkedClasses.length; i++) {
						const id = checkedClasses[i].classId;
						const value = checkedClasses[i].className;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\'); _fetchSelectClassArm();">'+ value +'</li>');
					}
				} else {
					_actionAlert(info.message, false); 
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}