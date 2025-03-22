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
	$departmentId = $_GET['departmentId'];
    $classIds=$data['classIds'];
    
	////////////////////////////////////////////////////////////////////////////////
    if (empty($departmentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "DEPARTMENT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(count($classIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "CLASSES REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    /// delete existing records first
    mysqli_query($conn,"DELETE FROM `CLASS_STRUCTURE_TAB` WHERE $clientIds AND parentId = '$departmentId'")or die (mysqli_error($conn));


    foreach ($classIds as $eachId) {
        $classId = $eachId['classId'];
        mysqli_query($conn,"INSERT INTO `CLASS_STRUCTURE_TAB`
        (`clientId`, `parentId`, `childId`, `createdTime`) VALUES 
        ('$clientId', '$departmentId', '$classId', NOW())")or die (mysqli_error($conn));
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASDEPARTMENT CREATED SUCCESFFULY!"; 
            
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>