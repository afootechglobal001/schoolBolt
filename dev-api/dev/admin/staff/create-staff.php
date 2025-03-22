<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/staff-session-check.php';?>
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
	$firstName=trim(strtoupper($data['firstName']));
    $middleName=trim(strtoupper($data['middleName']));
    $lastName=trim(strtoupper($data['lastName']));
    $emailAddress=trim($data['emailAddress']);
	$mobileNumber=trim($data['mobileNumber']);
    $genderId=trim($data['genderId']);
    $dateOfBirth=trim($data['dateOfBirth']);
	$stateId=trim($data['stateId']);
    $lgaId=trim($data['lgaId']);
    $address =trim(strtoupper(str_replace("'", "\'", $data['address'])));
    $branchId=trim($data['branchId']);
    $roleId=trim($data['roleId']);
    $statusId=trim($data['statusId']);

    
	////////////////////////////////////////////////////////////////////////////////

	if (empty($firstName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "FIRST NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($middleName)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "MIDDLE NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($lastName)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "LAST NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($emailAddress)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "EMAIL REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($mobileNumber)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "PHONE NUMBER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($genderId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STAFF GENDER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($dateOfBirth)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "DATE OF BIRTH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($stateId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STATE OF ORIGIN REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($lgaId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "LOCAL GOVT AREA REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($address)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "ADDRESS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($branchId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($roleId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STAFF ROLE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($statusId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STATUS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

        if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID EMAIL ADDRESS! Enter a valid email address and try again",
            ]; 
            goto end;
        }
       
   
			$query=mysqli_query($conn,"SELECT * FROM STAFF_TAB WHERE $clientIds AND emailAddress='$emailAddress'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "ACCOUNT EXIST! Account already exist by email. Check and try again.",
                ];
                goto end;
            }

            ///////////////////////geting sequence//////////////////////////
            $countId='STAFF';
            $sequence=$callclass->_get_sequence_count($conn, $countId);
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $staffId=$countId.$no.date("Ymdhis");
            $password=md5($staffId);

            
            mysqli_query($conn,"INSERT INTO `STAFF_TAB`
            (`clientId`, `staffId`, `firstName`, `middleName`, `lastName`, `emailAddress`, `mobileNumber`, `genderId`, `dateOfBirth`, `stateId`, `lgaId`, `address`, `branchId`, `roleId`, `statusId`, `password`, `createdBy`, `createdTime`) VALUES 
            ('$clientId', '$staffId','$firstName', '$middleName', '$lastName', '$emailAddress', '$mobileNumber', '$genderId', '$dateOfBirth', '$stateId', '$lgaId', '$address', '$branchId', '$roleId', '$statusId', '$password', '$loginStaffId', NOW())")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="STAFF CREATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM STAFF_VIEW WHERE $clientIds AND staffId = '$staffId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
        
                /////////////////// for  $createdBy
                $createdByData=array();
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
                while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
                    $createdByData[] = $getCreatedByfetch;
                }
                $fetchQuery['createdBy']= $createdByData;
        
                /////////////////// for  $updatedBy
                $updatedByData=array();
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
                while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
                    $updatedByData[] = $getUpdatedByfetch;
                }
                $fetchQuery['updatedBy']= $updatedByData;
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>