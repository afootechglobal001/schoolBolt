<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$userName=trim($data['userName']);
	$p_password=$data['password'];
	$password=md5($p_password);
	////////////////////////////////////////////////////////////////////////////////

	if (empty($userName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "USERNAME REQUIRED! Check username fields and try again",
        ]; 
        goto end;
	}

    if(empty($p_password)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "PASSWORD REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}

    if(!filter_var($userName, FILTER_VALIDATE_EMAIL)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "INVALID EMAIL ADDRESS! Enter a valid email address and try again",
        ]; 
        goto end;
	}

			$query=mysqli_query($conn,"SELECT * FROM STAFF_VIEW WHERE $clientIds AND emailAddress='$userName' AND `password`='$password'") or die (mysqli_error($conn));
			$countUser=mysqli_num_rows($query);

            if ($countUser==0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "INVALID USERNAME OR PASSWORD! Kindly check the login parameters and try again.",
                ];
                goto end;
            }

                $fetchQuery=mysqli_fetch_array($query);
                $staffId=$fetchQuery['staffId']; 
                $statusId=$fetchQuery['statusId'];

                if($statusId==2){
                    $response = [
                        'response'=> 102,
                        'success'=> false,
                        'message'=> "ACCOUNT SUSPENDED! Contact the administrator for more info.",
                    ];
                    goto end;
                }

                if($statusId==1){ /// start if 5 (check if the user is active)
                    /// Generate login access key
                    $accessKey=trim(md5($staffId.date("Ymdhis")));
                    /// update user on staff_tab
                    mysqli_query($conn,"UPDATE STAFF_TAB SET accessKey='$accessKey', lastLoginTime=NOW() WHERE $clientIds AND staffId='$staffId'")or die (mysqli_error($conn));

                    $response['response']=200; 
                    $response['success']=true;
                    $response['message']="LOGIN SUCCESSFUL!"; 
                    $response['data'] = array(); // Initialize the data array

                    $select="SELECT * FROM STAFF_VIEW WHERE $clientIds AND staffId = '$staffId'";

                    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
                    while ($fetchQuery = mysqli_fetch_assoc($query)) {
                        $firstName=$fetchQuery['firstName'];
                        $lastName=$fetchQuery['lastName'];
                        $fullName="$firstName $lastName";
                        $fetchQuery['fullName']=$fullName;
                        $response['data'][] = $fetchQuery;
                    }
                }else {
                    $response = [
                        'response'=> 102,
                        'success'=> false,
                        'message'=> "ACCOUNT UNDER REVIEW! Contact the administrator for more info.",
                    ];
                    goto end;
                }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>