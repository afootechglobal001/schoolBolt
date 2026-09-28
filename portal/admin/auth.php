<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
    <title><?php echo $appName ?> | Admin Authentication</title>
    <meta name="keywords" content="Admin Authentication  - <?php echo $appName ?>" />
    <meta name="description" content="Admin Authentication - <?php echo $appName ?>" />
    <link href="<?php echo $websiteUrl ?>/style/parent/auth-style.css?v=<?php echo $codeVersion ?>" type="text/css" rel="stylesheet" />
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-session">
        <div class="login-div">
            <header class="animated fadeInDown">
                <div class="header-div-in">
                    <div class="logo-div">
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="<?php echo $clientName ?> Logo"
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
                <div class="form-div" data-aos="fade-right" data-aos-duration="1600">
                    <div class="top-div">
                        <h1>👋 Welcome Back!<br><span>It’s really nice to see you</span></h1>
                    </div>

                    <div class="inner-form" id="viewLogin">
                        <div class="login-action-wrapper">
                            <a href="<?php echo $websiteUrl ?>/admin/login" title="<?php echo $appName ?>">
                                <div class="login-action-div" title="School Management">
                                    <h3>School Management</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>

                            <a href="<?php echo $websiteUrl ?>/cbt/admin/login" title="<?php echo $appName ?>">
                                <div class="login-action-div" title="Computer Based Test (CBT)">
                                    <h3>Computer Based Test (CBT)</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <p><span onclick="_goBack();"><i class="bi-arrow-left"></i> Go Back</span></p>
                </div>
            </div>
        </div>
        <div class="graphics-div">
            <div class="content" data-aos="fade-left" data-aos-duration="800">
                <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img
                        src="<?php echo $websiteUrl ?>/images/check-result.webp" alt="ABCC Result checker" /></div>
                <h2>Your Client's Education<br> <span>is at Your Fingertips!</span></h2>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php' ?>
</body>

</html>