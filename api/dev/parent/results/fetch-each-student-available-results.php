<?php require_once '../../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
	//////////////////declaration of variables//////////////////////////////////////
	$studentId =$_GET['studentId'];
	$branchId=$_GET['branchId'];
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($studentId, 'STUDENT ID');
    validateEmptyField($branchId, 'BRANCH');

    $select = "SELECT DISTINCT a.session, a.departmentId, b.departmentName, a.classId, c.className
                FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a
                JOIN DEPARTMENTS_TAB b ON a.clientId=b.clientId AND a.departmentId=b.departmentId
                JOIN CLASSES_TAB c ON a.clientId=c.clientId AND a.classId=c.classId
                WHERE 
                a.clientId='$clientId'
                AND a.branchId = '$branchId' 
                AND a.studentId = '$studentId'
                ORDER BY a.session ASC
    ";
    $getAvailableStudentResultQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($getAvailableStudentResultQuery);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="NO RECORD FOUND! - Results Not Available of the student. Contact School Admin for more information.";
        goto end;
    }


    /////////////////// get previous successfull payment true credit card or bank transfer
    $getPaymentIdQuery = mysqli_query($conn, "SELECT paymentId FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND studentId='$studentId'  AND statusId=5 AND (paymentMethodId='PM001' OR paymentMethodId='PM002')") or die (mysqli_error($conn));
    $previousPaymentCount=mysqli_num_rows($getPaymentIdQuery);


   
    $response['response']=200; 
    $response['success']=true;
    $response['message']="ACTION SUCCESSFUL!";
    $response['data'] = array(); // Initialize the data array
    while ($fetchQuery = mysqli_fetch_assoc($getAvailableStudentResultQuery)) {
        $session = $fetchQuery['session'];
        $departmentId = $fetchQuery['departmentId'];
        $classId = $fetchQuery['classId'];
        //// get the terms available for the student in the session, department and class
        $termSelect = "SELECT a.termId , b.termName, a.armId, c.armName
                        FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a
                        JOIN SETUP_TERM_TAB b ON a.termId=b.termId
                        JOIN ARMS_TAB c ON a.clientId=c.clientId AND a.armId=c.armId
                        WHERE a.clientId='$clientId'
                        AND a.branchId = '$branchId'
                        AND a.session = '$session'
                        AND a.departmentId = '$departmentId'
                        AND a.classId = '$classId'
                        AND a.studentId = '$studentId'
                        ORDER BY a.termId ASC";
        $termQuery = mysqli_query($conn, $termSelect) or die(mysqli_error($conn));
        while ($termFetch = mysqli_fetch_assoc($termQuery)) {
           $fetchQuery['results'][] = $termFetch;
        }

        $response['data'][]= $fetchQuery;
    }
            
end:
echo json_encode($response);
?>