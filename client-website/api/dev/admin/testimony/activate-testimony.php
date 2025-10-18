<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>

<?php
// Check for API security
if ($apiKey != $expected_api_key) {
    $response = [
        'response' => 98,
        'success' => false,
        'message' => 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
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
		// Declaration of variables
		$testimony_id = trim($_POST['testimony_id']);
		$fullname = trim($_POST['fullname']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$relationship_type_id = trim($_POST['relationship_type_id']);
		$testimony =str_replace("'", "\'", $_POST['testimony']);
		$status_id = trim($_POST['status_id']);


		if (empty($testimony_id)) {
			$response = [
				'response' => 100,
				'success' => false,
				'message' => 'TESTIMONY ID REQUIRED! Check and try again.'
			];
			goto end;
		}

		if (empty($fullname)) {
			$response = [
				'response' => 101,
				'success' => false,
				'message' => 'FULLNAME REQUIRED! Check fullname field and try again.'
			];
			goto end;
		}

		if (empty($email)) {
			$response = [
				'response' => 102,
				'success' => false,
				'message' => 'EMAIL REQUIRED! Check email field and try again.'
			];
			goto end;
		}

		if (!preg_match('/^\d{1,11}$/', $phone)) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'PHONE NUMBER INVALID! It must be numeric and no more than 11 digits.'
			];
			goto end;
		}

		if (empty($relationship_type_id)) {
			$response = [
				'response' => 104,
				'success' => false,
				'message' => 'TESTIMONY RELATIONSHIP REQUIRED! Check field and try again.'
			];
			goto end;
		}

		if (empty($testimony)) {
			$response = [
				'response' => 104,
				'success' => false,
				'message' => 'TESTIMONY MESSAGE REQUIRED! Check field and try again.'
			];
			goto end;
		}

		if (empty($status_id)) {
			$response = [
				'response' => 105,
				'success' => false,
				'message' => 'STATUS ID REQUIRED! Check field and try again.'
			];
			goto end;
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$response = [
				'response'=> 106,
				'success'=> false,
				'message'=> "ERROR: $email is NOT a valid email address"
			]; 
			goto end;
		}

			$testimony_id_check = mysqli_query($conn, "SELECT testimony_id FROM testimony_tab WHERE testimony_id='$testimony_id'");
			$testimony_id_count = mysqli_num_rows($testimony_id_check);
			
			if ($testimony_id_count == 0) {
				$response = [
					'response' => 107,
					'success' => false,
					'message' => "NO RECORD MATCH FOR THE TESTIMONY ID! $testimony_id doesn't exist"
				];
				goto end;
			}
			
				$usercheck=mysqli_query($conn,"SELECT * FROM testimony_tab WHERE email='$email' AND testimony_id!='$testimony_id' ");
				$useremail=mysqli_num_rows($usercheck);

				if ($useremail>0){
					$response = [
						'response'=> 108,
						'success'=> false,
						'message'=> "EMAIL NOT ACCETABLE! $email already exist"
					]; 
					goto end;	
				}
				
					mysqli_query($conn,"UPDATE testimony_tab SET fullname='$fullname', email='$email', phone='$phone', relationship_type_id='$relationship_type_id', testimony='$testimony', modified_by='$login_staff_id', status_id='$status_id', `updated_time`=NOW() WHERE testimony_id='$testimony_id'") or die (mysqli_error($conn));
					$response = [
						'response'=> 200,
						'success'=> true,
						'message'=> "SUCCESS! Testimony Updated Successful!"
					]; 

					$alert_detail="TESTIMONY UPDATED SUCCESSFUL!: A staff whose name - $login_staff_fullname, successfully updated a testimony. DETAILS: - Full Name: $fullname, ID: $email";	
					$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
				
end:
echo json_encode($response);
?>
