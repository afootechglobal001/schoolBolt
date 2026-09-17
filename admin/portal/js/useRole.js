//// User Role Check /////
function _userRoleCheck(){
	$('.switch input').on('change', function () {
		const label = $(this).next().next(); // Grab the toggle-label span
		label.text($(this).prop('checked') ? 'Yes' : 'No');
	});
}

//// Fetch Role Permissions /////
function _fetchRolePermissions() {
	let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	try {
		_callFetchEndPoints({
		url: `preset-data/fetch-role-permissions?roleId=${getEachRoleDetails?.roleId ?? ''}`,
		accessKey: true,
		})
		.then((response) => {
			_initFetchRolePermissions(response.data);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError();
	}
}

//// Initialize Fetch Role Permissions /////
function _initFetchRolePermissions(data) {
	for (let i = 0; i < data.length; i++) {
		const { rolePermissionId, rolePermissionCategory, rolePermissionName, checked } = data[i];
		const inputType = rolePermissionCategory === 'dashboard' ? 'radio' : 'checkbox';
		const isChecked = checked ? 'checked' : '';

		const permissionHtml = `
			<div class="each-toggle-div">
				<span>${rolePermissionName} (${rolePermissionId})</span>
				<label for="role_${rolePermissionId}" class="switch">
					<input type="${inputType}" class="child" id="role_${rolePermissionId}" name="rolePermissionId[]" data-value="${rolePermissionId}" ${isChecked}>
					<span class="slider"></span>
					<span class="toggle-label">No</span>
				</label>
			</div>`;

		$('#' + rolePermissionCategory).append(permissionHtml);
	}
	_userRoleCheck();
}

///// Create or Update Role /////
function _createUpdateRole(){
	let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	try {
		////////get all needed values////////////
		let issueCount = 0;
		let selectedPermissions = [];
		$('.child:checked').each(function() {
			selectedPermissions.push({ rolePermissionId: $(this).data('value') });
		});

		const roleName = $('#roleName').val();
		const roleDescription = $('#roleDescription').val();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("roleName", "ROLE NAME");
		issueCount += _validateEmptyValue("roleDescription", "ROLE DESCRIPTION");

		const checked = $('input[name="rolePermissionId[]"]:checked').length;
		$("#rolePermissionId").removeClass("issue");

		if (checked < 1) {
			$("#rolePermissionId").addClass("issue");
			_actionAlert('Assign at least a role to continue', false);
			return;
		}

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			roleId: getEachRoleDetails?.roleId,
			roleName,
			roleDescription,
			rolePermissionIds:selectedPermissions,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveCreateUpdateRoleCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createUpdateRole());
	}
}

///// Save Create or Update Role Callback /////
function _saveCreateUpdateRoleCallback(formData) {
    let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
    let callUrl= getEachRoleDetails?.roleId ? `admin/settings/roles/update-role` : `admin/settings/roles/create-role`;

	//// call endpoint //////
	_callRawEndPoints({
		url: callUrl,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				_alertClose();
				_getPage({page: 'userConfiguration', url: adminPortalMiddlewareUrl});
			},
			title: 'Success!',
			message: response.message,
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
			_callAjaxError(() => _saveCreateUpdateRoleCallback(formData), error.message); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_actionAlert(error.message, false);
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

///// Fetch Roles Data /////
function _fetchRolesData() {
  try {
    _callFetchEndPoints({
      url: `admin/settings/roles/fetch-roles`,
      accessKey: true,
    })
	.then((response) => {
		_initFetchRolesData(response.data);
	})
	.catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_showEmptyState({
				container: "rolesContent",
				message: "Check your internet connection and try again",
			});
			_callAjaxError(() => _fetchRolesData(), error.message);
		} else {
			showFalseNotification({
				container: "rolesContent",
				message: error.message,
				button: `
					<button class="btn" title="ADD NEW ROLE" onclick="sessionStorage.removeItem('getEachRoleDetails'); _getForm({page: 'roleReg', url: adminPortalMiddlewareUrl});">
						<i class="bi-plus-square"></i> ADD NEW ROLE
					</button>
				`,
			});
		}
	});
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _fetchRolesData());
  }
}

///// Initialize Fetch Roles Data /////
function _initFetchRolesData(data) {
   const content = data.map((item) => `
	  	<div class="role-list-div" id="role_${item.roleId}" onclick="_fetchEachRoles('${item.roleId}')">
			<div class="div-in">
				<div class="icon-div"><i class="bi-shield-fill-check"></i></div>
				<div class="text-div">
					<h4>${item.roleName}</h4>
					<p>${item.roleDescription}</p>
				</div>
			</div>
			<div class="bottom-div">
				<div class="count-div"><i class="bi-person-circle"></i>&nbsp; <span>${item.userCount}</span> ACTIVE USER</div>
			</div>
		</div>`
    )
    .join("");
	$("#rolesContent").html(content)
}

///// Fetch Each Role Details /////
function _fetchEachRoles(roleId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/settings/roles/fetch-roles?roleId=${roleId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("getEachRoleDetails", JSON.stringify(response?.data[0]));
			_getForm({page: 'updateRole', url: adminPortalMiddlewareUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachRoles(roleId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachRoles(roleId));
  	}
}

//// /// Delete Role /////
function _deleteRole(roleId){
	try {
		// Gather form data
		const formData = {
			roleId: roleId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveDeleteRoleCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to delete? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _deleteRole(roleId));
	}
}

///// Save Delete Role Callback /////
function _saveDeleteRoleCallback(formData) {
	///// get btn text/////
	_alertClose();
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);

	const btnText = $("#del_btn_"+ formData.roleId).html();
	_btnDisable("del_btn_" + formData.roleId, btnText, true);
	
	//// call endpoint //////
	_callRawEndPoints({
		url: `admin/settings/roles/delete-role`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				$('#role_' + formData.roleId).fadeOut(300);
				_alertClose();
			},
			title: 'Success!',
			message: response.message,
			alertType: 'success',
			trueActionBtnText: 'OK, Thanks.',
			closeOnOverlayClick: false,
		});
		_btnDisable("del_btn_"+ formData.roleId, btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveDeleteRoleCallback(formData), error.message); // retry if needed
			_getForm('updateRole');
			_btnDisable("del_btn_"+ formData.roleId, btnText, false);
		} else {
			_actionAlert(error.message, false);
			_getForm('updateRole');
			_btnDisable("del_btn_"+ formData.roleId, btnText, false);
		}
    });
}

/// filter Role ///
function _filtersRoles(value) {
  $("#rolesContent .role-list-div").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}