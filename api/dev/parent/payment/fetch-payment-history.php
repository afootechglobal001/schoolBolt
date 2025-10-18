<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$studentId =trim($data['studentId']);
	$branchId=trim($data['branchId']);

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

    $select = "SELECT `paymentId`,  `session`, `termId`, `branchId`, `studentId`, `departmentId`, `classId`, `armId`, `totalAmount`, `paymentMethodId`, `email`, `statusId`, `createdTime`, `paydate` FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'";
    $studentPaymentQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($studentPaymentQuery);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record Found.";
        goto end;
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="PAYMENT HISTORY FETCHED SUCCESSFUL!";
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($studentPaymentQuery)) {
    $termId=$fetchQuery['termId'];
    $departmentId=$fetchQuery['departmentId'];
    $classId=$fetchQuery['classId'];
    $armId=$fetchQuery['armId'];
    $paymentMethodId=$fetchQuery['paymentMethodId'];
    $statusId=$fetchQuery['statusId'];
    /////////////////// for  $termId
    $termDataQuery = mysqli_query($conn, "SELECT termId, termName AS currentTerm FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);
    $fetchQuery['termData']=$termDataFetch;
    /////////////////// for  $departmentId
    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
    $fetchQuery['departmentData']=$departmentDataFetch;
    /////////////////// for  $classId
    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);
    $fetchQuery['classData']=$classDataFetch;
    /////////////////// for  $armId
    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    $fetchQuery['armData']=$armDataFetch;
    /////////////////// for  $statusId
    $statusDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId ='$statusId'");
    $statusDataFetch = mysqli_fetch_assoc($statusDataQuery);
    $fetchQuery['statusData']= $statusDataFetch;
    /////////////////// for  $paymentMethodId
    $paymentMethodDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_PAYMENT_METHOD_TAB WHERE paymentMethodId ='$paymentMethodId'");
    $paymentMethodDataFetch = mysqli_fetch_assoc($paymentMethodDataQuery);
    $fetchQuery['paymentMethodData']= $paymentMethodDataFetch;

    $response['data'][]= $fetchQuery;
    }

            
end:
echo json_encode($response);
?>