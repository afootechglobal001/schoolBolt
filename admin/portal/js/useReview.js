/// Fetch Review List ///
// function _getReviewList(options) {
// 	const {
// 		pageContainer = '',
// 		paginationContainer = '',
// 	    crFlag = "",
//         limit = '',
//         crId = '',
// 		statusId = '',
//     } = options;
// 	try {
// 		//// call endpoint //////
// 		_callFetchEndPoints({
// 			url: `admin/contact-review/fetch-contacts-reviews?crFlag=${crFlag}&limit=${limit || ''}&crId=${crId || ''}&statusId=${statusId || ''}`,
// 			accessKey: true,
// 		})
// 		.then((response) => {
// 			_reviewListDisplay(response?.data, pageContainer, paginationContainer);
// 		})
// 		.catch((error) => {
// 			_staffValidationCheck(error.response);
// 			console.error("Error:", error);
// 			if (error.status==0) {
// 				_showEmptyState({
// 					container: pageContainer,
// 					message: "Check your internet connection and try again",
// 					paginationContainer: paginationContainer,
// 				});
// 			} else {
// 				_showEmptyState({
// 					container: pageContainer,
// 					message: error.message,
// 					paginationContainer: paginationContainer,
// 				});
// 			}
// 		});
// 	} catch (error) {
// 		console.error("Error:", error);
//   	}
// }

/// Fetch Review List ///
function _getReviewList(options) {
	const {
		pageContainer = '',
		paginationContainer = '',
	    crFlag = "",
        limit = '',
        crId = '',
		statusId = '',
    } = options;

	// TEMPORARY DUMMY DATA
	const response = {
		data: [
			{
				crId: "REV001",
				crFlag: "CR001",
				fullName: "Peter Emmanuel",
				emailAddress: "peter@gmail.com",
				message: "Excellent service. The technician arrived on time and completed the repair professionally. I highly recommend BowCare.",
				statusData: {
					statusName: "PENDING"
				}
			},
			{
				crId: "REV002",
				crFlag: "CR002",
				fullName: "Grace Johnson",
				emailAddress: "grace@gmail.com",
				message: "Very satisfied with the quality of work and customer support. Scheduling was easy and seamless.",
				statusData: {
					statusName: "APPROVED"
				}
			},
			{
				crId: "REV003",
				crFlag: "CR003",
				fullName: "Michael Brown",
				emailAddress: "michael@gmail.com",
				message: "Good service overall. Will definitely recommend BowCare to friends and family.",
				statusData: {
					statusName: "REJECTED"
				}
			},
			{
				crId: "REV004",
				crFlag: "CR004",
				fullName: "Sarah Williams",
				emailAddress: "sarah@gmail.com",
				message: "Professional technicians and excellent customer service. The issue was resolved quickly.",
				statusData: {
					statusName: "PENDING"
				}
			},
			{
				crId: "REV005",
				crFlag: "CR005",
				fullName: "David Ojo",
				emailAddress: "david@gmail.com",
				message: "Great experience from booking to completion. Highly recommended.",
				statusData: {
					statusName: "APPROVED"
				}
			}
		]
	};

	_reviewListDisplay(
		response.data,
		pageContainer,
		paginationContainer
	);

	/*
	try {
		_callFetchEndPoints({
			url: `admin/contact-review/fetch-contacts-reviews?crFlag=${crFlag}&limit=${limit || ''}&crId=${crId || ''}&statusId=${statusId || ''}`,
			accessKey: true,
		})
		.then((response) => {
			_reviewListDisplay(response?.data, pageContainer, paginationContainer);
		})
		.catch((error) => {
			// existing error handling
		});
	} catch (error) {
		console.error("Error:", error);
  	}
	*/
}
//// Display Page Review List ////
function _reviewListDisplay(data, pageContainer, paginationContainer) {
	if (pageContainer === "fetchDashboardReviews") {
		_dashboardReviewData(data, pageContainer);
	}
	if (pageContainer === "fetchPageReviewContent") {
		_initFetchReviewData(
			data,
			pageContainer,
			paginationContainer
		);
	}
}

/// Initialize Dashboard Review List ///
function _dashboardReviewData(data, pageContainer) {
	const content = data.map((item) => {
    return `
      	<div class="review-div">
			<div class="review-header">
				<div class="review-user">
					<div class="avatar">
						${getFirstLettersOfEachWord(item?.fullName)}		
					</div>

					<div class="user-info">
						<h4>${item?.fullName}</h4>
						<span>
							${item?.emailAddress}
						</span>
					</div>
				</div>

				<div class="review-meta">
					<div class="star-div">
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
					</div>

					<span class="status ${item?.statusData?.statusName}">
						${item?.statusData?.statusName}
					</span>
				</div>
			</div>

			<div class="review-content">
				${item?.message.substring(0, 129)}
				${item?.message.length > 129 ? '...' : ''}
			</div>

			<div class="review-action">
				<button class="btn page-view-btn" title="Approve Review" onclick="_fetchEachReview('${item?.crId}', '${item?.crFlag}', 'DASHBOARDFORM');">
					<i class="bi bi-check-all"></i>
					APPROVE
				</button>
			</div>
		</div>
    `;
  }).join("");
  $(`#${pageContainer}`).html(content);
}

