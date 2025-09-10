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

	$publish_id =trim(($_POST['publish_id']));

	$select="SELECT 
		publish_id, reg_title, reg_pix, gallery_sub_title
		FROM publish_tab
		WHERE page_category_id='gallery_category' 
		AND publish_id LIKE '%$publish_id%' 
	    AND gallery_sub_title IS NOT NULL
		AND gallery_sub_title <> ''
		AND status_id=1 
		ORDER BY created_time ASC";

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
				$fetch_query['documentStoragePath'] = "$documentStoragePath/gallery-pix";
				$response['data'][] = $fetch_query;				
			}
				
				
end:
echo json_encode($response);
?>