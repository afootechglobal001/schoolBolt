//// Get Select Session ////
function _getSelectBranchAssessment(fieldId){
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment?branchId=${getEachBranchDetailsSession.branchId}`,
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

///// Get Select Session ////
function _getSelectSession(fieldId){
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/preset-data/fetch-session?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].session;
						const value = data[i].session;
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

//// Proceed Fetch Report Classes ////
function _proceedFetchReportClasses(){
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	try {
		let issueCount=0;
		const session = $('#sessionId').val();
		const termId = $('#termId').val();
		const reportTypeId = $('#reportTypeId').val();
		const assessmentId = $('#assessmentId').val();

		$('#sessionId, #termId, #reportTypeId, #assessmentId').removeClass('issue');
		$('#issue_sessionId, #issue_termId, #issue_reportTypeId, #issue_assessmentId').html('');

		if (!session) {
			$('#sessionId').addClass('issue');
			$('#issue_sessionId').html('USER ERROR! Kindly select session to continue');
			issueCount++;
		}

		if (!termId) {
			$('#termId').addClass('issue');
			$('#issue_termId').html('USER ERROR! Kindly select term to continue');
			issueCount++;
		}

		if (!reportTypeId) {
			$('#reportTypeId').addClass('issue');
			$('#issue_reportTypeId').html('USER ERROR! Kindly select report type to continue');
			issueCount++;
		}

		if (!assessmentId) {
			$('#assessmentId').addClass('issue');
			$('#issue_assessmentId').html('USER ERROR! Kindly select assessment to continue');
			issueCount++;
		}

		if (issueCount>0){
			return;
		}

		const btnText = $("#proceedBtn").html();
		$("#proceedBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
		$("#proceedBtn").prop("disabled", true);

		$.ajax({
			type: "GET",
			url: `${endPoint}/preset-data/fetch-record-details?branchId=${getEachBranchDetailsSession.branchId}&session=${session}&termId=${termId}&assessmentId=${assessmentId}&reportTypeId=${reportTypeId}`,
			dataType: "json", 
			cache: false, 
			headers: getAuthHeaders(true),
			success: function (info) {
			if (info.success) {
				sessionStorage.setItem("fetchPresetDataSession", JSON.stringify(info));
				_getActiveBranchPage({divid:'branch_department_class_broadsheet', page: 'branch_department_class_broadsheet', url: adminPortalLocalUrl});
				_alertClose(2);
			} else {
				_actionAlert(info.message, false);
			}
			$("#proceedBtn").html(btnText).prop("disabled", false);
		},
			error: function (error) {
				_actionAlert('An error occurred while processing your request! Please Try Again', false);
				$("#proceedBtn").html(btnText).prop("disabled", false);
			}
		});
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$("#proceedBtn").prop("disabled", false);
	}
}

//// Fetch Broadsheet Class ////
function _fetchBroadsheetClass() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const reportTypeId = fetchPresetDataSession?.reportTypeData?.reportTypeId;

    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");

    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/reports/fetch-report-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
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
                       	const departmentName = department.departmentName;
						const departmentId = department.departmentId;
						const classesData = department.classesData;

						if (classesData.length > 0) {
							for (let j = 0; j < classesData.length; j++) {
								no++;
								const classInfo = classesData[j];
								const classId = classInfo.classId;
								const className = classInfo.className;
								const armData = classInfo.armData;
						
								text += `
									<div class="pages-toggle-div">
										<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view classess">
											<h3>${departmentName} (${className})</h3>
											<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
										</div>

										<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
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
																	<td>${className} ${arm}</td>`;

																	if (reportTypeId==='BRS'){
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to print broad sheet" id="printCaBtn_${classId}_${armId}" onclick="_printCaBroadSheet('${departmentId}','${classId}','${armId}');"><i class="bi-printer"></i> PRINT CA BROAD SHEET</button>
																				<button class="btn view-btn print-btn" title="Click to print terminal broad sheet" id="printTerminalBtn_${classId}_${armId}" onclick="_printTerminalBroadSheet('${departmentId}','${classId}','${armId}');"><i class="bi-printer"></i> PRINT TERMINAL BROAD SHEET</button>
																			</div>
																		</td>`;
																	} else {
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to view continuous assessment report sheet summary" id="" onclick="_viewCaResultSummary('${departmentId}','${classId}','${armId}');"><i class="bi-eye"></i> VIEW CA REPORT SHEET SUMMARY</button>
																				<button class="btn view-btn print-btn" title="Click to view terminal report sheet summary" id="" onclick="_viewTerminalResultSummary('${departmentId}','${classId}','${armId}');"><i class="bi-eye"></i> VIEW TERMINAL REPORT SHEET SUMMARY</button>
																			</div>
																		</td>`;
																	}
																text +=`</tr>`;
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
												text += `
												</tbody>
											</table>
										</div>
									</div>
								</div>`;
							}
						} else {
							no++;
							text += `
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="No classes available">
									<h3>${departmentName} (No Class)</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display:none;">
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
											<tbody>
												<tr class="tb-row">
													<td>1</td>
													<td>${departmentName}</td>
													<td>No Class Available</td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div> 
							</div>`;
						}
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

//// View Continuous Assessment Result Summary ////
function _viewCaResultSummary(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = fetchPresetDataSession?.session;
	const termId = fetchPresetDataSession?.termData?.termId;
	const assessmentId = fetchPresetDataSession?.assessmentData?.assessmentId;
	
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/view-ca-result-summary?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("getViewResultSummarySession", JSON.stringify(info));
					_getForm({page: 'view_ca_result_summary_form', layer:2, url: adminPortalLocalUrl});
				} else {
					_actionAlert(info.message, false);
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}
				}    
			},
			error: function(textStatus, errorThrown) {
				_alertClose(2);
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

//// View Terminal Result Summary ////
function _viewTerminalResultSummary(departmentId, classId, armId) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = fetchPresetDataSession?.session;
	const termId = fetchPresetDataSession?.termData?.termId;
	
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/reports/view-terminal-result-summary?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("getViewTerminalResultSummarySession", JSON.stringify(info));
					_getForm({page: 'view_terminal_result_summary_form', layer:2, url: adminPortalLocalUrl});
				} else {
					_showCustomConfirm({
                        title: "Access Denied!",
                        message: info.message,
                        alertType: "error",
                        trueActionBtnText: "OK",
                        closeOnOverlayClick: true,
                    });
					_alertClose(2);
					const response = info.response;
					if (response < 100) {
						_logOut();
					}
				}    
			},
			error: function(textStatus, errorThrown) {
				_alertClose(2);
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

/// Lock Assessment Record ///
function _lockAssessmentRecord(e, el) {
    try {
        e.stopPropagation();
        e.preventDefault();

        const assessmentLock = el.checked;

        _showCustomConfirm({
            callback: () => {
                _lockAssessmentRecordCallback(assessmentLock);
            },
            title: assessmentLock ? "Confirm Lock" : "Confirm Unlock",
            message: assessmentLock
                ? "Are you sure you want to lock assessment Updates?"
                : "Are you sure you want to unlock assessment Updates?",
            alertType: "warning",
            falseActionBtn: true,
            trueActionBtnText: assessmentLock ? "Yes, Lock" : "Yes, Unlock",
			falseActionBtnText: "Cancel",
			closeOnOverlayClick: true,
            falseActionCallback: () => {
                el.closest('.switch')
                .querySelector('.toggle-label')
                .textContent = el.checked ? 'Yes' : 'No';
            }
        });
    } catch (error) {
        console.error(error);
        _callCatchError(() => _lockAssessmentRecord(e, el));
    }
}

//// Lock Assessment Record Callback ////
function _lockAssessmentRecordCallback(assessmentLock) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	assessmentLock ? _showLoader('Locking Assessment Updates, please wait...') : _showLoader('Unlocking Assessment Updates, please wait...');

	//// call endpoint //////
	 _callFetchEndPoints({
		url: `reports/lock-assessment-update?branchId=${getEachBranchDetailsSession.branchId}&assessmentLock=${assessmentLock}`,
		accessKey: true,
	})
    .then((response) => {
		_staffValidationCheck(response.response);
		if (response.success) {
			_showCustomConfirm({
				callback: () => {
					sessionStorage.setItem(
						"getEachBranchDetailsSession",
						JSON.stringify({ branchId: getEachBranchDetailsSession.branchId })
					);

					_fetchEachBranches(getEachBranchDetailsSession.branchId);
					_getPage({ page: "branches", url: adminPortalLocalUrl });
				},
				title: "Success!",
				message: response.message,
				alertType: "success",
				trueActionBtnText: "Okay, Thanks",
				closeOnOverlayClick: false,
			});
			_hideLoader();
		} else {
			_hideLoader();
			_showCustomConfirm({
				title: assessmentLock ? "Unable to Lock Assessment Updates!" : "Unable to Unlock Assessment Updates!",
				message: response.message,
				alertType: "error",
				trueActionBtnText: "OK",
				closeOnOverlayClick: true,
			});
		}
    })
    .catch((error) => {
		console.error("Error:", error);
		_callAjaxError(() => _lockAssessmentRecordCallback(assessmentLock)); // retry if needed
		_hideLoader();
    });
}

/// Publish Result ///
function _publishResult(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const newSession = $('#newSession').val().trim();
    	const newTermId = $('#newTermId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("newSession", "SESSION");
		issueCount += _validateEmptyValue("newTermId", "TERM");

		if (issueCount > 0) return;

		/////Gather form data////
		const formData = {
			newSession,
			newTermId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_publishResultCallback(formData);
		},
			title: "Are you sure?",
			message: 'Once you publish this result, the current student result data cannot be updated. Ensure all scores and details are 100% correct before proceeding.',
			alertType: "warning",
			falseActionBtn: true,
			trueActionBtnText: "Yes, Publish",
			falseActionBtnText: "Cancel",
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _publishResult());
	}
}

/// Publish Result Callback ////
function _publishResultCallback(formData) {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	///// get btn text/////
	const btnText = $("#publishResultBtn").html();
	_btnDisable("publishResultBtn", btnText, true);
	
	//// call endpoint //////
	 _callRawEndPoints({
		url: `reports/publish-results?branchId=${getEachBranchDetailsSession.branchId}`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_staffValidationCheck(response.response);
		if (response.success) {
      _showCustomConfirm({
				callback: () => {
				  _alertClose(2);
          _fetchEachBranches(getEachBranchDetailsSession.branchId);
          _getPage({ page: "branches", url: adminPortalLocalUrl });
				},
          title: "Success!",
          message: response.message,
          alertType: "success",
          trueActionBtnText: "Okay, Thanks",
          closeOnOverlayClick: false,
      });
			_btnDisable("publishResultBtn", btnText, false);
		} else {
			_btnDisable("publishResultBtn", btnText, false);
			_showCustomConfirm({
				title: "Unable to Publish Result!",
				message: response.message,
				alertType: "error",
				trueActionBtnText: "OK",
			});
		}
    })
    .catch((error) => {
		console.error("Error:", error);
		_callAjaxError(() => _publishResultCallback(formData)); // retry if needed
		_btnDisable("publishResultBtn", btnText, false);
    });
}

//// Proceed Fetch Cumulative and Promotional Broadsheet ////
function proceedPromotionalAndCumulativeBroadsheet(viewBroadsheetType) {
	try {
		let issueCount=0;
		const session = $('#sessionId').val().trim();

  		issueCount += _validateEmptyValue("sessionId", "SESSION");

		if (issueCount>0){
			return;
		}

		const cumulativeAndPromotionalDepartmentClassParams = {
			session: session,
			viewBroadsheetType: viewBroadsheetType,
		};

		sessionStorage.setItem(
			"cumulativeAndPromotionalDepartmentClassParams",
			JSON.stringify(cumulativeAndPromotionalDepartmentClassParams),
		);
		_getActiveBranchPage({
			divid: "cumulativeAndPromotionalBranchDepartmentClass",
			page: "cumulativeAndPromotionalBranchDepartmentClass",
			url: adminPortalLocalUrl,
		});
		_alertClose(2);

	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
	}
}

//// Fetch Cumulative and Promotional Broadsheet Class ////
function _fetchCumulativeAndPromotionalBroadsheetClass() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	let cumulativeAndPromotionalDepartmentClassParams = JSON.parse(sessionStorage.getItem("cumulativeAndPromotionalDepartmentClassParams"));

	const session = cumulativeAndPromotionalDepartmentClassParams?.session;
	const viewBroadsheetType = cumulativeAndPromotionalDepartmentClassParams?.viewBroadsheetType;

    $('#cumulativePromotionalPageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");

    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/reports/fetch-report-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
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
                       	const departmentName = department.departmentName;
						const departmentId = department.departmentId;
						const classesData = department.classesData;

						if (classesData.length > 0) {
							for (let j = 0; j < classesData.length; j++) {
								no++;
								const classInfo = classesData[j];
								const classId = classInfo.classId;
								const className = classInfo.className;
								const armData = classInfo.armData;
						
								text += `
									<div class="pages-toggle-div">
										<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view classess">
											<h3>${departmentName} (${className})</h3>
											<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
										</div>

										<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
											<div class="table-div animated fadeIn">
												<table class="table" cellspacing="0" style="width:100%">
													<thead>
														<tr class="tb-col">
															<th>sn</th>
															<th>Department</th>
															<th>Class</th>
															<th>Session</th>
															<th>Action</th>
														</tr>
													</thead>
													
													<tbody>`;
														let sn = 0; 
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
																	<td>${session}</td>`;
																	if (viewBroadsheetType==='cumulative') {
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to print cumulative broad sheet" id="printCumulativeBtn_${classId}_${armId}" onclick="_printSessionCumulativeMarkBook('${session}', '${departmentId}', '${classId}', '${armId}');"><i class="bi-printer"></i> PRINT CUMULATIVE MARKBOOK</button>
																			</div>
																		</td>`;
																	} else {
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to print promotional broad sheet" id="printPromotionalBtn_${classId}_${armId}" onclick="_printSessionPromotionalBroadSheet('${session}', '${departmentId}', '${classId}', '${armId}');"><i class="bi-printer"></i> PRINT PROMOTIONAL BROAD SHEET</button>
																			</div>
																		</td>`;
																	}
																text +=`</tr>`;
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
												text += `
												</tbody>
											</table>
										</div>
									</div>
								</div>`;
							}
						} else {
							no++;
							text += `
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="No classes available">
									<h3>${departmentName} (No Class)</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display:none;">
									<div class="table-div animated fadeIn">
										<table class="table" cellspacing="0" style="width:100%">
											<thead>
												<tr class="tb-col">
													<th>sn</th>
													<th>Department</th>
													<th>Class</th>
													<th>Session</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr class="tb-row">
													<td>${no}</td>
													<td>${departmentName}</td>
													<td>No Class Available</td>
													<td>${session}</td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div> 
							</div>`;
						}
                    }
                    $('#cumulativePromotionalPageContent').html(text);
                } else {
                    _actionAlert(info.message, false);
                    $('#cumulativePromotionalPageContent').html(`
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

//// Proceed To Update Comment ////
function _proceedUpdatePrincipalsComment() {
	let getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));
  const classTeachersComment = getViewTerminalResultSummarySession?.studentData[0]?.classTeachersComment || "";
	
	if (getViewTerminalResultSummarySession) {
    if (classTeachersComment==="" || classTeachersComment==null) {
      _showCustomConfirm({
        title: "Unable to Proceed!",
        message: "Class teacher's comment must be computed. Kindly compute class teacher's comment to proceed.",
        alertType: "error",
        trueActionBtnText: "OK",
        closeOnOverlayClick: true,
      });
    } else {
      sessionStorage.setItem("printTerminalResultSummarySession", JSON.stringify(getViewTerminalResultSummarySession));
      _getForm({ page: "updateHeadAndPrincipalComment", layer: 3, url: adminPortalLocalUrl });
    }
	}
}

//// Save Principal Comment ////
function _savePrincipalsComment() {
  try {
    let issueCount = 0;
		const allComments = [];
	
		$('.student-id-holder').each(function () {
			const studentId = $(this).val();
			const inputSelector = `#principalComment_${studentId}`;
			const errorSelector = `#issue_principalComment_${studentId}`;
			const principalComment = $(inputSelector).val();

			$(inputSelector).removeClass('issue');
			$(errorSelector).html('');

			if (principalComment === "" || null) {
				$(inputSelector).addClass('issue');
				$(errorSelector).html(`Principal's comment is required`);
				issueCount++;
			} else {
				allComments.push({
					studentId: studentId,
					principalsComment: principalComment
				});
			}
		});

		if (issueCount>0){
			return;
		}

    ///// Gather form data ////
    const formData = {
      allComments: allComments,
    };

    ////// confirm action ////
    _showCustomConfirm({
      callback: () => {
        _savePrincipalsCommentCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _savePrincipalsComment());
  }
}

