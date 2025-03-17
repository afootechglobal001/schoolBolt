<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$website_auto_url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$thename='SchoolBolt'; 

	//$website_url='http://localhost/projects/schoolbolt.com';
	//$website_url='http://192.168.199.51/projects/schoolbolt.com';
	$website_url='https://schoolbolt.com';

	$code_version='10.4';
?>

<script>
	//////////////////online constants///////////////////////
	var website_url='https://schoolbolt.com';
	//var website_url='http://localhost/projects/schoolbolt.com';
	//var website_url='http://192.168.199.51/projects/schoolbolt.com';
</script>

