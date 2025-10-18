<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/admin-session-check.php';?>
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
		
		$publish_id = trim(strtoupper($_POST['publish_id']));

		$getPagesQuery=" SELECT 
			a.*
			FROM pages_tab a, publish_tab b
			WHERE a.publish_id = b.publish_id 
			AND a.publish_id = '$publish_id' AND b.status_id = 1";
		
			$query=mysqli_query($conn,$getPagesQuery)or die (mysqli_error($conn));
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
				'page_content_details' => array()
			];
		
			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$fetch_query['documentStoragePath'] = "$documentStoragePath/seo-flyer-pix";
				$response['page_content_details'][] = $fetch_query;
			}
			
end:
echo json_encode($response);
?>