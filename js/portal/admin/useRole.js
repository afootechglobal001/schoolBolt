function _userRoleCheck(){
	$('.switch input').on('change', function () {
		const label = $(this).next().next(); // Grab the toggle-label span
		label.text($(this).prop('checked') ? 'Yes' : 'No');
	});
}

function _fetchRolePermissions() {
	let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/preset-data/fetch-role-permissions?roleId=${getEachRoleDetails?.roleId ?? ''}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const { rolePermissionId, rolePermissionCategory, rolePermissionName, checked } = fetch[i];
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
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}

function _createUpdateRole() {
	let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	try {
		let selectedPermissions = [];
		$('.child:checked').each(function() {
			selectedPermissions.push({ rolePermissionId: $(this).data('value') });
		});

		const roleName = $('#roleName').val();
		const roleDescription = $('#roleDescription').val();

		$('#roleName, #roleDescription').removeClass('issue');

		if (!roleName) {
			$('#roleName').addClass('issue');
			_actionAlert('Provide role name to continue', false);
			return;
		}

		if (!roleDescription) {
			$('#roleDescription').addClass("issue");
			_actionAlert('Provide role description to continue', false);
			return;
		}

		const checked = $('input[name="rolePermissionId[]"]:checked').length;
		$("#rolePermissionId").removeClass("issue");

		if (checked < 1) {
			$("#rolePermissionId").addClass("issue");
			_actionAlert('Assign at least a role to continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"roleName": roleName,
				"roleDescription": roleDescription,
				rolePermissionIds: selectedPermissions
			};
			let callUrl= getEachRoleDetails?.roleId ? `${endPoint}/admin/settings/roles/update-role?roleId=${getEachRoleDetails.roleId}` : `${endPoint}/admin/settings/roles/create-role`;
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
					_alertClose();
					_getPage({page: 'user-role-configuration', url: adminPortalLocalUrl});
				} else {
					_actionAlert(data.message, false);
				}
				$("#submitBtn").html(btn_text).prop("disabled", false);
			},
				error: function (error) {
					_actionAlert('An error occurred while processing your request: ' + error, false);
					$("#submitBtn").html(btn_text).prop("disabled", false);
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		$("#submitBtn").prop("disabled", false);
	}
}

function _fetchRoles() {
    $('#fetchAllRoles').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/settings/roles/fetch-roles',
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;

				let text = '';
				if (info.success) {
					if (!fetch) {
						text += 
						'<div class="false-notification-div">' +
							"<p> " + info.message; + " </p>" +
						'</div>';
					} else {
						for (let i = 0; i < fetch.length; i++) {
							const roleId = fetch[i].roleId;
							const roleName = fetch[i].roleName;
							const userCount = fetch[i].userCount;
							const roleDescription = capitalizeFirstLetterOfEachWord(fetch[i].roleDescription);
							
							text +=`
								<div class="role-list-div" id="role_${roleId}" onclick="_fetchEachRoles('${roleId}')">
									<div class="div-in">
										<div class="icon-div"><i class="bi-shield-fill-check"></i></div>
										<div class="text-div">
											<h4>${roleName}</h4>
											<p>${roleDescription}</p>
										</div>
									</div>
									<div class="bottom-div">
										<div class="count-div"><i class="bi-person-circle"></i>&nbsp; <span>${userCount}</span> ACTIVE USER</div>
									</div>
								</div>
							`;  
						}
					}
					$('#fetchAllRoles').html(text);
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				$('#fetchAllRoles').html('<div class="false-notification-div"><p>An error occurred while fetching data. Please try again.</p></div>');
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		$('#fetchAllRoles').html('<div class="false-notification-div"><p>An unexpected error occurred. Please try again.</p></div>');
	}
}

function _fetchEachRoles(roleId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/roles/fetch-roles?roleId=${roleId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachRoleDetails", JSON.stringify(info.data[0]));
					_getForm({page: 'update_role', url: adminPortalLocalUrl});
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

function _deleteRole() {
	let getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
	try {
		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			_alertClose();
			$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
			const btn =$("#del_btn_"+ getEachRoleDetails.roleId);
			btn.html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating').prop('disabled', true);

			const formData = {
				"roleId": getEachRoleDetails.roleId
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/settings/roles/delete-role`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				success: function(info) {
					if (info.success) {
						$('#role_' + getEachRoleDetails.roleId).fadeOut(300);
						_actionAlert(info.message, true);
						_alertClose();
					} else {
						const response = info.response;
						_getForm('update_role');
						if (response < 100) {
							_logOut();
						}    
					}
				},
				error: function(textStatus, errorThrown) {
					_getForm({page: 'update_role', url: adminPortalLocalUrl});
					console.error("AJAX Error: ", textStatus, errorThrown);
					_actionAlert('An error occurred while fetching data. Please try again', false);
				}
			});
		}
	} catch (error) {
		_alertClose();
		_getForm({page: 'update_role', url: adminPortalLocalUrl});
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again', false);
	}
}