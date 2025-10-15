<?php 
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';
if (!$checkBasicSecurity){ goto end; }
if(!$checkSession){
    $response = [
        'response'=>99,
        'success'=>false,
        'message'=>"SESSION EXPIRED! Please LogIn Again."
    ];
    goto end;
}

$paymentId = trim($_GET['paymentId']);

$response = [
    'response'=> 200,
    'success'=> true,
    'message'=> "REVENUE FETCHED SUCCESSFULLY",
    'data'=>  [],
]; 


$dataQuery = mysqli_query($conn, "
    SELECT paymentId, studentId, email, branchId, session, termId, totalAmount, paymentMethodId, statusId, payDate, departmentId, classId, armId
    FROM PAYMENTS_TAB 
    WHERE $clientIds AND paymentId='$paymentId'
");

$fetchDataQuery = mysqli_fetch_assoc($dataQuery);
    $studentId = $fetchDataQuery['studentId'];
    $branchId = $fetchDataQuery['branchId'];
    $email = $fetchDataQuery['email'];
    //get student details
    $studentQuery = mysqli_query($conn, "SELECT studentId, surName, firstName, otherNames, passport FROM STUDENTS_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'");
    $studentData = mysqli_fetch_assoc($studentQuery);
    $fetchDataQuery['studentData'] = $studentData;
    //get parent details
    $parentQuery = mysqli_query($conn, "SELECT email, titleId, surName, otherNames, mobileNumber, recordFor AS relationship FROM PARENTS_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId' AND email='$email' LIMIT 1");
    $parentData = mysqli_fetch_assoc($parentQuery);
    $fetchDataQuery['parentData'] = $parentData;

    //get branch details
    $branchQuery = mysqli_query($conn, "SELECT branchId, name AS branchName, mobileNumber FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchData = mysqli_fetch_assoc($branchQuery);
    $fetchDataQuery['branchData'] = $branchData;

    //get term details
    $termId = $fetchDataQuery['termId'];
    $termQuery = mysqli_query($conn, "SELECT termId, termName FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termData = mysqli_fetch_assoc($termQuery);
    $fetchDataQuery['termData'] = $termData;

    //get status details
    $statusId = $fetchDataQuery['statusId'];
    $statusQuery = mysqli_query($conn, "SELECT statusId, statusName FROM SETUP_STATUS_TAB WHERE statusId='$statusId'");
    $statusData = mysqli_fetch_assoc($statusQuery);
    $fetchDataQuery['statusData'] = $statusData;

    // detapartment details
    $departmentId = $fetchDataQuery['departmentId'];
    $departmentQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentData = mysqli_fetch_assoc($departmentQuery);
    $fetchDataQuery['departmentData'] = $departmentData;

    //get class details
    $classId = $fetchDataQuery['classId'];
    $classQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classData = mysqli_fetch_assoc($classQuery);
    $fetchDataQuery['classData'] = $classData;

    //get arm details
    $armId = $fetchDataQuery['armId'];
    $armQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armData = mysqli_fetch_assoc($armQuery);
    $fetchDataQuery['armData'] = $armData;

    //get payment method details
    $paymentMethodId = $fetchDataQuery['paymentMethodId'];
    $paymentMethodQuery = mysqli_query($conn, "SELECT paymentMethodId, paymentMethodName FROM SETUP_PAYMENT_METHOD_TAB WHERE paymentMethodId='$paymentMethodId'");
    $paymentMethodData = mysqli_fetch_assoc($paymentMethodQuery);
    $fetchDataQuery['paymentMethodData'] = $paymentMethodData;

    //get payment breakdown details
    $paymentBreakdownQuery = mysqli_query($conn, "SELECT * FROM PAYMENT_HISTORY_TAB WHERE paymentId='$paymentId'");
    while ($row = mysqli_fetch_assoc($paymentBreakdownQuery)) {
        $paymentBreakdownData[] = $row;
    }
    $fetchDataQuery['paymentBreakdownData'] = $paymentBreakdownData;
    $response['data'][] = $fetchDataQuery;


end:
echo json_encode($response);
?>