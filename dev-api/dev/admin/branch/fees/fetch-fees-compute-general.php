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

    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
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
    $branchDataFetch['termData'] = $termDataFetch;
        

    $select = "SELECT * FROM BRANCH_DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        $response['branchData'] = $branchDataFetch;
        goto end;
    }


    $response['response']=200; 
    $response['success']=true;
    $response['message']="FEES FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['branchData'] = $branchDataFetch;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $departmentId=$fetchQuery['departmentId'];
        /////////////////// for  $departmentId
        $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
        $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
        $fetchQuery['departmentData'] = $departmentDataFetch;
        /////////////////// for  $classId
        $classData=array();
        $classDataQuery = mysqli_query($conn, "SELECT a.childId AS classId, b.className FROM CLASS_STRUCTURE_TAB a, CLASSES_TAB b WHERE a.clientId='$clientId' AND a.childId=b.classId AND a.parentId='$departmentId'");
        while ($classDataFetch = mysqli_fetch_assoc($classDataQuery)) {
            $classId=$classDataFetch['classId'];
            
            /////////////////// for  $FEES_COMPUTE_SUMMARY_TAB
            $feesSummaryDataQuery = mysqli_query($conn, "SELECT * FROM FEES_COMPUTE_SUMMARY_TAB WHERE $clientIds  AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId'");
            $feesSummaryDataFetch = mysqli_fetch_assoc($feesSummaryDataQuery);
            $payableAmount=$feesSummaryDataFetch['payableAmount'];
            $payableAmount = (is_null($payableAmount) || $payableAmount === '') ? '0.00' : $payableAmount;
            $statusId=$feesSummaryDataFetch['statusId'];
            $statusId = (is_null($statusId) || $statusId === '') ? 8 : $statusId;
            $updatedBy=$feesSummaryDataFetch['updatedBy'];
            $approvedBy=$feesSummaryDataFetch['approvedBy'];
            /////////////////// for  $feesSummaryData
            $classDataFetch['feesSummaryData']=$feesSummaryDataFetch;
            /////////////////// for  $statusId
            $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId ='$statusId'");
            $geStatusFetch = mysqli_fetch_assoc($getStatusQuery);
            $classDataFetch['statusData']= $geStatusFetch;
                
            /////////////////// for  $updatedBy
            $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
            $getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery);
            $classDataFetch['updatedBy']= $getUpdatedByfetch;

             /////////////////// for  $approvedBy
            $getApprovedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$approvedBy'");
            $getApprovedByfetch = mysqli_fetch_assoc($getApprovedByQuery);
            $classDataFetch['approvedBy']= $getApprovedByfetch;


            $classData[] = $classDataFetch;
        }
        $fetchQuery['classData']= $classData;
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

