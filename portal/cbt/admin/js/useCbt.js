function _getActiveCbtPagesTab(props) {
	const {
        page = '',
        divid = '',
		pageContainer='getCbtPagesDetails'
    } = props;
	_getActiveCbtPagesTabLink(divid);
	if(page){
		_getPage({page: page, pageContainer: pageContainer,  url: cbtAdminMiddleWareUrl});
	}
}
function _getActiveCbtPagesTabLink(divid){
	$('#questionBank, #quizQuestion, #loadQuestionManually, #loadQuestionAutomatically').removeClass('active-li');
	$("#"+divid).addClass('active-li');
}

function _checkAll(){
  $(document).ready(function() {
    $('#parent').on('change', function() {
        $('.child').prop('checked', this.checked);
    });
    $('.child').on('change', function() {
        $('#parent').prop('checked', $('.child:checked').length===$('.child').length);
    });
});
}