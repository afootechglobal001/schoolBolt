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
	$('#studentDashbaord').removeClass('active');
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
	window.parent.location.href = "../";
}

function _getFetchEachStudent(Id) {
	let parentSessionData = JSON.parse(sessionStorage.getItem("parentSessionData"));
	let parentStudents = parentSessionData.students;
	let student = parentStudents.find(s => s.studentId === Id);
	if (student) {
		sessionStorage.setItem("getEachStudentSession", JSON.stringify(student));
		_getForm({page: 'studentProfile', url: parentPortalLocalUrl});
	}
}