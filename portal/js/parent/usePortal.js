function _getActiveStudentPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getStudentDetails',
    } = props;
	_getStudentPageActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer, url: parentPortalLocalUrl});
	}
}

function _getStudentPageActiveLink(divid){
	$('#studentDashbaord, #paymentHistory, #studentProfile').removeClass('active');
	$("#"+divid).addClass('active');
}

function capitalizeFirstLetterOfEachWord(inputText) {
	const words = inputText.toLowerCase().split(' ');
	for (let i = 0; i < words.length; i++) {
		words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
	}
	const result = words.join(' ');
	return result;
}


function getAuthHeaders() {
    return {
        'apiKey': apiKey,
        'userOsBrowser': userOsBrowser,
        'userIpAddress': userIpAddress,
        'userDeviceId': userDeviceId,
		'clientId': clientId,
		'clientAddress': clientAddress
    };
}

function _logOut(){
	sessionStorage.clear();
	window.parent.location.href = parentLoginUrl;
}

window.addEventListener("load", function () {
	const sessionData = sessionStorage.getItem("parentSessionData");
	if (!sessionData || sessionData === '""') {
		_logOut();
	}
});


function _getFetchEachStudent(Id) {
	let parentSessionData = JSON.parse(sessionStorage.getItem("parentSessionData"));
	let parentStudents = parentSessionData.students;
	let student = parentStudents.find(s => s.studentId === Id);
	if (student) {
		sessionStorage.setItem("getEachStudentSession", JSON.stringify(student));
		_getForm({page: 'studentProfileForm', url: parentPortalLocalUrl});
	}
}


function _toggleCheck(){
	$('.switch input').on('change', function () {
		const label = $(this).next().next(); // Grab the toggle-label span
		label.text($(this).prop('checked') ? 'Yes' : 'No');
	});
}

function _getPpaymentFormDetails(icon, nextId) {
	$('#proceedHideDiv').hide();
	$("#" + nextId).fadeIn(1000);
	$('#summaryHideDiv').fadeOut(500);
	$("#panel-title").html($("#" + icon).html() + ' <span>PAYMENT SUMMARY</span>');
}


function _prevPage(nextId) {
  $("#proceedHideDiv").hide();
  $("#" + nextId).fadeIn(1000);
  $("#panel-title").html('<i class="bi-plus-square"></i> </span> FEES PAYMENT');
}

function selectSearch() {
	$(".srch-select").toggle("fast");
}
function srchCustom(text){
	$('#srch-text').html(text);
	$('.custom-srch-div').fadeIn(500);
};


function _getSelectPaymentMethod(fieldId){
	try {
		$.ajax({
			type: "GET",
			url: endPoint +'/preset-data/fetch-payment-method',
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
						$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\');">'+ value +'</li>');
					}	
				} else {
					_actionAlert(info.message, false); 
				}
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred. Please try again.', false);
	}
}


