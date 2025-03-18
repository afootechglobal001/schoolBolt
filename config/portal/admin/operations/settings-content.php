<?php if($page=='settings'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-gear"></i> <strong>Global Configurations</strong></div>
            <span class="settings-span">Manage and configure dashboard settings, global settings and manage users </span>
        </div>
        <button class="btn" title="LEARN MORE">LEARN MORE</button>
    </div>
    
    <div class="pages-back-div">
        <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
            <div class="user-managment-list" onclick="_getPage('master-count-config', 'master-count-config', '');">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/calculate.png" alt="Master Count Configurations"/></div>
                    <div class="text-div">
                        <h3>Master Count Configurations</h3>
                        <p>Master count configurations manage data totals, ensuring accurate tracking and control.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getForm({page: 'global-configuration', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/settings.png" alt="Global Configurations"/></div>
                    <div class="text-div">
                        <h3>Global Configurations</h3>
                        <p>Global configurations set system-wide settings, ensuring consistency and control.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage({page: 'user-role-configuration', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/authorization.png" alt="User Role Management"/></div>
                    <div class="text-div">
                        <h3>User Role Management</h3>
                        <p>User role configurations manage permissions, ensuring secure and efficient access to features.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage({page: 'department_config', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div">
                        <img src="<?php echo $websiteUrl?>/all-images/images/department.png" alt="Department Configuration"/>
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
                        <img src="<?php echo $websiteUrl?>/all-images/images/class.png" alt="Class Configuration"/>
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
                        <img src="<?php echo $websiteUrl?>/all-images/images/arms.png" alt="Arms Configuration"/>
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
                        <img src="<?php echo $websiteUrl?>/all-images/images/subject.png" alt="Subject Configuration"/>
                    </div>
                    <div class="text-div">
                        <h3>Subjects</h3>
                        <p>Define and manage subjects offered across various classes and departments.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage('blog-cat-config', 'blog-cat-config', '');">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/blog.png" alt="Blog Category Configurations"/></div>
                    <div class="text-div">
                        <h3>Blog Category Configurations</h3>
                        <p>Blog category configurations organize content, ensuring easy navigation and management.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getPage('faq-cat-config', 'faq-cat-config', '');">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/faq.png" alt="FAQ Category Configurations"/></div>
                    <div class="text-div">
                        <h3>FAQ Category Configurations</h3>
                        <p>FAQ category configurations organize questions, ensuring easy access and management.</p>
                    </div>
                </div>
            </div>

            <div class="user-managment-list" onclick="_getForm({page: 'change_password', url: adminPortalLocalUrl});">
                <div class="inner-div">
                    <div class="icon-div"><img src="<?php echo $websiteUrl?>/all-images/images/status.png" alt="User Status Configurations"/></div>
                    <div class="text-div">
                        <h3>Change Password</h3>
                        <p>Users can change and upadate their password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>


<?php if ($page=='global-configuration'){ ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="back_icon" style="display:none; cursor:pointer;" ><i class="bi-arrow-left" style="cursor:pointer;" onclick="_prevPage('account_settings_id');" ></i> &nbsp;&nbsp;</span>
                <span id="panel-title"><span id="header_icon"> <i class="bi-gear"></i> </span id="app_text"> APP SETTINGS</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="setting_detail" id="account_settings_id">   

                    <div class="settings-div" onclick="_nextPage('account_detail','back_icon','account');">
                        <div class="div-in">
                            <div class="text-container">
                                <div class="icon-div">
                                    <i class="bi-bank"></i> 
                                </div>
                                <div class="text-div">
                                    <h4 id="account">GATEWAY POLYTECHNIC BRANCH</h4>
                                    <span>gatewaypolybranch@gmail.com</span>
                                    <span>09028194758</span>
                                </div>
                            </div>
        
                            <div class="right-icon-div">
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="settings-div" onclick="_nextPage('account_detail','back_icon','account');">
                        <div class="div-in">
                            <div class="text-container">
                                <div class="icon-div">
                                    <i class="bi-bank"></i> 
                                </div>
                                <div class="text-div">
                                    <h4 id="account">OLABISI ONABANJO UNIVERSITY BRANCH</h4>
                                    <span>olabisiunibranch@gmail.com</span>
                                    <span>0705908475</span>
                                </div>
                            </div>
        
                            <div class="right-icon-div">
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="setting_detail" id="account_detail">     
                    <div class="alert alert-success account-form-alert"><span>SMTP DETAILS</span>

                        <div class="text_field_container" id="smtpHost_container">
                            <script>
                                textField({
                                    id: 'smtpHost',
                                    title: 'SMTP HOST'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpUsername_container">
                            <script>
                                textField({
                                    id: 'smtpUsername',
                                    title: 'SMTP USERNAME'
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="smtpPassword_container">
                            <script>
                                textField({
                                    id: 'smtpPassword',
                                    title: 'SMTP PASSWORD',
                                    type: 'password'
                                });
                            </script>   
                        </div>

                        <div class="text_field_container" id="smtpPort_container">
                            <script>
                                textField({
                                    id: 'smtpPort',
                                    title: 'SMTP PORT',
                                    type: 'number'
                                });
                            </script> 
                        </div>

                        <div class="text_field_container" id="supportEmail_container">
                            <script>
                                textField({
                                    id: 'supportEmail',
                                    title: 'SUPPORT EMAIL',
                                    type: 'email'
                                });
                            </script> 
                        </div> 

                        <div class="text_field_container" id="paymentKey_container">
                            <script>
                                textField({
                                    id: 'paymentKey',
                                    title: 'PAYMENT KEY'
                                });
                            </script> 
                        </div>    
                    </div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateSettings();"> <i class="bi-check"></i> UPDATE ACCOUNT </button>
                </div>
            </div>
        </div> 
    </div>
<?php } ?>

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

                <div class="text_field_container" id="newPassword_container">
                    <script>
                        textField({
                            id: 'newPassword',
                            title: 'Create New Password',
                            type: 'password'
                        });
                    </script> 
                </div>

                <div class="text_field_container" id="confirmPassword_container">
                    <script>
                        textField({
                            id: 'confirmPassword',
                            title: 'Confirm New Passwordd',
                            type: 'password'
                        });
                    </script> 
                </div>

                <div class="pswd_info" style="color:#8c8d8d"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>

                <div>    
                    <button class="btn" title="CHANGE PASSWORD" id="submit_btn" onclick=""> <i class="bi-check"></i> CHANGE PASSWORD </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>