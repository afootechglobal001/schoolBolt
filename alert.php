<div class="all-alert-back-div">
    <div class="success-alert-div animated fadeInDown">
        <div class="icon"><i class="bi-check-all"></i></div> 
        <div class="text"><p>PASSWORD RESET SUCCESSFUL! Check your email to confirm.</p></div>
    </div>
</div>

<div id="get-more-div" onclick="_alert_close(event);">
    <div class="alert-loading-div">
        <div class="icon"><img src="<?php echo $website_url?>/all-images/images/loading.gif" width="20px" alt="Loading"/></div> 
        <div class="text"><p>LOADING...</p></div>
    </div>
</div>

<div id="get-more-div-secondary">
    <div class="alert-loading-div">
        <div class="icon"><img src="<?php echo $website_url?>/all-images/images/loading.gif" width="20px" alt="Loading"/></div> 
        <div class="text"><p>LOADING...</p></div>
    </div>
</div>



<div class="sidenavdiv">
    <div class="live-chat-back-div">

    <a href="tel:1-800-658-5679" title="Call Customer Care">
        <div class="chat-div">
            <div class="icon-div" style="background:#008040;"><i class="bi-telephone-outbound"></i></div>
            <div class="text">1-800-658-5679</div>
          <br clear="all" />
        </div>
    </a>
    <a href="https://api.whatsapp.com/" target="_blank" title="Whatsapp">
        <div class="chat-div">
            <div class="icon-div" style="background:#25D366;"><i class="bi-whatsapp"></i></div>
            <div class="text">+234-812-700-0262</div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://www.facebook.com/" target="_blank" title="Facebook">
        <div class="chat-div">
            <div class="icon-div" style="background:#2980b9;"><i class="bi-facebook"></i></div>
            <div class="text">Facebook Page </div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://twitter.com/" target="_blank" title="Twitter">
        <div class="chat-div">
            <div class="icon-div" style="background:#3498db;"><i class="bi-twitter"></i></div>
            <div class="text">Twitter Page</div>
          <br clear="all" />
        </div>
    </a>

    <a href="https://www.instagram.com/" target="_blank" title="Instagram">
        <div class="chat-div">
            <div class="icon-div" style="background-image: linear-gradient(to right,#03F, #F0F);"><i class="bi-instagram"></i></div>
            <div class="text">Instagram Page</div>
          <br clear="all" />
        </div>
    </a>
  
</div>




<div class="index-menu-back-div"> 
    <div class="top-div">
        <div class="logo-div">
            <a href="<?php echo $website_url?>"><img src="<?php echo $website_url?>/all-images/images/logo.png" alt="<?php echo $thename?> Logo"  class="animated zoomIn"/></a>   
        </div>
    </div>

    <div class="div-in">
        <div class="div">
            <a href="<?php echo $website_url;?>" title="Home Page">
            <li <?php if ($page=='index.php') {?> id="active-li"<?php }?>><i class="bi-house"></i> Home Page</li></a>
        </div>

        <div class="div">
            <li onclick="_open_li('Schoolbolt')"><i class="bi-diagram-3"></i> SchoolBolt <i class="bi-plus" id="side-expand"></i></li>
            <div class="sub-li" id="Schoolbolt-sub-li">
                <a href="<?php echo $website_url;?>/about" title="About SchoolBolt">
                <li>About SchoolBolt</li></a>

                <a href="<?php echo $website_url;?>/features" title="SchoolBolt Features">
                <li> SchoolBolt Features </li></a>

                <a href="<?php echo $website_url;?>/sub-systems" title="SchoolBolt Subsystems">
                <li>SchoolBolt Subsystems</li></a>
            </div>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/modules" title="Modules">
            <li <?php if ($page=='modules') {?> id="active-li"<?php }?>><i class="bi-gear-wide-connected"></i> Modules</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/partners" title="Partners">
            <li <?php if ($page=='partners') {?> id="active-li"<?php }?>><i class="bi-person-check"></i> Partners</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/agency" title="Agency">
            <li <?php if ($page=='agency') {?> id="active-li"<?php }?>><i class="bi-person-check"></i> Agency</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/blog/" title="Blog">
            <li <?php if ($page=='blog') {?> id="active-li"<?php }?>><i class="bi-flower2"></i> Blog</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/contact-us" title="Blog">
            <li <?php if ($page=='contact-us') {?> id="active-li"<?php }?>><i class="bi-headset"></i> Contact Us</li></a>
        </div>

        <div class="div">
            <a href="<?php echo $website_url;?>/faq" title="Frequently Asked Questions">
            <li <?php if ($page=='faq') {?> id="active-li"<?php }?>><i class="bi-patch-question"></i> Frequently Asked Question</li></a>
        </div>
    </div>
</div>



<div class="sidenavdiv-in" onclick="_close_side_nav()"></div>
</div>



