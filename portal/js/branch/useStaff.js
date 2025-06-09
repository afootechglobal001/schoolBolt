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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
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
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const subjectName = fetchSubjectData.subjectName;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view">
									<h3>${className} (${subjectName})</h3>
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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
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
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const subjectName = fetchSubjectData.subjectName;
						const subjectId = fetchSubjectData.subjectId;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${className} (${subjectName})</h3>
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
														<button class="btn" title="PRINT SCORE SHEET" onclick="_printStudentScoreSheet('${departmentId}','${classId}','${armId}','${subjectId}');">
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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
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
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						// const departmentId = fetch[i].departmentId;
						// const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const subjectName = fetchSubjectData.subjectName;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${className} (${subjectName})</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
									<div class="list-back-div">`;
										
										if (Array.isArray(fetchArmData) && fetchArmData.length > 0) {
											for (let k = 0; k < fetchArmData.length; k++) {
												const armInfo = fetchArmData[k];
												// const armId = armInfo.armId;
												const armName = armInfo.armName;

												text += `
												<div class="list-div">
													<h4>${className} ${armName}</h4>
													<div class="btn-container">
														<button class="btn" title="MANAGE SCORES" onclick="_getForm({page: 'compute_score_reg', layer:2, url: adminPortalLocalUrl});">
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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
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
						const fetchClassData = fetch[i].classData;
						const fetchSubjectData = fetch[i].subjectData;
						const departmentId = fetch[i].departmentId;
						const classId = fetch[i].classId;
						const fetchArmData = fetchClassData.armData;
						const className = fetchClassData.className;
						const subjectName = fetchSubjectData.subjectName;

						text +=`
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teacher's students">
									<h3>${className} (${subjectName})</h3>
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
														<button class="btn" title="VIEW STUDENTS" onclick="_printStudents('${departmentId}','${classId}','${armId}');">
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
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}