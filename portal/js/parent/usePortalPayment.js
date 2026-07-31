function _toggleCheck() {
  $(".switch input").on("change", function () {
    const label = $(this).next().next(); // Grab the toggle-label span
    label.text($(this).prop("checked") ? "Yes" : "No");
  });
}

function _fetchFeesToPay(studentId, branchId, departmentId, classId, armId) {
  $("#get-more-div-secondary")
    .css({
      display: "flex",
      "justify-content": "center",
      "align-items": "center",
    })
    .fadeIn(500);
  try {
    const formData = {
      studentId: studentId,
      branchId: branchId,
      departmentId: departmentId,
      classId: classId,
      armId: armId,
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

function _proceedToPayment() {
  let getEachStudentSession = JSON.parse(
    sessionStorage.getItem("getEachStudentSession"),
  );

   let getPayFeesToPaySession = JSON.parse(
    sessionStorage.getItem("getPayFeesToPaySession"),
  );

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
          '/images/loading.gif" width="12px" alt="Loading"/>',
      );
      $("#submitBtn").prop("disabled", true);

      const formData = {
        session: getPayFeesToPaySession?.currentSession,
        termId: getPayFeesToPaySession?.termData?.termId,
        studentId: getEachStudentSession?.studentData?.studentId,
        branchId: getEachStudentSession?.branchData?.branchId,
        departmentId: getEachStudentSession?.classData?.departmentId,
        classId: getEachStudentSession?.classData?.classId,
        armId: getEachStudentSession?.classData?.armId,
        feesIds: selectedFees,
        paymentMethodId: paymentMethodId,
        email: getEachStudentSession?.parentData?.email,
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
              JSON.stringify(data),
            );
            const paymentKey = data.paymentKey;
            const secretKey = data.secretKey;
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
            _actionAlert(data.message, false);
          }
          $("#submitBtn").html(btn_text).prop("disabled", false);
        },
        error: function (error) {
          _actionAlert(
            "An error occurred while processing your request: " + error,
            false,
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
  const parentFullname =
    getEachStudentSession.parentData.titleId +
    " " +
    getEachStudentSession.parentData.surName +
    " " +
    getEachStudentSession.parentData.otherNames;
  const parentPhoneNumber = getEachStudentSession.parentData.mobileNumber;
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
      _getTransactionDetailsFromPaystack(paymentId, secretKey, branchId, paystackId)
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
        _alertClose(2);
        _showCustomConfirm({
          title: "Payment Successful!",
          message:
            "Your payment was successful. Login to parent portal to view your payment history.",
          alertType: "success",
          trueActionBtnText: "OK",
          closeOnOverlayClick: true,
        });
      },
      error: function (error) {
        console.log(error);
        _showCustomConfirm({
          title: "Payment Successful!",
          message:
            "Your payment was successful. Login to parent portal to view your payment history.",
          alertType: "success",
          trueActionBtnText: "OK",
          closeOnOverlayClick: true,
        });
      },
    });
  } catch (error) {
    console.log(error);
    _showCustomConfirm({
      title: "Payment Successful!",
      message:
        "Your payment was successful. Login to parent portal to view your payment history.",
      alertType: "success",
      trueActionBtnText: "OK",
      closeOnOverlayClick: true,
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
