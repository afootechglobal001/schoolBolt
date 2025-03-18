<?php
/////// developed by Mike Afolabi on 17-03-2025//////////////////////
$appName="SchoolBolt Edu System";
$appDescription="SchoolBolt is web application software, which aims at providing school management services to basic/secondary schools, selecting the legitimate staff by the school administrator.";

////////////////////////////////////////////////////////////////////////
$userOsBrowser = isset($_SERVER['HTTP_USEROSBROWSER']) ? $_SERVER['HTTP_USEROSBROWSER'] : null;
$userIpAddress = isset($_SERVER['HTTP_USERIPADDRESS']) ? $_SERVER['HTTP_USERIPADDRESS'] : null;
$userDeviceId = isset($_SERVER['HTTP_USERDEVICEID']) ? $_SERVER['HTTP_USERDEVICEID'] : null;
$clientId = isset($_SERVER['HTTP_CLIENTID']) ? $_SERVER['HTTP_CLIENTID'] : null;
$clientAddress = isset($_SERVER['HTTP_CLIENTADDRESS']) ? $_SERVER['HTTP_CLIENTADDRESS'] : null;
$frontEndApiKey = isset($_SERVER['HTTP_APIKEY']) ? $_SERVER['HTTP_APIKEY'] : null;
$backEndApiKey='a7c37b6289b9dd879b2c005118d3ef14'; //schoolBoltApiKey@2025
////////////////////////////////////////////////////////////////////////


$checkBasicSecurity=true;
///// check for API security
if ($frontEndApiKey!=$backEndApiKey){/// start if 1
	$response['response']=96; 
	$response['success']=false;
	$response['message']="SECURITY ACCESS DENIED! You are not allowed to execute this command due to security bridge.";
    $checkBasicSecurity=false;
}

$query=mysqli_query($connAdmin,"SELECT * FROM CLIENTS_TAB WHERE hashId='$clientId'") or die (mysqli_error($connAdmin));
	$countClient=mysqli_num_rows($query);
	if ($countClient==0){ /// start if 4
		$response['response']=90; 
		$response['success']=false;
		$response['message']="ERROR 90! Kindly contact SchoolBolt Admin For help."; 
		$checkBasicSecurity=false;
	}else{
		$fetchQuery=mysqli_fetch_array($query);
		$dbClientAddress=$fetchQuery['clientAddress']; 
		$statusId=$fetchQuery['statusId'];

		if($statusId!=1){
			$response['response']=91; 
			$response['success']=false;
			$response['message']="ERROR 91! Kindly contact SchoolBolt Admin For help."; 
			$checkBasicSecurity=false;
		}else{
			if (!strstr($clientAddress, $dbClientAddress)){
				$response['response']=92; 
				$response['success']=false;
				$response['message']="ERROR 92! Kindly contact SchoolBolt Admin For help."; 
				$checkBasicSecurity=false;
			}
		}

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

// Read the raw JSON input
$json = file_get_contents('php://input');
// Decode the JSON into an associative array
$data = json_decode($json, true);
?>