<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$websiteAutoUrl =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$appName='schoolBolt'; 
	$clientName='SchoolBolt Edu System';
	/////////////////////////////////////////////////////////////////////////////////
	//$websiteUrl='https://schoolbolt.com/portal'; /// For Live Server Url //
	$websiteUrl='http://localhost/projects/schoolbolt/portal';
	//$websitePath = $_SERVER['DOCUMENT_ROOT'].'/portal';
	$websitePath = $_SERVER['DOCUMENT_ROOT'].'/projects/schoolbolt/portal'; //dirname(__FILE__);
	$codeVersion= date('Ymdhis');
	/////////////////////////////////////////////////////////////////////////////////
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
	var clientAddress = "<?php echo $websiteAutoUrl;?>/https://schoolbolt.com";
	var apiKey='a7c37b6289b9dd879b2c005118d3ef14'; /// For API Key //
	var endPoint='https://schoolbolt.com/api/dev'; /// Server End Point url
	//var endPoint='https://schoolbolt.com/api/production'; /// Server End Point url
	var userOsBrowser = "<?php echo $userOsBrowser;?>"; /// For User OS Browser //
	var userIpAddress = "<?php echo $userIpAddress;?>"; /// For User IP Address //
	var userDeviceId = "<?php echo $userDeviceId;?>"; /// For User Device Id //

	var payStackTransferUrl='https://api.paystack.co/transfer'; /// API Transfer EndPoint

	var adminLocalUrl=websiteUrl+'/config/admin/code';
	var parentPortalLocalUrl=websiteUrl+'/config/parent/code';
	var adminPortalLocalUrl=websiteUrl+'/config/admin/operations/code'; 
	var adminPortalUrl=websiteUrl+'/admin'; /// For Portal Url //
	var adminUrl=websiteUrl+'/admin/login'; /// For Admin Url //
	var parentLoginUrl=websiteUrl+'/parent/login'; /// For Parent Portal Url //
	var parentPortalUrl=websiteUrl+'/parent'; /// For Parent Login Url //
	var studentPixPath=websiteUrl+'/uploaded_files/studentPix'; /// For Product Pix Path //
</script>