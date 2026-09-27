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
			_studentValidationCheck(error.response);
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
		const quizConfigId = subjectItem?.quizConfigId || "";
		const subjectName = subjectItem?.subjectData?.subjectName || "";

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
						onclick="event.stopPropagation(); _fetchStudentEachCbtPageDetails('${quizConfigId}');">
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
function _fetchStudentEachCbtPageDetails(quizConfigId) {
	$("#get-form-more-div")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);

	try {
		_callFetchEndPoints({
			url: `cbt/student/exams/fetch-quiz-details?quizConfigId=${quizConfigId}`,
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
			_studentValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);

			if (error.status == 0) {
				_callAjaxError(
					() => _fetchStudentEachCbtPageDetails(quizConfigId),
					error.message
				);
				_alertClose();
			} else {
				_showCustomConfirm({
					title: "Unable to take exam!",
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
		_callCatchError(() => _fetchStudentEachCbtPageDetails(quizConfigId));
	}
}

///// Set Exam Available Time /////
function _setExamAvailableTime() {
	const lastCountDownTime = useEachStudentCbtPageDetailsSession?.quizSummaryData?.lastCountDownTime ?? "00:00:00";

	const [hours, minutes, seconds] = lastCountDownTime.split(":");
	$("#timeAllowedContainer").html(`
		<div class="countdown-content">
			<p>Available Time</p>

			<div class="countdown-time">
				<span>${hours}:${minutes}:${seconds}</span>
			</div>
		</div>
	`);
}

//// Set Start and Resume Button /////
function _setStartAndResumeBtn() {
	const statusId = useEachStudentCbtPageDetailsSession?.quizSummaryData?.statusId;
	let showStartButton = "";
		if (statusId === 3) {
			showStartButton = `
				<button class="start-btn" id="startExamBtn" title="Start Exam" onclick="_startOrResumeQuiz();">
					<i class="bi bi-play-fill"></i>
					<span>Start Exam</span>
				</button>
			`
		} else if (statusId === 1) {
			showStartButton = `
				<button class="start-btn" id="startExamBtn" title="Resume Exam" onclick="_startOrResumeQuiz();">
					<i class="bi bi-play-fill"></i>
					<span>Resume Exam</span>
				</button>
			`
		}
	$("#showStartButton").html(showStartButton);
}

////// Start or resume Quiz /////
function _startOrResumeQuiz() {
	useEachStudentCbtPageDetailsSession = JSON.parse(
		sessionStorage.getItem("useEachStudentCbtPageDetailsSession")
	);

	///// get btn text/////
	const btnText = $("#startExamBtn").html();
	_btnDisable("startExamBtn", btnText, true);

	try {
		_callFetchEndPoints({
			url: `cbt/student/exams/start-or-resume-quiz?quizConfigId=${useEachStudentCbtPageDetailsSession?.quizSummaryData?.quizConfigId}`,
			accessKey: true,
		})
		.then((response) => {
			///// Save Backend Response /////
			sessionStorage.setItem(
				"startOrReumeQuizSessionData",
				JSON.stringify(response)
			);

			//// get exam page ///
			_getCbtExamPagesTab({
				page: 'studentCbtExamPage',
				url: cbtStudentPortalMiddleWareUrl
			});
		})
		.catch((error) => {
			_studentValidationCheck(error.response);
			_btnDisable("startExamBtn", btnText, false);
			console.error("Error:", error);
			if (error.status == 0) {
				_callAjaxError(
					() => _startOrResumeQuiz(),
					error.message
				);
			} else {
				_showCustomConfirm({
					title: "Unable to proceed!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
			}
		});
	} catch (error) {
		_btnDisable("startExamBtn", btnText, false);
		console.error("Error:", error);
		_callCatchError(
			() => _startOrResumeQuiz()
		);
	}
}

//// Get Start Or Resume Session Ids ////
function _getStartOrResumeSessionIds() {
	const startOrReumeQuizSessionData = JSON.parse(
		sessionStorage.getItem("startOrReumeQuizSessionData") || "{}"
	);

	return {
		quizConfigId: startOrReumeQuizSessionData?.data?.quizConfigId,
	};
}

///// Fetch CBT Buttons /////
function _renderCbtButtons() {
	startOrReumeQuizSessionData = JSON.parse(
		sessionStorage.getItem("startOrReumeQuizSessionData")
	);

	//// Get Total Button Count /////
	const displayBtn = startOrReumeQuizSessionData?.buttons || [];
	const btnCount = displayBtn.length;


	//// Save Total Button Count /////
	sessionStorage.setItem(
		"getTotalBtnCount",
		JSON.stringify(btnCount)
	);

	///// Get Current Question Index /////
		let currentQuestionIndex = JSON.parse(
		sessionStorage.getItem("currentQuestionIndex")
	);

	//// Check If Current Question Index Is Valid /////
	if (currentQuestionIndex === null || currentQuestionIndex < 0 || currentQuestionIndex >= btnCount) {
		currentQuestionIndex = 0;
	}

	//// Clear Number Buttons Container /////
	$("#numButtonContainerId").html("");

	///// Generate Number Buttons /////
	displayBtn.forEach((btnData, index) => {
		const isDone = btnData?.isDone === true;
		const btnContent = `
			<button 
				type="button"
				class="num-btn ${isDone ? "attemptedYes" : "attempteNo"}" 
				id="numBtnId_${index}"
				data-index="${index}"
				onclick="_updateCbtQuestion(
					'${index}',
					'${btnCount}',
					'${btnData?.questionId}',
					'${btnData?.number}'
				)">
				${btnData?.number}
			</button>
		`;
		$("#numButtonContainerId").append(btnContent);
	});

	///// Get Current Question Details /////
	const currentQuestion = displayBtn[currentQuestionIndex];
	const questionId = currentQuestion?.questionId;
	const number = currentQuestion?.number;

	///// Load Current Question /////
	_updateCbtQuestion(currentQuestionIndex, btnCount, questionId, number);
}

///// Fetch CBT Quiz Question Data /////
function _updateCbtQuestion(currentQuestionIndex, btnCount, questionId, number) {
	currentQuestionIndex = Number(currentQuestionIndex);
	btnCount = Number(btnCount);

	///// Save Current Question Index /////
	sessionStorage.setItem(
		"currentQuestionIndex",
		JSON.stringify(currentQuestionIndex)
	);

	///// Get Start Or Resume Quiz Session Data /////
	startOrReumeQuizSessionData = JSON.parse(
		sessionStorage.getItem("startOrReumeQuizSessionData")
	);

	///// Get Current Countdown /////
	const currentCountDownTime = JSON.parse(
		sessionStorage.getItem("getCurrentTime")
	);

	///// Get Original Countdown /////
	const lastCountDownTime = startOrReumeQuizSessionData?.data?.lastCountDownTime;

	///// Check If User Has Started The Exam /////
	const displayBtn = startOrReumeQuizSessionData?.buttons || [];

	const hasStartedExam = displayBtn.some(
		(btnData) => btnData?.isDone === true
	);

	///// Get Countdown Time /////
	const countDownTime = hasStartedExam ? currentCountDownTime || lastCountDownTime : lastCountDownTime;

	///// Get Session IDs /////
	const { quizConfigId } = _getStartOrResumeSessionIds();

	///// Remove Active From All Buttons /////
	$(".question-num-div .num-btn").removeClass("active");

	///// Add Active To Current Button /////
	$("#numBtnId_" + currentQuestionIndex).addClass("active");

	///// Previous Button State /////
	$("#prevButton").prop("disabled", currentQuestionIndex <= 0);

	///// Next / Finish Button State /////
	if (currentQuestionIndex >= btnCount - 1) {
		$("#nextBtn").html(`Finish <i class="bi bi-check-circle"></i>`).attr("title", "Finish").off("click").click(_finishQuiz);
	} else {
		$("#nextBtn").html(`Next <i class="bi bi-arrow-right-circle"></i>`).attr("title", "Next").off("click").click(_nextCbtQuestion);
	}

	///// Form Data /////
	const formData = {
		quizConfigId: quizConfigId,
		questionId: questionId,
		lastCountDownTime: countDownTime
	};

	try {
		_callRawEndPoints({
			url: `cbt/student/exams/fetch-next-questions`,
			formData,
			accessKey: true
		})
		.then((response) => {
			///// Render Question /////
			_renderFetchNextQuestionsData(response, number);
		})
		.catch((error) => {
			_studentValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status == 0) {
				_callAjaxError(() => _updateCbtQuestion(currentQuestionIndex, btnCount, questionId, number),
					"Check your internet connection and try again"
				);
			} else {
				_callAjaxError(() => _updateCbtQuestion(currentQuestionIndex, btnCount, questionId, number), error.message
				);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _updateCbtQuestion(currentQuestionIndex, btnCount, questionId, number)
		);
	}
}

///// Render Next Questions Data /////
function _renderFetchNextQuestionsData(response, number) {
	const questionData = response?.questionData;
	const optionData = response?.optionData || [];

	const questionPix = questionData?.questionPix
		? `
			<div class="pix-div">
				<img 
					src="${questionPixPath}/${questionData.questionPix}?t=${new Date().getTime()}" 
					alt="Question Image"
				/>
			</div>
		`
		: "";

	const options = optionData.map((option) => {
		const optionPix = option?.optionPix
			? `
				<div class="pix">
					<img 
						src="${optionPixPath}/${option.optionPix}?t=${new Date().getTime()}" 
						alt="Option ${option.optionId}"
					/>
				</div>
			`
			: "";

		return `
			<label class="each-option">
				<div class="radio-wrapper">
					<div class="radio-div">
						<input 
							type="radio"
							name="question_${questionData.questionId}"
							value="${option?.optionId}"
							onchange="_attemptCbtQuestion(
								'${option?.optionId}',
								'${questionData?.questionId}'
							)"
						>
						<span class="radio-custom"></span>
					</div>

					<div class="letter">
						${option?.optionId}
					</div>
				</div>
				${optionPix}
				<div>
					${option?.optionText || ""}
				</div>
			</label>
		`;
	}).join("");
	const content = `
		<div class="question-div">
			<div class="div-in">
				<div class="check-div">
					<label>
						<span>
							Question ${Number(number)}
						</span>
					</label>
				</div>

				<div class="each-question">
					${questionPix}
					<div class="text-div">
						<div>
							<p>
								${questionData?.questionText || ""}
							</p>
						</div>

						<div class="options-div">
							${options}
						</div>
					</div>
				</div>
			</div>
		</div>
	`;
	$("#quizQuestionContent").html(content);

	///// Restore Selected Answer /////
	_restoreSelectedCbtAnswer(questionData?.questionId);
}

///// Attempt CBT Question Answer /////
function _attemptCbtQuestion(optionId, questionId) {
	const { quizConfigId } = _getStartOrResumeSessionIds();

	const lastCountDownTime = JSON.parse(
		sessionStorage.getItem("getCurrentTime")
	);

	const formData = {
		quizConfigId: quizConfigId,
		questionId: questionId,
		lastCountDownTime: lastCountDownTime,
		optionId: optionId
	};

	try {
		_callRawEndPoints({
			url: `cbt/student/exams/attempt-question`,
			formData,
			accessKey: true
		})
		.then(() => {
			///// Get Selected Answers /////
			let selectedAnswers = JSON.parse(
				sessionStorage.getItem("cbtSelectedAnswers")
			) || {};

			///// Save Selected Option /////
			selectedAnswers[questionId] = optionId;

			sessionStorage.setItem(
				"cbtSelectedAnswers",
				JSON.stringify(selectedAnswers)
			);

			///// Change Current Button To Attempted /////
			$(".question-num-div .num-btn.active").removeClass("attempteNo active").addClass("attemptedYes");
		})
		.catch((error) => {
			_studentValidationCheck(error.response);
			console.error("Error:",error);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(
			() => _attemptCbtQuestion(optionId, questionId)
		);
	}
}

///// Restore Selected CBT Answer /////
function _restoreSelectedCbtAnswer(questionId) {
	const selectedAnswers = JSON.parse(
		sessionStorage.getItem("cbtSelectedAnswers")
	) || {};

	const selectedOption = selectedAnswers[questionId];
	if (!selectedOption) {
		return;
	}

	///// Restore Radio Button /////
	const selectedInput = $(
		`#quizQuestionContent input[value="${selectedOption}"]`
	);

	///// Restore Selected Option Style /////
	selectedInput.prop("checked", true);

	///// Restore Button State /////
	$(".question-num-div .num-btn.active").removeClass("active attempteNo").addClass("attemptedYes");
}

///// Next CBT Question /////
function _nextCbtQuestion() {
	const displayBtn = startOrReumeQuizSessionData?.buttons || [];
	const btnCount = displayBtn.length;

	///// Get Current Question Index /////
	let currentQuestionIndex = JSON.parse(
		sessionStorage.getItem("currentQuestionIndex")
	);

	///// Check If Current Question Is Last Question /////
	if (currentQuestionIndex === null || currentQuestionIndex >= btnCount - 1) {
		return;
	}

	///// Get Next Question Index /////
	currentQuestionIndex++;
	const nextQuestion = displayBtn[currentQuestionIndex];

	///// Update Current Question /////
	_updateCbtQuestion(
		currentQuestionIndex,
		btnCount,
		nextQuestion?.questionId,
		nextQuestion?.number
	);
}

///// Previous CBT Question /////
function _previousCbtQuestion() {
	const displayBtn = startOrReumeQuizSessionData?.buttons || [];
	const btnCount = displayBtn.length;

	///// Get Current Question Index /////
	let currentQuestionIndex = JSON.parse(
		sessionStorage.getItem("currentQuestionIndex")
	);

	///// Check If Current Question Is First Question /////
	if (currentQuestionIndex === null || currentQuestionIndex <= 0) {
		return;
	}

	///// Get Previous Question Index /////
	currentQuestionIndex--;
	const previousQuestion = displayBtn[currentQuestionIndex];

	///// Update Current Question /////
	_updateCbtQuestion(
		currentQuestionIndex,
		btnCount,
		previousQuestion?.questionId,
		previousQuestion?.number
	);
}

///// Finish CBT Quiz /////
function _finishQuiz() {
	const { quizConfigId } = _getStartOrResumeSessionIds();

	const lastCountDownTime = JSON.parse(
		sessionStorage.getItem("getCurrentTime")
	);

	///// get btn text/////
	const btnText = $("#nextBtn").html();
	_btnDisable("nextBtn", btnText, true);

	const formData = {
		quizConfigId: quizConfigId,
		lastCountDownTime: lastCountDownTime,
	};

	try {
		_callRawEndPoints({
			url: `cbt/student/exams/finish-quiz`,
			formData,
			accessKey: true
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					_alertClose();
				},
				title: 'Congratulations!',
				message: response?.message,
				alertType: 'success',
				trueActionBtnText: 'Done.',
				closeOnOverlayClick: false,
			});
		})
		.catch((error) => {
			_studentValidationCheck(error.response);
			console.error("Error:", error);
			_btnDisable("nextBtn", btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _finishQuiz());
		_btnDisable("nextBtn", btnText, false);
	}
}