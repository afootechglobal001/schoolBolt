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
       
        while($subjectFetch = mysqli_fetch_assoc($subjectQuery)){
            $subjectId = $subjectFetch['subjectId'];

            /// update students overall position in class per subject in the term
            $markChecker_Overall=0;
            $count_Overall=0;
            $updateOverallPositionSelect = "SELECT studentId, allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND subjectId = '$subjectId' ORDER BY allAssessmentTotalMark DESC";
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
                mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB SET overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND subjectId = '$subjectId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
            }
        }



        //////////////////////////////////////////////////////////////////////////////////////////////
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