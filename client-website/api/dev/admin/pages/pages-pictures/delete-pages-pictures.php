<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/admin-session-check.php';?>
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
        
        $publish_id=$_POST['publish_id'];
        $sn=$_POST['sn'];

        $query=mysqli_query($conn,"SELECT pictures FROM pages_pictures_tab WHERE sn='$sn' AND publish_id='$publish_id'");
        $fetch=mysqli_fetch_array($query);
        $pictures=$fetch['pictures'];

        unlink($publishPicturesPath .$pictures);

        mysqli_query($conn,"DELETE FROM `pages_pictures_tab` WHERE sn='$sn' AND publish_id='$publish_id'")or die (mysqli_error($conn));
        
            $response = [
                'response'=> 200,
                'success'=> true,
                'message'=> "SUCCESS! Pictures Deleted Successful!",          
            ]; 

            /////////// get alert//////////////////////////////////
            $alert_detail="Success Alert: Page Pictures was deleted successfully by $login_staff_fullname. DETAILS: ID: $publish_id";
            $callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
       
end:
echo json_encode($response);
?>