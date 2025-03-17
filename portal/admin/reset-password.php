<?php include '../../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php'?>
    <title><?php echo $appName?>  | Adminstrative Reset Password</title>
    <meta name="keywords" content="Adminstrative Reset Password - <?php echo $appName?>" />
    <meta name="description" content="Adminstrative Reset Password <?php echo $appName?>"/>
</head>
<body>
    <?php  include 'alert.php'?>

    <section class="login-session">
        <div class="login-over-lay login-blur"></div>
        <div class="center-login-div">
            <div class="login-div-in">
                <div class="header-div animated fadeIn">
                    <div class="logo-div">
                        <a href="<?php echo $websiteUrl ?>"><img src="<?php echo $websiteUrl?>/all-images/images/logo.png" alt="<?php echo $appName?> Logo"  class="animated zoomIn"/></a>   
                    </div>

                    <ul>
                        <li onclick="location.href='<?php echo $websiteUrl?>/portal/admin/login'">Back to Login</li>
                    </ul>
                </div>

                <div class="form-back-div">
                    <div class="form-div animated fadeIn" id="view_login" data-aos="zoom-in" data-aos-duration="1200"> 
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

                            <div class="text_field_container" id="confirmPassword_container">
                                <script>
                                    textField({
                                        id: 'confirmPassword',
                                        title: 'Confirm New Password',
                                        type: 'password'
                                    });
                                </script>
                            </div>
                        
                            <div class="pswd_info"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

                            <button class="btn" title="Reset Password" onclick="_getForm({page:'password_reset_successful', url: adminLocalUrl});">
                                Reset Password <i class="bi bi-arrow-counterclockwise"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'bottom-scripts.php'?>
</body>
</html>


