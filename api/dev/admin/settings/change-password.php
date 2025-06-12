<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/staff-session-check.php';?>
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
	$oldPassword=($data['oldPassword']);
    $newPassword=($data['newPassword']);
    $cnewPassword=($data['cnewPassword']);
    
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($oldPassword, 'OLD PASSWORD');
    validateEmptyField($newPassword, 'NEW PASSWORD');
    validateEmptyField($cnewPassword, 'CONFIRM NEW PASSWORD');

    $oldPassword=md5($data['oldPassword']);
    $newPassword=md5($data['newPassword']);
    $cnewPassword=md5($data['cnewPassword']);

    $query=mysqli_query($conn,"SELECT * FROM STAFF_TAB WHERE $clientIds AND staffId='$loginStaffId' AND password='$oldPassword'") or die (mysqli_error($conn));
    $count=mysqli_num_rows($query);
    if ($count==0){ /// start if 4
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "INCORRECT OLD PASSWORD! Check and try again.",
        ];
        goto end;
    }

    if ($newPassword!=$cnewPassword){ /// start if 4
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "NEW PASSWORD NOT MATCH! Check and try again.",
        ];
        goto end;
    }
    
    /// Generate login access key
    $accessKey=trim(md5($staffId.date("Ymdhis")));
    mysqli_query($conn,"UPDATE STAFF_TAB SET accessKey='$accessKey', password='$newPassword'  WHERE $clientIds AND staffId='$loginStaffId'") or die (mysqli_error($conn));

    $response['response']=200; 
    $response['success']=true;
    $response['message']="PASSWORD CHANGED SUCCESFFULY!"; 
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>