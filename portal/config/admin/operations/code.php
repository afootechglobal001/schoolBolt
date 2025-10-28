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
		require_once('branch-operation/account-content.php');
		require_once('account-report/account-report-content.php');
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
		require_once('branch-operation/account-content.php');
		require_once('account-report/account-report-content.php');
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

	case 'uploadFile':
		$fileType = $_POST['fileType'] ?? '';
		$oldFile = $_POST['oldFile'] ?? '';
		$newFile = $_POST['newFile'] ?? '';

		$folders = [
			'schoolLogo' => "../../../uploaded_files/branchLogo/",
			'principalSignature' => "../../../uploaded_files/branchPrincipalSignature/",
			'midTermResultHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'caResultSummaryHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'caBroadSheetHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'terminalBroadSheetHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'classListHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'cummulativeMarkBookHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'markBookHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'progressReportHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'scoreSheetHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'studentListHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'subjectListHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'terminalResultSummaryHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'terminalResultHeader' => "../../../uploaded_files/schoolResultHeaders/",
			'watermark' => "../../../uploaded_files/schoolResultHeaders/"
		];

		$uploadDir = $folders[$fileType];

		if (!empty($oldFile) && file_exists($uploadDir . $oldFile)) {
			unlink($uploadDir . $oldFile);
		}

		if (!empty($newFile) && isset($_FILES[$fileType]) && $_FILES[$fileType]['error'] === UPLOAD_ERR_OK) {
			move_uploaded_file($_FILES[$fileType]['tmp_name'], $uploadDir . $newFile);
		}
    break;
}
?>

<script src="<?php echo $websiteUrl?>/js/aos.js"></script>
<script>
AOS.init({
    easing: 'ease-in-out-sine'
});
</script>