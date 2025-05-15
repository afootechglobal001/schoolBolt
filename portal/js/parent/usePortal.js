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
	sessionStorage.setItem("parentSessionData", JSON.stringify(''));
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
