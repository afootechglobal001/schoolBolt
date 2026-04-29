<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchDailyRevenuePage') { ?>
    <div class="branch-account-wrapper">
        <div class="nav-content-back-div">
            <div class="nav-container branch-account-nav">
                <ul>
                    <li class="active border" title="Filter Revenue By Date Range" id="filterBranchByDate"
                        onclick="_getActiveBranchReportNav({divid:'filterBranchByDate', page: 'filterBranchByDate', url: adminPortalLocalUrl});">
                        <i class="bi-calendar2-check"></i> Date Range
                    </li>
                    <li title="Filter Revenue By Session/Term" id="filterBranchBySession"
                        onclick="_getActiveBranchReportNav({divid:'filterBranchBySession', page: 'filterBranchBySession', url: adminPortalLocalUrl});">
                        <i class="bi-filter"></i> Session/Term
                    </li>
                </ul>
            </div>

            <div id="getBranchReportNavPage">
                <script>
                    _getActiveBranchReportNav({
                        divid: 'filterBranchByDate',
                        page: 'filterBranchByDate',
                        url: adminPortalLocalUrl
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Filter By Date Revenue Pages -->
<?php if ($page == 'filterBranchByDate') { ?>
    <div class="chart-div-notifications report-chart-div branch-chat-div">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for </div>

        <div class="text text-right" onclick="select_search()">
            <span id="srch-text">Last 30 Days</span>
            <div class="icon-div"><i class="bi-caret-down"></i></div>

            <div class="srch-select alert-srch-select">
                <div id="srch-today" onclick="_fetchBranchRevenueReportFiltering('srch-today', 'Today');">Today
                </div>
                <div id="srch-week" onclick="_fetchBranchRevenueReportFiltering('srch-week', 'This Week');">This
                    Week</div>
                <div id="srch-7" onclick="_fetchBranchRevenueReportFiltering('srch-7', 'Last 7 Days');">Last 7 Days
                </div>
                <div id="srch-month" onclick="_fetchBranchRevenueReportFiltering('srch-month', 'This Month');">This
                    Month</div>
                <div id="srch-30" onclick="_fetchBranchRevenueReportFiltering('srch-30', 'Last 30 Days');">Last 30 Days
                </div>
                <div id="srch-90" onclick="_fetchBranchRevenueReportFiltering('srch-90', 'Last 90 Days');">Last 90 Days
                </div>
                <div id="srch-year" onclick="_fetchBranchRevenueReportFiltering('srch-year', 'This Year');">This
                    Year</div>
                <div id="srch-1year" onclick="_fetchBranchRevenueReportFiltering('srch-1year', 'Last 1 Year');">Last 1
                    Year</div>
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
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
                        onclick="_fetchCustomBranchRevenueReportFiltering();">Apply</button>
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
                <i class="bi-info-circle"></i> Revenue report between <span id="dateFrom"> March 17 2026</span> and <span
                    id="dateTo">April 15 2026</span>
            </div>

            <div class="div">
                Total Revenue: <span class="balance" id="totalRevenue">N347,000.00</span>
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
                                                label: "MANUAL PAYMENT",
                                                y: 300000.00
                                            },
                                            {
                                                label: "CREDIT CARD",
                                                y: 43000.00
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
            _fetchBranchRevenueReportFiltering('srch-30', 'Last 30 Days');
        });
        sessionStorage.removeItem("branchSessionTermData");
    </script>
<?php } ?>

