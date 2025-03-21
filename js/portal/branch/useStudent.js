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



function _createStudent() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    try {
        const surName = $('#surName').val();
		const firstName = $('#firstName').val();
		const otherNames = $('#otherNames').val();
		const genderId = $('#genderId').val();
		const maritalStatusId = $('#maritalStatusId').val();
		const dateOfBirth = $('#dateOfBirth').val();
		const countryId = $('#countryId').val();
		const stateId = $('#stateId').val();
		const lgaId = $('#lgaId').val();
		const address = $('#address').val();
		const email = $('#email').val();
		const mobileNumber = $('#mobileNumber').val();
		const fatherTitleId = $('#fatherTitleId').val();
		const fatherSurName = $('#fatherSurName').val();
        const fatherOtherNames = $('#fatherOtherNames').val();
		const fatherEmail = $('#fatherEmail').val();
		const fatherMobileNumber = $('#fatherMobileNumber').val();
		const fatherDayOfBirth = $('#fatherDayOfBirth').val();
		const fatherMonthOfBirth = $('#fatherMonthOfBirth').val();
		const fatherOccupation = $('#fatherOccupation').val();
		const motherTitleId = $('#motherTitleId').val();
		const motherSurName = $('#motherSurName').val();
		const motherOtherNames = $('#motherOtherNames').val();
		const motherAddress = $('#motherAddress').val();
		const motherEmail = $('#motherEmail').val();
		const motherMobileNumber = $('#motherMobileNumber').val();
		const motherDayOfBirth = $('#motherDayOfBirth').val();
		const motherMonthOfBirth = $('#motherMonthOfBirth').val();
		const officialStudentId = $('#officialStudentId').val();
		const departmentId = $('#departmentId').val();
        const classId = $('#classId').val();
		const armId = $('#armId').val();
		const accommodationId = $('#accommodationId').val();
		const statusId = $('#statusId').val();
		const pasport =document.getElementById("passport").src;

		$('#surName, #firstName, #genderId, #maritalStatusId, #dateOfBirth, #countryId, #stateId, #lgaId, #address, #email, #mobileNumber, #fatherEmail, #motherEmail, #departmentId, #classId, #armId, #accommodationId, #statusId').removeClass('issue');

        if (!surName) {
			$('#surName').addClass('issue');
			_actionAlert('Provide surname to continue', false);
			return;
		}
		
		if (!firstName) {
			$('#firstName').addClass("issue");
			_actionAlert('Provide first name to continue', false);
			return;
		}
	
		if (!genderId) {
			$('#genderId').addClass("issue");
			_actionAlert('Select gender to continue', false);
			return;
		}
		
		if (!maritalStatusId) {
			$('#maritalStatusId').addClass("issue");
			_actionAlert('Select marital status to continue', false);
			return;
		}
		
		if (!dateOfBirth) {
			$('#dateOfBirth').addClass("issue");
			_actionAlert('Provide date of birth to continue', false);
			return;
		}
		
		if (!countryId) {
			$('#countryId').addClass("issue");
			_actionAlert('Select country to continue', false);
			return;
		}
		
		if (!stateId) {
			$('#stateId').addClass("issue");
			_actionAlert('Select state to continue', false);
			return;
		}
		
		if (!lgaId) {
			$('#lgaId').addClass("issue");
			_actionAlert('Select LGA to continue', false);
			return;
		}
		
		if (!address) {
			$('#address').addClass("issue");
			_actionAlert('Provide address to continue', false);
			return;
		}

		if (email && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
			$('#email').addClass("issue");
			_actionAlert('Provide correct email to continue', false);
			return;
		}
		
		if (fatherEmail && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(fatherEmail)) {
			$('#fatherEmail').addClass("issue");
			_actionAlert('Provide father\'s correct email to continue', false);
			return;
		}
		
		if (motherEmail && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(motherEmail)) {
			$('#motherEmail').addClass("issue");
			_actionAlert('Provide mother\'s correct email to continue', false);
			return;
		}		
		
		if (!departmentId) {
			$('#departmentId').addClass("issue");
			_actionAlert('Select department to continue', false);
			return;
		}
		
		if (!classId) {
			$('#classId').addClass("issue");
			_actionAlert('Select class to continue', false);
			return;
		}
		
		if (!armId) {
			$('#armId').addClass("issue");
			_actionAlert('Select arm to continue', false);
			return;
		}
		
		if (!accommodationId) {
			$('#accommodationId').addClass("issue");
			_actionAlert('Select accommodation status to continue', false);
			return;
		}
		
		if (!statusId) {
			$('#statusId').addClass("issue");
			_actionAlert('Select status to continue', false);
			return;
		}

        if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
            const btn_text = $("#submitBtn").html();
            $("#submitBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
            $("#submitBtn").prop("disabled", true);

			const formData = new FormData();
			formData.append("surName", surName);
			formData.append("firstName", firstName);
			formData.append("otherNames", otherNames);
			formData.append("genderId", genderId);
			formData.append("maritalStatusId", maritalStatusId);
			formData.append("dateOfBirth", dateOfBirth);
			formData.append("countryId", countryId);
			formData.append("stateId", stateId);
			formData.append("lgaId", lgaId);
			formData.append("address", address);
			formData.append("email", email);
			formData.append("mobileNumber", mobileNumber);
			formData.append("fatherTitleId", fatherTitleId);
			formData.append("fatherSurName", fatherSurName);
			formData.append("fatherOtherNames", fatherOtherNames);
			formData.append("fatherEmail", fatherEmail);
			formData.append("fatherMobileNumber", fatherMobileNumber);
			formData.append("fatherDayOfBirth", fatherDayOfBirth);	
			formData.append("fatherMonthOfBirth", fatherMonthOfBirth);
			formData.append("fatherOccupation", fatherOccupation);
			formData.append("motherTitleId", motherTitleId);
			formData.append("motherSurName", motherSurName);
			formData.append("motherOtherNames", motherOtherNames);
			formData.append("motherAddress", motherAddress);
			formData.append("motherEmail", motherEmail);
			formData.append("motherMobileNumber", motherMobileNumber);
			formData.append("motherDayOfBirth", motherDayOfBirth);	
			formData.append("motherMonthOfBirth", motherMonthOfBirth);
			formData.append("officialStudentId", officialStudentId);
			formData.append("departmentId", departmentId);
			formData.append("classId", classId);
			formData.append("armId", armId);
			formData.append("accommodationId", accommodationId);
			formData.append("statusId", statusId);
			formData.append("passport", passport);

            $.ajax({
                type: "POST",
				url: `${endPoint}/admin/students/create-student?branchId=${getEachBranchDetailsSession.branchId}`,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (data) {
					const success = data.success;
					const message = data.message;

					if (success=== true) {
						const newProductPixNames = data.newProductPixNames;
						const oldProductPixNames = data.oldProductPixNames;

						_uploadStudentPicture(oldProductPixNames, newProductPixNames, message);
                    } else {
                        _actionAlert(data.message, false);
                    }
                    $("#submitBtn").html(btn_text).prop("disabled", false);
                },
                error: function () {
                    _actionAlert('An error occurred while processing your request! Please Try Again', false);
                    $("#submitBtn").html(btn_text).prop("disabled", false);
                }
            });
        }
    } catch (error) {
        _actionAlert('An unexpected error occurred! Please Try Again', false);
        $("#submitBtn").prop("disabled", false);
    }
}


function _uploadStudentPicture(oldProductPixNames, newProductPixNames, message) {
    const action = "upload_product_cat_pix";

    const formData = new FormData();
	const totalFiles = $('#productPix').get(0).files.length;
    formData.append("action", action);
    formData.append("oldProductPixNames", oldProductPixNames);
	formData.append("newProductPixNames", newProductPixNames);

	for(let i = 0; i < totalFiles; i++){
		formData.append("productPix[]", $("#productPix").get(0).files[i]);
	}

    $.ajax({
        url: adminPortalLocalUrl,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (html) {
            _actionAlert(message, true);
            _alertClose();
            _getPage({ page: 'product_category', url: adminPortalLocalUrl });
        },
        error: function () {
            _actionAlert('Upload failed! Please try again.', false);
        }
    });
}