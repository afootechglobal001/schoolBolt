<?php
/////// developed by Mike Afolabi on 17-03-2025//////////////////////
$appName="SchoolBolt Edu System";
$appDescription="SchoolBolt is web application software, which aims at providing school management services to basic/secondary schools, selecting the legitimate staff by the school administrator.";

////////////////////////////////////////////////////////////////////////
$userOsBrowser = isset($_SERVER['HTTP_USEROSBROWSER']) ? $_SERVER['HTTP_USEROSBROWSER'] : null;
$userIpAddress = isset($_SERVER['HTTP_USERIPADDRESS']) ? $_SERVER['HTTP_USERIPADDRESS'] : null;
$userDeviceId = isset($_SERVER['HTTP_USERDEVICEID']) ? $_SERVER['HTTP_USERDEVICEID'] : null;
$frontEndApiKey = isset($_SERVER['HTTP_APIKEY']) ? $_SERVER['HTTP_APIKEY'] : null;
////////////////////////////////////////////////////////////////////////



/// all constance
$websiteUrl='http://localhost/projects/schoolBolt';
//$websiteUrl='https://schoolbolt.com';
$backEndApiKey='a7c37b6289b9dd879b2c005118d3ef14'; //schoolBoltApiKey@2025



// Read the raw JSON input
$json = file_get_contents('php://input');
// Decode the JSON into an associative array
$data = json_decode($json, true);

$checkBasicSecurity=true;
///// check for API security
if ($frontEndApiKey!=$backEndApiKey){/// start if 1
	$response['response']=96; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
    $checkBasicSecurity=false;
}

///// check for userOsBrowser security
if (empty($userOsBrowser)){/// start if 1
	$response['response']=97; 
	$response['success']=false;
	$response['message']="ACCESS DENIED! The host OS and browser is undefined."; 
    $checkBasicSecurity=false;
}

///// check for userIpAddress security
if (empty($userIpAddress)){/// start if 1
	$response['response']=98; 
	$response['success']=false;
	$response['message']="ACCESS DENIED! The host IpAddress is undefined."; 
    $checkBasicSecurity=false;
}

///// check for userDeviceId security
if (empty($userDeviceId)){/// start if 1
	$response['response']=99; 
	$response['success']=false;
	$response['message']="ACCESS DENIED! User device is undefined."; 
    $checkBasicSecurity=false;
}
?>