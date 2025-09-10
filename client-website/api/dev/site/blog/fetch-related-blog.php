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

	$select="SELECT 
		a.publish_id, a.reg_title, a.reg_pix, a.updated_time, a.blog_view, a.blog_cat_id, b.seo_description, b.page_url, b.page_content, c.cat_name
		FROM publish_tab a, pages_tab b, setup_categories_tab c
		WHERE a.page_category_id='blog_category' 
		AND a.status_id=1 
		AND a.blog_cat_id=c.cat_id
		AND a.publish_id=b.publish_id
		ORDER BY a.created_time ASC";

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
				$fetch_query['documentStoragePath'] = "$documentStoragePath/blog-pix";
				$response['data'][] = $fetch_query;				
			}
				
				
end:
echo json_encode($response);
?>