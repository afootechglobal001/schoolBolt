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

	$select = "SELECT 
		a.publish_id, a.reg_title, a.reg_pix, a.event_start_time, a.event_end_time, a.event_location, a.event_date, b.page_url
		FROM publish_tab a, pages_tab b
		WHERE page_category_id = 'event_category'
		AND a.status_id = 1
		AND a.publish_id = b.publish_id
		AND a.event_date < NOW()
		ORDER BY a.event_date ASC"; 

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		
		if($all_record_count==0){
			$response = [
				'response'=> 100,
				'success'=> false,
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
				$fetch_query['documentStoragePath'] = "$documentStoragePath/event-pix";
				$response['data'][] = $fetch_query;				
			}
				
end:
echo json_encode($response);
?>