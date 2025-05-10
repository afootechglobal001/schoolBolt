function addSegmentation() {
    const fieldId = `fees_${Date.now()}`;

    const template = `
        <div class="segmentBody">
            <div class="text_field_container" id="${fieldId}_container"></div>

            <div class="text_field_container">
                <input class="text_field" type="number" id="amount" placeholder=""/>
                <div class="placeholder">Amount (<s>N</s>):</div>
            </div>                            
        </div>
    `;
    $('.segmentList').append(template);

    // Create Select Field for Fees Category with dynamic fieldId
    selectField({
        id: fieldId,
        title: 'Select Fees Category'
    });

    // Populate Fees Options
    _getSelectFeesSettings(fieldId);
}





function _getSelectFeesOptions(fieldId){
	const data=[
		{
			'id': true,
			'value': 'TRUE',
		},
		{
			'id': false,
			'value': 'FALSE',
		},
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].id;
		const value = data[i].value;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}	
}


function _getSelectFeesSettings(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json",
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const data = info.data;
				const success = info.success;
				
				if (success === true) {
					for (let i = 0; i < data.length; i++) {
						const id = data[i].feesId;
						const value = data[i].feesName;
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


function _fetchFeesSettings() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");        
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				const fetch = info.data;
				const success = info.success;

				let text = '';
				let no=0;
				text =`
				<thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Fees Name</th>
                        <th>Fees Option</th>
                        <th>Updated By</th>
                        <th>Action</th>
                    </tr>
                </thead>`;

				if (success===true) {
					for (let i = 0; i < fetch.length; i++) {
						no++;
						const feesId = fetch[i].feesId;
						const feesName = fetch[i].feesName;
						const fetchedFeesOption = fetch[i].feesOption;
                        const NewFeesOption = (fetchedFeesOption === "TRUE") ? "MANDATORY" : "NOT MANDATORY";
	                    const feesOptionColor = (fetchedFeesOption === "TRUE") ? "green-color" : "orange-color";
                        const updatedBy = fetch[i].updatedBy?.fullname;

						text +=`
						<tbody>
							<tr class="tb-row">
                                <td>${no}</td>
                                <td>${feesName}</td>
                                <td class="${feesOptionColor}">${NewFeesOption}</td>
                                <td>${updatedBy ? updatedBy : "NULL"}</td>
                                <td><button class="btn view-btn" title="Click to edit fees" onclick="_fetchEachFeesSettings('${feesId}')">EDIT FEES</button></td>
                            </tr>
						</tbody>`;
					}
					$('#pageContent').html(text);
				} else {
					_actionAlert(info.message, false);
					text += `
						tbody>
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
										<div>
											<button class="btn" onclick="_getForm({page: 'branch_fees_reg', layer:2, url: adminPortalLocalUrl});"><i class="bi-plus-square"></i> ADD FEES</button>
										</div>
									</div>
								</td>
							</tr>
						</tbody>`;
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



function _fetchEachFeesSettings(feesId) {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}&feesId=${feesId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getEachEachFeesSettings", JSON.stringify(info.data[0]));
					_getForm({page: 'branch_fees_reg', layer:2, url: adminPortalLocalUrl});
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



function _createUpdateFeesSettings() {
      let getEachEachFeesSettings = JSON.parse(sessionStorage.getItem("getEachEachFeesSettings"));
	try {

		const feesName = $('#feesName').val();
		const feesOption = $('#feesOption').val();

		$('#feesName, #feesOption').removeClass('issue');

		if (!feesName) {
			$('#feesName').addClass('issue');
			_actionAlert('Provide fees name to continue', false);
			return;
		}

		if (!feesOption) {
			$('#feesOption').addClass('issue');
			_actionAlert('Select fees option to continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btnText = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = new FormData();
			formData.append("feesName", feesName);
			formData.append("feesOption", feesOption);

            let callUrl= getEachEachFeesSettings?.feesId ? `${endPoint}/admin/branch/fees/update-fees-settings?branchId=${getEachBranchDetailsSession.branchId}&feesId=${getEachEachFeesSettings?.feesId}` : `${endPoint}/admin/branch/fees/create-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`;

			$.ajax({
				type: "POST",
				url: callUrl,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (info) {
					const success = info.success;
					const message = info.message;

					if (success=== true) {
                        _actionAlert(message, true);
                        _getActiveBranchPage({divid:'branch_fees_page', page: 'branch_fees_page', url: adminPortalLocalUrl});
                        _alertClose(2);
				} else {
					_actionAlert(message, false);
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


function _fetchFeeComputeGeneral() {
    let getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    $('#pageContent').html('<div class="ajax-loader pages-ajax-loader"><img src="' + websiteUrl + '/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");

    try {
        $.ajax({
            type: "GET",
            url: `${endPoint}/admin/branch/fees/fetch-fees-compute-general?branchId=${getEachBranchDetailsSession.branchId}`,
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
                        const branchId = department.branchId;
						const departmentId = department.departmentData.departmentId;
                        const classData = department.classData;
                        const createdTime = department.createdTime;

                        text += `
                            <div class="pages-toggle-div">
                                <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="Click to view department">
                                    <h3>${departmentName}</h3>
                                    <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                                </div>

                                <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                                    <div class="table-div animated fadeIn">
                                        <table class="table" cellspacing="0" style="width:100%">
                                            <thead>
                                                <tr class="tb-col">
                                                    <th>sn</th>
                                                    <th>Department</th>
                                                    <th>Class</th>
                                                    <th>Total Payable Amount</th>
                                                    <th>Updated By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>   

                                            <tbody>`;

                                                let sn = 0; 
                                                if (classData.length > 0) {
                                                    for (let j = 0; j < classData.length; j++) {
                                                        sn++
                                                        const classInfo = classData[j];
                                                        const classId = classInfo.classId;
                                                        const className = classInfo.className;
                                                        const payableAmount = classInfo.payableAmount;
                                                        const updatedBy = classInfo.updatedBy?.fullname;

                                                        text += `
                                                        <tr class="tb-row">
                                                            <td>${sn}</td>
                                                            <td>${departmentName}</td>
                                                            <td>${className}</td>
                                                            <td><s>N</s>${payableAmount}</td>
                                                            <td>
                                                                <div class="text-div">
                                                                    <div class="bold-font">${updatedBy ? updatedBy : "NULL"}</div>
                                                                    <div>${createdTime}</div>
                                                                </div>
                                                            </td>
                                                            <td><button class="btn view-btn" title="Click to compute fees" onclick="_fetchEachFeeComputeGeneral('${branchId}','${departmentId}','${classId}');">COMPUTE FEES</button></td>
                                                        </tr>`;
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
                _actionAlert('An error occurred while fetching data! Please try again.', false);
            }
        });
    } catch (error) {
        console.error("Error: ", error);
        _actionAlert('An unexpected error occurred! Please try again.', false);
    }
}



function _fetchEachFeeComputeGeneral(branchId, departmentId, classId) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/fees/fetch-fees-compute?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}`,
			dataType: "json", 
			cache: false,   
			headers: getAuthHeaders(true),
			success: function(info) {
					sessionStorage.setItem("getEachFeeComputeGeneral", JSON.stringify(info));
					_getForm({page: 'branch_fees_computaion_form', layer:2, url: adminPortalLocalUrl});
				
					const response = info.response;
					if (response < 100) {
						_logOut();
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



function _createFeeCompute() {
      let getEachFeeComputeGeneral = JSON.parse(sessionStorage.getItem("getEachFeeComputeGeneral"));
	try {

		 const paymentSegment = [];
  // Get all segmentBody elements
  const segmentBodies = document.querySelectorAll('.segmentBody');
  segmentBodies.forEach(segmentBody => {
    // Get the purpose and amount values
    const fieldId = segmentBody.querySelector('#fieldId').value;
    const sub_amount = segmentBody.querySelector('#amount').value;
    if (fieldId && sub_amount) {
      // Add to paymentSegment if both purpose and amount are valid
      paymentSegment.push({
        fieldId: parseFloat(fieldId),
        sub_amount: parseFloat(sub_amount),
      });
    }
  });
  if (paymentSegment.length===0) {
    $('#fieldId').addClass("issue");
    _actionAlert('Provide payment purpose and amount to continue', false);
  return;
  }
		const amount = $('#amount').val();

		$('#feesId, #amount').removeClass('issue');

		if (!amount) {
			$('#amount').addClass('issue');
			_actionAlert('Provide fees amount continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btnText = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = new FormData();
			formData.append("paymentSegment", paymentSegment);
			formData.append("amount", amount);

			$.ajax({
				type: "POST",
				url: `${endPoint}/admin/branch/fees/create-fees-compute?branchId=${getEachFeeComputeGeneral.branchId}$departmentId=${getEachFeeComputeGeneral.departmentId}$classId=${getEachFeeComputeGeneral.classId}`,
				data: formData,
                dataType: "json",
				contentType: false,
				cache: false,
				processData: false,
				headers: getAuthHeaders(true),
				success: function (info) {
					const success = info.success;
					const message = info.message;

					if (success=== true) {
                        _actionAlert(message, true);
                        _getActiveBranchPage({divid:'branch_fees_computaion_page', page: 'branch_fees_computaion_page', url: adminPortalLocalUrl});
                        _alertClose(2);
				} else {
					_actionAlert(message, false);
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