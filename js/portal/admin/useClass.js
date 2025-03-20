function _fetchClasses() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/settings/classes/fetch-class',
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
							<th>Class ID</th>
							<th>Class Name</th>
							<th>Created By</th>
							<th>Updated By</th>
							<th>Date</th>
							<th>Arms</th>
							<th>Subjects</th>
							<th>Status</th>
						</tr>
					</thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const classId = fetch[i].classId;
						const className = fetch[i].className;
						const createdBy = fetch[i].createdBy[0]?.fullname;
						const updatedBy = fetch[i].updatedBy[0]?.fullname;
						const createdTime = fetch[i].createdTime;
						const statusName = fetch[i].statusData[0].statusName;
						const noOfArms = fetch[i].noOfArms;
						const noOfSubjects = fetch[i].noOfSubjects;
						
						text +=`
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view class profile" onclick="_fetchEachClass('${classId}');">${classId}</td>
									<td class="clickable-td">${className}</td>
									<td>${createdBy}</td>
									<td>${updatedBy ? updatedBy : "NULL"}</td>
									<td>${createdTime}</td>
									<td><button class="btn" title="Add arm to class" onclick="_fetchClassArms('${classId}');">${noOfArms}</button></td>
									<td><button class="btn" title="Add Subject to class" onclick="_fetchClassSubject('${classId}');">${noOfSubjects}</button></td>
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
								<button class="btn" onclick="_getForm({page: 'class_reg', url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD NEW CLASS</button>
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

function _fetchEachClass(classId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/classes/fetch-class?classId=${classId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachClassSession", JSON.stringify(info.data[0]));
					_getForm({page: 'update_class', url: adminPortalLocalUrl});
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

function _createUpdateClass() {
	let getEachClassSession = JSON.parse(sessionStorage.getItem("getEachClassSession"));
	try {
		const className = $('#className').val();
		const statusId = $('#statusId').val();

		$('#className, #statusId').removeClass('issue');

		if (!className) {
			$('#className').addClass('issue');
			_actionAlert('Provide Class name to continue', false);
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
				"className": className,
				"statusId": statusId
			};

			let callUrl= getEachClassSession?.classId ? `${endPoint}/admin/settings/classes/update-class?classId=${getEachClassSession.classId}` : `${endPoint}/admin/settings/classes/create-class`;
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
					_getPage({page: 'class_config', url: adminPortalLocalUrl});
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

function _fetchClassArms(classId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/classes/fetch-class-arms?classId=${classId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getClassArmSession", JSON.stringify(info));
					_getForm({page: 'add_class_arm', url: adminPortalLocalUrl});
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

function _fetchArmToggle() {
	let getClassArmSession = JSON.parse(sessionStorage.getItem("getClassArmSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/classes/fetch-class-arms?classId=${getClassArmSession?.classId ?? ''}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const armId = fetch[i].armId;
						const armName = fetch[i].armName;
						const checked = fetch[i].checked;
						const isChecked = checked ? 'checked' : '';

						const text = `
							<div class="each-toggle-div">
								<span>${armName}</span>
								<label for="class_${armId}" class="switch">
									<input type="checkbox" class="child" id="class_${armId}" name="armId[]" data-value="${armId}" ${isChecked}>
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

function createUpdateClassArm() {
	let getClassArmSession = JSON.parse(sessionStorage.getItem("getClassArmSession"));
	try {
		let selectedArms = [];

		$('.child:checked').each(function() {
			const armId = $(this).data('value');
			selectedArms.push({ armId: armId });
		});

		if (selectedArms.length === 0) {
			_actionAlert('Please select at least one arm to continue.', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				armIds: selectedArms
			};
			
			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/settings/classes/create-or-update-class-arms?classId=${getClassArmSession.classId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_alertClose();
					_getPage({page: 'class_config', url: adminPortalLocalUrl});
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

function _fetchClassSubject(classId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/classes/fetch-class-subjects?classId=${classId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getClassSubjectSession", JSON.stringify(info));
					_getForm({page: 'add_class_subjects', url: adminPortalLocalUrl});
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

function _fetchSubjectToggle() {
	let getClassSubjectSession = JSON.parse(sessionStorage.getItem("getClassSubjectSession"));
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/classes/fetch-class-subjects?classId=${getClassSubjectSession?.classId ?? ''}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const subjectId = fetch[i].subjectId;
						const subjectName = fetch[i].subjectName;
						const checked = fetch[i].checked;
						const isChecked = checked ? 'checked' : '';

						const text = `
							<div class="each-toggle-div">
								<span>${subjectName}</span>
								<label for="class_${subjectId}" class="switch">
									<input type="checkbox" class="child" id="class_${subjectId}" name="subjectId[]" data-value="${subjectId}" ${isChecked}>
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

function createUpdateClassSubject() {
	let getClassSubjectSession = JSON.parse(sessionStorage.getItem("getClassSubjectSession"));
	try {
		let selectedSubject = [];

		$('.child:checked').each(function() {
			const subjectId = $(this).data('value');
			selectedSubject.push({ subjectId: subjectId });
		});

		if (selectedSubject.length === 0) {
			_actionAlert('Please select at least one arm to continue.', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn2").html();
			$("#submitBtn2").html('<img src="' + websiteUrl + '/all-images/images/loading.gif" width="12px" alt="Loading"/> Authenticating');
			$("#submitBtn2").prop("disabled", true);

			const formData = {
				subjectIds: selectedSubject
			};
			
			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/settings/classes/create-or-update-class-subjects?classId=${getClassSubjectSession.classId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_alertClose();
					_getPage({page: 'class_config', url: adminPortalLocalUrl});
				} else {
					_actionAlert(data.message, false);
				}
				$("#submitBtn2").html(btn_text).prop("disabled", false);
			},
				error: function (error) {
					_actionAlert('An error occurred while processing your request: ' + error, false);
					$("#submitBtn2").html(btn_text).prop("disabled", false);
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		$("#submitBtn2").prop("disabled", false);
	}
}