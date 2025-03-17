<?php include '../config/constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | School Portal</title>
    <meta name="keywords" content="<?php echo $appName ?> School portal, <?php echo $appName ?> Student login, <?php echo $appName ?> Parent portal, <?php echo $appName ?> Online school system, <?php echo $appName ?> Staff dashboard, <?php echo $appName ?> School management software, <?php echo $appName ?> Student records access, <?php echo $appName ?> Fee payment system, Academic results portal, <?php echo $appName ?> Secure school login" />
    <meta name="description" content="Access your school's portal for student records, fees, results, and communication. Secure login for administrators, staff, parents, and students. Stay connected easily! - <?php echo $appName ?>" />

    <meta property="og:title" content="<?php echo $appName ?> | School Portal" />
    <meta property="og:image" content="<?php echo $websiteUrl ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta property="og:description" content="Access your school's portal for student records, fees, results, and communication. Secure login for administrators, staff, parents, and students. Stay connected easily!." />

    <meta name="twitter:title" content="<?php echo $appName ?> | School Portal" />
    <meta name="twitter:card" content="<?php echo $appName ?>" />
    <meta name="twitter:image" content="<?php echo $websiteUrl ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta name="twitter:description" content="Access your school's portal for student records, fees, results, and communication. Secure login for administrators, staff, parents, and students. Stay connected easily!" />
</head>

<body>
    <?php include 'alert.php' ?>
    <section class="login-session">
        <div class="login-div">
            <header>
                <div class="header-div-in">
                    <div class="logo-div">
                        <a href="<?php echo $websiteUrl ?>" title="<?php echo $appName ?>">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="<?php echo $appName ?> Logo" class="animated zoomIn" /></a>
                    </div>

                    <!-- <div class="logo-div icon-div">
                       <img src="https://schoolbolt.com/all-images/images/icon.png" alt="SchoolBol Icon" class="animated zoomIn"/>
                    </div> -->

                </div>
            </header>

            <div class="form-back-div" data-aos="fade-in" data-aos-duration="1500">
                <div class="form-div">
                    <h1> Welcome to School Database Management System 😊</h1>

                    <div class="portal-list-back-div">
                        
                        <div class="portal-list-div">
                            <div class="div-in">
                                <div class="icon-div"><i class="bi-person-vcard"></i></div>
                                <div class="text-div">
                                    <h4>Admin Portal</h4>
                                    <p>An administrator manages users, data, security, and system operations in a school DBMS.</p>
                                </div>
                            </div>

                            <div class="bottom-div">
                                <a href="<?php echo $websiteUrl ?>/portal/admin/login" title="<?php echo $appName ?>">
                                <div class="count-div"><i class="bi-arrow-right-circle-fill"></i>&nbsp; Login Here</div></a>
                            </div>
                        </div>

                        <div class="portal-list-div">
                            <div class="div-in">
                                <div class="icon-div"><i class="bi-arrow-right-circle-fill"></i></div>
                                <div class="text-div">
                                    <h4>Staff Portal</h4>
                                    <p>A staff member updates records, manages student data, and assists operations.</p>
                                </div>
                            </div>

                            <div class="bottom-div">
                            <a href="<?php echo $websiteUrl ?>/portal/staff/login" title="<?php echo $appName ?>">
                            <div class="count-div"><i class="bi-arrow-right-circle-fill"></i>&nbsp; Login Here</div></a>
                            </div>
                        </div>

                        
                        <div class="portal-list-div">
                            <div class="div-in">
                                <div class="icon-div"><i class="bi-credit-card-fill"></i></div>
                                <div class="text-div">
                                    <h4>Bursary Portal</h4>
                                    <p>A bursary staff manages fees, payments, financial records, and student billing.</p>
                                </div>
                            </div>

                            <div class="bottom-div">
                            <a href="<?php echo $websiteUrl ?>/portal/account/login" title="<?php echo $appName ?>">
                            <div class="count-div"><i class="bi-arrow-right-circle-fill"></i>&nbsp; Login Here</div></a>
                            </div>
                        </div>


                        <div class="portal-list-div">
                            <div class="div-in">
                                <div class="icon-div"><i class="bi-mortarboard-fill"></i></div>
                                <div class="text-div">
                                    <h4>Student Portal</h4>
                                    <p>A student accesses records, views grades, and updates personal information.</p>
                                </div>
                            </div>

                            <div class="bottom-div">
                                <a href="<?php echo $websiteUrl ?>/portal/student/login" title="<?php echo $appName ?>">
                                <div class="count-div"><i class="bi-arrow-right-circle-fill"></i>&nbsp; Login Here</div></a>
                            </div>
                        </div>

                        <div class="portal-list-div">
                            <div class="div-in">
                                <div class="icon-div"><i class="bi-people-fill"></i></div>
                                <div class="text-div">
                                    <h4>Parent Portal</h4>
                                    <p>A parent monitors student progress, pay fees, views reports, and communicates with staff.</p>
                                </div>
                            </div>

                            <div class="bottom-div">
                            <a href="<?php echo $websiteUrl ?>/portal/parent/login" title="<?php echo $appName ?>">
                            <div class="count-div"><i class="bi-arrow-right-circle-fill"></i>&nbsp; Login Here</div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="graphics-div"></div>
    </section>

    <?php include 'bottom-scripts.php' ?>
</body>

</html>