function _getActiveBranchPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_branch_details'
    } = props;
	_getBranchPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getBranchPagesActiveLink(divid){
	$('#branch_dashboard, #branch_staff, #branch_profile, #branch_unpaid_orders, #branch_pending_orders, #branch_attending_orders, #branch_ready_orders, #branch_delivered_orders, #branch_activities, #branch_profile_details, #branch_products').removeClass('active');
	$("#"+divid).addClass('active');
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
	_getSelectBranchLga('branchLgaId');
}
function _getSelectBranchLga(fieldId){
	const stateId = $('#branchStateId').val();
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

function _getSelectBranchManagerId(fieldId){
	let $searchList = $('#searchList_' + fieldId);
    $searchList.html('<li>Loading data...</li>');

	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/admin/staff/fetch-staff?statusId=1",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				$searchList.empty();
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const managerFirstName = data[i].firstName
						const managerLastName = data[i].lastName
						const id = data[i].staffId;
						const value = managerFirstName + ' ' + managerLastName;
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


function _createBranch() {
	try {
		const name = $('#name').val();
		const mobileNumber = $('#mobileNumber').val();
		const stateId = $('#branchStateId').val();
		const lgaId = $('#branchLgaId').val();
		const address = $('#address').val();
		const smtpHost = $('#smtpHost').val();
		const smtpUsername = $('#smtpUsername').val();
		const smtpPassword = $('#smtpPassword').val();
		const smtpPort = $('#smtpPort').val();
		const supportEmail = $('#supportEmail').val();
		const paymentKey = $('#paymentKey').val();
		const session = $('#session').val();
		const managerId = $('#staffId').val();
		const termId = $('#termId').val();
		const statusId = $('#statusId').val();

		$('#name, #mobileNumber, #branchStateId, #branchLgaId, #address, #smtpHost, #smtpUsername, #smtpPassword, #smtpPort, #supportEmail, #paymentKey, #session, #staffId, #termId, #statusId').removeClass('issue');

		if (!name) {
			$('#name').addClass('issue');
			_actionAlert('Provide branch name to continue', false);
			return;
		}

		if (!mobileNumber) {
			$('#mobileNumber').addClass("issue");
			_actionAlert('Provide branch mobile number to continue', false);
			return;
		}

		if (!stateId) {
			$('#branchStateId').addClass("issue");
			_actionAlert('Select branch state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#branchLgaId').addClass("issue");
			_actionAlert('Select branch local govt area to continue', false);
			return;
		}

		if (!address) {
			$('#address').addClass("issue");
			_actionAlert('Provide branch address to continue', false);
			return;
		}

		if (!smtpHost || !/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(smtpHost)) {
			$('#smtpHost').addClass("issue");
			_actionAlert('Provide a valid SMTP Host to continue', false);
			return;
		}		

		if (!smtpUsername || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#smtpUsername').val())) {
			$('#smtpUsername').addClass("issue");
			_actionAlert('Provide a valid SMTP Username (email) to continue', false);
			return;
		}		

		if (!smtpPassword) {
			$('#smtpPassword').addClass("issue");
			_actionAlert('Provide branch Smtp Password to continue', false);
			return;
		}

		if (!smtpPort) {
			$('#smtpPort').addClass("issue");
			_actionAlert('Provide branch Smtp Port to continue', false);
			return;
		}

		if (!supportEmail || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(supportEmail)) {
			$('#supportEmail').addClass("issue");
			_actionAlert('Provide a valid Support Email to continue', false);
			return;
		}

		if (!paymentKey) {
			$('#paymentKey').addClass("issue");
			_actionAlert('Provide branch payment key to continue', false);
			return;
		}

		if (!session) {
			$('#session').addClass("issue");
			_actionAlert('Provide session to continue', false);
			return;
		}

		if (!managerId) {
			$('#staffId').addClass("issue");
			_actionAlert('Select branch manager to continue', false);
			return;
		}

		if (!termId) {
			$('#termId').addClass("issue");
			_actionAlert('Select term to continue', false);
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

			const formData = {
				"name": name,
				"mobileNumber": mobileNumber,
				"stateId": stateId,
				"lgaId": lgaId,
				"address": address,
				"smtpHost": smtpHost,
				"smtpUsername": smtpUsername,
				"smtpPassword": smtpPassword,
				"smtpPort": smtpPort,
				"supportEmail": supportEmail,
				"paymentKey": paymentKey,
				"session": session,
				"managerId": managerId,
				"termId": termId,
				"statusId": statusId
			};

			$.ajax({
				type: "POST",
				url: endPoint +'/admin/branch/create-branch',
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_alertClose();
					_getPage({page: 'branches', url: adminPortalLocalUrl});
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


function _fetchBranches() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/branch/fetch-branch',
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
                        <th>Name</th>
                        <th>Official Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Manager</th>
                        <th>Number of staff</th>
                        <th>Date of Reg.</th>
                        <th>Status</th>
						<th>View</th>
                    </tr>
                </thead>`;

				if (success===true) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const branchId = fetch[i].branchId;
						const name = fetch[i].name;
						const smtpUsername = fetch[i].smtpUsername;
						const mobileNumber = fetch[i].mobileNumber;
						const address = fetch[i].address;
						const managerName = fetch[i].managerName;
						const staffId = fetch[i].managerId;
						const totalNumberOfStaff = fetch[i].totalNumberOfStaff;
						const createdTime = fetch[i].createdTime;
						const statusName = fetch[i].statusName;

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td class="clickable-td" title="Click to view branch profile" onclick="_fetchEachBranches('${branchId}');">${name}</td>
								<td>${smtpUsername}i</td>
								<td>${mobileNumber}</td>
								<td>${address}</td>
								<td class="clickable-td" onclick="_fetchEachSaff('${staffId}');">${managerName}</td>
								<td>${totalNumberOfStaff}</td>
								<td>${createdTime}</td>
								<td><div class="status-div ${statusName}">${statusName}</div></td>
								<td><button class="btn view-btn" title="Click to view branch profile" onclick="_fetchEachBranches('${branchId}');">VIEW</button></td>
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
										<div>
											<button class="btn" onclick="_getForm({page: 'branch_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW BRANCH</button>
										</div>
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


function _fetchEachBranches(branchId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fetch-branch?branchId=${branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachBranchDetailsSession", JSON.stringify(info.data[0]));
					_getForm({page: 'branch_profile', url: adminPortalLocalUrl});
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

function _updateBranch() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		const name = $('#updateName').val();
		const mobileNumber = $('#updateMobileNumber').val();
		const stateId = $('#branchStateId').val();
		const lgaId = $('#branchLgaId').val();
		const address = $('#updateAddress').val();
		const smtpHost = $('#updateSmtpHost').val();
		const smtpUsername = $('#updateSmtpUsername').val();
		const smtpPassword = $('#updateSmtpPassword').val();
		const smtpPort = $('#updateSmtpPort').val();
		const supportEmail = $('#updateSupportEmail').val();
		const paymentKey = $('#updatePaymentKey').val();
		const session = $('#updateSession').val();
		const managerId = $('#updateStaffId').val();
		const termId = $('#updateTermId').val();
		const statusId = $('#updateStatusId').val();

		$('#updateName, #updateMobileNumber, #branchStateId, #branchLgaId, #updateAddress, #updateSmtpHost, #updateSmtpUsername, #updateSmtpPassword, #updateSmtpPort, #updateSupportEmail, #updatePaymentKey, #updateSession, #updateStaffId, #updateTermId, #updateStatusId').removeClass('issue');

		if (!name) {
			$('#updateName').addClass('issue');
			_actionAlert('Provide branch name to continue', false);
			return;
		}

		if (!mobileNumber) {
			$('#updateMobileNumber').addClass("issue");
			_actionAlert('Provide branch mobile number to continue', false);
			return;
		}

		if (!stateId) {
			$('#branchStateId').addClass("issue");
			_actionAlert('Select branch state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#branchLgaId').addClass("issue");
			_actionAlert('Select branch local govt area to continue', false);
			return;
		}

		if (!address) {
			$('#updateAddress').addClass("issue");
			_actionAlert('Provide branch address to continue', false);
			return;
		}

		if (!smtpHost || !/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(smtpHost)) {
			$('#updateSmtpHost').addClass("issue");
			_actionAlert('Provide a valid SMTP Host to continue', false);
			return;
		}		

		if (!smtpUsername || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#updateSmtpUsername').val())) {
			$('#updateSmtpUsername').addClass("issue");
			_actionAlert('Provide a valid SMTP Username (email) to continue', false);
			return;
		}		

		if (!smtpPassword) {
			$('#updateSmtpPassword').addClass("issue");
			_actionAlert('Provide branch Smtp Password to continue', false);
			return;
		}

		if (!smtpPort) {
			$('#updateSmtpPort').addClass("issue");
			_actionAlert('Provide branch Smtp Port to continue', false);
			return;
		}

		if (!supportEmail || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(supportEmail)) {
			$('#updateSupportEmail').addClass("issue");
			_actionAlert('Provide a valid Support Email to continue', false);
			return;
		}

		if (!paymentKey) {
			$('#updatePaymentKey').addClass("issue");
			_actionAlert('Provide branch payment key to continue', false);
			return;
		}

		if (!session) {
			$('#updateSession').addClass("issue");
			_actionAlert('Provide session to continue', false);
			return;
		}

		if (!managerId) {
			$('#updateStaffId').addClass("issue");
			_actionAlert('Select branch manager to continue', false);
			return;
		}

		if (!termId) {
			$('#updateTermId').addClass("issue");
			_actionAlert('Select term to continue', false);
			return;
		}

		if (!statusId) {
			$('#updateStatusId').addClass("issue");
			_actionAlert('Select status to continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#updateBtn").html();
			$("#updateBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
			$("#updateBtn").prop("disabled", true);

			const formData = {
				"name": name,
				"mobileNumber": mobileNumber,
				"stateId": stateId,
				"lgaId": lgaId,
				"address": address,
				"smtpHost": smtpHost,
				"smtpUsername": smtpUsername,
				"smtpPassword": smtpPassword,
				"smtpPort": smtpPort,
				"supportEmail": supportEmail,
				"paymentKey": paymentKey,
				"session": session,
				"managerId": managerId,
				"termId": termId,
				"statusId": statusId
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/branch/update-branch?branchId=${getEachBranchDetailsSession.branchId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					let getEachBranchDetailsSession =data.data[0];
					sessionStorage.setItem("getEachBranchDetailsSession", JSON.stringify(getEachBranchDetailsSession));

					_actionAlert(data.message, true);
					_getForm({page: 'branch_profile', url: adminPortalLocalUrl});
					_getPage({page: 'branches', url: adminPortalLocalUrl});
				} else {
					_actionAlert(data.message, false);
				}
				$("#updateBtn").html(btn_text).prop("disabled", false);
			},
				error: function (error) {
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