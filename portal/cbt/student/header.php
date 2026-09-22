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
                                        2025/2026 - THIRD TERM
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
                                IK
                            </div>
                            <div class="text">
                                <h2 id="loginUserFullname">
                                    Ikong Emmanuel
                                </h2>
                                <p id="loginUserEmail">
                                    STUDENT00123435565435
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