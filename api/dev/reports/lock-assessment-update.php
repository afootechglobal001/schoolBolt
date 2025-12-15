<?php require_once '../config/connection.php';?>
<?php require_once '../config/staff-session-check.php';?>
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
    $branchId = $_GET['branchId'];
    $assessmentLock =  $_GET['assessmentLock']; /// TRUE OR FALSE
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($assessmentLock, 'ASSESSMENT LOCK KEY');
    //////////////////////////////////////////////////////////////////////////////////
    $assessmentLockId = $assessmentLock == 'true' || $assessmentLock === true ? 1 : 0;
    $update="UPDATE `BRANCHES_TAB` SET  `assessmentLock` = '$assessmentLockId' WHERE $clientIds AND branchId='$branchId'";
    mysqli_query($conn,$update)or die (mysqli_error($conn));

    $response['response']=200;
    $response['success']=true;
    $response['assessmentLock']=$assessmentLock;
    $response['message']=$assessmentLockId == 1 ? "Assessment records locked successfully!" : "Assessment records unlocked successfully!";
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>