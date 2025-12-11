<?php if ($page=='branch_department_class') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <span><i class="bi-people-fill"></i> BRANCH CLASS LIST</span>

        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="printTeachersByClassBtn" onclick="_printTeachersByClass();"><i class="bi-printer"></i> PRINT</button>
        </div>
    </div>

    <div class="pages-toggle-back-div" id="pageContent">
        <script>_fetchBranchDepartmentClass();</script>
    </div>
<?php } ?>

<?php if ($page=='assign_staff') { ?>
    <script> getClassTeacherSession = JSON.parse(sessionStorage.getItem("getClassTeacherSession"));</script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE CLASS TEACHER</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly select staff below to <span> UPDATE CLASS TEACHER</span></div>
                </div>

                <div class="alert alert-success form-alert">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>Branch:</div>
                            <div><span id="branchName"><script>$("#branchName").html(getClassTeacherSession.branchData.branchName);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Department:</div>
                            <div><span id="departmentName"><script>$("#departmentName").html(getClassTeacherSession.departmentData.departmentName);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Level:</div>
                            <div><span id="level">
                                <script>
                                    $("#level").html(getClassTeacherSession.classData.className + ' ' + 
                                    getClassTeacherSession.armData.armName);
                                </script>
                            </span></div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Class Teacher',
                            fieldValue: getClassTeacherSession?.data[0]?.staffId ?? '',
                            fieldLabel: getClassTeacherSession?.data[0]?.teacherData?.fullname ?? ''
                        });
                        _getSelectClassTeachers('staffId');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="addClassTeacher();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>