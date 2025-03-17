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
	var apiKey='b58b8bf717120383cd5e13d247beb6b9'; /// For API Key //
	var endPoint='https://schoolbolt.com/api/dev'; /// Server End Point url
	var userOsBrowser = "<?php echo $userOsBrowser;?>"; /// For User OS Browser //
	var userIpAddress = "<?php echo $userIpAddress;?>"; /// For User IP Address //
	var userDeviceId = "<?php echo $userDeviceId;?>"; /// For User Device Id //

</script>

