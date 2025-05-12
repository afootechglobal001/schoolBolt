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
    $session=$_GET['session'];
    $termId=$_GET['termId'];
    $branchId = $_GET['branchId'];
	$departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $classFees=$data['classFees'];

    /////////////////////////////////////////////////////////////////////////
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($session)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "SESSION REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
        if (empty($termId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "TERM REQUIRED! Check the fields and try again",
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
    if (count($classFees)==0) {
			$response = [
				'response' => 102,
				'success' => false,
				'message' => 'FEES SEGMENT REQUIRED! Check field and try again.'
			];
			goto end;
		}

        ////// clear the previous classFees
         mysqli_query($conn,"DELETE FROM `FEES_COMPUTE_TAB` 
            WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId'")or die (mysqli_error($conn));
       
        $payableAmount=0;
        foreach ($classFees as $classFee) {
			$feesId = $classFee['feesId'];
			$amount = $classFee['amount'];

            ///// get feesOption
            $feesDataQuery = mysqli_query($conn, "SELECT feesOption FROM FEES_SETTINGS_TAB WHERE $clientIds AND branchId='$branchId' AND feesId='$feesId'");
            $feesDataFetch = mysqli_fetch_assoc($feesDataQuery);
            $feesOption = $feesDataFetch['feesOption'];
            if($amount!='' && $amount>0){
                /// Insert Into FEES_COMPUTE_TAB
                mysqli_query($conn,"INSERT INTO `FEES_COMPUTE_TAB`
                (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `feesId`, `feesOption`, `amount`, `createdBy`, `updatedBy`, `createdTime`) VALUES
                ('$clientId','$branchId', '$session', '$termId','$departmentId', '$classId', '$feesId', '$feesOption', '$amount', '$loginStaffId','$loginStaffId', NOW())")or die (mysqli_error($conn));

                $payableAmount=$payableAmount+$amount;
            }
			
		}

        ////// clear the previous summary
         mysqli_query($conn,"DELETE FROM `FEES_COMPUTE_SUMMARY_TAB` 
            WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId'")or die (mysqli_error($conn));
       

              ///////////////////////geting sequence//////////////////////////
            $countId='FCID';
            $sequence=$callclass->_get_sequence_count($conn, $countId);
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $fcId=$countId.$no.date("Ymdhis");

            /// insert to FEES_COMPUTE_SUMMARY_TAB
            mysqli_query($conn,"INSERT INTO `FEES_COMPUTE_SUMMARY_TAB`
            (`clientId`, `branchId`, `session`, `termId`, `departmentId`, `classId`, `fcId`, `payableAmount`, `statusId`, `updatedBy`,  `updatedTime`) VALUES
            ('$clientId','$branchId', '$session', '$termId','$departmentId', '$classId', '$fcId', '$payableAmount', 8, '$loginStaffId', NOW())")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="FEES COMPUTED SUCCESFFULY!"; 
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>