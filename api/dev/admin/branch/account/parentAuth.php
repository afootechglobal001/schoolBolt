<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>

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
    $studentId=trim($_GET['studentId']);
	$parentTypeId =trim($_GET['parentTypeId']);
	$email=trim($_GET['email']);
    if (empty($email)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PARENT EMAIL REQUIRED! Check email fields and try again",
        ]; 
        goto end;
	}

    ////////////////////////////////////////////////////////////////////////////////
        $select=mysqli_query($conn,"SELECT * FROM PARENTS_TAB WHERE $clientIds AND recordFor='$parentTypeId' AND email='$email' AND studentId='$studentId' LIMIT 1") or die (mysqli_error($conn));
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
            
end:
echo json_encode($response);
?>