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
    $armIds=$data['armIds'];
    
	////////////////////////////////////////////////////////////////////////////////
    if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(count($armIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "ARMS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    /// delete existing records first
    mysqli_query($conn,"DELETE FROM `CLASS_STRUCTURE_TAB` WHERE $clientIds AND parentId = '$classId'")or die (mysqli_error($conn));


    foreach ($armIds as $eachId) {
        $armId = $eachId['armId'];
        mysqli_query($conn,"INSERT INTO `CLASS_STRUCTURE_TAB`
        (`clientId`, `parentId`, `childId`, `createdTime`) VALUES 
        ('$clientId', '$classId', '$armId', NOW())")or die (mysqli_error($conn));
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASS ARMS CREATED SUCCESFFULY!"; 
            
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>