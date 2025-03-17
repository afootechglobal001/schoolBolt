<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept, apiKey, userOsBrowser, userIpAddress, userDeviceId");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header('Content-Type: application/json; charset=UTF-8');

////////////for live connect  
$_HOST_NAME = "145.239.185.59";  
$_DB_USERNAME ="schoolbolt_admin";
$_DB_PASSWORD ="Password@2024"; // ThisIsThePassword

$conn = mysqli_connect($_HOST_NAME, $_DB_USERNAME, $_DB_PASSWORD)or die("Unable to connect to MySQL1");
mysqli_select_db($conn,"schoolbolt_main_db");
/////////////////////////////////////////////////////////////////
?>

<?php require_once 'functions.php';?>
<?php require_once 'constants.php';?>