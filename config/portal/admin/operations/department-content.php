<?php if ($page == 'department_config') { ?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="back-div"><span onclick="_getActivePage({page:'settings'});"><i class="bi-arrow-left"></i> System Settings</span> Departments</div>
            <div class="main-title title"><i class="bi-diagram-3"></i> <strong>Departments</strong></div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper extended-text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach department..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search department...</div>
                </div>
            </div>

            <button class="btn" title="ADD NEW DEPARMENT" onclick="sessionStorage.removeItem('getEachDepartmentSession'); _getForm({page: 'department_reg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW DEPARMENT
            </button>
        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="table-div animated fadeIn">
            <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                <script>
                    _fetchDepartments();
                </script>
            </table>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'department_reg') { ?>
    <script>
        getEachDepartmentSession = JSON.parse(sessionStorage.getItem("getEachDepartmentSession"));
        $('#pageTitle, #pageTitle2').html(getEachDepartmentSession?.departmentId ? 'UPDATE DEPARTMENT' : 'ADD NEW DEPARTMENT');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD A NEW DEPARTMENT</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> ADD A NEW DEPARTMENT</span></div>
                </div>

                <div class="text_field_container" id="departmentName_container">
                    <script>
                        textField({
                            id: 'departmentName',
                            title: 'Department Name',
                            value: getEachDepartmentSession?.departmentName ?? ''
                        });
                    </script>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status',
                            fieldValue: getEachDepartmentSession?.statusData[0].statusId ?? '',
                            fieldLabel: getEachDepartmentSession?.statusData[0].statusName ?? ''
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateDepartment();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'update_department') { ?>
    <script>
        getEachDepartmentSession = JSON.parse(sessionStorage.getItem("getEachDepartmentSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div top-panel-details">
            <div class="inner-top">
                <div class="profile-div">
                    <div class="text-div">
                        <span>Department Name</span>
                        <h3 id="departmentName">
                            <script>
                                $("#departmentName").html(getEachDepartmentSession.departmentName);
                            </script>
                        </h3>
                    </div>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
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
                                    <span id="fullName">
                                        <script>
                                            $("#fullName").html(capitalizeFirstLetterOfEachWord(getEachDepartmentSession?.createdBy[0].fullname));
                                        </script>
                                    </span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress">
                                        <script>
                                            $("#emailAddress").html(getEachDepartmentSession?.createdBy[0].emailAddress);
                                        </script>
                                    </span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Created:</div>
                                    <span id="createdTime">
                                        <script>
                                            $("#createdTime").html(getEachDepartmentSession?.createdTime);
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
                                            $("#fullName2").html(capitalizeFirstLetterOfEachWord(getEachDepartmentSession?.updatedBy[0]?.fullname ?? ''));
                                        </script>
                                    </span>
                                </div>

                                <div class="each-details-list">
                                    <div>Email Address:</div>
                                    <span id="emailAddress2">
                                        <script>
                                            $("#emailAddress2").html(getEachDepartmentSession?.updatedBy[0]?.emailAddress ?? '');
                                        </script>
                                    </span>
                                </div>

                                <div class="each-details-list">
                                    <div>Date Updated:</div>
                                    <span id="updatedTime">
                                        <script>
                                            $("#updatedTime").html(getEachDepartmentSession?.updatedTime);
                                        </script>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <button class="edit-btn" title="Edit Department" id="edit_btn" onclick="_getForm({page: 'department_reg', url: adminPortalLocalUrl});">
                        <i class="bi-check"></i> Edit Department
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'add_classes') { ?>
    <script>
        getDepartmentClassSession = JSON.parse(sessionStorage.getItem("getDepartmentClassSession"));
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD CLASS TO DEPARTMENT </span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div id="user_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly click the <span>Add Class</span> button to <span> ADD CLASS TO <span id="departmentName"></span> DEPARTMENT</span></div>
                        <script>
                            $(document).ready(function() {
                                $("#departmentName, #departmentName2").html(getDepartmentClassSession.departmentName);
                            });
                        </script>
                    </div>

                    <div class="fetched-permission-back-div">
                        <div class="title">Registered Classes</div>
                        <div id="fetchedPermission"></div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            var getDepartmentClassSession = JSON.parse(sessionStorage.getItem("getDepartmentClassSession"));
                            let text = '';

                            if (getDepartmentClassSession && getDepartmentClassSession.data) {
                                const fetch = getDepartmentClassSession.data;
                                const noOfClasses = getDepartmentClassSession.noOfClasses;

                                if (noOfClasses > 0) {
                                    for (let i = 0; i < fetch.length; i++) {
                                        const className = fetch[i].className;
                                        const checked = fetch[i].checked;

                                        if (checked === true) {
                                            text += `
                                                <div class="fetched-permission-div">
                                                    <span>${className}</span>
                                                </div>`;
                                        }
                                    }
                                    $("#addBtn").html(`<i class="bi-check"></i> EDIT CLASS`).attr("title", "EDIT CLASS");
                                } else {
                                    text = `
                                        <div class="permission-form-back-div">
                                            <div class="title-div">
                                                <h4>No Class Available</h4>
                                                <p>There are currently no registered classes. To assign classes to this department, please click the "Add Class" button below.</p>
                                            </div>
                                        </div>`;
                                    $("#addBtn").html(`<i class="bi-check"></i> ADD CLASS`).attr("title", "ADD CLASS");
                                }

                                $("#fetchedPermission").html(text);
                            }
                        });
                    </script>

                    <div>
                        <button class="btn" title="ADD CLASS" id="addBtn" onclick="_getFormDetails('user_form_details');"><i class="bi-check"></i> ADD CLASS</button>
                    </div>
                </div>

                <div id="user_form_details">
                    <div>
                        <div class="alert alert-success form-alert">Kindly toggle the following classes to <span> ADD CLASS TO <span id="departmentName2"></span> DEPARTMENT</span></div>
                    </div>

                    <div class="permission-form-back-div">
                        <div class="title-div">
                            <h4>Classes</h4>
                            <p>Use the toggles below to assign registered classes to their respective departments. Switching to "Yes" activates the class for departmental use.</p>
                        </div>

                        <div class="permission-toggle-div">
                            <div class="toggle-title">Registered Classes</div>
                            <div class="fetch-toggle" id="pageContent"></div>
                        </div>

                        <script> _fetchClassesToggle();</script>
                    </div>

                    <div>
                        <button class="btn" title="SUBMIT" id="submitBtn" onclick="createUpdateDepartmentClass();"> <i class="bi-check"></i> SUBMIT </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>