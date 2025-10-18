<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$studentId =trim($data['studentId']);
	$branchId=trim($data['branchId']);
	$departmentId=trim($data['departmentId']);
    $classId=trim($data['classId']);
    $armId=trim($data['armId']);
	////////////////////////////////////////////////////////////////////////////////

	if (empty($studentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STUDENT ID REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}

    if(empty($branchId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}

    if(empty($departmentId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "DEPARTMENT REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(empty($classId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "CLASS REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(empty($armId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ARM REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}


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

    $select = "SELECT * FROM FEES_COMPUTE_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND statusId=9";
    $feesComputeSummaryQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($feesComputeSummaryQuery);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record Found: Fees Compute Not Done or Approved.";
        goto end;
    }


    /////////////////// get previous successfull payment
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

    $select = "
    SELECT 
        a.feesId, 
        a.feesName, 
        CASE 
            WHEN c.feesId IS NOT NULL THEN 'TRUE' 
            ELSE a.feesOption 
        END AS feesOption, 
        b.amount,
        CASE 
            WHEN c.feesId IS NOT NULL THEN 'TRUE' 
            ELSE 'FALSE' 
        END AS isDeletable 
    FROM FEES_SETTINGS_TAB a
    JOIN FEES_COMPUTE_TAB b 
        ON a.clientId = b.clientId 
        AND a.branchId = b.branchId 
        AND a.feesId = b.feesId
    LEFT JOIN ACCOUNT_STUDENT_TERMINAL_MANDATORY_FEES_CONFIG_TAB c 
        ON a.feesId = c.feesId 
        AND c.studentId = '$studentId'
        AND a.clientId = c.clientId 
        AND a.branchId = c.branchId 
        AND b.session = c.session 
        AND b.termId = c.termId 
        AND b.departmentId = c.departmentId 
        AND b.classId = c.classId
    WHERE 
        a.clientId = '$clientId' 
        AND a.branchId = '$branchId' 
        AND b.session = '$session' 
        AND b.termId = '$termId' 
        AND b.departmentId = '$departmentId' 
        AND b.classId = '$classId'
";
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