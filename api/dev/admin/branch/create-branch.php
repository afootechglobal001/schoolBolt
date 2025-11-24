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
    $schoolCategoryId=trim($data['schoolCategoryId']);
	$name=trim(strtoupper($data['name']));
	$mobileNumber=trim($data['mobileNumber']);
	$stateId=trim($data['stateId']);
    $lgaId=trim($data['lgaId']);
    $address =trim(strtoupper(str_replace("'", "\'", $data['address'])));
    $smtpHost=trim($data['smtpHost']);
    $smtpUsername=trim($data['smtpUsername']);
    $smtpPassword=trim($data['smtpPassword']);
    $smtpPort=trim($data['smtpPort']);
    $supportEmail=trim($data['supportEmail']);

    $accountName=trim($data['accountName']);
    $paymentKey=trim($data['paymentKey']);
    $secretKey=trim($data['secretKey']);
    $receiverKey=trim($data['receiverKey']);

    $staffId=trim($data['managerId']);
    $session=trim($data['session']);
    $termId=trim($data['termId']);
    $statusId=trim($data['statusId']);

    $departmentIds=$data['departmentIds'];
	////////////////////////////////////////////////////////////////////////////////

	if (empty($schoolCategoryId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "SCHOOL CATEGORY REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($name)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($mobileNumber)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "MOBILE NUMBER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($stateId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH STATE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($lgaId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH LGA REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($address)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH ADDRESS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($smtpHost)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SMTP HOST REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($smtpUsername)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SMTP USERNAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($smtpPassword)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SMTP PASSWORD REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($smtpPort)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SMTP PORT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($supportEmail)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "SUPPORT EMAIL REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($accountName)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "ACCOUNT NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
    if(empty($secretKey)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "PAYMENT SECRET KEY REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($receiverKey)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "PAYMENT RECEIVERS KEY REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($staffId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH MANAGER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($session)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "CURRENT SESSION REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($termId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "CURRENT TERM REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($statusId)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "BRANCH STATUS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(count($departmentIds)==0){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "DEPARTMENTS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

        if(!filter_var($smtpUsername, FILTER_VALIDATE_EMAIL)){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID SMTP USERNAME ADDRESS! Enter a valid email address and try again",
            ]; 
            goto end;
        }
        if(!filter_var($supportEmail, FILTER_VALIDATE_EMAIL)){
            $response = [
                'response'=> 102,
                'success'=> false,
                'message'=> "INVALID SUPPORT EMAIL ADDRESS! Enter a valid email address and try again",
            ]; 
            goto end;
        }
   
			$query=mysqli_query($conn,"SELECT * FROM BRANCHES_TAB WHERE $clientIds AND name='$name'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "BRANCH EXIST! Branch already exist by name. Check and try again.",
                ];
                goto end;
            }
            ///////////////////////geting sequence//////////////////////////
            $countId='BRANCH';
            $sequence=$callclass->_get_sequence_count($conn, $countId);
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $branchId=$countId.$no.date("Ymdhis");


            mysqli_query($conn,"INSERT INTO `BRANCHES_TAB`
            (`clientId`, `branchId`, `schoolCategoryId`, `name`, `mobileNumber`, `stateId`, `lgaId`, `address`, `smtpHost`, `smtpUsername`, `smtpPassword`, `smtpPort`, `supportEmail`,  `accountName`,  `paymentKey`, `secretKey`, `receiverKey`, `managerId`, `session`, `termId`, `statusId`, `createdBy`, `createdTime`) VALUES
            ('$clientId','$branchId','$schoolCategoryId','$name', '$mobileNumber', '$stateId', '$lgaId', '$address', '$smtpHost', '$smtpUsername', '$smtpPassword', '$smtpPort', '$supportEmail', '$accountName', '$paymentKey', '$secretKey', '$receiverKey', '$staffId', '$session', '$termId', '$statusId', '$loginStaffId', NOW())")or die (mysqli_error($conn));

            foreach ($departmentIds as $eachId) {
                $departmentId = $eachId['departmentId'];
                mysqli_query($conn,"INSERT INTO `BRANCH_DEPARTMENTS_TAB`
                (`clientId`, `branchId`, `departmentId`, `createdBy`, `createdTime`) VALUES 
                ('$clientId', '$branchId', '$departmentId', '$loginStaffId', NOW())")or die (mysqli_error($conn));
            }

            $response['response']=200; 
            $response['success']=true;
            $response['message']="BRANCH CREATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM BRANCH_VIEW WHERE $clientIds AND branchId = '$branchId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $termId=$fetchQuery['termId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];

                /////////////////// for  $termId
                $getTermQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
                $termData=array();
                while ($getTermFetch = mysqli_fetch_assoc($getTermQuery)) {
                    $termData[] = $getTermFetch;
                }
                $fetchQuery['termData']= $termData;

                /////////////////// for  $createdBy
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
                $createdByData=array();
                while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
                    $createdByData[] = $getCreatedByfetch;
                }
                $fetchQuery['createdBy']= $createdByData;

                /////////////////// for  $updatedBy
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
                $updatedByData=array();
                while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
                    $updatedByData[] = $getUpdatedByfetch;
                }
                $fetchQuery['updatedBy']= $updatedByData;


                /////////////////// for  $branchDepartmentsData
                $branchDepartmentsData=array();
                $branchDepartmentsQuery = mysqli_query($conn, "SELECT * FROM BRANCH_DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId'");
                while ($branchDepartmentsFetch = mysqli_fetch_assoc($branchDepartmentsQuery)) {
                    $branchDepartmentsData[] = $branchDepartmentsFetch;
                }
                $fetchQuery['branchDepartmentsData'] = $branchDepartmentsData;

                 
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>