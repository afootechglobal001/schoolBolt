function _getPage(options) {
	const {
        page = '',
		action='get_page',
		url='',
		pageContainer='page-content'
    } = options;

		$("#"+pageContainer).html('<div class="ajax-loader"><img src="'+ websiteUrl +'/all-images/images/spinner.gif"/></div>').css({'display': 'flex','flex-direction': 'column','gap': '20px','align-items': 'center','align-items': 'center'}).fadeIn(500);
		const dataString = "action=" + action + "&page=" + page;
		$.ajax({
			type: "POST",
			url: url,
			data: dataString,
			cache: false,
			success: function (html) {
				$("#"+pageContainer).html(html);
			},
		});
}

function _getForm(options) {
	const {
        page = '',
        id = '',
		layer=1,
		action='get_form',
		url=''
    } = options;
$(layer===1 ? '#get-form-more-div':'#get-more-div-secondary').css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
const dataString = "action=" + action + "&page=" + page + "&id=" + id + "&modalLayer=" + layer;
	$.ajax({
		type: "POST",
		url: url,
		data: dataString,
		cache: false,
		success: function (html) {
			$(layer===1 ? '#get-form-more-div':'#get-more-div-secondary').html(html);
		},
	});
}
function _alertClose(layer=1){
	let text = '';
	  text +=
	  '<div class="alert-loading-div">' +
		'<div class="icon"><img src="'+ websiteUrl +'/all-images/images/loading.gif" width="20px" alt="Loading"/></div>' +
		'<div class="text"><p>LOADING...</p></div>'+
		'</div>';
			$(layer===1 ? '#get-form-more-div':'#get-more-div-secondary').html(text).fadeOut(200);
}

function _actionAlert(message,status ){
	let text = '';
	$('.all-alert-back-div').html(text).css('display', 'flex');
	if(status==true){
		text +=
		'<div class="success-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-check-all"></i></div>'+
			'<div class="text"><p>'+message+'</p></div>'+
		'</div>';
	}else{
		text +=
		'<div class="failed-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-exclamation-octagon-fill"></i></div>'+
			'<div class="text"><p>'+message+'</p></div>'+
		'</div>';
	}
	$('.all-alert-back-div').html(text).fadeIn(500).delay(3000).fadeOut(100);
}

function isNumberCheck(e) {
    var key = e.keyCode || e.which;

    if (!((key >= 48 && key <= 57))) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
    }
}