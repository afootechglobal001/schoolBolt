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

		/////////////// Vvariable Declaration/////////////////
		$publish_id = $_POST['publish_id'];
		$reg_title =str_replace("'", "\'", $_POST['reg_title']);
		$event_date=trim($_POST['event_date']);
		$event_start_time=trim($_POST['event_start_time']);
		$event_end_time=trim($_POST['event_end_time']);
		$event_location=trim($_POST['event_location']);
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
				'message'=> 'SERMON TITLE REQUIRED! Check sermon title and try again.'
			];
			goto end;
		}

		if (empty($event_date)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'EVENT DATE REQUIRED! Check sermon speaker and try again.'
			];
			goto end;
		}

		if (empty($event_start_time)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'EVENT START TIME REQUIRED! Check event start time and try again.'
			];
			goto end;
		}

		if (empty($event_end_time)){
			$response = [
				'response'=> 103,
				'success'=> false,
				'message'=> 'EVENT END TIME REQUIRED! Check event end time and try again.'
			];
			goto end;
		}

		if (empty($event_location)){
			$response = [
				'response'=> 103,
				'success'=> false,
				'message'=> 'EVENT LOCATION REQUIRED! Check sermon speaker and try again.'
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
				$sermon_title_check=mysqli_query($conn,"SELECT reg_title FROM publish_tab WHERE reg_title='$reg_title' AND publish_id!='$publish_id' ");
				$sermon_title_check=mysqli_num_rows($sermon_title_check);

				if ($sermon_title_check>0){ 
					$response = [
						'response' => 106,
						'success' => false,
						'message' => "EVENT TITLE NOT ACCETABLE! $reg_title already exist"
					]; 

					$alert_detail="EVENT UPDATE FAILED: sermon with title $reg_title can not be updated as its already exist.";	
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
					
						unlink($eventProfilePixPath . $db_publish_pix);
					
						$datetime = date("Ymdhi");
						$reg_thumbnail = $publish_id . '_' . $datetime . '_' . $_FILES['reg_thumbnail']['name']; // Use original file name
						$uploadPath = $eventProfilePixPath . $reg_thumbnail;
					
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
					
						$event_date_with_time = "$event_date $event_start_time:00"; 

						mysqli_query($conn,"UPDATE publish_tab SET reg_title='$reg_title', event_date='$event_date_with_time', event_start_time='$event_start_time', event_end_time='$event_end_time', event_location='$event_location', status_id='$status_id', modified_by='$login_staff_id', `updated_time`=NOW() WHERE publish_id='$publish_id'") or die (mysqli_error($conn));
						$response = [
							'response'=> 200,
							'success'=> true,
							'message'=> "SUCCESS! Event Updated Successful!",
							'publish_id'=> $publish_id,
						]; 
						$alert_detail="Success Alert: A $page_category_name was updated successfully by  $login_staff_fullname. DETAILS: Title: $reg_title | ID: $publish_id";
						$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);

end:
echo json_encode($response);
?>