<?php include '../../config/constants.php';?>
<script src="<?php echo $websiteUrl?>/admin/js/session_validation.js"></script>

<?php
$action=$_POST['action'];

switch ($action){
	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$pageCategory=$_POST['pageCategory'];
		require_once('dashboard-content.php');
		require_once('cbt-configuration-content.php');
		require_once('set-exam-content.php');
		require_once('cbt-content.php');
		require_once('activate-exam-content.php');
	break;

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$pageCategory=$_POST['pageCategory'];
		$modalLayer=$_POST['modalLayer'];
		require_once('dashboard-content.php');
		require_once('cbt-configuration-content.php');
		require_once('set-exam-content.php');
		require_once('cbt-content.php');
		require_once('activate-exam-content.php');
	break;

	case 'uploadQuestionsPix':
		$newQuestionPixName = $_POST['newQuestionPixName'] ?? '';
		$questionPix = $_POST['questionPix'] ?? '';

		$newOptionAPixName = $_POST['newOptionAPixName'] ?? '';
		$optionAPix = $_POST['optionAPix'] ?? '';

		$newOptionBPixName = $_POST['newOptionBPixName'] ?? '';
		$optionBPix = $_POST['optionBPix'] ?? '';

		$newOptionCPixName = $_POST['newOptionCPixName'] ?? '';
		$optionCPix = $_POST['optionCPix'] ?? '';

		$newOptionDPixName = $_POST['newOptionDPixName'] ?? '';
		$optionDPix = $_POST['optionDPix'] ?? '';

		$newOptionEPixName = $_POST['newOptionEPixName'] ?? '';
		$optionEPix = $_POST['optionEPix'] ?? '';

		///// Question Image /////
		if (!empty($questionPix)) {
			$questionPix = preg_replace('#^data:image/\w+;base64,#i', '', $questionPix);
			$questionPix = str_replace(' ', '+', $questionPix);
			$questionPix = base64_decode($questionPix);
		}

		///// Option A Image /////
		if (!empty($optionAPix)) {
			$optionAPix = preg_replace('#^data:image/\w+;base64,#i', '', $optionAPix);
			$optionAPix = str_replace(' ', '+', $optionAPix);
			$optionAPix = base64_decode($optionAPix);
		}

		///// Option B Image /////
		if (!empty($optionBPix)) {
			$optionBPix = preg_replace('#^data:image/\w+;base64,#i', '', $optionBPix);
			$optionBPix = str_replace(' ', '+', $optionBPix);
			$optionBPix = base64_decode($optionBPix);
		}

		///// Option C Image /////
		if (!empty($optionCPix)) {
			$optionCPix = preg_replace('#^data:image/\w+;base64,#i', '', $optionCPix);
			$optionCPix = str_replace(' ', '+', $optionCPix);
			$optionCPix = base64_decode($optionCPix);
		}

		///// Option D Image /////
		if (!empty($optionDPix)) {
			$optionDPix = preg_replace('#^data:image/\w+;base64,#i', '', $optionDPix);
			$optionDPix = str_replace(' ', '+', $optionDPix);
			$optionDPix = base64_decode($optionDPix);
		}

		///// Option E Image /////
		if (!empty($optionEPix)) {
			$optionEPix = preg_replace('#^data:image/\w+;base64,#i', '', $optionEPix);
			$optionEPix = str_replace(' ', '+', $optionEPix);
			$optionEPix = base64_decode($optionEPix);
		}

		$uploadQuestionPixDir = "../../uploaded_files/cbt/question-pix/";
		$uploadOptionPixDir = "../../uploaded_files/cbt/option-pix/";

		///// Upload Question Image /////
		if (!empty($newQuestionPixName) && !empty($questionPix)) {
			file_put_contents(
				$uploadQuestionPixDir . $newQuestionPixName,
				$questionPix
			);
		}

		///// Upload Option A Image /////
		if (!empty($newOptionAPixName) && !empty($optionAPix)) {
			file_put_contents(
				$uploadOptionPixDir . $newOptionAPixName,
				$optionAPix
			);
		}

		///// Upload Option B Image /////
		if (!empty($newOptionBPixName) && !empty($optionBPix)) {
			file_put_contents(
				$uploadOptionPixDir . $newOptionBPixName,
				$optionBPix
			);
		}

		///// Upload Option C Image /////
		if (!empty($newOptionCPixName) && !empty($optionCPix)) {
			file_put_contents(
				$uploadOptionPixDir . $newOptionCPixName,
				$optionCPix
			);
		}

		///// Upload Option D Image /////
		if (!empty($newOptionDPixName) && !empty($optionDPix)) {
			file_put_contents(
				$uploadOptionPixDir . $newOptionDPixName,
				$optionDPix
			);
		}

		///// Upload Option E Image /////
		if (!empty($newOptionEPixName) && !empty($optionEPix)) {
			file_put_contents(
				$uploadOptionPixDir . $newOptionEPixName,
				$optionEPix
			);
		}
	break;
}
?>