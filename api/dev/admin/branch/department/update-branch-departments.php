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
    $branchId = $_GET['branchId'];
    $departmentIds=$data['departmentIds'];
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(count($departmentIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "DEPARTMENTS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    /// delete existing records first
    mysqli_query($conn,"DELETE FROM `BRANCH_DEPARTMENTS_TAB` WHERE $clientIds AND branchId = '$branchId'")or die (mysqli_error($conn));

    foreach ($departmentIds as $eachId) {
        $departmentId = $eachId['departmentId'];
        mysqli_query($conn,"INSERT INTO `BRANCH_DEPARTMENTS_TAB`
        (`clientId`, `branchId`, `departmentId`, `createdBy`, `createdTime`) VALUES 
        ('$clientId', '$branchId', '$departmentId', '$loginStaffId', NOW())")or die (mysqli_error($conn));
    }

    $select = "SELECT * FROM BRANCH_DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $departmentIds_ .= $fetchQuery['departmentId'] . ",";
    }
    $departmentArray = !empty($departmentIds_) ? explode(',', rtrim($departmentIds_, ',')) : [];

    $select = "SELECT `name` AS branchName FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $branchName=$fetchQuery['branchName'];


    $select = "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds";
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
    $response['message']="BRANCH  DEPARTMENTS UPDATED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['branchId']=$branchId;
    $response['branchName']=$branchName;
    $response['departmentArray']=$departmentArray;
    $response['data'] = array(); // Initialize the data array

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $departmentId=$fetchQuery['departmentId'];
        $fetchQuery['checked'] = in_array($departmentId, $departmentArray);
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

