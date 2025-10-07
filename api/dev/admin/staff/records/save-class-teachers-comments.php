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
    $branchId = $_GET['branchId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    $allComments = $data['allComments'];
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');

    if (count($allComments)==0) {
        $response = [
            'response' => 102,
            'success' => false,
            'message' => 'COMMENTS REQUIRED! At least one comment is required. Check field and try again.'
        ];
        goto end;
    }

    $branchDataQuery = mysqli_query($conn, "SELECT session, termId, timeSchoolOpened FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $session=$branchDataFetch['session'];
    $termId=$branchDataFetch['termId'];

    mysqli_query($conn,"DELETE FROM BRANCH_TEACHERS_COMMENTS_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND armId = '$armId'")or die (mysqli_error($conn));

        foreach ($allComments as $comment) {
			$studentId = $comment['studentId'];
			$classTeachersComment = strtoupper($comment['classTeachersComment']);
            
            mysqli_query($conn,"INSERT INTO `BRANCH_TEACHERS_COMMENTS_TAB`
            (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `armId`, `studentId`, `classTeachersComment`, `staffId`, `createdTime`) VALUES 
            ('$clientId', '$branchId', '$session', '$termId', '$departmentId', '$classId', '$armId', '$studentId', '$classTeachersComment', '$loginStaffId', NOW())")or die (mysqli_error($conn));
		}

    $response['response']=200; 
    $response['success']=true;
    $response['message']="TEACHERS COMMENTS SAVED SUCCESSFULLY!";

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>