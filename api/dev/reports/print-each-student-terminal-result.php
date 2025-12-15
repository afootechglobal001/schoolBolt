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
    $studentId = $_GET['studentId'];
    
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($session, 'SESSION');
    validateEmptyField($termId, 'TERM');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($studentId, 'STUDENT');

    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, principalSignature, address, supportEmail, mobileNumber, timeSchoolOpened, schoolResumptionDate, schoolCategoryId, terminalResultHeader, progressReportHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);

    $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);

    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);

    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);

    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    
    $studentDataQuery=mysqli_query($conn,"SELECT studentId, officialStudentId, surName, firstName, otherNames, passport, genderName FROM STUDENT_VIEW WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));
    $studentDataFetch = mysqli_fetch_assoc($studentDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="TERMINAL RESULT FETCHED  SUCCESFFULY!";
    $response['clientWebsite'] = $dbClientAddress;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['studentData'] = $studentDataFetch;

    if($termId == 1){
       require_once 'term-1-result.php';
    } elseif($termId == 2){
        require_once 'term-2-result.php';
    } elseif($termId == 3){
        require_once 'term-3-result.php';
    } else {
        $response['response'] = 400;
        $response['success'] = false;
        $response['message'] = "Invalid Term ID";
        goto end;
    }

 /// get all progressive report tableTitles
    $progressiveReportTableTitles="SN, SUBJECTS, FIRST TERM SCORE(100), SECOND TERM SCORE(100), THIRD TERM SCORE (100), FIRST TERM SCORE(100), SECOND TERM SCORE(100), THIRD TERM SCORE (100), FIRST TERM SCORE(100), SECOND TERM SCORE(100), THIRD TERM SCORE (100)";
    $response['progressiveReportTableTitles'] = $progressiveReportTableTitles;
    

        

///get all assessment counts for this branch
    $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0   $assessmentIds";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allAssessmentsCount=mysqli_num_rows($query);


    $select = "SELECT 
    a.childId AS classId, 
    b.className 
    FROM CLASS_STRUCTURE_TAB a
    JOIN CLASSES_TAB b  ON a.clientId=b.clientId AND a.childId = b.classId 
    WHERE a.clientId='$clientId'
    AND a.parentId= '$departmentId'";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
     while ($fetchQuery = mysqli_fetch_assoc($query)) {

        $classId = $fetchQuery['classId'];
        $sessionsData = []; // store all session data

        $sessionSelect="SELECT DISTINCT session 
                        FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB 
                        WHERE $clientIds AND branchId='$branchId' 
                        AND departmentId='$departmentId' 
                        AND classId='$classId' 
                        AND studentId='$studentId' 
                        ORDER BY session ASC";

        $sessionQuery = mysqli_query($conn, $sessionSelect);
        $fetchSession = mysqli_fetch_assoc($sessionQuery);
        $session = $fetchSession['session'];
        $fetchQuery['session'] = $session;
    /////////////////////////////////////////////////////////////////////////////////////////////////////
        $fetchQuery['subjectsScores'] = array();
        $studentSubjectSelect = "SELECT DISTINCT (a.subjectId) AS subjectId, b.subjectName
                                 FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB a
                                 JOIN SUBJECTS_TAB b ON a.clientId=b.clientId AND a.subjectId=b.subjectId
                                 WHERE a.clientId='$clientId' 
                                 AND a.branchId='$branchId'
                                 AND a.session='$session'
                                 AND a.departmentId='$departmentId'
                                 AND a.classId='$classId'
                                 AND a.studentId='$studentId'
                                 AND a.numberOfSittings=$allAssessmentsCount
                                 ORDER BY b.subjectName ASC";

        $studentSubjectQuery = mysqli_query($conn, $studentSubjectSelect);

        while ($studentSubjectFetch = mysqli_fetch_assoc($studentSubjectQuery)) {

            $subjectId = $studentSubjectFetch['subjectId'];

            // FIRST term
            $firstQuery = mysqli_query($conn, 
                "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB 
                 WHERE $clientIds AND branchId='$branchId' 
                 AND session='$session' AND termId=1 
                 AND departmentId='$departmentId' AND classId='$classId'
                 AND subjectId='$subjectId' AND studentId='$studentId' AND numberOfSittings=$allAssessmentsCount");

            $firstFetch = mysqli_fetch_assoc($firstQuery);
            $studentSubjectFetch['firstTermScores'] = $firstFetch['allAssessmentTotalMark'] ?? null;

            // SECOND term
            $secondQuery = mysqli_query($conn, 
                "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB 
                 WHERE $clientIds AND branchId='$branchId' 
                 AND session='$session' AND termId=2 
                 AND departmentId='$departmentId' AND classId='$classId'
                 AND subjectId='$subjectId' AND studentId='$studentId' AND numberOfSittings=$allAssessmentsCount");

            $secondFetch = mysqli_fetch_assoc($secondQuery);
            $studentSubjectFetch['secondTermScores'] = $secondFetch['allAssessmentTotalMark'] ?? null;

            // THIRD term
            $thirdQuery = mysqli_query($conn, 
                "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB 
                 WHERE $clientIds AND branchId='$branchId' 
                 AND session='$session' AND termId=3 
                 AND departmentId='$departmentId' AND classId='$classId'
                 AND subjectId='$subjectId' AND studentId='$studentId' AND numberOfSittings=$allAssessmentsCount");
            $thirdFetch = mysqli_fetch_assoc($thirdQuery);
            $studentSubjectFetch['thirdTermScores'] = $thirdFetch['allAssessmentTotalMark'] ?? null;

             $fetchQuery['subjectsScores'][] = $studentSubjectFetch;
        }

        /////////////////////////////////////////////////////////////////////////////////////////
    $firstTermTotalPercentageQuery=mysqli_query($conn,"SELECT  totalPercentage
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB
    WHERE 
    $clientIds
    AND branchId = '$branchId' 
    AND session = '$session' 
    AND termId = 1 
    AND departmentId = '$departmentId' 
    AND classId = '$classId' 
    AND studentId = '$studentId'")or die (mysqli_error($conn));
    $firstTermTotalPercentageFetch = mysqli_fetch_assoc($firstTermTotalPercentageQuery);
    $firstTermTotalPercentage = $firstTermTotalPercentageFetch['totalPercentage'] ?? null; 

    $secondTermTotalPercentageQuery=mysqli_query($conn,"SELECT  totalPercentage
    FROM
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB
    WHERE
    $clientIds
    AND branchId = '$branchId'
    AND session = '$session'
    AND termId = 2
    AND departmentId = '$departmentId'
    AND classId = '$classId'
    AND studentId = '$studentId'")or die (mysqli_error($conn));
    $secondTermTotalPercentageFetch = mysqli_fetch_assoc($secondTermTotalPercentageQuery);
    $secondTermTotalPercentage = $secondTermTotalPercentageFetch['totalPercentage'] ?? null;

    $thirdTermTotalPercentageQuery=mysqli_query($conn,"SELECT  totalPercentage
    FROM
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB
    WHERE
    $clientIds
    AND branchId = '$branchId'
    AND session = '$session'
    AND termId = 3
    AND departmentId = '$departmentId'
    AND classId = '$classId'
    AND studentId = '$studentId'")or die (mysqli_error($conn));
    $thirdTermTotalPercentageFetch = mysqli_fetch_assoc($thirdTermTotalPercentageQuery);
    $thirdTermTotalPercentage = $thirdTermTotalPercentageFetch['totalPercentage'] ?? null;

    $fetchQuery['totalPercentage'] = array(
        'firstTermTotalPercentage' => $firstTermTotalPercentage,
        'secondTermTotalPercentage' => $secondTermTotalPercentage,
        'thirdTermTotalPercentage' => $thirdTermTotalPercentage
    );
    $response['progressiveReportData'][] = $fetchQuery;
}




end:
echo json_encode($response);
?>