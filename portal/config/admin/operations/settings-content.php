<?php if($page=='settings'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-gear"></i> <strong>Global Configurations</strong></div>
            <span class="settings-span">Manage and configure dashboard settings, global settings and manage users </span>
        </div>
        <button class="btn" title="LEARN MORE">LEARN MORE</button>
    </div>
    
    <div class="pages-back-div settings-pages-back-div">
        <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">

            <div class="user-managment-list" onclick="_getPage({page: 'user-role-configuration', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/authorization.png" alt="User Role Management"/></div>
                    <div class="text-div">
                        <h3>User Role Management</h3>
                        <p>User role configurations manage permissions, ensuring secure and efficient access to features.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage({page: 'department_config', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl?>/images/department.png" alt="Department Configuration"/>
                    </div>
                    <div class="text-div">
                        <h3>Departments</h3>
                        <p>Manage, add, and update school departments efficiently.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage({page: 'class_config', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl?>/images/class.png" alt="Class Configuration"/>
                    </div>
                    <div class="text-div">
                        <h3>Classess</h3>
                        <p>Create, organize, and manage classes for different levels and departments.</p>
                    </div>
                </div>
            </div>
            
            <div class="user-managment-list" onclick="_getPage({page: 'arm_config', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl?>/images/arms.png" alt="Arms Configuration"/>
                    </div>
                    <div class="text-div">
                        <h3>Arms</h3>
                        <p>Create, organize, and manage Arms for different Classes.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage({page: 'subject_config', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl?>/images/subject.png" alt="Subject Configuration"/>
                    </div>
                    <div class="text-div">
                        <h3>Subjects</h3>
                        <p>Define and manage subjects offered across various classes and departments.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/images/status.png" alt="User Status Configurations"/></div>
                    <div class="text-div">
                        <h3>Change Password</h3>
                        <p>Users can change and upadate their password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>


<?php if ($page=='change_password'){ ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-shield-lock"></i> CHANGE PASSWORD</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Fill all fields to change your <span>PASSWORD</span></div>
                </div>

                <div class="text_field_container" id="oldPassword_container">
                    <script>
                        textField({
                            id: 'oldPassword',
                            title: 'Enter Your Old Password',
                            type: 'password'
                        });
                    </script> 
                </div>

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

                <div>    
                    <button class="btn" title="CHANGE PASSWORD" id="submitBtn" onclick="_changePassword();"> <i class="bi-check"></i> CHANGE PASSWORD </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page == 'accessKeyValidationForm') { ?>
    <div class="successful-div animated zoomIn">
        <div class="success-in">
            <div class="gif">
                <img src="<?php echo $websiteUrl?>/images/success.gif" alt="successful gif">
            </div>
            <h3>PASSWORD CHANGED SUCCESSFULLY</h3>
            <button class="btn" title="OKAY" onclick="_logOut();">OKAY <i class="bi-check2-all"></i></button>
        </div> 
    </div>
<?php } ?>