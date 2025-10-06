<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branches') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div other-pages-title-div">
            <div class="main-title title"><i class="bi-diagram-3"></i> <strong>Branches</strong></div>
            <div class="other-pg-statistics-container" id="statusContent"></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')"
                        placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search branch...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW BRANCH"
                    onclick="_getForm({page: 'branch_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW BRANCH
                </button>
            </div>

        </div>
    </div>

    <div class="pages-back-div other-pg-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script>
                    _fetchBranches();
                </script>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW BRANCH</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW BRANCH</span>
                    </div>
                </div>

                <div class="text_field_container" id="name_container">
                    <script>
                        textField({
                            id: 'name',
                            title: 'Branch Name'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="mobileNumber_container">
                    <script>
                        textField({
                            id: 'mobileNumber',
                            title: 'Branch Phone Number',
                            type: 'tel',
                            onKeyPressFunction: 'isNumberCheck(event);'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="stateId_container">
                    <script>
                        selectField({
                            id: 'stateId',
                            title: 'Select Branch State',
                        });
                        _getSelectGeneralState('stateId');
                    </script>
                </div>

                <div class="text_field_container" id="lgaId_container">
                    <script>
                        selectField({
                            id: 'lgaId',
                            title: 'Select Branch Local Govt Area'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="address_container">
                    <script>
                        textField({
                            id: 'address',
                            title: 'Branch Address'
                        });
                    </script>
                </div>

                <div class="alert alert-success form-alert"><span>BRANCH SMTP INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="smtpHost_container">
                            <script>
                                textField({
                                    id: 'smtpHost',
                                    title: 'SMTP HOST'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpUsername_container">
                            <script>
                                textField({
                                    id: 'smtpUsername',
                                    title: 'SMTP USERNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpPassword_container">
                            <script>
                                textField({
                                    id: 'smtpPassword',
                                    title: 'SMTP PASSWORD',
                                    type: 'password'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpPort_container">
                            <script>
                                textField({
                                    id: 'smtpPort',
                                    title: 'SMTP PORT',
                                    type: 'number'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="supportEmail_container">
                            <script>
                                textField({
                                    id: 'supportEmail',
                                    title: 'SUPPORT EMAIL',
                                    type: 'email'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert"><span>SCHOOL PAYMENT CONFIGURATION</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="accountName_container">
                            <script>
                                textField({
                                    id: 'accountName',
                                    title: 'BUSINESS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="paymentKey_container">
                            <script>
                                textField({
                                    id: 'paymentKey',
                                    title: 'PAYMENT KEY'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="secretKey_container">
                            <script>
                                textField({
                                    id: 'secretKey',
                                    title: 'SECRET KEY'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="receiverKey_container">
                            <script>
                                textField({
                                    id: 'receiverKey',
                                    title: 'RECEIVER KEY'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert"><span>TERMINAL CONFIGURATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="session_container">
                            <script>
                                textField({
                                    id: 'session',
                                    title: 'SESSION'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="termId_container">
                            <script>
                                selectField({
                                    id: 'termId',
                                    title: 'Select Term'
                                });
                                _getSelectTermId('termId');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert"><span>SELECT BRANCH DEPARTMENTS</span>
                    <div class="permission-form-back-div">
                        <div class="title-div">
                            <h4>Departments</h4>
                            <p>Use the toggles below to assign registered Departments to their respective branches.
                                Switching to "Yes" activates the department for branch use.</p>
                        </div>

                        <div class="permission-toggle-div">
                            <div class="toggle-title">Registered Departments</div>
                            <div class="fetch-toggle" id="pageContentToggle"></div>
                        </div>

                        <script>
                            _fetchDepartmentToggle();
                        </script>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Branch Manager'
                        });
                        _getSelectBranchManagerId('staffId');
                    </script>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status'
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createBranch();"> <i class="bi-check"></i>
                        SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branch_pages') { ?>
    <script>
        getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-diagram-3"></i> BRANCH PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <div class="img-div">
                        <img id="profileSchoolLogoImg" src="<?php echo $websiteUrl ?>/images/portal-logo.jpg"
                            alt="Profile Image">
                    </div>

                    <script>
                        $(document).ready(function() {
                            const schoolLogo = getEachBranchDetailsSession.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` :
                                "<?php echo $websiteUrl ?>/images/portal-logo.jpg";

                            $("#profileSchoolLogoImg").attr("src", logoUrl).attr("alt", getEachBranchDetailsSession
                                .name + " Logo");
                        });
                    </script>


                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="name">
                                    <script>
                                        $("#name").html(getEachBranchDetailsSession.name);
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn"><span id="statusName"></span></div>
                                    </div>
                                    | OFFICIAL EMAIL:
                                    <strong id="smtpUsername">
                                        <script>
                                            $("#smtpUsername").html(getEachBranchDetailsSession.smtpUsername);
                                        </script>
                                    </strong>

                                    | SESSION:
                                    <strong id="session">
                                        <script>
                                            $("#session").html(getEachBranchDetailsSession.session);
                                        </script>
                                    </strong>

                                    | TERM:
                                    <strong id="termName">
                                        <script>
                                            $("#termName").html(getEachBranchDetailsSession?.termData[0]?.termName);
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachBranchDetailsSession.statusName;
                                        $("#statusName").html(statusName);
                                        $("#statusBtn").addClass(statusName);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav-div">
                <div class="div-in">
                    <ul id="branchNavUl">
                        <li class="active" title="Dashboard" id="branch_dashboard"
                            onclick="_getActiveBranchPage({divid:'branch_dashboard', page: 'branch_dashboard', url: adminPortalLocalUrl});">
                            <i class="bi-speedometer2"></i> Dashboard
                        </li>

                        <script>
                            if (userRoles.canViewBranchSettings) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Settings" id="branch_settings"
                                    onclick="_getActiveBranchPage({divid:'branch_settings', page: 'branch_settings', url: adminPortalLocalUrl});">
                                    <i class="bi-gear-wide-connected"></i> Settings
                                </li>
                            `);
                            }

                            if (userRoles.canViewBranchStaff) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Staff" id="branch_staff"
                                    onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl});">
                                    <i class="bi-person-workspace"></i> Staff
                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchStudents) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Student"><i class="bi-mortarboard"></i>
                                    Student
                                    <ul class="animated fadeIn">
                                        <li id="reg_students" title="Register Students"
                                            onclick="_getForm({page: 'branch_student_reg', layer:2, url: adminPortalLocalUrl});">
                                            <i class="bi-mortarboard"></i>Register Student
                                        </li>

                                        <li id="my_students" title="View Students"
                                            onclick="_getForm({page: 'student_select_form', layer:2, url: adminPortalLocalUrl});">
                                            <i class="bi-mortarboard"></i>View Student
                                        </li>

                                        <li id="my_students" title="Search Students"
                                            onclick="_getActiveBranchPage({divid:'branch_student_search', page: 'branch_student_search', url: adminPortalLocalUrl});">
                                            <i class="bi-search"></i>Search Student
                                        </li>

                                        <li id="my_students" title="Student Archived"
                                            onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});">
                                            <i class="bi-mortarboard"></i>Student Archived
                                        </li>

                                        <li id="my_students" title="Student Alumni"
                                            onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});">
                                            <i class="bi-mortarboard"></i>Student Alumni
                                        </li>
                                    </ul>

                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchClasses) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Class" id="branch_department_class"
                                    onclick="_getActiveBranchPage({divid:'branch_department_class', page: 'branch_department_class', url: adminPortalLocalUrl});">
                                    <i class="bi-people-fill"></i> Class
                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchSubjects) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Subject" id="branch_subjects"
                                    onclick="_getForm({page: 'subject_select_form', layer:2, url: adminPortalLocalUrl});"><i class="bi-journals"></i> Subject</li>
                            `);
                            }
                            if (userRoles.canViewBranchResults) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Record"><i class="bi-person-lines-fill"></i> Result
                                    <ul class="animated fadeIn">
                                        <li title="Broad/Report Sheet"
                                            onclick="_getForm({page: 'broadsheet_select_form', layer:2, url: adminPortalLocalUrl});">
                                            <i class="bi-person-lines-fill"></i>Broad/Report Sheet
                                        </li>
                                        <li title="Cumulative Broadsheet"><i class="bi-person-lines-fill"></i>Cumulative
                                            Broadsheet
                                        </li>
                                        <li title="Promotional Panel"><i class="bi-person-lines-fill"></i>Promotion Panel</li>
                                    </ul>

                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchProfile) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Profile" id="branch_profile"
                                    onclick="_getActiveBranchPage({divid:'branch_profile', page: 'branch_profile', url: adminPortalLocalUrl});">
                                    <i class="bi-diagram-3"></i> Profile
                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchAccount) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Account" id="branch_account"
                                    onclick="_getActiveBranchPage({divid:'branch_account', page: 'branch_account', url: adminPortalLocalUrl});">
                                    <i class="bi-wallet2"></i> Account
                                </li>
                            `);
                            }
                            if (userRoles.canViewBranchActivities) {
                                $('#branchNavUl').append(`
                                <li class="hide-li" title="Branch Activities" id="branch_activities"
                                    onclick="_getActiveBranchPage({divid:'branch_activities', page: 'branch_activities', url: adminPortalLocalUrl});">
                                    <i class="bi-bell"></i> Activities
                                </li>
                            `);
                            }
                        </script>

                        <!-- for mobile view -->
                        <li class="li" title="Other Links"><i class="bi-three-dots-vertical"></i>
                            <ul class="ul" id="branchNavUlMobile">
                                <li title="Dashboard"
                                    onclick="_getActiveBranchPage({divid:'branch_dashboard', page: 'branch_dashboard', url: adminPortalLocalUrl});">
                                    <i class="bi-speedometer2"></i> <span>Dashboard</span>
                                </li>
                                <script>
                                    if (userRoles.canViewBranchSettings) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Settings"
                                    onclick="_getActiveBranchPage({divid:'branch_settings', page: 'branch_settings', url: adminPortalLocalUrl});">
                                    <i class="bi-gear-wide-connected"></i> <span>Settings</span>
                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchStaff) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Staff"
                                    onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl});">
                                    <i class="bi-person-workspace"></i> <span>Staff</span>
                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchStudents) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Student"><i class="bi-mortarboard"></i>
                                <span>Student</span>
                                <ul class="ul-expand animated fadeIn">
                                    <li id="reg_students" title="Register Students"
                                        onclick="_getForm({page: 'branch_student_reg', layer:2, url: adminPortalLocalUrl});">
                                        <i class="bi-mortarboard"></i>Register Student
                                    </li>

                                    <li id="my_students" title="View Students"
                                        onclick="_getForm({page: 'student_select_form', layer:2, url: adminPortalLocalUrl});">
                                        <i class="bi-mortarboard"></i>View Student
                                    </li>

                                    <li id="my_students" title="Search Students"
                                        onclick="_getActiveBranchPage({divid:'branch_student_search', page: 'branch_student_search', url: adminPortalLocalUrl});">
                                        <i class="bi-search"></i>Search Student
                                    </li>

                                    <li id="my_students" title="Student Archived"
                                        onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});">
                                        <i class="bi-mortarboard"></i>Student Archived
                                    </li>

                                    <li id="my_students" title="Student Alumni"
                                        onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});">
                                        <i class="bi-mortarboard"></i>Student Alumni
                                    </li>
                                </ul>

                            </li>
                            `);
                                    }

                                    if (userRoles.canViewBranchClasses) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Class"
                                    onclick="_getActiveBranchPage({divid:'branch_department_class', page: 'branch_department_class', url: adminPortalLocalUrl});">
                                    <i class="bi-people-fill"></i> <span>Class</span>
                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchSubjects) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Subject"
                                     onclick="_getForm({page: 'subject_select_form', layer:2, url: adminPortalLocalUrl});">
                                    <i class="bi-journals"></i> <span>Subject</span>
                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchResults) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Record"><i class="bi-person-lines-fill"></i> Result
                                    <ul class="ul-expand animated fadeIn">
                                        <li title="Broad/Report Sheet"
                                            onclick="_getForm({page: 'broadsheet_select_form', layer:2, url: adminPortalLocalUrl});">
                                            <i class="bi-person-lines-fill"></i>Broad/Report Sheet
                                        </li>
                                        <li title="Cumulative Broadsheet"><i class="bi-person-lines-fill"></i>Cumulative
                                            Broadsheet
                                        </li>
                                        <li title="Promotional Panel"><i class="bi-person-lines-fill"></i>Promotion Panel</li>
                                    </ul>

                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchProfile) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Profile"
                                    onclick="_getActiveBranchPage({divid:'branch_profile', page: 'branch_profile', url: adminPortalLocalUrl});">
                                    <i class="bi-diagram-3"></i> <span>Profile</span>
                                </li>
                            `);
                                    }

                                    if (userRoles.canViewBranchAccount) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Account"
                                    onclick="_getActiveBranchPage({divid:'branch_account', page: 'branch_account', url: adminPortalLocalUrl});">
                                    <i class="bi-graph-up-arrow"></i> <span>Account</span>
                                </li>
                            `);
                                    }
                                    if (userRoles.canViewBranchActivities) {
                                        $('#branchNavUlMobile').append(`
                                <li title="Branch Activities"
                                    onclick="_getActiveBranchPage({divid:'branch_activities', page: 'branch_activities', url: adminPortalLocalUrl});">
                                    <i class="bi-bell"></i> <span>Activities</span>
                                </li>
                            `);
                                    }
                                </script>
                            </ul>
                </div>
            </div>

            <div class="field-back-div background-color">
                <div class="field-inner-div branch-field-inner-div" id="get_branch_details">
                    <script>
                        _getActiveBranchPage({
                            divid: 'branch_dashboard',
                            page: 'branch_dashboard',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<!-- For Branch Modal Pages -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_dashboard') { ?>
    <script>
        userRoles.canViewSuperAdminDashboard && _getActiveBranchPage({
            divid: 'branch_dashboard',
            page: 'branch_super_admin_dashboard',
            url: adminPortalLocalUrl
        });

        (userRoles.canViewAdministratorDashboard || userRoles.canViewIctStaffDashboard) && _getActiveBranchPage({
            divid: 'branch_dashboard',
            page: 'branch_admin_dashboard',
            url: adminPortalLocalUrl
        });
        userRoles.canViewBursaryDashboard && _getActiveBranchPage({
            divid: 'branch_dashboard',
            page: 'branch_bursary_dashboard',
            url: adminPortalLocalUrl
        });
    </script>
<?php } ?>

<?php if ($page == 'branch_super_admin_dashboard') { ?>
    <div class="dashboard-statistics-wrapper">
        <div class="left-dashbaord-container">
            <div class="statistics-chart-back-div">
                <div class="new-statistics-back-div">
                    <div class="new-statistics-div" id="branch" title="Staffs"
                        onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl});">
                        <div class="statistics-inner-div">
                            <div class="statistics-text">
                                <p>Staffs</p>
                                <span>Statistics of Staffs</span>
                                <h2 id="totalActiveBranchStaffCount">0</h2>
                            </div>
                            <div class="statistics-icon pending"><i class="bi-person-bounding-box"></i></div>
                        </div>
                    </div>

                    <div class="new-statistics-div" title="Students">
                        <div class="statistics-inner-div">
                            <div class="statistics-text">
                                <p>Students</p>
                                <span>Statistics of Students</span>
                                <h2 id="totalActiveBranchStudentCount">0</h2>
                            </div>
                            <div class="statistics-icon upcoming"><i class="bi-people"></i></div>
                        </div>
                    </div>

                    <div class="new-statistics-div" title="Subjects" onclick="_fetchBranchDepartment();">
                        <div class="statistics-inner-div">
                            <div class="statistics-text">
                                <p>Department</p>
                                <span>Statistics of Departments</span>
                                <h2 id="totalActiveBranchDepartmentCount">0</h2>
                            </div>
                            <div class="statistics-icon completed"><i class="bi-journals"></i></div>
                        </div>
                    </div>

                    <div class="new-statistics-div" id="branch_department_class" onclick="" title="Class">
                        <div class="statistics-inner-div">
                            <div class="statistics-text">
                                <p>Alumni</p>
                                <span>Statistics of Alumni</span>
                                <h2 id="totalAlumniBranchStudentCount">0</h2>
                            </div>
                            <div class="statistics-icon pending"><i class="bi-people"></i></div>
                        </div>
                    </div>
                </div>

                <div class="chart-back-div">
                    <div class="chart-div-notifications top-border-radius">
                        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

                        <div class="text text-right" onclick="select_search()">
                            <span id="srch-text">Last 30 Days</span>
                            <div class="icon-div"><i class="bi-caret-down"></i></div>

                            <div class="srch-select alert-srch-select">
                                <div id="srch-today" onclick="_fetchBranchRevenueFiltering('srch-today', 'Today');">Today
                                </div>
                                <div id="srch-week" onclick="_fetchBranchRevenueFiltering('srch-week', 'This Week');">This
                                    Week</div>
                                <div id="srch-7" onclick="_fetchBranchRevenueFiltering('srch-7', 'Last 7 Days');">Last 7
                                    Days
                                </div>
                                <div id="srch-month" onclick="_fetchBranchRevenueFiltering('srch-month', 'This Month');">
                                    This
                                    Month</div>
                                <div id="srch-30" onclick="_fetchBranchRevenueFiltering('srch-30', 'Last 30 Days');">Last 30
                                    Days
                                </div>
                                <div id="srch-90" onclick="_fetchBranchRevenueFiltering('srch-90', 'Last 90 Days');">Last 90
                                    Days
                                </div>
                                <div id="srch-year" onclick="_fetchBranchRevenueFiltering('srch-year', 'This Year');">This
                                    Year</div>
                                <div id="srch-1year" onclick="_fetchBranchRevenueFiltering('srch-1year', 'Last 1 Year');">
                                    Last 1
                                    Year</div>
                                <div onclick="srch_custom('Custom Search')">Custom Search</div>
                            </div>
                        </div>

                        <div class="text">
                            <div class="custom-srch-div">
                                <div class="custom-srch-div-in">
                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from"
                                            placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                                        </div>
                                        <div class="issueText" id="issue_from"></div>
                                    </div>

                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to"
                                            placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
                                        <div class="issueText" id="issue_to"></div>
                                    </div>
                                    <button type="button" class="btn"
                                        onclick="_fetchBranchCustomRevenueFiltering();">Apply</button>
                                </div>
                            </div>
                        </div>


                        <script language="javascript">
                            $('#datepickers-from').datetimepicker({
                                lang: 'en',
                                timepicker: false,
                                format: 'Y-m-d',
                                formatDate: 'Y-M-d',
                            });

                            $('#datepickers-to').datetimepicker({
                                lang: 'en',
                                timepicker: false,
                                format: 'Y-m-d',
                                formatDate: 'Y-M-d',
                            });
                        </script>
                    </div>

                    <div class="trending-back-div">
                        <div class="revenue-div">
                            <p>Revenue from <span id="branchRevenueFrom">January 18 2025</span> - <span
                                    id="branchRevenueTo">February 17 2025</span></p>
                            <div class="fund-div">
                                <h3>
                                    <p id="branchRevenueCreditCard"><s>N</s> Loading...</p><span>Credit Card</span>
                                </h3>
                                <h3>
                                    <p id="branchRevenueBankTransfer"><s>N</s> Loading...</p><span>Bank Transfer</span>
                                </h3>
                            </div>
                        </div>

                        <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>
                        <script>
                            $(document).ready(function() {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title: {
                                        text: ""
                                    },
                                    axisX: {
                                        valueFormatString: "DD MMM",
                                        crosshair: {
                                            enabled: true,
                                            snapToDataPoint: true
                                        }
                                    },
                                    axisY: {
                                        title: "",
                                        includeZero: true,
                                        crosshair: {
                                            enabled: true
                                        }
                                    },
                                    toolTip: {
                                        shared: true
                                    },
                                    legend: {
                                        cursor: "pointer",
                                        verticalAlign: "bottom",
                                        horizontalAlign: "left",
                                        dockInsidePlotArea: true,
                                        itemclick: toogleDataSeries
                                    },
                                    data: [{
                                        type: "column",
                                        showInLegend: true,
                                        name: "Revenue",
                                        xValueFormatString: "DD MMM, YYYY",
                                        color: "#328ab3",
                                        dataPoints: [ //{
                                            //         x: new Date(2025, 0, 1),
                                            //         y: 250000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 2),
                                            //         y: 180000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 3),
                                            //         y: 100000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 4),
                                            //         y: 300000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 5),
                                            //         y: 120000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 6),
                                            //         y: 150000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 7),
                                            //         y: 275000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 8),
                                            //         y: 160000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 9),
                                            //         y: 350000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 10),
                                            //         y: 380000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 11),
                                            //         y: 0
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 12),
                                            //         y: 100000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 13),
                                            //         y: 0
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 14),
                                            //         y: 180000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 15),
                                            //         y: 270000
                                            //     },
                                        ]
                                    }, ]

                                });
                                chart.render();

                                function toogleDataSeries(e) {
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                        e.dataSeries.visible = false;
                                    } else {
                                        e.dataSeries.visible = true;
                                    }
                                    chart.render();
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-dashbaord-container">
            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title">
                        <h3>Payment Matrix</h3>
                    </div>
                    <div id="chartContainer2" style="width:100%; height:200px; margin:auto;"></div>

                    <script type="text/javascript">
                        var options = {
                            title: {
                                text: "" /*My Performance*/
                            },
                            data: [{
                                type: "pie",
                                startAngle: 45,
                                showInLegend: "False",
                                legendText: "{label}",
                                indexLabel: "{label} ({y})",
                                yValueFormatString: "#,##0.#" % "",
                                dataPoints: [{
                                        label: "Debit/Credit Card",
                                        y: 3
                                    },
                                    {
                                        label: "Wallet",
                                        y: 2
                                    },
                                    {
                                        label: "Bank Transfer",
                                        y: 11
                                    },
                                ]
                            }]
                        };
                        $("#chartContainer2").CanvasJSChart(options);
                    </script>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                _fetchBranchDashboardStatistics();
                _fetchBranchRevenueFiltering('srch-30', 'Last 30 Days');
            });
        </script>
    </div>
<?php } ?>

<?php if ($page == 'branch_admin_dashboard') { ?>
    <div class="new-statistics-back-div">
        <div class="new-statistics-div" id="branch" title="Staffs"
            onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl});">
            <div class="statistics-inner-div">
                <div class="statistics-text">
                    <p>Staffs</p>
                    <span>Statistics of Staffs</span>
                    <h2 id="totalActiveBranchStaffCount">0</h2>
                </div>
                <div class="statistics-icon pending"><i class="bi-person-bounding-box"></i></div>
            </div>
        </div>

        <div class="new-statistics-div" title="Students">
            <div class="statistics-inner-div">
                <div class="statistics-text">
                    <p>Students</p>
                    <span>Statistics of Students</span>
                    <h2 id="totalActiveBranchStudentCount">0</h2>
                </div>
                <div class="statistics-icon upcoming"><i class="bi-people"></i></div>
            </div>
        </div>

        <div class="new-statistics-div" title="Subjects"
            onclick="_fetchBranchDepartment();">
            <div class="statistics-inner-div">
                <div class="statistics-text">
                    <p>Departments</p>
                    <span>Statistics of Departments</span>
                    <h2 id="totalActiveBranchDepartmentCount">0</h2>
                </div>
                <div class="statistics-icon completed"><i class="bi-journals"></i></div>
            </div>
        </div>

        <div class="new-statistics-div" id="branch_department_class"
            onclick=""
            title="Class">
            <div class="statistics-inner-div">
                <div class="statistics-text">
                    <p>Alumni</p>
                    <span>Statistics of Alumni</span>
                    <h2 id="totalAlumniBranchStudentCount">0</h2>
                </div>
                <div class="statistics-icon pending"><i class="bi-people"></i></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            _fetchBranchDashboardStatistics();
        });
    </script>
<?php } ?>

<?php if ($page == 'branch_bursary_dashboard') { ?>
    <div class="dashboard-statistics-wrapper">
        <div class="left-dashbaord-container">
            <div class="statistics-chart-back-div box-shadow">
                <div class="chart-back-div">
                    <div class="chart-div-notifications no-border-top">
                        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

                        <div class="text text-right" onclick="select_search()">
                            <span id="srch-text">Last 30 Days</span>
                            <div class="icon-div"><i class="bi-caret-down"></i></div>

                            <div class="srch-select alert-srch-select">
                                <div id="srch-today" onclick="_fetchBranchRevenueFiltering('srch-today', 'Today');">Today
                                </div>
                                <div id="srch-week" onclick="_fetchBranchRevenueFiltering('srch-week', 'This Week');">This
                                    Week</div>
                                <div id="srch-7" onclick="_fetchBranchRevenueFiltering('srch-7', 'Last 7 Days');">Last 7
                                    Days
                                </div>
                                <div id="srch-month" onclick="_fetchBranchRevenueFiltering('srch-month', 'This Month');">
                                    This
                                    Month</div>
                                <div id="srch-30" onclick="_fetchBranchRevenueFiltering('srch-30', 'Last 30 Days');">Last 30
                                    Days
                                </div>
                                <div id="srch-90" onclick="_fetchBranchRevenueFiltering('srch-90', 'Last 90 Days');">Last 90
                                    Days
                                </div>
                                <div id="srch-year" onclick="_fetchBranchRevenueFiltering('srch-year', 'This Year');">This
                                    Year</div>
                                <div id="srch-1year" onclick="_fetchBranchRevenueFiltering('srch-1year', 'Last 1 Year');">
                                    Last 1
                                    Year</div>
                                <div onclick="srch_custom('Custom Search')">Custom Search</div>
                            </div>
                        </div>

                        <div class="text">
                            <div class="custom-srch-div">
                                <div class="custom-srch-div-in">
                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from"
                                            placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                                        </div>
                                    </div>

                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to"
                                            placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
                                    </div>
                                    <button type="button" class="btn"
                                        onclick="_fetchBranchCustomRevenueFiltering();">Apply</button>
                                </div>
                            </div>
                        </div>


                        <script language="javascript">
                            $('#datepickers-from').datetimepicker({
                                lang: 'en',
                                timepicker: false,
                                format: 'Y-m-d',
                                formatDate: 'Y-M-d',
                            });

                            $('#datepickers-to').datetimepicker({
                                lang: 'en',
                                timepicker: false,
                                format: 'Y-m-d',
                                formatDate: 'Y-M-d',
                            });
                        </script>
                    </div>

                    <div class="trending-back-div">
                        <div class="revenue-div">
                            <p>Revenue from <span id="branchBursarRevenueFrom">January 18 2025</span> - <span
                                    id="branchBursarRevenueTo">February 17 2025</span></p>
                            <div class="fund-div">
                                <h3>
                                    <p id="branchBursarRevenueCreditCard"><s>N</s> Loading...</p><span>Credit Card</span>
                                </h3>
                                <h3>
                                    <p id="branchBursarRevenueBankTransfer"><s>N</s> Loading...</p><span>Bank
                                        Transfer</span>
                                </h3>
                            </div>
                        </div>

                        <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>
                        <script>
                            $(document).ready(function() {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    title: {
                                        text: ""
                                    },
                                    axisX: {
                                        valueFormatString: "DD MMM",
                                        crosshair: {
                                            enabled: true,
                                            snapToDataPoint: true
                                        }
                                    },
                                    axisY: {
                                        title: "",
                                        includeZero: true,
                                        crosshair: {
                                            enabled: true
                                        }
                                    },
                                    toolTip: {
                                        shared: true
                                    },
                                    legend: {
                                        cursor: "pointer",
                                        verticalAlign: "bottom",
                                        horizontalAlign: "left",
                                        dockInsidePlotArea: true,
                                        itemclick: toogleDataSeries
                                    },
                                    data: [{
                                        type: "column",
                                        showInLegend: true,
                                        name: "Revenue",
                                        xValueFormatString: "DD MMM, YYYY",
                                        color: "#328ab3",
                                        dataPoints: [ //{
                                            //         x: new Date(2025, 0, 1),
                                            //         y: 250000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 2),
                                            //         y: 180000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 3),
                                            //         y: 100000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 4),
                                            //         y: 300000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 5),
                                            //         y: 120000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 6),
                                            //         y: 150000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 7),
                                            //         y: 275000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 8),
                                            //         y: 160000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 9),
                                            //         y: 350000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 10),
                                            //         y: 380000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 11),
                                            //         y: 0
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 12),
                                            //         y: 100000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 13),
                                            //         y: 0
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 14),
                                            //         y: 180000
                                            //     },
                                            //     {
                                            //         x: new Date(2025, 0, 15),
                                            //         y: 270000
                                            //     },
                                        ]
                                    }, ]

                                });
                                chart.render();

                                function toogleDataSeries(e) {
                                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                        e.dataSeries.visible = false;
                                    } else {
                                        e.dataSeries.visible = true;
                                    }
                                    chart.render();
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-dashbaord-container">
            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title">
                        <h3>Payment Matrix</h3>
                    </div>
                    <div id="chartContainer2" style="width:100%; height:200px; margin:auto;"></div>

                    <script type="text/javascript">
                        var options = {
                            title: {
                                text: "" /*My Performance*/
                            },
                            data: [{
                                type: "pie",
                                startAngle: 45,
                                showInLegend: "False",
                                legendText: "{label}",
                                indexLabel: "{label} ({y})",
                                yValueFormatString: "#,##0.#" % "",
                                dataPoints: [{
                                        label: "Debit/Credit Card",
                                        y: 3
                                    },
                                    {
                                        label: "Wallet",
                                        y: 2
                                    },
                                    {
                                        label: "Bank Transfer",
                                        y: 11
                                    },
                                ]
                            }]
                        };
                        $("#chartContainer2").CanvasJSChart(options);
                    </script>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                _fetchBranchRevenueFiltering('srch-30', 'Last 30 Days');
            });
        </script>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_settings') { ?>
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list staff-managment-list" title="Edit Branch Department"
            onclick="_fetchBranchDepartment();">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/department.png" alt="Branch Department" />
                </div>
                <div class="text-div">
                    <h3>Branch Department</h3>
                    <p>Assign and manage branch departments.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Assessment Settings"
            onclick="_getActiveBranchPage({divid:'branch_assessment_breakdown_page', page: 'branch_assessment_breakdown_page', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/score.png" alt="Assessment Settings" />
                </div>
                <div class="text-div">
                    <h3>Assessment Settings</h3>
                    <p>Customize Assessment scores and grading scales.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Other Settings"
            onclick="_getForm({page: 'branch_session_configuration_form', layer: 2, url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/gear.png" alt="Other Settings" />
                </div>
                <div class="text-div">
                    <h3>Session Configuration</h3>
                    <p>Manage current session, term, times school opens and resumption date.</p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_staff') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-person-bounding-box"></i> BRANCH STAFF LIST</span>

        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i>
                EXPORT</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _fetchBranchStaffs();
            </script>
        </table>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_profile') { ?>
    <div class="user-in branch-user-in">
        <div class="title">BRANCH BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateName_container">
                <script>
                    textField({
                        id: 'updateName',
                        title: 'Branch Name',
                        value: getEachBranchDetailsSession?.name ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateMobileNumber_container">
                <script>
                    textField({
                        id: 'updateMobileNumber',
                        title: 'Branch Phone Number',
                        type: 'tel',
                        value: getEachBranchDetailsSession?.mobileNumber ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="stateId_container">
                <script>
                    selectField({
                        id: 'stateId',
                        title: 'Select Branch State',
                        fieldValue: getEachBranchDetailsSession?.stateId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.stateName ?? ''
                    });
                    _getSelectGeneralState('stateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="lgaId_container">
                <script>
                    selectField({
                        id: 'lgaId',
                        title: 'Select Branch Local Govt Area',
                        fieldValue: getEachBranchDetailsSession?.lgaId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.lgaName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-2" id="updateAddress_container">
                <script>
                    textField({
                        id: 'updateAddress',
                        title: 'Branch Address',
                        value: getEachBranchDetailsSession?.address ?? ''
                    });
                </script>
            </div>

        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">BRANCH SMTP INFORMATIONS</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateSmtpHost_container">
                <script>
                    textField({
                        id: 'updateSmtpHost',
                        title: 'SMTP HOST',
                        value: getEachBranchDetailsSession?.smtpHost ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpUsername_container">
                <script>
                    textField({
                        id: 'updateSmtpUsername',
                        title: 'SMTP USERNAME',
                        value: getEachBranchDetailsSession?.smtpUsername ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPassword_container">
                <script>
                    textField({
                        id: 'updateSmtpPassword',
                        title: 'SMTP PASSWORD',
                        type: 'password',
                        value: getEachBranchDetailsSession?.smtpPassword ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPort_container">
                <script>
                    textField({
                        id: 'updateSmtpPort',
                        title: 'SMTP PORT',
                        type: 'number',
                        value: getEachBranchDetailsSession?.smtpPort ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-2" id="updateSupportEmail_container">
                <script>
                    textField({
                        id: 'updateSupportEmail',
                        title: 'SUPPORT EMAIL',
                        type: 'email',
                        value: getEachBranchDetailsSession?.supportEmail ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">SCHOOL PAYMENT CONFIGURATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateAccountName_container">
                <script>
                    textField({
                        id: 'updateAccountName',
                        title: 'BUSSINESS NAME',
                        value: getEachBranchDetailsSession?.accountName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updatePaymentKey_container">
                <script>
                    textField({
                        id: 'updatePaymentKey',
                        title: 'PAYMENT KEY',
                        value: getEachBranchDetailsSession?.paymentKey ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSecretKey_container">
                <script>
                    textField({
                        id: 'updateSecretKey',
                        title: 'SECRET KEY',
                        value: getEachBranchDetailsSession?.secretKey ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateReceiverKey_container">
                <script>
                    textField({
                        id: 'updateReceiverKey',
                        title: 'RECEIVER KEY',
                        value: getEachBranchDetailsSession?.receiverKey ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">BRANCH SESSION INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateSession_container">
                <script>
                    textField({
                        id: 'updateSession',
                        title: 'SESSION',
                        value: getEachBranchDetailsSession?.session ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateTermId_container">
                <script>
                    selectField({
                        id: 'updateTermId',
                        title: 'Select Term',
                        fieldValue: getEachBranchDetailsSession?.termData[0].termId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.termData[0].termName ?? ''
                    });
                    _getSelectTermId('updateTermId');
                </script>
            </div>

            <div class="text_field_container col-1" id="timeSchoolOpened_container">
                <script>
                    textField({
                        id: 'timeSchoolOpened',
                        title: 'Time School Opened',
                        value: getEachBranchDetailsSession?.timeSchoolOpened ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="schoolResumptionDate_container">
                <script>
                    $(document).ready(function() {
                        const bdate = getEachBranchDetailsSession?.schoolResumptionDate || '';

                        function formatDateForInput(date) {
                            if (!date) return "";
                            // If the date is in DD/MM/YYYY format
                            if (date.includes("/")) {
                                const [day, month, year] = date.split("/");
                                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                            }
                            // Already in YYYY-MM-DD format
                            return date;
                        }

                        textField({
                            id: 'schoolResumptionDate',
                            title: 'School Resumption Date',
                            type: 'date',
                            value: formatDateForInput(bdate)
                        });
                    });
                </script>
            </div>

        </div>
    </div>

    <div class="user-in branch-user-in">
        <div class="title">BRANCH ACCOUNT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="staffId_container">
                <script>
                    textField({
                        id: 'staffId',
                        title: 'Branch ID',
                        value: getEachBranchDetailsSession?.branchId ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        value: getEachBranchDetailsSession?.createdTime ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStaffId_container">
                <script>
                    selectField({
                        id: 'updateStaffId',
                        title: 'Select Branch Manager',
                        fieldValue: getEachBranchDetailsSession?.managerId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.managerName ?? ''
                    });
                    _getSelectBranchManagerId('updateStaffId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status',
                        fieldValue: getEachBranchDetailsSession?.statusId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.statusName ?? ''
                    });
                    _getSelectStatusId('updateStatusId', '1,2');
                </script>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateBranch();"> UPDATE PROFILE <i
                    class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_activities') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification History for </div>

        <div class="text text-right" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>
            <div class="icon-div"><i class="bi-caret-down"></i></div>

            <div class="srch-select alert-srch-select">
                <div id="srch-today" onclick="_fetchBranchRevenueFiltering('srch-today', 'view_today_search');">Today</div>
                <div id="srch-week" onclick="_fetchBranchRevenueFiltering('srch-week', 'view_thisweek_search');">This Week
                </div>
                <div id="srch-7" onclick="_fetchBranchRevenueFiltering('srch-7', 'view_7days_search');">Last 7 Days</div>
                <div id="srch-month" onclick="_fetchBranchRevenueFiltering('srch-month', 'view_thismonth_search');">This
                    Month</div>
                <div id="srch-30" onclick="_fetchBranchRevenueFiltering('srch-30', 'view_30days_search');">Last 30 Days
                </div>
                <div id="srch-90" onclick="_fetchBranchRevenueFiltering('srch-90', 'view_90days_search');">Last 90 Days
                </div>
                <div id="srch-year" onclick="_fetchBranchRevenueFiltering('srch-year', 'view_thisyear_search');">This Year
                </div>
                <div id="srch-1year" onclick="_fetchBranchRevenueFiltering('srch-1year', 'view_1year_search');">Last 1 Year
                </div>
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                        </div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
                    </div>
                    <button type="button" class="btn">Apply</button>
                </div>
            </div>
        </div>


        <script language="javascript">
            $('#datepickers-from').datetimepicker({
                lang: 'en',
                timepicker: false,
                format: 'Y-m-d',
                formatDate: 'Y-M-d',
            });

            $('#datepickers-to').datetimepicker({
                lang: 'en',
                timepicker: false,
                format: 'Y-m-d',
                formatDate: 'Y-M-d',
            });
        </script>
    </div>

    <div class="main-alert-div">
        <div class="system-alert" id="" onclick="_getSecondaryFormWithId('staff_alert_read');">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'edit_branch_department') { ?>
    <script>
        getBranchDepartmentSession = JSON.parse(sessionStorage.getItem("getBranchDepartmentSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> UPDATE BRANCH DEPARTMENT </span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly click the <span>Edit Department</span> button to
                            <span> UPDATE DEPARTMENT TO <span id="branchName"></span> BRANCH</span>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $("#branchName, #branchName2").html(getBranchDepartmentSession.branchName);
                            });
                        </script>
                    </div>

                    <div class="fetched-permission-back-div">
                        <div class="title">Registered Department</div>
                        <div id="fetchedPermission"></div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            var getBranchDepartmentSession = JSON.parse(sessionStorage.getItem(
                                "getBranchDepartmentSession"));
                            let text = '';
                            let hasCheckedDepartment = false;

                            if (getBranchDepartmentSession && getBranchDepartmentSession.data) {
                                const fetch = getBranchDepartmentSession.data;

                                for (let i = 0; i < fetch.length; i++) {
                                    const departmentName = fetch[i].departmentName;
                                    const checked = fetch[i].checked;

                                    if (checked === true) {
                                        hasCheckedDepartment = true;
                                        text += `
                                            <div class="fetched-permission-div">
                                                <span>${departmentName}</span>
                                            </div>`;
                                    }
                                }

                                if (!hasCheckedDepartment) {
                                    text = `
                                        <div class="permission-form-back-div">
                                            <div class="title-div">
                                                <h4>No Department Available</h4>
                                                <p>There are currently no registered Departments. To register departments to this branch, please click the "Edit Department" button below.</p>
                                            </div>
                                        </div>`;
                                }
                                $("#fetchedPermission").html(text);
                            }
                        });
                    </script>

                    <div>
                        <button class="btn" title="EDIT DEPARTMENT" id="addBtn"
                            onclick="_getFormDetails('user_form_details');"> <i class="bi-check"></i> EDIT DEPARTMENT
                        </button>
                    </div>
                </div>

                <div id="user_form_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly toggle the following department to <span> UPDATE
                                DEPARTMENT TO <span id="branchName2"></span> BRANCH</span></div>
                    </div>

                    <div class="permission-form-back-div">
                        <div class="title-div">
                            <h4>Departments</h4>
                            <p>Use the toggles below to assign registered Departments to their respective branches.
                                Switching to "Yes" activates the department for branch use.</p>
                        </div>

                        <div class="permission-toggle-div">
                            <div class="toggle-title">Registered Departments</div>
                            <div class="fetch-toggle" id="eachPageContentToggle"></div>
                        </div>

                        <script>
                            _fetchEachDepartmentToggle();
                        </script>
                    </div>

                    <div>
                        <button class="btn" title="SUBMIT" id="submitBtn" onclick="updateBranchDepartment();"> <i
                                class="bi-check"></i> SUBMIT </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_fees_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-credit-card"></i> BRANCH FEES CATEGORY</span>

        <div class="btn-container">
            <button class="btn" title="PRINT FEES" onclick="_printBranchFeesSettings();"><i class="bi-printer"></i> PRINT
                FEES</button>
            <button class="btn" title="ADD FEES"
                onclick="sessionStorage.removeItem('getEachEachFeesSettings'); _getForm({page: 'branch_fees_reg', layer:2, url: adminPortalLocalUrl});"><i
                    class="bi-plus-square"></i> ADD FEES</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _fetchFeesSettings();
            </script>
        </table>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_fees_reg') { ?>
    <script>
        getEachEachFeesSettings = JSON.parse(sessionStorage.getItem("getEachEachFeesSettings"));
        $('#pageTitle, #pageTitle2').html(getEachEachFeesSettings?.feesId ? 'UPDATE FEES' : 'ADD A NEW FEES');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD A NEW FEES</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> ADD A
                            NEW FEES</span></div>
                </div>

                <div class="text_field_container" id="feesName_container">
                    <script>
                        textField({
                            id: 'feesName',
                            title: 'Fee Name',
                            value: getEachEachFeesSettings?.feesName ?? ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="feesOption_container">
                    <script>
                        $(document).ready(function() {
                            const fetchedOption = getEachEachFeesSettings?.feesOption;
                            selectField({
                                id: 'feesOption',
                                title: 'Mandate Fees?',
                                fieldValue: fetchedOption,
                                fieldLabel: fetchedOption
                            });
                            _getSelectFeesOptions('feesOption');
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateFeesSettings();"> <i
                            class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_fees_computaion_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-credit-card"></i> FEES LIST</span>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>
            _fetchFeeComputeGeneral();
        </script>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_fees_computaion_form') { ?>
    <script>
        getEachFeeComputeGeneral = JSON.parse(sessionStorage.getItem("getEachFeeComputeGeneral"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> COMPUTE FEES</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success">
                        <span>Kindly fill the form below to compute fees for</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>School:</div>
                                    <div><span id="feesBranchName">
                                            <script>
                                                $("#feesBranchName").html(getEachFeeComputeGeneral.branchData.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="currentSession">
                                            <script>
                                                $("#currentSession").html(getEachFeeComputeGeneral.currentSession);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="currentTerm">
                                            <script>
                                                $("#currentTerm").html(getEachFeeComputeGeneral.termData.currentTerm);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="departmentName">
                                            <script>
                                                $("#departmentName").html(getEachFeeComputeGeneral.departmentData
                                                    .departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="className">
                                            <script>
                                                $("#className").html(getEachFeeComputeGeneral.classData.className);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="segmentDiv">
                        <div class="segmentTitle">
                            <span>Compute Fees Here</span>
                        </div>

                        <div class="segmentList" id="fetchedFeeTextbox">
                            <script>
                                $(document).ready(function() {
                                    let getEachFeeComputeGeneral = JSON.parse(sessionStorage.getItem(
                                        "getEachFeeComputeGeneral"));

                                    if (getEachFeeComputeGeneral && getEachFeeComputeGeneral.data) {
                                        const fetchArrayData = getEachFeeComputeGeneral.data;

                                        if (fetchArrayData.length > 0) {
                                            for (let i = 0; i < fetchArrayData.length; i++) {
                                                const fetchFeeData = fetchArrayData[i];
                                                const feesName = fetchFeeData.feesName;
                                                const feesId = fetchFeeData.feesId;
                                                const amount = fetchFeeData.amount;

                                                $("#fetchedFeeTextbox").append(`
                                                    <div class="text_field_title">${feesName}</div>
                                                    <div class="text_field_container" id="${feesId}_container"></div>
                                                `);

                                                textField({
                                                    id: feesId,
                                                    title: 'AMOUNT (<s>N</s>)',
                                                    type: 'number',
                                                    value: amount
                                                });
                                            }
                                        }
                                    }
                                });
                            </script>
                        </div>

                        <div>
                            <button type="button" class="add-btn" title="Save" id="submitBtn" onClick="saveFees();"><i
                                    class="bi-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_assessment_breakdown_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-credit-card"></i> ASSESSMENT SETTINGS</span>

        <div class="btn-container">
            <button class="btn" title="ADD ASSESSMENT"
                onclick="sessionStorage.removeItem('fetchEachAssessmentSession'); _getForm({page: 'branch_assessment_reg', layer:2, url: adminPortalLocalUrl});"><i
                    class="bi-plus-square"></i> ADD ASSESSMENT</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _fetchAssessmentPage();
            </script>
        </table>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_assessment_reg') { ?>
    <script>
        fetchEachAssessmentSession = JSON.parse(sessionStorage.getItem("fetchEachAssessmentSession"));
        $('#pageTitle, #pageTitle2').html(fetchEachAssessmentSession?.assessmentId ? 'UPDATE ASSESSMENT' :
            'ADD A NEW ASSESSMENT');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD A NEW ASSESSMENT</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> ADD A
                            NEW ASSESSMENT</span></div>
                </div>

                <div class="text_field_container" id="assessmentName_container">
                    <script>
                        textField({
                            id: 'assessmentName',
                            title: 'Assessment Name',
                            value: fetchEachAssessmentSession?.assessmentName ?? ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="assessmentTotalScore_container">
                    <script>
                        textField({
                            id: 'assessmentTotalScore',
                            title: 'Total Assessment Score',
                            type: 'number',
                            value: fetchEachAssessmentSession?.assessmentTotalScore ?? ''
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateAssessment();"> <i
                            class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_assessment_breakdown_form') { ?>
    <script>
        fetchAssessmentBreakdownSession = JSON.parse(sessionStorage.getItem("fetchAssessmentBreakdownSession"));
        fetchEachAssessmentBreakdownSession = JSON.parse(sessionStorage.getItem("fetchEachAssessmentBreakdownSession"));
        $('#pageTitle, #pageTitle2').html(fetchEachAssessmentBreakdownSession?.assessmentId ? 'UPDATE ASSESSMENT BREAKDOWN' :
            'COMPUTE ASSESSMENT BREAKDOWN');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> COMPUTE ASSESSMENT BREAKDOWN</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> COMPUTE
                            ASSESSMENT BREAKDOWN</span> for <span id="assessmentName">
                            <script>
                                $("#assessmentName").html(fetchAssessmentBreakdownSession.assessmentData.assessmentName);
                            </script>
                        </span> (<span id="assessmentTotalScore">
                            <script>
                                $("#assessmentTotalScore").html(fetchAssessmentBreakdownSession.assessmentData
                                    .assessmentTotalScore);
                            </script>
                        </span>)</div>
                </div>

                <div class="text_field_container" id="assessmentBreakDownName_container">
                    <script>
                        textField({
                            id: 'assessmentBreakDownName',
                            title: 'Assessment Breakdown Name',
                            value: fetchEachAssessmentBreakdownSession?.assessmentName ?? ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="assessmentBreakDownTotalScore_container">
                    <script>
                        textField({
                            id: 'assessmentBreakDownTotalScore',
                            title: 'Assessment Breakdown Score',
                            value: fetchEachAssessmentBreakdownSession?.assessmentTotalScore ?? ''
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateAssessmentBreakDown();"> <i
                            class="bi-check"></i> SUBMIT </button>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Assessment Breakdown Summary</span>
                        <div class="alert-list-div" id="fetchedAssessmentBreakDown">
                            <script>
                                $(document).ready(function() {
                                    let text = '';

                                    if (fetchAssessmentBreakdownSession) {
                                        const fetch = fetchAssessmentBreakdownSession.data;
                                        const message = fetchAssessmentBreakdownSession.message;
                                        const success = fetchAssessmentBreakdownSession.success;

                                        if (success === true) {
                                            for (let i = 0; i < fetch.length; i++) {
                                                const fetchedAssessmentBreakDown = fetch[i];
                                                const branchId = fetchedAssessmentBreakDown.branchId;
                                                const parentId = fetchedAssessmentBreakDown.parentId;
                                                const assessmentId = fetchedAssessmentBreakDown.assessmentId;
                                                const assessmentName = fetchedAssessmentBreakDown.assessmentName;
                                                const assessmentTotalScore = fetchedAssessmentBreakDown
                                                    .assessmentTotalScore;

                                                text += `
                                                <div class="alert-main-back-div">
                                                    <div class="alert-list-back-div">
                                                        <div class="alert-list">
                                                            <div>${assessmentName}:</div>
                                                            <div><span>${assessmentTotalScore}</span></div>
                                                        </div>
                                                    </div>

                                                    <div class="icon-div" title="Click to edit assessment breakdown" onclick="_fetchEachAssessmentBreakDown('${branchId}','${parentId}','${assessmentId}');"><i class="bi-pencil-square"></i></div>
                                                </div>`;
                                            }
                                            $("#fetchedAssessmentBreakDown").html(text);
                                        } else {
                                            text += `
                                            <div class="alert-list-back-div">
                                                <div class="alert-list">
                                                    <div>${message}.</div>
                                                </div>
                                            </div>`;
                                        }
                                        $("#fetchedAssessmentBreakDown").html(text);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'broadsheet_select_form') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-table"></i> BROAD/REPORT SHEET</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to print broad sheet
                for each class. Please select the <span>Session</span>, <span>Term</span>, <span>Report Type</span>,
                <span>Assessment</span> to proceed.
            </div>

            <div class="text_field_container" id="sessionId_container">
                <script>
                    selectField({
                        id: 'sessionId',
                        title: 'Select Session'
                    });
                    _getSelectSession('sessionId');
                </script>
            </div>

            <div class="text_field_container" id="termId_container">
                <script>
                    selectField({
                        id: 'termId',
                        title: 'Select Term'
                    });
                    _getSelectTermId('termId');
                </script>
            </div>

            <div class="text_field_container" id="reportTypeId_container">
                <script>
                    selectField({
                        id: 'reportTypeId',
                        title: 'Select Report Type'
                    });
                    _getSelectReportType('reportTypeId');
                </script>
            </div>

            <div class="text_field_container" id="assessmentId_container">
                <script>
                    selectField({
                        id: 'assessmentId',
                        title: 'Select Assessment'
                    });
                    _getSelectBranchAssessment('assessmentId');
                </script>
            </div>

            <button class="btn" id="proceedBtn" title="Proceed Request" onclick="_proceedFetchReportClasses();">PROCEED <i
                    class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_department_class_broadsheet') { ?>
    <script>
        fetchPresetDataSession = JSON.parse(sessionStorage.getItem("fetchPresetDataSession"));
    </script>

    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-grid-3x3"></i></span> <span id="reportTypeName">
                <script>
                    $("#reportTypeName").html(fetchPresetDataSession?.reportTypeData?.reportTypeName);
                </script>
            </span> -- <span id="broadBranchName">
                <script>
                    $("#broadBranchName").html(fetchPresetDataSession?.branchData?.branchName);
                </script>
            </span> - <span id="BroadSession">
                <script>
                    $("#BroadSession").html(fetchPresetDataSession?.session);
                </script>
            </span> - <span id="broadTerm">
                <script>
                    $("#broadTerm").html(fetchPresetDataSession?.termData?.termName);
                </script>
            </span>- <span id="broadAssessmentName">
                <script>
                    $("#broadAssessmentName").html(fetchPresetDataSession?.assessmentData?.assessmentName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>
            _fetchBroadsheetClass();
        </script>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'view_ca_result_summary_form') { ?>
    <script>
        getViewResultSummarySession = JSON.parse(sessionStorage.getItem("getViewResultSummarySession"));
        getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-diagram-3"></i> CA RESULT SUMMARY</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <div class="img-div">
                        <img id="summarySchoolLogo" src="<?php echo $websiteUrl ?>/images/portal-logo.jpg"
                            alt="Profile Image">
                    </div>

                    <script>
                        $(document).ready(function() {
                            const schoolLogo = getViewResultSummarySession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` :
                                "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#summarySchoolLogo").attr("src", logoUrl).attr("alt", getViewResultSummarySession
                                ?.branchData?.branchName + " Logo");
                        });
                    </script>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="resultBranchName">
                                    <script>
                                        $("#resultBranchName").html(getViewResultSummarySession?.branchData?.branchName);
                                    </script>
                                </div>

                                <div class="text">
                                    OFFICIAL EMAIL:
                                    <strong id="resultSmtpUsername">
                                        <script>
                                            $("#resultSmtpUsername").html(getViewResultSummarySession?.branchData
                                                ?.smtpUsername);
                                        </script>
                                    </strong>

                                    | SESSION:
                                    <strong id="resultSession">
                                        <script>
                                            $("#resultSession").html(getViewResultSummarySession?.session);
                                        </script>
                                    </strong>

                                    | TERM:
                                    <strong id="resultTermName">
                                        <script>
                                            $("#resultTermName").html(getViewResultSummarySession?.termData?.termName);
                                        </script>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-back-div background-color">
                <div class="field-inner-div branch-field-inner-div student-result-field-inner-div" id="get_branch_details">
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div><span><i class="bi-grid-3x3"></i></span> <span id="resultTypeName">
                                <script>
                                    $("#resultTypeName").html(fetchPresetDataSession?.reportTypeData?.reportTypeName);
                                </script>
                            </span> <span>SUMMARY</span> --- <span id="infoSession">
                                <script>
                                    $("#infoSession").html(getViewResultSummarySession?.session);
                                </script>
                            </span> - <span id="infoTermName">
                                <script>
                                    $("#infoTermName").html(getViewResultSummarySession?.termData?.termName);
                                </script>
                            </span>
                            - <span id="infoAssessmentName">
                                <script>
                                    $("#infoAssessmentName").html(getViewResultSummarySession?.assessmentData?.assessmentName);
                                </script>
                            </span> - <span id="resultDepartment">
                                <script>
                                    $("#resultDepartment").html(getViewResultSummarySession?.departmentData?.departmentName);
                                </script>
                            </span> - <span id="resultClass">
                                <script>
                                    $("#resultClass").html(getViewResultSummarySession?.classData?.className);
                                </script>
                            </span> - <span id="resultArm">
                                <script>
                                    $("#resultArm").html(getViewResultSummarySession?.armData?.armName);
                                </script>
                            </span></div>

                        <div class="btn-container">
                            <button class="btn" title="CA RESULT SUMMARY" id="printBtn"
                                onclick="_printCaResultSummary();"><i class="bi-printer"></i>CA RESULT SUMMARY</button>
                            <button class="btn" title="ALL CA RESULT" id="printAllBtn"
                                onclick="_printAllStudentCaResult()"><i class="bi-printer"></i> ALL CA RESULT</button>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="resultSumamryPageContent">
                            <script>
                                $(document).ready(function() {
                                    const getViewResultSummarySession = JSON.parse(sessionStorage.getItem(
                                        "getViewResultSummarySession"));
                                    if (!getViewResultSummarySession) return;
                                    // get ids for the print button //
                                    const branchId = getEachBranchDetailsSession?.branchId;
                                    const session = getViewResultSummarySession?.session;
                                    const termId = getViewResultSummarySession?.termData?.termId;
                                    const departmentId = getViewResultSummarySession?.departmentData?.departmentId;
                                    const classId = getViewResultSummarySession?.classData?.classId;
                                    const armId = getViewResultSummarySession?.armData?.armId;
                                    const assessmentId = getViewResultSummarySession?.assessmentData?.assessmentId;

                                    const tableTitles = getViewResultSummarySession?.tableTitles.split(',').map(x => x
                                        .trim());
                                    const studentList = getViewResultSummarySession?.studentData;

                                    // Dynamically extract all unique keys from student data
                                    const summaryFields = Object.keys(studentList[0] || {});
                                    const scoreMap = {};

                                    // Build scoreMap for summary fields (from studentList)
                                    summaryFields.forEach(field => {
                                        scoreMap[field] = {};
                                        studentList.forEach(student => {
                                            scoreMap[field][student.studentId] = student[field];
                                        });
                                    });

                                    // Normalize for fuzzy matching
                                    function normalizeWords(str) {
                                        return str
                                            .replace(/[\W_]+/g, ' ') // Remove punctuation and underscores
                                            .replace(/([a-z])([A-Z])/g, '$1 $2') // Split camelCase
                                            .toLowerCase()
                                            .split(' ')
                                            .filter(Boolean);
                                    }

                                    // Map tableTitles to scoreMap fields (summary or subject)
                                    tableTitles.forEach(title => {
                                        // First try exact match
                                        if (summaryFields.includes(title)) {
                                            scoreMap[title] = scoreMap[title];
                                            return;
                                        }

                                        // Try fuzzy matching
                                        const titleWords = normalizeWords(title);
                                        let bestMatch = null;
                                        let bestMatchScore = 0;

                                        summaryFields.forEach(field => {
                                            const fieldWords = normalizeWords(field);
                                            const overlapCount = titleWords.filter(word => fieldWords
                                                .includes(word)).length;

                                            if (overlapCount > bestMatchScore) {
                                                bestMatch = field;
                                                bestMatchScore = overlapCount;
                                            }
                                        });

                                        if (bestMatch && !scoreMap[title]) {
                                            scoreMap[title] = scoreMap[bestMatch];
                                        } else if (!scoreMap[title]) {
                                            // Check lowercase direct match (e.g., "remarks" vs "remark")
                                            const lowerTitle = title.toLowerCase().replace(/s$/,
                                                ''); // remove trailing 's'
                                            const fieldMatch = summaryFields.find(field => field
                                                .toLowerCase() === lowerTitle);
                                            if (fieldMatch) {
                                                scoreMap[title] = scoreMap[fieldMatch];
                                            }
                                        }
                                    });

                                    // Build the table
                                    const thead = $('<thead></thead>');
                                    const headerRow = $('<tr class="tb-col small-font-tb-col"></tr>');


                                    tableTitles.forEach(title => {
                                        headerRow.append($('<th></th>').text(title));
                                    });

                                    headerRow.append($('<th></th>').text('ACTION'));

                                    thead.append(headerRow);

                                    const tbody = $('<tbody></tbody>');

                                    studentList.forEach((student, index) => {
                                        const row = $('<tr class="tb-row report-tb-row"></tr>');
                                        const fullName = `${student.surName} ${student.otherNames || ''}`
                                            .trim();
                                        const studentId = student.studentId;
                                        const passportFile = student.passport ? student.passport :
                                            'default.jpg';

                                        row.append($('<td class="td"></td>').text(index + 1));

                                        const studentInfoId = $('<td class="td"></td>');
                                        const studentInfoText = `
                                            <div class="text-back-div">
                                                <div class="image-div general-passport">
                                                    <img src="${studentPixPath}/${passportFile}" alt="${fullName}" />
                                                </div>
                                                <div class="text-div">
                                                    <div class="first-class">${fullName}</div>
                                                    <div class="second-class">${studentId}</div>
                                                </div>
                                            </div>
                                        `;
                                        studentInfoId.html(studentInfoText);
                                        row.append(studentInfoId);

                                        for (let i = 2; i < tableTitles.length; i++) {
                                            const title = tableTitles[i];
                                            const score = scoreMap[title] && scoreMap[title][student
                                                .studentId
                                            ] ? scoreMap[title][student.studentId] : '';
                                            row.append($('<td class="td"></td>').text(score));
                                        }

                                        const actionTd = $('<td class="td"></td>');
                                        const printButton = $(`
                                            <button class="btn view-btn min-width-btn" id="printAssBtn_${studentId}" title="Click to print student result" onclick="_printEachStudentCaResult('${branchId}','${session}','${termId}','${departmentId}','${classId}','${armId}','${assessmentId}','${studentId}');">
                                                <i class="bi-printer"></i> PRINT
                                            </button>
                                        `);

                                        actionTd.append(printButton);
                                        row.append(actionTd);

                                        tbody.append(row);
                                    });

                                    $('#resultSumamryPageContent').empty().append(thead).append(tbody);
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'view_terminal_result_summary_form') { ?>
    <script>
        getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem("getViewTerminalResultSummarySession"));
        getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-diagram-3"></i> TERMINAL RESULT SUMMARY</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <div class="img-div" id="current_user_passport1">
                        <img id="terminalSchoolLogo" src="<?php echo $websiteUrl ?>/images/portal-logo.jpg"
                            alt="Profile Image">
                    </div>

                    <script>
                        $(document).ready(function() {
                            const schoolLogo = getViewTerminalResultSummarySession?.branchData?.schoolLogo;
                            const logoUrl = schoolLogo ? `${schoolLogoPixPath}/${schoolLogo}` :
                                "<?php echo $websiteUrl ?>/images/report/icon.png";

                            $("#terminalSchoolLogo").attr("src", logoUrl).attr("alt",
                                getViewTerminalResultSummarySession?.branchData?.branchName + " Logo");
                        });
                    </script>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="terminalResultBranchName">
                                    <script>
                                        $("#terminalResultBranchName").html(getViewTerminalResultSummarySession?.branchData
                                            ?.branchName);
                                    </script>
                                </div>

                                <div class="text">
                                    OFFICIAL EMAIL:
                                    <strong id="terminalResultSmtpUsername">
                                        <script>
                                            $("#terminalResultSmtpUsername").html(getViewTerminalResultSummarySession
                                                ?.branchData?.smtpUsername);
                                        </script>
                                    </strong>

                                    | SESSION:
                                    <strong id="terminalResultSession">
                                        <script>
                                            $("#terminalResultSession").html(getViewTerminalResultSummarySession?.session);
                                        </script>
                                    </strong>

                                    | TERM:
                                    <strong id="terminalResultTermName">
                                        <script>
                                            $("#terminalResultTermName").html(getViewTerminalResultSummarySession?.termData
                                                ?.termName);
                                        </script>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field-back-div background-color">
                <div class="field-inner-div branch-field-inner-div student-result-field-inner-div" id="get_branch_details">
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div><span><i class="bi-grid-3x3"></i></span> <span id="terminalResultTypeName">
                                <script>
                                    $("#terminalResultTypeName").html(fetchPresetDataSession?.reportTypeData?.reportTypeName);
                                </script>
                            </span> <span>SUMMARY</span> --- <span id="terminalInfoSession">
                                <script>
                                    $("#terminalInfoSession").html(getViewTerminalResultSummarySession?.session);
                                </script>
                            </span> - <span id="terminalInfoTermName">
                                <script>
                                    $("#terminalInfoTermName").html(getViewTerminalResultSummarySession?.termData?.termName);
                                </script>
                            </span>
                            - <span id="terminalResultDepartment">
                                <script>
                                    $("#terminalResultDepartment").html(getViewTerminalResultSummarySession?.departmentData
                                        ?.departmentName);
                                </script>
                            </span> - <span id="terminalResultClass">
                                <script>
                                    $("#terminalResultClass").html(getViewTerminalResultSummarySession?.classData?.className);
                                </script>
                            </span> - <span id="terminalResultArm">
                                <script>
                                    $("#terminalResultArm").html(getViewTerminalResultSummarySession?.armData?.armName);
                                </script>
                            </span></div>

                        <div class="btn-container">
                            <button class="btn" title="TERMINAL RESULT SUMMARY" id="printBtn"
                                onclick="_printTerminalResultSummary();"><i class="bi-printer"></i>TERMINAL RESULT
                                SUMMARY</button>
                            <button class="btn" title="ALL TERMINAL RESULT" id="printAllBtn"
                                onclick="windowPop('<?php echo $websiteUrl ?>/reports/print-all-student-terminal-result');"><i
                                    class="bi-printer"></i> ALL TERMINAL RESULT</button>
                            <button class="btn" title="PROGRESS REPORT" id="printAllBtn"
                                onclick="windowPop('<?php echo $websiteUrl ?>/reports/print-all-student-terminal-progress-report-result');"><i
                                    class="bi-printer"></i> PROGRESS REPORT</button>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="terminalResultSumamryPageContent">
                            <script>
                                $(document).ready(function() {
                                    const getViewTerminalResultSummarySession = JSON.parse(sessionStorage.getItem(
                                        "getViewTerminalResultSummarySession"));
                                    if (!getViewTerminalResultSummarySession) return;
                                    // get ids for the print button //
                                    const branchId = getEachBranchDetailsSession?.branchId;
                                    const session = getViewTerminalResultSummarySession?.session;
                                    const termId = getViewTerminalResultSummarySession?.termData?.termId;
                                    const departmentId = getViewTerminalResultSummarySession?.departmentData
                                        ?.departmentId;
                                    const classId = getViewTerminalResultSummarySession?.classData?.classId;
                                    const armId = getViewTerminalResultSummarySession?.armData?.armId;

                                    const tableTitles = getViewTerminalResultSummarySession?.tableTitles.split(',').map(
                                        x => x.trim());
                                    const studentList = getViewTerminalResultSummarySession?.studentData;

                                    // Dynamically extract all unique keys from student data
                                    const summaryFields = Object.keys(studentList[0] || {});
                                    const scoreMap = {};

                                    // Build scoreMap for summary fields (from studentList)
                                    summaryFields.forEach(field => {
                                        scoreMap[field] = {};
                                        studentList.forEach(student => {
                                            scoreMap[field][student.studentId] = student[field];
                                        });
                                    });

                                    // Normalize for fuzzy matching
                                    function normalizeWords(str) {
                                        return str
                                            .replace(/[\W_]+/g, ' ') // Remove punctuation and underscores
                                            .replace(/([a-z])([A-Z])/g, '$1 $2') // Split camelCase
                                            .toLowerCase()
                                            .split(' ')
                                            .filter(Boolean);
                                    }

                                    // Map tableTitles to scoreMap fields (summary or subject)
                                    tableTitles.forEach(title => {
                                        // First try exact match
                                        if (summaryFields.includes(title)) {
                                            scoreMap[title] = scoreMap[title];
                                            return;
                                        }

                                        // Try fuzzy matching
                                        const titleWords = normalizeWords(title);
                                        let bestMatch = null;
                                        let bestMatchScore = 0;

                                        summaryFields.forEach(field => {
                                            const fieldWords = normalizeWords(field);
                                            const overlapCount = titleWords.filter(word => fieldWords
                                                .includes(word)).length;

                                            if (overlapCount > bestMatchScore) {
                                                bestMatch = field;
                                                bestMatchScore = overlapCount;
                                            }
                                        });

                                        if (bestMatch && !scoreMap[title]) {
                                            scoreMap[title] = scoreMap[bestMatch];
                                        } else if (!scoreMap[title]) {
                                            // Check lowercase direct match (e.g., "remarks" vs "remark")
                                            const lowerTitle = title.toLowerCase().replace(/s$/,
                                                ''); // remove trailing 's'
                                            const fieldMatch = summaryFields.find(field => field
                                                .toLowerCase() === lowerTitle);
                                            if (fieldMatch) {
                                                scoreMap[title] = scoreMap[fieldMatch];
                                            }
                                        }
                                    });

                                    // Build the table
                                    const thead = $('<thead></thead>');
                                    const headerRow = $('<tr class="tb-col small-font-tb-col"></tr>');


                                    tableTitles.forEach(title => {
                                        headerRow.append($('<th></th>').text(title));
                                    });

                                    headerRow.append($('<th></th>').text('ACTION'));

                                    thead.append(headerRow);

                                    const tbody = $('<tbody></tbody>');

                                    studentList.forEach((student, index) => {
                                        const row = $('<tr class="tb-row report-tb-row"></tr>');
                                        const fullName = `${student.surName} ${student.otherNames || ''}`
                                            .trim();
                                        const studentId = student.studentId;
                                        const passportFile = student.passport ? student.passport :
                                            'default.jpg';

                                        row.append($('<td class="td"></td>').text(index + 1));

                                        const studentInfoId = $('<td class="td"></td>');
                                        const studentInfoText = `
                                            <div class="text-back-div">
                                                <div class="image-div general-passport">
                                                    <img src="${studentPixPath}/${passportFile}" alt="${fullName}" />
                                                </div>
                                                <div class="text-div">
                                                    <div class="first-class">${fullName}</div>
                                                    <div class="second-class">${studentId}</div>
                                                </div>
                                            </div>
                                        `;
                                        studentInfoId.html(studentInfoText);
                                        row.append(studentInfoId);

                                        for (let i = 2; i < tableTitles.length; i++) {
                                            const title = tableTitles[i];
                                            const score = scoreMap[title] && scoreMap[title][student
                                                .studentId
                                            ] ? scoreMap[title][student.studentId] : '';
                                            row.append($('<td class="td"></td>').text(score));
                                        }

                                        const actionTd = $('<td class="td"></td>');
                                        const printButton = $(`
                                            <button class="btn view-btn min-width-btn" id="printEachAssBtn_${studentId}" title="Click to print terminal student result" onclick="printEachStudentTerminalResult('${branchId}','${session}','${termId}','${departmentId}','${classId}','${armId}','${studentId}');">
                                                <i class="bi-printer"></i> PRINT
                                            </button>
                                        `);

                                        actionTd.append(printButton);
                                        row.append(actionTd);

                                        tbody.append(row);
                                    });

                                    $('#terminalResultSumamryPageContent').empty().append(thead).append(tbody);
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php if ($page == 'branch_session_configuration_form') { ?>
    <script>
        getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-gear-wide-connected"></i> SESSION CONFIGURATION</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2">
                            CONFIGURE OTHER SETTINGS</span></div>
                </div>

                <div class="text_field_container" id="currentSession_container">
                    <script>
                        textField({
                            id: 'currentSession',
                            title: 'Current Session',
                            value: getEachBranchDetailsSession?.session || ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="termId_container">
                    <script>
                        selectField({
                            id: 'termId',
                            title: 'Current Term',
                            fieldValue: getEachBranchDetailsSession?.termData[0].termId ?? '',
                            fieldLabel: getEachBranchDetailsSession?.termData[0].termName ?? ''
                        });
                        _getSelectTermId('termId');
                    </script>
                </div>

                <div class="text_field_container" id="timeSchoolOpened_container">
                    <script>
                        textField({
                            id: 'timeSchoolOpened',
                            title: 'Time School Opened',
                            value: getEachBranchDetailsSession?.timeSchoolOpened || ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="schoolResumptionDate_container">
                    <script>
                        textField({
                            id: 'schoolResumptionDate',
                            title: 'School Resumption Date',
                            type: 'date',
                            value: getEachBranchDetailsSession?.schoolResumptionDate || ''
                        });
                    </script>
                </div>

                <div class="title">UPLOAD SCHOOL LOGO: <i>(JPG, PNG FORMAT ONLY) (150 X 150)</i> <span>*</span></div>
                <label>
                    <div class="pix-div" id="schoolLogoPreviewContainer">
                        <img id="schoolLogoPreviewPix" src="<?php echo $websiteUrl ?>/images/sample.jpg"
                            alt="Default Image">
                        <input type="file" id="schoolLogo" style="display:none"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="schoolLogoPixPreview.UpdatePreview(this);" />
                    </div>

                    <script>
                        $(document).ready(function() {
                            const settingSchoolLogo = getEachBranchDetailsSession.schoolLogo;
                            const settingLogoUrl = settingSchoolLogo ?
                                "<?php echo $websiteUrl ?>/uploaded_files/branchLogo/" + settingSchoolLogo :
                                "<?php echo $websiteUrl ?>/images/sample.jpg";

                            $("#schoolLogoPreviewPix").attr("src", settingLogoUrl).attr("alt",
                                getEachBranchDetailsSession.name + " Logo");
                        });
                    </script>
                </label>


                <div class="title">UPLOAD PRINCIPAL SIGNATURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <img id="principalSignaturePreviewPix" src="<?php echo $websiteUrl ?>/images/sample.jpg"
                            alt="Default Image">
                        <input type="file" id="principalSignature" style="display:none"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="principalSignaturePixPreview.UpdatePreview(this);" />
                    </div>

                    <script>
                        $(document).ready(function() {
                            const settingPrincipalSignature = getEachBranchDetailsSession.principalSignature;
                            const settingSignature = settingPrincipalSignature ?
                                "<?php echo $websiteUrl ?>/uploaded_files/branchPrincipalSignature/" +
                                settingPrincipalSignature : "<?php echo $websiteUrl ?>/images/sample.jpg";

                            $("#principalSignaturePreviewPix").attr("src", settingSignature).attr("alt",
                                getEachBranchDetailsSession.name + " Principal Signature");
                        });
                    </script>
                </label>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_updateBranchConfig();"> <i
                            class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->


<?php if ($page == 'branch_account') { ?>
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list staff-managment-list" title="Fees Settings"
            onclick="_getActiveBranchPage({divid:'branch_fees_page', page: 'branch_fees_page', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl ?>/images/fees.png" alt="Fees Settings" /></div>
                <div class="text-div">
                    <h3>Fees Settings</h3>
                    <p>Set tuition fees and manage billing items.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Compute Fees"
            onclick="_getActiveBranchPage({divid:'branch_fees_computaion_page', page: 'branch_fees_computaion_page', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/compute.png" alt="Compute Fees" />
                </div>
                <div class="text-div">
                    <h3>Compute Fees</h3>
                    <p>Compute payable fees for each branch.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Parent List"
            onclick="_getForm({page: 'fetch_parent_form', layer:2, url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/student-reg.png" alt="Parent List" />
                </div>
                <div class="text-div">
                    <h3>Parent List</h3>
                    <p>View and manage parents associated with your branch.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Payroll"
            onclick="_getActiveBranchPage({divid:'branch_fees_computaion_page', page: 'branch_fees_computaion_page', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/payroll.png" alt="Payroll" />
                </div>
                <div class="text-div">
                    <h3>Payroll</h3>
                    <p>View and manage payroll for staff associated with your branch.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list" title="Staff Loan"
            onclick="_getActiveBranchPage({divid:'branch_fees_computaion_page', page: 'branch_fees_computaion_page', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/loan.png" alt="Staff Loan" />
                </div>
                <div class="text-div">
                    <h3>Staff Loan</h3>
                    <p>View and manage staff loans for employees associated with your branch.</p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>