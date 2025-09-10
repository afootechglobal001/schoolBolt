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
		$old_password=$_POST['old_password'];
		$new_password=$_POST['new_password'];
		$confirm_password=$_POST['confirm_password'];

		$oldpassword=md5($old_password);
		$password=md5($new_password);
		
		if (empty($old_password)){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> '"OLD PASSWORD REQUIRED! Kindly check and try again.'
			];
			goto end;
		}

		if (empty($new_password)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'NEW PASSWORD REQUIRED! Kindly check and try again.'
			];
			goto end;
		}

		if (empty($confirm_password)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'CONFIRM PASSWORD REQUIRED! Kindly check and try again.'
			];
			goto end;
		}	

			if ($new_password !== $confirm_password) {
				$response = [
					'response' => 103,
					'success' => false,
					'message' => 'PASSWORD NOT MATCH! Kindly check and try again.'
				];
				goto end;
			}

				$query = mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id='$login_staff_id' AND password='$oldpassword'") or die(mysqli_error($conn));
				$count_user = mysqli_num_rows($query);

				if ($count_user != 1) {
					$response = [
						'response' => 104,
						'success' => false,
						'message' => 'INCORRECT OLD PASSWORD! Kindly check and try again.'
					]; 
					goto end;
				}

				$access_key=md5($login_staff_id.date("Ymdhis"));
				mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', password='$password' WHERE staff_id='$login_staff_id'") or die (mysqli_error($conn));
				
				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> "PASSWORD UPDATED SUCCESSFULLY!"
				]; 

				$alert_detail="PASSWORD UPDATED SUCCESSFULLY: A staff whose name is  $login_staff_fullname with ID: $login_staff_id have successfully reset his/her password.";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);	

end:
echo json_encode($response);
?>