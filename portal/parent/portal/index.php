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
                            <h2>👋 Hi, Mr. Afolabi Oluwagbenga </h2>
                            <div class="info">
                                <div class="info-details">
                                    <p><span id="">sunaf4real@gmail.com</span></p> | <p><span id="">08131252996</span></p>
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
                <div class="list">

                    <div class="student-profile">
                        <div class="details">
                            <div class="pix"><img src="<?php echo $websiteUrl?>/images/student1.jpg" alt="Paul Emmanuel James" /></div>
                            <div class="text">
                                <h3>Paul Emmanuel James</h3>
                                <div class="info">
                                    <p>Class: <span>JSS 1</span> - Arm: <span>A</span></p>
                                    <button class="status-btn archive">ARCHIVE</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn" onClick="_getForm({page: 'student_profile', url: parentPortalLocalUrl});">VIEW DETAILS</button>
                    </div>

                    <div class="student-profile">
                        <div class="details">
                            <div class="pix"><img src="<?php echo $websiteUrl?>/images/student2.jpg" alt="Paul Samson James" /></div>
                            <div class="text">
                                <h3>Paul Samson James</h3>
                                <div class="info">
                                    <p>Class: <span>JSS 1</span> - Arm: <span>A</span></p>
                                    <button class="status-btn active">ACTIVE</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn">VIEW DETAILS</button>
                    </div>

                    <div class="student-profile">
                        <div class="details">
                            <div class="pix"><img src="<?php echo $websiteUrl?>/images/student2.jpg" alt="Profile Picture" /></div>
                            <div class="text">
                                <h3>Yakubu Ezekiel Jairus</h3>
                                <div class="info">
                                    <p>Class: <span>JSS 1</span> - Arm: <span>A</span></p>
                                    <button class="status-btn graduated">GRADUATED</button>
                                </div>
                            </div>
                        </div>
                        <button class="btn">VIEW DETAILS</button>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <?php include '../bottom-scripts.php' ?>
</body>

</html>