<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
    $paymentId =trim($data['paymentId']);
    $branchId =trim($data['branchId']);

    /// all temp payment to PAYMENT_HISTORY_TAB
 $tempPaymentQuery=mysqli_query($conn,"SELECT * FROM PAYMENT_HISTORY_TEMP_TAB WHERE paymentId='$paymentId'")or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($tempPaymentQuery)) {
        $studentId= $fetchQuery['studentId'];
        $feesId= $fetchQuery['feesId'];
        $feesName= $fetchQuery['feesName'];
        $feesOption= $fetchQuery['feesOption'];
        $amount= $fetchQuery['amount'];
        //// INSERT TO  PAYMENT_HISTORY_TAB
        mysqli_query($conn, "INSERT INTO `PAYMENT_HISTORY_TAB`
        (`paymentId`, `studentId`, `feesId`, `feesName`, `feesOption`, `amount`) VALUES 
        ('$paymentId', '$studentId', '$feesId', '$feesName', '$feesOption','$amount')") or die(mysqli_error($conn));
    }
    /// Delete temp payment
    mysqli_query($conn, "DELETE FROM PAYMENT_HISTORY_TEMP_TAB WHERE $paymentId='$paymentId'")or die (mysqli_error($conn));
    
   /// confirm payment first
    mysqli_query($conn, "UPDATE PAYMENTS_TAB SET statusId=5, paydate=NOW() WHERE $paymentId='$paymentId'")or die (mysqli_error($conn));
    
    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT * FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $secretKey=$branchDataFetch['secretKey'];
    $receiverKey=$branchDataFetch['receiverKey'];
   
    /////////////////// get schoolboltCharges
    $schoolboltChargesQuery = mysqli_query($conn, "SELECT schoolBoltCharges FROM PAYMENTS_TAB WHERE $paymentId='$paymentId'");
    $schoolboltChargesFetch=mysqli_fetch_assoc($schoolboltChargesQuery);
    $schoolBoltCharges=$schoolboltChargesFetch['schoolBoltCharges'];

    if($schoolBoltCharges>0){
    //// for schoolBolt Charges
     mysqli_query($conn, "INSERT INTO `SCHOOLBOLT_CHARGES_TAB`
     (`clientId`, `branchId`, `paymentId`, `amount`, `statusId`, `createdTime`) VALUES 
    ('$clientId', '$branchId', '$paymentId', '$schoolBoltCharges', 3, NOW())") or die(mysqli_error($conn));
    }
   
if($paymentMethodId=='PM001'){ /// DEBIT/CREDIT CARD
     $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> 'PAYMENT SUCCESSFUL. Proceed to your payment history.',
        'secretKey'=> $secretKey,
        'charges'=> ($schoolBoltCharges-10)*100,
        'paymentId'=> $paymentId,
        'receiverKey'=> $receiverKey,
        'reason'=> 'SchoolBolt Charges',
    ];
}

if($paymentMethodId=='PM002'){ /// BANK TRANSFER
     $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> 'ACOUNT VERIFIED FOR PAYMENT. Proceed to payment.',
        'amount'=> $totalAmount,
        'accountName'=> $accountName,
        'accountNumber'=> $accountNumber,
        'bankName'=> $bankName,
        'branchNumber'=> $mobileNumber,
    ];
}
end:
echo json_encode($response);
?>