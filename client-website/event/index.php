<?php include '../config/constants.php';?>
<?php include '../config/functions.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include '../meta.php'?>
    <title><?php echo $thename?> | Events | Celebrate Montessori Achievements</title>  
    <meta name="keywords" content="<?php echo $thename?>, Ar-Rahman Montessori events, Montessori school activities Lagos, upcoming school events, child-centered education events, early childhood education programs Lagos, Montessori workshops Nigeria, Lagos Montessori celebrations, preschool and primary school events, family-friendly events Lagos, school calendar Montessori Lagos, creativity-focused events, holistic education activities Nigeria, innovative teaching events, nurturing creativity programs, collaborative learning events, educational excellence celebrations Lagos" />
    <meta name="description" content="Stay updated with Ar-Rahman Montessori Schools events. Join us for workshops, celebrations, and activities that foster creativity, collaboration, and critical thinking." />

    <meta property="og:title" content="<?php echo $thename?> | Events | Celebrate Montessori Achievements" />
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta property="og:description" content="Stay updated with Ar-Rahman Montessori Schools events. Join us for workshops, celebrations, and activities that foster creativity, collaboration, and critical thinking.." />

    <meta name="twitter:title" content="<?php echo $thename?> | Events | Celebrate Montessori Achievements" />
    <meta name="twitter:card" content="<?php echo $thename?>" />
    <meta name="twitter:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta name="twitter:description" content="Stay updated with Ar-Rahman Montessori Schools events. Join us for workshops, celebrations, and activities that foster creativity, collaboration, and critical thinking." />
</head>
<body>
    <?php  include '../header.php'?>

    <section class="other-pages" data-aos="fade-in" data-aos-duration="900">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $website_url?>"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a href="<?php echo $website_url?>/blog/"><li title="Event">Event</li></a>					
                    </ul>
                </div>			
            </div>
            <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                <h1 data-aos="fade-in" data-aos-duration="800"><span>Event</span></h1>
                <p>Join us for an unforgettable experience filled with meaningful moments, engaging activities, and opportunities to connect.</p>                
           
                <?php $callclass->_otherPagesBtn($website_url);?>
            </div>
        </div>
    </section>

    <section class="others-pg-content-div">
        <div class="menu-btn-div">
            <div class="btn-div-in">
                <button class="menu-btn active-btn" id="next-recent" title="UPCOMING EVENTS" onclick="_next_event_page('recent-hide-div','recent');">UPCOMING EVENTS</button>
                <button class="menu-btn" id="next-past" title="PAST EVENTS" onclick="_next_event_page('past-hide-div','past');">PAST EVENTS</button>          
            </div>
        </div>

        <div id="recent-hide-div">
            <section class="body-div">
                <div class="body-div-in">
                    <div class="main-event-back-div">
                        <a id="event-link" title="Pastor Mrs. Fatile S. Femi">
                        <div class="upcoming-event-div"> 
                            <div class="event-title">Upcoming Event</div>  
                            <div class="img-div">
                                <img id="event_preview" src="<?php echo $website_url?>/api/uploaded-files/dev/event-pix/default.jpg" alt="Event"/>
                            </div> 

                            <div class="content-div">
                                <div class="event-date-back-div">
                                    <div class="date-div">
                                        <div class="event-date" id="event_day">0</div>
                                        <div class="event-month" id="event_month">0</div>
                                    </div>

                                    <div class="event-div">
                                        <h4 id="reg_title">No Upcoming Events! Check Back Soon.</h4>
                                        <div class="event-time"><i class="bi-calendar-check"></i> <em id="event_start_time"></em> - <em id="event_end_time"></em> </div>  
                                        <div class="event-time"><i class="bi-geo-alt"></i> <em id="event_location"></em></div> 
                                    </div>  
                                </div>
                                <p id="seo_description"></p>
                                <div class="time-div">
                                    <div class="time">                              
                                        <h3 id="days">0:0</h3>
                                        <span>DAY</span>
                                    </div>
                                    <div class="time">                              
                                        <h3 id="hours">0:0</h3>
                                        <span>HRS</span>
                                    </div>
                                    <div class="time">                              
                                        <h3 id="minutes">0:0</h3>
                                        <span>MIN</span>
                                    </div>
                                    <div class="time no-border">                              
                                        <h3 id="seconds">0:0</h3>
                                        <span>SEC</span>
                                    </div>
                                </div> 
                                <script>_startCountdown(targetDate);</script>
                            </div> 
                        </div></a>
                    </div>
                </div>
                <script>_fetchPageUpcomingEvent();</script>
            </section> 

            <section class="body-div main-event-body-div">
                <div class="body-div-in">
                    <div class="main-pages-back-div">
                        <div class="title-div main-event-title" data-aos="fade-in" data-aos-duration="1200">
                            <div class="top-div">
                                <h2>Related Upcoming Events</h2> 
                            </div>  
                        </div>

                        <div class="list-event-back-div" id="fetchMainRelatedUpcominEvent">
                            <script>_fetchMainRelatedUpcominEvent();</script>
                        </div>
                    </div>
                </div>
            </section> 
        </div>

        <div id="past-hide-div">
            <section class="body-div main-event-body-div">
                <div class="body-div-in">           
                    <div class="list-event-back-div" id="fetchPastEvent">
                       <script>_fetchRelatedEvent();</script>
                    </div>
                </div>
            </section> 
        </div>

        <?php include '../footer.php'?>
    </section>
                  
</body>
</html>


