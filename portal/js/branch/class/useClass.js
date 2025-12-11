function _getSelectClassTeachers(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/staff/fetch-staff?branchId=${getEachBranchDetailsSession.branchId}&statusId=1`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const teacherFirstName = data[i].firstName
						const teacherLastName = data[i].lastName
						const id = data[i].staffId;
						const value = teacherFirstName + ' ' + teacherLastName;
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

function _fetchBranchDepartmentClass() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");

    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/admin/branch/department/fetch-branch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
            dataType: "json",
            cache: false,
            headers: getAuthHeaders(true),
            success: function(info) {
                const fetch = info.data;
                const success = info.success;
                
                let text = '';
                let no = 0;

                if (success === true) {
                    for (let i = 0; i < fetch.length; i++) {
                        no++;
                        const department = fetch[i];
                        const departmentName = department.departmentData.departmentName;
						const departmentId = department.departmentData.departmentId;
                        const classData = department.classData;

                        text += `
                            <div class="pages-toggle-div">
                                <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view class teachers">
                                    <h3>${departmentName}</h3>
                                    <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                                </div>

                                <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                                    <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                                        <span><i class="bi-people-fill"></i> <span>${departmentName}</span> CLASS TEACHERS</span>       
                                    </div>

                                    <div class="table-div animated fadeIn">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            <thead>
                                                <tr class="tb-col">
                                                    <th>sn</th>
                                                    <th>Department</th>
                                                    <th>Class</th>
                                                    <th>Teacher</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>`;

                        let sn = 0; 
                        if (classData.length > 0) {
                            for (let j = 0; j < classData.length; j++) {
                                const classInfo = classData[j];
                                const className = classInfo.className;
								const classId = classInfo.classId;
                                const armData = classInfo.armData;

                                if (armData.length > 0) {
                                    for (let k = 0; k < armData.length; k++) {
                                        sn++;
                                        const armInfo = armData[k];
                                        const arm = armInfo.armName;
										const armId = armInfo.armId;
                                        const teacherData = armInfo.teacherData;

                                        text += `
                                            <tr class="tb-row">
                                                <td>${sn}</td>
                                                <td>${departmentName}</td>
                                                <td>${className} ${arm}</td>`;

												if (teacherData && typeof teacherData) {
													const fullname = teacherData.fullname;
													const emailAddress = teacherData.emailAddress;
													const profilePix = teacherData.profilePix ? teacherData.profilePix : "default.jpg";

													text += `
														<td>
															<div class="text-back-div">
																<div class="image-div general-passport">
																	<img src="${websiteUrl}/uploaded_files/staffPix/${profilePix}" alt="${fullname}"/>
																</div>

																<div class="text-div">
																	<div class="first-class">${fullname}</div>
																	<div class="second-class">${emailAddress}</div>
																</div>
															</div>
														</td>`;
												} else {
													text += '<td>No Teacher Assigned</td>';
												}

												if (teacherData && typeof teacherData) {
													text += `
													<td>
													 	<div class="btn-div">
															<button class="btn view-btn decline-btn" title="Click to discharge class teacher" id="dischargeClassTeacherBtn_${departmentId}_${classId}_${armId}" onclick="_dischargeClassTeacher('${departmentId}','${classId}','${armId}');"><i class="bi-x-circle"></i> DISCHARGE</button>
														</div>
													</td>`;
												} else {
													text += `
													<td>
													 	<div class="btn-div">
															<button class="btn view-btn" title="Click to edit assign class teacher" onclick="_fetchClassTeacher('${departmentId}','${classId}','${armId}');"><i class="bi-bookmark-check"></i> ASSIGN</button>
														</div>
													</td>`;
												}
												`</tr>`;
                                    }
                                } else {
                                    sn++;
                                    text += `
                                        <tr class="tb-row">
                                            <td>${sn}</td>
                                            <td>${departmentName}</td>
                                            <td>${className} (No Arm)</td>
                                            <td colspan="2">No Teacher Assigned</td>
                                        </tr>`;
                                }
                            }
                        } 
                        text += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>`;
                    }
                    $('#pageContent').html(text);
                } else {
                    _actionAlert(info.message, false);
                    $('#pageContent').html(`
                        <tbody>
                            <tr>
                                <td colspan="15">
                                    <div class="false-notification-div">
                                        <p>${info.message}</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>`);

                    if (info.response < 100) {
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
        console.error("Error: ", error);
        _actionAlert('An unexpected error occurred! Please try again.', false);
    }
}

function _fetchClassTeacher(departmentId, classId, armId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/class/fetch-class-teacher?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success) {
					sessionStorage.setItem("getClassTeacherSession", JSON.stringify(info));
					_getForm({page: 'assign_staff', layer:2, url: adminPortalLocalUrl});
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

function addClassTeacher() {
	try {
		const staffId = $('#staffId').val();

		$('#staffId').removeClass('issue');

		if (!staffId) {
			$('#staffId').addClass('issue');
			_actionAlert('Select class teacher to continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"staffId": staffId
			};

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/branch/class/add-class-teacher?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${getClassTeacherSession.departmentData.departmentId}&classId=${getClassTeacherSession.classData.classId}&armId=${getClassTeacherSession.armData.armId}`,
				data: JSON.stringify(formData),
				dataType: "json", 
				cache: false,
				headers: getAuthHeaders(true),
				processData: false,
				success: function (data) {
				if (data.success) {
					_actionAlert(data.message, true);
					_getActiveBranchPage({divid:'branch_department_class', page: 'branch_department_class', url: adminPortalLocalUrl});
					_alertClose(2);
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

function _dischargeClassTeacher(departmentId, classId, armId) {
    try {
        if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {

            const btnSelector = `#dischargeClassTeacherBtn_${departmentId}_${classId}_${armId}`;
            const btn_text = $(btnSelector).html();

            $(btnSelector).html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
            $(btnSelector).prop("disabled", true);

            $.ajax({
                type: "POST",
                url: `${endPoint}/admin/branch/class/discharge-class-teacher?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
                dataType: "json",
                cache: false,
                headers: getAuthHeaders(true),
                processData: false,

                success: function (data) {
                    if (data.success) {
                        _actionAlert(data.message, true);
                        _getActiveBranchPage({
                            divid: 'branch_department_class',
                            page: 'branch_department_class',
                            url: adminPortalLocalUrl
                        });
                    } else {
                        _actionAlert(data.message, false);
                    }

                    $(btnSelector).html(btn_text).prop("disabled", false);
                },

                error: function (error) {
                    _actionAlert('An error occurred while processing your request! Please Try Again', false);
                    $(btnSelector).html(btn_text).prop("disabled", false);
                }
            });
        }
    } catch (error) {
        _alertClose();
        console.error("Error: ", error);
        _actionAlert('An unexpected error occurred! Please try again.', false);
    }
}
