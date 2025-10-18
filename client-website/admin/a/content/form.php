<?php if ($view_content == 'edit_page_form') { ?>
    <div class="pages-creation-panel">
        <div class="side-bar">
            <div class="div-in">
                <?php include 'page-summary.php' ?>
            </div>
        </div>

        <div class="pages-content-div">
            <div class="title-div">
                <ul>
                    <?php if ($page_category_id == 'event_category') { ?>
                        <li class="active-li" title="Page Content" id="page_content" onclick="_check_page_content('page_content','page-content', '<?php echo $publish_id ?>')">Page Content </li>
                    <?php } ?>

                    <?php if ($page_category_id == 'gallery_category') { ?>
                        <li title="Upload Picture" id="picture_page" onclick="_check_page_content('picture_page','picture-page', '<?php echo $publish_id ?>')">Upload Picture</li>
                    <?php } ?>

                    <?php if ($page_category_id == 'blog_category') { ?>
                        <li class="active-li" title="Page Content" id="page_content" onclick="_check_page_content('page_content','page-content', '<?php echo $publish_id ?>')">Page Content </li>
                        <li title="Upload Picture" id="picture_page" onclick="_check_page_content('picture_page','picture-page', '<?php echo $publish_id ?>')">Upload Picture</li>
                    <?php } ?>
                </ul>
                <button class="close-btn" onclick="_alert_close()" title="Close"><i class="bi-x-lg"></i></button>
            </div>

            <div class="pages-back-div">
                <div id="get_pages_details">
                    <?php
                    if ($page_category_id == 'gallery_category') {
                        $page = 'picture-page';
                    } else {
                        $page = 'page-content';
                    }
                    include 'page-details.php';
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($page == 'staff_reg') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW STAFF</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> ADD A NEW STAFF</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="fullname" placeholder="" />
                    <div class="placeholder">Full Name:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="email" placeholder="" />
                    <div class="placeholder">Email Address:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="tel" id="phone" placeholder="" onkeypress="isNumber_Check(event)" />
                    <div class="placeholder">Phone Number:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="address" placeholder="" />
                    <div class="placeholder">Home Address:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="position" title="Position" placeholder="" />
                    <div class="placeholder">Position:</div>
                </div>

                <div class="text_field_container">
                    <select id="role_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectRole('role_id');
                        </script>
                    </select>
                    <div class="placeholder">--Select Role--</div>
                </div>

                <div class="text_field_container">
                    <select id="status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick="_addStaff();"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($page == 'my_profile') { ?>
    <?php include 'staff-profile.php'; ?>
<?php } ?>

