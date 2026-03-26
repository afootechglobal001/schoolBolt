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
