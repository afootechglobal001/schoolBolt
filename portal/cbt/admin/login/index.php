<?php include '../../config/constants.php'; ?>
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
        <div class="login-image-div">
            <div class="image-overlay"></div>
            <div class="logo-div">
                <a href="<?php echo $clientWebsiteUrl ?>">
                <img src="<?php echo $websiteUrl ?>/all-images/images/icon.png" alt="<?php echo $appName ?> Icon"></a>
            </div>
            <div class="bottom-container">
                <h1>
                    <?php echo $appName ?> -
                    <span>Portal</span>
                </h1>
                <p>
                    Manage <?php echo $appName ?> through your secure centralized management portal.
                </p>
            </div>
        </div>

        <div class="login-card-div">
            <div class="form-section" data-aos="fade-in" data-aos-duration="1200">
                <a href="<?php echo $clientWebsiteUrl ?>">
                <div class="logo-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="Logo">
                </div></a>

                <div class="form-back-div">
                    <div class="form-div" data-aos="fade-in" data-aos-duration="1200">
                        <h1> Welcome <span>Back!</span></h1>
                        <p>Sign in to access the <?php echo $appName ?> Portal and manage your school CBT operations.</p>

                        <div class="inner-form" id="viewLogin">
                            <div class="text_field_container" id="userName_container">
                                <script>
                                    textField({
                                        id: 'userName',
                                        title: 'Email Address'
                                    });
                                </script>
                            </div>

                            <div class="text_field_container" id="password_container">
                                <script>
                                    textField({
                                        id: 'password',
                                        title: 'Password',
                                        type: 'password'
                                    });
                                </script>
                            </div>

                            <div class="btn-div">
                                <button class="btn" id="submitBtn" title="Log In" onclick="_confirmCbtAdminLogin();">Log In <i class="bi bi-arrow-right-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-container">
                <p>
                   &copy; <?php echo date('Y'); ?> <?php echo $appName ?> Management Portal. All rights reserved.
                </p>
            </div>  
        </div>
    </section>
    <?php include 'bottom-scripts.php' ?>
</body>

</html>