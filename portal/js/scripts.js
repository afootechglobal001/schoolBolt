function _call_carousel(cnt) {
	// INIT CAROUSEL
	window["carousel_" + cnt] = new CgCarousel(
	  "#js-carousel_" + cnt,
	  window["carousel_options_" + cnt],
	  {}
	);
	// Navigation
	window["next_" + cnt] = document.getElementById("js-carousel__next_" + cnt);
	window["next_" + cnt].addEventListener("click", () =>
	  window["carousel_" + cnt].next()
	);
	window["prev_" + cnt] = document.getElementById("js-carousel__prev_" + cnt);
	window["prev_" + cnt].addEventListener("click", () =>
	  window["carousel_" + cnt].prev()
	);
}

$(window).scroll(function () {
	const scrollHeight = $(window).scrollTop();
	const windowWidth = $(window).width();
  
	if (scrollHeight >= 100) {
		$("#back2Top").fadeIn(1000);
	} else {
		$("#back2Top").fadeOut(1000);
	}
  
	if (scrollHeight >= 400) {
		$("header").addClass("scrolled");
	} else {
		$("header").removeClass("scrolled");
	}

	if (windowWidth <= 870) {
		$(".sticky-div").css({
			"position": "relative",
			"top": "0",
			"height": "auto", 
			"overflow": "visible" 
		});
	} else {
		if (scrollHeight >= 700) {
			$(".sticky-div").css({
				"position": "sticky",
				"top": "140px",
				"min-height": "280px",
				"overflow": "auto" 
			});
		} else {
			$(".sticky-div").css({
				"position": "relative",
				"top": "0",
				"height": "auto",
				"overflow": "auto" 
			});
		}
	}
});
  
function _back_to_top(){
	event.preventDefault();
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}

function _open_menu(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	$('.live-chat-back-div').animate({'margin-left':'-100%'},400);
	$('.index-menu-back-div').animate({'margin-left':'0'},400);
}

function _open_live_chat(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	$('.index-menu-back-div').animate({'margin-left':'-100%'},400);
	$('.live-chat-back-div').animate({'margin-left':'0'},400);
}

function _close_side_nav(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'-100%'},200);
	$('.index-menu-back-div,.live-chat-back-div').animate({'margin-left':'-100%'},400);
}

function _open_li(ids){
	$('#'+ids+'-sub-li').toggle('slow');
}

function alert_close(){
	$('#get-more-div').html('').fadeOut(200);
}

