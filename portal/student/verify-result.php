<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
    <title><?php echo $appName ?> | Parent Portal | Result Verification Portal</title>
    <meta name="keywords" content="Parent View Result  - <?php echo $appName ?>" />
    <meta name="description" content="Parent View Result - <?php echo $appName ?>" />
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
                        <h1>👋 Hi Student<br><span>This is result verification portal.</span></h1>
                    </div>

                    <div class="inner-form" id="viewLogin">
                        <div class="alert alert-success login-form-alert">
                            Kindly, provide your <span>Student ID</span> to Proceed
                        </div>

                        <div class="text_field_container" id="studentId_container">
                            <script>
                                textField({
                                    id: 'studentId',
                                    title: 'Student ID'
                                });
                            </script>
                        </div>

                        <button class="btn" title="Proceed" id="proceedResult"
                            onclick="_proceedViewStudentResult();">Proceed <i class="bi-arrow-right"></i></button>
                    </div>
                    <p><a href="<?php echo $websiteUrl ?>/parent/auth" title="Go Back" title="Go Back"><span><i
                                    class="bi-arrow-left"></i> Go Back</span></a></p>
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