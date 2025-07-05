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
                                <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view classess">
                                    <h3>${departmentName}</h3>
                                    <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                                </div>

                                <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                                    <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                                        <span><i class="bi-people-fill"></i> <span>${departmentName}</span> DEPARTMENT </span>

                                        <div class="btn-container">
                                            <button class="btn" title="PRINT RECORDS" onclick=""><i class="bi-printer"></i> PRINT</button>
                                            <button class="btn" title="EXPORT RECORDS" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
                                        </div>
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
																	<td>${className} ${arm}</td>`;

																	if (reportTypeId==='BRS'){
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to print broad sheet" id="printBtn" onclick="_printBroadSheet('${departmentId}','${classId}','${armId}');"><i class="bi-printer"></i> PRINT CA BROAD SHEET</button>
																				<button class="btn view-btn print-btn" title="Click to print terminal broad sheet" id="printBtn" onclick="_printTerminalBroadSheet('${departmentId}','${classId}','${armId}');"><i class="bi-printer"></i> PRINT CA TERMINAL BROAD SHEET</button>
																			</div>
																		</td>`;
																	} else {
																		text += `
																		<td>
																			<div class="btn-div">
																				<button class="btn view-btn" title="Click to view report sheet summary" id="" onclick="_viewResultSummary('${departmentId}','${classId}','${armId}');"><i class="bi-eye"></i> VIEW CA REPORT SHEET SUMMARY</button>
																				<button class="btn view-btn print-btn" title="Click to view terminal report sheet summary" id="" onclick="_viewResultSummary('${departmentId}','${classId}','${armId}');"><i class="bi-eye"></i> VIEW TERMINAL REPORT SHEET SUMMARY</button>
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
                _actionAlert('An error occurred while fetching data! Please try again.', false);
            }
        });
    } catch (error) {
        console.error("Error: ", error);
        _actionAlert('An unexpected error occurred! Please try again.', false);
    }
}


function _viewResultSummary(departmentId, classId, armId) {
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
			url: `${endPoint}/reports/view-result-summary?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(),
			success: function(info) {
				if (info.success > 0) {
					sessionStorage.setItem("getViewResultSummarySession", JSON.stringify(info));
					_getForm({page: 'view_broadsheet_result_summary_form', layer:2, url: adminPortalLocalUrl});
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
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}