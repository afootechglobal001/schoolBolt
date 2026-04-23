////// Proceed Fetch Branch Parents /////
function _proceedFetchBranchParents() {
  const departmentId = $("#departmentId").val();
  const classId = $("#classId").val();
  const armId = $("#armId").val();

  $("#departmentId, #classId, #armId").removeClass("issue");

  if (!departmentId) {
    $("#departmentId").addClass("issue");
    _actionAlert("Select department to continue", false);
    return;
  }

  if (!classId) {
    $("#classId").addClass("issue");
    _actionAlert("Select class to continue", false);
    return;
  }

  if (!armId) {
    $("#armId").addClass("issue");
    _actionAlert("Select arm to continue", false);
    return;
  }
  const fetchParentsParams = {
    departmentId: departmentId,
    classId: classId,
    armId: armId,
  };

  sessionStorage.setItem(
    "fetchParentsParams",
    JSON.stringify(fetchParentsParams),
  );
  _getActiveBranchPage({
    divid: "branch_parent_page",
    page: "branch_parent_page",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

///// Fetch Branch Parents /////
function _fetchBranchParents() {
  let fetchParentsParams = JSON.parse(
    sessionStorage.getItem("fetchParentsParams"),
  );
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/students/fetch-student?branchId=${getEachBranchDetailsSession.branchId}&departmentId=${fetchParentsParams.departmentId}&classId=${fetchParentsParams.classId}&armId=${fetchParentsParams.armId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const fetch = info.data;
        const success = info.success;
        const session = info.session;
        const termName = info.termData.termName;
        const departmentName = info.departmentData.departmentName;
        const className = info.classData.className;
        const armName = info.armData.armName;

        let pageTitle = `
				<div>
				<span><i class="bi-person-bounding-box"></i></span> BRANCH PARENT'S LIST ----
				<span>${session}</span> - 
				<span>${termName}</span> - 
				<span>${departmentName}</span> - 
				<span>${className}</span> - 
				<span>${armName}</span>
				</div>
				<div class="btn-container">
					<button class="btn" title="EXPORT RECORDS" onclick="_exportStudents('${session}','${departmentName}','${className}','${armName}');">
						<i class="bi-file-earmark-excel"></i> EXPORT
					</button>
				</div>
						
					`;
        $("#pageTitleDiv").html(pageTitle);

        let text = "";
        let no = 0;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const branchId = fetch[i].branchId;
            const departmentId = fetch[i].departmentId;
            const classId = fetch[i].classId;
            const armId = fetch[i].armId;

            const fetchStudentData = fetch[i].studentData;
            const fetchDepartmentData = fetch[i].departmentData;
            const fetchClassData = fetch[i].classData;
            const fetchArmData = fetch[i].armData;

            const studentId = fetchStudentData.studentId;
            const passport = fetchStudentData.passport || "default.jpg";
            const surName = fetchStudentData.surName;
            const firstName = fetchStudentData.firstName;
            const otherNames = fetchStudentData.otherNames;
            const fullname = surName + " " + firstName + " " + otherNames;
            const departmentName = fetchDepartmentData.departmentName;
            const className = fetchClassData.className;
            const armName = fetchArmData.armName;
            const statusName = fetchStudentData.statusName;

            const fetchFatherData = fetch[i].fatherData;
            const fatherFullname =
              fetchFatherData.titleId +
              " " +
              fetchFatherData.surName +
              " " +
              fetchFatherData.otherNames;
            const fatherEmail = fetchFatherData.email;
            const fatherMobileNumber = fetchFatherData.mobileNumber;

            const fetchMotherData = fetch[i].motherData;
            const motherFullname =
              fetchMotherData.titleId +
              " " +
              fetchMotherData.surName +
              " " +
              fetchMotherData.otherNames;
            const motherEmail = fetchMotherData.email;
            const motherMobileNumber = fetchMotherData.mobileNumber;

            text += `
						<tr class="tb-row">
						<td>${no}</td>
						<td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
							<div class="text-back-div">
								<div class="image-div general-passport">
									<img src="${studentPixPath}/${passport}" alt="${fullname}"/>
								</div>

								<div class="text-div">
									<div class="first-class">${fullname}</div>
									<div class="second-class">${studentId}</div>
								</div>
							</div>
						</td>
						<td class="clickable-td" title="Click to view father details" onclick="_loginOnbehalfOfParent('${fetchFatherData.email}','${fetchFatherData.recordFor}','${studentId}');">
						<div class="text-back-div">
							<div class="text-div">
								<div class="first-class">${fatherFullname}</div>
								<div class="second-class">${fatherEmail}</div>
								<div class="second-class">${fatherMobileNumber}</div>
								</div>
							</div>
						</td>
						<td class="clickable-td" title="Click to view mother details" onclick="_loginOnbehalfOfParent('${fetchMotherData.email}','${fetchMotherData.recordFor}','${studentId}');">
							<div class="text-back-div">
								<div class="text-div">
									<div class="first-class">${motherFullname}</div>
									<div class="second-class">${motherEmail}</div>
									<div class="second-class">${motherMobileNumber}</div>
									</div>
								</div>
							</td>
							<td>${session}</td>
							<td>${termName}</td>
							<td>${departmentName}</td>
							<td>${className}</td>
							<td>${armName}</td>
							<td><div class="status-div ${statusName}">${statusName}</div></td>
						</tr>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);
          text += `
				<tbody>
					<tr>
						<td colspan="20">
							<div class="false-notification-div">
								<p>${info.message}</p>
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
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

///// Login Onbehalf Of Parent ///
function _loginOnbehalfOfParent(email, parentTypeId, studentId) {
  try {
    $("#get-more-div-secondary")
      .css({
        display: "flex",
        "justify-content": "center",
        "align-items": "center",
      })
      .fadeIn(500);

    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/account/parentAuth?email=${email}&parentTypeId=${parentTypeId}&studentId=${studentId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success) {
          localStorage.setItem("parentSessionData", JSON.stringify(info));

          const studentData = info.students?.find(
            (s) => s.studentId === studentId,
          );
          const parentData = info.parentData;

          const sessionPayload = {
            student: studentData,
            parent: parentData,
          };
          sessionStorage.setItem(
            "studentParentSessionData",
            JSON.stringify(sessionPayload),
          );
          _getForm({
            page: "parentStudentForm",
            layer: 2,
            url: adminPortalLocalUrl,
          });
        } else {
          _actionAlert(info.message, false);
          _alertClose(2);
        }
      },
      error: function () {
        _actionAlert(
          "Unable to reach the server. Please check your connection.",
          false,
        );
        _alertClose(2);
      },
    });
  } catch (error) {
    console.error("Unexpected error:", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
    _alertClose(2);
  }
}

/////// Suspend and Activate Parent Account ///////
function _suspendActivateParentAccount() {
  let studentParentSessionData = JSON.parse(
    sessionStorage.getItem("studentParentSessionData"),
  );
  const statusId = studentParentSessionData?.parent?.statusId;

  const activeStatus = statusId === "1";

  const title = activeStatus
    ? "Suspend Parent Account"
    : "Activate Parent Account";

  const message = activeStatus
    ? "You are about to suspend this Parent Account. Do you want to proceed?"
    : "You are about to activate this Parent Account. Do you want to proceed?";

  try {
    ////// confirm action ////
    _showCustomConfirm({
      callback: () => {
        _suspendActivateParentAccountCallback();
      },
      title: title,
      message: message,
      alertType: "warning",
      falseActionBtn: true,
      trueActionBtnText: "Yes, Proceed",
      falseActionBtnText: "Cancel",
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _suspendActivateParentAccount());
  }
}

function _suspendActivateParentAccountCallback() {
  let studentParentSessionData = JSON.parse(
    sessionStorage.getItem("studentParentSessionData"),
  );

  const branchId = studentParentSessionData?.parent?.branchId;
  const studentId = studentParentSessionData?.student?.studentData?.studentId;
  const email = studentParentSessionData?.parent?.email;
  const parentTypeId = studentParentSessionData?.parent?.recordFor;
  const statusId = studentParentSessionData?.parent?.statusId;

  if (statusId === "1") {
    //1 means active, so we want to suspend parent //
    statusIdToSet = "2";
  } else if (statusId === "2") {
    //2 means suspended, so we want to activate parent //
    statusIdToSet = "1";
  }

  try {
    ///// get btn text/////
    const btnText = $("#activateAndSuspend").html();
    _btnDisable("activateAndSuspend", btnText, true);

    _callFetchEndPoints({
      url: `/admin/branch/students/update-parent-status?branchId=${branchId}&studentId=${studentId}&parentEmail=${email}&parentTypeId=${parentTypeId}&statusId=${statusIdToSet}`,
      accessKey: true,
    })
      .then((response) => {
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _loginOnbehalfOfParent(email, parentTypeId, studentId);
            },
            title: "Success!",
            message: response.message,
            alertType: "success",
            trueActionBtnText: "Okay, Thanks",
            closeOnOverlayClick: false,
          });
        } else {
          _showCustomConfirm({
            title: "Unable to Suspend/Activate Parent Account!",
            message: response.message,
            alertType: "error",
            trueActionBtnText: "OK",
          });
        }
        _btnDisable("activateAndSuspend", btnText, false);
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _suspendActivateParentAccountCallback()); // retry if needed
        _btnDisable("activateAndSuspend", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _suspendActivateParentAccountCallback());
    _btnDisable("activateAndSuspend", btnText, false);
  }
}

////// Select Session For Account //////
function _getSelectBranchAccountSession(fieldId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/preset-data/fetch-session-for-account?branchId=${getEachBranchDetailsSession.branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].session;
            const value = data[i].session;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>",
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

//// Proceed Fetch Account Department Classes /////
function _proceedFetchAcountDepartmentClass(accountViewMethod) {
  const session = $("#sessionId").val();
  const termId = $("#termId").val();

  // Get the selected text (name)
  const sessionName = $("#sessionId option:selected").text();
  const termName = $("#termId option:selected").text();

  let issueCount = 0;
  issueCount += _validateEmptyValue("sessionId", "SESSION");
  issueCount += _validateEmptyValue("termId", "TERM");

  if (issueCount > 0) return;

  const fetchAccountDepartmentClassParams = {
    session: session,
    sessionName: sessionName,
    termId: termId,
    termName: termName,
    accountViewMethod: accountViewMethod,
  };

  sessionStorage.setItem(
    "fetchAccountDepartmentClassParams",
    JSON.stringify(fetchAccountDepartmentClassParams),
  );
  _getActiveBranchPage({
    divid: "branchDepartmentClass",
    page: "branchDepartmentClass",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

//// Proceed Fetch Account Department Classes /////
function _proceedActivateResult(accountViewMethod) {
  const session = $("#sessionId").val();
  const termId = $("#termId").val();

  // Get the selected text (name)
  const sessionName = $("#sessionId option:selected").text();
  const termName = $("#termId option:selected").text();

  let issueCount = 0;
  issueCount += _validateEmptyValue("sessionId", "SESSION");
  issueCount += _validateEmptyValue("termId", "TERM");

  if (issueCount > 0) return;

  const fetchAccountDepartmentClassParams = {
    session: session,
    sessionName: sessionName,
    termId: termId,
    termName: termName,
    accountViewMethod: accountViewMethod,
  };

  ///// Gather form data ////
  const formData = {
    session: session,
    termId: termId,
  };

  sessionStorage.setItem(
    "fetchAccountDepartmentClassParams",
    JSON.stringify(fetchAccountDepartmentClassParams),
  );

  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  try {
    const btnText = $("#proceedActivateResultBtn").html();
    _btnDisable("proceedActivateResultBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-result/confirm-result-published?branchId=${getEachBranchDetailsSession?.branchId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success === true) {
          _alertClose(2);
          _getActiveBranchPage({
            divid: "branchDepartmentClass",
            page: "branchDepartmentClass",
            url: adminPortalLocalUrl,
          });
        } else {
          _showCustomConfirm({
            title: "Unable to Proceed",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("proceedActivateResultBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _proceedActivateResult(accountViewMethod)); // retry if needed
        _btnDisable("proceedActivateResultBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedActivateResult(accountViewMethod));
    _btnDisable("proceedActivateResultBtn", btnText, false);
  }
}

//////// Branch Department Class ///////////
function _fetchAccountBranchDepartmentClass() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );

  const sessionName = fetchAccountDepartmentClassParams?.sessionName;
  const termName = fetchAccountDepartmentClassParams?.termName;
  const accountViewMethod =
    fetchAccountDepartmentClassParams?.accountViewMethod;

  $("#pageContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>',
    )
    .fadeIn("fast");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/account/fetch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
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
            const departmentName = department.departmentData.departmentName;
            const departmentId = department.departmentData.departmentId;
            const classData = department.classData;

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

                    if (accountViewMethod === "activateResult") {
                      showBtn = `
                                            <div class="btn-div">
                                              <button class="btn view-btn" title="CLICK TO ACTIVATE STUDENT RESULT" onclick="_fetchApprovedStudentBySchoolBolt('${departmentId}','${classId}','${armId}');"><i class="bi-bookmark-check"></i> VIEW STUDENT RESULT</button>
                                            </div>
                                          `;
                    } else if (accountViewMethod === "debtors") {
                      showBtn = `
                                            <div class="btn-div">
                                              <button class="btn view-btn" title="CLICK TO VIEW STUDENT DEBTORS" onclick="_fetchAccountStudentsByClass('${departmentId}','${classId}','${armId}');"><i class="bi-bookmark-check"></i> VIEW STUDENT DEBTORS</button>
                                            </div>
                                          `;
                    } else {
                      showBtn = `
                                            <div class="btn-div">
                                              <button class="btn view-btn" title="CLICK TO VIEW STUDENT PAYMENT" onclick="_fetchAccountStudentsByClass('${departmentId}','${classId}','${armId}');"><i class="bi-bookmark-check"></i> VIEW STUDENT PAYMENT</button>
                                            </div>
                                          `;
                    }

                    text += `
                                        <tr class="tb-row">
                                        <td>${sn}</td>
                                        <td>${departmentName}</td>
                                        <td>${className} ${arm}</td>
                                        <td>${sessionName}</td>
                                        <td>${termName}</td>
                                        <td>
                                          ${showBtn}
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
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

///// Fetch Account Students By Class /////
function _fetchAccountStudentsByClass(departmentId, classId, armId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchAccountDepartmentClassParams?.session;
  const termId = fetchAccountDepartmentClassParams?.termId;
  const accountViewMethod =
    fetchAccountDepartmentClassParams?.accountViewMethod;

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
      url: `admin/branch/account/fetch-student?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success && response.data?.length > 0) {
          sessionStorage.setItem(
            "useAccountStudentByClassSession",
            JSON.stringify(response),
          );
          if (accountViewMethod === "payment") {
            _getForm({
              page: "viewAccountStudentByClassModal",
              layer: 2,
              url: adminPortalLocalUrl,
            });
          } else if (accountViewMethod === "debtors") {
            _getForm({
              page: "viewStudentDebtorsModal",
              layer: 2,
              url: adminPortalLocalUrl,
            });
          } else if (accountViewMethod === "activateResult") {
            _getForm({
              page: "activateStudentResultModal",
              layer: 2,
              url: adminPortalLocalUrl,
            });
          }
        } else {
          _alertClose(2);
          _actionAlert(response.message, false);
        }
      })
      .catch((error) => {
        _alertClose(2);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchAccountStudentsByClass(depatmentId, classId, armId),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchAccountStudentsByClass(depatmentId, classId, armId),
    ); // retry if needed
  }
}

///// Fetch Account Students By Class /////
function _fetchApprovedStudentBySchoolBolt(departmentId, classId, armId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchAccountDepartmentClassParams?.session;
  const termId = fetchAccountDepartmentClassParams?.termId;

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
      url: `admin/branch/account/student-result/fetch-student-approved-by-schoolbolt?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success && response.data?.length > 0) {
          sessionStorage.setItem(
            "useAccountStudentByClassSession",
            JSON.stringify(response),
          );
          _getForm({
            page: "activateStudentResultModal",
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
          _fetchApprovedStudentBySchoolBolt(depatmentId, classId, armId),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(2);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchApprovedStudentBySchoolBolt(depatmentId, classId, armId),
    ); // retry if needed
  }
}

///// Fetch Account Fees To Pay /////
function _fetchAccountFeesToPay(
  branchId,
  session,
  termId,
  departmentId,
  classId,
  armId,
  studentId,
  action,
) {
  $("#get-more-third-layer")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/account/get-fees-to-pay?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          sessionStorage.setItem(
            "useAccountFessToPaySession",
            JSON.stringify(response),
          );
          _getFetchEachAccountStudent(studentId);
          if (action === "loadFund") {
            _getForm({
              page: "branchLoadStudentFundForm",
              layer: 3,
              url: adminPortalLocalUrl,
            });
          } else {
            //// Check if student have an outstanding payment for last term ///
            const haveOutstandingFeesForLastTerm =
              response?.haveOutstandingFeesForLastTerm;
            if (haveOutstandingFeesForLastTerm === true) {
              _alertClose(3);
              _showCustomConfirm({
                title: "Outstanding Fees Detected!",
                message: response.message,
                alertType: "error",
                falseActionBtn: true,
                trueActionBtnText: "PROCCED TO PAY",
                falseActionBtnText: "CANCEL",
                trueActionCallback: () => {
                  _getForm({
                    page: "branchStudentPayFeesForm",
                    layer: 3,
                    url: adminPortalLocalUrl,
                  });
                },
                closeOnOverlayClick: false,
              });
            } else {
              _getForm({
                page: "branchStudentPayFeesForm",
                layer: 3,
                url: adminPortalLocalUrl,
              });
            }
          }
        } else {
          _alertClose(3);
          _showCustomConfirm({
            title: "Cannot Proceed!",
            message: response.message,
            alertType: "error",
            trueActionBtnText: "Got it",
            closeOnOverlayClick: true,
          });
        }
      })
      .catch((error) => {
        _alertClose(3);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchAccountFeesToPay(
            branchId,
            session,
            termId,
            departmentId,
            classId,
            armId,
            studentId,
            action,
          ),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(3);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchAccountFeesToPay(
        branchId,
        session,
        termId,
        departmentId,
        classId,
        armId,
        studentId,
        action,
      ),
    ); // retry if needed
  }
}

function _getFetchEachAccountStudent(Id) {
  let storedData = JSON.parse(
    sessionStorage.getItem("useAccountStudentByClassSession"),
  );

  let students = storedData.data;

  let student = students.find((s) => s.studentId === Id);

  if (student) {
    sessionStorage.setItem(
      "getEachAccountStudentSession",
      JSON.stringify(student),
    );
  }
}

function _getSelectAccountPaymentMethod(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: endPoint + "/preset-data/fetch-payment-method?fetchBy=admin",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].paymentMethodId;
            const value = data[i].paymentMethodName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>",
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

//// Proceed To Payment /////
function _proceedToPayment() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let useAccountFessToPaySession = JSON.parse(
    sessionStorage.getItem("useAccountFessToPaySession"),
  );
  let getEachAccountStudentSession = JSON.parse(
    sessionStorage.getItem("getEachAccountStudentSession"),
  );

  const session = useAccountFessToPaySession?.currentSession;
  const termId = useAccountFessToPaySession?.termData?.termId;
  const studentId = useAccountFessToPaySession?.studentData?.studentId;
  const branchId = getEachBranchDetailsSession?.branchId;
  const departmentId = useAccountFessToPaySession?.departmentData?.departmentId;
  const classId = useAccountFessToPaySession?.classData?.classId;
  const armId = useAccountFessToPaySession?.armData?.armId;

  const advancedBalance =
    getEachAccountStudentSession?.studentData?.advancedBalance;
  try {
    const paymentMethodId = $("#paymentMethodId").val().trim();
    let inputFees = [];
    let totalFees = 0;
    let hasFeeInput = false;

    $(".fees-id-holder").each(function () {
      const feesId = $(this).val();
      const inputSelector = `#fees_${feesId}`;
      const amount = $(inputSelector).val().trim();

      const parsedAmount = parseFloat(amount) || 0;

      if (parsedAmount > 0) {
        hasFeeInput = true;

        inputFees.push({
          feesId: feesId,
          amount: parsedAmount,
        });

        totalFees += parsedAmount;
      }
    });

    if (!hasFeeInput) {
      _showCustomConfirm({
        title: "Nothing to Pay Yet!",
        message:
          "You haven’t added any fees. Please enter a fee amount to continue.",
        alertType: "warning",
        trueActionBtnText: "Got it",
        closeOnOverlayClick: true,
      });
      return false;
    }

    let previousBalance = parseFloat(advancedBalance) || 0;
    let newBalance = previousBalance - totalFees;

    if (newBalance < 0) {
      _showCustomConfirm({
        title: "Insufficient Balance!",
        message: `You have Insufficient balance of <strong style="color:red;"> ${"-<s>N</s>" + thousandSeperator(Math.abs(newBalance))}</strong>. Kindly load fund for this student before proceeding.`,
        alertType: "warning",
        trueActionBtnText: "OK",
        closeOnOverlayClick: true,
      });
      return;
    }

    ///// Gather form data ////
    const formData = {
      session: session,
      termId: termId,
      studentId: studentId,
      branchId: branchId,
      departmentId: departmentId,
      classId: classId,
      armId: armId,
      paymentMethodId: paymentMethodId,
      allFees: inputFees,
    };

    ////// confirm action ////
    _showCustomConfirm({
      callback: () => {
        _proceedToPaymentCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedToPayment());
  }
}

//// Proceed To Payment CallBack /////
function _proceedToPaymentCallback(formData) {
  try {
    const btnText = $("#paymentBtn").html();
    _btnDisable("paymentBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/proceed-to-payment`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          if (
            response.paymentMethodId === "PM001" ||
            response.paymentMethodId === "PM002"
          ) {
            _payWithPaystackSchoolBoltCharges(
              response.branchId,
              response.branchName,
              response.mobileNumber,
              response.paymentKey,
              response.paymentId,
              response.email,
              response.amount,
              response.currency,
              response.paymentChannel,
              btnText,
            );
          } else {
            _alertClose(3);
            _showCustomConfirm({
              callback: () => {
                _fetchAccountStudentsByClass(
                  formData.departmentId,
                  formData.classId,
                  formData.armId,
                  formData.branchId,
                  formData.session,
                  formData.termId,
                );
              },
              title: "Success!",
              message: response.message,
              alertType: "success",
              trueActionBtnText: "OK, Thanks.",
              closeOnOverlayClick: false,
            });
          }
        } else {
          _showCustomConfirm({
            title: "Unable to Process Payment",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("paymentBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _proceedToPaymentCallback(formData)); // retry if needed
        _btnDisable("paymentBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedToPaymentCallback(formData));
    _btnDisable("paymentBtn", btnText, false);
  }
}

////// CALL SCHOOLBOLT CHARGES PAYSTACK ////////////////
function _payWithPaystackSchoolBoltCharges(
  branchId,
  branchName,
  mobileNumber,
  paymentKey,
  paymentId,
  email,
  amount,
  currency,
  paymentChannel,
  btnText,
) {
  // Create the base options
  const options = {
    key: paymentKey,
    email: email,
    amount: amount, // Amount in kobo
    ref: paymentId,
    currency: currency,
    channels: paymentChannel ? [paymentChannel] : ["card", "bank_transfer"],
    metadata: {
      custom_fields: [
        {
          display_name: branchName,
          variable_name: "mobile_number",
          value: mobileNumber,
        },
      ],
    },
    callback: function () {
      _schoolBoltChargesPaymentAction("success", branchId, paymentId, btnText);
    },
    onClose: function () {
      _schoolBoltChargesPaymentAction(
        "cancelled",
        branchId,
        paymentId,
        btnText,
      );
      return false;
    },
  };

  var handler = PaystackPop.setup(options);
  handler.openIframe();
}

////////////////////// END SCHOOLBOLT CHARGES PAYSTACK /////////////////////////////
function _schoolBoltChargesPaymentAction(action, branchId, paymentId, btnText) {
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );
  let useAccountStudentByClassSession = JSON.parse(
    sessionStorage.getItem("useAccountStudentByClassSession"),
  );

  const session = fetchAccountDepartmentClassParams?.session;
  const termId = fetchAccountDepartmentClassParams?.termId;

  const departmentId =
    useAccountStudentByClassSession?.departmentData?.departmentId;
  const classId = useAccountStudentByClassSession?.classData?.classId;
  const armId = useAccountStudentByClassSession?.armData?.armId;

  try {
    const formData = {
      branchId: branchId,
      paymentId: paymentId,
    };

    _callRawEndPoints({
      url: `parent/payment/payment-${action}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          if (action === "success") {
            _alertClose(3);
            _showCustomConfirm({
              callback: () =>
                _fetchAccountStudentsByClass(
                  departmentId,
                  classId,
                  armId,
                  branchId,
                  session,
                  termId,
                ),
              title: "PAYMENT SUCCESSFUL",
              message: "Student fees has been logged successfully",
              alertType: "success",
              trueActionBtnText: "OK",
              closeOnOverlayClick: false,
            });
          }
          _btnDisable("paymentBtn", btnText, false);
        } else {
          _showCustomConfirm({
            title: "Unable to Process Payment",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("paymentBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _schoolBoltChargesPaymentAction(action, branchId, paymentId, btnText),
        ); // retry if needed
        _btnDisable("paymentBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _schoolBoltChargesPaymentAction(action, branchId, paymentId, btnText),
    );
    _btnDisable("paymentBtn", btnText, false);
  }
}

///// Fetch Debtor Details /////
function _fetchEachSudentDebtors(
  branchId,
  session,
  termId,
  departmentId,
  classId,
  armId,
  studentId,
) {
  $("#get-more-third-layer")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `admin/branch/account/get-fees-to-pay?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          sessionStorage.setItem(
            "useAccountFessToPaySession",
            JSON.stringify(response),
          );
          _getFetchEachAccountStudent(studentId);
          _getForm({
            page: "branchStudentDebtorsForm",
            layer: 3,
            url: adminPortalLocalUrl,
          });
        } else {
          _alertClose(3);
          _actionAlert(response.message, false);
        }
      })
      .catch((error) => {
        _alertClose(3);
        console.error("Error:", error);
        _callAjaxError(() =>
          _fetchEachSudentDebtors(
            branchId,
            session,
            termId,
            departmentId,
            classId,
            armId,
            studentId,
          ),
        ); // retry if needed
      });
  } catch (error) {
    _alertClose(3);
    console.error("Error:", error);
    _callAjaxError(() =>
      _fetchEachSudentDebtors(
        branchId,
        session,
        termId,
        departmentId,
        classId,
        armId,
        studentId,
      ),
    ); // retry if needed
  }
}

/// filter Combo Product Data ///
function _filtersActivateStudents(value) {
  $("#accountPageContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

function _checkAll() {
  $(document).ready(function () {
    $("#parent").on("change", function () {
      $(".child").prop("checked", this.checked);
    });
    $(".child").on("change", function () {
      $("#parent").prop(
        "checked",
        $(".child:checked").length === $(".child").length,
      );
    });
  });
}

/// Activate All Student Result ////
function _activateAllStudentResult() {
  try {
    ////////get all needed values////////////
    let selectedStudents = [];
    $(".child:checked").each(function () {
      selectedStudents.push({ studentId: $(this).data("value") });
    });

    const checked = $('input[name="studentId[]"]:checked').length;
    $("#studentId").removeClass("issue");

    if (checked < 1) {
      $("#studentId").addClass("issue");
      _actionAlert("Select at least a student to continue", false);
      return;
    }

    // Gather form data
    const formData = {
      studentIds: selectedStudents,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _activateAllStudentResultCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _activateAllStudentResult());
  }
}

//// Proceed To Activation of student result CallBack /////
function _activateAllStudentResultCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );
  let useAccountStudentByClassSession = JSON.parse(
    sessionStorage.getItem("useAccountStudentByClassSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchAccountDepartmentClassParams?.session;
  const termId = fetchAccountDepartmentClassParams?.termId;

  const departmentId =
    useAccountStudentByClassSession?.departmentData?.departmentId;
  const classId = useAccountStudentByClassSession?.classData?.classId;
  const armId = useAccountStudentByClassSession?.armData?.armId;

  try {
    const btnText = $("#activateAllBtn").html();
    _btnDisable("activateAllBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-result/activate-all-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _fetchApprovedStudentBySchoolBolt(
                departmentId,
                classId,
                armId,
                branchId,
                session,
                termId,
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
            title: "Unable To Activate Result",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("activateAllBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _activateAllStudentResultCallback(formData)); // retry if needed
        _btnDisable("activateAllBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _activateAllStudentResultCallback(formData));
    _btnDisable("activateAllBtn", btnText, false);
  }
}

/// Deactivate All Student Result ////
function _deActivateAllStudentResult() {
  try {
    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _deActivateAllStudentResultCallback();
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _deActivateAllStudentResult());
  }
}

//// Proceed To Activation of student result CallBack /////
function _deActivateAllStudentResultCallback() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );
  let useAccountStudentByClassSession = JSON.parse(
    sessionStorage.getItem("useAccountStudentByClassSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchAccountDepartmentClassParams?.session;
  const termId = fetchAccountDepartmentClassParams?.termId;

  const departmentId =
    useAccountStudentByClassSession?.departmentData?.departmentId;
  const classId = useAccountStudentByClassSession?.classData?.classId;
  const armId = useAccountStudentByClassSession?.armData?.armId;

  try {
    const btnText = $("#deActivateAllBtn").html();
    _btnDisable("deActivateAllBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-result/deactivate-all-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _fetchApprovedStudentBySchoolBolt(
                departmentId,
                classId,
                armId,
                branchId,
                session,
                termId,
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
            title: "Unable To Dactivate Result",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("deActivateAllBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _deActivateAllStudentResultCallback(formData)); // retry if needed
        _btnDisable("deActivateAllBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _deActivateAllStudentResultCallback(formData));
    _btnDisable("deActivateAllBtn", btnText, false);
  }
}

//// Proceed Fetch Student Discount and scholarship Department Classes /////
function _proceedFetchDiscountScholarshipDepartmentClass() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const fetchDiscountDepartmentClassParams = {
    session: getEachBranchDetailsSession?.session,
    termId: getEachBranchDetailsSession?.termId,
    view: "discountScholarship",
  };
  sessionStorage.setItem(
    "fetchDiscountDepartmentClassParams",
    JSON.stringify(fetchDiscountDepartmentClassParams),
  );

  _getActiveBranchPage({
    divid: "branchDiscountScholarshipDepartmentClass",
    page: "branchDiscountScholarshipDepartmentClass",
    url: adminPortalLocalUrl,
  });
}
function _proceedFetchDiscountDepartmentClass() {
  const session = $("#sessionId").val();
  const termId = $("#termId").val();
  let issueCount = 0;
  issueCount += _validateEmptyValue("sessionId", "SESSION");
  issueCount += _validateEmptyValue("termId", "TERM");

  if (issueCount > 0) return;

  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  const fetchDiscountDepartmentClassParams = {
    session: session,
    termId: termId,
    view: "discount",
  };
  sessionStorage.setItem(
    "fetchDiscountDepartmentClassParams",
    JSON.stringify(fetchDiscountDepartmentClassParams),
  );
  _getActiveBranchPage({
    divid: "branchDiscountScholarshipDepartmentClass",
    page: "branchDiscountScholarshipDepartmentClass",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

function _proceedFetchScholarshipDepartmentClass() {
  const session = $("#sessionId").val();
  const termId = $("#termId").val();
  let issueCount = 0;
  issueCount += _validateEmptyValue("sessionId", "SESSION");
  issueCount += _validateEmptyValue("termId", "TERM");

  if (issueCount > 0) return;

  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  const fetchDiscountDepartmentClassParams = {
    session: session,
    termId: termId,
    view: "scholarship",
  };
  sessionStorage.setItem(
    "fetchDiscountDepartmentClassParams",
    JSON.stringify(fetchDiscountDepartmentClassParams),
  );
  _getActiveBranchPage({
    divid: "branchDiscountScholarshipDepartmentClass",
    page: "branchDiscountScholarshipDepartmentClass",
    url: adminPortalLocalUrl,
  });
  _alertClose(2);
}

//////// Branch Student Discount and scholarship Department Class ///////////
function _fetchDiscountScholarshipDepartmentClass() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchDiscountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchDiscountDepartmentClassParams"),
  );
  const session = fetchDiscountDepartmentClassParams?.session;
  const termName = getTermNameById(fetchDiscountDepartmentClassParams?.termId);

  $("#pageDiscountContent")
    .html(
      '<div class="ajax-loader pages-ajax-loader"><img src="' +
        websiteUrl +
        '/images/spinner.gif" alt="Loading"/></div>',
    )
    .fadeIn("fast");

  try {
    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/account/fetch-department-classes?branchId=${getEachBranchDetailsSession.branchId}`,
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
            const departmentName = department.departmentData.departmentName;
            const departmentId = department.departmentData.departmentId;
            const classData = department.classData;

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
                                            <button class="btn view-btn" title="CLICK TO VIEW DISCOUNT AND SCHOLARSHIP STUDENTS" onclick="_fetchStudentDiscountAndScholarshipByClass('${departmentId}', '${classId}', '${armId}');"><i class="bi-bookmark-check"></i> VIEW STUDENT DISCOUNT & PAYMENT</button>
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
          $("#pageDiscountContent").html(text);
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

///// Fetch Discount Scholarship Students By Class /////
function _fetchStudentDiscountAndScholarshipByClass(
  departmentId,
  classId,
  armId,
) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchDiscountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchDiscountDepartmentClassParams"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchDiscountDepartmentClassParams?.session;
  const termId = fetchDiscountDepartmentClassParams?.termId;

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
      url: `admin/branch/account/student-funds/fetch-all-student-discount-scholarship-fund?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}`,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success && response.data?.length > 0) {
          sessionStorage.setItem(
            "useStudentDiscountScholarshipSession",
            JSON.stringify(response),
          );
          _getForm({
            page: "viewStudentDiscountScholarshipClassModal",
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
          _fetchStudentDiscountAndScholarshipByClass(
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
      _fetchStudentDiscountAndScholarshipByClass(departmentId, classId, armId),
    ); // retry if needed
  }
}

function _getFetchEachDiscountStudent(Id) {
  let storedDiscountData = JSON.parse(
    sessionStorage.getItem("useStudentDiscountScholarshipSession"),
  );

  let student = storedDiscountData.data.find((s) => s.studentId === Id);

  if (student) {
    // rebuild response but with only this student
    let filteredResponse = {
      ...storedDiscountData,
      data: [student],
    };

    sessionStorage.setItem(
      "getEachDiscountStudentSession",
      JSON.stringify(filteredResponse),
    );
  }
  _getForm({
    page: "studentDiscountScholarshipForm",
    layer: 3,
    url: adminPortalLocalUrl,
  });
}

//// Load Student Discount Scholarship Fund /////
function _loadStudentDiscountScholarshipFund() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const amount = $("#amount").val().trim();
    const description = $("#description").val().trim();
    const fundPurposeId = $("#fundPurposeId").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("amount", "AMOUNT");
    issueCount += _validateNumber("amount", amount);
    issueCount += _validateEmptyValue("description", "DESCRIPTION");
    issueCount += _validateEmptyValue("fundPurposeId", "FUND PURPOSE");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      amount,
      description,
      fundPurposeId,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _loadStudentDiscountScholarshipFundCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _loadStudentDiscountScholarshipFund());
  }
}

//// Load Student Discount Scholarship Fund CallBack /////
function _loadStudentDiscountScholarshipFundCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let getEachDiscountStudentSession = JSON.parse(
    sessionStorage.getItem("getEachDiscountStudentSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const studentId = getEachDiscountStudentSession?.data?.[0].studentId;
  const session = getEachDiscountStudentSession?.session;
  const termId = getEachDiscountStudentSession?.termData?.termName;
  const departmentId =
    getEachDiscountStudentSession?.departmentData?.departmentId;
  const classId = getEachDiscountStudentSession?.classData?.classId;
  const armId = getEachDiscountStudentSession?.armData?.armId;

  try {
    const btnText = $("#scholarshipBtn").html();
    _btnDisable("scholarshipBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-funds/load-student-discount-scholarship-fund?branchId=${branchId}&studentId=${studentId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(3);
              _fetchStudentDiscountAndScholarshipByClass(
                departmentId,
                classId,
                armId,
                branchId,
                session,
                termId,
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
          _btnDisable("scholarshipBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _loadStudentDiscountScholarshipFundCallback(formData),
        ); // retry if needed
        _btnDisable("scholarshipBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _loadStudentDiscountScholarshipFundCallback(formData),
    );
    _btnDisable("scholarshipBtn", btnText, false);
  }
}

//// Create And Update Bank Setup /////
function _createAndUpdateBankSetUp() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const bankName = $("#bankName").val().trim();
    const accountNumber = $("#accountNumber").val().trim();
    const accountName = $("#accountName").val().trim();
    const statusId = $("#statusId").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("bankName", "BANK NAME");
    issueCount += _validateNumber("accountNumber", accountNumber);
    issueCount += _validateEmptyValue("accountNumber", "ACCOUNT NUMBER");
    issueCount += _validateEmptyValue("accountName", "ACCOUNT NAME");
    issueCount += _validateEmptyValue("statusId", "STATUS");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      bankName,
      accountNumber,
      accountName,
      statusId,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _createAndUpdateBankSetUpCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _createAndUpdateBankSetUp());
  }
}

//// Create And Update Bank Setup CallBack /////
function _createAndUpdateBankSetUpCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  let useEachBankSetUpSession = JSON.parse(
    sessionStorage.getItem("useEachBankSetUpSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const bankId = useEachBankSetUpSession?.bankId;

  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    let callUrl= bankId ? `admin/branch/account/banks/update-bank?branchId=${branchId}&bankId=${bankId}` : `admin/branch/account/banks/create-bank?branchId=${branchId}`;

    _callRawEndPoints({
      url: callUrl,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(2);
              _getActiveBranchPage({divid:'branch_account', page: 'branchAccountSetupPage', url: adminPortalLocalUrl});
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
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _createAndUpdateBankSetUpCallback(formData),
        ); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _createAndUpdateBankSetUpCallback(formData),
    );
    _btnDisable("submitBtn", btnText, false);
  }
}

///// Fetch Branch Bank Setup ////
function _fetchBranchBankSetUp() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;

	try {
		_callFetchEndPoints({
		url: `admin/branch/account/banks/fetch-banks?branchId=${branchId}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
				_initFetchBranchBankSetUp(response.data);
			} else {
			$("#fetchBankSetUpPageContent").html(`
				<tr>
					<td colspan="20">
						<div class="false-notification-div">
							<p>${response.message}</p>
              <div>
                <button class="btn" title="ADD BANK"
                onclick="sessionStorage.removeItem('useEachBankSetUpSession'); _getForm({page: 'branchAccountReg', layer:2, url: adminPortalLocalUrl});"><i
                    class="bi-plus-square"></i> ADD BANK</button>
              </div>
						</div>
					</td>
				</tr>`);
			$("#fetchBankSetUpPageContentPaginationControls").html("");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _fetchBranchBankSetUp());
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchBranchBankSetUp());
	}
}

///// Render Fetch Branch Bank Setup  ////
function _renderFetchBranchBankSetUp(data, start) {
  return data
    .map(
      (item, i) => `
      <tr class="tb-row">
        <td>${start + i + 1}</td>
        <td class="clickable-td">${item.bankId}</td>
        <td>${item.bankName}</td>
        <td>${item.accountNumber}</td>
        <td>${item.accountName}</td>
        <td class="clickable-td">
            ${item.createdByData?.staffId}<br />
            <span>${item.createdByData?.fullName}</span>
        </td>
        <td class="clickable-td">
            ${item.updatedByData?.staffId ? item.updatedByData?.staffId : "--"}<br />
            <span>${item.updatedByData?.fullName ? item.updatedByData?.fullName : "--"}</span>
        </td>
        <td>${item.updatedTime}</td>
        <td>
            <div class="status-div ${item.statusData?.statusName}">
                ${item.statusData?.statusName}
            </div>
        </td>
        <td><button class="btn view-btn" title="Click to edit bank details" onclick="_fetchEachBankSetUp('${item.bankId}');">EDIT</button></td>
      </tr>`)
    .join("");
}

///// Initialize Fetch Branch Bank Setup  ////
function _initFetchBranchBankSetUp(data) {
  const paginator = new Paginator(
    data,
    _renderFetchBranchBankSetUp,
    "fetchBankSetUpPageContentPaginationControls",
    "fetchBankSetUpPageContent",
    10
  );
  __paginatorHandlers["fetchBankSetUpPageContent"] = paginator;
  paginator.renderPage();
}

/////// Fetch Each Bank Setup /////
function _fetchEachBankSetUp(bankId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;

  $("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/branch/account/banks/fetch-banks?branchId=${branchId}&bankId=${bankId}`,
			accessKey: true,
		})
		.then((response) => {
        _staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
    			sessionStorage.setItem("useEachBankSetUpSession", JSON.stringify(response.data[0]));
          _getForm({page: 'branchAccountReg', layer:2, url: adminPortalLocalUrl});
			} else {
				_actionAlert(response.message, false);
			}
		 })
		.catch((error) => {
			console.error("Error:", error);
      _alertClose(2);
			_callAjaxError(() => _fetchEachBankSetUp(bankId)); // retry if needed
		});
	} catch (error) {
		console.error("Error:", error);
    _alertClose(2);
		_callCatchError(() => _fetchEachBankSetUp(bankId));
  }
}

//// Get Select Branch Bank ///
function _getSelectBranchBank(fieldId) {
   let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  try {
    $.ajax({
      type: "GET",
      url: endPoint + `/preset-data/fetch-branch-banks?branchId=${branchId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].bankId;
            const value = data[i].bankName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>",
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
  }
}

///// Fetch Branch Bank Setup ////
function _fetchBranchBankTransactionRecord() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;

	try {
		_callFetchEndPoints({
		url: `admin/branch/account/banks-payment-transactions/fetch-transactions?branchId=${branchId}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
				_initFetchBranchBankTransactionRecord(response.data);
			} else {
			$("#fetchBankTransactionRecordPageContent").html(`
				<tr>
					<td colspan="20">
						<div class="false-notification-div">
							<p>${response.message}</p>
              <div>
                <button class="btn" title="ADD BANK TRANSACTION"
                onclick="sessionStorage.removeItem('useEachBankTransactionRecordSession'); _getForm({page: 'branchBankTransactionReg', layer:2, url: adminPortalLocalUrl});"><i
                    class="bi-plus-square"></i> ADD BANK TRANSACTION</button>
              </div>
						</div>
					</td>
				</tr>`);
			$("#ffetchBankTransactionRecordPageContentPaginationControls").html("");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _fetchBranchBankTransactionRecord());
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchBranchBankTransactionRecord());
	}
}

///// Render Fetch Branch Bank Setup  ////
function _renderFetchBranchBankTransactionRecord(data, start) {
  return data
    .map(
      (item, i) => `
      <tr class="tb-row">
        <td>${start + i + 1}</td>
        <td class="clickable-td">${item.transactionDate}</td>
        <td>${item.bankData?.bankName}</td>
        <td><s>N</s>${thousandSeperator(item.amount)}</td>
        <td>${item.description}</td>
        <td>${item.session}</td>
        <td>${item.termData?.termName}</td>
        <td>${item.paymentBy}</td>
        <td class="clickable-td">
            ${item.createdByData?.staffId}<br />
            <span>${item.createdByData?.fullName}</span>
        </td>
        <td>${item.updatedTime}</td>
        <td><button class="btn view-btn" title="Click to edit bank details" onclick="_fetchEachBankTransactionRecord('${item.transactionId}');">EDIT</button></td>
      </tr>`)
    .join("");
}

///// Initialize Fetch Branch Bank Setup  ////
function _initFetchBranchBankTransactionRecord(data) {
  const paginator = new Paginator(
    data,
    _renderFetchBranchBankTransactionRecord,
    "ffetchBankTransactionRecordPageContentPaginationControls",
    "fetchBankTransactionRecordPageContent",
    10
  );
  __paginatorHandlers["fetchBankTransactionRecordPageContent"] = paginator;
  paginator.renderPage();
}

/////// Fetch Each Bank Transaction Record /////
function _fetchEachBankTransactionRecord(transactionId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;

  $("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/branch/account/banks-payment-transactions/fetch-transactions?branchId=${branchId}&transactionId=${transactionId}`,
			accessKey: true,
		})
		.then((response) => {
        _staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
    			sessionStorage.setItem("useEachBankTransactionRecordSession", JSON.stringify(response.data[0]));
          _getForm({page: 'branchBankTransactionReg', layer:2, url: adminPortalLocalUrl});
			} else {
				_actionAlert(response.message, false);
        _alertClose(2);
			}
		 })
		.catch((error) => {
			console.error("Error:", error);
      _alertClose(2);
			_callAjaxError(() => _fetchEachBankTransactionRecord(transactionId)); // retry if needed
		});
	} catch (error) {
		console.error("Error:", error);
    _alertClose(2);
		_callCatchError(() => _fetchEachBankTransactionRecord(transactionId));
  }
}

//// Create And Update Bank Setup /////
function _createAndUpdateBankTransactionRecord() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const bankId = $("#bankId").val().trim();
    const amount = $("#amount").val().trim();
    const paymentBy = $("#paymentBy").val().trim();
    const description = $("#description").val().trim();
    const transactionDate = $("#transactionDate").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("bankId", "BANK");
    issueCount += _validateNumber("amount", amount);
    issueCount += _validateEmptyValue("amount", "AMOUNT");
    issueCount += _validateEmptyValue("paymentBy", "PAYMENT BY");
    issueCount += _validateEmptyValue("description", "DESCRIPTION");
    issueCount += _validateEmptyValue("transactionDate", "TRANSACTION DATE");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      bankId,
      amount,
      paymentBy,
      description,
      transactionDate,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _createAndUpdateBankTransactionRecordCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _createAndUpdateBankTransactionRecord());
  }
}

//// Create And Update Bank Setup CallBack /////
function _createAndUpdateBankTransactionRecordCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  let useEachBankTransactionRecordSession = JSON.parse(
    sessionStorage.getItem("useEachBankTransactionRecordSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const transactionId = useEachBankTransactionRecordSession?.transactionId;

  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    let callUrl= transactionId ? `admin/branch/account/banks-payment-transactions/update-transaction?branchId=${branchId}&transactionId=${transactionId}` : `admin/branch/account/banks-payment-transactions/create-transaction?branchId=${branchId}`;

    _callRawEndPoints({
      url: callUrl,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(2);
              _getActiveBranchPage({divid:'branch_account', page: 'branchBankTransactionRecordPage', url: adminPortalLocalUrl});
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
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _createAndUpdateBankTransactionRecordCallback(formData),
        ); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _createAndUpdateBankTransactionRecordCallback(formData),
    );
    _btnDisable("submitBtn", btnText, false);
  }
}