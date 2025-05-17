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
    mysqli_query($conn, "DELETE FROM PAYMENT_HISTORY_TEMP_TAB WHERE paymentId='$paymentId'")or die (mysqli_error($conn));
    
   /// confirm payment first
    mysqli_query($conn, "UPDATE PAYMENTS_TAB SET statusId=5, paydate=NOW() WHERE paymentId='$paymentId'")or die (mysqli_error($conn));
    
    ////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT * FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $secretKey=$branchDataFetch['secretKey'];
    $receiverKey=$branchDataFetch['receiverKey'];
   
    /////////////////// get schoolboltCharges
    $schoolboltChargesQuery = mysqli_query($conn, "SELECT schoolBoltCharges FROM PAYMENTS_TAB WHERE paymentId='$paymentId'");
    $schoolboltChargesFetch=mysqli_fetch_assoc($schoolboltChargesQuery);
    $schoolBoltCharges=$schoolboltChargesFetch['schoolBoltCharges'];

    if($schoolBoltCharges>0){
    //// for schoolBolt Charges
     mysqli_query($conn, "INSERT INTO `SCHOOLBOLT_CHARGES_TAB`
     (`clientId`, `branchId`, `paymentId`, `amount`, `statusId`, `createdTime`) VALUES 
    ('$clientId', '$branchId', '$paymentId', '$schoolBoltCharges', 3, NOW())") or die(mysqli_error($conn));
    }

    ////////////////// get parent email
    $query = mysqli_query($conn, "SELECT studentId, session, termId, email FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND paymentId='$paymentId'");
    $fetch = mysqli_fetch_assoc($query);
    $parentEmail=$fetch['email'];
    $studentId=$fetch['studentId'];
    $session=$fetch['session'];
    $termId=$fetch['termId'];
     ///////////////// get student details
    $query=mysqli_query($conn,"SELECT surName, firstName, otherNames FROM STUDENTS_TAB WHERE $clientIds AND studentId='$studentId'")or die (mysqli_error($conn));
    $fetch = mysqli_fetch_assoc($query);
    $studentSurName=$fetch['surName'];
    $studentFirstName=$fetch['firstName'];
    $studentOtherNames=$fetch['otherNames'];
    $studentFullname="$studentSurName $studentFirstName $studentOtherNames";

     /////////////////// for  $termId
    $termDataQuery = mysqli_query($conn, "SELECT termId, termName FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);
    $termName=$termDataFetch['termName'];

    ///////////////// get parent name
    $query=mysqli_query($conn,"SELECT titleId, surName, otherNames, address AS parentAddress, mobileNumber FROM PARENTS_TAB WHERE $clientIds AND email='$parentEmail'")or die (mysqli_error($conn));
    $fetch = mysqli_fetch_assoc($query);
    $parentTitle=$fetch['titleId'];
    $parentSurName=$fetch['surName'];
    $parentOtherNames=$fetch['otherNames'];
    $parentAddress=$fetch['parentAddress'];
    $parentMobileNumber=$fetch['mobileNumber'];
    $parentFullname="$parentTitle $parentSurName $parentOtherNames";
    /// send receipt
   require_once '../../mail/parent/payment-receipt.php';


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



end:
echo json_encode($response);
?>