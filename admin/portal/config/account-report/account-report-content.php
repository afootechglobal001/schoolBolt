<?php if ($page == 'reportPage') { ?>
<div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="title-div">
        <div>
            <div class="icon-div"><i class="bi bi-graph-up-arrow"></i></div>
        </div>
        <div class="text-div">
            <h3>Income/Revenue</h3>
            <p>Track and manage all income and revenue records in one place. Monitor payments, generate financial
                reports, and gain clear insights into your institution's financial performance with ease.</p>
        </div>
    </div>

    <div class="btn-div">
        <div class="search-div">
            <input type="text" onkeyup="" placeholder="Search Report Here...">
            <i class="bi bi-search"></i>
        </div>
    </div>
</div>

<div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
    <div class="nav-content-back-div">
        <div class="nav-container">
            <ul>
                <li class="active border" title="Filter Revenue By Date Range" id="filterByDate"
                    onclick="_getActiveReportNav({divid:'filterByDate', page: 'filterByDate', url: portalMiddleWareUrl});">
                    <i class="bi-calendar2-check"></i> Date Range
                </li>
            </ul>
        </div>

        <div id="getNavPage">
            <script>
            _getActiveReportNav({
                divid: 'filterByDate',
                page: 'filterByDate',
                url: portalMiddleWareUrl
            });
            </script>
        </div>
    </div>
</div>
<?php } ?>

