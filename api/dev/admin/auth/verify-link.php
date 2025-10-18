<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
     $ref = $_GET['ref'];
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($ref, 'REF'); 

    $query=mysqli_query($conn,"SELECT * FROM STAFF_VIEW WHERE $clientIds AND accessKey='$ref'") or die (mysqli_error($conn));
    $countUser=mysqli_num_rows($query);

    if ($countUser==0){ /// start if 4
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "LINK EXPIRED! Proceed to reset your password again",
        ];
        goto end;
    }

        $fetchQuery=mysqli_fetch_array($query);
        $staffId=$fetchQuery['staffId']; 
        $statusId=$fetchQuery['statusId'];
        $email=$fetchQuery['emailAddress'];
       
        if($statusId!=1){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "ACCOUNT ERROR! Contact the administrator for more info.",
            ];
            goto end;
        }

        /// Generate login access key
        $accessKey=trim(md5($staffId.date("Ymdhis")));
        /// update user on staff_tab
        mysqli_query($conn,"UPDATE STAFF_TAB SET accessKey='$accessKey', lastLoginTime=NOW() WHERE $clientIds AND staffId='$staffId'")or die (mysqli_error($conn));

        $response['response']=200; 
        $response['success']=true;
        $response['message']="EMAIL VERIFICATION LINK SENT!";
        $response['email']=$email;

        
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>