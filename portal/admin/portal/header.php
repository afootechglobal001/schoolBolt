<?php include 'alert.php' ?>
<header class="fadeInDown animated">
    <div class="header-div-in">
        <div class="logo-back-div">
            <div class="menu-div" title="Open Menu" onclick="_openMenu()" id="menu-div"><i class="bi-text-right"></i>
            </div>
            <div class="logo-div"><img src="<?php echo $websiteUrl ?>/images/logo.png"
                    alt="<?php echo $appName ?> logo" /></div>
        </div>

        <div class="header-nav-div">
            <div class="left-nav">
                <div class="search-back-div">
                    <div class="search-div">
                        <input type="text" onkeyup="" placeholder="Search Here...">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>

            <div class="right-nav">
                <div class="right-icon-div left-icon-div">
                    <script>
                        if (userRoles.canViewGeneralSettings) {
                            document.write(`
                                <div class="icon-div" onclick="_getActivePage({page:'settings'});" title="System Settings">
                                    <i class="bi-gear"></i>
                                </div>
                            `);
                        }
                    </script>

                    <script>
                        if (userRoles.canViewGeneralNotifications) {
                            document.write(`
                                <div class="icon-div bell_notification" onClick="_get_page('system_alert');" title="System Alert">
                                    <i class="bi-bell"></i>
                                    <div>20</div>
                                </div>
                            `);
                        }
                    </script>
                </div>

                <div class="right-icon-div no-border" title="Click To View Profile" onclick="_toggleProfileDiv()">
                    <div class="profile-div">
                        <div class="info-div">
                            <div class="name" id="loginHeaderName"><strong>
                                    <script>
                                        $("#loginHeaderName").html(capitalizeFirstLetterOfEachWord(staffLoginData
                                            .fullName));
                                    </script>
                                </strong></div>
                            <div class="role" id="loginRoleName">
                                <script>
                                    $("#loginRoleName").html(capitalizeFirstLetterOfEachWord(staffLoginData.roleName));
                                </script>
                            </div>
                        </div>
                        <div class="img-div" id="profile_pix">
                            <script>
                                $("#profile_pix").html('<img src="<?php echo $websiteUrl; ?>/uploaded_files/staffPix/' +
                                    staffLoginData.profilePix + '" alt="Profile Image">');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="toggle-profile-div">
                    <div class="toggle-div-in">
                        <div class="toggle-profile-pix-div" id="profile_pix2">
                            <script>
                                $("#profile_pix2").html('<img src="<?php echo $websiteUrl; ?>/uploaded_files/staffPix/' +
                                    staffLoginData.profilePix + '" alt="Profile Image">');
                            </script>
                        </div>
                        <div class="header-content">
                            <div class="toggle-profile-name"><span id="loginProfileName">
                                    <script>
                                        $("#loginProfileName").html(capitalizeFirstLetterOfEachWord(staffLoginData
                                            .fullName));
                                    </script>
                                </span></div>
                            <div class="toggle-profile-others"><span id="loginProfileStaffId">
                                    <script>
                                        $("#loginProfileStaffId").html(staffLoginData.staffId);
                                    </script>
                                </span></div>
                            <div class="header-btn-div">
                                <script>
                                    document.write(`
                                        <button class="btn" title="View Profile" type="button" onclick="_fetchEachStaff('${staffLoginData.staffId}');"><i class="bi-person"></i> Profile</button>
                                    `);
                                </script>
                                <button class="btn" title="Log-Out" type="button"
                                    onclick="_confirmLogOut();"><i
                                        class="bi-box-arrow-in-right"></i> Log-Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>