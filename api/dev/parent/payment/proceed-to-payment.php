<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
    $session =trim($data['session']);
    $termId =trim($data['termId']);
	$studentId =trim($data['studentId']);
	$branchId=trim($data['branchId']);
	$departmentId=trim($data['departmentId']);
    $classId=trim($data['classId']);
    $armId=trim($data['armId']);
    $feesIds=$data['feesIds'];
    $paymentMethodId=trim($data['paymentMethodId']);
    $email=$data['email']; //// parent email
	////////////////////////////////////////////////////////////////////////////////

	if (empty($session)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "SESSION REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}
    if (empty($termId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "TERM REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}
    if (empty($studentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STUDENT ID REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}

    if(empty($branchId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}

    if(empty($departmentId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "DEPARTMENT REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(empty($classId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "CLASS REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(empty($armId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ARM REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(count($feesIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "AT LEAST ONE FEE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($paymentMethodId)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "PAYMENT METHOD REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
    if(empty($email)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "PARENT EMAIL REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}

    $feesComputeSummaryQuery=mysqli_query($conn,"SELECT * FROM FEES_COMPUTE_SUMMARY_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND statusId=9")or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($feesComputeSummaryQuery);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record Found: Fees Compute Not Done or Approved.";
        goto end;
    }

    if($paymentMethodId=='PM001'){
        $paymentChannel='card';
    }else if($paymentMethodId=='PM002'){
        $paymentChannel='bank_transfer';
    }else{
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "INVALID PAYMENT METHOD! Check password fields and try again",
        ]; 
        goto end;
    }



    /////////////////// get paymentId
    $getPaymentIdQuery = mysqli_query($conn, "SELECT paymentId FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND studentId='$studentId'  AND statusId IN (3,4)"); //PENDING or CANCELLED
    $getPaymentIdFetch = mysqli_fetch_assoc($getPaymentIdQuery);
    $previousPaymentId=$getPaymentIdFetch['paymentId'];
    if($previousPaymentId){
         mysqli_query($conn, "DELETE FROM PAYMENTS_TAB WHERE paymentId='$previousPaymentId'");
         mysqli_query($conn, "DELETE FROM PAYMENT_HISTORY_TEMP_TAB WHERE paymentId='$previousPaymentId'");
    }

    ///////////////////////geting sequence//////////////////////////
    $countId='PAY';
    $sequence=$callclass->_get_sequence_count($conn, $countId);
    $array = json_decode($sequence, true);
    $no= $array[0]['no'];
    $paymentId=$countId.$no.date("Ymdhis");

     foreach ($feesIds as $eachId) {
        $feesId = $eachId['feesId'];
        /////////////////// for  $feesId
        $feesSettingsDataQuery = mysqli_query($conn, "SELECT feesName FROM FEES_SETTINGS_TAB WHERE $clientIds AND branchId='$branchId' AND feesId='$feesId'");
        $feesSettingsDataFetch = mysqli_fetch_assoc($feesSettingsDataQuery);
        $feesName = $feesSettingsDataFetch['feesName'];
        /////////////////// for  $feesId
        $feesDataQuery = mysqli_query($conn, "SELECT * FROM FEES_COMPUTE_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND feesId='$feesId'");
        $feesDataFetch = mysqli_fetch_assoc($feesDataQuery);
        $feesOption = $feesDataFetch['feesOption'];
        $amount = $feesDataFetch['amount'];

        mysqli_query($conn, "INSERT INTO `PAYMENT_HISTORY_TEMP_TAB`
        (`paymentId`, `studentId`, `feesId`, `feesName`, `feesOption`, `amount`, `createdTime`) VALUES 
        ('$paymentId', '$studentId', '$feesId', '$feesName', '$feesOption', '$amount', NOW())") or die(mysqli_error($conn));

        $totalMandatoryFees +=$feesOption==='TRUE' ? $amount:0;
        $totalNotMandatoryFee +=$feesOption==='FALSE' ? $amount:0;
    }

    /////////////////// get previous successfull payment true credit card or bank transfer
    $schoolboltChargesQuery = mysqli_query($conn, "SELECT paymentId FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND studentId='$studentId'  AND statusId=5 AND (paymentMethodId='PM001' OR paymentMethodId='PM002')") or die (mysqli_error($conn));
    $previousSchoolboltCharges=mysqli_num_rows($schoolboltChargesQuery);
    $schoolBoltCharges=$previousSchoolboltCharges>0 ? 0 : ($schoolBoltChargesStatus==1 ? $schoolBoltCharges : 0);
    //$deductCharges=$schoolBoltCharges>0 ? true: false;
    $deductCharges=false;
    $totalFeesPaid=$totalMandatoryFees+$totalNotMandatoryFee;
    $totalAmount=$totalFeesPaid+$schoolBoltCharges;

    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT * FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $paymentKey=$branchDataFetch['paymentKey'];
    $receiverKey=$branchDataFetch['receiverKey'];
    $accountNumber=$branchDataFetch['accountNumber'];
    $accountName=$branchDataFetch['accountName'];
    $bankName=$branchDataFetch['bankName'];
    $mobileNumber=$branchDataFetch['mobileNumber'];



    mysqli_query($conn, "INSERT INTO `PAYMENTS_TAB`
    (`paymentId`, `clientId`, `session`, `termId`, `branchId`, `studentId`, `departmentId`, `classId`, `armId`, `totalMandatoryFees`, `totalNotMandatoryFee`, `schoolBoltCharges`, `totalFeesPaid`, `totalAmount`, `paymentMethodId`, `paymentKey`, `email`, `statusId`, `createdTime`) VALUES  
    ('$paymentId', '$clientId', '$session', '$termId', '$branchId', '$studentId', '$departmentId', '$classId', '$armId', '$totalMandatoryFees', '$totalNotMandatoryFee', '$schoolBoltCharges', '$totalFeesPaid', '$totalAmount', '$paymentMethodId', '$paymentKey', '$email', 3, NOW())") or die(mysqli_error($conn));
    
    if($schoolBoltCharges>0){
        //// for schoolBolt Charges
        mysqli_query($conn, "INSERT INTO `SCHOOLBOLT_CHARGES_TAB`
        (`clientId`, `branchId`, `paymentId`, `amount`, `statusId`, `createdTime`) VALUES 
        ('$clientId', '$branchId', '$paymentId', '$schoolBoltCharges', 3, NOW())") or die(mysqli_error($conn));
    }

   
     $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> 'ACOUNT VERIFIED FOR PAYMENT. Proceed to payment.',
        'paymentKey'=> $paymentKey,
        'paymentId'=> $paymentId,
        'email'=> $email,
        'amount'=> $totalAmount*100,
        'paymentMethodId'=> $paymentMethodId,
        'deductCharges'=> $deductCharges,
        'schoolBoltCharges'=> $schoolBoltCharges*100,
        'receiverKey'=> $receiverKey,
        'paymentChannel'=> $paymentChannel,
    ];


// if($paymentMethodId=='PM001'){ /// DEBIT/CREDIT CARD
//      $response = [
//         'response'=> 200,
//         'success'=> true,
//         'message'=> 'ACOUNT VERIFIED FOR PAYMENT. Proceed to payment.',
//         'paymentKey'=> $paymentKey,
//         'paymentId'=> $paymentId,
//         'email'=> $email,
//         'amount'=> $totalAmount*100,
//         'paymentMethodId'=> $paymentMethodId,
//         'deductCharges'=> $deductCharges,
//         'schoolBoltCharges'=> $schoolBoltCharges*100,
//         'receiverKey'=> $receiverKey,
//     ];
// }

// if($paymentMethodId=='PM002'){ /// BANK TRANSFER
//      $response = [
//         'response'=> 200,
//         'success'=> true,
//         'message'=> 'ACOUNT VERIFIED FOR PAYMENT. Proceed to payment.',
//         'amount'=> $totalAmount,
//         'accountName'=> $accountName,
//         'accountNumber'=> $accountNumber,
//         'bankName'=> $bankName,
//         'branchNumber'=> $mobileNumber,
//         'paymentMethodId'=> $paymentMethodId,
//     ];
// }
end:
echo json_encode($response);
?>