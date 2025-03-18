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



function copyAddress() {
    setTimeout(function () {
        let fValue = $('#faddress').val();
        $('#maddress').val(fValue);
    }, 0);
}




function _getSelectTitle(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/preset-data/fetch-title',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].titleId;
						const value = data[i].titleName;
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

function _getSelectClass(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/admin/settings/classes/fetch-class',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].classId;
						const value = data[i].className;
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

function _getSelectArm(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+'/admin/settings/arms/fetch-arm',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].armId;
						const value = data[i].armName;
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