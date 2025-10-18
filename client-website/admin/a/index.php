<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include '../../config/constants.php';?>
<?php include 'config/welcome_profile.php'?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<title>Administrative Portal | <?php echo $thename;?></title>
</head>
<body>

    <?php include 'header.php'?>
    <?php include 'side-bar.php'?>

    <div class="content-div">
        <div class="inner-content">
            <?php $callclass->_UserWelcomeProfile($website_url);?>
            
            <div id="page-content">
                <script>_get_page('dashboard')</script>	
            </div> 
        </div>
    </div>

    <div class="side-div-right" data-aos="fade-in" data-aos-duration="1000">
        <div class="alert-dashboard-title"><div><i class="bi-bell"></i> Recent Activities</div> <span>See All</span></div>
        <div class="alert-dashboard-div animated ZoomIn" id="fetchDashboardAlert">
            <script>_fetchDashboardAlert();</script>
            
            <!-- <div class="system-alert" id="'+ alert_id +'" onClick="_get_form('alert-read');">
                <div class="alert-name"><i class="bi-person"></i> Hon. Paul Emmanuel<span><i class="bi-check"></i></span></div>
                <div class="alert-text">Success Alert: uccess Alert: LOGIN ALERT: A user whose name is AFOLABI ABAYOMI with ...</div>
                <div class="alert-time"><i class="bi-clock"></i> <span> 2024-09-15 13:46:42</span></div>
            </div>   -->
        </div>
    </div>
    <?php include 'bottom-scripts.php'?>
</body>
</html>


