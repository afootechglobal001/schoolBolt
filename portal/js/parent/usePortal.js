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


function _logOut(){
	sessionStorage.setItem("parentSessionData", JSON.stringify(''));
	window.parent.location.href = parentLoginUrl;
}

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

function _getFormDetails(icon, nextId) {
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
	const data=[
		{
			id: 1,
			value: 'DEBIT/CREDIT CARD',
		},
		{
			id: 2,
			value: 'BANK TRANSFER',
		}
	]

	for (let i = 0; i < data.length; i++) {
		const id = data[i].id;
		const value = data[i].value;
		$('#searchList_'+ fieldId).append('<li onclick="_clickOption(\'searchList_' + fieldId + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
	}	
}