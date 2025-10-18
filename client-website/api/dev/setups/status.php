<?php require_once '../config/connection.php';?>
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
	//////////////////declaration of variables///////////////
	$status_id=trim(strtoupper($_POST['status_id']));
	$search_keywords=trim(strtoupper($_POST['search_keywords']));

	if ($status_id !=''){
		$status_ids= "AND  status_id IN ($status_id)";
	}

	$select="SELECT
		*
		FROM 
		setup_status_tab
		WHERE 
		(status_name LIKE '%$search_keywords%' $status_ids)";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		if($all_record_count==0){
			$response = [
				'response'=> 100,
				'success'=> true,
				'message'=> 'No Record found!!!'
			];  
			goto end;
		}

			$response = [
				'response' => 101,
				'success' => true,
				'all_record_count' => $all_record_count,
				'data' => array()
			];

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}
	
end:
echo json_encode($response);
?>