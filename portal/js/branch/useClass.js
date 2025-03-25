function _getSelectClassTeachers(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint+"/admin/staff/fetch-staff?statusId=1",
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
            url: `${endPoint}/admin/branch/fetch-branch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
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

                                        <div class="btn-container">
                                            <button class="btn" title="PRINT RECORDS" onclick=""><i class="bi-printer"></i> PRINT</button>
                                            <button class="btn" title="EXPORT RECORDS" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
                                        </div>
                                    </div>

                                    <div class="table-div animated fadeIn">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            <thead>
                                                <tr class="tb-col">
                                                    <th>sn</th>
                                                    <th>Department</th>
                                                    <th>Level</th>
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
										const armData = classInfo.armData;

										if (armData.length > 0) {
											for (let k = 0; k < armData.length; k++) {
												sn++;
												const arm = armData[k];

												text += `
													<tr class="tb-row">
														<td>${sn}</td>
														<td>${departmentName}</td>
														<td>${className} ${arm.armName}</td>
														<td>
															<div class="text-back-div">
																<div class="image-div general-passport">
																	<img src="${websiteUrl}/uploaded_files/staffPix/teacher3.png" alt="MR AHMED ODELAKIN"/>
																</div>

																<div class="text-div">
																	<div class="first-class">MR AHMED ODELAKIN</div>
																	<div class="second-class">ahmedolumide20@gmail.com</div>
																</div>
															</div>
														</td>
														<td><button class="btn view-btn" title="Click to edit assign class teacher" onclick="_getForm({page: 'assign_staff', layer:2, url: adminPortalLocalUrl});"><i class="bi-bookmark-check"></i> ASSIGN</button></td>
													</tr>`;
											}
										} else {
											sn++;
											text += `
												<tr class="tb-row">
													<td>${sn}</td>
													<td>${departmentName}</td>
													<td>${className} (No Arm)</td>
													<td>
														<div class="text-back-div">
															<div class="image-div general-passport">
																<img src="${websiteUrl}/uploaded_files/staffPix/teacher3.png" alt="MR AHMED ODELAKIN"/>
															</div>

															<div class="text-div">
																<div class="first-class">MR AHMED ODELAKIN</div>
																<div class="second-class">ahmedolumide20@gmail.com</div>
															</div>
														</div>
													</td>
													<td></td>
												</tr>`;
										}
									}
								} 
								text += `
											</tbody>
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
                _actionAlert('An error occurred while fetching data! Please try again.', false);
            }
        });
    } catch (error) {
        console.error("Error: ", error);
        _actionAlert('An unexpected error occurred! Please try again.', false);
    }
}
