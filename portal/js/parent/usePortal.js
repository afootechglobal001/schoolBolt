function _getActiveStudentPortalPage(props) {
  const { page = "", divid = "", pageContainer = "getStudentDetails" } = props;
  _getStudentPortalPageActiveLink(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: parentPortalLocalUrl,
    });
  }
}

function _getStudentPortalPageActiveLink(divid) {
  $(
    "#studentDashbaord, #paymentHistory, #studentProfile, #studentResult",
  ).removeClass("active");
  $("#" + divid).addClass("active");
}

function getAuthHeaders() {
  return {
    apiKey: apiKey,
    userOsBrowser: userOsBrowser,
    userIpAddress: userIpAddress,
    userDeviceId: userDeviceId,
    clientId: clientId,
    clientAddress: clientAddress,
  };
}

function _logOut() {
  localStorage.clear();
  window.parent.location.href = parentLoginUrl;
}

function _confirmLogOut() {
  _showCustomConfirm({
    callback: () => {
      _logOut();
    },
    title: "Confirm Logout Action!",
    message:
      "Are you sure you want to log out? You may miss important notifications or updates until you sign in again.",
    alertType: "warning",
    falseActionBtn: true,
    closeOnOverlayClick: true,
  });
}

window.addEventListener("load", function () {
  const sessionData = localStorage.getItem("parentSessionData");
  if (!sessionData || sessionData === '""') {
    _logOut();
  }
});

function _getFetchEachStudent(Id) {
  let parentSessionData = JSON.parse(localStorage.getItem("parentSessionData"));
  let parentStudents = parentSessionData.students;
  let student = parentStudents.find((s) => s.studentId === Id);
  if (student) {
    sessionStorage.setItem("getEachStudentSession", JSON.stringify(student));
    _getForm({ page: "studentProfileForm", url: parentPortalLocalUrl });
  }
}

function _toggleCheck() {
  $(".switch input").on("change", function () {
    const label = $(this).next().next(); // Grab the toggle-label span
    label.text($(this).prop("checked") ? "Yes" : "No");
  });
}

function _getPpaymentFormDetails(icon, nextId) {
  $("#proceedHideDiv").hide();
  $("#" + nextId).fadeIn(1000);
  $("#summaryHideDiv").fadeOut(500);
  $("#panel-title").html(
    $("#" + icon).html() + " <span>PAYMENT SUMMARY</span>",
  );
}

function _prevPage(nextId) {
  $("#proceedHideDiv").hide();
  $("#" + nextId).fadeIn(1000);
  $("#panel-title").html('<i class="bi-plus-square"></i> </span> FEES PAYMENT');
}

function selectSearch() {
  $(".srch-select").toggle("fast");
}
function srchCustom(text) {
  $("#srch-text").html(text);
  $(".custom-srch-div").fadeIn(500);
}

function _collapse(divId) {
  var x = document.getElementById(divId + "num");
  if (x.innerHTML === '&nbsp;<i class="bi-plus"></i>&nbsp;') {
    x.innerHTML = '&nbsp;<i class="bi-dash"></i>&nbsp;';
  } else {
    x.innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
  }
  $("#" + divId + "answer").slideToggle("slow");
}



