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
		$staff_id=trim(strtoupper($_POST['staff_id']));
		$profile_pix=$_FILES['profile_pix']['name'];

	

			$allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
			$extension = pathinfo($_FILES['profile_pix']['name'], PATHINFO_EXTENSION);
			
			if (!in_array(($extension), $allowedExts)) {
				$response = [
					'response' => 101,
					'success' => false,
					'message' => 'INVALID PICTURE FORMAT! Check the picture format and try again.'
				];  
				goto end;
			}
			
				$datetime = date("Ymdhi");
				$profile_pix = $staff_id . '_' . $datetime . '_' . $profile_pix;
				$uploadPath = $staffProfilePixPath . $profile_pix;
			
					if (!move_uploaded_file($_FILES["profile_pix"]["tmp_name"], $uploadPath)) {
						$response = [
							'response' => 102,
							'success' => false,
							'message' => 'PICTURE UPLOAD ERROR! Contact your Engineer For Help'
						];  
						goto end;
					}
			
						$user_array = $callclass->_get_staff_details($conn, $staff_id);
						$user_array = json_decode($user_array, true);
						$db_passport = $user_array[0]['profile_pix'];
						$fullname = $user_array[0]['fullname'];
						
						if ($db_passport != 'avatar.jpg') {
							unlink($staffProfilePixPath . $db_passport);
						}

						mysqli_query($conn,"UPDATE `staff_tab` SET profile_pix='$profile_pix' WHERE staff_id='$staff_id'")or die (mysqli_error($conn));

						$response = [
							'response'=> 200,
							'success'=> true,
							'message'=> 'SUCCESS! Staff picture updated successfully!'
						];  

						$alert_detail="STAFF PICTURE UPDATED SUCCESSFUL:A staff whose name - $login_staff_fullname, successfully uploaded his/her profile picture. DETAILS: - Full Name: $fullname, ID: $staff_id";	
						$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);

end:
echo json_encode($response);
?>