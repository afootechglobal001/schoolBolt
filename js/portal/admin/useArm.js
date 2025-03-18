function _fetchArms() {
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: endPoint + '/admin/settings/arms/fetch-arm',
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
							<th>Arm ID</th>
							<th>Arm Name</th>
							<th>Created By</th>
							<th>Updated By</th>
							<th>Date</th>
							<th>Status</th>
						</tr>
					</thead>`;

				if (info.success) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const armId = fetch[i].armId;
						const armName = fetch[i].armName;
						const createdBy = fetch[i].createdBy[0]?.fullname;
						const updatedBy = fetch[i].updatedBy[0]?.fullname;
						const createdTime = fetch[i].createdTime;
						const statusName = fetch[i].statusData[0].statusName;

						text +=`
						 	<tbody>
								<tr class="tb-row">
									<td>${no}</td>
									<td class="clickable-td" title="Click to view class profile" onclick="_fetchEachArm('${armId}');">${armId}</td>
									<td class="clickable-td">${armName}</td>
									<td>${createdBy}</td>
									<td>${updatedBy ? updatedBy : "NULL"}</td>
									<td>${createdTime}</td>
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

function _fetchEachArm(armId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/settings/arms/fetch-arm?armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachArmSession", JSON.stringify(info.data[0]));
					_getForm({page: 'update_arm', url: adminPortalLocalUrl});
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

function _createUpdateArm() {
	let getEachArmSession = JSON.parse(sessionStorage.getItem("getEachArmSession"));
	try {
		const armName = $('#armName').val();
		const statusId = $('#statusId').val();

		$('#armName, #statusId').removeClass('issue');

		if (!armName) {
			$('#armName').addClass('issue');
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
				"armName": armName,
				"statusId": statusId
			};

			let callUrl= getEachArmSession?.armId ? `${endPoint}/admin/settings/arms/update-arm?armId=${getEachArmSession.armId}` : `${endPoint}/admin/settings/arms/create-arm`;
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
					_getPage({page: 'arm_config', url: adminPortalLocalUrl});
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