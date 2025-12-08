<?php if ($page == 'staff') { ?>
    <div class="page-title-back-div other-pages-title-back-div adjusted-title-back-div" data-aos="fade-in"
        data-aos-duration="1500">
        <div class="page-title-div other-pages-title-div">
            <div class="main-title title"><i class="bi-people"></i> <strong>Administrators</strong></div>
            <div class="other-pg-statistics-container" id="statusContent"></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')"
                        placeholder="" title="Type here to serach staff..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search staff...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW STAFF"
                    onclick="_getForm({page: 'staff_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW STAFF
                </button>
            </div>
        </div>
    </div>

    <div class="pages-back-div other-pg-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script>
                    _fetchStaffs();
                </script>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staff_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STAFF</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW STAFF</span>
                    </div>
                </div>

                <div class="cam-pix">
                    <div class="btn-div">
                        <button class="btn" title="Take Staff Picture" onClick="takeSnapShot()"> <i
                                class="bi-camera-fill"></i> TAKE
                            PICTURE </button>

                        <input id="browseImageInput" type="file" style="display:none;"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="staffPixPreview.UpdatePreview(this, 'register');" />

                        <button class="btn" type="button" title="Browse Image"
                            onclick="document.getElementById('browseImageInput').click()">
                            BROWSE IMAGE
                        </button>
                    </div>
                    <div class="cam-pix-inner" id="cam-pix">
                        <img src="<?php echo $websiteUrl ?>/images/sample.jpg" />
                    </div>
                </div>

                <div class="text_field_container" id="titleId_container">
                    <script>
                        selectField({
                            id: 'titleId',
                            title: 'Select Title'
                        });
                        _getSelectTitle('titleId');
                    </script>
                </div>

                <div class="text_field_container" id="firstName_container">
                    <script>
                        textField({
                            id: 'firstName',
                            title: 'First Name'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="middleName_container">
                    <script>
                        textField({
                            id: 'middleName',
                            title: 'Middle Name'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="lastName_container">
                    <script>
                        textField({
                            id: 'lastName',
                            title: 'Last Name'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="emailAddress_container">
                    <script>
                        textField({
                            id: 'emailAddress',
                            title: 'Email Address',
                            type: 'email'
                        });
                    </script>
                </div>

                <div class="text_field_container" id="mobileNumber_container">
                    <script>
                        textField({
                            id: 'mobileNumber',
                            title: 'Phone Number',
                            type: 'tel',
                            onKeyPressFunction: 'isNumberCheck(event);'
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

                <div class="text_field_container" id="dateOfBirth_container">
                    <script>
                        textField({
                            id: 'dateOfBirth',
                            title: 'Date Of Birth',
                            type: 'date'
                        });
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
                            title: 'Home Address'
                        });
                    </script>
                </div>


                <div class="alert alert-success form-alert">
                    <span>ADMINISTRATIVE INFORMATION</span>
                    <div class="text_field_back_container">
                        <div class="text_field_container" id="branchId_container">
                            <script>
                                selectField({
                                    id: 'branchId',
                                    title: 'Select Branch'
                                });
                                _getSelectBranch('branchId');
                            </script>
                        </div>

                        <div class="text_field_container" id="roleId_container">
                            <script>
                                selectField({
                                    id: 'roleId',
                                    title: 'Select Role'
                                });
                                _getSelectRole('roleId');
                            </script>
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
                    </div>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStaff();"> <i class="bi-check"></i>
                        SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staff_profile') { ?>
    <script>
        getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-person-check-fill"></i> STAFF PROFILE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <div class="btn-div">
                        <button class="btn" title="Take Staff Picture" onClick="takeSnapShot('updateStaffPix')">
                             <i class="bi-camera-fill"></i></button>

                        <input id="browseImageInput" type="file" style="display:none;"
                            accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"
                            onchange="staffPixPreview.UpdatePreview(this, 'updateStaffPix');" />

                        <button class="btn" type="button" title="Browse Image"
                            onclick="document.getElementById('browseImageInput').click()">
                            <i class="bi-folder2-open"></i>
                        </button>
                    </div>

                    <div class="img-div" id="cam-pix">
                        <img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/default.jpg" alt="Profile Image">
                    </div>
                    
                    <script>
                        $("#cam-pix").html('<img src="<?php echo $websiteUrl ?>/uploaded_files/staffPix/' +
                            getEachStaffDetailsSession.profilePix + '" alt="Profile Image">');
                    </script>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">
                                    <script>
                                        $("#fullName").html(getEachStaffDetailsSession.titleName + ' ' +
                                            getEachStaffDetailsSession.firstName + ' ' + getEachStaffDetailsSession.lastName
                                        );
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="staffStatusBtn" class="status-btn"><span id="staffStatusName"></span></div>
                                    </div>
                                    | LAST LOGIN DATE:
                                    <strong id="lastLoginTime">
                                        <script>
                                            $("#lastLoginTime").html(getEachStaffDetailsSession.lastLoginTime ?
                                                getEachStaffDetailsSession.lastLoginTime : "00-00-00 00:00:00");
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachStaffDetailsSession.statusName;
                                        $("#staffStatusName").html(statusName);
                                        $("#staffStatusBtn").addClass(statusName);
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
                        <!-- ////// for mobile view -->
                        <li class="li" title="Other Links"><i class="bi-three-dots-vertical"></i>
                            <ul class="ul">

                                <li title="My Students"
                                    onclick="_getActiveStaffPage({divid:'staff_students', page: 'staff_students', url: adminPortalLocalUrl});">
                                    <i class="bi-mortarboard"></i> <span>My Students</span>
                                </li>
                                <li title="Staff Record"><i class="bi-file-spreadsheet"></i> <span>Record</span>
                                    <ul class="ul-expand animated fadeIn" id="recordExpandUl">
                                        <li onclick="_getActiveStaffPage({divid:'staff_students_score_sheet', page: 'staff_students_score_sheet', url: adminPortalLocalUrl});"
                                            title="Score Sheet"><i class="bi-file-spreadsheet"></i>Score Sheet</li>
                                        <li onclick="_getActiveStaffPage({divid:'staff_students_compute_score', page: 'staff_students_compute_score', url: adminPortalLocalUrl});"
                                            title="Compute Score"><i class="bi-file-spreadsheet"></i>Compute Score</li>
                                        <li onclick="_getActiveStaffPage({divid:'staff_students_cummulative_mark', page: 'staff_students_cummulative_mark', url: adminPortalLocalUrl});"
                                            title="Cumulative Mark's Score"><i class="bi-file-spreadsheet"></i>Cumulative
                                            Mark's Book</li>
                                        <script>
                                            if (userRoles.canManageStudentsAttendance) {
                                                $('#recordExpandUl').append(`
                                                <li title="Student Attendance" onclick="_getActiveStaffPage({divid:'staffStudentAttendance', page: 'staffStudentAttendance', url: adminPortalLocalUrl});"><i class="bi-file-spreadsheet"></i>Student Attendance</li>
                                            `);
                                            }
                                            if (userRoles.canManageClassTeachersComments) {
                                                $('#recordExpandUl').append(`
                                                <li title="Class Teacher's Comment" onclick="_getActiveStaffPage({divid:'classTeachersComment', page: 'classTeachersComment', url: adminPortalLocalUrl});"><i class="bi-file-spreadsheet"></i>Class Teacher's Comment</li>
                                            `);
                                            }
                                        </script>

                                    </ul>

                                </li>

                                <li title="Staff Activities"
                                    onclick="_getActiveStaffPage({divid:'staff_activities', page: 'staff_activities', url: adminPortalLocalUrl});">
                                    <i class="bi-bell"></i> <span>Activities</span>
                                </li>
                            </ul>
                        </li>
                        <!-- ////// end for mobile view -->
                        <li class="active" title="Dashboard" id="staff_dashboard"
                            onclick="_getActiveStaffPage({divid:'staff_dashboard', page: 'staff_dashboard', url: adminPortalLocalUrl});">
                            <i class="bi-speedometer2"></i> Dashboard
                        </li>
                        <li class="hide-li" title="My Students" id="staff_students"
                            onclick="_getActiveStaffPage({divid:'staff_students', page: 'staff_students', url: adminPortalLocalUrl});">
                            <i class="bi-mortarboard"></i> My Students
                        </li>

                        <li class="hide-li" title="Staff Record"><i class="bi-file-spreadsheet"></i> Record
                            <ul class="animated fadeIn" id="recordExpandTopUl">
                                <li onclick="_getActiveStaffPage({divid:'staff_students_score_sheet', page: 'staff_students_score_sheet', url: adminPortalLocalUrl});"
                                    title="Score Sheet"><i class="bi-file-spreadsheet"></i>Score Sheet</li>
                                <li onclick="_getActiveStaffPage({divid:'staff_students_compute_score', page: 'staff_students_compute_score', url: adminPortalLocalUrl});"
                                    title="Compute Score"><i class="bi-file-spreadsheet"></i>Compute Score</li>
                                <li onclick="_getActiveStaffPage({divid:'staff_students_cummulative_mark', page: 'staff_students_cummulative_mark', url: adminPortalLocalUrl});"
                                    title="Cumulative Mark's Score"><i class="bi-file-spreadsheet"></i>Cumulative Mark's
                                    Book</li>
                                <script>
                                    if (userRoles.canManageStudentsAttendance) {
                                        $('#recordExpandTopUl').append(`
                                                <li title="Student Attendance" onclick="_getActiveStaffPage({divid:'staffStudentAttendance', page: 'staffStudentAttendance', url: adminPortalLocalUrl});"><i class="bi-file-spreadsheet"></i>Student Attendance</li>
                                            `);
                                    }
                                    if (userRoles.canManageClassTeachersComments) {
                                        $('#recordExpandTopUl').append(`
                                                <li title="Class Teacher's Comment" onclick="_getActiveStaffPage({divid:'classTeachersComment', page: 'classTeachersComment', url: adminPortalLocalUrl});"><i class="bi-file-spreadsheet"></i>Class Teacher's Comment</li>
                                            `);
                                    }
                                </script>
                            </ul>

                        </li>

                        <li title="My Profile" id="staff_profile_details"
                            onclick="_getActiveStaffPage({divid:'staff_profile_details', page: 'staff_profile_details', url: adminPortalLocalUrl});">
                            <i class="bi-person-bounding-box"></i> Staff Profile
                        </li>
                        <li class="hide-li" title="Staff Activities" id="staff_activities"
                            onclick="_getActiveStaffPage({divid:'staff_activities', page: 'staff_activities', url: adminPortalLocalUrl});">
                            <i class="bi-bell"></i> Staff Activities
                        </li>

                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_staff_details">
                    <script>
                        _getActiveStaffPage({
                            divid: 'staff_dashboard',
                            page: 'staff_dashboard',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- For Staffs Modal Pages -->
<?php if ($page == 'staff_dashboard') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-speedometer2"></i> DASHBOARD / </span>SCHOOL -- <span id="dashBranchName">
                <script>
                    $("#dashBranchName").html(getEachStaffDetailsSession?.branchData?.branchName);
                </script>
            </span> <span>/</span> CURRENT SESSION -- <span id="dashSession">
                <script>
                    $("#dashSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="dashTermName">
                <script>
                    $("#dashTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="user-managment-back-div staff-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="user-managment-list staff-managment-list"
            onclick="_getActiveStaffPage({divid:'staff_students', page: 'staff_students', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl ?>/images/student-reg.png" alt="My Students" /></div>
                <div class="text-div">
                    <h3>My Students</h3>
                    <p>Manage student records and class enrollment.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list"
            onclick="_getActiveStaffPage({divid:'staff_students_score_sheet', page: 'staff_students_score_sheet', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div"><img src="<?php echo $websiteUrl ?>/images/score.png" alt="Score Sheet" /></div>
                <div class="text-div">
                    <h3>Score Sheet</h3>
                    <p>Record and review student scores with ease.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list"
            onclick="_getActiveStaffPage({divid:'staff_students_compute_score', page: 'staff_students_compute_score', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/compute.png" alt="Compute Score" />
                </div>
                <div class="text-div">
                    <h3>Compute Score</h3>
                    <p>Automatically calculate student scores.</p>
                </div>
            </div>
        </div>

        <div class="user-managment-list staff-managment-list"
            onclick="_getActiveStaffPage({divid:'staff_students_cummulative_mark', page: 'staff_students_cummulative_mark', url: adminPortalLocalUrl});">
            <div class="inner-div">
                <div class="icon-div">
                    <img src="<?php echo $websiteUrl ?>/images/message.png" alt="Cummulative Mark's Book" />
                </div>
                <div class="text-div">
                    <h3>Cummulative Mark's Book</h3>
                    <p>Keep a complete record of student marks.</p>
                </div>
            </div>
        </div>
        <script>
            if (userRoles.canManageClassTeachersComments) {
                $('.staff-managment-back-div').append(`
            <div class="user-managment-list staff-managment-list" onclick="_getActiveStaffPage({divid:'classTeachersComment', page: 'classTeachersComment', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl ?>/images/timetable.png" alt="Class Teacher's Comment" />
                    </div>
                    <div class="text-div">
                        <h3>Class Teacher's Comment</h3>
                        <p>Add feedback on student performance.</p>
                    </div>
                </div>
            </div>
        `);
            }
            if (userRoles.canManageStudentsAttendance) {
                $('.staff-managment-back-div').append(`
            <div class="user-managment-list staff-managment-list" onclick="_getActiveStaffPage({divid:'staffStudentAttendance', page: 'staffStudentAttendance', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl ?>/images/cbt.png" alt="Student Attendance" />
                    </div>
                    <div class="text-div">
                        <h3>Student Attendance</h3>
                        <p>Track and manage student attendance.</p>
                    </div>
                </div>
            </div>
        `);
            }
        </script>
    </div>
<?php } ?>

<?php if ($page == 'staff_profile_details') { ?>
    <div class="user-in">
        <div class="title">STAFF BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateTitleId_container">
                <script>
                    selectField({
                        id: 'updateTitleId',
                        title: 'Select Title',
                        fieldValue: getEachStaffDetailsSession?.titleId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.titleName ?? ''
                    });
                    _getSelectTitle('updateTitleId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateFirstName_container">
                <script>
                    textField({
                        id: 'updateFirstName',
                        title: 'First Name',
                        value: getEachStaffDetailsSession?.firstName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateMiddleName_container">
                <script>
                    textField({
                        id: 'updateMiddleName',
                        title: 'Middle Name',
                        value: getEachStaffDetailsSession?.middleName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateLastName_container">
                <script>
                    textField({
                        id: 'updateLastName',
                        title: 'Last Name',
                        value: getEachStaffDetailsSession?.lastName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateMobileNumber_container">
                <script>
                    textField({
                        id: 'updateMobileNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        value: getEachStaffDetailsSession?.mobileNumber ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateEmailAddress_container">
                <script>
                    textField({
                        id: 'updateEmailAddress',
                        title: 'Email Address',
                        type: 'email',
                        value: getEachStaffDetailsSession?.emailAddress ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-1" id="updateGenderId_container">
                <script>
                    selectField({
                        id: 'updateGenderId',
                        title: 'Select Gender',
                        fieldValue: getEachStaffDetailsSession?.genderId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.genderName ?? ''
                    });
                    _getSelectGender('updateGenderId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateDateOfBirth_container">
                <script>
                    $(document).ready(function() {
                        const dob = getEachStaffDetailsSession?.dateOfBirth || '';

                        function reverseFormatDate(date) {
                            if (!date) return "";
                            const parts = date.split('/');
                            return `${parts[2]}-${parts[1]}-${parts[0]}`;
                        }

                        textField({
                            id: 'updateDateOfBirth',
                            title: 'Date Of Birth',
                            type: 'date',
                            value: reverseFormatDate(dob)
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">STAFF RESIDENT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="stateId_container">
                <script>
                    selectField({
                        id: 'stateId',
                        title: 'Select Branch State',
                        fieldValue: getEachStaffDetailsSession?.stateId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.stateName ?? ''
                    });
                    _getSelectGeneralState('stateId');
                </script>
            </div>

            <div class="text_field_container col-1" id="lgaId_container">
                <script>
                    selectField({
                        id: 'lgaId',
                        title: 'Select Branch Local Govt Area',
                        fieldValue: getEachStaffDetailsSession?.lgaId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.lgaName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-2" id="updateAddress_container">
                <script>
                    textField({
                        id: 'updateAddress',
                        title: 'Home Address',
                        value: getEachStaffDetailsSession?.address ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">STAFF ACCOUNT INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="staffId_container">
                <script>
                    textField({
                        id: 'staffId',
                        title: 'Staff ID',
                        value: getEachStaffDetailsSession?.staffId ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        value: getEachStaffDetailsSession?.createdTime ?? '',
                        readonly: true
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="lastLogin_container">
                <script>
                    textField({
                        id: 'lastLogin',
                        title: 'Last Login Date',
                        value: getEachStaffDetailsSession?.lastLoginTime ?? '',
                        readonly: true
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">ADMINISTRATIVE INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="updateBranchId_container">
                <script>
                    selectField({
                        id: 'updateBranchId',
                        title: 'Select Branch',
                        fieldValue: getEachStaffDetailsSession?.branchId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.branchName ?? ''
                    });
                    _getSelectBranch('updateBranchId');
                </script>
            </div>

            <div class="text_field_container col-3" id="updateRoleId_container">
                <script>
                    selectField({
                        id: 'updateRoleId',
                        title: 'Select Role',
                        fieldValue: getEachStaffDetailsSession?.roleId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.roleName ?? ''
                    });
                    _getSelectRole('updateRoleId');
                </script>
            </div>

            <div class="text_field_container col-3" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status',
                        fieldValue: getEachStaffDetailsSession?.statusId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.statusName ?? ''
                    });
                    _getSelectStatusId('updateStatusId', '1,2');
                </script>
            </div>
        </div>

        <div class="btn-div" id="staffBtn">
            <script>
                if ((userRoles.canViewSuperAdminDashboard || userRoles.canViewAdministratorDashboard || userRoles.canViewIctStaffDashboard)) {
                    let buttonContent = "";
                    if (userRoles.canChangeStaffPassword) {
                        buttonContent += `
                            <button class="btn change-pass-btn" title="CHANGE STAFF PASSWORD" onclick="_getForm({page: 'changeStaffPassword', layer: 2, url: adminPortalLocalUrl});"> CHANGE PASSWORD <i class="bi-shield-lock"></i></button>
                        `;
                    }
                    if (userRoles.canViewSuperAdminDashboard && getEachStaffDetailsSession?.statusId === '2') {
                        buttonContent += `
                            <button class="btn del-btn" title="DELETE STAFF" id="deleteBtn" onclick="_deleteStaff();"> DELETE STAFF <i class="bi-trash"></i></button>
                        `;
                    }
                    buttonContent += `
                        <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateStaff();"> UPDATE PROFILE <i class="bi-check"></i></button>
                    `;
                    $("#staffBtn").html(buttonContent);
                }
            </script>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staff_activities') { ?>
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

<?php if ($page == 'staff_students') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-people-fill"></i> STUDENT'S LIST / </span> CURRENT SESSION -- <span id="stuSession">
                <script>
                    $("#stuSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="stuTermName">
                <script>
                    $("#stuTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContents">
        <script>
            _fetchStaffSubjectAllocated();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'staff_students_score_sheet') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-grid-3x3"></i> SCORE SHEET / </span> CURRENT SESSION -- <span id="scoreSession">
                <script>
                    $("#scoreSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="scoreTermName">
                <script>
                    $("#scoreTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent2">
        <script>
            _fetchStaffSubjectScoreSheet();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'staff_students_compute_score') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-grid-3x3"></i> COMPUTE SCORE / </span> CURRENT SESSION -- <span id="computeSession">
                <script>
                    $("#computeSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="computeTermName">
                <script>
                    $("#computeTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent3">
        <script>
            _fetchStaffSubjectComputeScores();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'staff_students_cummulative_mark') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-grid-3x3"></i> CUMMULATIVE MARK BOOK / </span> CURRENT SESSION -- <span id="cummSession">
                <script>
                    $("#cummSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="cummTermName">
                <script>
                    $("#cummTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent4">
        <script>
            _fetchStaffSubjectCummulative();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'compute_score_proceed') { ?>
    <script>
        getComputeScoreRecordDetailsSession = JSON.parse(sessionStorage.getItem("getComputeScoreRecordDetailsSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> COMPUTE SCORE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert form-alert">
                        Kindly follow the following instruction below to compute score for students
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Session:</div>
                                    <div><span id="formSession">
                                            <script>
                                                $("#formSession").html(getEachStaffDetailsSession?.branchData?.session);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Term:</div>
                                    <div><span id="formTermName">
                                            <script>
                                                $("#formTermName").html(getEachStaffDetailsSession?.termData?.termName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="departmentName">
                                            <script>
                                                $("#departmentName").html(getComputeScoreRecordDetailsSession?.departmentData
                                                    ?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="className">
                                            <script>
                                                $("#className").html(getComputeScoreRecordDetailsSession?.classData?.className);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Arm:</div>
                                    <div><span id="armName">
                                            <script>
                                                $("#armName").html(getComputeScoreRecordDetailsSession?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Subject:</div>
                                    <div><span id="subjectName">
                                            <script>
                                                $("#subjectName").html(getComputeScoreRecordDetailsSession?.subjectData
                                                    ?.subjectName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="assessmentId_container">
                    <script>
                        selectField({
                            id: 'assessmentId',
                            title: 'Select Computed Assessment'
                        });
                        _getSelectAssessment('assessmentId');
                    </script>
                </div>

                <div class="btn-container compute-btn-container">
                    <button class="btn" title="COMPUTE SCORES" id="submitBtn" onclick="_proceedComputeAssessment();"> <i
                            class="bi-check"></i> COMPUTE SCORES </button>
                    <button class="btn print-btn" title="PRINT ASSESSMENT" id="printBtn"
                        onclick="_printAssessmentPerSubject();"> <i class="bi-printer"></i> PRINT SCORES </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'compute_score_save') { ?>
    <script>
        getComputeScoreStudentDataSession = JSON.parse(sessionStorage.getItem("getComputeScoreStudentDataSession"));
    </script>

    <div class="slide-form-div save-compute-slide-form" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> SAVE COMPUTE SCORE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert compute-form-alert">
                        <span>Kindly input score for each student to complete score computation </span>
                    </div>
                </div>

                <div class="compute-score-back-div" id="fetchStudents">
                    <script>
                        $(document).ready(function() {
                            let text = '';

                            if (getComputeScoreStudentDataSession) {
                                const fetchData = getComputeScoreStudentDataSession?.studentData;
                                const success = getComputeScoreStudentDataSession?.success;

                                if (success === true && fetchData.length > 0) {
                                    for (let i = 0; i < fetchData.length; i++) {
                                        const student = fetchData[i].studentData;
                                        const dept = fetchData[i].departmentData;
                                        const classInfo = fetchData[i].classData;
                                        const arm = fetchData[i].armData;
                                        const score = fetchData[i].assessmentData ? fetchData[i].assessmentData
                                            .markObtained : '';

                                        const fullName =
                                            `${student.surName} ${student.firstName} ${student.otherNames}`;
                                        const passport = student.passport || 'default.jpg';
                                        const studentId = student.studentId;
                                        const fieldId = `score_${studentId}`;

                                        $("#fetchStudents").append(`
                                            <div class="each-compute-score-div">
                                                <div class="inner-score-div">
                                                    <div class="image-div">
                                                        <img src="${studentPixPath}/${passport}" alt="${fullName}"/>
                                                    </div>
                                                    <div class="text-container">
                                                        <div class="text-div">
                                                            <div class="name">${fullName}</div>
                                                            <div>${dept.departmentName} -- ${classInfo.className} ${arm.armName}</div>
                                                        </div>
                                                        <div class="text-field-parent">
                                                            <div class="text_field_container compute-score-text-field" id="${fieldId}_container"></div>
                                                            <input type="hidden" class="student-id-holder" value="${studentId}">
                                                            <div class="text-score">/ <span>${getComputeScoreStudentDataSession?.assessmentTotalScore}</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `);

                                        textField({
                                            id: fieldId,
                                            title: 'Enter Score',
                                            type: 'number',
                                            value: score
                                        });
                                    }
                                }
                            }
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SAVE SCORES" id="submitBtn" onclick="_saveAssessment();">
                        <i class="bi-save"></i> SAVE
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staffStudentAttendance') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-people-fill"></i> CLASS LIST / </span> CURRENT SESSION -- <span id="attenPageSession">
                <script>
                    $("#attenPageSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="attenPageTermName">
                <script>
                    $("#attenPageTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="classPageContent">
        <script>
            _fetchStaffAssignedClasses();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'computeAttendanceSave') { ?>
    <script>
        getStudentAttendanceDataSession = JSON.parse(sessionStorage.getItem("getStudentAttendanceDataSession"));
    </script>

    <div class="slide-form-div save-compute-slide-form" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> COMPUTE STUDENT ATTENDANCE</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert compute-form-alert">
                        <span>Kindly input score for each student to complete Attendance computation </span>
                    </div>
                </div>

                <div class="compute-score-back-div" id="fetchStudents">
                    <script>
                        $(document).ready(function() {
                            let text = '';

                            if (getStudentAttendanceDataSession) {
                                const fetchData = getStudentAttendanceDataSession?.data;
                                const fetchBranchData = getStudentAttendanceDataSession?.branchData;
                                const success = getStudentAttendanceDataSession?.success;

                                if (success === true && fetchData.length > 0) {
                                    for (let i = 0; i < fetchData.length; i++) {
                                        const student = fetchData[i];
                                        const department = fetchData[i].departmentData;
                                        const classInfo = fetchData[i].classData;
                                        const arm = fetchData[i].armData;
                                        const numberOfDaysPresents = fetchData[i].attendanceData ? fetchData[i]
                                            .attendanceData?.numberOfDaysPresents : '';

                                        const fullName = `${student.surName} ${student.firstName}`;
                                        const passport = student.passport || 'default.jpg';
                                        const studentId = student.studentId;
                                        const fieldId = `numberOfDaysPresents_${studentId}`;

                                        $("#fetchStudents").append(`
                                        <div class="each-compute-score-div">
                                            <div class="inner-score-div">
                                                <div class="image-div">
                                                    <img src="${studentPixPath}/${passport}" alt="${fullName}"/>
                                                </div>
                                                <div class="text-container">
                                                    <div class="text-div">
                                                        <div class="name">${fullName}</div>
                                                        <div>${department.departmentName} -- ${classInfo.className} ${arm.armName}</div>
                                                    </div>
                                                    <div class="text-field-parent">
                                                        <div class="text_field_container compute-score-text-field" id="${fieldId}_container"></div>
                                                        <input type="hidden" class="student-id-holder" value="${studentId}">
                                                        <div class="text-score">/ <span>${fetchBranchData.timeSchoolOpened}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `);

                                        textField({
                                            id: fieldId,
                                            title: 'Enter Score',
                                            type: 'number',
                                            onKeyPressFunction: 'isNumberCheck(event);',
                                            value: numberOfDaysPresents
                                        });
                                    }
                                }
                            }
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SAVE SCORES" id="submitBtn" onclick="_saveAttendance();">
                        <i class="bi-save"></i> SAVE
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'classTeachersComment') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-people-fill"></i> CLASS LIST / </span> CURRENT SESSION -- <span id="attenPageSession">
                <script>
                    $("#attenPageSession").html(getEachStaffDetailsSession?.branchData?.session);
                </script>
            </span> <span>/</span> CURRENT TERM -- <span id="attenPageTermName">
                <script>
                    $("#attenPageTermName").html(getEachStaffDetailsSession?.termData?.termName);
                </script>
            </span></div>
    </div>

    <div class="pages-toggle-back-div" id="classPageContent">
        <script>
            _fetchClassTeacherAssignedClasses();
        </script>
    </div>
<?php } ?>

<?php if ($page == 'computeClassTeacherCommentSave') { ?>
    <script>
        getClassTeacherCommentDataSession = JSON.parse(sessionStorage.getItem("getClassTeacherCommentDataSession"));
    </script>

    <div class="slide-form-div save-compute-teachers-comment-slide-form" data-aos="fade-left" data-aos-duration="900">

        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> COMPUTE CLASS TEACHER'S COMMENT</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert compute-form-alert">
                        <span>Kindly input score for each student to complete Class Teacher's Comment computation </span>
                    </div>
                </div>

                <div class="compute-comment-back-div" id="fetchStudents">
                    <script>
                        $(document).ready(function() {
                            let text = '';

                            if (getClassTeacherCommentDataSession) {
                                const fetchData = getClassTeacherCommentDataSession?.data;
                                const fetchBranchData = getClassTeacherCommentDataSession?.branchData;
                                const success = getClassTeacherCommentDataSession?.success;

                                if (success === true && fetchData.length > 0) {
                                    for (let i = 0; i < fetchData.length; i++) {
                                        const student = fetchData[i];
                                        const department = fetchData[i].departmentData;
                                        const classInfo = fetchData[i].classData;
                                        const arm = fetchData[i].armData;
                                        const classTeachersComment = fetchData[i].classTeachersCommentData ? fetchData[i]
                                            .classTeachersCommentData?.classTeachersComment : '';
                                        const suggestedComments = student.suggestedComments || [];

                                        const fullName = `${student.surName} ${student.firstName}`;
                                        const passport = student.passport || 'default.jpg';
                                        const studentId = student.studentId;
                                        const fieldId = `classTeachersComment_${studentId}`;

                                        // Generate the suggested comment radios dynamically
                                        let radioContent = '';
                                        suggestedComments.forEach((comment, index) => {
                                            radioContent += `
                                                <div class="each-radio-div">
                                                    <div class="radio">
                                                        <input type="radio" 
                                                            class="comment-radio" 
                                                            name="suggested_comment_${studentId}" 
                                                            id="suggested_comment_${studentId}_${index}" 
                                                            value="${comment}" 
                                                            data-target="#${fieldId}">
                                                        <div class="border"></div>
                                                    </div>
                                                    <span>${comment}</span>
                                                </div>
                                            `;
                                        });

                                        $("#fetchStudents").append(`
                                            <div class="new-each-compute-score-div">
                                                <div class="new-inner-score-div">
                                                    <div class="top-cont-div">
                                                        <div class="image-div">
                                                            <img src="${studentPixPath}/${passport}" alt="${fullName}"/>
                                                        </div>

                                                        <div class="text-container">
                                                            <div class="text-div">
                                                                <div class="name">${fullName}</div>
                                                                <div>${department.departmentName} -- ${classInfo.className} ${arm.armName} (${student.genderData.genderName})</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="radio-button-back-div">
                                                        ${radioContent}
                                                    </div>

                                                    <div>
                                                        <div class="text_area_container" id="${fieldId}_container"></div>
                                                        <div class="issueText" id="issue_classTeachersComment"></div>
                                                        <input type="hidden" class="student-id-holder" value="${studentId}">
                                                    </div>
                                                </div>
                                            </div>
                                        `);

                                        textField({
                                            id: fieldId,
                                            title: 'Class Teacher\'s Comment',
                                            type: 'textarea',
                                            rows: 2,
                                            value: classTeachersComment
                                        });
                                    }

                                    $(document).on('change', '.comment-radio', function() {
                                        const commentText = $(this).val();
                                        const targetField = $(this).data('target');
                                        const studentGroupName = $(this).attr('name'); // unique per student

                                        // Remove highlight from other radios in same group
                                        $(`input[name='${studentGroupName}']`).closest('.each-radio-div').removeClass('active-radio');

                                        // Highlight selected radio
                                        $(this).closest('.each-radio-div').addClass('active-radio');

                                        // Update textarea text
                                        $(targetField).val(commentText).trigger('input');
                                    });

                                }
                            }
                        });
                    </script>
                </div>

                <div>
                    <button class="btn" title="SAVE CLASS TEACHER'S COMMENT" id="submitBtn" onclick="_saveClassTeachersComment();">
                        <i class="bi-save"></i> SAVE
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='changeStaffPassword'){ ?>
     <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-shield-lock"></i> CHANGE STAFF PASSWORD</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to change your staff password. Please enter sraff new and confirm password below.</div>
            <div class="pswd_info" style="color:#8c8d8d"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>
            <div class="text_field_container" id="newPassword_container">
                <script>
                    textField({
                        id: 'newPassword',
                        title: 'Create New Password',
                        type: 'password'
                    });
                </script> 
            </div>

            <div class="text_field_container" id="cnewPassword_container">
                <script>
                    textField({
                        id: 'cnewPassword',
                        title: 'Confirm New Password',
                        type: 'password'
                    });
                </script> 
            </div>

            <button class="btn" title="CHANGE STAFF PASSWORD" id="changeStaffPasswordBtn" onclick="_changeStaffPassword();"> <i class="bi-check"></i> CHANGE PASSWORD </button>
        </div>
    </div>
<?php } ?>