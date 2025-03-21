<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$websiteAutoUrl =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$appName='schoolBolt'; 

	//$websiteUrl='https://schoolbolt.com'; /// For Live Server Url //
	$websiteUrl='http://localhost/projects/schoolbolt';
	//$websitePath = $_SERVER['DOCUMENT_ROOT'];
	$websitePath = $_SERVER['DOCUMENT_ROOT'].'/projects/schoolbolt'; //dirname(__FILE__);
	$codeVersion= date('Ymdhis');
?>


<?php
$userOsBrowser = $_SERVER['HTTP_USER_AGENT'];

/////////////////////////////////////////////////////////////////////////////////
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
$userIpAddress =getUserIP();

/////////////////////////////////////////////////////////////////////////////////
function getBrowserId() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';  // Browser and OS info
    $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';  // Language
    // Combine all data and create a hash
    $browserId = hash('sha256', $userAgent . $acceptLanguage);
    return $browserId;
}
$userDeviceId=getBrowserId();
?>


<script>
	var websiteUrl = "<?php echo $websiteUrl;?>";
	var clientId = "3b338d51b4971ec84429b3e1a6ffe769"; /// for dev
	//var clientId = "1b26bb4215f64bc62160b26d9b2b4865" /// for production
	var clientAddress = "<?php echo $websiteAutoUrl;?>";
	var apiKey='a7c37b6289b9dd879b2c005118d3ef14'; /// For API Key //
	var endPoint='https://schoolbolt.com/api/dev'; /// Server End Point url
	var userOsBrowser = "<?php echo $userOsBrowser;?>"; /// For User OS Browser //
	var userIpAddress = "<?php echo $userIpAddress;?>"; /// For User IP Address //
	var userDeviceId = "<?php echo $userDeviceId;?>"; /// For User Device Id //

	var adminLocalUrl=websiteUrl+'/config/portal/admin/code';
	var adminPortalLocalUrl=websiteUrl+'/config/portal/admin/operations/code'; 
	var adminPortalUrl=websiteUrl+'/portal/admin'; /// For Portal Url //
	var adminUrl=websiteUrl+'/portal/admin/login'; /// For Admin Url //
	var studentPixPath=websiteUrl+'/uploaded_files/studentPix'; /// For Product Pix Path //
</script>

