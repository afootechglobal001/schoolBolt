function _getActiveCbtPagesTab(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getCbtPagesDetails'
    } = props;
	_getActiveCbtPagesTabLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: cbtAdminMiddleWareUrl});
	}
}
function _getActiveCbtPagesTabLink(divid){
	$('#questionBank, #quizQuestion, #loadQuestionManually, #loadQuestionAutomatically').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}

/// Set Question Bank Search Filter ////
function _filtersCbtQuestionBankData(value) {
  $("#questionBankContent .question-div").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

/// Check All Questions ////
function _checkAll(){
  $(document).ready(function() {
    $('#parent').on('change', function() {
        $('.child').prop('checked', this.checked);
    });
    $('.child').on('change', function() {
        $('#parent').prop('checked', $('.child:checked').length===$('.child').length);
    });
});
}

/// Proceed Download Question Template ////
function _downloadQuestionTemplate(){
	try {
		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_processDownloadQuestionTemplateCallback();
		},
			title: "Are you sure?",
			message: 'Are you sure you want to download question template? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _downloadQuestionTemplate());
	}
}

/// Process Download Question Template ////
function _processDownloadQuestionTemplateCallback() {
    ///// get btn text/////
	const btnText = $("#downloadBtn").html();
    _btnDisable("downloadBtn", btnText, true);
    
    const url = websiteUrl + '/uploaded_files/cbt/question-template/template.csv';
    window.open(url, '_blank');

    _actionAlert("Question template downloaded successfully.", true);
    _btnDisable("downloadBtn", btnText, false);
}

//// Get CBT Page Details Session ////
function _getCbtPageDetailsSeeion() {
	const useEachCbtPageDetailsSession = JSON.parse(
		sessionStorage.getItem("useEachCbtPageDetailsSession") || "{}"
	);

	return {
		cbtId: useEachCbtPageDetailsSession?.cbtData?.cbtId,
		departmentId: useEachCbtPageDetailsSession?.departmentData?.departmentId,
		classId: useEachCbtPageDetailsSession?.classData?.classId,
		subjectId: useEachCbtPageDetailsSession?.subjectData?.subjectId,
	};
}

/// Fetch CBT Question Bank Data ////
function _fetchCbtQuestionBankData() {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();

	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-questions-bank?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			_initCbtQuestionBankData(response);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);

			if (error.status == 0) {
				_showEmptyState({
					container: "questionBankContent",
					message: "Check your internet connection and try again",
				});

				_callAjaxError(() => _fetchCbtQuestionBankData(), error.message);
			} else {
				_showEmptyState({
					container: "questionBankContent",
					message: error.message,
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchCbtQuestionBankData());
	}
}

/// Initialize Fetch CBT Question Bank Data ////
function _initCbtQuestionBankData(response) {
	const isShowBtn = response
	? `<button class="btn" id="submitBtn" title="Set As Questions Quiz" onclick="_proceedSetQuizQuestions();">
			<i class="bi-check2-circle"></i> Set As Quiz Questions
		</button>
		<button class="btn del-btn" id="deleteBtn" title="Delete Quiz Questions" onclick="_proceedDeleteQuestions();">
			<i class="bi-trash"></i> Delete Questions
		</button>`
	: "";
	$("#fetchBtnDiv").html(isShowBtn);
	
	const content = response?.data?.map((item, index) => {
		const questionPix = item?.questionPix
			? `
				<div class="pix-div">
					<img src="${questionPixPath}/${item.questionPix + '?t=' + new Date().getTime()}" alt="Question Image"/>
				</div>
			`
			: "";

		const options = item?.optionsData?.map((option) => {
			const optionPix = option?.optionPix
				? `
					<div class="pix">
						<img src="${optionPixPath}/${option?.optionPix + '?t=' + new Date().getTime()}" alt="${option?.optionId}"/>
					</div>
				`
				: "";

			return `
				<div class="each-option ${item?.questionAnswer === option?.optionId ? "correct-option" : ""}">
					<div class="letter ${item?.questionAnswer === option?.optionId ? "correct-letter" : ""}">
						${option?.optionId}
					</div>
					${optionPix}
					<div>${option?.optionText}</div>
				</div>
			`;
		}).join("");

		return `
			<div class="question-div" id="question${item?.questionId}">
				<div class="div-in">
					<div class="check-div">
						<label>
							<input 
								type="checkbox" 
								class="child" 
								name="questionId[]" 
								data-value="${item?.questionId}"
							>
							<span>Question ${index + 1}</span>
						</label>

						<div class="btn-div">
							<button class="btn" title="Edit Question" onclick="_fetchEachQuestion('${item?.cbtId}','${item?.departmentId}','${item?.classId}','${item?.subjectId}','${item?.questionId}');">
								<i class="bi-pencil-square"></i> Edit
							</button>
						</div>
					</div>

					<div class="each-question">
						${questionPix}
						<div class="text-div">
							<div>
								<p>${item?.questionText}</p>
							</div>

							<div class="options-div">
								${options}
							</div>
						</div>
					</div>
				</div>
			</div>
		`;
	}).join("");
	$("#questionBankContent").html(content);
}