function _fetchFeesToPay() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );
  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    const formData = {
      studentId: getEachStudentSession?.studentData?.studentId,
      branchId: getEachStudentSession?.branchData?.branchId,
      departmentId: getEachStudentSession?.departmentData?.departmentId,
      classId: getEachStudentSession?.classData?.classId,
      armId: getEachStudentSession?.armData?.armId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/get-fees-to-pay`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function (info) {
        if (info.success) {
          sessionStorage.setItem(
            "getPayFeesToPaySession",
            JSON.stringify(info),
          );

          //// Check if student have an outstanding payment for last term /// 
          const haveOutstandingFeesForLastTerm = info?.haveOutstandingFeesForLastTerm;
          if (haveOutstandingFeesForLastTerm===true) {
            _alertClose(2);
            _showCustomConfirm({
              title: "Outstanding Fees Detected!",
              message: info.message,
              alertType: "error",
              falseActionBtn: true,
              trueActionBtnText: "PROCCED TO PAY",
              falseActionBtnText: "CANCEL",
              trueActionCallback: () => {
                _getForm({
                  page: "paymentForm",
                  layer: 2,
                  url: parentPortalLocalUrl,
                });
              },
              closeOnOverlayClick: false,
            });
          } else {
            _getForm({
              page: "paymentForm",
              layer: 2,
              url: parentPortalLocalUrl,
            });
          }
        } else {
          _showCustomConfirm({
            title: "Cannot Proceed!",
            message: info.message,
            alertType: "error",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _alertClose(2);
        }
      },
      error: function (textStatus, errorThrown) {
        _alertClose(2);
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    _alertClose(2);
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}


//// Proceed To Payment /////
function _proceedToPayment() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );
  let parentSessionData = JSON.parse(localStorage.getItem("parentSessionData"));

  try {
    let issueCount = 0;
    const paymentMethodId = $("#paymentMethodId").val().trim();

    ///// empty field validation//////////
    issueCount += _validateEmptyValue("paymentMethodId", "PAYMENT METHOD");

    let selectedFees = [];

    $(".child:checked").each(function () {
      const feesId = $(this).data("value");
      selectedFees.push({ feesId: feesId });
    });

    if (selectedFees.length === 0) {
      _actionAlert("Please select at least one fee to continue.", false);
      return;
    }

     if (issueCount > 0) return;

    ///// Gather form data ////
    const formData = {
      session: getEachStudentSession?.branchData?.currentSession,
      termId: getEachStudentSession?.branchData?.termId,
      studentId: getEachStudentSession?.studentData?.studentId,
      branchId: getEachStudentSession?.branchData?.branchId,
      departmentId: getEachStudentSession?.departmentData?.departmentId,
      classId: getEachStudentSession?.classData?.classId,
      armId: getEachStudentSession?.armData?.armId,
      feesIds: selectedFees,
      paymentMethodId: paymentMethodId,
      email: parentSessionData?.parentData?.email,
    };

    ////// confirm action ////
    _showCustomConfirm({
      callback: () => {
        _proceedToPaymentCallback(formData);
      },
      title: "Are you sure?",
      message: "Are you sure you want to proceed to payment?",
      alertType: "warning",
      falseActionBtn: true,
      closeOnOverlayClick: true,
    });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedToPayment());
  }
}

//// Proceed To Payment CallBack /////
function _proceedToPaymentCallback(formData) {
  try {
    const btnText = $("#submitBtn").html();
    _btnDisable("submitBtn", btnText, true);

    _callRawEndPoints({
      url: `parent/payment/proceed-to-payment`,
      formData,
      accessKey: true,
    })
      .then((response) => {
        if (response.success) {
            sessionStorage.setItem(
              "studentPaymentSession",
              JSON.stringify(response),
            );
            const paymentKey = response.paymentKey;
            const secretKey = response.secretKey;
            const paymentId = response.paymentId;
            const email = response.email;
            const amount = response.amount;
            //const paymentMethodId = response.paymentMethodId;
            const deductCharges = response.deductCharges;
            const schoolBoltCharges = response.schoolBoltCharges;
            const receiverKey = response.receiverKey;
            const paymentChannel = response.paymentChannel;

            _callPayStack(
              paymentKey,
              secretKey,
              paymentId,
              email,
              amount,
              deductCharges,
              schoolBoltCharges,
              receiverKey,
              paymentChannel,
            );
        } else {
          _showCustomConfirm({
            title: "Unable to Process Payment",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
          _btnDisable("submitBtn", btnText, false);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() => _proceedToPaymentCallback(formData)); // retry if needed
        _btnDisable("submitBtn", btnText, false);
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() => _proceedToPaymentCallback(formData));
    _btnDisable("submitBtn", btnText, false);
  }
}

////// CALL PAYSTACK ////////////////
function _callPayStack(
  paymentKey,
  secretKey,
  paymentId,
  email,
  amount,
  deductCharges,
  schoolBoltCharges,
  receiverKey,
  paymentChannel,
) {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );
  let parentSessionData = JSON.parse(localStorage.getItem("parentSessionData"));
  const parentFullname =
    parentSessionData.parentData.titleId +
    " " +
    parentSessionData.parentData.surName +
    " " +
    parentSessionData.parentData.otherNames;
  const parentPhoneNumber = parentSessionData.parentData.mobileNumber;
  const branchId = getEachStudentSession.branchData.branchId;

  // Create the base options
  const options = {
    key: paymentKey,
    email: email,
    amount: amount, // Amount in kobo
    ref: paymentId,
    currency: "NGN",
    channels: paymentChannel ? [paymentChannel] : ["card", "bank_transfer"],
    metadata: {
      custom_fields: [
        {
          display_name: parentFullname,
          variable_name: "mobile_number",
          value: parentPhoneNumber,
        },
      ],
    },
    callback: function (response) {
      const paystackId = $.trim(response.transaction);
      $("#get-more-div-secondary")
        .css({
          display: "flex",
          "justify-content": "center",
          "align-items": "center",
        })
        .html(
          `<div class="alert-loading-div"><div class="icon"><img src="${websiteUrl}/images/loading.gif" width="20px" alt="Loading"/></div><div class="text"><p>PROCESSING...</p></div></div>`,
        )
        .fadeIn(500);
      _getTransactionDetailsFromPaystack(paymentId, secretKey, branchId, paystackId);
    },
    onClose: function () {
      _callPaymentCancelled(paymentId);
      return false;
    },
  };
  // Conditionally add the split configuration
  if (deductCharges) {
    options.split = {
      type: "flat",
      bearer_type: "account",
      subaccounts: [
        {
          subaccount: receiverKey, // Replace with actual subaccount code
          share: schoolBoltCharges, // Amount in kobo
        },
      ],
    };
  }

  var handler = PaystackPop.setup(options);
  handler.openIframe();
}

function _getTransactionDetailsFromPaystack(paymentId, secretKey, branchId, paystackId) {
  try{
  $.ajax({
   url: `https://api.paystack.co/transaction/${paystackId}`,
    type: "GET",
    headers: {
      "Authorization": "Bearer " + secretKey,
      "Content-Type": "application/json"
    },
    success: function (data) {
      if (data.status === true && data.data.status === "success") {
        const paystackCharges = $.trim(data?.data?.fees);
        _callPaymentSuccess(paymentId, branchId, paystackId, paystackCharges);
      } else {
        _callPaymentSuccess(paymentId, branchId, paystackId, paystackCharges);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error:", error);
      _callPaymentSuccess(paymentId, branchId, paystackId, paystackCharges);
    }
  });
  }catch (error) {
    console.log(error);
    _callPaymentSuccess(paymentId, branchId, paystackId, paystackCharges);
  }
}

