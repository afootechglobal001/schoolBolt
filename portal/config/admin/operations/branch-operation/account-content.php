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
            $(document).ready(function() {
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
        <div class="title"><i class="bi-table"></i> SESSION & TERM SELECTION</div>
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
            _getSelectAccountSession('sessionId');
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

        <button class="btn" id="proceedBtn" title="Proceed Request"
            onclick="_proceedFetchAcountDepartmentClass();">PROCEED <i class="bi-arrow-right"></i> </button>
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
<?php if ($page == 'viewAccountStudentByClass') { ?>
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
                        $(document).ready(function() {
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
                                                <th>Fund Balance</th>
                                                <th>Load Funds</th>
                                                <th>Pay Fees</th>
                                            </tr>
                                        </thead>
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
                                                            <div class="first-class"><s>N</s>${thousandSeperator(item.totalMandatoryAmountPaid)}</div>
                                                            <div class="second-class">(${item.totalPercentageForMandatoryFees}%)</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><s>N</s>${thousandSeperator(item.totalNotMandatoryAmountPaid)}</td>
                                                <td><s>N</s>${thousandSeperator(item.totalFeesPaid)}</td>
                                                <td><s>N</s>${thousandSeperator(advancedBalance)}</td>

                                                <td>
                                                    <button class="btn view-btn"
                                                        title="Click to load fund"
                                                        onclick="_fetchAccountFeesToPay('${item.branchId}','${item.session}','${item.termId}','${item.departmentId}','${item.classId}','${item.armId}','${item.studentId}', 'loadFund');">
                                                        LOAD FUND
                                                    </button>
                                                </td>

                                                <td>
                                                    <button class="btn view-btn"
                                                        title="Click to make pay fees"
                                                        onclick="_fetchAccountFeesToPay('${item.branchId}','${item.session}','${item.termId}','${item.departmentId}','${item.classId}','${item.armId}','${item.studentId}', 'payFees');">
                                                        PAY FEES
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
<?php if ($page == 'branchStudentPayFeesForm') { ?>
<script>
useAccountFessToPaySession = JSON.parse(sessionStorage.getItem("useAccountFessToPaySession"));
getEachAccountStudentSession = JSON.parse(sessionStorage.getItem("getEachAccountStudentSession"));
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
                    <span>Kindly follow the instructions below to make a payment for;</span>
                    <div class="alert-list-div">
                        <div class="alert-list-back-div">
                            <div class="alert-list">
                                <div>Student Name:</div>
                                <div><span id="studentPayFullName">
                                        <script>
                                        $("#studentPayFullName").html(getEachAccountStudentSession?.studentData
                                            ?.surName + ' ' + getEachAccountStudentSession?.studentData?.firstName +
                                            ' ' + getEachAccountStudentSession?.studentData?.otherNames);
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
                                            getEachAccountStudentSession?.studentData?.advancedBalance));
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

                    <div class="alert-list-div" id="paidFees">
                        No record found!
                    </div>
                </div>
            </div>

            <div class="permission-form-back-div account-permission-form-back-div">
                <div class="title-div">
                    <h4>Select Fees for Payment</h4>
                    <p>Use the toggles below to select fees applicable to this student. Switching a toggle to "Yes"
                        enables payment for that category.</p>
                </div>

                <div class="permission-toggle-div">
                    <div class="toggle-title">Fee Categories</div>
                    <div class="fetch-toggle" id="notPaidFees">

                        <script>
                        $(document).ready(function() {
                            let notPaidFees = '';
                            let paidFees = '';

                            if (useAccountFessToPaySession && useAccountFessToPaySession.data) {
                                const fetch = useAccountFessToPaySession.data;

                                for (let i = 0; i < fetch.length; i++) {
                                    const fetchedFess = fetch[i];
                                    const feesId = fetchedFess.feesId;
                                    const feesName = fetchedFess.feesName;
                                    const feesOption = fetchedFess.feesOption;
                                    const NewFeesOption = (feesOption === "TRUE") ? "MANDATORY" :
                                        "NOT MANDATORY";
                                    const feesOptionColor = (feesOption === "TRUE") ? "green-color" :
                                        "orange-color";
                                    const amount = thousandSeperator(fetchedFess.amount);
                                    const paid = fetchedFess.paid;

                                    if (paid === 'FALSE') {
                                        notPaidFees += `
                                                <div class="each-toggle-div payment-each-toggle-div">
                                                    <div class="title-back-div">
                                                        <div class="toggle-title-div">${feesName} - <span>(<s>N</s>${amount})</span></div>
                                                        <div class="sub-title ${feesOptionColor}">${NewFeesOption}</div>
                                                    </div>
                                                    <label for="fees_${feesId}" class="switch">
                                                        <input type="checkbox" class="child" id="fees_${feesId}" name="feesId[]" data-value="${feesId}" value="${fetchedFess.amount}">
                                                        <span class="slider"></span>
                                                        <span class="toggle-label">No</span>
                                                    </label>
                                                </div>`;
                                    } else {
                                        paidFees += `
                                                <div class="alert-list-back-div">
                                                    <div class="alert-list">
                                                        <div>${feesName}:</div>
                                                        <div><span id=""><s>N</s>${amount}</span></div>
                                                    </div>
                                                </div>`;
                                    }
                                }
                                $("#notPaidFees").html(notPaidFees);
                                $("#paidFees").html(paidFees !== '' ? paidFees : 'No record found!');
                                _toggleCheck();
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
function _calculatePaymentSummary() {
    let previousBalance = parseFloat(getEachAccountStudentSession?.studentData?.advancedBalance);

    // Sum selected fees
    let totalFees = 0;
    $('.child:checked').each(function() {
        totalFees += parseFloat($(this).val()) || 0;
    });

    $("#formAdvancedBalance").html('<s>N</s>' + thousandSeperator(previousBalance));
    $("#totalAmount").html('<s>N</s>' + thousandSeperator(totalFees));

    let newBalance = previousBalance - totalFees;

    if (newBalance >= 0) {
        $("#newAdvancedBalance").html('<s>N</s>' + thousandSeperator(newBalance));
    } else {
        $("#newAdvancedBalance").html(
            '<span style="color:red;">- <s>N</s>' + thousandSeperator(Math.abs(newBalance)) +
            ' (Insufficent Funds)</span>'
        );
    }
}

$(document).ready(function() {
    _calculatePaymentSummary();
    $(document).on('change', '.child', function() {
        _calculatePaymentSummary();
    });

    ///// SHOW / HIDE SCHOOL BOLT CHARGES ////
    if (useAccountFessToPaySession?.schoolBoltCharges > 0) {
        $('#showSchoolBoltCharges').show();
    } else {
        $('#showSchoolBoltCharges').hide();
    }
});
</script>
<?php } ?>