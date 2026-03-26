//// Load Student Fund /////
function _loadStudentFund() {
  try {
    ////////get all needed values////////////
    let issueCount = 0;
    const amountReceivedFromParent = $("#amountReceivedFromParent")
      .val()
      .trim();
    const description = $("#description").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("amountReceivedFromParent", "AMOUNT");
    issueCount += _validateNumber(
      "amountReceivedFromParent",
      amountReceivedFromParent,
    );
    issueCount += _validateEmptyValue("description", "DESCRIPTION");

    if (issueCount > 0) return;

    /////Gather form data////
    const formData = {
      description,
      amountReceivedFromParent,
    };

    ////// confirm action////
    _showCustomConfirm({
      callback: () => {
        _loadStudentFundCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed? This action is irreversible.",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _loadStudentFund());
  }
}

//// Load Student Fund CallBack /////
function _loadStudentFundCallback(formData) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );
  let fetchAccountDepartmentClassParams = JSON.parse(
    sessionStorage.getItem("fetchAccountDepartmentClassParams"),
  );
  let getEachAccountStudentSession = JSON.parse(
    sessionStorage.getItem("getEachAccountStudentSession"),
  );
  let useAccountStudentByClassSession = JSON.parse(
    sessionStorage.getItem("useAccountStudentByClassSession"),
  );

  const branchId = getEachBranchDetailsSession?.branchId;
  const session = fetchAccountDepartmentClassParams?.sessionId;
  const termId = fetchAccountDepartmentClassParams?.termId;

  const departmentId =
    useAccountStudentByClassSession?.departmentData?.departmentId;
  const classId = useAccountStudentByClassSession?.classData?.classId;
  const armId = useAccountStudentByClassSession?.armData?.armId;

  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    _callRawEndPoints({
      url: `admin/branch/account/student-funds/load-student-fund?branchId=${branchId}&studentId=${getEachAccountStudentSession?.studentId}`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        _staffValidationCheck(response.response);
        if (response.success) {
          _showCustomConfirm({
            callback: () => {
              _alertClose(3);
              _fetchAccountStudentsByClass(
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
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _loadStudentFundCallback(formData)); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _loadStudentFundCallback(formData));
    _btnDisable("submitBtn", btnText, false);
  }
}

function studentFundSelectSearch() {
  $(".student-fund-srch-select").toggle("fast");
}
function studentFundSrchCustom(text) {
  $("#srch-student-fund-text").html(text);
  $(".student-fund-custom-srch-div").fadeIn(500);
}

///// Branch Wallet Filtering ////////
function _fetchStudentFundFiltering(filterWith, text) {
  $("#srch-student-fund-text").html(text);
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

  _studentFundHistoryFiltering(dateFrom, dateTo);
}

///// Branch Wallet Custom Filtering ////////
function _fetchCustomStudentFundFiltering() {
  let issueCount = 0;

  const dateFrom = $("#student-fund-datepickers-from").val();
  const dateTo = $("#student-fund-datepickers-to").val();

  $("#student-fund-datepickers-from, #student-fund-datepickers-to").removeClass("issue");
  $("#issue_student-fund-datepickers-from, #issue_student-fund-datepickers-to").html("");

  if (!dateFrom) {
    $("#issue_student-fund-datepickers-from").html("Kindly Provide Start Date To Continue");
    issueCount++;
  }

  if (!dateTo) {
    $("#issue_student-fund-datepickers-to").html("Kindly Provide End Date To Continue");
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  _studentFundHistoryFiltering(dateFrom, dateTo);
}


///// Fetch Students Funds ////
function _studentFundHistoryFiltering(dateFrom, dateTo) {
	$("#get-more-third-layer")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);

  	let getEachBranchDetailsSession = JSON.parse(
		  sessionStorage.getItem("getEachBranchDetailsSession")
	  );

    let getEachBranchStudentsSession = JSON.parse(
      sessionStorage.getItem("getEachBranchStudentsSession"),
    );

	try {
		_callFetchEndPoints({
		url: `admin/branch/account/student-funds/fetch-student-fund?branchId=${getEachBranchDetailsSession?.branchId}&studentId=${getEachBranchStudentsSession?.studentId}&dateFrom=${dateFrom}&dateTo=${dateTo}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
				_initFetchStudentFunds(response.data);

				// Update custom date from and date to///
				$("#dateFrom").html(response.dateFrom);
				$("#dateTo").html(response.dateTo);

				// Update Wallet Balance///
				$("#advancedBalance").html(
				"<s>N</s>" + thousandSeperator(response?.studentData?.advancedBalance)
				);
			} else {
			$("#fetchStudentFunds").html(`
				<tr>
					<td colspan="20">
						<div class="false-notification-div">
							<p>No record found!</p>
						</div>
					</td>
				</tr>`);
			$("#fetchStudentFundsPaginationControls").html("");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _walletHistoryFiltering(dateFrom, dateTo));
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _walletHistoryFiltering(dateFrom, dateTo));
	}
	$("#get-more-third-layer").fadeOut(500);
}

///// Render Fetch Students Funds ////
function _renderFetchStudentFunds(data, start) {
  return data
    .map(
      (item, i) => `
      <tr class="tb-row">
        <td>${start + i + 1}</td>
        <td class="clickable-td">${item.updatedTime}</td>
        <td class="clickable-td">
          <div class="text-back-div">
            <div class="text-div">
              <div class="first-class">${item.paymentId}</div>
              <div class="second-class">${item.description}</div>
            </div>
          </div>
        </td>
        <td><s>N</s>${thousandSeperator(item.advancedBalanceBefore)}</td>
        <td><s>N</s>${thousandSeperator(item.amount)}</td>
        <td><s>N</s>${thousandSeperator(item.advancedBalanceAfter)}</td>
        <td class="clickable-td">
          <div class="text-back-div">
            <div class="text-div">
              <div class="first-class">${item.createdByData?.fullName}</div>
              <div class="second-class">${item.createdByData?.staffId}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="status-div ${item.statusData?.statusName}">
            ${item.statusData?.statusName}
          </div>
        </td>
      </tr>`
    )
    .join("");
}

///// Initialize Fetch Branch Wallet History ////
function _initFetchStudentFunds(data) {
  const paginator = new Paginator(
    data,
    _renderFetchStudentFunds,
    "fetchStudentFundsPaginationControls",
    "fetchStudentFunds",
    10
  );
  __paginatorHandlers["fetchStudentFunds"] = paginator;
  paginator.renderPage();
}