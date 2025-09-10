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

	$page_session=trim($_POST['page_session']);
	$publish_id=trim($_POST['publish_id']);

	if (!empty($publish_id)){
		///////////////////////geting checkPageSession//////////////////////////
		$checkPageSession=$callclass->_check_page_session($conn, 'event_category', $publish_id, $page_session);
		$array = json_decode($checkPageSession, true);
		$page_session_check= $array[0]['page_session_check'];

		if ($page_session_check==1){
			mysqli_query($conn,"UPDATE `publish_tab` SET page_view=page_view+1 WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
		}
	}		
	
	$select="SELECT 
		a.publish_id, a.reg_title, a.reg_pix, a.page_view, a.updated_time, b.seo_description, b.page_url, b.page_content, b.modified_by, c.fullname
		FROM publish_tab a, pages_tab b, staff_tab c
		WHERE a.page_category_id='event_category' 
		AND a.publish_id LIKE '%$publish_id%' 
		AND a.status_id=1 
		AND b.modified_by=c.staff_id
		AND a.publish_id=b.publish_id";

		$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
		$all_record_count=mysqli_num_rows($query);

		if($all_record_count==0){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> 'No Record Found!'
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