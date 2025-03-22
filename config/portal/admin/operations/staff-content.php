<?php if ($page == 'staff') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-people"></i> <strong>Administrators</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach staff..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search staff...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW STAFF" onclick="_getForm({page: 'staff_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW STAFF
                </button>
            </div>

        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script>_fetchStaffs();</script>
            </table>
        </div>
    </div>
<?php } ?>


<?php if ($page == 'staff_reg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STAFF</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW STAFF</span></div>
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
                            title: 'Select Branch State',
                        });
                        _getSelectGeneralState('stateId');
                    </script>
                </div>

                <div class="text_field_container" id="lgaId_container">
                    <script>
                        selectField({
                            id: 'lgaId',
                            title: 'Select Branch Local Govt Area'
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
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStaff();"> <i class="bi-check"></i> SUBMIT </button>
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
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="current_user_passport1">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">
                                    <script>
                                        $("#fullName").html(getEachStaffDetailsSession.fullName);
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn"><span id="statusName"></span></div>
                                    </div>
                                    | LAST LOGIN DATE:
                                    <strong id="lastLoginTime">
                                        <script>
                                            $("#lastLoginTime").html(getEachStaffDetailsSession.lastLoginTime ? getEachStaffDetailsSession.lastLoginTime : "00-00-00 00:00:00");
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachStaffDetailsSession.statusName;
                                        $("#statusName").html(statusName);
                                        $("#statusBtn").addClass(statusName);
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <div class="div-in">
                    <ul>
                        <li class="active" title="My Profile" id="staff_profile_details" onclick="_getActiveStaffPage({divid:'staff_profile_details', page: 'staff_profile_details', url: adminPortalLocalUrl});"><i class="bi-person-bounding-box"></i> Staff Profile</li>
                        <li title="My Students" id="staff_students" onclick="_getActiveStaffPage({divid:'staff_students', page: 'staff_students', url: adminPortalLocalUrl});"><i class="bi-mortarboard"></i> My Students</li>
                   
                        <li id="dotted" title="Branch Record"><i class="bi-file-spreadsheet"></i> Record
                            <div class="expand-div expanded animated fadeIn">
                                <ul class="ul-expand">
                                    <li title="Score Sheet"><i class="bi-file-spreadsheet"></i>Score Sheet</li>
                                    <li title="Compute Score"><i class="bi-file-spreadsheet"></i>Compute Score</li>
                                    <li title="Cumulative Mark's Score"><i class="bi-file-spreadsheet"></i>Cumulative Mark's Score</li>
                                    <li title="Student Attendance"><i class="bi-file-spreadsheet"></i>Student Attendance</li>
                                    <li title="Student Attendance"><i class="bi-file-spreadsheet"></i>Class Teacher's  Commemt</li>
                                </ul>
                            </div>
                        </li>

                        <li title="Staff Activities" id="staff_activities" onclick="_getActiveStaffPage({divid:'staff_activities', page: 'staff_activities', url: adminPortalLocalUrl});"><i class="bi-bell"></i> Staff Activities</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_staff_details">
                    <script>
                        _getActiveStaffPage({
                            divid: 'staff_profile_details',
                            page: 'staff_profile_details',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<!-- For Staffs Modal Pages -->
<?php if ($page == 'staff_profile_details') { ?>
    <div class="user-in">
        <div class="title">STAFF BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-3" id="updateFirstName_container">
                <script>
                    textField({
                        id: 'updateFirstName',
                        title: 'First Name',
                        value: getEachStaffDetailsSession?.firstName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="updateMiddleName_container">
                <script>
                    textField({
                        id: 'updateMiddleName',
                        title: 'Middle Name',
                        value: getEachStaffDetailsSession?.middleName ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="updateLastName_container">
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
        <div class="btn-div">
            <button class="btn" title="UPDATE PROFILE" id="updateBtn" onclick="_updateStaff();"> UPDATE PROFILE <i class="bi-check"></i></button>
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
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-from" placeholder="" />
                        <div class="placeholder dash_placeholder bar_cust_placeholder"><i class="bi-calendar3"></i> From</div>
                    </div>

                    <div class="text_field_container dash_field_container">
                        <input class="text_field dash_text_field bar_cust_text_field" type="text" id="datepickers-to" placeholder="" />
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
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i>Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>

        <div class="system-alert" id="" onClick="_get_form_with_id()">
            <div class="alert-name"><i class="bi-person"></i> Hon. Emmanuel Paul <span id="<?php //echo $alert_id; 
                                                                                            ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: A customer with whose name is EMMANUEL PAUL have cancelled a trans...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div>
    </div>
<?php } ?>