<?php if($page=='login'){?>
    <div class="form-div" data-aos="fade-in" data-aos-duration="1200">
		<h1> Welcome <span>Back!</span></h1>
		<p>Sign in to access the <?php echo $appName ?> Admin Portal and manage your projects, operations, and company resources.</p>

		<div class="inner-form" id="viewLogin">
			<div class="text_field_container" id="userName_container">
				<script>
					textField({
						id: 'userName',
						title: 'Email Address'
					});
				</script>
			</div>

			<div class="text_field_container" id="password_container">
				<script>
					textField({
						id: 'password',
						title: 'Password',
						type: 'password'
					});
				</script>
			</div>

			<div class="forgot-pass-container">
				<div class="checkbox-container">
					<input type="checkbox" id="rememberMe">
					<label for="rememberMe">Remember Me</label>
				</div>

				<div class="forgot-container">
					<span onclick="_nextAdminLoginPage({page: 'forgetPassword'});">Forgot Password?</span>
				</div>
			</div>

			<div class="btn-div">
				<button class="btn" id="submitBtn" title="Log In" onclick="_confirmLogin();">Log In <i class="bi-arrow-right"></i></button>
			</div>
		</div>
    </div>
<?php }?>

<?php if($page=='forgetPassword'){?>
	<div class="form-div" data-aos="fade-in" data-aos-duration="1200">
		<h1> Administrative <span>Reset Password!</span></h1>
		<p>Kindly, provide your email address to reset your password.</p>
		
        <div class="inner-form" id="viewResetPassword">
            <div class="text_field_container" id="emailAddress_container">
                <script>
                    textField({
                        id: 'emailAddress',
                        title: 'Enter Your Email Address',
                        type: 'email'
                    });
                </script>
            </div>

			<div class="btn-div">
            	<button class="btn" id="proceedBtn" title="Proceed" onclick="_proceedResetPassword();">Proceed <i class="bi-arrow-right"></i></button>
			</div>
            <div class="reset-password">
                Already have an account? <span onclick="_nextAdminLoginPage({page: 'login'});">Login Here</span>
            </div>
        </div>
    </div>
<?php }?>

<?php if($page=='otpPage'){?>
	<script>
		$(document).ready(function () {
			let staffResetPasswordSession = JSON.parse(localStorage.getItem("staffResetPasswordSession"));
			if (!staffResetPasswordSession) {
				window.location.href = adminUrl;
				return;
			}

			$("#fullName").html(staffResetPasswordSession?.fullName);
			$("#userEmailAddress").html(staffResetPasswordSession?.emailAddress);
		});
	</script>

	<div class="form-div" data-aos="fade-in" data-aos-duration="1200">
		<h1> Reset Password <span>OTP!</span></h1>
		<div class="alert alert-success form-alert-div"> <i class="bi-person"></i> Hi, <span id="fullName"></span>,	
			an <span>OTP</span> has been sent to your email address (<span id="userEmailAddress"></span>). Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to
			confirm.
		</div>
		
        <div class="inner-form" id="viewOtpPassword">
            <div class="otp-container" id="otp_container">
                <script>
                    otpField({
						id: "otp",
						length: 6,
						onKeyPressFunction: 'isNumberCheck(event);',
					});
                </script>
            </div>

			<div class="forgot-pass-container">
				<div class="forgot-container">
					Didn't get the OTP?
					<button title="Resend OTP" class="resendOtpBtn" id="resendOtpBtn" onclick="_proceedResetPassword(true);"><strong>Resend OTP</strong></button>
                    <div id="resendCountdown"></div>
				</div>
			</div>

			<div class="btn-div">
            	<button class="btn" id="verifyBtn" title="Proceed" onclick="_proceedOtpVerification();">Proceed <i class="bi-arrow-right"></i></button>
			</div>
			<div class="reset-password">
                Already have an account? <span onclick="window.location.href = adminUrl;">Login Here</span>
            </div>
        </div>
    </div>
	<script>
		_counDownOtp(180);
	</script>
<?php }?>