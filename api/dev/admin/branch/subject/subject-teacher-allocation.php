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
    $subjectId = $_GET['subjectId'];
    $staffId=$data['staffId'];
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($subjectId, 'SUBJECT');
    validateEmptyField($staffId, 'TEACHER');
    
    $select = "SELECT * FROM CLASS_SUBJECT_ALLOCATION_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount>0){///start if 1
        /// update CLASS_SUBJECT_ALLOCATION_TAB
        mysqli_query($conn,"UPDATE `CLASS_SUBJECT_ALLOCATION_TAB` 
        SET staffId='$staffId', updatedBy='$loginStaffId' 
        WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'")or die (mysqli_error($conn));
    }else{
        ///// insert into CLASS_SUBJECT_ALLOCATION_TAB
        mysqli_query($conn,"INSERT INTO `CLASS_SUBJECT_ALLOCATION_TAB`
        (`clientId`, `branchId`, `departmentId`, `classId`, `armId`, `subjectId`, `staffId`, `createdBy`, `createdTime`) VALUES 
        ('$clientId', '$branchId', '$departmentId', '$classId', '$armId', '$subjectId', '$staffId', '$loginStaffId', NOW())")or die (mysqli_error($conn));
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="SUBJECT TEACHER UPDATED SUCCESFFULY!";

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
        /////////////////// for  $subjectId
        $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
        $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);
        $response['subjectData'] = $subjectDataFetch;
        /////////////////// for  $staffId
        $teacherDataQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$staffId'");
        $teacherDataFetch = mysqli_fetch_assoc($teacherDataQuery);
        $fetchQuery['teacherData'] = $teacherDataFetch;
    
   
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>