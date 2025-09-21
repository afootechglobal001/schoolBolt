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

    //// staff details from CLASS_TEACHER_TAB
    $select = "SELECT * FROM CLASS_TEACHER_TAB WHERE $clientIds AND branchId='$branchId' AND staffId='$loginStaffId'";
    $query = mysqli_query($conn, $select) or die (mysqli_error($conn));
    $allRecordCount = mysqli_num_rows($query);
    if ($allRecordCount == 0) {
        $response['response'] = 102;
        $response['success'] = false;
        $response['message'] = 'NO CLASS ASSIGNED! You have not been assigned to any class. Contact Admin for assistance.';
        goto end;
    } 
        
    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASS FETCH SUCCESSFULLY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

        while ($fetchQuery = mysqli_fetch_assoc($query)) {
            $departmentId=$fetchQuery['departmentId'];
            $classId=$fetchQuery['classId'];
            $armId=$fetchQuery['armId'];

            /////////////////// for  $departmentId
            $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
            $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
            $fetchQuery['departmentData']= $departmentDataFetch;
            /////////////////// for  $classId
            $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
            $classDataFetch = mysqli_fetch_assoc($classDataQuery);
            $fetchQuery['classData']= $classDataFetch;

            /////////////////// for  $armId
            $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
            $armDataFetch = mysqli_fetch_assoc($armDataQuery);
            $fetchQuery['armData']= $armDataFetch;
            
        $response['data'][] = $fetchQuery;
        }
    
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>