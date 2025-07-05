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
     WHERE $clientIds  AND branchId = '$branchId'  AND session = '$session'  AND termId = '$termId'  
     AND departmentId = '$departmentId'  AND classId = '$classId'  AND armId = '$armId'  AND assessmentId = '$assessmentId'";
     
    $broadsheetQuery=mysqli_query($conn,$broadsheetSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($broadsheetQuery);
    if($allRecordCount==0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="No record found!";
        goto end;
    }


    /// get all tableTitles
    $tableTitles="SN, FULL NAME, NO. OF SUBJECTS, MARK OBTAINABLE (%), MARK OBTAINED (%), TOTAL PERCENTAGE, POSTN. IN CALSS, OVERALL POSTN., REMARKS, TEACHER'S COMMENT";
    
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

    $assessmentDataQuery = mysqli_query($conn, "SELECT assessmentId, assessmentName FROM BRANCH_ASSESSMENT_SETUP_TAB  WHERE $clientIds AND branchId='$branchId' AND assessmentId='$assessmentId'");
    $assessmentDataFetch = mysqli_fetch_assoc($assessmentDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CA RESULT SUMMARY FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['assessmentData'] = $assessmentDataFetch;
    $response['tableTitles']=$tableTitles;
    
    $response['studentData'] = array();
    //// get all students as at the time of assessment
    $select="SELECT DISTINCT(a.studentId) AS studentId, c.surName, c.otherNames, c.passport FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b, STUDENTS_TAB c    
    WHERE b.clientId=c.clientId AND a.recordId=b.recordId AND a.studentId=c.studentId  AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.session='$session' AND b.termId='$termId' AND b.departmentId='$departmentId' AND b.classId='$classId' AND b.armId='$armId'  ORDER BY c.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {    
        $response['studentData'][] = $fetch;
    }


       //// get overall number of students in that class
    $select="SELECT DISTINCT(a.studentId) AS studentId, c.surName FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b, STUDENTS_TAB c    
    WHERE b.clientId=c.clientId AND a.recordId=b.recordId AND a.studentId=c.studentId  AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.session='$session' AND b.termId='$termId' AND b.departmentId='$departmentId' AND b.classId='$classId'  ORDER BY c.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $overallNumberOfStudents=mysqli_num_rows($query);


    //// get students broadsheet summary
    $response['summaryData'] = array();
    $select="SELECT DISTINCT(a.studentId) AS studentId, c.surName FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b, STUDENTS_TAB c    
    WHERE b.clientId=c.clientId AND a.recordId=b.recordId AND a.studentId=c.studentId  AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.session='$session' AND b.termId='$termId' AND b.departmentId='$departmentId' AND b.classId='$classId' AND b.armId='$armId'  ORDER BY c.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $numberOfStudents=mysqli_num_rows($query);
    
    while ($fetch = mysqli_fetch_assoc($query)) {   
        $studentId = $fetch['studentId'];

        // Get totalSubjects
        $totalSubjectsQuery = mysqli_query($conn, "SELECT b.recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB a, BRANCH_ASSESSMENT_RECORD_DETAILS_TAB b 
        WHERE a.recordId=b.recordId AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.session = '$session' AND a.termId = '$termId' 
        AND a.departmentId = '$departmentId' AND a.classId = '$classId' AND a.armId = '$armId' AND b.studentId='$studentId' AND a.assessmentId='$assessmentId'") or die (mysqli_error($conn));
        $totalSubjects = mysqli_num_rows($totalSubjectsQuery);
        $fetch['totalSubjects'] = $totalSubjects;
        
        //get totalMarkObtainable
        $fetch['totalMarkObtainable'] = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks

        // get totalMarkObtained
        $totalMarkObtainedQuery = mysqli_query($conn, "SELECT SUM(percentage) AS totalMarkObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId' AND studentId='$studentId' AND assessmentId='$assessmentId')
        ") or die (mysqli_error($conn));
        $totalMarkObtainedFetch = mysqli_fetch_assoc($totalMarkObtainedQuery);
        $fetch['totalMarkObtained'] = $totalMarkObtainedFetch['totalMarkObtained'];
        
        // Calculate totalPercentage
        $fetch['totalPercentage'] = number_format(($fetch['totalMarkObtained'] / $fetch['totalMarkObtainable']) * 100, 2) . '%'; // Assuming totalMarkObtainable is the sum of all subjects' maximum marks

        // get positionInClass
        $positionQuery = mysqli_query($conn, "SELECT COUNT(*) AS position FROM 
        (SELECT studentId, SUM(percentage) AS totalMark FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId' AND assessmentId='$assessmentId') GROUP BY studentId) AS subquery 
        WHERE totalMark > (SELECT SUM(percentage) FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId' AND studentId='$studentId' AND assessmentId='$assessmentId'))") or die (mysqli_error($conn));
        $positionFetch = mysqli_fetch_assoc($positionQuery);
        $positionInClass = $positionFetch['position'] + 1; // Adding 1 to include the current student in the position count
        $fetch['positionInClass']= $positionInClass . getOrdinalSuffix($positionInClass) . "($numberOfStudents)"; // Get ordinal suffix for position



        // get overallPositionInClass
        $overallPositionQuery = mysqli_query($conn, "SELECT COUNT(*) AS position FROM 
        (SELECT studentId, SUM(percentage) AS totalMark FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND assessmentId='$assessmentId') GROUP BY studentId) AS subquery 
        WHERE totalMark > (SELECT SUM(percentage) FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND studentId='$studentId' AND assessmentId='$assessmentId'))") or die (mysqli_error($conn));
        $overallPositionFetch = mysqli_fetch_assoc($overallPositionQuery);
        $overallPositionInClass = $overallPositionFetch['position'] + 1; // Adding 1 to include the current student in the position count
        $fetch['overallPositionInClass']= $overallPositionInClass . getOrdinalSuffix($overallPositionInClass) . "($overallNumberOfStudents)"; // Get ordinal suffix for position

        


        // Get remarks
        $fetch['remarks'] = getRemark($fetch['totalPercentage']);

        // get teachers comment
        $fetch['teachersComment'] = getPrincipalComment($fetch['totalPercentage']);
        
        $response['summaryData'][] = $fetch;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>