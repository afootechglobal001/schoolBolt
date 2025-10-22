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
                            <div class="content-loading-div">
                                <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            _fetchReportRevenueFiltering('srch-30', 'Last 30 Days');
        });
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
    <script>
        getRevenueByDateSessionData = JSON.parse(sessionStorage.getItem("getRevenueByDateSessionData"));
    </script>

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
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div><i class="bi-graph-up-arrow"></i> Revenue For <span id="date">
                                <script>
                                    $("#date").html(getRevenueByDateSessionData?.date);
                                </script>
                            </span> -- Total Revenue: <span class="balance" id="totalAmount">
                                <script>
                                    $("#totalAmount").html("<s>N</s>" + thousandSeperator(getRevenueByDateSessionData?.totalAmount));
                                </script>
                            </span></div>

                        <div class="btn-container">
                            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
                            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i>
                                EXPORT</button>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                            <script>
                                $(document).ready(function() {
                                    const getRevenueByDateSessionData = JSON.parse(sessionStorage.getItem("getRevenueByDateSessionData"));
                                    let text = '';
                                    let no = 0;
                                    text = `
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
                                        </thead>`;

                                    if (getRevenueByDateSessionData && getRevenueByDateSessionData.success === true) {
                                        const fetchedData = getRevenueByDateSessionData?.data;

                                        for (let i = 0; i < fetchedData.length; i++) {
                                            no++;
                                            const fetchStudentData = fetchedData[i].studentData;
                                            const fetchParentData = fetchedData[i].parentData;
                                            const fetchBranchData = fetchedData[i].branchData;
                                            const fetchTermData = fetchedData[i].termData;
                                            const fetchClassData = fetchedData[i].classData;
                                            const fetchArmData = fetchedData[i].armData;
                                            const totalFeesPaid = fetchedData[i].totalFeesPaid;
                                            const fetchedStatusData = fetchedData[i].statusData;
                                            const payDate = fetchedData[i].payDate;
                                            const session = fetchedData[i].session;
                                            const departmentId = fetchedData[i].departmentId;
                                            const paymentId = fetchedData[i].paymentId;

                                            //// Student Data///
                                            const studentId = fetchStudentData.studentId;
                                            const passport = fetchStudentData.passport || 'default.jpg';
                                            const surName = fetchStudentData.surName;
                                            const firstName = fetchStudentData.firstName;
                                            const otherNames = fetchStudentData.otherNames;
                                            const fullname = surName + ' ' + firstName + ' ' + otherNames;

                                            //// Parent Data///
                                            const titleId = fetchParentData.titleId;
                                            const parentSurName = fetchParentData.surName;
                                            const parentOtherNames = fetchParentData.otherNames;
                                            const parentFullname = titleId + ' ' + parentSurName + ' ' + parentOtherNames;
                                            const parentEmail = fetchParentData.email;
                                            const recordFor = fetchParentData.recordFor;
                                            const parentPhone = fetchParentData.mobileNumber;

                                            //// Branch Data///
                                            const branchName = fetchBranchData.branchName;
                                            const branchMobile = fetchBranchData.mobileNumber;
                                            const branchId = fetchBranchData.branchId;

                                            /// term Data ///
                                            const termName = fetchTermData.termName;

                                            /// Class Data ///
                                            const className = fetchClassData.className;
                                            const classId = fetchClassData.classId;

                                            /// Arm Data ///
                                            const armId = fetchArmData.armId;
                                            const armName = fetchArmData.armName;

                                            /// Status Data ///
                                            const statusName = fetchedStatusData.statusName;

                                            text += `
                                            <tbody>
                                                <tr class="tb-row">
                                                    <td>${no}</td>
                                                    <td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
                                                        <div class="text-back-div">
                                                            <div class="image-div general-passport">
                                                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                                            </div>

                                                            <div class="text-div">
                                                                <div class="first-class">${fullname}</div>
                                                                <div class="second-class">${studentId}</div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class="clickable-td" title="Click to view father details" onclick="_loginOnbehalfOfParent('${parentEmail}','${recordFor}','${studentId}');">
                                                        <div class="text-back-div">
                                                            <div class="text-div">
                                                                <div class="first-class">${parentFullname}</div>
                                                                <div class="second-class">${parentEmail}</div>
                                                                <div class="second-class">${parentPhone}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="clickable-td" title="Click to view branch profile" onclick="_fetchEachBranches('${branchId}');">${branchName}<br /><span>${branchMobile}</span></td>
                                                    <td>${session} - ${termName}</td>
                                                    <td>${className} ${armName}</td>
                                                    <td><s>N</s>${thousandSeperator(totalFeesPaid)}</td>
                                                    <td>
                                                        <div class="status-div ${statusName}">${statusName}</div>
                                                    </td>
                                                    <td>${payDate}</td>
                                                    <td><button class="btn view-btn" title="Click to view payment breakdown" onclick="_fetchRevenueById('${paymentId}');">VIEW DETAILS</button></td>
                                                </tr>
                                            </tbody>`;
                                        }
                                        $('#pageContent').html(text);
                                    }
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                        </div>
                    </div>
                </div>

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

                <div>
                    <button class="btn" title="PRINT RECEIPT" id="submitBtn" onclick=""> <i class="bi-check"></i> PRINT RECEIPT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>