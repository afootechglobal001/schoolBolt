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
<div class="alert alert-success top-alert-div animated fadeIn">
    <div><span><i class="bi-person-bounding-box"></i></span> BRANCH PARENT'S LIST ---- <span
            id="pageSession">Loading...</span> - <span id="pageTermName">Loading...</span> - <span
            id="departmentName3">Loading...</span> - <span id="className2">Loading...</span> - <span
            id="armName2">Loading...</span></div>
    <div class="btn-container" id="printAndExportButton"></div>
</div>

<div class="table-div animated fadeIn">
    <table class="table" cellspacing="0" style="width:100%" id="pageContent">
        <script>
        _fetchBranchStudents();
        </script>
    </table>
</div>
<?php } ?>