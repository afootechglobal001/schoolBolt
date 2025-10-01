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

     $branchDataQuery = mysqli_query($conn, "SELECT session, termId, timeSchoolOpened FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['session'];
    $termId=$branchDataFetch['termId'];
    $timeSchoolOpened= $branchDataFetch['timeSchoolOpened'];

    $response['response']=200; 
    $response['success']=true;
    $response['branchData'] = $branchDataFetch;
    $response['data'] = array();

    $select="SELECT a.*, b.surName, b.firstName, b.passport FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND a.statusId=1 ORDER BY b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $studentId=$fetchQuery['studentId'];
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

         //////////// get student numberOfDaysPresent and numberOfDaysAbsent
         $attendanceDataQuery = mysqli_query($conn, "SELECT numberOfDaysPresent FROM BRANCH_STUDENT_ATTENDANCE_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND studentId='$studentId'");
         $attendanceDataFetch = mysqli_fetch_assoc($attendanceDataQuery);
         $fetchQuery['attendanceData']= $attendanceDataFetch;

        $response['data'][] = $fetchQuery;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>