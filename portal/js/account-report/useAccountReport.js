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
      url: adminPortalLocalUrl,
    });
  }
}
function _getActivePaymentStatusNav(divid) {
  $(".title-nav-back-div ul li").removeClass("active-li");
  $("#" + divid).addClass("active-li");
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

        // Update Report Statistics info///
        $("#sumCreditCardPayments").html("<s>N</s>" + thousandSeperator(statistic.sumCreditCardPayments));
        $("#sumBankTransferPayments").html("<s>N</s>" + thousandSeperator(statistic.sumBankTransferPayments));
        $("#countCreditCardPayments").html(statistic.countCreditCardPayments);
        $("#countBankTransferPayments").html(statistic.countBankTransferPayments);

        //// Update Dougnut Chart Revenue ///
        const dataPoints = [
          {
            label: "Credit Card",
            y: Number(statistic.sumCreditCardPayments) || 0,
          },
          {
            label: "Bank Transfer",
            y: Number(statistic.sumBankTransferPayments) || 0,
          },
        ];

        $("#chartContainer1").CanvasJSChart({
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

        // Update Pie Chart credit and bank transfer ///
        const options = {
          title: {
            text: "",
          },
          data: [
            {
              type: "pie",
              startAngle: 45,
              showInLegend: "False",
              legendText: "{label}",
              indexLabel: "{label} ({y})",
              yValueFormatString: "#,##0.#" % "",
              indexLabelFontSize: 9,
              dataPoints: [
                {
                  label: "Debit/Credit Card",
                  y: parseInt(statistic.countCreditCardPayments),
                },
                {
                  label: "Bank Transfer",
                  y: parseInt(statistic.countBankTransferPayments),
                },
              ],
            },
          ],
        };

        $("#chartContainer2").CanvasJSChart(options);

        // Update Report revenue Table ///
        let text = "";
        let no = 0;
        if (info.data && info.data.length > 0) {
          for (let i = 0; i < info.data.length; i++) {
            no++;
            const fetchedData = info.data[i];
            const payDate = new Date(fetchedData.payDate);
            const newpayDate = payDate.toISOString().split("T")[0];
            const totalSuccessfulFees = fetchedData.totalSuccessfulFees;
            const totalPendingFees = fetchedData.totalPendingFees;
            const totalCancelledFees = fetchedData.totalCancelledFees;

            text += `
              <tr class="tb-row">
                <td>${no}</td>
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'revenueBreakdown', id: '${newpayDate}', url: adminPortalLocalUrl});">${newpayDate}</td>
                <td class="SUCCESSFULSTATUS"><s>N</s>${thousandSeperator(totalSuccessfulFees)}</td>
                <td class="PENDINGSTATUS"><s>N</s>${thousandSeperator(totalPendingFees)}</td>
                <td class="CANCLLEDSTATUS"><s>N</s>${thousandSeperator(totalCancelledFees)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'revenueBreakdown', id: '${newpayDate}', url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
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

  // Save to sessionStorage
  sessionStorage.setItem('selectedSession', session);
  sessionStorage.setItem('selectedTermId', termId);

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

        sessionStorage.setItem("sessionTermData", JSON.stringify({
					session: info.session,
					termId: info?.termData?.termId
				}));

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
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'revenueBreakdown', id: '${newpayDate}', url: adminPortalLocalUrl});">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'revenueBreakdown', id: '${newpayDate}', url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
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

function _loadPaymentsByStatus(statusId, newpayDate) {
  let sessionTermData = JSON.parse(
    sessionStorage.getItem("sessionTermData")
  );

  let url = `${endPoint}/admin/account-reports/fetch-revenue-by-date?date=${newpayDate}&statusId=${statusId}`;

  if (sessionTermData?.session && sessionTermData?.termId) {
    url= `${endPoint}/admin/account-reports/fetch-revenue-by-date?date=${newpayDate}&statusId=${statusId}&session=${sessionTermData?.session}&termId=${sessionTermData?.termId}`;
  }

  try {
		$.ajax({
			type: "GET",
			url: url,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success) {

					const fetchedData = info.data;

          $('#date').html(info?.date);
          if (statusId === '5' && fetchedData.length > 0) {
            $('output').show();
            $('#totalAmount').html("<s>N</s>" + thousandSeperator(info?.totalAmount));
          } else {
            $('output').hide();
          }

          let text = "";
          let no = 0;

          if (fetchedData && fetchedData.length > 0) {
            for (let i = 0; i < fetchedData.length; i++) {
                no++;
                const fetchStudentData = fetchedData[i].studentData;
                const fetchParentData = fetchedData[i]?.parentData;
                const fetchBranchData = fetchedData[i].branchData;
                const fetchTermData = fetchedData[i].termData;
                const fetchClassData = fetchedData[i].classData;
                const fetchArmData = fetchedData[i].armData;
                const totalFeesPaid = fetchedData[i].totalFeesPaid;
                const fetchedStatusData = fetchedData[i].statusData;
                const payDate = fetchedData[i].payDate;
                const session = fetchedData[i].session;
                const departmentId = fetchedData[i].departmentId;
                const paymentId = fetchedData[i].paymentId;

                //// Student Data ////
                const studentId = fetchStudentData.studentId;
                const passport = fetchStudentData.passport || 'default.jpg';
                const surName = fetchStudentData.surName;
                const firstName = fetchStudentData.firstName;
                const otherNames = fetchStudentData.otherNames;
                const fullname = surName + ' ' + firstName + ' ' + otherNames;

                //// Parent Data ////
                const titleId = fetchParentData?.titleId || '';
                const parentSurName = fetchParentData?.surName || '';
                const parentOtherNames = fetchParentData?.otherNames || '';
                const parentFullname = `${titleId} ${parentSurName} ${parentOtherNames}`.trim();
                const parentEmail = fetchParentData?.email || '';
                const recordFor = fetchParentData?.recordFor || '';
                const parentPhone = fetchParentData?.mobileNumber || '';

                //// Branch Data ////
                const branchName = fetchBranchData.branchName;
                const branchMobile = fetchBranchData.mobileNumber;
                const branchId = fetchBranchData.branchId;

                /// Term Data ///
                const termName = fetchTermData.termName;

                /// Class Data ///
                const className = fetchClassData.className;
                const classId = fetchClassData.classId;

                /// Arm Data ///
                const armId = fetchArmData.armId;
                const armName = fetchArmData.armName;

                /// Status Data ///
                const statusName = fetchedStatusData.statusName;
                const statusId = fetchedStatusData.statusId;

                let buttonHtml = '';

                $('#revenueAlert').removeClass('alert-success alert-failed');
                if (statusName === 'SUCCESSFUL') {
                  $('#revenueAlert').addClass('alert-success');
                } else {
                  $('#revenueAlert').addClass('alert-failed');
                }

                if (statusId === '3') {
                  buttonHtml = `
                    <td>
                      <button class="btn view-btn"
                          id="refreshBtn"
                          title="Click to refresh payment"
                          onclick="_proceedVerifyPaystackTransaction('${paymentId}');">
                        REFRESH
                      </button>
                    </td>
                  `;
                } else {
                  buttonHtml = `
                    <td>
                      <button class="btn view-btn"
                          title="Click to view payment breakdown"
                          onclick="_fetchRevenueById('${paymentId}');">
                        VIEW DETAILS
                      </button>
                    </td>
                  `;
                }

                text += `
                  <tr class="tb-row">
                      <td>${no}</td>

                      <td class="clickable-td"
                          title="Click to view student details"
                          onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">

                          <div class="text-back-div">
                              <div class="image-div general-passport">
                                  <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                              </div>

                              <div class="text-div">
                                  <div class="first-class">${fullname}</div>
                                  <div class="second-class">${studentId}</div>
                              </div>
                          </div>
                      </td>

                      <td class="clickable-td"
                          title="Click to view father details"
                          onclick="_loginOnbehalfOfParent('${parentEmail}','${recordFor}','${studentId}');">

                          <div class="text-back-div">
                              <div class="text-div">
                                  <div class="first-class">${parentFullname}</div>
                                  <div class="second-class">${parentEmail}</div>
                                  <div class="second-class">${parentPhone}</div>
                              </div>
                          </div>
                      </td>

                      <td class="clickable-td"
                          title="Click to view branch profile"
                          onclick="_fetchEachBranches('${branchId}');">
                          ${branchName}<br />
                          <span>${branchMobile}</span>
                      </td>

                      <td>${session} - ${termName}</td>

                      <td>${className} ${armName}</td>

                      <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>

                      <td>
                          <div class="status-div ${statusName}">
                              ${statusName}
                          </div>
                      </td>

                      <td>${payDate}</td>
                      ${buttonHtml} 
                  </tr>
              `;
            }
            $('#pageContent').html(text);
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


function _proceedVerifyPaystackTransaction(paymentId) {

  try {
    const btnText = $("#refreshBtn").html();
    $("#refreshBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="10px" alt="Loading"/>');
    $("#refreshBtn").prop("disabled", true);

    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/account-reports/verify-paystack-transaction?paymentId=${paymentId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success===true) {
          const branchId = info.branchId;
          const paymentId = info.paymentId; 
          const secretKey = info.secretKey;

          _verifyPaystackTransaction(branchId, paymentId, secretKey, btnText);
        } else {
          _actionAlert(data.message, false);
          $("#refreshBtn").html(btn_text).prop("disabled", false);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function(textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert('Check your internet connection and try again.', false);
        $("#refreshBtn").html(btnText).prop("disabled", false);
      },
    });
  } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
    $("#refreshBtn").html(btnText).prop("disabled", false);
	}
}

function _verifyPaystackTransaction(branchId, paymentId, secretKey, btnText) {

  $.ajax({
    url: `https://api.paystack.co/transaction/verify/${paymentId}`,
    type: "GET",
    headers: {
      "Authorization": "Bearer " + secretKey,
      "Content-Type": "application/json"
    },
    success: function (data) {
      console.log(data);
      if (data.status === true && data.data.status === "abandoned") {
        _callVeifyPaymentSuccess(paymentId, branchId, btnText);
      } else {
        _actionAlert('Transaction is still in pending status', false);
        $("#refreshBtn").html(btnText).prop("disabled", false);
      }

    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      _actionAlert("An unexpected error occurred! Please try again.", false);
      $("#refreshBtn").html(btnText).prop("disabled", false);
    }
  });

}

function _callVeifyPaymentSuccess(paymentId, branchId, btnText) {
 let sessionPayDate = sessionStorage.getItem("sessionPayDate");
  try {
    const formData = {
      paymentId: paymentId,
      branchId: branchId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/payment-success`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function (data) {
        if (data.success) {
         _actionAlert(data.message, true);
          _getPaymentStatusNav({
            divid: 'successfulPage',
            page: 'successfulPage',
            id: sessionPayDate,
            url: adminPortalLocalUrl
          });
        } else {
          _actionAlert(data.message, false);
          $("#refreshBtn").html(btnText).prop("disabled", false);
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  } catch (error) {
    console.log(error);
  }
}