<!-- Filter By Date Revenue Pages -->
<?php if ($page == 'filterByDate') { ?>
<div class="chart-div-notifications report-chart-div">
    <div class="text-wrapper">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

        <div class="text text-right" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>
            <div class="icon-div"><i class="bi-caret-down"></i></div>

            <div class="srch-select alert-srch-select">
                <div id="srch-today" onclick="_fetchReportRevenueFiltering('srch-today', 'Today');">Today
                </div>
                <div id="srch-week" onclick="_fetchReportRevenueFiltering('srch-week', 'This Week');">This
                    Week</div>
                <div id="srch-7" onclick="_fetchReportRevenueFiltering('srch-7', 'Last 7 Days');">Last 7 Days
                </div>
                <div id="srch-month" onclick="_fetchReportRevenueFiltering('srch-month', 'This Month');">This
                    Month</div>
                <div id="srch-30" onclick="_fetchReportRevenueFiltering('srch-30', 'Last 30 Days');">Last 30 Days
                </div>
                <div id="srch-90" onclick="_fetchReportRevenueFiltering('srch-90', 'Last 90 Days');">Last 90 Days
                </div>
                <div id="srch-year" onclick="_fetchReportRevenueFiltering('srch-year', 'This Year');">This
                    Year</div>
                <div id="srch-1year" onclick="_fetchReportRevenueFiltering('srch-1year', 'Last 1 Year');">Last 1
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
                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
                        <div class="placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To </div>
                        <div class="issueText" id="issue_to"></div>
                    </div>
                    <button type="button" class="btn" id="applyCustomSearchBtn"
                        onclick="_fetchCustomReportRevenueFiltering();">Apply</button>
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
        <i class="bi-info-circle"></i> Revenue report between <strong id="dateFrom">Loading...</strong> and <strong
            id="dateTo">Loading...</strong>
    </div>
</div>

<div class="fetch-report-back-div">
    <div class="report-dashbaord-wrapper animated fadeIn">
        <div class="dashboard-statistics-wrapper">
            <div class="left-dashbaord-container">
                <div class="statistics-chart-back-div">
                    <div class="report-statistics-back-div">
                        <div class="report-statistics-div" title="Revenue from All Channels">
                            <div class="statistics-inner-div">
                                <div class="icon-div active">
                                    <i class="bi bi-cash-coin"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Total Revenue</p>
                                    <span>Total revenue from all channels</span>
                                    <h2 id="totalRevenue"><strong>$</strong>20,000.00</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="Advance Payments">
                            <div class="statistics-inner-div">
                                <div class="icon-div secondary">
                                    <i class="bi bi-wallet2"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Total Advance Payments</p>
                                    <span>Total Advance payments received</span>
                                    <h2 id="totalAdvancePayments"><strong>$</strong>0.00</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="Completed Service Payments">
                            <div class="statistics-inner-div">
                                <div class="icon-div success">
                                    <i class="bi bi-tools"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Total Service Payments</p>
                                    <span>Total Income from completed services</span>
                                    <h2 id="totalServicePayments"><strong>$</strong>0.00</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="Advance Payment Transactions">
                            <div class="statistics-inner-div">
                                <div class="icon-div warning">
                                    <i class="bi bi-receipt"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Advance Transactions</p>
                                    <span>Total Advance payment transactions</span>
                                    <h2 id="countAdvanceTransactions">2</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="Service Payment Transactions">
                            <div class="statistics-inner-div">
                                <div class="icon-div info">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Service Transactions</p>
                                    <span>Total completed payment transactions</span>
                                    <h2 id="countServiceTransactions">3</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="Stripe Revenue">
                            <div class="statistics-inner-div">
                                <div class="icon-div primary">
                                    <i class="bi bi-stripe"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>Stripe Revenue</p>
                                    <span>Total payments processed through Stripe</span>
                                    <h2 id="totalStripeRevenue"><strong>$</strong>0.00</h2>
                                </div>
                            </div>
                        </div>

                        <div class="report-statistics-div" title="PayPal Revenue">
                            <div class="statistics-inner-div">
                                <div class="icon-div danger">
                                    <i class="bi bi-paypal"></i>
                                </div>

                                <div class="report-statistics-text">
                                    <p>PayPal Revenue</p>
                                    <span>Total payments processed through PayPal</span>
                                    <h2 id="totalPayPalRevenue"><strong>$</strong>0.00</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%">
                            <thead>
                                <tr class="tb-col">
                                    <th>sn</th>
                                    <th>Date</th>
                                    <th>Successful(<s>N</s>)</th>
                                    <th>Pending(<s>N</s>)</th>
                                    <th>Cancelled(<s>N</s>)</th>
                                    <th>View</th>
                                </tr>
                            </thead>

                            <tbody id="acoountReportPageContent">

                                <!-- CONTENT GOES HERE -->
                                <tr>
                                    <td colspan="20">
                                        <div class="content-loading-div">
                                            <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div id="acoountReportPageContentPaginationControls" class="pagination-div"></div>
                    </div>
                </div>
            </div>

            <div class="right-dashbaord-container">
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
                                // dataPoints: [{
                                //         label: "STRIPE",
                                //         y: 10000.00
                                //     },
                                //     {
                                //         label: "PAYPAL",
                                //         y: 5000.00
                                //     }
                                // ]
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
                                // dataPoints: [{
                                //         label: "Total Advanced Payment",
                                //         y: 3
                                //     },
                                //     {
                                //         label: "Total Services Payment",
                                //         y: 11
                                //     },
                                // ]
                            }]
                            };
                            $("#chartContainer2").CanvasJSChart(options);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function() {
            _fetchReportRevenueFiltering('srch-30', 'Last 30 Days');
        });
    </script>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'revenueBreakdown') { ?>
<div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
    <div class="form-title-div">
        <div class="title-div">
            <div class="icon-div"><i class="bi-graph-up-arrow"></i></div>
            <h3 id="pageTitle">REVENUE BREAKDOWN</h3>
        </div>
        <div class="btn-div">
            <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                <i class="bi bi-x-lg"></i> Close
            </button>
        </div>
    </div>

    <div class="profile-content-div">
        <div class="field-back-div">
            <div class="field-inner-div report-field-inner-div">
                <div class="content-wrapper animated fadeIn">
                    <div class="header-div">
                        <div class="title-nav-back-div">
                            <div class="nav-ul-div">
                                <ul>
                                    <li class="active-li" title="Successful Status" id="successfulPage"
                                        onclick="_getPaymentStatusNav({divid:'successfulPage', page: 'successfulPage', id: '<?php echo $id; ?>', url: portalMiddleWareUrl});">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/tick-mark.png"
                                            alt="Successful Icon" /> SUCCESSFUL
                                    </li>
                                    <li title="Pending Status" id="pendingPage"
                                        onclick="_getPaymentStatusNav({divid:'pendingPage', page: 'pendingPage', id: '<?php echo $id; ?>', url: portalMiddleWareUrl});">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/load.png"
                                            alt="Pending Icon" />
                                        PENDING
                                    </li>
                                    <li title="Cancel Status" id="cancelledPage"
                                        onclick="_getPaymentStatusNav({divid:'cancelledPage', page: 'cancelledPage', id: '<?php echo $id; ?>', url: portalMiddleWareUrl});">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/close.png"
                                            alt="Cancelled Icon" /></i> CANCELLED
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="content-container" id="getPaymentNav">
                        <script>
                        _getPaymentStatusNav({
                            divid: 'successfulPage',
                            page: 'successfulPage',
                            id: '<?php echo $id; ?>',
                            url: portalMiddleWareUrl
                        });
                        sessionStorage.setItem("sessionPayDate", '<?php echo $id; ?>');
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- ///// Success Page //// -->
<?php if ($page == 'successfulPage') { ?>
<div id="revenueAlert" class="alert top-alert-div report-alert animated fadeIn">
    <div>
        <i class="bi-graph-up-arrow"></i>
        Successful Transactions On <span id="date"></span>
        <output style="display:none;">
            -- Total Revenue:
            <span class="balance" id="totalAmount"></span>
        </output>
    </div>

    <div class="btn-container">
        <button class="btn"><i class="bi-printer"></i> PRINT</button>
        <button class="btn"><i class="bi-file-earmark-excel"></i> EXPORT</button>
    </div>
</div>

<div class="table-div animated fadeIn">
    <table class="table" cellspacing="0" style="width:100%">
        <thead>
            <tr class="tb-col">
                <th>sn</th>
                <th>Student Info</th>
                <th>Contact</th>
                <th>Institution</th>
                <th>Program</th>
                <th>Level</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>View</th>
            </tr>
        </thead>

        <tbody id="pageContent">

            <tr class="tb-row">
                <td>1</td>

                <td class="clickable-td" title="Click to view student details"
                    onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">

                    <div class="text-back-div">
                        <div class="image-div general-passport">
                            <img src="${studentPixPath}/${passport}" alt="John Emmanuel" />
                        </div>

                        <div class="text-div">
                            <div class="first-class">John Emmanuel</div>
                            <div class="second-class">SID00320260624110353</div>
                        </div>
                    </div>
                </td>

                <td>
                    <div class="text-div">
                        <div>
                            07050903886
                        </div>
                        <div>
                            seunemmanuel107@gmail.com
                        </div>
                    </div>
                </td>

                <td>
                    <div class="text-div">
                        <div>
                            Gateway ICT Polytechnic
                        </div>
                        <div>
                            Computer Science
                        </div>
                    </div>
                </td>

                <td>
                    <div class="text-div">
                        <div>SIWES</div>
                        <div>Backend Web Development</div>
                    </div>
                </td>

                <td>
                    <div class="text-div">
                        <div>
                            18012211071
                        </div>
                        <div>
                            ND 1
                        </div>
                    </div>
                </td>

                <td><s>N</s>800.00</td>

                <td>
                    <div class="status-div SUCCESSFUL">
                        SUCCESSFUL
                    </div>
                </td>

                <td>2026-07-16</td>
                <td><button class="btn view-btn" title="Click to view payment breakdown"
                        onclick="_getForm({ page: 'paymentBreakDownForm', id: '2026-07-16', layer:2, url: portalMiddleWareUrl});">VIEW
                        DETAILS</button></td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<!-- ///// Pending Page //// -->
<?php if ($page == 'pendingPage') { ?>
<div id="revenueAlert" class="alert top-alert-div animated fadeIn">
    <div>
        <i class="bi-graph-up-arrow"></i>
        Pending Transactions On <span id="date"></span>
        <output style="display:none;">
            -- Total Revenue:
            <span class="balance" id="totalAmount"></span>
        </output>
    </div>

    <div class="btn-container">
        <button class="btn"><i class="bi-printer"></i> PRINT</button>
        <button class="btn"><i class="bi-file-earmark-excel"></i> EXPORT</button>
    </div>
</div>

<div class="table-div animated fadeIn">
    <table class="table" cellspacing="0" style="width:100%">
        <thead>
            <tr class="tb-col">
                <th>sn</th>
                <th>Student Info</th>
                <th>Parent Info</th>
                <th>Branch</th>
                <th>Session/Term</th>
                <th>Class</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>View</th>
            </tr>
        </thead>

        <tbody id="pageContent">
            <script>
            $(document).ready(function() {
                const newpayDate = "<?php echo $id; ?>";
                _loadPaymentsByStatus('3', newpayDate);
            });
            </script>
            <tr>
                <td colspan="20">
                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<!-- ///// Cancel Page //// -->
<?php if ($page == 'cancelledPage') { ?>
<div id="revenueAlert" class="alert top-alert-div animated fadeIn">
    <div>
        <i class="bi-graph-up-arrow"></i>
        Cancelled Transactions On <span id="date"></span>
        <output style="display:none;">
            -- Total Revenue:
            <span class="balance" id="totalAmount"></span>
        </output>
    </div>

    <div class="btn-container">
        <button class="btn"><i class="bi-printer"></i> PRINT</button>
        <button class="btn"><i class="bi-file-earmark-excel"></i> EXPORT</button>
    </div>
</div>

<div class="table-div animated fadeIn">
    <table class="table" cellspacing="0" style="width:100%">
        <thead>
            <tr class="tb-col">
                <th>sn</th>
                <th>Student Info</th>
                <th>Parent Info</th>
                <th>Branch</th>
                <th>Session/Term</th>
                <th>Class</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>View</th>
            </tr>
        </thead>

        <tbody id="pageContent">
            <script>
            $(document).ready(function() {
                const newpayDate = "<?php echo $id; ?>";
                _loadPaymentsByStatus('4', newpayDate);
            });
            </script>
            <tr>
                <td colspan="20">
                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php } ?>

<?php if ($page == 'paymentBreakDownForm') { ?>
<section class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
    <div class="form-title-div">
        <div class="title-div">
            <div class="icon-div"><i class="bi bi-credit-card"></i></div>
            <h3>TRANSACTION DETAILS</h3>
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
            <p>This section provides a complete breakdown of your transaction, including payment status, amount paid,
                and transaction reference.</p>
        </div>

        <!--  ////////////////////////////////////////////////////////////////////////////////-->
        <div class="form-container">
            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-people"></i>
                            <p>Student Institution Details</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Student ID:</div>
                                        <div>
                                            <span id="userId">
                                                SID01320260702105153
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Institution Class:</div>
                                        <div>
                                            <span id="fullName">
                                                POLYTECHNIC/MONOTECHNIC
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Institution Name:</div>
                                        <div>
                                            <span id="emailAddress">
                                                GATEWAY ICT POLYTECHNIC
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                COMPUTER SCIENCE
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Student Level:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                ND 1
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Matric Number:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                18012211071
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-people"></i>
                            <p>Student Details</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Full Name:</div>
                                        <div>
                                            <span id="userId">
                                                PAUL EMMANUEL
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Email Address:</div>
                                        <div>
                                            <span id="fullName">
                                                paulemmanue40@gmail.com
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Phone Number:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                07050903886
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Registration Status:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                ACTIVE
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Registration Date:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                2026-07-02 10:52:03
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-people"></i>
                            <p>Training Details</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Program:</div>
                                        <div>
                                            <span id="userId">
                                                SIWES
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Course:</div>
                                        <div>
                                            <span id="fullName">
                                                BACKEND WEB DEVELOPMENT
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Training Duration:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                1 - 3 MONTHS
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Training Status:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                PENDING
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Training Start Date:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                Not Started
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Training End Date:</div>
                                        <div>
                                            <span id="phoneNumber">
                                                Not Started
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-credit-card"></i>
                            <p>Payment Details</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Payment Id:</div>
                                        <div><span id="paymentId">
                                                PAY01920260702105153
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Payment Purpose:</div>
                                        <div><span id="paymentMethodName">
                                                FORM FEE
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Payment Method:</div>
                                        <div><span id="paymentMethodName">
                                                CREDIT/DEBIT CARD
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Status:</div>
                                        <div><span id="statusName">
                                                SUCCESSFUL
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Date Initiated:</div>
                                        <div><span id="createdTime">
                                                2026-07-02 10:52:03
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Date Confirmed:</div>
                                        <div><span id="payDate">
                                                2026-07-02 10:52:03
                                            </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-credit-card"></i>
                            <p>Total</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Total Amount:</div>
                                        <div>
                                            <span class="total-amount"><s>N</s>200,000.00
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content">
                <div class="tables-content-div form-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-credit-card"></i>
                            <p>Paystack Details</p>
                        </div>
                    </div>

                    <div class="form-text">
                        <div class="alert alert-success form-alert">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Paystack ID:</div>
                                        <div><span id="paymentId">
                                                PAY01920260702105153
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Paystack Charges:</div>
                                        <div><span id="paymentId">
                                                N3.00
                                            </span></div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Paystack Remittance:</div>
                                        <div><span class="total-amount"><s>N</s>3.00
                                            </span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>


<?php if ($page == 'resendRecieptSelectForm') { ?>
<div class="caption-div animated zoomIn">
    <div class="title-div">
        <div class="title"><i class="bi-folder-symlink-fill"></i> RESEND PAYMENT RECIEPT</div>
        <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                class="bi-x-lg"></i></button>
    </div>

    <div class="div-in animated fadeIn">
        <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, You’re about to continue with this
            operation.
            Please provide the required <span>Name</span>, and <span>Email</span>, to proceed.
        </div>

        <div class="text_field_container" id="parentFullname_container">
            <script>
            textField({
                id: 'parentFullname',
                title: 'Reciever Name'
            });
            </script>
        </div>

        <div class="text_field_container" id="recieptParentEmail_container">
            <script>
            textField({
                id: 'recieptParentEmail',
                title: 'Reciever Email'
            });
            </script>
        </div>

        <button class="btn" id="proceedBtn" title="Resend Reciept" onclick="_resendPaymentReciept();">RESEND <i
                class="bi-reply-all"></i>
        </button>
    </div>
</div>
<?php } ?>