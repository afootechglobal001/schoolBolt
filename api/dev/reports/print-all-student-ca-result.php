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



    /// confirm if there is records
    $broadsheetSelect="SELECT 
    a.recordId, 
    a.subjectId, 
    b.subjectName 
    FROM 
        BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB a
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
    ORDER BY 
        b.subjectName ASC
";
     
    $broadsheetQuery=mysqli_query($conn,$broadsheetSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($broadsheetQuery);
    if($allRecordCount==0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="No record found!";
        goto end;
    }
   
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

    $studentsInClassSelect = "SELECT 
    DISTINCT(a.studentId) AS studentId
    FROM 
    BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a
    JOIN 
    BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b ON a.recordId=b.recordId
    WHERE 
     b.clientId='$clientId' 
    AND b.branchId = '$branchId' 
    AND b.departmentId='$departmentId' 
    AND b.classId='$classId' 
    AND b.armId='$armId'";

    $studentsInClassQuery=mysqli_query($conn, $studentsInClassSelect)or die (mysqli_error($conn));
    While($studentsInClassFetch = mysqli_fetch_assoc($studentsInClassQuery)){
        $studentId = $studentsInClassFetch['studentId'];
   
        $studentDataQuery=mysqli_query($conn,"SELECT studentId, surName, firstName, otherNames, passport, genderName FROM STUDENT_VIEW WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));
        $studentDataFetch = mysqli_fetch_assoc($studentDataQuery);
        $studentsInClassFetch['studentData']= $studentDataFetch;
        
        $numOfSubjects=0;
        $markObtained=0;
        $broadsheetQuery=mysqli_query($conn,$broadsheetSelect)or die (mysqli_error($conn));
        while($datatFetch = mysqli_fetch_assoc($broadsheetQuery)){
            $numOfSubjects++;
            $recordId = $datatFetch['recordId'];
            $subjectId = $datatFetch['subjectId'];
            
            $eachSubjectAssessmentQuery = mysqli_query($conn, "SELECT  `markObtainable`, `markObtained`, `percentage`, `grade`, `remark`, `position` FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB  WHERE recordId='$recordId' AND studentId='$studentId'") or die (mysqli_error($conn));
            $eachSubjectAssessmentFetch = mysqli_fetch_assoc($eachSubjectAssessmentQuery);
            $position =$eachSubjectAssessmentFetch['position'];
            $markObtained +=$eachSubjectAssessmentFetch['percentage'];
            /// get number of students that did this subject
            $subjectStudentsCountsQuery = mysqli_query($conn, "SELECT COUNT(studentId) AS subjectStudentsCounts FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB WHERE recordId='$recordId'") or die (mysqli_error($conn));
            $subjectStudentsCountsFetch = mysqli_fetch_assoc($subjectStudentsCountsQuery);
            $subjectStudentsCounts = $subjectStudentsCountsFetch['subjectStudentsCounts']; 

            $eachSubjectAssessmentFetch['positionInClass']= $position . "($subjectStudentsCounts)";
            $datatFetch['subjectAssessment'] = $eachSubjectAssessmentFetch;
            $studentsInClassFetch['data'][] = $datatFetch;
        }
        /// get number of student in class
        $select="SELECT DISTINCT(a.studentId) FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a, BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b   
        WHERE a.recordId=b.recordId   AND  b.clientId='$clientId' AND b.branchId = '$branchId' AND b.departmentId='$departmentId' AND b.classId='$classId' AND b.armId='$armId'";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        $numberOfStudents=mysqli_num_rows($query);
        $studentsInClassFetch['numberOfStudents'] = $numberOfStudents;
        //// get number of subjects
        $studentsInClassFetch['numOfSubjects'] = $numOfSubjects;
        //get totalMarkObtainable
        $studentsInClassFetch['totalMarkObtainable'] = $numOfSubjects * 100;
        /// get totalMarkObtained
        $studentsInClassFetch['totalMarkObtained'] = number_format((float)$markObtained, 2, '.', '');
        // Calculate totalPercentage
        $totalPercentage= round(($markObtained / ($numOfSubjects * 100)) * 100, 2);
        $studentsInClassFetch['totalPercentage'] =$totalPercentage . '%';
        // get teachers comment
        $studentsInClassFetch['principalsComment'] = getPrincipalComment($totalPercentage);

        $response['eachStudentData'][]=$studentsInClassFetch;
     }
   
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>