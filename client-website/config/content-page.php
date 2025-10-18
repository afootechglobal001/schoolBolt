<?php if($page=='gallery-images'){?>
    <div class="preview-content animated fadeIn">
        <div class="gallery-in">
            <div class="main-preview" id="preview_image">
                <script>_fetchGall('<?php echo $publish_id?>');</script>
            </div>

            <div class="thumbnail-list" id="fetchGalleryList">  
                <script>_fetchGalleryList('<?php echo $publish_id?>');</script>            	
            </div>
        </div>
    </div>
<?php }?>

<?php if($page=='testimonial-form'){ ?>
    <div class="testimonial-form animated fadeIn">
        <div class="testimonial-header">
            <h2><i class="bi-chat-quote-fill"></i> Testimonial Form </h2>    
            <button class="close-btn" title="Close" onclick="_alert_close2();"><i class="bi-x"></i></button>
        </div>

        <div class="div-in testimonial-div-in">
            <div class="text_field_container">
                <input class="text_field" type="text" id="fullname" placeholder=""/>
                <div class="placeholder">Enter Your Name:</div>
            </div>  

            <div class="text_field_container">
                <input class="text_field" type="email" id="email" placeholder=""/>
                <div class="placeholder">Enter Your Email Address:</div>
            </div>

            <div class="text_field_container">
                <input class="text_field" type="tel" id="phone" placeholder=""/>
                <div class="placeholder">Enter Your Phone Number:</div>
            </div>

            <div class="text_field_container">
                <select id="relationship_type_id" class="text_field" placeholder="">
                    <option value="">-Select here</option>
                    <script>_getSelectRelationship();</script>
                </select>
                <div class="placeholder">--Select Relationship--</div>
            </div>

            <div class="text_field_container">
                <textarea class="text_field text_area" row="20" type="text" id="testimony"  placeholder=""></textarea>
                <div class="placeholder">Testimony:</div>
            </div>    
            
            <button class="btn" id="submit_btn" title="Send Testimony" onclick="_sendTestimony();">Send <i class="bi-send-check"></i></button>                           
        </div>
    </div>
<?php } ?>

<?php if($page=='send_contact_success'){?>
    <div class="successful-div animated bounceInDown">
        <div class="success-in">
            <div class="gif">
                <img src="<?php echo $website_url?>/all-images/images/success.gif" alt="successful gif">
            </div>
            <h3>EMAIL SENT SUCCESSFULLY</h3>
            <button class="btn" onclick="_alert_close2();">OKAY <i class="bi-check2-all"></i></button>
        </div> 
    </div>
<?php }?>