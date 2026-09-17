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
                            onclick="_getActiveAdminPage({page:'dashboard', divid:'dashboard'});">
                            <i class="bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </div>

                        <div class="nav-div" title="Administrators" id="administratorsPage"
                            onclick="_getActiveAdminPage({page:'administratorsPage', divid:'administratorsPage'});">
                            <i class="bi bi-person-gear"></i>
                            <span>Administrators</span>
                        </div>

                        <div class="nav-div" title="Schools" id="schoolsPage"
                            onclick="_getActiveAdminPage({page:'schoolsPage', divid:'schoolsPage'});">
                            <i class="bi bi-buildings-fill"></i>
                            <span>Schools</span>
                        </div>

                        <div class="nav-div" title="Reports" id="reportPage"
                            onclick="_getActiveAdminPage({page:'reportPage', divid:'reportPage'});">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                            <span>Reports</span>
                        </div>
                    </div>
                </div>

                <div class="title-wrapper">
                    <div class="title-div">
                        <h3>System</h3>
                    </div>

                    <div class="nav-container">
                        <div class="nav-div" title="Partners" id="partnersPage"
                            onclick="_getActiveAdminPage({page:'partnersPage', divid:'partnersPage'});">
                            <i class="bi bi-stack"></i>
                            <span>Partners</span>
                        </div>

                        <div class="nav-div" title="Portfolio" id="galleryPage"
                            onclick="_getActiveAdminPage({page:'galleryPage', divid:'galleryPage'});">
                            <i class="bi bi-images"></i>
                            <span>Gallery</span>
                        </div>

                        <div class="nav-div" title="Blog" id="blogPage"
                            onclick="_getActiveAdminPage({page:'blogPage', divid:'blogPage'});">
                            <i class="bi bi-journal-text"></i>
                            <span>Blog</span>
                        </div>

                        <div class="nav-div" title="Frequently Asked Questions" id="faqPage"
                            onclick="_getActiveAdminPage({page:'faqPage', divid:'faqPage'});">
                            <i class="bi bi-question-circle"></i>
                            <span>FAQ</span>
                        </div>

                        <div class="nav-div" title="Reviews" id="reviewPage"
                            onclick="_getActiveAdminPage({page:'reviewPage', divid:'reviewPage'});">
                            <i class="bi bi-chat-text"></i>
                            <span>Reviews</span>
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
                        <div class="nav-div" title="System Settings" id="settingsPage"
                            onclick="_getActiveAdminPage({page:'settingsPage', divid:'settingsPage'});">
                            <i class="bi-gear"></i>
                            <span>Settings</span>
                        </div>

                        <div class="nav-div" title="Log-Out" onclick="_confirmLogOut();">
                            <i class="bi-box-arrow-right"></i>
                            <span>Log-Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>