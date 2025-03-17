<?php require_once 'constants.php';?>
<?php
$action=$_POST['action'];
switch ($action){

	case 'get_form':
		$page=$_POST['page'];
		require_once 'content-page.php';
	break;
}?>
