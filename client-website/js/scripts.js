$(document).ready(function(){
	let page_session = JSON.parse(sessionStorage.getItem("page_session"));
	if (page_session==null){
	  _get_page_session_value('');
	}
  });
  
  
  
  function _get_page_session_value(reload) {
	$.ajax({
		  type: "POST",
		  url: endPoint + '/site/session/get-page-session',
		  dataType: "json",
		  cache: false,
		  headers: {
			  'apiKey': apiKey
	          },
	  success: function (info) {
		sessionStorage.setItem("page_session", JSON.stringify(info.page_session));
		if (reload=='reload'){
		  window.location.reload()
		}
	  }
	});
  }
  


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

function _view_preview_img(divid) {
	const view_pix = $("#" + divid).html();
	$("#blog_preview").html(view_pix).fadeIn(3000);
}

function _view_gallery_preview_img(event,divid) {
	var view_gallery_pix = $("#" + divid).html();
	$("#preview_image").html(view_gallery_pix).fadeIn(3000);
	event.stopPropagation();
  }

function alert_close(){
	$('#get-more-div').html('').fadeOut(200);
}

function _alert_close2(){
	$('#get-form-more-div').fadeOut(200);
}

function _actionAlert(message, status){
	let text = '';
	$('.all-alert-back-div').html(text).css('display', 'flex');
	if(status==true){
		text +=
		'<div class="success-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-check-all"></i></div>'+
			'<div class="text"><p>'+ message +'</p></div>'+
		'</div>';
	}else{
		text +=
		'<div class="failed-alert-div animated fadeInDown">' +
			'<div class="icon"><i class="bi-exclamation-octagon-fill"></i></div>'+
			'<div class="text"><p>'+ message +'</p></div>'+
		'</div>';
	}
	$('.all-alert-back-div').html(text).fadeIn(500).delay(3000).fadeOut(100);
}


function _alert_close(event) {
	var targetElement = event.target;
	if (!targetElement.closest('.main-preview, .preview-live-stream')) {
	  let text = '';
	  text +=
	  '<div class="alert-loading-div">' +
		'<div class="icon"><img src="../all-images/images/loading.gif" width="20px" alt="Loading"/></div>' +
		'<div class="text"><p>LOADING...</p></div>'+
		'</div>';
	  $('#get-more-div').html(text).fadeOut(200);
	}
}


  ///// for FAQs
  function _collapse(div_id) {
    const currentFaq = document.getElementById(div_id);
    const currentIcon = document.getElementById(div_id + "num");
    const currentAnswer = document.getElementById(div_id + "answer");

    document.querySelectorAll('.faq-toggle.active-faq').forEach(faq => {
        if (faq !== currentFaq) {
            faq.classList.remove('active-faq');
            faq.querySelector('.expand-div').innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
            $(faq.querySelector('.answer-div')).slideUp('slow');
        }
    });

    const isActive = currentFaq.classList.toggle('active-faq');
    currentIcon.innerHTML = isActive ? '&nbsp;<i class="bi-dash"></i>&nbsp;' : '&nbsp;<i class="bi-plus"></i>&nbsp;';
    $(currentAnswer).slideToggle('slow');
}


function _main_faq_collapse(div_id) {
	var x = document.getElementById(div_id + "num");
	if (x.innerHTML === '&nbsp;<i class="bi-plus"></i>&nbsp;') {
	  x.innerHTML = '&nbsp;<i class="bi-dash"></i>&nbsp;';
	  $("#" + div_id).addClass("active-faq");
	} else {
	  x.innerHTML = '&nbsp;<i class="bi-plus"></i>&nbsp;';
	  $("#" + div_id).removeClass("active-faq");
	}
	$("#" + div_id + "answer").slideToggle("slow");
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

function capitalizeFirstLetterOfEachWord(inputText) {
	// Split the input text into an array of words
	var words = inputText.toLowerCase().split(' ');
	// Capitalize the first letter of each word
	for (var i = 0; i < words.length; i++) {
		words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
	}
	// Join the words back into a sentence
	var result = words.join(' ');
	return result;
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
    

  
function _getForm(page) {
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

function _progressBar(){
	document.addEventListener('DOMContentLoaded', () => {
		const progressBars = document.querySelectorAll('.progress-per');
	
		const animateProgressBar = (entry) => {
			const progressBar = entry.target;
			if (!progressBar.classList.contains('animated')) {
				const value = progressBar.dataset.text;
				progressBar.style.width = `${value}%`; // Animate width
				progressBar.classList.add('animated');
			}
		};
	
		const observer = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					animateProgressBar(entry);
				}
			});
		}, { threshold: 0.5 }); // Adjust threshold as needed
	
		progressBars.forEach(bar => {
			observer.observe(bar);
		});
	});
	
}

