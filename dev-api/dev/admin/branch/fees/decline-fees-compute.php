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
    mysqli_query($conn,"UPDATE FEES_COMPUTE_SUMMARY_TAB SET statusId=10, approvedBy='$loginStaffId', approvedTime=NOW() WHERE fcId='$fcId'")or die (mysqli_error($conn));
   
    $response['response']=200; 
    $response['success']=true;
    $response['message']="FEES DECLINED SUCCESFFULY!"; 
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>