/// Fetch CBT Quiz Question Data ////
function _fetchCbtQuizQuestionData() {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();

	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-quiz-questions?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			_initCbtQuizQuestionData(response);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);

			if (error.status == 0) {
				_showEmptyState({
					container: "quizQuestionContent",
					message: "Check your internet connection and try again",
				});

				_callAjaxError(() => _fetchCbtQuizQuestionData(), error.message);
			} else {
				_showEmptyState({
					container: "quizQuestionContent",
					message: error.message,
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchCbtQuizQuestionData());
	}
}

/// Initialize Fetch CBT Quiz Question Data ////
function _initCbtQuizQuestionData(response) {
	const isShowBtn = response?.quizData?.statusId === 8
		? `<button class="btn" id="approveBtn" title="Approve Questions" onclick="_approveQuestions();">
				<i class="bi-check2-circle"></i> Approve Questions
			</button>`
		: `<button class="btn del-btn" id="disapproveBtn" title="Disapprove Questions" onclick="_disapproveQuestions();">
				<i class="bi-trash"></i> Disapprove Questions
			</button>`;
	$("#quizQuestionBtnDiv").html(isShowBtn);
	$("#quizDuration").html(response?.quizData?.timeAllowed || "00:00:00");
	
	const content = response?.data.map((item) => {	
		const questionPix = item?.questionPix
			? `
				<div class="pix-div">
					<img src="${questionPixPath}/${item?.questionPix + '?t=' + new Date().getTime()}" alt="Question Image"/>
				</div>
			`
			: "";

		const options = item?.optionsData?.map((option) => {
			const optionPix = option?.optionPix
				? `
					<div class="pix">
						<img src="${optionPixPath}/${option?.optionPix + '?t=' + new Date().getTime()}" alt="${option?.optionId}"/>
					</div>
				`
				: "";

			const isCorrect = item?.questionAnswer === option?.optionId;

			return `
				<div class="each-option ${isCorrect ? "correct-option" : ""}">
					<div class="letter ${isCorrect ? "correct-letter" : ""}">
						${option?.optionId}
					</div>
					${optionPix}
					<span>${option?.optionText}</span>
				</div>
			`;
		}).join("");

		return `
			<div class="question-div">
				<div class="div-in">
					<div class="each-question">
						${questionPix}
						<div class="text-div">
							<div>
								<p>${item?.questionText}</p>
							</div>

							<div class="options-div">
								${options}
							</div>
						</div>
					</div>
				</div>
			</div>
		`;
	}).join("");
	$("#quizQuestionContent").html(content);
}

/// Fetch Each Cbt Question ////
function _fetchEachQuestion(cbtId, departmentId, classId, subjectId, questionId) {
	///// get btn text/////
	$("#get-more-div-secondary")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);

	try {
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/fetch-questions-bank?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}&questionId=${questionId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem(
				"useEachCbtQuestionSession",
				JSON.stringify(response?.data?.[0])
			);

			_getActiveCbtPagesTab({
				divid: 'loadQuestionManually',
				page: 'loadQuestionManually',
				url: cbtAdminMiddleWareUrl
			});
			_alertClose(2);
		})	
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose(2);
			console.error("Error:", error);
			_callAjaxError(
				() => _fetchEachQuestion(cbtId, departmentId, classId, subjectId, questionId),
				error.message
			);
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error:", error);
		_callCatchError(() => _fetchEachQuestion(cbtId, departmentId, classId, subjectId, questionId));
	}
}

