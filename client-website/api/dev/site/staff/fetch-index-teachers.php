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

		$select="SELECT fullname, email, profile_pix, position 
		FROM staff_tab
		WHERE status_id=1 
		AND role_id <3
		ORDER BY RAND() LIMIT 4";
	
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
				$fetch_query['documentStoragePath'] = "$documentStoragePath/staff-pix";
				$response['data'][] = $fetch_query;
			}
				
end:
echo json_encode($response);
?>