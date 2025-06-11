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
    $assessmentId = $_GET['assessmentId'];

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($subjectId, 'SUBJECT');
    validateEmptyField($assessmentId, 'ASSESSMENT ID');


    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, address, smtpUsername, mobileNumber, session, termId  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['session'];
    $termId=$branchDataFetch['termId'];

    $select = "SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND assessmentId='$assessmentId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount>0){
        $fetchQuery = mysqli_fetch_assoc($query);
        $recordId=$fetchQuery['recordId'];

          mysqli_query($conn,"UPDATE `BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB` SET `updatedBy`='$loginStaffId', `updatedTime`=NOW() WHERE recordId='$recordId'")or die (mysqli_error($conn));

    }else{
        ///////////////////////geting sequence//////////////////////////
        $countId='RECORD';
        $sequence=$callclass->_get_sequence_count($conn, $countId);
        $array = json_decode($sequence, true);
        $no= $array[0]['no'];
        $recordId=$countId.$no.date("Ymdhis");

        mysqli_query($conn,"INSERT INTO `BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB`
        (`recordId`, `clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `subjectId`, `assessmentId`, `updatedBy`, `updatedTime`) VALUES
        ('$recordId', '$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$subjectId', '$assessmentId', '$loginStaffId',  NOW())")or die (mysqli_error($conn));
    }



    $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND assessmentId='$assessmentId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $assessmentTotalScore = $fetchQuery['assessmentTotalScore'];
    
  
    $response['response']=200; 
    $response['success']=true;
    $response['recordId']=$recordId;
    $response['assessmentTotalScore']=$assessmentTotalScore;
    $response['studentData'] = array();

    $select="SELECT a.*, b.surName, b.firstName FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND a.statusId=1 ORDER BY b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $studentId=$fetchQuery['studentId'];
        $departmentId=$fetchQuery['departmentId'];
        $classId=$fetchQuery['classId'];
        $armId=$fetchQuery['armId'];
         /////////////////// for  $studentId
        $studentDataQuery = mysqli_query($conn, "SELECT * FROM STUDENT_VIEW WHERE $clientIds AND studentId='$studentId'");
        $studentDatafetch = mysqli_fetch_assoc($studentDataQuery);
        $fetchQuery['studentData'] = $studentDatafetch;

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

         /////////////////// get previous score
         $assessmentDataQuery = mysqli_query($conn, "SELECT markObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId='$recordId' AND studentId='$studentId'");
         $assessmentDataFetch = mysqli_fetch_assoc($assessmentDataQuery);
         $fetchQuery['assessmentData']= $assessmentDataFetch;

        $response['studentData'][] = $fetchQuery;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>