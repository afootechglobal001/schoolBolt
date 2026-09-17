<?php include '../../../config/constants.php';?>
<!-- <script src="<?php echo $websiteUrl?>/portal/js/session_validation.js"></script> -->

<?php
$action=$_POST['action'];

switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$pageCategory=$_POST['pageCategory'];
		require_once('dashboard-content.php');
		require_once('administrator-content.php');
		require_once('service-content.php');
		require_once('gallery-content.php');
		require_once('blog-content.php');
		require_once('faq-content.php');
		require_once('review-content.php');
		require_once('settings-content.php');
		require_once('role-content.php');
		require_once('pages-content.php');
		require_once('page-details.php');
		require_once('information-category-content.php');
		require_once('project-category-content.php');
		require_once('account-report/account-report-content.php');
		require_once('schools-content.php');
	break;

	case 'get_form':
		$page=$_POST['page'];
		$id=$_POST['id'];
		$pageCategory=$_POST['pageCategory'];
		$modalLayer=$_POST['modalLayer'];
		require_once('dashboard-content.php');
		require_once('administrator-content.php');
		require_once('service-content.php');
		require_once('gallery-content.php');
		require_once('blog-content.php');
		require_once('faq-content.php');
		require_once('review-content.php');
		require_once('settings-content.php');
		require_once('role-content.php');
		require_once('pages-content.php');
		require_once('page-details.php');
		require_once('information-category-content.php');
		require_once('project-category-content.php');
		require_once('account-report/account-report-content.php');
		require_once('schools-content.php');
	break;

	case 'uploadPagePix':
		$pageCategory = $_POST['pageCategory'] ?? '';
		$newSeoFlyer = $_POST['newSeoFlyer'] ?? '';
		$seoFlyer = $_POST['seoFlyer'] ?? '';
	
		///// Validate SEO Flyer /////
		if (!empty($seoFlyer)) {
    		$seoFlyer = preg_replace('#^data:image/\w+;base64,#i', '', $seoFlyer);
			$seoFlyer = str_replace(' ', '+', $seoFlyer);
			$seoFlyer = base64_decode($seoFlyer);
		}
		
		if ($pageCategory==="blog") {
			$uploadPagesPictureDir = "../../../uploaded_files/blog/";
		} else if ($pageCategory==="service") {
			$uploadPagesPictureDir = "../../../uploaded_files/services/";
		} else if ($pageCategory==="portfolio") {
			$uploadPagesPictureDir = "../../../uploaded_files/portfolio/";
		}

		//// Create Directory If Not Exists ////
		if (!empty($newSeoFlyer) && !empty($seoFlyer)) {
			file_put_contents($uploadPagesPictureDir . $newSeoFlyer, $seoFlyer);
		}
    break;

	case 'uploadPagePictures':
		$pagePixNames=$_POST['pagePixNames'];

		if($pagePixNames!=''){
			$myArray = explode(',', $pagePixNames);
				$i=0;
				foreach($myArray as $picture){
					move_uploaded_file($_FILES["pagePixArr"]["tmp_name"][$i], '../../../uploaded_files/pagePictures/' . $picture);
					$i++;
				}
		}
	break;

	case 'deleteOldPagePictures':
		$oldPagePix=$_POST['oldPagePix'];

		$uploadDir = "../../../uploaded_files/pagePictures/";

		// Delete old image only if it's not the default
		if (!empty($oldPagePix) && file_exists($uploadDir . $oldPagePix)) {
			unlink($uploadDir . $oldPagePix);
		}
	break;

	case 'createPagesFolder':
		$pageCategory = strtolower(trim($_POST['pageCategory']));
		$pageId = trim($_POST['pageId']);
		$pageUrl = trim(strtolower($_POST['pageUrl']));
		$oldPageUrl = trim(strtolower($_POST['oldPageUrl']));
		$pageTitle = trim($_POST['pageTitle']);
		$seoKeywords = $_POST['seoKeywords'];
		$seoDescription = $_POST['seoDescription'];
		$newSeoFlyer = $_POST['newSeoFlyer'];
		$projectStageName = $_POST['projectStageName'] ?? '';
		$pageSeoPix = $newSeoFlyer;

		// common text content
		$txt .= "<?php \$pageId='$pageId';?>\n";
		$txt .= "<?php \$pageUrl='$pageUrl';?>\n";
		$txt .= "<?php \$pageTitle='$pageTitle';?>\n";
		$txt .= "<?php \$seoKeywords='$seoKeywords';?>\n";
		$txt .= "<?php \$seoDescription='$seoDescription';?>\n";
		$txt .= "<?php \$pageSeoPix='$pageSeoPix';?>\n";

		//// include page details file ////
		if ($pageCategory == 'portfolio'){
			$txt .= "<?php include " . "'../../$pageCategory" . "_details.php';?>";
		} else {
			$txt .= "<?php include " . "'../$pageCategory" . "_details.php';?>";
		}

		/// check if old page url is empty to create new folder////
		if (empty($oldPageUrl) || $oldPageUrl===null) {
			////////// Create Page Folder //////////
			if ($pageCategory == 'blog') {
				mkdir('../../../blog/' . $pageUrl);
				$myfile = fopen("../../../blog/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");
			} else if ($pageCategory == 'service') {
				mkdir('../../../services/' . $pageUrl);
				$myfile = fopen("../../../services/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");
			} else if ($pageCategory == 'portfolio') {
				mkdir('../../../portfolio/'.$projectStageName.'/' . $pageUrl);
				$myfile = fopen("../../../portfolio/".$projectStageName."/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");	
			}
			fwrite($myfile, $txt);
			fclose($myfile);
		} else {
			if ($pageCategory == 'blog') {
				//// delete file with folders ////
				array_map('unlink', glob("../../../blog/$oldPageUrl/*.*"));
				rmdir("../../../blog/$oldPageUrl");

				//// recreate new file with folders ////
				mkdir('../../../blog/' . $pageUrl);
				$myfile = fopen("../../../blog/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");
			} else if ($pageCategory == 'service') {
				//// delete file with folders ////
				array_map('unlink', glob("../../../services/$oldPageUrl/*.*"));
				rmdir("../../../services/$oldPageUrl");

				//// recreate new file with folders ////
				mkdir('../../../services/' . $pageUrl);
				$myfile = fopen("../../../services/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");
			} else if ($pageCategory == 'portfolio') {
				//// delete file with folders ////
				array_map('unlink', glob("../../../portfolio/".$projectStageName."/$oldPageUrl/*.*"));
				rmdir("../../../portfolio/".$projectStageName."/$oldPageUrl");

				//// recreate new file with folders ////
				mkdir('../../../portfolio/'.$projectStageName.'/' . $pageUrl);
				$myfile = fopen("../../../portfolio/".$projectStageName."/" . $pageUrl . "/index.php", "w") or die("Unable to open file!");	
			}
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	break;
}
?>