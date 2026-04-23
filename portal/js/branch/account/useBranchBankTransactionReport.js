function _getActiveBranchTransactionReportNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getBranchTransactionReportNavPage",
  } = props;
  _getBranchTransactionReportNavActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getBranchTransactionReportNavActiveNav(divid) {
  $(
    "#filterBranchTransactionByDate, #filterBranchTransactionBySession"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

///// Dashbaord Custom Revenue Filtering ////////
function _fetchBranchBankTransactionReportFiltering(filterWith, text) {
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

  _branchBankTransactionReportFiltering(dateFrom, dateTo);
}

function _fetchCustomBranchBankTransactionReportFiltering() {
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

  
  _branchBankTransactionReportFiltering(dateFrom, dateTo,'');
}

function _branchBankTransactionReportFiltering(dateFrom, dateTo, bankId) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  $.ajax({
    type: "GET",
    url: `${endPoint}/admin/branch/account/banks-transactions-reports/fetch-transactions-by-date-range?dateFrom=${dateFrom}&dateTo=${dateTo}&branchId=${getEachBranchDetailsSession?.branchId}&bankId=${bankId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistic = info.statistics;
        const totalRevenue = thousandSeperator(info.totalRevenue);

        /// Update Total Revenue ///
        $("#totalRevenue").html("<s>N</s>" + totalRevenue);

        // Update custom date from and date to///
        $("#dateFrom").html(info.dateFrom);
        $("#dateTo").html(info.dateTo);

        let content= "";
        for (let i = 0; i < statistic.length; i++) {
          const fetchStatisticsData = statistic[i];

          content +=`
            <div class="new-statistics-div" title="Click to view ${capitalizeFirstLetterOfEachWord(fetchStatisticsData.bankName)} Transaction" onclick="_branchBankTransactionReportFiltering('${fetchStatisticsData.dateFrom}','${fetchStatisticsData.dateTo}','${fetchStatisticsData.bankId}');">
              <div class="statistics-inner-div">
                <div class="statistics-text report-statistics-text">
                    <p>${fetchStatisticsData.bankName}</p>
                    <div class="flex-cont"><span>Total Transactions via ${capitalizeFirstLetterOfEachWord(fetchStatisticsData.bankName)}</span><span class="transCount">${fetchStatisticsData.transactionCount}</span></div>
                    <h2><s>N</s>${thousandSeperator(fetchStatisticsData.totalAmount)}</h2>
                </div>
              </div>
            </div>
          `
        }
        $("#statisticsContent").html(content);

        //// Update Dougnut Chart Transaction Banks ///
        let dataPoints = [];
        for (let i = 0; i < statistic.length; i++) {
          const fetchDoughnutData = statistic[i];

          dataPoints.push({
            label: fetchDoughnutData.bankName,
            y: Number(fetchDoughnutData.totalAmount) || 0,
          });
        }

        $("#chartContainer").CanvasJSChart({
          data: [
            {
              type: "doughnut",
              innerRadius: 30,
              indexLabel: "{label} ({y})",
              yValueFormatString: "₦#,##0.00",
              indexLabelFontSize: 9,
              dataPoints: dataPoints,
            },
          ],
        });

        // Update Transaction Report Table ///
        let text = "";
        let no = 0;
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            no++;
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const newpayDate = payDate.toISOString().split("T")[0];
            const totalAmount = fetchedData.totalAmount;

            text += `
              <tr class="tb-row">
                <td>${no}</td>
                <td class="clickable-td" title="Click to view transaction breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalAmount)}</td>
                <td><button class="btn view-btn" title="Click to view transaction breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
              </tr>
            `;
          }
          $("#bankTransactionReportPageContent").html(text);
        } else {
          text += `
            <tr>
                <td colspan="20">
                  <div class="false-notification-div">
										<p>No Transaction record found!</p>
									</div>
                </td>
            </tr>`;
          $("#bankTransactionReportPageContent").html(text);
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
  $("#get-more-div-secondary").fadeOut(500);
}


function _fetchBankTransactionBySessionAndTerm() {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  let issueCount = 0;

  const session = $("#branchAccountSession").val();
  const termId = $("#branchAccountTermId").val();

  $("#branchAccountSession, #branchAccountTermId").removeClass("issue");
  $("#issue_branchAccountSession, #issue_branchAccountTermId").html("");
  
  if (!session) {
    $('#branchAccountSession').addClass('issue');
    $('#issue_branchAccountSession').html('Select Session To Continue');
    issueCount++;
  }

  if (!termId) {
    $('#branchAccountTermId').addClass('issue');
    $('#issue_branchAccountTermId').html('Select Term To Continue');
    issueCount++;
  }

  if (issueCount > 0) {
    return;
  }

  const btnText = $("#filterBankTransBtn").html();
  $("#filterBankTransBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="10px" alt="Loading"/>');
  $("#filterBankTransBtn").prop("disabled", true);

    $("#bankTransactionSessionTermContent")
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
    url: `${endPoint}/admin/branch/account/banks-transactions-reports/fetch-transactions-by-term?session=${session}&termId=${termId}&branchId=${getEachBranchDetailsSession?.branchId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success) {
        const totalRevenue = info.totalRevenue;
        const termName = info?.termData?.termName;
        const fetchedSession = info?.session;

        let titleContainer = "";
        titleContainer += `
          <i class="bi-info-circle"></i> Revenue report for <span>${fetchedSession}</span> -- <span>${termName}</span>`;
        $("#reportTitleContainer").html(titleContainer);

        let balanceContainer = "";
        balanceContainer += `
          Total Balance: <span class="balance"><s>N</s>${thousandSeperator(totalRevenue)}</span>`;
        $("#reportBalanceContainer").html(balanceContainer);

        sessionStorage.setItem(
          "bankTransSessionTermData",
          JSON.stringify({
            session: info.session,
            termId: info?.termData?.termId
          })
        );

        const storedData = JSON.parse(
          sessionStorage.getItem("bankTransSessionTermData")
        );

        // Update Report revenue Table ///
        let text = "";
        let no = 0;
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            no++;
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const newpayDate = payDate.toISOString().split("T")[0];
            const totalAmount = fetchedData.totalAmount;

            text += `
              <tr class="tb-row">
                <td>${no}</td>
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalAmount)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
              </tr>
            `;
          }
          $("#bankTransactionSessionTermContent").html(text);
        } else {
          text += `
            <tr>
                <td colspan="20">
                  <div class="false-notification-div">
										<p>No Transaction record found!</p>
									</div>
                </td>
            </tr>`;
          $("#bankTransactionSessionTermContent").html(text);
        }
        $("#filterBankTransBtn").html(btnText).prop("disabled", false);
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
    error: function (err) {
      console.error(err);
      $("#filterBankTransBtn").html(btnText).prop("disabled", false);
    },
  });
}

