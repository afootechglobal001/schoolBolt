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
    $fcId = $_GET['fcId'];
    mysqli_query($conn,"DELETE FROM FEES_COMPUTE_TAB WHERE fcId='$fcId'")or die (mysqli_error($conn));
   
    $response['response']=200; 
    $response['success']=true;
    $response['message']="FEES DELETED SUCCESFFULY!"; 
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>