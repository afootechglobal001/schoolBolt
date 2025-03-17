<?php if($page=='product_category'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-boxes"></i> <strong>Product Categories</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper product-cat-text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchContent" onkeyup="filters('Content')" placeholder="" title="Type here to serach product category" />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search product category</div>
                </div>
            </div>

            <button class="btn" type="button" title="ADD NEW PRODUCT CATEGORY" onclick="sessionStorage.removeItem('getEachProductCatSession'); _getForm({page: 'product_cat_reg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW PRODUCT CATEGORY
            </button>
        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="other-pg-back-div">
            <div class="product-cat-wrapper" id="pageContent">
                <script>_fetchProductCategory();</script>  
            </div>
        </div>
    </div>
<?php }?>

<?php if ($page=='product_cat_reg'){ ?>
    <script> 
        getEachProductCatSession = JSON.parse(sessionStorage.getItem("getEachProductCatSession"));
        $('#pageTitle, #pageTitle2').html(getEachProductCatSession?.productId ? 'UPDATE PRODUCT CATEGORY':'ADD A NEW PRODUCT CATEGORY');
    </script>

    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="pageTitle"><i class="bi-plus-square"></i> ADD A NEW PRODUCT CATEGORY</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span id="pageTitle2"> ADD A NEW PRODUCT CATEGORY</span></div>
                </div>

                <div class="text_field_container" id="productName_container">
                    <script>
                        textField({
                            id: 'productName',
                            title: 'Product Category Name',
                            value: getEachProductCatSession?.productName ?? ''
                        });
                    </script>
                </div>        
                
                <script>
                    $(document).ready(function() {
                        const picturesArray = getEachProductCatSession?.picturesData ?? [];
                        let pixHtml = '';

                        for (let i = 0; i < picturesArray.length; i++) {
                            const pictures = picturesArray[i].productPix;
                            pixHtml += `
                                <div class="product-pictures-div">
                                    <div class="img"><img src="${productCategoryPixPath}/${pictures}" alt="${productName}"></div>
                                </div>`;
                        }
                        $('#pixPreview').html(pixHtml);
                    });
                </script>

                <div class="text_area_container" id="productTags_container">
                    <script>
                        textField({
                            id: 'productTags',
                            title: 'Product Category Tag',
                            type: 'textarea',
                            value: getEachProductCatSession?.productTags ?? ''
                        });
                    </script>
                </div>

                <div class="alert alert-success form-alert">
                    <span>UPLOAD PRODUCT CATEGORY PICTURES</span>
                    <div class="product-pictures-div">
                        <div id="pixPreview"></div>
                        <label>
                            <div class="img"><img src="<?php echo $websiteUrl;?>/all-images/images/default.png" alt="Tap to upload"/></div>
                            <input type="file" id="productPix" name="productPix[]" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" multiple  onchange="_previewProductCatPix();" style="display:none;"/>
                        </label>
                    </div>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status',
                            fieldValue: getEachProductCatSession?.statusData?.[0]?.statusId ?? '',
                            fieldLabel: getEachProductCatSession?.statusData?.[0]?.statusName ?? ''
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>    
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick="_createUpdateProductCategory();"> <i class="bi-check"></i> SUBMIT </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page=='product_category_modal_form'){?>
    <script> getEachProductCatSession = JSON.parse(sessionStorage.getItem("getEachProductCatSession"));</script>

    <div class="pages-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <div class="grid-div product-grid" id="pixPreviews"></div>

                <script>
                    $(document).ready(function() {
                        const picturesArray = getEachProductCatSession?.picturesData ?? [];
                        let pixHtml = '';

                        for (let i = 0; i < picturesArray.length; i++) {
                            const pictures = picturesArray[i].productPix;
                            pixHtml += `
                                <div class="img-div"><img src="${productCategoryPixPath}/${pictures}" alt="${productName}"></div>
                                `;
                        }
                        $('#pixPreviews').html(pixHtml);
                    });
                </script>

                <div class="grid-div">
                    <div class="text-div">
                        <div class="list-back-div">
                            <div class="list-div">
                                <div>PRODUCT CATEGORY NAME:</div>
                                <div class="input-div" id="productName"><script>$("#productName").html(getEachProductCatSession.productName);</script></div>
                            </div>
                            <div class="list-div">
                                <div>CREATED ON:</div>
                                <div class="input-div" id="createdTime"><script>$("#createdTime").html(getEachProductCatSession.createdTime);</script></div>
                            </div>
                            <div class="list-div">
                                <div>UPDATED ON:</div>
                                <div class="input-div" id="updatedTime"><script>$("#updatedTime").html(getEachProductCatSession.updatedTime);</script></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content-div">   
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Page Content" id="page_content" onclick="_getActiveProductCatPage({divid:'product_cat_page_content', page: 'product_cat_page_content', url: adminPortalLocalUrl});">Page Content </li>
                </ul>
                <button class="close-btn" onclick="_alertClose()" title="Close"><i class="bi-x-lg"></i></button> 
            </div>
            
            <div class="pages-back-div">
                <div id="get_product_cat_details">
                    <script>
                        _getActiveProductCatPage({
                            divid: 'product_cat_page_content',
                            page: 'product_cat_page_content',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>    
            </div>
        </div>      
    </div> 
<?php } ?>

<?php if ($page=='product_cat_page_content'){ ?>
    <script> publishId = JSON.parse(sessionStorage.getItem("publishId"));</script>

    <div class="page-form-div animated fadeIn">
        <div class="page-title">SEO CONTENT</div>
        <div class="form-div">
           <div class="form-input-div">
                <div class="title">PAGE URL</div>
                <div class="text_field_container" id="pageUrl_container">
                    <script>
                        textField({
                            id: 'pageUrl',
                            title: 'page-url'
                        });
                    </script>
                </div>

                <div class="title">PAGE TITLE <span><em>(Not more than 100 words)</em></span></div>
                <div class="text_field_container" id="pageTitle_container">
                    <script>
                        textField({
                            id: 'pageTitle',
                            title: 'Page Title'
                        });
                    </script>
                </div>

                <div class="title">SEO KEYWORDS</div>
                <div class="text_area_container" id="seoKeywords_container">
                    <script>
                        textField({
                            id: 'seoKeywords',
                            title: 'Seo Keywords',
                            type : 'textarea'
                        });
                    </script>
                </div>
                
                <div class="title">SEO DESCRIPTION <span><em>(Not more than 167 words)</em></span></div>
                <div class="text_area_container" id="seoDescription_container">
                    <script>
                        textField({
                            id: 'seoDescription',
                            title: 'Seo Descriptions',
                            type : 'textarea'
                        });
                    </script>
                </div>                       
            </div>
            
            <div class="picture-div">
                <label>
                    <div class="pix-div">
                        <img id="seoFlyerPreviewPix" src="<?php echo $websiteUrl?>/all-images/images/sample.jpg" />
                        <input type="file" id="seoFlyer" name="seoFlyer[]" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"  onchange="seoFlyerPreview.UpdatePreview(this);" />
                    </div>
                </label>
            </div>                        			
        </div>
    </div>

    <div class="page-form-div">
        <div class="page-title">FULL PAGE CONTENT</div>
        <div class="form-div content-form">
            <script src="<?php echo $websiteUrl?>/js/admin/portal/TextEditor.js" referrerpolicy="origin"></script>
            <script>tinymce.init({selector:'#pageContent',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
            <div style="margin-bottom: 5px;">
                <textarea class="text_field" style="width:100%;" rows="27" id="pageContent" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" id="" placeholder=""></textarea>
            </div>

            <div class="btn-div">
                <button class="btn" id="saveBtn" title="Save Page" onclick="_createOrUpdatePage()"><i class="bi-save"></i> SAVE</button>
            </div>
        </div>
    </div>     
<?php }?>