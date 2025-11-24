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
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');

    $select = "DELETE FROM CLASS_TEACHER_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
  

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASS TEACHER DISCHARGED SUCCESFFULY!";

        /////////////////// for  $branchId
        $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
        $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
        $response['branchData'] = $branchDataFetch;
        /////////////////// for  $departmentId
        $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
        $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
        $response['departmentData'] = $departmentDataFetch;
    
        /////////////////// for  $classId
        $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
        $classDataFetch = mysqli_fetch_assoc($classDataQuery);
        $response['classData'] = $classDataFetch;
        /////////////////// for  $armId
        $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
        $armDataFetch = mysqli_fetch_assoc($armDataQuery);
        $response['armData'] = $armDataFetch;
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>