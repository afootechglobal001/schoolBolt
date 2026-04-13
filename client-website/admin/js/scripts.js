
function _open_menu(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	$('.live-chat-back-div').animate({'margin-left':'-100%'},400);
}

function _open_live_chat(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'0'},200);
	$('.live-chat-back-div').animate({'margin-left':'0'},400);
}

function _close_side_nav(){
	$('.sidenavdiv, .sidenavdiv-in').animate({'margin-left':'-100%'},200);
	$('.live-chat-back-div').animate({'margin-left':'-100%'},400);
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

function _show_password_visibility(ids,toggle_pass){
	var password = $('#'+ids).val();
	if (password!='') {
	 $('#'+toggle_pass).show();
	} else {
		$('#'+toggle_pass).hide();
	}
}

function _togglePasswordVisibility(ids, toggle_pass) {
	const passwordInput = document.getElementById(ids);
	const togglePasswordIcon = document.getElementById(toggle_pass);

	if (passwordInput.type === 'password') {
		passwordInput.type = 'text';
		togglePasswordIcon.innerHTML = '<i class="bi-eye password-toggle"></i>';
	} else {
	passwordInput.type = 'password';
	togglePasswordIcon.innerHTML = '<i class="bi-eye-slash password-toggle"></i>';
	}
}


function isNumber_Check(e) {
    var key = e.keyCode || e.which;

    if (!((key >= 48 && key <= 57))) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
    }
}
 
function _next_page(next_id) {
    $("#view_login,#reset_password_info,#send_link_info").hide();
    $("#" + next_id).fadeIn(1000);
    
    let staffResetData = JSON.parse(sessionStorage.getItem("staffResetData"));
    $('#staff_id').html(staffResetData.staff_id);
    $('#user_fullname').html(staffResetData.fullname);
    $('#user_email').html(staffResetData.email);

	$("#resendOtpBtn").attr('onclick', `_resendMail('${staffResetData.staff_id}')`);
}

function _counDownOtp(timer){
	$('#resendOtpBtn').hide();
	$('#resendCountdown').fadeIn(500);
	const countdown = setInterval(() => {
		if (timer > 0) {
		  timer = timer - 1;
		  $('#timer').html(timer);
		} else {
			$('#resendCountdown').hide();
			$('#resendOtpBtn').fadeIn(500);
		  clearInterval(countdown);
		}
	  }, 1000);
	  return () => clearInterval(countdown);
}


function _passwordResetSuccesful(page) {
	$("#get-more-div").css({'display': 'flex','justify-content': 'center','align-items': 'center'}) .fadeIn(500);
	const action = "password_reset_successful";
	const dataString = "action=" + action + "&page=" + page;
	$.ajax({
	  type: "POST",
	  url: admin_login_local_url,
	  data: dataString,
	  cache: false,
	  success: function (html) { 
		$("#get-more-div").html(html);
	  },
	});
}
  

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////USER LOGIN FUNCTION////////
function _confirmLogin() {
	const username = $('#username').val();
	const password = $("#password").val();

	$('#email, #password').removeClass("issue");

	if (!username || !$('#username').val().includes("@") || !$('#username').val().includes(".")) {
		$('#username').addClass('issue');
		_actionAlert('Provide Correct Email Address To Continue', false);	

	} else if (!password) {
		$('#password').addClass('issue');
		_actionAlert('Provide Correct Password Address To Continue', false);

	} else {
	$('#username, #password').removeClass("issue");

	//////////////// get btn text ////////////////
	const btn_text = $("#submit_btn").html();
	$("#submit_btn").html('<img src="../all-images/images/loading.gif" width="15px" alt="Loading"/> Authenticating');
	document.getElementById("submit_btn").disabled = true;
	////////////////////////////////////////////////

	const dataString = "&username=" + username + "&password=" + password;
	$.ajax({
		type: "POST",
		url: endPoint + '/admin/auth/login',
		data: dataString,
		cache: false,
		dataType: "json",
		cache: false,
		headers: {
		'apiKey': apiKey
	        },
		success: function (data) {
			const success = data.success;
			const message = data.message;
		
			if (success == true) {
				sessionStorage.setItem("staffLoginData", JSON.stringify(data));
				_actionAlert(message, true);
				window.parent((location = admin_portal_url));
			} else {
				_actionAlert(message, false);				
			}	
			$("#submit_btn").html(btn_text);
			document.getElementById("submit_btn").disabled = false;	
		},
		error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);	
			$("#submit_btn").html(btn_text);
			document.getElementById("submit_btn").disabled = false;
		}
	});
	}
}

//////USER RESET PASSWORD FUNCTION////////
function _resetPassword() {
	const email = $('#email').val();
	$('#email').removeClass("issue");

	if (!email || !$('#email').val().includes("@") || !$('#email').val().includes(".")) {
		$('#email').addClass('issue');
		_actionAlert('Provide Correct Email Address To Continue', false);

	} else {
	$('#email').removeClass("issue");

	//////////////// get btn text ////////////////
	const btn_text = $("#proceed_btn").html();
	$("#proceed_btn").html('<img src="../all-images/images/loading.gif" width="15px" alt="Loading"/> Authenticating');
	document.getElementById("proceed_btn").disabled = true;
	////////////////////////////////////////////////

	const dataString = "&email=" + email;
	$.ajax({
		type: "POST",
		url: endPoint + '/admin/auth/reset-password',
		data: dataString,
		cache: false,
		dataType: "json",
		cache: false,
		headers: {
		'apiKey': apiKey
	        },
		success: function (data) {
			const success = data.success;
			const message = data.message;
		
			if (success == true) {
				sessionStorage.setItem("staffResetData", JSON.stringify(data));
				_next_page('send_link_info');
				_actionAlert(message, true);
			} else {
				_actionAlert(message, false);				
			}	
			$("#proceed_btn").html(btn_text);
			document.getElementById("proceed_btn").disabled = false;	
		},
		error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);	
			$("#proceed_btn").html(btn_text);
			document.getElementById("proceed_btn").disabled = false;
		}
	});
	}
}

