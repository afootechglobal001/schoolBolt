<?php include '../config/constants.php'; ?>
<?php include 'config/functions.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Complete Reset Password</title>
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-div">
        <?php _leftSideSection($websiteUrl, $appName); ?>

        <div class="login-card-div">
            <script>
                $(document).ready(function () {
                    saveAcceesKeySession = JSON.parse(localStorage.getItem("saveAcceesKeySession"));
                    if (!saveAcceesKeySession) {
                       window.location.replace(adminUrl);
                        return;
                    }

                    window.history.pushState(null, "", window.location.href);
                    window.addEventListener("popstate", function () {
                        window.location.replace(adminUrl);
                    });
                });
	        </script>
            <div class="form-section" data-aos="fade-in" data-aos-duration="1200">
                <a href="<?php echo $websiteUrl ?>">
                <div class="logo-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="Logo">
                </div></a>

                <div class="form-back-div">
                    <div class="form-div" data-aos="fade-in" data-aos-duration="1200">
                        <h1> Complete <span>Reset Password!</span></h1>
                        <p>Kindly, provide your new password to reset your password.</p>
                        
                        <div class="inner-form" id="viewCompleteResetPassword">
                            <div class="text_field_container" id="password_container">
                                <script>
                                    textField({
                                        id: 'password',
                                        title: 'Enter Your New Password',
                                        type: 'password'
                                    });
                                </script>
                            </div>

                            <div class="text_field_container" id="confirmPassword_container">
                                <script>
                                    textField({
                                        id: 'confirmPassword',
                                        title: 'Confirm Your New Password',
                                        type: 'password'
                                    });
                                </script>
                            </div>

                            <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

                            <div class="btn-div">
                                <button class="btn" id="submitBtn" title="Reset Password" onclick="_completeResetPassword();">Reset Password <i class="bi bi-arrow-counterclockwise"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-container">
                <p>
                   &copy; <?php echo date('Y'); ?> <?php echo $appName ?> Admin Portal. All rights reserved.
                </p>
            </div>  
        </div>
    </section>
    <?php include 'bottom-scripts.php' ?>
</body>

</html>