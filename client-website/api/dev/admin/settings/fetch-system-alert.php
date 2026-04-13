<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/admin-session-check.php';?>
<?php
	
////////////////////////////////////////////////////////
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

		$alert_id =trim(($_POST['alert_id']));
		$search_keywords =trim(($_POST['search_keywords']));
		$view_from =trim(($_POST['view_from']));
		$view_report=trim(($_POST['view_report']));

		if($alert_id!=''){
			$alert_array=$callclass->_get_alert_details($conn, $alert_id);
			$alert_array = json_decode($alert_array, true);
			$db_seen_status= $alert_array[0]['seen_status'];

			$add_alert_query="AND alert_id='$alert_id'";

			if($db_seen_status<$login_role_id){
				mysqli_query($conn,"UPDATE 0_alert_tab SET seen_status ='$login_role_id' WHERE alert_id='$alert_id'")or die (mysqli_error($conn));
			}
		
			$select="SELECT * FROM 0_alert_tab WHERE alert_id='$alert_id'";
		}else{
			include('../../config/report-date-filtering.php');

			$select="SELECT * FROM 0_alert_tab WHERE 
			date(created_time) BETWEEN '$db_date_from' AND '$db_date_to' AND 
			(alert_id LIKE '%$search_keywords%' OR user_name LIKE '%$search_keywords%' OR alert_detail LIKE '%$search_keywords%') AND
			role_id<='$login_role_id' ORDER BY created_time DESC";
		}
		
		$all_record_query=mysqli_query($conn,$select)or die (mysqli_error($conn));

		$all_record_count=mysqli_num_rows($all_record_query);

		//$view_from=$view_from-1;
		if ($view_from>$all_record_count){
			$view_from=$all_record_count - 50;
		}
		if(($view_from=='') || ($view_from<1)){
			$view_from=0;
		}
		
		$view_to=$view_from + 50;
		if ($view_to>$all_record_count){
			$view_to=$all_record_count;
		}
		
		
		$query=mysqli_query($conn,$select." LIMIT $view_from, 50")or die (mysqli_error($conn));
		
		if($all_record_count==0){///start if 1
			$response['response']=200;
			$response['success']=true;
			$response['message']="No Record found"; 
		}else{///else if 1

			$response['response']=200;
			$response['success']=true;
			$response['all_record_count']=$all_record_count;
			$response['view_from']=$view_from + 1;
			$response['view_to']=$view_to;
			$response['date_from']=$date_from;
			$response['date_to']=$date_to;
			$response['data'] = array(); // Initialize the data array

			while ($fetch_query = mysqli_fetch_assoc($query)) {
				$response['data'][] = $fetch_query;
			}

		}
	
end:
echo json_encode($response);
?>