function _fetchFeesToPay() {
    let getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {

		const formData = {
			"studentId": getEachStudentSession?.studentData?.studentId,
			"branchId": getEachStudentSession?.branchData?.branchId,
			"departmentId": getEachStudentSession?.departmentData?.departmentId,
			"classId": getEachStudentSession?.classData?.classId,
			"armId": getEachStudentSession?.armData?.armId
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
					sessionStorage.setItem("getPayFeesToPaySession", JSON.stringify(info));
					_getForm({page: 'paymentForm', layer: 2, url: parentPortalLocalUrl});
				} else {
					_actionAlert(info.message, false); 
					_alertClose(2);
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}



function _proceedToPayment() {
	let getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));
	let parentSessionData = JSON.parse(sessionStorage.getItem("parentSessionData"));
	
	try {
		const paymentMethodId = $('#paymentMethodId').val().trim();
		$('#paymentMethodId').removeClass("issue");

		let selectedFees = [];

		$('.child:checked').each(function() {
			const feesId = $(this).data('value');
			selectedFees.push({ feesId: feesId });
		});

		if (selectedFees.length === 0) {
			_actionAlert('Please select at least one fee to continue.', false);
			return;
		}

		if (!paymentMethodId) {
			$('#paymentMethodId').addClass('issue');
			_actionAlert('Select payment method to continue', false);
			return;
		} 

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="' + websiteUrl + '/images/loading.gif" width="12px" alt="Loading"/>');
			$("#submitBtn").prop("disabled", true);

			const formData = {
				"session": getEachStudentSession?.branchData?.currentSession,
				"termId": getEachStudentSession?.branchData?.termId,
				"studentId": getEachStudentSession?.studentData?.studentId,
				"branchId": getEachStudentSession?.branchData?.branchId,
				"departmentId": getEachStudentSession?.departmentData?.departmentId,
				"classId": getEachStudentSession?.classData?.classId,
				"armId": getEachStudentSession?.armData?.armId,
				feesIds: selectedFees,
				"paymentMethodId": paymentMethodId,
				"email": parentSessionData?.parentData?.email,
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
						sessionStorage.setItem("studentPaymentSession", JSON.stringify(data));
						const paymentKey= data.paymentKey;
						const paymentId= data.paymentId;
						const email = data.email;
						const amount = data.amount
						const paymentMethodId = data.paymentMethodId;

						if (paymentMethodId==='PM001'){/// PAYMENT BY CREDIT/DEBIT////
							_callPayStack(paymentKey, paymentId, email, amount);
						}
						if (paymentMethodId==='PM002'){/// PAYMENT BY BANK TRANSFER////
							_getForm({page: 'accountTransferForm', layer: 2, url: parentPortalLocalUrl});
						}
					} else {
						_actionAlert(data.message, false);
					}
					$("#submitBtn").html(btn_text).prop("disabled", false);
				},
				error: function (error) {
					_actionAlert('An error occurred while processing your request: ' + error, false);
					$("#submitBtn").html(btn_text).prop("disabled", false);
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		$("#submitBtn").prop("disabled", false);
	}
}



////// CALL PAYSTACK ////////////////
function _callPayStack(paymentKey, paymentId, email, amount) {
	let getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));
	let parentSessionData = JSON.parse(sessionStorage.getItem("parentSessionData"));
	const parentFullname= parentSessionData.parentData.titleId+' '+parentSessionData.parentData.surName+' '+parentSessionData.parentData.otherNames;
	const parentPhoneNumber= parentSessionData.parentData.mobileNumber;
	const branchId= getEachStudentSession.branchData.branchId;

	var handler = PaystackPop.setup({
		key: paymentKey,
		email: email,
		amount: amount, //amt in kobo
		ref: paymentId,
		currency: 'NGN', // Use GHS for Ghana Cedis or USD for US Dollars
		metadata: {
			custom_fields: [
				{
					display_name: parentFullname,
					variable_name: "mobile_number",
					value: parentPhoneNumber
				}
			]
		},
		callback: function () { //success
			$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}).html(`<div class="alert-loading-div"><div class="icon"><img src="${websiteUrl}/images/loading.gif" width="20px" alt="Loading"/></div><div class="text"><p>PROCESSING...</p></div></div>`).fadeIn(500);
			//var stack_pay_ref = $.trim(response.reference);
			_callPaymentSuccess(paymentId,branchId);
		},
		onClose: function () { //update to cancelled.
			_callPaymentCancelled(paymentId);
			return false;
		}
	});
	handler.openIframe();
}

function _callPaymentSuccess(paymentId,branchId) {
	try {
		const formData = {
			"paymentId": paymentId,
			"branchId": branchId,
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
					const secretKey= data.secretKey;
					const charges= data.charges;
					const paymentId= data.paymentId;
					const receiverKey= data.receiverKey;
					const reason= data.reason;
					if(charges>0){
						_transferToSchoolBolt(secretKey, charges, paymentId, receiverKey, reason);
					} else {
						_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
					}
				} else {
					console.log(data);
					_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
				}
			},
			error: function (error) {
				console.log(error);
				_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
			}
		});
		
	} catch (error) {
		console.log(error);
		_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
	}
}

function _callPaymentCancelled(paymentId) {
	try {
		const formData = {
			"paymentId": paymentId,
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
				$('#submitBtn').html('<i class="bi-check"></i> MAKE PAYMENT').prop("disabled", false);
			},
			error: function (error) {
				_actionAlert('An error occurred while processing your request: ' + error, false);
				$('#submitBtn').html('<i class="bi-check"></i> MAKE PAYMENT').prop("disabled", false);
			}
		});
		
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		$('#submitBtn').html('<i class="bi-check"></i> MAKE PAYMENT').prop("disabled", false);
	}
}

