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
    $select = "SELECT 
    DISTINCT a.studentId AS studentId, 
    b.surName,
    COUNT(DISTINCT a.recordId) AS totalSubjects,
    SUM(a.percentage) AS totalMarkObtained
FROM 
    BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a
JOIN STUDENTS_TAB b  
    ON a.studentId = b.studentId
JOIN BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB c 
    ON a.recordId = c.recordId
WHERE 
    c.clientId='$clientId' 
    AND c.branchId = '$branchId' 
    AND c.session = '$session' 
    AND c.termId = '$termId' 
    AND c.departmentId = '$departmentId' 
    AND c.classId = '$classId' 
    AND c.armId = '$armId'
    AND c.assessmentId='$assessmentId'
GROUP BY 
    a.studentId, b.surName
ORDER BY 
    b.surName ASC";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {   
        $studentId = $fetch['studentId'];
        $totalSubjects = $fetch['totalSubjects'];
        //get totalMarkObtainable
        $totalMarkObtainable = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks
        $totalMarkObtained = $fetch['totalMarkObtained'];
        
        $totalPercentage = ($totalMarkObtained / $totalMarkObtainable) * 100;
        $grade = getGrade($totalPercentage);
        $remark = getRemark($totalPercentage);
        // get principal comment
        $principalComment = getPrincipalComment($totalPercentage);
        
        mysqli_query($conn,"INSERT INTO `BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB`
        (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `assessmentId`, `studentId`, `totalSubjects`, `totalMarkObtainable`, `totalMarkObtained`, `totalPercentage`, `grade`, `remark`, `principalComment`) VALUES
        ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$assessmentId', '$studentId', '$totalSubjects', '$totalMarkObtainable', '$totalMarkObtained', '$totalPercentage', '$grade', '$remark', '$principalComment')")or die (mysqli_error($conn));
        
    }

    //// update students position in arm per assessment
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
      
    }
?>