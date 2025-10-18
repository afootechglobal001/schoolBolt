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

		$query=mysqli_query($conn,"SELECT
			(SELECT COUNT(*) FROM staff_tab WHERE status_id=1) AS total_active_staff_count,
			(SELECT COUNT(*) FROM publish_tab WHERE page_category_id='sermon_category' AND status_id=1) AS total_active_sermon_count,
			(SELECT COUNT(*) FROM publish_tab WHERE page_category_id='event_category' AND status_id=1) AS total_active_event_count,
			(SELECT COUNT(*) FROM publish_tab WHERE page_category_id='gallery_category' AND status_id=1) AS total_active_gallery_count,
			(SELECT COUNT(*) FROM publish_tab WHERE page_category_id='blog_category' AND status_id=1) AS total_active_blog_count,
			(SELECT COUNT(*) FROM publish_tab WHERE page_category_id='faq_category' AND status_id=1) AS total_active_faq_count,
			(SELECT COUNT(*) FROM testimony_tab WHERE status_id=1) AS total_active_testimony_count");

			$response = [
				'response'=> 200,
				'success'=> true,
				'data'=>  array()
			];  

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}
				
end:
echo json_encode($response);
?>