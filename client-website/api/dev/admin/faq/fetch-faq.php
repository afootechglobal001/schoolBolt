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

		$page_category_id=trim(strtoupper($_POST['page_category_id']));
		$publish_id=trim(strtoupper($_POST['publish_id']));
		$status_id=trim(strtoupper($_POST['status_id']));
		$search_keywords =trim(($_POST['search_keywords']));

		$select=
			"SELECT
			a.page_category_id, a.publish_id, a.faq_question, a.faq_answer, a.status_id, a.modified_by, a.created_time, a.updated_time, a.faq_cat_id, b.status_name, c.cat_name
			FROM publish_tab a, setup_status_tab b, setup_categories_tab c
			WHERE 
			a.publish_id LIKE '%$publish_id%' AND a.status_id LIKE '%$status_id%' AND
			(a.reg_title LIKE '%$search_keywords%' or a.faq_question LIKE '%$search_keywords%' or a.faq_answer LIKE '%$search_keywords%') AND
			a.status_id=b.status_id AND a.faq_cat_id=c.cat_id AND a.page_category_id='$page_category_id' ORDER BY a.faq_question ASC";
		
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