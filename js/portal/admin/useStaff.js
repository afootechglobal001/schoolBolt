function _getActiveStaffPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='get_staff_details'
    } = props;
	_getStaffPagesActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: adminPortalLocalUrl});
	}
}
function _getStaffPagesActiveLink(divid){
	$('#staff_profile_details, #staff_activities').removeClass('active');
	$("#"+divid).addClass('active');
}

function _getSelectGender(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/preset-data/fetch-gender",
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].genderId;
						const value = data[i].genderName;
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

function _getSelectBranch(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint +'/admin/branch/fetch-branch?statusId=1',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].branchId;
						const value = data[i].name;
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

function _getSelectRole(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint +'/admin/settings/roles/fetch-roles',
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].roleId;
						const value = data[i].roleName;
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

function _fetchStaffs() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/staff/fetch-staff',
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
                    </tr>
                </thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const staffId = fetch[i].staffId;
						const firstName = fetch[i].firstName;
						const lastName = fetch[i].lastName;
						const staffNames = firstName + ' ' + lastName;
						const emailAddress = fetch[i].emailAddress;
						const mobileNumber = fetch[i].mobileNumber;
						const branchName = fetch[i].branchName;
						const roleName = fetch[i].roleName;
						const lastLoginTime = fetch[i].lastLoginTime;
						const statusName = fetch[i].statusName;

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td class="clickable-td" title="Click to view staff profile" onclick="_fetchEachSaff('${staffId}');">
									<div class="text-back-div">
										<div class="image-div">
											<img src="${websiteUrl}/all-images/images/avatar.jpg" alt="${staffNames}"/>
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
										<div">${mobileNumber}</div>
									</div>
								</td>
								<td>${branchName}</td>
								<td>${roleName}</td>
								<td>${lastLoginTime ? lastLoginTime : "00-00-00 00:00:00"}</td>
								<td><div class="status-div ${statusName}">${statusName}</div></td>
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

