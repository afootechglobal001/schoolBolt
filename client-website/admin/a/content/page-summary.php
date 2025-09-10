<?php if ($page_category_id=='event_category'){?>
    <div class="grid-div">
        <div class="img-div"><img id="event_preview_pix" src="" alt="Sermon"></div>
        <div class="text-div">
            <div class="top-text"><span><i class="bi-calendar-check"></i> </span><em id="event_start_time">xxxx</em> - <em id="event_end_time">xxxx</em> </div>  
            <h2 id="summary_reg_title">xxxx</h2>
            <div class="text-in">
                <div class="text">UPDATED ON: <span id="formattedDate"></span> | <span id="page_view">0</span> VIEWS </div>
            </div>
        </div>
    </div>
    <script>_fetchEachEvent('<?php echo $page_category_id?>','<?php echo $publish_id?>');</script>
<?php }?>

<?php if ($page_category_id=='gallery_category'){?>
    <div class="grid-div">
        <div class="img-div"><img id="gallery_preview_pix" src="" alt="Gallery"></div>
        <div class="text-div">
            <div class="top-text"><span id="gallery_sub_title">xxxx</span></div>
            <h2 id="summary_reg_title">xxxx</h2>
            <div class="text-in">
                <div class="text">UPDATED ON: <span id="formattedDate">xxxx</span> | <span id="page_view">0</span> VIEWS </div>
            </div>
        </div>
    </div>
    <script>_fetchEachGallery('<?php echo $page_category_id?>','<?php echo $publish_id?>');</script>
<?php }?>

<?php if ($page_category_id=='blog_category'){?>
    <div class="grid-div">
        <div class="img-div"><img id="blog_preview_pix" src="" alt="Blog"></div>
        <div class="text-div">
            <div class="top-text"><span id="cat_name">xxx</span></div>
            <h2 id="summary_reg_title">xxx</h2>
            <div class="text-in">
                <div class="text">UPDATED ON: <span id="formattedDate">xxxx</span> | <span id="blog_view">0</span> VIEWS </div>
            </div>
        </div>
    </div>
    <script>_fetchEachBlogs('<?php echo $page_category_id?>','<?php echo $publish_id?>');</script>
<?php }?>
