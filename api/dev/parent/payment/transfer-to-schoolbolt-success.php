<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
    $paymentId =trim($data['paymentId']);
    mysqli_query($conn, "UPDATE SCHOOLBOLT_CHARGES_TAB SET statusId=5 WHERE $paymentId='$paymentId'")or die (mysqli_error($conn));
     $response = [
        'response'=> 200,
        'success'=> true,
        'message'=> 'PAYMENT SUCCESSFUL. Proceed to your payment history.', 
    ];
end:
echo json_encode($response);
?>