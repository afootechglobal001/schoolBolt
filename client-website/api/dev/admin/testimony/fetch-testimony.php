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

		$testimony_id=trim(strtoupper($_POST['testimony_id']));
		$status_id=trim(strtoupper($_POST['status_id']));
		$search_keywords =trim(($_POST['search_keywords']));

		$select=
			"SELECT
			a.testimony_id, a.fullname, a.email, a.phone, a.testimony, a.status_id, a.relationship_type_id, b.status_name, c.relationship_type_name
			FROM testimony_tab a, setup_status_tab b, setup_relationship_type_tab c
			WHERE 
			a.testimony_id LIKE '%$testimony_id%' AND a.status_id LIKE '%$status_id%' AND
			(a.fullname LIKE '%$search_keywords%' OR a.email LIKE '%$search_keywords%' OR a.phone LIKE '%$search_keywords%') AND
			a.status_id=b.status_id AND a.relationship_type_id=c.relationship_type_id ORDER BY a.created_time ASC";
		
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