function _startCountdown(targetDate) {
	function updateCountdown() {
	  const now = new Date();
	  const timeDifference = targetDate - now;
  
	  if (timeDifference <= 0) {
		// Time's up
		document.getElementById("days").innerText = "0";
		document.getElementById("hours").innerText = "0";
		document.getElementById("minutes").innerText = "0";
		document.getElementById("seconds").innerText = "0";
		return;
	  }
  
	  const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
	  const hours = Math.floor(
		(timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
	  );
	  const minutes = Math.floor(
		(timeDifference % (1000 * 60 * 60)) / (1000 * 60)
	  );
	  const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
  
	  document.getElementById("days").innerText = days;
	  document.getElementById("hours").innerText = hours;
	  document.getElementById("minutes").innerText = minutes;
	  document.getElementById("seconds").innerText = seconds;
	}
  
	updateCountdown(); // Update immediately
	setInterval(updateCountdown, 1000); // Update every second
}
  

function _countStatistics() {
  var a = 0;
  $(window).scroll(function() {
    var oTop = $('.statistics-div').offset().top - window.innerHeight;
    if (a == 0 && $(window).scrollTop() > oTop) {
      $('.text-div h2').each(function() {
        var $this = $(this),
          countTo = $this.attr('data-count');
        $({
          countNum: $this.text()
        }).animate({
            countNum: countTo
          },
          {
            duration: 10000,
            easing: 'swing',
            step: function() {
              $this.text(Math.floor(this.countNum));
            },
            complete: function() {
              $this.text(this.countNum + '+'); // Add '+' at the end of the final count
            }
          });
      });
      a = 1;
    }
  });
}

function _get_active_contact_link(text) {
	$('#next-ketu, #next-ojota').removeClass('active-btn');
	$('#next-'+text).addClass('active-btn');
}


function _next_contact_page(next_id,text) {
	_get_active_contact_link(text);
	$("#ketu-hide-div, #ojota-hide-div").hide();
	$("#" + next_id).fadeIn(1000);
}

function _get_active_next_link(text) {
	$('#next-recent, #next-past').removeClass('active-btn');
	$('#next-'+text).addClass('active-btn');
}
  
function _next_event_page(next_id,text) {
	_get_active_next_link(text);
	$("#recent-hide-div, #past-hide-div").hide();
	$("#" + next_id).fadeIn(1000);
}


function _open_preview_with_id(page, publish_id) {
    $("#get-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
    var action = "open_preview_with_id";
    var dataString = "action=" + action + "&page=" + page + "&publish_id=" + publish_id;
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

function getFormattedDateTime() {
	const now = new Date();
  
	const year = now.getFullYear();
	const month = String(now.getMonth() + 1).padStart(2, '0');
	const day = String(now.getDate()).padStart(2, '0');
  
	const hours = String(now.getHours()).padStart(2, '0');
	const minutes = String(now.getMinutes()).padStart(2, '0');
	const seconds = String(now.getSeconds()).padStart(2, '0');
  
	const formattedDateTime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
	return formattedDateTime;
}




function _fetchindexUpcomingEvent() {
	const local_date_time= getFormattedDateTime();
	const dataString = 'local_date_time=' + local_date_time;
	try {
		$.ajax({
		type: "POST",
		url: endPoint + '/site/event/fetch-index-upcoming-event',
		data: dataString,
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			const success = info.success;
		
			let text = '';

			if (success==true){
				const data = info.data[0];
				const reg_title = data.reg_title.toUpperCase();
				const event_start_time = data.event_start_time;
				const event_end_time = data.event_end_time;
				const event_location = data.event_location;
				const event_date = data.event_date;
				const main_page_url = data.page_url;

				const targetDate = new Date(event_date.replace(' ', 'T'));

				let dateObj = new Date(event_date);
				let day = dateObj.getDate();
				let month = dateObj.toLocaleString('default', { month: 'short' }).toUpperCase();

				text +=
				`<div class="event-back-div animated fadeInUp">                      
					<div class="inner-content">
						<div class="date-div">
							<div class="event-date">${day}</div>
							<div class="event-month">${month}</div>
						</div>

						<a href="${website_url}/event/${main_page_url}">
						<div class="event-div">
							<h4>UPCOMING EVENT: <span>${reg_title}</span></h4>
							<div class="event-time"><i class="bi-calendar-check"></i> <em>${event_start_time}</em></em> - <em>${event_end_time}</em> </div>  
							<div class="event-time"><i class="bi-geo-alt"></i> <em>${event_location}.</em></div> 
						</div></a>

						<div class="time-div">
                            <div class="time">                              
                                <h3 id="days">0:0</h3>
                                <span>DAY</span>
                            </div>
                            <div class="time">                              
                                <h3 id="hours">0:0</h3>
                                <span>HRS</span>
                            </div>
                            <div class="time">                              
                                <h3 id="minutes">0:0</h3>
                                <span>MIN</span>
                            </div>
                            <div class="time no-border">                              
                                <h3 id="seconds">0:0</h3>
                                <span>SEC</span>
                            </div>
                        </div>
					</div>  
				</div>`;   

				$('#fetchindexUpcomingEvent').html(text);
				_startCountdown(targetDate);
			} else {

			}
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}		
}


function _fetchIndexFaq() {
	
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/faq/fetch-index-faq',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
			const fetch = info.data; 
			const success = info.success;
			const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {
						const faq_question = fetch[i].faq_question;
						const faq_answer = fetch[i].faq_answer;
						const faqID = 'faq' + (i + 1);
					
						text +=
							'<div class="faq-toggle" id="' + faqID + '">' +
								'<div class="title-text" onclick="_collapse(\'' + faqID + '\')">' +
									'<div class="quest-text-div">' +
										'<div class="icon-div"><i class="bi-question"></i></div>' +
										'<h3>' + faq_question + '</h3>' +
									'</div>' +
									'<div class="expand-div" id="' + faqID + 'num">' +
										'<i class="bi-plus"></i>' +
									'</div>' +
								'</div>' +
								'<div class="answer-div" id="' + faqID + 'answer" style="display: none;">' +
									'<p>' + faq_answer + '</p>' +
								'</div>' +
							'</div>';
					}
					$('#fetchIndexFaq').html(text);											   
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchIndexFaq').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}


function formatDate(date) {
	const options = { day: '2-digit', month: 'short', year: 'numeric' };
	const formattedDate = new Date(date).toLocaleDateString('en-GB', options);
	
	const dateParts = formattedDate.split(' ');
	return `${dateParts[0]} ${dateParts[1]} ${dateParts[2]}`;
}


function _fetchIndexBlog(){
	$('#fetchIndexBlog').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/blog/fetch-index-blog',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const page_url = fetch[i].page_url; 
						const blog_view = fetch[i].blog_view; 
						const updated_time = fetch[i].updated_time; 
						const documentStoragePath = fetch[i].documentStoragePath; 
						const formattedDate = formatDate(updated_time);

						text +=
						'<div class="blog-div" data-aos="fade-in" data-aos-duration="1000">'+
                            '<div class="blog-inner-div">'+
                                '<div class="image-div">'+
                                   '<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_pix +'"/>'+   
                                '</div>'+

                               '<div class="text-div">' +                        
                                    '<div class="count"><i class="bi-calendar3"></i> '+ formattedDate +' <span>|</span> <i class="bi-eye-fill"></i> '+ blog_view +' VIEWS</div>'+
                                    '<h3>'+ reg_title +'</h3>'+
                                    
                                    '<a href="'+ website_url +'/blog/' + page_url + '" title="'+ reg_title +'">'+
                                    '<button class="btn" title="Read More">Read More <i class="bi-arrow-right"></i></button></a>'+                                 
                                '</div>'+
                            '</div>'+
                        '</div>';
					}
					$('#fetchIndexBlog').html(text);        					
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchIndexBlog').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}

function _getBlogCategory(){
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/blog-category',
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
		},
		success: function(info){
			const success = info.success;
			const message = info.message;
			const fetch = info.data;
      
      		let text = '';
			if (success == true) {
				for (let i = 0; i < fetch.length; i++) {
					const cat_id = fetch[i].cat_id;
					const cat_name = fetch[i].cat_name;
          
          			text +=
					'<li title="' + cat_name + '" onclick="selectCategory(\'' + cat_id + '\'); _fetchListBlog();">' + cat_name + '</li>';
				}
        		$('#cat_id').html(text); 
			}else{
				_actionAlert(message, false);
		  	}
		}, 
	});
}


function selectCategory(cat_id) {
	$('#cat_id').val(cat_id); 
}
  

function _fetchListBlog(){
	const search_keywords = $('#search_keywords').val();
	const cat_id = $('#cat_id').val(); 
	$('#fetchListBlog').html('<div class="ajax-loader blog-ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	
	if (search_keywords.length > 2 || search_keywords === '') {
		const dataString = '&cat_id=' + cat_id + '&search_keywords=' + search_keywords;
	  	try {
		  	$.ajax({
			  	type: "POST",
			 	url: endPoint + '/site/blog/fetch-listed-blog',
				data: dataString,
			  	dataType: "json",
			 	cache: false,
			  	headers: {
				  'apiKey': apiKey
			  },
			  	success: function (info) {
					const fetch = info.data; 
					const success = info.success;
					const message = info.message;
	
					let text = '';
					if (success === true) {
						for (let i = 0; i < fetch.length; i++) {  
							const reg_title = fetch[i].reg_title; 
							const reg_pix = fetch[i].reg_pix;  
							const page_url = fetch[i].page_url; 
							const blog_view = fetch[i].blog_view; 
							const seo_description = fetch[i].seo_description; 
							const updated_time = fetch[i].updated_time; 
							const cat_name = fetch[i].cat_name; 
							const documentStoragePath = fetch[i].documentStoragePath; 
							const formattedDate = formatDate(updated_time);
  
							  text +=
								'<div class="main-blog-div">'+
									'<div class="top-text">'+ cat_name +'</div>'+
									'<div class="image-div">'+
										'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_pix +'"/>'+
									'</div>'+
									
									'<a href="'+ website_url +'/blog/' + page_url + '" title="'+ reg_title +'">'+
									'<div class="text-content-div">'+
										'<h2>'+ reg_title +'</h2>'+
										'<div class="count"><i class="bi-calendar3"></i>  '+ formattedDate +' <span> | </span> <i class="bi-eye"></i> '+ blog_view +' VIEWS </div>'+
										'<p>'+ seo_description +'</p>'+
										
										'<div>'+
											'<button class="btn" title="Read More">Read More <i class="bi-arrow-right"></i></button></a>'+
										'</div>'+
									'</div></a>'+
								'</div>';        
						}
						$('#fetchListBlog').html(text);        					
				  	} else {
						text +=
						'<div class="false-notification-div">' +
							"<p> " + message +" </p>" +
						"</div>";
						$('#fetchListBlog').html(text);
					} 
			  },
			  	error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	  } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	  }
	}
}
  

function _fetchRelatedBlog(){
	$('#fetchRelatedBlog').html('<div class="ajax-loader blog-ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/blog/fetch-related-blog',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
					const reg_title = fetch[i].reg_title; 
					const reg_pix = fetch[i].reg_pix;  
					const page_url = fetch[i].page_url; 
					const blog_view = fetch[i].blog_view; 
					const seo_description = fetch[i].seo_description; 
					const updated_time = fetch[i].updated_time; 
					const cat_name = fetch[i].cat_name; 
					const documentStoragePath = fetch[i].documentStoragePath; 
					const formattedDate = formatDate(updated_time);

					text +=
					'<div class="related-blog-div">'+
						'<a href="'+ website_url +'/blog/' + page_url + '" title="'+ reg_title +'">'+
						'<div class="top-text">'+ cat_name +'</div>'+
						'<div class="image-div">'+
							'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_pix +'"/>'+
						'</div>'+
	
						'<div class="text-div">'+
							'<h2>'+ reg_title +'</h2>'+
							'<div class="count"><i class="bi-calendar3"></i>  '+ formattedDate +' <span> | </span> <i class="bi-eye"></i> '+ blog_view +' VIEWS</div>'+
							'<p>'+ seo_description +'</p>'+
						'</div></a>'+
					'</div>';         
				}
				$('#fetchRelatedBlog').html(text);      					
			} else {
				text +=
				'<div class="false-notification-div">' +
					"<p> " + message +" </p>" +
				"</div>";
				$('#fetchRelatedBlog').html(text);
			} 
			},
			error: function(textStatus, errorThrown) {
			console.error("AJAX Error: ", textStatus, errorThrown);
			_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}
  

function _fetchEachBlog(publish_id) {
	let page_session = JSON.parse(sessionStorage.getItem("page_session"));
	if(page_session==null){
		_get_page_session_value('reload')
	} else {
  
	  const dataString = 'publish_id=' + publish_id + '&page_session=' + page_session;
	  try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/blog/fetch-each-blog',
			data: dataString,
			dataType: "json",
			cache: false,
			headers: {
			'apiKey': apiKey
		        },
			success: function (info) {
			const success = info.success;
			const message = info.message;
  
		  	if (success==true){
				const data = info.data[0];
				const reg_title = data.reg_title;
				const reg_pix = data.reg_pix;
				const seo_description = data.seo_description;
				const main_page_url = data.page_url;
				const page_content = data.page_content;
				const updated_time = data.updated_time;
				const fullname = capitalizeFirstLetterOfEachWord(data.fullname);
				const formattedDate = formatDate(updated_time);
				const blog_view = data.blog_view;
				const documentStoragePath = data.documentStoragePath;
	
				$('#blog_reg_title, #blog_top_title').html(reg_title);
				$('#blog_seo_description').html(seo_description);
				$('#blog_page_content').html(page_content);
				$('#fullname').html(fullname);
				$('#formattedDate').html(formattedDate);
				$('#blog_view').html(blog_view);
				$('#main_blog_preview').attr('src', documentStoragePath + '/' + reg_pix);
				
				$('#blog-home-link').attr('href', website_url);
				$('#blog-sermon-link').attr('href', website_url + '/blog');
				$('#blog-sermon-title-link').attr('href', website_url + '/blog/' + main_page_url);
			} else {
				_actionAlert(message, false);
			}
		},
		error: function(textStatus, errorThrown) {
		  console.error("AJAX Error: ", textStatus, errorThrown);
		  _actionAlert('An error occurred while processing your request: Please try again', false);
		}
		});
	  } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	  }
	}		
}