///// Upload Question Automatically ////
function _uploadQuestionAutomatically(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
  		const questionTemplateFile = $('#questionTemplate').prop('files')[0];
		
		if (!questionTemplateFile) {
			$("#issues_questionTemplate").html("(.CSV) QUESTION TEMPLATE FILE IS REQUIRED").fadeIn();
			$("#issueBorder").addClass("issue");
			issueCount ++
		} else {
			$("#issues_questionTemplate").html("");
			$("#issueBorder").removeClass("issue");
		}
		
		if (issueCount > 0) return;

		// Gather form data //
		const formData = new FormData();
      	formData.append("questionTemplate", questionTemplateFile);

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveUploadQuestionAutomaticallyCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to upload question automatically? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _uploadQuestionAutomatically());
	}
}

/// Create And Update CBT Configuration Call Back ////
function _saveUploadQuestionAutomaticallyCallback(formData) {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);
	
	//// call endpoint //////
	_callFileEndPoints({
		url: `cbt/admin/set-exam/upload-questions-automatically?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				_getActiveCbtPagesTab({
					divid: 'questionBank',
					page: 'questionBank',
					url: cbtAdminMiddleWareUrl
				});
			},
			title: 'Success!',
			message: response?.message,
			alertType: 'success',
			trueActionBtnText: 'Done.',
			closeOnOverlayClick: false,
		});
		_btnDisable("submitBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveUploadQuestionAutomaticallyCallback(formData, error.message)); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_showCustomConfirm({
                title: "Unable to Upload Question Automatically",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

//// Question Pix Preview ////
$(function () {
  quizQuestionPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizQuestionPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

//// Option A Pix Preview ////
$(function () {
  quizOptionAPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizOptionAPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

//// Option B Pix Preview ////
$(function () {
  quizOptionBPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizOptionBPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

//// Option C Pix Preview ////
$(function () {
  quizOptionCPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;
        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizOptionCPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


//// Option D Pix Preview ////
$(function () {
  quizOptionDPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizOptionDPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});

//// Option E Pix Preview ////
$(function () {
  quizOptionEPixPreview = {
    UpdatePreview: function (obj) {
      // if IE < 10 doesn't support FileReader
      if (!window.FileReader) {
        // don't know how to proceed to assign src to image tag
      } else {
        var reader = new FileReader();
        var target = null;

        reader.onload = function (e) {
          target = e.target || e.srcElement;
          $("#quizOptionEPix").prop("src", target.result);
        };
        reader.readAsDataURL(obj.files[0]);
      }
    },
  };
});


///// Upload Question Manually ////
function _uploadQuestionsManually() {
	tinyMCE.triggerSave();
	try {
		////////get all needed values////////////
		let issueCount = 0;
  		const questionText = $('#questionText').val();
		const questionPixFile = $('#questionPix').prop('files')[0];
		const optionA = $('#optionA').val();
		const optionAPixFile = $('#optionAPix').prop('files')[0];
		const optionB = $('#optionB').val();
		const optionBPixFile = $('#optionBPix').prop('files')[0];
		const optionC = $('#optionC').val();
		const optionCPixFile = $('#optionCPix').prop('files')[0];
		const optionD = $('#optionD').val();
		const optionDPixFile = $('#optionDPix').prop('files')[0];
		const optionE = $('#optionE').val();
		const optionEPixFile = $('#optionEPix').prop('files')[0];
		const questionAnswer = $('#questionAnswer').val();
		
		if (!questionText) {
			$("#questionText").addClass("issue");
			$("#issue_questionText").html("QUESTION IS REQUIRED");
			issueCount += 1;
		} else {
			$("#questionText").removeClass("issue");
			$("#issue_questionText").html("");
		}

		if (!optionA) {
			$("#optionA").addClass("issue");
			$("#issue_optionA").html("OPTION A IS REQUIRED");
			issueCount += 1;
		} else {
			$("#optionA").removeClass("issue");
			$("#issue_optionA").html("");
		}

		if (!optionB) {
			$("#optionB").addClass("issue");
			$("#issue_optionB").html("OPTION B IS REQUIRED");
			issueCount += 1;
		} else {
			$("#optionB").removeClass("issue");
			$("#issue_optionB").html("");
		}
		
		if (!optionC) {
			$("#optionC").addClass("issue");
			$("#issue_optionC").html("OPTION C IS REQUIRED");
			issueCount += 1;
		} else {
			$("#optionC").removeClass("issue");
			$("#issue_optionC").html("");
		}

		if (!optionD) {
			$("#optionD").addClass("issue");
			$("#issue_optionD").html("OPTION D IS REQUIRED");
			issueCount += 1;
		} else {
			$("#optionD").removeClass("issue");
			$("#issue_optionD").html("");
		}

		if (!optionE) {
			$("#optionE").addClass("issue");
			$("#issue_optionE").html("OPTION E IS REQUIRED");
			issueCount += 1;
		} else {
			$("#optionE").removeClass("issue");
			$("#issue_optionE").html("");
		}

		issueCount += _validateEmptyValue("questionAnswer", "QUESTION ANSWER IS REQUIRED");
		
		if (issueCount > 0) return;

		// Gather form data //
		const formData = new FormData();
		formData.append("questionText", questionText);
		formData.append("optionA", optionA);
		formData.append("optionB", optionB);
		formData.append("optionC", optionC);
		formData.append("optionD", optionD);
		formData.append("optionE", optionE);
		formData.append("questionAnswer", questionAnswer);

		if (questionPixFile) {
			formData.append("questionPix", questionPixFile);
		}

		if (optionAPixFile) {
			formData.append("optionAPix", optionAPixFile);
		}

		if (optionBPixFile) {
			formData.append("optionBPix", optionBPixFile);
		}

		if (optionCPixFile) {
			formData.append("optionCPix", optionCPixFile);
		}

		if (optionDPixFile) {
			formData.append("optionDPix", optionDPixFile);
		}

		if (optionEPixFile) {
			formData.append("optionEPix", optionEPixFile);
		}

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_uploadQuestionsManuallyCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to upload question manually? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _uploadQuestionsManually(formData));
	}
}

/// Upload Question Manually Call Back ////
function _uploadQuestionsManuallyCallback(formData) {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	useEachCbtQuestionSession = JSON.parse(
        sessionStorage.getItem("useEachCbtQuestionSession") || "{}"
    );

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);

	let url = useEachCbtQuestionSession?.questionId ? `cbt/admin/set-exam/update-questions-manually?questionId=${useEachCbtQuestionSession?.questionId}` : `cbt/admin/set-exam/upload-questions-manually?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`;
	
	//// call endpoint //////
	_callFileEndPoints({
		url,
		formData,
		accessKey: true,
	})
	.then((response) => {
		const message = response?.message;
		const newQuestionPixName = response?.data?.questionPixName;
		const optionImages = response?.data?.optionImages || [];

		_uploadQuestionsImages(newQuestionPixName, optionImages, message, btnText);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _uploadQuestionsManuallyCallback(formData)); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_showCustomConfirm({
                title: "Unable to Upload Question Manually",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

///// Upload Questions Images ////
function _uploadQuestionsImages(newQuestionPixName, optionImages, message, btnText) {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	//// Get question pix
	var questionPix = document.getElementById("quizQuestionPix")?.src || "";
	var optionAPix = document.getElementById("quizOptionAPix")?.src || "";
	var optionBPix = document.getElementById("quizOptionBPix")?.src || "";
	var optionCPix = document.getElementById("quizOptionCPix")?.src || "";
	var optionDPix = document.getElementById("quizOptionDPix")?.src || "";
	var optionEPix = document.getElementById("quizOptionEPix")?.src || "";

	/// Check if question pix is new
	var isNewQuestionPix = questionPix.startsWith("data:image");
	var isNewOptionAPix = optionAPix.startsWith("data:image");
	var isNewOptionBPix = optionBPix.startsWith("data:image");
	var isNewOptionCPix = optionCPix.startsWith("data:image");
	var isNewOptionDPix = optionDPix.startsWith("data:image");
	var isNewOptionEPix = optionEPix.startsWith("data:image");

	// Nothing new to upload
	if (
		!isNewQuestionPix &&
		!isNewOptionAPix &&
		!isNewOptionBPix &&
		!isNewOptionCPix &&
		!isNewOptionDPix &&
		!isNewOptionEPix
	) {
		_showCustomConfirm({
			callback: () => {
				_showLoader("Please wait while we update your question!");
				Promise.resolve(
					_fetchEachCbtPageDetails(
						cbtId,
						departmentId,
						classId,
						subjectId
					)
				).finally(() => {
					_hideLoader();
					_btnDisable("submitBtn", btnText, false);
				});
			},
			title: 'Success!',
			message: message,
			alertType: 'success',
			trueActionBtnText: 'Done.',
			closeOnOverlayClick: false,
		});
		_hideLoader();
		_btnDisable("submitBtn", btnText, false);
		return;
	}

	const formData = new FormData();
	formData.append("action", "uploadQuestionsPix");

	// Question image First 
	if (isNewQuestionPix) {
		formData.append("newQuestionPixName", newQuestionPixName);
		formData.append("questionPix", questionPix);
	}

	// Loop through backend option images
	optionImages.forEach((optionImage) => {
		const optionId = optionImage?.optionId;
		const newPixName = optionImage?.pixName;

		let optionPix = "";
		let isNewOptionPix = false;

		if (optionId === "A") {
			optionPix = optionAPix;
			isNewOptionPix = isNewOptionAPix;
		} else if (optionId === "B") {
			optionPix = optionBPix;
			isNewOptionPix = isNewOptionBPix;
		} else if (optionId === "C") {
			optionPix = optionCPix;
			isNewOptionPix = isNewOptionCPix;
		} else if (optionId === "D") {
			optionPix = optionDPix;
			isNewOptionPix = isNewOptionDPix;
		} else if (optionId === "E") {
			optionPix = optionEPix;
			isNewOptionPix = isNewOptionEPix;
		}

		// Only append if this option has a new image
		if (isNewOptionPix && newPixName) {
			formData.append(`newOption${optionId}PixName`, newPixName);
			formData.append(`option${optionId}Pix`, optionPix);
		}
	});

	_callFileEndPoints({
		url: cbtAdminMiddleWareUrl,
		formData,
		expectJson: false,
	})
	.then(() => {
		_showCustomConfirm({
			callback: () => {
				_showLoader("Please wait while we update your question!");
				Promise.resolve(
					_fetchEachCbtPageDetails(
						cbtId,
						departmentId,
						classId,
						subjectId
					)
				).finally(() => {
					_hideLoader();
					_btnDisable("submitBtn", btnText, false);
				});
			},
			title: 'Success!',
			message: message,
			alertType: 'success',
			trueActionBtnText: 'Done.',
			closeOnOverlayClick: false,
		});
		_btnDisable("submitBtn", btnText, false);
		_hideLoader();
	})
	.catch((error) => {
		console.error("Error:", error);
		_hideLoader();
		_callAjaxError(
			() => _uploadQuestionsImages(
				newQuestionPixName,
				optionImages,
				message,
				btnText
			),
			error.message
		);
	});
}

//// Fetch Time Count Option ////
function _fetchTimeCountOption(selectId, maxValue) {
  for (let minValue = 0; minValue <= maxValue; minValue++) {
	  let paddedValue = String(minValue).padStart(2, '0');
	  $("#searchList_" + selectId).append(`
		<li onclick="
			_clickOption(
			'searchList_${selectId}',
			'${paddedValue}',
			'${paddedValue}'
			);
		">
		${paddedValue}
	</li>
	`);
  }
}

//// Proceed Set Quiz Questions ////
function _proceedSetQuizQuestions() {
	try {
		//////// get all needed values ////////////
		let selectedQuestions = [];

		$(".child:checked").each(function () {
			selectedQuestions.push({
				questionId: $(this).data("value")
			});
		});

		const checked = selectedQuestions.length;

		$("#questionId").removeClass("issue");

		if (checked < 1) {
			$("#questionId").addClass("issue");
			_actionAlert("Select at least a question to continue", false);
			return;
		}

		// Save selected questions in session
		useSetSelectedQuizQuestions = {
			questionIds: selectedQuestions,
			totalQuestions: checked
		};

		sessionStorage.setItem(
			"useSetSelectedQuizQuestions",
			JSON.stringify(useSetSelectedQuizQuestions)
		);

		_getForm({
			page: 'setQuizQuestionsForm',
			layer: 2,
			url: cbtAdminMiddleWareUrl
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _proceedSetQuizQuestions());
	}
}

//// Set Quiz Questions ////
function _setQuizQuestions() {
	useSetSelectedQuizQuestions = JSON.parse(
		sessionStorage.getItem("useSetSelectedQuizQuestions")
	);

	try {
		let issueCount = 0;
		const quizHour = $("#quizHour").val()?.trim();
		const quizMinute = $("#quizMinute").val()?.trim();
		const quizSecond = $("#quizSecond").val()?.trim();

		const timeAllowed = `${quizHour}:${quizMinute}:${quizSecond}`;

		///// empty field validation //////////
		issueCount += _validateEmptyValue("quizHour", "HOUR");
		issueCount += _validateEmptyValue("quizMinute", "MINUTE");
		issueCount += _validateEmptyValue("quizSecond", "SECOND");

		// Convert to numbers
		const hours = Number(quizHour);
		const minutes = Number(quizMinute);
		const seconds = Number(quizSecond);

		// Don't allow 00:00:00
		if (hours === 0 && minutes === 0 && seconds === 0) {
			$("#timeAllowed").addClass("issue");
			$("#issue_timeAllowed").html(
				"Time allowed must be greater than zero"
			);
			issueCount += 1;
		} else {
			$("#timeAllowed").removeClass("issue");
			$("#issue_timeAllowed").html("");
		}

		// Get selected questions from session
		const selectedQuestions = useSetSelectedQuizQuestions?.questionIds ?? [];

		if (selectedQuestions.length < 1) {
			_actionAlert("No questions have been selected", false);
			return;
		}

		if (issueCount > 0) return;

		// Save time to session
		useSetSelectedQuizQuestions.timeAllowed = timeAllowed;
		sessionStorage.setItem(
			"useSetSelectedQuizQuestions",
			JSON.stringify(useSetSelectedQuizQuestions)
		);

		// Form Data payload
		const formData = {
			timeAllowed: timeAllowed,
			questionIds: selectedQuestions
		};

		////// confirm action //////
		_showCustomConfirm({
			callback: () => {
				_setQuizQuestionsCallBack(formData);
			},
			title: "Are you sure?",
			message: "Are you sure you want to set these questions?",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _setQuizQuestions());
	}
}

//// Activate Quiz Questions ////
function _setQuizQuestionsCallBack(formData) {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	try {
		///// get btn text/////
		const btnText = $("#setBtn").html();
		_btnDisable("setBtn", btnText, true);
		
		//// call endpoint //////
		_callRawEndPoints({
			url: `cbt/admin/set-exam/set-quiz-questions?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			formData,
			accessKey: true,
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					_alertClose(2);
					_getActiveCbtPagesTab({
						divid: 'quizQuestion',
						page: 'quizQuestion', url: cbtAdminMiddleWareUrl
					});
					_fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId);
				},
				title: 'Success!',
				message: response?.message,
				alertType: 'success',
				trueActionBtnText: 'Done',
				closeOnOverlayClick: false,
			});
			_btnDisable("setBtn", btnText, false);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(() => _setQuizQuestionsCallBack(formData, error.message)); // retry if needed
				_btnDisable("setBtn", btnText, false);
			} else {
				_showCustomConfirm({
					title: "Unable to Set Questions!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("setBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _setQuizQuestionsCallBack(formData));
	}
}

