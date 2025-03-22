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
    $branchId = $_GET['branchId'];
    $studentId = $_GET['studentId'];

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

    
    $officialStudentId=trim(strtoupper($_POST['officialStudentId']));
    $departmentId=trim($_POST['departmentId']);
    $classId=trim($_POST['classId']);
    $armId=trim($_POST['armId']);
    $accommodationId=trim($_POST['accommodationId']);
   
    $statusId=trim($_POST['statusId']);

    
	////////////////////////////////////////////////////////////////////////////////

    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($studentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STUDENT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
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

        if(($email) && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
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
   
            
            mysqli_query($conn,"UPDATE `STUDENTS_TAB` SET
            `surName`='$surName', `firstName`='$firstName', `otherNames`='$otherNames', `genderId`='$genderId', `maritalStatusId`='$maritalStatusId',
            `dateOfBirth`='$dateOfBirth', `countryId`='$countryId', `stateId`='$stateId', `lgaId`='$lgaId', `address`='$address', `email`='$email',
            `mobileNumber`='$mobileNumber', `statusId`='$statusId', `updatedBy`='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));


            $fatherDateOfBirth="$fatherDayOfBirth/$fatherMonthOfBirth";
            mysqli_query($conn,"UPDATE `PARENTS_TAB` SET
            `titleId`='$fatherTitleId', `surName`='$fatherSurName', `otherNames`='$fatherOtherNames', `address`='$fatherAddress', `email`='$fatherEmail',
            `mobileNumber`='$fatherMobileNumber', `dateOfBirth`='$fatherDateOfBirth', `occupation`='$fatherOccupation', `statusId`='$statusId', 
            `updatedBy`='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND recordFor='father' AND studentId='$studentId'")or die (mysqli_error($conn));

            $motherDateOfBirth="$motherDayOfBirth/$motherMonthOfBirth";
            mysqli_query($conn,"UPDATE `PARENTS_TAB` SET
            `titleId`='$motherTitleId', `surName`='$motherSurName', `otherNames`='$motherOtherNames', `address`='$motherAddress', `email`='$motherEmail',
            `mobileNumber`='$motherMobileNumber', `dateOfBirth`='$motherDateOfBirth', `occupation`='$motherOccupation', `statusId`='$statusId', 
            `updatedBy`='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND recordFor='mother' AND studentId='$studentId'")or die (mysqli_error($conn));

            mysqli_query($conn,"UPDATE `STUDENTS_CLASS_TAB` SET
            `officialStudentId`='$officialStudentId', `departmentId`='$departmentId', `classId`='$classId', `armId`='$armId', `accommodationId`='$accommodationId',
            `statusId`='$statusId', `updatedBy`='$loginStaffId'
            WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));


            $response['response']=200; 
            $response['success']=true;
            $response['message']="STUDENT UPDATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM STUDENTS_CLASS_TAB WHERE $clientIds AND branchId = '$branchId' AND studentId = '$studentId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $branchId=$fetchQuery['branchId'];
                $studentId=$fetchQuery['studentId'];
                $departmentId=$fetchQuery['departmentId'];
                $classId=$fetchQuery['classId'];
                $armId=$fetchQuery['armId'];
                $accommodationId=$fetchQuery['accommodationId'];
                $statusId=$fetchQuery['statusId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];


                /////////////////// for  $studentId
                $studentData=array();
                $studentDataQuery = mysqli_query($conn, "SELECT * FROM STUDENT_VIEW WHERE $clientIds AND studentId='$studentId'");
                while ($studentDatafetch = mysqli_fetch_assoc($studentDataQuery)) {
                    $studentData[] = $studentDatafetch;
                }
                $fetchQuery['studentData']= $studentData;

                 /////////////////// for  $departmentId
                 $departmentData=array();
                 $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
                 while ($departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery)) {
                     $departmentData[] = $departmentDataFetch;
                 }
                 $fetchQuery['departmentData']= $departmentData;
         
                 /////////////////// for  $classId
                 $classData=array();
                 $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
                 while ($classDataFetch = mysqli_fetch_assoc($classDataQuery)) {
                     $classData[] = $classDataFetch;
                 }
                 $fetchQuery['classData']= $classData;

                 /////////////////// for  $armId
                 $armData=array();
                 $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
                 while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
                     $armData[] = $armDataFetch;
                 }
                 $fetchQuery['armData']= $armData;

                 /////////////////// for  $accommodationId
                 $accommodationData=array();
                 $accommodationDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_ACCOMMODATION_TAB WHERE accommodationId='$accommodationId'");
                 while ($accommodationDataFetch = mysqli_fetch_assoc($accommodationDataQuery)) {
                     $accommodationData[] = $accommodationDataFetch;
                 }
                 $fetchQuery['accommodationData']= $accommodationData;
        
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