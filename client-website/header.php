<?php  include 'alert.php'?>
<header class="animated fadeInDown">
    <div class="header-top-div">
        <div class="header-top-div-in">
            <div class="social-media-div">                  
                <h3>Follow Us:</h3>
                <ul>
                    <a href="https://www.youtube.com" target="_blank" title="YouTube">
                    <li><i class="bi-youtube"></i></li></a>
                    <a href="https://web.facebook.com/ARMOSLagos" target="_blank" title="Facebook">
                    <li><i class="bi-facebook"></i></li></a>
                    <a href="https://www.twitter.com" target="_blank" title="Twitter">
                    <li><i class="bi-twitter"></i></li></a> 
                    <a href="https://www.instagram.com" target="_blank" title="Instagram">
                    <li><i class="bi-instagram"></i></li></a> 
                </ul>
            </div>  

            <div class="contacts">
                <div class="contact no-border"><i class="bi-clock"></i> <span>Monday - Friday (8am - 4pm)</span></div>
                <div class="contact dsp-none"><i class="bi-envelope"></i> <span>info@arrahmangroupofschools.com</span></div>
                <div class="contact"><i class="bi-telephone"></i> <span>(+234) 805 020 2261</span></div>
            </div>
        </div>   
    </div>  

    <div class="header-div-in">
        <div class="inner-div">
            <div class="logo-div">
                <a href="<?php echo $website_url ?>"><img src="<?php echo $website_url?>/all-images/images/logo.png?<?php echo $code_version?>" alt="<?php echo $thename?> Logo"  class="animated zoomIn"/></a>   
            </div>
            
            <nav>
                <ul>                          
                    <a href="<?php echo $website_url ?>" title="Home Page"><li <?php if (($website_auto_url=="$website_url/index")||($website_auto_url=="$website_url/")||($website_auto_url=="$website_url")) {?> class="active" <?php }?>> Home</li></a>

                    <li id="expand-li" class=" <?php if (strstr($website_auto_url, "$website_url/about")) {?> active <?php }?>">
                        About Us <i class="bi-chevron-down"></i>
                        <ul class="animated fadeIn">
                            <a href="<?php echo $website_url?>/about" title="About Ar-Rahman Montessori Schools">
                            <li>About Ar-Rahman Montessori Schools</li></a>
                            <a href="<?php echo $website_url?>/faq" title="Frequently Asked Questions">
                            <li>Frequently Asked Questions</li></a>
                            <a href="<?php echo $website_url?>/gallery" title="Gallery">
                            <li>Our Gallery</li></a>
                            <a href="<?php echo $website_url?>/event/" title="Event">
                            <li class="li">Our Events</li></a>   
                        </ul>  
                    </li>

                    <li id="expand-li" class="<?php if (strstr($website_auto_url, "$website_url/admission/")) {?> active <?php }?>">
                        Admission <i class="bi-chevron-down"></i>
                        <ul class="animated fadeIn">
                            <a href="<?php echo $website_url?>" title="Apply For Admission">
                            <li>Apply For Admission</li></a>
                            <a href="<?php echo $website_url?>" title="Admission Requirement">
                            <li>Admission Requirement</li></a> 
                            <a href="<?php echo $website_url?>" title="Admission Requirement">
                            <li>Entrance Examinations</li></a>                          
                        </ul>  
                    </li>

                    <li id="expand-li" class=" <?php if (strstr($website_auto_url, "$website_url/academics")) {?> active <?php }?>">
                        Academics <i class="bi-chevron-down"></i>
                        <ul class="animated fadeIn">
                            <a href="<?php echo $website_url?>" title="Curriculum">
                            <li>Curriculum</li></a>
                            <a href="<?php echo $website_url?>" title="Classes">
                            <li>Classes</li></a>
                            <a href="<?php echo $website_url?>" title="Subjects">
                            <li class="li">Subjects</li></a>   
                        </ul>  
                    </li>

                    <a href="<?php echo $website_url?>/contact-us" title="Contact Us">
                        <li class="contact <?php if (strstr($website_auto_url, "$website_url/contact-us")) {?> active <?php }?>">
                            Contact Us
                        </li>
                    </a>

                    <a href="<?php echo $website_url?>/blog/" title="Blog">
                        <li class="blog <?php if (strstr($website_auto_url, "$website_url/blog/")) {?> active <?php }?>">
                            Blog
                        </li>
                    </a>  
                </ul>
            
                <div class="nav-icon-div"><i class="bi-search"></i></div>  
                <a href="<?php echo $website_url?>/portal/" title="Apply For Admission">
                <button class="btn" title="Apply For Admission"><i class="bi-pencil-fill"></i> PORTAL</button></a>
                <button class="mobile-btn" onclick="_open_menu()"><i class="bi-text-right"></i></button>
            </nav>
        </div>
    </div>  
</header>