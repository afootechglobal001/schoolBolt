<?php 
require_once '../../config/connection.php';

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
		$staff_id = trim($_POST['staff_id']);
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if (empty($staff_id)) {
			$response = [
				'response' => 100,
				'success' => false,
				'message' => 'USERNAME REQUIRED! Check username field and try again.'
			];
			goto end;
		}

		if (empty($password)) {
			$response = [
				'response' => 101,
				'success' => false,
				'message' => 'PASSWORD REQUIRED! Check password field and try again.'
			];
			goto end;
		}

		if (empty($confirm_password)) {
			$response = [
				'response' => 102,
				'success' => false,
				'message' => 'CONFIRM PASSWORD REQUIRED! Check password field and try again.'
			];
			goto end;
		}

		// Check if passwords match
		if ($password !== $confirm_password) {
			$response = [
				'response' => 103,
				'success' => false,
				'message' => 'PASSWORD NOT MATCH! Check the Passwords and try again.'
			];
			goto end;
		}

			// Convert password to MD5
			$password = md5($password);

			// Check if staff exists
			$query = mysqli_query($conn, "SELECT * FROM staff_tab WHERE staff_id='$staff_id'") or die(mysqli_error($conn));
			$count_user = mysqli_num_rows($query);

			if ($count_user != 1) {
				$response = [
					'response' => 104,
					'success' => false,
					'message' => 'NO RECORD MATCH! Kindly check the email and try again.'
				]; 
				goto end;
			}

				// Update staff password
				mysqli_query($conn, "UPDATE staff_tab SET password='$password', updated_time=NOW() WHERE staff_id='$staff_id'") or die(mysqli_error($conn));

				$response = [
					'response' => 200,
					'success' => true,
					'message' => 'PASSWORD RESET SUCCESSFULLY! You may proceed to login.'
				]; 

end:
echo json_encode($response);
?>
