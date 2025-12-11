function _getSelectFeesOptions(fieldId) {
  const data = [
    {
      id: true,
      value: "TRUE",
    },
    {
      id: false,
      value: "FALSE",
    },
  ];

  for (let i = 0; i < data.length; i++) {
    const id = data[i].id;
    const value = data[i].value;
    $("#searchList_" + fieldId).append(
      "<li onclick=\"_clickOption('searchList_" +
        fieldId +
        "', '" +
        id +
        "', '" +
        value +
        "')\">" +
        value +
        "</li>"
    );
  }
}

function _getSelectFeesSettings(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].feesId;
            const value = data[i].feesName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchFeesSettings() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>'
    )
    .fadeIn("fast");
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;

        let text = "";
        let no = 0;
        text = `
				<thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Fees Name</th>
                        <th>Fees Option</th>
                        <th>Updated By</th>
                        <th>Action</th>
                    </tr>
                </thead>`;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const feesId = fetch[i].feesId;
            const feesName = fetch[i].feesName;
            const fetchedFeesOption = fetch[i].feesOption;
            const NewFeesOption =
              fetchedFeesOption === "TRUE" ? "MANDATORY" : "NOT MANDATORY";
            const feesOptionColor =
              fetchedFeesOption === "TRUE" ? "green-color" : "orange-color";
            const updatedBy = fetch[i].updatedBy?.fullname;

            text += `
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
          $("#pageContent").html(text);
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
          $("#pageContent").html(text);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _fetchEachFeesSettings(feesId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  $("#get-form-more-div")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fees/fetch-fees-settings?branchId=${getEachBranchDetailsSession.branchId}&feesId=${feesId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success && info.data.length > 0) {
          sessionStorage.setItem(
            "getEachEachFeesSettings",
            JSON.stringify(info.data[0])
          );
          _getForm({
            page: "branch_fees_reg",
            layer: 2,
            url: adminPortalLocalUrl,
          });
        } else {
          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _createUpdateFeesSettings() {
  let getEachEachFeesSettings = JSON.parse(
    sessionStorage.getItem("getEachEachFeesSettings")
  );
  try {
    const feesName = $("#feesName").val();
    const feesOption = $("#feesOption").val();

    $("#feesName, #feesOption").removeClass("issue");

    if (!feesName) {
      $("#feesName").addClass("issue");
      _actionAlert("Provide fees name to continue", false);
      return;
    }

    if (!feesOption) {
      $("#feesOption").addClass("issue");
      _actionAlert("Select fees option to continue", false);
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnText = $("#submitBtn").html();
      $("#submitBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#submitBtn").prop("disabled", true);

      const formData = new FormData();
      formData.append("feesName", feesName);
      formData.append("feesOption", feesOption);

      let callUrl = getEachEachFeesSettings?.feesId
        ? `${endPoint}/admin/branch/fees/update-fees-settings?branchId=${getEachBranchDetailsSession.branchId}&feesId=${getEachEachFeesSettings?.feesId}`
        : `${endPoint}/admin/branch/fees/create-fees-settings?branchId=${getEachBranchDetailsSession.branchId}`;

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

          if (success === true) {
            _actionAlert(message, true);
            _getActiveBranchPage({
              divid: "branch_fees_page",
              page: "branch_fees_page",
              url: adminPortalLocalUrl,
            });
            _alertClose(2);
          } else {
            _actionAlert(message, false);
          }
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#submitBtn").prop("disabled", false);
  }
}

function _fetchFeeComputeGeneral() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );
  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>'
    )
    .fadeIn("fast");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fees/fetch-fees-compute-general?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const fetchBranchData = info.branchData;
        const success = info.success;

        const currentSession = fetchBranchData.currentSession;
        const currentTerm = fetchBranchData.termData.currentTerm;
        const termId = fetchBranchData.termData.termId;

        let text = "";
        let no = 0;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const department = fetch[i];
            const departmentName = department.departmentData.departmentName;
            const branchId = department.branchId;
            const departmentId = department.departmentData.departmentId;
            const classData = department.classData;

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
                                                    <th>Session</th>
													<th>Term</th>
													<th>Department</th>
                                                    <th>Class</th>
                                                    <th>Total Payable Amount</th>
													<th>Status</th>
                                                    <th>Updated By</th>
													<th>Approved By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>   

                                            <tbody>`;

            let sn = 0;
            if (classData.length > 0) {
              for (let j = 0; j < classData.length; j++) {
                sn++;
                const classInfo = classData[j];
                const classId = classInfo.classId;
                const className = classInfo.className;
                const payableAmount = classInfo?.feesSummaryData?.payableAmount;
                const formattedAmount = payableAmount
                  ? thousandSeperator(payableAmount)
                  : "00:00";
                const statusName = classInfo.statusData.statusName;
                const updatedBy = classInfo?.updatedBy?.fullname;
                const updatedTime = classInfo?.feesSummaryData?.updatedTime;
                const approvedBy = classInfo?.approvedBy?.fullname;
                const approvedTime = classInfo?.feesSummaryData?.approvedTime;
                const feesSummaryData = classInfo?.feesSummaryData;
                const feeStatus = classInfo?.feesSummaryData?.statusId;
                const fcId = classInfo?.feesSummaryData?.fcId;

                text += `
                                                        <tr class="tb-row">
                                                            <td>${sn}</td>
															<td>${currentSession}</td>
															<td>${currentTerm}</td>
                                                            <td>${departmentName}</td>
                                                            <td>${className}</td>
                                                           	<td><s>N</s>${formattedAmount}</td>
															<td>${statusName}</td>
                                                            <td>
                                                                <div class="text-div">
                                                                    <div class="bold-font">${
                                                                      updatedBy
                                                                        ? updatedBy
                                                                        : "NULL"
                                                                    }</div>
                                                                    <div>${
                                                                      updatedTime
                                                                        ? updatedTime
                                                                        : "NULL"
                                                                    }</div>
                                                                </div>
                                                            </td>
															<td>
                                                                <div class="text-div">
                                                                    <div class="bold-font">${
                                                                      approvedBy
                                                                        ? approvedBy
                                                                        : "NULL"
                                                                    }</div>
                                                                    <div>${
                                                                      approvedTime
                                                                        ? approvedTime
                                                                        : "NULL"
                                                                    }</div>
                                                                </div>
                                                            </td>`;

                if (
                  !feesSummaryData ||
                  feesSummaryData === "null" ||
                  feesSummaryData === "NULL"
                ) {
                  text += `
                        <td>
                          <div class="btn-div">
                            <button class="btn view-btn" title="Click to compute fees" onclick="_fetchEachFeeComputeGeneral('${branchId}','${departmentId}','${classId}','${currentSession}','${termId}');">COMPUTE FEES</button>
                          </div>
                        </td>`;
                } else if (feeStatus === "8" || feeStatus === "10") {
                  let approveBtn = "";
                  if (userRoles.canApproveFees) {
                    approveBtn = `<button class="btn view-btn approve-btn"  title="Click to approve fees" id="approveBtn_${fcId}"  onclick="_approveFeesCompute('${fcId}');"> APPROVE FEES </button>`;
                  }
                  text += `
                          <td>
                            <div class="btn-div">
                              <button class="btn view-btn print-btn" title="Click to print fees" id="printFeesBtn_${classId}" onclick="_printComputeFee('${branchId}','${departmentId}','${classId}','${currentSession}','${termId}');">PRINT FEES</button>
                              <button class="btn view-btn" title="Click to compute fees" onclick="_fetchEachFeeComputeGeneral('${branchId}','${departmentId}','${classId}','${currentSession}','${termId}');">COMPUTE FEES</button>
                              ${approveBtn}
                            </div>
                          </td>`;
                } else {
                  let declineBtn = "";
                  if (userRoles.canApproveFees) {
                    declineBtn = `<button class="btn view-btn decline-btn" title="Click to decline fees" id="declineBtn_${fcId}" onclick="_declineFeesCompute('${fcId}');">DECLINE FEES</button>`;
                  }
                  text += `
                        <td>
                          <div class="btn-div">
                            <button class="btn view-btn print-btn" title="Click to print fees" id="printFeesBtn_${classId}" onclick="_printComputeFee('${branchId}','${departmentId}','${classId}','${currentSession}','${termId}');">PRINT FEES</button>
                          ${declineBtn}
                          </div>
                        </td>`;
                }
                text += `</tr>`;
              }
            }
            text += `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);
          $("#pageContent").html(`
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
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _fetchEachFeeComputeGeneral(
  branchId,
  departmentId,
  classId,
  session,
  termId
) {
  $("#get-form-more-div")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/fees/fetch-fees-compute?branchId=${branchId}&departmentId=${departmentId}&classId=${classId}&session=${session}&termId=${termId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        sessionStorage.setItem(
          "getEachFeeComputeGeneral",
          JSON.stringify(info)
        );
        _getForm({
          page: "branch_fees_computaion_form",
          layer: 2,
          url: adminPortalLocalUrl,
        });

        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function saveFees() {
  let getEachFeeComputeGeneral = JSON.parse(
    sessionStorage.getItem("getEachFeeComputeGeneral")
  );
  try {
    let classFees = [];
    $(".text_field_container").each(function () {
      let input = $(this).find("input");
      let feesId = input.attr("id");
      let feeValue = input.val();

      classFees.push({
        feesId: feesId,
        amount: feeValue,
      });
    });

    let atLeastOneFilled = classFees.some((fee) => fee.amount.trim() !== "");
    if (!atLeastOneFilled) {
      _actionAlert(
        "Please enter at least one fee amount before saving!",
        false
      );
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnText = $("#submitBtn").html();
      $("#submitBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#submitBtn").prop("disabled", true);

      $.ajax({
        type: "POST",
        url: `${endPoint}/admin/branch/fees/create-fees-compute?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${getEachFeeComputeGeneral.departmentData.departmentId}&classId=${getEachFeeComputeGeneral.classData.classId}&session=${getEachFeeComputeGeneral.currentSession}&termId=${getEachFeeComputeGeneral.termData.termId}`,
        dataType: "json",
        data: JSON.stringify({ classFees: classFees }),
        contentType: "application/json",
        processData: false,
        cache: false,
        headers: getAuthHeaders(true),
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success === true) {
            _actionAlert(message, true);
            _getActiveBranchPage({
              divid: "branch_fees_computaion_page",
              page: "branch_fees_computaion_page",
              url: adminPortalLocalUrl,
            });
            _alertClose(2);
          } else {
            _actionAlert(message, false);
          }
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          $("#submitBtn").html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $("#submitBtn").prop("disabled", false);
  }
}

function _approveFeesCompute(fcId) {
  try {
    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnId = `#approveBtn_${fcId}`;
      const btn = $(btnId);
      const btnText = btn.html();

      btn.html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      btn.prop("disabled", true);

      $.ajax({
        type: "GET",
        url: `${endPoint}/admin/branch/fees/approve-fees-compute?fcId=${fcId}`,
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success === true) {
            _actionAlert(message, success);
            _getActiveBranchPage({
              divid: "branch_fees_computaion_page",
              page: "branch_fees_computaion_page",
              url: adminPortalLocalUrl,
            });
          }

          btn.html(btnText).prop("disabled", false);
        },
        error: function () {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          btn.html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $(`#approveBtn_${fcId}`).prop("disabled", false);
  }
}

function _declineFeesCompute(fcId) {
  try {
    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btnId = `#declineBtn_${fcId}`;
      const btn = $(btnId);
      const btnText = btn.html();

      btn.html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      btn.prop("disabled", true);

      $.ajax({
        type: "GET",
        url: `${endPoint}/admin/branch/fees/decline-fees-compute?fcId=${fcId}`,
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(true),
        success: function (info) {
          const success = info.success;
          const message = info.message;

          if (success === true) {
            _actionAlert(message, success);
            _getActiveBranchPage({
              divid: "branch_fees_computaion_page",
              page: "branch_fees_computaion_page",
              url: adminPortalLocalUrl,
            });
          }

          btn.html(btnText).prop("disabled", false);
        },
        error: function () {
          _actionAlert(
            "An error occurred while processing your request! Please Try Again",
            false
          );
          btn.html(btnText).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred! Please Try Again", false);
    $(`#declineBtn_${fcId}`).prop("disabled", false);
  }
}
