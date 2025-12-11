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
       
        // delete previous terminal total percentage records for the class and arm
         mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'")or die (mysqli_error($conn));

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