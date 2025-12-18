function _getActiveStudentPage(props) {
  const { page = "", divid = "", pageContainer = "getStudentDetails" } = props;
  _getStudentPageActiveLink(divid);
  if (page) {
    _getPage({
      page: page,
      pageContainer: pageContainer,
      url: parentPortalLocalUrl,
    });
  }
}

function _getStudentPageActiveLink(divid) {
  $("#studentDashbaord, #paymentHistory, #studentProfile, #studentResult").removeClass(
    "active"
  );
  $("#" + divid).addClass("active");
}

function capitalizeFirstLetterOfEachWord(inputText) {
  const words = inputText.toLowerCase().split(" ");
  for (let i = 0; i < words.length; i++) {
    words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
  }
  const result = words.join(" ");
  return result;
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
    $("#" + icon).html() + " <span>PAYMENT SUMMARY</span>"
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

function _getSelectPaymentMethod(fieldId) {
  try {
    $.ajax({
      type: "GET",
      url: endPoint + "/preset-data/fetch-payment-method",
      dataType: "json",
      cache: false,
      headers: getAuthHeaders(),
      success: function (info) {
        const data = info.data;
        const success = info.success;

        if (success === true) {
          for (let i = 0; i < data.length; i++) {
            const id = data[i].paymentMethodId;
            const value = data[i].paymentMethodName;
            $("#searchList_" + fieldId).append(
              "<li onclick=\"_clickOption('searchList_" +
                fieldId +
                "', '" +
                id +
                "', '" +
                value +
                "');\">" +
                value +
                "</li>"
            );
          }
        } else {
          _actionAlert(info.message, false);
        }
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred. Please try again.", false);
  }
}

function _fetchFeesToPay() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession")
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
        if (info.success && info.data.length > 0) {
          sessionStorage.setItem(
            "getPayFeesToPaySession",
            JSON.stringify(info)
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
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

function _proceedToPayment() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession")
  );
  let parentSessionData = JSON.parse(localStorage.getItem("parentSessionData"));

  try {
    const paymentMethodId = $("#paymentMethodId").val().trim();
    $("#paymentMethodId").removeClass("issue");

    let selectedFees = [];

    $(".child:checked").each(function () {
      const feesId = $(this).data("value");
      selectedFees.push({ feesId: feesId });
    });

    if (selectedFees.length === 0) {
      _actionAlert("Please select at least one fee to continue.", false);
      return;
    }

    if (!paymentMethodId) {
      $("#paymentMethodId").addClass("issue");
      _actionAlert("Select payment method to continue", false);
      return;
    }

    if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
      const btn_text = $("#submitBtn").html();
      $("#submitBtn").html(
        '<img src="' +
          websiteUrl +
          '/images/loading.gif" width="12px" alt="Loading"/>'
      );
      $("#submitBtn").prop("disabled", true);

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

      $.ajax({
        type: "POST",
        url: `${endPoint}/parent/payment/proceed-to-payment`,
        data: JSON.stringify(formData),
        dataType: "json",
        cache: false,
        headers: getAuthHeaders(),
        processData: false,
        success: function (data) {
          if (data.success) {
            sessionStorage.setItem(
              "studentPaymentSession",
              JSON.stringify(data)
            );
            const paymentKey = data.paymentKey;
            const paymentId = data.paymentId;
            const email = data.email;
            const amount = data.amount;
            //const paymentMethodId = data.paymentMethodId;
            const deductCharges = data.deductCharges;
            const schoolBoltCharges = data.schoolBoltCharges;
            const receiverKey = data.receiverKey;
            const paymentChannel = data.paymentChannel;

            _callPayStack(
              paymentKey,
              paymentId,
              email,
              amount,
              deductCharges,
              schoolBoltCharges,
              receiverKey,
              paymentChannel
            );

            //  if (paymentMethodId === "PM001") {
            //   /// PAYMENT BY CREDIT/DEBIT////
            //   _callPayStack(
            //     paymentKey,
            //     paymentId,
            //     email,
            //     amount,
            //     deductCharges,
            //     schoolBoltCharges,
            //     receiverKey
            //   );
            // }
            // if (paymentMethodId === "PM002") {
            //   /// PAYMENT BY BANK TRANSFER////
            //   _getForm({
            //     page: "accountTransferForm",
            //     layer: 2,
            //     url: parentPortalLocalUrl,
            //   });
            // }
          } else {
            _actionAlert(data.message, false);
          }
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert(
            "An error occurred while processing your request: " + error,
            false
          );
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
      });
    }
  } catch (error) {
    _actionAlert("An unexpected error occurred: " + error.message, false);
    $("#submitBtn").prop("disabled", false);
  }
}

////// CALL PAYSTACK ////////////////
function _callPayStack(
  paymentKey,
  paymentId,
  email,
  amount,
  deductCharges,
  schoolBoltCharges,
  receiverKey,
  paymentChannel
) {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession")
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
    callback: function () {
      $("#get-more-div-secondary")
        .css({
          display: "flex",
          "justify-content": "center",
          "align-items": "center",
        })
        .html(
          `<div class="alert-loading-div"><div class="icon"><img src="${websiteUrl}/images/loading.gif" width="20px" alt="Loading"/></div><div class="text"><p>PROCESSING...</p></div></div>`
        )
        .fadeIn(500);
      _callPaymentSuccess(paymentId, branchId);
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

function _callPaymentSuccess(paymentId, branchId) {
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
          _getForm({
            page: "payemntSuccessForm",
            layer: 2,
            url: parentPortalLocalUrl,
          });
        } else {
          console.log(data);
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
          false
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
    sessionStorage.getItem("getEachStudentSession")
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
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
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
  armId
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
        if (info.success && info.data.length > 0) {
          sessionStorage.setItem(
            "getPayFeesToPaySession",
            JSON.stringify(info)
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
        console.error("AJAX Error: ", textStatus, errorThrown);
        _actionAlert(
          "Check your internet connection and try again.",
          false
        );
      },
    });
  } catch (error) {
    console.error("Error: ", error);
    _actionAlert("An unexpected error occurred! Please try again.", false);
  }
}

/////// Fetch Student Classes ///////
function _fetchStudentClasses() {
  _showLoader('Fetching available result classes, please wait...');
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession")
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
				_showCustomConfirm({
					title: "FETCH RESULT",
					message: response.message,
					alertType: "warning",
					trueActionBtnText: "OK",
          closeOnOverlayClick: true,
				});

				$('#pageContent').html(`
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
  const content = data.map((classes, index) => {
    const resultContent = classes.results.map((resultItems) => `
      <div class="list-div">
        <h4>${resultItems.termName}</h4>
        <div class="btn-container">
          <button class="btn" title="VIEW RESULT" id="printStudentResultBtn_${classes.classId}_${resultItems.termId}"
            onclick="printStudentTerminalResult('${getEachStudentSession?.branchData?.branchId}', '${classes.session}', '${resultItems.termId}', '${classes.departmentId}', '${classes.classId}', '${resultItems.armId}', '${getEachStudentSession?.studentData?.studentId}');">
            <i class="bi-eye"></i> VIEW RESULT
          </button>
        </div>
      </div>
    `).join("");

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
  }).join("");

  $('#pageContent').html(content);
}

/////// Fetch Student Result ///////
function printStudentTerminalResult(branchId, session, termId, departmentId, classId, armId, studentId) {
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
        sessionStorage.setItem("printEachStudentTerminalResultSession", JSON.stringify(response));
				window.open(`${websiteUrl}/reports/print-each-student-terminal-result`, '_blank');
			} else {
				_showCustomConfirm({
					title: "VIEW STUDENT RESULT",
					message: response.message,
					alertType: "warning",
					trueActionBtnText: "OK",
          closeOnOverlayClick: true,
				});
			}
      _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, false);
		 })
		.catch((error) => {
			console.error("Error:", error);
			_callAjaxError(() => printStudentTerminalResult(branchId, session, termId, departmentId, classId, armId, studentId)); // retry if needed
      _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, false);
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => printStudentTerminalResult(branchId, session, termId, departmentId, classId, armId, studentId));
    _btnDisable(`printStudentResultBtn_${classId}_${termId}`, btnText, false);
  }
}