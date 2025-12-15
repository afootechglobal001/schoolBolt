function _fetchBranchStaffs() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				let no=0;

				text =`
				<thead>
                    <tr class="tb-col">
                       	<th>sn</th>
                        <th>User Name</th>
                        <th>Contact</th>
                        <th>Staff Branch</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th>Status</th>
						<th>View</th>
                    </tr>
                </thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const staffId = fetch[i].staffId;
						const firstName = fetch[i].firstName;
						const lastName = fetch[i].lastName;
						const titleName = fetch[i].titleName;
						const staffNames = titleName + ' ' + firstName + ' ' + lastName;
						const emailAddress = fetch[i].emailAddress;
						const mobileNumber = fetch[i].mobileNumber;
						const branchName = fetch[i].branchName;
						const roleName = fetch[i].roleName;
						const lastLoginTime = fetch[i].lastLoginTime;
						const statusName = fetch[i].statusName;
						const profilePix = fetch[i].profilePix;

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td class="clickable-td" title="Click to view staff profile" onclick="_fetchEachBranchSaff('${staffId}');">
									<div class="text-back-div">
										<div class="image-div">
											<img src="${websiteUrl}/uploaded_files/staffPix/${profilePix}" alt="${staffNames}"/>
										</div>

										<div class="text-div">
											<div class="first-class">${staffNames}</div>
											<div class="second-class">${staffId}</div>
										</div>
									</div>
								</td>
								<td>
									<div class="text-div">
										<div>${emailAddress}</div> 
										<div>${mobileNumber}</div>
									</div>
								</td>
								<td>${branchName}</td>
								<td>${roleName}</td>
								<td>${lastLoginTime ? lastLoginTime : "00-00-00 00:00:00"}</td>
								<td><div class="status-div ${statusName}">${statusName}</div></td>
								<td><button class="btn view-btn" title="Click to view staff profile" onclick="_fetchEachBranchSaff('${staffId}');">VIEW</button></td>
							</tr>
						</tbody>`;
					}
					$('#pageContent').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
						<div class="false-notification-div">
							<p>${info.message}</p>
							<div>
								<button class="btn" onclick="_getForm({page: 'staff_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW STAFF</button>
							</div>
						</div>`;

						$('#pageContent').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchEachBranchSaff(staffId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff?staffId=${staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachStaffDetailsSession", JSON.stringify(info.data[0]));
					_getForm({page: 'staff_profile', layer: 2,  url: adminPortalLocalUrl});
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchStaffSubjectAllocated() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#pageContents').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff-subjects-allocated?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				let no=0;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchDepartmentData = fetch[i].departmentData;
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const departmentName = fetchDepartmentData.departmentName;
						const subjectName = fetchSubjectData.subjectName;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view">
									<h3>${departmentName} - ${className} (${subjectName})</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
									<div class="list-back-div">`;
										
										if (Array.isArray(fetchArmData) && fetchArmData.length > 0) {
											for (let k = 0; k < fetchArmData.length; k++) {
												const armInfo = fetchArmData[k];
												const armId = armInfo.armId;
												const armName = armInfo.armName;

												text += `
												<div class="list-div">
													<h4>${className} ${armName}</h4>
													<div class="btn-container">
														<button class="btn" title="VIEW STUDENTS" onclick="_printAllocatedStudents('${departmentId}','${classId}','${armId}');">
															<i class="bi-eye"></i> VIEW STUDENTS
														</button>
													</div>
												</div>`;
											}
										}
										text +=`
									</div>
								</div>
							</div>
						`;
					}
					$('#pageContents').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#pageContents').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchStaffSubjectScoreSheet() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#pageContent2').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff-subjects-allocated?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				let no=0;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchDepartmentData = fetch[i].departmentData;
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const departmentName = fetchDepartmentData.departmentName;
						const subjectName = fetchSubjectData.subjectName;
						const subjectId = fetchSubjectData.subjectId;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${departmentName} - ${className} (${subjectName})</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
									<div class="list-back-div">`;
										
										if (Array.isArray(fetchArmData) && fetchArmData.length > 0) {
											for (let k = 0; k < fetchArmData.length; k++) {
												const armInfo = fetchArmData[k];
												const armId = armInfo.armId;
												const armName = armInfo.armName;

												text += `
												<div class="list-div">
													<h4>${className} ${armName}</h4>
													<div class="btn-container">
														<button class="btn" title="PRINT SCORE SHEET" id="printScoreSheetBtn_${subjectId}" onclick="_printScoreSheet('${departmentId}','${classId}','${armId}','${subjectId}');">
															<i class="bi-printer"></i> PRINT SCORE SHEET
														</button>
													</div>
												</div>`;
											}
										}
										text +=`
									</div>
								</div>
							</div>
						`;
					}
					$('#pageContent2').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#pageContent2').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchStaffSubjectComputeScores() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#pageContent3').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff-subjects-allocated?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				let no=0;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchDepartmentData = fetch[i].departmentData;
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const departmentName = fetchDepartmentData.departmentName;
						const subjectName = fetchSubjectData.subjectName;
						const subjectId = fetchSubjectData.subjectId;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${departmentName} - ${className} (${subjectName})</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
									<div class="list-back-div">`;
										
										if (Array.isArray(fetchArmData) && fetchArmData.length > 0) {
											for (let k = 0; k < fetchArmData.length; k++) {
												const armInfo = fetchArmData[k];
												const armId = armInfo.armId;
												const armName = armInfo.armName;

												text += `
												<div class="list-div">
													<h4>${className} ${armName}</h4>
													<div class="btn-container">
														<button class="btn" title="MANAGE SCORES" onclick="_fetchComputeScoreRecordDetails('${departmentId}','${classId}','${armId}','${subjectId}');">
															<i class="bi-eye"></i> MANAGE SCORES
														</button>
													</div>
												</div>`;
											}
										}
										text +=`
									</div>
								</div>
							</div>
						`;
					}
					$('#pageContent3').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#pageContent3').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchStaffSubjectCummulative() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#pageContent4').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff-subjects-allocated?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				let no=0;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchDepartmentData = fetch[i].departmentData;
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const departmentName = fetchDepartmentData.departmentName;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const subjectName = fetchSubjectData.subjectName;
						const subjectId = fetchSubjectData.subjectId;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${departmentName} - ${className} (${subjectName})</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
									<div class="list-back-div">`;
										
										if (Array.isArray(fetchArmData) && fetchArmData.length > 0) {
											for (let k = 0; k < fetchArmData.length; k++) {
												const armInfo = fetchArmData[k];
												const armId = armInfo.armId;
												const armName = armInfo.armName;

												text += `
												<div class="list-div">
													<h4>${className} ${armName}</h4>
													<div class="btn-container">
														<button class="btn" title="PRINT" id="printMarkBookBtn_${classId}_${armId}_${subjectId}" onclick="_printContemporaryMarkBookPerSubject('${departmentId}','${classId}','${armId}','${subjectId}');">
															<i class="bi-printer"></i> PRINT
														</button>
													</div>
												</div>`;
											}
										}
										text +=`
									</div>
								</div>
							</div>
						`;
					}
					$('#pageContent4').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#pageContent4').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchComputeScoreRecordDetails(departmentId, classId, armId, subjectId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/preset-data/fetch-record-details?departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info) {
					sessionStorage.setItem("getComputeScoreRecordDetailsSession", JSON.stringify(info));
					_getForm({page: 'compute_score_proceed', layer: 2, url: adminPortalLocalUrl});
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _getSelectAssessment(fieldId){
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment?branchId=${getEachStaffDetailsSession.branchId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].assessmentId;
						const value = data[i].assessmentName;
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

function _proceedComputeAssessment() {
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

		const btn_text = $("#submitBtn").html();
		$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#submitBtn").prop("disabled", true);

		$.ajax({
			type: "POST",
			url: `${endPoint}/admin/staff/records/proceed-compute-assessment?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&subjectId=${subjectId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			processData: false,
			success: function (info) {
			if (info.success) {
				sessionStorage.setItem("getComputeScoreStudentDataSession", JSON.stringify(info));
				_getForm({page: 'compute_score_save', layer: 2, url: adminPortalLocalUrl});
			} else{
				const response = info.response;
				if (response < 100) {
					_logOut();
				}
				_showCustomConfirm({
					title: "Access Denied!",
					message: info.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
			}
			$("#submitBtn").html(btn_text).prop("disabled", false);
		},
			error: function (error) {
				_actionAlert('An error occurred while processing your request! Please Try Again', false);
				$("#submitBtn").html(btn_text).prop("disabled", false);
			}
		});
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$("#submitBtn").prop("disabled", false);
	}
}

