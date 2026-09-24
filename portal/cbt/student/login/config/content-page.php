<?php if ($page == 'loginPage') { ?>
    <div class="form-div" data-aos="fade-in" data-aos-duration="1600">
        <div class="top-div">
            <h1>👋 Hello Student<br><span>Welcome to Your CBT Exam</span></h1>
        </div>

        <div class="inner-form" id="viewLogin">
            <div class="alert alert-success login-form-alert">
                Kindly, provide your <span>Student ID</span> to Proceed
            </div>

            <div class="text_field_container" id="studentId_container">
                <script>
                    textField({
                        id: 'studentId',
                        title: 'Student ID'
                    });
                </script>
            </div>

            <button class="btn" title="Proceed" id="proceedLoginBtn" onclick="_getStudentNextPage({page:'verifyStudentPage'});">Proceed
                <i class="bi bi-arrow-right-circle"></i></button>
        </div>
        <p><span onclick="_goBack();"><i class="bi-arrow-left"></i> Go Back</span></p>
    </div>
<?php } ?>

<?php if ($page == 'verifyStudentPage') { ?>
    <div class="form-div" data-aos="fade-in" data-aos-duration="1600">
        <div class="top-div">
            <h1>✅ Student Verification<br><span>Verify your details and select an exam type</span></h1>
        </div>

        <div class="inner-form" id="viewLogin">
            <div class="alert alert-success login-form-alert">
                <div class="alert-list-div">
                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Student Name:</div>
                            <div>
                                <strong id="studentName">
                                    Paul Emmanuel
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Branch:</div>
                            <div>
                                <strong id="branchName">
                                    AFOOTECH GLOBAL INTERNATIONAL BASIC SCHOOL
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Department:</div>
                            <div>
                                <strong id="departmentName">
                                    KINDERGARTEN
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Class:</div>
                            <div>
                                <strong id="className">
                                    KG
                                </strong>
                            </div>
                        </div>
                    </div>

                    <div class="alert-list-back-div">
                        <div class="alert-list">
                            <div>Arm:</div>
                            <div>
                                <strong id="armName">
                                    A
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
                </script>
            </div>

            <button class="btn" title="Login" id="proceedLoginBtn" onclick="window.parent.location.href = cbtStudentPortalUrl;">Login
                <i class="bi bi-arrow-right-circle"></i></button>
        </div>
        <p><span onclick="_getStudentNextPage({page:'loginPage'});"><i class="bi-arrow-left"></i> Go Back</span></p>
    </div>
<?php } ?>