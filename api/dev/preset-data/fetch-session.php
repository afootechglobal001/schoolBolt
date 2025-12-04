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
    $branchId = $_GET['branchId'];
    ////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH ID'); 
    $select="SELECT DISTINCT session FROM BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' ORDER BY session DESC";
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
    $response['message']="SESSION FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['data'] = array(); // Initialize the data array
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>