function _callPaymentSuccess(paymentId, branchId, paystackId, paystackCharges) {
  try {
    const formData = {
      paymentId: paymentId,
      branchId: branchId,
      paystackId: paystackId,
      paystackCharges: paystackCharges,
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
          _getForm({
            page: "payemntSuccessForm",
            layer: 2,
            url: parentPortalLocalUrl,
          });
        } else {
          _actionAlert(data.message, false);
          _getForm({
            page: "payemntSuccessForm",
            layer: 2,
            url: parentPortalLocalUrl,
          });
        }
      },
      error: function (error) {
        console.log(error);
        _getForm({
          page: "payemntSuccessForm",
          layer: 2,
          url: parentPortalLocalUrl,
        });
      },
    });
  } catch (error) {
    console.log(error);
    _getForm({
      page: "payemntSuccessForm",
      layer: 2,
      url: parentPortalLocalUrl,
    });
  }
}

function _callPaymentCancelled(paymentId) {
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
      success: function () {
        $("#submitBtn")
          .html('<i class="bi-check"></i> MAKE PAYMENT')
          .prop("disabled", false);
      },
      error: function (error) {
        _actionAlert(
          "An error occurred while processing your request: " + error,
          false,
        );
        $("#submitBtn")
          .html('<i class="bi-check"></i> MAKE PAYMENT')
          .prop("disabled", false);
      },
    });
  } catch (error) {
    _actionAlert("An unexpected error occurred: " + error.message, false);
    $("#submitBtn")
      .html('<i class="bi-check"></i> MAKE PAYMENT')
      .prop("disabled", false);
  }
}

