<?php if($page=='otpForm'){?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
           <div class="title"><i class="bi-person-fill-lock"></i> OTP AUTHENTICATION</div>
           <button class="close-btn" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeInRight">
            <div class="alert alert-success login-form-alert"> <i class="bi-person"></i> Hi, an <span>OTP</span> has been sent to your email address (<span id="useremail">seunemmanuel107@gmail.com</span>) to login. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>
            <div class="text_field_container" id="otp_container">
                <script>
                    textField({
                        id: 'otp',
                        title: 'Enter OTP',
                        type: 'number',
                        onkeypress: 'isNumber_Check(event)'
                    });
                </script> 
            </div>
            <button class="btn" type="button" id="submit_btn"  title="Proceed" onclick=""><i class="bi-check"></i> PROCEED </button>
            <div id="resendCountdown">Resend in <strong id="timer">30</strong> Sec</div>
            <div id="resendOtpBtn" onclick="_confirmLoginEmail();"><strong>Resend OTP</strong></div>
        </div>
    </div>
    <script>_counDownOtp(30)</script>
<?php }?>