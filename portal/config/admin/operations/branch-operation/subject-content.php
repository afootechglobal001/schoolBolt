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

            <button class="btn" id="submit_btn" title="Proceed Request" onclick="_getActiveBranchPage({divid:'branch_subject_page', page: 'branch_subject_page', url: adminPortalLocalUrl});">PROCEED <i class="bi-arrow-right"></i> </button>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'branch_subject_page') { ?>
    <div class="alert alert-success top-alert-div animated fadeIn">
        <div><span><i class="bi-person-bounding-box"></i></span> BRANCH SUBJECT'S LIST ---- <span id="session">2024/2025</span> - <span id="termName">FIRST TEAM</span> - <span id="departmentName3">NURSERY</span> - <span id="className2">NURSERY 1</span></div>
        <div class="btn-container">
            <button class="btn" title="PRINT RECORDS" id="" onclick=""><i class="bi-printer"></i> PRINT</button>
            <button class="btn" title="EXPORT RECORDS" id="" onclick=""><i class="bi-file-earmark-excel"></i> EXPORT</button>
        </div>
    </div>

    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="pageContent">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Department</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Subject Teacher</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td>2024/2025</td>
                    <td>FIRST TERM</td>
                    <td>NURSERY</td>
                    <td>NURSERY 1</td>
                    <td>BASIC SCIENCE</td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="<?php echo $websiteUrl?>/uploaded_files/staffPix/default.jpg" alt="MR EMMANUEL PAUL"/>
                            </div>

                            <div class="text-div">
                                <div class="first-class">MR EMMANUEL PAUL</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick="_getForm({page: 'assign_subject_staff', layer:2, url: adminPortalLocalUrl});"><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                </tr>

                <tr class="tb-row">
                    <td>2</td>
                    <td>2024/2025</td>
                    <td>FIRST TERM</td>
                    <td>NURSERY</td>
                    <td>NURSERY 1</td>
                    <td>BASIC TECHNOLOGY</td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="<?php echo $websiteUrl?>/uploaded_files/staffPix/default.jpg" alt="MR EMMANUEL PAUL"/>
                            </div>

                            <div class="text-div">
                                <div class="first-class">MR EMMANUEL PAUL</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                </tr>

                <tr class="tb-row">
                    <td>3</td>
                    <td>2024/2025</td>
                    <td>FIRST TERM</td>
                    <td>NURSERY</td>
                    <td>NURSERY 1</td>
                    <td>CHRISTIAN RELIGIOUS STUDIES</td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="<?php echo $websiteUrl?>/uploaded_files/staffPix/default.jpg" alt="MR EMMANUEL PAUL"/>
                            </div>

                            <div class="text-div">
                                <div class="first-class">MR EMMANUEL PAUL</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                </tr>

                <tr class="tb-row">
                    <td>4</td>
                    <td>2024/2025</td>
                    <td>FIRST TERM</td>
                    <td>NURSERY</td>
                    <td>NURSERY 1</td>
                    <td>CIVIC EDUCATION</td>
                    <td>
                        <div class="text-back-div">
                            <div class="image-div general-passport">
                                <img src="<?php echo $websiteUrl?>/uploaded_files/staffPix/default.jpg" alt="MR EMMANUEL PAUL"/>
                            </div>

                            <div class="text-div">
                                <div class="first-class">MR EMMANUEL PAUL</div>
                                <div class="second-class">seunemmanuel107@gmail.com</div>
                            </div>
                        </div>
                    </td>
                    <td><button class="btn view-btn" title="Click to edit assign class teacher" onclick=""><i class="bi-bookmark-check"></i> ASSIGN</button></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>

<?php if ($page=='assign_subject_staff') { ?>

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
                            <div><span id="branchName">AFOOTECH GLOBAL INSTITUTE</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Session:</div>
                            <div><span id="branchName">2024/2025</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Term:</div>
                            <div><span id="branchName">FIRST TERM</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Department:</div>
                            <div><span id="departmentName">NURSERY</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Class:</div>
                            <div><span id="level">NURSERY 1</span></div>
                        </div>
                    </div>
                </div>

                <div class="text_field_container" id="staffId_container">
                    <script>
                        selectField({
                            id: 'staffId',
                            title: 'Select Class Teacher'
                        });
                        _getSelectClassTeachers('staffId');
                    </script>
                </div>

                <div>
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>