<?php if ($page == 'staff_profile') { ?>
    <div class="user-profile-div animated fadeInUp">
        <div class="top-panel-div">
            <span><i class="bi-person-check-fill"></i> ADMINISTRATIVE PROFILE</span>
            <div class="close" title="Close" onclick="_alert_close();">X</div>
        </div>

        <div class="profile-content-div">
            <div class="bg-img">
                <div class="mini-profile">
                    <label>
                        <div class="img-div" id="current_user_passport1">
                            <img src="<?php echo $website_url ?>/admin/a/all-images/images/avatar.jpg" alt="Profile Image">
                        </div>
                        <input type="file" id="profile_pix" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="Staffs.UpdatePreview(this);" />
                    </label>

                    <div class="text-div">
                        <h2 id="staff_login_fullname">Loading...</h2>
                        <div class="text">STATUS: <strong id="staff_status_name">Loading...</strong> | LAST LOGIN DATE: <strong id="last_login_time">Loading...</strong></div>
                    </div>
                </div>
            </div>

            <div class="field-back-div">
                <div class="user-in">
                    <div class="title">BASIC INFORMATION</div>

                    <div class="profile-segment-div">
                        <div class="text_field_container col-2">
                            <input class="text_field" type="text" id="updt_fullname" placeholder="" />
                            <div class="placeholder">Full Name:</div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="updt_email" placeholder="" />
                            <div class="placeholder">Email Address:</div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="updt_address" placeholder="" />
                            <div class="placeholder">Home Address:</div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="updt_position" placeholder="" />
                            <div class="placeholder">Position:</div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="updt_mobile" placeholder="" />
                            <div class="placeholder">Phone Number:</div>
                        </div>              
                    </div>
                </div>


                <div class="user-in">
                    <div class="title">ACCOUNT INFORMATION</div>

                    <div class="profile-segment-div">
                        <div class="text_field_container col-2">
                            <input class="text_field" type="text" id="s_staff_id" placeholder="" readonly="readonly" />
                            <div class="placeholder">Staff ID:</div>
                            <div class="lock-container"><i class="bi-lock"></i></div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="s_created_time" placeholder="" readonly="readonly" />
                            <div class="placeholder">Date Of Registration:</div>
                            <div class="lock-container"><i class="bi-lock"></i></div>
                        </div>

                        <div class="text_field_container col-1">
                            <input class="text_field" type="text" id="s_last_login" placeholder="" readonly="readonly" />
                            <div class="placeholder">Last Login Date:</div>
                            <div class="lock-container"><i class="bi-lock"></i></div>
                        </div>
                    </div>
                </div>

                <div class="user-in">
                    <div class="title">ADMINISTRATIVE INFORMATION</div>

                    <div class="profile-segment-div ">
                        <div class="text_field_container col-1">
                            <select id="updt_role_id" class="text_field" placeholder="">
                                <option value="">-Select here</option>
                                <script>
                                    _getSelectRole('updt_role_id');
                                </script>
                            </select>
                            <div class="placeholder">--Select Role--</div>
                        </div>

                        <div class="text_field_container col-1">
                            <select id="updt_status_id" class="text_field" placeholder="">
                                <option value="">-Select here</option>
                                <script>
                                    _getSelectStataus('updt_status_id', '1,2');
                                </script>
                            </select>
                            <div class="placeholder">--Select Status--</div>
                        </div>
                    </div>
                    <div class="btn-div">
                        <button class="btn" type="button" id="update_btn" onclick="_updateStaff('<?php echo $ids ?>')"> UPDATE PROFILE <i class="bi-check"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>_uploadStaffPix_('<?php echo $ids ?>');</script>
    <script>_getStaffProfile('<?php echo $ids ?>');</script>
<?php } ?>


<?php if ($page == 'event_reg') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW EVENT</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> ADD A NEW EVENT</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Event Title:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="date" id="event_date" placeholder="" />
                    <div class="placeholder">Event Date:</div>
                </div>

                <div class="event_placeholder-text_field_container">
                    <div class="text_field_container event_text_container">
                        <input class="text_field" type="time" id="event_start_time" placeholder="">
                        <div class="placeholder">Event Start Time:</div>
                    </div>

                    <div class="text_field_container event_text_container">
                        <input class="text_field" type="time" id="event_end_time" placeholder="">
                        <div class="placeholder">Event End Time:</div>
                    </div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="event_location" placeholder="" />
                    <div class="placeholder">Event Location:</div>
                </div>

                <div class="title">UPLOAD EVENT PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <img id="event_preview_pix" src="<?php echo $website_url ?>/all-images/images/sample.jpg" alt="Default Image">
                        <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="eventPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Event Status--</div>
                </div>
                <div>
                    <button class="btn" type="button" title="SUBMIT" id="submit_btn" onclick="_addEvent('event_category');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'update_event') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE EVENT</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> UPDATE EVENT</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Event Title:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="date" id="event_date" placeholder="" />
                    <div class="placeholder">Event Date:</div>
                </div>

                <div class="event_placeholder-text_field_container">
                    <div class="text_field_container event_text_container">
                        <input class="text_field" type="time" id="event_start_time" placeholder="">
                        <div class="placeholder">Event Start Time:</div>
                    </div>

                    <div class="text_field_container event_text_container">
                        <input class="text_field" type="time" id="event_end_time" placeholder="">
                        <div class="placeholder">Event End Time:</div>
                    </div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="event_location" placeholder="" />
                    <div class="placeholder">Event Location:</div>
                </div>

                <div class="title">UPLOAD EVENT PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <img id="event_preview_pix" src="all-images/images/sample.jpg" alt="Default Image">
                        <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="eventPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="uptd_status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('uptd_status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Event Status--</div>
                </div>
                <div>
                    <button class="btn" type="button" title="SUBMIT" id="update_btn" onclick="_updateEvent('<?php echo $page_category_id ?>','<?php echo $publish_id ?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        showTimePicker(inputField);
    </script>
    <script>
        _fetchEachEvent('<?php echo $page_category_id ?>', '<?php echo $publish_id ?>');
    </script>
<?php } ?>

