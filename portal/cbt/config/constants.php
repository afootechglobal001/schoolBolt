<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
$websiteAutoUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$appName = 'SchoolBolt Edu System CBT';

$clientWebsiteUrl='http://localhost/schoolbolt/schoolbolt';
	//$clientWebsiteUrl='https://schoolbolt.com';
//$websiteUrl='https://schoolbolt.com/portal/cbt'; /// For Live Server Url //
$websiteUrl = 'http://localhost/schoolBolt/schoolBolt/portal/cbt';
//$websitePath = $_SERVER['DOCUMENT_ROOT'];
$websitePath = $_SERVER['DOCUMENT_ROOT'].'/schoolBolt/schoolBolt/portal/cbt'; //dirname(__FILE__);
$codeVersion = date('Ymdhis');
?>

<?php
$userOsBrowser = $_SERVER['HTTP_USER_AGENT'];
/////////////////////////////////////////////////////////////////////////////////
function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
$userIpAddress = getUserIP();

/////////////////////////////////////////////////////////////////////////////////
function getBrowserId()
{
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';  // Browser and OS info
    $acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';  // Language
    // Combine all data and create a hash
    $browserId = hash('sha256', $userAgent . $acceptLanguage);
    return $browserId;
}
$userDeviceId = getBrowserId();
?>

<script>
    /// Constants ///
    var websiteUrl = "<?php echo $websiteUrl; ?>";
    var userOsBrowser = "<?php echo $userOsBrowser; ?>"; /// For User OS Browser //
    var userIpAddress = "<?php echo $userIpAddress; ?>"; /// For User IP Address //
    var userDeviceId = "<?php echo $userDeviceId; ?>"; /// For User Device Id //

    ////// EndPoints///
    var clientId = "3b338d51b4971ec84429b3e1a6ffe769"; /// for dev
    var clientAddress = "<?php echo $websiteAutoUrl;?>/https://schoolbolt.com";
    var apiKey = 'a7c37b6289b9dd879b2c005118d3ef14'; /// For API Key //
    var endPoint='https://schoolbolt.org/api/dev'; /// Server End Point url

    /// CBT Admin Middleware Urls ///
    var cbtLoginMiddleWareUrl = websiteUrl + '/admin/login/config/code'; /// For CBT Login Middleware Url //
    var cbtLoginUrl = websiteUrl + '/admin/login'; /// For CBT Login Url //

    /// Admin Middleware Urls ///
    var cbtAdminMiddleWareUrl = websiteUrl + '/admin/config/code'; /// For CBT Admin Login Middleware Url //
    var cbtAdminUrl = websiteUrl + '/admin'; /// For Admin Url //

    /// Student Login Middleware Urls ///
    var cbtStudentLoginMiddleWareUrl = websiteUrl + '/student/login/config/code'; /// For CBT Student Login Middleware Url //
    var cbtStudentLoginUrl = websiteUrl + '/student/login'; /// For Student Login Url //

    /// Student Portal Middleware Urls ///
    var cbtStudentPortalMiddleWareUrl = websiteUrl + '/student/config/code'; /// For CBT Student Portal Middleware Url //
    var cbtStudentPortalUrl = websiteUrl + '/student'; /// For Student Portal Url //

    /// Images Path ///
    var questionPixPath = websiteUrl + '/uploaded_files/cbt/question-pix/'; /// For Question Pix Path //
    var optionPixPath = websiteUrl + '/uploaded_files/cbt/option-pix/'; /// For Option Pix Path //
</script>