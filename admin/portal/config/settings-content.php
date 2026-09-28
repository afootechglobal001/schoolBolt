<?php if ($page == 'settingsPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-gear"></i></div>
            </div>
            <div class="text-div">
                <h3>Global Configurations</h3>
                <p>Manage and configure dashboard settings, global settings and manage users</p>
            </div>
        </div>

        <div class="btn-div">
            <button class="btn" title="LEARN MORE">LEARN MORE</button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-gear"></i>
                    <p>Global Configurations</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="user-managment-back-div" data-aos="fade-in" data-aos-duration="1500">
                    <div class="user-managment-list" title="User Role Configurations" onclick="_getPage({page: 'userConfiguration', url: portalMiddleWareUrl});">
                        <div class="inner-div">
                            <div class="icon-div"><img src="<?php echo $websiteUrl ?>/all-images/images/authorization.png" alt="User Role Configurations" /></div>
                            <div class="text-div">
                                <h3>User Role Configurations</h3>
                                <p>User role configurations manage permissions, ensuring secure and efficient access to features.</p>
                            </div>
                        </div>
                    </div>

                    <div class="user-managment-list" title="Information Category Configurations" onclick="_getPage({page: 'informationCategory', url: portalMiddleWareUrl});">
                        <div class="inner-div">
                            <div class="icon-div"><img src="<?php echo $websiteUrl ?>/all-images/images/blog.png" alt="Blog Category Configurations" /></div>
                            <div class="text-div">
                                <h3>Information Category Configurations</h3>
                                <p>Information category configurations organize content, ensuring easy navigation and management.</p>
                            </div>
                        </div>
                    </div>

                    <div class="user-managment-list" title="Project Category Configurations" onclick="_getPage({page: 'projectCategory', url: portalMiddleWareUrl});">
                        <div class="inner-div">
                            <div class="icon-div"><img src="<?php echo $websiteUrl ?>/all-images/images/blog.png" alt="Project Category Configurations" /></div>
                            <div class="text-div">
                                <h3>Project Category Configurations</h3>
                                <p>Project category configurations, ensuring organized project management.</p>
                            </div>
                        </div>
                    </div>

                    <div class="user-managment-list" title="System Configurations" onclick="_getForm({page: 'systemSettings', url: portalMiddleWareUrl});">
                        <div class="inner-div">
                            <div class="icon-div"><img src="<?php echo $websiteUrl ?>/all-images/images/blog.png" alt="Blog Category Configurations" /></div>
                            <div class="text-div">
                                <h3>System Configurations</h3>
                                <p>Manage and configure system settings, global settings and manage users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'systemSettings') { ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-gear"></i></div>
                <h3>SYSTEM SETTINGS</h3>
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
                <p>You are about to change your system settings. Please complete the form below with accurate details to successfully change system settings.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-gear"></i>
                            <p>System Settings</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <span>SYSTEM SETTINGS CONFIGURATION</span>
                            <div class="text_field_back_container">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="UPDATE SYSTEM SETTINGS" id="submitBtn" onclick=""> <i class="bi-check"></i> UPDATE </button>
            </div>
        </div>
    </div>
<?php } ?>