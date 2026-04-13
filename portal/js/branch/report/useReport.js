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