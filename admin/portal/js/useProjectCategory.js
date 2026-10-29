/// Project Category Search Filter ////
function _filtersProjectCategory(value) {
  $("#projectCategoryContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

/// Create And Update Project Category ////
function _addAndUpdateProjectCategory(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const projectCategoryName = $('#projectCategoryName').val().trim();
		const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("projectCategoryName", "PROJECT CATEGORY");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			projectCategoryName,
            statusId,	
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveAddAndUpdateProjectCategoryCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _addAndUpdateProjectCategory());
	}
}

/// Create And Update Project Category Call Back ////
function _saveAddAndUpdateProjectCategoryCallback(formData) {
	let useEachProjectCategorySession = JSON.parse(sessionStorage.getItem("useEachProjectCategorySession"));

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);

	let callUrl= useEachProjectCategorySession?.projectCategoryId ? `admin/settings/project-category/update-project-category?projectCategoryId=${useEachProjectCategorySession?.projectCategoryId}` : `admin/settings/project-category/create-project-category`;
	
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
				_getPage({page: 'projectCategory', url: adminPortalMiddlewareUrl});
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
			_callAjaxError(() => _saveAddAndUpdateProjectCategoryCallback(formData, error.message)); // retry if needed
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

/// Fetch Project Category Data ////
function _fetchProjectCategoryData() {
  try {
    _callFetchEndPoints({
      url: `admin/settings/project-category/fetch-project-category`,
      accessKey: true,
    })
    .then((response) => {
        _initProjectCategoryData(response.data);
    })
	.catch((error) => {
		_staffValidationCheck(error.response);
		console.error("Error:", error);
		if (error.status==0) {
			_showEmptyState({
				container: "projectCategoryContent",
				message: "Check your internet connection and try again",
				colspan: 20,
				paginationContainer: "projectCategoryContentPaginationControls",
			});
			_callAjaxError(() => _fetchProjectCategoryData(), error.message);
		} else {
			_showEmptyState({
				container: "projectCategoryContent",
				message: error.message,
				colspan: 20,
				button: `
					<button class="btn" title="ADD NEW PROJECT CATEGORY" onclick="sessionStorage.removeItem('useEachProjectCategorySession'); _getForm({page: 'projectCategoryReg', url: adminPortalMiddlewareUrl});">
						<i class="bi-plus-square"></i> ADD NEW PROJECT CATEGORY
					</button>
				`,
				paginationContainer: "projectCategoryContentPaginationControls",
			});
		}
	});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchProjectCategoryData());
	}
}

/// Render Fetch Project Category Data ////
function _renderProjectCategoryData(data, start) {
  return data
    .map(
      (item, index) => `
	  	<tr class="tb-row">
			<td>${start + index + 1}</td>
			<td class="clickable-td" title="Click to view Category" onclick="_fetchEachProjectCategory('${item.projectCategoryId}');">${item.projectCategoryId}</td>
			<td>${item.projectCategoryName}</td>
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
			<td><button class="btn view-btn" title="Click to view Category" onclick="_fetchEachProjectCategory('${item.projectCategoryId}');">VIEW</button></td>
		</tr>`
    )
    .join("");
}

/// Initialize Project Category Data ////
function _initProjectCategoryData(productCat) {
  const paginator = new Paginator(
    productCat,
    _renderProjectCategoryData,
    "projectCategoryContentPaginationControls",
    "projectCategoryContent",
    10
  );
  __paginatorHandlers["projectCategoryContent"] = paginator;
  paginator.renderPage();
}

/// Fetch Each Project Category ////
function _fetchEachProjectCategory(projectCategoryId) {
    $("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		//// call endpoint //////
		_callFetchEndPoints({
			url: `admin/settings/project-category/fetch-project-category?projectCategoryId=${projectCategoryId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem("useEachProjectCategorySession", JSON.stringify(response.data[0]));
			_getForm({page: 'projectCategoryReg', url: adminPortalMiddlewareUrl});
		 })
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(() => _fetchEachProjectCategory(projectCategoryId), error.message); // retry if needed
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachProjectCategory(projectCategoryId));
  	}
}