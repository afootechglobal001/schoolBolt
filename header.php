<?php  include 'alert.php'?>
<header class="animated fadeInDown">
    <div class="header-top-div">
        <div class="header-top-div-in">
            <div class="contacts">
                <div class="contact dsp-none"><i class="bi-clock"></i> <span>Mon - Fri (8am - 4pm)</span></div>
                <div class="contact dsp-none2" title="Mail Us"><i class="bi-envelope"></i> <span>info@schoolbolt.com</span></div>
                <div class="contact no-border2" title="Call Us"><i class="bi-telephone"></i> <span>(+234) 812 700 0262</span></div>
                <a href="<?php echo $websiteUrl?>/faq" title="Frequently Asked Questions">
                <div class="contact no-border" title="Frequently Asked Questions"><i class="bi-patch-question"></i> <span>FAQ</span></div></a> 
            </div>

            <div class="social-media-div">                  
                <h3>Follow Us:</h3>
                <ul>
                    <a href="https://api.whatsapp.com" target="_blank" title="WhatsApp">
                    <li><i class="bi-whatsapp"></i></li></a>
                    <a href="https://www.facebook.com" target="_blank" title="Facebook">
                    <li><i class="bi-facebook"></i></li></a>
                    <a href="https://www.twitter.com" target="_blank" title="Twitter">
                    <li><i class="bi-twitter-x"></i></li></a> 
                    <a href="https://www.instagram.com" target="_blank" title="Instagram">
                    <li><i class="bi-instagram"></i></li></a> 
                </ul>
            </div>  
        </div>   
    </div>  

    <div class="header-div-in">
        <div class="inner-div">
            <div class="logo-div">
                <a href="<?php echo $websiteUrl ?>"><img src="<?php echo $websiteUrl?>/all-images/images/logo.png" alt="<?php echo $appName?> Logo"  class="animated zoomIn"/></a>   
            </div>
            
            <nav>
                <ul>                          
                    <a href="<?php echo $websiteUrl ?>" title="Home Page"><li <?php if (($websiteAutoUrl=="$websiteUrl/index")||($websiteAutoUrl=="$websiteUrl/")||($websiteAutoUrl=="$websiteUrl")) {?> class="active" <?php }?>> Home</li></a>
                
                    <li id="expand-li" class="<?php if (strstr($websiteAutoUrl, "$websiteUrl/schoolbolt")) {?> active <?php }?>">
                        SchoolBolt <i class="bi-plus"></i>
                        <ul class="animated fadeIn">
                            <div class="sub-nav-div">
                                <a class="nav-div" href="<?php echo $websiteUrl?>/about" title="About SchoolBolt">                             
                                    <div class="icon-div"><i class="bi-mortarboard"></i></div>
                                    <div class="text-div">
                                        <li>About SchoolBolt</li>  
                                        <p>Learn more about our platform.</p>                                       
                                    </div>
                                </a> 

                                <a class="nav-div" href="<?php echo $websiteUrl?>/features" title="SchoolBolt Features">                             
                                    <div class="icon-div"><i class="bi-gear-wide-connected"></i></div>
                                    <div class="text-div">
                                        <li>SchoolBolt Features</li>  
                                        <p>Explore our unique features.</p>                                       
                                    </div>
                                </a> 

                                <a class="nav-div" href="<?php echo $websiteUrl?>/modules" title="SchoolBolt Modules">                             
                                    <div class="icon-div"><i class="bi-diagram-2"></i></div>
                                    <div class="text-div">
                                        <li>SchoolBolt Modules</li>  
                                        <p>Explore our unique Modules.</p>                                       
                                    </div>
                                </a> 

                                <a class="nav-div" href="<?php echo $websiteUrl?>/sub-systems" title="SchoolBolt Subsystem">                             
                                    <div class="icon-div"><i class="bi-diagram-3"></i></div>
                                    <div class="text-div">
                                        <li>SchoolBolt Subsystems</li>  
                                        <p>Discover our trusted subsystems.</p>                                       
                                    </div>
                                </a> 
                            </div>                          
                        </ul>                  
                    </li> 

                    <a href="<?php echo $websiteUrl?>/partners" title="Partners">
                        <li class="<?php if (strstr($websiteAutoUrl, "$websiteUrl/partners")) {?> active <?php }?>">
                            Partners
                        </li>
                    </a>

                    <a href="<?php echo $websiteUrl?>" title="Agency">
                        <li class="<?php if (strstr($websiteAutoUrl, "$websiteUrl/agency/")) {?> active <?php }?>">
                            Agency
                        </li>
                    </a> 

                    <a href="<?php echo $websiteUrl?>/blog/" title="Blog">
                        <li class="<?php if (strstr($websiteAutoUrl, "$websiteUrl/blog/")) {?> active <?php }?>">
                            Blog
                        </li>
                    </a> 

                    <a href="<?php echo $websiteUrl?>/contact-us" title="Contact Us">
                        <li class="<?php if (strstr($websiteAutoUrl, "$websiteUrl/contact-us")) {?> active <?php }?>">
                            Contact Us
                        </li>
                    </a>
                </ul>
        
                <a href="<?php echo $websiteUrl?>" title="REQUEST FOR A DEMO">
                <button class="btn" title="REQUEST FOR A DEMO"> REQUEST FOR A DEMO</button></a>
                <button class="mobile-btn" onclick="_open_menu()"><i class="bi-text-right"></i></button>
            </nav>
        </div>
    </div>  
</header>