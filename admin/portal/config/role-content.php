<?php if ($page == 'userConfiguration') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-gear"></i></div>
            </div>
            <div class="text-div">
                <div class="back-div"><span id="settingsPage" title="Click to return to System Settings" onclick="_getActivePage({page:'settingsPage', divid:'settingsPage'});"><i class="bi-arrow-left"></i>System Settings /</span> Role And Permissions</div>
                <h3>Roles And Permissions</h3>
                <p>Manage user roles and permissions effortlessly. Control system privileges, and maintain secure operations.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" id="searchContent" onkeyup="_filtersRoles(this.value);" placeholder="Search Role Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW ROLE" onclick="sessionStorage.removeItem('getEachRoleDetails'); _getForm({page: 'roleReg', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW ROLE
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-gear"></i>
                    <p>Roles And Permission</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="role-list-back-div" id="rolesContent">
                    <script>_fetchRolesData();</script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'roleReg') { ?>
    <script>
        getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
        $('#pageTitle').html(getEachRoleDetails?.roleId ? 'UPDATE USER ROLE' : 'ADD NEW USER ROLE');
        $('#subTitle, #subTitle2').html(getEachRoleDetails?.roleId ? 'update this role' : 'create new role');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-people"></i></div>
                <h3 id="pageTitle">ADD A NEW ROLE</h3>
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
                <p>You are about to <span id="subTitle"></span>. Please complete the form below with accurate details to successfully <span id="subTitle2"></span>.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-people"></i>
                            <p>Create Role</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="roleName_container">
                            <script>
                                textField({
                                    id: 'roleName',
                                    title: 'Role Name',
                                    value: getEachRoleDetails?.roleName ?? ''
                                });
                            </script>
                        </div>

                        <div class="text_area_container" id="roleDescription_container">
                            <script>
                                textField({
                                    id: 'roleDescription',
                                    title: 'Role Description',
                                    type: 'textarea',
                                    value: getEachRoleDetails?.roleDescription ?? ''
                                });
                            </script>
                        </div>

                        <div class="permission-form-back-div">
                            <div class="title-div">
                                <h4>Permissions</h4>
                                <p>Every user has a default permission to view dashboard overview. You can customized other settings and permissions based on individual privileges</p>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Dashboard Permissions</div>
                                <div class="fetch-toggle" id="dashboard"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Administrative Permissions</div>
                                <div class="fetch-toggle" id="administrative"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Services Permissions</div>
                                <div class="fetch-toggle" id="services"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Portfolio Permissions</div>
                                <div class="fetch-toggle" id="portfolio"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Publish Permissions</div>
                                <div class="fetch-toggle" id="blog"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">FAQ Permissions</div>
                                <div class="fetch-toggle" id="faq"></div>
                            </div>

                            <div class="permission-toggle-div">
                                <div class="toggle-title">Review Permissions</div>
                                <div class="fetch-toggle" id="review"></div>
                            </div>
                            <script>
                                _fetchRolePermissions();
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateRole();"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'updateRole') { ?>
    <script>
        getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-people"></i></div>
                <h3 id="roleName">
                    <script>
                        $("#roleName").html(getEachRoleDetails?.roleName);
                    </script>
                </h3>
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
                <div class="title">Role Description</div>
                <p id="roleDescription">
                    <script>
                        $("#roleDescription").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails?.roleDescription));
                    </script>
                </p>
            </div>

            <div id="user-details">
                <div class="main-content-div form-main-content-div">
                    <div class="tables-content-div form-table-content-div">
                        <div class="content-title">
                            <div class="title">
                                <i class="bi bi-people"></i>
                                <p>Permissions</p>
                            </div>
                        </div>

                        <div class="form-container">
                            <div class="fetched-permission-back-div">
                                <div id="fetchedPermission">
                                    <script>
                                        $(document).ready(function() {
                                            let text = '';

                                            for (let i = 0; i < getEachRoleDetails?.rolePermissions.length; i++) {
                                                const rolePermissionName = getEachRoleDetails?.rolePermissions[i]?.rolePermissionName;

                                                text +=
                                                    `<div class="fetched-permission-div">
                                                    <span>${rolePermissionName}</span>
                                                </div>`;
                                            }
                                            $("#fetchedPermission").html(text);
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                        <div class="details-div">
                            <div class="details-list">
                                <div class="title">Created By:</div>
                                <div class="each-details-back-list">
                                    <div class="each-details-list">
                                        <div>Full Name:</div>
                                        <span id="fullName">
                                            <script>
                                                $("#fullName").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails?.createdBy[0].fullname));
                                            </script>
                                        </span>
                                    </div>

                                    <div class="each-details-list">
                                        <div>Email Address:</div>
                                        <span id="emailAddress">
                                            <script>
                                                $("#emailAddress").html(getEachRoleDetails?.createdBy[0].emailAddress);
                                            </script>
                                        </span>
                                    </div>

                                    <div class="each-details-list">
                                        <div>Date Created:</div>
                                        <span id="createdTime">
                                            <script>
                                                $("#createdTime").html(getEachRoleDetails?.createdTime);
                                            </script>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="details-list">
                                <div class="title">Updated By:</div>
                                <div class="each-details-back-list">
                                    <div class="each-details-list">
                                        <div>Full Name:</div>
                                        <span id="fullName2">
                                            <script>
                                                $("#fullName2").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails?.updatedBy[0]?.fullname ?? ''));
                                            </script>
                                        </span>
                                    </div>

                                    <div class="each-details-list">
                                        <div>Email Address:</div>
                                        <span id="emailAddress2">
                                            <script>
                                                $("#emailAddress2").html(getEachRoleDetails?.updatedBy[0]?.emailAddress ?? '');
                                            </script>
                                        </span>
                                    </div>

                                    <div class="each-details-list">
                                        <div>Date Updated:</div>
                                        <span id="updatedTime">
                                            <script>
                                                $("#updatedTime").html(getEachRoleDetails?.updatedTime);
                                            </script>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div" id="btnDiv">
                <script>
                    $(document).ready(function() {
                        let showButton = '';
                        showButton =
                            `<button class="btn" title="Edit User Role" id="edit_btn" onclick="_getForm({page: 'roleReg', url: portalMiddleWareUrl});">
                                        <i class="bi-check"></i> Edit User Role
                                    </button>`;
                        if (getEachRoleDetails?.userCount === 0) {
                            showButton +=
                                `<button class="btn delete-btn" title="Delete User Role" id="delete_btn_${getEachRoleDetails?.roleId}" onclick="_deleteRole('${getEachRoleDetails?.roleId}');">
                                        <i class="bi-trash3"></i> Delete User Role
                                    </button>`;
                        }

                        $("#btnDiv").html(showButton);
                    });
                </script>
            </div>
        </div>
    </div>
<?php } ?>