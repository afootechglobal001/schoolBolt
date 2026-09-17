//// create and update faq ///
function _createAndUpdatefaq() {
	try {
		tinyMCE.triggerSave();

		////////get all needed values////////////
		let issueCount = 0;
		const categoryId = $('#categoryId').val().trim();
		const faqQuestion = $('#faqQuestion').val().trim();
		const faqAnswer = $('#faqAnswer').val().trim();
        const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("categoryId", "FAQ CATEGORY");
		issueCount += _validateEmptyValue("faqQuestion", "FAQ QUESTION");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		$("#faqAnswer").removeClass("issue");
  		$("#issue_faqAnswer").html("");

		if (!faqAnswer) {
			$("#faqAnswer").addClass("issue");
			$("#issue_faqAnswer").html("FAQ ANSWER REQUIRED");
			issueCount++;
		}

		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			categoryId,
			faqQuestion,
			faqAnswer,
            statusId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveFaqCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to save? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _createAndUpdatefaq());
	}
}

function _saveFaqCallback(formData) {
    let useEachFaqSession = JSON.parse(sessionStorage.getItem("useEachFaqSession"));
	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);

    let callUrl= useEachFaqSession?.faqId ? `admin/faq/update-faq?faqId=${useEachFaqSession?.faqId}` : `admin/faq/create-faq`;

	//// call endpoint //////
	_callRawEndPoints({
		url: callUrl,
		formData,
		accessKey: true,
	})
    .then((response) => {
		_showCustomConfirm({
			callback: () => {
				_alertClose();
				_getActivePage({page:'faqPage', divid:'faqPage'});
			},
			title: 'Success!',
			message: response.message,
			alertType: 'success',
			trueActionBtnText: 'OK, Thanks.',
		});
		_btnDisable("submitBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveFaqCallback(formData), error.message); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_actionAlert(error.message, false);
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

//// fetch faq data ///
// function _fetchFaqData() {
// 	try {
// 		//// call endpoint //////
// 		_callFetchEndPoints({
// 			url: `admin/faq/fetch-faq`,
// 			accessKey: true,
// 		})
// 		.then((response) => {
//             _initFetchFaqData(response.data);
// 		})
// 		.catch((error) => {
// 			_staffValidationCheck(error.response);
// 			console.error("Error:", error);
// 			if (error.status==0) {
// 				_showFalseNotification({
// 					container: "faqPageContent",
// 					message: "Check your internet connection and try again",
// 				});

// 				_callAjaxError(() => _fetchFaqData(), error.message); // retry if needed
// 			} else {
// 				_showEmptyState({
// 					container: "faqPageContent",
// 					message: error.message,
// 					button: `
// 						<button class="btn" title="ADD NEW FAQ" onclick="sessionStorage.removeItem('useEachFaqSession'); _getForm({page: 'faqReg', url: adminPortalMiddlewareUrl});">
// 							<i class="bi-plus-square"></i> ADD NEW FAQ
// 						</button>
// 					`,
// 				});
// 			}
// 		});
// 	} catch (error) {
// 		console.error("Error:", error);
// 		_callCatchError(() => _fetchFaqData());
//   	}
// }

function _fetchFaqData() {
    const response = {
        data: [
            {
                faqId: "FAQ001",
                faqQuestion: "How do I book a maintenance service?",
                faqAnswer: "You can book a service by calling us, sending a WhatsApp message, or filling out the booking form on our website.",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                faqId: "FAQ002",
                faqQuestion: "What areas do you serve?",
                faqAnswer: "We provide maintenance services across residential and commercial properties within our service coverage areas.",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                faqId: "FAQ003",
                faqQuestion: "Do you offer emergency repairs?",
                faqAnswer: "Yes, we offer emergency repair services for urgent plumbing, electrical, and HVAC issues.",
                statusData: {
                    statusName: "ACTIVE"
                }
            },
            {
                faqId: "FAQ004",
                faqQuestion: "How do I make payment?",
                faqAnswer: "Payments can be made via bank transfer, debit card, or other approved payment methods.",
                statusData: {
                    statusName: "SUSPEND"
                }
            },
            {
                faqId: "FAQ005",
                faqQuestion: "Are your technicians certified?",
                faqAnswer: "Yes, all our technicians are trained, experienced, and certified in their respective fields.",
                statusData: {
                    statusName: "ACTIVE"
                }
            }
        ]
    };

    _initFetchFaqData(response.data);
}

//// init faq data ///
function _initFetchFaqData(data, start = 0) {
  	const content = data.map((item, index) => {
	return `
	<div class="faq-back-div">
		<div class="title-div ${item.statusData?.statusName === 'SUSPEND' ? 'SUSPEND' :""}">
		<div class="num">${start + index + 1}</div>
		<button class="btn" onClick="_fetchEachFaq('${item.faqId}');">
			<i class="bi-pencil-square"></i> 
			<span>${item.faqQuestion}</span>
		</button>
		</div>
		<div class="answer-div">${item.faqAnswer}</div>
	</div>
    `;
  }).join("");

  $('#faqPageContent').html(content);
}

//// fetch each faq data ///
function _fetchEachFaq(faqId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/faq/fetch-faq?faqId=${faqId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("useEachFaqSession", JSON.stringify(response?.data[0]));
			_getForm({page: 'faqReg', url: adminPortalMiddlewareUrl});
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachFaq(faqId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachFaq(faqId));
  	}
}

function _filtersFaq(value) {
  $("#mainFaqPageContent .faq-back-div").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}