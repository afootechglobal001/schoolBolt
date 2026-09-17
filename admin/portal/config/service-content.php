<?php if ($page == 'servicePage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-stack"></i></div>
            </div>
            <div class="text-div">
                <h3>Services</h3>
                <p>Organize and manage all Services to ensure smooth listing and browsing.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersService(this.value);" placeholder="Search Services Here...">   
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW SERVICE" onclick="sessionStorage.removeItem('useEachPageSession'); _getForm({page: 'editPagesForm', pageCategory: 'SERVICE', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW SERVICE
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-stack"></i>
                    <p>Services</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="grid-div-wrapper" id="servicePageContent">
                    <script>_fetchServiceData();</script> 

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
                <!-- Pagination -->
                <div id="serviceContentPaginationControls" class="pagination-div"></div>
            </div>
        </div>
    </div>
<?php } ?>