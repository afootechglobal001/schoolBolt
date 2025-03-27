<?php include '../../constants.php';?>
<script src="<?php echo $websiteUrl?>/js/admin/session_validation.js"></script>

<?php
$action=$_POST['action'];

switch ($action){
	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		require_once('dashboard-content.php');
		require_once('branch-content.php');
		require_once('staff-content.php');
		require_once('settings-content.php');
		require_once('role-content.php');
		require_once('department-content.php');
		require_once('class-content.php');
		require_once('arm-content.php');
		require_once('subject-content.php');
		require_once('branch-operation/student-content.php');
		require_once('branch-operation/class-content.php');
		require_once('branch-operation/subject-content.php');
	break;

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$modalLayer=$_POST['modalLayer'];
		require_once('dashboard-content.php');
		require_once('branch-content.php');
		require_once('staff-content.php');
		require_once('settings-content.php');
		require_once('role-content.php');
		require_once('department-content.php');
		require_once('class-content.php');
		require_once('arm-content.php');
		require_once('subject-content.php');
		require_once('branch-operation/student-content.php');
		require_once('branch-operation/class-content.php');
		require_once('branch-operation/subject-content.php');
	break;

	case 'upload_student_pix':
		$oldPassportName=$_POST['oldPassportName'];
		$newPassportName=$_POST['newPassportName'];
		$passport=$_POST['passport'];
		$passport = str_replace('data:image/jpeg;base64,', '', $passport);
		$passport = str_replace(' ', '+', $passport);
		$passport = base64_decode($passport);
		if($oldPassportName!='default.jpg'){
			unlink("../../../uploaded_files/studentPix/" .$oldPassportName);
		}
		file_put_contents('../../../uploaded_files/studentPix/'.$newPassportName, $passport);
	break;

	case 'upload_staff_pix':
		$oldPassportName=$_POST['oldPassportName'];
		$newPassportName=$_POST['newPassportName'];
		$passport=$_POST['passport'];
		$passport = str_replace('data:image/jpeg;base64,', '', $passport);
		$passport = str_replace(' ', '+', $passport);
		$passport = base64_decode($passport);
		if($oldPassportName!='default.jpg'){
			unlink("../../../uploaded_files/staffPix/" .$oldPassportName);
		}
		file_put_contents('../../../uploaded_files/staffPix/'.$newPassportName, $passport);
	break;
}
?>

<script src="<?php echo $websiteUrl?>/js/aos.js"></script>
<script>
AOS.init({
  easing: 'ease-in-out-sine'
});
</script>

