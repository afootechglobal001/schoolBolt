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
userRoles.canViewBursaryDashboard && _getActivePage({
    page: 'bursaryDashboard',
    divid: 'dashboard'
});
</script>
<?php } ?>

<?php if ($page == 'superAdminDashboard') { ?>
<div class="page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="page-title-div">
        <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Admin Dashboard Overview</span>
        </div>
        <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>
                $("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));
                </script>
            </span></div>
        <div class="bottom-title"><i class="bi-clock"></i> Last Login Date | <span id="loginUserLastLogin">
                <script>
                $("#loginUserLastLogin").html(staffLoginData.lastLoginTime);
                </script>
            </span>
        </div>
    </div>

    <div class="statistics-container">
        <ul>
            <li title="Department" onclick="_getPage({page: 'department_config', url: adminPortalLocalUrl});"><span><i
                        class="bi-diagram-3"></i> Department</span>
                <div class="num" id="totalActiveDepartmentCount">0</div>
            </li>
            <li title="Classes" onclick="_getPage({page: 'class_config', url: adminPortalLocalUrl});"><span><i
                        class="bi-people"></i> classes</span>
                <div class="num" id="totalActiveClassCount">0</div>
            </li>
            <li title="Subjects" onclick="_getPage({page: 'subject_config', url: adminPortalLocalUrl});"><span><i
                        class="bi-journals"></i> Subjects</span>
                <div class="num" id="totalActiveSubjectCount">0</div>
            </li>
        </ul>
    </div>
</div>

<div class="dashboard-statistics-wrapper" data-aos="fade-in" data-aos-duration="1500">
    <div class="left-dashbaord-container">
        <div class="statistics-chart-back-div">
            <div class="new-statistics-back-div">
                <div class="new-statistics-div" title="Statistics of Branches"
                    onclick="_getActivePage({page:'branches', divid:'branches'});">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Branches</p>
                            <span>Statistics of Branches</span>
                            <h2 id="totalActiveBranchCount">0</h2>
                        </div>
                        <div class="statistics-icon pending"><i class="bi-diagram-3"></i></div>
                    </div>
                </div>

                <div class="new-statistics-div" title="Statistics of Staffs"
                    onclick="_getActivePage({page:'staff', divid:'staff'});">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Total Staff</p>
                            <span>Statistics of Staffs</span>
                            <h2 id="totalActiveStaffCount">0</h2>
                        </div>
                        <div class="statistics-icon upcoming"><i class="bi-person-bounding-box"></i></div>
                    </div>
                </div>

                <div class="new-statistics-div" title="Statistics of Students">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Total Students</p>
                            <span>Statistics of Students</span>
                            <h2 id="totalActiveStudentCount">0</h2>
                        </div>
                        <div class="statistics-icon completed"><i class="bi-people"></i></div>
                    </div>
                </div>

                <div class="new-statistics-div" title="Statistics of Alumni Students">
                    <div class="statistics-inner-div">
                        <div class="statistics-text">
                            <p>Total Alumni</p>
                            <span>Statistics of Alumni</span>
                            <h2 id="totalAlumniStudentCount">0</h2>
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
                            <div id="srch-today" onclick="_fetchRevenueFiltering('srch-today', 'Today');">Today
                            </div>
                            <div id="srch-week" onclick="_fetchRevenueFiltering('srch-week', 'This Week');">This
                                Week</div>
                            <div id="srch-7" onclick="_fetchRevenueFiltering('srch-7', 'Last 7 Days');">Last 7 Days
                            </div>
                            <div id="srch-month" onclick="_fetchRevenueFiltering('srch-month', 'This Month');">This
                                Month</div>
                            <div id="srch-30" onclick="_fetchRevenueFiltering('srch-30', 'Last 30 Days');">Last 30 Days
                            </div>
                            <div id="srch-90" onclick="_fetchRevenueFiltering('srch-90', 'Last 90 Days');">Last 90 Days
                            </div>
                            <div id="srch-year" onclick="_fetchRevenueFiltering('srch-year', 'This Year');">This
                                Year</div>
                            <div id="srch-1year" onclick="_fetchRevenueFiltering('srch-1year', 'Last 1 Year');">Last 1
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
                                    <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To </div>
                                    <div class="issueText" id="issue_to"></div>
                                </div>
                                <button type="button" class="btn" id="applyCustomSearchBtn"
                                    onclick="_fetchCustomRevenueFiltering();">Apply</button>
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
                        <p>Revenue from <span id="dateFrom">January 18 2025</span> - <span id="dateTo">February 17
                                2025</span></p>
                        <div class="fund-div">
                            <h3>
                                <p id="sumCreditCardPayments"><s>N</s> Loading...</p><span>Credit Card</span>
                            </h3>
                            <h3>
                                <p id="sumBankTransferPayments"><s>N</s> Loading...</p><span>Bank Transfer</span>
                            </h3>
                        </div>
                    </div>

                    <div id="chartContainer" style="width:100%; height:400px; margin:auto;"></div>
                    <script>
                    $(document).ready(function() {
                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            theme: "light2",
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
                                dataPoints: [
                                    // {
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
                    <h3>Staff Role Matrix</h3>
                </div>
                <div id="chartContainer1" style="width:100%; height:200px; margin:auto;"></div>

                <script type="text/javascript">
                var options = {
                    title: {
                        text: "" /*My Performance*/
                    },
                    data: [{
                        type: "doughnut",
                        innerRadius: 30,
                        showInLegend: "False",
                        legendText: "{label}",
                        indexLabel: "{label} ({y})",
                        yValueFormatString: "#,##0.#" % "",
                        indexLabelFontSize: 9,
                        dataPoints: [{
                                label: "SUPER ADMIN",
                                y: 5
                            },
                            {
                                label: "ADMINISTRATOR",
                                y: 6
                            },
                            {
                                label: "SUBJECT TEACHER",
                                y: 4
                            },
                            {
                                label: "CLASS TEACHERS",
                                y: 5
                            },
                        ]
                    }]
                };
                $("#chartContainer1").CanvasJSChart(options);
                </script>
            </div>
        </div>

        <div class="matrix-div">
            <div class="inner-div">
                <div class="title">
                    <h3>Payment Channel Matrix</h3>
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
        _fetchDashboardStatistics();
        _fetchRevenueFiltering('srch-30', 'Last 30 Days');
    });
    </script>
</div>
<?php } ?>


<?php if ($page == 'administratorDashboard') { ?>
<div class="page-title-back-div dashbaords-page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="page-title-div">
        <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Dashboard Overview</span></div>
        <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>
                $("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));
                </script>
            </span></div>
        <div class="bottom-title"><i class="bi-clock"></i> Last Login Date | <span id="loginUserLastLogin">
                <script>
                $("#loginUserLastLogin").html(staffLoginData.lastLoginTime);
                </script>
            </span>
        </div>
    </div>
</div>

<div class="pages-back-div dashbaords-pg-back-div">
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list" id="MasterCountConfigurations">
            <script>
            $("#MasterCountConfigurations").html(`
                        <div class="inner-div"  onclick="_fetchEachBranches('${staffLoginData.branchId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/branch.png" alt="${staffLoginData.branchName}"/></div>
                            <div class="text-div">
                                <h3>${staffLoginData.branchName}</h3>
                                <p>Click here to view your branch details</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>

        <div class="user-managment-list" id="MyProfile">
            <script>
            $("#MyProfile").html(`
                        <div class="inner-div"  onclick="_fetchEachStaff('${staffLoginData.staffId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/profile.png" alt="MY PROFILE"/></div>
                            <div class="text-div">
                                <h3>MY PROFILE</h3>
                                <p>Manages Subject Lessons, Assignments, Grades, Attendance, And Student Performance Tracking For Their Designated Subject.</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>


        <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/status.png"
                        alt="User Status Configurations" /></div>
                <div class="text-div">
                    <h3>CHANGE PASSWORD</h3>
                    <p>Click here to change and upadate your password</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if ($page == 'subjectTeacherDashboard') { ?>
<div class="page-title-back-div dashbaords-page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="page-title-div">
        <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Dashboard Overview</span></div>
        <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>
                $("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));
                </script>
            </span></div>
        <div class="bottom-title"><i class="bi-clock"></i> Last Login Date | <span id="loginUserLastLogin">
                <script>
                $("#loginUserLastLogin").html(staffLoginData.lastLoginTime);
                </script>
            </span>
        </div>
    </div>
</div>

<div class="pages-back-div dashbaords-pg-back-div">
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list" id="MyProfile">
            <script>
            $("#MyProfile").html(`
                        <div class="inner-div" onclick="_fetchEachStaff('${staffLoginData.staffId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/profile.png" alt="Master Count Configurations"/></div>
                            <div class="text-div">
                                <h3>MY PROFILE</h3>
                                <p>Manages Subject Lessons, Assignments, Grades, Attendance, And Student Performance Tracking For Their Designated Subject.</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>

        <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/status.png"
                        alt="User Status Configurations" /></div>
                <div class="text-div">
                    <h3>CHANGE PASSWORD</h3>
                    <p>Click here to change and upadate your password</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<?php if ($page == 'ICTStaffDashboard') { ?>
<div class="page-title-back-div dashbaords-page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="page-title-div">
        <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Dashboard Overview</span></div>
        <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>
                $("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));
                </script>
            </span></div>
        <div class="bottom-title"><i class="bi-clock"></i> Last Login Date | <span id="loginUserLastLogin">
                <script>
                $("#loginUserLastLogin").html(staffLoginData.lastLoginTime);
                </script>
            </span>
        </div>
    </div>
</div>

<div class="pages-back-div dashbaords-pg-back-div">
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">

        <div class="user-managment-list" id="MyProfile">
            <script>
            $("#MyProfile").html(`
                        <div class="inner-div"  onclick="_fetchEachStaff('${staffLoginData.staffId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/profile.png" alt="Master Count Configurations"/></div>
                            <div class="text-div">
                                <h3>MY PROFILE</h3>
                                <p>Manages Subject Lessons, Assignments, Grades, Attendance, And Student Performance Tracking For Their Designated Subject.</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>

        <div class="user-managment-list" onclick="_getActivePage({page:'branches', divid:'branches'});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/branch.png"
                        alt="Master Count Configurations" /></div>
                <div class="text-div">
                    <h3>Branches Management</h3>
                    <p> Manage the administration of a specific school branch, handling staff, student enrollment,
                        schedules, resources, and compliance reporting.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getActivePage({page:'staff', divid:'staff'});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/staff.png"
                        alt="Master Count Configurations" /></div>
                <div class="text-div">
                    <h3>Staff Management</h3>
                    <p>Manage staff recruitment, roles, attendance, performance, and records of all academic and
                        non-academic staff members.</p>
                </div>
            </div>
        </div>


        <div class="user-managment-list"
            onclick="_getPage({page: 'user-role-configuration', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/authorization.png"
                        alt="User Role Management" /></div>
                <div class="text-div">
                    <h3>User Role Management</h3>
                    <p>User role configurations manage permissions, ensuring secure and efficient access to features.
                    </p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getPage({page: 'department_config', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl?>/images/department.png" alt="Department Configuration" />
                </div>
                <div class="text-div">
                    <h3>Departments</h3>
                    <p>Manage, add, and update school departments efficiently.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getPage({page: 'class_config', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl?>/images/class.png" alt="Class Configuration" />
                </div>
                <div class="text-div">
                    <h3>Classess</h3>
                    <p>Create, organize, and manage classes for different levels and departments.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getPage({page: 'arm_config', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl?>/images/arms.png" alt="Arms Configuration" />
                </div>
                <div class="text-div">
                    <h3>Arms</h3>
                    <p>Create, organize, and manage Arms for different Classes.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getPage({page: 'subject_config', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl?>/images/subject.png" alt="Subject Configuration" />
                </div>
                <div class="text-div">
                    <h3>Subjects</h3>
                    <p>Define and manage subjects offered across various classes and departments.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/status.png"
                        alt="User Status Configurations" /></div>
                <div class="text-div">
                    <h3>CHANGE PASSWORD</h3>
                    <p>Click here to change and upadate your password</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<?php if ($page == 'bursaryDashboard') { ?>
<div class="page-title-back-div dashbaords-page-title-back-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="page-title-div">
        <div class="top-title"><span id="page-title"><i class="bi-speedometer2"></i> Dashboard Overview</span></div>
        <div class="main-title">👋 Hi, <span id="loginUserName">
                <script>
                $("#loginUserName").html(capitalizeFirstLetterOfEachWord(staffLoginData.fullName));
                </script>
            </span></div>
        <div class="bottom-title"><i class="bi-clock"></i> Last Login Date | <span id="loginUserLastLogin">
                <script>
                $("#loginUserLastLogin").html(staffLoginData.lastLoginTime);
                </script>
            </span>
        </div>
    </div>
</div>

<div class="pages-back-div dashbaords-pg-back-div">
    <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list" id="MasterCountConfigurations">
            <script>
            $("#MasterCountConfigurations").html(`
                        <div class="inner-div"  onclick="_fetchEachBranches('${staffLoginData.branchId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/branch.png" alt="${staffLoginData.branchName}"/></div>
                            <div class="text-div">
                                <h3>${staffLoginData.branchName}</h3>
                                <p>Click here to view your branch details</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>

        <div class="user-managment-list" id="MyProfile">
            <script>
            $("#MyProfile").html(`
                        <div class="inner-div"  onclick="_fetchEachStaff('${staffLoginData.staffId}');">
                            <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/profile.png" alt="MY PROFILE"/></div>
                            <div class="text-div">
                                <h3>MY PROFILE</h3>
                                <p>Manages Subject Lessons, Assignments, Grades, Attendance, And Student Performance Tracking For Their Designated Subject.</p>
                            </div>
                        </div>
                    `);
            </script>
        </div>


        <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/status.png"
                        alt="User Status Configurations" /></div>
                <div class="text-div">
                    <h3>CHANGE PASSWORD</h3>
                    <p>Click here to change and upadate your password</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>












































<?php if ($page == 'logout_confirm_form') { ?>
<div class="caption-success-div animated zoomIn">
    <div class="div-in">
        <div class="img"><img src="<?php echo $websiteUrl ?>/images/warning.gif" /></div>
        <h2>Are you sure to log-out?</h2>
        Please, confirm your log-out action.
        <div class="btn-div">
            <button class="btn" onclick="_logOut();">YES</button>
            <button class="btn no-btn" onclick="_alertClose(<?php echo $modalLayer ?>);">NO</button>
        </div>
    </div>
</div>
<?php } ?>