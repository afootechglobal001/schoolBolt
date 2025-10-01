<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
     $email = $_GET['email'];
     $newPassword=($data['newPassword']);
     $cnewPassword=($data['cnewPassword']);
    
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($email, 'EMAIL'); 
    validateEmptyField($newPassword, 'NEW PASSWORD');
    validateEmptyField($cnewPassword, 'CONFIRM NEW PASSWORD');
	////////////////////////////////////////////////////////////////////////////////
    $newPassword=md5($data['newPassword']);
    $cnewPassword=md5($data['cnewPassword']);
    if ($newPassword!=$cnewPassword){ /// start if 4
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "NEW PASSWORD NOT MATCH! Check and try again.",
        ];
        goto end;
    }
    $query=mysqli_query($conn,"SELECT * FROM STAFF_VIEW WHERE $clientIds AND emailAddress='$email'") or die (mysqli_error($conn));
    $countUser=mysqli_num_rows($query);

    if ($countUser==0){ /// start if 4
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "USER DOES NOT EXIST! Kindly check the email and try again.",
        ];
        goto end;
    }

        $fetchQuery=mysqli_fetch_array($query);
        $staffId=$fetchQuery['staffId']; 
        $statusId=$fetchQuery['statusId'];
       
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
        mysqli_query($conn,"UPDATE STAFF_TAB SET accessKey='$accessKey', password='$newPassword'  WHERE $clientIds AND staffId='$staffId'") or die (mysqli_error($conn));

        $response['response']=200; 
        $response['success']=true;
        $response['message']="PASSWORD RESET SUCCESSFULLY!";

        
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>