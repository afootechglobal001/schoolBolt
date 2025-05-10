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
	$departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $feesId=trim(strtoupper($_POST['feesId']));
	$amount=trim(($_POST['amount']));

    /////////////////////////////////////////////////////////////////////////
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($departmentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "DEPARTMENT iD REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS ID REQUIRED! Check the fields and try again",
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

    if(empty($amount)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "AMOUNT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
   
    $select = "SELECT * FROM FEES_COMPUTE_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND feesId='$feesId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount>0){///start if 1
         mysqli_query($conn,"UPDATE `FEES_COMPUTE_TAB` SET
            `amount`='$amount', updatedBy='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND feesId='$feesId'")or die (mysqli_error($conn));
    }else{

        ///////////////////////geting sequence//////////////////////////
        $countId='FCID';
        $sequence=$callclass->_get_sequence_count($conn, $countId);
        $array = json_decode($sequence, true);
        $no= $array[0]['no'];
        $fcId=$countId.$no.date("Ymdhis");


        mysqli_query($conn,"INSERT INTO `FEES_COMPUTE_TAB`
        (`clientId`, `branchId`, `departmentId`, `classId`, `fcId`, `feesId`, `amount`, `createdBy`, `updatedBy`, `createdTime`) VALUES
        ('$clientId','$branchId','$departmentId', '$classId', '$fcId', '$feesId', '$amount', '$loginStaffId','$loginStaffId', NOW())")or die (mysqli_error($conn));

    }
           

            

            $response['response']=200; 
            $response['success']=true;
            $response['message']="FEES COMPUTED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select = "SELECT * FROM FEES_COMPUTE_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $feesId=$fetchQuery['feesId'];
                /////////////////// for  $feesId
                $feesDataQuery = mysqli_query($conn, "SELECT * FROM FEES_SETTINGS_TAB WHERE $clientIds AND branchId='$branchId' AND feesId='$feesId'");
                $feesDataFetch = mysqli_fetch_assoc($feesDataQuery);
                $fetchQuery['feesData'] = $feesDataFetch;

                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>