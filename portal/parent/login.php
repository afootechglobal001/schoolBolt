<?php include '../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
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
                        <a href="<?php echo $clientWebsiteUrl?>" title="<?php echo $clientName ?>">
                        <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="<?php echo $clientName ?> Logo" class="animated zoomIn" /></a>
                    </div>

                    <ul>
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">            
                        <li>Back to website</li></a>
                    </ul>
                </div>
            </header>
            
            <div class="form-back-div">
                <div class="form-div" data-aos="fade-right" data-aos-duration="1600">
                    <div class="top-div">
                        <h1>👋 Hi Parent<br><span>It’s really nice to see you</span></h1>
                    </div>

                    <div class="inner-form" id="viewLogin">
                        <div class="alert alert-success login-form-alert">
                            Kindly, provide your <span>Login Details</span> to Proceed
                        </div>

                        <div class="text_field_container" id="parentTypeId_container">
                            <script>
                                selectField({
                                    id: 'parentTypeId',
                                    title: 'Select Parent Type'
                                });
                                _getSelectParentType('parentTypeId');
                            </script>
                        </div>

                        <div class="text_field_container" id="email_container">
                            <script>
                                textField({
                                    id: 'email',
                                    title: 'Parent Email'
                                });
                            </script> 
                        </div>

                        <button class="btn" title="Proceed" id="proceedLoginBtn" onclick="_confirmLoginEmail();">Proceed <i class="bi-arrow-right"></i></button>                                                                                                                    
                    </div>
                    <p>Need Help? <a href="<?php echo $clientWebsiteContactUsUrl ?>" title="Contact Us"><span>Contact Us</span></a></p>
                </div>
            </div>
        </div>
        <div class="graphics-div">
            <div class="content" data-aos="fade-left" data-aos-duration="800">
                <div class="graphics" data-aos="fade-left" data-aos-duration="1200"><img src="<?php echo $websiteUrl ?>/images/check-result.webp" alt="ABCC Result checker" /></div>
                <h2>Your Client's Education<br> <span>is at Your Fingertips!</span></h2>
            </div>
        </div>
    </section>

    <?php include '../bottom-scripts.php' ?>
</body>

</html>