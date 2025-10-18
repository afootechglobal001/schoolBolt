<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/staff-session-check.php';?>
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
    $staffId = $_GET['staffId'];
    
    if (!empty($branchId)) {
        $branchIds = "AND branchId ='$branchId'";
    }
    if (!empty($staffId)) {
        $staffIds = "AND staffId ='$staffId'";
    }
   
    $select = "SELECT departmentId, classId, subjectId FROM CLASS_SUBJECT_ALLOCATION_TAB WHERE $clientIds $branchIds $staffIds";

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
    $response['message']="MY STUDENTS FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $departmentId=$fetchQuery['departmentId'];
        $classId=$fetchQuery['classId'];
        $subjectId=$fetchQuery['subjectId'];


        /////////////////// for $departmentId
         $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
         $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
         $fetchQuery['departmentData']= $departmentDataFetch;
        /////////////////// for $classId
         $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
         $classDataFetch = mysqli_fetch_assoc($classDataQuery);
         $fetchQuery['classData']= $classDataFetch;
            $armData=array();
            $armDataQuery = mysqli_query($conn, "SELECT a.childId AS armId, b.armName FROM CLASS_STRUCTURE_TAB a, ARMS_TAB b WHERE a.clientId='$clientId' AND a.childId=b.armId AND a.parentId='$classId'");
            while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
                $armData[] = $armDataFetch;
            }
            $fetchQuery['classData']['armData'] = $armData;

        /////////////////// for  $subjectId
        $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
        $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);
        $fetchQuery['subjectData'] = $subjectDataFetch;

        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>