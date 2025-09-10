<?php require_once '../../config/connection.php';?>

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

		// Declaration of variables
		$fullname = trim($_POST['fullname']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$relationship_type_id = trim($_POST['relationship_type_id']);
		$testimony =str_replace("'", "\'", $_POST['testimony']);

		if (empty($fullname)) {
			$response = [
				'response' => 100,
				'success' => false,
				'message' => 'FULLNAME REQUIRED! Check fullname field and try again.'
			];
			goto end;
		}

		if (empty($email)) {
			$response = [
				'response' => 101,
				'success' => false,
				'message' => 'EMAIL REQUIRED! Check email field and try again.'
			];
			goto end;
		}

		if (!preg_match('/^\d{1,11}$/', $phone)) {
			$response = [
				'response' => 102,
				'success' => false,
				'message' => 'PHONE NUMBER INVALID! It must be numeric and no more than 11 digits.'
			];
			goto end;
		}

		if (empty($testimony)) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'TESTIMONY MESSAGE REQUIRED! Check field and try again.'
			];
			goto end;
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$response = [
				'response'=> 104,
				'success'=> false,
				'message'=> "ERROR: $email is NOT a valid email address"
			]; 
			goto end;
		}
			
			$usercheck=mysqli_query($conn,"SELECT * FROM testimony_tab WHERE email='$email'");
			$useremail=mysqli_num_rows($usercheck);

			if ($useremail>0){
				$response = [
					'response'=> 105,
					'success'=> false,
					'message'=> "EMAIL NOT ACCETABLE! $email already exist"
				]; 
				goto end;	
			}
				
				//////////////geting sequence//////////////////////////
				$sequence=$callclass->_get_sequence_count($conn, 'TEST');
				$array = json_decode($sequence, true);
				$no= $array[0]['no'];

				$testimony_id='TEST'.$no.date("Ymdhis");
				
				/// Insert Into Satff Tab
				mysqli_query($conn,"INSERT INTO `testimony_tab`
				(`testimony_id`, `fullname`, `email`, `phone`, `relationship_type_id`, `testimony`, `status_id`, `created_time`, `updated_time`) VALUES
				('$testimony_id', '$fullname', '$email', '$phone', '$relationship_type_id', '$testimony', 3, NOW(), NOW())")or die (mysqli_error($conn));

				////// send Link to email
				require_once('../site-mail/testimony-mail.php');	

				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> "SUCCESS! Your Testimony is under review!"
				]; 

		
end:
echo json_encode($response);
?>