function _slideImages(){
    $(document).ready(function () {
	var container = $(".inner-img-container");
	var imagesCount = $(".each-img-div").length;
	var currentIndex = 0;
	var visibleImages;
	var imageWidth = $('.each-img-div').outerWidth(true);
	
	function updateVisibleImages() {
		if ($(window).width() <= 767) {
			visibleImages = 1;
		} else {
			visibleImages = 5;
		}
	}

	updateVisibleImages();
	$(window).resize(updateVisibleImages);

	$(document).on("click", ".right-btn", function () {
		if (currentIndex < imagesCount - visibleImages) {
			currentIndex++;
			var translateValue = currentIndex * imageWidth;
			container.css("transform", "translateX(-" + translateValue + "px)");
		}
	});

	$(document).on("click", ".left-btn", function () {
		if (currentIndex > 0) {
			currentIndex--;
			var translateValue = currentIndex * imageWidth;
			container.css("transform", "translateX(-" + translateValue + "px)");
		}
	});
  });
}


function _fetchBlogPictures(publish_id) {
	const dataString = 'publish_id=' + publish_id;
   	try {
		$.ajax({
		type: "POST",
		url: endPoint + '/site/blog/fetch-pages-pictures',
		data: dataString,
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			const fetch = info.gallery; 
			const success = info.success;
			const message = info.message;
  
			let no = 0;
			let text = '';
			if (success === true) {
				for (let i = 0; i < fetch.length; i++) {  
				no++
				const publish_id = fetch[i].publish_id; 
				const pictures = fetch[i].pictures; 
				const documentStoragePath = fetch[i].documentStoragePath; 
	
				text +=
					'<div class="each-img-div" title="Click to Preview" id="img'+ no +'" onclick="_view_preview_img('+"'"+'img'+ no +"'"+')">'+
						'<img src="' + documentStoragePath + '/' + pictures + '" alt="' + publish_id + '"/>'+
					'</div>';           
				}
				$('#fetchBlogPictures').html(text);       					
			} else {
			text +=
				'<div class="false-notification-div">' +
					"<p> " + message +" </p>" +
				"</div>";
				$('#fetchBlogPictures').html(text);
			}
			_slideImages();
		},
		error: function(textStatus, errorThrown) {
			console.error("AJAX Error: ", textStatus, errorThrown);
			_actionAlert('An error occurred while processing your request: Please try again', false);
		}
	});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}
  


