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
    $branchId = $_GET['branchId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    $subjectId = $_GET['subjectId'];
    $staffId=$data['staffId'];
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($subjectId, 'SUBJECT');
    
    mysqli_query($conn,"DELETE FROM CLASS_SUBJECT_ALLOCATION_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'")or die (mysqli_error($conn));
    $response['response']=200; 
    $response['success']=true;
    $response['message']="SUBJECT TEACHER DISALLOCATED SUCCESSFUL!";

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>