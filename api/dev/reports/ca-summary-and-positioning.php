<?php
///// confirm if the session and term is the current session and term
    $currentSessionTermQuery = mysqli_query($conn, "SELECT session, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId = '$branchId'");
    $currentSessionTermFetch = mysqli_fetch_assoc($currentSessionTermQuery);
    $currentSession = $currentSessionTermFetch['session'];
    $currentTermId = $currentSessionTermFetch['termId'];
    if (($session == $currentSession) && ($termId == $currentTermId)) {
           // delete previous terminal records for the class and arm
        mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'  AND assessmentId='$assessmentId'")or die (mysqli_error($conn));


    //// get all students CA broadsheet summary and positioning
    $select="SELECT 
    a.studentId AS studentId, 
    b.surName 
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a 
    JOIN 
    STUDENTS_TAB b  ON a.studentId = b.studentId AND a.clientId = b.clientId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId = '$branchId' 
    AND a.session = '$session' 
    AND a.termId = '$termId' 
    AND a.departmentId = '$departmentId' 
    AND a.classId = '$classId' 
    AND a.armId = '$armId'
    ORDER BY 
    b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        /// get total number of students
    $totalNoOfStudents = mysqli_num_rows($query);
    while ($fetch = mysqli_fetch_assoc($query)) {   
        $studentId = $fetch['studentId'];

        // Get totalSubjects
        $totalSubjectsQuery = mysqli_query($conn, "SELECT b.recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB a, BRANCH_ASSESSMENT_RECORD_DETAILS_TAB b 
        WHERE a.recordId=b.recordId AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.session = '$session' AND a.termId = '$termId' 
        AND a.departmentId = '$departmentId' AND a.classId = '$classId' AND a.armId = '$armId' AND b.studentId='$studentId' AND a.assessmentId='$assessmentId'") or die (mysqli_error($conn));
        $totalSubjects = mysqli_num_rows($totalSubjectsQuery);
        
        //get totalMarkObtainable
        $totalMarkObtainable = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks

        // get totalMarkObtained
        $totalMarkObtainedQuery = mysqli_query($conn, "SELECT SUM(percentage) AS totalMarkObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB 
        WHERE recordId IN 
        (SELECT recordId FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB 
        WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' 
        AND classId='$classId' AND armId='$armId' AND studentId='$studentId' AND assessmentId='$assessmentId')
        ") or die (mysqli_error($conn));
        $totalMarkObtainedFetch = mysqli_fetch_assoc($totalMarkObtainedQuery);
        $totalMarkObtained = $totalMarkObtainedFetch['totalMarkObtained'];
        // Prevent division by zero
        if ($totalSubjects == 0 || $totalMarkObtainable == 0) {
            $totalMarkObtained = 0;
            $totalPercentage = 0;
            $grade = getGrade(0);
            $remark = getRemark(0);
            $principalComment = getPrincipalComment(0);
        } else {
            $totalPercentage = ($totalMarkObtained / $totalMarkObtainable) * 100;
            $grade = getGrade($totalPercentage);
            $remark = getRemark($totalPercentage);
            // get principal comment
            $principalComment = getPrincipalComment($totalPercentage);
        }
        
        mysqli_query($conn,"INSERT INTO `BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB`
        (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `assessmentId`, `studentId`, `totalSubjects`, `totalMarkObtainable`, `totalMarkObtained`, `totalPercentage`, `grade`, `remark`, `principalComment`) VALUES
        ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$assessmentId', '$studentId', '$totalSubjects', '$totalMarkObtainable', '$totalMarkObtained', '$totalPercentage', '$grade', '$remark', '$principalComment')")or die (mysqli_error($conn));
        
    }

    //// update students position in class
        $markChecker=0;
        $count=0;
        $updatePositionSelect = "SELECT studentId, totalPercentage FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND assessmentId='$assessmentId' ORDER BY totalPercentage DESC";
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
            mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB SET position = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND assessmentId='$assessmentId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }

        //// update students overall position in class
        $markChecker_Overall=0;
        $count_Overall=0;
        $updatePositionSelect = "SELECT studentId, totalPercentage FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND assessmentId='$assessmentId' ORDER BY totalPercentage DESC";
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
            mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB SET overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND assessmentId='$assessmentId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }
    }
?>