function _fetchMainRelatedBlog(){
	$('#fetchMainRelatedBlog').html('<div class="ajax-loader blog-ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/blog/fetch-index-blog',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const page_url = fetch[i].page_url; 
						const blog_view = fetch[i].blog_view; 
						const updated_time = fetch[i].updated_time; 
						const documentStoragePath = fetch[i].documentStoragePath; 
						const formattedDate = formatDate(updated_time);

						text +=
						'<a href="'+ website_url +'/blog/'+ page_url +'" title="'+ reg_title +'">'+
							'<div class="related-post">'+
								'<div class="image-div">'+
									'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
								'</div>'+
								'<div class="cont-div">'+
									'<h3>'+ reg_title +'</h3>'+  
									'<div class="comment"><i class="bi-clock"></i> <span> '+ formattedDate +' </span> | <i class="bi-eye-fill"></i> <span> '+ blog_view +' Views </span></div>'+
								'</div>'+
						'</div></a>';        
					}
					$('#fetchMainRelatedBlog').html(text);       					
				} else {
					text +=
						'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
						"</div>";
					$('#fetchMainRelatedBlog').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}
  


function _fetchAllGallery() {
	$('#fetchAllGallery').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/gallery/fetch-main-gallery',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const publish_id = fetch[i].publish_id; 
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const gallery_sub_title = fetch[i].gallery_sub_title; 
						const documentStoragePath = fetch[i].documentStoragePath; 

						text +=
						'<div class="main-gallery-div" title="click to view album" onclick="_open_preview_with_id(' + "'gallery-images'" + "," + "'" + publish_id  + "'" +');">'+
							'<div class="title">'+ gallery_sub_title +'</div>'+
							'<div class="image-div">'+
								'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
							'</div>'+

							'<div class="text-back-div">'+
								'<div class="text-div">'+
									'<h4>'+ reg_title +'</h4>'+
								'</div>'+
								'<div class="icon-div">'+
									'<img src="'+ website_url +'/all-images/images/icon.png" alt="AR-RAHMAN MONTESSORI SCHOOLS Logo"/>'+
								'</div>'+
							'</div>'+
						'</div>'; 
					}
					$('#fetchAllGallery').html(text); 				
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
				$('#fetchAllGallery').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}
  


function _fetchIndexClassGallery() {
	$('#fetchIndexClassGallery').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/gallery/fetch-index-class-gallery',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const publish_id = fetch[i].publish_id; 
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const class_gallery_sub_title = fetch[i].class_gallery_sub_title.toUpperCase();
						const documentStoragePath = fetch[i].documentStoragePath; 

						text +=
						'<div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left" data-aos-duration="1200">'+
							'<div class="main-gallery-div index-gallery-div" title="click to view album" onclick="_open_preview_with_id(' + "'gallery-images'" + "," + "'" + publish_id  + "'" +');">'+
								'<div class="title">'+ class_gallery_sub_title +'</div>'+
								'<div class="image-div">'+
									'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
								'</div>'+

								'<div class="text-back-div">'+
									'<div class="text-div">'+
										'<h4>'+ reg_title +'</h4>'+
									'</div>'+
									'<div class="icon-div">'+
										'<img src="'+ website_url +'/all-images/images/icon.png" alt="AR-RAHMAN MONTESSORI SCHOOLS Logo"/>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
					}
					$('#fetchIndexClassGallery').html(text); 	
					_call_carousel(1)
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
				$('#fetchIndexClassGallery').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}



