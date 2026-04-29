<?php if ($page == 'incomeReport') { ?>
    <div class="page-title-back-div other-pages-title-back-div adjusted-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-graph-up-arrow"></i> <strong>Income/Revenue</strong></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')"
                        placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search report...</div>
                </div>
            </div>
        </div>
    </div>

    <div class="pages-back-div revenue-other-pg-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="nav-content-back-div">
            <div class="nav-container">
                <ul>
                    <li class="active border" title="Filter Revenue By Date Range" id="filterByDate" onclick="_getActiveReportNav({divid:'filterByDate', page: 'filterByDate', url: adminPortalLocalUrl});"><i class="bi-calendar2-check"></i> Date Range</li>
                    <li title="Filter Revenue By Session/Term" id="filterBySession" onclick="_getActiveReportNav({divid:'filterBySession', page: 'filterBySession', url: adminPortalLocalUrl});"><i class="bi-filter"></i> Session/Term</li>
                </ul>
            </div>

            <div id="getNavPage">
                <script>
                    _getActiveReportNav({
                        divid: 'filterByDate',
                        page: 'filterByDate',
                        url: adminPortalLocalUrl
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Filter By Date Revenue Pages -->
<?php if ($page == 'filterByDate') { ?>
    <div class="chart-div-notifications report-chart-div">
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
                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-to"
                            placeholder="" />
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

    <div class="fetch-report-back-div">
        <div class="alert alert-success top-alert-div report-alert">
            <div class="div">
                <i class="bi-info-circle"></i> Revenue report between <span id="dateFrom">Loading...</span> and <span id="dateTo">Loading...</span>
            </div>

            <div class="div">
                Total Revenue: <span class="balance" id="totalRevenue">Loading...</span>
            </div>
        </div>

        <div class="report-dashbaord-wrapper animated fadeIn">
            <div class="dashboard-statistics-wrapper">
                <div class="left-dashbaord-container left-report-dashbaord-container">
                    <div class="statistics-chart-back-div">
                        <div class="new-statistics-back-div">
                            <div class="new-statistics-div" id="branch" title="Credit Card">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Credit Card Revenue</p>
                                        <span>Total Amount Paid via Credit Card</span>
                                        <h2 id="sumCreditCardPayments">0</h2>
                                    </div>

                                </div>
                            </div>

                            <div class="new-statistics-div" title="Bank Transfer Revenue">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Bank Transfer Revenue</p>
                                        <span>Total Amount Paid via Bank Transfer</span>
                                        <h2 id="sumBankTransferPayments">0</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="new-statistics-div" title="Manual Payment Revenue">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Manual Payment Revenue</p>
                                        <span>Total Amount Paid via Manual Payment</span>
                                        <h2 id="sumManualPayments">0.00</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="new-statistics-div" title="Number of Card Payments">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Credit Card Transactions</p>
                                        <span>Number of Card Payments</span>
                                        <h2 id="countCreditCardPayments">0</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="new-statistics-div" title="Bank Transfer Transactions">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Bank Transfer Transactions</p>
                                        <span>Number of Bank Transfer Payments</span>
                                        <h2 id="countBankTransferPayments">0</h2>
                                    </div>
                                </div>
                            </div>

                            <div class="new-statistics-div" title="Manual Payment Transactions">
                                <div class="statistics-inner-div">
                                    <div class="statistics-text report-statistics-text">
                                        <p>Manual Payment Transactions</p>
                                        <span>Number of Manual Payments</span>
                                        <h2 id="countManualPayments">0</h2>
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

                                <tbody id="pageContent">
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
                        </div>
                    </div>
                </div>

                <div class="right-dashbaord-container">
                    <div class="matrix-div">
                        <div class="inner-div">
                            <div class="title">
                                <h3>Revenue Matrix</h3>
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
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            _fetchReportRevenueFiltering('srch-30', 'Last 30 Days');
        });
        sessionStorage.removeItem("sessionTermData");
    </script>
<?php } ?>

<!-- Filter By Session Revenue Pages -->
<?php if ($page == 'filterBySession') { ?>
    <div class="report-select-back-div">
        <div>Select session and term to filter Revenue</div>
        <div class="div-in">
            <div class="select-field-back-div">
                <div class="text_field_container select_field_container" id="session_container">
                    <script>
                        selectField({
                            id: 'session',
                            title: 'Select Session'
                        });
                        _getSelectAccountSession('session');
                    </script>
                </div>

                <div class="text_field_container select_field_container" id="termId_container">
                    <script>
                        selectField({
                            id: 'termId',
                            title: 'Select Term'
                        });
                        _getSelectTermId('termId');
                    </script>
                </div>
            </div>

            <button type="button" class="btn" id="filterRevenueBtn"
                onclick="_fetchRevenueBySessionAndTerm();">Filter</button>
        </div>
    </div>

    <div class="fetch-report-back-div">
        <div class="alert alert-success top-alert-div report-alert">
            <div class="div" id="reportTitleContainer"></div>
            <div class="div" id="reportBalanceContainer"></div>
        </div>

        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%">
                <thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>View</th>
                    </tr>
                </thead>

                <tbody id="pageContent">
                    <!-- CONTENT GOES HERE -->

                    <tr>
                        <td colspan="20">
                            <div class="false-notification-div">
                                <p>Select session And term to filter revenue</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'revenueBreakdown') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-graph-up-arrow"></i> REVENUE BREAKDOWN</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">

                    <div class="content-wrapper animated fadeIn">
                        <div class="header-div">
                            <div class="title-nav-back-div">
                                <div class="nav-ul-div">
                                    <ul>
                                        <li class="active-li" title="Successful Status" id="successfulPage" onclick="_getPaymentStatusNav({divid:'successfulPage', page: 'successfulPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/tick-mark.png" alt="Successful Icon" /> SUCCESSFUL</li>
                                        <li title="Pending Status" id="pendingPage" onclick="_getPaymentStatusNav({divid:'pendingPage', page: 'pendingPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/load.png" alt="Pending Icon" /> PENDING</li>
                                        <li title="Cancel Status" id="cancelledPage" onclick="_getPaymentStatusNav({divid:'cancelledPage', page: 'cancelledPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/close.png" alt="Cancelled Icon" /></i> CANCELLED</li>
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
                                    url: adminPortalLocalUrl
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
    <div id="revenueAlert" class="alert top-alert-div animated fadeIn">
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
                        _loadPaymentsByStatus('5', newpayDate);
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
    <script>
        getRevenueBreakdownSessionData = JSON.parse(sessionStorage.getItem("getRevenueBreakdownSessionData"));
    </script>

    <div class="slide-form-div save-compute-slide-form" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> REVENUE BREAKDOWN</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Branch Details:</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Branch Name:</div>
                                    <div><span id="branchName">
                                            <script>
                                                $("#branchName").html(getRevenueBreakdownSessionData?.branchData?.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Branch Mobile Number:</div>
                                    <div><span id="mobileNumber">
                                            <script>
                                                $("#mobileNumber").html(getRevenueBreakdownSessionData?.branchData?.mobileNumber);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Parent Details:</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Full Name:</div>
                                    <div><span id="fullName">
                                            <script>
                                                $("#fullName").html(capitalizeFirstLetterOfEachWord(getRevenueBreakdownSessionData?.parentData?.titleId + ' ' + getRevenueBreakdownSessionData?.parentData?.surName + ' ' + getRevenueBreakdownSessionData?.parentData?.otherNames));
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Email:</div>
                                    <div><span id="parentEmail">
                                            <script>
                                                $("#parentEmail").html(getRevenueBreakdownSessionData?.parentData?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Relationship:</div>
                                    <div><span id="relationship">
                                            <script>
                                                $("#relationship").html(getRevenueBreakdownSessionData?.parentData?.relationship);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Student Details:</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Full Name:</div>
                                    <div><span id="studentFullName">
                                            <script>
                                                $("#studentFullName").html(capitalizeFirstLetterOfEachWord(getRevenueBreakdownSessionData?.studentData?.surName + ' ' + getRevenueBreakdownSessionData?.studentData?.firstName + ' ' + getRevenueBreakdownSessionData?.studentData?.otherNames));
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Id:</div>
                                    <div><span id="studentId">
                                            <script>
                                                $("#studentId").html(getRevenueBreakdownSessionData?.studentData?.studentId);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="sessionName">
                                            <script>
                                                $("#sessionName").html(getRevenueBreakdownSessionData?.session);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="studentTermName">
                                            <script>
                                                $("#studentTermName").html(getRevenueBreakdownSessionData?.termData?.termName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="departmentName">
                                            <script>
                                                $("#departmentName").html(getRevenueBreakdownSessionData?.departmentData?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="className">
                                            <script>
                                                $("#className").html(getRevenueBreakdownSessionData?.classData?.className + ' ' + getRevenueBreakdownSessionData?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Payment Details:</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Payment Id:</div>
                                    <div><span id="paymentId">
                                            <script>
                                                $("#paymentId").html(getRevenueBreakdownSessionData?.paymentId);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Payment Method:</div>
                                    <div><span id="paymentMethodName">
                                            <script>
                                                $("#paymentMethodName").html(getRevenueBreakdownSessionData?.paymentMethodData?.paymentMethodName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Status:</div>
                                    <div><span id="statusName">
                                            <script>
                                                $("#statusName").html(getRevenueBreakdownSessionData?.statusData?.statusName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Date Initiated:</div>
                                    <div><span id="createdTime">
                                            <script>
                                                $("#createdTime").html(getRevenueBreakdownSessionData?.createdTime);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Date Confirmed:</div>
                                    <div><span id="payDate">
                                            <script>
                                                $("#payDate").html(getRevenueBreakdownSessionData?.payDate);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        const paymentComputedBy = getRevenueBreakdownSessionData?.paymentComputedBy;

                        let content = "";
                        if (paymentComputedBy) {
                            content += `
                                <div class="alert alert-success form-alert">
                                <span>Payment Confirmed By:</span>
                                <div class="alert-list-div">
                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Staff Id:</div>
                                            <div><span>${paymentComputedBy?.staffId}</span></div>
                                        </div>
                                    </div>

                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Staff FullName:</div>
                                            <div><span>${paymentComputedBy?.fullName}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $('#showPaymentComputedBy').html(content);
                    });
                </script>

                <div id="showPaymentComputedBy"></div>

                <div class="paid-fee-conatiner">
                    <div class="alert alert-success form-alert">
                        <span>Breakdown of Fees Paid</span>

                        <div class="alert-list-div" id="paidFees">
                            No record found!
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Total Amount</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>TOTAL AMOUNT:</div>
                                    <div><span class="total-amount" id="formTotalAmount"><s>N</s>
                                            <script>
                                                $("#formTotalAmount").html('<s>N</s>' + thousandSeperator(getRevenueBreakdownSessionData?.totalFeesPaid));
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let paidFees = '';

                        if (getRevenueBreakdownSessionData && getRevenueBreakdownSessionData?.paymentBreakdownData) {
                            const fetch = getRevenueBreakdownSessionData?.paymentBreakdownData;

                            for (let i = 0; i < fetch.length; i++) {
                                const fetchedFess = fetch[i];
                                const feesName = fetchedFess.feesName;
                                const amount = thousandSeperator(fetchedFess.amount);

                                paidFees += `
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>${feesName}:</div>
                                        <div><span><s>N</s>${amount}</span></div>
                                    </div>
                                </div>`;
                            }
                            $("#paidFees").html(paidFees !== '' ? paidFees : 'No record found!');
                        }
                    });
                </script>

                <script>
                    $(document).ready(function () {
                        const paystackCharges = getRevenueBreakdownSessionData?.paystackCharges;

                        let content = "";
                        if (paystackCharges > 0) {
                            content += `
                                <div class="alert alert-success form-alert">
                                <span>Paystack Details:</span>
                                <div class="alert-list-div">
                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack ID:</div>
                                            <div><span>${getRevenueBreakdownSessionData?.paystackId}</span></div>
                                        </div>
                                    </div>

                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack Charges:</div>
                                            <div><span><s>N</s>${getRevenueBreakdownSessionData?.paystackCharges}</span></div>
                                        </div>
                                    </div>

                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack Remittance:</div>
                                            <div><span class="total-amount"><s>N</s>${getRevenueBreakdownSessionData?.paystackRemittance}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                        $('#showPaystackDetails').html(content);
                    });
                </script>

                <div id="showPaystackDetails"></div>

                <div>
                    <button class="btn" title="PRINT RECEIPT" id="submitBtn" onclick=""> <i class="bi-check"></i> PRINT RECEIPT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>