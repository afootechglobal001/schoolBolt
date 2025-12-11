<?php if ($page == 'subject_select_form') { ?>
    <div class="caption-div animated zoomIn">
        <div class="title-div">
            <div class="title"><i class="bi-person-check"></i> VIEW SUBJECT</div>
            <button class="close-btn" onclick="_alertClose(<?php echo $modalLayer ?>);" title="Close"><i class="bi-x-lg"></i></button>
        </div>

        <div class="div-in animated fadeIn">
            <div class="alert alert-success form-alert"> <i class="bi-person"></i> Hello, you're about to view subjects by their <span>Department</span>, <span>Class</span>. Please select the <span>Department</span>, <span>Class</span> to proceed.</div>

            <div class="text_field_container" id="departmentId_container">
                <script>
                    selectField({
                        id: 'departmentId',
                        title: 'Select Department'
                    });
                    _getSelectSubjectDepartment('departmentId');
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

            <button class="btn" id="submitBtn" title="Proceed Request" onclick="_proceedFetchBranchSubject();">PROCEED <i class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_subject_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-person-bounding-box"></i></span> BRANCH SUBJECT'S LIST ---- <span id="subjectSession">Loading...</span> - <span id="subjectTermName">Loading...</span> - <span id="departmentName3">Loading...</span> - <span id="className2">Loading...</span> <span id="armName2">Loading...</span></div>
        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="printTeachersBySubjectBtn" onclick="_printTeachersBySubject();"><i class="bi-printer"></i> PRINT</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <script>_fetchBranchSubjects();</script>
        </table>
    </div>
<?php } ?>

<?php if ($page=='assign_subject_staff') { ?>
    <script> getSubjectTeacherSession = JSON.parse(sessionStorage.getItem("getSubjectTeacherSession"));</script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE SUBJECT TEACHER</span>
                <div class="close" title="Close" onclick="_alertClose(<?php echo $modalLayer?>);">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly select staff below to <span> UPDATE SUBJECT TEACHER</span></div>
                </div>

                <div class="alert alert-success form-alert">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>Branch:</div>
                            <div><span id="branchName"><script>$("#branchName").html(getSubjectTeacherSession.branchData.branchName);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Department:</div>
                            <div><span id="departmentName"><script>$("#departmentName").html(getSubjectTeacherSession.departmentData.departmentName);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Class:</div>
                            <div><span id="className"><script>$("#className").html(getSubjectTeacherSession.classData.className);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Arm:</div>
                            <div><span id="armName"><script>$("#armName").html(getSubjectTeacherSession.armData.armName);</script></span></div>
                        </div>
                        <div class="alert-list">
                            <div>Subject:</div>
                            <div><span id="subjectName"><script>$("#subjectName").html(getSubjectTeacherSession.subjectData.subjectName);</script></span></div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Class Teacher',
                            fieldValue: getSubjectTeacherSession?.data[0]?.staffId ?? '',
                            fieldLabel: getSubjectTeacherSession?.data[0]?.teacherData?.fullname ?? ''
                        });
                        _getSelectSubjectTeachers('staffId');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="allocateSubjectTeacher();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>