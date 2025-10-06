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
    $staffId = $_GET['staffId'];
    $statusId = $_GET['statusId'];

    if (!empty($branchId)) {
        $branchIds = "AND branchId ='$branchId'";
    }
    if (!empty($staffId)) {
        $staffIds = "AND staffId ='$staffId'";
    }
    if (!empty($statusId)) {
        $statusIds = "AND statusId IN ($statusId)";
    }

    
    
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select = "SELECT * FROM STAFF_VIEW WHERE $clientIds AND (firstName LIKE '%$q%' OR middleName LIKE '%$q%' OR lastName LIKE '%$q%' OR mobileNumber LIKE '%$q%' OR address LIKE '%$q%') $staffIds  $statusIds $branchIds ORDER BY firstName ASC";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }
    /// get active staff count
    $activeStaffCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM STAFF_TAB WHERE $clientIds AND statusId=1");
    $activeStaffCountFetch = mysqli_fetch_assoc($activeStaffCountQuery);
    /// get number of suspended staff
    $suspendedStaffCountQuery = mysqli_query($conn, "SELECT COUNT(*) AS count FROM STAFF_TAB WHERE $clientIds AND statusId=2");
    $suspendedStaffCountFetch = mysqli_fetch_assoc($suspendedStaffCountQuery);


    $response['response']=200; 
    $response['success']=true;
    $response['message']="STAFF FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['activeStaffCount'] = $activeStaffCountFetch['count'];
    $response['suspendedStaffCount'] = $suspendedStaffCountFetch['count'];
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $titlId=$fetchQuery['titlId'];
        $firstName=$fetchQuery['firstName'];
        $lastName=$fetchQuery['lastName'];
        $fullName="$titlId $firstName $lastName";
        $fetchQuery['fullName']=$fullName;
         $branchId=$fetchQuery['branchId'];
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];

        $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, address, smtpUsername, mobileNumber, session, termId  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
        $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
        $termId=$branchDataFetch['termId'];
        $fetchQuery['branchData']=$branchDataFetch;

        /////////////////// for  $termId
        $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
        $termDataFetch = mysqli_fetch_assoc($termDataQuery);
        $fetchQuery['termData']=$termDataFetch;

        /////////////////// for  $createdBy
        $createdByData=array();
        $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
        while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
            $createdByData[] = $getCreatedByfetch;
        }
        $fetchQuery['createdBy']= $createdByData;

        /////////////////// for  $updatedBy
        $updatedByData=array();
        $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
        while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
            $updatedByData[] = $getUpdatedByfetch;
        }
        $fetchQuery['updatedBy']= $updatedByData;
        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>