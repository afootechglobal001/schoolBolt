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

/// Check All Questions ////
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

/// Proceed Download Question Template ////
function _downloadQuestionTemplate(){
	try {
		////// confirm action////
		_showCustomConfirm({
		callback: () => {
			_processDownloadQuestionTemplateCallback();
		},
			title: "Are you sure?",
			message: 'Are you sure you want to download question template? This action is irreversible.',
			alertType: "warning",
			falseActionBtn: true,
			closeOnOverlayClick: true,
		});
	} catch (error) {
		console.error("Error:", error);
		_callCatchError(() => _downloadQuestionTemplate());
	}
}

/// Process Download Question Template ////
function _processDownloadQuestionTemplateCallback() {
    ///// get btn text/////
	const btnText = $("#downloadBtn").html();
    _btnDisable("downloadBtn", btnText, true);
    
    const url = websiteUrl + '/uploaded_files/cbt/question-template/template.csv';
    window.open(url, '_blank');

    _actionAlert("Question template downloaded successfully.", true);
    _btnDisable("downloadBtn", btnText, false);
}