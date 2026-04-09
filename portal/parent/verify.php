<?php include '../config/constants.php'; ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'auth-meta.php' ?>
    <title><?php echo $appName ?> | Parent OTP Verification</title>
    <meta name="keywords" content="Parent Parent OTP Verification   - <?php echo $appName ?>" />
    <meta name="description" content="Parent Parent OTP Verification - <?php echo $appName ?>" />
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-session">
        <script>
            $(document).ready(function () {
                let parentProceedLoginSession = JSON.parse(localStorage.getItem("parentProceedLoginSession"));
                if (!parentProceedLoginSession) {
                    window.location.href = parentLoginUrl;
                }

                $("#parentFullname").html(parentProceedLoginSession.parentFullname);
                $("#email").html(parentProceedLoginSession.email);
            });
        </script>
        <div class="login-div">
            <header class="animated fadeInDown">
                <div class="header-div-in">
                    <div class="logo-div">
                        <a href="<?php echo $clientWebsiteUrl ?>" title="<?php echo $clientName ?>">
                            <img src="<?php echo $websiteUrl ?>/images/logo.png" alt="<?php echo $clientName ?> Logo"
                                class="animated zoomIn" /></a>
                    </div>

                    <ul>
                        <li onclick="window.location.href = parentLoginUrl"><i class="bi-arrow-left"></i> Go Back</li>
                    </ul>
                </div>
            </header>

            <div class="form-back-div">
                <div class="form-div" data-aos="fade-right" data-aos-duration="1600">
                    <div class="top-div">
                        <h1>🔐 OTP Verification</h1>
                    </div>

                    <div class="inner-form" id="viewOtp">
                        <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hi, <span
                                id="parentFullname">

                            </span>, an <span>OTP</span> has been sent to your email address (<span id="email">

                            </span>). Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to
                            confirm.
                        </div>

                        <div class="text_field_container" id="otp_container">
                            <script>
                                textField({
                                    id: 'otp',
                                    title: 'Enter OTP',
                                    type: 'number',
                                    onKeyPressFunction: 'isNumberCheck(event);',
                                    autocomplete: "off"
                                });
                            </script>
                        </div>

                        <button class="btn" title="Proceed" id="submitBtn" onclick="_proceedToLogin();">Proceed <i
                                class="bi-arrow-right"></i></button>

                        <div class="bottom-div">
                            <div>
                                <button class="resendOtpBtn" id="resendOtpBtn"
                                    onclick="_confirmLoginEmail(true);"><strong>Resend OTP</strong></button>
                            </div>
                            <div id="resendCountdown"></div>
                        </div>
                    </div>

                </div>
                <script>
                    _counDownOtp(180)
                </script>
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