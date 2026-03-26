//// Load Branch Wallet /////
function loadBranchWallet(layer) {
	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession")
	);

	try {
		//////get all needed values////
		const amount = $("#amount").val().trim();
		const description = $("#description").val().trim();
		const paymentMethodId = $("#paymentMethodId").val().trim();

		///// empty field validation//////////
		let issueCount = 0;
		issueCount += _validateEmptyValue("amount", "AMOUNT");
		issueCount += _validateEmptyValue("description", "DESCRIPTION");
		issueCount += _validateNumber("amount", amount);
		issueCount += _validateEmptyValue("paymentMethodId", "PAYMENT METHOD");

		if (issueCount > 0) return;

		// Gather form data
		const formData = {
			amount: amount,
			description: description,
			paymentMethodId: paymentMethodId,
		};

		const btnText = $("#loadWalletBtn").html();
		_btnDisable("loadWalletBtn", btnText, true);

		_callRawEndPoints({
		url: `admin/branch/schoolbolt-wallet/load-wallet-log?branchId=${getEachBranchDetailsSession?.branchId}`,
		formData,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success) {
				const data = response.data;
				_payWithPaystackLoadWallet(
					data.transactionId,
					data.fullName,
				 	data.emailAddress,
					data.phoneNumber,
					data.amount,
					data.currency,
					data.paymentChannel,
					data.paymentKey,
					btnText,
					layer
				);
			} else {
				_showCustomConfirm({
					title: "Unable to Process Wallet",
					message: response.message,
					alertType: "warning",
					trueActionBtnText: "OK",
					closeOnOverlayClick: true,
				});
				_btnDisable("loadWalletBtn", btnText, false);
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => loadBranchWallet(layer)); // retry if needed
			_btnDisable("loadWalletBtn", btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => loadBranchWallet(layer));
		_btnDisable("loadWalletBtn", btnText, false);
	}
}

////// CALL LOAD WALLET PAYSTACK ////////////////
function _payWithPaystackLoadWallet(transactionId, fullName, emailAddress, phoneNumber, amount, currency, paymentChannel, paymentKey, btnText, layer) {

  // Create the base options
  const options = {
    key: paymentKey,
    email: emailAddress,
    amount: amount, // Amount in kobo
    ref: transactionId,
    currency: currency,
    channels: paymentChannel ? [paymentChannel] : ["card", "bank_transfer"],
    metadata: {
      custom_fields: [
        {
          display_name: fullName,
          variable_name: "mobile_number",
          value: phoneNumber,
        },
      ],
    },
    callback: function () {
      _loadBranchWalletAction("success", transactionId, btnText, layer);
    },
    onClose: function () {
      _loadBranchWalletAction("cancel", transactionId, btnText, layer);
      return false;
    },
  };
  
  var handler = PaystackPop.setup(options);
  handler.openIframe();
}

