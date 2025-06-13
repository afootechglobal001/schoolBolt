<?php if ($page == 'login') { ?>
    <div class="form-div animated fadeIn" id="viewLogin" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <h1> 👋 Administrative <span>Log-In</span></h1>

            <div class="alert alert-success login-form-alert">
                Kindly, provide your <span>Email Address</span> to Login
            </div>

            <div class="text_field_container" id="userName_container">
                <script>
                    textField({
                        id: 'userName',
                        title: 'Enter Your Email Address'
                    });
                </script>
            </div>

            <div class="text_field_container" id="password_container">
                <script>
                    textField({
                        id: 'password',
                        title: 'Enter Your Password',
                        type: 'password'
                    });
                </script>
            </div>

            <button class="btn" id="submit_btn" title="Log In" onclick="_confirmLogin();">Log In <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'forget-password') { ?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <h1> Administrative <span>Reset Password</span></h1>

            <div class="alert alert-success login-form-alert">
                Kindly, provide your <span>Email Address</span> to reset your password
            </div>

            <div class="text_field_container" id="email_container">
                <script>
                    textField({
                        id: 'email',
                        title: 'Enter Your Email Address',
                        type: 'email'
                    });
                </script>
            </div>

            <button class="btn" id="proceedBtn" title="Proceed" onclick="_proceedResetPassword();">Proceed <i class="bi-arrow-right"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'send-link-mail') { ?>
    <script>
        staffEmailSession = JSON.parse(sessionStorage.getItem("staffEmailSession"));
    </script>

    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <div class="top-div">
                <div class="icon-div"><i class="bi-check2-circle"></i></div>
                <h3>Mail sent successfully</h3>
            </div>

            <div class="alert alert-success login-form-alert"><i class="bi-person"></i> Dear <strong id="fullName">
                    <script>
                        $("#fullName").html(staffEmailSession.fullName);
                    </script>
                </strong>,
                a link has been sent to your email address (<strong id="email">
                    <script>
                        $("#email").html(staffEmailSession.email);
                    </script>
                </strong>)
                to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.
            </div>

            <button class="btn" type="button" id="submit_btn" title="Okay" onclick="location.href='<?php echo $websiteUrl ?>/admin/login'">
                OKAY <i class="bi-check2-all"></i>
            </button>
            <div class="notification"><strong>MAIL</strong> not received? <span><i class="bi-send"></i> <button class="resend-btn" id="resendBtn" onclick="_proceedResetPassword(staffEmailSession.email, 'resendBtn');"><strong title="RESEND MAIL">RESEND MAIL</strong> </button></span></div>
        </div>
    </div>
    <script> sessionStorage.removeItem("staffEmailSession");</script>
<?php } ?>


<?php if ($page == 'complete-reset-password') { ?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <h1> Complete Reset <span>Password</span></h1>
            <div class="alert alert-success login-form-alert">
                Kindly, Provide <span>New Password</span> to reset your password
            </div>

            <div class="text_field_container" id="newPassword_container">
                <script>
                    textField({
                        id: 'newPassword',
                        title: 'Create New Password',
                        type: 'password'
                    });
                </script>
            </div>

            <div class="text_field_container" id="cnewPassword_container">
                <script>
                    textField({
                        id: 'cnewPassword',
                        title: 'Confirm New Password',
                        type: 'password'
                    });
                </script>
            </div>

            <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

            <button class="btn" title="Reset Password" id="completeBtn" onclick="_completeResetPassword();">
                Reset Password <i class="bi bi-arrow-counterclockwise"></i>
            </button>
        </div>
    </div>
<?php } ?>


<?php if ($page == 'verify-ref-response') { ?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <div class="top-div">
                <div class="icon-div red-icon"><i class="bi-exclamation-octagon"></i></div>
                <h3>Link Expired!</h3>
            </div>

            <div class="alert alert-failed login-form-alert">Kindly reset your password again or contact your <strong>Administrator</strong> to continue.</div>

            <button class="btn" type="button" id="submit_btn" title="Okay" onclick="location.href='<?php echo $websiteUrl ?>/admin/login'">
                OKAY <i class="bi-check2-all"></i>
            </button>
        </div>
    </div>
<?php } ?>