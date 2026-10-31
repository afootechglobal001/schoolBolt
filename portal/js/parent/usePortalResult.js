
function _collapseResult(divId) {
  var x = document.getElementById(divId + "num");
  if (x.innerHTML === '&nbsp;<i class="bi-plus"></i>&nbsp;') {
    x.innerHTML = '&nbsp;<i class="bi-dash"></i>&nbsp;';
  } else {
    x.innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
  }
  $("#" + divId + "answer").slideToggle("slow");
}

/////// Fetch Student Result ///////
function _printAuthStudentTerminalResult(
  branchId,
  session,
  termId,
  departmentId,
  classId,
  armId,
  studentId,
) {
  try {
    ///// get btn text/////
    const btnText = $(`#printStudentResultBtn_${classId}_${termId}`).html();
    _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, true);

    //// call endpoint //////
    _callFetchEndPoints({
      url: `reports/print-each-student-terminal-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
    })
      .then((response) => {
        if (response.success) {
          sessionStorage.setItem(
            "printEachStudentTerminalResultSession",
            JSON.stringify(response),
          );
          window.open(
            `${websiteUrl}/reports/print-each-student-terminal-result`,
            "_blank",
          );
        } else {
          _showCustomConfirm({
            title: "VIEW STUDENT RESULT",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
        }
        _btnDisable(
          `printStudentResultBtn_${classId}_${termId}`,
          btnText,
          false,
        );
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          printStudentTerminalResult(
            branchId,
            session,
            termId,
            departmentId,
            classId,
            armId,
            studentId,
          ),
        ); // retry if needed
        _btnDisable(
          `printStudentResultBtn_${classId}_${termId}`,
          btnText,
          false,
        );
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      printStudentTerminalResult(
        branchId,
        session,
        termId,
        departmentId,
        classId,
        armId,
        studentId,
      ),
    );
    _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, false);
  }
}

//// Print Each Student Ca Result ////
function _printAuthEachStudentCaResult(branchId, session, termId, departmentId, classId, armId, assessmentId, studentId) {
  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `reports/print-each-student-ca-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&assessmentId=${assessmentId}&studentId=${studentId}`,
    })
      .then((response) => {
        if (response.success) {
          sessionStorage.setItem(
            "printSingleAssessementSession",
            JSON.stringify(response),
          );
          window.open(`${websiteUrl}/reports/print-each-student-ca-result`, '_blank');
        } else {
          _showCustomConfirm({
            title: "UNABLE TO VIEW CA RESULT",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          _printAuthEachStudentCaResult(branchId, session, termId, departmentId, classId, armId, assessmentId, studentId),
        ); // retry if needed
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      _printAuthEachStudentCaResult(branchId, session, termId, departmentId, classId, armId, assessmentId, studentId),
    );
  }
}