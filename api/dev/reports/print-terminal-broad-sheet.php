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
    

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');


    /// confirm if there is records
    $broadsheetSelect="SELECT recordId, subjectId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB
     WHERE $clientIds  AND branchId = '$branchId'  AND session = '$session'  AND termId = '$termId'  
     AND departmentId = '$departmentId'  AND classId = '$classId'  AND armId = '$armId'";
     
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
    $tableTitles .=", NO. OF SUBJECTS, MARK OBTAINABLE (%), MARK OBTAINED (%), TOTAL PERCENTAGE, POSTN. IN CALSS, REMARKS";

    


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
    $response['tableTitles']=$tableTitles;
    
    $response['studentData'] = array();
    //// get all students as at the time of assessment
    $select="SELECT DISTINCT(a.studentId) AS studentId, c.surName, c.firstName FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b, STUDENTS_TAB c    
    WHERE b.clientId=c.clientId AND a.recordId=b.recordId AND a.studentId=c.studentId  AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.departmentId='$departmentId' AND b.classId='$classId' AND b.armId='$armId'  ORDER BY c.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {    
        $response['studentData'][] = $fetch;
    }



    $response['scoreData'] = array();
     /// get all class subjects
    $select="SELECT a.subjectId, b.subjectName, b.subjectAbbreviation FROM SUBJECT_STRUCTURE_TAB a, SUBJECTS_TAB b 
    WHERE a.clientId=b.clientId AND a.clientId='$clientId'  AND a.subjectId = b.subjectId AND a.classId='$classId'
    ORDER BY b.subjectName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $subjectId= $fetch['subjectId'];

        $recordIdsArray = [];
        $recordIdQuery = mysqli_query($conn, "SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'") or die(mysqli_error($conn));

        while ($recordIdFetch = mysqli_fetch_assoc($recordIdQuery)) {
            $recordIdsArray[] = "'" . $recordIdFetch['recordId'] . "'";
        }

        if (!empty($recordIdsArray)) {
            $recordIds = implode(",", $recordIdsArray);

            $studentScoreQuery = mysqli_query($conn, "SELECT studentId, SUM(markObtained) AS totalMark FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId IN ($recordIds) GROUP BY studentId") or die(mysqli_error($conn));

            while ($studentScoreFetch = mysqli_fetch_assoc($studentScoreQuery)) {
                $fetch['studentScorePerSubject'][] = $studentScoreFetch;
            }
        } else {
            $fetch['studentScorePerSubject'] = []; // optional: handle no records
        }

        $response['scoreData'][] = $fetch;
    }


       //// get all students broadsheet summary
    $response['summaryData'] = array();
    $select="SELECT DISTINCT(a.studentId) AS studentId, c.surName FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b, STUDENTS_TAB c    
    WHERE b.clientId=c.clientId AND a.recordId=b.recordId AND a.studentId=c.studentId  AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.departmentId='$departmentId' AND b.classId='$classId' AND b.armId='$armId'  ORDER BY c.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $numberOfStudents=mysqli_num_rows($query);
    while ($fetch = mysqli_fetch_assoc($query)) {   
        $studentId = $fetch['studentId'];

        // Get totalSubjects
        $totalSubjectsQuery = mysqli_query($conn, "SELECT DISTINCT(a.subjectId) FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB a, BRANCH_ASSESSMENT_RECORD_DETAILS_TAB b 
        WHERE a.recordId=b.recordId AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.session = '$session' AND a.termId = '$termId' 
        AND a.departmentId = '$departmentId' AND a.classId = '$classId' AND a.armId = '$armId'") or die (mysqli_error($conn));
        $totalSubjects = mysqli_num_rows($totalSubjectsQuery);
        $fetch['totalSubjects'] = $totalSubjects;
        
        //get totalMarkObtainable
        $fetch['totalMarkObtainable'] = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks

        // get totalMarkObtained
        $totalMarkObtainedQuery = mysqli_query($conn, "SELECT SUM(markObtained) AS totalMarkObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId') AND studentId='$studentId'") or die (mysqli_error($conn));
        
        $totalMarkObtainedFetch = mysqli_fetch_assoc($totalMarkObtainedQuery);
        $fetch['totalMarkObtained'] = $totalMarkObtainedFetch['totalMarkObtained'];
        
        // Calculate totalPercentage
        $fetch['totalPercentage'] = number_format(($fetch['totalMarkObtained'] / $fetch['totalMarkObtainable']) * 100, 2) . '%'; // Assuming totalMarkObtainable is the sum of all subjects' maximum marks

        // get positionInClass
        $positionQuery = mysqli_query($conn, "SELECT COUNT(*) AS position FROM 
        (SELECT studentId, SUM(percentage) AS totalMark FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId') GROUP BY studentId) AS subquery 
        WHERE totalMark > (SELECT SUM(percentage) FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId' AND studentId='$studentId'))") or die (mysqli_error($conn));
        $positionFetch = mysqli_fetch_assoc($positionQuery);
        $positionInClass = $positionFetch['position'] + 1; // Adding 1 to include the current student in the position count
        $fetch['positionInClass']= $positionInClass . getOrdinalSuffix($positionInClass) . "($numberOfStudents)"; // Get ordinal suffix for position
        // Get remarks
        $fetch['remarks'] = getRemark($fetch['totalPercentage']);
        
        $response['summaryData'][] = $fetch;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>