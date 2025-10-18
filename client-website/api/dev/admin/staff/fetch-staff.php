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

		$staff_id=trim(strtoupper($_POST['staff_id']));
		$status_id=trim(strtoupper($_POST['status_id']));
		$search_keywords =trim(($_POST['search_keywords']));

		if(empty($staff_id)){
			$where_clause="AND a.role_id < $login_role_id";
		}
			$select="SELECT a.*, b.role_name, c.status_name
			FROM staff_tab a, setup_role_tab b, setup_status_tab c
			WHERE a.staff_id LIKE '%$staff_id%' AND a.status_id LIKE '%$status_id%' AND
			(a.fullname LIKE '%$search_keywords%' OR a.email LIKE '%$search_keywords%' OR a.phone LIKE '%$search_keywords%' OR a.address LIKE '%$search_keywords%') AND
			a.role_id=b.role_id AND a.status_id=c.status_id $where_clause 
			ORDER BY a.fullname ASC";
		
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