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
	$classId = $_GET['classId'];
    $subjectIds=$data['subjectIds'];
    
	////////////////////////////////////////////////////////////////////////////////
    if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(count($subjectIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SUBJECTS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    /// delete existing records first
    mysqli_query($conn,"DELETE FROM `SUBJECT_STRUCTURE_TAB` 
    WHERE $clientIds AND classId = '$classId'")or die (mysqli_error($conn));


    $getSubjectsIdsArray = [];

    foreach ($subjectIds as $eachId) {
        $subjectId = $eachId['subjectId'];
        mysqli_query($conn, "INSERT INTO `SUBJECT_STRUCTURE_TAB`
            (`clientId`, `classId`, `subjectId`, `createdTime`) VALUES 
            ('$clientId', '$classId', '$subjectId', NOW())") or die(mysqli_error($conn));
    
        // Escape and quote string values
        $escapedId = mysqli_real_escape_string($conn, $subjectId);
        $getSubjectsIdsArray[] = "'$escapedId'";
    }
    
    $getSubjectsIds = implode(",", $getSubjectsIdsArray);
    
    // Delete from CLASS_SUBJECT_ALLOCATION_TAB if subjectId is not in the current list
    mysqli_query($conn, "DELETE FROM `CLASS_SUBJECT_ALLOCATION_TAB` 
        WHERE clientId = '$clientId' AND classId = '$classId' AND subjectId NOT IN ($getSubjectsIds)")
        or die(mysqli_error($conn));
    
    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASS SUBJECTS CREATED SUCCESFFULY!"; 
            
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>