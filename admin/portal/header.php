<?php include 'alert.php' ?>
<header class="fadeInDown animated">
    <div class="header-div-in">
        <div class="header-nav-div">
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

                    <div class="icon-div" onclick="_getActivePage({page:'settingsPage', divid:'settingsPage'});"
                        title="System Settings">
                        <i class="bi-gear"></i>
                    </div>

                    <div class="icon-div bell_notification"
                        onclick="" title="System Alert">
                        <i class="bi-bell"></i>
                        <div>20</div>
                    </div>
                </div>

                <div class="right-icon-div no-border" title="Click To View Profile" onclick="_toggleProfileDiv()">
                    <div class="profile-div">
                        <div class="info-div">
                            <div class="name"><strong id="loginHeaderName">Hon.Emmanuel Paul</strong></div>
                            <div class="role" id="loginRoleName">SUPER ADMIN</div>
                        </div>

                        <div class="img-div" id="profilePix">
                            <script>
                            $("#profilePix").html(
                                '<img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">'
                                );
                            </script>
                        </div>
                    </div>
                </div>

                <div class="toggle">
                    <div class="toggle-in">
                        <div class="toggle-title">
                            <div class="dp" id="loginProfileName">
                                EP
                            </div>
                            <div class="text">
                                <h2 id="loginUserFullname">
                                    Hon.Emmanuel Paul
                                </h2>
                                <p id="loginUserEmail">
                                    seunemmanuel107@gmail.com
                                </p>
                                <p id="loginUserPhone"></p>
                                07050903886
                                </p>
                            </div>
                        </div>

                        <ul>
                            <li title="Dashboard" onclick="_getActivePage({page:'dashboard', divid:'dashboard'});">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </li>
                            <li title="Administrators" onclick="_getActivePage({page:'adminPage', divid:'adminPage'});">
                                <i class="bi bi-people"></i> Administrators
                            </li>
                            <li title="Artisan"
                                onclick="_getActivePage({page:'artisanPage', divid:'artisanPage'});">
                                <i class="bi bi-tools"></i> Artisan
                            </li>
                            <li title="Task"
                                onclick="_getActivePage({page:'taskPage', divid:'taskPage'});">
                                <i class="bi bi-list-check"></i> Task
                            </li>
                            <li title="Invoice"
                                onclick="_getActivePage({page:'invoicePage', divid:'invoicePage'});">
                                <i class="bi bi-receipt"></i> Invoice
                            </li>
                            <li title="Services" onclick="_getActivePage({page:'servicePage', divid:'servicePage'});">
                                <i class="bi bi-stack"></i> Services
                            </li>
                            <li title="Gallery"
                                onclick="_getActivePage({page:'galleryPage', divid:'galleryPage'});">
                                <i class="bi bi-images"></i> Gallery
                            </li>
                            <li title="Blog"
                                onclick="_getActivePage({page:'blogPage', divid:'blogPage'});">
                                <i class="bi bi-journal-text"></i> Blog
                            </li>
                            <li title="Frequently Asked Questions"
                                onclick="_getActivePage({page:'faqPage', divid:'faqPage'});">
                                <i class="bi bi-question-circle"></i> FAQ
                            </li>
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