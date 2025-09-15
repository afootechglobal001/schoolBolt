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
    $feesId = $_GET['feesId'];
	$feesName=trim(strtoupper($_POST['feesName']));
	$feesOption=trim(strtoupper($_POST['feesOption']));
	
	////////////////////////////////////////////////////////////////////////////////
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
     if (empty($feesId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "FEES ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
	if (empty($feesName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "FEES NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($feesOption)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "FEES OPTION REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
   
			$query=mysqli_query($conn,"SELECT * FROM FEES_SETTINGS_TAB WHERE $clientIds  AND branchId='$branchId' AND feesName='$feesName' AND feesId!='$feesId'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "FEES EXIST! Fees already exist by name. Check and try again.",
                ];
                goto end;
            }
           

            mysqli_query($conn,"UPDATE `FEES_SETTINGS_TAB` SET
            `feesName`='$feesName', `feesOption`='$feesOption', updatedBy='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND feesId='$feesId'")or die (mysqli_error($conn));

             ////////////////// for  $branchId
            $branchDataQuery = mysqli_query($conn, "SELECT session AS currentSession, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
            $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
            $session=$branchDataFetch['currentSession'];
            $termId=$branchDataFetch['termId'];
            ////update FEES_COMPUTE_TAB
            mysqli_query($conn,"UPDATE `FEES_COMPUTE_TAB` SET
            `feesOption`='$feesOption', updatedBy='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND feesId='$feesId'")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="FEES UPDATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select = "SELECT * FROM FEES_SETTINGS_TAB WHERE $clientIds  AND branchId='$branchId' AND feesId='$feesId'";

            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $branchId=$fetchQuery['branchId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
            
                ////////////////// for  $branchId
                $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
                $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
                $response['branchData'] = $branchDataFetch;
                /////////////////// for  $createdBy
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
                $getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery);
                $fetchQuery['createdBy'] = $getCreatedByfetch;

                /////////////////// for  $updatedBy
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
                $getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery);
                $fetchQuery['updatedBy']= $getUpdatedByfetch;
                
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>