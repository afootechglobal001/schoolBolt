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
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($studentId, 'STUDENT');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
 
    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName, session AS currentSession, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['currentSession'];
    $termId=$branchDataFetch['termId'];
    /////////////////// for  $termId
    $termDataQuery = mysqli_query($conn, "SELECT termId, termName AS currentTerm FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);

    /////////////////// for  $departmentId
    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
    
    /////////////////// for  $classId
    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);

    /////////////////// for  $armId
    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    ///check FEES_COMPUTE_SUMMARY_TAB where its approved
    $select = "SELECT * FROM FEES_COMPUTE_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND statusId=9";
    $feesComputeSummaryQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($feesComputeSummaryQuery);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record Found: Fees Compute Not Done or Approved.";
        goto end;
    }


    /////////////////// get count previous successfull payment
    $getPaymentIdQuery = mysqli_query($conn, "SELECT paymentId FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND studentId='$studentId'  AND statusId=5");
    $previousPaymentCount=mysqli_num_rows($getPaymentIdQuery);


   
    $response['response']=200; 
    $response['success']=true;
    $response['message']="ACTION SUCCESSFUL!";
    $response['currentSession']=$session;
    $response['termData'] = $termDataFetch;
    $response['branchData'] = $branchDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['schoolBoltCharges'] = $previousPaymentCount>0 ? 0 : $schoolBoltCharges;
    $response['data'] = array(); // Initialize the data array

    $select = "SELECT a.feesId, a.feesName, a.feesOption, b.amount 
    FROM FEES_SETTINGS_TAB a, FEES_COMPUTE_TAB b WHERE 
    a.clientId=b.clientId AND a.branchId=b.branchId AND a.feesId=b.feesId AND 
    a.clientId='$clientId' AND a.branchId='$branchId' AND b.session='$session' AND b.termId='$termId' AND b.departmentId='$departmentId' AND b.classId='$classId'";
    
    $getFeesToPayQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($getFeesToPayQuery)) {
        $feesId=$fetchQuery['feesId'];
        $paymentQuery=mysqli_query($conn,"SELECT a.paymentId FROM PAYMENTS_TAB a, PAYMENT_HISTORY_TAB b WHERE a.clientId='$clientId' AND a.branchId='$branchId' AND a.session='$session' AND a.termId='$termId' AND a.paymentId=b.paymentId AND b.studentId='$studentId' AND b.feesId='$feesId'")or die (mysqli_error($conn));
        $paymentCount = mysqli_num_rows($paymentQuery);
        $fetchQuery['paid']=$paymentCount>0 ? 'TRUE' : 'FALSE';
        $response['data'][]= $fetchQuery;
    }
            
end:
echo json_encode($response);
?>