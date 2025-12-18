<?php if ($page == 'otpVerificationForm') { ?>
    <script> parentProceedLoginSession = JSON.parse(sessionStorage.getItem("parentProceedLoginSession"));</script>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-fill-lock"></i> OTP AUTHENTICATION</div>
            <button class="close-btn" onclick="_alertClose();" title="Close"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hi, <span id="parentFullname"><script>$("#parentFullname").html(parentProceedLoginSession.parentFullname);</script></strong></span>, an <span>OTP</span> has been sent to your email address (<span id="email"><script>$("#email").html(parentProceedLoginSession.email);</script></span>) to login. Kindly check your <strong>INBOX</strong> or <strong>SPAM</strong> to confirm.</div>
            <div class="text_field_container" id="otp_container">
                <script>
                    textField({
                        id: 'otp',
                        title: 'Enter OTP',
                        type: 'number',
                        onKeyPressFunction: 'isNumberCheck(event);'
                    });
                </script> 
            </div>

            <div class="btn-div">
                <button class="btn" id="submitBtn" title="PROCEED" onclick="_proceedToLogin();"> PROCEED <i class="bi-arrow-right"></i></button>
            </div>
            <div id="resendCountdown">Resend in <strong id="timer">30</strong> Sec</div>
            <div>
                <button class="resendOtpBtn" id="resendOtpBtn" onclick="_confirmLoginEmail(true);"><strong>Resend OTP</strong></button>
            </div>
        </div>
    </div>
    <script>_counDownOtp(30)</script>
<?php } ?>

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
                                    SESSION:<strong id="headerCurrentSession"><script>$("#headerCurrentSession").html(getEachStudentSession.branchData.currentSession);</script></strong> | 
                                    TERM:<strong id="headerCurrentTerm"><script>$("#headerCurrentTerm").html(getEachStudentSession.branchData.termData.currentTerm);</script></strong> | 
                                    CLASS:<strong id="headerClass"><script>$("#headerClass").html(getEachStudentSession.classData.className+' '+getEachStudentSession.armData.armName);</script></strong>
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
                        <li title="Time Table" id="timeTable" onclick=""><i class="bi-bell"></i> Time Table</li> -->
                        <li title="View Result"  class="hide-li" id="studentResult" onclick="_getActiveStudentPage({divid: 'studentResult', page: 'studentResult', url: parentPortalLocalUrl});"><i class="bi-printer"></i> View Result</li>
                        <!-- <li title="Assignment" id="assignment" onclick=""><i class="bi-bell"></i> Assignment</li> -->
                        <li title="Other Links"><i class="bi-three-dots-vertical"></i>
                            <ul>
                                <li title="Dashboard" class="active" onclick="_getActiveStudentPage({divid: 'studentDashbaord', page: 'studentDashbaord', url: parentPortalLocalUrl});"><i class="bi-speedometer2"></i> <span>Dashboard</span></li>
                                <li title="Student Profile" onclick="_getActiveStudentPage({divid: 'studentProfile', page: 'studentProfile', url: parentPortalLocalUrl});"><i class="bi-person-lines-fill"></i> <span>Student Profile</span></li>
                                <li title="Pay Fees" onclick="_fetchFeesToPay();"><i class="bi-credit-card-2-back"></i> <span>Pay Fees</span></li>
                                <li title="Payment History" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl});"><i class="bi-clock-history"></i> <span>Payment History</span></li>
                                <li title="View Result" id="studentResult" onclick="_getActiveStudentPage({divid: 'studentResult', page: 'studentResult', url: parentPortalLocalUrl});"><i class="bi-printer"></i> <span>View Result</span></li>
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

        <!-- <div class="card-div inactive-card-div" title="Attendance" onclick="">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/attendance.jpg" alt="Attendance"></div>
            <div class="text">Attendance</div>
        </div>

        <div class="card-div inactive-card-div" title="Time Table" onclick="">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/time-table.png" alt="Time Table"></div>
            <div class="text">Time Table</div>
        </div>

        <div class="card-div inactive-card-div" title="Assignment" onclick="">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/assignment.jpg" alt="Assignment"></div>
            <div class="text">Assignment</div>
        </div> -->

        <div class="card-div" title="View Result" id="studentResult" onclick="_getActiveStudentPage({divid: 'studentResult', page: 'studentResult', url: parentPortalLocalUrl});">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/print-result.jpg" alt="View Result"></div>
            <div class="text">View Result</div>
        </div>

        <!-- <div class="card-div inactive-card-div" title="Transcript" onclick="">
            <div class="pix"><img src="<?php echo $websiteUrl?>/images/transcript.jpg" alt="Transcript"></div>
            <div class="text">Transcript</div>
        </div> -->
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
                    <div id="className"><script>$("#className").html(getEachStudentSession.classData.className+' '+getEachStudentSession.armData.armName);</script></div>
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
                                <div><span id="formCurrentSession"><script>$("#formCurrentSession").html(getPayFeesToPaySession.currentSession);</script></span></div>
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

                        <div class="alert-list-div" id="paidFees">
                            No record found!
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
                        <div class="fetch-toggle" id="notPaidFees">

                            <script>
                                $(document).ready(function() {
                                    let notPaidFees = '';
                                    let paidFees = '';

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
                                            const paid = fetchedFess.paid;

                                            if (paid==='FALSE'){
                                                notPaidFees += `
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
                                        $("#paidFees").html(paidFees!=='' ? paidFees : 'No record found!');
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
                    <button class="btn" title="Make Payment" id="submitBtn" onclick="_proceedToPayment();"> <i class="bi-check"></i> MAKE PAYMENT </button>
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
                <script>_fetchPaymentHistory();</script>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'accountTransferForm') { ?>
    <script> studentPaymentSession = JSON.parse(sessionStorage.getItem("studentPaymentSession"));</script>
    <script> parentSessionData = JSON.parse(sessionStorage.getItem("parentSessionData"));</script>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> ACCOUNT INFORMATIONS</div>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, <strong id="loginUsername"><script>$("#loginUsername").html(parentSessionData.parentData.titleId+' '+parentSessionData.parentData.surName +' '+parentSessionData.parentData.otherNames);</script></strong>, Kindly pay the sum of <span><strong id="amount"><script>$("#amount").html('<s>N</s>'+thousandSeperator(studentPaymentSession.amount));</script></strong></span> to the account details below:</div>
            <div class="text">ACCOUNT NAME: <strong id="accountName"><script>$("#accountName").html(studentPaymentSession.accountName);</script></strong></div>
            <div class="text">ACCOUNT NUMBER: <strong id="accountNumber"><script>$("#accountNumber").html(studentPaymentSession.accountNumber);</script></strong></div>
            <div class="text">BANK NAME: <strong id="bankName"><script>$("#bankName").html(studentPaymentSession.bankName);</script></strong></div>
            <p>Contact the admin on <strong id="branchNumber"><script>$("#branchNumber").html(studentPaymentSession.branchNumber);</script></strong> for payment activation.</p>

            <div class="btn-div">
                <button class="btn" id="submitBtn" title="VIEW PAYMENT HISTORY" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl}); _alertClose(2)"><i class="bi-eye"></i> VIEW PAYMENT HISTORY </button>
                <a id="callLink" href="tel:" title="Call Customer Care">
                <button class="btn whatsapp-btn" id="submitBtn" title="PLACE A CALL ON THIS NUMBER" onclick=""><i class="bi-telephone-outbound-fill"></i> </button></a>
            </div>
        </div>
    </div>

    <script>
        // Set the href attribute with the phone number
        $("#callLink").attr("href", "tel:" + studentPaymentSession.branchNumber);
    </script>
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

<?php if ($page == 'payemntSuccessForm') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $websiteUrl?>/images/success.gif"/></div>
            <h2>PAYMENT SUCCESSFUL</h2>
            <div class="btn-div">
                <button class="btn done-btn" onclick="_getActiveStudentPage({divid: 'paymentHistory', page: 'paymentHistory', url: parentPortalLocalUrl}); _alertClose(2)">DONE</button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'studentResult') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-person-bounding-box"></i> STUDENT CLASS LIST</span>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>_fetchStudentClasses()</script>
    </div>
<?php } ?>