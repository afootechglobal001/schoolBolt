<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include 'config/constants.php'; ?>
<?php include 'config/functions.php'; ?>
<html id="other-page-header" lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include 'meta.php' ?>
    <title><?php echo $appName ?> | Contact Us | 24/7 Online and Offline Support</title>
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
    <?php include 'header.php' ?>

    <section class="other-pages other-body-div" data-aos="fade-in" data-aos-duration="900">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $websiteUrl ?>">
                            <li title="Home">Home <i class="bi-caret-right-fill"></i></li>
                        </a>
                        <a href="<?php echo $websiteUrl ?>/contact-us">
                            <li title="Contact Us">Contact Us</li>
                        </a>
                    </ul>
                </div>
            </div>

            <div class="main-content-back-div">
                <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                    <h1 data-aos="fade-in" data-aos-duration="800"><span>Contact Us</span></h1>
                    <p>Have questions or need assistance? Our support team is here to help!, We’re just a click or call away. Reach out anytime!</p>

                    <?php $callclass->_pagesButtons($websiteUrl); ?>
                </div>

                <div class="image-div">
                    <img src="<?php echo $websiteUrl ?>/all-images/body-pix/blog.png" alt="<?php echo $appName ?> Company" />
                </div>
            </div>
        </div>
    </section>


    <section class="others-pg-content-div">
        <div class="menu-btn-div">
            <div class="btn-div-in">
                <div class="btn-div-in">
                    <ul>
                        <li class="active" id="next-lagos" title="LAGOS ADDRESS" onclick="_next_contact_page('lagos-hide-div','lagos');">LAGOS ADDRESS</li>
                        <li id="next-ogun" title="OGUN STATE ADDRESS" onclick="_next_contact_page('ogun-hide-div','ogun');">OGUN STATE ADDRESS</li>
                        <li class="hide-li" id="next-oyo" title="OYO ADDRESS" onclick="_next_contact_page('oyo-hide-div','oyo');">OYO ADDRESS</li>
                        <li id="mobile-expand-li" title="More Modules"><i class="bi-three-dots-vertical"></i>
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li id="mo-next-student" id="next-oyo" title="OYO ADDRESS" onclick="_next_contact_page('oyo-hide-div','oyo');">OYO ADDRESS</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="lagos-hide-div">
            <section class="contact-hash-bg">
                <div class="bottom-body-div">
                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/email.png" alt="<?php echo $appName ?> Email Address" /></div>

                            <div class="text">
                                <h2>MAIL US</h2>
                                <p>info@schoolbolt.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/phone.png" alt="<?php echo $appName ?> Phone Number" /></div>

                            <div class="text">
                                <h2>CALL US</h2>
                                <p>(+234) 812 700 0262</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/location.png" alt="<?php echo $appName ?> Office Address" /></div>

                            <div class="text">
                                <h2>LOCATION</h2>
                                <p>Lagos, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="map-body-div">
                <div class="map-back-div">
                    <iframe allowfullscreen="" class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1014758.8304398162!2d3.5370304499999996!3d6.5341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf2bae227550d%3A0xe771ad7f1bbe89d6!2sLagos!5e0!3m2!1sen!2sng!4v1737195930397!5m2!1sen!2sng"></iframe>
                </div>
            </section>
        </div>

        <div id="ogun-hide-div">
            <section class="contact-hash-bg">
                <div class="bottom-body-div">
                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/email.png" alt="<?php echo $appName ?> Email Address" /></div>

                            <div class="text">
                                <h2>MAIL US</h2>
                                <p>info@schoolbolt.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/phone.png" alt="<?php echo $appName ?> Phone Number" /></div>

                            <div class="text">
                                <h2>CALL US</h2>
                                <p>+1(408)8783199</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/location.png" alt="<?php echo $appName ?> Office Address" /></div>

                            <div class="text">
                                <h2>LOCATION</h2>
                                <p>Ogun State, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="map-body-div">
                <div class="map-back-div">
                    <iframe allowfullscreen="" class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2027046.0348654755!2d2.330235590331325!3d7.117389987597631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b0deeeb1087cb%3A0xae67d82f51409ce8!2sOgun%20State!5e0!3m2!1sen!2sng!4v1737196090363!5m2!1sen!2sng"></iframe>
                </div>
            </section>
        </div>

        <div id="oyo-hide-div">
            <section class="contact-hash-bg">
                <div class="bottom-body-div">
                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/email.png" alt="<?php echo $appName ?> Email Address" /></div>

                            <div class="text">
                                <h2>MAIL US</h2>
                                <p>info@schoolbolt.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/phone.png" alt="<?php echo $appName ?> Phone Number" /></div>

                            <div class="text">
                                <h2>CALL US</h2>
                                <p>+1(408)8783199</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-div animated zoomIn">
                        <div class="div-in inner-contact">
                            <div class="icon img-div"><img src="all-images/images/location.png" alt="<?php echo $appName ?> Office Address" /></div>

                            <div class="text">
                                <h2>LOCATION</h2>
                                <p>Oyo State, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="map-body-div">
                <div class="map-back-div">
                    <iframe allowfullscreen="" class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2022232.2506287484!2d2.3031296014340765!3d8.134798588822227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1036e55e45fb9a45%3A0x9c6be1902ef005e9!2sOyo!5e0!3m2!1sen!2sng!4v1737196153797!5m2!1sen!2sng"></iframe>
                </div>
            </section>
        </div>

       <section class="body-div">
            <div class="body-div-in">
                <div class="contact-mail-div" data-aos="fade-in" data-aos-duration="800">
                    <div class="inner-div">
                        <div class="div-in">
                            <div class="text_field_container" id="full_name_container">
                                <script>textField('full_name', 'Full Name')</script>
                            </div>

                            <div class="text_field_container" id="email_container">
                                <script>textField('email', 'Email Address', 'email')</script>
                            </div>

                            <div class="text_field_container" id="subject_container">
                                <script>textField('subject', 'Subject')</script>
                            </div>       
                        </div>

                        <div class="div-in right-div-in">
                            <div class="text_area_container" id="message_container">
                                <script>textField('message', 'Message', 'textarea')</script>
                            </div>
                
                            <button class="btn" onclick="">Send Mail <i class="bi-send-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php' ?>
    </section>
</body>

</html>