//// Proceed To Principal Comment CallBack /////
function _savePrincipalsCommentCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

  let getViewTerminalResultSummarySession = JSON.parse(
    sessionStorage.getItem("getViewTerminalResultSummarySession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
	const departmentId = getViewTerminalResultSummarySession?.departmentData?.departmentId;
	const classId = getViewTerminalResultSummarySession?.classData?.classId;
	const armId = getViewTerminalResultSummarySession?.armData?.armId;

  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    _callRawEndPoints({
      url: `reports/save-class-principals-comments?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _alertClose(3);
          _viewTerminalResultSummary(departmentId, classId, armId);
        } else {
          _showCustomConfirm({
            title: "Unable to Save Comments!",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _savePrincipalsCommentCallback(formData)); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _savePrincipalsCommentCallback(formData));
    _btnDisable("submitBtn", btnText, false);
  }
}

//// Fetch Promotional Panel Department Classes ////
function _fetchPromotionDepartmentClasses() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));

	const branchId = getEachBranchDetailsSession?.branchId;
	const session = getEachBranchDetailsSession?.session;
	const termName = getEachBranchDetailsSession?.termData[0]?.termName;

    $('#promotionPanelPageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/reports/fetch-report-department-classes?branchId=${branchId}`,
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
                       	const departmentName = department.departmentName;
						const departmentId = department.departmentId;
						const classesData = department.classesData;

						if (classesData.length > 0) {
							for (let j = 0; j < classesData.length; j++) {
								no++;
								const classInfo = classesData[j];
								const classId = classInfo.classId;
								const className = classInfo.className;
								const armData = classInfo.armData;
						
								text += `
									<div class="pages-toggle-div">
										<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view classess">
											<h3>${departmentName} (${className})</h3>
											<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
										</div>

										<div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
											<div class="table-div animated fadeIn">
												<table class="table" cellspacing="0" style="width:100%">
													<thead>
														<tr class="tb-col">
															<th>sn</th>
															<th>Department</th>
															<th>Class</th>
															<th>Session</th>
															<th>Term</th>
															<th>Action</th>
														</tr>
													</thead>
													
													<tbody>`;
														let sn = 0; 
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
																	<td>${session}</td>
																	<td>${termName}</td>
																	<td>
																		<div class="btn-div">
																			<button class="btn view-btn" title="Click to proceed to promotion panel" id="proceedBtn_${classId}_${armId}" onclick="_fetchPromotionPanelStudentsByClass('${departmentId}', '${classId}', '${armId}');"><i class="bi-printer"></i> PROCEED TO VIEW STUDENTS</button>
																		</div>
																	</td>`;
																	
																text +=`</tr>`;
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
												text += `
												</tbody>
											</table>
										</div>
									</div>
								</div>`;
							}
						} else {
							no++;
							text += `
							<div class="pages-toggle-div">
								<div class="pages-toggle-title" onclick="_collapse('view${no}');" title="No classes available">
									<h3>${departmentName} (No Class)</h3>
									<div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
								</div>

								<div class="toggle-expand-div" id="view${no}answer" style="display:none;">
									<div class="table-div animated fadeIn">
										<table class="table" cellspacing="0" style="width:100%">
											<thead>
												<tr class="tb-col">
													<th>sn</th>
													<th>Department</th>
													<th>Class</th>
													<th>Session</th>
													<th>Term</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr class="tb-row">
													<td>${no}</td>
													<td>${departmentName}</td>
													<td>No Class Available</td>
													<td>${session}</td>
													<td>${termName}</td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div> 
							</div>`;
						}
                    }
                    $('#promotionPanelPageContent').html(text);
                } else {
                    _actionAlert(info.message, false);
                    $('#promotionPanelPageContent').html(`
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

///// Fetch Promotion Panel Students By Class /////
function _fetchPromotionPanelStudentsByClass(departmentId, classId, armId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  try {
	const btnText = $(`#proceedBtn_${classId}_${armId}`).html();
    _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, true);
	
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/students/fetch-student?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success=== true) {
          sessionStorage.setItem(
            "usePromotionPanelStudentByClassSession",
            JSON.stringify(response),
          );
          _getForm({page: 'studentPromotionPanelModal', layer: 2, url: adminPortalLocalUrl});
        } else {
          _alertClose(2);
          _actionAlert(response.message, false);
		   _btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
        }
		_btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
      })
      .catch((error) => {
        _alertClose(2);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchPromotionPanelStudentsByClass(departmentId, classId, armId),
        ); // retry if needed
		_btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
      });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchPromotionPanelStudentsByClass(departmentId, classId, armId),
    ); // retry if needed
	_btnDisable(`proceedBtn_${classId}_${armId}`, btnText, false);
  }
}

