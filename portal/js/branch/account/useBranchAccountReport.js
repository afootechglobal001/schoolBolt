function _getActiveBranchReportNav(props) {
  const {
    page = "",
    divid = "",
    pageContainer = "getBranchReportNavPage",
  } = props;
  _getBranchReportActiveNav(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getBranchReportActiveNav(divid) {
  $(
    "#filterBranchByDate, #filterBranchBySession"
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

function _getBranchPaymentStatusNav(props) {
  const {
    page = "",
    divid = "",
    id="",
    pageContainer = "getBranchPaymentNav",
  } = props;
  _getActiveBranchPaymentStatusNav(divid);
  if (page) {
    _getPage({
      page: page,
      id: id,
      pageContainer: pageContainer,
      url: adminPortalLocalUrl,
    });
  }
}
function _getActiveBranchPaymentStatusNav(divid) {
  $(".title-nav-back-div ul li").removeClass("active-li");
  $("#" + divid).addClass("active-li");
}


///// Dashbaord Custom Revenue Filtering ////////
function _fetchBranchRevenueReportFiltering(filterWith, text) {
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

  _branchReportRevenueFiltering(dateFrom, dateTo);
}
function _fetchCustomBranchRevenueReportFiltering() {
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

  _branchReportRevenueFiltering(dateFrom, dateTo);
}

function _branchReportRevenueFiltering(dateFrom, dateTo) {
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
    url: `${endPoint}/admin/branch/account/account-reports/fetch-revenue-by-date-range?dateFrom=${dateFrom}&dateTo=${dateTo}&branchId=${getEachBranchDetailsSession?.branchId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistic = info.statistics[0];
        const totalRevenue = thousandSeperator(info.totalRevenue);

        /// Update Total Revenue ///
        $("#totalRevenue").html("<s>N</s>" + totalRevenue);

        // Update custom date from and date to///
        $("#dateFrom").html(info.dateFrom);
        $("#dateTo").html(info.dateTo);

        // Update Report Statistics info///
        $("#sumCreditCardPayments").html("<s>N</s>" + thousandSeperator(statistic.sumCreditCardPayments));
        $("#sumBankTransferPayments").html("<s>N</s>" + thousandSeperator(statistic.sumBankTransferPayments));
         $("#sumManualPayments").html("<s>N</s>" + thousandSeperator(statistic.sumManualPayments));
        $("#countCreditCardPayments").html(statistic.countCreditCardPayments);
        $("#countBankTransferPayments").html(statistic.countBankTransferPayments);
        $("#countManualPayments").html(statistic.countManualPayments);

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
          {
            label: "Manual Payment",
            y: Number(statistic.sumManualPayments) || 0,
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
                {
                  label: "Manual Payment",
                  y: parseInt(statistic.countManualPayments),
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
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchRevenueBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">${newpayDate}</td>
                <td class="SUCCESSFULSTATUS"><s>N</s>${thousandSeperator(totalSuccessfulFees)}</td>
                <td class="PENDINGSTATUS"><s>N</s>${thousandSeperator(totalPendingFees)}</td>
                <td class="CANCLLEDSTATUS"><s>N</s>${thousandSeperator(totalCancelledFees)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchRevenueBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
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
  $("#get-more-div-secondary").fadeOut(500);
}

function _fetchBranchRevenueBySessionAndTerm() {
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

  const btnText = $("#filterBrnachRevenueBtn").html();
  $("#filterBrnachRevenueBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="10px" alt="Loading"/>');
  $("#filterBrnachRevenueBtn").prop("disabled", true);

    $("#branchSessionTermContent")
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
    url: `${endPoint}/admin/branch/account/account-reports/fetch-revenue-by-term?session=${session}&termId=${termId}&branchId=${getEachBranchDetailsSession?.branchId}`,
    dataType: "json",
    cache: false,
    headers: getAuthHeaders(true),
    success: function (info) {
      if (info.success && info.statistics.length > 0) {
        const statistic = info.statistics[0];
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

        sessionStorage.setItem("branchSessionTermData", JSON.stringify({
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
                <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchRevenueBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">${newpayDate}</td>
                <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchRevenueBreakdown', id: '${newpayDate}', layer:2, url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
              </tr>
            `;
          }
          $("#branchSessionTermContent").html(text);
        } else {
          text += `
            <tr>
                <td colspan="20">
                  <div class="false-notification-div">
										<p>No payment record found!</p>
									</div>
                </td>
            </tr>`;
          $("#branchSessionTermContent").html(text);
        }
        $("#filterBrnachRevenueBtn").html(btnText).prop("disabled", false);
      } else {
        const response = info.response;
        if (response < 100) {
          _logOut();
        }
      }
    },
    error: function (err) {
      console.error(err);
      $("#filterBrnachRevenueBtn").html(btnText).prop("disabled", false);
    },
  });
}

