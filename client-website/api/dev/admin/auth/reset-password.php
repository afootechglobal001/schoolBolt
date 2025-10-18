<?php require_once '../../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){
	$response = [
        'response' => 98,
        'success'=> false,
        'message'=> 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
    ]; 
	goto end;
}
	//////////////////declaration of variables///////////
	$email=trim($_POST['email']);

	if (empty($email)){
		$response = [
			'response'=> 100,
			'success'=> false,
			'message'=> 'EMAIL FIELD REQUIRED! Email address field cannot be empty'
		]; 
		goto end;
	}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'INVALID EMAIL ADDRESS! Enter a valid email address and try again'
			]; 
			goto end;
		}	
			$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$email'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);
		
				if ($count_user!=1){				
					$response = [
						'response' => 102,
						'success' => false,
						'message' => 'NO RECORD MATCH! Kindly check the email and try again.'
					]; 
					goto end;
				}

					$fetch_query=mysqli_fetch_array($query);
					$staff_id=$fetch_query['staff_id']; 
					$fullname=$fetch_query['fullname'];
					$email=$fetch_query['email']; 
					$status_id=$fetch_query['status_id'];
								
						if($status_id==1){ /// (check if the user is active)
							/// Generate Acess Key for user on staff_tab
							$access_key=trim(md5($staff_id.date("Ymdhis")));

							/// update user on staff_tab
							mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update access key - staff_tab");

							////// send Link to email
							require_once('../../config/mail/admin/reset-password.php');	
						
							$response = [
								'response'=> 200,
								'success'=> true,
								'message'=> 'EMAIL SENT! Kindly check your email address and proceed.',
								'staff_id'=> $staff_id,
								'fullname'=> $fullname,
								'email'=> $email
							]; 
		
						} 
						if($status_id==2){									
							$response = [
								'response'=> 104,
								'success'=> false,
								'message'=> 'ACCOUNT SUSPENDED! Contact the administrator for help.'
							]; 
							goto end;
						}						
end:
echo json_encode($response);
?>