<!-- Filter By Session Revenue Pages -->
<?php if ($page == 'filterBranchBySession') { ?>
    <div class="report-select-back-div">
        <div>Select session and term to filter Revenue</div>
        <div class="div-in">
            <div class="select-field-back-div">
                <div class="text_field_container select_field_container" id="branchAccountSession_container">
                    <script>
                        selectField({
                            id: 'branchAccountSession',
                            title: 'Select Session'
                        });
                        _getSelectAccountSession('branchAccountSession');
                    </script>
                </div>

                <div class="text_field_container select_field_container" id="branchAccountTermId_container">
                    <script>
                        selectField({
                            id: 'branchAccountTermId',
                            title: 'Select Term'
                        });
                        _getSelectTermId('branchAccountTermId');
                    </script>
                </div>
            </div>

            <button type="button" class="btn" id="filterBrnachRevenueBtn"
                onclick="_fetchBranchRevenueBySessionAndTerm();">Filter</button>
        </div>
    </div>

    <div class="fetch-report-back-div">
        <div class="alert alert-success top-alert-div report-alert">
            <div class="div" id="reportTitleContainer"></div>
            <div class="div" id="reportBalanceContainer"></div>
        </div>

        <div class="branch-revenue-table-wrapper">
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

                    <tbody id="branchSessionTermContent">
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
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchRevenueBreakdown') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-graph-up-arrow"></i> BRANCH REVENUE BREAKDOWN</span>
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
                                        <li class="active-li" title="Successful Status" id="branchSuccessfulPage" onclick="_getBranchPaymentStatusNav({divid:'branchSuccessfulPage', page: 'branchSuccessfulPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/tick-mark.png" alt="Successful Icon" /> SUCCESSFUL</li>
                                        <li title="Pending Status" id="branchPendingPage" onclick="_getBranchPaymentStatusNav({divid:'branchPendingPage', page: 'branchPendingPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/load.png" alt="Pending Icon" /> PENDING</li>
                                        <li title="Cancel Status" id="branchCancelledPage" onclick="_getBranchPaymentStatusNav({divid:'branchCancelledPage', page: 'branchCancelledPage', id: '<?php echo $id; ?>', url: adminPortalLocalUrl});"><img src="<?php echo $websiteUrl ?>/images/close.png" alt="Cancelled Icon" /></i> CANCELLED</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="content-container" id="getBranchPaymentNav">
                            <script>
                                _getBranchPaymentStatusNav({
                                    divid: 'branchSuccessfulPage',
                                    page: 'branchSuccessfulPage',
                                    id: '<?php echo $id; ?>',
                                    url: adminPortalLocalUrl
                                });
                                sessionStorage.setItem("branchSessionPayDate", '<?php echo $id; ?>');
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ///// Success Page //// -->
<?php if ($page == 'branchSuccessfulPage') { ?>
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
            <button class="btn" title="EXPORT RECORDS" onclick="exportAccountTableToExcel('branchPageContentTable','Revenue_Breakdown_By_Date_List');">
                <i class="bi-file-earmark-excel"></i> EXPORT
            </button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="branchPageContentTable">
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

            <tbody id="branchPageContent">
                <script>
                    $(document).ready(function() {
                        const newpayDate = "<?php echo $id; ?>";
                        _loadBranchPaymentsByStatus('5', newpayDate);
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
<?php if ($page == 'branchPendingPage') { ?>
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
            <button class="btn" title="EXPORT RECORDS" onclick="exportAccountTableToExcel('branchPendingPageContentTable','Revenue_Breakdown_By_Date_List');">
                <i class="bi-file-earmark-excel"></i> EXPORT
            </button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="branchPendingPageContentTable">
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

            <tbody id="branchPageContent">
                <script>
                    $(document).ready(function() {
                        const newpayDate = "<?php echo $id; ?>";
                        _loadBranchPaymentsByStatus('3', newpayDate);
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
<?php if ($page == 'branchCancelledPage') { ?>
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
            <button class="btn" title="EXPORT RECORDS" onclick="exportAccountTableToExcel('branchCancelledPageContentTable','Revenue_Breakdown_By_Date_List');">
                <i class="bi-file-earmark-excel"></i> EXPORT
            </button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="branchCancelledPageContentTable">
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

            <tbody id="branchPageContent">
                <script>
                    $(document).ready(function() {
                        const newpayDate = "<?php echo $id; ?>";
                        _loadBranchPaymentsByStatus('4', newpayDate);
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

<?php if ($page == 'branchPaymentBreakDownForm') { ?>
    <script>
        getBranchRevenueBreakdownSessionData = JSON.parse(sessionStorage.getItem("getBranchRevenueBreakdownSessionData"));
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
                                                $("#branchName").html(getBranchRevenueBreakdownSessionData?.branchData?.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Branch Mobile Number:</div>
                                    <div><span id="mobileNumber">
                                            <script>
                                                $("#mobileNumber").html(getBranchRevenueBreakdownSessionData?.branchData?.mobileNumber);
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
                                                $("#fullName").html(capitalizeFirstLetterOfEachWord(getBranchRevenueBreakdownSessionData?.parentData?.titleId + ' ' + getBranchRevenueBreakdownSessionData?.parentData?.surName + ' ' + getBranchRevenueBreakdownSessionData?.parentData?.otherNames));
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Email:</div>
                                    <div><span id="parentEmail">
                                            <script>
                                                $("#parentEmail").html(getBranchRevenueBreakdownSessionData?.parentData?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Relationship:</div>
                                    <div><span id="relationship">
                                            <script>
                                                $("#relationship").html(getBranchRevenueBreakdownSessionData?.parentData?.relationship);
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
                                                $("#studentFullName").html(capitalizeFirstLetterOfEachWord(getBranchRevenueBreakdownSessionData?.studentData?.surName + ' ' + getBranchRevenueBreakdownSessionData?.studentData?.firstName + ' ' + getBranchRevenueBreakdownSessionData?.studentData?.otherNames));
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Id:</div>
                                    <div><span id="studentId">
                                            <script>
                                                $("#studentId").html(getBranchRevenueBreakdownSessionData?.studentData?.studentId);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="sessionName">
                                            <script>
                                                $("#sessionName").html(getBranchRevenueBreakdownSessionData?.session);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="studentTermName">
                                            <script>
                                                $("#studentTermName").html(getBranchRevenueBreakdownSessionData?.termData?.termName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="departmentName">
                                            <script>
                                                $("#departmentName").html(getBranchRevenueBreakdownSessionData?.departmentData?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="className">
                                            <script>
                                                $("#className").html(getBranchRevenueBreakdownSessionData?.classData?.className + ' ' + getBranchRevenueBreakdownSessionData?.armData?.armName);
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
                                                $("#paymentId").html(getBranchRevenueBreakdownSessionData?.paymentId);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Payment Method:</div>
                                    <div><span id="paymentMethodName">
                                            <script>
                                                $("#paymentMethodName").html(getBranchRevenueBreakdownSessionData?.paymentMethodData?.paymentMethodName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Status:</div>
                                    <div><span id="branchReportStatusName">
                                            <script>
                                                $("#branchReportStatusName").html(getBranchRevenueBreakdownSessionData?.statusData?.statusName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Date Initiated:</div>
                                    <div><span id="createdTime">
                                            <script>
                                                $("#createdTime").html(getBranchRevenueBreakdownSessionData?.createdTime);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Date Confirmed:</div>
                                    <div><span id="payDate">
                                            <script>
                                                $("#payDate").html(getBranchRevenueBreakdownSessionData?.payDate);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        const paymentComputedBy = getBranchRevenueBreakdownSessionData?.paymentComputedBy;

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
                                                $("#formTotalAmount").html('<s>N</s>' + thousandSeperator(getBranchRevenueBreakdownSessionData?.totalFeesPaid));
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

                        if (getBranchRevenueBreakdownSessionData && getBranchRevenueBreakdownSessionData?.paymentBreakdownData) {
                            const fetch = getBranchRevenueBreakdownSessionData?.paymentBreakdownData;

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
                        const paystackCharges = getBranchRevenueBreakdownSessionData?.paystackCharges;

                        let content = "";
                        if (paystackCharges > 0) {
                            content += `
                                <div class="alert alert-success form-alert">
                                <span>Paystack Details:</span>
                                <div class="alert-list-div">
                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack ID:</div>
                                            <div><span>${getBranchRevenueBreakdownSessionData?.paystackId}</span></div>
                                        </div>
                                    </div>

                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack Charges:</div>
                                            <div><span><s>N</s>${getBranchRevenueBreakdownSessionData?.paystackCharges}</span></div>
                                        </div>
                                    </div>

                                    <div class="alert-list-back-div">
                                        <div class="alert-list">
                                            <div>Paystack Remittance:</div>
                                            <div><span class="total-amount"><s>N</s>${getBranchRevenueBreakdownSessionData?.paystackRemittance}</span></div>
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