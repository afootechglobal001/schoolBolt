<?php include '../config/constants.php';?>
<?php include '../config/functions.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include '../meta.php'?>
    <title><?php echo $thename?> Gallery | Discover Our Montessori Journey</title>  
    <meta name="keywords" content="<?php echo $thename?>, Ar-Rahman Montessori gallery, Montessori school photos Lagos, hands-on learning images, child-centered education visuals, early childhood education gallery, creative learning Lagos photos, preschool and primary school events, safe learning environment gallery, best Montessori school in Lagos gallery, holistic education images Nigeria, innovative teaching visuals, Lagos Montessori moments, nurturing creativity photos, collaborative learning highlights, educational excellence snapshots" />
    <meta name="description" content="Explore the Ar-Rahman Montessori Schools gallery showcasing vibrant moments of hands-on learning, creativity, and collaboration. Discover our safe, nurturing environment through visuals of events and activities." />

    <meta property="og:title" content="<?php echo $thename?> Gallery | Discover Our Montessori Journey" />
    <meta property="og:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta property="og:description" content="Explore the Ar-Rahman Montessori Schools gallery showcasing vibrant moments of hands-on learning, creativity, and collaboration. Discover our safe, nurturing environment through visuals of events and activities." />

    <meta name="twitter:title" content="<?php echo $thename?> Gallery | Discover Our Montessori Journey" />
    <meta name="twitter:card" content="<?php echo $thename?>" />
    <meta name="twitter:image" content="<?php echo $website_url?>/all-images/plugin-pix/arrahmanmontessori.jpg" />
    <meta name="twitter:description" content="Explore the Ar-Rahman Montessori Schools gallery showcasing vibrant moments of hands-on learning, creativity, and collaboration. Discover our safe, nurturing environment through visuals of events and activities." />
</head>

<body>
    <?php  include '../header.php'?>

    <section class="other-pages" data-aos="fade-in" data-aos-duration="900">
        <div class="other-pages-back-div">
            <div class="top-title">
                <div class="div-in">
                    <ul>
                        <a href="<?php echo $website_url?>"><li title="Home">Home <i class="bi-caret-right-fill"></i></li></a>
                        <a href="<?php echo $website_url?>/gallery"><li title="Our Gallery">Our Gallery</li></a>					
                    </ul>
                </div>			
            </div>
            <div class="text-content-div" data-aos="fade-in" data-aos-duration="900">
                <h1 data-aos="fade-in" data-aos-duration="800"><span>Our Gallery</span></h1>
                <p>At Ar-Rahman Montessori Schools, we believe in creating unforgettable memories. Choose from our array of galleries.</p>                
           
                <?php $callclass->_otherPagesBtn($website_url);?>
            </div>
        </div>
    </section>
 
    
    <section class="others-pg-content-div">
        <section class="body-div">
            <div class="body-div-in">
                <div class="main-gallery-back-div" id="fetchAllGallery">
                    <script>_fetchAllGallery();</script>
			    </div>              
            </div>
        </section>
        
        <?php include '../footer.php'?>
    </section>
</body>
</html>


