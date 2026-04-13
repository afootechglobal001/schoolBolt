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
		$smtp_host=trim($_POST['smtp_host']);
		$smtp_username=trim($_POST['smtp_username']);
		$smtp_password=trim($_POST['smtp_password']);
		$smtp_port=trim($_POST['smtp_port']);
		$sender_name=trim($_POST['sender_name']);
		$support_email=trim($_POST['support_email']);
		
		if (empty($smtp_host)){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> 'SMTP REQUIRED! Check smtp and try again.'
			];
			goto end;
		}

		if (empty($smtp_username)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'SMTP USERNAME REQUIRED! Check smtp username and try again.'
			];
			goto end;
		}

		if (empty($smtp_password)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'SMTP PASSWORD REQUIRED! Check smtp password and try again.'
			];
			goto end;
		}

		if (empty($smtp_port)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'SMTP PORT REQUIRED! Check smtp port and try again.'
			];
			goto end;
		}

		if (empty($sender_name)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'SENDER NAME REQUIRED! Check sender name and try again.'
			];
			goto end;
		}

		if (empty($support_email)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'SUPPORT EMAIL REQUIRED! Check support email and try again.'
			];
			goto end;
		}

			

			mysqli_query($conn,"UPDATE setup_backend_settings_tab SET smtp_host='$smtp_host', smtp_username='$smtp_username',
			smtp_password='$smtp_password', smtp_port='$smtp_port', sender_name='$sender_name', support_email='$support_email',
			`updated_time`=NOW(), updated_by='$login_staff_id' WHERE backend_setting_id='BK_ID001'") or die (mysqli_error($conn));

			$response = [
				'response'=> 200,
				'success'=> true,
				'message'=> "SYSTEM SETTINGS UPDATED! settings Updated Successful!"
			]; 

			$alert_detail="SYSTEM SETTINGS UPDATED SUCCESSFULLY: The system setting was updated by $login_staff_fullname";
			$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);	

end:
echo json_encode($response);
?>