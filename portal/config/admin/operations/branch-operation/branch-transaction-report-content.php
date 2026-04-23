<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchTransactionReportPage') { ?>
    <div class="branch-account-wrapper">
        <div class="nav-content-back-div">
            <div class="nav-container branch-account-nav">
                <ul>
                    <li class="active border" title="Filter Transaction By Date Range" id="filterBranchTransactionByDate"
                        onclick="_getActiveBranchTransactionReportNav({divid:'filterBranchTransactionByDate', page: 'filterBranchTransactionByDate', url: adminPortalLocalUrl});">
                        <i class="bi-calendar2-check"></i> Date Range
                    </li>
                    <li title="Filter Transaction By Session/Term" id="filterBranchTransactionBySession"
                        onclick="_getActiveBranchTransactionReportNav({divid:'filterBranchTransactionBySession', page: 'filterBranchTransactionBySession', url: adminPortalLocalUrl});">
                        <i class="bi-filter"></i> Session/Term
                    </li>
                </ul>
            </div>

            <div id="getBranchTransactionReportNavPage">
                <script>
                    _getActiveBranchTransactionReportNav({
                        divid: 'filterBranchTransactionByDate',
                        page: 'filterBranchTransactionByDate',
                        url: adminPortalLocalUrl
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Filter By Date Transaction Pages -->
<?php if ($page == 'filterBranchTransactionByDate') { ?>
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
                <i class="bi-info-circle"></i> Transaction report between <span id="dateFrom"> March 17 2026</span> and <span
                    id="dateTo">April 15 2026</span>
            </div>

            <div class="div">
                Total Transactions: <span class="balance" id="totalRevenue">N347,000.00</span>
            </div>
        </div>

        <div class="report-dashbaord-wrapper animated fadeIn">
            <div class="dashboard-statistics-wrapper">
                <div class="left-dashbaord-container left-report-dashbaord-container">
                    <div class="statistics-chart-back-div">
                        <div class="table-div animated fadeIn">
                            <table class="table" cellspacing="0" style="width:100%">
                                <thead>
                                    <tr class="tb-col">
                                        <th>sn</th>
                                        <th>Date</th>
                                        <th>Total Amount(<s>N</s>)</th>
                                        <th>View Details</th>
                                    </tr>
                                </thead>

                                <tbody id="pageContent">
                                    <!-- CONTENT GOES HERE -->
                                    <tr class="tb-row">
                                        <td>1</td>
                                        <td class="clickable-td" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', layer:2, url: adminPortalLocalUrl});">2026-04-22</td>
                                        <td><s>N</s>200,000.00</td>
                                        <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_getForm({ page: 'branchTransactionRecordBreakdown', layer:2, url: adminPortalLocalUrl});">VIEW DETAILS</button></td>
                                    </tr>

                                    <!-- <tr>
                                        <td colspan="20">
                                            <div class="content-loading-div">
                                                <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                                            </div>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="right-dashbaord-container">
                    <div class="matrix-div">
                        <div class="inner-div">
                            <div class="title">
                                <h3>Bank Transaction Matrix</h3>
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
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Filter By Session Transaction Pages -->
<?php if ($page == 'filterBranchTransactionBySession') { ?>
    <div class="report-select-back-div">
        <div>Select session and term to filter Transactions</div>
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

                        <!-- <tr>
                            <td colspan="20">
                                <div class="false-notification-div">
                                    <p>Select session And term to filter revenue</p>
                                </div>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchTransactionRecordBreakdown') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-graph-up-arrow"></i> BRANCH BANK TRANSACTION BREAKDOWN</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">

                    <div class="content-wrapper animated fadeIn">
                        <div class="content-container" id="getBranchPaymentNav">
                            <div id="revenueAlert" class="alert top-alert-div animated fadeIn">
                                <div>
                                    <i class="bi-graph-up-arrow"></i>
                                    Transactions On <span id="date"></span>
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

                                    <tbody id="branchPageContent">
                                        <!-- <script>
                                            $(document).ready(function() {
                                                const newpayDate = "<?php echo $id; ?>";
                                                _loadBranchPaymentsByStatus('5', newpayDate);
                                            });
                                        </script> -->
                                        <!-- <tr>
                                            <td colspan="20">
                                                <div class="content-loading-div">
                                                    <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                                                </div>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchTransactionRecorsBreakDownForm') { ?>
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
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        const paymentComputedBy = getBranchRevenueBreakdownSessionData?.paymentComputedBy;

                        let content = "";
                        if (paymentComputedBy) {
                            content += `
                                <div class="alert alert-success form-alert">
                                <span>Manual Payment Processed By:</span>
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

                <div>
                    <button class="btn" title="PRINT RECEIPT" id="submitBtn" onclick=""> <i class="bi-check"></i> PRINT RECEIPT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>