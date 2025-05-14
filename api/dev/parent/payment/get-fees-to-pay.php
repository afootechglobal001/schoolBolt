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

   
    $response['response']=200; 
    $response['success']=true;
    $response['message']="ACTION SUCCESSFUL!";
    $response['curentSession']=$session;
    $response['termData'] = $termDataFetch;
    $response['branchData'] = $branchDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;  
    $response['data'] = array(); // Initialize the data array

    $select = "SELECT a.feesId, a.feesName, a.feesOption, b.amount 
    FROM FEES_SETTINGS_TAB a, FEES_COMPUTE_TAB b WHERE 
    a.clientId=b.clientId AND a.branchId=b.branchId AND a.feesId=b.feesId AND 
    a.clientId='$clientId' AND a.branchId='$branchId' AND b.session='$session' AND b.termId='$termId' AND b.departmentId='$departmentId' AND b.classId='$classId'";
    
    $getFeesToPayQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($getFeesToPayQuery)) {
        $response['data'][]= $fetchQuery;
    }
            
end:
echo json_encode($response);
?>