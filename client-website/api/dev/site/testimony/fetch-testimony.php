<?php require_once '../../config/connection.php';?>
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

		$select= "SELECT a.fullname, a.testimony, b.relationship_type_name 
			FROM testimony_tab a, setup_relationship_type_tab b
			WHERE a.status_id=1 AND a.relationship_type_id=b.relationship_type_id ORDER BY created_time ASC";
		
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
					'response'=> 200,
					'success'=> true,
					'all_record_count'=> $all_record_count,
					'data'=>  array()
				];  

				while ($fetch_query = mysqli_fetch_assoc($query)) {
					$response['data'][] = $fetch_query;
				}
				
end:
echo json_encode($response);
?>