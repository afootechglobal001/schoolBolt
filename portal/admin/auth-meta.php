<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $websiteUrl?>/all-images/images/icon.png" rel="shortcut icon" type="image-png"/>
<link href="<?php echo $websiteUrl?>/style/icons-1.11.3/font/bootstrap-icons.css" type="text/css" rel="stylesheet" >
<link href="<?php echo $websiteUrl?>/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $websiteUrl?>/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/portal/admin/auth-style.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />

<script src="<?php echo $websiteUrl?>/js/jquery-v3.6.1.min.js"></script>
<script src="<?php echo $websiteUrl?>/js/paramount.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/portal/admin/useAuth.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/textfield-selectfield.js?v=<?php echo $codeVersion?>"></script>

<script>
    let staffLoginData = JSON.parse(sessionStorage.getItem("staffLoginData"));

    if (staffLoginData){
        window.parent.location.href = adminPortalUrl;
    } else {
        sessionStorage.setItem("staffLoginData", JSON.stringify(''));
    }
</script>
