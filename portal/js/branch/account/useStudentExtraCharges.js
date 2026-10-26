/// Proceed To Fetch Extra Charges Department Class /////
function _proceedFetchExtraChargesDepartmentClass() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const fetchExtraChargesDepartmentClassParams = {
    session: getEachBranchDetailsSession?.session,
    termId: getEachBranchDetailsSession?.termId,
  };
  sessionStorage.setItem(
    "fetchExtraChargesDepartmentClassParams",
    JSON.stringify(fetchExtraChargesDepartmentClassParams),
  );
  
  _getActiveBranchPage({
    divid: "branchExtraChargesDepartmentClass",
    page: "branchExtraChargesDepartmentClass",
    url: adminPortalLocalUrl,
  });
}

//////// Branch Extra Charges Department Class ///////////
function _fetchExtraChargesDepartmentClass() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchExtraChargesDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchExtraChargesDepartmentClassParams"),
  );
  const session = fetchExtraChargesDepartmentClassParams?.session;
  const termName = getTermNameById(fetchExtraChargesDepartmentClassParams?.termId);

  $("#pageExtraChargesContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>',
    )
    .fadeIn("fast");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/account/fetch-department-classes?branchId=${getEachBranchDetailsSession?.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;

        let text = "";
        let no = 0;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const department = fetch[i];
            const departmentName = department?.departmentData?.departmentName;
            const departmentId = department?.departmentData?.departmentId;
            const classData = department?.classData;

            text += `
                <div class="pages-toggle-div">
                    <div class="pages-toggle-title" onclick="_collapse('view${no}');" title="CLICK TO VIEW ${departmentName} DEPARTMENT CLASSES">
                        <h3>${departmentName}</h3>
                        <div class="expand-div" id="view${no}num">&nbsp;<i class="bi-chevron-down"></i>&nbsp;</div> 
                    </div>

                    <div class="toggle-expand-div" id="view${no}answer" style="display: none;">  
                        <div class="alert alert-success top-alert-div class-top-alert-div animated fadeIn">
                            <span><i class="bi-people-fill"></i> <span>${departmentName}</span> DEPARTMENT</span>       
                        </div>

                        <div class="table-div animated fadeIn">
                            <table class="table" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr class="tb-col">
                                        <th>sn</th>
                                        <th>Department</th>
                                        <th>Class</th>
                                        <th>Session</th>
                                        <th>Term</th>
                                        <th>Action</th>
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

                                          text += `
                                              <tr class="tb-row">
                                              <td>${sn}</td>
                                              <td>${departmentName}</td>
                                              <td>${className} ${arm}</td>
                                              <td>${session}</td>
                                              <td>${termName}</td>
                                              <td>
                                                <div class="btn-div">
                                                  <button class="btn view-btn" title="CLICK TO VIEW EXTRA CHARGES STUDENTS" onclick="_fetchExtraChargesStudentByClass('${departmentId}', '${classId}', '${armId}');"><i class="bi-bookmark-check"></i> VIEW EXTRA CHARGES STUDENTS</button>
                                                </div>
                                              </td>`;
                                        }
                                      }
                                    }
                                  }
                                  text += `</tbody>
                                                  </table>
                                              </div>
                                          </div>
                                      </div>`;
                                }
                                $("#pageExtraChargesContent").html(text);
                              } else {
                                _actionAlert(info.message, false);
                                $("#pageDiscountContent").html(`
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
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

///// Fetch Extra Charges Students By Class /////
function _fetchExtraChargesStudentByClass(
  departmentId,
  classId,
  armId,
) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchExtraChargesDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchExtraChargesDepartmentClassParams"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchExtraChargesDepartmentClassParams?.session;
  const termId = fetchExtraChargesDepartmentClassParams?.termId;

  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/account/student-extra-charges/fetch-all-student-extra-charges?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success && response.data?.length > 0) {
          sessionStorage.setItem(
            "useExtraChargesStudentSession",
            JSON.stringify(response),
          );
          _getForm({
            page: "viewExtraChargesStudentClassModal",
            layer: 2,
            url: adminPortalLocalUrl,
          });
        } else {
          _alertClose(2);
          _actionAlert(response.message, false);
        }
      })
      .catch((error) => {
        _alertClose(2);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchExtraChargesStudentByClass(
            departmentId,
            classId,
            armId,
          ),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchExtraChargesStudentByClass(departmentId, classId, armId),
    ); // retry if needed
  }
}