<?php if ($page == 'gallery_reg') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW GALLERY</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> ADD A NEW GALLERY</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Gallery Title:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="gallery_sub_title" placeholder="" />
                    <div class="placeholder">Gallery Sub Title:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="class_gallery_sub_title" placeholder="" />
                    <div class="placeholder">Class Gallery Sub Title:</div>
                </div>

                <div class="title">UPLOAD GALLERY PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <label>
                            <img id="gallery_preview_pix" src="<?php echo $website_url ?>/all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="galleyPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Gallery Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick="_addGallery('gallery_category');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($page == 'update_gallery') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE GALLERY</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> UPDATE GALLERY</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Gallery Title:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="gallery_sub_title" placeholder="" />
                    <div class="placeholder">Gallery Sub Title:</div>
                </div>

                
                <div class="text_field_container">
                    <input class="text_field" type="text" id="class_gallery_sub_title" placeholder="" />
                    <div class="placeholder">Class Gallery Sub Title:</div>
                </div>

                <div class="title">UPLOAD GALLERY PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <img id="gallery_preview_pix" src="<?php echo $website_url ?>/all-images/images/sample.jpg" alt="Default Image">
                        <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="galleyPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="uptd_status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('uptd_status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Gallery Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateGallery('<?php echo $page_category_id ?>','<?php echo $publish_id ?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchEachGallery('<?php echo $page_category_id ?>', '<?php echo $publish_id ?>');
    </script>
<?php } ?>

<?php if ($page == 'blog_reg') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW BLOG</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> ADD A NEW BLOG</span></div>
                </div>

                <div class="text_field_container">
                    <select id="cat_id" class="text_field" placeholder="">
                        <option value="">--Select here</option>
                        <script>
                            _getSelectCategory();
                        </script>
                    </select>
                    <div class="placeholder">--Select Blog Category--</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Blog Title:</div>
                </div>

                <div class="title">UPLOAD BLOG PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <label>
                            <img id="blog_preview_pix" src="<?php echo $website_url ?>/all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="blogPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Blog Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick="_addBlog('blog_category');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($page == 'update_blog') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE BLOG</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> UPDATE BLOG</span></div>
                </div>

                <div class="text_field_container">
                    <select id="cat_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectCategory();
                        </script>
                    </select>
                    <div class="placeholder">--Select Blog Category--</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="reg_title" placeholder="" />
                    <div class="placeholder">Blog Title:</div>
                </div>

                <div class="title">UPLOAD BLOG PICTURE: <i>(JPG, PNG FORMAT ONLY)</i> <span>*</span></div>
                <label>
                    <div class="pix-div">
                        <label>
                            <img id="blog_preview_pix" src="<?php echo $website_url ?>/all-images/images/sample.jpg" alt="Default Image">
                            <input type="file" id="reg_thumbnail" style="display:none" accept=".jpg, .jpeg, .png, .gif, .bmp, .tiff, .webp, .svg, .avif" onchange="blogPixPreview.UpdatePreview(this);" />
                    </div>
                </label>

                <div class="text_field_container">
                    <select id="uptd_status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('uptd_status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Blog Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateBlog('<?php echo $page_category_id ?>','<?php echo $publish_id ?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchEachBlogs('<?php echo $page_category_id ?>', '<?php echo $publish_id ?>');
    </script>
<?php } ?>

<?php if ($page == 'faq_reg') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> ADD A NEW FAQ</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> ADD A NEW FAQ</span></div>
                </div>

                <div class="text_field_container">
                    <select id="cat_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectFaqCategory();
                        </script>
                    </select>
                    <div class="placeholder">--Select FAQ Category--</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="faq_question" placeholder="" />
                    <div class="placeholder">FAQ Question:</div>
                </div>

                <div class="title">FAQ Answer</div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: '#faq_answer', // change this value according to your HTML
                        plugins: "link, image, table"
                    });
                </script>
                <div style="margin-bottom: 20px;">
                    <textarea class="text_field" style="width:100%;" rows="5" id="faq_answer" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" id="" placeholder=""></textarea>
                </div>

                <div class="text_field_container">
                    <select id="status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select FAQ Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="submit_btn" onclick="_addFaq('faq_category');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php if ($page == 'update_faq') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE FAQ</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> UPDATE FAQ</span></div>
                </div>

                <div class="text_field_container">
                    <select id="cat_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectFaqCategory();
                        </script>
                    </select>
                    <div class="placeholder">--Select FAQ Category--</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="faq_question" placeholder="" />
                    <div class="placeholder">FAQ Question:</div>
                </div>

                <div class="title">FAQ Answer</div>
                <script src="js/TextEditor.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: '#faq_answer', // change this value according to your HTML
                        plugins: "link, image, table"
                    });
                </script>
                <div style="margin-bottom: 20px;">
                    <textarea class="text_field" style="width:100%;" rows="5" id="faq_answer" title="TYPE FULL PAGE CONTENT HERE" type="text" maxlength="167" id="" placeholder=""></textarea>
                </div>

                <div class="text_field_container">
                    <select id="updt_status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('updt_status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select FAQ Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateFaq('<?php echo $page_category_id ?>','<?php echo $publish_id ?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchEachFaq('<?php echo $page_category_id ?>', '<?php echo $publish_id ?>');
    </script>