function _renderPageReviewData(data) {
	return data.map((item) => `
		<div class="review-div">

			<div class="review-header">

				<div class="review-user">
					<div class="avatar">
						${getFirstLettersOfEachWord(item.fullName)}
					</div>

					<div class="user-info">
						<h4>${item.fullName}</h4>
						<span>${item.emailAddress}</span>
					</div>
				</div>

				<div class="review-meta">
					<div class="star-div">
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
						<i class="bi bi-star-fill"></i>
					</div>

					<span class="status ${item.statusData?.statusName}">
						${item.statusData?.statusName}
					</span>
				</div>

			</div>

			<div class="review-content">
				${item.message.substring(0,180)}
				${item.message.length>180 ? "..." : ""}
			</div>

			<div class="review-action flex-end">
				<button class="btn page-view-btn" onclick="_fetchEachReview('${item?.crId}', '${item?.crFlag}', 'PAGEFORM');">
					<i class="bi bi-check-all"></i>
					APPROVE
				</button>
			</div>

		</div>
	`).join("");

}

//// Initialize Review Data Pagination ////
function _initFetchReviewData(data, pageContainer, paginationContainer) {
	const paginator = new Paginator(
		data,
		_renderPageReviewData,
		`${paginationContainer}`,
		pageContainer,
		4
	);
	__paginatorHandlers[`${paginationContainer}`] = paginator;
	paginator.renderPage();
}

//// Fetch Each Review ////
function _fetchEachReview(crId, crFlag , pageType) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/contact-review/fetch-contacts-reviews?crId=${crId}&crFlag=${crFlag}`,	
			accessKey: true,	
		})
		.then((response) => {
			sessionStorage.setItem("getEachReviewDetailsSession", JSON.stringify(response.data[0]));
			sessionStorage.setItem("pageType", pageType);
			_getForm({page: 'updateReview', url: adminPortalMiddlewareUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachReview(crId, crFlag, pageType), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachReview(crId, crFlag, pageType));
  	}
}

//// Update Review ////
function _updateReview() {
 	getEachReviewDetailsSession = JSON.parse(sessionStorage.getItem("getEachReviewDetailsSession"));
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const statusId = $('#statusId').val().trim();
		const fullName = getEachReviewDetailsSession?.fullName;
		const emailAddress = getEachReviewDetailsSession?.emailAddress;
		const phoneNumber = getEachReviewDetailsSession?.phoneNumber;
		const message = getEachReviewDetailsSession?.message;
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (issueCount > 0) return;

		/////Gather form data////
		const formData = {
			fullName,
			emailAddress,
			phoneNumber,
			message,
            statusId,
        };

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_updateReviewCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to update? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _updateReview());
	}
}

function _updateReviewCallback(formData) {
	getEachReviewDetailsSession = JSON.parse(sessionStorage.getItem("getEachReviewDetailsSession"));
	const pageType = sessionStorage.getItem("pageType");
		
 	try {
		///// get btn text/////
		const btnText = $("#updateBtn").html();
		_btnDisable("updateBtn", btnText, true);
		
		//// call endpoint //////
		_callRawEndPoints({
			url: `admin/contact-review/update-contacts-reviews?crId=${getEachReviewDetailsSession?.crId}`,
			formData,
			accessKey: true,
		})
		.then((response) => {
			_showCustomConfirm({
				callback: () => {
					_alertClose();
					if (pageType == 'DASHBOARDFORM') {
						_getReviewList({
							pageContainer: 'fetchDashboardReviews',
							crFlag: 'REVIEW',
							limit: 2,
							statusId: 3,
						});
					}
					else if (pageType == 'PAGEFORM') {
						_getReviewList({
                            pageContainer: 'fetchPageReviewContent',
                            crFlag: 'REVIEW',
                            paginationContainer: 'reviewPaginationControls',
                        });
					}
				},
				title: "Review Updated Successfully!",
				message: response.message,
				alertType: "success",
				trueActionBtnText: "Okay, Thanks",
			});
			_btnDisable("updateBtn", btnText, false);
		})
		.catch((error) => {
		_staffValidationCheck(error.response);
		if (error.status==0) {
			_callAjaxError(() => _updateReviewCallback(formData), error.message); // retry if needed
			_btnDisable("updateBtn", btnText, false);
		} else {
			_showCustomConfirm({
				title: `Unable to update review`,
				message: error.message,
				alertType: "error",
				trueActionBtnText: "Okay, Thanks",
				closeOnOverlayClick: true,
			});
			_btnDisable("updateBtn", btnText, false);
		}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _updateReviewCallback(formData));
	}
}