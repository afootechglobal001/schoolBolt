<?php include '../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php include 'meta.php'?>
    <title><?php echo $thename?>  | Adminstrative Login</title>
    <meta name="keywords" content="Adminstrative Login - <?php echo $thename?>" />
    <meta name="description" content="Adminstrative Login <?php echo $thename?>"/>
</head>
<body>
    <?php  include 'alert.php'?>

    <section class="login-section">
        <div class="login-over-lay login-blur"></div>
        <div class="login-container">
            <div class="login-left-content" data-aos="fade-in" data-aos-duration="1500">
                <div class="logo-div">
                    <a href="<?php echo $website_url ?>">
                        <img src="<?php echo $website_url?>/all-images/images/logo.png" alt="<?php echo $thename?> Logo" class="animated zoomIn"/>
                    </a>
                </div>
                
                <div class="inner-div">
                    <h2>Welcome to Ar-Rahman Montessori Schools Administrative Portal</h2>
                    <p>Where we inspire young minds, foster creativity, and empower students to reach their full potential.</p>
                </div>
            </div>

            <div class="login-div" data-aos="fade-right" data-aos-duration="1400">
                <?php $page='login';?>
                <?php include 'config/page-content.php';?>
            </div>
        </div>
    </section>
    <?php include '../bottom-scripts.php'?>
</body>
</html>


