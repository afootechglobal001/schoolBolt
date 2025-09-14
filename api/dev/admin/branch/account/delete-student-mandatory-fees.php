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
    $studentId =trim($_GET['studentId']);
    $branchId=trim($_GET['branchId']);
    $departmentId=trim($_GET['departmentId']);
    $classId=trim($_GET['classId']);
    $armId=trim($_GET['armId']);
    $feesId=$data['feesId'];
    ////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($studentId, 'STUDENT');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($feesId, 'FEES ID');
   
    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName, session AS currentSession, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['currentSession'];
    $termId=$branchDataFetch['termId'];
   
     // delele from ACCOUNT_STUDENT_TERMINAL_MANDATORY_FEES_CONFIG_TAB
    $delete=mysqli_query($conn,"DELETE FROM ACCOUNT_STUDENT_TERMINAL_MANDATORY_FEES_CONFIG_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND feesId='$feesId'") or die (mysqli_error($conn));
    // confirm delete
    if($delete){
        $response['response']=200; 
        $response['success']=true;
        $response['message']="FEES DELETE SUCCESSFULLY!";
        goto end;
    }else{
        $response = [
            'response'=> 500,
            'success'=> false,
            'message'=> "FAILED TO DELETE FEES! Try Again",
        ]; 
        goto end;
    }
end:
echo json_encode($response);
?>