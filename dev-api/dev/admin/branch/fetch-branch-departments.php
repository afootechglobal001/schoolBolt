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

    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    $select = "SELECT * FROM BRANCH_DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $departmentIds .= $fetchQuery['departmentId'] . ",";
    }
    $departmentArray = !empty($departmentIds) ? explode(',', rtrim($departmentIds, ',')) : [];

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
    $response['message']="BRANCH  DEPARTMENTS FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['branchId']=$branchId;
    $response['branchName']=$branchName;
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

