<?php  include '../alert.php'?>
<header class="fadeInDown animated">
    <div class="header-div-in"> 
        <div class="logo-div"><img src="<?php echo $websiteUrl?>/all-images/images/logo.png" alt="<?php echo $appName?> logo" /></div>

        <div class="header-nav-div">
            <div class="left-nav">
                <ul>
                    <li class="active-li" title="Dashboard" onclick="_getPage('dashboard','dashboard', '');" id="top-dashboard"><i class="bi-speedometer2"></i> Dashboard</li>
                    <li title="My Profile" onclick="_getFormWithId('update_staff','');"><i class="bi-person"></i> My Profile</li>
                    <li title="Prospective Staff" onclick="_getPage('prospective_staff','staff', '');" id="top-staff"><i class="bi-people-fill"></i> Prospective Staff <div class="num" id="">3</div></li>
                </ul> 
            </div>

            <div class="right-nav">
                <div class="right-icon-div left-icon-div">
                    <div class="icon-div" onclick="_getActivePage({page:'settings'});" title="System Settings">
                        <i class="bi-gear"></i>
                    </div>
                    <div class="icon-div bell_notification" onClick="_get_page('system_alert');" title="System Alert">
                        <i class="bi-bell"></i>
                        <div>20</div>
                    </div>
                </div>

                <div class="right-icon-div no-border" title="Click To View Profile" onclick="_toggleProfileDiv()">
                    <div class="profile-div">
                        <div class="info-div">
                            <div class="name" id="loginHeaderName"><strong> <script>$("#loginHeaderName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));</script></strong></div>
                            <div class="role" id="loginRoleName"><script>$("#loginRoleName").html(capitalizeFirstLetterOfEachWord(staffLoginData.roleName));</script></div>
                        </div>
                        <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/images/avatar.jpg" alt="<?php echo $appName?>" /></div>
                    </div>
                </div>

                <div class="toggle-profile-div">
                    <div class="toggle-div-in">
                        <div class="toggle-profile-pix-div"><img src="<?php echo $websiteUrl?>/all-images/images/avatar.jpg" alt="<?php echo $appName?>"/></div>
                        <div class="header-content">
                            <div class="toggle-profile-name"><span id="loginProfileName"><script>$("#loginProfileName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));</script></span></div>
                            <div class="toggle-profile-others">User ID: <span id="loginProfileStaffId"><script>$("#loginProfileStaffId").html(staffLoginData.staffId);</script></span></div>
                            <div class="toggle-profile-others">Phone: <span id="loginProfileMobilePhone"><script>$("#loginProfileMobilePhone").html(staffLoginData.mobileNumber);</script></span></div>
                            <div class="header-btn-div">
                                <button class="btn" title="View Profile" type="button" onclick="_getFormWithId('update_staff','');"><i class="bi-person"></i> Profile</button>
                                <button class="btn" title="Log-Out" type="button" onclick="_getForm({page: 'logout_confirm_form', url: adminPortalLocalUrl});"><i class="bi-box-arrow-in-right"></i> Log-Out</button>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
