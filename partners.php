<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include 'config/constants.php';?>
<?php include 'config/functions.php';?>
<html id="other-page-header" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php' ?>
    <title><?php echo $thename ?> | Clients & Partners</title>
    <meta name="keywords" content="<?php echo $thename ?>, School Management Software in Nigeria, School Database System, School Administration Software, Basic and Secondary School Management, School Staff Management, Web Application for Schools, School Performance Tracking, Student Information System, Academic Record Management, School Scheduling Software, Nigerian School Software, SchoolBolt Features, Education Management System in Nigeria" />
    <meta name="description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />

    <meta property="og:title" content="<?php echo $thename ?> | School Database Management System in Nigeria" />
    <meta property="og:image" content="<?php echo $website_url ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta property="og:description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />

    <meta name="twitter:title" content="<?php echo $thename ?> | School Database Management System in Nigeria" />
    <meta name="twitter:card" content="<?php echo $thename ?>" />
    <meta name="twitter:image" content="<?php echo $website_url ?>/all-images/plugin-pix/schoolbolt.jpg" />
    <meta name="twitter:description" content="SchoolBolt is a reliable school database management system designed to streamline operations in basic and secondary schools across Nigeria. Manage staff, track academic performance, and simplify school administration efficiently." />
</head>

<body>
    <?php  include 'header.php'?>

    <section class="other-pages other-body-div" data-aos="fade-down" data-aos-duration="800">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $website_url?>"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a href="<?php echo $website_url?>/partners"><li title="Clients & Partners">Clients & Partners</li></a>					
                    </ul>
                </div>			
            </div>

            <div class="main-content-back-div">
                <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                    <h1 data-aos="fade-in" data-aos-duration="800"><span>SchoolBolt Clients & Partners</span></h1>
                    <p><strong>“SchoolBolt”</strong> proudly collaborates with a diverse range of clients and partners, including schools, educational institutions, and technology providers.</p>
                  
                    <?php $callclass->_pagesButtons($website_url);?>           
                </div>

                <div class="image-div">
                    <img src="<?php echo $website_url ?>/all-images/body-pix/partners.png" alt="<?php echo $thename ?> Company" />
                </div>
            </div>
           
        </div>
    </section>

    <section class="others-pg-content-div">
        <section class="body-div">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div animated fadeIn">
                        <div class="left-div">
                            <p><strong>“SchoolBolt”</strong> proudly collaborates with a diverse range of clients and partners, including schools, educational institutions, and technology providers.</p>
                        </div>
                    </div>

                    <div class="cg-carousel">
                        <div class="cg-carousel__container" id="js-carousel_1">
                            <div class="cg-carousel__track js-carousel__track">

                                <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left" data-aos-duration="1200">
                                    <div class="potfolio-div">
                                        <div class="image-div">
                                            <img src="<?php echo $website_url ?>/all-images/projects/leaderstutors-website.png" alt="leaders Tutors Website" />
                                        </div>

                                        <div class="content-div">
                                            <div class="div-in">
                                                <h2>Leaders Tutors Website & Mobile App</h2>
                                                <p> The is where education meets innovation! Our cutting-edge application redefines the learning experience with a dynamic Education Video Learning system.</p>
                                                <a href="https://leaderstutors.com" title="Leaders Tutors Website" target="_blank">
                                                    <button class="btn">Visit Website <i class="bi-chevron-right"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left" data-aos-duration="1200">
                                    <div class="potfolio-div">
                                        <div class="image-div">
                                            <img src="<?php echo $website_url ?>/all-images/projects/advanced-breed-school-website.png" alt="Advanced Breed School Website" />
                                        </div>

                                        <div class="content-div">
                                            <div class="div-in">
                                                <h2>Advanced Breed Group of Schools</h2>
                                                <p>Advanced Breed Group of Schools is a one-stop school. We are an academic giant in providing the best in quality education to your child.</p>
                                                <a href="https://www.advancedbreedgroupofschool.com" title="Advanced Breed School Website" target="_blank">
                                                    <button class="btn">Visit Website <i class="bi-chevron-right"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-div">
                        <button class="carousel-btn" title="Previous" id="js-carousel__prev_1"><i class="bi-chevron-double-left"></i></button>
                        <button class="carousel-btn" title="Next" id="js-carousel__next_1"><i class="bi-chevron-double-right"></i></button>
                    </div>
                </div>
            </div>
            <script>
                window['carousel_options_1'] = ({
                    items: 4,
                    margin: 30,
                    loop: true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed: 650,
                    autoplay: true,
                    breakpoints: {
                        700: {
                            slidesPerView: 1,
                        },
                        900: {
                            slidesPerView: 1,
                        },
                        1300: {
                            slidesPerView: 1,
                        }

                    }
                });
                _call_carousel(1);
            </script>
        </section>

        <?php $callclass->_pagesAgentContent($website_url, $thename);?> 

        <section class="body-div net-bg-bl">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="testimonial">
                        <div class="content" data-aos="fade-up" data-aos-duration="1400">
                            <h2>What Our Client Say <span>About Us</span></h2>
                            <p>Discover what our clients have to say about their experience with SchoolBolt and how our platform has helped them improve communication, streamline operations, and enhance the overall learning experience</p>
                        </div>

                        <div class="right-back-div">
                            <div class="cg-carousel">
                                <div class="cg-carousel__container" id="js-carousel_2">
                                    <div class="cg-carousel__track js-carousel__track">

                                        <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left"
                                            data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url ?>/all-images/images/avatar.png"
                                                            alt="testimonial" />
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>

                                                <p><strong>“SchoolBolt”</strong> has improved our communication and made school management effortless. Highly recommended!</p>

                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Ar-Rahman Montessori School</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left"
                                            data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url ?>/all-images/images/avatar.png"
                                                            alt="testimonial" />
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>

                                                <p><strong>“SchoolBolt”</strong> has simplified our processes and improved communication across the board. Highly recommended!</p>

                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Advanced Breed Group Of Schools</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left"
                                            data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url ?>/all-images/images/avatar.png"
                                                            alt="testimonial" />
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>

                                                <p><strong>“SchoolBolt”</strong> has enhanced our online class experience with seamless management and communication tools. Highly recommended</p>

                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Leaders Tutor</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cg-carousel__slide js-carousel__slide" data-aos="fade-left"
                                            data-aos-duration="1200">
                                            <div class="main-testimonial">
                                                <div class="img-back-div">
                                                    <div class="img-div">
                                                        <img src="<?php echo $website_url ?>/all-images/images/avatar.png"
                                                            alt="testimonial" />
                                                    </div>

                                                    <div class="icon">
                                                        <i class="bi-quote"></i>
                                                    </div>
                                                </div>

                                                <p>SchoolBolt has made managing our online classes smooth and efficient. Highly recommended</p>

                                                <div class="bottom-div">
                                                    <div class="star-div">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                    </div>

                                                    <h5>Always Online Classes</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                window['carousel_options_2'] = ({
                    items: 4,
                    margin: 30,
                    loop: true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed: 650,
                    autoplay: true,
                    breakpoints: {
                        700: {
                            slidesPerView: 1,
                        },
                        1100: {
                            slidesPerView: 1,
                        },
                        1300: {
                            slidesPerView: 2,
                        }

                    }
                });
                _call_carousel(2);
            </script>
        </section>
        
        <?php include 'footer.php'?>
    </section>
 
</body>
</html>


