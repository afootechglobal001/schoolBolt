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
    $studentId = $_GET['studentId'];
    
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($studentId, 'STUDENT');

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
    
    $studentDataQuery=mysqli_query($conn,"SELECT studentId, surName, firstName, otherNames, passport, genderName FROM STUDENT_VIEW WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));
    $studentDataFetch = mysqli_fetch_assoc($studentDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="TERMINAL RESULT FETCHED  SUCCESFFULY!";
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['studentData'] = $studentDataFetch;

     /// get all tableTitles
    $tableTitles="SN, SUBJECTS";
    $response['subjectAssessmentData'] = array();
    $assessmentSelect="SELECT assessmentId, assessmentName, assessmentTotalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0";
    $assessmentQuery=mysqli_query($conn,$assessmentSelect)or die (mysqli_error($conn));
    while ( $assessmentFetch = mysqli_fetch_assoc($assessmentQuery)){
        $assessmentName=$assessmentFetch['assessmentName'];
        $assessmentTotalScore=$assessmentFetch['assessmentTotalScore'];
        $tableTitles .= ", $assessmentName ($assessmentTotalScore)";
        $response['subjectAssessmentData'][] = $assessmentFetch;
    }
    $tableTitles .=",TOTAL SCORE(100), POSTN. IN CLASS, MIN SCORE, MAX SCORE, AVERAGE SCORE,  GRADE, REMARKS";

    $response['tableTitles'] = $tableTitles;
     //// get student mark per assessment for each subject
    $response['studentSubjectAssessmentData'] = array();

    $studentSubjectSelect = "SELECT 
    a.subjectId, 
    b.subjectName,
    a.totalMark,
    a.grade,
    a.position,
    a.overallPosition,
    a.remark
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB a
    JOIN
    SUBJECTS_TAB b ON a.clientId=b.clientId AND a.subjectId = b.subjectId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId='$branchId' 
    AND a.departmentId='$departmentId' 
    AND a.classId='$classId' 
    AND a.armId='$armId'
    AND a.studentId='$studentId'
    ORDER BY b.subjectName";
    $studentSubjectQuery = mysqli_query($conn, $studentSubjectSelect) or die(mysqli_error($conn));
    while ($studentSubjectFetch = mysqli_fetch_assoc($studentSubjectQuery)) {
        $subjectId = $studentSubjectFetch['subjectId'];

        // Get assessments for the subject
        $assessmentSelect = "SELECT assessmentId FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0";
        $assessmentQuery = mysqli_query($conn, $assessmentSelect) or die(mysqli_error($conn));
        while ($assessmentFetch = mysqli_fetch_assoc($assessmentQuery)) {
            $assessmentId = $assessmentFetch['assessmentId'];

            // Get markObtained for each assessment
            $markObtainedSelect = "SELECT markObtained 
            FROM 
            BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a
            JOIN 
            BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b ON a.recordId=b.recordId
            WHERE 
            b.clientId='$clientId' 
            AND b.branchId='$branchId' 
            AND b.session='$session' 
            AND b.termId='$termId' 
            AND b.departmentId='$departmentId' 
            AND b.classId='$classId' 
            AND b.armId='$armId' 
            AND b.subjectId='$subjectId' 
            AND b.assessmentId='$assessmentId'
            AND a.studentId='$studentId'";
            $markObtainedQuery = mysqli_query($conn, $markObtainedSelect) or die(mysqli_error($conn));
            $markObtainedFetch = mysqli_fetch_assoc($markObtainedQuery);
            $studentSubjectFetch[$assessmentId]['markObtained'] = $markObtainedFetch['markObtained'] ? $markObtainedFetch['markObtained'] : '';
        }
        /// get min, max, average score in class for the subject from BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
        $minMaxAvgSelect = "SELECT 
        MIN(totalMark) AS minScore,
        MAX(totalMark) AS maxScore,
        AVG(totalMark) AS averageScore
        FROM 
        BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
        WHERE 
        clientId='$clientId'
        AND branchId='$branchId'
        AND session='$session'
        AND termId='$termId'
        AND departmentId='$departmentId'
        AND classId='$classId'  
        AND armId='$armId'
        AND subjectId='$subjectId'";
        $minMaxAvgQuery = mysqli_query($conn, $minMaxAvgSelect) or die(mysqli_error($conn));
        $minMaxAvgFetch = mysqli_fetch_assoc($minMaxAvgQuery);
        $studentSubjectFetch['minScore'] = $minMaxAvgFetch['minScore'] ? $minMaxAvgFetch['minScore'] : '';
        $studentSubjectFetch['maxScore'] = $minMaxAvgFetch['maxScore'] ? $minMaxAvgFetch['maxScore'] : '';
        $studentSubjectFetch['averageScore'] = $minMaxAvgFetch['averageScore'] ? number_format($minMaxAvgFetch['averageScore'], 2, '.', '')  : '';
        $response['studentSubjectAssessmentData'][] = $studentSubjectFetch;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>