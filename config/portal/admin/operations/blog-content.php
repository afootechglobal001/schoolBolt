<?php if($page=='blog_page'){?>
    <div class="page-title-back-div other-pages-title-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="page-title-div">
            <div class="main-title title"><i class="bi-journals"></i> <strong>Blog & Articles</strong></div>
            <div class="bottom-title">
                Active: <span id="active-staff">10</span> |
                Suspended: <span>5</span>
            </div>
        </div>

        <div class="other-pages-filter-div">
            <div class="text-field-wrapper">
                <div class="text_field_container search_field_container">
                    <input class="text_field dash_text_field" type="text" id="searchBlogs" onkeyup="filters('Blogs')" placeholder="" title="Type here to serach blog..." />
                    <div class="placeholder dash_placeholder"><i class="bi-search"></i> Type here to search blog...</div>
                </div>
            </div>

            <div class="btn-div">
                <button class="btn" type="button" title="ADD NEW BLOG" onclick="_getForm({page: 'blog_reg', url: adminPortalLocalUrl});">
                    <i class="bi-plus-square"></i> ADD NEW BLOG
                </button>
            </div>
        </div>
    </div>

    <div class="pages-back-div" data-aos="fade-in" data-aos-duration="1500">
        <div class="other-pg-back-div" id="fetchAllBlogs">
            <div class="grid-div">
                <div class="btn-div">
                    <button class="btn active-btn" onclick="">EDIT</button>
                    <button class="btn" onclick="_getForm({page: 'blog_modal_form', url: adminPortalLocalUrl});">EDIT PAGE DETAILS</button>
                </div>

                <div class="status-div">ACTIVE</div>
                <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/blog/blog_1.webp" alt="Blog"></div>
                <div class="text-div">
                    <div class="top-text"><span>Announcement</span></div>
                    <h2>5 Quick Recipes Using Fresh Ingredients from Get Food Stuff...</h2>
                    <div class="text-in">
                        <div class="text">UPDATED ON: <span>27 Feb 2025</span> | <span>486</span> VIEWS </div>
                    </div>
                </div>
            </div>

            <div class="grid-div">
                <div class="btn-div">
                    <button class="btn active-btn" onclick="_get_form_with_id('')">EDIT</button>
                    <button class="btn" onclick="_edit_page('<?php echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
                </div>

                <div class="status-div">ACTIVE</div>
                <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/blog/blog_2.jpg" alt="Blog"></div>
                <div class="text-div">
                    <div class="top-text"><span>Announcement</span></div>
                    <h2>How Get Food Stuffs Ensures Freshness in Every Delivery...</h2>
                    <div class="text-in">
                        <div class="text">UPDATED ON: <span>10 Jul 2025</span> | <span>486</span> VIEWS </div>
                    </div>
                </div>
            </div>

            <div class="grid-div">
                <div class="btn-div">
                    <button class="btn active-btn" onclick="_get_form_with_id('')">EDIT</button>
                    <button class="btn" onclick="_edit_page('<?php echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
                </div>

                <div class="status-div">ACTIVE</div>
                <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/blog/blog_3.jpg" alt="Blog"></div>
                <div class="text-div">
                    <div class="top-text"><span>Announcement</span></div>
                    <h2>Top 5 Reasons to Choose Get Food Stuffs for Your Grocery Needs...</h2>
                    <div class="text-in">
                        <div class="text">UPDATED ON: <span>22 Jul 2025</span> | <span>486</span> VIEWS </div>
                    </div>
                </div>
            </div>

            <div class="grid-div">
                <div class="btn-div">
                    <button class="btn active-btn" onclick="_get_form_with_id('')">EDIT</button>
                    <button class="btn" onclick="_edit_page('<?php echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
                </div>

                <div class="status-div">ACTIVE</div>
                <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/blog/blog_2.jpg" alt="Blog"></div>
                <div class="text-div">
                    <div class="top-text"><span>Announcement</span></div>
                    <h2>How Get Food Stuffs Ensures Freshness in Every Delivery...</h2>
                    <div class="text-in">
                        <div class="text">UPDATED ON: <span>10 Jul 2025</span> | <span>486</span> VIEWS </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php if ($page=='blog_reg'){ ?>
    <div class="slide-form-div" data-aos="fade-left" data-aos-duration="900">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW BLOG</span>
                <div class="close" title="Close" onclick="_alertClose();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert alert-success form-alert">Kindly fill the form below to <span> ADD A NEW BLOG</span></div>
                </div>

                <div class="text_field_container" id="searchBlogCat_container">
                    <script>
                        selectField({
                            id: 'searchBlogCat',
                            title: 'Select Blog Category'
                        });
                        _getSelectBlogCategory('searchBlogCat');
                    </script>
                </div>

                <div class="text_field_container" id="blogTitle_container">
                    <script>
                        textField({
                            id: 'blogTitle',
                            title: 'Blog Title'
                        });
                    </script>
                </div>

                <div class="title">UPLOAD BLOG PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <label>
                        <img id="blog_preview_pix" src="<?php echo $websiteUrl?>/all-images/images/sample.jpg" alt="Default Image">
                        <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="blogPixPreview.UpdatePreview(this);" />
                    </div> 
                </label>

                <div class="text_field_container" id="searchStatus_container">
                    <script>
                        selectField({
                            id: 'searchStatus',
                            title: 'Select Status'
                        });
                        _getSelectStatus('searchStatus');
                    </script>
                </div>

                <div>    
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick=""> <i class="bi-check"></i> SUBMIT </button>             
                </div>
            </div>
        </div>  
    </div>
<?php } ?>

<?php if ($page=='blog_modal_form'){?>
    <div class="pages-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <div class="grid-div">
                    <div class="img-div"><img src="<?php echo $websiteUrl?>/all-images/blog/blog_1.webp" alt="Blog"></div>
                    <div class="text-div">
                        <div class="top-text"><span>Announcement</span></div>
                        <h2>Maximizing Business Efficiency Through Custom Software...</h2>
                        <div class="text-in">
                            <div class="text">UPDATED ON: <span>27 Jul 2024</span> | <span>486</span> VIEWS </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pages-content-div">   
            <div class="title-div">
                <ul>
                    <li class="active-li" title="Page Content" id="page_content" onclick="_getActiveBlogPage({divid:'page_content', page: 'page_content', url: adminPortalLocalUrl});">Page Content </li>
                    <li title="Upload Picture" id="picture_page" onclick="_getActiveBlogPage({divid:'picture_page', page: 'picture_page', url: adminPortalLocalUrl});">Upload Picture</li>
                </ul>
                <button class="close-btn" onclick="_alertClose()" title="Close"><i class="bi-x-lg"></i></button> 
            </div>
            
            <div class="pages-back-div">
                <div id="get_blog_details">
                    <script>
                        _getActiveBlogPage({
                            divid: 'page_content',
                            page: 'page_content',
                            url: adminPortalLocalUrl
                        });
                    </script>
                </div>    
            </div>
        </div>      
    </div> 
<?php } ?>

<?php if ($page=='page_content'){ ?>
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

<?php if ($page=='picture_page'){ ?>    
    <div class="page-form-div animated fadeIn">
        <div class="page-title">UPLOAD MORE PICTURES</div>
        <div class="form-div form-picture-div">
            <div class="picture-back-div">
                
                <div class="picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php echo $websiteUrl?>/all-images/blog/blog_1.webp" alt="Blog">
                </div>

                <div class="picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php echo $websiteUrl?>/all-images/blog/blog_2.jpg" alt="Blog">
                </div>

                <div class="picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php echo $websiteUrl?>/all-images/blog/blog_3.jpg" alt="Blog">
                </div>

                <div class="picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php echo $websiteUrl?>/all-images/blog/blog_3.jpg" alt="Blog">
                </div>

                <div class="picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php echo $websiteUrl?>/all-images/blog/blog_3.jpg" alt="Blog">
                </div>

                <div class="picture-div">
                    <label>
                        <img src="<?php echo $websiteUrl?>/all-images/images/default.png"/>
                        <input type="file" id="pictures" name="pictures[]" multiple accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG"  onchange="_save_page_other_pictures('<?php echo $publish_id;?>')" style="display:none;"/>
                    </label>
                </div>
            </div>  
        </div>
    </div>  
<?php }?>