<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
    <title><?php echo $appName ?> | Student Authentication</title>
    <meta name="keywords" content="Student Authentication  - <?php echo $appName ?>" />
    <meta name="description" content="Student Authentication - <?php echo $appName ?>" />
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
                        <h1>👋 Hi Student<br><span>It’s really nice to see you</span></h1>
                    </div>

                    <div class="inner-form" id="viewLogin">
                        <div class="login-action-wrapper">
                            <a href="<?php echo $websiteUrl ?>/student/apply-for-admission" title="Apply For Admission">
                                <div class="login-action-div">
                                    <h3>Apply For Admission</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            <a href="<?php echo $websiteUrl ?>/student/entrance-examination"
                                title="Start Entrance Examination">
                                <div class="login-action-div">
                                    <h3>Start Entrance Examination</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            <a href="<?php echo $websiteUrl ?>/student/pay-school-fees" title="Pay School Fees">
                                <div class="login-action-div">
                                    <h3>Pay your School Fees</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            <a href="<?php echo $websiteUrl ?>/student/verify-result" title="View your Result">
                                <div class="login-action-div">
                                    <h3>View Your Terminal Result</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            <a href="<?php echo $websiteUrl ?>/student/login" title="Login To Student Portal">
                                <div class="login-action-div">
                                    <h3>Login To Student Portal</h3>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>


                        </div>
                    </div>
                    <p>Need Help? <a href="<?php echo $clientWebsiteContactUsUrl ?>" title="Contact Us"><span>Contact
                                Us</span></a></p>
                </div>
            </div>
        </div>
        <div class="graphics-div">
            <div class="content" data-aos="fade-left" data-aos-duration="800">
                <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img
                        src="<?php echo $websiteUrl ?>/images/check-result.webp" alt="ABCC Result checker" /></div>
                <h2>Access your education<br> <span>at Your Fingertips!</span></h2>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php' ?>
</body>

</html>