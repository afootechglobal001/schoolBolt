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
	$roleName=trim(strtoupper($data['roleName']));
	$roleDescription=trim(strtoupper($data['roleDescription']));
	$rolePermissionIds=$data['rolePermissionIds'];
	////////////////////////////////////////////////////////////////////////////////

	if (empty($roleName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "ROLE NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($roleDescription)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ROLE DESCRIPTION REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(count($rolePermissionIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "ROLE PERMISSIONS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

   
			$query=mysqli_query($conn,"SELECT * FROM ROLE_TAB WHERE roleName='$roleName'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "ROLE EXIST! Role already exist by name. Check and try again.",
                ];
                goto end;
            }
            // Extract rolePermissionIds
            $rolePermissionIdsArray = array_column($data['rolePermissionIds'], 'rolePermissionId');
            // Convert array to comma-separated string
            $rolePermissionIds = implode(',', $rolePermissionIdsArray);

            ///////////////////////geting sequence//////////////////////////
            $sequence=$callclass->_get_sequence_count($conn, 'R');
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $roleId='R'.$no;


            mysqli_query($conn,"INSERT INTO `ROLE_TAB`
            (`roleId`, `roleName`, `roleDescription`, `rolePermissionIds`, `createdBy`, `createdTime`) VALUES 
            ('$roleId','$roleName', '$roleDescription', '$rolePermissionIds', '$loginStaffId', NOW() )")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="ROLE CREATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM ROLE_TAB WHERE roleId = '$roleId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
                $rolePermissionIds=$fetchQuery['rolePermissionIds'];

                /////////////////// for  $createdBy
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$createdBy'");
                $createdByData=array();
                while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
                    $createdByData[] = $getCreatedByfetch;
                }
                $fetchQuery['createdBy']= $createdByData;

                /////////////////// for  $updatedBy
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$updatedBy'");
                $updatedByData=array();
                while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
                    $updatedByData[] = $getUpdatedByfetch;
                }
                $fetchQuery['updatedBy']= $updatedByData;

                 /////////////////// for  $rolePermissionIds
                 $rolePermissionIdsData=array();
                 $getRolePermissionIdsQuery = mysqli_query($conn, "SELECT * FROM SETUP_ROLE_PERMISSION_TAB WHERE rolePermissionId IN ($rolePermissionIds)");
                 while ($getRolePermissionIdsfetch = mysqli_fetch_assoc($getRolePermissionIdsQuery)) {
                     $rolePermissionIdsData[] = $getRolePermissionIdsfetch;
                 }
                 $fetchQuery['rolePermissions']= $rolePermissionIdsData;

                 
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>