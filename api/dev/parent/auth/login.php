<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$parentTypeId =trim($data['parentTypeId']);
	$email=trim(strtolower($data['email']));
	$otp=trim($data['otp']);
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
    if(empty($otp)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "OTP REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
			$select=mysqli_query($conn,"SELECT * FROM EMAIL_VERIFICATION_TAB WHERE email='$email' AND otp='$otp'") or die (mysqli_error($conn));
			$countUser=mysqli_num_rows($select);
            if ($countUser==0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "INVALID OTP! Kindly check and try again.",
                ];
                goto end;
            }
                $select=mysqli_query($conn,"SELECT * FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email' LIMIT 1") or die (mysqli_error($conn));
                $fetchQuery=mysqli_fetch_assoc($select);

                $response['response']=200; 
                $response['success']=true;
                $response['message']="LOGIN SUCCESSFUL!"; 
                $response['parentData']= $fetchQuery;
                $response['students'] = array(); // Initialize the data array

			    $select="SELECT branchId, studentId FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email' AND statusId=1";
                $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
                while ($fetchQuery = mysqli_fetch_assoc($query)) {
                    $branchId=$fetchQuery['branchId'];
                    $studentId=$fetchQuery['studentId'];
                    /////////////////// for  $studentId
                    $studentDetailQuery=mysqli_query($conn,"SELECT a.*, b.* FROM STUDENTS_CLASS_TAB a, STUDENT_VIEW b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.studentId='$studentId'");
                    $studentDetailFetch = mysqli_fetch_assoc($studentDetailQuery);
                    $departmentId=$studentDetailFetch['departmentId'];
                    $classId=$studentDetailFetch['classId'];
                    $armId=$studentDetailFetch['armId'];

                    $fetchQuery['studentData'] = $studentDetailFetch;
                    
                    
                     ////////////////// for  $branchId
                    $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName, schoolLogo, address, mobileNumber, smtpUsername AS email, session AS currentSession, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
                    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
                    $termId=$branchDataFetch['termId'];
                    
                    /////////////////// for  $termId
                    $termDataQuery = mysqli_query($conn, "SELECT termName AS currentTerm FROM SETUP_TERM_TAB WHERE termId='$termId'");
                    $termDataFetch = mysqli_fetch_assoc($termDataQuery);
                    $branchDataFetch['termData'] = $termDataFetch;
                    $fetchQuery['branchData'] = $branchDataFetch;

                     /////////////////// for  $departmentId
                    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
                    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
                    $fetchQuery['departmentData'] = $departmentDataFetch;
                     /////////////////// for  $classId
                    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
                    $classDataFetch = mysqli_fetch_assoc($classDataQuery);
                    $fetchQuery['classData'] = $classDataFetch;

                    /////////////////// for  $armId
                    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
                    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
                    $fetchQuery['armData'] = $armDataFetch;

                    $response['students'][]= $fetchQuery;
                }

            /// delete the previous record
			mysqli_query($conn,"DELETE FROM `EMAIL_VERIFICATION_TAB` WHERE email='$email'");
            
end:
echo json_encode($response);
?>