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


    require_once 'positioning.php';
    if(!$recordFound){
        $response['response']=200;
        $response['success']=false;
        $response['message']="No record found!";
        goto end;
    }

    /// get all tableTitles
    $tableTitles="SN, FULL NAME";
    $select="SELECT a.subjectId, b.subjectName, b.subjectAbbreviation 
    FROM 
    SUBJECT_STRUCTURE_TAB a
    JOIN
    SUBJECTS_TAB b ON a.subjectId = b.subjectId AND a.clientId = b.clientId
    WHERE 
    a.clientId='$clientId'  
    AND a.classId='$classId'
    ORDER BY 
    b.subjectName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $subjectAbbreviation=$fetch['subjectAbbreviation'];
        $tableTitles .=", $subjectAbbreviation";     
    }
    $tableTitles .=", NO. OF SUBJECTS, MARK OBTAINABLE (%), MARK OBTAINED (%), TOTAL PERCENTAGE, POSTN. IN CLASS, REMARKS";

    
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

    $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
    $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);

    $response['response']=200; 
    $response['success']=true;
    $response['message']="BROADSHEET FETCHED SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['subjectData'] = $subjectDataFetch;
    $response['tableTitles']=$tableTitles;
    
    $response['studentData'] = array();
    //// get all students as at the time of assessment
    $select="SELECT 
    a.studentId AS studentId, 
    b.surName, 
    b.firstName,
    b.otherNames
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a 
    JOIN 
    STUDENTS_TAB b  ON a.studentId = b.studentId AND a.clientId = b.clientId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId = '$branchId' 
    AND a.session = '$session' 
    AND a.termId = '$termId' 
    AND a.departmentId = '$departmentId' 
    AND a.classId = '$classId' 
    AND a.armId = '$armId'
    ORDER BY 
    b.surName ASC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    /// get total number of students
    $totalNoOfStudents = mysqli_num_rows($query);
     // Get total subjects for the class
    while ($fetch = mysqli_fetch_assoc($query)) { 
        $studentId = $fetch['studentId'];
        /// get SubjectLists of this student
        $totalSubjects = 0;
        $totalMarkObtained = 0;
        
        $subjectListSelect = "SELECT a.subjectId, 
        a.allAssessmentTotalMark AS totalMark,
        b.subjectAbbreviation
        FROM 
        BRANCH_TERMINAL_SUBJECT_REPORT_TAB a
        JOIN
        SUBJECTS_TAB b ON a.clientId=b.clientId AND a.subjectId = b.subjectId
        WHERE
        a.clientId='$clientId' 
        AND a.branchId='$branchId' 
        AND a.session='$session' 
        AND a.termId='$termId' 
        AND a.departmentId='$departmentId' 
        AND a.classId='$classId' 
        AND a.armId='$armId' 
        AND a.studentId='$studentId'
        ORDER BY b.subjectName ASC"; // Order by subject name
        $subjectListQuery = mysqli_query($conn, $subjectListSelect) or die(mysqli_error($conn));
        while($subjectListFetch = mysqli_fetch_assoc($subjectListQuery)) {
            $totalSubjects++;
            $totalMarkObtained +=(float)$subjectListFetch['totalMark'];
            $fetch['studentScorePerSubject'][] = $subjectListFetch;
            
        }
        $fetch['totalSubjects'] = $totalSubjects;
        //get totalMarkObtainable
        $fetch['totalMarkObtainable'] = $totalSubjects * 100; // Assuming each subject has a maximum of 100 marks
        // get totalMarkObtained
        $fetch['totalMarkObtained'] = number_format($totalMarkObtained, 2, '.', '');
         // Calculate totalPercentage
        $fetch['totalPercentage'] = number_format(($fetch['totalMarkObtained'] / $fetch['totalMarkObtainable']) * 100, 2) . '%'; // Assuming totalMarkObtainable is the sum of all subjects' maximum marks
        // Get remarks
        $fetch['remarks'] = getRemark($fetch['totalPercentage']);
        // get positionInClass using totalPercentage
        $positionQuery = mysqli_query($conn, "SELECT position FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND studentId='$studentId'") or die(mysqli_error($conn));
        $positionFetch = mysqli_fetch_assoc($positionQuery);
        $positionInClass = $positionFetch['position'];
        $fetch['positionInClass']= $positionInClass; // Get ordinal suffix for position
        $response['studentData'][] = $fetch;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>