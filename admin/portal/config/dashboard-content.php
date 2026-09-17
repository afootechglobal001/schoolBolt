<?php if ($page == 'dashboard') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-speedometer2"></i></div>
            </div>
            <div class="text-div">
                <h2>Welcome, <span id="DashFullname">
                        Emmanuel
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
                        Aug 4, 2026
                    </span>
                </div>

                <div class="info-item">
                    <i class="bi bi-clock"></i>
                    <span id="lastLoginTime">
                        12:23:55 PM
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="dashboard-wrapper">
            <div class="left-container">
                <div class="statistics-back-div">
                    <div class="statistics-div pending-card" id="administratorsPage" title="Administrators"
                        onclick="_getActiveAdminPage({page:'administratorsPage', divid:'administratorsPage'});">

                        <div class="statistics-inner-div">
                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Administrators</p>
                                    <span>Total Administrators</span>
                                </div>

                                <div class="statistics-icon pending">
                                    <i class="bi bi-person-gear"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveStaffCount">10</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-person-workspace"></i>
                                    <span>Manage Administrators</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="statistics-div upcoming-card" id="servicePage" title="Registered Schools"
                        onclick="_getActivePage({page:'servicePage', divid:'servicePage'});">

                        <div class="statistics-inner-div">

                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Registered Schools</p>
                                    <span>Total schools registered on SchoolBolt.</span>
                                </div>

                                <div class="statistics-icon upcoming">
                                    <i class="bi bi-buildings-fill"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveServiceCount">7</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-building"></i>
                                    <span>Manage Schools</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="statistics-div gallery-card" id="galleryPage" title="Active Schools"
                        onclick="_getActivePage({page:'galleryPage', divid:'galleryPage'});">

                        <div class="statistics-inner-div completed-card">

                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Active Schools</p>
                                    <span>Schools with active subscriptions.</span>
                                </div>

                                <div class="statistics-icon completed">
                                    <i class="bi bi-building-check"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveGalleryCount">6</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-check2-circle"></i>
                                    <span>View Active Schools</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="statistics-div" id="galleryPage" title="Browse Gallery"
                        onclick="_getActivePage({page:'galleryPage', divid:'galleryPage'});">

                        <div class="statistics-inner-div gallery-card">

                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Gallery</p>
                                    <span>Completed Gallery Items</span>
                                </div>

                                <div class="statistics-icon">
                                    <i class="bi bi-images"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveGalleryCount">6</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-image"></i>
                                    <span>Browse Gallery</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="statistics-div pending-card" id="faqPage" title="Frequently Asked Questions"
                        onclick="_getActivePage({page:'faqPage', divid:'faqPage'});">

                        <div class="statistics-inner-div">
                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>FAQ</p>
                                    <span>Frequently Asked Questions (FAQs)</span>
                                </div>

                                <div class="statistics-icon">
                                    <i class="bi bi-patch-question"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveFaqCount">7</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-question-circle"></i>
                                    <span>View FAQs</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="statistics-div upcoming-card" id="blogsPage" title="View Blog Posts"
                        onclick="_getActivePage({page:'blogPage', divid:'blogPage'});">

                        <div class="statistics-inner-div">

                            <div class="statistics-top-div">
                                <div class="statistics-text">
                                    <p>Blog</p>
                                    <span>Published Articles</span>
                                </div>

                                <div class="statistics-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                            </div>

                            <div class="statistics-count">
                                <h2 id="totalActiveBlogCount">7</h2>
                            </div>

                            <div class="statistics-action-div">
                                <div class="action-left">
                                    <i class="bi bi-pencil-square"></i>
                                    <span>View Articles</span>
                                </div>

                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-container">
                <div class="recent-review-wrapper">
                    <div class="main-content-div dash-main-content-div" data-aos="fade-in" data-aos-duration="1500">
                        <div class="tables-content-div">
                            <div class="content-title">
                                <div class="title">
                                    <i class="bi bi-chat-text"></i>
                                    <p>Recent Pending Reviews</p>
                                </div>

                                <button class="btn btn-view" title="View All"
                                    onclick="_getActivePage({page:'reviewPage', divid:'reviewPage'});">
                                    VIEW ALL
                                </button>
                            </div>

                            <div class="inner-table-content review-table-content">
                                <div class="review-back-div" id="fetchDashboardReviews">
                                    <div class="review-div">
                                        <div class="review-header">
                                            <div class="review-user">
                                                <div class="avatar">
                                                    PE
                                                </div>

                                                <div class="user-info">
                                                    <h4>Peter Emmanuel</h4>
                                                    <span>
                                                        peter.emmanuel@gmail.com
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="review-meta">
                                                <div class="star-div">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>

                                                <span class="status approved">
                                                    Pending
                                                </span>
                                            </div>
                                        </div>

                                        <div class="review-content">
                                            BowCare provided excellent service. The technician arrived on time,
                                            explained the issue clearly, and completed the repair...
                                        </div>

                                        <div class="review-action">
                                            <button class="btn page-view-btn" title="Approve Review">
                                                <i class="bi bi-check-all"></i>
                                                APPROVE
                                            </button>
                                        </div>
                                    </div>

                                    <div class="review-div">
                                        <div class="review-header">
                                            <div class="review-user">
                                                <div class="avatar">
                                                    PE
                                                </div>

                                                <div class="user-info">
                                                    <h4>Peter Emmanuel</h4>
                                                    <span>
                                                        peter.emmanuel@gmail.com
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="review-meta">
                                                <div class="star-div">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </div>

                                                <span class="status approved">
                                                    Pending
                                                </span>
                                            </div>
                                        </div>

                                        <div class="review-content">
                                            BowCare provided excellent service. The technician arrived on time,
                                            explained the issue clearly, and completed the repair...
                                        </div>

                                        <div class="review-action">
                                            <button class="btn page-view-btn" title="Approve Review">
                                                <i class="bi bi-check-all"></i>
                                                APPROVE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </div>
<?php  } ?>

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