function _saveAssessment() {
	let getComputeScoreStudentDataSession = JSON.parse(sessionStorage.getItem("getComputeScoreStudentDataSession"));
	try {
		let issueCount = 0;
		const assessments = [];

		const maxScore = parseFloat(getComputeScoreStudentDataSession.assessmentTotalScore || 0);
	
		$('.student-id-holder').each(function () {
			const studentId = $(this).val();
			const inputSelector = `#score_${studentId}`;
			const errorSelector = `#issue_score_${studentId}`;
			const score = $(inputSelector).val();

			$(inputSelector).removeClass('issue');
			$(errorSelector).html('');

			const parsedScore = parseFloat(score);
			if (parsedScore < 0 || parsedScore > maxScore) {
				$(inputSelector).addClass('issue');
				$(errorSelector).html(`USER ERROR! Score must be between 0 and ${maxScore}`);
				issueCount++;
			} else {
				assessments.push({
					studentId: studentId,
					score: parsedScore
				});
			}
			
		});

		if (issueCount>0){
			return;
		}

		if (confirm("Confirm!!\n\nAre you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"assessments": assessments,
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/staff/records/save-assessments?recordId=${getComputeScoreStudentDataSession.recordId}`,
				data: JSON.stringify(formData),
				dataType: "json",
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (info) {
					if (info.success) {
						_actionAlert(info.message, true);
						_alertClose(2);
						_getForm({page: 'compute_score_proceed', layer: 2, url: adminPortalLocalUrl});
					} else {
						_actionAlert(info.message, false);
					}
					$("#submitBtn").html(btn_text).prop("disabled", false);
				},
				error: function (error) {
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

/// Staff Student Attendance Functions //////////////////////////////////
function _fetchStaffAssignedClasses() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#classPageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/records/get-class-teacher-assigned-classes?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						const fetchClassData = fetch[i].classData;
						const fetchArmData = fetch[i].armData;
						const fetchDepartmentData = fetch[i].departmentData;
						const classId = fetchClassData.classId;
						const className = fetchClassData.className;
						const armName = fetchArmData.armName;
						const armId = fetchArmData.armId;
						const departmentId = fetchDepartmentData.departmentId

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title">
									<h3>${className} ${armName}</h3>
									<div class="btn-back-div">
										<button class="btn compute-btn" id="proceedBtn_${armId}" title="COMPUTE STUDENT ATTENDANCE" onclick="_proceedComputeAttendance('${departmentId}','${classId}','${armId}');"><i class="bi-check-all"></i> COMPUTE ATTENDANCE</button>
									</div> 
								</div>
							</div>
						`;
					}
					$('#classPageContent').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#classPageContent').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _proceedComputeAttendance(departmentId, classId, armId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));

	try {
		const btnText = $(`#proceedBtn_${armId}`).html();
		$(`#proceedBtn_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#proceedBtn_${armId}`).prop("disabled", true);

		$.ajax({
			type: "POST",
			url: `${endPoint}/admin/staff/records/proceed-compute-attendance?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			processData: false,
			success: function (info) {
			if (info.success) {
				sessionStorage.setItem("getStudentAttendanceDataSession", JSON.stringify(info));
				_getForm({page: 'computeAttendanceSave', layer: 2, url: adminPortalLocalUrl});
			} else{
				const response = info.response;
				if (response < 100) {
					_logOut();
				} 
			}
			$(`#proceedBtn_${armId}`).html(btnText).prop("disabled", false);
		},
			error: function (error) {
				_actionAlert('An error occurred while processing your request! Please Try Again', false);
				$(`#proceedBtn_${armId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$(`#proceedBtn_${armId}`).prop("disabled", false);
	}
}

function _saveAttendance() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	let getStudentAttendanceDataSession = JSON.parse(sessionStorage.getItem("getStudentAttendanceDataSession"));
	
	const departmentId = getStudentAttendanceDataSession?.data[0]?.departmentData?.departmentId;
	const classId = getStudentAttendanceDataSession?.data[0]?.classData?.classId;
	const armId = getStudentAttendanceDataSession?.data[0]?.armData?.armId;

	try {
		let issueCount = 0;
		const attendance = [];

		const maxScore = parseFloat(getStudentAttendanceDataSession?.branchData?.timeSchoolOpened || 0);
	
		$('.student-id-holder').each(function () {
			const studentId = $(this).val();
			const inputSelector = `#numberOfDaysPresents_${studentId}`;
			const errorSelector = `#issue_numberOfDaysPresents_${studentId}`;
			const numberOfDaysPresents = $(inputSelector).val();

			$(inputSelector).removeClass('issue');
			$(errorSelector).html('');

			const parsedScore = parseFloat(numberOfDaysPresents);

			if (numberOfDaysPresents === "" || isNaN(parsedScore)) {
				$(inputSelector).addClass('issue');
				$(errorSelector).html(`Attendance is required (0 - ${maxScore})`);
				issueCount++;
			} else if (parsedScore < 0 || parsedScore > maxScore) {
				$(inputSelector).addClass('issue');
				$(errorSelector).html(`USER ERROR! Score must be between 0 and ${maxScore}`);
				issueCount++;
			} else {
				attendance.push({
					studentId: studentId,
					numberOfDaysPresents: parsedScore
				});
			}
		});

		if (issueCount>0){
			return;
		}

		if (confirm("Confirm!!\n\nAre you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				attendance: attendance,
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/staff/records/save-attendance?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
				data: JSON.stringify(formData),
				dataType: "json",
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (info) {
					if (info.success) {
						_actionAlert(info.message, true);
						_proceedComputeAttendance(departmentId, classId, armId)
					} else {
						_actionAlert(info.message, false);
					}
					$("#submitBtn").html(btn_text).prop("disabled", false);
				},
				error: function (error) {
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

/// Class Teacher Comment Functions ///////////////////////////////////////////////////////////////////////////////////////////////////////////
function _fetchClassTeacherAssignedClasses() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    $('#classPageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/records/get-class-teacher-assigned-classes?branchId=${getEachStaffDetailsSession.branchId}&staffId=${getEachStaffDetailsSession.staffId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						const fetchClassData = fetch[i].classData;
						const fetchArmData = fetch[i].armData;
						const fetchDepartmentData = fetch[i].departmentData;
						const classId = fetchClassData.classId;
						const className = fetchClassData.className;
						const armName = fetchArmData.armName;
						const armId = fetchArmData.armId;
						const departmentId = fetchDepartmentData.departmentId

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title">
									<h3>${className} ${armName}</h3>
									<div class="btn-back-div">
										<button class="btn compute-btn" id="proceedBtn_${armId}" title="COMPUTE CLASS TEACHER COMMENT" onclick="_proceedComputeClassTeacherComment('${departmentId}','${classId}','${armId}');"><i class="bi-check-all"></i> COMPUTE CLASS TEACHER'S COMMENT</button>
									</div> 
								</div>
							</div>
						`;
					}
					$('#classPageContent').html(text);
				} else {
					_actionAlert(info.message, false);

					text +=`
					<div class="false-notification-div">
						<p>${info.message}</p>
					</div>`;

					$('#classPageContent').html(text);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _proceedComputeClassTeacherComment(departmentId, classId, armId) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));

	try {
		const btnText = $(`#proceedBtn_${armId}`).html();
		$(`#proceedBtn_${armId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$(`#proceedBtn_${armId}`).prop("disabled", true);

		$.ajax({
			type: "POST",
			url: `${endPoint}/admin/staff/records/proceed-compute-class-teachers-comments?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			processData: false,
			success: function (info) {
			if (info.success) {
				sessionStorage.setItem("getClassTeacherCommentDataSession", JSON.stringify(info));
				_getForm({page: 'computeClassTeacherCommentSave', layer: 2, url: adminPortalLocalUrl});
			} else{
				const response = info.response;
				if (response < 100) {
					_logOut();
				} 
			}
			$(`#proceedBtn_${armId}`).html(btnText).prop("disabled", false);
		},
			error: function (error) {
				_actionAlert('An error occurred while processing your request! Please Try Again', false);
				$(`#proceedBtn_${armId}`).html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$(`#proceedBtn_${armId}`).prop("disabled", false);
	}
}


function _saveClassTeachersComment() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	let getClassTeacherCommentDataSession = JSON.parse(sessionStorage.getItem("getClassTeacherCommentDataSession"));

	const departmentId = getClassTeacherCommentDataSession?.data[0]?.departmentData?.departmentId;
	const classId = getClassTeacherCommentDataSession?.data[0]?.classData?.classId;
	const armId = getClassTeacherCommentDataSession?.data[0]?.armData?.armId;

	try {
		let issueCount = 0;
		const allComments = [];
	
		$('.student-id-holder').each(function () {
			const studentId = $(this).val();
			const inputSelector = `#classTeachersComment_${studentId}`;
			const errorSelector = `#issue_classTeachersComment_${studentId}`;
			const classTeachersComment = $(inputSelector).val();

			$(inputSelector).removeClass('issue');
			$(errorSelector).html('');

			if (classTeachersComment === "" || null) {
				$(inputSelector).addClass('issue');
				$(errorSelector).html(`Class teacher's comment is required`);
				issueCount++;
			} else {
				allComments.push({
					studentId: studentId,
					classTeachersComment: classTeachersComment
				});
			}
		});

		if (issueCount>0){
			return;
		}

		if (confirm("Confirm!!\n\nAre you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				allComments: allComments,
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/staff/records/save-class-teachers-comments?branchId=${getEachStaffDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
				data: JSON.stringify(formData),
				dataType: "json",
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (info) {
					if (info.success) {
						_actionAlert(info.message, true);
						_proceedComputeClassTeacherComment(departmentId, classId, armId)
					} else {
						_actionAlert(info.message, false);
					}
					$("#submitBtn").html(btn_text).prop("disabled", false);
				},
				error: function (error) {
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