<?php } ?>

<?php if ($page == 'update_testimony') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-plus-square"></i> UPDATE TESTIMONY</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div>
                    <div class="alert">Kindly fill the form below to <span> UPDATE TESTIMONY</span></div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="text" id="fullname" placeholder="" />
                    <div class="placeholder">Full Name:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="email" id="email" placeholder="" />
                    <div class="placeholder">Email Address:</div>
                </div>

                <div class="text_field_container">
                    <input class="text_field" type="tel" id="phone" placeholder="" />
                    <div class="placeholder">Phone Number:</div>
                </div>

                <div class="text_field_container">
                    <textarea class="text_field text_area" type="text" id="testimony" placeholder=""></textarea>
                    <div class="placeholder">Testimony:</div>
                </div>
                <br clear="all" />

                <div class="text_field_container">
                    <select id="relationship_type_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectRelationship();
                        </script>
                    </select>
                    <div class="placeholder">--Select Relationship--</div>
                </div>

                <div class="text_field_container">
                    <select id="updt_status_id" class="text_field" placeholder="">
                        <option value="">-Select here</option>
                        <script>
                            _getSelectStataus('updt_status_id', '1,2');
                        </script>
                    </select>
                    <div class="placeholder">--Select Testimony Status--</div>
                </div>
                <div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateTestimony('<?php echo $ids ?>');"> <i class="bi-check"></i> SUBMIT </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchEachTestimony('<?php echo $ids ?>');
    </script>
<?php } ?>