function _fetchBankTransactionRecordBreakdown(newpayDate) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  let bankTransSessionTermData = JSON.parse(
    sessionStorage.getItem("bankTransSessionTermData")
  );

  let callUrl = `${endPoint}/admin/branch/account/banks-transactions-reports/fetch-transactions-by-date?date=${newpayDate}&branchId=${getEachBranchDetailsSession?.branchId}`;

  if (bankTransSessionTermData?.session && bankTransSessionTermData?.termId) {
    callUrl= `${endPoint}/admin/branch/account/banks-transactions-reports/fetch-transactions-by-date?date=${newpayDate}&session=${bankTransSessionTermData?.session}&termId=${bankTransSessionTermData?.termId}&branchId=${getEachBranchDetailsSession?.branchId}`;
  }

  try {
		$.ajax({
			type: "GET",
			url: callUrl,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success) {
					const fetchedData = info.data;

          $('#date').html(info?.date);
          $('#breakDowntotalAmount').html("<s>N</s>" + thousandSeperator(info?.totalAmount));

          let text = "";
          let no = 0;

          if (fetchedData && fetchedData.length > 0) {
            for (let i = 0; i < fetchedData.length; i++) {
              no++;
              const data = fetchedData[i];

              const transactionId = data.transactionId;
              const transactionDate = data.transactionDate;
              const bankName = data.bankData?.bankName || '';
              const amount = data.amount;
              const description = data.description;
              const session = data.session;
              const termName = data.termData?.termName || '';
              const paymentBy = data.paymentBy;
              const computedBy = data.createdByData || '';
              const dateComputed = data.createdTime;

              text += `
                <tr class="tb-row">
                  <td>${no}</td>
                  <td>${transactionId}</td>
                  <td>${transactionDate}</td>
                  <td>${bankName}</td>
                  <td><s>N</s>${thousandSeperator(amount)}</td>
                  <td>${description}</td>
                  <td>${session} - ${termName}</td>
                  <td>${paymentBy}</td>
                  <td class="clickable-td">
                    ${computedBy.fullName}<br />
                    <span>${computedBy.staffId}</span>
                  </td>
                  <td>${dateComputed}</td>
                </tr>
              `;
            }

            $('#bankTransactionRecordBreakdownPageContent').html(text);

          } else {
            text += `
              <tr>
                  <td colspan="20">
                    <div class="false-notification-div">
                      <p>No payment record found!</p>
                    </div>
                  </td>
              </tr>`;
              
            $("#bankTransactionRecordBreakdownPageContent").html(text);
          }
				} else {
					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
        _alertClose(2);
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('Check your internet connection and try again.', false);
			}
		});
	} catch (error) {
		_alertClose(2);
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}