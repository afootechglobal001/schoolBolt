<?php  include 'alert.php'?>
<header class="fadeInDown animated">
    <div class="header-div-in"> 
        <div class="logo-div"><img src="<?php echo $website_url?>/all-images/images/logo.png" alt="<?php echo $thename?> logo" /></div>

        <div class="header-nav-div">
            <div class="left-icon-div">
                <div class="icon-div dsp-none" onClick="" title="System Search">
                    <i class="bi-search"></i>
                </div>

                <div class="icon-div" onClick="_get_form('app_settings');" title="System Settings">
                    <i class="bi-gear"></i>
                </div>
                <div class="icon-div bell_notification" onClick="_get_page('system_alert');" title="System Alert">
                    <i class="bi-bell"></i>
                    <script>getNotificationNumber();</script>
                </div>
            </div>

            <div class="left-icon-div no-border" title="Click To View Profile" onclick="_toggle_profile_pix_div()">
                <div class="profile-div">
                    <div class="info-div">
                        <div class="name"><strong id="header_fullname">Loading...</strong></div>
                        <div class="role" id="login_role_name">Loading...</div>
                    </div>
                    <div class="img-div" id="header_pix"></div>
                </div>
            </div>

            <div class="toggle-profile-div">
                <div class="toggle-div-in">
                    <div class="toggle-profile-pix-div" id="toggle_header_pix"></div>
                    <div class="header-content">
                        <div class="toggle-profile-name"><span id="pro_header_fullname">Loading...</span></div>
                        <div class="toggle-profile-others">User ID: <span id="pro_header_staff_id">Loading...</span></div>
                        <div class="toggle-profile-others">Phone: <span id="pro_header_phone">Loading...</span></div>
                        <div class="btn-div">
                            <button class="btn" title="Log-Out" type="button" onclick="_get_form('logout_confirm_form');"><i class="bi-box-arrow-in-right"></i> Log-Out</button>
                            <button class="btn" title="View Profile" type="button" onclick="_get_form_with_id('my_profile','<?php echo $login_staff_id?>');"><i class="bi-person"></i> Profile</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>