function _transferToSchoolBolt(secretKey, charges, paymentId, receiverKey, reason) {
	try {
		$.ajax({
			url: payStackTransferUrl,
			method: "POST",
			headers: {
				"Authorization": `Bearer ${secretKey}`,
				"Content-Type": "application/json"
			},
			data: JSON.stringify({
				source: "balance",
				amount: charges,
				reference: paymentId,
				recipient: receiverKey,
				reason: reason
			}),
			success: function(response) {
				console.log(response);
				_transferToSchoolBoltSuccess(paymentId);
			},
			error: function(xhr, status, error) {
    			console.error("Transfer failed:", status, error, xhr.responseText);
				_transferToSchoolBoltFailed(paymentId);
				_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
			}
		});
	} catch (error) {
		console.error("Transfer failed:", error);
		_transferToSchoolBoltFailed(paymentId);
		_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
	}	
}

function _transferToSchoolBoltSuccess(paymentId) {
	const formData = {
		"paymentId": paymentId,
	};
	
	$.ajax({
		type: "POST",
		url: `${endPoint}/parent/payment/transfer-to-schoolbolt-success`,
		data: JSON.stringify(formData),
		dataType: "json", 
		cache: false,
		headers: getAuthHeaders(),
		processData: false,
		success: function (data) {
			console.log(data);
			_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
		},
	});
}

function _transferToSchoolBoltFailed(paymentId) {
	const formData = {
		"paymentId": paymentId,
	};
	
	$.ajax({
		type: "POST",
		url: `${endPoint}/parent/payment/transfer-to-schoolbolt-failed`,
		data: JSON.stringify(formData),
		dataType: "json", 
		cache: false,
		headers: getAuthHeaders(),
		processData: false,
		success: function (data) {
			console.log(data);
			_getForm({page: 'payemntSuccessForm', layer: 2, url: parentPortalLocalUrl});
		},
	});
}




function _fetchPaymentHistory() {
   let getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));
	try {

		const formData = {
			"studentId": getEachStudentSession?.studentData?.studentId,
			"branchId": getEachStudentSession?.branchData?.branchId,
			"departmentId": getEachStudentSession?.departmentData?.departmentId,
			"classId": getEachStudentSession?.classData?.classId,
			"armId": getEachStudentSession?.armData?.armId
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

				let text = '';
				let no=0;
				text =`
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

				if (success===true) {
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
						const paymentMethodName = fetchedPayment.paymentMethodData.paymentMethodName;
						const statusName = fetchedPayment.statusData.statusName;
						const createdTime = fetchedPayment.createdTime;
						const paydate = fetchedPayment.paydate ? fetchedPayment.paydate : createdTime;

						text +=`
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
					$('#pageContent').html(text);
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
					$('#pageContent').html(text);

					const response = info.response;
					if (response < 100) {
						_logOut();
					}    
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}


function _viewPaymentDetails(session, termId, studentId, branchId, departmentId, classId, armId) {
	$("#get-more-div-secondary").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	try {

		const formData = {
			"session": session,
			"termId": termId,
			"studentId": studentId,
			"branchId": branchId,
			"departmentId": departmentId,
			"classId": classId,
			"armId": armId
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
					sessionStorage.setItem("getPayFeesToPaySession", JSON.stringify(info));
					_getForm({page: 'paymentForm', layer: 2, url: parentPortalLocalUrl});
				} else {
					_actionAlert(info.message, false); 
					_alertClose(2);
				}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while fetching data! Please try again.', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An unexpected error occurred! Please try again.', false);
	}
}




//declare callback function
function paymentCallback(response) {
    console.log(response);
}

//sample payment request

function _payWithInterswitch() {
	var samplePaymentRequest = {
		merchant_code: "MX248599",          
		pay_item_id: "student_Id",
		pay_item_name: "Student Name",
		cust_name: "John Doe",
		cust_email: "eamil@email.com",
		cust_mobile_no: "08012345678",
		txn_ref: "sample_txn_ref_1234",
		amount: 10000, 
		currency: 566,
		mode: 'TEST',
		access_token: true,
		onComplete: paymentCallback,
		site_redirect_url: window.location.origin,
	};
   window.webpayCheckout(samplePaymentRequest);
}
//call webpayCheckout to initiate the payment
