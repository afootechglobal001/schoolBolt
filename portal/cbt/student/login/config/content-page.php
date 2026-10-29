<?php if ($page == 'loginPage') { ?>
    <script>verifyStudentLoginSessionData = JSON.parse(sessionStorage.getItem("verifyStudentLoginSessionData") || "{}");</script>

    <div class="form-div"  data-aos="fade-in" data-aos-duration="1600">
        <div class="top-div">
            <h1>👋 Hello Student<br><span>Welcome to Your CBT Exam</span></h1>
        </div>

        <div class="inner-form" id="verifyForm">
            <div class="alert alert-success login-form-alert">
                Kindly, provide your <span>Student ID</span> to Proceed
            </div>

            <div class="text_field_container" id="studentId_container">
                <script>
                    textField({
                        id: 'studentId',
                        title: 'Student ID',
                        value: verifyStudentLoginSessionData?.studentData?.studentId ?? ""
                    });
                </script>
            </div>

            <button class="btn" title="Proceed" id="proceedBtn" onclick="_proceedVerifyStudentLogin();">Proceed
                <i class="bi bi-arrow-right-circle"></i></button>
        </div>
        <p><span onclick="_goBack();"><i class="bi-arrow-left"></i> Go Back</span></p>
    </div>
<?php } ?>

<?php if ($page == 'verifyStudentPage') { ?>
    <script>
        $(document).ready(function () {
            verifyStudentLoginSessionData = JSON.parse(sessionStorage.getItem("verifyStudentLoginSessionData") || "{}");
            if (!verifyStudentLoginSessionData) {
                window.parent.location.href = cbtStudentLoginUrl;
                return;
            }
        });
    </script>
    <div class="form-div"  data-aos="fade-in" data-aos-duration="1600">
        <div class="top-div">
            <h1>✅ Student Verification<br><span>Verify your details and select an exam type</span></h1>
        </div>

        <div class="inner-form" id="loginForm">
            <div class="alert alert-success login-form-alert">
                <div class="alert-list-div">
                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Student Name:</div>
                            <div>
                                <strong id="studentName">
                                    <script>$("#studentName").html(verifyStudentLoginSessionData?.studentData?.fullName ?? "");</script>
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Branch:</div>
                            <div>
                                <strong id="branchName">
                                    <script>$("#branchName").html(verifyStudentLoginSessionData?.branchData?.branchName ?? "");</script>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text_field_container" id="cbtId_container">
                <script>
                    selectField({
                        id: 'cbtId',
                        title: 'Select Exam Type'
                    });
                    _getSelectStudentExamType("cbtId");
                </script>
            </div>

            <button class="btn" title="Login" id="loginBtn" onclick="_proceedStudentLogin();">Login
                <i class="bi bi-arrow-right-circle"></i></button>
        </div>
        <p><span onclick="_getStudentNextPage({page:'loginPage'});"><i class="bi-arrow-left"></i> Go Back</span></p>
    </div>
<?php } ?>