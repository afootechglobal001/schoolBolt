<?php include '../../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Parent Login</title>
    <meta name="keywords" content="Parent Login  - <?php echo $appName ?>" />
    <meta name="description" content="Parent Login - <?php echo $appName ?>" />
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-session">
        <div class="login-div">
            <header class="animated fadeInDown">
                <div class="header-div-in">
                    <div class="logo-div">
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="<?php echo $clientName ?> Logo"
                                class="animated zoomIn" /></a>
                    </div>

                    <ul>
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <li>Back to website</li>
                        </a>
                    </ul>
                </div>
            </header>

            <div class="form-back-div">
                <div id="page-content">
                        <?php include $websitePath . '/student/login/config/content-page.php'; ?>
                    </div>
                <script>
                    $(document).ready(function () {
                        let savedPage = sessionStorage.getItem("currentAuthPage") ?? "loginPage";

                        _getPage({
                            page: savedPage,
                            url: cbtStudentLoginMiddleWareUrl
                        });
                    });
                </script>
            </div>
        </div>
        <div class="graphics-div">
            <div class="content" data-aos="fade-left" data-aos-duration="800">
                <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img
                        src="<?php echo $websiteUrl ?>/all-images/images/check-result.png" alt="ABCC Result checker" /></div>
                <h2>Access your CBT exam<br> <span>at Your Fingertips!</span></h2>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php' ?>
</body>
</html>