<?php include '../config/constants.php';?>
<?php $ref = $_GET['ref']; ?>
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
                        <a href="<?php echo $websiteUrl ?>"><img src="<?php echo $websiteUrl?>/images/logo.png" alt="<?php echo $appName?> Logo"  class="animated zoomIn"/></a>   
                    </div>

                    <ul>
                        <li onclick="location.href='<?php echo $websiteUrl?>/admin/login'">Back to Login</li>
                    </ul>
                </div>

                <div class="form-back-div">
                    <div id="page-content">
                        <script>_verifyLink('<?php echo $ref?>');</script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php'?>
</body>
</html>


