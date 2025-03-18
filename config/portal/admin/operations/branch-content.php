<?php if ($page == 'branches') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-diagram-3"></i> <strong>Branches</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search branch...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW BRANCH" onclick="_getForm({page: 'branch_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW BRANCH
                </button>
            </div>

        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
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
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW BRANCH</span></div>
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

                <div class="text_field_container" id="branchStateId_container">
                    <script>
                        selectField({
                            id: 'branchStateId',
                            title: 'Select Branch State',
                        });
                        _getSelectBranchState('branchStateId');
                    </script>
                </div>

                <div class="text_field_container" id="branchLgaId_container">
                    <script>
                        selectField({
                            id: 'branchLgaId',
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

                        <div class="text_field_container" id="paymentKey_container">
                            <script>
                                textField({
                                    id: 'paymentKey',
                                    title: 'PAYMENT KEY'
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
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createBranch();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_profile') { ?>
    <script>
        getEachBranchDetailsSession = JSON.parse(sessionStorage.getItem("getEachBranchDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-diagram-3"></i> BRANCH PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="current_user_passport1">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </label>

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

            <div class="btn-div branch-btn-div">
                <div class="div-in">
                    <ul>
                    <li class="active" title="Dashboard" id="branch_dashboard" onclick="_getActiveBranchPage({divid:'branch_dashboard', page: 'branch_dashboard', url: adminPortalLocalUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="Branch Staff" id="branch_staff" onclick="_getActiveBranchPage({divid:'branch_staff', page: 'branch_staff', url: adminPortalLocalUrl})"><i class="bi-person-workspace"></i> Staff</li>
                        <li id="dotted" title="Branch Student"><i class="bi-mortarboard"></i> Student
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li class="active" id="reg_students" title="Register Students"
                                       onclick="_getForm({page: 'branch_student_reg', layer:2, url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i>Register Student</li>

                                    <li id="my_students" title="View Students"
                                        onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i>View Student</li>
                                    
                                    <li id="my_students" title="Search Students"
                                        onclick="_getActiveBranchPage({divid:'view_students', page: 'view_students', url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i>Search Student</li>
                                </ul>
                            </div>
                        </li>

                        <li title="Branch Class" id="branch_class"
                            onclick="_getActiveBranchPage({divid:'branch_class', page: 'branch_class', url: adminPortalLocalUrl});"><i class="bi-people-fill"></i> Class</li>

                        <li title="Subject" id="branch_subject"
                        onclick="_getActiveBranchPage({divid:'branch_subject', page: 'branch_subject', url: adminPortalLocalUrl});"><i class="bi-journals"></i> Subject</li>
                        
                        <li id="dotted" title="Branch Record"><i class="bi-graph-up-arrow"></i> Report
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li title="Broad/Report Sheet"><i class="bi-graph-up-arrow"></i>Broad/Report Sheet</li>
                                    <li title="Cumulative Broadsheet"><i class="bi-graph-up-arrow"></i>Cumulative Broadsheet</li>
                                    <li title="Promotional Panel"><i class="bi-graph-up-arrow"></i>Promotional Panel</li>
                                </ul>
                            </div>
                        </li>

                        <li id="dotted" title="Branch Settings"><i class="bi-gear-wide-connected"></i> Settings
                            <div class="expand-div animated fadeIn">
                                <ul class="ul-expand">
                                    <li title="Change Password"><i class="bi-shield-check"></i>Change Password</li>
                                </ul>
                            </div>
                        </li>

                        <li title="Branch Profile" id="branch_profile_details"
                            onclick="_getActiveBranchPage({divid:'branch_profile_details', page: 'branch_profile_details', url: adminPortalLocalUrl});"><i class="bi-diagram-3"></i> Profile</li>

                        <li title="Branch Activities" id="branch_activities"
                            onclick="_getActiveBranchPage({divid:'branch_activities', page: 'branch_activities', url: adminPortalLocalUrl});"><i class="bi-bell"></i> Activities</li>
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
<?php if ($page == 'branch_dashboard') { ?>
    <div class="dashboard-statistics-wrapper">
        <div class="left-dashbaord-container">
            <div class="statistics-chart-back-div box-shadow">
                <div class="statistics-back-div">
                    <div class="statistics-div left-border font-size" title="Staff" onclick="">
                        <h2>5</h2>
                        <span><i class="bi-person-workspace"></i> Staff</span>
                    </div>

                    <div class="statistics-div left-border border-radius font-size" title="Class" onclick="">
                        <h2>8</h2>
                        <span><i class="bi-people-fill"></i> Class</span>
                    </div>

                    <div class="statistics-div font-size" title="Student" onclick="">
                        <h2>10</h2>
                        <span><i class="bi-mortarboard font-size"></i> Student </span>
                    </div>

                    <div class="statistics-div right-border font-size" title="Subject" onclick="">
                        <h2>100</h2>
                        <span><i class="bi-journals"></i> Subject</span>
                    </div>
                </div>

                <div class="chart-back-div">
                    <div class="chart-div-notifications no-border-top">
                        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

                        <div class="text text-right" onclick="select_search()">
                            <span id="srch-text">Last 30 Days</span>
                            <div class="icon-div"><i class="bi-caret-down"></i></div>

                            <div class="srch-select alert-srch-select">
                                <div id="srch-today" onclick="_getAlertReport('srch-today', 'view_today_search');">Today</div>
                                <div id="srch-week" onclick="_getAlertReport('srch-week', 'view_thisweek_search');">This Week</div>
                                <div id="srch-7" onclick="_getAlertReport('srch-7', 'view_7days_search');">Last 7 Days</div>
                                <div id="srch-month" onclick="_getAlertReport('srch-month', 'view_thismonth_search');">This Month</div>
                                <div id="srch-30" onclick="_getAlertReport('srch-30', 'view_30days_search');">Last 30 Days</div>
                                <div id="srch-90" onclick="_getAlertReport('srch-90', 'view_90days_search');">Last 90 Days</div>
                                <div id="srch-year" onclick="_getAlertReport('srch-year', 'view_thisyear_search');">This Year</div>
                                <div id="srch-1year" onclick="_getAlertReport('srch-1year', 'view_1year_search');">Last 1 Year</div>
                                <div onclick="srch_custom('Custom Search')">Custom Search</div>
                            </div>
                        </div>

                        <div class="text">
                            <div class="custom-srch-div">
                                <div class="custom-srch-div-in">
                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                                    </div>

                                    <div class="text_field_container dash_field_container">
                                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
                                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
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

                    <div class="trending-back-div">
                        <div class="revenue-back-div">
                            <div class="revenue-div top-rev">Revenue For<span>January 18 2025</span>-<span>February 17 2025</span></div>
                            <div class="revenue-div">
                                <h3><span>₦1,343,581.63</span>(SALES)</h3>-<h3><span>₦256,000.00</span>(WALLET)</h3>
                            </div>
                        </div>

                        <div id="chartContainer" style="width:100%; height:300px; margin:auto;"></div>
                        <script>
                            $(document).ready(function() {
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light1",
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
                                            type: "line",
                                            showInLegend: true,
                                            name: "Sales",
                                            markerType: "square",
                                            xValueFormatString: "DD MMM, YYYY",
                                            color: "#29BA00",
                                            dataPoints: [{
                                                    x: new Date(2025, 0, 1),
                                                    y: 250000
                                                },
                                                {
                                                    x: new Date(2025, 0, 2),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 3),
                                                    y: 100000
                                                },
                                                {
                                                    x: new Date(2025, 0, 4),
                                                    y: 300000
                                                },
                                                {
                                                    x: new Date(2025, 0, 5),
                                                    y: 120000
                                                },
                                                {
                                                    x: new Date(2025, 0, 6),
                                                    y: 150000
                                                },
                                                {
                                                    x: new Date(2025, 0, 7),
                                                    y: 275000
                                                },
                                                {
                                                    x: new Date(2025, 0, 8),
                                                    y: 160000
                                                },
                                                {
                                                    x: new Date(2025, 0, 9),
                                                    y: 350000
                                                },
                                                {
                                                    x: new Date(2025, 0, 10),
                                                    y: 380000
                                                },
                                                {
                                                    x: new Date(2025, 0, 11),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 12),
                                                    y: 100000
                                                },
                                                {
                                                    x: new Date(2025, 0, 13),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 14),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 15),
                                                    y: 270000
                                                },
                                            ]
                                        },
                                        {
                                            type: "line",
                                            showInLegend: true,
                                            name: "Wallet",
                                            lineDashType: "dash",
                                            dataPoints: [{
                                                    x: new Date(2025, 0, 1),
                                                    y: 180000
                                                },
                                                {
                                                    x: new Date(2025, 0, 2),
                                                    y: 50000
                                                },
                                                {
                                                    x: new Date(2025, 0, 3),
                                                    y: 80000
                                                },
                                                {
                                                    x: new Date(2025, 0, 4),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 5),
                                                    y: 150000
                                                },
                                                {
                                                    x: new Date(2025, 0, 6),
                                                    y: 40000
                                                },
                                                {
                                                    x: new Date(2025, 0, 7),
                                                    y: 300000
                                                },
                                                {
                                                    x: new Date(2025, 0, 8),
                                                    y: 200000
                                                },
                                                {
                                                    x: new Date(2025, 0, 9),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 10),
                                                    y: 120000
                                                },
                                                {
                                                    x: new Date(2025, 0, 11),
                                                    y: 90000
                                                },
                                                {
                                                    x: new Date(2025, 0, 12),
                                                    y: 200000
                                                },
                                                {
                                                    x: new Date(2025, 0, 13),
                                                    y: 0
                                                },
                                                {
                                                    x: new Date(2025, 0, 14),
                                                    y: 280000
                                                },
                                                {
                                                    x: new Date(2025, 0, 15),
                                                    y: 50000
                                                },

                                            ]
                                        }
                                    ]

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
                        <h3>Order Matrix</h3>
                    </div>
                    <div id="chartContainer1" style="width:100%; height:200px; margin:auto;"></div>

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
                                        label: "Outstanding",
                                        y: 5
                                    },
                                    {
                                        label: "Pending",
                                        y: 6
                                    },
                                    {
                                        label: "Processing",
                                        y: 4
                                    },
                                    {
                                        label: "Ready",
                                        y: 5
                                    },
                                    {
                                        label: "Delivered",
                                        y: 15
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
    </div>
<?php } ?>

