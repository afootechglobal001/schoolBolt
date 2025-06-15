<?php require_once '../config/connection.php';?>
<?php require_once '../config/staff-session-check.php';?>
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
    $session = $_GET['session'];
    $termId = $_GET['termId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    $subjectId = $_GET['subjectId'];
    $reportTypeId = $_GET['reportTypeId'];

    if ($branchId) {
        /////////////////// for  $branchId
        $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, address, smtpUsername, mobileNumber  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
        $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
        $session=$branchDataFetch['session'];
        $termId=$branchDataFetch['termId'];
    }
    if ($termId) {
        /////////////////// for  $termId
        $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
        $termDataFetch = mysqli_fetch_assoc($termDataQuery);
    }
    if ($departmentId) {
        /////////////////// for  $departmentId
        $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
        $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
    }
    if ($classId) {
        /////////////////// for  $classId
        $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
        $classDataFetch = mysqli_fetch_assoc($classDataQuery);
    }
     if ($armId) {
        /////////////////// for  $armId
        $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
        $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    }
    if ($subjectId) {
        /////////////////// for  $subjectId
        $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
        $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);
    }
    if ($reportTypeId) {
        /////////////////// for  $reportTypeId
        $reportTypeDataQuery = mysqli_query($conn, "SELECT reportTypeId, reportTypeName FROM SETUP_REPORT_TYPE_TAB WHERE reportTypeId='$reportTypeId'");
        $reportTypeDataFetch = mysqli_fetch_assoc($reportTypeDataQuery);
    }
    

  
    $response['response']=200; 
    $response['success']=true;
    if($branchId){
        $response['branchData'] = $branchDataFetch;
    }
    if($session){
        $response['session'] = $session;
    }
    if($termId){
        $response['termData'] = $termDataFetch;
    }
    if($departmentId){
        $response['departmentData'] = $departmentDataFetch;
    }
    if($classId){
        $response['classData'] = $classDataFetch;
    }
    if($armId){
        $response['armData'] = $armDataFetch;
    }
     if($subjectId){
        $response['subjectData'] = $subjectDataFetch;
    }
     if($reportTypeId){
        $response['reportTypeData'] = $reportTypeDataFetch;
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>