<?php if ($page == 'cbtConfigPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-gear-wide-connected"></i></div>
            </div>
            <div class="text-div">
                <h3>CBT Configuration</h3>
                <p>Manage and configure the settings used to control CBT examinations and examination activities.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersCbtConfig(this.value);" placeholder="Search Here...">
                <i class="bi bi-search"></i>
            </div>

            <button class="btn" title="ADD NEW CBT CONFIGURATION"
                onclick="sessionStorage.removeItem('useEachCbtConfigSession'); _getForm({page: 'cbtConfigReg', url: cbtAdminMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW CONFIGURATION
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-gear-wide-connected"></i>
                    <p>CBT Configuration</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="table-div animated fadeIn">
                    <table class="table" cellspacing="0" style="width:100%">
                        <thead>
                            <tr class="tb-col">
                                <th>sn</th>
                                <th>CBT ID</th>
                                <th>CBT Title</th>
                                <th>Description</th>
                                <th>Updated By</th>
                                <th>Last Update Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="cbtConfigContent">
                            <script>
                                _fetchCbtConfigData();
                            </script>

                            <tr>
                                <td colspan="8">
                                    <div class="content-loading-div">
                                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif"
                                            alt="Loading" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div id="cbtConfigContentPaginationControls" class="pagination-div"></div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'cbtConfigReg') { ?>
    <script>
        useEachCbtConfigSession = JSON.parse(sessionStorage.getItem("useEachCbtConfigSession"));

        $('#pageTitle').html(
            useEachCbtConfigSession?.cbtId
                ? 'UPDATE CBT CONFIGURATION'
                : 'ADD NEW CBT CONFIGURATION'
        );

        $('#subTitle, #subTitle2').html(
            useEachCbtConfigSession?.cbtId
                ? 'update this CBT configuration'
                : 'create a new CBT configuration'
        );
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="form-title-div">
            <div class="title-div">
                <div class="icon-div">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>

                <h3 id="pageTitle">ADD A NEW CBT CONFIGURATION</h3>
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
                    You are about to <span id="subTitle"></span>.
                    Please complete the form below with accurate details to
                    successfully <span id="subTitle2"></span>.
                </p>
            </div>

            <div class="main-content-div form-main-content-div">
                <div class="tables-content-div form-table-content-div">

                    <div class="content-title">
                        <div class="title">
                            <i class="bi bi-gear-wide-connected"></i>
                            <p>CBT Configuration</p>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="text_field_container" id="cbtTitle_container">
                            <script>
                                textField({
                                    id: 'cbtTitle',
                                    title: 'CBT Title',
                                    value: useEachCbtConfigSession?.cbtTitle,
                                });
                            </script>
                        </div>

                        <div class="text_area_container" id="cbtDescription_container">
                            <script>
                                textField({
                                    id: 'cbtDescription',
                                    title: 'CBT Description',
                                    type: 'textarea',
                                    value: useEachCbtConfigSession?.cbtDescription,
                                });
                            </script>
                        </div>

                        <div class="text_field_container" id="statusId_container">
                            <script>
                                selectField({
                                    id: 'statusId',
                                    title: 'Select Status',
                                    fieldValue: useEachCbtConfigSession?.statusData?.statusId ?? '',
                                    fieldLabel: useEachCbtConfigSession?.statusData?.statusName ?? ''
                                });

                                _getSelectStatusId('statusId', '1,2');
                            </script>
                        </div>

                    </div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" title="SUBMIT" id="submitBtn"
                    onclick="_addAndUpdateCbtConfig();">
                    <i class="bi-check"></i> SUBMIT
                </button>
            </div>
        </div>
    </div>
<?php } ?>