<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $website_url?>/all-images/images/icon.png" rel="shortcut icon" type="image-png"/>
<link href="<?php echo $website_url?>/style/icons-1.11.3/font/bootstrap-icons.css" type="text/css" rel="stylesheet" >
<link href="<?php echo $website_url?>/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $website_url?>/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/style/paramount.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/style/main-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />

<script src="<?php echo $website_url?>/js/jquery-v3.6.1.min.js?v=<?php echo $code_version?>"></script>
<script>
   // Check if login_staff_session contains staff_id
   if (staffLoginData && staffLoginData.hasOwnProperty("staff_id")){
    window.parent.location.href = "a/";
} else {
    sessionStorage.setItem("staffLoginData", JSON.stringify(''));
}
</script>
<script src="<?php echo $website_url?>/admin/js/scripts.js?v=<?php echo $code_version?>"></script> 
<script src="<?php echo $website_url?>/js/aos.js?v=<?php echo $code_version?>"></script>

<meta property="og:type" content="Website" />
<meta property="og:site_name" content="<?php echo $thename?>">
<meta property="og:url" content="<?php echo $website_url?>" />