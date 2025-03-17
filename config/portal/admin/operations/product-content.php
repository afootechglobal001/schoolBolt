<?php if($page=='product_page'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="back-div"><span title="Click and navigate back to product categories" onclick="_getActivePage({page:'product_category', divid:'products'});"><i class="bi-arrow-left"></i> Product Categories</span> Products</div>
            <div class="main-title title"><i class="bi-boxes"></i> <strong>Products</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper product-cat-text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchProduct" onkeyup="filters('Product')" placeholder="" title="Type here to serach product" />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search product</div>
                </div>
            </div>

            <button class="btn" type="button" title="ADD NEW PRODUCT" onclick="_getForm({page: 'product_reg', url: adminPortalLocalUrl});">
                <i class="bi-plus-square"></i> ADD NEW PRODUCT
            </button>
        </div>
    </div>

    <div class="pages-back-div product-pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="top-header">
            <ul>
                <li class="active-li" title="GRID VIEW" id="gridView" onclick="_getActiveProductViewPage({divid:'gridView', page: 'gridView', url: adminPortalLocalUrl});"><i class="bi-grid"></i> GRID VIEW</li>
                <li class="no-border" title="LIST VIEW" id="listView" onclick="_getActiveProductViewPage({divid:'listView', page: 'listView', url: adminPortalLocalUrl});"><i class="bi-list-stars"></i> LIST VIEW</li>
            </ul>
        </div>

        <div class="other-pg-back-div product-other-pg-back-div" id="getProductView">
            <script>
                _getActiveProductViewPage({
                    divid: 'gridView',
                    page: 'gridView',
                    url: adminPortalLocalUrl
                });
            </script>
        </div>
    </div>
<?php }?>

