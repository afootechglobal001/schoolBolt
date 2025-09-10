<?php include 'config/constants.php';?>
<?php include 'config/functions.php';?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php'?>
    <title><?php echo $thename?> | Nurturing Creativity and Curiosity Thrive</title>
    <meta name="keywords" content="<?php echo $thename?>, Montessori school in Lagos, Ar-Rahman Montessori, creative learning Lagos, early childhood education, hands-on learning, collaborative learning, critical thinking school, best Montessori school in Nigeria, safe learning environment, Montessori education Nigeria, early childhood education, safe learning environment, preschool Lagos, primary school Lagos, innovative teaching, child-centered learning, Lagos Montessori, nurturing creativity, holistic education, educational excellence" />
    <meta name="description" content="Discover Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />

    <meta property="og:title" content="<?php echo $thename?> | Nurturing Creativity and Curiosity Thrive" />
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta property="og:description" content="Discover Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />

    <meta name="twitter:title" content="<?php echo $thename?> | Nurturing Creativity and Curiosity Thrive" />
    <meta name="twitter:card" content="<?php echo $thename?>" />
    <meta name="twitter:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta name="twitter:description"  content="Discover Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />
</head>
<body>

    <?php  include 'header.php'?>

    <section class="slide-section">
        <?php include 'slide.php'?>
        <div class="slide-div">
            <div class="content-back-div">
                <div class="text-content-div" data-aos="zoom-in" data-aos-duration="900">
                    <div>
                        <div class="top-title"><i class="bi-bell-fill"></i><span> <strong>WELCOME</strong> TO ADVANCED BREED GROUP OF SCHOOLS</span></div>
                    </div>
                    <h1>Start Your Beautiful And </br>#<span id="page-title"></span></h1>      
                    <p>Our Vision Is To Breed A Total Man Who Builds The Moral, Social And Economic Strata Of The Society And Give It An Educational Institution Where Confidence Can Be Reposed..</p>
                   
                    <div class="btn-div">
                        
                        <button class="btn" title="Apply For Admission"><i class="bi-mortarboard-fill"></i> Apply For Admission</button>
                        
                        <button class="btn right-btn" title="Student Portal"><i class="bi-person-fill-check"></i>Student Portal</button>    
                       
                        <a href="https://arrahmangroupofschools.com/portal/parent/login" title="Parent Portal"><button class="btn"><i class="bi-people-fill"></i> Parent Portal</button></a>
                    </div> 
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            // List of sentences
            var _CONTENT = ["Bright Future", "Academic Path", "Lifelong Learning", "Empowered Vision", "Creative Thinking", "Learning Adventure", "Inspiring Success"];
            // Current sentence being processed
            var _PART = 0;
            // Character number of the current sentence being processed 
            var _PART_INDEX = 0;
            // Element that holds the text
            var _ELEMENT = document.querySelector("#page-title");
            // Implements typing effect
            function Type() { 
                var text =  _CONTENT[_PART].substring(0, _PART_INDEX + 1);
                _ELEMENT.innerHTML = text;
                _PART_INDEX++;

                // If full sentence has been displayed then start to delete the sentence after some time
                if(text === _CONTENT[_PART]) {
                    clearInterval(_INTERVAL_VAL);
                    setTimeout(function() {
                        _INTERVAL_VAL = setInterval(Delete, 2);
                    }, 5000);
                }
            }
            // Implements deleting effect
            function Delete() {
                var text =  _CONTENT[_PART].substring(0, _PART_INDEX - 1);
                _ELEMENT.innerHTML = text;
                _PART_INDEX--;

                // If sentence has been deleted then start to display the next sentence
                if(text === '') {
                    clearInterval(_INTERVAL_VAL);

                    // If last sentence then display the first one, else move to the next
                    if(_PART == (_CONTENT.length - 1))
                        _PART = 0;
                    else
                        _PART++;
                    _PART_INDEX = 0;

                    // Start to display the next sentence after some time
                    setTimeout(function() {
                        _INTERVAL_VAL = setInterval(Type, 50);
                    }, 100);
                }
            }
            // Start the typing effect on load
            _INTERVAL_VAL = setInterval(Type, 50);
        </script>
    </section>

    <section class="index-content-div">
        <div class="event-body-div">
            <div class="event-body-div-in" id="fetchindexUpcomingEvent">
                <script>_fetchindexUpcomingEvent();</script>
            </div> 
        </div>


        <section class="body-div">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="about-div">
                        <div class="image-back-div">
                            <div class="img-div" data-aos="fade-up" data-aos-duration="1400">
                                <img src="<?php echo $website_url?>/all-images/body-pix/about.jpg" alt="About <?php echo $thename?>"/>                   
                            </div>
                            <div class="image-lay-text-div">
                                <div class="icon-div">
                                    <img src="<?php echo $website_url?>/all-images/images/icon.png" alt="About Us"/>                   
                                </div>

                                <div class="text-div">
                                    <h3>DEACONESS ABOSEDE OGUNFOWOKE</h3>  
                                    <p>Proprietress</p>                  
                                </div>
                            </div>
                        </div>   
                        
                        <div class="content-div" data-aos="flip-in" data-aos-duration="1400">
                            <div><span class="top-text">ABOUT US</span></div>
                            <h2>Welcome to <span>Advanced Breed Group Of Schools</span></h2>
                            <p>Advanced Breed Group of Schools is a one-stop school. We are an academic giant in providing the best in quality education to your child.</p>
                            <p>We are the theatre of realized dreams and passionately moulding your child to become a dependable and successful leader they are meant to be.</p>
                            <p>Ours is a school that is very competitive and our records in both external and internal exams and competitions only testify to the sincere hard work of the teachers and sustained determination of the students.</p>
                            
                            <a href="<?php echo $website_url?>/about" title="Read More">
                            <button class="btn" title="Read More">Read More <i class="bi-arrow-right"></i></button></a> 
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="body-div net-bg-br">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="about-div" data-aos="fade-in" data-aos-duration="1400">
                        <div class="content-div">
                            <div><span class="top-text">OUR CORE VALUES</span></div>
                            <h2>Exploring Our Status <span>#Values</span></h2>                           
                            <p>Explore our status values to learn about the guiding principles that shape our approach to education and community.</p>

                            <div class="progress-back-div">
                                <div class="progress-container">
                                    <div class="progress-item">
                                        <span class="title">Case study success</span>
                                        <div class="progress-bar">
                                            <div class="progress-per" data-text="90">90</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-item">
                                        <span class="title">Happy student</span>
                                        <div class="progress-bar">
                                            <div class="progress-per" data-text="75">75</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-item">
                                        <span class="title">Engaging</span>
                                        <div class="progress-bar">
                                            <div class="progress-per" data-text="93">93</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-item">
                                        <span class="title">Student Community</span>
                                        <div class="progress-bar">
                                            <div class="progress-per" data-text="63">63</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="image-back-div">
                            <div class="img-div" data-aos="fade-in" data-aos-duration="1200">                   
                                <img src="<?php echo $website_url?>/all-images/body-pix/values.jpg" alt="<?php echo $thename?> Values"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>_progressBar();</script>
        </section>


        <section class="body-div net-bg-tr">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div" data-aos="fade-in" data-aos-duration="1200">
                        <div class="top-div">
                            <div><span class="top-title">OUR CLASSES</span></div>
                            <h2>Our Popular Classes </h2> 
                            <p>Explore our most sought-after classes designed to inspire and engage. Join us and discover a world of learning opportunities!"</p> 
                        </div>  

                        <div class="carousel-title-btn-div">
                            <button class="button" title="Previous" id="js-carousel__prev_1"><i class="bi-chevron-double-left"></i></button>
                            <button class="button" title="Next" id="js-carousel__next_1"><i class="bi-chevron-double-right"></i></button>
                        </div> 
                    </div>

                    <div class="main-gallery-back-div">
                        <div class="cg-carousel">
                            <div class="cg-carousel__container" id="js-carousel_1">                
                                <div class="cg-carousel__track js-carousel__track"  id="fetchIndexClassGallery">
                                    <script>_fetchIndexClassGallery();</script>
                                </div>          
                            </div>
                        </div>                
			        </div>    
                </div>
            </div>

            <script>
                window['carousel_options_1']= ({
                items:4,
                    margin: 30,
                    loop:true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed:650,         
                    autoplay:true,      
                    breakpoints: {
                700: {
                slidesPerView: 2,
                },
                1000: {
                slidesPerView: 3,
                },
                1300: {
                slidesPerView: 4,
                }
            
                }
                });
            </script>
        </section>

      
        <section class="body-div net-bg-bl">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="faq-back-div">              
                        <div class="left-image-div" data-aos="fade-in" data-aos-duration="1200">
                            <img src="<?php echo $website_url?>/all-images/body-pix/faq.jpg" alt="<?php echo $thename?> Frequently Asked Question"/>
                        </div>

                        <div class="right-container" data-aos="fade-up" data-aos-duration="1200">
                            <div class="faq-title">
                                <div><span class="top-title">FAQ</span></div>
                                <h2>Frequently Asked <span>Questions</span></h2>
                            </div>                      
                            <div class="faq-toggle-back" id="fetchIndexFaq">
                                <script>_fetchIndexFaq();</script>
                            </div> 
                            <a href="<?php echo $website_url?>/faq" title="Read More FAQ">
                            <button class="btn" title="Read More FAQ">Read More FAQ <i
                            class="bi-arrow-right"></i></button></a>            
                        </div>                     
                    </div>
                </div>
            </div>
        </section>

        <section class="body-div net-bg-tl">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div" data-aos="fade-in" data-aos-duration="1200">
                        <div class="top-div">
                            <h2>Meet With Our Teachers</h2> 
                            <p>Meet with our dedicated teachers to discuss your child’s progress, ask questions, and explore how we can support their educational journey.</p> 
                        </div> 
                        
                        <a href="<?php echo $website_url?>/teachers" title="Explore All Teachers">
                        <button class="btn" title="Explore All Teachers">Explore All Teachers <i class="bi-arrow-right"></i></button></a>
                    </div>

                    <div class="teachers-back-div" id="fetchIndexTeachers">
                       <script>_fetchIndexTeachers();</script>
                    </div>
                </div>
            </div>
        </section>

        <section class="body-div testimonial-bg">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="testimonial-title" data-aos="fade-in" data-aos-duration="1200">
                        <div class="top-div">
                            <div><span class="top-title">TESTIMONIALS</span></div>
                            <h2>What Our Students <span>Say's</span></h2>
                            <p>Our students share their experiences, highlighting the engaging lessons and strong friendships that make our school a special place to learn and grow.</p>
                        </div> 
                        <button class="btn" title="Share Your Testimony" onclick="_getForm('testimonial-form');">Share Your Testimony <i class="bi-arrow-right"></i></button>
                    </div>

                    <div class="testimonial-back-div"> 
                        <div class="cg-carousel">
                            <div class="cg-carousel__container" id="js-carousel_2">                
                                <div class="cg-carousel__track js-carousel__track" id="fetchAllTestimony">
                                    <script>_fetchAllTestimony();</script>                                                        
                                </div>
                            </div>       
                        </div>                     
                    </div> 

                    <div class="test-carousel-btn-div">
                        <button class="btn" title="Previous" id="js-carousel__prev_2"><i class="bi-chevron-double-left"></i></button>
                        <button class="btn" title="Next" id="js-carousel__next_2"><i class="bi-chevron-double-right"></i></button>
                    </div>                    
                </div>  
            </div>
            <script>
                window['carousel_options_2']= ({
                items:4,
                    margin: 30,
                    loop:true,
                    dots: true,
                    autoplayHoverPause: true,
                    smartSpeed:650,         
                    autoplay:true,      
                    breakpoints: {
                    700: {
                    slidesPerView: 2,
                    },
                    900: {
                    slidesPerView: 2,
                    },
                    1300: {
                    slidesPerView: 3,
                    }
                
                    }
                    });
            </script>   
        </section>

        <section class="body-div faq-bg">
            <div class="body-div-in">
                <div class="main-pages-back-div">
                    <div class="title-div" data-aos="fade-in" data-aos-duration="1200">
                        <div class="top-div">
                            <div><span class="top-title">LATEST INSIGHTS</span></div>
                            <h2>Latest News & Blog </h2> 
                            <p>Stay updated with our latest news and blog posts, where we share important announcements, insights, and exciting updates from our school community.</p> 
                        </div> 
                        <a href="<?php echo $website_url?>/blog/" title="Explore All Blogs">
                        <button class="btn" title="Explore All Blogs">Explore All Blogs <i class="bi-arrow-right"></i></button></a>
                    </div>

                    <div class="blog-back-div" id="fetchIndexBlog">
                        <script>_fetchIndexBlog();</script>
                    </div>
                </div>
            </div>
        </section>

        <?php $callclass->_statistics($website_url);?>
        <?php  include 'footer.php'?>
    </section>
</body>
</html>