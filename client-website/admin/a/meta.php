<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $website_url?>/all-images/images/icon.png" rel="shortcut icon" type="image-png"/>
<link href="<?php echo $website_url?>/style/icons-1.11.3/font/bootstrap-icons.css" type="text/css" rel="stylesheet" >
<link href="<?php echo $website_url?>/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $website_url?>/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/a/style/paramount.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/a/style/main-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $website_url?>/admin/a/style/nav-style.css?v=<?php echo $code_version?>" type="text/css" rel="stylesheet" />

<script src="<?php echo $website_url?>/js/jquery-v3.6.1.min.js"></script>
<script>
  let staffLoginData = JSON.parse(sessionStorage.getItem("staffLoginData"));
  const login_staff_id=staffLoginData.staff[0].staff_id;
  const login_access_key=staffLoginData.staff[0].access_key;
  const login_role_id=staffLoginData.staff[0].role_id;
</script>
<script src="<?php echo $website_url?>/admin/a/js/scripts.js?v=<?php echo $code_version?>"></script> 
<script src="<?php echo $website_url?>/admin/a/js/session_validation.js?v=<?php echo $code_version?>"></script>

<meta property="og:type" content="Website" />
<meta property="og:site_name" content="<?php echo $thename?>">
<meta property="og:url" content="<?php echo $website_url?>" />