function _getFetchEachExtraChargesStudent(Id) {
  let storedExtraChargesData = JSON.parse(
    sessionStorage.getItem("useExtraChargesStudentSession"),
  );

  let student = storedExtraChargesData.data.find((s) => s.studentId === Id);

  if (student) {
    // rebuild response but with only this student
    let filteredResponse = {
      ...storedExtraChargesData,
      data: [student],
    };

    sessionStorage.setItem(
      "getEachExtraChargesStudentSession",
      JSON.stringify(filteredResponse),
    );
  }
  _getForm({
    page: "studentExtraChargesForm",
    layer: 3,
    url: adminPortalLocalUrl,
  });
}

//// Load Student Extra Charges /////
function _loadStudentExtraCharges() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const title = $("#title").val().trim();
    const amount = $("#amount").val().trim();
    const description = $("#description").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("title", "TITLE");
    issueCount += _validateEmptyValue("amount", "AMOUNT");
    issueCount += _validateNumber("amount", amount);
    issueCount += _validateEmptyValue("description", "DESCRIPTION");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      title,
      amount,
      description,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _loadStudentExtraChargesCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _loadStudentExtraCharges());
  }
}

//// Load Student Extra Charges CallBack /////
function _loadStudentExtraChargesCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let getEachExtraChargesStudentSession = JSON.parse(
    sessionStorage.getItem("getEachExtraChargesStudentSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const studentId = getEachExtraChargesStudentSession?.data?.[0].studentId;
  const departmentId = getEachExtraChargesStudentSession?.departmentData?.departmentId;
  const classId = getEachExtraChargesStudentSession?.classData?.classId;
  const armId = getEachExtraChargesStudentSession?.armData?.armId;

  try {
    const btnText = $("#extraChargesBtn").html();
    _btnDisable("extraChargesBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-extra-charges/create-extra-charges?branchId=${branchId}&studentId=${studentId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(3);
              _fetchExtraChargesStudentByClass(
                departmentId,
                classId,
                armId,
              );
            },
            title: "Success!",
            message: response.message,
            alertType: "success",
            trueActionBtnText: "OK, Thanks.",
            closeOnOverlayClick: false,
          });
        } else {
          _showCustomConfirm({
            title: "Unable to proceed",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("extraChargesBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _loadStudentExtraChargesCallback(formData),
        ); // retry if needed
        _btnDisable("extraChargesBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _loadStudentExtraChargesCallback(formData),
    );
    _btnDisable("extraChargesBtn", btnText, false);
  }
}



function studentExtraChargesSelectSearch() {
  $(".student-fund-srch-select").toggle("fast");
}
function studentExtraChargesSrchCustom(text) {
  $("#srch-student-extra-charges-text").html(text);
  $(".student-fund-custom-srch-div").fadeIn(500);
}

///// Student Extra Charges Filtering ////////
function _fetchStudentExtraChargesFiltering(filterWith, text) {
  $("#srch-student-extra-charges-text").html(text);
  $(".student-fund-custom-srch-div").fadeOut(500);
  let dateFrom;
  const dateTo = new Date().toISOString().split("T")[0];
  if (filterWith === "srch-today") {
    dateFrom = new Date().toISOString().split("T")[0];
  } else if (filterWith === "srch-week") {
    const currentDate = new Date();
    const firstDayOfWeek = new Date(
      currentDate.setDate(currentDate.getDate() - currentDate.getDay())
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfWeek;
  } else if (filterWith === "srch-7") {
    /// for last 7 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 6))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-30") {
    /// for last 30 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 29))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-90") {
    /// for last 90 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 89))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-month") {
    const currentDate = new Date();
    const firstDayOfMonth = new Date(
      currentDate.getFullYear(),
      currentDate.getMonth(),
      2
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfMonth;
  } else if (filterWith === "srch-year") {
    const currentDate = new Date();
    const firstDayOfYear = new Date(currentDate.getFullYear(), 0, 2)
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfYear;
  } else if (filterWith === "srch-1year") {
    /// for last 1 year
    const currentDate = new Date();
    const pastDate = new Date(
      currentDate.setFullYear(currentDate.getFullYear() - 1)
    )
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  }

  _studentExtraChargesHistoryFiltering(dateFrom, dateTo);
}

///// Student Extra Charges Custom Filtering ////////
function _fetchCustomStudentExtraChargesFiltering() {
  let issueCount = 0;

  const dateFrom = $("#student-extra-charges-datepickers-from").val();
  const dateTo = $("#student-extra-charges-datepickers-to").val();

  $("#student-extra-charges-datepickers-from, #student-extra-charges-datepickers-to").removeClass("issue");
  $("#issue_student-extra-charges-datepickers-from, #issue_student-extra-charges-datepickers-to").html("");

  if (!dateFrom) {
    $("#issue_student-extra-charges-datepickers-from").html("Kindly Provide Start Date To Continue");
    issueCount++;
  }

  if (!dateTo) {
    $("#issue_student-extra-charges-datepickers-to").html("Kindly Provide End Date To Continue");
    issueCount++;
  }

  if (issueCount > 0) { 
    return;
  }

  _studentExtraChargesHistoryFiltering(dateFrom, dateTo);
}


///// Fetch Students Extra Charges History ////
function _studentExtraChargesHistoryFiltering(dateFrom, dateTo) {
    $("#fetchStudentExtraCharges").html(`
        <tr>
            <td colspan="20">
                <div class="content-loading-div">
                    <img src="${websiteUrl}/images/spinner.gif" alt="Loading" />
                </div>
            </td>
        </tr>
    `);
    $("#fetchStudentExtraChargesPaginationControls").html("");
    
  	let getEachBranchDetailsSession = JSON.parse(
		  sessionStorage.getItem("getEachBranchDetailsSession")
	);

    let getEachBranchStudentsSession = JSON.parse(
      sessionStorage.getItem("getEachBranchStudentsSession"),
    );

	try {
		_callFetchEndPoints({
		url: `admin/branch/account/student-extra-charges/fetch-student-extra-charges?branchId=${getEachBranchDetailsSession?.branchId}&studentId=${getEachBranchStudentsSession?.studentId}&dateFrom=${dateFrom}&dateTo=${dateTo}`,
		accessKey: true,
		})
		.then((response) => {
            _staffValidationCheck(response?.response);

            // Update custom date from and date to///
			$("#dateFrom").html(response?.dateFrom);
            $("#dateTo").html(response?.dateTo);
            
			if (response?.success && response?.data?.length > 0) {
				_initFetchStudentExtraCharges(response?.data);

				// Update Wallet Balance///
				$("#advancedBalance").html(
				"<s>N</s>" + thousandSeperator(response?.studentData?.advancedBalance)
				);
			} else {
			$("#fetchStudentExtraCharges").html(`
				<tr>
					<td colspan="20">
						<div class="false-notification-div">
							<p>No record found!</p>
						</div>
					</td>
				</tr>`);
			$("#fetchStudentExtraChargesPaginationControls").html("");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _studentExtraChargesHistoryFiltering(dateFrom, dateTo));
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _studentExtraChargesHistoryHistoryFiltering(dateFrom, dateTo));
	}
}

///// Render Fetch Students Extra Charges History ////
function _renderFetchStudentExtraCharges(data, start) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession")
  );

  return data
    .map((item, i) => {
      return `
      <tr class="tb-row">
        <td>${start + i + 1}</td>
        <td class="clickable-td">${item?.updatedTime}</td>
        <td class="clickable-td" title="Click to view student extra charges details" onclick="_fetchEachStudentExtraCharges('${getEachBranchDetailsSession?.branchId}', '${item?.studentId}', '${item?.chargesId}');">
          <div class="text-back-div">
            <div class="text-div">
              <div class="first-class">${item?.chargesId}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="text-back-div">
            <div class="text-div">
              <div class="first-class">${capitalizeFirstLetterOfEachWord(item?.title)}</div>
              <div class="second-class">${item?.description}</div>
            </div>
          </div>
        </td>
        <td><s>N</s>${thousandSeperator(item?.amount)}</td>
        <td class="clickable-td">
          <div class="text-back-div">
            <div class="text-div">
              <div class="first-class">${item?.createdByData?.fullName}</div>
              <div class="second-class">${item?.createdByData?.staffId}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="status-div ${item?.statusData?.statusName}">
            ${item?.statusData?.statusName}
          </div>
        </td>
        <td>
          <button class="btn view-btn"
            title="Click to view student extra charges details"
            onclick="_fetchEachStudentExtraCharges('${getEachBranchDetailsSession?.branchId}', '${item?.studentId}', '${item?.chargesId}');">
            VIEW
          </button>
        </td>
      </tr>`
    })
    .join("");
}

///// Initialize Fetch Branch Extra Charges History ////
function _initFetchStudentExtraCharges(data) {
  const paginator = new Paginator(
    data,
    _renderFetchStudentExtraCharges,
    "fetchStudentExtraChargesPaginationControls",
    "fetchStudentExtraCharges",
    10
  );
  __paginatorHandlers["fetchStudentExtraCharges"] = paginator;
  paginator.renderPage();
}

/////// Fetch Each Student Extra Charges /////
function _fetchEachStudentExtraCharges(branchId, studentId, chargesId) {
  try {
    $("#get-more-third-layer")
      .css({
        display: "flex",
        "justify-content": "center",
        "align-items": "center",
      })
      .fadeIn(500);

    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/account/student-extra-charges/fetch-student-extra-charges?branchId=${branchId}&studentId=${studentId}&chargesId=${chargesId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success && response.data?.length > 0) {
          sessionStorage.setItem(
            "useEachFetchStudentExtraChargesSession",
            JSON.stringify(response),
          );
          _getForm({
            page: "studentExtraChargesDetailsForm",
            layer: 3,
            url: adminPortalLocalUrl,
          });
        } else {
          _actionAlert(response.message, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _alertClose(3);
        _callAjaxError(() => _fetchEachStudentExtraCharges(branchId, studentId, chargesId)); // retry if needed
      });
  } catch (error) {
    console.error("Error:", error);
    _alertClose(3);
    _callCatchError(() => _fetchEachStudentExtraCharges(branchId, studentId, chargesId));
  }
}

//// Student Extra Charges Cancellation /////
function _studentExtraChargesCancellation() {
  let useEachFetchStudentExtraChargesSession = JSON.parse(
    sessionStorage.getItem("useEachFetchStudentExtraChargesSession"),
  );
  const chargesId = useEachFetchStudentExtraChargesSession?.data[0]?.chargesId;

  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const reasonForCancellation = $("#reasonForCancellation").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("reasonForCancellation", "REASON FOR CANCELLATION");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      chargesId,
      reasonForCancellation,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _studentExtraChargesCancellationCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to cancel this extra charges? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _studentExtraChargesCancellation());
  }
}

//// Student Extra Charges Cancellation CallBack /////
function _studentExtraChargesCancellationCallback(formData) {
  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-extra-charges/cancel-extra-charges`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response?.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(3);
              _fetchStudentExtraChargesFiltering('srch-90', 'Last 90 Days');
            },
            title: "Success!",
            message: response.message,
            alertType: "success",
            trueActionBtnText: "OK, Thanks.",
            closeOnOverlayClick: false,
          });
        } else {
          _showCustomConfirm({
            title: "Unable to Cancel Extra Charges",
            message: response.message,
            alertType: "error",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _studentExtraChargesCancellationCallback(formData)); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _studentExtraChargesCancellationCallback(formData));
    _btnDisable("submitBtn", btnText, false);
  }
}