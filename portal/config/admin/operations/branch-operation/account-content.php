<!-- fetch student select form -->
<?php if ($page == 'fetch_parent_form') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> VIEW PARENT</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to view parents by
                student <span>Department</span>, <span>Class</span>, and <span>Arm</span>. Please select the
                <span>Department</span>, <span>Class</span>, and <span>Arm</span> to proceed.
            </div>

            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                    _getSelectDepartment('departmentId');
                </script>
            </div>

            <div class="text_field_container" id="classId_container">
                <script>
                    selectField({
                        id: 'classId',
                        title: 'Select Class'
                    });
                </script>
            </div>

            <div class="text_field_container" id="armId_container">
                <script>
                    selectField({
                        id: 'armId',
                        title: 'Select Arm'
                    });
                </script>
            </div>

            <button class="btn" id="submit_btn" title="Proceed Request" onclick="_proceedFetchBranchParents();">PROCEED <i
                    class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<!-- ///////////////// Parent Page/////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branch_parent_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn" id="pageTitleDiv"></div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Student Info</th>
                    <th>Father Info</th>
                    <th>Mother Info</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Arm</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="pageContent">
                <!-- CONTENT GOES HERE -->
                <script>
                    _fetchBranchParents();
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

<?php if ($page == 'parentStudentForm') { ?>
    <script>
        studentParentSessionData = JSON.parse(sessionStorage.getItem("studentParentSessionData"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> STUDENT & PARENT MANAGEMENT</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Parent Details;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Full Name:</div>
                                    <div><span id="parentFullName">
                                            <script>
                                                $("#parentFullName").html(studentParentSessionData?.parent?.titleId +
                                                    ' ' + studentParentSessionData?.parent?.surName + ' ' +
                                                    studentParentSessionData?.parent?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Email:</div>
                                    <div><span id="parentEmail">
                                            <script>
                                                $("#parentEmail").html(studentParentSessionData?.parent?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Mobile Number:</div>
                                    <div><span id="parentMobileNumber">
                                            <script>
                                                $("#parentMobileNumber").html(studentParentSessionData?.parent?.mobileNumber);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Relationship:</div>
                                    <div><span id="parentRelationship">
                                            <script>
                                                $("#parentRelationship").html(studentParentSessionData?.parent?.recordFor);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Student Details;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Full Name:</div>
                                    <div><span id="studentFullName">
                                            <script>
                                                $("#studentFullName").html(studentParentSessionData?.student?.studentData
                                                    ?.surName +
                                                    ' ' + studentParentSessionData?.student?.studentData?.firstName + ' ' +
                                                    studentParentSessionData?.student?.studentData?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="formDepartmentName">
                                            <script>
                                                $("#formDepartmentName").html(studentParentSessionData?.student?.departmentData
                                                    ?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="formClassName">
                                            <script>
                                                $("#formClassName").html(studentParentSessionData?.student?.classData
                                                    ?.className);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Arm:</div>
                                    <div><span id="formArmName">
                                            <script>
                                                $("#formArmName").html(studentParentSessionData?.student?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="new-btn-container"></div>
                <script>
                    $(document).ready(function () {
                        let showButton = '';
                        const statusId = studentParentSessionData?.parent?.statusId;

                        if (statusId === "1") {
                            showButton += `
                                <button class="btn suspend" title="SUSPEND PARENT" id="activateAndSuspend" onclick="_suspendActivateParentAccount();">
                                    <i class="bi-person-dash"></i> SUSPEND PARENT
                                </button>
                            `;
                        } else if (statusId === "2") {
                            showButton += `
                                <button class="btn activate" title="ACTIVATE PARENT" id="activateAndSuspend" onclick="_suspendActivateParentAccount();">
                                    <i class="bi-person-check"></i> ACTIVATE PARENT
                                </button>
                            `;
                        }
                        showButton += `
                                <button class="btn portal" title="GO TO PARENT PORTAL" onclick='window.open(parentPortalUrl, "_blank")'>
                                    <i class="bi-box-arrow-up-right"></i> GO TO PARENT PORTAL
                                </button>
                                `;
                        $(".new-btn-container").html(showButton);
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ///////////////// Account Session and term Select Form /////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'accountSessionSelectForm') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <?php if ($id == "payment") {
                $pageTitle = "STUDENT PAYMENT";
            } else if ($id == "debtors") {
                $pageTitle = "VIEW DEPTORS";
            } else if ($id == "activateResult") {
                $pageTitle = "ACTIVATE ACADEMIC RESULT";
            }
            ?>

            <div class="title"><i class="bi-table"></i> <?php echo $pageTitle; ?></div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, You’re about to continue with this
                operation.
                Please choose the required <span>Session</span>, and <span>Term</span>, to proceed.
            </div>

            <div class="text_field_container" id="sessionId_container">
                <script>
                    selectField({
                        id: 'sessionId',
                        title: 'Select Session'
                    });
                    _getSelectBranchAccountSession('sessionId');
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

            <?php if ($id == "activateResult") { ?>
                <button class="btn" id="proceedActivateResultBtn" title="Proceed Request"
                    onclick="_proceedActivateResult('<?php echo $id ?>');">PROCEED <i class="bi-arrow-right"></i> </button>
            <?php } else { ?>
                <button class="btn" id="proceedBtn" title="Proceed Request"
                    onclick="_proceedFetchAcountDepartmentClass('<?php echo $id ?>');">PROCEED <i class="bi-arrow-right"></i>
                </button>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<!-- ///////////////// Branch Department Class/////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchDepartmentClass') { ?>
    <script>
        fetchAccountDepartmentClassParams = JSON.parse(sessionStorage.getItem("fetchAccountDepartmentClassParams"));
    </script>

    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-people-fill"></i> BRANCH DEPARTMENT CLASS LIST /</span> SESSION -- <span
                id="proceedSessionName">
                <script>
                    $("#proceedSessionName").html(fetchAccountDepartmentClassParams?.sessionName);
                </script>
            </span> / TERM -- <span id="proceedTermName">
                <script>
                    $("#proceedTermName").html(fetchAccountDepartmentClassParams?.termName);
                </script>
            </span></span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>
            _fetchAccountBranchDepartmentClass();
        </script>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'viewAccountStudentByClassModal') { ?>
    <script>
        useAccountStudentByClassSession = JSON.parse(sessionStorage.getItem("useAccountStudentByClassSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-people-fill"></i> STUDENT'S LIST</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div>
                            <span><i class="bi-people-fill"></i> STUDENT LIST /</span> SESSION -- <span id="accountSession">
                                <script>
                                    $("#accountSession").html(useAccountStudentByClassSession?.session);
                                </script>
                            </span>
                            / TERM -- <span id="accountTermName">
                                <script>
                                    $("#accountTermName").html(useAccountStudentByClassSession?.termData?.termName);
                                </script>
                            </span>
                            / DEPARTMENT -- <span id="accountDepartment">
                                <script>
                                    $("#accountDepartment").html(useAccountStudentByClassSession?.departmentData
                                        ?.departmentName);
                                </script>
                            </span>
                            / CLASS -- <span id="AccountClass">
                                <script>
                                    $("#AccountClass").html(useAccountStudentByClassSession?.classData?.className + ' ' +
                                        useAccountStudentByClassSession?.armData?.armName);
                                </script>
                            </span>
                            </span>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="accountPageContent">
                            <script>
                                $(document).ready(function () {
                                    const response = JSON.parse(sessionStorage.getItem(
                                        "useAccountStudentByClassSession"));

                                    if (response && response.success === true) {
                                        const data = response.data;

                                        const session = response.session;
                                        const term = response?.termData?.termName;
                                        const termId = response?.termData?.termId;
                                        const departmentId = response?.departmentData?.departmentId;
                                        const department = response?.departmentData?.departmentName;
                                        const classId = response?.classData?.classId;
                                        const className = response?.classData?.className;
                                        const armId = response?.armData?.armId;
                                        const arm = response?.armData?.armName;



                                        let html = `
                                            <thead>
                                                <tr class="tb-col">
                                                    <th>sn</th>
                                                    <th>Student Info</th>
                                                    <th>Session/Term</th>
                                                    <th>Class</th>
                                                    <th>Total Mandatory Fees</th>
                                                    <th>Total Non-Mandatory Fees</th>
                                                    <th>Mandatory Fees Paid</th>
                                                    <th>Non-Mandatory Fees Paid</th>
                                                    <th>Total Fees Paid</th>
                                                    <th>Outstanding Balance</th>
                                                    <th>Fund Balance</th>
                                                    ${userRoles.canLoadStudentFund ? '<th>Load Funds</th>' : ''}
                                                    <th>Pay Fees</th>
                                                </tr >
                                            </thead >
                                        <tbody>`;

                                        let sn = 0;

                                        data.forEach(item => {
                                            sn++;
                                            const student = item.studentData;
                                            const fullname =
                                                `${student.surName} ${student.firstName} ${student.otherNames || ''}`;
                                            const studentId = item.studentId;
                                            const branchId = item.branchId;
                                            const passport = student.passport || "default.jpg";
                                            const advancedBalance = student.advancedBalance;
                                            const outstandingBalance = item.outstandingBalance;
                                            const outstandingStatus = outstandingBalance > 0 ? "red-color" :
                                                "green-color";

                                            let loadFundColumn = '';
                                            if (userRoles.canLoadStudentFund) {
                                                loadFundColumn = `
                                            <td>
                                                <button class="btn view-btn"
                                                    title="Click to load fund"
                                                    onclick="_fetchAccountFeesToPay('${item.branchId}','${session}','${termId}','${departmentId}','${classId}','${armId}','${item.studentId}', 'loadFund');">
                                                    LOAD FUND
                                                </button>
                                            </td>
                                            `;
                                            }

                                            html += `
                                            <tr class="tb-row">
                                                <td>${sn}</td>

                                                <td class="clickable-td">
                                                    <div class="text-back-div" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
                                                        <div class="image-div general-passport">
                                                            <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                                        </div>

                                                        <div class="text-div">
                                                            <div class="first-class">${fullname}</div>
                                                            <div class="second-class">${studentId}</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>${session} - ${term}</td>
                                                <td>${className} ${arm}</td>

                                                <td><s>N</s>${thousandSeperator(item.totalMandatoryAmount)}</td>
                                                <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmount)}</td>
                                                <td>
                                                    <div class="text-back-div">
                                                        <div class="text-div">
                                                            <div class="first-class ${outstandingStatus}"><s>N</s>${thousandSeperator(item.totalMandatoryAmountPaid)}</div>
                                                            <div class="second-class">(${item.totalPercentageForMandatoryFees}%)</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmountPaid)}</td>
                                                <td><s>N</s>${thousandSeperator(item.totalFeesPaid)}</td>
                                                <td>
                                                    <div class="text-back-div">
                                                        <div class="text-div">
                                                            <div class="first-class ${outstandingStatus}"><s>N</s>${thousandSeperator(item.outstandingBalance)}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><s>N</s>${thousandSeperator(advancedBalance)}</td>
                                               
                                                ${loadFundColumn}
                                        <td>
                                            <button class="btn view-btn"
                                                title="Click to make pay fees"
                                                onclick="_fetchAccountFeesToPay('${item.branchId}','${session}','${termId}','${departmentId}','${classId}','${armId}','${item.studentId}', 'payFees');">
                                                PAY FEES
                                            </button>
                                        </td>
                                            </tr > `;
                                        });

                                        html += `</tbody >`;
                                        $('#accountPageContent').html(html);
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

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchStudentPayFeesForm') { ?>
    <script>
        useAccountFessToPaySession = JSON.parse(sessionStorage.getItem("useAccountFessToPaySession"));
    </script>

    <div class="slide-form-div fee-payment-slide" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> FEES PAYMENT</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Kindly follow the instructions below to make a payment for;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Name:</div>
                                    <div><span id="studentPayFullName">
                                            <script>
                                                $("#studentPayFullName").html(useAccountFessToPaySession?.studentData
                                                    ?.fullName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>School Name:</div>
                                    <div><span id="studentPayBranchName">
                                            <script>
                                                $("#studentPayBranchName").html(useAccountFessToPaySession?.branchData
                                                    ?.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="studentPayDepartment">
                                            <script>
                                                $("#studentPayDepartment").html(useAccountFessToPaySession?.departmentData
                                                    ?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="studentPayClassName">
                                            <script>
                                                $("#studentPayClassName").html(useAccountFessToPaySession?.classData
                                                    ?.className + ' ' + useAccountFessToPaySession?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="studentPayCurrentSession">
                                            <script>
                                                $("#studentPayCurrentSession").html(useAccountFessToPaySession?.currentSession);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="studentPayCurrentTerm">
                                            <script>
                                                $("#studentPayCurrentTerm").html(useAccountFessToPaySession?.termData
                                                    ?.currentTerm);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Previous Advanced Balance:</div>
                                    <div><span id="studentAdvancedBalance">
                                            <script>
                                                $("#studentAdvancedBalance").html('<s>N</s>' + thousandSeperator(
                                                    useAccountFessToPaySession?.studentData?.advancedBalance));
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paid-fee-conatiner">
                    <div class="alert alert-success form-alert">
                        <span>List of Fees Paid</span>

                        <div class="alert-list-div" id="paidFees"></div>
                    </div>
                </div>

                <div class="permission-form-back-div account-permission-form-back-div">
                    <div class="title-div">
                        <h4>Enter Fees Amount for Payment</h4>
                        <p>Type the amount or percentage for each fee below. The system will automatically calculate the
                            corresponding percentage or amount and update the total balance in real-time.</p>
                    </div>

                    <div class="permission-toggle-div payment-permission-toggle-div">
                        <div class="fetch-toggle pay-fetch-toggle" id="fetchedFeeTextbox">

                            <script>
                                $(document).ready(function () {
                                    let notPaidFees = '';
                                    let paidFees = '';
                                    let upPaidFees = false;
                                    let completeFees = false;

                                    if (useAccountFessToPaySession && useAccountFessToPaySession
                                        ?.listOfFeesNotPaidData) {
                                        const fetch = useAccountFessToPaySession?.listOfFeesNotPaidData;

                                        for (let i = 0; i < fetch.length; i++) {
                                            const fetchedFess = fetch[i];
                                            const feesId = fetchedFess.feesId;
                                            const percentage = feesId + "_percent";

                                            const feesName = fetchedFess.feesName;
                                            const feesOption = fetchedFess.feesOption;
                                            const newFeesOption = (feesOption === "TRUE") ? "MANDATORY" :
                                                "NOT MANDATORY";
                                            const feesOptionColor = (feesOption === "TRUE") ? "green-color" :
                                                "orange-color";
                                            const amount = thousandSeperator(fetchedFess.amount);

                                            const fieldId = `fees_${feesId} `;

                                            notPaidFees +=
                                                upPaidFees = true;
                                            $("#fetchedFeeTextbox").append(`
                                            < div class="each-toggle-div payment-each-toggle-div new-pay-toggle-div" >
                                                                            <div class="title-back-div">
                                                                                <div class="toggle-title-div new-toggle-title">
                                                                                    <h5>${feesName}</h5> 
                                                                                    <span class="${feesOptionColor}">(<s>N</s>${amount})</span>
                                                                                </div>
                                                                                <div class="sub-title ${feesOptionColor}">${newFeesOption}</div>
                                                                            </div>

                                                                            <div class="text-box-wrapper">
                                                                                <div class="text_field_container" id="${fieldId}_container"></div>
                                                                                <input type="hidden" class="fees-id-holder" value="${feesId}">
                                                                                <div class="text_field_container" id="${percentage}_container"></div>
                                                                            </div>
                                                                        </div > `);

                                            textField({
                                                id: fieldId,
                                                title: 'AMOUNT(<s>N</s>)',
                                                type: 'number',
                                                onKeyUpFunction: `_convertAmountToPercentage('${feesId}')`,
                                                autocomplete: "off"
                                            });

                                            textField({
                                                id: percentage,
                                                title: 'Percentage(%)',
                                                type: 'number',
                                                onKeyUpFunction: `_convertPercentageToAmount('${feesId}')`,
                                                autocomplete: "off"
                                            });

                                        }
                                        if (!upPaidFees) {
                                            $("#fetchedFeeTextbox").html(
                                                '<div class="success-msg">Fees Payment Completed for this session and term!</div>'
                                            );
                                        }
                                    }

                                    if (useAccountFessToPaySession && useAccountFessToPaySession?.listOfFeesPaidData) {
                                        const feesPaidData = useAccountFessToPaySession?.listOfFeesPaidData;

                                        for (let i = 0; i < feesPaidData.length; i++) {
                                            const fetchFeesPaid = feesPaidData[i];
                                            const totalAmountPaid = thousandSeperator(fetchFeesPaid.totalAmountPaid);
                                            const totalFeesPercentage = fetchFeesPaid.totalFeesPercentage;
                                            const feesName = fetchFeesPaid.feesName;
                                            const percentageColor = totalFeesPercentage >= 100 ? "green-color" :
                                                "orange-color";

                                            paidFees +=
                                                completeFees = true;
                                            $("#paidFees").append(`
                                            < div class="alert-list-back-div paid-fees-back-div" >
                                                <div class="alert-list paid-fees-list">
                                                    <div>${feesName}:</div>
                                                    <div class="alert-value">
                                                        <span class="alert-percentage ${percentageColor}">${totalFeesPercentage}%</span>
                                                        <span><s>N</s>${totalAmountPaid}</span>
                                                    </div>
                                                </div>
                                                                        </div >`);

                                        }
                                        if (!completeFees) {
                                            $("#paidFees").html('No record found!');
                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Payment Summary</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>PREVIOUS ADVANCED BALANCE:</div>
                                    <div><span id="formAdvancedBalance"></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>TOTAL AMOUNT TO BE PAID:</div>
                                    <div><span class="total-amount" id="totalAmount"><s>N</s>0.00</span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>NEW ADVANCED BALANCE:</div>
                                    <div><span id="newAdvancedBalance"><s>N</s>0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert" id="showSchoolBoltCharges">
                    <span>Select payment method to pay system charges.</span>
                    <div class="alert-list-div">

                        <div class="alert-list-back-div">
                            <div class="alert-list">
                                <div>SCHOOLBOT WALLET BALANCE:</div>
                                <div>
                                    <span id="walletBalance"></span>
                                    <script>
                                        $("#walletBalance").html('<s>N</s>' + thousandSeperator(useAccountFessToPaySession
                                            ?.branchData?.walletBalance));
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="alert-list-back-div">
                            <div class="alert-list">
                                <div>SYSTEM CHARGES:</div>
                                <div>
                                    <span id="schoolBoltCharges"></span>
                                    <script>
                                        $("#schoolBoltCharges").html('<s>N</s>' + thousandSeperator(useAccountFessToPaySession
                                            ?.schoolBoltCharges));
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="alert-list-div">
                            <div class="text_field_container" id="paymentMethodId_container">
                                <script>
                                    selectField({
                                        id: 'paymentMethodId',
                                        title: 'Select Payment Method'
                                    });
                                    _getSelectAccountPaymentMethod('paymentMethodId');
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="btn" title="Make Payment" id="paymentBtn" onclick="_proceedToPayment();"> <i
                            class="bi-check"></i> MAKE PAYMENT </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function _convertAmountToPercentage(feesId) {
            const feeData = useAccountFessToPaySession?.listOfFeesNotPaidData.find(f => f.feesId == feesId);

            const fieldId = `fees_${feesId} `;
            const percentageId = feesId + "_percent";

            let totalFee = parseFloat(feeData.amount) || 0;
            let amount = parseFloat($("#" + fieldId).val()) || 0;

            if (amount > totalFee) {
                amount = totalFee;
                $("#" + fieldId).val(amount);
            }

            let percentage = totalFee > 0 ? (amount / totalFee) * 100 : 0;

            $("#" + percentageId).val(percentage.toFixed(2));

            _calculatePaymentSummary();
        }

        function _convertPercentageToAmount(feesId) {
            const feeData = useAccountFessToPaySession?.listOfFeesNotPaidData.find(f => f.feesId == feesId);

            const fieldId = `fees_${feesId}`;
            const percentageId = feesId + "_percent";

            let totalFee = parseFloat(feeData.amount) || 0;
            let percentage = parseFloat($("#" + percentageId).val()) || 0;

            if (percentage > 100) {
                percentage = 100;
                $("#" + percentageId).val(100);
            }

            let amount = (percentage / 100) * totalFee;

            $("#" + fieldId).val(amount.toFixed(2));

            _calculatePaymentSummary();
        }

        function _calculatePaymentSummary() {
            let previousBalance = parseFloat(useAccountFessToPaySession?.studentData?.advancedBalance) || 0;

            let totalFees = 0;

            $('#fetchedFeeTextbox input[type="number"]').each(function () {
                let id = $(this).attr('id');

                // Only amount fields
                if (!id.includes('_percent')) {
                    totalFees += parseFloat($(this).val()) || 0;
                }
            });

            $("#formAdvancedBalance").html('<s>N</s>' + thousandSeperator(previousBalance));
            $("#totalAmount").html('<s>N</s>' + thousandSeperator(totalFees));

            let newBalance = previousBalance - totalFees;

            if (newBalance >= 0) {
                $("#newAdvancedBalance").html('<s>N</s>' + thousandSeperator(newBalance));
            } else {
                $("#newAdvancedBalance").html(
                    '<span style="color:red;">- <s>N</s>' +
                    thousandSeperator(Math.abs(newBalance)) +
                    ' (Insufficient Funds)</span>'
                );
            }
        }

        $(document).ready(function () {
            _calculatePaymentSummary();

            ///// SHOW / HIDE SCHOOL BOLT CHARGES ////
            if (useAccountFessToPaySession?.schoolBoltCharges > 0) {
                $('#showSchoolBoltCharges').show();
            } else {
                $('#showSchoolBoltCharges').hide();
            }
        });
    </script>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'viewStudentDebtorsModal') { ?>
    <script>
        useAccountStudentByClassSession = JSON.parse(sessionStorage.getItem("useAccountStudentByClassSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-people-fill"></i> STUDENT DEBTORS LIST</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div>
                            <span><i class="bi-people-fill"></i> STUDENT DEBTORS LIST /</span> SESSION -- <span
                                id="accountSession">
                                <script>
                                    $("#accountSession").html(useAccountStudentByClassSession?.session);
                                </script>
                            </span>
                            / TERM -- <span id="accountTermName">
                                <script>
                                    $("#accountTermName").html(useAccountStudentByClassSession?.termData?.termName);
                                </script>
                            </span>
                            / DEPARTMENT -- <span id="accountDepartment">
                                <script>
                                    $("#accountDepartment").html(useAccountStudentByClassSession?.departmentData
                                        ?.departmentName);
                                </script>
                            </span>
                            / CLASS -- <span id="AccountClass">
                                <script>
                                    $("#AccountClass").html(useAccountStudentByClassSession?.classData?.className + ' ' +
                                        useAccountStudentByClassSession?.armData?.armName);
                                </script>
                            </span>
                            </span>
                        </div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="accountPageContent">
                            <script>
                                $(document).ready(function () {
                                    const response = JSON.parse(sessionStorage.getItem(
                                        "useAccountStudentByClassSession"));

                                    if (response && response.success === true) {
                                        const data = response.data;

                                        const session = response.session;
                                        const term = response?.termData?.termName;
                                        const termId = response?.termData?.termId;
                                        const departmentId = response?.departmentData?.departmentId;
                                        const department = response?.departmentData?.departmentName;
                                        const classId = response?.classData?.classId;
                                        const className = response?.classData?.className;
                                        const armId = response?.armData?.armId;
                                        const arm = response?.armData?.armName;

                                        let html = `
                                            < thead >
                                            <tr class="tb-col">
                                                <th>sn</th>
                                                <th>Student Info</th>
                                                <th>Session/Term</th>
                                                <th>Class</th>
                                                <th>Total Mandatory Fees</th>
                                                <th>Total Non-Mandatory Fees</th>
                                                <th>Mandatory Fees Paid</th>
                                                <th>Non-Mandatory Fees Paid</th>
                                                <th>Total Fees Paid</th>
                                                <th>Oustanding Mandatory Fees</th>
                                                <th>View</th>
                                            </tr>
                                                                        </thead >
                                            <tbody>`;

                                        let sn = 0;

                                        data.forEach(item => {
                                            sn++;
                                            const student = item.studentData;
                                            const fullname =
                                                `${student.surName} ${student.firstName} ${student.otherNames || ''}`;
                                            const studentId = item.studentId;
                                            const branchId = item.branchId;
                                            const passport = student.passport || "default.jpg";
                                            const advancedBalance = student.advancedBalance;
                                            const isDebtor = item.isDebtor;
                                            const debtorStatusColor = (isDebtor === "TRUE") ? "red-color" :
                                                "green-color";
                                            const debtorImgStatusColor = (isDebtor === "TRUE") ?
                                                '<div class="status-icon debtor"><i class="bi-x"></i></div>' :
                                                '<div class="status-icon"><i class="bi-check"></i></div>';
                                            const outstandingBalance = item.outstandingBalance;
                                            const outstandingStatus = outstandingBalance > 0 ? "red-color" :
                                                "green-color";

                                            html += `
                                                <tr class="tb-row">
                                                    <td>${sn}</td>

                                                    <td class="clickable-td">
                                                        <div class="text-back-div" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
                                                            ${debtorImgStatusColor}
                                                            <div class="image-div general-passport">
                                                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                                            </div>

                                                            <div class="text-div">
                                                                <div class="first-class">${fullname}</div>
                                                                <div class="second-class">${studentId}</div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>${session} - ${term}</td>
                                                    <td>${className} ${arm}</td>

                                                    <td><s>N</s>${thousandSeperator(item.totalMandatoryAmount)}</td>
                                                    <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmount)}</td>
                                                    <td>
                                                        <div class="text-back-div">
                                                            <div class="text-div">
                                                                <div class="first-class ${debtorStatusColor}"><s>N</s>${thousandSeperator(item.totalMandatoryAmountPaid)}</div>
                                                                <div class="second-class">(${item.totalPercentageForMandatoryFees}%)</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmountPaid)}</td>
                                                    <td><s>N</s>${thousandSeperator(item.totalFeesPaid)}</td>
                                                    <td>
                                                        <div class="text-back-div">
                                                            <div class="text-div">
                                                                <div class="first-class ${outstandingStatus}"><s>N</s>${thousandSeperator(item.outstandingBalance)}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn view-btn"
                                                            title="Click to make pay fees"
                                                            onclick="_fetchEachSudentDebtors('${item.branchId}','${session}','${termId}','${departmentId}','${classId}','${armId}','${item.studentId}');">
                                                            VIEW FEES PAID
                                                        </button>
                                                    </td>
                                                </tr>`;
                                        });

                                        html += `</tbody>`;
                                        $('#accountPageContent').html(html);
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

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'branchStudentDebtorsForm') { ?>
    <script>
        useAccountFessToPaySession = JSON.parse(sessionStorage.getItem("useAccountFessToPaySession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> FEES PAYMENT</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>View student fees;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Name:</div>
                                    <div><span id="debotorStudentPayFullName">
                                            <script>
                                                $("#debotorStudentPayFullName").html(useAccountFessToPaySession?.studentData
                                                    ?.fullName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>School Name:</div>
                                    <div><span id="studentPayBranchName">
                                            <script>
                                                $("#studentPayBranchName").html(useAccountFessToPaySession?.branchData
                                                    ?.branchName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="studentPayDepartment">
                                            <script>
                                                $("#studentPayDepartment").html(useAccountFessToPaySession?.departmentData
                                                    ?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="studentPayClassName">
                                            <script>
                                                $("#studentPayClassName").html(useAccountFessToPaySession?.classData
                                                    ?.className + ' ' + useAccountFessToPaySession?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="studentPayCurrentSession">
                                            <script>
                                                $("#studentPayCurrentSession").html(useAccountFessToPaySession?.currentSession);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="studentPayCurrentTerm">
                                            <script>
                                                $("#studentPayCurrentTerm").html(useAccountFessToPaySession?.termData
                                                    ?.currentTerm);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="paid-fee-conatiner">
                    <div class="alert alert-success form-alert">
                        <span>List of Fees Paid</span>

                        <div class="alert-list-div" id="debtorPaidFees"></div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            let paidFees = '';
                            let completeFees = false;

                            if (useAccountFessToPaySession && useAccountFessToPaySession?.listOfFeesPaidData) {
                                const feesPaidData = useAccountFessToPaySession?.listOfFeesPaidData;

                                for (let i = 0; i < feesPaidData.length; i++) {
                                    const fetchFeesPaid = feesPaidData[i];
                                    const totalAmountPaid = thousandSeperator(fetchFeesPaid.totalAmountPaid);
                                    const totalFeesPercentage = fetchFeesPaid.totalFeesPercentage;
                                    const feesName = fetchFeesPaid.feesName;
                                    const percentageColor = totalFeesPercentage >= 100 ? "green-color" : "orange-color";

                                    paidFees +=
                                        completeFees = true;
                                    $("#debtorPaidFees").append(`
                                            < div class="alert-list-back-div paid-fees-back-div" >
                                                <div class="alert-list paid-fees-list">
                                                    <div>${feesName}:</div>
                                                    <div class="alert-value">
                                                        <span class="alert-percentage ${percentageColor}">${totalFeesPercentage}%</span>
                                                        <span><s>N</s>${totalAmountPaid}</span>
                                                    </div>
                                                </div>
                                                                </div >`);

                                }
                                if (!completeFees) {
                                    $("#debtorPaidFees").html('No record found!');
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'activateStudentResultModal') { ?>
    <script>
        useAccountStudentByClassSession = JSON.parse(sessionStorage.getItem("useAccountStudentByClassSession"));
    </script>

    <script>
        _checkAll()
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-people-fill"></i> ACTIVATE STUDENTS RESULT</span>
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
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="parent">
                                        <span>Check All Students</span>
                                    </label>
                                </div>
                            </div>

                            <div class="search-btn-div">
                                <div class="search-div">
                                    <input type="text" onkeyup="_filtersActivateStudents(this.value);"
                                        placeholder="Search Student Here...">
                                    <i class="bi bi-search"></i>
                                </div>

                                <div class="btn-div">
                                    <button class="btn" title="ACTIVATE RESULT" id="activateAllBtn"
                                        onclick="_activateAllStudentResult();">
                                        <i class="bi-check"></i> ACTIVATE RESULT
                                    </button>
                                    <button class="btn deactivate-btn" title="DEACTIVATE ALL RESULT" id="deActivateAllBtn"
                                        onclick="_deActivateAllStudentResult();">
                                        <i class="bi-x"></i> DEACTIVATE ALL RESULT
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="content-container" id="getPaymentNav">
                            <div class="alert alert-success top-alert-div animated fadeIn">
                                <div>
                                    <span><i class="bi-people-fill"></i> STUDENT RESULT ACTIVATION LIST /</span> SESSION --
                                    <span id="accountSession">
                                        <script>
                                            $("#accountSession").html(useAccountStudentByClassSession?.session);
                                        </script>
                                    </span>
                                    / TERM -- <span id="accountTermName">
                                        <script>
                                            $("#accountTermName").html(useAccountStudentByClassSession?.termData?.termName);
                                        </script>
                                    </span>
                                    / DEPARTMENT -- <span id="accountDepartment">
                                        <script>
                                            $("#accountDepartment").html(useAccountStudentByClassSession?.departmentData
                                                ?.departmentName);
                                        </script>
                                    </span>
                                    / CLASS -- <span id="AccountClass">
                                        <script>
                                            $("#AccountClass").html(useAccountStudentByClassSession?.classData?.className +
                                                ' ' +
                                                useAccountStudentByClassSession?.armData?.armName);
                                        </script>
                                    </span>
                                    </span>
                                </div>
                            </div>

                            <div class="table-div animated fadeIn">
                                <table class="table" cellspacing="0" style="width:100%" id="accountPageContent">
                                    <script>
                                        $(document).ready(function () {
                                            const response = JSON.parse(sessionStorage.getItem(
                                                "useAccountStudentByClassSession"));

                                            if (response && response.success === true) {
                                                const data = response.data;

                                                const session = response.session;
                                                const term = response?.termData?.termName;
                                                const departmentId = response?.departmentData?.departmentId;
                                                const department = response?.departmentData?.departmentName;
                                                const classId = response?.classData?.classId;
                                                const className = response?.classData?.className;
                                                const armId = response?.armData?.armId;
                                                const arm = response?.armData?.armName;

                                                let html = `
                                            < thead >
                                            <tr class="tb-col">
                                                <th></th>
                                                <th>sn</th>
                                                <th>Student Info</th>
                                                <th>Session/Term</th>
                                                <th>Class</th>
                                                <th>Total Mandatory Fees</th>
                                                <th>Total Non-Mandatory Fees</th>
                                                <th>Mandatory Fees Paid</th>
                                                <th>Non-Mandatory Fees Paid</th>
                                                <th>Total Fees Paid</th>
                                                <th>Outstanding Balance</th>
                                                <th>Status</th>
                                            </tr>
                                                                        </thead >
                                            <tbody>`;

                                                let sn = 0;

                                                data.forEach(item => {
                                                    sn++;
                                                    const student = item.studentData;
                                                    const fullname =
                                                        `${student.surName} ${student.firstName} ${student.otherNames || ''}`;
                                                    const studentId = item.studentId;
                                                    const branchId = item.branchId;
                                                    const passport = student.passport || "default.jpg";
                                                    const advancedBalance = student.advancedBalance;
                                                    const isDebtor = item.isDebtor;
                                                    const isResultActivated = item.isResultActivated;
                                                    const outstandingBalance = item.outstandingBalance;
                                                    const debtorStatusColor = (isDebtor === "TRUE") ?
                                                        "red-color" : "green-color";
                                                    const debtorImgStatusColor = (isDebtor === "TRUE") ?
                                                        '<div class="status-icon debtor"><i class="bi-x"></i></div>' :
                                                        '<div class="status-icon"><i class="bi-check"></i></div>';

                                                    viewStatus = (isResultActivated === "TRUE") ?
                                                        `
                                                <div class="status-div ACTIVATE">
                                                    ACTIVATED
                                                </div>
                                                ` :
                                                        `
                                                <div class="status-div DEACTIVATE">
                                                    DEACTIVATED
                                                </div>
                                                `;

                                                    html += `
                                                <tr class="tb-row">
                                                    <td>
                                                        <label class="custom-checkbox">
                                                            <input type="checkbox"
                                                                class="child"
                                                                id="student_${studentId}"
                                                                name="studentId[]"
                                                                value="${studentId}"
                                                                data-value="${studentId}"
                                                                ${isResultActivated === "TRUE" ? "checked" : ""}>
                                                                <span></span>
                                                        </label>
                                                    </td>
                                                    <td>${sn}</td>

                                                    <td class="clickable-td">
                                                        <div class="text-back-div" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
                                                            ${debtorImgStatusColor}
                                                            <div class="image-div general-passport">
                                                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                                            </div>

                                                            <div class="text-div">
                                                                <div class="first-class">${fullname}</div>
                                                                <div class="second-class">${studentId}</div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>${session} - ${term}</td>
                                                    <td>${className} ${arm}</td>

                                                    <td><s>N</s>${thousandSeperator(item.totalMandatoryAmount)}</td>
                                                    <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmount)}</td>
                                                    <td>
                                                        <div class="text-back-div">
                                                            <div class="text-div">
                                                                <div class="first-class ${debtorStatusColor}"><s>N</s>${thousandSeperator(item.totalMandatoryAmountPaid)}</div>
                                                                <div class="second-class">(${item.totalPercentageForMandatoryFees}%)</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmountPaid)}</td>
                                                    <td><s>N</s>${thousandSeperator(item.totalFeesPaid)}</td>
                                                    <td>
                                                        <div class="text-back-div">
                                                            <div class="text-div">
                                                                <div class="first-class ${debtorStatusColor}"><s>N</s>${thousandSeperator(item.outstandingBalance)}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        ${viewStatus}
                                                    </td>
                                                </tr>`;
                                                });

                                                html += `</tbody>`;
                                                $('#accountPageContent').html(html);
                                            }
                                        });
                                    </script>
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
<?php if ($page == 'branchDailyRevenuePage') { ?>
    <div class="branch-account-wrapper">
        <div class="nav-content-back-div">
            <div class="nav-container">
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
                <i class="bi-info-circle"></i> Revenue report between <span id="dateFrom">Loading...</span> and <span
                    id="dateTo">Loading...</span>
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
<?php } ?>

<!-- Filter By Session Revenue Pages -->
<?php if ($page == 'filterBranchBySession') { ?>
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