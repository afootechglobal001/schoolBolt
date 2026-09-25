<?php include 'alert.php' ?>
<header class="fadeInDown animated">
    <div class="header-div-in">
        <div class="header-nav-div">
            <div class="logo-div">
                <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="<?php echo $appName ?> logo" />
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
                                        <script>$("#currentSession").html(studentLoginData?.session + " - " + studentLoginData?.termData?.termName ?? "");</script>
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
                                    $("#loginProfileName").html(getFirstLettersOfEachWord(studentLoginData?.studentData.fullName || ""));
                                </script>
                            </div>
                            <div class="text">
                                <h2 id="loginUserFullname">
                                    <script>$("#loginUserFullname").html(capitalizeFirstLetterOfEachWord(studentLoginData?.studentData?.fullName || "User"));</script>
                                </h2>
                                <p id="loginUserId">
                                    <script>$("#loginUserId").html(studentLoginData?.studentData?.studentId ?? "");</script>
                                </p>
                            </div>
                        </div>

                        <ul>
                            <li class="logOut" title="Log-Out" onclick="_confirmLogOut();">
                                <i class="bi bi-power"></i> Log-Out
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>