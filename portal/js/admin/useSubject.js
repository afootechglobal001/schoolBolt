function _fetchSubjects() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/settings/subjects/fetch-subject',
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
							<th>Subject ID</th>
							<th>Subject Name</th>
							<th>Created By</th>
							<th>Updated By</th>
							<th>Date</th>
							<th>Status</th>
							<th>View</th>
						</tr>
					</thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const subjectId = fetch[i].subjectId;
						const subjectName = fetch[i].subjectName;
						const createdBy = fetch[i].createdBy[0]?.fullname;
						const updatedBy = fetch[i].updatedBy[0]?.fullname;
						const createdTime = fetch[i].createdTime;
						const statusName = fetch[i].statusData[0].statusName;

						text +=`
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view department profile" onclick="_fetchEachSubject('${subjectId}');">${subjectId}</td>
									<td class="clickable-td">${subjectName}</td>
									<td>${createdBy}</td>
									<td>${updatedBy ? updatedBy : "NULL"}</td>
									<td>${createdTime}</td>
									<td><div class="status-div ${statusName}">${statusName}</div></td>
									<td><button class="btn view-btn" title="Click view to edit subject" onclick="_fetchEachSubject('${subjectId}');">VIEW</button></td>
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

function _fetchEachSubject(subjectId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/subjects/fetch-subject?subjectId=${subjectId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachSubjectSession", JSON.stringify(info.data[0]));
					_getForm({page: 'update_subject', url: adminPortalLocalUrl});
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

function _createUpdateSubject() {
	let getEachSubjectSession = JSON.parse(sessionStorage.getItem("getEachSubjectSession"));
	try {
		const subjectName = $('#subjectName').val();
		const statusId = $('#statusId').val();

		$('#subjectName, #statusId').removeClass('issue');

		if (!subjectName) {
			$('#subjectName').addClass('issue');
			_actionAlert('Provide subject name to continue', false);
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
				"subjectName": subjectName,
				"statusId": statusId
			};

			let callUrl= getEachSubjectSession?.subjectId ? `${endPoint}/admin/settings/subjects/update-subject?subjectId=${getEachSubjectSession.subjectId}` : `${endPoint}/admin/settings/subjects/create-subject`;
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
					_getPage({page: 'subject_config', url: adminPortalLocalUrl});
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