$(document).ready(function () {
	function trim(s) {
		return s.replace(/^\s*/, "").replace(/\s*$/, "");
	}
	$("#viewLogin").keydown(function (e) {
		if (e.keyCode == 13) {
			_confirmLogin();
		}
	});
});

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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

