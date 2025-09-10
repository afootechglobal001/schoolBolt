<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$website_auto_url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$thename='AR-RAHMAN MONTESSORI SCHOOLS'; 

	//$website_url='http://localhost/projects/arrahmangroupofschools.com';
	//$website_url='http://192.168.236.51/projects/arrahmangroupofschools.com';
	$website_url='https://arrahmangroupofschools.com';
	$portalUrl=$website_url.'/portal';

	$code_version='10.19';
?>

<script>
	//////////////////online constants///////////////////////
	var website_url='https://arrahmangroupofschools.com';
	//var website_url='http://localhost/projects/arrahmangroupofschools.com';
	//var website_url='http://192.168.236.51/projects/arrahmangroupofschools.com';

	var apiKey ='cb2321c2-64bd-434a-ac30-0acbad030d61';
	var endPoint=website_url+'/api/dev'; /// Server End Point url

	var admin_login_local_url=website_url+'/admin/config/code'; /// For Admin local_url //
	var index_local_url=website_url+'/config/code'; /// For Site local_url //
	var admin_local_portal_url=website_url+'/admin/a/config/code'; /// admin local portal url
	var admin_portal_url=website_url+'/admin/a'; /// admin portal url
	var admin_login_portal_url=website_url+'/admin'; /// For Admin local_url //
</script>

