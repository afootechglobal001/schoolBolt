<?php if($page=='user-role-configuration'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="back-div"><span onclick="_getActivePage({page:'settings'});"><i class="bi-arrow-left"></i> System Settings</span> Role And Permissions</div>
            <div class="main-title title"><i class="bi-gear"></i> <strong>Roles And Permissions</strong></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach role..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search role...</div>
                </div>
            </div>
            
            <div class="btn-div">
                <button class="btn" title="ADD NEW ROLE" onclick=" sessionStorage.removeItem('getEachRoleDetails'); _getForm({page: 'role_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW ROLE
                </button>
            </div>
        </div>
    </div>
    
    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="role-list-back-div" id="pageContent">
            <script>_fetchRoles();</script>
        </div>
    </div>
<?php }?>

<?php if ($page=='role_reg'){ ?>
    <script> 
        getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails"));
        $('#pageTitle').html(getEachRoleDetails?.roleId ? 'UPDATE USER ROLE':'ADD NEW USER ROLE');
    </script>
    
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> <span id="pageTitle">ADD NEW USER ROLE</span></span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>
        
        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below and toggle permissions to<span> ADD NEW USER ROLE</span></div>
                </div>

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
                        <div class="toggle-title">Branch Permissions</div>
                        <div class="fetch-toggle" id="branch"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Administrative Permissions</div>
                        <div class="fetch-toggle" id="administrative"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Customer Permissions</div>
                        <div class="fetch-toggle" id="customer"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Product Permissions</div>
                        <div class="fetch-toggle" id="product"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Order Permissions</div>
                        <div class="fetch-toggle" id="order"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Publish Permissions</div>
                        <div class="fetch-toggle" id="publish"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Report Permissions</div>
                        <div class="fetch-toggle" id="report"></div>
                    </div>

                    <div class="permission-toggle-div">
                        <div class="toggle-title">Role Permissions</div>
                        <div class="fetch-toggle" id="role"></div>
                    </div>
                    <script>_fetchRolePermissions();</script>
                </div>
                <div>    
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateRole();"> <i class="bi-check"></i> SUBMIT </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page=='update_role'){ ?>	
    <script>  getEachRoleDetails = JSON.parse(sessionStorage.getItem("getEachRoleDetails")); </script>	

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div top-panel-details">
            <div class="inner-top">
                <div class="profile-div">
                    <div class="text-div">
                        <span>Role Name</span>
                        <h3 id="roleName"><script> $("#roleName").html(getEachRoleDetails.roleName);</script></h3>
                    </div>
                </div>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user-details">
                    <div class="alert alert-success form-alert">
                        <span class="alert-title">ROLE DESCRIPTION</span>
                        <div id="roleDescription"><script>$("#roleDescription").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails.roleDescription));</script></div>
                    </div>

                    <div class="fetched-permission-back-div">
                        <div class="title">Permissions</div>
                        <div id="fetchedPermission">
                            <script>
                                $(document).ready(function () {
                                    let text = '';

                                    for (let i = 0; i < getEachRoleDetails.rolePermissions.length; i++) {
                                        const rolePermissionName = getEachRoleDetails.rolePermissions[i].rolePermissionName; 

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

                    <div class="details-div">
                        <div class="details-list">
                            <div class="title">Created By:</div>
                            <div class="each-details-back-list">
                                <div class="each-details-list">
                                    <div>Full Name:</div>
                                    <span id="fullName"><script>$("#fullName").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails.createdBy[0].fullname));</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress"><script>$("#emailAddress").html(getEachRoleDetails.createdBy[0].emailAddress);</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Created:</div>
                                    <span id="createdTime"><script>$("#createdTime").html(getEachRoleDetails.createdTime);</script></span>
                                </div>
                            </div>
                        </div>

                        <div class="details-list">
                            <div class="title">Updated By:</div>
                            <div class="each-details-back-list">
                                <div class="each-details-list">
                                    <div>Full Name:</div>
                                    <span id="fullName2"><script>$("#fullName2").html(capitalizeFirstLetterOfEachWord(getEachRoleDetails.updatedBy[0]?.fullname ?? ''));</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress2"><script>$("#emailAddress2").html(getEachRoleDetails.updatedBy[0]?.emailAddress ?? '');</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Updated:</div>
                                    <span id="updatedTime"><script>$("#updatedTime").html(getEachRoleDetails.updatedTime);</script></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-container"></div>
                    <script>
                        $(document).ready(function () {
                            let showButton = '';
                            showButton = 
                                `<button class="edit-btn" title="Edit User Role" id="edit_btn" onclick="_getForm({page: 'role_reg', url: adminPortalLocalUrl});">
                                    <i class="bi-check"></i> Edit User Role
                                </button>`;
                            if (getEachRoleDetails.userCount === "0") {
                                showButton += 
                                `<button class="edit-btn delete-btn" title="Delete User Role" id="delete_btn" onclick="_deleteRole();">
                                    <i class="bi-trash3"></i> Delete User Role
                                </button>`; 
                            }

                            $(".btn-container").html(showButton);
                        });
                    </script>
                </div>
            </div>
        </div>  
    </div>
<?php } ?>