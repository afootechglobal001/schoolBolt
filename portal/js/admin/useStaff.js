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
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
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

						text +=`
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td class="clickable-td" title="Click to view staff profile" onclick="_fetchEachSaff('${staffId}');">
									<div class="text-back-div">
										<div class="image-div">
											<img src="${websiteUrl}/uploaded_files/staffPix/default.jpg" alt="${staffNames}"/>
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
								<td><button class="btn view-btn" title="Click to view staff profile" onclick="_fetchEachSaff('${staffId}');">VIEW</button></td>
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

function formatDate(date) {
	if (!date) return ""; 
    const parts = date.split('-');
    return `${parts[2]}/${parts[1]}/${parts[0]}`;
}


function _createStaff(view) {
	try {
		if (view=='mobile'){
			var passport ='mobile';
		}else{
			var passport =document.getElementById("passport").src;
		}

		const titleId = $('#titleId').val();
		const firstName = $('#firstName').val();
		const middleName = $('#middleName').val();
		const lastName = $('#lastName').val();
		const emailAddress = $('#emailAddress').val();
		const mobileNumber = $('#mobileNumber').val();
		const genderId = $('#genderId').val();
		const dateOfBirth = formatDate($('#dateOfBirth').val()); 
		const stateId = $('#stateId').val();
		const lgaId = $('#lgaId').val();
		const address = $('#address').val();
		const branchId = $('#branchId').val();
		const roleId = $('#roleId').val();
		const statusId = $('#statusId').val();

		$('#titleId, #firstName, #middleName, #lastName, #emailAddress, #mobileNumber, #genderId, #dateOfBirth, #stateId, #lgaId, #address, #branchId, #roleId, #statusId').removeClass('issue');

		if (!titleId) {
			$('#titleId').addClass('issue');
			_actionAlert('Select title to continue', false);
			return;
		}

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
			$('#stateId').addClass("issue");
			_actionAlert('Select state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#lgaId').addClass("issue");
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
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = new FormData();
			formData.append("titleId", titleId);
			formData.append("firstName", firstName);
			formData.append("middleName", middleName);
			formData.append("lastName", lastName);
			formData.append("emailAddress", emailAddress);
			formData.append("mobileNumber", mobileNumber);
			formData.append("genderId", genderId);
			formData.append("dateOfBirth", dateOfBirth);
			formData.append("stateId", stateId);
			formData.append("lgaId", lgaId);
			formData.append("address", address);
			formData.append("branchId", branchId);
			formData.append("roleId", roleId);
			formData.append("statusId", statusId);
			formData.append("address", address);
			formData.append("passport", passport);

			$.ajax({
				type: "POST",
				url: endPoint +'/admin/staff/create-staff',
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				success: function (info) {
					const data = info.data[0];
					const success = info.success;
					const message = info.message;

					if (success=== true) {
						const passportName = data.staffData[0].passport;

						if (passportName==='default.jpg'){
							_actionAlert(message, true);
							_getPage({page: 'staff', url: adminPortalLocalUrl});
						}else{
							_uploadStaffPicture(passportName, message);
						}
				} else {
					_actionAlert(message, false);
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


function _uploadStaffPicture(passportName, message) {
    const action = "upload_staff_pix";

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
			_getPage({page: 'staff', url: adminPortalLocalUrl});
        },
        error: function () {
            _actionAlert('Upload failed! Please try again.', false);
        }
    });
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
		const stateId = $('#stateId').val();
		const lgaId = $('#lgaId').val();
		const address = $('#updateAddress').val();
		const branchId = $('#updateBranchId').val();
		const roleId = $('#updateRoleId').val();
		const statusId = $('#updateStatusId').val();

		$('#updateFirstName, #updateMiddleName, #updateLastName, #updateEmailAddress, #updateMobileNumber, #updateGenderId, #updateDateOfBirth, #stateId, #lgaId, #updateAddress, #updateBranchId, #updateRoleId, #updateStatusId').removeClass('issue');

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
			$('#stateId').addClass("issue");
			_actionAlert('Select state to continue', false);
			return;
		}

		if (!lgaId) {
			$('#lgaId').addClass("issue");
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
			$("#updateBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
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