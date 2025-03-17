<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include 'config/constants.php';?>
<?php include 'config/functions.php';?>
<html id="other-page-header" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Frequently Asked Question</title>
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
                        <a href="<?php echo $websiteUrl?>/faq"><li title="Frequently Asked Question">Frequently Asked Question</li></a>					
                    </ul>
                </div>			
            </div>

            <div class="main-content-back-div">
                <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                    <h1 data-aos="fade-in" data-aos-duration="800"><span>Frequently Asked Question</span></h1>
                    <p>Find answers to common questions about SchoolBolt, the ultimate school management system for basic and secondary schools in Nigeria.</p>                
                  
                    <?php $callclass->_pagesButtons($websiteUrl);?>           
                </div>

                <div class="image-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/body-pix/faq.png" alt="<?php echo $appName ?> Company" />
                </div>
            </div>
        </div>
    </section>

    <section class="others-pg-content-div">
        <section class="body-div harsh-bg">
            <div class="body-div-in">
                <div class="page-back-div">
                    <div class="right-div sticky-div">
                        <div class="div-in">
                            <h3>SEARCH</h3>
                            <div class="text_field_container">
                                <input class="text_field blog_text_field" id="search_keywords" onkeyup="_fetchListBlog();" type="text" placeholder="" />
                                <div class="placeholder">Type Here To Search</div>
                            </div>
                        </div>

                        <div class="div-in">
                            <h3>TAG LIST</h3>

                            <ul id="cat_id">
                                <li title="SchoolBolt">SchoolBolt</li>
                                <li title="Schools">Schools</li>
                                <li title="General">General</li>
                                <li title="Announcement">Announcement</li>
                                <li title="Services">Services</li>
                            </ul>
                        </div>
                    </div>

                    <div class="left-div">
                        <div class="general-faq-div">
                            <div class="faq-title"  id="faq201">
                                <div class="inner-title-div" onclick="_collapse('faq201')">
                                    <h2>What is SchoolBolt?</h2>
                                    <div class="expand-div" id="faq201num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                                </div>

                                <div class="faq-answer-div" id="faq201answer" style="display: none;">
                                    <p>SchoolBolt is a web-based school management system designed to simplify administrative tasks for basic and secondary schools in Nigeria. It helps manage staff, students, academic records, and school operations efficiently.</p>
                                </div>
                            </div>

                            <div class="faq-title" id="faq202">
                                <div class="inner-title-div" onclick="_collapse('faq202')">
                                    <h2>Who can use SchoolBolt?</h2>
                                    <div class="expand-div" id="faq202num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                                </div>

                                <div class="faq-answer-div" id="faq202answer" style="display: none;">
                                    <p>SchoolBolt is ideal for school administrators, teachers, parents, and students. It provides tailored features to meet the needs of each user group.</p>
                                </div>
                            </div>

                            <div class="faq-title" id="faq203">
                                <div class="inner-title-div" onclick="_collapse('faq203')">
                                    <h2> What features does SchoolBolt offer?</h2>
                                    <div class="expand-div" id="faq203num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                                </div>

                                <div class="faq-answer-div" id="faq203answer" style="display: none;">
                                    <p>1. Staff and student management</p>
                                    <p>2. Academic performance tracking</p>
                                    <p>3. Attendance management</p>
                                    <p>4. Communication tools for parents, teachers, and administrators</p>
                                </div>
                            </div>

                            <div class="faq-title" id="faq204">
                                <div class="inner-title-div" onclick="_collapse('faq204')">
                                    <h2>Is SchoolBolt easy to use?</h2>
                                    <div class="expand-div" id="faq204num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                                </div>

                                <div class="faq-answer-div" id="faq204answer" style="display: none;">
                                    <p>Yes, SchoolBolt is designed with a user-friendly interface, making it simple for anyone to navigate and use its features effectively.</p>
                                </div>
                            </div>

                            <div class="faq-title" id="faq205">
                                <div class="inner-title-div" onclick="_collapse('faq205')">
                                    <h2>Can SchoolBolt be accessed on mobile devices?</h2>
                                    <div class="expand-div" id="faq205num">&nbsp;<i class="bi-plus"></i>&nbsp;</div>
                                </div>

                                <div class="faq-answer-div" id="faq205answer" style="display: none;">
                                    <p>Absolutely! SchoolBolt is optimized for both desktop and mobile devices, allowing users to manage school activities anytime, anywhere.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php' ?>
    </section>
</body>
</html>


