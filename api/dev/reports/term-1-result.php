<?php 
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
    $tableTitles .=",TOTAL SCORE(100), SECOND TERM SCORE(100), THIRD TERM SCORE (100), MIN SCORE, MAX SCORE, AVERAGE SCORE, POSTN. IN CLASS, GRADE, REMARKS";

    $response['tableTitles'] = $tableTitles;
     //// get student mark per assessment for each subject
    $response['studentSubjectAssessmentData'] = array();

    $studentSubjectSelect = "SELECT 
    a.subjectId, 
    b.subjectName,
    a.allAssessmentTotalMark AS totalMark,
    a.grade,
    a.position AS positionInClass,
    a.overallPosition,
    a.remark
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB a
    JOIN
    SUBJECTS_TAB b ON a.clientId=b.clientId AND a.subjectId = b.subjectId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId='$branchId'
    AND a.session='$session' 
    AND a.termId='$termId'
    AND a.departmentId='$departmentId' 
    AND a.classId='$classId' 
    AND a.armId='$armId'
    AND a.studentId='$studentId'
    ORDER BY b.subjectName";
    $studentSubjectQuery = mysqli_query($conn, $studentSubjectSelect) or die(mysqli_error($conn));
    while ($studentSubjectFetch = mysqli_fetch_assoc($studentSubjectQuery)) {
        $subjectId = $studentSubjectFetch['subjectId'];

        $studentSubjectFetch['secondTermScore'] = '';
        $studentSubjectFetch['thirdTermScore'] = '';

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
        MIN(allAssessmentTotalMark) AS minScore,
        MAX(allAssessmentTotalMark) AS maxScore,
        AVG(allAssessmentTotalMark) AS averageScore
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

     /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $response['resultSummary'] = array();  
    //// get all students as at the time of assessment
    $select="SELECT 
    totalSubjects,
    totalMarkObtainable,
    totalMarkObtained,
    totalPercentage,
    position AS positionInClass,
    principalComment,
    noOfStudentsInArm,
    noOfStudentsInClass
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB
    WHERE 
    $clientIds
    AND branchId = '$branchId' 
    AND session = '$session' 
    AND termId = '$termId' 
    AND departmentId = '$departmentId' 
    AND classId = '$classId' 
    AND armId = '$armId'
    AND studentId = '$studentId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetch = mysqli_fetch_assoc($query);    
    $response['resultSummary'] = $fetch;
    
?>