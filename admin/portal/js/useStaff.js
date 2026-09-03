function _getActiveStaffPage(props) {
    const { page = "", divid = "", pageContainer = "get_staff_details" } = props;
    _getStaffPagesActiveLink(divid);
    if (page) {
        _getPage({
        page: page,
        pageContainer: pageContainer,
        url: adminPortalMiddlewareUrl,
        });
    }
}
function _getStaffPagesActiveLink(divid) {
    $("#staff_profile_details, #staff_activities").removeClass("active");
    $("#" + divid).addClass("active");
}

//// Filter Staffs ////
function _filtersStaffs(value) {
    $("#staffContent .tb-row").each(function () {
        var text = $(this).text();
        text.toLowerCase().indexOf(value.toLowerCase()) > -1
        ? $(this).show()
        : $(this).hide();
    });
}

//// Get Role Preset Data ////
function _getSelectRole(fieldId) {
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/settings/roles/fetch-roles`,
      accessKey: true,
		})
        .then((response) => {
            $("#searchList_" + fieldId).html("");
			for (let i = 0; i < response.data.length; i++) {
				const id = response.data[i].roleId;
        const value = response.data[i].roleName;
                
				$("#searchList_" + fieldId).append(`
          <li onclick="
            _clickOption(
              'searchList_${fieldId}',
              '${id}',
              '${value}'
            );
          ">
            ${value}
          </li>
        `);
			}				
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
    }
}

///// Create or Update Staff /////
function _createStaff(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const firstName = $('#firstName').val();
		const lastName = $('#lastName').val();
		const emailAddress = $('#emailAddress').val();
		const phoneNumber = $('#phoneNumber').val();
		const roleId = $('#roleId').val();
		const statusId = $('#statusId').val();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("firstName", "FIRST NAME");
		issueCount += _validateEmptyValue("lastName", "LAST NAME");
		issueCount += _validateEmptyValue("emailAddress", "EMAIL ADDRESS");
        issueCount += _validateEmail("emailAddress", "EMAIL ADDRESS");
		issueCount += _validateEmptyValue("phoneNumber", "PHONE NUMBER");
		issueCount += _validateEmptyValue("roleId", "ROLE");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			firstName,
			lastName,
            emailAddress,
            phoneNumber,
            roleId,
            statusId,
		};

		////// confirm action////
		_showCustomConfirm({
            callback: () => {
                _createStaffCallback(formData);
            },
			title: "Are you sure?",
			message: 'Are you sure you want to submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createStaff());
	}
}

///// Save Create or Update Role Callback /////
function _createStaffCallback(formData) {

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
	//// call endpoint //////
	_callRawEndPoints({
		url: `admin/staff/create-staff`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				_alertClose();
				_getActivePage({page:'adminPage', divid:'adminPage'});
			},
			title: 'Success!',
			message: response?.message,
			alertType: 'success',
			trueActionBtnText: 'OK, Thanks.',
			closeOnOverlayClick: false,
		});
		_btnDisable("submitBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _createStaffCallback(formData), error.message); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_showCustomConfirm({
                title: "Unable to Create Staff",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

/// Fetch Staff Data ///
// function _fetchStaffData() {
// 	try {
// 		//// call endpoint //////
// 		_callFetchEndPoints({
// 			url: `admin/staff/fetch-staff`,
// 			// accessKey: true,
// 		})
// 		.then((response) => {
//             _initFetchStaffData(response.data);
// 		 })
// 		.catch((error) => {
// 			_staffValidationCheck(error.response);
// 			console.error("Error:", error);
// 			if (error.status==0) {
// 				_showEmptyState({
// 					container: "staffContent",
// 					message: "Check your internet connection and try again",
//                     colspan: 20,
// 					paginationContainer: "staffContentPaginationControls",
// 				});

// 				_callAjaxError(() => _fetchStaffData(), error.message); // retry if needed
// 			} else {
// 				_showEmptyState({
// 					container: "staffContent",
// 					message: error.message,
//                     colspan: 20,
// 					button: `
// 						<button class="btn" title="ADD NEW STAFF" onclick="sessionStorage.removeItem('useEachStaffSession'); _getForm({page: 'staffReg', url: adminPortalMiddlewareUrl});">
// 							<i class="bi-plus-square"></i> ADD NEW STAFF
// 						</button>
// 					`,
// 					paginationContainer: "staffContentPaginationControls",
// 				});
// 			}
// 		});
// 	} catch (error) {
// 		console.error("Error:", error);
// 		_callCatchError(() => _fetchStaffData());
//   	}
// }

function _fetchStaffData() {
    const response = {
        data: [
            {
                staffId: "STF001",
                firstName: "Emmanuel",
                lastName: "Afolabi",
                emailAddress: "emmanuel.afolabi@schoolbolt.com",
                phoneNumber: "+2348012345678",
                lastLoginTime: "2026-08-03 09:15:22",
                roleData: {
					roleName: "SUPER ADMIN"
				},
				statusData: {
					statusName: "ACTIVE"
				}
            },
            {
                staffId: "STF002",
                firstName: "Grace",
                lastName: "Johnson",
                emailAddress: "grace.johnson@schoolbolt.com",
                phoneNumber: "+2348023456789",
                lastLoginTime: "2026-08-02 15:42:10",
                roleData: {
					roleName: "SUPER ADMIN"
				},
				statusData: {
					statusName: "ACTIVE"
				}
            }
        ]
    };

    _initFetchStaffData(response.data);
}

/// Render Staff Data ///
function _renderStaffData(data, start) {
  return data
    .map(
      (item, i) => `
	  	<tr class="tb-row">
			<td>${start + i + 1}</td>
			<td class="clickable-td" title="Click to view staff profile" onclick="_fetchEachSaff('${item.staffId}');">
				<div class="text-back-div">
					<div class="image-div">
						<img src="${websiteUrl}/all-images/images/avatar.jpg" alt="${item.firstName} ${item.lastName}"/>
					</div>

					<div class="text-div">
						<div class="first-class">${item.firstName} ${item.lastName}</div>
						<div class="second-class">${item.staffId}</div>
					</div>
				</div>
			</td>
			<td>
				<div class="text-div">
					<div>${item.emailAddress}</div> 
					<div">${item.phoneNumber}</div>
				</div>
			</td>
			<td>${item.roleData?.roleName}</td>
			<td>${item.lastLoginTime ? item.lastLoginTime : "00-00-00 00:00:00"}</td>
			<td><div class="status-div ${item.statusData?.statusName}">${item.statusData?.statusName}</div></td>
			<td><button class="btn view-btn" title="Click to view staff profile" onclick="_fetchEachSaff('${item.staffId}');">VIEW</button></td>
		</tr>`
    )
    .join("");
}

/// Initialize Fetch Staff Data ///
function _initFetchStaffData(data) {
  const paginator = new Paginator(
    data,
    _renderStaffData,
    "staffContentPaginationControls",
    "staffContent",
    10
  );
  __paginatorHandlers["staffContentPaginationControls"] = paginator;
  paginator.renderPage();
}

//// Fetch Each Staff ////
function _fetchEachSaff(staffId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/staff/fetch-staff?staffId=${staffId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("getEachStaffDetailsSession", JSON.stringify(response.data[0]));
			_getForm({page: 'staffProfile', url: adminPortalMiddlewareUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachSaff(staffId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachSaff(staffId));
  	}
}

//// /// Update Staff ////
function _updateStaff(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const firstName = $('#updateFirstName').val().trim();
		const lastName = $('#updateLastName').val().trim();
		const emailAddress = $('#updateEmailAddress').val().trim();
		const phoneNumber = $('#updatePhoneNumber').val().trim();
		const roleId = $('#updateRoleId').val().trim();
		const statusId = $('#updateStatusId').val().trim();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("updateFirstName", "FIRST NAME");
		issueCount += _validateEmptyValue("updateLastName", "LAST NAME");
		issueCount += _validateEmail("updateEmailAddress", "EMAIL");
		issueCount += _validateEmptyValue("updatePhoneNumber", "PHONE NUMBER");
		issueCount += _validateEmptyValue("updateRoleId", "ROLE");
		issueCount += _validateEmptyValue("updateStatusId", "STATUS");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			firstName,
			lastName,
			emailAddress,
			phoneNumber,
			roleId,
			statusId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveUpdateStaffCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _updateStaff());
	}
}

//// /// Save Update Staff Callback /////
function _saveUpdateStaffCallback(formData) {
	let getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));

	///// get btn text/////
	const btnText = $("#updateBtn").html();
	_btnDisable("updateBtn", btnText, true);
	
	//// call endpoint //////
	_callRawEndPoints({
		url: `admin/staff/update-staff?staffId=${getEachStaffDetailsSession.staffId}`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				let getEachStaffDetailsSession =response?.data;
				sessionStorage.setItem("getEachStaffDetailsSession", JSON.stringify(getEachStaffDetailsSession));
                _showLoader("Please wait while we load the staff profile...");
				_getForm({page: 'staffProfile', url: adminPortalMiddlewareUrl});
				_getActivePage({page:'adminPage', divid:'adminPage'});

                setTimeout(() => {
                    _hideLoader();
                }, 2000); // adjust if needed
			},
			title: 'Success!',
			message: response.message,
			alertType: 'success',
			trueActionBtnText: 'OK, Thanks.',
		});
		_btnDisable("updateBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveUpdateStaffCallback(formData), error.message); // retry if needed
			_btnDisable("updateBtn", btnText, false);
		} else {
			_actionAlert(error.message, false);
			_btnDisable("updateBtn", btnText, false);
		}
    });
}