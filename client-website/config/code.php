<?php require_once 'constants.php';?>
<?php
$action=$_POST['action'];
switch ($action){

	case 'get_form':
		$page=$_POST['page'];
		require_once 'content-page.php';
	break;

	case 'open_preview_with_id':
		$publish_id=$_POST['publish_id'];
		$divid=$_POST['divid'];
		$page=$_POST['page'];
		require_once 'content-page.php';
	break;
	
}?>
