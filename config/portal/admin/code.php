<?php include '../../../config/constants.php';?>

<?php
$action=$_POST['action'];

switch ($action){
	case 'get_page':
		$page=$_POST['page'];
		require_once('page-content.php');
	break;
	case 'get_form':
		$page=$_POST['page'];
		require_once('form-content.php');
	break;
}
?>