<?php if ($page=='product_reg'){ ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW PRODUCT</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW PRODUCT</span></div>
                </div>

                <div class="text_field_container" id="productName_container">
                    <script>
                        textField({
                            id: 'productName',
                            title: 'Product Name'
                        });
                    </script>
                </div>        
                
                <div class="title">Product Description</div>
                <script src="<?php echo $websiteUrl?>/js/admin/portal/TextEditor.js" referrerpolicy="origin"></script>
                <script>tinymce.init({selector:'#faq_answer',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
                <div> 
                    <textarea class="text_field" rows="5" id="faq_answer" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" placeholder=""></textarea>          
                </div> 

                <div class="text_area_container" id="tag_container">
                    <script>
                        textField({
                            id: 'tag',
                            title: 'Product Tag',
                            type: 'textarea'
                        });
                    </script>
                </div>

                <div class="alert alert-success form-alert">
                    <span>UPLOAD PRODUCT PICTURES</span>
                    <div class="product-pictures-div">
                        <div id="pixPreview"></div>
                        <label>
                            <div class="img"><img src="<?php echo $websiteUrl;?>/all-images/images/default.png" alt="Tap to upload"/></div>
                            <input type="file" id="product_cat_pix" name="product_cat_pix[]" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" multiple  onchange="_previewProductCatPix();" style="display:none;"/>
                        </label>
                    </div>
                </div>

                <div class="text_field_container" id="statusId_container">
                    <script>
                        selectField({
                            id: 'statusId',
                            title: 'Select Status'
                        });
                        _getSelectStatusId('statusId', '1,2');
                    </script>
                </div>

                <div>    
                    <button class="btn" title="SUBMIT" id="submitBtn" onclick=""> <i class="bi-check"></i> SUBMIT </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page == 'gridView') { ?>
    <div class="product-cat-wrapper" id="fetchAllProduct">
        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="_getForm({page: 'product_modal_form', url: adminPortalLocalUrl});">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div ACTIVE">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/palm-oil.jpg" alt="<?php echo $appName ?> 5L PALM OIL + KEG" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>5L PALM OIL + KEG</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="_getForm({page: 'product_category_modal_form', url: adminPortalLocalUrl});">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div ACTIVE">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/terra.jpg" alt="<?php echo $appName ?> GOLDEN TERRA" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>GOLDEN TERRA SOYA OIL 4.5L</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div ACTIVE">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/devon.jpg" alt="<?php echo $appName ?> DEVON KINGS" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>DEVON KINGS VEG. OIL 25L</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div ACTIVE">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/kings_oil.jpg" alt="<?php echo $appName ?> DEVON KING'S" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>DEVON KING'S PURE VEGETABLE OIL -5L</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div ACTIVE">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/devon_kings.png" alt="<?php echo $appName ?> DEVON KINGS VEG. OIL 750ML" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>DEVON KINGS VEG. OIL 750ML</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div">ACTIVE</div>
            <div class="image-div">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/devon_kings.png" alt="<?php echo $appName ?> DEVON KINGS VEG. OIL 750ML" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>DEVON KINGS VEG. OIL 750ML</h3>
                </div>
            </div>
        </div>

        <div class="product-cat-div main-product-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="">EDIT</button>
                <button class="btn" onclick="">EDIT PAGE DETAILS</button>
            </div>
            <div class="status-div SUSPEND">SUSPEND</div>
            <div class="image-div SUSPEND">
                <img src="<?php echo $websiteUrl ?>/all-images/products-pix/palm_oil_5l.webp" alt="<?php echo $appName ?> 5L PALM OIL + KEG" />
            </div>
            <div class="text-div">
                <div class="inner-div">
                    <h4>EDIBLE OIL</h4>
                    <h3>5L PALM OIL + KEG</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'listView') { ?>
    <div class="table-div animated fadeIn">
        <table class="table" cellspacing="0" style="width:100%" id="fetchAllCustomers">
            <thead>
                <tr class="tb-col">
                    <th>sn</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Modified By</th>
                    <th>Date of Reg.</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to edit product" onclick="">PROD20220605070858001</td>
                    <td class="clickable-td" title="Click to edit product">5L PALM OIL + KEG</td>
                    <td>EDIBLE OIL</td>
                    <td>Cooking oil is used for frying, cooking, baking and even dressing meals. We can't do without it in the kitchen. When preparing food, it's unlikely you can make any meal.</td>
                    <td>EMMANUEL PAUL</td>
                    <td>2024-11-18 03:28:41</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                </tr>

                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to edit product" onclick="">PROD20220605070858002</td>
                    <td class="clickable-td" title="Click to edit product">GOLDEN TERRA SOYA OIL 4.5L</td>
                    <td>EDIBLE OIL</td>
                    <td>Cooking oil is used for frying, cooking, baking and even dressing meals. We can't do without it in the kitchen. When preparing food, it's unlikely you can make any meal.</td>
                    <td>EMMANUEL PAUL</td>
                    <td>2024-11-18 03:28:41</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                </tr>

                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to edit product" onclick="">PROD20220605070858003</td>
                    <td class="clickable-td" title="Click to edit product">DEVON KINGS VEG. OIL 25L</td>
                    <td>EDIBLE OIL</td>
                    <td>Cooking oil is used for frying, cooking, baking and even dressing meals. We can't do without it in the kitchen. When preparing food, it's unlikely you can make any meal.</td>
                    <td>EMMANUEL PAUL</td>
                    <td>2024-11-18 03:28:41</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                </tr>

                <tr class="tb-row">
                    <td>1</td>
                    <td class="clickable-td" title="Click to edit product" onclick="">PROD20220605070858004</td>
                    <td class="clickable-td" title="Click to edit product">DEVON KINGS VEG. OIL 750ML</td>
                    <td>EDIBLE OIL</td>
                    <td>Cooking oil is used for frying, cooking, baking and even dressing meals. We can't do without it in the kitchen. When preparing food, it's unlikely you can make any meal.</td>
                    <td>EMMANUEL PAUL</td>
                    <td>2024-11-18 03:28:41</td>
                    <td><div class="status-div ACTIVE">ACTIVE</div></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>


<?php if ($page=='product_modal_form'){?>
    <div class="pages-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <div class="grid-div product-grid">
                    <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/products-pix/palm-oil.jpg" alt="<?php echo $appName ?> 5L PALM OIL + KEG"></div>
                </div>

                <div class="grid-div">
                    <div class="text-div">
                        <div class="list-back-div">
                            <div class="list-div">
                                <div>PRODUCT NAME:</div>
                                <div class="input-div" id="">5L PALM OIL + KEG</div>
                            </div>
                            <div class="list-div">
                                <div>PRODUCT DESCRIPTION:</div>
                                <div class="input-div" id="">Cooking oil is used for frying, cooking, baking and even dressing meals. We can't do without it in the kitchen. When preparing food, it's unlikely you can make any meal.</div>
                            </div>
                            <div class="list-div">
                                <div>CREATED ON:</div>
                                <div class="input-div" id="">2024-11-18 03:28:41</div>
                            </div>
                            <div class="list-div">
                                <div>UPDATED ON:</div>
                                <div class="input-div" id="">2024-11-18 03:28:41</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content-div">   
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Page Content" id="product_page_content" onclick="_getActiveProductCatPage({divid:'product_page_content', page: 'product_cat_page_content', url: adminPortalLocalUrl});">Page Content </li>
                </ul>
                <button class="close-btn" onclick="_alertClose()" title="Close"><i class="bi-x-lg"></i></button> 
            </div>
            
            <div class="pages-back-div">
                <div id="get_product_cat_details">
                    <script>
                        _getActiveProductCatPage({
                            divid: 'product_page_content',
                            page: 'product_page_content',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>    
            </div>
        </div>      
    </div> 
<?php } ?>

<?php if ($page=='product_page_content'){ ?>
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
                <div class="text_area_container" id="SeoDescription_container">
                    <script>
                        textField({
                            id: 'SeoDescription',
                            title: 'Seo Descriptions',
                            type : 'textarea'
                        });
                    </script>
                </div>                       
            </div>
            
            <div class="picture-div">
                <label>
                    <div class="pix-div"><img id="seo_flyer_preview_pix" src="<?php echo $websiteUrl?>/all-images/images/sample.jpg"  id="seo-flyer" /></div>
                    <input type="file" id="seo_flyer" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"  onchange="seoFlyer.UpdatePreview(this);" />
                </label>
            </div>                        			
        </div>
    </div>

    <div class="page-form-div">
        <div class="page-title">FULL PAGE CONTENT</div>
        <div class="form-div content-form">
            <script src="<?php echo $websiteUrl?>/js/admin/portal/TextEditor.js" referrerpolicy="origin"></script>
            <script>tinymce.init({selector:'#page_content_text',  // change this value according to your HTML
                plugins: "link, image, table"
                });</script>
            <div style="margin-bottom: 5px;">
                <textarea class="text_field" style="width:100%;" rows="27" id="page_content_text" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" id="" placeholder=""></textarea>
            </div>

            <div class="btn-div">
                <button class="btn" id="save_btn" title="Save Page" onclick="_addPageContent('<?php echo $publish_id?>')"><i class="bi-save"></i> SAVE</button>
            </div>
        </div>
    </div>     
<?php }?>