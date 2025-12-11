<?php require_once '../config/connection.php';?>
<?php require_once '../config/staff-session-check.php';?>
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
    $newSession = trim($data['newSession']);
    $newTermId = trim($data['newTermId']);
    
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($newSession, 'SESSION');
    validateEmptyField($newTermId, 'TERM');
    //////////////////////////////////////////////////////////////////////////////////

    /////get current session and term for the branch
    $select = "SELECT `session`, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId= '$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $currentSession=$fetchQuery['session'];
    $currentTermId=$fetchQuery['termId'];
    if($currentSession==$newSession && $currentTermId==$newTermId){
        $response['response']=200;
        $response['success']=false;
        $response['message']="The selected session and term is the same as the current session and term!";
        goto end;
    }
    ////check if results for the selected new session and term have been published on PUBLISHED_RESULTS_TAB
    $selectPublished="SELECT * 
    FROM PUBLISHED_RESULTS_TAB 
    WHERE $clientIds 
    AND branchId='$branchId' 
    AND session='$newSession'
    AND termId='$newTermId'";
    $queryPublished=mysqli_query($conn,$selectPublished)or die (mysqli_error($conn));
    $numRowsPublished=mysqli_num_rows($queryPublished);
    if($numRowsPublished>0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="Results for the selected session and term have already been published!";
        goto end;
    }

////check if results for the current session and term have been published on PUBLISHED_RESULTS_TAB
    $selectPublished="SELECT * 
    FROM PUBLISHED_RESULTS_TAB 
    WHERE $clientIds 
    AND branchId='$branchId' 
    AND session='$currentSession'
    AND termId='$currentTermId'";
    $queryPublished=mysqli_query($conn,$selectPublished)or die (mysqli_error($conn));
    $numRowsPublished=mysqli_num_rows($queryPublished);
    if($numRowsPublished>0){
        ///update the published session and term to the new session and term
        $update="UPDATE PUBLISHED_RESULTS_TAB 
        SET republishedBy='$loginStaffId'
        WHERE $clientIds 
        AND branchId='$branchId'
        AND session='$currentSession'
        AND termId='$currentTermId'";
        mysqli_query($conn,$update)or die (mysqli_error($conn));
    }else{
        ///insert new published session and term to PUBLISHED_RESULTS_TAB
        $insert="INSERT INTO PUBLISHED_RESULTS_TAB
        (clientId, branchId, session, termId, publishedBy, createdTime) VALUES
        ('$clientId', '$branchId', '$currentSession', '$currentTermId', '$loginStaffId', NOW())";
        mysqli_query($conn,$insert)or die (mysqli_error($conn));

    }

   
    ///// update the branch current session and term to the new session and term
    $updateBranch="UPDATE BRANCHES_TAB SET
    session='$newSession',
    termId='$newTermId'
    WHERE $clientIds AND branchId='$branchId'";
    mysqli_query($conn,$updateBranch)or die (mysqli_error($conn));

    $response['response']=200;
    $response['success']=true;
    $response['message']="Results published successfully!";
   
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>