/// filter Combo Product Data ///
function _filtersPromotionPanelStudents(value) {
  $("#promotionPanelStudentByClassPageContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

//// Open Proceed Promotion Form ////
function _openProceedPromotionForm() {
    ////////get all needed values////////////
    let selectedStudents = [];
    $(".child:checked").each(function () {
      selectedStudents.push({ studentId: $(this).data("value") });
    });

    const checked = $('input[name="studentId[]"]:checked').length;
    $("#studentId").removeClass("issue");

    if (checked < 1) {
		_showCustomConfirm({
			title: "No Student Selected!",
			message: "Select at least a student to continue.",
			alertType: "error",
			trueActionBtnText: "OK",
			closeOnOverlayClick: true,
		});
		return;
    }

    // STORE SELECTED IDS
    sessionStorage.setItem(
        "getPromotionStudentIds",
        JSON.stringify(selectedStudents)
    );

    // OPEN MODAL
    _getForm({
        page: 'promotionPanelStudentSelectForm',
        layer: 3,
        url: adminPortalLocalUrl
    });
}

/// Proceed With Student Promotion ////
function _proceedStudentPromotion() {
	let getPromotionStudentIds = JSON.parse(sessionStorage.getItem("getPromotionStudentIds"));

	try {
		////////get all needed values////////////
		let issueCount = 0;
		let selectedStudents = getPromotionStudentIds || [];
		const newDepartmentId = $("#departmentId").val().trim();
		const newClassId = $("#classId").val().trim();
		const newArmId = $("#armId").val().trim();

		issueCount += _validateEmptyValue("departmentId", "NEW DEPARTMENT");
		issueCount += _validateEmptyValue("classId", "NEW CLASS");
		issueCount += _validateEmptyValue("armId", "NEW ARM");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			studentIds: selectedStudents,
			newDepartmentId: newDepartmentId,
			newClassId: newClassId,
			newArmId: newArmId,
		};

		////// confirm action////
		_showCustomConfirm({
			callback: () => {
				_proceedStudentPromotionCallback(formData);
			},
			title: "Are you sure?",
			message: "Are you sure you want to proceed? This action is irreversible.",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedStudentPromotion());
	}
}

//// Proceed To Promotion of student CallBack /////
function _proceedStudentPromotionCallback(formData) {
	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession"),
	);

	let usePromotionPanelStudentByClassSession = JSON.parse(
		sessionStorage.getItem("usePromotionPanelStudentByClassSession"),
	);

	const branchId = getEachBranchDetailsSession?.branchId;
	const selectedDepartmentId = usePromotionPanelStudentByClassSession?.departmentData?.departmentId;
	const selectedClassId = usePromotionPanelStudentByClassSession?.classData?.classId;
	const selectedArmId = usePromotionPanelStudentByClassSession?.armData?.armId;
	
	try {
		/// Get Btn Text ///
		const btnText = $("#submitBtn").html();
		_btnDisable("submitBtn", btnText, true);

		//// Call endpoint //////
		_callRawEndPoints({
			url: `reports/promote-students-to-next-class?branchId=${branchId}`,
			formData,
			accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success) {
				_alertClose(3);
				_showCustomConfirm({
					callback: () => {
						_fetchPromotionPanelStudentsByClass(selectedDepartmentId, selectedClassId, selectedArmId)
					},
					title: "Success!",
					message: response.message,
					alertType: "success",
					trueActionBtnText: "OK, Thanks.",
					closeOnOverlayClick: false,
				});
			} else {
				_showCustomConfirm({
					title: "Unable To Promote Students!",
					message: response.message,
					alertType: "warning",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("submitBtn", btnText, false);
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _proceedStudentPromotionCallback(formData)); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedStudentPromotionCallback(formData));
		_btnDisable("submitBtn", btnText, false);
	}
}