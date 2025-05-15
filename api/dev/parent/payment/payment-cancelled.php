<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
    $paymentId =trim($data['paymentId']);
    
   /// update PAYMENTS_TAB
    mysqli_query($conn, "UPDATE PAYMENTS_TAB SET statusId=4, paydate=NOW() WHERE $paymentId='$paymentId'")or die (mysqli_error($conn));
     $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> 'PAYMENT CANCELLED. Kindly try again.',
    ];

end:
echo json_encode($response);
?>