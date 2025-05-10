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

    $select = "SELECT * FROM BRANCH_DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }


    $response['response']=200; 
    $response['success']=true;
    $response['message']="FEES FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
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
            
            ////////////////// for  payableAmount
               $payableAmountDataQuery = mysqli_query($conn, "
                    SELECT 
                        (SELECT IFNULL(SUM(amount), 0.00) 
                         FROM FEES_COMPUTE_TAB 
                         WHERE $clientIds 
                           AND branchId='$branchId' 
                           AND departmentId='$departmentId' 
                           AND classId='$classId') AS payableAmount,
                        
                        (SELECT updatedBy 
                         FROM FEES_COMPUTE_TAB 
                         WHERE $clientIds 
                           AND branchId='$branchId' 
                           AND departmentId='$departmentId' 
                           AND classId='$classId' 
                         ORDER BY updatedTime DESC 
                         LIMIT 1) AS updatedBy
                ");

                
                
                $payableAmountDataFetch = mysqli_fetch_assoc($payableAmountDataQuery);
                $updatedBy=$payableAmountDataFetch['updatedBy'];
                $payableAmount = $payableAmountDataFetch['payableAmount'];
                $classDataFetch['payableAmount'] = (is_null($payableAmount) || $payableAmount === '') ? '0.00' : $payableAmount;



                 /////////////////// for  $updatedBy
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
                $getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery);
                $classDataFetch['updatedBy']= $getUpdatedByfetch;

            $classData[] = $classDataFetch;
        }
        $fetchQuery['classData']= $classData;



        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

