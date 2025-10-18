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

		$local_date_time = $_POST['local_date_time'];
		$select = "SELECT 
			a.publish_id, a.reg_title, a.event_start_time, a.event_end_time, a.event_location, a.event_date, a.created_time, b.page_url
		FROM 
			publish_tab a, pages_tab b
		WHERE 
			a.page_category_id = 'event_category'
			AND a.status_id = 1
			AND a.publish_id = b.publish_id
			AND a.event_date > STR_TO_DATE('$local_date_time', '%Y-%m-%d %H:%i:%s')
		ORDER BY RAND() LIMIT 1";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);
		
		if($all_record_count==0){
			$response = [
				'response'=> 100,
				'success'=> True,
				'message'=> 'No Upcoming Events! Check Back Soon.'
			];  
			goto end;
		}

			$response = [
				'response'=> 200,
				'success'=> true,
				'all_record_count'=> $all_record_count,
				'current_date_time'=> $local_date_time,
				'data'=>  array()
			];  

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;				
			}
				
end:
echo json_encode($response);
?>