//// Approve Quiz Questions ////
function _approveQuestions() {
	try {
		////// confirm action //////
		_showCustomConfirm({
			callback: () => {
				_approveQuestionsCallBack();
			},
			title: "Are you sure?",
			message: "Are you sure you want to approve these questions?",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _approveQuestions());
	}
}

//// Approve Quiz Questions Callback////
function _approveQuestionsCallBack() {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	try {
		///// get btn text/////
		const btnText = $("#approveBtn").html();
		_btnDisable("approveBtn", btnText, true);
		
		//// call endpoint //////
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/approve-quiz-questions?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					_getActiveCbtPagesTab({
						divid: 'quizQuestion',
						page: 'quizQuestion', url: cbtAdminMiddleWareUrl
					});
				},
				title: 'Success!',
				message: response?.message,
				alertType: 'success',
				trueActionBtnText: 'Done',
				closeOnOverlayClick: false,
			});
			_btnDisable("approveBtn", btnText, false);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(() => _approveQuestionsCallBack(error.message)); // retry if needed
				_btnDisable("approveBtn", btnText, false);
			} else {
				_showCustomConfirm({
					title: "Unable to Approve Questions!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("approveBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _approveQuestionsCallBack());
	}
}

//// Disapprove Quiz Questions ////
function _disapproveQuestions() {
	try {
		////// confirm action //////
		_showCustomConfirm({
			callback: () => {
				_disapproveQuestionsCallBack();
			},
			title: "Are you sure?",
			message: "Are you sure you want to disapprove these questions?",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _disapproveQuestions());
	}
}

//// Disapprove Quiz Questions Callback////
function _disapproveQuestionsCallBack() {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	try {
		///// get btn text/////
		const btnText = $("#disapproveBtn").html();
		_btnDisable("disapproveBtn", btnText, true);
		
		//// call endpoint //////
		_callFetchEndPoints({
			url: `cbt/admin/set-exam/disapprove-quiz-questions?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			accessKey: true,
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					_getActiveCbtPagesTab({
						divid: 'quizQuestion',
						page: 'quizQuestion', url: cbtAdminMiddleWareUrl
					});
				},
				title: 'Success!',
				message: response?.message,
				alertType: 'success',
				trueActionBtnText: 'Done',
				closeOnOverlayClick: false,
			});
			_btnDisable("disapproveBtn", btnText, false);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(() => _disapproveQuestionsCallBack(error.message)); // retry if needed
				_btnDisable("disapproveBtn", btnText, false);
			} else {
				_showCustomConfirm({
					title: "Unable to Disapprove Questions!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("disapproveBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _disapproveQuestionsCallBack());
	}
}


//// Delete Questions ////
function _proceedDeleteQuestions() {
	try {
		//////// get all needed values ////////////
		let selectedQuestions = [];

		$(".child:checked").each(function () {
			selectedQuestions.push({
				questionId: $(this).data("value")
			});
		});

		const checked = selectedQuestions.length;

		$("#questionId").removeClass("issue");

		if (checked < 1) {
			$("#questionId").addClass("issue");
			_actionAlert("Select at least a question to delete", false);
			return;
		}

		// Save QuestionIds to session
		const useSetSelectedQuizQuestionIds = {
			questionIds: selectedQuestions,
		};

		sessionStorage.setItem(
			"useSetSelectedQuizQuestionIds",
			JSON.stringify(useSetSelectedQuizQuestionIds)
		);

		// Save selected questions in session
		formData = {
			questionIds: selectedQuestions,
		};

		////// confirm action //////
		_showCustomConfirm({
			callback: () => {
				_deleteQuestionsCallBack();
			},
			title: "Are you sure?",
			message: "Are you sure you want to delete these questions?",
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _deleteQuestions());
	}
}

//// Delete Questions Callback////
function _deleteQuestionsCallBack() {
	const { cbtId, departmentId, classId, subjectId } = _getCbtPageDetailsSeeion();
	const { questionIds } = JSON.parse(sessionStorage.getItem("useSetSelectedQuizQuestionIds"));
	try {
		///// get btn text/////
		const btnText = $("#deleteBtn").html();
		_btnDisable("deleteBtn", btnText, true);
		
		//// call endpoint //////
		_callRawEndPoints({
			url: `cbt/admin/set-exam/delete-questions?cbtId=${cbtId}&departmentId=${departmentId}&classId=${classId}&subjectId=${subjectId}`,
			formData,
			accessKey: true,
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					questionIds.forEach(({ questionId }) => {
						$(`#question${questionId}`).fadeOut(300, function () {
							$(this).remove();
						});
					});
					sessionStorage.removeItem("useSetSelectedQuizQuestionIds");
					_fetchEachCbtPageDetails(cbtId, departmentId, classId, subjectId);
				},
				title: 'Success!',
				message: response?.message,
				alertType: 'success',
				trueActionBtnText: 'Done',
				closeOnOverlayClick: false,
			});
			_btnDisable("deleteBtn", btnText, false);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);
			if (error.status==0) {
				_callAjaxError(() => _deleteQuestionsCallBack(error.message)); // retry if needed
				_btnDisable("deleteBtn", btnText, false);
			} else {
				_showCustomConfirm({
					title: "Unable to Delete Questions!",
					message: error.message,
					alertType: "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("deleteBtn", btnText, false);
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _deleteQuestionsCallBack());
	}
}
