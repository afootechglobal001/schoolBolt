<?php include '../../../config/constants.php';?>
<script src="js/session_validation.js"></script>

<?php
$action=$_POST['action'];

switch ($action){

	case 'get_page':
		$page=$_POST['page'];
		include '../content/page-content.php';
	break;

	case 'get_page_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/page-content.php';
	break;

	case 'get_form':
		$page=$_POST['page'];
		include '../content/form.php';
	break;

	case 'get_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$page_category_id=$_POST['page_category_id'];
		$publish_id=$_POST['publish_id'];
		include '../content/form.php';
	break;

	case 'get_form_page_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		include '../content/page-details.php';
	break;

	case 'get_secondary_form_with_id':
		$page=$_POST['page'];
		$ids=$_POST['ids'];
		$publish_id=$_POST['publish_id'];
		$video_id=$_POST['video_id'];
		$material_id=$_POST['material_id'];
		$audio_id=$_POST['audio_id'];
		include '../content/form.php';
	break;

	case 'get_pages_details':
		$page=$_POST['page'];
		$publish_id=$_POST['publish_id'];
		include '../content/page-details.php';
	break;

	case 'get_edit_page_form': 
		$page_category_id=$_POST['page_category_id'];
		$publish_id=$_POST['publish_id'];
		$view_content='edit_page_form';
		include '../content/form.php';
	break;	


	// case 'get_check_page_content': 
	// 	$check_page_content=$_POST['check_page_content'];
	// 	$publish_id=$_POST['publish_id'];
	// 	require_once '../content/page-details.php';
	// break;	

	case 'createPagesFolder': 	
		$page_category_id = strtolower(trim($_POST['page_category_id']));
		$publish_id = trim($_POST['publish_id']);
		$page_url= trim(strtolower($_POST['page_url']));
		$db_page_url = trim($_POST['db_page_url']);
		$page_title = trim($_POST['page_title']);
		$db_seo_flyer = $_POST['db_seo_flyer']; 
		$seo_flyer = $_POST['seo_flyer']; 
		$seo_keywords = $_POST['seo_keywords'];
		$seo_description = $_POST['seo_description']; 
		$page_content = $_POST['page_content']; 

		$page_seo_pix = $seo_flyer;

		if (empty($page_seo_pix)||($page_seo_pix=='')||($page_seo_pix==null)) {
			$page_seo_pix = $db_seo_flyer;
		}

		if (empty($db_page_url)||($db_page_url=='')||($db_page_url==null)){
			////////// Create Page Folder //////////
			if ($page_category_id=='sermon_category'){
				mkdir('../../../sermon/'.$page_url);
				$myfile = fopen("../../../sermon/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}elseif ($page_category_id=='event_category'){
				mkdir('../../../event/'.$page_url);
				$myfile = fopen("../../../event/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}elseif ($page_category_id=='blog_category'){
				mkdir('../../../blog/'.$page_url);
				$myfile = fopen("../../../blog/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}	
	
			// Write to index.php file
			$txt = "<?php include '../../config/constants.php';?>\n";
			$txt .= "<?php " . strval('$publish_id') . "='$publish_id';?>\n";
			$txt .= "<?php " . strval('$page_url') . "='$page_url';?>\n";
			$txt .= "<?php " . strval('$page_title') . "='$page_title';?>\n";
			$txt .= "<?php " . strval('$seo_keywords') . "='$seo_keywords';?>\n";
			$txt .= "<?php " . strval('$seo_description') . "='$seo_description';?>\n";
			$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
			$txt .= "<?php include "."'../$page_category_id"."_details.php';?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}else{
			////////// Delete Page Folder //////////
			if ($page_category_id=='sermon_category'){
				array_map('unlink', glob("../../../sermon/$db_page_url/*.*"));
				rmdir("../../../sermon/$db_page_url");
		  	}elseif ($page_category_id=='event_category'){
				array_map('unlink', glob("../../../event/$db_page_url/*.*"));
				rmdir("../../../event/$db_page_url");
			}elseif ($page_category_id=='blog_category'){
				array_map('unlink', glob("../../../blog/$db_page_url/*.*"));
				rmdir("../../../blog/$db_page_url");
			}	


			////////// Recreate Page Folder //////////
			if ($page_category_id=='sermon_category'){
				mkdir('../../../sermon/'.$page_url);
				$myfile = fopen("../../../sermon/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}elseif ($page_category_id=='event_category'){
				mkdir('../../../event/'.$page_url);
				$myfile = fopen("../../../event/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}elseif ($page_category_id=='blog_category'){
				mkdir('../../../blog/'.$page_url);
				$myfile = fopen("../../../blog/" . $page_url . "/index.php", "w") or die("Unable to open file!");
			}	
	
			// Write to index.php file
			$txt = "<?php include '../../config/constants.php';?>\n";
			$txt .= "<?php " . strval('$publish_id') . "='$publish_id';?>\n";
			$txt .= "<?php " . strval('$page_url') . "='$page_url';?>\n";
			$txt .= "<?php " . strval('$page_title') . "='$page_title';?>\n";
			$txt .= "<?php " . strval('$seo_keywords') . "='$seo_keywords';?>\n";
			$txt .= "<?php " . strval('$seo_description') . "='$seo_description';?>\n";
			$txt .= "<?php \$page_seo_pix='$page_seo_pix';?>\n";
			$txt .= "<?php include "."'../$page_category_id"."_details.php';?>";
			fwrite($myfile, $txt);
			fclose($myfile);
		}
	break;	
}
?>