////////////////////// END LOAD WALLET PAYSTACK /////////////////////////////
function _loadBranchWalletAction(action, transactionId, btnText, layer) {
	try {
		_callRawEndPoints({
		url: `admin/branch/schoolbolt-wallet/load-wallet-${action}?transactionId=${transactionId}`,
		accessKey: true,
		})
		.then((response) => {
		_staffValidationCheck(response.response);

		if (response.success) {
			if (layer===2) {
				_alertClose(2);
				_showCustomConfirm({
					callback: () => {
						_fetchBranchDashboardStatistics();
					},
					title: action === "success" ? "TRANSACTION SUCCESSFUL" : "TRANSACTION CANCELLED",
					message: response.message,
					alertType: action === "success" ? "success" : "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: false,
				});
			} else {
				_alertClose(3);
				_showCustomConfirm({
					callback: () => {
						// Reload history
						_getForm({
							page: 'branchWalletHistory',
							layer: 2,
							url: adminPortalLocalUrl
						});
						
						//// Update Dashboard Wallet Balance
						_fetchBranchDashboardStatistics();
					},
					title: action === "success" ? "TRANSACTION SUCCESSFUL" : "TRANSACTION CANCELLED",
					message: response.message,
					alertType: action === "success" ? "success" : "error",
					trueActionBtnText: "OK",
					closeOnOverlayClick: false,
				});
			}
		} else {
			_showCustomConfirm({
				title: "Unable to Process Wallet",
				message: response.message,
				alertType: "warning",
				trueActionBtnText: "OK",
				closeOnOverlayClick: true,
			});
			_btnDisable("loadWalletBtn", btnText, false);
		}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _loadBranchWalletAction(action, transactionId, btnText, layer)); // retry if needed
			_btnDisable("loadWalletBtn", btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _loadBranchWalletAction(action, transactionId, btnText, layer));
		_btnDisable("loadWalletBtn", btnText, false);
	}
}

function wallet_select_search() {
  $(".alert-srch-select").toggle("fast");
}
function wallet_srch_custom(text) {
  $("#srch-wallet-text").html(text);
  $(".branch-wallet-custom-srch-div").fadeIn(500);
}

///// Dashbaord Custom Revenue Filtering ////////
function _fetchBranchWalletFiltering(filterWith, text) {
  $("#srch-wallet-text").html(text);
  $(".branch-wallet-custom-srch-div").fadeOut(500);
  let dateFrom;
  const dateTo = new Date().toISOString().split("T")[0];
  if (filterWith === "srch-today") {
    dateFrom = new Date().toISOString().split("T")[0];
  } else if (filterWith === "srch-week") {
    const currentDate = new Date();
    const firstDayOfWeek = new Date(
      currentDate.setDate(currentDate.getDate() - currentDate.getDay())
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfWeek;
  } else if (filterWith === "srch-7") {
    /// for last 7 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 6))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-30") {
    /// for last 30 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 29))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-90") {
    /// for last 90 days
    const currentDate = new Date();
    const pastDate = new Date(currentDate.setDate(currentDate.getDate() - 89))
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  } else if (filterWith === "srch-month") {
    const currentDate = new Date();
    const firstDayOfMonth = new Date(
      currentDate.getFullYear(),
      currentDate.getMonth(),
      2
    )
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfMonth;
  } else if (filterWith === "srch-year") {
    const currentDate = new Date();
    const firstDayOfYear = new Date(currentDate.getFullYear(), 0, 2)
      .toISOString()
      .split("T")[0];
    dateFrom = firstDayOfYear;
  } else if (filterWith === "srch-1year") {
    /// for last 1 year
    const currentDate = new Date();
    const pastDate = new Date(
      currentDate.setFullYear(currentDate.getFullYear() - 1)
    )
      .toISOString()
      .split("T")[0];
    dateFrom = pastDate;
  }

  _walletHistoryFiltering(dateFrom, dateTo);
}

function _fetchCustomWalletHistoryFiltering() {
  let issueCount = 0;

  const dateFrom = $("#wallet-datepickers-from").val();
  const dateTo = $("#wallet-datepickers-to").val();

  $("#wallet-datepickers-from, #wallet-datepickers-to").removeClass("issue");
  $("#issue_wallet-datepickers-from, #issue_wallet-datepickers-to").html("");

  if (!dateFrom) {
    $("#issue_wallet-datepickers-from").html("Kindly Provide Start Date To Continue");
    issueCount++;
  }

  if (!dateTo) {
    $("#issue_wallet-datepickers-to").html("Kindly Provide End Date To Continue");
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  _walletHistoryFiltering(dateFrom, dateTo);
}


///// Fetch Branch Wallet History ////
function _walletHistoryFiltering(dateFrom, dateTo) {
	$("#get-more-third-layer")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);

  	let getEachBranchDetailsSession = JSON.parse(
		sessionStorage.getItem("getEachBranchDetailsSession")
	);

	try {
		_callFetchEndPoints({
		url: `admin/branch/schoolbolt-wallet/fetch-wallet-transactions?branchId=${getEachBranchDetailsSession?.branchId}&dateFrom=${dateFrom}&dateTo=${dateTo}`,
		accessKey: true,
		})
		.then((response) => {
			_staffValidationCheck(response.response);
			if (response.success && response.data?.length > 0) {
				_initFetchBranchWalletTransactions(response.data);

				// Update custom date from and date to///
				$("#dateFrom").html(response.dateFrom);
				$("#dateTo").html(response.dateTo);

				// Update Wallet Balance///
				$("#branchWalletBalance").html(
				"<s>N</s>" + thousandSeperator(response.walletBalance)
				);
			} else {
			$("#fetchBranchWalletTransactions").html(`
				<tr>
					<td colspan="20">
						<div class="false-notification-div">
							<p>No wallet record found!</p>
						</div>
					</td>
				</tr>`);
			$("#fetchBranchWalletTransactionsPaginationControls").html("");
			}
		})
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => _walletHistoryFiltering(dateFrom, dateTo));
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _walletHistoryFiltering(dateFrom, dateTo));
	}
	$("#get-more-third-layer").fadeOut(500);
}

function _renderFetchBranchWalletTransactions(data, start) {
  return data
    .map(
      (item, i) => `
	  	<tr class="tb-row">
			<td>${start + i + 1}</td>
			<td class="clickable-td">${item.updatedTime}</td>
			<td class="clickable-td">
				<div class="text-back-div">
					<div class="text-div">
						<div class="first-class">${item.transactionId}</div>
						<div class="second-class">${item.description}</div>
					</div>
				</div>
			</td>
			<td><s>N</s>${thousandSeperator(item.balanceBefore)}</td>
			<td><s>N</s>${thousandSeperator(item.amount)}</td>
			<td><s>N</s>${thousandSeperator(item.balanceAfter)}</td>
			<td class="clickable-td">
				<div class="text-back-div">
					<div class="text-div">
						<div class="first-class">${item.createdByData?.fullName}</div>
						<div class="second-class">${item.createdByData?.staffId}</div>
					</div>
				</div>
			</td>
			<td>${item.paymentMethodData?.paymentMethodName}</td>
			<td>
				<div class="status-div ${item.statusData?.statusName}">
					${item.statusData?.statusName}
				</div>
			</td>
		</tr>`
    )
    .join("");
}

function _initFetchBranchWalletTransactions(data) {
  const paginator = new Paginator(
    data,
    _renderFetchBranchWalletTransactions,
    "fetchBranchWalletTransactionsPaginationControls",
    "fetchBranchWalletTransactions",
    10
  );
  __paginatorHandlers["fetchBranchWalletTransactions"] = paginator;
  paginator.renderPage();
}