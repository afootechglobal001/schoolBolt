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
    $caBroadSheetHeader = $_FILES['caBroadSheetHeader']['name'];
    $caResultSummaryHeader = $_FILES['caResultSummaryHeader']['name'];
    $classListHeader = $_FILES['classListHeader']['name'];
    $cummulativeMarkBookHeader = $_FILES['cummulativeMarkBookHeader']['name'];
    $markBookHeader = $_FILES['markBookHeader']['name'];
    $midTermResultHeader = $_FILES['midTermResultHeader']['name'];
    $progressReportHeader = $_FILES['progressReportHeader']['name'];
    $scoreSheetHeader = $_FILES['scoreSheetHeader']['name'];
    $studentListHeader = $_FILES['studentListHeader']['name'];
    $subjectListHeader = $_FILES['subjectListHeader']['name'];
    $terminalBroadSheetHeader = $_FILES['terminalBroadSheetHeader']['name'];
    $terminalResultSummaryHeader = $_FILES['terminalResultSummaryHeader']['name'];
    $terminalResultHeader = $_FILES['terminalResultHeader']['name'];
    $watermark = $_FILES['watermark']['name'];

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($timeSchoolOpened, 'TIME SCHOOL OPENED');

    mysqli_query($conn,"UPDATE `BRANCHES_TAB` SET
    `session`='$session', `termId`='$termId', `timeSchoolOpened`='$timeSchoolOpened', `schoolResumptionDate`='$schoolResumptionDate', 
    `updatedBy`='$loginStaffId', `updatedTime`=NOW() WHERE $clientIds AND branchId='$branchId'")or die (mysqli_error($conn));


    ////get db school logo and principal signature
    $getBranchQuery = mysqli_query($conn, "SELECT schoolLogo, principalSignature, caBroadSheetHeader, caResultSummaryHeader, classListHeader, cummulativeMarkBookHeader, markBookHeader, midTermResultHeader, progressReportHeader, scoreSheetHeader, studentListHeader, subjectListHeader, terminalBroadSheetHeader, terminalResultSummaryHeader, terminalResultHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    $branchData = mysqli_fetch_assoc($getBranchQuery);
    $oldSchoolLogo = $branchData['schoolLogo'];
    $oldPrincipalSignature = $branchData['principalSignature'];
    $oldCaBroadSheetHeader = $branchData['caBroadSheetHeader'];
    $oldCaResultSummaryHeader = $branchData['caResultSummaryHeader'];
    $oldClassListHeader = $branchData['classListHeader'];
    $oldCummulativeMarkBookHeader = $branchData['cummulativeMarkBookHeader'];
    $oldMarkBookHeader = $branchData['markBookHeader'];
    $oldMidTermResultHeader = $branchData['midTermResultHeader'];
    $oldProgressReportHeader = $branchData['progressReportHeader'];
    $oldScoreSheetHeader = $branchData['scoreSheetHeader'];
    $oldStudentListHeader = $branchData['studentListHeader'];
    $oldSubjectListHeader = $branchData['subjectListHeader'];
    $oldTerminalBroadSheetHeader = $branchData['terminalBroadSheetHeader'];
    $oldTerminalResultSummaryHeader = $branchData['terminalResultSummaryHeader'];
    $oldTerminalResultHeader = $branchData['terminalResultHeader'];
    $oldWatermark = $branchData['watermark'];

    $newSchoolLogoName = '';
    $newPrincipalSignatureName = '';
    $newCaBroadSheetHeaderName = '';
    $newCaResultSummaryHeaderName = '';
    $newClassListHeaderName = '';
    $newCummulativeMarkBookHeaderName = '';
    $newMarkBookHeaderName = '';
    $newMidTermResultHeaderName = '';
    $newProgressReportHeaderName = '';
    $newScoreSheetHeaderName = '';
    $newStudentListHeaderName = '';
    $newSubjectListHeaderName = '';
    $newTerminalBroadSheetHeaderName = '';
    $newTerminalResultSummaryHeaderName = '';
    $newTerminalResultHeaderName = '';
    $newWatermarkName = '';
    
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
     ////update caBroadSheetHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $caBroadSheetHeaderExtension = pathinfo($_FILES['caBroadSheetHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($caBroadSheetHeaderExtension,$allowedExts)){
        $newCaBroadSheetHeaderName = $branchId . uniqid() . '.' . $caBroadSheetHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET caBroadSheetHeader='$newCaBroadSheetHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update caResultSummaryHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $caResultSummaryHeaderExtension = pathinfo($_FILES['caResultSummaryHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($caResultSummaryHeaderExtension,$allowedExts)){
        $newCaResultSummaryHeaderName = $branchId . uniqid() . '.' . $caResultSummaryHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET caResultSummaryHeader='$newCaResultSummaryHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update classListHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $classListHeaderExtension = pathinfo($_FILES['classListHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($classListHeaderExtension,$allowedExts)){
        $newClassListHeaderName = $branchId . uniqid() . '.' . $classListHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET classListHeader='$newClassListHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update cummulativeMarkBookHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $cummulativeMarkBookHeaderExtension = pathinfo($_FILES['cummulativeMarkBookHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($cummulativeMarkBookHeaderExtension,$allowedExts)){
        $newCummulativeMarkBookHeaderName = $branchId . uniqid() . '.' . $cummulativeMarkBookHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET cummulativeMarkBookHeader='$newCummulativeMarkBookHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update markBookHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $markBookHeaderExtension = pathinfo($_FILES['markBookHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($markBookHeaderExtension,$allowedExts)){
        $newMarkBookHeaderName = $branchId . uniqid() . '.' . $markBookHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET markBookHeader='$newMarkBookHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update midTermResultHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $midTermResultHeaderExtension = pathinfo($_FILES['midTermResultHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($midTermResultHeaderExtension,$allowedExts)){
        $newMidTermResultHeaderName = $branchId . uniqid() . '.' . $midTermResultHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET midTermResultHeader='$newMidTermResultHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update progressReportHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $progressReportHeaderExtension = pathinfo($_FILES['progressReportHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($progressReportHeaderExtension,$allowedExts)){
        $newProgressReportHeaderName = $branchId . uniqid() . '.' . $progressReportHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET progressReportHeader='$newProgressReportHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update scoreSheetHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $scoreSheetHeaderExtension = pathinfo($_FILES['scoreSheetHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($scoreSheetHeaderExtension,$allowedExts)){
        $newScoreSheetHeaderName = $branchId . uniqid() . '.' . $scoreSheetHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET scoreSheetHeader='$newScoreSheetHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update studentListHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $studentListHeaderExtension = pathinfo($_FILES['studentListHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($studentListHeaderExtension,$allowedExts)){
        $newStudentListHeaderName = $branchId . uniqid() . '.' . $studentListHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET studentListHeader='$newStudentListHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update subjectListHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $subjectListHeaderExtension = pathinfo($_FILES['subjectListHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($subjectListHeaderExtension,$allowedExts)){
        $newSubjectListHeaderName = $branchId . uniqid() . '.' . $subjectListHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET subjectListHeader='$newSubjectListHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update terminalBroadSheetHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $terminalBroadSheetHeaderExtension = pathinfo($_FILES['terminalBroadSheetHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($terminalBroadSheetHeaderExtension,$allowedExts)){
        $newTerminalBroadSheetHeaderName = $branchId . uniqid() . '.' . $terminalBroadSheetHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET terminalBroadSheetHeader='$newTerminalBroadSheetHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update terminalResultSummaryHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $terminalResultSummaryHeaderExtension = pathinfo($_FILES['terminalResultSummaryHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($terminalResultSummaryHeaderExtension,$allowedExts)){
        $newTerminalResultSummaryHeaderName = $branchId . uniqid() . '.' . $terminalResultSummaryHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET terminalResultSummaryHeader='$newTerminalResultSummaryHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update terminalResultHeader
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $terminalResultHeaderExtension = pathinfo($_FILES['terminalResultHeader']['name'], PATHINFO_EXTENSION);
    if (in_array($terminalResultHeaderExtension,$allowedExts)){
        $newTerminalResultHeaderName = $branchId . uniqid() . '.' . $terminalResultHeader;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET terminalResultHeader='$newTerminalResultHeaderName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
    }
        ////update watermark
    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
    $watermarkExtension = pathinfo($_FILES['watermark']['name'], PATHINFO_EXTENSION);
    if (in_array($watermarkExtension,$allowedExts)){
        $newWatermarkName = $branchId . uniqid() . '.' . $watermark;
        mysqli_query($conn, "UPDATE `BRANCHES_TAB` SET watermark='$newWatermarkName' WHERE $clientIds AND branchId='$branchId'") or die (mysqli_error($conn));
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
        'schoolLogo'           => $newSchoolLogoName,
        'oldPrincipalSignature'=> $oldPrincipalSignature,
        'principalSignature'   => $newPrincipalSignatureName,
        'oldCaBroadSheetHeader' => $oldCaBroadSheetHeader,
        'caBroadSheetHeader'    => $newCaBroadSheetHeaderName,
        'oldCaResultSummaryHeader' => $oldCaResultSummaryHeader,
        'caResultSummaryHeader'    => $newCaResultSummaryHeaderName,
        'oldClassListHeader' => $oldClassListHeader,
        'classListHeader'    => $newClassListHeaderName,
        'oldCummulativeMarkBookHeader' => $oldCummulativeMarkBookHeader,
        'cummulativeMarkBookHeader'    => $newCummulativeMarkBookHeaderName,
        'oldMarkBookHeader' => $oldMarkBookHeader,
        'markBookHeader'    => $newMarkBookHeaderName,
        'oldMidTermResultHeader' => $oldMidTermResultHeader,
        'midTermResultHeader'    => $newMidTermResultHeaderName,
        'oldProgressReportHeader' => $oldProgressReportHeader,
        'progressReportHeader'    => $newProgressReportHeaderName,
        'oldScoreSheetHeader' => $oldScoreSheetHeader,
        'scoreSheetHeader'    => $newScoreSheetHeaderName,
        'oldStudentListHeader' => $oldStudentListHeader,
        'studentListHeader'    => $newStudentListHeaderName,
        'oldSubjectListHeader' => $oldSubjectListHeader,
        'subjectListHeader'    => $newSubjectListHeaderName,
        'oldTerminalBroadSheetHeader' => $oldTerminalBroadSheetHeader,
        'terminalBroadSheetHeader'    => $newTerminalBroadSheetHeaderName,
        'oldTerminalResultSummaryHeader' => $oldTerminalResultSummaryHeader,
        'terminalResultSummaryHeader'    => $newTerminalResultSummaryHeaderName,
        'oldTerminalResultHeader' => $oldTerminalResultHeader,
        'terminalResultHeader'    => $newTerminalResultHeaderName,
        'oldWatermark' => $oldWatermark,
        'watermark'    => $newWatermarkName,
    ]
];
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>