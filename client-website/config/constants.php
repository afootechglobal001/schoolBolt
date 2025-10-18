<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	$website_auto_url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$thename='ADVANCED BREED GROUP OF SCHOOLS'; 

	$website_url='http://localhost/projects/schoolbolt/client-website';
	$portalUrl=$website_url.'/portal';

	$code_version='10.19';
?>

<script>
//////////////////online constants///////////////////////
var website_url = 'http://localhost/projects/schoolbolt/client-website';

var apiKey = 'cb2321c2-64bd-434a-ac30-0acbad030d61';
var endPoint = website_url + '/api/dev'; /// Server End Point url

var admin_login_local_url = website_url + '/admin/config/code'; /// For Admin local_url //
var index_local_url = website_url + '/config/code'; /// For Site local_url //
var admin_local_portal_url = website_url + '/admin/a/config/code'; /// admin local portal url
var admin_portal_url = website_url + '/admin/a'; /// admin portal url
var admin_login_portal_url = website_url + '/admin'; /// For Admin local_url //
</script>