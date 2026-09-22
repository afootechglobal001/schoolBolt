function _getCbtExamPagesTab(props) {
	const {
        page = '',
		pageContainer='getCbtExamPanel'
    } = props;
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: cbtStudentPortalMiddleWareUrl});
	}
}

//// Fetch Student CBT Exams ////
function _fetchAvailableCbtExamsData() {
	try {

		// Backend endpoint - uncomment when backend is ready
		/*
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-classes-subject-for-each-cbt`,
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
		*/

		// Dummy response until backend endpoint is ready
		const response = {
			response: 200,
			success: true,
			message: "CLASS SUBJECTS FETCH SUCCESSFULLY!",

			departmentData: {
				departmentId: "DEPARTMENT001",
				departmentName: "KINDERGARTEN"
			},

			classData: {
				classId: "CLASS001",
				className: "KG"
			},

			data: [
				{
					cbtId: "CBT002",
					cbtTitle: "WELCOME TEST",
					subjectAllocatedData: [
						{
							subjectId: "SUBJECT001",
							subjectData: {
								subjectId: "SUBJECT001",
								subjectName: "NUMERACY"
							}
						},
						{
							subjectId: "SUBJECT002",
							subjectData: {
								subjectId: "SUBJECT002",
								subjectName: "ENGLISH LANGUAGE"
							}
						}
					]
				}
			]
		};
		_initFetchAvailableCbtExamsData(response);
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchAvailableCbtExamsData());
	}
}

/// Render Available CBT Exams Data ///
function _initFetchAvailableCbtExamsData(response) {
	const data = response?.data || [];
	const departmentId = response?.departmentData?.departmentId || "";
	const classId = response?.classData?.classId || "";

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
							title="TAKE EXAM"
							onclick="event.stopPropagation(); _fetchEachCbtPageDetails('${item?.cbtId}', '${departmentId}', '${classId}', '${subjectId}');">
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
					id="${viewId}answer">

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
	$("#availableCbtExamsContent").html(content);
}

/// Fetch Each CBT Page Details ////
function _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId) {
	$("#get-form-more-div")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);

	try {

		// Backend endpoint - uncomment when backend is ready
		/*
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-subject-exam-details?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem(
				"useEachCbtPageDetailsSession",
				JSON.stringify(response?.data)
			);

			_getForm({
				page: 'cbtPageDetails',
				url: cbtAdminMiddleWareUrl
			});
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);

			if (error.status == 0) {
				_callAjaxError(
					() => _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId),
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
		*/

		// Dummy response until backend endpoint is ready
		const response = {
			response: 200,
			success: true,
			message: "SUBJECTS ALLOCATED FETCH SUCCESSFULLY!",
			allRecordCount: null,

			data: {
				branchData: {
					branchId: "BRANCH001",
					branchName: "AFOOTECH GLOBAL INTERNATIONAL BASIC SCHOOL",
					address: "121, KOTCO ROAD, OFF LAGOS-IBADAN EXPRESSWAY, ODE REMO, OGUN STATE",
					smtpUsername: "afootech@schoolbolt.org",
					mobileNumber: "08131252996",
					session: "2025/2026",
					termId: 3
				},

				termData: {
					sn: 3,
					termId: 3,
					termName: "THIRD TERM",
					createdTime: "2025-03-17 07:54:18"
				},

				departmentData: {
					departmentId: "DEPARTMENT001",
					departmentName: "KINDERGARTEN"
				},

				classData: {
					classId: "CLASS001",
					className: "KG"
				},

				subjectData: {
					subjectId: subjectId || "SUBJECT001",
					subjectName: "NUMERACY"
				},

				cbtData: {
					cbtId: cbtId || "CBT001",
					cbtTitle: "WELCOME TEST"
				},
				quizData: {
					totalQuizQuestions: 20
				}
			}
		};

		sessionStorage.setItem(
			"useEachStudentCbtPageDetailsSession",
			JSON.stringify(response?.data)
		);

		_getForm({
			page: 'cbtPageDetails',
			url: cbtStudentPortalMiddleWareUrl
		});

	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId));
	}
}