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

   
    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, address, smtpUsername, mobileNumber  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);

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
    $response['message']="ALL CA RESULT FETCHED SUCCESFFULY!";
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['assessmentData'] = $assessmentDataFetch;
    $response['eachStudentData'] = array();

    $select="SELECT 
    a.studentId AS studentId,
    b.surName, 
    b.firstName,
    b.otherNames,
    b.passport,
    b.genderName,
    a.totalSubjects,
    a.totalMarkObtainable,
    a.totalMarkObtained,
    a.totalPercentage,
    a.grade,
    a.remark,
    a.position AS positionInClass,
    a.overallPosition,
    a.principalComment
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_ASSESSMENT_TAB a 
    JOIN 
    STUDENT_VIEW b  ON a.studentId = b.studentId AND a.clientId = b.clientId
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

    $studentsInClassQuery=mysqli_query($conn, $select)or die (mysqli_error($conn));
    $numberOfStudents=mysqli_num_rows($studentsInClassQuery);
    While($studentsInClassFetch = mysqli_fetch_assoc($studentsInClassQuery)){
        $studentsInClassFetch['numberOfStudents'] = $numberOfStudents;
        $studentId = $studentsInClassFetch['studentId'];
        
        /// confirm student subjects
        $subjectAssessmentSelect="SELECT 
        a.recordId, 
        a.subjectId, 
        b.subjectName 
        FROM 
            BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB a
        JOIN 
            BRANCH_ASSESSMENT_RECORD_DETAILS_TAB c ON a.recordId = c.recordId
        JOIN
            SUBJECTS_TAB b ON a.subjectId = b.subjectId AND a.clientId = b.clientId
        WHERE 
            a.clientId = '$clientId' 
            AND a.branchId = '$branchId'  
            AND a.session = '$session'  
            AND a.termId = '$termId'        
            AND a.departmentId = '$departmentId'  
            AND a.classId = '$classId'  
            AND a.armId = '$armId'  
            AND a.assessmentId = '$assessmentId'
            AND c.studentId = '$studentId'
            AND c.markObtained > 0
        ORDER BY 
            b.subjectName ASC
        ";
        $subjectAssessmentQuery=mysqli_query($conn,$subjectAssessmentSelect)or die (mysqli_error($conn));
        while($datatFetch = mysqli_fetch_assoc($subjectAssessmentQuery)){
            $recordId = $datatFetch['recordId'];
            $subjectId = $datatFetch['subjectId'];
            
            $eachSubjectAssessmentQuery = mysqli_query($conn, "SELECT  `markObtainable`, `markObtained`, `percentage`, `grade`, `remark`, `position` FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB  WHERE recordId='$recordId' AND studentId='$studentId'") or die (mysqli_error($conn));
            $eachSubjectAssessmentFetch = mysqli_fetch_assoc($eachSubjectAssessmentQuery);
            $position =$eachSubjectAssessmentFetch['position'];
            /// get number of students that did this subject
            $subjectStudentsCountsQuery = mysqli_query($conn, "SELECT COUNT(studentId) AS subjectStudentsCounts FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId='$recordId'") or die (mysqli_error($conn));
            $subjectStudentsCountsFetch = mysqli_fetch_assoc($subjectStudentsCountsQuery);
            $subjectStudentsCounts = $subjectStudentsCountsFetch['subjectStudentsCounts']; 

            $eachSubjectAssessmentFetch['positionInClass']= $position . "($subjectStudentsCounts)";
            $datatFetch['subjectAssessment'] = $eachSubjectAssessmentFetch;
            $studentsInClassFetch['data'][] = $datatFetch;
        }

        $response['eachStudentData'][]=$studentsInClassFetch;
     }
   
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>