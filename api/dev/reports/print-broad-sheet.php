<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}

    //////////////////declaration of variables//////////////////////////////////////
    $branchId = $_GET['branchId'];
    $session = $_GET['session'];
    $termId = $_GET['termId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    $assessmentId = $_GET['assessmentId'];
    

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($assessmentId, 'ASSESSMENT');


    /// confirm if there is records
    $broadsheetSelect="SELECT recordId, subjectId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB
     WHERE $clientIds  AND branchId = '$branchId'  AND session = '$session'  AND termId = '$termId'  AND departmentId = '$departmentId'  AND classId = '$classId'  AND armId = '$armId'  AND assessmentId = '$assessmentId'";
    $broadsheetQuery=mysqli_query($conn,$broadsheetSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($broadsheetQuery);
    if($allRecordCount==0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="No record found!";
        goto end;
    }


    /// get all tableTitles
    $tableTitles="SN, FULL NAME";
    $select="SELECT a.subjectId, b.subjectName, b.subjectAbbreviation FROM SUBJECT_STRUCTURE_TAB a, SUBJECTS_TAB b 
    WHERE a.clientId=b.clientId AND a.clientId='$clientId'  AND a.subjectId = b.subjectId AND a.classId='$classId'
    ORDER BY b.subjectName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $subjectAbbreviation=$fetch['subjectAbbreviation'];
        $tableTitles .=", $subjectAbbreviation";     
    }
    //$tableTitles .=", NO. OF SUBJECTS, MARK OBTAINABLE (%), MARK OBTAINED (%), TOTAL PERCENTAGE, POSTN. IN CALSS, REMARKS";


    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, address, smtpUsername, mobileNumber  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);

    $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);

    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);

    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);

        $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);

    $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
    $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);

    $assessmentDataQuery = mysqli_query($conn, "SELECT assessmentId, assessmentName FROM BRANCH_ASSESSMENT_SETUP_TAB  WHERE $clientIds AND branchId='$branchId' AND assessmentId='$assessmentId'");
    $assessmentDataFetch = mysqli_fetch_assoc($assessmentDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="BROADSHEET FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['subjectData'] = $subjectDataFetch;
    $response['assessmentData'] = $assessmentDataFetch;
    $response['tableTitles']=$tableTitles;
    
    $response['studentData'] = array();

    //// get all students
    $select="SELECT a.studentId, b.surName, b.firstName FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND b.statusId=1  ORDER BY b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {    
        $response['studentData'][] = $fetch;
    }



    $response['scoreData'] = array();
     /// get all class subjects
    $tableTitles="SN, FULL NAME";
    $select="SELECT a.subjectId, b.subjectName, b.subjectAbbreviation FROM SUBJECT_STRUCTURE_TAB a, SUBJECTS_TAB b 
    WHERE a.clientId=b.clientId AND a.clientId='$clientId'  AND a.subjectId = b.subjectId AND a.classId='$classId'
    ORDER BY b.subjectName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $subjectId= $fetch['subjectId'];
        /// get recordId
        $recordIdQuery=mysqli_query($conn,"SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND assessmentId='$assessmentId'")or die (mysqli_error($conn));
        $recordIdFetch = mysqli_fetch_assoc($recordIdQuery);
        $recordId=$recordIdFetch['recordId'];
        
        $studentScoreQuery=mysqli_query($conn,"SELECT studentId, markObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId='$recordId'")or die (mysqli_error($conn));
        while($studentScoreFetch = mysqli_fetch_assoc($studentScoreQuery)){
            $fetch['studentScorePerSubject'][]=$studentScoreFetch;
        }
        $response['scoreData'][] = $fetch;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>