<?php if ($page == 'schoolsPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-buildings-fill"></i></div>
            </div>
            <div class="text-div">
                <h3>Schools Management</h3>
                <p>Manage registered schools, track onboarding progress, and monitor activation status from one dashboard.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersSchools(this.value);" placeholder="Search Schools Here...">
                <i class="bi bi-search"></i>
            </div>

            <button class="btn" title="ONBOARD NEW SCHOOL"
                onclick="_getForm({page: 'schoolReg', url: portalMiddleWareUrl});">
                <i class="bi bi-building-add"></i> ONBOARD NEW SCHOOL
            </button>
        </div>
    </div>

    <div class="main-content-div no-padding-bottom-content" data-aos="fade-in" data-aos-duration="1500">
        <div class="pages-statistics-wrapper">
            <div class="report-statistics-back-div">
                <div class="report-statistics-div" title="Total Schools">
                    <div class="statistics-inner-div">
                        <div class="icon-div secondary">
                            <i class="bi bi-buildings-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Total Schools</p>
                            <span>All schools registered on SchoolBolt</span>
                            <h2 id="totalSchools">0</h2>
                        </div>
                    </div>
                </div>

                <div class="report-statistics-div" title="Active Schools">
                    <div class="statistics-inner-div">
                        <div class="icon-div active">
                            <i class="bi bi-patch-check-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Active Schools</p>
                            <span>Schools currently using the platform</span>
                            <h2 id="activeSchools">0</h2>
                        </div>
                    </div>
                </div>

                <div class="report-statistics-div" title="Suspended Schools">
                    <div class="statistics-inner-div">
                        <div class="icon-div danger">
                            <i class="bi bi-ban-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Suspended Schools</p>
                            <span>Schools currently suspended from the platform</span>
                            <h2 id="suspendedSchools">0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-buildings-fill"></i>
                    <p>Registered Schools</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="tb-col">
                                <th>Sn</th>
                                <th>Client ID</th>
                                <th>School Name</th>
                                <th>School Contact</th>
                                <th>Address</th>
                                <th>Administrator</th>
                                <th>Total SchoolBolt Wallet Balance(<s>N</s>)</th>
                                <th>Onboarded Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="schoolsContent">
                            <script>
                                _fetchSchoolsData();
                            </script>

                            <tr>
                                <td colspan="20">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div id="schoolsContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'schoolReg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-person-bounding-box"></i></div>
                <h3>CREATE NEW STAFF</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <!-- /////////// Title ////////////////////////////// -->
        <div class="container-back-div">
            <div class="form-notification">
                <p>You are about to create a new staff. Please complete the form below with accurate details to successfully create new staff.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-person-bounding-box"></i>
                            <p>Basic Information</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="firstName_container">
                            <script>
                                textField({
                                    id: 'firstName',
                                    title: 'First Name'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="lastName_container">
                            <script>
                                textField({
                                    id: 'lastName',
                                    title: 'Last Name'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="emailAddress_container">
                            <script>
                                textField({
                                    id: 'emailAddress',
                                    title: 'Email Address',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="phoneNumber_container">
                            <script>
                                textField({
                                    id: 'phoneNumber',
                                    title: 'Phone Number',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-person-bounding-box"></i>
                            <p>Administrative Information</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="roleId_container">
                            <script>
                                selectField({
                                    id: 'roleId',
                                    title: 'Select Role'
                                });
                                _getSelectRole('roleId');
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
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStaff();"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'schoolsProfile') { ?>
    <script>
        getEachSchoolDetailsSession = JSON.parse(sessionStorage.getItem("getEachSchoolDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-buildings-fill"></i></div>
                <h3 id="pageTitle">SCHOOL PROFILE</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">
                                    <script>
                                        $("#fullName").html(getEachSchoolDetailsSession?.schoolName);
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn"><span id="statusName"></span></div>
                                    </div>
                                    | Email:
                                    <strong id="schoolEmail">
                                        <script>
                                            $("#schoolEmail").html(getEachSchoolDetailsSession?.schoolEmail);
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachSchoolDetailsSession?.statusData?.statusName;
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
                    <ul>
                        <li class="active" title="Dashboard" id="schoolDashboard" onclick="_getActiveSchoolsPage({divid:'schoolDashboard', page: 'schoolDashboard', url: portalMiddleWareUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="School Branches" id="schoolBranches" onclick="_getActiveSchoolsPage({divid:'schoolBranches', page: 'schoolBranches', url: portalMiddleWareUrl});"><i class="bi bi-diagram-3"></i> Branches</li>
                        <li title="School Profile" id="schoolProfileDetails" onclick="_getActiveSchoolsPage({divid:'schoolProfileDetails', page: 'schoolProfileDetails', url: portalMiddleWareUrl});"><i class="bi bi-mortarboard-fill"></i> School Profile</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="getSchoolsDetails">
                    <script>
                        _getActiveSchoolsPage({
                            divid: 'schoolDashboard',
                            page: 'schoolDashboard',
                            url: portalMiddleWareUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- For Schools Modal Pages -->
<?php if ($page == 'schoolDashboard') { ?>
    <div class="report-statistics-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="report-statistics-div" title="Total Branches">
            <div class="statistics-inner-div">
                <div class="icon-div secondary">
                    <i class="bi bi-buildings-fill"></i>
                </div>

                <div class="report-statistics-text">
                    <p>Total Branches</p>
                    <span>All school branches registered</span>
                    <h2 id="totalBranches">4</h2>
                </div>
            </div>
        </div>

        <div class="report-statistics-div" title="Total Administrators">
            <div class="statistics-inner-div">
                <div class="icon-div active">
                    <i class="bi bi-person-badge-fill"></i>
                </div>

                <div class="report-statistics-text">
                    <p>Total Administrators</p>
                    <span>School administrators managing branches</span>
                    <h2 id="totalAdministrators">3</h2>
                </div>
            </div>
        </div>

        <div class="report-statistics-div" title="Total Staff">
            <div class="statistics-inner-div">
                <div class="icon-div success">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="report-statistics-text">
                    <p>Total Staff</p>
                    <span>Teaching and non-teaching staff records</span>
                    <h2 id="totalStaff">100</h2>
                </div>
            </div>
        </div>

        <div class="report-statistics-div" title="Total Students">
            <div class="statistics-inner-div">
                <div class="icon-div warning">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <div class="report-statistics-text">
                    <p>Total Students</p>
                    <span>Students enrolled across all branches</span>
                    <h2 id="totalStudents">300</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-revenue-wrapper">
        <div class="chart-back-div">
            <div class="chart-div-notifications top-border-radius">
                <div class="text-wrapper">
                    <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

                    <div class="text text-right" onclick="select_search()">
                        <span id="srch-text">Last 30 Days</span>
                        <div class="icon-div"><i class="bi-caret-down"></i></div>

                        <div class="srch-select alert-srch-select">
                            <div id="srch-today" onclick="_fetchDashBoardRevenueFiltering('srch-today', 'Today');">Today
                            </div>
                            <div id="srch-week" onclick="_fetchDashBoardRevenueFiltering('srch-week', 'This Week');">
                                This
                                Week</div>
                            <div id="srch-7" onclick="_fetchDashBoardRevenueFiltering('srch-7', 'Last 7 Days');">Last 7
                                Days
                            </div>
                            <div id="srch-month" onclick="_fetchDashBoardRevenueFiltering('srch-month', 'This Month');">
                                This
                                Month</div>
                            <div id="srch-30" onclick="_fetchDashBoardRevenueFiltering('srch-30', 'Last 30 Days');">Last
                                30 Days
                            </div>
                            <div id="srch-90" onclick="_fetchDashBoardRevenueFiltering('srch-90', 'Last 90 Days');">Last
                                90 Days
                            </div>
                            <div id="srch-year" onclick="_fetchDashBoardRevenueFiltering('srch-year', 'This Year');">
                                This
                                Year</div>
                            <div id="srch-1year"
                                onclick="_fetchDashBoardRevenueFiltering('srch-1year', 'Last 1 Year');">Last 1
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
                                    onclick="_fetchDashboardCustomRevenueFiltering();">Apply</button>
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

                <div class="revenue-date">
                    <i class="bi-info-circle"></i> Revenue report between <strong id="dateFrom">July 07 2026 </strong>
                    and <strong id="dateTo">August 05 2026</strong>
                </div>
            </div>

            <div class="trending-back-div">
                <div class="report-statistics-back-div">
                    <div class="report-statistics-div" title="Total revenue from all schools">
                        <div class="statistics-inner-div">
                            <div class="icon-div active">
                                <i class="bi bi-cash-coin"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Total Revenue</p>
                                <span>Total revenue from all schools</span>
                                <h2 id="totalRevenue"><strong><s>N</s></strong>20,000.00</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="Total Advance Payments">
                        <div class="statistics-inner-div">
                            <div class="icon-div secondary">
                                <i class="bi bi-wallet2"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Total Advance Payments</p>
                                <span>Total unused payments received</span>
                                <h2 id="sumCreditCardPayments"><strong><s>N</s></strong>10,000.00</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="Total Service Payments">
                        <div class="statistics-inner-div">
                            <div class="icon-div success">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Total Service Payments</p>
                                <span>Total used and completed services</span>
                                <h2 id="sumBankTransferPayments"><strong><s>N</s></strong>10,000.00</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="Bank Transfer Transactions">
                        <div class="statistics-inner-div">
                            <div class="icon-div warning">
                                <i class="bi bi-receipt"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Bank Transfer Transactions</p>
                                <span>Total bank transfer transactions</span>
                                <h2 id="countCreditCardPayments">2</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="Credit Card Transactions">
                        <div class="statistics-inner-div">
                            <div class="icon-div info">
                                <i class="bi bi-clipboard-check"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Credit Card Transactions</p>
                                <span>Total credit card transactions</span>
                                <h2 id="countBankTransferPayments">3</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="Basic School Advance Payment">
                        <div class="statistics-inner-div">
                            <div class="icon-div primary">
                                <i class="bi bi-house-door-fill"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>Basic School Advance Payment</p>
                                <span>Total advance payments received from Basic Schools</span>
                                <h2 id="sumStripePayments"><strong><s>N</s></strong>30,000.00</h2>
                            </div>
                        </div>
                    </div>

                    <div class="report-statistics-div" title="College School Advance Payment">
                        <div class="statistics-inner-div">
                            <div class="icon-div danger">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>

                            <div class="report-statistics-text">
                                <p>College School Advance Payment</p>
                                <span>Total payments from College Schools</span>
                                <h2 id="sumPayPalPayments"><strong><s>N</s></strong>25,000.00</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="chartContainer" style="width:100%; height:400px; margin:auto;"></div>
                <script>
                $(document).ready(function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,

                        axisX: {
                            valueFormatString: "DD MMM",
                            crosshair: {
                                enabled: true,
                                snapToDataPoint: true
                            }
                        },

                        axisY: {
                            includeZero: true,
                            prefix: "₦",
                            valueFormatString: "#,##0",
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
                                type: "splineArea",
                                showInLegend: true,
                                name: "Total Advanced Payment",
                                xValueFormatString: "DD MMM, YYYY",
                                yValueFormatString: "₦#,##0",
                                color: "#635BFF", // Stripe Brand Color
                                dataPoints: [{
                                        x: new Date(2026, 5, 1),
                                        y: 45000
                                    },
                                    {
                                        x: new Date(2026, 5, 5),
                                        y: 62000
                                    },
                                    {
                                        x: new Date(2026, 5, 10),
                                        y: 38000
                                    },
                                    {
                                        x: new Date(2026, 5, 15),
                                        y: 90000
                                    },
                                    {
                                        x: new Date(2026, 5, 20),
                                        y: 70000
                                    },
                                    {
                                        x: new Date(2026, 5, 25),
                                        y: 120000
                                    },
                                    {
                                        x: new Date(2026, 5, 30),
                                        y: 95000
                                    }
                                ]
                            },
                            {
                                type: "splineArea",
                                showInLegend: true,
                                name: "Total Service Payment",
                                xValueFormatString: "DD MMM, YYYY",
                                yValueFormatString: "₦#,##0",
                                color: "#0070BA", // PayPal Brand Color
                                dataPoints: [{
                                        x: new Date(2026, 5, 1),
                                        y: 45000
                                    },
                                    {
                                        x: new Date(2026, 5, 5),
                                        y: 75000
                                    },
                                    {
                                        x: new Date(2026, 5, 10),
                                        y: 38000
                                    },
                                    {
                                        x: new Date(2026, 5, 15),
                                        y: 90000
                                    },
                                    {
                                        x: new Date(2026, 5, 20),
                                        y: 60000
                                    },
                                    {
                                        x: new Date(2026, 5, 25),
                                        y: 100000
                                    },
                                    {
                                        x: new Date(2026, 5, 30),
                                        y: 95000
                                    }
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
                });
                </script>
            </div>
        </div>

        <div class="right-wrapper">
            <div class="matrix-div">
                <div class="inner-div">
                    <div class="title">
                        <h3>Payment Gateway Matrix</h3>
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
                            showInLegend: false,
                            legendText: "{label}",
                            indexLabel: "{label} ($ {y})",
                            yValueFormatString: "$#,##0.00",
                            indexLabelFontSize: 9,
                            dataPoints: [{
                                    label: "STRIPE",
                                    y: 10000.00
                                },
                                {
                                    label: "PAYPAL",
                                    y: 5000.00
                                }
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
                        <h3>Income Sources Overview</h3>
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
                                    label: "Total Advanced Payment",
                                    y: 3
                                },
                                {
                                    label: "Total Services Payment",
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

    <div class="main-content-div dash-main-content-div">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-buildings-fill"></i>
                    <p>Branches List</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="tb-col">
                                <th>Sn</th>
                                <th>Branch Name</th>
                                <th>Branch Contact</th>
                                <th>Session/Term</th>
                                <th>Address</th>
                                <th>Administrator</th>
                                <th>No. of Staff</th>
                                <th>No. of Students</th>
                                <th>Total SchoolBolt Wallet Balance(<s>N</s>)</th>
                                <th>Onboarded Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="branchesContent">
                            <script>
                                _fetchBranchesData();
                            </script>

                            <tr>
                                <td colspan="20">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div id="branchesContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'schoolBranches') { ?>
    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-buildings-fill"></i>
                    <p>Branches List</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="tb-col">
                                <th>Sn</th>
                                <th>Branch Name</th>
                                <th>Branch Contact</th>
                                <th>Session/Term</th>
                                <th>Address</th>
                                <th>Administrator</th>
                                <th>No. of Staff</th>
                                <th>No. of Students</th>
                                <th>Total SchoolBolt Wallet Balance(<s>N</s>)</th>
                                <th>Onboarded Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="branchesContent">
                            <script>
                                _fetchBranchesData();
                            </script>

                            <tr>
                                <td colspan="20">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div id="branchesContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'schoolProfileDetails') { ?>
    <div class="user-in">
        <div class="title">STAFF BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateFirstName_container">
                <script>
                    textField({
                        id: 'updateFirstName',
                        title: 'First Name',
                        value: getEachSchoolDetailsSession?.firstName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateLastName_container">
                <script>
                    textField({
                        id: 'updateLastName',
                        title: 'Last Name',
                        value: getEachSchoolDetailsSession?.lastName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updatePhoneNumber_container">
                <script>
                    textField({
                        id: 'updatePhoneNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        value: getEachSchoolDetailsSession?.phoneNumber ?? '',
                        onKeyPressFunction: 'isNumberCheck(event);'
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateEmailAddress_container">
                <script>
                    textField({
                        id: 'updateEmailAddress',
                        title: 'Email Address',
                        type: 'email',
                        value: getEachSchoolDetailsSession?.emailAddress ?? ''
                    });
                </script>
            </div>            
        </div>
    </div>

    <div class="user-in">
        <div class="title">STAFF ACCOUNT INFORMATION</div>
        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="staffId_container">
                <script>
                    textField({
                        id: 'staffId',
                        title: 'Staff ID',
                        readonly: true,
                        value: getEachSchoolDetailsSession?.staffId ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        readonly: true,
                        value: getEachSchoolDetailsSession?.createdTime ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="lastLogin_container">
                <script>
                    textField({
                        id: 'lastLogin',
                        title: 'Last Login Date',
                        readonly: true,
                        value: getEachSchoolDetailsSession?.lastLoginTime ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">ADMINISTRATIVE INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateRoleId_container">
                <script>
                    selectField({
                        id: 'updateRoleId',
                        title: 'Select Role',
                        fieldValue: getEachSchoolDetailsSession?.roleData?.roleId ?? '',
                        fieldLabel: getEachSchoolDetailsSession?.roleData?.roleName ?? ''
                    });
                    _getSelectRole('updateRoleId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status',
                        fieldValue: getEachSchoolDetailsSession?.statusData?.statusId ?? '',
                        fieldLabel: getEachSchoolDetailsSession?.statusData?.statusName ?? ''
                    });
                    _getSelectStatusId('updateStatusId', '1,2');
                </script>
            </div>
        </div>
        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateStaff();"> UPDATE PROFILE <i class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>