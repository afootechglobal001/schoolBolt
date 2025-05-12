<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
if(!$checkSession){
	$response['response']=99;
	$response['success']=false;
	$response['message']="SESSION EXPIRED! Please LogIn Again.";
	goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$roleId=$data['roleId'];
	////////////////////////////////////////////////////////////////////////////////

	if (empty($roleId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "ROLE ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
        //// get number of users
        $userCountQuery = mysqli_query($conn, "SELECT * FROM STAFF_TAB WHERE $clientIds AND roleId='$roleId'");
        $userCount = mysqli_num_rows($userCountQuery);
        if($userCount>0){
            $response = [
                'response'=> 101,
                'success'=> false,
                'message'=> "ROLE CAN NOT BE DELETED! There are user's attached to this role.",
            ]; 
            goto end;
        }
   
			$query=mysqli_query($conn,"DELETE FROM ROLE_TAB WHERE $clientIds AND roleId='$roleId'") or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="ROLE DELETED SUCCESFFULY!"; 
          
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>