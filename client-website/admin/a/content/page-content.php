<?php if ($page=='dashboard'){?>
    <div class="statistics-back-div" data-aos="fade-in" data-aos-duration="1500">
       
        <span id="adminstrator_link"></span>
        
        <div class="statistics-div"  onClick="_get_page('event_category', 'event')" id="event">
            <div class="inner-div">                    
                <div class="number-div">
                    Event  
                    <span id="total_active_event_count">0</span>
                </div>
                <div class="icon"><i class="bi-calendar2-event"></i></div>
            </div>
        </div>

        <div class="statistics-div" onClick="_get_page('gallery_category', 'gallery')" id="gallery">
            <div class="inner-div">                    
                <div class="number-div">
                    Gallery  
                    <span id="total_active_gallery_count">0</span>
                </div>
                <div class="icon"><i class="bi-images"></i></div>
            </div>
        </div>

        <div class="statistics-div" onClick="_get_page('blog_category', 'blog')" id="blog">
            <div class="inner-div">
                <div class="number-div">
                    Blog  
                    <span id="total_active_blog_count">0</span>
                </div>
                <div class="icon"><i class="bi-file-post"></i></div>
            </div>
        </div>

        <div class="statistics-div" onClick="_get_page('faq_category', 'faq')" id="faq">
            <div class="inner-div">
                <div class="number-div">
                    FAQ  
                    <span id="total_active_faq_count">0</span>
                </div>
                <div class="icon"><i class="bi-patch-question"></i></div>
            </div>
        </div>

        <div class="statistics-div" onClick="_get_page('testimony_category', 'test')" id="test">
            <div class="inner-div">
                <div class="number-div">
                    Testimony  
                    <span id="total_active_testimony_count">0</span>
                </div>
                <div class="icon"><i class="bi-chat-quote-fill"></i></div>
            </div>
        </div>

        <div class="statistics-div round">
            <div class="inner-div text-centre">
                View All Activities
                <div class="icon-div">
                    <i class="bi-arrow-up-right"> </i>
                </div>
            </div>
        </div>

    </div>
    
    <script>_fetchLoginUser();</script>
    <script>_getDashboardStatistics();</script>
<?php }?>

<?php if ($page=='view_staff'){?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllStaff();">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllStaff();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> ADMINISTRATOR'S LIST</span>  <button class="btn" onClick="_get_form('staff_reg')"><i class="bi-plus-square"></i> CREATE A NEW ADMIN</button></div>
    </div>


    <div class="fetch-div" id="fetchAllStaff">
        <script>_fetchAllStaff();</script>

        <!-- <div class="user-div animated fadeIn" title="Click to view User Profile" onclick="_get_form_with_id('staff_profile')">
            <div class="pix-div"><img src="<?php //echo $website_url?>/admin/a/all-images/images/avatar.jpg" alt="Profile Image"></div>
            <div class="detail">
                <div class="name-div"><div class="name">Ikong Samuel </div><hr /><br/></div>
                <div class="text">ID: <span>STF20241809001</span></div>
                <div class="text"><span>08060881905</span></div>
                <div class="status-div">ACTIVE</div>
            </div>
        </div> -->
    </div>
<?php } ?>


