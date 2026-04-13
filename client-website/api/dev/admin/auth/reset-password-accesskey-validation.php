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
		$access_key = trim($_POST['access_key']);

		if (empty($access_key)) {
			$response = [
				'response' => 100,
				'success' => false,
			];
			goto end;
		}

			$query = mysqli_query($conn, "SELECT staff_id FROM staff_tab WHERE access_key='$access_key'") or die(mysqli_error($conn));
			$getCount = mysqli_num_rows($query);

				if ($getCount != 1) {
					$response = [
						'response' => 101,
						'success' => false,
					];
					goto end;
				}

					$fetch_query = mysqli_fetch_array($query);
					$staff_id = $fetch_query['staff_id'];

					// Update the acceskey
					mysqli_query($conn, "UPDATE staff_tab SET `access_key`='' WHERE staff_id='$staff_id'") or die(mysqli_error($conn));

					$response = [
						'response' => 200,
						'success' => true,
						'staff_id' => $staff_id
					];

end:
echo json_encode($response);
?>