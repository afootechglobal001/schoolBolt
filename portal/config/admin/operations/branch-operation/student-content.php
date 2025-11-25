<!-- Student Registration Form -->
<?php if ($page == 'branch_student_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STUDENT</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW
                            STUDENT</span></div>
                </div>

                <div class="cam-pix">
                    <div class="btn-div">
                        <button class="btn" title="Take Student Picture" onClick="takeSnapShot()"> <i
                                class="bi-camera-fill"></i> TAKE
                            PICTURE </button>

                        <input id="browseImageInput" type="file" style="display:none;"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="studentPixPreview.UpdatePreview(this, 'register');" />

                        <button class="btn" type="button" title="Browse Image"
                            onclick="document.getElementById('browseImageInput').click()">
                            BROWSE IMAGE
                        </button>
                    </div>
                    <div class="cam-pix-inner" id="cam-pix">
                        <img src="<?php echo $websiteUrl ?>/images/sample.jpg" />
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>STUDENT BASIC INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="surName_container">
                            <script>
                                textField({
                                    id: 'surName',
                                    title: 'SURNAME NAME',
                                    onKeyUpFunction: 'copyTextbox()'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="firstName_container">
                            <script>
                                textField({
                                    id: 'firstName',
                                    title: 'FIRST NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="otherNames_container">
                            <script>
                                textField({
                                    id: 'otherNames',
                                    title: 'OTHER NAMES'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="genderId_container">
                            <script>
                                selectField({
                                    id: 'genderId',
                                    title: 'Select Gender'
                                });
                                _getSelectGender('genderId');
                            </script>
                        </div>

                        <div class="text_field_container" id="maritalStatusId_container">
                            <script>
                                selectField({
                                    id: 'maritalStatusId',
                                    title: 'Select Marital Status'
                                });
                                _getSelectMaritalStatus('maritalStatusId');
                            </script>
                        </div>

                        <div class="text_field_container" id="dateOfBirth_container">
                            <script>
                                textField({
                                    id: 'dateOfBirth',
                                    title: 'Dtae Of Birth',
                                    type: 'date'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="countryId_container">
                            <script>
                                selectField({
                                    id: 'countryId',
                                    title: 'Select Nationality'
                                });
                                _getSelectNationality('countryId');
                            </script>
                        </div>

                        <div class="text_field_container" id="stateId_container">
                            <script>
                                selectField({
                                    id: 'stateId',
                                    title: 'Select State Of Origin',
                                });
                                _getSelectGeneralState('stateId');
                            </script>
                        </div>

                        <div class="text_field_container" id="lgaId_container">
                            <script>
                                selectField({
                                    id: 'lgaId',
                                    title: 'Select Local Govt Area'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="address_container">
                            <script>
                                textField({
                                    id: 'address',
                                    title: 'HOME ADDRESS',
                                    onKeyUpFunction: 'copyTextbox()'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="email_container">
                            <script>
                                textField({
                                    id: 'email',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="mobileNumber_container">
                            <script>
                                textField({
                                    id: 'mobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>FATHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="fatherTitleId_container">
                            <script>
                                selectField({
                                    id: 'fatherTitleId',
                                    title: 'Select Title'
                                });
                                _getSelectTitle('fatherTitleId');
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherSurName_container">
                            <script>
                                textField({
                                    id: 'fatherSurName',
                                    title: 'SURNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherOtherNames_container">
                            <script>
                                textField({
                                    id: 'fatherOtherNames',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherAddress_container">
                            <script>
                                textField({
                                    id: 'fatherAddress',
                                    title: 'HOME ADDRESS'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherEmail_container">
                            <script>
                                textField({
                                    id: 'fatherEmail',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="fatherMobileNumber_container">
                            <script>
                                textField({
                                    id: 'fatherMobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>

                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="fatherDayOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'fatherDayOfBirth',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('fatherDayOfBirth');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="fatherMonthOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'fatherMonthOfBirth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('fatherMonthOfBirth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="fatherOccupation_container">
                            <script>
                                textField({
                                    id: 'fatherOccupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>MOTHER's INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="motherTitleId_container">
                            <script>
                                selectField({
                                    id: 'motherTitleId',
                                    title: 'Select Title'
                                });
                                _getSelectTitle('motherTitleId');
                            </script>
                        </div>

                        <div class="text_field_container" id="motherSurName_container">
                            <script>
                                textField({
                                    id: 'motherSurName',
                                    title: 'SURNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherOtherNames_container">
                            <script>
                                textField({
                                    id: 'motherOtherNames',
                                    title: 'OTHERS NAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherAddress_container">
                            <script>
                                textField({
                                    id: 'motherAddress',
                                    title: 'HOME ADDRESS'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherEmail_container">
                            <script>
                                textField({
                                    id: 'motherEmail',
                                    title: 'EMAIL ADDRESS',
                                    type: 'email'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="motherMobileNumber_container">
                            <script>
                                textField({
                                    id: 'motherMobileNumber',
                                    title: 'PHONE NUMBER',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>

                        <div class="col-back-div">
                            <div class="text_field_container col-1" id="motherDayOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'motherDayOfBirth',
                                        title: 'Select Birth Day'
                                    });
                                    _getSelectBirthDay('motherDayOfBirth');
                                </script>
                            </div>

                            <div class="text_field_container col-1" id="motherMonthOfBirth_container">
                                <script>
                                    selectField({
                                        id: 'motherMonthOfBirth',
                                        title: 'Select Birth Month'
                                    });
                                    _getSelectBirthMonth('motherMonthOfBirth');
                                </script>
                            </div>
                        </div>

                        <div class="text_field_container" id="motherOccupation_container">
                            <script>
                                textField({
                                    id: 'motherOccupation',
                                    title: 'OCCUPATION'
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success form-alert">
                    <span>STUDENT's ACADEMIC INFORMATIONS</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="officialStudentId_container">
                            <script>
                                textField({
                                    id: 'officialStudentId',
                                    title: 'Student Official ID'
                                });
                            </script>
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

                        <div class="text_field_container" id="accommodationId_container">
                            <script>
                                selectField({
                                    id: 'accommodationId',
                                    title: 'Select Accomodation'
                                });
                                _getSelectAccomodation('accommodationId');
                            </script>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status'
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStudent();"> <i class="bi-check"></i>
                        SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Student Profile Modal -->
<?php if ($page == 'student_profile') { ?>
    <script>
        getEachBranchStudentsSession = JSON.parse(sessionStorage.getItem("getEachBranchStudentsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STUDENT PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <div class="btn-div">
                        <button class="btn" title="Take Student Picture" onClick="takeSnapShot('updateStudentPix')">
                             <i class="bi-camera-fill"></i></button>

                        <input id="browseImageInput" type="file" style="display:none;"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="studentPixPreview.UpdatePreview(this, 'updateStudentPix');" />

                        <button class="btn" type="button" title="Browse Image"
                            onclick="document.getElementById('browseImageInput').click()">
                            <i class="bi-folder2-open"></i>
                        </button>
                    </div>

                    <div class="img-div" id="cam-pix">
                        <img src="<?php echo $websiteUrl ?>/uploaded_files/studentPix/default.jpg" alt="Profile Image">
                    </div>

                    <script>
                        $("#cam-pix").html('<img src="<?php echo $websiteUrl ?>/uploaded_files/studentPix/' +
                            getEachBranchStudentsSession?.studentData?.passport + '" alt="Profile Image">');
                    </script>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">
                                    <script>
                                        $("#fullName").html(getEachBranchStudentsSession?.studentData?.surName + ' ' +
                                            getEachBranchStudentsSession?.studentData?.firstName + ' ' +
                                            getEachBranchStudentsSession?.studentData?.otherNames);
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn2" class="status-btn"><span id="statusName2"></span></div>
                                    </div>
                                    | DEPARTMENT:
                                    <strong id="departmentName2">
                                        <script>
                                            $("#departmentName2").html(getEachBranchStudentsSession.departmentData
                                                .departmentName);
                                        </script>
                                    </strong>
                                    | CLASS:
                                    <strong id="className">
                                        <script>
                                            $("#className").html(getEachBranchStudentsSession.classData.className);
                                        </script>
                                    </strong>
                                    | ARM:
                                    <strong id="armName">
                                        <script>
                                            $("#armName").html(getEachBranchStudentsSession.armData.armName);
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName2 = getEachBranchStudentsSession.studentData.statusName;
                                        const passport = getEachBranchStudentsSession.studentData.passport;

                                        $("#statusName2").html(statusName2);
                                        $("#statusBtn2").addClass(statusName2);

                                        const passportUrl = '<?php echo $websiteUrl ?>/uploaded_files/studentPix/' +
                                            passport;
                                        $('#currentUserPassport img').attr('src', passportUrl);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="Student Profile" id="student_profile_details"
                            onclick="_getActiveStudentPage({divid:'student_profile_details', page: 'student_profile_details', url: adminPortalLocalUrl});">
                            <i class="bi-person-bounding-box"></i> Student Profile
                        </li>
                        <li title="Transcript" id="tanscript"
                            onclick="_getActiveStudentPage({divid:'tanscript', page: 'tanscript', url: adminPortalLocalUrl});">
                            <i class="bi-mortarboard"></i> Transcript
                        </li>
                        <li class="hide-li" title="Student Report" id="student_report"
                            onclick="_getActiveStudentPage({divid:'student_report', page: 'student_report', url: adminPortalLocalUrl});">
                            <i class="bi-mortarboard"></i> Student Report
                        </li>
                        <li class="hide-li" title="Student Activities" id="student_activities"
                            onclick="_getActiveStudentPage({divid:'student_activities', page: 'student_activities', url: adminPortalLocalUrl});">
                            <i class="bi-bell"></i> Student Activities
                        </li>
                        <li class="hide-li" id="dotted" title="Student Account"><i class="bi-credit-card"></i> Student
                            Account
                            <ul class="animated fadeIn">
                                <li title="Current Payable Fees" onclick="_fetchStudentCurrentPayableFees();"><i
                                        class="bi-credit-card"></i>Current Payable Fees</li>
                                <li title="Payment History" id="paymentHistory"
                                    onclick="_getActiveStudentPage({divid:'paymentHistory', page: 'paymentHistory', url: adminPortalLocalUrl});">
                                    <i class="bi-clock"></i>Payment History
                                </li>
                            </ul>

                        </li>
                        <li class="li" title="Other Links"><i class="bi-three-dots-vertical"></i>
                            <ul class="ul">
                                <li title="Dashboard"
                                    onclick="_getActiveStudentPage({divid:'student_profile_details', page: 'student_profile_details', url: adminPortalLocalUrl});">
                                    <i class="bi-speedometer2"></i> <span> Dashboard</span>
                                </li>
                                <li title="Transcript" id="tanscript"
                                    onclick="_getActiveStudentPage({divid:'tanscript', page: 'tanscript', url: adminPortalLocalUrl});">
                                    <i class="bi-mortarboard"></i> Transcript
                                </li>
                                <li title="Student Report" id="student_report"
                                    onclick="_getActiveStudentPage({divid:'student_report', page: 'student_report', url: adminPortalLocalUrl});">
                                    <i class="bi-mortarboard"></i> Student Report
                                </li>
                                <li title="Student Activities"
                                    onclick="_getActiveStudentPage({divid:'student_activities', page: 'student_activities', url: adminPortalLocalUrl});">
                                    <i class="bi-bell"></i> <span>Student Activities</span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_student_details">
                    <script>
                        _getActiveStudentPage({
                            divid: 'student_profile_details',
                            page: 'student_profile_details',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- For Student Modal Pages -->
<?php if ($page == 'student_profile_details') { ?>
    <div class="user-in">
        <div class="title">STUDENT BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="surName_container">
                <script>
                    textField({
                        id: 'surName',
                        title: 'Surname',
                        value: getEachBranchStudentsSession?.studentData?.surName ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="firstName_container">
                <script>
                    textField({
                        id: 'firstName',
                        title: 'First Name',
                        value: getEachBranchStudentsSession?.studentData?.firstName ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="otherNames_container">
                <script>
                    textField({
                        id: 'otherNames',
                        title: 'Other Name',
                        value: getEachBranchStudentsSession?.studentData?.otherNames ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="genderId_container">
                <script>
                    selectField({
                        id: 'genderId',
                        title: 'Select Gender',
                        fieldValue: getEachBranchStudentsSession?.studentData?.genderId ?? '',
                        fieldLabel: getEachBranchStudentsSession?.studentData?.genderName ?? ''
                    });
                    _getSelectGender('genderId');
                </script>
            </div>

            <div class="text_field_container col-3" id="maritalStatusId_container">
                <script>
                    selectField({
                        id: 'maritalStatusId',
                        title: 'Select Marital Status',
                        fieldValue: getEachBranchStudentsSession?.studentData?.maritalStatusId ?? '',
                        fieldLabel: getEachBranchStudentsSession?.studentData?.maritalStatusName ?? ''
                    });
                    _getSelectMaritalStatus('maritalStatusId');
                </script>
            </div>

            <div class="text_field_container col-3" id="dateOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const dob = getEachBranchStudentsSession?.studentData?.dateOfBirth || '';

                        function reverseFormatDate(date) {
                            if (!date) return "";
                            const parts = date.split('/');
                            return `${parts[2]}-${parts[1]}-${parts[0]}`;
                        }

                        textField({
                            id: 'dateOfBirth',
                            title: 'Date Of Birth',
                            type: 'date',
                            value: reverseFormatDate(dob)
                        });
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="mobileNumber_container">
                <script>
                    textField({
                        id: 'mobileNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        value: getEachBranchStudentsSession.studentData?.mobileNumber ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="email_container">
                <script>
                    textField({
                        id: 'email',
                        title: 'Email Address',
                        type: 'email',
                        value: getEachBranchStudentsSession.studentData?.email ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">STUDENT RESIDENT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="countryId_container">
                <script>
                    selectField({
                        id: 'countryId',
                        title: 'Select Nationality',
                        fieldValue: getEachBranchStudentsSession.studentData?.countryId ?? '',
                        fieldLabel: getEachBranchStudentsSession.studentData?.countryName ?? ''
                    });
                    _getSelectNationality('countryId');
                </script>
            </div>

            <div class="text_field_container col-1" id="stateId_container">
                <script>
                    selectField({
                        id: 'stateId',
                        title: 'Select State Of Origin',
                        fieldValue: getEachBranchStudentsSession.studentData?.stateId ?? '',
                        fieldLabel: getEachBranchStudentsSession.studentData?.stateName ?? ''
                    });
                    _getSelectGeneralState('stateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="lgaId_container">
                <script>
                    selectField({
                        id: 'lgaId',
                        title: 'Select Local Govt Area',
                        fieldValue: getEachBranchStudentsSession.studentData?.lgaId ?? '',
                        fieldLabel: getEachBranchStudentsSession.studentData?.lgaName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="address_container">
                <script>
                    textField({
                        id: 'address',
                        title: 'HOME ADDRESS',
                        onKeyUpFunction: 'copyTextbox()',
                        value: getEachBranchStudentsSession.studentData?.address ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">FATHER'S INFORMATIONS</div>
        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="fatherTitleId_container">
                <script>
                    selectField({
                        id: 'fatherTitleId',
                        title: 'Select Title',
                        fieldValue: getEachBranchStudentsSession.fatherData?.titleId ?? '',
                        fieldLabel: getEachBranchStudentsSession.fatherData?.titleId ?? ''
                    });
                    _getSelectTitle('fatherTitleId');
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherSurName_container">
                <script>
                    textField({
                        id: 'fatherSurName',
                        title: 'Surname',
                        value: getEachBranchStudentsSession.fatherData?.surName ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherOtherNames_container">
                <script>
                    textField({
                        id: 'fatherOtherNames',
                        title: 'Other Name',
                        value: getEachBranchStudentsSession.fatherData?.otherNames ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherAddress_container">
                <script>
                    textField({
                        id: 'fatherAddress',
                        title: 'Home Address',
                        value: getEachBranchStudentsSession.fatherData?.address ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherEmail_container">
                <script>
                    textField({
                        id: 'fatherEmail',
                        title: 'Email Address',
                        type: 'email',
                        value: getEachBranchStudentsSession.fatherData?.email ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherMobileNumber_container">
                <script>
                    textField({
                        id: 'fatherMobileNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        onKeyPressFunction: 'isNumberCheck(event);',
                        value: getEachBranchStudentsSession.fatherData?.mobileNumber ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherDayOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const fDateOfBirth = getEachBranchStudentsSession.fatherData?.dateOfBirth;

                        let day = '';

                        if (fDateOfBirth && fDateOfBirth.includes('/')) {
                            day = fDateOfBirth.split('/')[0];
                        }

                        selectField({
                            id: 'fatherDayOfBirth',
                            title: 'Select Birth Day',
                            fieldValue: day,
                            fieldLabel: day
                        });
                        _getSelectBirthDay('fatherDayOfBirth');
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherMonthOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const fDateOfBirth = getEachBranchStudentsSession.fatherData?.dateOfBirth;
                        let monthNumber = '';
                        let monthName = '';

                        if (fDateOfBirth && fDateOfBirth.includes('/')) {
                            const parts = fDateOfBirth.split('/');
                            monthNumber = parts[1];
                            const monthNum = parseInt(monthNumber, 10);
                            const monthMap = {
                                1: 'Jan',
                                2: 'Feb',
                                3: 'Mar',
                                4: 'Apr',
                                5: 'May',
                                6: 'Jun',
                                7: 'Jul',
                                8: 'Aug',
                                9: 'Sep',
                                10: 'Oct',
                                11: 'Nov',
                                12: 'Dec'
                            };
                            monthName = monthMap[monthNum] || '';
                        }
                        selectField({
                            id: 'fatherMonthOfBirth',
                            title: 'Select Birth Month',
                            fieldValue: monthNumber,
                            fieldLabel: monthName
                        });
                        _getSelectBirthMonth('fatherMonthOfBirth');
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="fatherOccupation_container">
                <script>
                    textField({
                        id: 'fatherOccupation',
                        title: 'Occuoation',
                        value: getEachBranchStudentsSession.fatherData?.occupation ?? '',
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">MONTHER'S INFORMATIONS</div>
        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="motherTitleId_container">
                <script>
                    selectField({
                        id: 'motherTitleId',
                        title: 'Select Title',
                        fieldValue: getEachBranchStudentsSession.motherData?.titleId ?? '',
                        fieldLabel: getEachBranchStudentsSession.motherData?.titleId ?? ''
                    });
                    _getSelectTitle('motherTitleId');
                </script>
            </div>

            <div class="text_field_container col-3" id="motherSurName_container">
                <script>
                    textField({
                        id: 'motherSurName',
                        title: 'Surname',
                        value: getEachBranchStudentsSession.motherData?.surName ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherOtherNames_container">
                <script>
                    textField({
                        id: 'motherOtherNames',
                        title: 'Other Names',
                        value: getEachBranchStudentsSession.motherData?.otherNames ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherAddress_container">
                <script>
                    textField({
                        id: 'motherAddress',
                        title: 'Home Address',
                        value: getEachBranchStudentsSession.motherData?.address ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherEmail_container">
                <script>
                    textField({
                        id: 'motherEmail',
                        title: 'Email Address',
                        type: 'email',
                        value: getEachBranchStudentsSession.motherData?.email ?? '',
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherMobileNumber_container">
                <script>
                    textField({
                        id: 'motherMobileNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        onKeyPressFunction: 'isNumberCheck(event);',
                        value: getEachBranchStudentsSession.motherData?.mobileNumber ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherDayOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const dateOfBirth = getEachBranchStudentsSession.motherData?.dateOfBirth;

                        let day = '';

                        if (dateOfBirth && dateOfBirth.includes('/')) {
                            day = dateOfBirth.split('/')[0];
                        }

                        selectField({
                            id: 'motherDayOfBirth',
                            title: 'Select Birth Day',
                            fieldValue: day,
                            fieldLabel: day
                        });
                        _getSelectBirthDay('motherDayOfBirth');
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="motherMonthOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const dateOfBirth = getEachBranchStudentsSession.motherData?.dateOfBirth;
                        let monthNumber = '';
                        let monthName = '';

                        if (dateOfBirth && dateOfBirth.includes('/')) {
                            const parts = dateOfBirth.split('/');
                            monthNumber = parts[1];
                            const monthNum = parseInt(monthNumber, 10);
                            const monthMap = {
                                1: 'Jan',
                                2: 'Feb',
                                3: 'Mar',
                                4: 'Apr',
                                5: 'May',
                                6: 'Jun',
                                7: 'Jul',
                                8: 'Aug',
                                9: 'Sep',
                                10: 'Oct',
                                11: 'Nov',
                                12: 'Dec'
                            };
                            monthName = monthMap[monthNum] || '';
                        }
                        selectField({
                            id: 'motherMonthOfBirth',
                            title: 'Select Birth Month',
                            fieldValue: monthNumber,
                            fieldLabel: monthName
                        });
                        _getSelectBirthMonth('motherMonthOfBirth');
                    });
                </script>
            </div>


            <div class="text_field_container col-3" id="motherOccupation_container">
                <script>
                    textField({
                        id: 'motherOccupation',
                        title: 'Occupation',
                        value: getEachBranchStudentsSession.motherData?.occupation ?? '',
                    });
                </script>
            </div>
        </div>
    </div>
    </div>

    <div class="user-in">
        <div class="title">ACADEMICS INFORMATIONS</div>
        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="officialStudentId_container">
                <script>
                    textField({
                        id: 'officialStudentId',
                        title: 'Student Official ID',
                        value: getEachBranchStudentsSession?.officialStudentId ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="accommodationId_container">
                <script>
                    selectField({
                        id: 'accommodationId',
                        title: 'Select Accomodation',
                        fieldValue: getEachBranchStudentsSession.accommodationData?.accommodationId ?? '',
                        fieldLabel: getEachBranchStudentsSession.accommodationData?.accommodationName ?? ''
                    });
                    _getSelectAccomodation('accommodationId');
                </script>
            </div>

            <div class="text_field_container col-3" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department',
                        fieldValue: getEachBranchStudentsSession.departmentData?.departmentId ?? '',
                        fieldLabel: getEachBranchStudentsSession.departmentData?.departmentName ?? ''
                    });
                    _getSelectDepartment('departmentId');
                </script>
            </div>

            <div class="text_field_container col-3" id="classId_container">
                <script>
                    selectField({
                        id: 'classId',
                        title: 'Select Class',
                        fieldValue: getEachBranchStudentsSession.classData?.classId ?? '',
                        fieldLabel: getEachBranchStudentsSession.classData?.className ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="armId_container">
                <script>
                    selectField({
                        id: 'armId',
                        title: 'Select Arm',
                        fieldValue: getEachBranchStudentsSession.armData?.armId ?? '',
                        fieldLabel: getEachBranchStudentsSession.armData?.armName ?? ''
                    });
                </script>
            </div>
        </div>
    </div>
    </div>

    <div class="user-in">
        <div class="title">STUDENT ADMINISTRATIVE INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="studentId_container">
                <script>
                    textField({
                        id: 'studentId',
                        title: 'Student ID',
                        value: getEachBranchStudentsSession?.studentData?.studentId ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        value: getEachBranchStudentsSession?.studentData?.createdTime ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="statusId_container">
                <script>
                    selectField({
                        id: 'statusId',
                        title: 'Select Status',
                        fieldValue: getEachBranchStudentsSession.studentData?.statusId ?? '',
                        fieldLabel: getEachBranchStudentsSession.studentData?.statusName ?? ''
                    });
                    _getSelectStatusId('statusId', '1,2');
                </script>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateBranchStudents();"> UPDATE PROFILE <i
                    class="bi-check"></i></button>
        </div>
    </div>
<?php } ?>

<!-- For Student Activities Page -->
<?php if ($page == 'student_activities') { ?>
    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Notification History for </div>

        <div class="text text-right" onclick="select_search()">
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
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                        </div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
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

    <div class="main-alert-div">
        <div class="system-alert" id="" onclick="_getSecondaryFormWithId('staff_alert_read');">
            <div class="alert-name"><i class="bi-person"></i>Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i>Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i
                        class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...
            </div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>
    </div>
<?php } ?>

<!-- For Student Department, class, arm select -->
<?php if ($page == 'student_select_form') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> VIEW STUDENT</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to view students by
                their <span>Department</span>, <span>Class</span>, and <span>Arm</span>. Please select the
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

            <button class="btn" id="submit_btn" title="Proceed Request" onclick="_proceedFetchBranchStudents();">PROCEED <i
                    class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<!-- For Student Page-->
<?php if ($page == 'branch_student_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-person-bounding-box"></i></span> BRANCH STUDENT'S LIST ---- <span
                id="pageSession">Loading...</span> - <span id="pageTermName">Loading...</span> - <span
                id="departmentName3">Loading...</span> - <span id="className2">Loading...</span> - <span
                id="armName2">Loading...</span></div>
        <div class="btn-container" id="printAndExportButton"></div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _fetchBranchStudents();
            </script>
        </table>
    </div>
<?php } ?>

<!-- For Student Search Page -->
<?php if ($page == 'branch_student_search') { ?>
    <div class="alert alert-success form-alert animated fadeIn">
        <span>Search student by surname, first name, other name, student Id</span>
        <div class="long-search-div">
            <div class="text_field_container search_field_container">
                <input class="text_field student_text_field" type="text" id="q" placeholder=""
                    title="Type here to search students" />
                <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search student</div>
            </div>

            <div>
                <button class="btn" title="SEARCH STUDENTS" onclick="_searchBranchStudents();">
                    <i class="bi-search"></i> SEARCH
                </button>
            </div>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _getSearchStudents();
            </script>
        </table>
    </div>
<?php } ?>

<!-- For Student Transaction History Page -->
<?php if ($page == 'paymentHistory') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-clock"></i></span> STUDENT TRANSACTION HISTORY</div>

        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i>
                EXPORT</button>
        </div>
    </div>

    <div class="chart-div-notifications user-details-notf">
        <div class="text"><i class="bi-graph-up-arrow"></i> Showing Payment History for </div>

        <div class="text text-right" onclick="select_search()">
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
                <div onclick="srch_custom('Custom Search')">Custom Search</div>
            </div>
        </div>

        <div class="text">
            <div class="custom-srch-div">
                <div class="custom-srch-div-in">
                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From
                        </div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to"
                            placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> To</div>
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
        <table class="table" cellspacing="0" style="width:100%" id="pageContent2">
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

            <tbody id="pageContent">
                <!-- CONTENT GOES HERE -->
                <script>
                    _fetchPaymentHistory();
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

<!-- For Student Modal -->
<?php if ($page == 'payableFess') { ?>
    <script>
        studentCurrentPayableFeesSession = JSON.parse(sessionStorage.getItem("studentCurrentPayableFeesSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> STUDENT FEES CONFIGURATION</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Student Details;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Full Name:</div>
                                    <div><span id="studentFullName">
                                            <script>
                                                $("#studentFullName").html(getEachBranchStudentsSession?.studentData?.surName +
                                                    ' ' + getEachBranchStudentsSession?.studentData?.firstName + ' ' +
                                                    getEachBranchStudentsSession?.studentData?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Email:</div>
                                    <div><span id="studentEmail">
                                            <script>
                                                $("#studentEmail").html(getEachBranchStudentsSession?.studentData?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="formDepartmentName">
                                            <script>
                                                $("#formDepartmentName").html(getEachBranchStudentsSession?.departmentData
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
                                                $("#formClassName").html(getEachBranchStudentsSession?.classData?.className);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Arm:</div>
                                    <div><span id="formArmName">
                                            <script>
                                                $("#formArmName").html(getEachBranchStudentsSession?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paid-fee-conatiner">
                    <div class="alert alert-success form-alert">
                        <span>List of Mandatory Fees</span>

                        <div class="alert-list-div" id="mandatoryFees">
                            No record found!
                        </div>
                    </div>
                </div>

                <div class="permission-form-back-div">
                    <div class="title-div">
                        <h4>Select Mandatory Fees for this student</h4>
                        <p>Use the toggles below to select fees applicable to this student. Switching a toggle to "Yes"
                            enables payment for that category.</p>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Fee Categories</div>
                        <div class="fetch-toggle" id="notMandatoryFees">

                            <script>
                                $(document).ready(function() {
                                    let notMandatoryFees = '';
                                    let mandatoryFees = '';

                                    if (studentCurrentPayableFeesSession && studentCurrentPayableFeesSession.data) {
                                        const fetch = studentCurrentPayableFeesSession.data;

                                        for (let i = 0; i < fetch.length; i++) {
                                            const fetchedFess = fetch[i];
                                            const feesId = fetchedFess.feesId;
                                            const feesName = fetchedFess.feesName;
                                            const feesOption = fetchedFess.feesOption;
                                            const isDeletable = fetchedFess.isDeletable;
                                            const NewFeesOption = (feesOption === "FALSE") ? "NOT MANDATORY" : "";
                                            const feesOptionColor = (feesOption === "FALSE") ? "orange-color" : "";
                                            const amount = thousandSeperator(fetchedFess.amount);

                                            if (feesOption === 'FALSE') {
                                                notMandatoryFees += `
                                                <div class="each-toggle-div">
                                                    <div class="sub-back-div">
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

                                                if (isDeletable === 'TRUE') {
                                                    mandatoryFees += `
                                                    <div class="alert-list" title="Delete this mandatory fees">
                                                        <div>${feesName}:</div>
                                                        <div class="span">
                                                            <span><s>N</s>${amount}</span>
                                                            <div class="del-btn" onclick="_deleteMandatoryFees('${feesId}');"><i class="bi-trash"></i></div>
                                                        </div>
                                                    </div>`;
                                                } else {
                                                    mandatoryFees += `
                                                    <div class="alert-list">
                                                        <div>${feesName}:</div>
                                                        <div class="span">
                                                        <span><s>N</s>${amount}</span></div>
                                                    </div>`;
                                                }
                                            }
                                        }
                                        $("#notMandatoryFees").html(notMandatoryFees);
                                        $("#mandatoryFees").html(mandatoryFees !== '' ? mandatoryFees :
                                            'No record found!');
                                        _toggleCheck();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="btn" title="SAVE FEES" id="submitBtn" onclick="_updateStudentMandatoryFess();"> <i
                            class="bi-check"></i> SAVE </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- For Archived Students Page -->
<?php if ($page == 'branch_archived_students') { ?>
    <div class="alert alert-success form-alert animated fadeIn">
        <div class="alert-top-container">
            <span>Archived Students</span>
            <div class="btn-container" id="printAndExportButton"></div>
        </div>

        <div class="long-search-div archived-search-div">
            <div class="text_field_container search_field_container">
                <input class="text_field student_text_field" type="text" id="searchContent" onkeyup="filters('Content');"
                    placeholder="" title="Type here to search students" />
                <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to archived student</div>
            </div>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>
                _fetchBranchArchivedStudents();
            </script>
        </table>
    </div>
<?php } ?>