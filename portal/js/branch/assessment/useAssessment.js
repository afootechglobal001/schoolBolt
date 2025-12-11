function _fetchAssessmentPage() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment?branchId=${getEachBranchDetailsSession.branchId}`,
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
						<th>Assessment Name</th>
						<th>Total Assessment Score</th>
						<th>Updated By</th>
						<th>Action</th>
					</tr>
				</thead>`;

				if (success===true) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const fetchedAssessment = fetch[i];
						const branchId = fetchedAssessment.branchId;
						const parentId = fetchedAssessment.assessmentId;
						const assessmentId = fetchedAssessment.assessmentId;
						const assessmentName = fetchedAssessment.assessmentName;
                        const assessmentTotalScore = fetchedAssessment.assessmentTotalScore;
 						const updatedBy = fetchedAssessment.updatedBy;
						const updatedTime = fetchedAssessment.updatedTime;

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td> 
									<div class="text-div flex-div">
										<div><button class="btn view-btn edit-btn" title="Click to edit assessment" onclick="_fetchEachAssessment('${assessmentId}');"><i class="bi-pencil-square"></i></button></div>
										<div>${assessmentName}</div>
									</div>
								</td>
								<td>${assessmentTotalScore}</td>
								<td>
									<div class="text-div">
										<div class="bold-font">${updatedBy ? updatedBy : "NULL"}</div>
										<div>${updatedTime ? updatedTime : "NULL"}</div>
									</div>
								</td>
								<td><button class="btn view-btn" title="Click to compute assessment breakdown" onclick="_fetchAssessmentBreakDown('${branchId}','${parentId}');">ASSESSMENT BREAKDOWN</button></td>
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
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}


function _fetchEachAssessment(assessmentId) {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment?branchId=${getEachBranchDetailsSession.branchId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("fetchEachAssessmentSession", JSON.stringify(info.data[0]));
					_getForm({page: 'branch_assessment_reg', layer:2, url: adminPortalLocalUrl});
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
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _createUpdateAssessment() {
	let fetchEachAssessmentSession = JSON.parse(sessionStorage.getItem("fetchEachAssessmentSession"));
	try {
		let issueCount=0;
		const assessmentName = $('#assessmentName').val();
		const assessmentTotalScore = $('#assessmentTotalScore').val();

		$('#assessmentName, #assessmentTotalScore').removeClass('issue');
		$('#issue_assessmentName, #issue_assessmentTotalScore').html('');

		if (!assessmentName) {
			$('#assessmentName').addClass('issue');
			$('#issue_assessmentName').html('USER ERROR! Kindy provide assessment name to continue');
			issueCount++;
		}

		if (!assessmentTotalScore) {
			$('#assessmentTotalScore').addClass('issue');
			$('#issue_assessmentTotalScore').html('USER ERROR! Kindy provide assessment score to continue');
			issueCount++;
		}

		if (issueCount>0){
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"assessmentName": assessmentName,
				"assessmentTotalScore": assessmentTotalScore
			};

			let callUrl= fetchEachAssessmentSession?.assessmentId ? `${endPoint}/admin/branch/assessment/update-assessment?branchId=${getEachBranchDetailsSession.branchId}&assessmentId=${fetchEachAssessmentSession?.assessmentId}` : `${endPoint}/admin/branch/assessment/create-assessment?branchId=${getEachBranchDetailsSession.branchId}`;

			$.ajax({
				type: "POST",
				url: callUrl,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_fetchAssessmentPage();
					_alertClose(2);
				} else {
					_actionAlert(data.message, false);
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

function _fetchAssessmentBreakDown(branchId, parentId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment-breakdown?branchId=${branchId}&parentId=${parentId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info) {
					sessionStorage.removeItem("fetchEachAssessmentBreakdownSession");
					sessionStorage.setItem("fetchAssessmentBreakdownSession", JSON.stringify(info));
					_getForm({page: 'branch_assessment_breakdown_form', layer:2, url: adminPortalLocalUrl});
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
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchEachAssessmentBreakDown(branchId, parentId, assessmentId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/assessment/fetch-assessment-breakdown?branchId=${branchId}&parentId=${parentId}&assessmentId=${assessmentId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info) {
					sessionStorage.setItem("fetchEachAssessmentBreakdownSession", JSON.stringify(info.data[0]));
					_getForm({page: 'branch_assessment_breakdown_form', layer:2, url: adminPortalLocalUrl});
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
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _createUpdateAssessmentBreakDown() {
	let fetchAssessmentBreakdownSession = JSON.parse(sessionStorage.getItem("fetchAssessmentBreakdownSession"));
	let fetchEachAssessmentBreakdownSession = JSON.parse(sessionStorage.getItem("fetchEachAssessmentBreakdownSession"));
	const fetchedIds = fetchAssessmentBreakdownSession;

    const branchId = fetchedIds.assessmentData.branchId;
    const parentId = fetchedIds.assessmentData.assessmentId;

	try {
		let issueCount=0;
		const assessmentName = $('#assessmentBreakDownName').val();
		const assessmentTotalScore = $('#assessmentBreakDownTotalScore').val();

		$('#assessmentBreakDownName, #assessmentBreakDownTotalScore').removeClass('issue');
		$('#issue_assessmentBreakDownName, #issue_assessmentBreakDownTotalScore').html('');

		if (!assessmentName) {
			$('#assessmentBreakDownName').addClass('issue');
			$('#issue_assessmentBreakDownName').html('USER ERROR! Kindy provide assessment breakdown name to continue');
			issueCount++;
		}

		if (!assessmentTotalScore) {
			$('#assessmentBreakDownTotalScore').addClass('issue');
			$('#issue_assessmentBreakDownTotalScore').html('USER ERROR! Kindy provide assessment breakdown score to continue');
			issueCount++;
		}

		if (issueCount>0){
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"assessmentName": assessmentName,
				"assessmentTotalScore": assessmentTotalScore
			};

			let callUrl= fetchEachAssessmentBreakdownSession?.assessmentId ? `${endPoint}/admin/branch/assessment/update-assessment-breakdown?branchId=${branchId}&parentId=${parentId}&assessmentId=${fetchEachAssessmentBreakdownSession?.assessmentId}` : `${endPoint}/admin/branch/assessment/create-assessment-breakdown?branchId=${branchId}&parentId=${parentId}`;

			$.ajax({
				type: "POST",
				url: callUrl,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_fetchAssessmentBreakDown(branchId, parentId);
				} else {
					_actionAlert(data.message, false);
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