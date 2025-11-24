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
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
   
    $select = "SELECT `session`, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId= '$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $response['session']=$fetchQuery['session'];
    $termId=$fetchQuery['termId'];
    /////////////////// for  $termId
    $termDataQuery = mysqli_query($conn, "SELECT termId, termName FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $response['termData'] = mysqli_fetch_assoc($termDataQuery);
    /////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $response['branchData'] = $branchDataFetch;
    /////////////////// for  $departmentId
    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
    $response['departmentData'] = $departmentDataFetch;

    /////////////////// for  $classId
    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);
    $response['classData'] = $classDataFetch;

    /////////////////// for  $armId
    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    $response['armData']= $armDataFetch;

    $select = "SELECT * FROM SUBJECT_STRUCTURE_TAB WHERE $clientIds AND classId='$classId'";
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
    $response['message']="CLASS SUBJECTS FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $subjectId=$fetchQuery['subjectId'];
        /////////////////// for  $subjectId
        $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
        $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);
        $fetchQuery['subjectData'] = $subjectDataFetch;

        /////////////////// for  $staffId
        $teacherDataQuery = mysqli_query($conn, "SELECT b.staffId, CONCAT(b.titleId, ' ', b.firstName, ' ', b.lastName) AS fullname, b.emailAddress, b.profilePix FROM CLASS_SUBJECT_ALLOCATION_TAB a, STAFF_TAB b 
        WHERE a.clientId=b.clientId AND  a.clientId='$clientId' AND a.branchId='$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND a.subjectId='$subjectId' AND a.staffId=b.staffId");
        $teacherDataFetch = mysqli_fetch_assoc($teacherDataQuery);
        $fetchQuery['teacherData'] = $teacherDataFetch;

        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>