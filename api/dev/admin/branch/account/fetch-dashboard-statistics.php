<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>
<?php 
if (!$checkBasicSecurity){ 
    goto end;
}
if(!$checkSession){
    $response['response']=99;
    $response['success']=false;
    $response['message']="SESSION EXPIRED! Please LogIn Again.";
    goto end;
}
$branchId = trim($_GET['branchId']);

$dataQuery = mysqli_query($conn,"
    SELECT
        (SELECT COUNT(*) FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_branch_count,
        (SELECT COUNT(*) FROM STAFF_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_staff_count,
        (SELECT COUNT(*) FROM STUDENTS_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_student_count,
        (SELECT COUNT(*) FROM STUDENTS_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=12) AS total_alumni_student_count,
        (SELECT COUNT(*) FROM DEPARTMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_department_count,
        (SELECT COUNT(*) FROM CLASSES_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_class_count,
        (SELECT COUNT(*) FROM SUBJECTS_TAB WHERE $clientIds AND branchId='$branchId' AND statusId=1) AS total_active_subject_count
");

if (!$dataQuery) {
    die("Data Query Failed: " . mysqli_error($conn));
}


$response = [
    'response'=> 200,
    'success'=> true,
    'data'=>  array(),
    'staffMatrix' => array()
];  

while ($fetchDataQuery = mysqli_fetch_assoc($dataQuery)) {
    $response['data'][] = $fetchDataQuery;
}

end:
echo json_encode($response);