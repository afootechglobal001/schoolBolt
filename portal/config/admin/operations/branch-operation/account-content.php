<!-- fetch_student_select_form -->
<?php if ($page == 'fetch_parent_form') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> VIEW PARENT</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to view parents by
                student <span>Department</span>, <span>Class</span>, and <span>Arm</span>. Please select the
                <span>Department</span>, <span>Class</span>, and <span>Arm</span> to proceed.
            </div>

            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                    _getSelectDepartment('departmentId');
                </script>
            </div>

            <div class="text_field_container" id="classId_container">
                <script>
                    selectField({
                        id: 'classId',
                        title: 'Select Class'
                    });
                </script>
            </div>

            <div class="text_field_container" id="armId_container">
                <script>
                    selectField({
                        id: 'armId',
                        title: 'Select Arm'
                    });
                </script>
            </div>

            <button class="btn" id="submit_btn" title="Proceed Request" onclick="_proceedFetchBranchParents();">PROCEED <i
                    class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_parent_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn" id="pageTitleDiv"></div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Student Info</th>
                    <th>Father Info</th>
                    <th>Mother Info</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Arm</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="pageContent">
                <!-- CONTENT GOES HERE -->
                <script>
                    _fetchBranchParents();
                </script>
                <tr>
                    <td colspan="20">
                        <div class="content-loading-div">
                            <img src="<?php echo $websiteUrl ?>/images/spinner.gif" alt="Loading" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page == 'parentStudentForm') { ?>
    <script>studentParentSessionData = JSON.parse(sessionStorage.getItem("studentParentSessionData"));</script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <div class="icon-title-div">
                    <span id="panel-title"><span><i class="bi-plus-square"></i></span> STUDENT & PARENT MANAGEMENT</span>
                </div>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">
                        <span>Parent Details;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Full Name:</div>
                                    <div><span id="parentFullName">
                                            <script>
                                                $("#parentFullName").html(studentParentSessionData?.parent?.titleId +
                                                    ' ' + studentParentSessionData?.parent?.surName + ' ' +
                                                    studentParentSessionData?.parent?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Email:</div>
                                    <div><span id="parentEmail">
                                            <script>
                                                $("#parentEmail").html(studentParentSessionData?.parent?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Parent Mobile Number:</div>
                                    <div><span id="parentMobileNumber">
                                            <script>
                                                $("#parentMobileNumber").html(studentParentSessionData?.parent?.mobileNumber);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Student Details;</span>
                        <div class="alert-list-div">
                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Full Name:</div>
                                    <div><span id="studentFullName">
                                            <script>
                                                $("#studentFullName").html(studentParentSessionData?.student?.studentData?.surName +
                                                    ' ' + studentParentSessionData?.student?.studentData?.firstName + ' ' +
                                                    studentParentSessionData?.student?.studentData?.otherNames);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Student Email:</div>
                                    <div><span id="studentEmail">
                                            <script>
                                                $("#studentEmail").html(studentParentSessionData?.student?.studentData?.email);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Department:</div>
                                    <div><span id="formDepartmentName">
                                            <script>
                                                $("#formDepartmentName").html(studentParentSessionData?.student?.departmentData
                                                    ?.departmentName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Class:</div>
                                    <div><span id="formClassName">
                                            <script>
                                                $("#formClassName").html(studentParentSessionData?.student?.classData?.className);
                                            </script>
                                        </span></div>
                                </div>
                            </div>

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Arm:</div>
                                    <div><span id="formArmName">
                                            <script>
                                                $("#formArmName").html(studentParentSessionData?.student?.armData?.armName);
                                            </script>
                                        </span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="alert alert-success form-alert">
                        <span>Parent Management;</span>

                        <div class="new-btn-container"></div>
                        <script>
                            $(document).ready(function() {
                                let showButton = '';
                                const statusId = studentParentSessionData?.parent?.statusId;

                                if (statusId === "1") {
                                    showButton += `
                                        <button class="btn suspend" title="SUSPEND PARENT" onclick="">
                                            <i class="bi-person-dash"></i> SUSPEND PARENT
                                        </button>
                                    `;
                                } else if (statusId === "2") {
                                    showButton += `
                                        <button class="btn activate" title="ACTIVATE PARENT" onclick="">
                                            <i class="bi-person-check"></i> ACTIVATE PARENT
                                        </button>
                                    `;
                                }
                                    showButton += `
                                        <button class="btn portal" title="GO TO PARENT PORTAL" onclick='window.open(parentPortalUrl, "_blank")'>
                                            <i class="bi-box-arrow-up-right"></i> GO TO PARENT PORTAL
                                        </button>
                                        `;
                                $(".new-btn-container").html(showButton);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>