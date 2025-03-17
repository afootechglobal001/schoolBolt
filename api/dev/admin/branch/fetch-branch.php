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
    $q = $_GET['q'];
    $branchId = $_GET['branchId'];
    $statusId = $_GET['statusId'];

    if (!empty($branchId)) {
        $branchIds = "AND branchId ='$branchId'";
    }
    if (!empty($statusId)) {
        $statusIds = "AND statusId IN ($statusId)";
    }
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select = "SELECT * FROM BRANCH_VIEW WHERE (name LIKE '%$q%' OR address LIKE '%$q%') $branchIds  $statusIds ORDER BY name ASC";

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
    $response['message']="BRANCH FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $branchId=$fetchQuery['branchId'];
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];
        $rolePermissionIds=$fetchQuery['rolePermissionIds'];
        $termId=$fetchQuery['termId'];

        /////////////////// for  $termId
        $getTermQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
        $termData=array();
        while ($getTermFetch = mysqli_fetch_assoc($getTermQuery)) {
            $termData[] = $getTermFetch;
        }
        $fetchQuery['termData']= $termData;

        /////////////////// for  $createdBy
        $createdByData=array();
        $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$createdBy'");
        while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
            $createdByData[] = $getCreatedByfetch;
        }
        $fetchQuery['createdBy']= $createdByData;

        /////////////////// for  $updatedBy
        $updatedByData=array();
        $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$updatedBy'");
        while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
            $updatedByData[] = $getUpdatedByfetch;
        }
        $fetchQuery['updatedBy']= $updatedByData;

      
        //// get number of staf
        $userCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM STAFF_TAB WHERE branchId='$branchId'");
        $userCountFetch = mysqli_fetch_assoc($userCountQuery);
        $fetchQuery['totalNumberOfStaff'] = $userCountFetch['count']; // Assign the actual count value

        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>