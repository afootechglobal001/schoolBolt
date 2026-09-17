<?php require_once 'constants.php';?>
<?php
$action=$_POST['action'];
switch ($action){

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$modalLayer=$_POST['modalLayer'];
		require_once('content-page.php');
	break;	

	case 'get_page':
		$page=$_POST['page'];
		$ids = $_POST['ids'];
		require_once('content-page.php');
	break;	
}?>