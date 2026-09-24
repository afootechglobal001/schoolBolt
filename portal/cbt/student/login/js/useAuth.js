$(document).ready(function () {
    function trim(s) {
        return s.replace(/^\s*/, "").replace(/\s*$/, "");
    }
    $("#verifyForm").keydown(function (e) {
        if (e.keyCode == 13) {
            _proceedVerifyStudentLogin();
        }
    });

});


/// get student next page /////
function _getStudentNextPage(props) {
    const { page = ""} = props;
    if (page) {
        sessionStorage.setItem("currentAuthPage", page);
        _getPage({ page: page, url: cbtStudentLoginMiddleWareUrl });
    }
}


///// Proceed to verify student login ////
function _proceedVerifyStudentLogin(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const studentId = $('#studentId').val().trim();

		///// empty field validation//////////
		issueCount += _validateEmptyValue("studentId", "STUDENT ID");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			studentId,
		};

		////// confirm action////
		_proceedVerifyStudentLoginCallback(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedVerifyStudentLogin());
	}
}

//// VERIFY STUDENT LOGIN CALLBACK FUNCTION ////////
function _proceedVerifyStudentLoginCallback(formData) {
    ///// get btn text /////
    const btnText = $("#proceedBtn").html();
    _btnDisable("proceedBtn", btnText, true);

    ///// call endpoint //////
    _callRawEndPoints({
        url: `cbt/student/auth/verify-student`,
        formData,
    })
    .then((response) => {
        sessionStorage.setItem("verifyStudentLoginSessionData", JSON.stringify(response?.data || {}));
        _getStudentNextPage({ page: "verifyStudentPage" });
        window.location.reload();
    })
    .catch((error) => {
        console.error("Error:", error);
        if (error.status == 0) {
            _callAjaxError(() => _proceedVerifyStudentLoginCallback(formData), error.message);
            _btnDisable("proceedBtn", btnText, false);
        } else {
            _showCustomConfirm({
                title: "Invalid Student!",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
            _btnDisable("proceedBtn", btnText, false);
        }
    });
}

//// Get Select Exam Type ////
function _getSelectStudentExamType(fieldId) {
    verifyStudentLoginSessionData = JSON.parse(sessionStorage.getItem("verifyStudentLoginSessionData") || "{}");

	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `cbt/student/auth/fetch-cbt-by-branch?branchId=${verifyStudentLoginSessionData?.branchData?.branchId}`,
            accessKey: true,
		})
      .then((response) => {
        $("#searchList_" + fieldId).html("");
        for (let i = 0; i < response?.data?.length; i++) {
          const id = response?.data[i].cbtId;
          const value = response?.data[i].cbtTitle;
                  
          $("#searchList_" + fieldId).append(`
            <li onclick="
              _clickOption(
                'searchList_${fieldId}',
                '${id}',
                '${value}'
              );
            ">
              ${value}
            </li>
          `);
        }				
		})
		.catch((error) => {
			console.error("Error:", error);
		});
	} catch (error) {
		console.error("Error:", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
  }
}

///// Proceed to student login ////
function _proceedStudentLogin(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
        const cbtId = $('#cbtId').val().trim();
        const studentId = verifyStudentLoginSessionData?.studentData?.studentId;

		///// empty field validation//////////
		issueCount += _validateEmptyValue("cbtId", "EXAM TYPE");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
            cbtId,
            studentId,
		};

		////// confirm action////
		_proceedStudentLoginCallback(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedStudentLogin());
	}
}

//// STUDENT LOGIN CALLBACK FUNCTION ////////
function _proceedStudentLoginCallback(formData) {
    ///// get btn text /////
    const btnText = $("#loginBtn").html();
    _btnDisable("loginBtn", btnText, true);

    ///// call endpoint //////
    _callRawEndPoints({
        url: `cbt/student/auth/login`,
        formData,
        accessKey: true,
    })
    .then((response) => {
        sessionStorage.setItem("studentLoginData", JSON.stringify(response?.data || {}));
        window.parent.location.href = cbtStudentPortalUrl;
        sessionStorage.removeItem("verifyStudentLoginSessionData");
    })
    .catch((error) => {
        console.error("Error:", error);
        if (error.status == 0) {
            _callAjaxError(() => _proceedStudentLoginCallback(formData), error.message);
            _btnDisable("loginBtn", btnText, false);
        } else {
            _showCustomConfirm({
                title: "Unable to Login!",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
            _btnDisable("loginBtn", btnText, false);
        }
    });
}