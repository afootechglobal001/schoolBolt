<?php
    ///// confirm if the session and term is the current session and term
    $currentSessionTermQuery = mysqli_query($conn, "SELECT session, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId = '$branchId'");
    $currentSessionTermFetch = mysqli_fetch_assoc($currentSessionTermQuery);
    $currentSession = $currentSessionTermFetch['session'];
    $currentTermId = $currentSessionTermFetch['termId'];
    if (($session == $currentSession) && ($termId == $currentTermId)) {
        // delete previous terminal total percentage records for the class and arm
         mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId'")or die (mysqli_error($conn));
        ///get all assessment counts for this branch
        $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0   $assessmentIds";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        $allAssessmentsCount=mysqli_num_rows($query);
        //////////////////////////////////////////////////////////////////////////////////////////////
        /// get each student totalSubjects and totalMarkObtained for a term
        $select="SELECT studentId, COUNT(DISTINCT subjectId) AS totalSubjects, SUM(allAssessmentTotalMark) AS totalMarkObtained FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND numberOfSittings=$allAssessmentsCount GROUP BY studentId";
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


        //////////////////////////////////////////////////////////////////////////////////////////////
        //// update students position in arm
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
            mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB SET noOfStudentsInArm = '$noOfStudents', position = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
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
            mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB SET noOfStudentsInClass = '$noOfStudents', overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }

    }
end:
?>