<?php if ($page == 'activateExamPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
            </div>

            <div class="text-div">
                <h3>Activate Exam</h3>
                <p>
                    Activate CBT examinations for students by selecting the exam,
                    confirming the examination details, and making it available for students to take.
                </p>
            </div>
        </div>
    </div>

    <div class="main-content-div select-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="select-wrapper">
            <div class="select-inner-div">
                <div class="text-field-wrapper">
                    <div class="text_field_container column-1" id="departmentId_container">
                        <script>
                            selectField({
                                id: 'departmentId',
                                title: 'Select Department',
                            });
                            _getSelectBranchDepartment('departmentId');
                        </script>
                    </div>

                    <div class="text_field_container column-2" id="classId_container">
                        <script>
                            selectField({
                                id: 'classId',
                                title: 'Select Class',
                            });
                        </script>
                    </div>
                </div>

                <div class="btn-div">
                    <div class="btn" onclick="_proceedFetchCbtConfig();" id="proceedBtn" title="Proceed">
                        Proceed
                        <i class="bi bi-arrow-right-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title mobile-content-title">
                <div class="title">
                    <i class="bi bi-patch-check-fill"></i>
                    <p>Activate Exam</p>
                </div>

                <div class="alert alert-success detail-alert" id="fetchDepartmentClassCbtDetails" style="display: none;">
                    <i class="bi bi-mortarboard-fill"></i>
                    Department: <strong><span id="selectedDepartmentName">Loading...</span></strong> |
                    Class: <strong><span id="selectedClassName">Loading...</span></strong>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="toggle-wrapper" id="fetchClassesSubjectForEachCbtContent">
                    <script>
                        _showEmptyState({
                            container: "fetchClassesSubjectForEachCbtContent",
                            message: "Select department and class and proceed.",
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>