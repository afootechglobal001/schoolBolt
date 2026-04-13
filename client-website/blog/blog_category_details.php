<?php include '../../config/constants.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include '../../meta.php'?>
    <title><?php echo $thename?> - <?php echo $page_title?></title>
    <meta name="description" content="<?php echo $seo_description?>"/>
    <meta name="keywords" content="<?php echo $seo_keywords?>"/>

    <meta property="og:title" content="<?php echo $thename?> - <?php echo $page_title?>" />
    <meta property="og:image" content="<?php echo $website_url?>/api/uploaded-files/dev/seo-flyer-pix/<?php echo $page_seo_pix?>"/>
    <meta property="og:description" content="<?php echo $seo_description?>"/>

    <meta name="twitter:title" content=" <?php echo $thename?> - <?php echo $page_title?>"/>
    <meta name="twitter:card" content="<?php echo $thename?>"/>
    <meta name="twitter:image"  content="<?php echo $website_url?>/api/uploaded-files/dev/seo-flyer-pix/<?php echo $page_seo_pix?>"/>
    <meta name="twitter:description" content="<?php echo $seo_description?>"/>
</head>

<body>
    <?php  include '../../header.php'?>

    <section class="other-pages" data-aos="fade-in" data-aos-duration="900">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a id="blog-home-link" href="#"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a id="blog-sermon-link" href="#"><li title="Blog">Blog <i class="bi-caret-right-fill"></i></li></a>	
                        <a id="blog-sermon-title-link" href="#"><li id="blog_top_title">Loading...</li></a>	
                    </ul>
                </div>			
            </div>

            <div class="main-content-back-div">
                <div class="text-content-div detail-page-text-content" data-aos="fade-in" data-aos-duration="900">
                    <h1 data-aos="fade-in" data-aos-duration="800"><span id="blog_reg_title">Loading...</span></h1>
                    <div class="count"><i class="bi-person"></i> By: <span id="fullname">Loading...</span> &nbsp;|&nbsp; <i class="bi-calendar3"></i> DATE: <span id="formattedDate">Loading...</span> &nbsp;|&nbsp; <i class="bi-eye"></i> VIEWS: <span id="blog_view">Loading...</span> </div>
                    <p id="blog_seo_description"></p>  
                </div>
            </div>
        </div>
    </section>

    <section class="others-pg-content-div">
        <section class="body-div">
            <div class="body-div-in">
                <div class="page-back-div full-pages-back-div">
                    <div class="left-div">
                        <div class="page-list-back-div">
                            <div class="main-picture-back-div">	
                                <div class="main-picture-div" id="blog_preview">
                                    <img id="main_blog_preview" src="<?php echo $website_url?>/api/uploaded-files/dev/blog-pix/default.jpg" alt="Blog"/>  
                                </div>   

                                <div class="bottom-img-div">
                                    <div class="inner-img-container"> 
                                        <div class="inner-img-div" id="fetchBlogPictures">
                                           <script>_fetchBlogPictures('<?php echo $publish_id?>')</script>
                                        </div>
                                    </div>
                                    <button class="left-btn"> <i class="bi-chevron-double-left"></i></button>
                                    <button class="blog-right-btn"> <i class="bi-chevron-double-right"></i></button>
                                </div>                                   
						    </div>                         
                        
                            <div class="main-pages-content-div" id="blog_page_content"></div>

                            <div class="comment-back-div">
                                <div id="disqus_thread"></div>
                                <script>
                                    (function() { // DON'T EDIT BELOW THIS LINE
                                    var d = document, s = d.createElement('script');
                                    s.src = 'https://arrahmanmontessori.disqus.com/embed.js';
                                    s.setAttribute('data-timestamp', +new Date());
                                    (d.head || d.body).appendChild(s);
                                    })();
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="right-div sticky-div">   
                        <div class="div-in">
                            <h3>RECENT BLOG</h3>
                            
                            <div class="related-post-back-div" id="fetchMainRelatedBlog">
                                <script>_fetchMainRelatedBlog();</script>                          
                            </div>
                        </div>
                    </div>                     
                </div>
            </div>
        </section>
        <script>_fetchEachBlog('<?php echo $publish_id?>');</script>
        <?php include '../../footer.php'?>
    </section>
 
</body>
</html>


