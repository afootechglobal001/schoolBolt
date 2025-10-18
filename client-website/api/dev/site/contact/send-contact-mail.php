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
		$fullName = trim($_POST['fullName']);
		$email = trim($_POST['email']);
		$subject = trim($_POST['subject']);
		$message =str_replace("'", "\'", $_POST['message']);

		if (empty($fullName)) {
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

		if (empty($subject)) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'SUBJECT REQUIRED! Check field and try again.'
			];
			goto end;
		}

		if (empty($message)) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'MESSAGE REQUIRED! Check field and try again.'
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
			
			$userCheck=mysqli_query($conn,"SELECT * FROM news_letter_tab WHERE email='$email'");
			$userCount=mysqli_num_rows($userCheck);

			if ($userCount>0){
				mysqli_query($conn,"UPDATE news_letter_tab SET fullName='$fullName', updatedTime=NOW() WHERE email='$email'")or die (mysqli_error($conn));  	
			} else {
				/// Insert Into news_letter_tab Tab
				mysqli_query($conn,"INSERT INTO `news_letter_tab`
				(`fullName`, `email`, `subject`, `message`, `createdTime`, `updatedTime`) VALUES
				('$fullName', '$email', '$subject', '$message', NOW(), NOW())")or die (mysqli_error($conn));
			}
				
			    ////// send Link to email
				require_once('../site-mail/send-contact-mail.php');	

				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> "SUCCESS! Mail sent succesfully!"
				]; 
				
		
end:
echo json_encode($response);
?>
