<?php if ($page == 'viewResultPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div">
                    <i class="bi bi-bar-chart-fill"></i>
                </div>
            </div>

            <div class="text-div">
                <h3>View Results</h3>
                <p>
                    View CBT examinations for students by selecting the exam,
                    confirming the examination details, and viewing the results of the exam.
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
                    <div class="btn" onclick="_proceedFetchResultCbtConfig();" id="proceedBtn" title="Fetch">
                        Fetch
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
                    <i class="bi bi-bar-chart-fill"></i>
                    <p>View Results</p>
                </div>

                <div class="alert alert-success detail-alert" id="fetchDepartmentClassResultCbtDetails" style="display: none;">
                    <i class="bi bi-mortarboard-fill"></i>
                    Department: <strong><span id="selectedDepartmentName">Loading...</span></strong> |
                    Class: <strong><span id="selectedClassName">Loading...</span></strong>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="toggle-wrapper" id="fetchClassesSubjectResultForEachCbtContent">
                    <script>
                        _showEmptyState({
                            container: "fetchClassesSubjectResultForEachCbtContent",
                            message: "Select department and class to proceed.",
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'proccedViewCbtResultForm') { ?>
    <script>selectedCbtSubjectSession = JSON.parse(sessionStorage.getItem("selectedCbtSubjectSession"));</script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div">
                   <i class="bi bi-bar-chart-fill"></i>
                </div>

                <h3>VIEW RESULTS</h3>
            </div>

            <div class="btn-div">
                <button class="btn" title="Close"
                    onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <div class="container-back-div">
            <div class="form-notification">
                <p>
                    You are about to view
                    results.
                    Please set the time allowed before viewing the results.
                </p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-bar-chart-fill"></i>
                            <p>Result Details</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="alert alert-success form-alert-div">
                            <div class="alert-list-div">
                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Department:</div>
                                        <div>
                                            <strong id="departmentName">
                                                <script>$("#departmentName").html(selectedCbtSubjectSession?.departmentName);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Class:</div>
                                        <div>
                                            <strong id="className">
                                                <script>$("#className").html(selectedCbtSubjectSession?.className);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>Subject:</div>
                                        <div>
                                            <strong id="subjectName">
                                                <script>$("#subjectName").html(selectedCbtSubjectSession?.subjectName);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert-list-back-div">
                                    <div class="alert-list">
                                        <div>CBT title:</div>
                                        <div>
                                            <strong id="cbbtTitle">
                                                <script>$("#cbbtTitle").html(selectedCbtSubjectSession?.cbtTitle);</script>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-clock-fill"></i>
                            <p>Select Arm to View Results</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="armId_container">
                            <script>
                                selectField({
                                    id: 'armId',
                                    title: 'Select Arm',
                                });
                                _getSelectBranchDepartmentClassArm('armId');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="PRINT RESULT" id="printBtn"
                    onclick="proceedPrintCbtResult();">
                    <i class="bi-printer"></i> PRINT RESULT
                </button>
            </div>
        </div>
    </div>
<?php } ?>