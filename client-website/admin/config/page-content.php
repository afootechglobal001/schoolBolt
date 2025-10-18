
<?php if($page=='login'){?>
    <div class="login-div-in animated fadeIn" id="view_login">               
        <h1>Administrative Portal</h1>
        <p>Welcome! Please enter your details</p>  
                    
        <div class="text_field_container">
            <input class="text_field" type="email" id="username" placeholder=""/>
            <div class="placeholder">Enter Your Email Address:</div>
        </div>

        <div class="text_field_container">
            <input class="text_field" type="password" id="password" placeholder=""/>                 
            <div class="placeholder">Enter Your Password:</div>
        </div>
        <div class="btn-div">
            <button class="btn" id="submit_btn" title="LOG-IN" onclick="_confirmLogin();"> LOG-IN <i class="bi-arrow-right"></i></button>
            <div class="notification-div">
                <span title="Forgot Password" onclick="_next_page('reset_password_info');"> Forgot Password? </span>
            </div>
        </div>      
    </div>    

    <div id="reset_password_info"> 
        <div class="login-div-in animated fadeIn">               
            <h1><i class="bi-shield-lock-fill"></i> Reset Password</h1>
            <p>Provide your Email Address to reset your password</p>  
                        
            <div class="text_field_container">
                <input class="text_field" type="email" id="email" placeholder=""/>
                <div class="placeholder">Enter Your Email Address:</div>
            </div>

            <div class="btn-div">
                <button class="btn" id="proceed_btn" title="Proceed" onclick="_resetPassword();"> Proceed <i class="bi-arrow-right"></i></button>
                <div class="notification-div">
                    <span title="Already have an account" onclick="_next_page('view_login');"> Already have an account? </span>
                </div>
            </div> 
        </div>
    </div> 
    
    <div id="send_link_info"> 
        <div class="login-div-in animated fadeIn">    
            <div class="icon-div"><i class="bi-check2-circle"></i></div> 
            <h3>Mail sent successfully</h3>
            <p><i class="bi-person"></i> Dear <strong id="user_fullname">xxxx</strong>, 
                a link has been sent to your email address (<strong id="user_email">xxxx</strong>) 
                to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.
            </p>
            <div class="btn-div">
                <button class="btn" type="button" id="submit_btn" title="Okay" onclick="location.href='<?php echo $website_url?>/admin'"> 
                    OKAY <i class="bi-check2-all"></i>
                </button>                          
                <div class="notification"><strong>MAIL</strong> not received? <span id="resendOtpBtn"><i class="bi-send"></i> <strong> RESEND MAIL </strong></span> <span id="resendCountdown">Resend in <strong id="timer">30</strong> Sec</span></div>                             
            </div> 
        </div>
    </div>
<script> _counDownOtp(40);</script>
<?php }?>


<?php if ($page=='reset_password'){?>
    <div class="login-div-in animated fadeIn">               
        <h1><i class="bi-shield-lock-fill"></i> Reset Password</h1>
        <p>Provide your new and confirm password to reset your password</p>  
                    
        <div class="text_field_container">
            <input class="text_field" type="password" id="password" placeholder=""/>                 
            <div class="placeholder">Create New Password:</div>
        </div>
        <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>
       
        <div class="text_field_container">
            <input class="text_field" type="password" id="confirm_password" placeholder=""/>                 
            <div class="placeholder">Comfirm New Password:</div>
        </div>
        <div class="btn-div">
            <button class="btn" title="Reset Password" id="confirmed_reset_btn" onclick="_completeResetPassword('<?php echo $staff_id?>');"><i class="bi-check"></i> Reset Password </button>
            <div id="message">Password Not Matched!</div>
        </div>
    </div>   
<?php } ?>


<?php if($page=='password_reset_successful'){?>
    <div class="successful-div animated bounceInDown">
        <div class="success-in">
            <div class="gif">
                <img src="<?php echo $website_url?>/all-images/images/success.gif" alt="successful gif">
            </div>
            <h3>PASSWORD RESET SUCCESSFULLY</h3>
            <button class="btn" onclick="location.href='<?php echo $website_url?>/admin'">OKAY <i class="bi-check2-all"></i></button>
        </div> 
    </div>
<?php }?>