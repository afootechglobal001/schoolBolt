/// Information Category Search Filter ////
function _filtersInfoCategory(value) {
  $("#infoCategoryContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

/// Create And Update Information Category ////
function _addAndUpdateInfoCategory(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const categoryName = $('#categoryName').val().trim();
		const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("categoryName", "INFORMATION CATEGORY");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			categoryName,
            statusId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveAddAndUpdateInfoCategoryCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _addAndUpdateInfoCategory());
	}
}

/// Create And Update Information Category Call Back ////
function _saveAddAndUpdateInfoCategoryCallback(formData) {
	let useEachInfoCategorySession = JSON.parse(sessionStorage.getItem("useEachInfoCategorySession"));

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);

	let callUrl= useEachInfoCategorySession?.categoryId ? `admin/settings/information-category/update-information-category?categoryId=${useEachInfoCategorySession?.categoryId}` : `admin/settings/information-category/create-information-category`;
	
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
				_getPage({page: 'informationCategory', url: adminPortalMiddlewareUrl});
			},
			title: 'Success!',
			message: response?.message,
			alertType: 'success',
			trueActionBtnText: 'OK, Thanks.',
			closeOnOverlayClick: false,
		});
		_btnDisable("submitBtn", btnText, false);
    })
    .catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_callAjaxError(() => _saveAddAndUpdateInfoCategoryCallback(formData, error.message)); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_showCustomConfirm({
                title: "Unable to Create Category",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

/// Fetch Information Category Data ////
function _fetchInfoCategoryData() {
  try {
    _callFetchEndPoints({
      url: `admin/settings/information-category/fetch-information-category`,
      accessKey: true,
    })
    .then((response) => {
        _initInfoCategoryData(response.data);
    })
	.catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_showEmptyState({
				container: "infoCategoryContent",
				message: "Check your internet connection and try again",
				colspan: 20,
				paginationContainer: "infoCategoryContentPaginationControls",
			});
			_callAjaxError(() => _fetchInfoCategoryData(), error.message);
		} else {
			_showEmptyState({
				container: "infoCategoryContent",
				message: error.message,
				colspan: 20,
				button: `
					<button class="btn" title="ADD NEW INFORMATION CATEGORY" onclick="sessionStorage.removeItem('useEachInfoCategorySession'); _getForm({page: 'categoryReg', url: adminPortalMiddlewareUrl});">
						<i class="bi-plus-square"></i> ADD NEW INFORMATION CATEGORY
					</button>
				`,
				paginationContainer: "infoCategoryContentPaginationControls",
			});
		}
	});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchInfoCategoryData());
	}
}

/// Render Fetch Information Category Data ////
function _renderInfoCategoryData(data) {
  return data
    .map(
      (item) => `
	  	<tr class="tb-row">
			<td>1</td>
			<td class="clickable-td" title="Click to view Category" onclick="_fetchEachInfoCategory('${item.categoryId}');">${item.categoryId}</td>
			<td class="clickable-td" title="Click to view Category" onclick="_fetchEachInfoCategory('${item.categoryId}');">${item.categoryName}</td>
			<td>
				<div class="text-div">
					<div>${item.createdByData?.fullname ? item.createdByData?.fullname : '----'}</div> 
					<div>${item.createdByData?.emailAddress ? item.createdByData?.emailAddress : '----'}</div>
				</div>
			</td>
			<td>
				<div class="text-div">
					<div>${item.updatedByData?.fullname ? item.updatedByData?.fullname : '----'}</div> 
					<div>${item.updatedByData?.emailAddress ? item.updatedByData?.emailAddress : '----'}</div>
				</div>
			</td>
			<td><div class="status-div ${item.statusData?.statusName}">${item.statusData?.statusName}</div></td>
			<td><button class="btn view-btn" title="Click to view Category" onclick="_fetchEachInfoCategory('${item.categoryId}');">VIEW</button></td>
		</tr>`
    )
    .join("");
}

/// Initialize Information Category Data ////
function _initInfoCategoryData(productCat) {
  const paginator = new Paginator(
    productCat,
    _renderInfoCategoryData,
    "infoCategoryContentPaginationControls",
    "infoCategoryContent",
    10
  );
  __paginatorHandlers["infoCategoryContent"] = paginator;
  paginator.renderPage();
}

/// Fetch Each Information Category ////
function _fetchEachInfoCategory(categoryId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/settings/information-category/fetch-information-category?categoryId=${categoryId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("useEachInfoCategorySession", JSON.stringify(response.data[0]));
			_getForm({page: 'categoryReg', url: adminPortalMiddlewareUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachInfoCategory(categoryId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachInfoCategory(categoryId));
  	}
}