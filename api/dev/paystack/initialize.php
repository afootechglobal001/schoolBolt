<?php
header("Content-Type: application/json");

// 🔑 Replace with your keys
$paystack_secret_key = "******"; // needed for server-side
$paystack_public_key = "*******"; // needed for popup

// Get raw POST data
$input = json_decode(file_get_contents("php://input"), true);

$reference         = $input['reference'];
$email             = $input['email'];
$amount            = $input['amount']; // in kobo
$currency          = $input['currency'] ?? "NGN";
$deductCharges     = $input['deductCharges'];
$schoolBoltCharges = $input['schoolBoltCharges'];
$receiverKey       = $input['receiverKey'];
$channels          = $input['channels'] ?? ["card", "bank_transfer"]; //  default if none passed
$metadata          = $input['metadata'] ?? [];


$fields = [
    'reference' => $reference,
    'email'     => $email,
    'amount'    => $amount,
    'currency'  => $currency,
    'metadata'  => $metadata,
    'channels'  => $channels,
];

// If deductCharges is true, add split config
if ($deductCharges) {
    $fields['split'] = [
        "type" => "flat",
        "bearer_type" => "account",
        "subaccounts" => [
            [
                "subaccount" => $receiverKey,
                "share"      => $schoolBoltCharges // e.g. 50000 = ₦500
            ]
        ]
    ];
}

// cURL to Paystack initialize API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transaction/initialize");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $paystack_secret_key",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode([
        "status" => false,
        "message" => "cURL Error: " . curl_error($ch)
    ]);
    exit;
}
curl_close($ch);

$data = json_decode($response, true);

// Attach your public key so frontend can use popup
if ($data && $data['status']) {
    $data['data']['public_key'] = $paystack_public_key;
}

echo json_encode($data);
?>



