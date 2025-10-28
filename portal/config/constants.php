<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$websiteAutoUrl =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$appName='schoolBolt'; 
	$clientName='SchoolBolt Edu System';
	/////////////////////////////////////////////////////////////////////////////////
	$clientWebsiteUrl='http://localhost/projects/schoolbolt';
	//$clientWebsiteUrl='https://schoolbolt.com';
	$clientWebsiteContactUsUrl=$clientWebsiteUrl.'/contact-us';
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
var apiKey = 'a7c37b6289b9dd879b2c005118d3ef14'; /// For API Key //
var endPoint = 'https://schoolbolt.com/api/dev'; /// Server End Point url
//var endPoint = 'http://localhost/projects/schoolbolt/api/dev'; /// Server End Point url
var userOsBrowser = "<?php echo $userOsBrowser;?>"; /// For User OS Browser //
var userIpAddress = "<?php echo $userIpAddress;?>"; /// For User IP Address //
var userDeviceId = "<?php echo $userDeviceId;?>"; /// For User Device Id //

var payStackTransferUrl = 'https://api.paystack.co/transfer'; /// API Transfer EndPoint

var adminLocalUrl = websiteUrl + '/config/admin/code';
var parentPortalLocalUrl = websiteUrl + '/config/parent/code';
var adminPortalLocalUrl = websiteUrl + '/config/admin/operations/code';
var adminPortalUrl = websiteUrl + '/admin'; /// For Portal Url //
var adminUrl = websiteUrl + '/admin/login'; /// For Admin Url //
var parentLoginUrl = websiteUrl + '/parent/login'; /// For Parent Portal Url //
var parentPortalUrl = websiteUrl + '/parent'; /// For Parent Login Url //
var studentPixPath = websiteUrl + '/uploaded_files/studentPix'; /// For Student Pix Path //
var schoolLogoPixPath = websiteUrl + '/uploaded_files/branchLogo'; /// For School Pix Path //
var principalSignaturePixPath = websiteUrl + '/uploaded_files/branchPrincipalSignature'; /// For School Pix Path //

var midTermResultHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Mid-Term Result path //
var caResultSummaryHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For CA Result Summary path //
var caBroadSheetHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For CA Broad Sheet path //
var terminalBroadSheetHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Terminal Broad Sheet path //
var classListHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Class List Header path //
var cummulativeMarkBookHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Cummulative Mark Book Header path //
var markBookHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Mark Book Header path //
var progressReportHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Progress Report Header path //
var scoreSheetHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Score Sheet Header path //
var studentListHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Student List Header path //
var subjectListHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Subject List Header path //
var terminalResultSummaryHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Terminal Result Summary Header path //
var terminalResultHeaderPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Terminal Result Header path //
var watermarkPixPath = websiteUrl + '/uploaded_files/schoolResultHeaders'; /// For Watermark path //
</script>