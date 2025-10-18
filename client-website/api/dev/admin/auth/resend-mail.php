<?php require_once '../../config/connection.php';?>
<?php
///// check for API security
if ($apiKey!=$expected_api_key){
	$response = [
        'response' => 98,
        'success'=> false,
        'message'=> 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
    ]; 
	goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$staff_id=trim($_POST['staff_id']);

	if (empty($staff_id)){
		$response = [
			'response'=> 100,
			'success'=> false,
			'message'=> 'STAFF ID FIELD REQUIRED! Staff ID field cannot be empty'
		]; 
		goto end;
	}
		
		$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE staff_id='$staff_id'") or die (mysqli_error($conn));
		$count_user=mysqli_num_rows($query);

			if ($count_user!=1){				
				$response = [
					'response' => 101,
					'success' => false,
					'message' => 'INVALID STAFF ID! Staff ID Required'
				]; 
				goto end;
			}
				$fetch_query=mysqli_fetch_array($query);
				$staff_id=$fetch_query['staff_id']; 
				$fullname=$fetch_query['fullname'];
				$email=$fetch_query['email']; 

				/// Generate Acess Key for user on staff_tab
				$access_key=trim(md5($staff_id.date("Ymdhis")));

				/// update user on staff_tab
				mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', updated_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update access key - staff_tab");

				////// send Link to email
				require_once('../../config/mail/admin/reset-password.php');	
			
				$response = [
					'response'=> 200,
					'success'=> true,
					'message'=> 'EMAIL RE-SENT! Kindly check your email address and proceed.'
				]; 

end:
echo json_encode($response);
?>