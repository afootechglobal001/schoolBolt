<?php if ($page == 'projectCategory') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-tags"></i></div>
            </div>
            <div class="text-div">
                <div class="back-div"><span title="Click to return to System Settings" onclick="_getActivePage({page:'settingsPage', divid:'settingsPage'});"><i class="bi-arrow-left"></i>System Settings /</span> Project Category Configurations</div>
                <h3>Project Category Configurations</h3>
                <p>Manage and configure project categories to support accurate data classification and streamlined workflows.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                 <input type="text" onkeyup="_filtersProjectCategory(this.value);" placeholder="Search Category Here...">
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW CATEGORY" onclick="sessionStorage.removeItem('useEachProjectCategorySession'); _getForm({page: 'projectCategoryReg', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW CATEGORY
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-tags"></i>
                    <p>Project Category Configurations</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%" id="">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Created By</th>
                                <th>Updated By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="projectCategoryContent">
                            <script>
                                _fetchProjectCategoryData();
                            </script>
                            
                            <tr>
                                <td colspan="8">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                     <!-- Pagination -->
                    <div id="projectCategoryContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'projectCategoryReg') { ?>
    <script>
        useEachProjectCategorySession = JSON.parse(sessionStorage.getItem("useEachProjectCategorySession")) || {};
        $('#pageTitle').html(useEachProjectCategorySession?.projectCategoryId ? 'UPDATE PROJECT CATEGORY' : 'ADD A NEW PROJECT CATEGORY');
        $('#subTitle, #subTitle2').html(useEachProjectCategorySession?.projectCategoryId ? 'update this project category' : 'create new project category');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div"><i class="bi bi-tags"></i></div>
                <h3 id="pageTitle">ADD A NEW CATEGORY</h3>
            </div>
            <div class="btn-div">
                <button class="btn" title="Close" onclick="_alertClose(<?php echo $modalLayer ?>);">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>
        </div>

        <!-- /////////// Title ////////////////////////////// -->
        <div class="container-back-div">
            <div class="form-notification">
                <p>You are about to <span id="subTitle"></span>. Please complete the form below with accurate details to successfully <span id="subTitle2"></span>.</p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">
                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-tags"></i>
                            <p>Project Category</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="projectCategoryName_container">
                            <script>
                                textField({
                                    id: 'projectCategoryName',
                                    title: 'Project Category Name',
                                    value: useEachProjectCategorySession?.projectCategoryName,
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useEachProjectCategorySession?.statusData?.statusId ?? '',
                                    fieldLabel: useEachProjectCategorySession?.statusData?.statusName ?? ''
                                });
                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn" onclick="_addAndUpdateProjectCategory();"> <i class="bi-check"></i> SUBMIT </button>
            </div>
        </div>
    </div>
<?php } ?>