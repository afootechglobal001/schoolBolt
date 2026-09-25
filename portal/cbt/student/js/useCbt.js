function _getCbtExamPagesTab(props) {
	const {
        page = '',
		pageContainer='getCbtExamPanel'
    } = props;
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: cbtStudentPortalMiddleWareUrl});
	}
}

function _getStudentLoginDataSession() {
	const studentLoginData = JSON.parse(
		sessionStorage.getItem("studentLoginData") || "{}"
	);

	return {
		cbtId: studentLoginData?.cbtData?.cbtId,
		departmentId: studentLoginData?.departmentData?.departmentId,
		classId: studentLoginData?.classData?.classId,
	};
}

//// Fetch Student CBT Exams ////
function _fetchAvailableCbtExamsData() {
	const { cbtId } = _getStudentLoginDataSession();
	
	try {
		_callFetchEndPoints({
			url: `cbt/student/exams/fetch-department-class-subject-cbt?cbtId=${cbtId}`,
			accessKey: true,
		})
		.then((response) => {
			_initFetchAvailableCbtExamsData(response);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);

			if (error.status == 0) {
				_showEmptyState({
					container: "availableCbtExamsContent",
					message: "Check your internet connection and try again",
				});

				_callAjaxError(
					() => _fetchAvailableCbtExamsData(),
					error.message
				);
			} else {
				_showEmptyState({
					container: "availableCbtExamsContent",
					message: error.message,
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchAvailableCbtExamsData());
	}
}

/// Render Available CBT Exams Data ///
function _initFetchAvailableCbtExamsData(response) {
	const data = response?.data || [];
	const cbtId = response?.cbtData?.cbtId || "";
	const cbtTitle = response?.cbtData?.cbtTitle || "";
	const viewId = `view${cbtId}`;

	const subjectContent = data.length > 0 ? data.map((subjectItem) => {
		const subjectName = subjectItem?.subjectData?.subjectName || "";
		const subjectId = subjectItem?.subjectData?.subjectId || "";

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
						title="TAKE EXAM"
						onclick="event.stopPropagation(); _fetchStudentEachCbtPageDetails('${cbtId}', '${subjectId}');">
						<i class="bi bi-tv"></i> TAKE EXAM
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
				This CBT exam is not currently available.
					<br>
					Kindly check back later or contact the administrator.
				</p>
			</div>
		`;

	const content = `
		<div
			class="toggle-card"
			onclick="_chevronCollapse('${viewId}')">
			<div class="title-content">
				<div class="number">
					1
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
				id="${viewId}answer">

				<div class="toggle-list-wrapper">
					${subjectContent}
				</div>
			</div>
		</div>
	`;
	$("#availableCbtExamsContent").html(content);
}

/// Fetch Each CBT Page Details ////
function _fetchStudentEachCbtPageDetails(cbtId, subjectId) {
	$("#get-form-more-div")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);

	try {
		_callFetchEndPoints({
			url: `cbt/student/exams/fetch-quiz-details?cbtId=${cbtId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem(
				"useEachStudentCbtPageDetailsSession",
				JSON.stringify(response?.data)
			);

			_getForm({
				page: 'cbtPageDetails',
				url: cbtStudentPortalMiddleWareUrl
			});
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);

			if (error.status == 0) {
				_callAjaxError(
					() => _fetchStudentEachCbtPageDetails(cbtId, subjectId),
					error.message
				);
				_alertClose();
			} else {
				_showCustomConfirm({
					title: "Unable to fetch details!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_alertClose();
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchStudentEachCbtPageDetails(cbtId, subjectId));
	}
}