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
    $q = $_GET['q'];
    $roleId = $_GET['roleId'];

    if (!empty($roleId)) {
        // Ensure roleId is properly formatted for SQL
        $roleIdArray = explode(',', $roleId); // Split if multiple values
        $roleIdArray = array_map(function($id) use ($conn) {
            return "'" . mysqli_real_escape_string($conn, trim($id)) . "'";
        }, $roleIdArray); // Escape values for security

        $roleIds = "AND roleId IN (" . implode(',', $roleIdArray) . ")";
    }
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select = "SELECT * FROM ROLE_TAB WHERE $clientIds AND (roleName LIKE '%$q%' OR roleDescription LIKE '%$q%') $roleIds";

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
    $response['message']="ROLES FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $roleId=$fetchQuery['roleId'];
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];
        $rolePermissionIds=$fetchQuery['rolePermissionIds'];

        /////////////////// for  $createdBy
        $createdByData=array();
        $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
        while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
            $createdByData[] = $getCreatedByfetch;
        }
        $fetchQuery['createdBy']= $createdByData;

        /////////////////// for  $updatedBy
        $updatedByData=array();
        $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
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

        //// get number of users
        $userCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM STAFF_TAB WHERE $clientIds AND roleId='$roleId'");
        $userCountFetch = mysqli_fetch_assoc($userCountQuery);
        $fetchQuery['userCount'] = $userCountFetch['count']; // Assign the actual count value

        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>