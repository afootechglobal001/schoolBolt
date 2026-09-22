<?php if ($page == 'dashboard') { ?>
    <script>
        userRoles.canViewSuperAdminDashboard && _getActivePage({
            page: 'superAdminDashboard',
            divid: 'dashboard'
        });
        userRoles.canViewAdministratorDashboard && _getActivePage({
            page: 'administratorDashboard',
            divid: 'dashboard'
        });
        userRoles.canViewSubjectTeacherDashboard && _getActivePage({
            page: 'subjectTeacherDashboard',
            divid: 'dashboard'
        });
        userRoles.canViewClassTeacherDashboard && _getActivePage({
            page: 'subjectTeacherDashboard',
            divid: 'dashboard'
        });
        userRoles.canViewIctStaffDashboard && _getActivePage({
            page: 'ICTStaffDashboard',
            divid: 'dashboard'
        });
    </script>
<?php } ?>

<?php if ($page == 'superAdminDashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="dashFullname">
                        <script>
                            $("#dashFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData?.lastName));
                        </script>
                    </span>!</h2>
                <p>Welcome to your dashboard, where you can oversee all your activities, tasks, progress, and
                    updates—helping you stay organized and on track</p>
            </div>
        </div>

        <div class="last-login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="login-title">
                    <h3>Last Login</h3>
                    <span class="active-status">
                        <i class="bi bi-circle-fill"></i>
                        Active
                    </span>
                </div>
            </div>

            <div class="login-info">
                <div class="info-item">
                    <i class="bi bi-calendar-event"></i>
                    <span id="lastLoginDate">
                        <script>
                            $("#lastLoginDate").html(_formatShortDate(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        <script>
                            $("#lastLoginTime").html(_formatTime(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="dashboard-wrapper">
            <div class="statistics-back-div">
                <div class="statistics-div pending-card" id="setExamPage" title="Set CBT Exam"
                    onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">

                    <div class="statistics-inner-div">
                        <div class="statistics-top-div">
                            <div class="statistics-text">
                                <p>Set Exam</p>
                                <span>Create and manage CBT examinations</span>
                            </div>

                            <div class="statistics-icon pending">
                                <i class="bi bi-file-earmark-plus-fill"></i>
                            </div>
                        </div>

                        <div class="statistics-action-div">
                            <div class="action-left">
                                <i class="bi bi-file-earmark-plus-fill"></i>
                                <span>Set CBT Exam</span>
                            </div>

                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <div class="statistics-div upcoming-card" id="activateExamPage" title="Activate CBT Exam"
                    onclick="_getActivePage({page:'activateExamPage', divid:'activateExamPage'});">

                    <div class="statistics-inner-div">
                        <div class="statistics-top-div">
                            <div class="statistics-text">
                                <p>Activate Exam</p>
                                <span>Make CBT exams available to students</span>
                            </div>

                            <div class="statistics-icon upcoming">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                        </div>

                        <div class="statistics-action-div">
                            <div class="action-left">
                                <i class="bi bi-patch-check-fill"></i>
                                <span>Activate CBT Exam</span>
                            </div>

                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- <div class="statistics-div completed-card" id="viewResultPage" title="View CBT Exam Result"
                    onclick="_getActivePage({page:'viewResultPage', divid:'viewResultPage'});">

                    <div class="statistics-inner-div">
                        <div class="statistics-top-div">
                            <div class="statistics-text">
                                <p>View Results</p>
                                <span>View and manage CBT exam results</span>
                            </div>

                            <div class="statistics-icon completed">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                        </div>

                        <div class="statistics-action-div">
                            <div class="action-left">
                                <i class="bi bi-bar-chart-fill"></i>
                                <span>View Exam Results</span>
                            </div>

                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div> -->

                <div class="statistics-div purple-card" id="cbtConfigPage" title="CBT Configuration"
                    onclick="_getActivePage({page:'cbtConfigPage', divid:'cbtConfigPage'});">

                    <div class="statistics-inner-div">
                        <div class="statistics-top-div">
                            <div class="statistics-text">
                                <p>Configuration</p>
                                <span>Configure CBT examination settings</span>
                            </div>

                            <div class="statistics-icon">
                                <i class="bi bi-gear-wide-connected"></i>
                            </div>
                        </div>

                        <div class="statistics-action-div">
                            <div class="action-left">
                                <i class="bi bi-gear-wide-connected"></i>
                                <span>CBT Configuration</span>
                            </div>

                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'administratorDashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="dashFullname">
                        <script>
                            $("#dashFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData?.lastName));
                        </script>
                    </span>!</h2>
                <p>Welcome to your dashboard, where you can oversee all your activities, tasks, progress, and
                    updates—helping you stay organized and on track</p>
            </div>
        </div>

        <div class="last-login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="login-title">
                    <h3>Last Login</h3>
                    <span class="active-status">
                        <i class="bi bi-circle-fill"></i>
                        Active
                    </span>
                </div>
            </div>

            <div class="login-info">
                <div class="info-item">
                    <i class="bi bi-calendar-event"></i>
                    <span id="lastLoginDate">
                        <script>
                            $("#lastLoginDate").html(_formatShortDate(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        <script>
                            $("#lastLoginTime").html(_formatTime(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <script>
            function _writeCbtDashboardItems() {
                let html = `
                    <div class="statistics-div pending-card" id="setExamPage" title="Set CBT Exam"
                        onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">

                        <div class="statistics-inner-div">
                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Set Exam</p>
                                    <span>Create and manage CBT examinations</span>
                                </div>

                                <div class="statistics-icon pending">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                </div>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                    <span>Set CBT Exam</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                `;

                if (userRoles?.canActivateOrDeActivateCbt) {
                    html += `
                        <div class="statistics-div upcoming-card" id="activateExamPage" title="Activate CBT Exam"
                            onclick="_getActivePage({page:'activateExamPage', divid:'activateExamPage'});">

                            <div class="statistics-inner-div">
                                <div class="statistics-top-div">
                                    <div class="statistics-text">
                                        <p>Activate Exam</p>
                                        <span>Make CBT exams available to students</span>
                                    </div>

                                    <div class="statistics-icon upcoming">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>

                                <div class="statistics-action-div">
                                    <div class="action-left">
                                        <i class="bi bi-patch-check-fill"></i>
                                        <span>Activate CBT Exam</span>
                                    </div>

                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    `;
                }

                if (userRoles?.canConfigureCbt) {
                    html += `
                        <div class="statistics-div purple-card" id="cbtConfigPage" title="CBT Configuration"
                            onclick="_getActivePage({page:'cbtConfigPage', divid:'cbtConfigPage'});">

                            <div class="statistics-inner-div">
                                <div class="statistics-top-div">
                                    <div class="statistics-text">
                                        <p>Configuration</p>
                                        <span>Configure CBT examination settings</span>
                                    </div>

                                    <div class="statistics-icon">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </div>
                                </div>

                                <div class="statistics-action-div">
                                    <div class="action-left">
                                        <i class="bi bi-gear-wide-connected"></i>
                                        <span>CBT Configuration</span>
                                    </div>

                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    `;
                }
                $("#cbtDashboardItems").html(html);
            }
        </script>

        <div class="dashboard-wrapper">
            <div class="statistics-back-div" id="cbtDashboardItems">
                <script>_writeCbtDashboardItems();</script>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'subjectTeacherDashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="dashFullname">
                        <script>
                            $("#dashFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData?.lastName));
                        </script>
                    </span>!</h2>
                <p>Welcome to your dashboard, where you can oversee all your activities, tasks, progress, and
                    updates—helping you stay organized and on track</p>
            </div>
        </div>

        <div class="last-login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="login-title">
                    <h3>Last Login</h3>
                    <span class="active-status">
                        <i class="bi bi-circle-fill"></i>
                        Active
                    </span>
                </div>
            </div>

            <div class="login-info">
                <div class="info-item">
                    <i class="bi bi-calendar-event"></i>
                    <span id="lastLoginDate">
                        <script>
                            $("#lastLoginDate").html(_formatShortDate(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        <script>
                            $("#lastLoginTime").html(_formatTime(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="dashboard-wrapper">
            <div class="statistics-back-div">
                <div class="statistics-div pending-card" id="setExamPage" title="Set CBT Exam"
                    onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">

                    <div class="statistics-inner-div">
                        <div class="statistics-top-div">
                            <div class="statistics-text">
                                <p>Set Exam</p>
                                <span>Create and manage CBT examinations</span>
                            </div>

                            <div class="statistics-icon pending">
                                <i class="bi bi-file-earmark-plus-fill"></i>
                            </div>
                        </div>

                        <div class="statistics-action-div">
                            <div class="action-left">
                                <i class="bi bi-file-earmark-plus-fill"></i>
                                <span>Set CBT Exam</span>
                            </div>

                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'ICTStaffDashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="dashFullname">
                        <script>
                            $("#dashFullname").html(capitalizeFirstLetterOfEachWord(staffLoginData?.lastName));
                        </script>
                    </span>!</h2>
                <p>Welcome to your dashboard, where you can oversee all your activities, tasks, progress, and
                    updates—helping you stay organized and on track</p>
            </div>
        </div>

        <div class="last-login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div class="login-title">
                    <h3>Last Login</h3>
                    <span class="active-status">
                        <i class="bi bi-circle-fill"></i>
                        Active
                    </span>
                </div>
            </div>

            <div class="login-info">
                <div class="info-item">
                    <i class="bi bi-calendar-event"></i>
                    <span id="lastLoginDate">
                        <script>
                            $("#lastLoginDate").html(_formatShortDate(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        <script>
                            $("#lastLoginTime").html(_formatTime(staffLoginData.lastLoginTime));
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <script>
            function _writeCbtDashboardItems() {
                let html = `
                    <div class="statistics-div pending-card" id="setExamPage" title="Set CBT Exam"
                        onclick="_getActivePage({page:'setExamPage', divid:'setExamPage'});">

                        <div class="statistics-inner-div">
                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Set Exam</p>
                                    <span>Create and manage CBT examinations</span>
                                </div>

                                <div class="statistics-icon pending">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                </div>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-file-earmark-plus-fill"></i>
                                    <span>Set CBT Exam</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                `;

                if (userRoles?.canActivateOrDeActivateCbt) {
                    html += `
                        <div class="statistics-div upcoming-card" id="activateExamPage" title="Activate CBT Exam"
                            onclick="_getActivePage({page:'activateExamPage', divid:'activateExamPage'});">

                            <div class="statistics-inner-div">
                                <div class="statistics-top-div">
                                    <div class="statistics-text">
                                        <p>Activate Exam</p>
                                        <span>Make CBT exams available to students</span>
                                    </div>

                                    <div class="statistics-icon upcoming">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>

                                <div class="statistics-action-div">
                                    <div class="action-left">
                                        <i class="bi bi-patch-check-fill"></i>
                                        <span>Activate CBT Exam</span>
                                    </div>

                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    `;
                }

                if (userRoles?.canConfigureCbt) {
                    html += `
                        <div class="statistics-div purple-card" id="cbtConfigPage" title="CBT Configuration"
                            onclick="_getActivePage({page:'cbtConfigPage', divid:'cbtConfigPage'});">

                            <div class="statistics-inner-div">
                                <div class="statistics-top-div">
                                    <div class="statistics-text">
                                        <p>Configuration</p>
                                        <span>Configure CBT examination settings</span>
                                    </div>

                                    <div class="statistics-icon">
                                        <i class="bi bi-gear-wide-connected"></i>
                                    </div>
                                </div>

                                <div class="statistics-action-div">
                                    <div class="action-left">
                                        <i class="bi bi-gear-wide-connected"></i>
                                        <span>CBT Configuration</span>
                                    </div>

                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    `;
                }
                $("#cbtDashboardItems").html(html);
            }
        </script>

        <div class="dashboard-wrapper">
            <div class="statistics-back-div" id="cbtDashboardItems">
                <script>_writeCbtDashboardItems();</script>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'logoutConfirmForm') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $websiteUrl ?>/all-images/images/warning.gif" /></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logOut();">YES</button>
                <button class="btn no-btn" onclick="_alertClose(<?php echo $modalLayer ?>);">NO</button>
            </div>
        </div>
    </div>
<?php } ?>