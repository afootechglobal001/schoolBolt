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

		/////////////// Variable Declaration/////////////////
		$page_category_id=trim(strtolower($_POST['page_category_id']));
		$publish_id = $_POST['publish_id'];
		$faq_question =str_replace("'", "\'", $_POST['faq_question']);
		$faq_answer =str_replace("'", "\'", $_POST['faq_answer']);
		$status_id=trim($_POST['status_id']);
		$faq_cat_id=trim($_POST['faq_cat_id']);
			
		if (empty($page_category_id)){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> 'PAGE CATEGORY ID REQUIRED! Check page category ID and try again.'
			];
			goto end;
		}		

		if (empty($publish_id)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'PUBLISH ID REQUIRED! Check Publish ID and try again.'
			];
			goto end;
		}
		
		if (empty($faq_question)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'FAQ QUESTION REQUIRED! Check faq question and try again.'
			];
			goto end;
		}

		if (empty($faq_answer)){
			$response = [
				'response'=> 103,
				'success'=> false,
				'message'=> 'FAQ ANSWER REQUIRED! check faq answer and try again.'
			];
			goto end;
		}

		if (empty($status_id)){
			$response = [
				'response'=> 104,
				'success'=> false,
				'message'=> 'STATUS REQUIRED! Select the status and try again.'
			];
			goto end;
		}

			$faq_quest_check=mysqli_query($conn,"SELECT faq_question FROM publish_tab WHERE faq_question='$faq_question' AND publish_id!='$publish_id'");
			$faq_quest_count=mysqli_num_rows($faq_quest_check);

			if ($faq_quest_count>0){ 
				$response = [
					'response' => 105,
					'success' => false,
					'message' => "FAQ QUESTION NOT ACCETABLE! $faq_question already exist"
				]; 

				$alert_detail="FAQ REGISTRATION FAILED: faq with title $faq_question can not be registered as its already exist.";	
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
				goto end;
			}	
			
				/// Update FAQ Publish Tab///////
				mysqli_query($conn,"UPDATE publish_tab SET faq_question='$faq_question', faq_answer='$faq_answer', status_id='$status_id', modified_by='$login_staff_id', `updated_time`=NOW(), faq_cat_id='$faq_cat_id' WHERE publish_id='$publish_id'") or die (mysqli_error($conn));

				$page_cat_array=$callclass->_get_setup_page_category_detail($conn, $page_category_id);
				$fetch_page_cat = json_decode($page_cat_array, true);
				$page_category_name= $fetch_page_cat[0]['page_category_name'];

				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> "SUCCESS! Faq Updated Successful!",
					'publish_id'=> $publish_id
				]; 

				/////////// get alert//////////////////////////////////
				$alert_detail="Success Alert: A $page_category_name was updated successfully by  $login_staff_fullname. DETAILS: Title: $faq_question | ID: $publish_id";
				$callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
		
		
end:
echo json_encode($response);
?>