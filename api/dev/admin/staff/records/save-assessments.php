<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
if(!$checkSession){
	$response['response']=99;
	$response['success']=false;
	$response['message']="SESSION EXPIRED! Please LogIn Again.";
	goto end;
}
    //////////////////declaration of variables//////////////////////////////////////
    $recordId = $_GET['recordId'];
	$assessments = $data['assessments'];

    validateEmptyField($recordId, 'RECORD');
    if (count($assessments)==0) {
        $response = [
            'response' => 102,
            'success' => false,
            'message' => 'ASSESSMENT REQUIRED! At least one assessment is required. Check field and try again.'
        ];
        goto end;
    }

    mysqli_query($conn,"DELETE FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId = '$recordId'")or die (mysqli_error($conn));

    /// get markObtainable
    $query=mysqli_query($conn,"SELECT * FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE recordId = '$recordId'")or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $assessmentId = $fetchQuery['assessmentId'];
    $branchId = $fetchQuery['branchId'];


    $query=mysqli_query($conn,"SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND assessmentId='$assessmentId'")or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $assessmentName = $fetchQuery['assessmentName'];
    $markObtainable = $fetchQuery['assessmentTotalScore'];

        foreach ($assessments as $assessment) {
			$studentId = $assessment['studentId'];
			$markObtained = $assessment['score'];
            if($markObtained && $markObtained<=$markObtainable){
                $percentage=ROUND((($markObtained/$markObtainable)*100),2);
                $grade = getGrade($percentage);
                $remark = getRemark($percentage);

                mysqli_query($conn,"INSERT INTO `BRANCH_ASSESSMENT_RECORD_DETAILS_TAB`
                (`recordId`, `studentId`, `markObtainable`, `markObtained`, `percentage`, `grade`, `remark`, `createdTime`) VALUES 
                ('$recordId', '$studentId', '$markObtainable', '$markObtained', '$percentage', '$grade', '$remark', NOW())")or die (mysqli_error($conn));
            }
		}


        //// calculate position
    $select="SELECT studentId, markObtained FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId='$recordId' ORDER BY markObtained DESC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));

    $markChecker=0;
    $count=0;
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $count++;
        $studentId=$fetchQuery['studentId'];
        $markObtained=$fetchQuery['markObtained'];

       if($markChecker!=$markObtained){
            $markChecker=$markObtained;
            $position=$count . getOrdinalSuffix($count);
       }
       mysqli_query($conn,"UPDATE BRANCH_ASSESSMENT_RECORD_DETAILS_TAB  SET position='$position' WHERE recordId='$recordId' AND studentId='$studentId'")or die (mysqli_error($conn));
    }




    
    ////// get  this recordId details to update total percentage
    $query=mysqli_query($conn,"SELECT * FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE recordId = '$recordId'")or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $branchId = $fetchQuery['branchId'];
    $session = $fetchQuery['session'];
    $termId = $fetchQuery['termId'];
    $departmentId = $fetchQuery['departmentId'];
    $classId = $fetchQuery['classId'];
    $armId = $fetchQuery['armId'];
    $subjectId = $fetchQuery['subjectId'];
 // delete previous terminal records for the class and arm
    mysqli_query($conn,"DELETE FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId' AND subjectId = '$subjectId'")or die (mysqli_error($conn));
 
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

    $response['response']=200; 
    $response['success']=true;
    $response['message']="$assessmentName SAVED SUCCESSFULLY!";

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>