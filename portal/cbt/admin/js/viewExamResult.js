///// Proceed Fetch Result CBT Result Configuration ////
function _proceedFetchResultCbtConfig(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const departmentId = $('#departmentId').val();
		const classId = $('#classId').val();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("departmentId", "DEPARTMENT");
		issueCount += _validateEmptyValue("classId", "CLASS");
		
		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			departmentId,
			classId,
		}

		_fetchClassesSubjectResultForEachCbt(formData);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedFetchResultCbtConfig(formData));
	}
}

//// Fetch Teacher Subject Data For Each CBT ////
function _fetchClassesSubjectResultForEachCbt(formData) {
	///// get btn text/////
	const btnText = $("#proceedBtn").html();
	_btnDisable("proceedBtn", btnText, true);

	///// show loading only after Proceed /////
	$("#fetchClassesSubjectResultForEachCbtContent").html(`
		<div class="content-loading-div">
			<img 
				src="${websiteUrl}/all-images/images/spinner.gif" 
				alt="Loading" />
		</div>
	`);

	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-classes-subject-for-each-cbt?departmentId=${formData?.departmentId}&classId=${formData?.classId}`,
			accessKey: true,
		})
		.then((response) => {
			_initFetchClassesSubjectResultForEachCbtData(response);
			_btnDisable("proceedBtn", btnText, false);

			if (response?.departmentData && response?.classData) {
				$("#selectedDepartmentName").html(response?.departmentData?.departmentName || "");
				$("#selectedClassName").html(response?.classData?.className || "");
				$("#fetchDepartmentClassResultCbtDetails").show();
			}
			sessionStorage.setItem("getClassesSubjectResultForEachCbtData", JSON.stringify(response));
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			_btnDisable("proceedBtn", btnText, false);
			if (error.status == 0) {
				_showEmptyState({
					container: "fetchClassesSubjectResultForEachCbtContent",
					message: "Check your internet connection and try again",
				});

				_callAjaxError(
					() => _fetchClassesSubjectResultForEachCbt(formData),
					error.message
				);
				_btnDisable("proceedBtn", btnText, false);
			} else {
				_showEmptyState({
					container: "fetchClassesSubjectResultForEachCbtContent",
					message: error.message,
				});
				_btnDisable("proceedBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchClassesSubjectResultForEachCbt(formData));
		_btnDisable("proceedBtn", btnText, false);
	}
}

/// Render Classes Subject Result For Each CBT Data ///
function _initFetchClassesSubjectResultForEachCbtData(response) {
	const data = response?.data || [];
	const content = data?.length > 0 ? data.map((item, start) => {
		const viewId = `view${item?.cbtId}`;
		const cbtTitle = item?.cbtTitle;
		const subjectAllocatedData = item?.subjectAllocatedData || [];

		const subjectContent = subjectAllocatedData.length > 0 ? subjectAllocatedData.map((subjectItem) => {
			const subjectName = subjectItem?.subjectData?.subjectName;
			const subjectId = subjectItem?.subjectData?.subjectId;

			return `
				<div class="toggle-list">
					<div class="title">
						<h4>
							${subjectName}
						</h4>
					</div>

					<div class="btn-container">
						<button
							class="btn"
							title="VIEW RESULT"
							onclick="event.stopPropagation(); _proceedFetchCbtResult('${item?.cbtId}', '${subjectId}');">
							<i class="bi bi-eye"></i> VIEW RESULT
						</button>
					</div>
				</div>
			`;
		}).join("")
		: `
			<div class="empty-state-div">
				<div class="icon">
					<img
						src="${websiteUrl}/all-images/images/no-record.png"
						alt="Warning" />
				</div>

				<p>
					No subject assigned to this CBT.
					<br>
					Kindly contact the administrator to assign subjects.
				</p>
			</div>
		`;

		return `
			<div
				class="toggle-card"
				onclick="_chevronCollapse('${viewId}')">
				<div class="title-content">
					<div class="number">
						${start + 1}
					</div>

					<div class="content-div">
						<div class="left-content">
							<div class="text-div">
								<h2>
									${cbtTitle}
								</h2>
							</div>
						</div>

						<div class="nav-wrapper">
							<div
								class="nav-cont toggle-nav"
								id="${viewId}num">

								<i class="bi bi-chevron-down"></i>
							</div>
						</div>
					</div>
				</div>

				<div
					class="open-toggle"
					id="${viewId}answer"
					style="display: none;">

					<div class="toggle-list-wrapper">
						${subjectContent}
					</div>
				</div>
			</div>
		`;

	}).join("")
	: `
		<div class="empty-state-div">
			<div class="icon">
				<img
					src="${websiteUrl}/all-images/images/no-record.png"
					alt="Warning" />
			</div>

			<p>No CBT configuration found.</p>
		</div>
	`;
	$("#fetchClassesSubjectResultForEachCbtContent").html(content);
}


//// Proceed Fetch CBT Result ///
function _proceedFetchCbtResult(cbtId, subjectId) {
	let  storedData = JSON.parse(sessionStorage.getItem("getClassesSubjectResultForEachCbtData"));

	let cbts = storedData?.data;
	// correct key (cbtId)
	let cbt = cbts.find((c) => c.cbtId === cbtId);

	// find subject inside that cbt
	let subject = cbt.subjectAllocatedData.find(
		(s) => s.subjectData?.subjectId === subjectId
	);

	// build selected subject data
	let selectedSubject = {
		cbtId: cbt?.cbtId,
		cbtTitle: cbt?.cbtTitle,

		subjectId: subject?.subjectData?.subjectId,
		subjectName: subject?.subjectData?.subjectName,

		departmentId: storedData.departmentData?.departmentId,
		departmentName: storedData.departmentData?.departmentName,

		classId: storedData.classData?.classId,
		className: storedData.classData?.className,
	};

	// save to session
	sessionStorage.setItem(
		"selectedCbtSubjectSession",
		JSON.stringify(selectedSubject)
	);
	_getForm({ page: "proccedViewCbtResultForm", url: cbtAdminMiddleWareUrl });
}

//// Get Department Class Arm Preset Data ////
function _getSelectBranchDepartmentClassArm(fieldId) {
	selectedCbtSubjectSession = JSON.parse(sessionStorage.getItem("selectedCbtSubjectSession"));
	
  	const departmentId = selectedCbtSubjectSession?.departmentId || ""; 
	const classId = selectedCbtSubjectSession?.classId || "";
	
    // always reset before loading
    $("#"+fieldId).val("");
    $("#searchList_" + fieldId).html("");

	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `cbt/preset-data/fetch-branch-department-class-arms?departmentId=${departmentId}&classId=${classId}`,
			accessKey: true,
		})
        .then((response) => {
			$("#searchList_" + fieldId).html("");
			const data = response?.data || [];
			for (let i = 0; i < data.length; i++) {
				const id = data[i].armId;
				const value = data[i].armName;
				$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
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

//// Proceed Print CBT Result ////
function proceedPrintCbtResult() {
	try {
		let issueCount = 0;
		const armId = $("#armId").val();

		///// empty field validation //////////
		issueCount += _validateEmptyValue("armId", "ARM");

		if (issueCount > 0) return;

		// Form Data payload
		const formData = {
			armId: armId,
		};

		////// confirm action //////
		_showCustomConfirm({
			callback: () => {
				_printCbtResultCallBack(formData);
			},
			title: "Are you sure?",
			message: "Are you sure you want to print the result?",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => proceedPrintCbtResult());
	}
}

///// Print CBT Result Callback ////
function _printCbtResultCallBack(formData) {
	try {
		selectedCbtSubjectSession = JSON.parse(sessionStorage.getItem("selectedCbtSubjectSession"));
		const departmentId = selectedCbtSubjectSession?.departmentId;
		const classId = selectedCbtSubjectSession?.classId;
		const cbtId = selectedCbtSubjectSession?.cbtId;
		const subjectId = selectedCbtSubjectSession?.subjectId;

		const armId = formData?.armId;

		///// get btn text/////
		const btnText = $("#printBtn").html();
		_btnDisable("printBtn", btnText, true);

		//// call endpoint //////
		_callFileEndPoints({
			url: `cbt/results/print-cbt-result?departmentId=${departmentId}&classId=${classId}&cbtId=${cbtId}&subjectId=${subjectId}&armId=${armId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("printStudentsCbtResultSession", JSON.stringify(response));
			if (response?.data?.length > 0) {
				window.open(`${clientWebsiteUrl}/portal/reports/print-cbt-result`, '_blank');
			} else {
				_showCustomConfirm({
					title: "Unable to Print CBT Result",
					message: "No student result found for this arm.",
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("printBtn", btnText, false);
			}
			_btnDisable("printBtn", btnText, false);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(() => proceedPrintCbtResult()); // retry if needed
				_btnDisable("printBtn", btnText, false);
			} else {
				_showCustomConfirm({
					title: "Unable to Print CBT Result",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("printBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => proceedPrintCbtResult());
		_btnDisable("printBtn", btnText, false);
	}
}

