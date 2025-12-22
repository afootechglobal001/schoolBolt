<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$parentTypeId =trim($data['parentTypeId']);
	$email=trim($data['email']);
	////////////////////////////////////////////////////////////////////////////////

	if (empty($parentTypeId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PARENT TYPE REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}

    if(empty($email)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "EMAIL REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "INVALID EMAIL ADDRESS! Enter a valid email address and try again",
        ]; 
        goto end;
	}
   
    $select=mysqli_query($conn,"SELECT * FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email' AND statusId=1 LIMIT 1") or die (mysqli_error($conn));
			$countUser=mysqli_num_rows($select);
            if ($countUser==0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "INVALID LOGIN CREDIENTIALS! Kindly check the login parameters and try again.",
                ];
                goto end;
            }

                $fetchQuery=mysqli_fetch_assoc($select);
                $statusId=$fetchQuery['statusId'];
                $branchId=$fetchQuery['branchId'];
                $titleId=$fetchQuery['titleId'];
                $surName=$fetchQuery['surName'];
                $otherNames=$fetchQuery['otherNames'];
                $parentFullname="$titleId $surName $otherNames";
                
                if($statusId!=1){
                    $response = [
                        'response'=> 102,
                        'success'=> false,
                        'message'=> "ACCOUNT SUSPENDED! Contact the administrator for more info.",
                    ];
                    goto end;
                }

                /// delete the previous record
			mysqli_query($conn,"DELETE FROM `EMAIL_VERIFICATION_TAB` WHERE email='$email'");
			/// Generate otp
			$otp = rand(111111,999999);
			/// Insert new record for verification
			mysqli_query($conn,"INSERT INTO `EMAIL_VERIFICATION_TAB`
			(`email`, `otp`) VALUES
			('$email',  '$otp')")or die (mysqli_error($conn));
                /// send receipt
                require_once '../../mail/parent/email-verification.php';

                $response['response']=200; 
                $response['success']=true;
                $response['message']="MAIL SENT SUCCESSFUL!";
                $response['email']=$email;
                $response['parentTypeId']=$parentTypeId;
                $response['parentFullname']=$parentFullname;

			  
            
end:
echo json_encode($response);
?>