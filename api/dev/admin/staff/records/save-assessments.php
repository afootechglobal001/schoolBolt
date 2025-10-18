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

    $response['response']=200; 
    $response['success']=true;
    $response['message']="$assessmentName SAVED SUCCESSFULLY!";

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>