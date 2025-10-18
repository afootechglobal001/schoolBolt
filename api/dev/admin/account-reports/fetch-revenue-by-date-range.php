<?php 
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

$response = ['success' => false]; // Initialize

if (!$checkBasicSecurity){ goto end; }
if(!$checkSession){
    $response = [
        'response'=>99,
        'success'=>false,
        'message'=>"SESSION EXPIRED! Please LogIn Again."
    ];
    goto end;
}

$dateFrom = date('Y-m-d', strtotime(trim($_GET['dateFrom'])));
$dateTo = date('Y-m-d', strtotime(trim($_GET['dateTo'])));

$dateFromFormatted = date('F d Y', strtotime($dateFrom));
$dateToFormatted = date('F d Y', strtotime($dateTo));

$statisticsQuery = mysqli_query($conn,"
    SELECT
        IFNULL((SELECT SUM(totalFeesPaid) FROM PAYMENTS_TAB WHERE $clientIds AND DATE(payDate) BETWEEN '$dateFrom' AND '$dateTo' AND statusId=5 AND paymentMethodId='PM001'), 0) AS sumCreditCardPayments,
        IFNULL((SELECT SUM(totalFeesPaid) FROM PAYMENTS_TAB WHERE $clientIds AND DATE(payDate) BETWEEN '$dateFrom' AND '$dateTo' AND statusId=5 AND paymentMethodId='PM002'), 0) AS sumBankTransferPayments,
        IFNULL((SELECT COUNT(paymentId) FROM PAYMENTS_TAB WHERE $clientIds AND DATE(payDate) BETWEEN '$dateFrom' AND '$dateTo' AND statusId=5 AND paymentMethodId='PM001'), 0) AS countCreditCardPayments,
        IFNULL((SELECT COUNT(paymentId) FROM PAYMENTS_TAB WHERE $clientIds AND DATE(payDate) BETWEEN '$dateFrom' AND '$dateTo' AND statusId=5 AND paymentMethodId='PM002'), 0) AS countBankTransferPayments
");


if (!$statisticsQuery) {
    die("Data Query Failed: " . mysqli_error($conn));
}

$response = [
    'response'=> 200,
    'success'=> true,
    'message'=> "DASHBOARD REVENUE FETCHED SUCCESSFULLY",
    'dateFrom' => $dateFromFormatted,
    'dateTo' => $dateToFormatted,
    'statistics' => [],
    'data'=>  [],
]; 

while ($statisticsDataQuery = mysqli_fetch_assoc($statisticsQuery)) {
    $response['statistics'][] = $statisticsDataQuery;
}

$dataQuery = mysqli_query($conn, "
    SELECT SUM(totalFeesPaid) AS totalFeesPaid, DATE(payDate) AS payDate 
    FROM PAYMENTS_TAB 
    WHERE $clientIds AND DATE(payDate) BETWEEN '$dateFrom' AND '$dateTo' 
    AND statusId=5 
    GROUP BY DATE(payDate) 
    ORDER BY DATE(payDate) ASC
");

while ($fetchDataQuery = mysqli_fetch_assoc($dataQuery)) {
    $response['data'][] = $fetchDataQuery;
}

end:
echo json_encode($response);
?>