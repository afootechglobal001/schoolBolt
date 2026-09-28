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

                        <div class="log-out-div" onclick="_confirmLogOut();" title="Log-Out">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log-Out</span>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>