//////USER RESENT MAIL FUNCTION////////
function _resendMail(staff_id) {

	//////////////// get btn text ////////////////
	const btn_text = $("#resendOtpBtn").html();
	$("#resendOtpBtn").html('<img src="../all-images/images/loading.gif" width="12px" alt="Loading"/> Sending');
	$("#resendOtpBtn").removeAttr("onclick").css("pointer-events", "none");
	/////////////////////////////////

	const dataString = "&staff_id=" + staff_id;
	
	$.ajax({
		type: "POST",
		url: endPoint + '/admin/auth/resend-mail',
		data: dataString,
		cache: false,
		dataType: "json",
		headers: {
			'apiKey': apiKey
		},
		success: function (data) {
			const success = data.success;
			const message = data.message;
		
			if (success) {
				_actionAlert(message, true);
			} else {
				_actionAlert(message, false);				
			}	

			$("#resendOtpBtn").html(btn_text).css("pointer-events", "auto");
			$("#resendOtpBtn").attr('onclick', `_resendMail('${staff_id}')`);
		},
		error: function (error) {
			console.log(error);
			_actionAlert('An error occurred. Please try again', false);
			$("#resendOtpBtn").html(btn_text).css("pointer-events", "auto");
			$("#resendOtpBtn").attr('onclick', `_resendMail('${staff_id}')`);
		}
	});
}

//////USER ACCESS KEY CHECK FUNCTION////////
function _get_acess_key_value(page, access_key) {
	const dataString = "&access_key=" + access_key;
	
	$.ajax({
		type: "POST",
		url: endPoint +'/admin/auth/reset-password-accesskey-validation',
		data: dataString,
		dataType: 'json',
		cache: false,
		headers: {
		'apiKey': apiKey
		},
		success: function (info) {
			const success = info.success;
			if (success == true) {
				const staff_id = info.staff_id;
				_get_reset_password_page(page, staff_id);
			} else {
				window.parent((location = admin_login_portal_url));
			}
		}
	});
}

//////RESET PASSWORD PAGE FUNCTION////////
function _get_reset_password_page(page, staff_id) {
	var action = page;
	var dataString = 'action=' + action + '&page=' + page + '&staff_id=' + staff_id;
	$.ajax({
		type: "POST",
		url: admin_login_local_url,
		data: dataString,
		cache: false,
		success: function (html) {
			$('#get-reset-password-page').html(html);
		}
	});
}

//////CHECK PASSWORD MATCH FUNCTION////////
function _check_password_match(){
	const password = $("#password").val();
	const confirm_password = $("#confirm_password").val();
	if ((password!=confirm_password) && (confirm_password!='')){
	 $('#message').show();
	}else{
	  $('#message').hide();
	}
}

//////USER COMPLETE RESET PASSWORD FUNCTION////////
function _completeResetPassword(staff_id) {
	const password = $('#password').val();
	const confirm_password = $("#confirm_password").val();

	$('#password, #confirm_password').removeClass("issue");

	if (!password) {
		$('#password').addClass('issue');
		_actionAlert('Provide Password To Continue', false);	

	} else if (!confirm_password) {
		$('#confirm_password').addClass('issue');
		_actionAlert('Provide Password To Continue', false);

	} else if (password!=confirm_password) {
		$('#password, #confirm_password').addClass('issue');
		_actionAlert('Provide Password Not Match', false);

	} else if (password.length < 8) {
		_actionAlert('Password Not Accepted, Please follow the instructon', false);

	} else if (password.match(/^(?=[^A-Z]*[A-Z])(?=[^!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])(?=\D*\d).{8,}$/ )){

		$('#password, #confirm_password').removeClass("issue");

		//////////////// get btn text ////////////////
		const btn_text = $("#confirmed_reset_btn").html();
		$("#confirmed_reset_btn").html('<img src="../all-images/images/loading.gif" width="15px" alt="Loading"/> Resetting');
		document.getElementById("confirmed_reset_btn").disabled = true;
		////////////////////////////////////////////////

		const dataString = "&staff_id=" + staff_id + "&password=" + password + "&confirm_password=" + confirm_password;
		$.ajax({
			type: "POST",
			url: endPoint + '/admin/auth/create-new-password',
			data: dataString,
			cache: false,
			dataType: "json",
			cache: false,
			headers: {
			'apiKey': apiKey
		        },
			success: function (data) {
				const success = data.success;
				const message = data.message;
			
				if (success == true) {
					_actionAlert(message, true);
					_passwordResetSuccesful("password_reset_successful");
				} else {
					_actionAlert(message, false);				
				}	
				$("#confirmed_reset_btn").html(btn_text);
				document.getElementById("confirmed_reset_btn").disabled = false;	
			},
			error: function (error) {
				console.log(error);
				_actionAlert('An error occurred. Please try again', false);	
				$("#confirmed_reset_btn").html(btn_text);
				document.getElementById("confirmed_reset_btn").disabled = false;
			}
		});
	} else {
		$('#password, #confirm_password').addClass("issue");
		_actionAlert('Password Not Accepted, Please follow the instructon', false);
  	}
}