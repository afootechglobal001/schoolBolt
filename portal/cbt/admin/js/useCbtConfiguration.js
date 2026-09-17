/// CT Configuration Search Filter ////
function _filtersCbtConfig(value) {
  $("#cbtConfigContent .tb-row").each(function () {
    var text = $(this).text();
    text.toLowerCase().indexOf(value.toLowerCase()) > -1
      ? $(this).show()
      : $(this).hide();
  });
}

/// Create And Update CT Configuration ////
function _addAndUpdateCbtConfig(){
	try {
		////////get all needed values////////////
		let issueCount = 0;
		const cbtTitle = $('#cbtTitle').val().trim();
		const cbtDescription = $('#cbtDescription').val().trim();
		const statusId = $('#statusId').val().trim();
		
		///// empty field validation//////////
		issueCount += _validateEmptyValue("cbtTitle", "CBT TITLE");
		issueCount += _validateEmptyValue("cbtDescription", "CBT DESCRIPTION");
		issueCount += _validateEmptyValue("statusId", "STATUS");

		if (issueCount > 0) return;

		// Gather form data //
		const formData = {
			cbtTitle,
			cbtDescription,
            statusId,
		};

		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_saveAddAndUpdateCbtConfigCallback(formData);
		},
			title: "Are you sure?",
			message: 'Are you sure you want to submit? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _addAndUpdateCbtConfig());
	}
}

/// Create And Update CBT Configuration Call Back ////
function _saveAddAndUpdateCbtConfigCallback(formData) {
	let useEachCbtConfigSession = JSON.parse(sessionStorage.getItem("useEachCbtConfigSession"));

	///// get btn text/////
	const btnText = $("#submitBtn").html();
	_btnDisable("submitBtn", btnText, true);

	let callUrl= useEachCbtConfigSession?.cbtId ? `cbt/admin/settings/cbt-config/update-cbt-config?cbtId=${useEachCbtConfigSession?.cbtId}` : `cbt/admin/settings/cbt-config/create-cbt-config`;
	
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
				_getPage({page: 'cbtConfigPage', url: cbtAdminMiddleWareUrl});
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
			_callAjaxError(() => _saveAddAndUpdateCbtConfigCallback(formData, error.message)); // retry if needed
			_btnDisable("submitBtn", btnText, false);
		} else {
			_showCustomConfirm({
                title: "Unable to Create Configuration",
                message: error.message,
                alertType: "error",
                trueActionBtnText: "OK",
                closeOnOverlayClick: true,
            });
			_btnDisable("submitBtn", btnText, false);
		}
    });
}

/// Fetch CBT Configuration Data ////
function _fetchCbtConfigData() {
	try {
		_callFetchEndPoints({
			url: `cbt/admin/settings/cbt-config/fetch-cbt-config`,
			accessKey: true,
		})
		.then((response) => {
			_initCbtConfigData(response?.data);
		})
		.catch((error) => {
			_staffValidationCheck(error.response);
			console.error("Error:", error);

			if (error.status == 0) {
				_showEmptyState({
					container: "cbtConfigContent",
					message: "Check your internet connection and try again",
					colspan: 20,
					paginationContainer: "cbtConfigContentPaginationControls",
				});

				_callAjaxError(() => _fetchCbtConfigData(), error.message);
			} else {
				_showEmptyState({
					container: "cbtConfigContent",
					message: error.message,
					colspan: 20,
					button: `
						<button class="btn" title="ADD NEW CBT CONFIGURATION"
							onclick="sessionStorage.removeItem('useEachCbtConfigSession'); _getForm({page: 'cbtConfigReg', url: cbtAdminMiddleWareUrl});">
							<i class="bi-plus-square"></i> ADD NEW CBT CONFIGURATION
						</button>
					`,
					paginationContainer: "cbtConfigContentPaginationControls",
				});
			}
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _fetchCbtConfigData());
	}
}

/// Render Fetch CBT Configuration Data ////
function _renderCbtConfigData(data) {
	return data
		.map(
			(item, index) => `
				<tr class="tb-row">
					<td>${index + 1}</td>

					<td class="clickable-td"
						title="Click to view CBT Configuration"
						onclick="_fetchEachCbtConfig('${item?.cbtId}');">
						${item?.cbtId}
					</td>

					<td class="clickable-td"
						title="Click to view CBT Configuration"
						onclick="_fetchEachCbtConfig('${item?.cbtId}');">
						${item?.cbtTitle}
					</td>

					<td>
						<div class="text-back-div desc-text-back-div">
							<div class="text-div">
								<div>${item?.cbtDescription || "-----"}</div>
							</div>
						</div>
					</td>

					<td>
						<div class="text-back-div">
							<div class="text-div">
								<div class="first-class">
									${item?.updatedByData?.fullname || "----"}
								</div>

								<div class="second-class">
									${item?.updatedByData?.emailAddress || "----"}
								</div>
							</div>
						</div>
					</td>

					<td>
						<div class="text-back-div">
							<div class="text-div">
								<div class="first-class">
									<i class="bi bi-calendar2-check"></i>
									${_formatShortDate(item?.updatedTime || "00-00-00 00:00:00")}
								</div>

								<div class="second-class date-item">
									<i class="bi bi-clock"></i>
									${_formatTime(item?.updatedTime || "00:00:00")}
								</div>
							</div>
						</div>
					</td>

					<td>
						<div class="status-div ${item?.statusData?.statusName}">
							${item?.statusData?.statusName || "-----"}
						</div>
					</td>

					<td>
						<button class="btn view-btn"
							title="Click to view CBT Configuration"
							onclick="_fetchEachCbtConfig('${item?.cbtId}');">
							VIEW
						</button>
					</td>
				</tr>
			`
		)
		.join("");
}

/// Initialize CBT Configuration Data ////
function _initCbtConfigData(productCat) {
  const paginator = new Paginator(
    productCat,
    _renderCbtConfigData,
    "cbtConfigContentPaginationControls",
    "cbtConfigContent",
    10
  );
  __paginatorHandlers["cbtConfigContent"] = paginator;
  paginator.renderPage();
}

/// Fetch Each CBT Configuration ////
function _fetchEachCbtConfig(cbtId) {
	$("#get-form-more-div")
		.css({
			'display': 'flex',
			'justify-content': 'center',
			'align-items': 'center'
		})
		.fadeIn(500);
	try {
		_callFetchEndPoints({
			url: `cbt/admin/settings/cbt-config/fetch-cbt-config?cbtId=${cbtId}`,
			accessKey: true,
		})
		.then((response) => {
			sessionStorage.setItem(
				"useEachCbtConfigSession",
				JSON.stringify(response?.data?.[0])
			);

			_getForm({
				page: 'cbtConfigReg',
				url: cbtAdminMiddleWareUrl
			});
		})	
		.catch((error) => {
			_staffValidationCheck(error.response);
			_alertClose();
			console.error("Error:", error);
			_callAjaxError(
				() => _fetchEachCbtConfig(cbtId),
				error.message
			);
		});
	} catch (error) {
		_alertClose();
		console.error("Error:", error);
		_callCatchError(() => _fetchEachCbtConfig(cbtId));
	}
}