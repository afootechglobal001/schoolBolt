<?php include 'config/constants.php';?>
<?php include 'config/functions.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include 'meta.php'?>
    <title><?php echo $thename?> | Frequently Asked Questions | Offline Support</title>
    <meta name="keywords" content="<?php echo $thename?>, frequently asked questions about Ar-Rahman Montessori, creative learning Lagos, early childhood education, hands-on learning, collaborative learning, critical thinking school, best Montessori school in Nigeria, safe learning environment, Montessori education Nigeria, early childhood education, safe learning environment, preschool Lagos, primary school Lagos, innovative teaching, child-centered learning, Lagos Montessori, nurturing creativity, holistic education, educational excellence" />
    <meta name="description" content="frequently asked questions about Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />

    <meta property="og:title" content="<?php echo $thename?> | Frequently Asked Questions | Offline Support"/>
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg"/>
    <meta property="og:description" content="frequently asked questions about Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />

    <meta name="twitter:title" content="<?php echo $thename?> | Frequently Asked Questions | Offline Support" />
    <meta name="twitter:card" content="<?php echo $thename?>" />
    <meta name="twitter:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta name="twitter:description"  content="frequently asked questions about Ar-Rahman Montessori Schools in Lagos, where creativity and curiosity thrive. We provide hands-on, collaborative learning to inspire critical thinking and success." />
</head>
<body>
    <?php  include 'header.php'?>

    <section class="other-pages" data-aos="fade-in" data-aos-duration="900">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $website_url?>"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a href="<?php echo $website_url?>/faq"><li title="Frequently Asked Question">Frequently Asked Question</li></a>					
                    </ul>
                </div>			
            </div>
            <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                <h1 data-aos="fade-in" data-aos-duration="800"><span>Frequently Asked Question</span></h1>
                <p>Our FAQ section provides answers to common queries about admissions, curriculum, school policies, extracurricular activities, and student support services, all in one place.</p>                
           
                <?php $callclass->_otherPagesBtn($website_url);?>
            </div>
        </div>
    </section>

 
    <section class="others-pg-content-div">
        <section class="body-div blog-body-div">
            <div class="body-div-in">
                <div class="page-back-div faq-pages-back-div">
                    <div class="right-div sticky-div">
                        <div class="div-in">
                            <h3>SEARCH</h3>
                            <div class="text_field_container">
                                <input class="text_field blog_text_field" id="search_keywords" onkeyup="_fetchFaq();" type="text" placeholder=""/>
                                <div class="placeholder blog-placeholder">Type Here To Search</div>
                            </div>                                                               
                        </div>
                
                        <div class="div-in">
                            <h3>TAG LIST</h3>

                            <ul id="cat_id">
                                <script>_getSelectCategory();</script>  
                            </ul>                                                              
                        </div>                            
                    </div> 

                    <div class="left-div">
                        <div class="general-faq-div" id="fetchFaq">  
                            <script>_fetchFaq();</script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer.php'?>
    </section>

</body>
</html>


