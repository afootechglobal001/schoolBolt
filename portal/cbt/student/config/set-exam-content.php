<?php if ($page == 'setExamPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div">
                    <i class="bi bi-file-earmark-plus-fill"></i>
                </div>
            </div>

            <div class="text-div">
                <h3>Set CBT Exam</h3>
                <p>Create and manage CBT examinations by setting the exam details, subject, questions, duration, and other examination requirements.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text"
                    onkeyup="_filtersCbtExam(this.value);"
                    placeholder="Search Here...">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-file-earmark-plus-fill"></i>
                    <p>Set CBT Exam</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="toggle-wrapper" id="fetchAssignedSubjectContent">
                    <script>
                        _fetchAssignedSubjectData();
                    </script>

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>