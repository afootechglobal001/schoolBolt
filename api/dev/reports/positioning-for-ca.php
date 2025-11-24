<?php
    /// confirm if there is any subject records for this class and arm
    $subjectSelect="SELECT
    DISTINCT (subjectId) AS subjectId
    FROM
    BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB
    WHERE
    $clientIds
    AND branchId = '$branchId'
    AND session = '$session'
    AND termId = '$termId'
    AND departmentId = '$departmentId'
    AND classId = '$classId'
    AND armId = '$armId'";

    $subjectQuery=mysqli_query($conn,$subjectSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($subjectQuery);
    if ($allRecordCount==0){
        $recordFound = false; // No records found, set flag to false
        goto end;
    } else {
        $recordFound = true; // Records found, set flag to true 
    }


    ///// confirm if the session and term is the current session and term
    $currentSessionTermQuery = mysqli_query($conn, "SELECT session, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId = '$branchId'");
    $currentSessionTermFetch = mysqli_fetch_assoc($currentSessionTermQuery);
    $currentSession = $currentSessionTermFetch['session'];
    $currentTermId = $currentSessionTermFetch['termId'];
    if (($session == $currentSession) && ($termId == $currentTermId)) {
       
        // delete previous terminal records for the class and arm
        mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'")or die (mysqli_error($conn));
         // delete previous terminal total percentage records for the class and arm
         mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'")or die (mysqli_error($conn));

        while($subjectFetch = mysqli_fetch_assoc($subjectQuery)){
            $subjectId = $subjectFetch['subjectId'];

            /// get all assessment records for this subject
            $recordIdsArray = [];
            $recordIdQuery = mysqli_query($conn, "SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'") or die(mysqli_error($conn));
            while ($recordIdFetch = mysqli_fetch_assoc($recordIdQuery)) {
                $recordIdsArray[] = "'" . $recordIdFetch['recordId'] . "'";
            }
            //// calculate total assessments mark for each student in the subject
            $recordIds = implode(",", $recordIdsArray);
            $studentScoreQuery = mysqli_query($conn, "SELECT DISTINCT(studentId) AS studentId, SUM(markObtained) AS totalMark FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId IN ($recordIds) GROUP BY studentId") or die(mysqli_error($conn));

            while ($studentScoreFetch = mysqli_fetch_assoc($studentScoreQuery)) {
                $studentId = $studentScoreFetch['studentId'];
                $totalMark = $studentScoreFetch['totalMark'];
                $percentage = number_format(($totalMark / 100) * 100, 2); // Assuming each subject has a maximum of 100 marks
                $grade = getGrade($percentage);
                $remark = getRemark($percentage);
                

                mysqli_query($conn,"INSERT INTO `BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB`
                (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `subjectId`, `studentId`, `allAssessmentTotalMark`, `grade`, `remark`) VALUES
                ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$subjectId', '$studentId', '$totalMark', '$grade', '$remark')")or die (mysqli_error($conn));
            }
            /// update students position in class per subject in the term
            $markChecker=0;
            $count=0;
            $updatePositionSelect = "SELECT studentId, allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND subjectId = '$subjectId' ORDER BY allAssessmentTotalMark DESC";
            $updatePositionQuery = mysqli_query($conn, $updatePositionSelect) or die(mysqli_error($conn));
            $noOfStudents = mysqli_num_rows($updatePositionQuery);
            while ($updatePositionFetch = mysqli_fetch_assoc($updatePositionQuery)) {
                $count++;
                $updateStudentId=$updatePositionFetch['studentId'];
                $allAssessmentTotalMark=$updatePositionFetch['allAssessmentTotalMark'];

                if($markChecker!=$allAssessmentTotalMark){
                    $markChecker=$allAssessmentTotalMark;
                    $position=$count . getOrdinalSuffix($count)."($noOfStudents)";
                }
                mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB SET position = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND subjectId = '$subjectId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
            }
        }



        //////////////////////////////////////////////////////////////////////////////////////////////
        /// get each student totalSubjects and totalMarkObtained for a term
        $select="SELECT studentId, COUNT(DISTINCT subjectId) AS totalSubjects, SUM(allAssessmentTotalMark) AS totalMarkObtained FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' GROUP BY studentId";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        while ($fetch = mysqli_fetch_assoc($query)) {
            $studentId = $fetch['studentId'];
            $totalSubjects = $fetch['totalSubjects'];
            $totalMarkObtainable = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks
            $totalMarkObtained = $fetch['totalMarkObtained'];

            $totalPercentage = ($totalMarkObtained / $totalMarkObtainable) * 100; // Assuming each subject has a maximum of 100 marks
            $grade = getGrade($totalPercentage);
            $remark = getRemark($totalPercentage);
            // get principal comment
            $principalComment = getPrincipalComment($totalPercentage);

            mysqli_query($conn,"INSERT INTO `BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB`
            (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `studentId`, `totalSubjects`, `totalMarkObtainable`, `totalMarkObtained`, `totalPercentage`, `grade`, `remark`, `principalComment`) VALUES
            ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$studentId', '$totalSubjects', '$totalMarkObtainable', '$totalMarkObtained', '$totalPercentage', '$grade', '$remark', '$principalComment')")or die (mysqli_error($conn));
        }

    }
end:
?>