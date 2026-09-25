<?php include 'alert.php' ?>
<header class="fadeInDown animated">
    <div class="header-div-in">
        <div class="header-nav-div">
            <div class="logo-div">
                <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="<?php echo $appName ?> logo" />
            </div>
            
            <div class="left-nav">
                <ul>
                    <li class="active-li" title="Dashboard"
                        onclick="_getActivePage({page:'dashboard', divid:'topDashboard'});" id="topDashboard"><i
                            class="bi-speedometer2"></i> Dashboard</li>
                </ul>
            </div>

            <div class="right-nav">
                <div class="right-icon-div left-icon-div">
                    <button class="mode-switch" title="Switch Mode" id="darkModeBtn">
                        <i class="bi bi-moon"></i>
                    </button>
                </div>

                <div class="right-icon-div no-border">
                    <div class="profile-div">
                        <div class="current-term-card">
                            <div class="card-item">
                                <i class="bi bi-mortarboard-fill"></i>
                                <span>
                                    Current Session & Term: 
                                </span>

                                <div>
                                    <strong id="currentSession">
                                        <script>
                                            $("#currentSession").html(staffLoginData?.branchData?.session+" - "+staffLoginData?.termData?.termName);
                                        </script>
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <div class="img-div" id="profilePix" title="Click To View Profile" onclick="_toggleCbtProfileDiv()">
                            <script>
                                $("#profilePix").html('<img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="toggle">
                    <div class="toggle-in">
                        <div class="toggle-title">
                            <div class="dp" id="loginProfileName">
                                <script>
                                    $("#loginProfileName").html(getFirstLettersOfEachWord(staffLoginData?.firstName + " " + staffLoginData?.lastName));
                                </script>
                            </div>
                            <div class="text">
                                <h2 id="loginUserFullname">
                                    <script>
                                        $("#loginUserFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData?.firstName + " " + staffLoginData?.lastName));
                                    </script>
                                </h2>
                                <p id="loginUserEmail">
                                    <script>
                                        $("#loginUserEmail").html(staffLoginData?.emailAddress);
                                    </script>
                                </p>
                                <p id="loginUserPhone"></p>
                                    <script>
                                        $("#loginUserPhone").html(staffLoginData?.phoneNumber);
                                    </script>
                                </p>
                            </div>
                        </div>

                        <script>
                            function _writeCbtNavbarItems() {
                                document.write(`
                                    <li title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});">
                                        <i class="bi bi-speedometer2"></i> Dashboard
                                    </li>
                                `);

                                document.write(`
                                    <li title="Set Exam"
                                        onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">
                                        <i class="bi bi-file-earmark-plus-fill"></i> Set Exam
                                    </li>
                                `);

                                if (userRoles?.canActivateOrDeActivateCbt) {
                                    document.write(`
                                        <li title="Activate Exam"
                                            onclick="_getActivePage({page:'activateExamPage', divid:'activateExamPage'});">
                                            <i class="bi bi-patch-check-fill"></i> Activate Exam
                                        </li>
                                    `);
                                }

                                // if (userRoles?.canViewCbtResult) {
                                //     document.write(`
                                //         <li title="View Results"
                                //             onclick="_getActivePage({page:'viewResultPage', divid:'viewResultPage'});">
                                //             <i class="bi bi-bar-chart-fill"></i> View Results
                                //         </li>
                                //     `);
                                // }

                                if (userRoles?.canConfigureCbt) {
                                    document.write(`
                                        <li title="CBT Configuration"
                                            onclick="_getActivePage({page:'cbtConfigPage', divid:'cbtConfigPage'});">
                                            <i class="bi bi-gear-wide-connected"></i> CBT Configuration
                                        </li>
                                    `);
                                }

                                document.write(`
                                    <li class="logOut" title="Log-Out" onclick="_confirmLogOut();">
                                        <i class="bi bi-power"></i> Log-Out
                                    </li>
                                `);
                            }
                        </script>

                        <ul>
                            <script>_writeCbtNavbarItems();</script>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>