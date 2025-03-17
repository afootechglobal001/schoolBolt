<?php include '../../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php'?>
    <title><?php echo $appName?> | Administrative Login</title>
    <meta name="keywords" content="Administrative Login  - <?php echo $appName?>"/>
    <meta name="description" content="Administrative Login - <?php echo $appName?>"/>
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
                        <li class="active-li" id="login_id" onclick="_nextLoginPage({divid:'login_id', page: 'login'});">Log-In</li>
                        <li id="reset_pass_id" onclick="_nextLoginPage({divid:'reset_pass_id', page: 'forget-password'});">Forgot Password?</li>
                        <li id="expand_li"><i class="bi-list-nested"></i>
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li id="login_id" onclick="_nextLoginPage({divid:'login_id', page: 'login'});">Log-In</li>
                                    <li id="reset_pass_id" onclick="_nextLoginPage({divid:'reset_pass_id', page: 'forget-password'});">Forgot Password?</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="form-back-div">
                    <div id="page-content">
                        <?php $page='login';?>
                        <?php include $websitePath.'/config/portal/admin/page-content.php';?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include 'bottom-scripts.php'?>
</body>
</html>


