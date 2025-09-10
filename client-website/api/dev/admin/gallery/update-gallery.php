<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){
	$response = [
        'response'=> 98,
        'success'=> false,
        'message'=> 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
    ]; 
	goto end;
} 

	if($check==0){ 
		$response = [
			'response'=> 99,
			'success'=> false,
			'message'=> 'SESSION EXPIRED! Please LogIn Again.'
		];  
		goto end;
	}

		/////////////// Variable Declaration/////////////////
		$page_category_id=trim(strtolower($_POST['page_category_id']));
		$publish_id = $_POST['publish_id'];
		$reg_title =str_replace("'", "\'", $_POST['reg_title']);
		$gallery_sub_title=trim($_POST['gallery_sub_title']);
		$class_gallery_sub_title = trim($_POST['class_gallery_sub_title']);
		$reg_thumbnail=$_FILES['reg_thumbnail']['name'];
		$status_id=trim($_POST['status_id']);	
		
		if (empty($publish_id)){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> 'PUBLISH ID REQUIRED! Check publish ID and try again.'
			];
			goto end;
		}

		if (empty($reg_title)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'GALLERY TITLE REQUIRED! Check sermon title and try again.'
			];
			goto end;
		}

		if (empty($gallery_sub_title) && empty($class_gallery_sub_title)) {
			$response = [
				'response' => 102,
				'success' => false,
				'message' => 'Provide either GALLERY SUB TITLE or CLASS GALLERY SUB TITLE. At least one is required!'
			];
			goto end;
		}
		
		if (!empty($gallery_sub_title) && !empty($class_gallery_sub_title)) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'You cannot provide both GALLERY SUB TITLE and CLASS GALLERY SUB TITLE at the same time. Choose one!'
			];
			goto end;
		}

		if (empty($status_id)){
			$response = [
				'response'=> 104,
				'success'=> false,
				'message'=> 'STATUS REQUIRED! Select the status and try again.'
			];
			goto end;
		}

			$publish_id_check = mysqli_query($conn, "SELECT publish_id FROM publish_tab WHERE publish_id='$publish_id'");
			$publish_id_count = mysqli_num_rows($publish_id_check);
			
			if ($publish_id_count == 0) {
				$response = [
					'response' => 105,
					'success' => false,
					'message' => "NO RECORD MATCH FOR THE PUBLISH ID! $publish_id doesn't exist"
				];
				goto end;
			}
				$gallery_title_check=mysqli_query($conn,"SELECT reg_title FROM publish_tab WHERE reg_title='$reg_title' AND publish_id!='$publish_id'");
				$gallery_title_check=mysqli_num_rows($gallery_title_check);

				if ($gallery_title_check>0){ 
					$response = [
						'response' => 106,
						'success' => false,
						'message' => "GALLERY TITLE NOT ACCETABLE! $reg_title already exist"
					]; 

					$alert_detail="GALLERY UPDATE FAILED: sermon with title $reg_title can not be updated as its already exist.";	
					$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
					goto end;
				}	

				$class_sub_title_check=mysqli_query($conn,"SELECT class_gallery_sub_title FROM publish_tab WHERE class_gallery_sub_title='$class_gallery_sub_title' AND publish_id!='$publish_id'");
				$class_sub_title_check=mysqli_num_rows($class_sub_title_check);

				if ($class_sub_title_check>0){ 
					$response = [
						'response' => 107,
						'success' => false,
						'message' => "CLASS SUB GALLERY TITLE NOT ACCETABLE! $class_gallery_sub_title already exist"
					]; 

					$alert_detail="GALLERY UPDATE FAILED: Class Sub Gallery with title $class_gallery_sub_title can not be updated as its already exist.";	
					$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
					goto end;
				}	
				
					$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png", "PNG", "GIF", "webp", "WEBP");
					$uploadPath = null;
					
					if (isset($_FILES['reg_thumbnail']) && $_FILES['reg_thumbnail']['error'] != UPLOAD_ERR_NO_FILE) {
						$extension = pathinfo($_FILES['reg_thumbnail']['name'], PATHINFO_EXTENSION);
					
						if (!in_array($extension, $allowedExts)) {
							$response = [
								'response' => 108,
								'success' => false,
								'message' => 'INVALID PICTURE FORMAT! Check the picture format and try again.'
							];  
							goto end; 
						}
					
						$publish_array = $callclass->_get_publish_detail($conn, $publish_id);
						$publish_array = json_decode($publish_array, true);
						$db_publish_pix = $publish_array[0]['reg_pix'];
						
						$datetime = date("Ymdhi");
						$reg_thumbnail = $publish_id.'_'.$datetime.'_'.$_FILES['reg_thumbnail']['name']; // Use original file name
						$uploadPath = $galleryProfilePixPath . $reg_thumbnail;
					
						if (!move_uploaded_file($_FILES["reg_thumbnail"]["tmp_name"], $uploadPath)) {
							$response = [
								'response' => 109,
								'success' => false,
								'message' => 'PICTURE UPLOAD ERROR! Contact your Engineer For Help'
							];  
							goto end; 
						}
						mysqli_query($conn, "UPDATE publish_tab SET reg_pix='$reg_thumbnail' WHERE publish_id='$publish_id'") or die(mysqli_error($conn));
					}
					
						mysqli_query($conn,"UPDATE publish_tab SET reg_title='$reg_title', gallery_sub_title='$gallery_sub_title', class_gallery_sub_title='$class_gallery_sub_title', status_id='$status_id', modified_by='$login_staff_id', `updated_time`=NOW() WHERE publish_id='$publish_id'") or die (mysqli_error($conn));
						
						$page_cat_array=$callclass->_get_setup_page_category_detail($conn, $page_category_id);
						$fetch_page_cat = json_decode($page_cat_array, true);
						$page_category_name= $fetch_page_cat[0]['page_category_name'];

						$response = [
							'response'=> 200,
							'success'=> true,
							'message'=> "SUCCESS! Gallery Updated Successful!",
							'publish_id'=> $publish_id
						]; 
						$alert_detail="Success Alert: A $page_category_name was updated successfully by  $login_staff_fullname. DETAILS: Title: $reg_title | ID: $publish_id";
						$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);

end:
echo json_encode($response);
?>