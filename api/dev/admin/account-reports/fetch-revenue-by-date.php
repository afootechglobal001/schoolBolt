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

$date = date('Y-m-d', strtotime(trim($_GET['date'])));
$dateFormatted = date('F d Y', strtotime($date));
///get sum total amount paid on that date
$totalAmountQuery = mysqli_query($conn, "
    SELECT IFNULL(SUM(totalFeesPaid), 0) AS totalAmount 
    FROM PAYMENTS_TAB 
    WHERE $clientIds AND DATE(payDate) = '$date' 
    AND statusId=5
");
$totalAmount = mysqli_fetch_assoc($totalAmountQuery)['totalAmount'];


$response = [
    'response'=> 200,
    'success'=> true,
    'message'=> "REVENUE FETCHED SUCCESSFULLY",
    'date' => $dateFormatted,
    'totalAmount' => $totalAmount,
    'data'=>  [],
]; 


$dataQuery = mysqli_query($conn, "
    SELECT paymentId, studentId, email, branchId, session, termId, totalFeesPaid, paymentMethodId, statusId, payDate, departmentId, classId, armId
    FROM PAYMENTS_TAB 
    WHERE $clientIds AND DATE(payDate) = '$date'
    AND statusId=5 
    ORDER BY DATE(payDate) DESC
");

while ($fetchDataQuery = mysqli_fetch_assoc($dataQuery)) {
    $studentId = $fetchDataQuery['studentId'];
    $branchId = $fetchDataQuery['branchId'];
    $email = $fetchDataQuery['email'];
    //get student details
    $studentQuery = mysqli_query($conn, "SELECT studentId, surName, firstName, otherNames, passport FROM STUDENTS_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'");
    $studentData = mysqli_fetch_assoc($studentQuery);
    $fetchDataQuery['studentData'] = $studentData;
    //get parent details
    $parentQuery = mysqli_query($conn, "SELECT email, titleId, surName, otherNames, mobileNumber FROM PARENTS_TAB WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId' AND email='$email' LIMIT 1");
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

    $response['data'][] = $fetchDataQuery;
}

end:
echo json_encode($response);
?>