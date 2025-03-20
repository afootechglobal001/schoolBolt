function _getActiveStudentPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_student_details'
    } = props;
	_getStudentPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getStudentPagesActiveLink(divid){
	$('#student_profile_details, #student_activities').removeClass('active');
	$("#"+divid).addClass('active');
}

//////////////////////////// upload image from webcam//////////////////////////
Webcam.set({
    width: 270,
    height: 200,
    image_format: 'jpeg',
    jpeg_quality: 1000
});

function takeSnapShot(){
$('.webcam-div').fadeIn(500);
Webcam.attach( '#my_camera' );
}
function snapPicture() {
    Webcam.snap( function(data_uri) {
        $('#passport').val(data_uri);
        document.getElementById('cam-pix').innerHTML = '<img id="passport" src="'+data_uri+'"/>';
    $('.webcam-div').fadeOut(500);
    } );
     Webcam.reset();
}
//////////////////////////// end upload image from webcam//////////////////////////



function copyTextbox() {
    setTimeout(function () {
        let addressVal = $('#address').val();
        let surnameVal = $('#surName').val();

        $('#motherAddress, #fatherAddress').val(addressVal);
        $('#fatherSurName, #motherSurName').val(surnameVal);
    }, 0);
}

function _getSelectBranchState(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-states",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].stateId;
						const value = data[i].stateName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\'); _fetchBranchStateLga()">'+ value +'</li>');
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

function _fetchBranchStateLga(){
	_getSelectBranchLga('lgaId');
}
function _getSelectBranchLga(fieldId){
	const stateId = $('#stateId').val();
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-lga?stateId="+stateId,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;

				if (success === true) {
					$('#searchList_'+ fieldId).html('');
					for (let i = 0; i < data.length; i++) {
						const id = data[i].lgaId;
						const value = data[i].lgaName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
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

function _getSelectNationlaity(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/preset-data/fetch-country',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].countryId;
						const value = data[i].countryName;
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

function _getSelectAccomodation(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/preset-data/fetch-accommodation',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].accommodationId;
						const value = data[i].accommodationName;
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


function _getSelectDepartment(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/admin/settings/departments/fetch-department',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].departmentId;
						const value = data[i].departmentName;
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\'); _fetchSelectDepartmentClass();">'+ value +'</li>');
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

function _fetchSelectDepartmentClass(){
	_getSelectClass('classId');
}
function _getSelectClass(fieldId){
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

function _fetchSelectClassArm(){
	_getSelectArm('armId');
}
function _getSelectArm(fieldId){
	const classId = $('#classId').val();
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/admin/settings/classes/fetch-class-arms?classId='+ classId,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					$('#searchList_'+ fieldId).html('');
					const checkedArms = data.filter(item => item.checked === true);
					for (let i = 0; i < checkedArms.length; i++) {
						const id = checkedArms[i].armId;
						const value = checkedArms[i].armName;
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