<?php if ($page == 'branch_staff') { ?>
    <div class="alert alert-success form-alert animated fadeIn"><span><i class="bi-person-bounding-box"></i> BRANCH STAFF LIST</span></div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>_fetchBranchStaffs();</script>
        </table>
    </div>
   
<?php } ?>

<?php if ($page == 'branch_profile_details') { ?>
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

            <div class="text_field_container col-1" id="branchStateId_container">
                <script>
                    selectField({
                        id: 'branchStateId',
                        title: 'Select Branch State',
                        fieldValue: getEachBranchDetailsSession?.stateId ?? '',
                        fieldLabel: getEachBranchDetailsSession?.stateName ?? ''
                    });
                    _getSelectBranchState('branchStateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="branchLgaId_container">
                <script>
                    selectField({
                        id: 'branchLgaId',
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
                        value: getEachBranchDetailsSession?.smtpHost ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpUsername_container">
                <script>
                    textField({
                        id: 'updateSmtpUsername',
                        title: 'SMTP USERNAME',
                        value: getEachBranchDetailsSession?.smtpUsername ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPassword_container">
                <script>
                    textField({
                        id: 'updateSmtpPassword',
                        title: 'SMTP PASSWORD',
                        type: 'password',
                        value: getEachBranchDetailsSession?.smtpPassword ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSmtpPort_container">
                <script>
                    textField({
                        id: 'updateSmtpPort',
                        title: 'SMTP PORT',
                        type: 'number',
                        value: getEachBranchDetailsSession?.smtpPort ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateSupportEmail_container">
                <script>
                    textField({
                        id: 'updateSupportEmail',
                        title: 'SUPPORT EMAIL',
                        type: 'email',
                        value: getEachBranchDetailsSession?.supportEmail ?? ''
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
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateBranch();"> UPDATE PROFILE <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_activities') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification History for </div>

        <div class="text text-right" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>
            <div class="icon-div"><i class="bi-caret-down"></i></div>

            <div class="srch-select alert-srch-select">
                <div id="srch-today" onclick="_getAlertReport('srch-today', 'view_today_search');">Today</div>
                <div id="srch-week" onclick="_getAlertReport('srch-week', 'view_thisweek_search');">This Week</div>
                <div id="srch-7" onclick="_getAlertReport('srch-7', 'view_7days_search');">Last 7 Days</div>
                <div id="srch-month" onclick="_getAlertReport('srch-month', 'view_thismonth_search');">This Month</div>
                <div id="srch-30" onclick="_getAlertReport('srch-30', 'view_30days_search');">Last 30 Days</div>
                <div id="srch-90" onclick="_getAlertReport('srch-90', 'view_90days_search');">Last 90 Days</div>
                <div id="srch-year" onclick="_getAlertReport('srch-year', 'view_thisyear_search');">This Year</div>
                <div id="srch-1year" onclick="_getAlertReport('srch-1year', 'view_1year_search');">Last 1 Year</div>
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
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
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>
    </div>
<?php } ?>
