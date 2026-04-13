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
	$cat_id=trim(strtoupper($_POST['cat_id']));
	$search_keywords =trim(($_POST['search_keywords']));

	$select="SELECT 
		a.faq_question, a.faq_answer, a.faq_cat_id, b.cat_name
		FROM publish_tab a, setup_categories_tab b
		WHERE a.page_category_id='faq_category' 
		AND a.faq_cat_id LIKE '%$cat_id%' 
		AND (a.faq_question LIKE '%$search_keywords%' OR a.faq_answer LIKE '%$search_keywords%') 
		AND a.status_id=1 
		AND a.faq_cat_id=b.cat_id
		ORDER BY a.created_time DESC";

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
				$response['data'][] = $fetch_query;				
			}
				
				
end:
echo json_encode($response);
?>