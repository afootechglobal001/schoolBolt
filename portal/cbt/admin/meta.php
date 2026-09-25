<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="ALL">
<meta name="Engine" content="all">
<meta name="distribution" content="global">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo $websiteUrl?>/all-images/images/icon.png" rel="shortcut icon" type="image-png" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link href="<?php echo $websiteUrl?>/style/animate.css" type="text/css" rel="stylesheet" media="all">
<link href="<?php echo $websiteUrl?>/style/aos.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/paramount.css?v=<?php echo $codeVersion?>" type="text/css"rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/style/tablePaginator.css?v=<?php echo $codeVersion?>" type="text/css" rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/admin/style/main-style.css?v=<?php echo $codeVersion?>" type="text/css"rel="stylesheet" />
<link href="<?php echo $websiteUrl?>/admin/style/nav-style.css?v=<?php echo $codeVersion?>" type="text/css"rel="stylesheet" />

<script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>

<script>
    let staffLoginData = JSON.parse(sessionStorage.getItem("staffLoginData"));
    let userRoles = JSON.parse(sessionStorage.getItem("userRoles"));
    const loginStaffId = staffLoginData.staffId;
    const loginAccessKey = staffLoginData.accessKey;
    const loginRoleId = staffLoginData.roleId;
    const rolePermissionIds = staffLoginData.rolePermissionIds;
</script>

<script src="<?php echo $websiteUrl?>/js/paramount.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/textfield-selectfield.js?v=<?php echo $codeVersion?>"></script>
<script src="<?php echo $websiteUrl?>/js/helper.js?v=<?php echo $codeVersion?>" type="text/javascript"></script>
<script src="<?php echo $websiteUrl?>/js/aos.js"></script>
<script src="<?php echo $websiteUrl?>/js/tablePaginator.js?v=<?php echo $codeVersion?>"></script>

<script src="<?php echo $websiteUrl?>/admin/js/useDashboard.js?v=<?php echo $codeVersion?>" type="text/javascript"></script>
<script src="<?php echo $websiteUrl?>/admin/js/useCbtConfiguration.js?v=<?php echo $codeVersion?>" type="text/javascript"></script>
<script src="<?php echo $websiteUrl?>/admin/js/useSetExam.js?v=<?php echo $codeVersion?>" type="text/javascript"></script>
<script src="<?php echo $websiteUrl?>/admin/js/useCbt.js?v=<?php echo $codeVersion?>" type="text/javascript"></script>