<?php if ($page=='event_category'){
     $page_category_id=$page;
     ?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllEvent('<?php echo $page_category_id;?>');">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllEvent('<?php echo $page_category_id;?>');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> EVENT LIST</span>  <button class="btn" onClick="_get_form('event_reg')"><i class="bi-plus-square"></i> CREATE A NEW EVENT</button></div>
    </div>

    <div class="fetch-div animated fadeIn" id="fetchAllEvent">
        <script>_fetchAllEvent('<?php echo $page_category_id;?>');</script>

        <!-- <div class="grid-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('update_sermon')">EDIT</button>
                <button class="btn" onclick="_edit_page('<?php //echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php //echo $website_url?>/all-images/body-pix/event_1.webp" alt="Sermon"></div>
            <div class="text-div">
                <div class="top-text"><span><i class="bi-calendar-check"></i> </span><em>08:00 AM - 11:00 AM</em> </div>  
                <h2>The Christian Community in America</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>27 Jul 2024</span> | <span>486</span> VIEWS </div>
                </div>
            </div>
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='gallery_category'){
     $page_category_id=$page;
     ?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllGallery('<?php echo $page_category_id;?>');">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllGallery('<?php echo $page_category_id;?>');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> GALLERY LIST</span>  <button class="btn" onClick="_get_form('gallery_reg')"><i class="bi-plus-square"></i> CREATE A NEW GALLERY</button></div>
    </div>

    <div class="fetch-div animated fadeIn" id="fetchAllGallery">
        <script>_fetchAllGallery('<?php echo $page_category_id;?>');</script>
        <!-- <div class="grid-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('')">EDIT</button>
                <button class="btn" onclick="_edit_page('<?php //echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php //echo $website_url?>/all-images/body-pix/gallery_12.jpg" alt="Gallery"></div>
            <div class="text-div">
                <div class="top-text"><span>Birthday</span></div>
                <h2>Celebrating the 70th Birthday of Dr. Kayode...</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>27 Jul 2024</span> | <span>486</span> VIEWS </div>
                </div>
            </div>
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='blog_category'){
     $page_category_id=$page;
     ?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllBlog('<?php echo $page_category_id;?>');">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllBlog('<?php echo $page_category_id;?>');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> BLOG LIST</span>  <button class="btn" onClick="_get_form('blog_reg')"><i class="bi-plus-square"></i> CREATE A NEW BLOG</button></div>
    </div>

    <div class="fetch-div" id="fetchAllBlog">
        <script>_fetchAllBlog('<?php echo $page_category_id;?>');</script>
        
        <!-- <div class="grid-div">
            <div class="btn-div">
                <button class="btn active-btn" onclick="_get_form_with_id('')">EDIT</button>
                <button class="btn" onclick="_edit_page('<?php //echo $page_category_id;?>','')">EDIT PAGE DETAILS</button>
            </div>

            <div class="status-div">ACTIVATED</div>
            <div class="img-div"><img src="<?php //echo $website_url?>/all-images/body-pix/blog2.webp" alt="Blog"></div>
            <div class="text-div">
                <div class="top-text"><span>Announcement</span></div>
                <h2>Strengthening Your Faith Through Spiritual Disciplines...</h2>
                <div class="text-in">
                    <div class="text">UPDATED ON: <span>27 Jul 2024</span> | <span>486</span> VIEWS </div>
                </div>
            </div>
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='faq_category'){
    $page_category_id=$page;
    ?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllFaq('<?php echo $page_category_id;?>');">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllFaq('<?php echo $page_category_id;?>');" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> FAQ LIST</span>  <button class="btn" onClick="_get_form('faq_reg')"><i class="bi-plus-square"></i> CREATE A NEW FAQ</button></div>
    </div>

    <div class="fetch-div" id="fetchAllFaq">
        <script>_fetchAllFaq('<?php echo $page_category_id;?>');</script>

        <!-- <div class="faq-back-div">
            <div class="title-div">
                <div class="num">2</div>
                <button class="btn" onClick=""><i class="bi-pencil-square"></i> <span>Where is your church located?</span></button>
            </div>
            <div class="answer-div">We are located at San Fransisco, USA. If you need directions, you can find a map on our Contact Page!</div>
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='testimony_category'){?>
    <div class="top-content-div" data-aos="fade-in" data-aos-duration="1000">
        <div class="search-div">
            <!--------------------------------network search select------------------------->
            <select id="status_id" class="text_field select" onchange="_fetchAllTestimony();">
                <option value=""> SELECT STATUS</option>
                <script>_getSelectStataus('status_id','1,2,3');</script>
            </select>
            <!--------------------------------all search select------------------------->
            <input id="search_keywords" onkeyup="_fetchAllTestimony();" type="text" class="text_field utext" placeholder="Type here to search..." title="Type here to search" />
        </div>
        <div class="alert alert-success page-alert"> <span><i class="bi-people-fill"></i> TESTIMONY LIST</span> </div>
    </div>

    <div class="fetch-div" id="fetchAllTestimony">
    <script>_fetchAllTestimony();</script>

        <!-- <div class="list">
            <div class="student-profile">
                <div class="details">
                    <div class="text">
                        <h3>Paul Emmanuel</h3>
                        <div class="info">
                            <div>
                                <p>Email: <span>seunemmanuel107@gmail.com</span></p>
                                <p>Phone: <span>07050903886</span></p>
                            </div>                               
                            <button class="status-btn ACTIVE">ACTIVE</button>
                        </div>
                    </div>
                </div>
                <button class="btn" onClick="_get_form_with_id('update_testimony')">VIEW DETAILS</button>
            </div> 
        </div> -->
    </div>
<?php } ?>

