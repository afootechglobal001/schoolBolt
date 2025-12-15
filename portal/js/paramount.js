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
    closeOnOverlayClick = false,
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

  $("#customConfirmModal").off("click");

if (closeOnOverlayClick) {
  $("#customConfirmModal").on("click", function (e) {
    if (e.target === this) {
      _modalClose();
    }
  });
}
}
function _modalClose() {
  $("#customConfirmModal").html("").fadeOut(200);
}

function _validateEmptyValue(fieldId, fieldName) {
  const fieldValue = $("#" + fieldId)
    .val()
    .trim();
  $("#" + fieldId).removeClass("issue");
  $("#issue_" + fieldId).html("");

  if (!fieldValue) {
    $("#" + fieldId).addClass("issue");
    $("#issue_" + fieldId).html(fieldName + " IS REQUIRED");
    return 1;
  }
  return 0;
}
function _validateEmail(fieldId, email) {
  if (!email) return 0;
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
    $("#" + fieldId).addClass("issue");
    $("#issue_" + fieldId).html("PROVIDE A VALID EMAIL ADDRESS");
    return 1;
  }
  return 0;
}
function _validateNumber(fieldId, number) {
  if (!number) return 0;
  // Allow integer or decimal numbers (e.g. 123, 123.45, .5)
  if (!/^\d+(\.\d+)?$/.test(number)) {
    $("#" + fieldId).addClass("issue");
    $("#issue_" + fieldId).html(
      "NUMBER MUST CONTAIN ONLY DIGITS OR DECIMAL POINT"
    );
    return 1;
  }
  return 0;
}

function getAuthHeaders(includeAuth = false) {
  return {
    apiKey: apiKey,
    userOsBrowser: userOsBrowser,
    userIpAddress: userIpAddress,
    userDeviceId: userDeviceId,
    clientId: clientId,
    clientAddress: clientAddress,
    Authorization: includeAuth ? "Bearer " + (loginAccessKey ?? "") : undefined,
  };
}

function _callRawEndPoints(payLoadProps) {
  const {
    type = "POST",
    url = "",
    formData = null,
    accessKey = false,
  } = payLoadProps;
  // Auto-flatten if formData has only one key called "formData"
  const payload = formData && formData.formData ? formData.formData : formData;
  return new Promise((resolve, reject) => {
    $.ajax({
      type: type,
      url: `${endPoint}/${url}`,
      data: JSON.stringify(payload),
      dataType: "json",
      contentType: "application/json", // important for JSON
      cache: false,
      headers: getAuthHeaders(accessKey),
      success: function (data) {
        resolve(data); // ✅ resolve promise
      },
      error: function (error) {
        reject(error); // ✅ reject promise
      },
    });
  });
}

function _callFileEndPoints(payLoadProps) {
  const {
    type = "POST",
    url = "",
    formData = null,
    accessKey = false,
    expectJson = true, // default true
  } = payLoadProps;

  // const payload = formData && formData.formData ? formData.formData : formData;
  const finalUrl = url.startsWith("http") ? url : `${endPoint}/${url}`;

  return new Promise((resolve, reject) => {
    $.ajax({
      type: type,
      url: finalUrl,
      data: formData,
      dataType: expectJson ? "json" : undefined, // only parse if JSON expected
      contentType: false,
      cache: false,
      processData: false,
      headers: getAuthHeaders(accessKey),
      success: function (data) {
        resolve(data);
      },
      error: function (error) {
        reject(error);
      },
    });
  });
}

function _callFetchEndPoints(payLoadProps) {
  const { type = "GET", url = "", accessKey = false } = payLoadProps;
  return new Promise((resolve, reject) => {
    const finalUrl = url.startsWith("http") ? url : `${endPoint}/${url}`;

    $.ajax({
      type: type,
      url: finalUrl,
      dataType: url.startsWith("http") ? undefined : "json",
      cache: false,
      headers: getAuthHeaders(accessKey),
      success: function (data) {
        resolve(data);
      },
      error: function (error) {
        reject(error);
      },
    });
  });
}

function _callAjaxError(callback) {
  _showCustomConfirm({
    callback: () => {
      callback();
    },
    title: "Connection Error!",
    message: "Check your internet connection and try again.",
    alertType: "error",
    trueActionBtnText: "OK",
    closeOnOverlayClick: true,
  });
}
function _callCatchError(callback) {
  _showCustomConfirm({
    callback: () => {
      callback();
    },
    title: "Unexpected Error",
    message: "An unexpected error occurred! Please try again.",
    alertType: "error",
    trueActionBtnText: "OK, Retry",
    closeOnOverlayClick: true,
  });
}

function _btnDisable(btnId, btnText = "SUBMIT", action = true) {
  //////////////// get btn text ////////////////
  if (action) {
    $("#" + btnId).html('<img src="' + websiteUrl + '/images/loading.gif" style="width:12px;" alt="Loading"/>'
    );
    $("#" + btnId).prop("disabled", action);
  } else {
    $("#" + btnId)
      .html(btnText)
      .prop("disabled", false);
  }
  ////////////////////////////////////////////////
}


 ////////////////////////////////////////////////
function _showLoader(message = 'Processing, please wait...') {
  $('#globalLoaderText').html(message);
  $('#globalLoader').fadeIn(150);
}

function _hideLoader() {
  $('#globalLoader').fadeOut(150);
}
