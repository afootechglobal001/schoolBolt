<?php if ($page=='page-content'){ ?>
    <div class="page-form-div animated fadeIn">
        <div class="page-title">SEO CONTENT</div>
        <div class="form-div">
            <div class="form-input-div">
                <div class="title">PAGE URL</div>
                <div class="text_field_container">
                    <input class="text_field" type="text" id="page_url" placeholder=""/>
                    <div class="placeholder">page-url:</div>
                </div>

                <div class="title">PAGE TITLE <span><em>(Not more than 100 words)</em></span></div>
                <div class="text_field_container">
                    <input class="text_field" type="text" maxlength="100" id="page_title" placeholder=""/>
                    <div class="placeholder">Page Title:</div>
                </div>

                <div class="title">SEO KEYWORDS</div>
                <div class="text_field_container text_area_container">
                    <textarea class="text_field text_area" type="text" id="seo_keywords" placeholder=""></textarea>
                    <div class="placeholder">Seo Keywords:</div>
                </div>
                
                <div class="title">SEO DESCRIPTION <span><em>(Not more than 167 words)</em></span></div>
                <div class="text_field_container text_area_container">
                    <textarea class="text_field text_area" type="text" maxlength="167" id="seo_description" placeholder=""></textarea>
                    <div class="placeholder">Seo Description:</div>
                </div>                        
            </div>
            
            <div class="picture-div">
                <label>
                    <div class="pix-div"><img id="seo_flyer_preview_pix" src="<?php echo $website_url?>/all-images/images/sample.jpg"  id="seo-flyer" /></div>
                    <input type="file" id="seo_flyer" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif"  onchange="seoFlyer.UpdatePreview(this);" />
                </label>
            </div>                        			
        </div>
    </div>

    <div class="page-form-div">
        <div class="page-title">FULL PAGE CONTENT</div>
        <div class="form-div content-form">
            <script src="js/TextEditor.js" referrerpolicy="origin"></script>
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
    <script>_fetchPageContent('<?php echo $publish_id?>');</script>    
<?php }?>


<?php if ($page=='picture-page'){ ?>    
    <div class="page-form-div animated fadeIn">
        <div class="page-title">UPLOAD MORE PICTURES</div>
        <div class="form-div content-form video-content-form">
            <div class="video-back-div" >
                <div id="fetchPagePicture"></div>
                
                <!-- <div class="video-div picture-div">
                    <div class="icon-div" onclick=""><i class="bi-trash"></i></div>
                    <img src="<?php //echo $website_url?>/all-images/body-pix/gallery_16.jpg" alt="Gallery">
                </div>  -->

                <div class="video-div select-video-div select-pix-div">
                    <label>
                        <div class="pix-div"><img src="<?php echo $website_url?>/all-images/images/default.png"/></div>
                        <input type="file" id="pictures" name="pictures[]" multiple accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG"  onchange="_save_page_other_pictures('<?php echo $publish_id;?>')" style="display:none;"/>
                    </label>
                </div>
            </div>  
        </div>
    </div>  
    <script>_fetchPagePicture('<?php echo $publish_id?>');</script>
<?php }?>
