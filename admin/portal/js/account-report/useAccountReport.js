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
      url: portalMiddleWareUrl,
    });
  }
}
function _getReportActiveNav(divid) {
  $(
    "#filterByDate"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

function _getPaymentStatusNav(props) {
  const {
    page = "",
    divid = "",
    id="",
    pageContainer = "getPaymentNav",
  } = props;
  _getActivePaymentStatusNav(divid);
  if (page) {
    _getPage({
      page: page,
      id: id,
      pageContainer: pageContainer,
      url: portalMiddleWareUrl,
    });
  }
}
function _getActivePaymentStatusNav(divid) {
  $(".title-nav-back-div ul li").removeClass("active-li");
  $("#" + divid).addClass("active-li");
}

/// Account Custom Revenue Filtering ////////
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

// function _reportRevenueFiltering(dateFrom, dateTo) {
//   $("#get-form-more-div")
//     .css({
//       display: "flex",
//       "justify-content": "center",
//       "align-items": "center",
//     })
//     .fadeIn(500);

//     try {
//       //// call endpoint //////
//       _callFetchEndPoints({
//         url: `admin/account-reports/fetch-revenue-by-date-range?dateFrom=${dateFrom}&dateTo=${dateTo}`,
//         accessKey: true,
//       })
//       .then((response) => {
//         const statistic = response?.statistics;

//         // Update custom date from and date to///
//         $("#dateFrom").html(response?.dateFrom);
//         $("#dateTo").html(response?.dateTo);

//         // Update Report Statistics///
//         $("#totalRevenue").html("<s>N</s>" + thousandSeperator(response?.totalRevenue));
//         $("#sumCreditCardPayments").html("<s>N</s>" + thousandSeperator(statistic.sumCreditCardPayments));
//         $("#sumBankTransferPayments").html("<s>N</s>" + thousandSeperator(statistic.sumBankTransferPayments));
//         $("#sumPaystackCharges").html("<s>N</s>" + thousandSeperator(statistic.sumPaystackCharges));
//         $("#sumPaystackRemittance").html("<s>N</s>" + thousandSeperator(statistic.sumPaystackRemittance));
//         $("#countCreditCardPayments").html(statistic.countCreditCardPayments);
//         $("#countBankTransferPayments").html(statistic.countBankTransferPayments);

//         //// Update Dougnut Chart Revenue ///
//         const dataPoints = [
//           {
//             label: "Credit Card",
//             y: Number(statistic.sumCreditCardPayments) || 0,
//           },
//           {
//             label: "Bank Transfer",
//             y: Number(statistic.sumBankTransferPayments) || 0,
//           },
//         ];

//         $("#chartContainer1").CanvasJSChart({
//           data: [
//             {
//               type: "doughnut",
//               innerRadius: 30,
//               indexLabel: "{label} ({y})",
//               yValueFormatString: "₦#,##0.00",
//               indexLabelFontSize: 9,
//               dataPoints: dataPoints,
//             },
//           ],
//         });

//         // Update Pie Chart credit and bank transfer ///
//         const options = {
//           title: {
//             text: "",
//           },
//           data: [
//             {
//               type: "pie",
//               startAngle: 45,
//               showInLegend: "False",
//               legendText: "{label}",
//               indexLabel: "{label} ({y})",
//               yValueFormatString: "#,##0.#" % "",
//               indexLabelFontSize: 9,
//               dataPoints: [
//                 {
//                   label: "Debit/Credit Card",
//                   y: parseInt(statistic.countCreditCardPayments),
//                 },
//                 {
//                   label: "Bank Transfer",
//                   y: parseInt(statistic.countBankTransferPayments),
//                 },
//               ],
//             },
//           ],
//         };
//         $("#chartContainer2").CanvasJSChart(options);

//         if (response?.data && response?.data.length > 0) {
//           _initFetchAccountReportTableData(response);
//         } else {
//           _showEmptyState({
//             container: "acoountReportPageContent",
//             message: "No payment records found!",
//             colspan: 20,
//             paginationContainer: "acoountReportPageContentPaginationControls",
//           });
//         }
//         $("#get-form-more-div").fadeOut(500);
//       })
//       .catch((error) => {
//         _staffValidationCheck(error.response);
//         console.error("Error:", error);
//         if (error.status==0) {
// 				  _alertClose();
//            _showEmptyState({
//             container: "acoountReportPageContent",
//             message: "Check your internet connection and try again",
//             colspan: 20,
//             paginationContainer: "acoountReportPageContentPaginationControls",
//           });
//         }
//       });
//     } catch (error) {
//       _alertClose();
//       console.error("Error:", error);
//       _callCatchError(() => _reportRevenueFiltering(dateFrom, dateTo));
//   	}
// }


function _reportRevenueFiltering(dateFrom, dateTo) {
  $("#get-form-more-div")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);

  try {

    /*
    // ===============================
    // BACKEND INTEGRATION
    // Uncomment when API is ready
    // ===============================

    _callFetchEndPoints({
      url: `admin/account-reports/fetch-revenue-by-date-range?dateFrom=${dateFrom}&dateTo=${dateTo}`,
      accessKey: true,
    })
    .then((response) => {
      _processRevenueResponse(response);
    })
    .catch((error) => {
      _staffValidationCheck(error.response);
      console.error("Error:", error);
    });

    */

    // ===============================
    // DUMMY RESPONSE
    // ===============================

      const response = {
      response: 200,
      success: true,
      message: "DASHBOARD REVENUE FETCHED SUCCESSFULLY",
      dateFrom: "July 09 2026",
      dateTo: "August 07 2026",
      totalRevenue: "20000.00",
      statistics: {
          totalAdvancePayments: "10000.00",
          totalServicePayments: "10000.00",
          totalStripeRevenue: "30000.00",
          totalPayPalRevenue: "25000.00",

          countAdvanceTransactions: 2,
          countServiceTransactions: 3,
      },
      data: [
          {
              payDate: "2026-07-29",
              totalSuccessfulFees: "5000.00",
              totalPendingFees: "1000.00",
              totalCancelledFees: "0.00",
              paymentViewed: false
          },
          {
              payDate: "2026-07-30",
              totalSuccessfulFees: "3000.00",
              totalPendingFees: "2000.00",
              totalCancelledFees: "500.00",
              paymentViewed: false
          },
          {
              payDate: "2026-07-31",
              totalSuccessfulFees: "4000.00",
              totalPendingFees: "1500.00",
              totalCancelledFees: "0.00",
              paymentViewed: false
          },
          {
              payDate: "2026-08-01",
              totalSuccessfulFees: "8000.00",
              totalPendingFees: "2500.00",
              totalCancelledFees: "1000.00",
              paymentViewed: true
          }
      ]
  };

    const statistic = response.statistics;

    $("#dateFrom").html(response.dateFrom);
    $("#dateTo").html(response.dateTo);

    $("#totalRevenue").html("$" + thousandSeperator(response.totalRevenue));
    $("#totalAdvancePayments").html("$" + thousandSeperator(statistic.totalAdvancePayments));
    $("#totalServicePayments").html("$" + thousandSeperator(statistic.totalServicePayments));
    $("#totalStripeRevenue").html("$" + thousandSeperator(statistic.totalStripeRevenue));
    $("#totalPayPalRevenue").html("$" + thousandSeperator(statistic.totalPayPalRevenue));
    $("#countAdvanceTransactions").html(statistic.countAdvanceTransactions);
    $("#countServiceTransactions").html(statistic.countServiceTransactions);

    const dataPoints = [
      {
        label: "Stripe",
        y: Number(statistic.totalStripeRevenue)
      },
      {
        label: "Paypal",
        y: Number(statistic.totalPayPalRevenue)
      }
    ];

    $("#chartContainer1").CanvasJSChart({
      data: [{
        type: "doughnut",
        innerRadius: 30,
        indexLabel: "{label} ({y})",
        yValueFormatString: "$#,##0.00",
        indexLabelFontSize: 10,
        dataPoints
      }]
    });

    $("#chartContainer2").CanvasJSChart({
      data: [{
        type: "pie",
        startAngle: 45,
        indexLabel: "{label} ({y})",
        indexLabelFontSize: 10,
        dataPoints: [
          {
            label: "Total Advanced Payment",
            y: statistic.countAdvanceTransactions
          },
          {
            label: "Total Services Payment",
            y: statistic.countServiceTransactions
          }
        ]
      }]
    });

    if (response.data.length > 0) {
      _initFetchAccountReportTableData(response);
    } else {
      _showEmptyState({
        container: "acoountReportPageContent",
        message: "No payment records found!",
        colspan: 20,
        paginationContainer: "acoountReportPageContentPaginationControls",
      });
    }

    $("#get-form-more-div").fadeOut(500);

  } catch (error) {
    _alertClose();
    console.error("Error:", error);
    _callCatchError(() => _reportRevenueFiltering(dateFrom, dateTo));
  }
}

/// Render Account Table Data ///
function _renderAccountTableData(data, start) {
  return data
    .map((fetchedData, i) => {
      const no = start + i + 1;

      const payDate = new Date(fetchedData.payDate);
      const newpayDate = payDate.toISOString().split("T")[0];

      const totalSuccessfulFees = fetchedData.totalSuccessfulFees;
      const totalPendingFees = fetchedData.totalPendingFees;
      const totalCancelledFees = fetchedData.totalCancelledFees;

      const viewedPayment =
        fetchedData.paymentViewed === false
          ? `
            <div class="text-div">
              <div class="new-payment animated fadeIn">New</div>
            </div>
          `
          : "";

      return `
        <tr class="tb-row">
          <td>${no}</td>

          <td class="clickable-td"
              title="Click to view payment breakdown"
              onclick="_getForm({
                page: 'revenueBreakdown',
                id: '${newpayDate}',
                url: adminPortalLocalUrl
              });">

            <div class="text-back-div date-text-div">
              <div class="date-div">
                <i class="bi bi-calendar-check-fill"></i>
              </div>

              ${newpayDate}
              ${viewedPayment}
            </div>
          </td>

          <td class="SUCCESSFULSTATUS">
            <s>N</s>${thousandSeperator(totalSuccessfulFees)}
          </td>

          <td class="PENDINGSTATUS">
            <s>N</s>${thousandSeperator(totalPendingFees)}
          </td>

          <td class="CANCLLEDSTATUS">
            <s>N</s>${thousandSeperator(totalCancelledFees)}
          </td>

          <td>
            <button class="btn view-btn"
              title="Click to view payment breakdown"
              onclick="_getForm({
                page: 'revenueBreakdown',
                id: '${newpayDate}',
                url: portalMiddleWareUrl
              });">
              VIEW DETAILS
            </button>
          </td>
        </tr>
      `;
    })
    .join("");
}

/// Initialize Fetch Account Report Table Data ///
function _initFetchAccountReportTableData(response) {
  const paginator = new Paginator(
    response.data || [],
    _renderAccountTableData,
    "acoountReportPageContentPaginationControls",
    "acoountReportPageContent",
    10
  );

  __paginatorHandlers["acoountReportPageContentPaginationControls"] = paginator;
  paginator.renderPage();
}