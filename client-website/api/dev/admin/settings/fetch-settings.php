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

		$select=" SELECT * 
			FROM setup_backend_settings_tab";

			$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$all_record_count=mysqli_num_rows($query);
			
			if($all_record_count==0){
				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> 'No Record found!!!'
				];  
				goto end;
			}

			$response = [
				'response' => 200,
				'success' => true,
				'data' => array()
			];
		
			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}
			
end:
echo json_encode($response);
?>