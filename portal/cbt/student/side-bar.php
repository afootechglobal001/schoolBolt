<div class="side-nav-div animated fadeInLeft">
    <div class="div-in">
        <div class="logo-div">
            <img src="<?php echo $websiteUrl ?>/all-images/images/logo.png" alt="<?php echo $appName ?> logo" />
        </div>

        <div class="nav-wrapper">
            <div class="nav-back-div">
                <div class="title-wrapper">
                    <div class="title-div">
                        <h3>Main</h3>
                    </div>

                    <div class="nav-container">
                        <div class="nav-div active-li" title="Dashboard" id="dashboard"
                            onclick="_getActivePage({page:'dashboard', divid:'dashboard'});">
                            <i class="bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </div>

                        <div class="nav-div" title="Set CBT Exam" id="setExamPage"
                            onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">
                            <i class="bi bi-file-earmark-plus-fill"></i>
                            <span>Set Exam</span>
                        </div>

                        <div class="nav-div" title="Activate CBT Exam" id="activateExamPage"
                            onclick="_getActivePage({page:'activateExamPage', divid:'activateExamPage'});">
                            <i class="bi bi-patch-check-fill"></i>
                            <span>Activate Exam</span>
                        </div>

                        <div class="nav-div" title="View CBT Exam Results" id="viewResultPage"
                            onclick="_getActivePage({page:'viewResultPage', divid:'viewResultPage'});">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>View Results</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav-back-div">
                <div class="title-wrapper">
                    <div class="title-div">
                        <h3>System Configuration</h3>
                    </div>

                    <div class="nav-container">
                        <div class="nav-div setting-nav-div" title="CBT Configuration" id="cbtConfigPage"
                            onclick="_getActivePage({page:'cbtConfigPage', divid:'cbtConfigPage'});">
                            <i class="bi bi-gear-wide-connected"></i>
                            <span>CBT Configuration</span>
                        </div>

                        <div class="nav-div setting-nav-div" title="Log-Out" onclick="_confirmLogOut();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log-Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>