function _loadBranchPaymentsByStatus(statusId, newpayDate) {
  let getEachBranchDetailsSession = JSON.parse(
    sessionStorage.getItem("getEachBranchDetailsSession"),
  );

  let branchSessionTermData = JSON.parse(
    sessionStorage.getItem("branchSessionTermData")
  );

  let url = `${endPoint}/admin/branch/account/account-reports/fetch-revenue-by-date?date=${newpayDate}&statusId=${statusId}&branchId=${getEachBranchDetailsSession?.branchId}`;

  if (branchSessionTermData?.session && branchSessionTermData?.termId) {
    url= `${endPoint}/admin/branch/account/account-reports/fetch-revenue-by-date?date=${newpayDate}&statusId=${statusId}&session=${branchSessionTermData?.session}&termId=${branchSessionTermData?.termId}&branchId=${getEachBranchDetailsSession?.branchId}`;
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
                      <div class="btn-div">
                        <button class="btn view-btn"
                          title="Click to view payment breakdown"
                          onclick="_fetchBranchRevenueById('${paymentId}');">
                          VIEW DETAILS
                        </button>

                        <button class="btn view-btn print-btn"
                          id="refreshBtn_${paymentId}"
                          title="Click to refresh payment"
                          onclick="_proceedVerifyBranchPaystackTransaction('${paymentId}');">
                          REFRESH
                        </button>
                      </div>
                    </td>
                  `;
                } else {
                  buttonHtml = `
                    <td>
                      <button class="btn view-btn"
                          title="Click to view payment breakdown"
                          onclick="_fetchBranchRevenueById('${paymentId}');">
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
            $('#branchPageContent').html(text);
          } else {
            text += `
              <tr>
                  <td colspan="20">
                    <div class="false-notification-div">
                      <p>No payment record found!</p>
                    </div>
                  </td>
              </tr>`;
            $("#branchPageContent").html(text);
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

function _fetchBranchRevenueById(paymentId) {
	$("#get-more-third-layer").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {
		$.ajax({
			type: "GET",
			url: `${endPoint}/admin/branch/account/account-reports/fetch-revenue-by-id?paymentId=${paymentId}`,
			dataType: "json", 
			cache: false,
			headers: getAuthHeaders(true),
			success: function(info) {
				if (info.success && info.data.length > 0) {
					sessionStorage.setItem("getBranchRevenueBreakdownSessionData", JSON.stringify(info.data[0]));
					_getForm({ page: 'branchPaymentBreakDownForm', layer: 3, url: adminPortalLocalUrl });
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

function _proceedVerifyBranchPaystackTransaction(paymentId) {

  try {
    const btnText = $(`#refreshBtn_${paymentId}`).html();
    $(`#refreshBtn_${paymentId}`).html('<img src="' + websiteUrl + '/images/loading.gif" width="10px" alt="Loading"/>');
    $(`#refreshBtn_${paymentId}`).prop("disabled", true);

    $.ajax({
      type: "GET",
      url: `${endPoint}/admin/branch/account/account-reports/verify-paystack-transaction?paymentId=${paymentId}`,
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(true),
      success: function (info) {
        if (info.success===true) {
          const branchId = info.branchId;
          const paymentId = info.paymentId; 
          const secretKey = info.secretKey;

          _verifyBranchPaystackTransaction(branchId, paymentId, secretKey, btnText);
        } else {
          _actionAlert(data.message, false);
          $(`#refreshBtn_${paymentId}`).html(btn_text).prop("disabled", false);

          const response = info.response;
          if (response < 100) {
            _logOut();
          }
        }
      },
      error: function(textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert('Check your internet connection and try again.', false);
        $(`#refreshBtn_${paymentId}`).html(btnText).prop("disabled", false);
      },
    });
  } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
    $(`#refreshBtn_${paymentId}`).html(btnText).prop("disabled", false);
	}
}

function _verifyBranchPaystackTransaction(branchId, paymentId, secretKey, btnText) {
  let branchSessionPayDate = sessionStorage.getItem("branchSessionPayDate");

  $.ajax({
    url: `https://api.paystack.co/transaction/verify/${paymentId}`,
    type: "GET",
    headers: {
      "Authorization": "Bearer " + secretKey,
      "Content-Type": "application/json"
    },
    success: function (data) {
      if (data.status === true && data.data.status === "success") {
        _callVerifyBranchPaymentSuccess(paymentId, branchId, btnText);
      } else {
        _callBranchVerifyPaymentCancelled(paymentId);
        _showCustomConfirm({
            callback: () => {
              _getBranchPaymentStatusNav({
                divid: 'branchCancelledPage',
                page: 'branchCancelledPage',
                id: branchSessionPayDate,
                url: adminPortalLocalUrl
              });
            },
            title: "Transaction Not Successful!",
            message: "This transaction was not successful and has been automatically cancelled by the system.",
            alertType: "error",
            trueActionBtnText: "Got It",
            closeOnOverlayClick: false,
        });
        $(`#refreshBtn_${paymentId}`).html(btnText).prop("disabled", false);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      _callBranchVerifyPaymentCancelled(paymentId);
      _showCustomConfirm({
          callback: () => {
            _getBranchPaymentStatusNav({
              divid: 'branchCancelledPage',
              page: 'branchCancelledPage',
              id: branchSessionPayDate,
              url: adminPortalLocalUrl
            });
          },
          title: "Transaction Not Successful!",
          message: "This transaction was not successful and has been automatically cancelled by the system.",
          alertType: "error",
          trueActionBtnText: "Got It",
          closeOnOverlayClick: false,
      });
      $(`#refreshBtn_${paymentId}`).html(btnText).prop("disabled", false);
    }
  });

}

function _callVerifyBranchPaymentSuccess(paymentId, branchId, btnText) {
 let branchSessionPayDate = sessionStorage.getItem("branchSessionPayDate");
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
          _getBranchPaymentStatusNav({
            divid: 'branchSuccessfulPage',
            page: 'branchSuccessfulPage',
            id: branchSessionPayDate,
            url: adminPortalLocalUrl
          });
        } else {
          _actionAlert(data.message, false);
          $(`#refreshBtn_${paymentId}`).html(btnText).prop("disabled", false);
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

function _callBranchVerifyPaymentCancelled(paymentId) {
  try {
    const formData = {
      paymentId: paymentId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/payment-cancelled`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function () {},
      error: function (error) {
        console.log(error);
      },
    });
  } catch (error) {
    console.log(error);
  }
}