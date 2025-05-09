function _getActiveStudentPage(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getStudentDetails'
    } = props;
	_getStudentPageActiveLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: parentPortalLocalUrl});
	}
}
function _getStudentPageActiveLink(divid){
	$('#studentDashbaord').removeClass('active');
	$("#"+divid).addClass('active');
}