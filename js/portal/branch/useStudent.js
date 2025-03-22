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
	$('#student_profile_details, #tanscript, #student_activities, #student_report').removeClass('active');
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

function formatDate(date) {
	if (!date) return ""; 
    const parts = date.split('-'); // Convert "1990-05-20" to ["1990", "05", "20"]
    return `${parts[2]}/${parts[1]}/${parts[0]}`; // Output: "20/05/1990"
}

function _createStudent(view) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    try {
		if (view=='mobile'){
			var passport ='mobile';
		}else{
			var passport =document.getElementById("passport").src;
		}

        const surName = $('#surName').val();
		const firstName = $('#firstName').val();
		const otherNames = $('#otherNames').val();
		const genderId = $('#genderId').val();
		const maritalStatusId = $('#maritalStatusId').val();
		const dateOfBirth = formatDate($('#dateOfBirth').val()); 
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
				success: function (info) {
					const data = info.data[0];
					const success = info.success;
					const message = info.message;

					if (success=== true) {
						const passportName = data.studentData[0].passport;

						if (passportName==='default.jpg'){
							_actionAlert(message, true);
							_getActiveBranchPage({divid:'branch_student_page', page: 'branch_student_page', url: adminPortalLocalUrl});	
							_alertClose(2);
						}else{
							_uploadStudentPicture(passportName, message);
						}
                    } else {
                        _actionAlert(message, false);
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


function _uploadStudentPicture(passportName, message) {
    const action = "upload_student_pix";

    const formData = new FormData();
	var passport =document.getElementById("passport").src;
    formData.append("action", action);
    formData.append("passport", passport);
	formData.append("passportName", passportName);

    $.ajax({
        url: adminPortalLocalUrl,
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (html) {
            _actionAlert(message, true);
			_getActiveBranchPage({divid:'branch_student_page', page: 'branch_student_page', url: adminPortalLocalUrl});	
            _alertClose(2);
        },
        error: function () {
            _actionAlert('Upload failed! Please try again.', false);
        }
    });
}


function _proceedFetchBranchStudents(){
	const departmentId = $('#departmentId').val();
	const classId = $('#classId').val();
	const armId = $('#armId').val();

	$('#departmentId, #classId, #armId').removeClass('issue');

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
	const fetchStudentsParams={
		departmentId: departmentId,
		classId: classId,
		armId: armId
	}

	sessionStorage.setItem("fetchStudentsParams", JSON.stringify(fetchStudentsParams));
	_getActiveBranchPage({divid:'branch_student_page', page: 'branch_student_page', url: adminPortalLocalUrl});
	_alertClose(2);
}

function _fetchBranchStudents() {
	let fetchStudentsParams = JSON.parse(sessionStorage.getItem("fetchStudentsParams"));
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
     $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/students/fetch-student?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchStudentsParams.departmentId}&classId=${fetchStudentsParams.classId}&armId=${fetchStudentsParams.armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;
				
				let text = '';
				let no=0;
				text =`
					<thead>
						<tr class="tb-col">
							<th>sn</th>
							<th>Student ID</th>
							<th>Passport</th>
							<th>Full Name</th>
							<th>Gender</th>
							<th>Age</th>
							<th>Department</th>
							<th>Class</th>
							<th>Arm</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

				if (success=== true) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const branchId = fetch[i].branchId;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const armId = fetch[i].armId;

						const fetchStudentData = fetch[i].studentData?.[0];
						const fetchDepartmentData=fetch[i].departmentData?.[0]; 
						const fetchClassData=fetch[i].classData?.[0]; 
						const fetchArmData=fetch[i].armData?.[0]; 
						
						const studentId = fetchStudentData.studentId;
						const passport = fetchStudentData.passport || 'default.jpg';
						const surName = fetchStudentData.surName;
						const firstName = fetchStudentData.firstName;
						const otherNames = fetchStudentData.otherNames;
						const fullname = surName+ ' ' +firstName+ ' ' +otherNames;
						const genderName = fetchStudentData.genderName;
						const departmentName = fetchDepartmentData.departmentName;
						const className = fetchClassData.className;
						const armName = fetchArmData.armName;
						const statusName = fetchStudentData.statusName;
						const age = new Date().getFullYear() - new Date(fetchStudentData.dateOfBirth).getFullYear();

						text +=`
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view student profile" onclick="_fetchEachBranchStudents();">
										<div class="text-back-div">
											<div class="text-div">
												<div class="first-class">${studentId}</div>
											</div>
										</div>
									</td>
									<td>
										<div class="text-back-div">
											<div class="image-div student-passport">
												<img src="${studentPixPath}/${passport}" alt="${fullname}"/>
											</div>
										</div>
									</td>
									<td>${fullname}</td>
									<td>${genderName}</td>
									<td>${age}</td>
									<td>${departmentName}</td>
									<td>${className}</td>
									<td>${armName}</td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
									<td><button class="btn view-btn" title="Click to view student profile" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}');">VIEW</button></td>
								</tr>
							</tbody>`;
					}
					$('#pageContent').html(text);
				} else {
					_actionAlert(info.message, false);

					text += `
						tbody>
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
									</div>
								</td>
							</tr>
						</tbody>`;
					$('#pageContent').html(text);
						
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchEachBranchStudents(branchId, departmentId, classId, armId, studentId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/students/fetch-student?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachBranchStudentsSession", JSON.stringify(info.data[0]));
					_getForm({page: 'student_profile', layer:2, url: adminPortalLocalUrl});
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}


function _updateBranchStudents() {
	let getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
    try {

        const surName = $('#surName').val();
		const firstName = $('#firstName').val();
		const otherNames = $('#otherNames').val();
		const genderId = $('#genderId').val();
		const maritalStatusId = $('#maritalStatusId').val();
		const dateOfBirth = formatDate($('#dateOfBirth').val()); 
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
            const btn_text = $("#updateBtn").html();
            $("#updateBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
            $("#updateBtn").prop("disabled", true);

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

            $.ajax({
                type: "POST",
				url: `${endPoint}/admin/students/update-student?branchId=${getEachBranchStudentsSession.branchId}&studentId=${getEachBranchStudentsSession.studentId}`,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (info) {
					const data = info.data[0];
					const success = info.success;
					const message = info.message;

					if (success=== true) {
						_actionAlert(message, true);
						_getActiveBranchPage({divid:'branch_student_page', page: 'branch_student_page', url: adminPortalLocalUrl});	
						_alertClose(2);
                    } else {
                        _actionAlert(message, false);
                    }
                    $("#updateBtn").html(btn_text).prop("disabled", false);
                },
                error: function () {
                    _actionAlert('An error occurred while processing your request! Please Try Again', false);
                    $("#updateBtn").html(btn_text).prop("disabled", false);
                }
            });
        }
    } catch (error) {
        _actionAlert('An unexpected error occurred! Please Try Again', false);
        $("#updateBtn").prop("disabled", false);
    }
}
