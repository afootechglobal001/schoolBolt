<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/staff-session-check.php';?>
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
    $session=trim($_POST['session']);
    $termId=trim($_POST['termId']);
    $timeSchoolOpened=trim($_POST['timeSchoolOpened']);
    $schoolResumptionDate=trim($_POST['schoolResumptionDate']);
    $schoolLogo=$_FILES['schoolLogo']['name'];
    $principalSignature=$_FILES['principalSignature']['name'];


    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($timeSchoolOpened, 'TIME SCHOOL OPENED');

    mysqli_query($conn,"UPDATE `BRANCHES_TAB` SET
    `session`='$session', `termId`='$termId', `timeSchoolOpened`='$timeSchoolOpened', `schoolResumptionDate`='$schoolResumptionDate', 
    `updatedBy`='$loginStaffId', `updatedTime`=NOW() WHERE $clientIds AND branchId='$branchId'")or die (mysqli_error($conn));


    ////get db school logo and principal signature
    $getBranchQuery = mysqli_query($conn, "SELECT schoolLogo, principalSignature FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    $branchData = mysqli_fetch_assoc($getBranchQuery);
    $oldSchoolLogo = $branchData['schoolLogo'];
    $oldPrincipalSignature = $branchData['principalSignature'];
    $newSchoolLogoName = '';
    $newPrincipalSignatureName = '';
    ////update school logo
    $schoolLogoExtension = pathinfo($_FILES['schoolLogo']['name'], PATHINFO_EXTENSION);
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    if (in_array($schoolLogoExtension,$allowedExts)){
        $newSchoolLogoName = $branchId . uniqid() . '.' . $schoolLogo;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET schoolLogo='$newSchoolLogoName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
    ////update principal signature
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $principalSignatureExtension = pathinfo($_FILES['principalSignature']['name'], PATHINFO_EXTENSION);
    if (in_array($principalSignatureExtension,$allowedExts)){
        $newPrincipalSignatureName = $branchId . uniqid() . '.' . $principalSignature;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET principalSignature='$newPrincipalSignatureName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }  

    $response = [
    'response' => 200,
    'success'  => true,
    'message'  => 'BRANCH UPDATE SUCCESSFULLY!',
    'data'     => [
        'branchId'             => $branchId,
        'session'              => $session,
        'termId'               => $termId,
        'timeSchoolOpened'     => $timeSchoolOpened,
        'schoolResumptionDate' => $schoolResumptionDate,
        'oldSchoolLogo'        => $oldSchoolLogo,
        'oldPrincipalSignature'=> $oldPrincipalSignature,
        'schoolLogo'           => $newSchoolLogoName,
        'principalSignature'   => $newPrincipalSignatureName,
    ]
];
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>