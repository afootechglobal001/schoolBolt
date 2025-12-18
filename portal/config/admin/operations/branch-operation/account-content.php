<!-- fetch student select form -->
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

<!-- ///////////////// Parent Page/////////////////////////////////////////////////////////////////////////////////////// -->
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

                            <div class="alert-list-back-div">
                                <div class="alert-list">
                                    <div>Relationship:</div>
                                    <div><span id="parentRelationship">
                                            <script>
                                                $("#parentRelationship").html(studentParentSessionData?.parent?.recordFor);
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

                <div class="new-btn-container"></div>
                <script>
                    $(document).ready(function() {
                        let showButton = '';
                        const statusId = studentParentSessionData?.parent?.statusId;

                        if (statusId === "1") {
                            showButton += `
                                <button class="btn suspend" title="SUSPEND PARENT" id="activateAndSuspend" onclick="_suspendActivateParentAccount();">
                                    <i class="bi-person-dash"></i> SUSPEND PARENT
                                </button>
                            `;
                        } else if (statusId === "2") {
                            showButton += `
                                <button class="btn activate" title="ACTIVATE PARENT" id="activateAndSuspend" onclick="_suspendActivateParentAccount();">
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
<?php } ?>

<!-- ///////////////// Account Session and term Select Form /////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'accountSessionSelectForm') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-table"></i> SESSION & TERM SELECTION</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i
                    class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, You’re about to continue with this operation.
                Please choose the required <span>Session</span>, and <span>Term</span>, to proceed.
            </div>

            <div class="text_field_container" id="sessionId_container">
                <script>
                    selectField({
                        id: 'sessionId',
                        title: 'Select Session'
                    });
                    _getSelectSession('sessionId');
                </script>
            </div>

            <div class="text_field_container" id="termId_container">
                <script>
                    selectField({
                        id: 'termId',
                        title: 'Select Term'
                    });
                    _getSelectTermId('termId');
                </script>
            </div>

            <button class="btn" id="proceedBtn" title="Proceed Request" onclick="_getActiveBranchPage({divid:'branchDepartmentClass', page: 'branchDepartmentClass', url: adminPortalLocalUrl});">PROCEED <i
                    class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<!-- ///////////////// Branch Department Class/////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page=='branchDepartmentClass') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-people-fill"></i> BRANCH DEPARTMENT CLASS LIST /</span> SESSION -- <span id="">2024/2025 /</span> TERM -- <span id="">THIRD TERM</span></span></div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>_fetchAccountBranchDepartmentClass();</script>
    </div>
<?php } ?>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<?php if ($page == 'viewStudentByClass') { ?>
    <div class="user-profile-div" data-aos="fade-left" data-aos-duration="900">
        <div class="top-panel-div">
            <div class="inner-top">
                <span><i class="bi-people-fill"></i> STUDENT'S LIST</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">X</div>
            </div>
        </div>

        <div class="profile-content-div">
            <div class="field-back-div">
                <div class="field-inner-div student-result-field-inner-div">
                    <div class="alert alert-success top-alert-div animated fadeIn">
                        <div><i class="bi-graph-up-arrow"></i> Revenue For <span id="date">
                                <script>
                                    $("#date").html(getRevenueByDateSessionData?.date);
                                </script>
                            </span> -- Total Revenue: <span class="balance" id="totalAmount">
                                <script>
                                    $("#totalAmount").html("<s>N</s>" + thousandSeperator(getRevenueByDateSessionData?.totalAmount));
                                </script>
                            </span></div>
                    </div>

                    <div class="table-div animated fadeIn">
                        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
                            <thead>
                                <tr class="tb-col">
                                    <th>sn</th>
                                    <th>Student Info</th>
                                    <th>Session/Term</th>
                                    <th>Class</th>
                                    <th>Total Mandatory Fees</th>
                                    <th>Total Non-Mandatory Fees</th>
                                    <th>Payable Fees</th>
                                    <th>Mandatory Fees Paid</th>
                                    <th>Non-Mandatory Fees Paid</th>
                                    <th>Total Fees Paid</th>
                                    <th>Wallet Balance</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="tb-row">
                                    <td>1</td>
                                    <td class="clickable-td" title="Click to view student details" onclick="_fetchEachBranchStudents('${branchId}','${departmentId}','${classId}','${armId}','${studentId}','');">
                                        <div class="text-back-div">
                                            <div class="image-div general-passport">
                                                <img src="${studentPixPath}/${passport}" alt="${fullname}" />
                                            </div>

                                            <div class="text-div">
                                                <div class="first-class">AFOLBAI MIKE OLUWAGBENGA</div>
                                                <div class="second-class">STUDENT00220250321124557</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>2024/2025 - THIRD TERM</td>
                                    <td>KINDERGARTEN (KG 1 A)</td>
                                    <td><s>N</s>200, 000</td>
                                    <td><s>N</s>200, 000</td>
                                    <td><s>N</s>200, 000</td>
                                    <td><s>N</s>200, 000</td>
                                    <td><s>N</s>200, 000</td>
                                    <td><s>N</s>400, 000</td>
                                    <td><s>N</s>50, 000</td>
                                    <td><button class="btn view-btn" title="Click to load wallet" onclick="">LOAD WALLET</button></td>
                                    <td><button class="btn view-btn" title="Click to make payment" onclick="">MAKE PAYMENT</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>