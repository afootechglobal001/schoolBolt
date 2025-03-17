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
    $staffId = $_GET['staffId'];
    $statusId = $_GET['statusId'];

    if (!empty($staffId)) {
        $staffIds = "AND staffId ='$staffId'";
    }
    if (!empty($statusId)) {
        $statusIds = "AND statusId IN ($statusId)";
    }
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select = "SELECT * FROM STAFF_VIEW WHERE (firstName LIKE '%$q%' OR middleName LIKE '%$q%' OR lastName LIKE '%$q%' OR mobileNumber LIKE '%$q%' OR address LIKE '%$q%') $staffIds  $statusIds ORDER BY firstName ASC";

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
    $response['message']="STAFF FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $firstName=$fetchQuery['firstName'];
        $lastName=$fetchQuery['lastName'];
        $fullName="$firstName $lastName";
        $fetchQuery['fullName']=$fullName;
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];

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
        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>