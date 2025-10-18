<?php include '../constants.php';?>

<?php
$action=$_POST['action'];

switch ($action){
	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once('form-content.php');
	break;

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$modalLayer=$_POST['modalLayer'];
		require_once('form-content.php');
	break;
}
?>

<script src="<?php echo $websiteUrl?>/js/aos.js"></script>
<script>
AOS.init({
  easing: 'ease-in-out-sine'
});
</script>

