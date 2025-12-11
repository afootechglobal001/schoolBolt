function _fetchTeachersComment(genderId) {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/admin/branch/settings/teachers-comment/fetch-class-teachers-comment?branchId=${getEachBranchDetailsSession?.branchId}&genderId=${genderId}`,
            dataType: "json",
            cache: false,
            headers: getAuthHeaders(true),
            success: function (info) {
                const fetch = info.data;

                let content = "";
                let no = 0;
                if (info.success===true) {
                    for (let i = 0; i < fetch.length; i++) {
                        no++;
                        const fetchedData = fetch[i];

                        content += `
                            <tr class="tb-row">
                                <td>${no}</td>
                                <td class="clickable-td" title="Click to edit comment" onclick="_setActiveGender('${fetchedData.genderId}'); _fetchEachComment('${fetchedData.branchId}', '${fetchedData.genderId}','${fetchedData.commentId}',);"><span>${fetchedData?.genderData?.genderName}</span></td>
                                <td>${fetchedData.comment}</td>
                                <td>
                                    <div class="text-div">
                                        <div>${fetchedData?.createdBy?.fullname}</div> 
                                        <div>${fetchedData?.createdBy?.emailAddress}</div>
                                    </div>
                                </td>
                                <td>${fetchedData.createdTime}</td>
                                <td><div class="status-div ${fetchedData?.statusData?.statusName}">${fetchedData?.statusData?.statusName}</div></td>
                                <td><button class="btn view-btn" title="Click to edit comment" onclick="_setActiveGender('${fetchedData.genderId}'); _fetchEachComment('${fetchedData.branchId}', '${fetchedData.genderId}','${fetchedData.commentId}',);">VIEW</button></td>
                            </tr>
                        `;
                    }
                    $("#pageContent").html(content);
                    
                } else {
                    content += `
                        <tr>
                            <td colspan="20">
                            <div class="false-notification-div">
                                <p>${info.message}</p>
                                </div>
                            </td>
                        </tr>`;
                    $("#pageContent").html(content);

                    const response = info.response;
                    if (response < 100) {
                        _logOut();
                    }
                }
            },
            error: function(textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
                $('#pageContent').html('<div class="false-notification-div"><p>An error occurred while fetching data. Please try again.</p></div>');
            }
        });
    } catch (error) {
        console.error("Error: ", error);
        $('#pageContent').html('<div class="false-notification-div"><p>An unexpected error occurred. Please try again.</p></div>');
    }
}

function _setActiveGender(gender) {
    sessionStorage.setItem("activeGender", gender);
}

function _fetchEachComment(branchId, genderId, commentId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/settings/teachers-comment/fetch-class-teachers-comment?branchId=${branchId}&genderId=${genderId}&commentId=${commentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachTeachersCommentSession", JSON.stringify(info.data[0]));
					_getForm({page: 'commentRegForm', layer: 2,  url: adminPortalLocalUrl});
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

function _createClassTeachersComment(genderId) {
    let getEachTeachersCommentSession = JSON.parse(sessionStorage.getItem("getEachTeachersCommentSession"));
    try {
        let issueCount = 0;

        const comment = $("#comment").val();
        const statusId = $("#statusId").val();

        $("#comment, #statusId").removeClass("issue");
        $("#issue_comment, #issue_statusId").html("");
        
        if (!comment) {
            $('#comment').addClass('issue');
            $('#issue_comment').html('Provide Comment To Continue');
            issueCount++;
        }

        if (!statusId) {
            $('#statusId').addClass('issue');
            $('#issue_statusId').html('Select Status To Continue');
            issueCount++;
        }

        if (issueCount > 0) {
            return;
        }

        if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btnText = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				genderId: genderId,
				comment: comment,
				statusId: statusId,
			};

            let callUrl= getEachTeachersCommentSession?.commentId ? `${endPoint}/admin/branch/settings/teachers-comment/update-class-teachers-comment?branchId=${getEachTeachersCommentSession?.branchId}&commentId=${getEachTeachersCommentSession?.commentId}` : `${endPoint}/admin/branch/settings/teachers-comment/create-class-teachers-comment?branchId=${getEachBranchDetailsSession?.branchId}`;

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
                    _alertClose(2);
					_fetchTeachersComment(genderId);
				} else {
					_actionAlert(data.message, false);
				}
				$("#submitBtn").html(btnText).prop("disabled", false);
			},
				error: function (error) {
					_actionAlert('An error occurred while processing your request! Please Try Again', false);
					$("#submitBtn").html(btnText).prop("disabled", false);
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred! Please Try Again', false);
		$("#submitBtn").prop("disabled", false);
    }
}