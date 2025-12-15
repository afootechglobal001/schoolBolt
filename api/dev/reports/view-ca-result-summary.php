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
    $assessmentId = $_GET['assessmentId'];
    

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($assessmentId, 'ASSESSMENT');






    /// get all tableTitles
    $tableTitles="SN, FULL NAME, NO. OF SUBJECTS, MARK OBTAINABLE, MARK OBTAINED, TOTAL PERCENTAGE (%), POSTN. IN CLASS, OVERALL POSTN., REMARKS, TEACHER'S COMMENT";
    
    $branchDataQuery = mysqli_query($conn, "SELECT session, termId,  name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, caResultSummaryHeader, watermark  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $currentSession = $currentSessionTermFetch['session'];
    $currentTermId = $currentSessionTermFetch['termId'];
    
    if (($session == $currentSession) && ($termId == $currentTermId)) {
        //// update students overall position in class
        $markChecker_Overall=0;
        $count_Overall=0;
        $updatePositionSelect = "SELECT studentId, totalPercentage FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND assessmentId='$assessmentId' ORDER BY totalPercentage DESC";
        $updatePositionQuery = mysqli_query($conn, $updatePositionSelect) or die(mysqli_error($conn));
        $noOfStudents = mysqli_num_rows($updatePositionQuery);
        while ($updatePositionFetch = mysqli_fetch_assoc($updatePositionQuery)) {
            $count_Overall++;
            $updateStudentId=$updatePositionFetch['studentId'];
            $totalPercentage=$updatePositionFetch['totalPercentage'];

            if($markChecker_Overall!=$totalPercentage){
                $markChecker_Overall=$totalPercentage;
                $position=$count_Overall . getOrdinalSuffix($count_Overall)."($noOfStudents)";
            }
            mysqli_query($conn, "UPDATE BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB SET overallPosition = '$position' WHERE $clientIds AND branchId = '$branchId' AND session = '$session' AND termId = '$termId' AND departmentId = '$departmentId' AND classId = '$classId' AND assessmentId='$assessmentId' AND studentId = '$updateStudentId'") or die(mysqli_error($conn));
        }
    };

    $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);

    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);

    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);

    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);

    $assessmentDataQuery = mysqli_query($conn, "SELECT assessmentId, assessmentName FROM BRANCH_ASSESSMENT_SETUP_TAB  WHERE $clientIds AND branchId='$branchId' AND assessmentId='$assessmentId'");
    $assessmentDataFetch = mysqli_fetch_assoc($assessmentDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CA RESULT SUMMARY FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['assessmentData'] = $assessmentDataFetch;
    $response['tableTitles']=$tableTitles;
    
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $response['studentData'] = array();  
    //// get all students as at the time of assessment
    $select="SELECT 
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
    c.classTeachersComment
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB a 
    JOIN 
    STUDENTS_TAB b  ON a.studentId = b.studentId AND a.clientId = b.clientId
    LEFT JOIN BRANCH_TEACHERS_COMMENTS_TAB c 
    ON a.studentId = c.studentId
    AND a.clientId = c.clientId
    AND a.branchId = c.branchId
    AND a.session = c.session
    AND a.termId = c.termId
    AND a.departmentId = c.departmentId
    AND a.classId = c.classId
    AND a.armId = c.armId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId = '$branchId' 
    AND a.session = '$session' 
    AND a.termId = '$termId' 
    AND a.departmentId = '$departmentId' 
    AND a.classId = '$classId' 
    AND a.armId = '$armId'
    AND a.assessmentId='$assessmentId'
    ORDER BY 
    b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {    
        $response['studentData'][] = $fetch;
    }

end:
echo json_encode($response);
?>