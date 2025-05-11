<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include '../config/constants.php'; ?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title>Parent Portal | <?php echo $appName; ?></title>
</head>

<body>
    <?php include 'header.php' ?>

    <div class="body-content-div" data-aos="fade-down" data-aos-duration="1200">
        <div class="mini-profile-div">
            <div class="profile-content">
                <span><i class="bi-speedometer2"></i> Parent Dashboard</span>
                <div class="main-profile">
                    <div class="inner-profile">
                        <div class="img-div"><img src="<?php echo $websiteUrl ?>/images/avatar.jpg" alt="Parent Profile" /></div>
                        <div class="pro-text-div">
                            <h2 id="fullName">👋 Hi, <span id="fullNameText"></span></h2>
                            <script>$("#fullNameText").html(capitalizeFirstLetterOfEachWord(parentLoginData.titleId + ' ' + parentLoginData.surName + ' ' + parentLoginData.otherNames));</script>
                            <div class="info">
                                <div class="info-details">
                                    <p><span id="email"><script>$("#email").html(parentLoginData.email);</script></span></p> | <p><span id="mobileNumber"><script>$("#mobileNumber").html(parentLoginData.mobileNumber);</script></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-div">
            <div class="dashboard-content">
                <h2>Student's List</h2>
                <div class="list" id="pageContent">
                    <script>_getFetchStudents();</script>
                </div>
            </div>
        </div>
    </div>
    <?php include '../bottom-scripts.php' ?>
</body>

</html>