function _fetchGalleryList(publish_id) {
	const dataString = 'publish_id=' + publish_id;
   	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/gallery/fetch-pages-pictures',
	   		data: dataString,
			dataType: "json",
			cache: false,
			headers: {
				 'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.gallery; 
				const success = info.success;
				const message = info.message;
 
		 		let no = 0;
				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						no++
						const publish_id = fetch[i].publish_id; 
						const pictures = fetch[i].pictures; 
						const documentStoragePath = fetch[i].documentStoragePath; 
 
						text +=
						'<div class="each-img" title="click to Preview" id="' + no + '" onclick="_view_gallery_preview_img(event,' + no + ')">'+
							'<img src="' + documentStoragePath + '/' + pictures + '" alt="' + publish_id + '"/>'+
						'</div>'; 
					}
					$('#fetchGalleryList').html(text);       					
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchGalleryList').html(text);
				} 
			},
			 error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		 });
 
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
 }
 
 
 function _fetchGall(publish_id) {
   const dataString = 'publish_id=' + publish_id;
  
	$.ajax({
	  	type: "POST",
	 	url: endPoint + '/site/gallery/fetch-pages-pictures',
	 	data: dataString,
	  	dataType: "json",
	  	cache: false,
	  	headers: {
		'apiKey': apiKey
	  	},
	  success: function (info) {
		const success = info.success;
		const reg_pix = info.reg_pix;
 
		if (success === true) {
		 	const documentStoragePath = info.gallery[0].documentStoragePath2;
 
			if ($('#ppreview_image img').length === 0) {
				$('#preview_image').append('<img alt="Image Preview">');
			}
			$('#preview_image img').attr('src', documentStoragePath +'/' + reg_pix);	
	   	}
	  },
	});
}


function _fetchPageUpcomingEvent() {
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/event/fetch-main-upcoming-event',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
		        },
			success: function (info) {
			const success = info.success;
      		const message = info.message;

			if (success==true){
				const data = info.data[0];
				const reg_title = data.reg_title.toUpperCase();
				const reg_pix = data.reg_pix;
				const documentStoragePath = data.documentStoragePath;
				const event_start_time = data.event_start_time;
				const event_end_time = data.event_end_time;
				const event_location = data.event_location;
				const seo_description = data.seo_description;
				const page_url = data.page_url;
				const event_date = data.event_date;

				let dateObj = new Date(event_date);
				let day = dateObj.getDate();
				let month = dateObj.toLocaleString('default', { month: 'short' }).toUpperCase();

				$('#seo_description').html(seo_description);
				$('#reg_title').html(reg_title);
				$('#event_preview').attr('src', documentStoragePath + '/' + reg_pix);
				$('#event_start_time').html(event_start_time);
				$("#event_end_time").html(event_end_time);
				$("#event_location").html(event_location);
				$("#event_day").html(day);
				$("#event_month").html(month);
				$('#event-link').attr('href', website_url + '/event/' + page_url);

        		const targetDate = new Date(event_date);
				_startCountdown(targetDate);
			} else {
        		_actionAlert(message, false);
			}
		},
		error: function(textStatus, errorThrown) {
			console.error("AJAX Error: ", textStatus, errorThrown);
			_actionAlert('An error occurred while processing your request: Please try again', false);
		}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}		
}


function _fetchRelatedEvent() {
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/event/fetch-main-past-event',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const event_start_time = fetch[i].event_start_time; 
						const event_end_time = fetch[i].event_end_time; 
						const event_location = fetch[i].event_location; 
						const event_date = fetch[i].event_date;
						const page_url = fetch[i].page_url;
						const documentStoragePath = fetch[i].documentStoragePath; 

						let dateObj = new Date(event_date);
						let day = dateObj.getDate();
						let month = dateObj.toLocaleString('default', { month: 'short' }).toUpperCase();

						text +=
						'<div class="main-event-div" data-aos="fade-in" data-aos-duration="1000">'+                      
							'<div class="image-div">'+
								'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
							'</div>'+
							'<div class="content-div">'+
								'<div class="event-date-back-div">'+
									'<div class="date-div">'+
										'<div class="event-date">'+ day +'</div>'+
										'<div class="event-month">'+ month +'</div>'+
									'</div>'+

									'<a href="'+ website_url +'/event/'+ page_url +'" title="'+ reg_title +'">' +
									'<div class="event-div">'+
									'<h2>'+ reg_title +'</h2>'+
										'<div class="event-time"><i class="bi-calendar-check"></i> <em>'+ event_start_time +' - '+ event_end_time +'</em> </div>'+  
										'<div class="event-time"><i class="bi-geo-alt"></i> <em>'+ event_location +'</em></div>'+
									'</div></a>'+
								'</div>'+
							'</div>'+ 
						'</div>';
						}
						$('#fetchPastEvent').html(text);        					
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchPastEvent').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}



function _fetchMainRelatedUpcominEvent() {
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/event/fetch-main-related-upcoming-event',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const event_start_time = fetch[i].event_start_time; 
						const event_end_time = fetch[i].event_end_time; 
						const event_location = fetch[i].event_location; 
						const event_date = fetch[i].event_date;
						const page_url = fetch[i].page_url;
						const documentStoragePath = fetch[i].documentStoragePath; 

						let dateObj = new Date(event_date);
						let day = dateObj.getDate();
						let month = dateObj.toLocaleString('default', { month: 'short' }).toUpperCase();

						text +=
						'<div class="main-event-div" data-aos="fade-in" data-aos-duration="1000">'+ 
							'<div class="event-title">Related Upcoming Event</div>'+                      
							'<div class="image-div">'+
								'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
							'</div>'+
							'<div class="content-div">'+
								'<div class="event-date-back-div">'+
									'<div class="date-div">'+
										'<div class="event-date">'+ day +'</div>'+
										'<div class="event-month">'+ month +'</div>'+
									'</div>'+

									'<a href="'+ website_url +'/event/'+ page_url +'" title="'+ reg_title +'">' +
									'<div class="event-div">'+
									'<h2>'+ reg_title +'</h2>'+
										'<div class="event-time"><i class="bi-calendar-check"></i> <em>'+ event_start_time +' - '+ event_end_time +'</em> </div>'+  
										'<div class="event-time"><i class="bi-geo-alt"></i> <em>'+ event_location +'</em></div>'+
									'</div></a>'+
								'</div>'+
							'</div>'+ 
						'</div>';
						}
						$('#fetchMainRelatedUpcominEvent').html(text);        					
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchMainRelatedUpcominEvent').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}




