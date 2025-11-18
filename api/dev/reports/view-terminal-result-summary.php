<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}

    //////////////////declaration of variables//////////////////////////////////////
    $branchId = $_GET['branchId'];
    $session = $_GET['session'];
    $termId = $_GET['termId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');


    /// get all tableTitles
$tableTitles="SN, FULL NAME, NO. OF SUBJECTS, MARK OBTAINABLE, MARK OBTAINED, TOTAL PERCENTAGE (%), POSTN. IN CLASS, OVERALL POSTN., REMARKS, TEACHER'S COMMENT, ATTENDANCE";

    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, terminalResultSummaryHeader, watermark  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);

    $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);

    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);

    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);

    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="TERMINAL RESULT SUMMARY FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['tableTitles']=$tableTitles;
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $response['studentData'] = array();  
    //// get all students as at the time of assessment
  $select = "SELECT 
    a.studentId AS studentId,
    b.surName, 
    b.firstName,
    b.otherNames,
    b.passport,
    a.totalSubjects,
    a.totalMarkObtainable,
    a.totalMarkObtained,
    a.totalPercentage,
    a.grade,
    a.remark,
    a.position AS positionInClass,
    a.overallPosition,
    a.principalComment,
    CONCAT(
        IFNULL(c.numberOfDaysPresents, 0),
        ' / ',
        IFNULL(c.timeSchoolOpened, 0)
    ) AS attendance,
    d.classTeachersComment
FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a
JOIN STUDENTS_TAB b  
    ON a.studentId = b.studentId 
   AND a.clientId = b.clientId
LEFT JOIN BRANCH_STUDENT_ATTENDANCE_TAB c 
    ON a.studentId = c.studentId 
   AND a.clientId = c.clientId 
   AND a.branchId = c.branchId 
   AND a.session = c.session 
   AND a.termId = c.termId 
   AND a.departmentId = c.departmentId 
   AND a.classId = c.classId 
   AND a.armId = c.armId
LEFT JOIN BRANCH_TEACHERS_COMMENTS_TAB d 
    ON a.studentId = d.studentId
    AND a.clientId = d.clientId
    AND a.branchId = d.branchId
    AND a.session = d.session
    AND a.termId = d.termId
    AND a.departmentId = d.departmentId
    AND a.classId = d.classId
    AND a.armId = d.armId
WHERE a.clientId = '$clientId'
  AND a.branchId = '$branchId'
  AND a.session = '$session'
  AND a.termId = '$termId'
  AND a.departmentId = '$departmentId'
  AND a.classId = '$classId'
  AND a.armId = '$armId'
ORDER BY b.surName ASC
";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {    
        $response['studentData'][] = $fetch;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>