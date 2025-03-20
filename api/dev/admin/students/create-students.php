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
	$surName=trim(strtoupper($_POST['surName']));
    $firstName=trim(strtoupper($_POST['firstName']));
    $otherNames=trim(strtoupper($_POST['otherNames']));
    $genderId=trim($_POST['genderId']);
    $maritalStatusId=trim($_POST['maritalStatusId']);
    $dateOfBirth=trim($_POST['dateOfBirth']);
    $countryId=trim($_POST['countryId']);
    $stateId=trim($_POST['stateId']);
    $lgaId=trim($_POST['lgaId']);
    $address =trim(strtoupper(str_replace("'", "\'", $_POST['address'])));
    $email=trim($_POST['email']);
	$mobileNumber=trim($_POST['mobileNumber']);
    $passport=trim($_POST['passport']);

    $fatherTitleId=trim($_POST['fatherTitleId']);
    $fatherSurName=trim(strtoupper($_POST['fatherSurName']));
    $fatherOtherNames=trim(strtoupper($_POST['fatherOtherNames']));
    $fatherAddress =trim(strtoupper(str_replace("'", "\'", $_POST['fatherAddress'])));
    $fatherEmail=trim($_POST['fatherEmail']);
	$fatherMobileNumber=trim($_POST['fatherMobileNumber']);
	$fatherDayOfBirth=trim($_POST['fatherDayOfBirth']);
    $fatherMonthOfBirth=trim($_POST['fatherMonthOfBirth']);
    $fatherOccupation=trim(strtoupper($_POST['fatherOccupation']));

    $motherTitleId=trim($_POST['motherTitleId']);
    $motherSurName=trim(strtoupper($_POST['motherSurName']));
    $motherOtherNames=trim(strtoupper($_POST['motherOtherNames']));
    $motherAddress =trim(strtoupper(str_replace("'", "\'", $_POST['motherAddress'])));
    $motherEmail=trim($_POST['motherEmail']);
	$motherMobileNumber=trim($_POST['motherMobileNumber']);
	$motherDayOfBirth=trim($_POST['motherDayOfBirth']);
    $motherMonthOfBirth=trim($_POST['motherMonthOfBirth']);
    $motherOccupation=trim(strtoupper($_POST['motherOccupation']));

    
    $studentOfficialId=trim(strtoupper($_POST['studentOfficialId']));
    $departmentId=trim($_POST['departmentId']);
    $classId=trim($_POST['classId']);
    $armId=trim($_POST['armId']);
    $accommodationId=trim($_POST['accommodationId']);
   
    $statusId=trim($_POST['statusId']);

    
	////////////////////////////////////////////////////////////////////////////////

	if (empty($surName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STUDENT SURNAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($firstName)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "STUDENT FIRST NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($otherNames)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT ORTHER NAMES REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($genderId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT GENDER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($maritalStatusId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "MARITAL STATUS REQUIRED! Check the fields and try again",
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
    if(empty($countryId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT COUNTRY REQUIRED! Check the fields and try again",
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
    if(empty($departmentId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT DEPARTMENT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($classId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT CLASS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($armId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "STUDENT ARM REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($accommodationId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "ACCOMMODATION REQUIRED! Check the fields and try again",
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

        if(($emailAddress) && (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID STUDENT EMAIL ADDRESS! Enter a valid email address and try again",
            ]; 
            goto end;
        }

        if(($fatherEmail) && (!filter_var($fatherEmail, FILTER_VALIDATE_EMAIL))){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID FATHER EMAIL ADDRESS! Enter a valid email address and try again",
            ]; 
            goto end;
        }
        if(($motherEmail) && (!filter_var($motherEmail, FILTER_VALIDATE_EMAIL))){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID MOTHER EMAIL ADDRESS! Enter a valid email address and try again",
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