<?php if ($page=='system_alert'){ ?> 
    <div class="search-div">
        <!--------------------------------all search select------------------------->
        <input id="search_keywords" onkeyup="_fetchAlertByKeywords();" type="text" class="text_field full" placeholder="Type here to search..." title="Type here to search" />
    </div>

    <div class="alert-chart-back-div">
        <div class="chart-div-notifications alert-chart-div-notifications">
            <div class="text"><i class="bi-graph-up-arrow"></i> Showing Matrix for</div> 
            
            <div class="text">
                <div class="custom-srch-div">
                    <input id="datepicker-from" type="text" class="srchtxt" placeholder="From" title="Select Date From" />
                    <input id="datepicker-to" type="text" class="srchtxt" placeholder="To" title="Select Date To"/>
                    <button type="button" class="btn" onclick="_getCustomReport('','','custom_search')">Apply</button>
                </div>
            </div>

            <div class="text text-right" onclick="select_search()">
                <span id="srch-text">Last 30 Days</span>              
                <div class="icon-div"><i class="bi-caret-down"></i></div> 
              
                <div class="srch-select alert-srch-select">
                    <div id="srch-today" onclick="_getAlertReport('srch-today', 'view_today_search');">Today</div>
                    <div id="srch-week" onclick="_getAlertReport('srch-week', 'view_thisweek_search');">This Week</div>
                    <div id="srch-7" onclick="_getAlertReport('srch-7', 'view_7days_search');">Last 7 Days</div>
                    <div id="srch-month" onclick="_getAlertReport('srch-month', 'view_thismonth_search');">This Month</div>
                    <div id="srch-30" onclick="_getAlertReport('srch-30', 'view_30days_search');">Last 30 Days</div>
                    <div id="srch-90" onclick="_getAlertReport('srch-90', 'view_90days_search');">Last 90 Days</div>
                    <div id="srch-year" onclick="_getAlertReport('srch-year', 'view_thisyear_search');">This Year</div>
                    <div id="srch-1year" onclick="_getAlertReport('srch-1year', 'view_1year_search');">Last 1 Year</div>
                    <div onclick="srch_custom('Custom Search')">Custom Search</div>
                </div> 
            </div>
        </div>
    </div>

    <div class="alert alert-success"> <span><i class="bi-bell"></i></span> Notification Between <span id="date_from">Loading...</span> - <span id="date_to">Loading...</span></div>

    <div class="main-alert-div" id="fetchAllSystemAlert">
        <script>_getAlertReport('srch-30', 'view_30days_search');</script>
        <!-- <div class="system-alert main-system-alert" id="<?php //echo $alert_id; ?>" onClick="_get_form_with_id('alert-read')">
            <div class="alert-name"><i class="bi-person"></i> Afolabi Taiwo <span id="<?php //echo $alert_id; ?>viewed"><i class="bi-check"></i></span></div>
            <div class="alert-text">Success Alert: EMMANUEL SAMUEL profile was updated successfully...</div>
            <div class="alert-time"><i class="bi-clock"></i> <span>2023-07-09 15:31:34</span></div>
        </div> -->

       
    </div>
    
    <div class="bottom-btn-div">
        <button id="fetch_previous_alerts" title="Older" class="btn" onclick="_fetchPreviousAlerts()"><i class="bi-chevron-left"></i></button>
        <div><span id="view_from">0</span>-<span id="view_to">0</span> of <span id="all_record_count">0</span></div>
        <button id="fetch_next_alerts" title="Newer" class="btn" onclick="_fetchNextAlerts()"><i class="bi-chevron-right"></i></button>
    </div>
<?php }?>