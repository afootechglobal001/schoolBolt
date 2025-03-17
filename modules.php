<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include 'config/constants.php';?>
<?php include 'config/functions.php';?>
<html id="other-page-header" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Modules</title>
    <meta name="keywords" content="<?php echo $appName ?>, School Management Software in Nigeria, School Database System, School Administration Software, Basic and Secondary School Management, School Staff Management, Web Application for Schools, School Performance Tracking, Student Information System, Academic Record Management, School Scheduling Software, Nigerian School Software, SchoolBolt Features, Education Management System in Nigeria" />
    <meta name="description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />

    <meta property="og:title" content="<?php echo $appName ?> | School Database Management System in Nigeria" />
    <meta property="og:image" content="<?php echo $websiteUrl ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta property="og:description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />

    <meta name="twitter:title" content="<?php echo $appName ?> | School Database Management System in Nigeria" />
    <meta name="twitter:card" content="<?php echo $appName ?>" />
    <meta name="twitter:image" content="<?php echo $websiteUrl ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta name="twitter:description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />
</head>

<body>
    <?php  include 'header.php'?>

    <section class="other-pages other-body-div" data-aos="fade-down" data-aos-duration="800">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $websiteUrl?>"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a href="<?php echo $websiteUrl?>/modules"><li title="SchoolBolt Modules">SchoolBolt Modules</li></a>					
                    </ul>
                </div>			
            </div>

            <div class="main-content-back-div">
                <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                    <h1 data-aos="fade-in" data-aos-duration="800"><span>SchoolBolt Modules</span></h1>
                    <p>This project will follow top-down approach algorithm i.e navigating from the main page to the sub-modules in the application</p>
                  
                    <?php $callclass->_pagesButtons($websiteUrl);?>           
                </div>

                <div class="image-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/body-pix/modules.png" alt="<?php echo $appName ?> Company" />
                </div>
            </div>
           
        </div>
    </section>

    <section class="others-pg-content-div">
        <div class="menu-btn-div">
            <div class="btn-div-in">
                <ul>
                    <li class="active" id="next-admin" title="ADMINISTRATIVE PORTAL" onclick="_nextModulePage('admin-hide-div','admin');">ADMINISTRATIVE PORTAL</li>
                    <li id="next-staff" title="STAFF PORTAL" onclick="_nextModulePage('staff-hide-div','staff');">STAFF PORTAL</li>
                    <li class="hide-li" id="next-student" title="STUDENT PORTAL" onclick="_nextModulePage('student-hide-div','student');">STUDENT PORTAL</li>
                    <li class="hide-li" id="next-bursary" title="BURSARY/ACCOUNT PORTAL" onclick="_nextModulePage('bursary-hide-div','bursary');">BURSARY/ACCOUNT PORTAL</li>
                    <li class="hide-li" id="next-parents" title="PARENTS/GUARDIANS PORTAL" onclick="_nextModulePage('parents-hide-div','parents');">PARENTS/GUARDIANS PORTAL</li>
                    <li id="mobile-expand-li" title="More Modules"><i class="bi-three-dots-vertical"></i>
                        <div class="expand-div animated fadeIn">
                            <ul class="ul-expand">
                                <li id="mo-next-student" title="STUDENT PORTAL" onclick="_nextModulePage('student-hide-div','student');">STUDENT PORTAL</li>
                                <li id="mo-next-bursary" title="BURSARY/ACCOUNT PORTAL" onclick="_nextModulePage('bursary-hide-div','bursary');">BURSARY/ACCOUNT PORTAL</li>
                                <li id="mo-next-parents" title="PARENTS/GUARDIANS PORTAL" onclick="_nextModulePage('parents-hide-div','parents');">PARENTS/GUARDIANS PORTAL</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div id="admin-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="page-text-content animated fadeIn">
                        <p>The application is designed for basic/Secondary School administrators to perform the following responsibilities;</p>
                        <p><strong>1.</strong> Register staff with all their primary information according to the school requirement.</p>
                        <p><strong>2.</strong> Register students by session, term, or any other entrance method used for a student.</p>
                        <p><strong>3.</strong> Create, update, and delete any subject and generate time table.</p>
                        <p><strong>4.</strong> Update and delete any staff or student of the school.</p>
                        <p><strong>5.</strong> Allocate subject to a particular staff.</p>
                        <p><strong>6.</strong> Print out the staff or student Identity Card.</p>
                        <p><strong>7.</strong> Print out the academic report, broadsheet, and transcript of each of the students either by session or by term.</p>
                        <p><strong>8.</strong> Activate online classes.</p>
                        <p><strong>9.</strong> Activate or deactivate prospective staff or student.</p>
                    </div>
                </div>
            </section>
        </div>

        <div id="staff-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="page-text-content animated fadeIn">
                        <p>The application is also designed for to perform the following responsibilities;</p>
                        <p><strong>1.</strong> To track the entire students that offer the subject of that particular staff.</p>
                        <p><strong>2.</strong> To compute the baseline, scoresheet, and broadsheet result of each student that offers the subject of that particular staff.</p>
                        <p><strong>3.</strong> To have the detailed information of every student per subject.</p>
                        <p><strong>4.</strong> Set CBT questions.</p>
                    </div>
                </div>
            </section>
        </div>

        <div id="student-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="page-text-content animated fadeIn">
                        <p>it is designed for the students to:</p>
                        <p><strong>1.</strong> Apply for admission.</p>
                        <p><strong>2.</strong> Write online entrance examination (CBT).</p>
                        <p><strong>3.</strong> Check and print out their academic report.</p>
                        <p><strong>4.</strong> Attend online classes when necessary.</p>
                        <p><strong>5.</strong> Write CBT terminal CA or exams.</p>
                    </div>
                </div>
            </section>
        </div>

        <div id="bursary-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="page-text-content animated fadeIn">
                        <p>The application is also designed for the bursary/account department to perform the following responsibilities;</p>
                        <p><strong>1.</strong> To track transaction records for all staff and students.</p>
                        <p><strong>2.</strong> To track the debtors within the students.</p>
                        <p><strong>3.</strong> To audit the school account at large (monthly or yearly).</p>
                        <p><strong>4.</strong> To create a salary schedule and record staff salary.</p>
                    </div>
                </div>
            </section>
        </div>

        <div id="parents-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="page-text-content animated fadeIn">
                        <p>Lastly, it is designed for the guardians monitor the progressive report, academic performance of the students and make payment where necessary.</p>
                    </div>
                </div>
            </section>
        </div>

        <?php $callclass->_pagesAgentContent($websiteUrl, $appName);?>     
        
        <?php include 'footer.php'?>
    </section>
 
</body>
</html>


