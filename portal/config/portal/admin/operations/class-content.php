<?php if($page=='class_config'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="back-div"><span onclick="_getActivePage({page:'settings'});"><i class="bi-arrow-left"></i> System Settings</span> - Classes</div>
            <div class="main-title title"><i class="bi-people"></i> <strong>Classes</strong></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper extended-text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach class..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search class...</div>
                </div>
            </div>
            
            <button class="btn" title="ADD NEW CLASS" onclick="sessionStorage.removeItem('getEachClassSession'); _getForm({page: 'class_reg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW CLASS
            </button>
        </div>
    </div>
    
    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script>_fetchClasses();</script>
            </table>
        </div>
    </div>
<?php }?>

<?php if ($page == 'class_reg') { ?>
    <script> 
        getEachClassSession = JSON.parse(sessionStorage.getItem("getEachClassSession"));
        $('#pageTitle, #pageTitle2').html(getEachClassSession?.classId ? 'UPDATE CLASS':'ADD NEW CLASS');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD A NEW CLASS</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> ADD A NEW CLASS</span></div>
                </div>

                <div class="text_field_container" id="className_container">
                    <script>
                        textField({
                            id: 'className',
                            title: 'Class Name',
                            value: getEachClassSession?.className ?? ''
                        });
                    </script>
                </div>
                
                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status',
                            fieldValue: getEachClassSession?.statusData[0].statusId?? '',
                            fieldLabel: getEachClassSession?.statusData[0].statusName?? ''
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateClass();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='update_class'){ ?>	
    <script>getEachClassSession = JSON.parse(sessionStorage.getItem("getEachClassSession")); </script>	

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div top-panel-details">
            <div class="inner-top">
                <div class="profile-div">
                    <div class="text-div">
                        <span>Class Name</span>
                        <h3 id="roleName"><script> $("#roleName").html(getEachClassSession.className);</script></h3>
                    </div>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user-details">
                    <div class="details-div">
                        <div class="details-list">
                            <div class="title">Created By:</div>
                            <div class="each-details-back-list">
                                <div class="each-details-list">
                                    <div>Full Name:</div>
                                    <span id="fullName"><script>$("#fullName").html(capitalizeFirstLetterOfEachWord(getEachClassSession?.createdBy[0].fullname));</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress"><script>$("#emailAddress").html(getEachClassSession?.createdBy[0].emailAddress);</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Created:</div>
                                    <span id="createdTime"><script>$("#createdTime").html(getEachClassSession?.createdTime);</script></span>
                                </div>
                            </div>
                        </div>

                        <div class="details-list">
                            <div class="title">Updated By:</div>
                            <div class="each-details-back-list">
                                <div class="each-details-list">
                                    <div>Full Name:</div>
                                    <span id="fullName2"><script>$("#fullName2").html(capitalizeFirstLetterOfEachWord(getEachClassSession?.updatedBy[0]?.fullname ?? ''));</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress2"><script>$("#emailAddress2").html(getEachClassSession?.updatedBy[0]?.emailAddress ?? '');</script></span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Updated:</div>
                                    <span id="updatedTime"><script>$("#updatedTime").html(getEachClassSession?.updatedTime);</script></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <button class="edit-btn" title="Edit Class" id="edit_btn" onclick="_getForm({page: 'class_reg', url: adminPortalLocalUrl});">
                        <i class="bi-check"></i> Edit Class
                    </button>
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page=='add_class_arm') { ?>
    <script> getClassArmSession = JSON.parse(sessionStorage.getItem("getClassArmSession"));</script>	

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD ARM TO CLASS </span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly click the <span>Add Arm</span> button to <span> ADD ARM TO <span id="className"></span> CLASS</span></div>
                        <script>
                            $(document).ready(function () {
                                $("#className, #className2").html(getClassArmSession.className);
                            });
                        </script>
                    </div>

                    <div class="fetched-permission-back-div">
                        <div class="title">Registered Arms</div>
                        <div id="fetchedPermission"></div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            var getClassArmSession = JSON.parse(sessionStorage.getItem("getClassArmSession"));
                            let text = '';

                            if (getClassArmSession && getClassArmSession.data) {
                                const fetch = getClassArmSession.data;
                                const noOfArms = getClassArmSession.noOfArms;

                                if (noOfArms > 0) {
                                    for (let i = 0; i < fetch.length; i++) {
                                        const armName = fetch[i].armName;
                                        const checked = fetch[i].checked;

                                        if (checked === true) {
                                            text += `
                                                <div class="fetched-permission-div">
                                                    <span>${armName}</span>
                                                </div>`;
                                        }
                                    }
                                    $("#addBtn").html(`<i class="bi-check"></i> EDIT ARM`).attr("title", "EDIT ARM");
                                } else {
                                    text = `
                                        <div class="permission-form-back-div">
                                            <div class="title-div">
                                                <h4>No Arm Available</h4>
                                                <p>There are currently no registered arms. To assign arm to this class, please click the "Add Arm" button below.</p>
                                            </div>
                                        </div>`;
                                    $("#addBtn").html(`<i class="bi-check"></i> ADD ARM`).attr("title", "ADD ARM");
                                }

                                $("#fetchedPermission").html(text);
                            }
                        });
                    </script>

                    <div>
                        <button class="btn" title="ADD ARM" id="addBtn" onclick="_getFormDetails('user_form_details');"> <i class="bi-check"></i> ADD ARM </button>
                    </div>
                </div>

                <div id="user_form_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly toggle the following arm to <span> ADD ARM TO <span id="className2"></span> CLASS</span></div>
                    </div>

                    <div class="permission-form-back-div">
                        <div class="title-div">
                            <h4>Arms</h4>
                            <p>Use the toggles below to assign registered arm to their respective classes. Switching to "Yes" activates the arm for class use.</p>
                        </div>

                        <div class="permission-toggle-div">
                            <div class="toggle-title">Registered Arms</div>
                            <div class="fetch-toggle" id="pageContent"></div>
                        </div>

                        <script>_fetchArmToggle();</script>
                    </div>

                    <div>
                        <button class="btn" title="SUBMIT" id="submitBtn" onclick="createUpdateClassArm();"> <i class="bi-check"></i> SUBMIT </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page=='add_class_subjects') { ?>
    <script>getClassSubjectSession = JSON.parse(sessionStorage.getItem("getClassSubjectSession"));</script>	

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD SUBJECT TO CLASS </span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly click the <span>Add Subject</span> button to <span> ADD SUBJECT TO <span id="className"></span> CLASS</span></div>
                        <script>
                            $(document).ready(function () {
                                $("#className, #className2").html(getClassSubjectSession.className);
                            });
                        </script>
                    </div>

                    <div class="fetched-permission-back-div">
                        <div class="title">Registered Subjects</div>
                        <div id="fetchedPermission"></div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            var getClassSubjectSession = JSON.parse(sessionStorage.getItem("getClassSubjectSession"));
                            let text = '';

                            if (getClassSubjectSession && getClassSubjectSession.data) {
                                const fetch = getClassSubjectSession.data;
                                const noOfsubjects = getClassSubjectSession.noOfsubjects;

                                if (noOfsubjects > 0) {
                                    for (let i = 0; i < fetch.length; i++) {
                                        const subjectName = fetch[i].subjectName;
                                        const checked = fetch[i].checked;

                                        if (checked === true) {
                                            text += `
                                                <div class="fetched-permission-div">
                                                    <span>${subjectName}</span>
                                                </div>`;
                                        }
                                    }
                                    $("#addBtn").html(`<i class="bi-check"></i> EDIT SUBJECT`).attr("title", "EDIT SUBJECT");
                                } else {
                                    text = `
                                        <div class="permission-form-back-div">
                                            <div class="title-div">
                                                <h4>No Subject Available</h4>
                                                <p>There are currently no registered subjects. To assign subject to this class, please click the "Add Subject" button below.</p>
                                            </div>
                                        </div>`;
                                    $("#addBtn").html(`<i class="bi-check"></i> ADD SUBJECT`).attr("title", "ADD SUBJECT");
                                }

                                $("#fetchedPermission").html(text);
                            }
                        });
                    </script>

                    <div>
                        <button class="btn" title="ADD SUBJECT" id="submitBtn" onclick="_getFormDetails('user_form_details');"> <i class="bi-check"></i> ADD SUBJECT </button>
                    </div>
                </div>

                <div id="user_form_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly toggle the following subject to <span> ADD SUBJECT TO <span id="className2"></span> CLASS</span></div>
                    </div>

                    <div class="permission-form-back-div">
                        <div class="title-div">
                            <h4>Classes</h4>
                            <p>Use the toggles below to assign registered subjects to their respective classes. Switching to "Yes" activates the subject for class use.</p>
                        </div>

                        <div class="permission-toggle-div">
                            <div class="toggle-title">Registered Subjects</div>
                            <div class="fetch-toggle" id="pageContent"></div>
                        </div>

                        <script>_fetchSubjectToggle();</script>
                    </div>

                    <div>
                        <button class="btn" title="SUBMIT" id="submitBtn2" onclick="createUpdateClassSubject();"> <i class="bi-check"></i> SUBMIT </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>