<?php if ($page == 'administratorsPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-people"></i></div>
            </div>
            <div class="text-div">
                <h3>Administrators</h3>
                <p>Manage administrator accounts with ease. Assign roles, control access, and oversee activities to keep operations secure and well-organized.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersStaffs(this.value);" placeholder="Search Staff Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW STAFF" onclick="_getForm({page: 'staffReg', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW STAFF
            </button>
        </div>
    </div>

    <div class="main-content-div no-padding-bottom-content" data-aos="fade-in" data-aos-duration="1500">
        <div class="pages-statistics-wrapper">
            <div class="report-statistics-back-div">
                <div class="report-statistics-div" title="Total Staff">
                    <div class="statistics-inner-div">
                        <div class="icon-div secondary">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Total Staff</p>
                            <span>All registered staff members</span>
                            <h2 id="totalStaff">2</h2>
                        </div>
                    </div>
                </div>

                <div class="report-statistics-div" title="Active Staff">
                    <div class="statistics-inner-div">
                        <div class="icon-div active">
                            <i class="bi bi-person-check-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Active Staff</p>
                            <span>Currently active staff accounts</span>
                            <h2 id="activeStaff">2</h2>
                        </div>
                    </div>
                </div>

                <div class="report-statistics-div" title="Suspended Staff">
                    <div class="statistics-inner-div">
                        <div class="icon-div success">
                            <i class="bi bi-person-x-fill"></i>
                        </div>

                        <div class="report-statistics-text">
                            <p>Suspended Staff</p>
                            <span>Staff accounts under suspension</span>
                            <h2 id="suspendedStaff">0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-people"></i>
                    <p>Administrators</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>User Name</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Last Login</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="staffContent">
                            <script>
                                _fetchStaffData();
                            </script>

                            <tr>
                                <td colspan="20">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div id="staffContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staffReg') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-person-bounding-box"></i></div>
                <h3>CREATE NEW STAFF</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <!-- /////////// Title ////////////////////////////// -->
        <div class="container-back-div">
            <div class="form-notification">
                <p>You are about to create a new staff. Please complete the form below with accurate details to successfully create new staff.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-person-bounding-box"></i>
                            <p>Basic Information</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="firstName_container">
                            <script>
                                textField({
                                    id: 'firstName',
                                    title: 'First Name'
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

                        <div class="text_field_container" id="phoneNumber_container">
                            <script>
                                textField({
                                    id: 'phoneNumber',
                                    title: 'Phone Number',
                                    type: 'tel',
                                    onKeyPressFunction: 'isNumberCheck(event);'
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-person-bounding-box"></i>
                            <p>Administrative Information</p>
                        </div>
                    </div>

                    <div class="form-container">
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
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createStaff();"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'staffProfile') { ?>
    <script>
        getEachStaffDetailsSession = JSON.parse(sessionStorage.getItem("getEachStaffDetailsSession"));
    </script>

    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-person-check-fill"></i></div>
                <h3 id="pageTitle">STAFF PROFILE</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="">
                            <img src="<?php echo $websiteUrl ?>/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                    </label>

                    <div class="text-back-div">
                        <div class="inner-text">
                            <div class="text-div">
                                <div class="name" id="fullName">
                                    <script>
                                        $("#fullName").html(getEachStaffDetailsSession?.firstName + " " + getEachStaffDetailsSession?.lastName);
                                    </script>
                                </div>

                                <div class="text">
                                    <div>
                                        <div id="statusBtn" class="status-btn"><span id="statusName"></span></div>
                                    </div>
                                    | LAST LOGIN DATE:
                                    <strong id="lastLoginTime">
                                        <script>
                                            $("#lastLoginTime").html(getEachStaffDetailsSession?.lastLoginTime ? getEachStaffDetailsSession?.lastLoginTime : "00-00-00 00:00:00");
                                        </script>
                                    </strong>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        const statusName = getEachStaffDetailsSession?.statusData?.statusName;
                                        $("#statusName").html(statusName);
                                        $("#statusBtn").addClass(statusName);
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
                        <li class="active" title="My Profile" id="staffProfileDetails" onclick="_getActiveStaffPage({divid:'staffProfileDetails', page: 'staffProfileDetails', url: adminPortalMiddlewareUrl});"><i class="bi-person-bounding-box"></i> Staff Profile</li>
                    </ul>
                </div>
            </div>

            <div class="field-back-div">
                <div class="field-inner-div" id="get_staff_details">
                    <script>
                        _getActiveStaffPage({
                            divid: 'staffProfileDetails',
                            page: 'staffProfileDetails',
                            url: adminPortalMiddlewareUrl
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- For Staffs Modal Pages -->
<?php if ($page == 'staffProfileDetails') { ?>
    <div class="user-in">
        <div class="title">STAFF BASIC INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateFirstName_container">
                <script>
                    textField({
                        id: 'updateFirstName',
                        title: 'First Name',
                        value: getEachStaffDetailsSession?.firstName ?? ''
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

            <div class="text_field_container col-1" id="updatePhoneNumber_container">
                <script>
                    textField({
                        id: 'updatePhoneNumber',
                        title: 'Phone Number',
                        type: 'tel',
                        value: getEachStaffDetailsSession?.phoneNumber ?? '',
                        onKeyPressFunction: 'isNumberCheck(event);'
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
                        readonly: true,
                        value: getEachStaffDetailsSession?.staffId ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="createdTime_container">
                <script>
                    textField({
                        id: 'createdTime',
                        title: 'Date Of Registration',
                        readonly: true,
                        value: getEachStaffDetailsSession?.createdTime ?? ''
                    });
                </script>
            </div>

            <div class="text_field_container col-3" id="lastLogin_container">
                <script>
                    textField({
                        id: 'lastLogin',
                        title: 'Last Login Date',
                        readonly: true,
                        value: getEachStaffDetailsSession?.lastLoginTime ?? ''
                    });
                </script>
            </div>
        </div>
    </div>

    <div class="user-in">
        <div class="title">ADMINISTRATIVE INFORMATION</div>

        <div class="profile-segment-div">
            <div class="text_field_container col-1" id="updateRoleId_container">
                <script>
                    selectField({
                        id: 'updateRoleId',
                        title: 'Select Role',
                        fieldValue: getEachStaffDetailsSession?.roleData?.roleId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.roleData?.roleName ?? ''
                    });
                    _getSelectRole('updateRoleId');
                </script>
            </div>

            <div class="text_field_container col-1" id="updateStatusId_container">
                <script>
                    selectField({
                        id: 'updateStatusId',
                        title: 'Select Status',
                        fieldValue: getEachStaffDetailsSession?.statusData?.statusId ?? '',
                        fieldLabel: getEachStaffDetailsSession?.statusData?.statusName ?? ''
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