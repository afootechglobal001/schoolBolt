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
    $response['message']="BRANCH  DEPARTMENTS FETCH SUCCESFFULY!";
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
            /////////////////// for  $armId
            $armData=array();
            $armDataQuery = mysqli_query($conn, "SELECT a.childId AS armId, b.armName FROM CLASS_STRUCTURE_TAB a, ARMS_TAB b WHERE a.clientId='$clientId' AND a.childId=b.armId AND a.parentId='$classId'");
            while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
                $armId=$armDataFetch['armId'];
                  /////////////////// for  $staffId
                $teacherDataQuery = mysqli_query($conn, "SELECT CONCAT(b.firstName, ' ', b.lastName) AS fullname, b.emailAddress, b.profilePix FROM CLASS_TEACHER_TAB a, STAFF_TAB b 
                WHERE a.clientId=b.clientId AND  a.clientId='$clientId' AND a.branchId='$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND a.staffId=b.staffId");
                $teacherDataFetch = mysqli_fetch_assoc($teacherDataQuery);
                $armDataFetch['teacherData'] = $teacherDataFetch;
                $armData[] = $armDataFetch;

            }
            
            $classDataFetch['armData'] = $armData;
            $classData[] = $classDataFetch;
        }
        $fetchQuery['classData']= $classData;



        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

