<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$parentTypeId =trim($data['parentTypeId']);
	$email=trim($data['email']);
	$phone=trim($data['phone']);
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
    if(empty($phone)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "PHONE NUMBER REQUIRED! Check password fields and try again",
        ]; 
        goto end;
	}
			$select=mysqli_query($conn,"SELECT * FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email' AND `mobileNumber`='$phone' LIMIT 1") or die (mysqli_error($conn));
			$countUser=mysqli_num_rows($select);
            if ($countUser==0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "INVALID LOGIN CREDIENTIALS! Kindly check the login parameters and try again.",
                    'clientIds'=> $clientIds,
                    'parentTypeId'=> $parentTypeId,
                    'email'=> $email,
                    'phone'=> $phone,
                ];
                goto end;
            }

                $fetchQuery=mysqli_fetch_assoc($select);
                $statusId=$fetchQuery['statusId'];
                
                if($statusId!=1){
                    $response = [
                        'response'=> 102,
                        'success'=> false,
                        'message'=> "ACCOUNT SUSPENDED! Contact the administrator for more info.",
                    ];
                    goto end;
                }

                
                $response['response']=200; 
                $response['success']=true;
                $response['message']="LOGIN SUCCESSFUL!"; 
                $response['parentData']= $fetchQuery;
                $response['students'] = array(); // Initialize the data array

			    $select="SELECT branchId, studentId FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email'";
                $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
                while ($fetchQuery = mysqli_fetch_assoc($query)) {
                    $branchId=$fetchQuery['branchId'];
                    $studentId=$fetchQuery['studentId'];
                    /////////////////// for  $studentId
                    $studentDetailQuery=mysqli_query($conn,"SELECT a.*, b.* FROM STUDENTS_CLASS_TAB a, STUDENT_VIEW b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.studentId='$studentId'");
                    $studentDetailFetch = mysqli_fetch_assoc($studentDetailQuery);
                    $fetchQuery['studentData'] = $studentDetailFetch;
                     ////////////////// for  $branchId
                    $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName, address, mobileNumber, smtpUsername AS email FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
                    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
                    $fetchQuery['branchData'] = $branchDataFetch;

                    $response['students'][]= $fetchQuery;
                }
            
end:
echo json_encode($response);
?>