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
<div class="alert alert-success top-alert-div animated fadeIn" id="pageTitleDiv">

</div>

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