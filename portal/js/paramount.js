function _getPage(options) {
	const {
        page = '',
		action='get_page',
		url='',
		pageContainer='page-content',
		id=''
    } = options;

		$("#"+pageContainer).html('<div class="ajax-loader"><img src="'+ websiteUrl +'/images/spinner.gif"/></div>').css({'display': 'flex','flex-direction': 'column','gap': '20px','align-items': 'center','align-items': 'center'}).fadeIn(500);
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
        layer = 1,
        action = 'get_form',
        url = ''
    } = options;

    const target = layer === 1 ? '#get-form-more-div' : layer === 2  ? '#get-more-div-secondary' : '#get-more-third-layer';
    $(target).css({ 'display': 'flex', 'justify-content': 'center', 'align-items': 'center' }).fadeIn(500);
    const dataString = "action=" + action + "&page=" + page + "&id=" + id + "&modalLayer=" + layer;

    $.ajax({
        type: "POST",
        url: url,
        data: dataString,
        cache: false,
        success: function (html) {
            $(target).html(html);
        },
    });
}

function _alertClose(layer=1){
	let text = '';
	  text +=
	  '<div class="alert-loading-div">' +
		'<div class="icon"><img src="'+ websiteUrl +'/images/loading.gif" width="20px" alt="Loading"/></div>' +
		'<div class="text"><p>LOADING...</p></div>'+
		'</div>';
			$(layer === 1 ? '#get-form-more-div' : layer === 2  ? '#get-more-div-secondary' : '#get-more-third-layer').html(text).fadeOut(200);
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

function thousandSeperator(val) {
	let dp=2;
  const formatter = new Intl.NumberFormat('ng-NG', {
    style: 'decimal',
    maximumFractionDigits: dp,
    minimumFractionDigits: dp,
  });
  //   return formatter.format(val);
  return isNaN(parseFloat(formatter.format(val))) ? '-' : formatter.format(val);
};


function _showCustomConfirm(options) {
  const {
    callback = () => {},
    alertType = "info",
    title = "Are you sure?",
    message = "This action can't be undone. Please confirm if you want to proceed.",
    trueActionBtnText = "YES",
    falseActionBtn = false,
    falseActionBtnText = "NO",
    trueActionCallback = () => {},
    falseActionCallback = () => {},
  } = options;

  // Show modal
  $("#customConfirmModal").html("").fadeIn(200);
  let icon = "bi-info-circle-fill";
  let iconBg = "bg-info";

  if (alertType === "success") {
    icon = "bi-check-circle-fill";
    iconBg = "bg-success";
  } else if (alertType === "error") {
    icon = "bi-x-circle-fill";
    iconBg = "bg-danger";
  } else if (alertType === "warning") {
    icon = "bi-exclamation-octagon-fill";
    iconBg = "bg-warning";
  }

  const content = `
		<div class="modal-box">
			<div class="modal-icon ${iconBg}">
				<i class="bi ${icon}"></i>
			</div>
			<h3>${title}</h3>
			<p>${message}</p>
			<div class="btn-div">
				${
          falseActionBtn
            ? `<button id="confirmCancelBtn" class="btn false-btn">${falseActionBtnText}</button>`
            : ""
        }
				<button id="confirmOkBtn" class="btn">${trueActionBtnText}</button>
			</div>
		</div>
	`;
  $("#customConfirmModal").html(content);
  // Attach button events
  $("#confirmOkBtn")
    .off("click")
    .on("click", function () {
      callback();
      _modalClose();
      trueActionCallback();
    });
  if (falseActionBtn) {
    $("#confirmCancelBtn")
      .off("click")
      .on("click", function () {
        _modalClose();
        falseActionCallback();
      });
  }
  // If mouse enters modal, clear and hide it
  $("#customConfirmModal")
    .off("click")
    .on("click", function (e) {
      if (e.target === this) {
        // ensures click is only on the modal, not children
        $(this).html("").fadeOut(200);
      }
    });
}
function _modalClose() {
  $("#customConfirmModal").html("").fadeOut(200);
}