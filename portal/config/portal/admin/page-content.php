<?php if($page=='login'){?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
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
<?php }?>

<?php if($page=='forget-password'){?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <h1> Administrative <span>Reset Password</span></h1>                   

            <div class="alert alert-success login-form-alert">
                Kindly, provide your <span>Email Address</span> to reset your password
            </div>
            
            <div class="text_field_container" id="resetEmail_container">
                <script>
                    textField({
                        id: 'resetEmail',
                        title: 'Enter Your Email Address',
                        type: 'email'
                    });
                </script>
            </div>

            <button class="btn" id="" title="Proceed" onclick="_getPage({page: 'send-link-mail', url: adminLocalUrl});">Proceed <i class="bi-arrow-right"></i></button>
        </div>
    </div>
<?php }?>

<?php if($page=='send-link-mail'){?>
    <div class="form-div animated fadeIn" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inner-form">
            <div class="top-div">
                <div class="icon-div"><i class="bi-check2-circle"></i></div> 
                <h3>Mail sent successfully</h3>
            </div>
           
            <div class="alert alert-success login-form-alert"><i class="bi-person"></i> Dear <strong>Paul Emmanuel</strong>, 
                a link has been sent to your email address (<strong>seunemmanuel107@gmail.com</strong>) 
                to reset your password. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.
            </div>

            <button class="btn" type="button" id="submit_btn" title="Okay" onclick="location.href='<?php echo $websiteUrl?>/portal/admin/reset-password'"> 
                OKAY <i class="bi-check2-all"></i>
            </button>                          
            <div class="notification"><strong>MAIL</strong> not received? <span><i class="bi-send"></i> <strong> RESEND MAIL </strong></span></div>                             
        </div>
    </div>
<?php }?>