function _actionAlert(message,status){
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


///// for FAQs
function _collapse(div_id) {
    const $currentFaq = $('#' + div_id);
    const $currentIcon = $('#' + div_id + 'num');
    const $currentAnswer = $('#' + div_id + 'answer');

    $('.faq-toggle.active-faq').each(function () {
        if (this.id !== div_id) {
            $(this).removeClass('active-faq');
            $(this).find('.expand-div').html('&nbsp;<i class="bi-plus"></i>&nbsp;');
            $(this).find('.answer-div').slideUp('slow');
        }
    });

    const isActive = $currentFaq.toggleClass('active-faq').hasClass('active-faq');
    $currentIcon.html(isActive ? '&nbsp;<i class="bi-dash"></i>&nbsp;' : '&nbsp;<i class="bi-plus"></i>&nbsp;');
    $currentAnswer.slideToggle('slow');
}




function isNumber_Check(textID) {
	var e = window.event;
	var key = e.keyCode && e.which;
  
	if (!((key >= 48 && key <= 57) || key == 43 || key == 45)) {
	  if (e.preventDefault) {
		e.preventDefault();
		$('#'+textID).val('');
	  } else {
		e.returnValue = false;
	  }
	} else {
		$('#'+textID).val('');
	}
  
}

function _view_preview_img(divid) {
	const view_pix = $("#" + divid).html();
	$("#blog_preview").html(view_pix).fadeIn(3000);
}

function _selectOption(selectBoxId) {
	$('#txtSearchValue_'+selectBoxId).val('');
	filter(selectBoxId);

    if ($('#searchPanel_'+selectBoxId).is(":visible")) {
        $('#searchPanel_'+selectBoxId).css('display', 'none');
    } else {
        $('#searchPanel_'+selectBoxId).css('display', 'flex');
        $('#txtSearchValue_'+selectBoxId).focus();
    }
}
document.addEventListener('click', (e) => {
	const selectContainer = document.querySelector('#selectContainer');
	const searchPanel = document.querySelector('.searchPanel');
	if (!selectContainer.contains(e.target)) {
	  searchPanel.style.display = 'none';
	}
});
function filter(selectBoxId) {
	var valThis = $('#txtSearchValue_'+selectBoxId).val();
	$('#searchList_'+selectBoxId+' > li').each(function() {
		var text = $(this).text();
		(text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? $(this).show(): $(this).hide();
	});
};
function _clickOption(selectedOption, id, value) {
	selectBoxId = selectedOption.replace("searchList_", "");
	// Clear previous options and set the selected one
	$('#'+selectBoxId).html(`<option selected="selected" value="${id}">${value}</option>`);
	_selectOption(selectBoxId);
};
    


function textField(id, title, type = "text") {
    const template = type === "textarea"
        ? `
          <textarea class="text_area" id="${id}" placeholder=" " rows="2"></textarea>
          <div class="placeholder">${title}:</div>
        `
        : `
          <input class="text_field" type="${type}" id="${id}" placeholder=""/>
          <div class="placeholder">${title}:</div>
        `;
    $('#' + id + '_container').html(template);
}


function _get_parent_type(select_id,parent_type_id){
	var dataString = "parent_type_id=" + parent_type_id;
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/parent-type',
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
		},
		success: function(info){
			var success = info.success;
			var message = info.message;
			var fetch = info.data;
  
			if (success == true) {
				for (var i = 0; i < fetch.length; i++) {
				  var id = fetch[i].parent_type_id;
				  var value = fetch[i].parent_type_name;
				  $('#'+ select_id).append('<li onclick="_clickOption(\'' + select_id + '\', \'' + id + '\', \'' + value + '\')">'+ value +'</li>');
				}
			}else{
				_actionAlert(message,false);
		  	}
		}, 
	});
}

  

function _get_form(page) {
	$("#get-form-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	var action = "get_form";
	var dataString = "action=" + action + "&page=" + page;

	$.ajax({
		type: "POST",
		url: index_local_url,
		data: dataString,
		cache: false,
		success: function (html) {
			$("#get-form-more-div").html(html);
		},
	});
}
  
  
function _get_form_with_id(page, ids) {
	$("#get-more-div").css('display', 'flex').fadeIn(500);
	var action = "get_form_with_id";
	var dataString = "action=" + action + "&page=" + page + "&ids=" + ids;

	$.ajax({
		type: "POST",
		url: index_local_url,
		data: dataString,
		cache: false,
		success: function (html) {
			$("#get-more-div").html(html);
		},
	});
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function _get_active_contact_link(text) {
	$('#next-lagos, #next-ogun, #next-oyo').removeClass('active');
	$('#next-'+text).addClass('active');
}

function _next_contact_page(next_id,text) {
	_get_active_contact_link(text);
	$("#lagos-hide-div, #ogun-hide-div, #oyo-hide-div").hide();
	$("#" + next_id).fadeIn(1000);
}


function _getActiveNextModulePage(text) {
	$('#next-admin, #next-staff, #next-student, #next-bursary, #next-parents').removeClass('active');
	$('#next-'+text).addClass('active');
}


function _nextModulePage(next_id,text) {
	_getActiveNextModulePage(text);
	$("#admin-hide-div, #staff-hide-div, #student-hide-div, #bursary-hide-div, #parents-hide-div").hide();
	$("#" + next_id).fadeIn(1000);
}

function _setupShowMore(containerSelector, buttonId, maxItems) {
    const $container = $(containerSelector);
    const $items = $container.children(); // This will correctly refer to <a> elements
    const $button = $('#' + buttonId);

    // Initially hide all items above maxItems
    $items.each(function(index) {
        $(this).css('display', index < maxItems ? '' : 'none');
    });

    $button.on('click', function() {
        const isShowingMore = $button.text().trim() === 'See More Features';
        $button.text(isShowingMore ? 'Show Less' : 'See More Features');

        $items.each(function(index) {
            $(this).css('display', isShowingMore && index >= maxItems ? '' : (index < maxItems ? '' : 'none'));
        });
    });
}

$(document).ready(function() {
    _setupShowMore('.features-back-div', 'toggleFeaturesButton', 6);
});