function _fetchPaymentHistory() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );
  try {
    const formData = {
      studentId: getEachStudentSession?.studentData?.studentId,
      branchId: getEachStudentSession?.branchData?.branchId,
      departmentId: getEachStudentSession?.departmentData?.departmentId,
      classId: getEachStudentSession?.classData?.classId,
      armId: getEachStudentSession?.armData?.armId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/fetch-payment-history`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function (info) {
        const fetch = info.data;
        const success = info.success;

        let text = "";
        let no = 0;
        text = `
				<thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Date</th>
                        <th>Payment ID</th>
                        <th>Term</th>
                        <th>Class</th>
                        <th>(₦)Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>`;

        if (success === true) {
          for (let i = 0; i < fetch.length; i++) {
            no++;
            const fetchedPayment = fetch[i];
            const paymentId = fetchedPayment.paymentId;
            const studentId = fetchedPayment.studentId;
            const branchId = fetchedPayment.branchId;
            const departmentId = fetchedPayment.departmentData.departmentId;
            const currentTerm = fetchedPayment.termData.currentTerm;
            const termId = fetchedPayment.termData.termId;
            const session = fetchedPayment.session;
            const className = fetchedPayment.classData.className;
            const classId = fetchedPayment.classData.classId;
            const armName = fetchedPayment.armData.armName;
            const armId = fetchedPayment.armData.armId;
            const totalAmount = thousandSeperator(fetchedPayment.totalAmount);
            const paymentMethodName =
              fetchedPayment.paymentMethodData.paymentMethodName;
            const statusName = fetchedPayment.statusData.statusName;
            const createdTime = fetchedPayment.createdTime;
            const paydate = fetchedPayment.paydate
              ? fetchedPayment.paydate
              : createdTime;

            text += `
						<tbody>
							<tr class="tb-row">
								<td>${no}</td>
								<td>${paydate}</td>
								<td><span onclick="_viewPaymentDetails('${session}','${termId}','${studentId}','${branchId}','${departmentId}','${classId}','${armId}');">${paymentId}</span></td>
								<td>
									<div class="text-div">
										<div>${session}</div> 
										<div>${currentTerm}</div>
									</div>
								</td>
								<td>
									<div class="text-div">
										<div>${className} ${armName}</div>
									</div>
								</td>
								<td><span><s>N</s>${totalAmount}</span></td>
								<td>${paymentMethodName}</td>
								<td>
									<div class="status-div ${statusName}">${statusName}</div>
								</td>
							</tr>
						</tbody>`;
          }
          $("#pageContent").html(text);
        } else {
          _actionAlert(info.message, false);
          text += `
						tbody>
							<tr>
								<td colspan="11">
									<div class="false-notification-div">
										<p>${info.message}</p>
									</div>
								</td>
							</tr>
						</tbody>`;
          $("#pageContent").html(text);
        }
      },
      error: function (textStatus, errorThrown) {
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _viewPaymentDetails(
  session,
  termId,
  studentId,
  branchId,
  departmentId,
  classId,
  armId,
) {
  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    const formData = {
      session: session,
      termId: termId,
      studentId: studentId,
      branchId: branchId,
      departmentId: departmentId,
      classId: classId,
      armId: armId,
    };

    $.ajax({
      type: "POST",
      url: `${endPoint}/parent/payment/view-payment-details`,
      data: JSON.stringify(formData),
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      processData: false,
      success: function (info) {
        if (info.success) {
          sessionStorage.setItem(
            "getPayFeesToPaySession",
            JSON.stringify(info),
          );
          _getForm({
            page: "paymentForm",
            layer: 2,
            url: parentPortalLocalUrl,
          });
        } else {
          _actionAlert(info.message, false);
          _alertClose(2);
        }
      },
      error: function (textStatus, errorThrown) {
        _alertClose(2);
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert("Check your internet connection and try again.", false);
      },
    });
  } catch (error) {
    _alertClose(2);
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

/////// Fetch Student Classes ///////
function _fetchStudentClasses() {
  _showLoader("Fetching available result classes, please wait...");
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );
  try {
    //// call endpoint //////
    _callFetchEndPoints({
      url: `parent/results/fetch-each-student-available-results?branchId=${getEachStudentSession?.branchData?.branchId}&studentId=${getEachStudentSession?.studentData?.studentId}`,
      accessKey: true,
    })
      .then((response) => {
        if (response.success && response.data?.length > 0) {
          _initFetchStudentClasses(response.data);
        } else {
          const staffContactForAccount = response?.staffContactForAccount;
          const studentData = response?.studentData;
          const accountWhatsappNumber = staffContactForAccount?.mobileNumber;
          const studentFullName = studentData?.fullName;

          _showCustomConfirm({
            title: "Unable To View Result",
            message: response.message,
            alertType: "error",
            falseActionBtn: true,
            trueActionBtnText: "WHATSAPP",
            falseActionBtnText: "CANCEL",
            trueActionCallback: () => {
              window.open("https://api.whatsapp.com/send?text=Hello, I am the parent of " + studentFullName + ". I would like to request access to view my child's academic result. Kindly assist me. Thank you.&phone=+234" + accountWhatsappNumber, "_blank");
            },
            closeOnOverlayClick: true,
          });

          $("#pageContent").html(`
					<div class="false-notification-div">
						<p>${response.message}</p>
					</div>
				`);
        }
        _hideLoader();
      })
      .catch((error) => {
        _hideLoader();
        console.error("Error:", error);
        _callAjaxError(() => _fetchStudentClasses()); // retry if needed
      });
  } catch (error) {
    _hideLoader();
    console.error("Error:", error);
    _callCatchError(() => _fetchStudentClasses());
  }
}

function _initFetchStudentClasses(data, start = 0) {
  const content = data
    .map((classes, index) => {
      const resultContent = classes.results
        .map(
          (resultItems) => `
      <div class="list-div">
        <h4>${resultItems.termName}</h4>
        <div class="btn-container">
          <button class="btn" title="VIEW RESULT" id="printStudentResultBtn_${classes.classId}_${resultItems.termId}"
            onclick="printStudentTerminalResult('${getEachStudentSession?.branchData?.branchId}', '${classes.session}', '${resultItems.termId}', '${classes.departmentId}', '${classes.classId}', '${resultItems.armId}', '${getEachStudentSession?.studentData?.studentId}');">
            <i class="bi-eye"></i> VIEW RESULT
          </button>
        </div>
      </div>
    `,
        )
        .join("");

      return `
      <div class="pages-toggle-div">
        <div class="pages-toggle-title" onclick="_collapse('view${start + index + 1}');" title="EXPAND TO VIEW ${classes.departmentName} (${classes.className}) RESULTS">
          <h3>${classes.departmentName} (${classes.className}) - ${classes.session}</h3>
          <div class="expand-div" id="view${start + index + 1}num">&nbsp;<i class="bi-plus"></i>&nbsp;</div> 
        </div>

        <div class="toggle-expand-div" id="view${start + index + 1}answer" style="display: none;">  
          <div class="list-back-div">
            ${resultContent}
          </div>
        </div>
      </div>
    `;
    })
    .join("");

  $("#pageContent").html(content);
}

/////// Fetch Student Result ///////
function printStudentTerminalResult(
  branchId,
  session,
  termId,
  departmentId,
  classId,
  armId,
  studentId,
) {
  try {
    ///// get btn text/////
    const btnText = $(`#printStudentResultBtn_${classId}_${termId}`).html();
    _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, true);

    //// call endpoint //////
    _callFetchEndPoints({
      url: `reports/print-each-student-terminal-result?branchId=${branchId}&session=${session}&termId=${termId}&departmentId=${departmentId}&classId=${classId}&armId=${armId}&studentId=${studentId}`,
      accessKey: true,
    })
      .then((response) => {
        if (response.success) {
          sessionStorage.setItem(
            "printEachStudentTerminalResultSession",
            JSON.stringify(response),
          );
          window.open(
            `${websiteUrl}/reports/print-each-student-terminal-result`,
            "_blank",
          );
        } else {
          _showCustomConfirm({
            title: "VIEW STUDENT RESULT",
            message: response.message,
            alertType: "warning",
            trueActionBtnText: "OK",
            closeOnOverlayClick: true,
          });
        }
        _btnDisable(
          `printStudentResultBtn_${classId}_${termId}`,
          btnText,
          false,
        );
      })
      .catch((error) => {
        console.error("Error:", error);
        _callAjaxError(() =>
          printStudentTerminalResult(
            branchId,
            session,
            termId,
            departmentId,
            classId,
            armId,
            studentId,
          ),
        ); // retry if needed
        _btnDisable(
          `printStudentResultBtn_${classId}_${termId}`,
          btnText,
          false,
        );
      });
  } catch (error) {
    console.error("Error:", error);
    _callCatchError(() =>
      printStudentTerminalResult(
        branchId,
        session,
        termId,
        departmentId,
        classId,
        armId,
        studentId,
      ),
    );
    _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, false);
  }
}
