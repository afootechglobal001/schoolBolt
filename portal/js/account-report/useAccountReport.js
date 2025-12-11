function _getActiveReportNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getNavPage",
  } = props;
  _getReportActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getReportActiveNav(divid) {
  $(
    "#filterByDate, #filterBySession"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}


///// Dashbaord Custom Revenue Filtering ////////
function _fetchReportRevenueFiltering(filterWith, text) {
  $("#srch-text").html(text);
  $(".custom-srch-div").fadeOut(500);
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

  _reportRevenueFiltering(dateFrom, dateTo);
}
function _fetchCustomReportRevenueFiltering() {
  let issueCount = 0;

  const dateFrom = $("#datepickers-from").val();
  const dateTo = $("#datepickers-to").val();

  $("#datepickers-from, #datepickers-to").removeClass("issue");
  $("#issue_from, #issue_to").html("");

  if (!dateFrom) {
    $("#issue_from").html("Kindly Provide Start Date To Continue");
    issueCount++;
  }

  if (!dateTo) {
    $("#issue_to").html("Kindly Provide End Date To Continue");
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  _reportRevenueFiltering(dateFrom, dateTo);
}

function _reportRevenueFiltering(dateFrom, dateTo) {
  $("#get-form-more-div")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/account-reports/fetch-revenue-by-date-range?dateFrom=${dateFrom}&dateTo=${dateTo}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistic = info.statistics[0];
        const sumCreditCardPayments = Number(statistic.sumCreditCardPayments) || 0;
        const sumBankTransferPayments = Number(statistic.sumBankTransferPayments) || 0;
        const totalRevenue = thousandSeperator(sumCreditCardPayments + sumBankTransferPayments);

        /// Update Total Revenue ///
        $("#totalRevenue").html("<s>N</s>" + totalRevenue);

        // Update custom date from and date to///
        $("#dateFrom").html(info.dateFrom);
        $("#dateTo").html(info.dateTo);

        // Update Report revenue Table ///
        let text = "";
        let no = 0;
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            no++;
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const newpayDate = payDate.toISOString().split("T")[0];
            const totalFeesPaid = fetchedData.totalFeesPaid;

            text += `
              <tr class="tb-row">
                <td>${no}</td>
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_fetchRevenueByDate('${newpayDate}', '', '');">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_fetchRevenueByDate('${newpayDate}', '', '');">VIEW DETAILS</button></td>
              </tr>
            `;
          }
          $("#pageContent").html(text);
        } else {
          text += `
            <tr>
                <td colspan="20">
                  <div class="false-notification-div">
										<p>No payment record found!</p>
									</div>
                </td>
            </tr>`;
          $("#pageContent").html(text);
        }
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
    error: function (err) {
      console.error(err);
    },
  });
  $("#get-form-more-div").fadeOut(500);
}

function _fetchRevenueByDate(newpayDate, session = '', termId = '') {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/account-reports/fetch-revenue-by-date?date=${newpayDate}&session=${session}&termId=${termId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getRevenueByDateSessionData", JSON.stringify(info));
					_getForm({ page: 'revenueBreakdown', url: adminPortalLocalUrl });
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchRevenueById(paymentId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/account-reports/fetch-revenue-by-id?paymentId=${paymentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getRevenueBreakdownSessionData", JSON.stringify(info.data[0]));
					_getForm({ page: 'paymentBreakDownForm', layer: 2, url: adminPortalLocalUrl });
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose();
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}

function _fetchRevenueBySessionAndTerm() {
  let issueCount = 0;

  const session = $("#session").val();
  const termId = $("#termId").val();

  $("#session, #termId").removeClass("issue");
  $("#issue_session, #issue_termId").html("");
  
  if (!session) {
    $('#session').addClass('issue');
    $('#issue_session').html('Select Session To Continue');
    issueCount++;
  }

  if (!termId) {
    $('#termId').addClass('issue');
    $('#issue_termId').html('Select Term To Continue');
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  const btnText = $("#filterRevenueBtn").html();
  $("#filterRevenueBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="10px" alt="Loading"/>');
  $("#filterRevenueBtn").prop("disabled", true);

    $("#pageContent")
    .html(
      `<tr>
          <td colspan="20">
              <div class="content-loading-div">
                  <img src="${websiteUrl}/images/spinner.gif" alt="Loading" />
              </div>
          </td>
      </tr>`
    ).fadeIn("fast");

  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/account-reports/fetch-revenue-by-term?session=${session}&termId=${termId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistic = info.statistics[0];
        const sumCreditCardPayments = Number(statistic.sumCreditCardPayments) || 0;
        const sumBankTransferPayments = Number(statistic.sumBankTransferPayments) || 0;
        const totalRevenue = thousandSeperator(sumCreditCardPayments + sumBankTransferPayments);
        const termName = info?.termData?.termName;
        const fetchedSession = info?.session;

        let titleContainer = "";
        titleContainer += `
          <i class="bi-info-circle"></i> Revenue report for <span>${fetchedSession}</span> -- <span>${termName}</span>`;
        $("#reportTitleContainer").html(titleContainer);

        let balanceContainer = "";
        balanceContainer += `
          Total Balance: <span class="balance"><s>N</s>${totalRevenue}</span>`;
        $("#reportBalanceContainer").html(balanceContainer);

        // Update Report revenue Table ///
        let text = "";
        let no = 0;
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            no++;
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const newpayDate = payDate.toISOString().split("T")[0];
            const totalFeesPaid = fetchedData.totalFeesPaid;

            text += `
              <tr class="tb-row">
                <td>${no}</td>
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_fetchRevenueByDate('${newpayDate}', '${session}', '${termId}');">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_fetchRevenueByDate('${newpayDate}', '${session}', '${termId}');">VIEW DETAILS</button></td>
              </tr>
            `;
          }
          $("#pageContent").html(text);
        } else {
          text += `
            <tr>
                <td colspan="20">
                  <div class="false-notification-div">
										<p>No payment record found!</p>
									</div>
                </td>
            </tr>`;
          $("#pageContent").html(text);
        }
        $("#filterRevenueBtn").html(btnText).prop("disabled", false);
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
    error: function (err) {
      console.error(err);
      $("#filterRevenueBtn").html(btnText).prop("disabled", false);
    },
  });
}