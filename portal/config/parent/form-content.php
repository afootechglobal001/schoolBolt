<?php if ($page == 'studentProfileForm') { ?>
    <script> getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));</script>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STUDENT DETAILS</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img" id="profileTitle">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="headerImage">
                            <script>$("#headerImage").html('<img src="'+websiteUrl+'/uploaded_files/studentPix/'+getEachStudentSession.studentData.passport+'" alt="'+getEachStudentSession.studentData.surName+'"/>');</script>
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <h2 id="headerSurname">
                                    <script>$("#headerSurname").html(capitalizeFirstLetterOfEachWord(getEachStudentSession.studentData.surName+' '+getEachStudentSession.studentData.firstName +' '+getEachStudentSession.studentData.otherNames));</script>
                                </h2>

                                <div class="text">
                                    ID:<strong id="headerStudentId"><script>$("#headerStudentId").html(getEachStudentSession.studentId);</script></strong> | 
                                    <strong id="headerClass">
                                        <script>$("#headerClass").html(getEachStudentSession.departmentData.departmentName+' - '+getEachStudentSession.classData.className+' '+getEachStudentSession.armData.armName);</script>
                                    </strong>
                                    <div id="headerStatus">
                                         <script>$("#headerStatus").html('<div id="statusBtn" class="status-btn '+getEachStudentSession.studentData.statusName+'"><span>'+getEachStudentSession.studentData.statusName+'</span></div>')</script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Dashboard" id="studentDashbaord" onclick="_getActiveStudentPage({divid: 'studentDashbaord', page: 'studentDashbaord', url: parentPortalLocalUrl});"><i class="bi-speedometer2"></i> Dashboard</li>
                        <li title="Student Profile" id="studentProfile" onclick="_getActiveStudentPage({divid: 'studentProfile', page: 'studentProfile', url: parentPortalLocalUrl});"><i class="bi-person-lines-fill"></i> Student Profile</li>
                        <li title="Pay Fees" class="hide-li" id="payFees" onclick="_fetchFeesToPay();"><i class="bi-credit-card"></i> Pay Fees</li>
                        <li title="Payment History" class="hide-li" id="paymentHistory" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl});"><i class="bi-clock-history"></i> Payment History</li>
                        <!-- <li title="Attendance" id="attendance" onclick=""><i class="bi-person-bounding-box"></i> Attendance</li>
                        <li title="Time Table" id="timeTable" onclick=""><i class="bi-bell"></i> Time Table</li>
                        <li title="Print Result" id="printResult" onclick=""><i class="bi-bell"></i> Print Result</li>
                        <li title="Assignment" id="assignment" onclick=""><i class="bi-bell"></i> Assignment</li> -->
                        <li title="Other Links"><i class="bi-three-dots-vertical"></i>
                            <ul>
                                <li title="Dashboard" class="active" onclick="_getActiveStudentPage({divid: 'studentDashbaord', page: 'studentDashbaord', url: parentPortalLocalUrl});"><i class="bi-speedometer2"></i> <span>Dashboard</span></li>
                                <li title="Student Profile" onclick="_getActiveStudentPage({divid: 'studentProfile', page: 'studentProfile', url: parentPortalLocalUrl});"><i class="bi-person-lines-fill"></i> <span>Student Profile</span></li>
                                <li title="Pay Fees" onclick="_fetchFeesToPay();"><i class="bi-credit-card-2-back"></i> <span>Pay Fees</span></li>
                                <li title="Payment History" class="hide-li" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl});"><i class="bi-clock-history"></i> <span>Payment History</span></li>
                                <li title="View Result" onclick=""><i class="bi-printer"></i> <span>View Result</span></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="getStudentDetails">
                    <script>
                        _getActiveStudentPage({
                            divid: 'studentDashbaord',
                            page: 'studentDashbaord',
                            url: parentPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- For Student Modal Pages -->
<?php if ($page == 'studentDashbaord') { ?>
    <div class="card-back-div" data-aos="fade-in" data-aos-duration="1300">
        <div class="card-div" title="Pay Fees" onclick="_fetchFeesToPay();"> 
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/online-payment.jpg" alt="Pay Fees"></div>
            <div class="text">Pay Fees</div>
        </div>

        <div class="card-div" title="View Result">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/print-result.jpg" alt="View Result"></div>
            <div class="text">View Result</div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'studentProfile') { ?>
    <script> getEachStudentSession = JSON.parse(sessionStorage.getItem("getEachStudentSession"));</script>
    <div class="detail-container" data-aos="fade-in" data-aos-duration="1300">  
        <div class="profile-details">
            <div class="title">
                <i class="bi-person-lines-fill"></i>
                <span>STUDENT DETAILS</span>
            </div>

            <div class="details-div" id="student-details">
                <div class="details"><span>STUDENT ID</span>
                    <div id="studentId"><script>$("#studentId").html(getEachStudentSession.studentData.studentId);</script></div>
                </div>

                <div class="details"><span>FULLNAME</span>
                    <div id="fullName"><script>$("#fullName").html(capitalizeFirstLetterOfEachWord(getEachStudentSession.studentData.surName+' '+getEachStudentSession.studentData.firstName +' '+getEachStudentSession.studentData.otherNames));</script></div>
                </div>

                <div class="details"><span>CURRENT CLASS</span>
                    <div id="className"><script>$("#className").html(getEachStudentSession.classData.className);</script></div>
                </div>

                <div class="details"><span>DATE OF BIRTH</span>
                    <div id="dateOfBirth"><script>$("#dateOfBirth").html(getEachStudentSession.studentData.dateOfBirth);</script></div>
                </div>

                <div class="details"><span>GENDER</span>
                    <div id="genderName"><script>$("#genderName").html(getEachStudentSession.studentData.genderName);</script></div>
                </div>

                <div class="details"><span>STUDENT CATEGORY</span>
                    <div id="accommodationId"><script>$("#accommodationId").html(getEachStudentSession.studentData.accommodationId);</script></div>
                </div>

                <div class="details"><span>ADDRESS</span>
                    <div id="address"><script>$("#address").html(getEachStudentSession.studentData.address);</script></div>
                </div>

                <div class="details"><span>DATE OF REGISTRATION</span>
                    <div id="createdTime"><script>$("#createdTime").html(getEachStudentSession.studentData.createdTime);</script></div>
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="title">
                <i class="bi-person-lines-fill"></i>
                <span>SCHOOL DETAILS</span>
            </div>

            <div class="details-div" id="student-details">
                <div class="details"><span>SCHOOL NAME</span>
                    <div id="branchName"><script>$("#branchName").html(getEachStudentSession.branchData.branchName);</script></div>
                </div>

                <div class="details"><span>SCHOOL OFFICIAL EMAIL</span>
                   <div id="email"><script>$("#email").html(getEachStudentSession.branchData.email);</script></div>
                </div>

                <div class="details"><span>ADDRESS</span>
                   <div id="address2"><script>$("#address2").html(getEachStudentSession.branchData.address);</script></div>
                </div>

                <div class="details"><span>PHONE NUMBER</span>
                   <div id="mobileNumber"><script>$("#mobileNumber").html(getEachStudentSession.branchData.mobileNumber);</script></div>
                </div>

                <div class="details"><span>SESSION</span>
                   <div id="currentSession"><script>$("#currentSession").html(getEachStudentSession.branchData.currentSession);</script></div>
                </div>

                <div class="details"><span>TERM</span>
                   <div id="currentTerm"><script>$("#currentTerm").html(getEachStudentSession.branchData.termData.currentTerm);</script></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'paymentForm') { ?>
    <script> getPayFeesToPaySession = JSON.parse(sessionStorage.getItem("getPayFeesToPaySession"));</script>

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
                                    <div><span id="formSurname"><script>$("#formSurname").html(getEachStudentSession.studentData.surName+' '+getEachStudentSession.studentData.firstName +' '+getEachStudentSession.studentData.otherNames);</script></span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>School Name:</div>
                                    <div><span id="formBranchName"><script>$("#formBranchName").html(getPayFeesToPaySession.branchData.branchName);</script></span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="formDepartment"><script>$("#formDepartment").html(getPayFeesToPaySession.departmentData.departmentName);</script></span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                <div><span id="formClass"><script>$("#formClass").html(getPayFeesToPaySession.classData.className+' '+getEachStudentSession.armData.armName);</script></span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                <div><span id="formCurrentSession"><script>$("#formCurrentSession").html(getPayFeesToPaySession.branchData.currentSession);</script></span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="formCurrentTerm"><script>$("#formCurrentTerm").html(getPayFeesToPaySession.termData.currentTerm);</script></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paid-fee-conatiner">
                    <div class="alert alert-success form-alert">
                        <span>List of Fees Paid</span>

                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>TUITION FEE:</div>
                                    <div><span id=""><s>N</s>150,000</span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>BUS FEE:</div>
                                    <div><span id=""><s>N</s>10,000</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="permission-form-back-div">
                    <div class="title-div">
                        <h4>Select Fees for Payment</h4>
                        <p>Use the toggles below to select fees applicable to this student. Switching a toggle to "Yes" enables payment for that category.</p>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Fee Categories</div>
                        <div class="fetch-toggle" id="fetchedPayment">

                            <script>
                                $(document).ready(function() {
                                    let text = '';

                                    if (getPayFeesToPaySession && getPayFeesToPaySession.data) {
                                        const fetch = getPayFeesToPaySession.data;

                                        for (let i = 0; i < fetch.length; i++) {
                                            const fetchedFess = fetch[i];
                                            const feesId = fetchedFess.feesId;
                                            const feesName = fetchedFess.feesName;
                                            const feesOption = fetchedFess.feesOption;
                                            const NewFeesOption = (feesOption === "TRUE") ? "MANDATORY" : "NOT MANDATORY";
                                            const feesOptionColor = (feesOption === "TRUE") ? "green-color" : "orange-color";       
                                            const amount = thousandSeperator(fetchedFess.amount);

                                            text += `
                                                <div class="each-toggle-div">
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
                                            
                                        }
                                        $("#fetchedPayment").html(text);
                                        _toggleCheck();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Summary of Fees Chosen by Parent</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>TOTAL FEES:</div>
                                    <div><span id="totalFee"><s>N</s>0.00</span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>SYSTEM CHARGES:</div>
                                    <div>
                                        <span id="schoolBoltCharges"></span>
                                        <script>$("#schoolBoltCharges").html('<s>N</s>'+thousandSeperator(getPayFeesToPaySession.schoolBoltCharges));</script>
                                    </div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>TOTAL AMOUNT:</div>
                                    <div><span class="total-amount" id="totalAmount"><s>N</s>160,000</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="paymentMethodId_container">
                    <script>
                        selectField({
                            id: 'paymentMethodId',
                            title: 'Select Payment Method'
                        });
                        _getSelectPaymentMethod('paymentMethodId');
                    </script>
                </div>
        
                <div>
                    <button class="btn" title="Make Payment" id="submitBtn" onclick="_getForm({page: 'accountTransferForm', layer: 2, url: parentPortalLocalUrl});"> <i class="bi-check"></i> MAKE PAYMENT </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            function updateTotal() {

                let totalFee = 0;
                let totalAmount=0;

                $('.child:checked').each(function () {
                    totalFee += parseFloat($(this).val()) || 0;
                });
                totalAmount = totalFee + parseFloat(getPayFeesToPaySession.schoolBoltCharges);

                $('#totalFee').html('<s>N</s>'+thousandSeperator(totalFee));
                $('#totalAmount').html('<s>N</s>'+thousandSeperator(totalAmount));

            }

            // Attach event listener to checkboxes
            $('.child').on('change', updateTotal);

            // Call once on load to initialize total
            updateTotal();
        });
    </script>

<?php } ?>

<?php if ($page == 'paymentHistory') { ?>
    <div class="detail-container" data-aos="fade-in" data-aos-duration="1300">  
        <div class="chart-div-notifications">
            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification History for </div>

            <div class="text text-right" onclick="selectSearch()">
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
                    <div onclick="srchCustom('Custom Search')">Custom Search</div>
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

        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <thead>
                    <tr class="tb-col">
                        <th>sn</th>
                        <th>Date</th>
                        <th>Payment ID</th>
                        <th>Term</th>
                        <th>Class</th>
                        <th>(₦)Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="tb-row">
                        <td>1</td>
                        <td>2025-02-14 17:03:46</td>
                        <td><span onclick="_getForm({page: 'paymentForm', layer: 2, url: parentPortalLocalUrl});">PAY5964620250203090426</span></td>
                        <td>
                            <div class="text-div">
                                <div>2024/2025</div> 
                                <div>THIRD TERM</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-div">
                                <div>NURSERY 1 A</div>
                            </div>
                        </td>
                        <td><span>₦60,000.00</span></td>
                        <td>DEBIT/CREDIT CARD</td>
                        <td>
                            <div class="status-div SUCCESS">SUCCESS</div>
                        </td>
                    </tr>

                    <tr class="tb-row">
                        <td>2</td>
                        <td>2025-02-12 17:03:46</td>
                        <td><span>PAY5964620250203090431</span></td>
                        <td>
                            <div class="text-div">
                                <div>2024/2025</div> 
                                <div>THIRD TERM</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-div">
                                <div>NURSERY 1 A</div>
                            </div>
                        </td>
                        <td><span>₦120,000.00</span></td>
                        <td>DEBIT/CREDIT CARD</td>
                        <td>
                            <div class="status-div SUCCESS">SUCCESS</div>
                        </td>
                    </tr>

                    <tr class="tb-row">
                        <td>3</td>
                        <td>2025-02-22 17:03:46</td>
                        <td><span>PAY5964620250203090411</span></td>
                        <td>
                            <div class="text-div">
                                <div>2024/2025</div> 
                                <div>THIRD TERM</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-div">
                                <div>NURSERY 1 A</div>
                            </div>
                        </td>
                        <td><span>₦100,000.00</span></td>
                        <td>BANK TRANSFER</td>
                        <td>
                            <div class="status-div SUCCESS">SUCCESS</div>
                        </td>
                    </tr>
                    <tr class="tb-row">
                        <td>4</td>
                        <td>2025-02-15 17:03:46</td>
                        <td><span>PAY5964620250203090427</span></td>
                        <td>
                            <div class="text-div">
                                <div>2024/2025</div> 
                                <div>THIRD TERM</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-div">
                                <div>NURSERY 1 A</div>
                            </div>
                        </td>
                        <td><span>₦10,000.00</span></td>
                        <td>DEBIT/CREDIT CARD</td>
                        <td>
                            <div class="status-div SUCCESS">SUCCESS</div>
                        </td>
                    </tr>

                    <tr class="tb-row">
                        <td>5</td>
                        <td>2025-02-11 17:03:46</td>
                        <td><span>PAY5964620250203090478</span></td>
                       <td>
                            <div class="text-div">
                                <div>2024/2025</div> 
                                <div>THIRD TERM</div>
                            </div>
                        </td>
                        <td>
                            <div class="text-div">
                                <div>NURSERY 1 A</div>
                            </div>
                        </td>
                        <td><span>₦5,000.00</span></td>
                        <td>BANK TRANSFER</td>
                        <td>
                            <div class="status-div PENDING">PENDING</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'accountTransferForm') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> ACCOUNT INFORMATIONS</div>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, Kindly pay the sum of <span><strong><s>N</s>9,125.00</strong></span> to the account details below:</div>
            <h3>ACCOUNT NAME: <span>IKONG EMMANUEL ODO</span></h3>
            <h3>ACCOUNT NUMBER: <span>0247536837</span></h3>
            <h3>BANK NAME: <span>GT BANK</span></h3>
            <p>Contact the admin on <strong>+234-(0)705-3879-522</strong> for payment activation.</p>

            <div class="btn-div">
                <button class="btn" id="submitBtn" title="VIEW PAYMENT HISTORY" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl});"><i class="bi-eye"></i> VIEW PAYMENT HISTORY </button>
                <button class="btn whatsapp-btn" id="submitBtn" title="MESSAGE ADMIN VIA WHATSAPP" onclick=""><i class="bi-whatsapp"></i> </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'logOutConfirmForm') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $websiteUrl?>/images/warning.gif"/></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logOut();">YES</button>
                <button class="btn no-btn" onclick="_alertClose(<?php echo $modalLayer?>);">NO</button>
            </div>
        </div>
    </div>
<?php } ?>