<?php if ($page == 'app_settings') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="back_icon" style="display:none; cursor:pointer;"><i class="bi-arrow-left" style="cursor:pointer;" onclick="_prev_page('account_settings_id');"></i> &nbsp;&nbsp;</span>
                <span id="panel-title"><span id="header_icon"> <i class="bi-gear"></i> </span id="app_text"> APP SETTINGS</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="setting_detail" id="account_settings_id">

                    <div class="settings-div" onclick="_next_page('account_detail','back_icon','account');">
                        <div class="div-in">
                            <div class="text-container">
                                <div class="icon-div">
                                    <i class="bi-bank"></i>
                                </div>
                                <div class="text-div">
                                    <h4 id="account">ACCOUNT DETAILS</h4>
                                    <span>Manage your account information</span>
                                </div>
                            </div>

                            <div class="right-icon-div">
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                    <div class="settings-div" onclick="_next_page('channge_password','back_icon','password');">
                        <div class="div-in">
                            <div class="text-container">
                                <div class="icon-div">
                                    <i class="bi-lock"></i>
                                </div>
                                <div class="text-div">
                                    <h4 id="password">CHANGE PASSWORD</h4>
                                    <span>Manage and change password</span>
                                </div>
                            </div>

                            <div class="right-icon-div">
                                <i class="bi-chevron-right"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="setting_detail" id="account_detail">
                    <div class="alert alert-success form-alert"><span>SMTP DETAILS</span>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="sender_name" placeholder="" />
                            <div class="placeholder">SENDER NAME:</div>
                        </div>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="smtp_host" placeholder="" />
                            <div class="placeholder">SMTP HOST:</div>
                        </div>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="smtp_username" placeholder="" />
                            <div class="placeholder">SMTP USERNAME:</div>
                        </div>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="smtp_password" placeholder="" />
                            <div class="placeholder">SMTP PASSWORD:</div>
                        </div>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="smtp_port" placeholder="" />
                            <div class="placeholder">SMTP PORT:</div>
                        </div>

                        <div class="text_field_container">
                            <input class="text_field" type="text" id="support_email" placeholder="" />
                            <div class="placeholder">SUPPORT EMAIL:</div>
                        </div>
                    </div>
                    <button class="btn" title="SUBMIT" id="update_btn" onclick="_updateSettings();"> <i class="bi-check"></i> UPDATE ACCOUNT </button>
                </div>

                <div class="setting_detail" id="channge_password">
                    <div class="alert">Fill all fields to change your <span>PASSWORD</span></div>

                    <div class="text_field_container">
                        <input class="text_field" type="password" id="old_password" onkeyup="_show_password_visibility('old_password','old_pass')" placeholder="" />
                        <div class="placeholder">Enter Your Old Password:</div>
                        <div class="password-container" id="old_pass" onclick="_togglePasswordVisibility('old_password','old_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="password" id="new_password" onkeyup="_show_password_visibility('new_password','new_pass')" placeholder="" />
                        <div class="placeholder">Create New Password:</div>
                        <div class="password-container" id="new_pass" onclick="_togglePasswordVisibility('new_password','new_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="text_field_container">
                        <input class="text_field" type="password" id="confirm_password" onkeyup="_show_password_visibility('confirm_password','c_new_pass')" placeholder="" />
                        <div class="placeholder">Confirm New Password:</div>
                        <div class="password-container" id="c_new_pass" onclick="_togglePasswordVisibility('confirm_password','c_new_pass')">
                            <i class="bi-eye-slash password-toggle"></i>
                        </div>
                    </div>

                    <div class="pswd_info" style="color:#8c8d8d"><em>At least 8 charaters required including upper & lower cases and special characters and numbers.</em></div>
                    <button class="btn" id="submit_btn" type="button" onclick="_changePassword();" title="CHANGE PASSWORD"> CHANGE PASSWORD</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchSettings();
    </script>
<?php } ?>

<?php if ($page == 'alert-read') { ?>
    <div class="slide-form-div animated fadeInRight">
        <div class="title-panel-div">
            <div class="inner-top">
                <span id="panel-title"><i class="bi-bell"></i> Notification Details</span>
                <div class="close" title="Close" onclick="_alert_close();">X</div>
            </div>
        </div>

        <div class="container-back-div">
            <div class="inner-container">
                <div class="alert alert-success">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>User ID:</div>
                            <div><span id="read_user_id">Loading...</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Action Performed By:</div>
                            <div><span id="user_name">Loading...</span></div>
                        </div>
                        <div class="alert-list">
                            <div>IP Address Used:</div>
                            <div><span id="ip_address">Loading...</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Computer Used:</div>
                            <div><span id="system_name">Loading...</span></div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success">
                    <div class="alert-list-div">
                        <div class="alert-list">
                            <div>Alert ID:</div>
                            <div><span id="alert_id">Loading...</span></div>
                        </div>
                        <div class="alert-list">
                            <div>Date:</div>
                            <div><span id="created_time">Loading...</span></div>
                        </div>
                    </div>
                </div>

                <div class="title">Alert Details:</div>
                <div class="alert alert-success">
                    <div class="alert-details" id="alert_detail"> Loading...</div>
                </div>
                <div>
                    <button class="btn" onclick="_alert_close();"> <i class="bi-check"></i> OK </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        _fetchReadAlert('<?php echo $ids ?>');
    </script>
<?php } ?>


<?php if ($page == 'logout_confirm_form') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $website_url ?>/all-images/images/warning.gif" /></div>
            <h2>Are you sure to log-out?</h2>
            Please, confirm your log-out action.
            <div class="btn-div">
                <button class="btn" onclick="_logout();">YES</button>
                <button class="btn no-btn" onclick="_alert_close();">NO</button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($page == 'access_key_validation_info') { ?>
    <div class="caption-success-div animated zoomIn">
        <div class="div-in">
            <div class="img"><img src="<?php echo $website_url ?>/all-images/images/warning.gif" /></div>
            <h2>INVALID ACCESS TOKEN</h2>
            Please LogIn Again
            <div class="btn-div password-div">
                <button class="btn password-btn" onclick="_logout();"><i class="bi-check"></i> Okay, Log-In </button>
            </div>
        </div>
    </div>
<?php } ?>