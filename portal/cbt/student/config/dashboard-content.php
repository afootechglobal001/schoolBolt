<?php if ($page == 'dashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-journal-check"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="dashFullname">
                        <script>$("#dashFullname").html(capitalizeFirstLetterOfEachWord(studentLoginData?.studentData?.fullName || "User"));</script>
                    </span>!</h2>
                <p>Access your exams, read the instructions carefully, and take your CBT.</p>
            
                <div class="alert alert-success detail-alert">
                    <i class="bi bi-mortarboard-fill"></i>
                    Department: <strong><span id="dashDepartment"><script>$("#dashDepartment").html(studentLoginData?.departmentData?.departmentName ?? "");</script></span></strong> 
                    Class: <strong><span id="">KG</span></strong> |
                    Arm: <strong><span id="dashArm"><script>$("#dashArm").html(studentLoginData?.armData?.armName ?? "");</script></span></strong>
                </div>

                <div class="alert alert-success detail-alert mobile-current-session-alert">
                    <i class="bi bi-mortarboard-fill"></i>
                    Current Session & Term: <strong> <span id="dashCurrentSession"><script>$("#dashCurrentSession").html(studentLoginData?.session + " - " + studentLoginData?.termData?.termName ?? "");</script></span></strong> 
                </div>
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
                            $("#lastLoginDate").html(_formatShortDate(studentLoginData?.studentData?.lastLoginTime ?? ""));
                        </script>
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        <script>
                            $("#lastLoginTime").html(_formatTime(studentLoginData?.studentData?.lastLoginTime ?? ""));
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-clipboard-check"></i>
                    <p>My CBT Exams</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="toggle-wrapper" id="availableCbtExamsContent">
                    <script>
                        _fetchAvailableCbtExamsData();
                    </script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
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