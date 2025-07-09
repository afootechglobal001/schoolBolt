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
    $allRecordCount==0 ? $recordFound = false : $recordFound = true;
    

    // delete previous terminal records for the class and arm
    mysqli_query($conn,"DELETE FROM BRANCH_TERMINAL_SUBJECT_REPORT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'")or die (mysqli_error($conn));
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

            mysqli_query($conn,"INSERT INTO `BRANCH_TERMINAL_SUBJECT_REPORT_TAB`
            (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `subjectId`, `studentId`, `allAssessmentTotalMark`, `grade`, `remark`) VALUES
            ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$subjectId', '$studentId', '$totalMark', '$grade', '$remark')")or die (mysqli_error($conn));
        }
        /// update students position in class per subject in the term
        $markChecker=0;
        $count=0;
        $updatePositionSelect = "SELECT studentId, allAssessmentTotalMark FROM BRANCH_TERMINAL_SUBJECT_REPORT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND subjectId = '$subjectId' ORDER BY allAssessmentTotalMark DESC";
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
            mysqli_query($conn, "UPDATE BRANCH_TERMINAL_SUBJECT_REPORT_TAB SET position = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND subjectId = '$subjectId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }


        /// update students overall position in class per subject in the term
        $markChecker_Overall=0;
        $count_Overall=0;
        $updateOverallPositionSelect = "SELECT studentId, allAssessmentTotalMark FROM BRANCH_TERMINAL_SUBJECT_REPORT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND subjectId = '$subjectId' ORDER BY allAssessmentTotalMark DESC";
        $updateOverallPositionQuery = mysqli_query($conn, $updateOverallPositionSelect) or die(mysqli_error($conn));
        $allNoOfStudents = mysqli_num_rows($updateOverallPositionQuery);
        while ($updateOverallPositionFetch = mysqli_fetch_assoc($updateOverallPositionQuery)) {
            $count_Overall++;
            $updateStudentId=$updateOverallPositionFetch['studentId'];
            $allAssessmentTotalMark=$updateOverallPositionFetch['allAssessmentTotalMark'];

            if($markChecker_Overall!=$allAssessmentTotalMark){
                $markChecker_Overall=$allAssessmentTotalMark;
                $position=$count_Overall . getOrdinalSuffix($count_Overall)."($allNoOfStudents)";
            }
            mysqli_query($conn, "UPDATE BRANCH_TERMINAL_SUBJECT_REPORT_TAB SET overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND subjectId = '$subjectId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////
    /// get each student totalSubjects and totalMarkObtained for a term
    $select="SELECT studentId, COUNT(DISTINCT subjectId) AS totalSubjects, SUM(allAssessmentTotalMark) AS totalMarkObtained FROM BRANCH_TERMINAL_SUBJECT_REPORT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' GROUP BY studentId";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $studentId = $fetch['studentId'];
        $totalSubjects = $fetch['totalSubjects'];
        $totalMarkObtainable = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks
        $totalMarkObtained = $fetch['totalMarkObtained'];

        $totalPercentage = ($totalMarkObtained / $totalMarkObtainable) * 100; // Assuming each subject has a maximum of 100 marks
        $grade = getGrade($totalPercentage);
        $remark = getRemark($totalPercentage);

        mysqli_query($conn,"INSERT INTO `BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB`
        (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `studentId`, `totalSubjects`, `totalMarkObtainable`, `totalMarkObtained`, `totalPercentage`, `grade`, `remark`) VALUES
        ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$studentId', '$totalSubjects', '$totalMarkObtainable', '$totalMarkObtained', '$totalPercentage', '$grade', '$remark')")or die (mysqli_error($conn));
    }

    //// update students position in class
    $markChecker=0;
    $count=0;
    $updatePositionSelect = "SELECT studentId, totalPercentage FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' ORDER BY totalPercentage DESC";
    $updatePositionQuery = mysqli_query($conn, $updatePositionSelect) or die(mysqli_error($conn));
    $noOfStudents = mysqli_num_rows($updatePositionQuery);
    while ($updatePositionFetch = mysqli_fetch_assoc($updatePositionQuery)) {
        $count++;
        $updateStudentId=$updatePositionFetch['studentId'];
        $totalPercentage=$updatePositionFetch['totalPercentage'];

        if($markChecker!=$totalPercentage){
            $markChecker=$totalPercentage;
            $position=$count . getOrdinalSuffix($count)."($noOfStudents)";
        }
        mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB SET position = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
    }


    //// update students overall position in class
    $markChecker_Overall=0;
    $count_Overall=0;
    $updatePositionSelect = "SELECT studentId, totalPercentage FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' ORDER BY totalPercentage DESC";
    $updatePositionQuery = mysqli_query($conn, $updatePositionSelect) or die(mysqli_error($conn));
    $noOfStudents = mysqli_num_rows($updatePositionQuery);
    while ($updatePositionFetch = mysqli_fetch_assoc($updatePositionQuery)) {
        $count_Overall++;
        $updateStudentId=$updatePositionFetch['studentId'];
        $totalPercentage=$updatePositionFetch['totalPercentage'];

        if($markChecker_Overall!=$totalPercentage){
            $markChecker_Overall=$totalPercentage;
            $position=$count_Overall . getOrdinalSuffix($count_Overall)."($noOfStudents)";
        }
        mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB SET overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
    }

?>