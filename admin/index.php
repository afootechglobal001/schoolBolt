<?php include '../config/constants.php'; ?>
<?php include 'config/functions.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Admin Portal</title>
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-div">
        <?php _leftSideSection($websiteUrl, $appName); ?>

        <div class="login-card-div">
            <div class="form-section" data-aos="fade-in" data-aos-duration="1200">
                <a href="<?php echo $websiteUrl ?>">
                <div class="logo-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="Logo">
                </div></a>

                <div class="form-back-div">
                    <div id="page-content">
                        <?php $page='login';?>
                        <?php include $websitePath.'/admin/config/content-page.php';?>
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