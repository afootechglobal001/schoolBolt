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
    $staffId = $_GET['staffId'];

    $select = "SELECT staffId FROM STAFF_TAB WHERE $clientIds AND branchId='$branchId' AND staffId='$staffId' AND statusId =2"; ///// only suspended staff can be deleted
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="NO RECORD FOUND OR STAFF IS ACTIVE, ONLY SUSPENDED STAFF CAN BE DELETED!";
        goto end;
    }
    
    mysqli_query($conn,"DELETE FROM STAFF_TAB WHERE $clientIds AND branchId='$branchId' AND staffId='$staffId'")or die (mysqli_error($conn));
    $response['response']=200; 
    $response['success']=true;
    $response['message']="STAFF DELETED SUCCESFFULY!";
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>