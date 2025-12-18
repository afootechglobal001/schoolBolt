////// Proceed Fetch Branch Parents /////
function _proceedFetchBranchParents() {
	const departmentId = $("#departmentId").val();
	const classId = $("#classId").val();
	const armId = $("#armId").val();

	$("#departmentId, #classId, #armId").removeClass("issue");

	if (!departmentId) {
		$("#departmentId").addClass("issue");
		_actionAlert("Select department to continue", false);
		return;
	}

	if (!classId) {
		$("#classId").addClass("issue");
		_actionAlert("Select class to continue", false);
		return;
	}

	if (!armId) {
		$("#armId").addClass("issue");
		_actionAlert("Select arm to continue", false);
		return;
	}
	const fetchParentsParams = {
		departmentId: departmentId,
		classId: classId,
		armId: armId,
	};

	sessionStorage.setItem(
		"fetchParentsParams",
		JSON.stringify(fetchParentsParams)
	);
	_getActiveBranchPage({
		divid: "branch_parent_page",
		page: "branch_parent_page",
		url: adminPortalLocalUrl,
	});
	_alertClose(2);
}

///// Fetch Branch Parents /////
function _fetchBranchParents() {
	let fetchParentsParams = JSON.parse(
		sessionStorage.getItem("fetchParentsParams")
	);
	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession")
	);
	try {
		$.ajax({
		type: "GET",
		url: `${endPoint}/admin/branch/students/fetch-student?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchParentsParams.departmentId}&classId=${fetchParentsParams.classId}&armId=${fetchParentsParams.armId}`,
		dataType: "json",
		cache: false,
		headers: getAuthHeaders(true),
		success: function (info) {
			const fetch = info.data;
			const success = info.success;
			const session = info.session;
			const termName = info.termData.termName;
			const departmentName = info.departmentData.departmentName;
			const className = info.classData.className;
			const armName = info.armData.armName;

			let pageTitle = `
				<div>
				<span><i class="bi-person-bounding-box"></i></span> BRANCH PARENT'S LIST ----
				<span>${session}</span> - 
				<span>${termName}</span> - 
				<span>${departmentName}</span> - 
				<span>${className}</span> - 
				<span>${armName}</span>
				</div>
				<div class="btn-container">
					<button class="btn" title="EXPORT RECORDS" onclick="_exportStudents('${session}','${departmentName}','${className}','${armName}');">
						<i class="bi-file-earmark-excel"></i> EXPORT
					</button>
				</div>
						
					`;
			$("#pageTitleDiv").html(pageTitle);

			let text = "";
			let no = 0;
		
			if (success === true) {
				for (let i = 0; i < fetch.length; i++) {
					no++;
					const branchId = fetch[i].branchId;
					const departmentId = fetch[i].departmentId;
					const classId = fetch[i].classId;
					const armId = fetch[i].armId;

					const fetchStudentData = fetch[i].studentData;
					const fetchDepartmentData = fetch[i].departmentData;
					const fetchClassData = fetch[i].classData;
					const fetchArmData = fetch[i].armData;

					const studentId = fetchStudentData.studentId;
					const passport = fetchStudentData.passport || "default.jpg";
					const surName = fetchStudentData.surName;
					const firstName = fetchStudentData.firstName;
					const otherNames = fetchStudentData.otherNames;
					const fullname = surName + " " + firstName + " " + otherNames;
					const departmentName = fetchDepartmentData.departmentName;
					const className = fetchClassData.className;
					const armName = fetchArmData.armName;
					const statusName = fetchStudentData.statusName;

					const fetchFatherData = fetch[i].fatherData;
					const fatherFullname =
					fetchFatherData.titleId +
					" " +
					fetchFatherData.surName +
					" " +
					fetchFatherData.otherNames;
					const fatherEmail = fetchFatherData.email;
					const fatherMobileNumber = fetchFatherData.mobileNumber;

					const fetchMotherData = fetch[i].motherData;
					const motherFullname =
					fetchMotherData.titleId +
					" " +
					fetchMotherData.surName +
					" " +
					fetchMotherData.otherNames;
					const motherEmail = fetchMotherData.email;
					const motherMobileNumber = fetchMotherData.mobileNumber;

					text += `
						<tr class="tb-row">
						<td>${no}</td>
						<td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
							<div class="text-back-div">
								<div class="image-div general-passport">
									<img src="${studentPixPath}/${passport}" alt="${fullname}"/>
								</div>

								<div class="text-div">
									<div class="first-class">${fullname}</div>
									<div class="second-class">${studentId}</div>
								</div>
							</div>
						</td>
						<td class="clickable-td" title="Click to view father details" onclick="_loginOnbehalfOfParent('${fetchFatherData.email}','${fetchFatherData.recordFor}','${studentId}');">
						<div class="text-back-div">
							<div class="text-div">
								<div class="first-class">${fatherFullname}</div>
								<div class="second-class">${fatherEmail}</div>
								<div class="second-class">${fatherMobileNumber}</div>
								</div>
							</div>
						</td>
						<td class="clickable-td" title="Click to view mother details" onclick="_loginOnbehalfOfParent('${fetchMotherData.email}','${fetchMotherData.recordFor}','${studentId}');">
							<div class="text-back-div">
								<div class="text-div">
									<div class="first-class">${motherFullname}</div>
									<div class="second-class">${motherEmail}</div>
									<div class="second-class">${motherMobileNumber}</div>
									</div>
								</div>
							</td>
							<td>${session}</td>
							<td>${termName}</td>
							<td>${departmentName}</td>
							<td>${className}</td>
							<td>${armName}</td>
							<td><div class="status-div ${statusName}">${statusName}</div></td>
						</tr>`;
				}
				$("#pageContent").html(text);
			} else {
			_actionAlert(info.message, false);
			text += `
				<tbody>
					<tr>
						<td colspan="20">
							<div class="false-notification-div">
								<p>${info.message}</p>
							</div>
						</td>
					</tr>
				</tbody>`;
			$("#pageContent").html(text);

			const response = info.response;
			if (response < 100) {
				_logOut();
			}
			}
		},
		error: function (textStatus, errorThrown) {
			console.error("AJAX Error: ", textStatus, errorThrown);
			_actionAlert(
			"Check your internet connection and try again.",
			false
			);
		},
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert("An unexpected error occurred! Please try again.", false);
	}
}

///// Login Onbehalf Of Parent ///
function _loginOnbehalfOfParent(email, parentTypeId, studentId) {
	try {
		$("#get-more-div-secondary")
		.css({
			display: "flex",
			"justify-content": "center",
			"align-items": "center",
		})
		.fadeIn(500);

		$.ajax({
		type: "GET",
		url:`${endPoint}/admin/branch/account/parentAuth?email=${email}&parentTypeId=${parentTypeId}&studentId=${studentId}`,
		dataType: "json",
		cache: false,
		headers: getAuthHeaders(true),
		success: function (info) {
			if (info.success) {
				localStorage.setItem("parentSessionData", JSON.stringify(info));

				const studentData = info.students?.find(s => s.studentId === studentId);
				const parentData = info.parentData;

				const sessionPayload = {
					student: studentData,
					parent: parentData
				};
				sessionStorage.setItem("studentParentSessionData", JSON.stringify(sessionPayload));
				_getForm({page: 'parentStudentForm', layer:2, url: adminPortalLocalUrl});
			} else {
				_actionAlert(info.message, false);
				_alertClose(2);
			}
		},
		error: function () {
			_actionAlert("Unable to reach the server. Please check your connection.", false);
			_alertClose(2);
		},
		});
	} catch (error) {
		console.error("Unexpected error:", error);
		_actionAlert("An unexpected error occurred. Please try again.", false);
		_alertClose(2);
	}
}

//////// Branch Department Class ///////////
function _fetchAccountBranchDepartmentClass() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");

    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/admin/branch/department/fetch-branch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
            dataType: "json",
            cache: false,
            headers: getAuthHeaders(true),
            success: function(info) {
                const fetch = info.data;
                const success = info.success;
                
                let text = '';
                let no = 0;

                if (success === true) {
                    for (let i = 0; i < fetch.length; i++) {
                        no++;
                        const department = fetch[i];
                        const departmentName = department.departmentData.departmentName;
						const departmentId = department.departmentData.departmentId;
                        const classData = department.classData;

                        text += `
                            <div class="pages-toggle-div">
                                <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="CLICK TO VIEW ${departmentName} DEPARTMENT CLASSES">
                                    <h3>${departmentName}</h3>
                                    <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                                </div>

                                <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                                    <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                                        <span><i class="bi-people-fill"></i> <span>${departmentName}</span> DEPARTMENT</span>       
                                    </div>

                                    <div class="table-div animated fadeIn">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            <thead>
                                                <tr class="tb-col">
                                                    <th>sn</th>
                                                    <th>Department</th>
                                                    <th>Class</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

											let sn = 0; 
											if (classData.length > 0) {
												for (let j = 0; j < classData.length; j++) {
													const classInfo = classData[j];
													const className = classInfo.className;
													const classId = classInfo.classId;
													const armData = classInfo.armData;

													if (armData.length > 0) {
														for (let k = 0; k < armData.length; k++) {
															sn++;
															const armInfo = armData[k];
															const arm = armInfo.armName;
															const armId = armInfo.armId;

															text += `
															<tr class="tb-row">
															<td>${sn}</td>
															<td>${departmentName}</td>
															<td>${className} ${arm}</td>
															<td>
																<div class="btn-div">
																	<button class="btn view-btn" title="CLICK TO VIEW STUDENT PAYMENT" onclick="_getForm({page: 'viewStudentByClass', layer:2, url: adminPortalLocalUrl});"><i class="bi-bookmark-check"></i> VIEW STUDENT PAYMENT</button>
																</div>
															</td>`;
														}
													} else {
														sn++;
													text += `
														<tr class="tb-row">
															<td>${sn}</td>
															<td>${departmentName}</td>
															<td>${className} (No Arm)</td>
															<td></td>
														</tr>`;
													}
												}
											} 
											text += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>`;
                    }
                    $('#pageContent').html(text);
                } else {
                    _actionAlert(info.message, false);
                    $('#pageContent').html(`
                        <tbody>
                            <tr>
                                <td colspan="15">
                                    <div class="false-notification-div">
                                        <p>${info.message}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>`);

                    if (info.response < 100) {
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

/////// Suspend and Activate Parent Account ///////
function _suspendActivateParentAccount() {
	let studentParentSessionData = JSON.parse(
		sessionStorage.getItem("studentParentSessionData")
	);
	const statusId = studentParentSessionData?.parent?.statusId;

	const activeStatus = statusId === '1';

	const title = activeStatus
		? 'Suspend Parent Account'
		: 'Activate Parent Account';

	const message = activeStatus
		? 'You are about to suspend this Parent Account. Do you want to proceed?'
		: 'You are about to activate this Parent Account. Do you want to proceed?';

	try {
		////// confirm action ////
		_showCustomConfirm({
			callback: () => {
				_suspendActivateParentAccountCallback();
			},
			title: title,
			message: message,
			alertType: "warning",
			falseActionBtn: true,
			trueActionBtnText: "Yes, Proceed",
			falseActionBtnText: "Cancel",
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _suspendActivateParentAccount());
	}
}

	
function _suspendActivateParentAccountCallback() {
	let studentParentSessionData = JSON.parse(sessionStorage.getItem("studentParentSessionData"));

	const branchId = studentParentSessionData?.parent?.branchId;
	const studentId = studentParentSessionData?.student?.studentData?.studentId;
	const email = studentParentSessionData?.parent?.email;
	const parentTypeId = studentParentSessionData?.parent?.recordFor;
	const statusId = studentParentSessionData?.parent?.statusId;

	if (statusId==='1'){
		//1 means active, so we want to suspend parent //
		statusIdToSet='2';
	} else if (statusId==='2'){
		//2 means suspended, so we want to activate parent //
		statusIdToSet='1';
	}

	try {
		///// get btn text/////
		const btnText = $("#activateAndSuspend").html();
		_btnDisable("activateAndSuspend", btnText, true);

		_callFetchEndPoints({
			url: `/admin/branch/students/update-parent-status?branchId=${branchId}&studentId=${studentId}&parentEmail=${email}&parentTypeId=${parentTypeId}&statusId=${statusIdToSet}`,
			accessKey: true,
		})
		.then((response) => {
			if (response.success) {
				_showCustomConfirm({
					callback: () => {
						_loginOnbehalfOfParent(email, parentTypeId, studentId)
					},
					title: "Success!",
					message: response.message,
					alertType: "success",
					trueActionBtnText: "Okay, Thanks",
					closeOnOverlayClick: false,
				});
			} else {
				_showCustomConfirm({
					title: "Unable to Suspend/Activate Parent Account!",
					message: response.message,
					alertType: "error",
					trueActionBtnText: "OK",
				});
			}
			_btnDisable("activateAndSuspend", btnText, false);
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _suspendActivateParentAccountCallback()); // retry if needed
			_btnDisable("activateAndSuspend", btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _suspendActivateParentAccountCallback());
		_btnDisable("activateAndSuspend", btnText, false);
	}
}