<?php if ($page == 'galleryPage') { ?>
    <div class="page-title-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="title-div">
            <div>
                <div class="icon-div"><i class="bi bi-images"></i></div>
            </div>
            <div class="text-div">
                <h3>Gallery</h3>
                <p>Manage your gallery to showcase your work and build trust with clients.</p>
            </div>
        </div>

        <div class="btn-div">
            <div class="search-div">
                <input type="text" onkeyup="_filtersGallery(this.value);" placeholder="Search Gallery Here...">   
                <i class="bi bi-search"></i>
            </div>
            <button class="btn" title="ADD NEW GALLERY" onclick="sessionStorage.removeItem('useEachPageSession'); _getForm({page: 'editPagesForm', pageCategory: 'GALLERY', url: portalMiddleWareUrl});">
                <i class="bi-plus-square"></i> ADD NEW GALLERY
            </button>
        </div>
    </div>

    <div class="main-content-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="tables-content-div">
            <div class="content-title">
                <div class="title">
                    <i class="bi bi-images"></i>
                    <p>Portfolio</p>
                </div>
            </div>

            <div class="inner-table-content">
                <div class="grid-div-wrapper" id="galleryPageContent">   
                    <script>_fetchGalleryData();</script> 

                    <div class="content-loading-div">
                        <img src="<?php echo $websiteUrl ?>/all-images/images/spinner.gif" alt="Loading" />
                    </div>
                </div>
                <!-- Pagination -->
                <div id="galleryContentPaginationControls" class="pagination-div"></div>
            </div>
        </div>
    </div>
<?php } ?>