function _getSelectCategory(){
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/faq-category',
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
		},
		success: function(info){
			const success = info.success;
			const message = info.message;
			const fetch = info.data;

			let text = '';
			if (success == true) {
				for (let i = 0; i < fetch.length; i++) {
					const cat_id = fetch[i].cat_id;
					const cat_name = fetch[i].cat_name;
					
					text +=
					'<li title="' + cat_name + '" onclick="selectCategory(\'' + cat_id + '\'); _fetchFaq();">' + cat_name + '</li>';
				}
				$('#cat_id').html(text); 
			}else{
				_actionAlert(message, false);
		  	}
		}, 
	});
}



function _fetchFaq() {
	const search_keywords = $('#search_keywords').val();
	const cat_id = $('#cat_id').val();
	$('#fetchFaq').html('<div class="ajax-loader blog-ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	
	if (search_keywords.length > 2 || search_keywords === '') {
		const dataString = 'cat_id=' + cat_id + '&search_keywords=' + search_keywords;
	
	  	try {
		  	$.ajax({
			  	type: "POST",
			  	url: endPoint + '/site/faq/fetch-faq',
				data: dataString,
			 	dataType: "json",
			  	cache: false,
			 	 headers: {
				  'apiKey': apiKey
				},
				success: function (info) {
					const fetch = info.data; 
					const success = info.success;
					const message = info.message;
	
		  			let no=0;
				  	let text = '';
				  	if (success === true) {
						for (let i = 0; i < fetch.length; i++) {  
							no++;
							const faq_question = fetch[i].faq_question; 
							const faq_answer = fetch[i].faq_answer;  
			
							text +=
							'<div class="faq-title main-faq-title" onclick="_main_faq_collapse(' + "'" + 'faq' + no + "'" + ')">'+
								'<div class="inner-title-div">'+
									'<h2>'+ faq_question +'</h2>'+
									'<div class="expand-div" id="' + "faq" + no + "num" + '">&nbsp;<i class="bi-plus"></i>&nbsp;</div>'+
								'</div>'+
												
								'<div class="faq-answer-div" id="' + "faq" + no + "answer" + '" style="display: none;">'+
									'<p>'+ faq_answer +'</p>'+                         
								'</div>'+
							'</div>';
						  }
						  $('#fetchFaq').html(text);        					
				  	} else {
					  text +=
						'<div class="false-notification-div">' +
							"<p> " + message +" </p>" +
						"</div>";
					$('#fetchFaq').html(text);
				  } 
			  },
			  error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	  } catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	  }
  	}
}


function _fetchEachEvent(publish_id) {
	let page_session = JSON.parse(sessionStorage.getItem("page_session"));
	if(page_session==null){
		_get_page_session_value('reload')
	} else {
		const dataString = 'publish_id=' + publish_id + '&page_session=' + page_session;
		try {
			$.ajax({
				type: "POST",
				url: endPoint + '/site/event/fetch-each-event',
				data: dataString,
				dataType: "json",
				cache: false,
				headers: {
				'apiKey': apiKey
			        },
				success: function (info) {
				const success = info.success;
				const message = info.message;
	
				if (success==true){
					const data = info.data[0];
					const reg_title = data.reg_title;
					const reg_pix = data.reg_pix;
					const seo_description = data.seo_description;
					const main_page_url = data.page_url;
					const page_content = data.page_content;
					const updated_time = data.updated_time;
					const fullname = capitalizeFirstLetterOfEachWord(data.fullname);
					const formattedDate = formatDate(updated_time);
					const page_view = data.page_view;
					const documentStoragePath = data.documentStoragePath;
		
					$('#event_reg_title, #event_top_title').html(reg_title);
					$('#event_seo_description').html(seo_description);
					$('#event_page_content').html(page_content);
					$('#fullname').html(fullname);
					$('#formattedDate').html(formattedDate);
					$('#page_view').html(page_view);
					$('#main_event_preview').attr('src', documentStoragePath + '/' + reg_pix);
					
					$('#event-home-link').attr('href', website_url);
					$('#event-sermon-link').attr('href', website_url + '/event');
					$('#event-sermon-title-link').attr('href', website_url + '/event/' + main_page_url);
		
				} else {
					_actionAlert(message, false);
				}
				},
				error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
				}
			});
		} catch (error) {
			console.error("Error: ", error);
			_actionAlert('An error occurred while processing your request: ' + error, false);
		}
	}		
}
  
  
  
  
function _fetchMainRelatedEvent(){
	$('#fetchMainRelatedEvent').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
	try {
		$.ajax({
			type: "POST",
			url: endPoint + '/site/event/fetch-related-event',
			dataType: "json",
			cache: false,
			headers: {
				'apiKey': apiKey
			},
			success: function (info) {
				const fetch = info.data; 
				const success = info.success;
				const message = info.message;

				let text = '';
				if (success === true) {
					for (let i = 0; i < fetch.length; i++) {  
						const reg_title = fetch[i].reg_title; 
						const reg_pix = fetch[i].reg_pix;  
						const page_url = fetch[i].page_url; 
						const page_view = fetch[i].page_view; 
						const updated_time = fetch[i].updated_time; 
						const documentStoragePath = fetch[i].documentStoragePath; 
						const formattedDate = formatDate(updated_time);

						text +=
						'<a href="'+ website_url +'/event/'+ page_url +'" title="'+ reg_title +'">'+
						'<div class="related-post">'+
							'<div class="image-div">'+
								'<img src="'+ documentStoragePath +'/'+ reg_pix +'" alt="'+ reg_title +'"/>'+
							'</div>'+
							'<div class="cont-div">'+
								'<h3>'+ reg_title +'</h3>'+  
								'<div class="comment"><i class="bi-clock"></i> <span> '+ formattedDate +' </span> | <i class="bi-eye-fill"></i> <span> '+ page_view +' Views </span></div>'+
							'</div>'+
						'</div></a>';        
						}
						$('#fetchMainRelatedEvent').html(text);       					
				} else {
					text +=
					'<div class="false-notification-div">' +
						"<p> " + message +" </p>" +
					"</div>";
					$('#fetchMainRelatedEvent').html(text);
				} 
			},
			error: function(textStatus, errorThrown) {
				console.error("AJAX Error: ", textStatus, errorThrown);
				_actionAlert('An error occurred while processing your request: Please try again', false);
			}
		});
	} catch (error) {
		console.error("Error: ", error);
		_actionAlert('An error occurred while processing your request: ' + error, false);
	}
}



function _getSelectRelationship(){
	$.ajax({
		type: "POST",
		url: endPoint + '/setups/fetch-relationship-cat',
		dataType: 'json',
		cache: false,
		headers: {
			'apiKey': apiKey,
		},
		success: function(info){
			const success = info.success;
			const message = info.message;
			const fetch = info.data;
  
			if (success == true) {
				for (let i = 0; i < fetch.length; i++) {
					const relationship_type_id = fetch[i].relationship_type_id;
					const relationship_type_name = fetch[i].relationship_type_name;
					$('#relationship_type_id').append('<option value="'+ relationship_type_id +'">'+ relationship_type_name +'</option>');
				}
			}else{
				_actionAlert(message, false);
		  	}
		}, 
	});
}



function _sendTestimony() {
	try {
		const fullname = $('#fullname').val();
		const email = $('#email').val();
		const phone = $('#phone').val();
		const relationship_type_id = $('#relationship_type_id').val();
    	const testimony = $('#testimony').val();
		
		$('#fullname, #email, #phone, #relationship_type_id, #testimony').removeClass('issue');	
		
		if (!fullname) {
			$('#fullname').addClass("issue");
			_actionAlert('Provide Fullname to continue', false);
		return;
		} 

		if (!email || $('#email').val().indexOf("@") <= 0) {
			$('#email').addClass("issue");
			_actionAlert('Provide valid email address to continue', false);
		return;
		} 

		if (!phone) {
			$('#phone').addClass("issue");
			_actionAlert('Provide Phone Number to continue', false);
		return;
		} 

		if (!relationship_type_id) {
			$('#relationship_type_id').addClass("issue");
			_actionAlert('Select Relationship to continue', false);
		return;
		}

		if (!testimony) {
			$('#testimony').addClass("issue");
			_actionAlert('Provide Testimony to continue', false);
		return;
		}

    	$('#fullname, #email, #phone, #relationship_type_id, #testimony').removeClass('issue');
		
		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submit_btn").html();
			$("#submit_btn").html('<img src="'+ website_url +'/all-images/images/loading.gif" width="15px" alt="Loading"/> Sending');
			document.getElementById("submit_btn").disabled = true;
			
			const form_data = new FormData();
			form_data.append("fullname", fullname);
			form_data.append("email", email);
			form_data.append("phone", phone);
			form_data.append("relationship_type_id", relationship_type_id);
			form_data.append("testimony", testimony);
			
			$.ajax({
				type: "POST",
				url: endPoint + '/site/testimony/send-testimony',
				data: form_data,
				dataType: "json",
				contentType: false,
				cache: false,
				headers: {
					'apiKey': apiKey
				},
				processData: false,
				success: function (info) {
					const success = info.success;
					const message = info.message;
		
					if (success === true) {
						_actionAlert(message, true);
						_alert_close2();
					} else {
						_actionAlert(message, false);
					}
					$("#submit_btn").html(btn_text);
					document.getElementById("submit_btn").disabled = false;
				},
				error: function (error) {
					_actionAlert('An error occurred while processing your request: ' + error, false);
					$("#submit_btn").html(btn_text);
					document.getElementById("submit_btn").disabled = false;
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		document.getElementById("submit_btn").disabled = false;
	}
}



function _fetchAllTestimony() {
	$('#fetchAllTestimony').html('<div class="ajax-loader"><img src="' + website_url + '/all-images/images/spinner.gif" alt="Loading"/></div>').fadeIn("fast");
   	try {
		$.ajax({
		type: "POST",
		url: endPoint + '/site/testimony/fetch-testimony',
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			const fetch = info.data; 
			const success = info.success;
			const message = info.message;
	
			let text = '';
			if (success === true) {
				for (let i = 0; i < fetch.length; i++) { 
					const fullname = fetch[i].fullname; 
					const relationship_type_name = capitalizeFirstLetterOfEachWord(fetch[i].relationship_type_name);
					const testimony = fetch[i].testimony; 

					text +=
					'<div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left" data-aos-duration="1200">'+
						'<div class="testimonial-div">'+
							'<div class="top-icon"><i class="bi-quote"></i></div>'+
							'<div class="inner-div">'+ 
								'<div class="star-div">'+
									'<i class="bi-star-fill"></i>'+
									'<i class="bi-star-fill"></i>'+
									'<i class="bi-star-fill"></i>'+
									'<i class="bi-star-fill"></i>'+
									'<i class="bi-star-fill"></i>'+
								'</div>'+ 

								'<p><em>'+ testimony +'</em></p>'+
								
								'<div class="profile-div">'+
									'<div class="img-div"><img src="'+ website_url +'/all-images/images/avatar.png" alt="Profile Image"/></div>'+
									'<div class="text-div">'+
										'<h3>'+ fullname +'</h3>'+
										'<p>'+ relationship_type_name +'</p>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
				} 
			 	$('#fetchAllTestimony').html(text); 
			 	_call_carousel(2);      					
			} else {
				text +=
				'<div class="false-notification-div">' +
					"<p> " + message +" </p>" +
				"</div>";
				$('#fetchAllTestimony').html(text);
			} 
	   },
	   	error: function(textStatus, errorThrown) {
		 	console.error("AJAX Error: ", textStatus, errorThrown);
		 	_actionAlert('An error occurred while processing your request: Please try again', false);
	   }
	});
   	} catch (error) {
	 	console.error("Error: ", error);
	 	_actionAlert('An error occurred while processing your request: ' + error, false);
   	}
}



function _fetchIndexTeachers() {
   	try {
		$.ajax({
		type: "POST",
		url: endPoint + '/site/staff/fetch-index-teachers',
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			const fetch = info.data; 
			const success = info.success;
			const message = info.message;
	
			let text = '';
			if (success === true) {
				for (let i = 0; i < fetch.length; i++) { 
					const fullname = fetch[i].fullname; 
					const position = capitalizeFirstLetterOfEachWord(fetch[i].position);
					const profile_pix = fetch[i].profile_pix; 
					const documentStoragePath = fetch[i].documentStoragePath;

					text +=`
						<div class="teachers-div" data-aos="fade-in" data-aos-duration="1000">
							<div class="teachers-inner-div">
								<div class="image-div">
									<img src="${documentStoragePath}/${profile_pix}" alt="${fullname}"/>     
								</div>

								<div class="text-div"> 
									<div class="detail-text">
										<h3>${fullname}</h3>
										<p>${position}</p>
									</div>                           
									<div class="icon-div"><i class="bi-share"></i></div>      
								</div>
							</div>
						</div>`;
				} 
			 	$('#fetchIndexTeachers').html(text); 
			} else {
				text +=
				'<div class="false-notification-div">' +
					"<p> " + message +" </p>" +
				"</div>";
				$('#fetchIndexTeachers').html(text);
			} 
	   },
	   	error: function(textStatus, errorThrown) {
		 	console.error("AJAX Error: ", textStatus, errorThrown);
		 	_actionAlert('An error occurred while processing your request: Please try again', false);
	   }
	});
   	} catch (error) {
	 	console.error("Error: ", error);
	 	_actionAlert('An error occurred while processing your request: ' + error, false);
   	}
}



function _fetchAllTeachers() {
   	try {
		$.ajax({
		type: "POST",
		url: endPoint + '/site/staff/fetch-all-teachers',
		dataType: "json",
		cache: false,
		headers: {
			'apiKey': apiKey
		},
		success: function (info) {
			const fetch = info.data; 
			const success = info.success;
			const message = info.message;
	
			let text = '';
			if (success === true) {
				for (let i = 0; i < fetch.length; i++) { 
					const fullname = fetch[i].fullname; 
					const position = capitalizeFirstLetterOfEachWord(fetch[i].position);
					const profile_pix = fetch[i].profile_pix; 
					const documentStoragePath = fetch[i].documentStoragePath;

					text +=`
						<div class="teachers-div" data-aos="fade-in" data-aos-duration="1000">
							<div class="teachers-inner-div">
								<div class="image-div">
									<img src="${documentStoragePath}/${profile_pix}" alt="${fullname}"/>     
								</div>

								<div class="text-div"> 
									<div class="detail-text">
										<h3>${fullname}</h3>
										<p>${position}</p>
									</div>                           
									<div class="icon-div"><i class="bi-share"></i></div>      
								</div>		
							</div>
						</div>`;
				} 
			 	$('#fetchAllTeachers').html(text); 
			} else {
				text +=
				'<div class="false-notification-div">' +
					"<p> " + message +" </p>" +
				"</div>";
				$('#fetchAllTeachers').html(text);
			} 
	   },
	   	error: function(textStatus, errorThrown) {
		 	console.error("AJAX Error: ", textStatus, errorThrown);
		 	_actionAlert('An error occurred while processing your request: Please try again', false);
	   }
	});
   	} catch (error) {
	 	console.error("Error: ", error);
	 	_actionAlert('An error occurred while processing your request: ' + error, false);
   	}
}



function _sendContactEmail() {
	try {
		const fullName = $('#fullName').val();
		const email = $('#email').val();
		const subject = $('#subject').val();
		const message = $('#message').val();

		$('#fullName, #email, #subject, #message').removeClass('issue');

		if (!fullName) {
			$('#fullName').addClass("issue");
			_actionAlert('Provide fullname to continue', false);
			return;
		}

		if (!email || $('#email').val().indexOf("@") <= 0) {
			$('#email').addClass("issue");
			_actionAlert('Provide valid email address to continue', false);
			return;
		}

		if (!subject) {
			$('#subject').addClass("issue");
			_actionAlert('Provide subject to continue', false);
			return;
		}

		if (!message) {
			$('#message').addClass("issue");
			_actionAlert('Provide message to continue', false);
			return;
		}

		if (confirm("Confirm!!\n\n Are you sure to PERFORM THIS ACTION?")) {
			const btn_text = $("#submitBtn").html();
			$("#submitBtn").html('<img src="'+ website_url +'/all-images/images/loading.gif" width="15px" alt="Loading"/> Sending');
			document.getElementById("submitBtn").disabled = true;

			const form_data = new FormData();
			form_data.append("fullName", fullName);
			form_data.append("email", email);
			form_data.append("subject", subject);
			form_data.append("message", message);

			$.ajax({
				type: "POST",
				url: endPoint + '/site/contact/send-contact-mail',
				data: form_data,
				dataType: "json",
				contentType: false,
				cache: false,
				headers: {
					'apiKey': apiKey
				},
				processData: false,
				success: function (info) {
					const success = info.success;
					const message = info.message;

					if (success === true) {
						_getForm('send_contact_success');
						$('#fullName,#email,#subject,#message').val('');
					} else {
						_actionAlert(message, false);
					}
					$("#submitBtn").html(btn_text);
					document.getElementById("submitBtn").disabled = false;
				},
				error: function (error) {
					_actionAlert('An error occurred while processing your request: ' + error, false);
					$("#submitBtn").html(btn_text);
					document.getElementById("submitBtn").disabled = false;
				}
			});
		}
	} catch (error) {
		_actionAlert('An unexpected error occurred: ' + error.message, false);
		document.getElementById("submitBtn").disabled = false;
	}
}