<script>
function _getActiveStudentPage(props) {
    const {
        page = "", divid = "", pageContainer = "getStudentDetails"
    } = props;
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
    $("#studentDashbaord, #paymentHistory, #studentProfile").removeClass(
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
    sessionStorage.clear();
    window.parent.location.href = parentLoginUrl;
}

window.addEventListener("load", function() {
    const sessionData = sessionStorage.getItem("parentSessionData");
    if (!sessionData || sessionData === '""') {
        _logOut();
    }
});

function _getFetchEachStudent(Id) {
    let parentSessionData = JSON.parse(
        sessionStorage.getItem("parentSessionData")
    );
    let parentStudents = parentSessionData.students;
    let student = parentStudents.find((s) => s.studentId === Id);
    if (student) {
        sessionStorage.setItem("getEachStudentSession", JSON.stringify(student));
        _getForm({
            page: "studentProfileForm",
            url: parentPortalLocalUrl
        });
    }
}

function _toggleCheck() {
    $(".switch input").on("change", function() {
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

function _getSelectPaymentMethod(fieldId) {
    try {
        $.ajax({
            type: "GET",
            url: endPoint + "/preset-data/fetch-payment-method",
            dataType: "json",
            cache: false,
            headers: getAuthHeaders(),
            success: function(info) {
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
            success: function(info) {
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
            error: function(textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
                _actionAlert(
                    "An error occurred while fetching data! Please try again.",
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
    let parentSessionData = JSON.parse(
        sessionStorage.getItem("parentSessionData")
    );

    try {
        const paymentMethodId = $("#paymentMethodId").val().trim();
        $("#paymentMethodId").removeClass("issue");

        let selectedFees = [];

        $(".child:checked").each(function() {
            const feesId = $(this).data("value");
            selectedFees.push({
                feesId: feesId
            });
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
                success: function(data) {
                    if (data.success) {
                        sessionStorage.setItem(
                            "studentPaymentSession",
                            JSON.stringify(data)
                        );
                        const paymentKey = data.paymentKey;
                        const paymentId = data.paymentId;
                        const email = data.email;
                        const amount = data.amount;
                        const paymentMethodId = data.paymentMethodId;
                        const deductCharges = data.deductCharges;
                        const schoolBoltCharges = data.schoolBoltCharges;
                        const receiverKey = data.receiverKey;

                        if (paymentMethodId === "PM001") {
                            /// PAYMENT BY CREDIT/DEBIT////
                            _callPayStack(
                                //paymentKey,
                                paymentId,
                                email,
                                amount,
                                deductCharges,
                                schoolBoltCharges,
                                receiverKey
                            );
                        }
                        if (paymentMethodId === "PM002") {
                            /// PAYMENT BY BANK TRANSFER////
                            _getForm({
                                page: "accountTransferForm",
                                layer: 2,
                                url: parentPortalLocalUrl,
                            });
                        }
                    } else {
                        _actionAlert(data.message, false);
                    }
                    $("#submitBtn").html(btn_text).prop("disabled", false);
                },
                error: function(error) {
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
    paymentId,
    email,
    amount,
    deductCharges,
    schoolBoltCharges,
    receiverKey
) {
    let getEachStudentSession = JSON.parse(
        sessionStorage.getItem("getEachStudentSession")
    );
    let parentSessionData = JSON.parse(
        sessionStorage.getItem("parentSessionData")
    );

    const parentFullname =
        parentSessionData.parentData.titleId +
        " " +
        parentSessionData.parentData.surName +
        " " +
        parentSessionData.parentData.otherNames;
    const parentPhoneNumber = parentSessionData.parentData.mobileNumber;
    const branchId = getEachStudentSession.branchData.branchId;

    $.ajax({
        url: `${endPoint}/paystack/initialize`,
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            reference: paymentId,
            email: email,
            amount: amount, // in kobo
            currency: "NGN",
            deductCharges,
            schoolBoltCharges,
            receiverKey,
            channels: ["card", "bank_transfer"], // 👈 restrict channels here
            metadata: {
                parentFullname,
                parentPhoneNumber,
                branchId,
            },
        }),
        success: function(data) {
            if (data.status && data.data.access_code) {
                // 👉 Open Paystack popup modal
                var handler = PaystackPop.setup({
                    key: data.data.public_key, // from backend
                    email: email,
                    amount: amount,
                    ref: paymentId,
                    currency: "NGN",
                    access_code: data.data.access_code,
                    callback: function(response) {
                        // Payment complete - verify on backend
                        $("#get-more-div-secondary")
                            .css({
                                display: "flex",
                                "justify-content": "center",
                                "align-items": "center",
                            })
                            .html(
                                `<div class="alert-loading-div">
                   <div class="icon"><img src="${websiteUrl}/images/loading.gif" width="20px" alt="Loading"/></div>
                   <div class="text"><p>PROCESSING...</p></div>
                 </div>`
                            )
                            .fadeIn(500);

                        _callPaymentSuccess(paymentId, branchId);
                    },
                    onClose: function() {
                        _callPaymentCancelled(paymentId);
                        return false;
                    },
                });

                handler.openIframe();
            } else {
                alert("Failed: " + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert("An error occurred while initializing payment.");
        },
    });
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
            success: function(data) {
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
            error: function(error) {
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
            success: function() {
                $("#submitBtn")
                    .html('<i class="bi-check"></i> MAKE PAYMENT')
                    .prop("disabled", false);
            },
            error: function(error) {
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
            success: function(info) {
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
                        const paydate = fetchedPayment.paydate ?
                            fetchedPayment.paydate :
                            createdTime;

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

                    const response = info.response;
                    if (response < 100) {
                        _logOut();
                    }
                }
            },
            error: function(textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
                _actionAlert(
                    "An error occurred while fetching data! Please try again.",
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
            success: function(info) {
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
            error: function(textStatus, errorThrown) {
                console.error("AJAX Error: ", textStatus, errorThrown);
                _actionAlert(
                    "An error occurred while fetching data! Please try again.",
                    false
                );
            },
        });
    } catch (error) {
        console.error("Error: ", error);
        _actionAlert("An unexpected error occurred! Please try again.", false);
    }
}
</script>