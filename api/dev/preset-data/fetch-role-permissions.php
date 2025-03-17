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
    $roleId = $_GET['roleId'];
    if($roleId){
    $select = "SELECT rolePermissionIds FROM ROLE_TAB WHERE roleId= '$roleId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $rolePermissionIds=$fetchQuery['rolePermissionIds'];
    $rolePermissionArray = explode(',', $rolePermissionIds);
    }else{
        $rolePermissionArray=[];
    }

    $select="SELECT * FROM SETUP_ROLE_PERMISSION_TAB";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));

    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }


    $response['response']=200; 
    $response['success']=true;
    $response['message']="ROLE CREATED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $rolePermissionId=$fetchQuery['rolePermissionId'];
        $fetchQuery['checked'] = in_array($rolePermissionId, $rolePermissionArray);
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>