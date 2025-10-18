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
    $feesIds=$data['feesIds'];
    ////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($studentId, 'STUDENT');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    if(count($feesIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "AT LEAST ONE FEE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
    }
    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT session AS currentSession, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['currentSession'];
    $termId=$branchDataFetch['termId'];
    foreach ($feesIds as $eachId) {
        $feesId = $eachId['feesId'];
        /////////////////// for  $feesId
        $feesDataQuery = mysqli_query($conn, "SELECT * FROM FEES_COMPUTE_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND feesId='$feesId'");
        $feesDataFetch = mysqli_fetch_assoc($feesDataQuery);
        $feesOption = $feesDataFetch['feesOption'];
        $amount = $feesDataFetch['amount'];
        if($feesOption=="FALSE"){
        mysqli_query($conn, "INSERT INTO `ACCOUNT_STUDENT_TERMINAL_MANDATORY_FEES_CONFIG_TAB`
        (`clientId`, `branchId`, `studentId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `feesId`, `amount`, `createdby`, `createdTime`) VALUES 
            ('$clientId', '$branchId', '$studentId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$feesId', '$amount', '$loginStaffId', NOW())") or die(mysqli_error($conn));
        }
    
    }
        $response['response']=200; 
        $response['success']=true;
        $response['message']="FEES UPDATE SUCCESSFULLY!";
end:
echo json_encode($response);
?>