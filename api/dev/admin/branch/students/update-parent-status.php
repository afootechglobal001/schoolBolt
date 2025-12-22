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
    $branchId =trim($_GET['branchId']);
    $studentId=trim($_GET['studentId']);
    $email=trim($_GET['parentEmail']);
    $parentTypeId =trim($_GET['parentTypeId']);
    $statusId=trim($_GET['statusId']);
    ////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($studentId, 'STUDENT ID');
    validateEmptyField($email, 'EMAIL ADDRESS');
    validateEmptyField($parentTypeId, 'PARENT TYPE');
    validateEmptyField($statusId, 'STATUS');

    mysqli_query($conn,"UPDATE `PARENTS_TAB` SET `statusId`='$statusId'
    WHERE $clientIds AND branchId='$branchId' AND recordFor='$parentTypeId' AND email='$email' AND studentId='$studentId'")or die (mysqli_error($conn));
 
    $response['response']=200; 
    $response['success']=true;
    $response['message']= $statusId== 1 ? "PARENT ACTIVATED SUCCESSFULLY!" : "PARENT SUSPENDED SUCCESSFULLY!"; 
  
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>