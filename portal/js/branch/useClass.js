function _getSelectClassTeachers(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/admin/staff/fetch-staff?statusId=1",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const teacherFirstName = data[i].firstName
						const teacherLastName = data[i].lastName
						const id = data[i].staffId;
						const value = teacherFirstName + ' ' + teacherLastName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
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