function _createStaff() {
	try {
		const firstName = $('#firstName').val();
		const middleName = $('#middleName').val();
		const lastName = $('#lastName').val();
		const emailAddress = $('#emailAddress').val();
		const mobileNumber = $('#mobileNumber').val();
		const genderId = $('#genderId').val();
		const dateOfBirth = formatDate($('#dateOfBirth').val()); 
		const stateId = $('#branchStateId').val();
		const lgaId = $('#branchLgaId').val();
		const address = $('#address').val();
		const branchId = $('#branchId').val();
		const roleId = $('#roleId').val();
		const statusId = $('#statusId').val();

		$('#firstName, #middleName, #lastName, #emailAddress, #mobileNumber, #genderId, #dateOfBirth, #branchStateId, #branchLgaId, #address, #branchId, #roleId, #statusId').removeClass('issue');

		if (!firstName) {
			$('#firstName').addClass('issue');
			_actionAlert('Provide first name to continue', false);
			return;
		}

		if (!middleName) {
			$('#middleName').addClass("issue");
			_actionAlert('Provide middle name to continue', false);
			return;
		}

		if (!lastName) {
			$('#lastName').addClass("issue");
			_actionAlert('Provide last name to continue', false);
			return;
		}

		if (!emailAddress || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#emailAddress').val())) {
			$('#emailAddress').addClass("issue");
			_actionAlert('Provide a valid email address to continue', false);
			return;
		}

		if (!mobileNumber) {
			$('#mobileNumber').addClass("issue");
			_actionAlert('Provide mobile number to continue', false);
			return;
		}

		if (!genderId) {
			$('#genderId').addClass("issue");
			_actionAlert('Select gender to continue', false);
			return;
		}

		if (!dateOfBirth) {
			$('#dateOfBirth').addClass("issue");
			_actionAlert('Provide date of birth to continue', false);
			return;
		}

		if (!stateId) {
			$('#branchStateId').addClass("issue");
			_actionAlert('Select state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#branchLgaId').addClass("issue");
			_actionAlert('Select branch local govt area to continue', false);
			return;
		}

		if (!address) {
			$('#address').addClass("issue");
			_actionAlert('Provide full address to continue', false);
			return;
		}

		if (!branchId) {
			$('#branchId').addClass("issue");
			_actionAlert('Select a branch to continue', false);
			return;
		}

		if (!roleId) {
			$('#roleId').addClass("issue");
			_actionAlert('Select role to continue', false);
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
				"firstName": firstName,
				"middleName": middleName,
				"lastName": lastName,
				"emailAddress": emailAddress,
				"mobileNumber": mobileNumber,
				"genderId": genderId,
				"dateOfBirth": dateOfBirth,
				"stateId": stateId,
				"lgaId": lgaId,
				"address": address,
				"branchId": branchId,
				"roleId": roleId,
				"statusId": statusId
			};

			$.ajax({
				type: "POST",
				url: endPoint +'/admin/staff/create-staff',
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_alertClose();
					_getPage({page: 'staff', url: adminPortalLocalUrl});
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

function formatDate(date) {
	if (!date) return ""; 
    const parts = date.split('-'); // Convert "1990-05-20" to ["1990", "05", "20"]
    return `${parts[2]}/${parts[1]}/${parts[0]}`; // Output: "20/05/1990"
}

function _fetchEachSaff(staffId) {
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
					_getForm({page: 'staff_profile', url: adminPortalLocalUrl});
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

function _updateStaff() {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
	try {
		const firstName = $('#updateFirstName').val();
		const middleName = $('#updateMiddleName').val();
		const lastName = $('#updateLastName').val();
		const emailAddress = $('#updateEmailAddress').val();
		const mobileNumber = $('#updateMobileNumber').val();
		const genderId = $('#updateGenderId').val();
		const dateOfBirth = formatDate($('#updateDateOfBirth').val()); 
		const stateId = $('#branchStateId').val();
		const lgaId = $('#branchLgaId').val();
		const address = $('#updateAddress').val();
		const branchId = $('#updateBranchId').val();
		const roleId = $('#updateRoleId').val();
		const statusId = $('#updateStatusId').val();

		$('#updateFirstName, #updateMiddleName, #updateLastName, #updateEmailAddress, #updateMobileNumber, #updateGenderId, #updateDateOfBirth, #branchStateId, #branchLgaId, #updateAddress, #updateBranchId, #updateRoleId, #updateStatusId').removeClass('issue');

		if (!firstName) {
			$('#updateFirstName').addClass('issue');
			_actionAlert('Provide first name to continue', false);
			return;
		}

		if (!middleName) {
			$('#updateMiddleName').addClass("issue");
			_actionAlert('Provide middle name to continue', false);
			return;
		}

		if (!lastName) {
			$('#updateLastName').addClass("issue");
			_actionAlert('Provide last name to continue', false);
			return;
		}

		if (!emailAddress || !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#updateEmailAddress').val())) {
			$('#updateEmailAddress').addClass("issue");
			_actionAlert('Provide a valid email address to continue', false);
			return;
		}

		if (!mobileNumber) {
			$('#updateMobileNumber').addClass("issue");
			_actionAlert('Provide mobile number to continue', false);
			return;
		}

		if (!genderId) {
			$('#updateGenderId').addClass("issue");
			_actionAlert('Select gender to continue', false);
			return;
		}

		if (!dateOfBirth) {
			$('#updateDateOfBirth').addClass("issue");
			_actionAlert('Provide date of birth to continue', false);
			return;
		}

		if (!stateId) {
			$('#branchStateId').addClass("issue");
			_actionAlert('Select state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#branchLgaId').addClass("issue");
			_actionAlert('Select branch local govt area to continue', false);
			return;
		}

		if (!address) {
			$('#updateAddress').addClass("issue");
			_actionAlert('Provide full address to continue', false);
			return;
		}

		if (!branchId) {
			$('#updateBranchId').addClass("issue");
			_actionAlert('Select a branch to continue', false);
			return;
		}

		if (!roleId) {
			$('#updateRoleId').addClass("issue");
			_actionAlert('Select role to continue', false);
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
				"firstName": firstName,
				"middleName": middleName,
				"lastName": lastName,
				"emailAddress": emailAddress,
				"mobileNumber": mobileNumber,
				"genderId": genderId,
				"dateOfBirth": dateOfBirth,
				"stateId": stateId,
				"lgaId": lgaId,
				"address": address,
				"branchId": branchId,
				"roleId": roleId,
				"statusId": statusId
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/staff/update-staff?staffId=${getEachStaffDetailsSession.staffId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					let getEachStaffDetailsSession =data.data[0];
					sessionStorage.setItem("getEachStaffDetailsSession", JSON.stringify(getEachStaffDetailsSession));

					_actionAlert(data.message, true);
					_getForm({page: 'staff_profile', url: adminPortalLocalUrl});
					_getPage({page: 'staff', url: adminPortalLocalUrl});
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