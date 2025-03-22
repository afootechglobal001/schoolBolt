function _fetchDepartments() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/settings/departments/fetch-department',
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
							<th>Department ID</th>
							<th>Department Name</th>
							<th>Created By</th>
							<th>Updated By</th>
							<th>Date</th>
							<th>Class</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const departmentId = fetch[i].departmentId;
						const departmentName = fetch[i].departmentName;
						const createdBy = fetch[i].createdBy[0]?.fullname;
						const updatedBy = fetch[i].updatedBy[0]?.fullname;
						const createdTime = fetch[i].createdTime;
						const statusName = fetch[i].statusData[0].statusName;
						const noOfClasses = fetch[i].noOfClasses;

						text +=`
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view department profile" onclick="_fetchEachDepartment('${departmentId}');">${departmentId}</td>
									<td class="clickable-td">${departmentName}</td>
									<td>${createdBy}</td>
									<td>${updatedBy ? updatedBy : "NULL"}</td>
									<td>${createdTime}</td>
									<td><button class="btn" title="Add Classes to department" onclick="_fetchDepartmentClass('${departmentId}');">${noOfClasses}</button></td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
									<td><button class="btn view-btn" title="Click to view department profile" onclick="_fetchEachDepartment('${departmentId}');">VIEW</button></td>
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
								<button class="btn" onclick="_getForm({page: 'department_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW DEPARTMENT</button>
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

function _fetchEachDepartment(departmentId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/departments/fetch-department?departmentId=${departmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachDepartmentSession", JSON.stringify(info.data[0]));
					_getForm({page: 'update_department', url: adminPortalLocalUrl});
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

function _createUpdateDepartment() {
	let getEachDepartmentSession = JSON.parse(sessionStorage.getItem("getEachDepartmentSession"));
	try {
		const departmentName = $('#departmentName').val();
		const statusId = $('#statusId').val();

		$('#departmentName, #statusId').removeClass('issue');

		if (!departmentName) {
			$('#departmentName').addClass('issue');
			_actionAlert('Provide department name to continue', false);
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
				"departmentName": departmentName,
				"statusId": statusId
			};

			let callUrl= getEachDepartmentSession?.departmentId ? `${endPoint}/admin/settings/departments/update-department?departmentId=${getEachDepartmentSession.departmentId}` : `${endPoint}/admin/settings/departments/create-department`;
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
					_getPage({page: 'department_config', url: adminPortalLocalUrl});
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


function _fetchDepartmentClass(departmentId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/departments/fetch-department-classes?departmentId=${departmentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getDepartmentClassSession", JSON.stringify(info));
					_getForm({page: 'add_classes', url: adminPortalLocalUrl});
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

function _fetchClassesToggle() {
	let getDepartmentClassSession = JSON.parse(sessionStorage.getItem("getDepartmentClassSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/departments/fetch-department-classes?departmentId=${getDepartmentClassSession?.departmentId ?? ''}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const classId = fetch[i].classId;
						const className = fetch[i].className;
						const checked = fetch[i].checked;
						const isChecked = checked ? 'checked' : '';

						const text = `
							<div class="each-toggle-div">
								<span>${className}</span>
								<label for="class_${classId}" class="switch">
									<input type="checkbox" class="child" id="class_${classId}" name="classId[]" data-value="${classId}" ${isChecked}>
									<span class="slider"></span>
									<span class="toggle-label">No</span>
								</label>
							</div>`;
						$('#pageContent').append(text);
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

function createUpdateDepartmentClass() {
	let getDepartmentClassSession = JSON.parse(sessionStorage.getItem("getDepartmentClassSession"));
	try {
		let selectedClasses = [];

		$('.child:checked').each(function() {
			const classId = $(this).data('value');
			selectedClasses.push({ classId: classId });
		});

		if (selectedClasses.length === 0) {
			_actionAlert('Please select at least one class.', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				classIds: selectedClasses
			};
			
			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/settings/departments/create-or-update-department-classes?departmentId=${getDepartmentClassSession.departmentId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_alertClose();
					_getPage({page: 'department_config', url: adminPortalLocalUrl});
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