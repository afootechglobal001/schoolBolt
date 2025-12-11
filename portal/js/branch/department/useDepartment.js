function _fetchDepartmentToggle() {
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/departments/fetch-department`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const departmentId = fetch[i].departmentId;
						const departmentName = fetch[i].departmentName;
						
						const text = `
							<div class="each-toggle-div">
								<span>${departmentName}</span>
								<label for="class_${departmentId}" class="switch">
									<input type="checkbox" class="child" id="class_${departmentId}" name="departmentId[]" data-value="${departmentId}">
									<span class="slider"></span>
									<span class="toggle-label">No</span>
								</label>
							</div>`;
						$('#pageContentToggle').append(text);
					}
					_toggleCheck();
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

function _fetchEachDepartmentToggle() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession")); 
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession?.branchId ?? ''}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const departmentId = fetch[i].departmentId;
						const departmentName = fetch[i].departmentName;
						const checked = fetch[i].checked;
						const isChecked = checked ? 'checked' : '';
						
						const text = `
							<div class="each-toggle-div">
								<span>${departmentName}</span>
								<label for="class_${departmentId}" class="switch">
									<input type="checkbox" class="child" id="class_${departmentId}" name="departmentId[]" data-value="${departmentId}" ${isChecked}>
									<span class="slider"></span>
									<span class="toggle-label">No</span>
								</label>
							</div>`;
						$('#eachPageContentToggle').append(text);
					}
					_toggleCheck();
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

function _fetchBranchDepartment() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/department/fetch-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getBranchDepartmentSession", JSON.stringify(info));
					_getForm({page: 'edit_branch_department', layer:2, url: adminPortalLocalUrl});
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
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function updateBranchDepartment() {
	let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	try {
		
		let selectedDepartment = [];

		$('.child:checked').each(function() {
			const departmentId = $(this).data('value');
			selectedDepartment.push({ departmentId: departmentId });
		});

		if (selectedDepartment.length === 0) {
			_actionAlert('Please select at least one department to continue.', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				departmentIds: selectedDepartment,
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/branch/department/update-branch-departments?branchId=${getEachBranchDetailsSession.branchId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (info) {
				if (info.success) {
					let getBranchDepartmentSession =info.data;
					sessionStorage.setItem("getBranchDepartmentSession", JSON.stringify(getBranchDepartmentSession));

					_actionAlert(info.message, true);
					_fetchBranchDepartment();
				} else {
					_actionAlert(info.message, false);
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