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
     /// confirm if there is any subject records for this class and arm
    $subjectSelect="SELECT
    DISTINCT (subjectId) AS subjectId
    FROM
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
    WHERE
    $clientIds
    AND branchId = '$branchId'
    AND session = '$session'
    AND termId = '$termId'
    AND departmentId = '$departmentId'
    AND classId = '$classId'
    AND armId = '$armId' LIMIT 1";

    $subjectQuery=mysqli_query($conn,$subjectSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($subjectQuery);
    if ($allRecordCount==0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }

    require_once 'positioning-for-term.php';

   /// get all tableTitles
    $tableTitles="SN, FULL NAME";
    $subjectsSelect="SELECT 
   a.subjectId, 
   b.subjectName, 
   b.subjectAbbreviation 
   FROM 
   SUBJECT_STRUCTURE_TAB a
   JOIN 
   SUBJECTS_TAB b ON a.clientId=b.clientId AND a.subjectId=b.subjectId
    WHERE a.clientId='$clientId' AND a.classId='$classId'
    ORDER BY b.subjectName ASC";
    $query=mysqli_query($conn,$subjectsSelect)or die (mysqli_error($conn));
    while ($fetch = mysqli_fetch_assoc($query)) {
        $subjectAbbreviation=$fetch['subjectAbbreviation'];
        $tableTitles .=", $subjectAbbreviation";     
    }
    $tableTitles .=", NO. OF SUBJECTS, MARK OBTAINABLE, MARK OBTAINED, TOTAL PERCENTAGE (%), POSTN. IN CLASS, OVERALL POSTN., REMARKS";

    
    $branchDataQuery = mysqli_query($conn, "SELECT assessmentLock, name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, terminalBroadSheetHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    $assessmentLock=$branchDataFetch['assessmentLock'];
    if($assessmentLock==0){
        $response['response']=403;
        $response['success']=false;
        $response['message']="ASSESSMENT UPDATE LOCK IS REQUIRED! Kindly lock the assessment update before proceeding.";
        goto end;
    }
    
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
    ///get all assessment counts for this branch
    $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0   $assessmentIds";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allAssessmentsCount=mysqli_num_rows($query);
    //// get all students as at the time of assessment
    $select="SELECT 
    a.studentId AS studentId, 
    b.surName, 
    b.firstName,
    b.otherNames,
    a.totalSubjects,
    a.totalMarkObtainable,
    a.totalMarkObtained,
    a.totalPercentage,
    a.grade,
    a.remark,
    a.position AS positionInClass,
    a.overallPosition
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
     // Get total subjects for the class
    while ($fetch = mysqli_fetch_assoc($query)) { 
        $studentId = $fetch['studentId'];
        /// get SubjectLists of this student
        $subjectListSelect = "SELECT a.subjectId, 
        a.numberOfSittings,
        a.allAssessmentTotalMark AS totalMark,
        b.subjectAbbreviation
        FROM 
        BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB a
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
        AND numberOfSittings=$allAssessmentsCount 
        ORDER BY b.subjectName ASC"; // Order by subject name
        $subjectListQuery = mysqli_query($conn, $subjectListSelect) or die(mysqli_error($conn));
        while($subjectListFetch = mysqli_fetch_assoc($subjectListQuery)) {
            $fetch['studentScorePerSubject'][] = $subjectListFetch;
        }
         //////// check if schoolBoltCharges is to be applied for this client. if no, send all the students broadsheet
        ///////// else send only those that have paid the schoolBoltCharges
        $hasPaidSchoolBoltCharges = false;
        if($schoolBoltChargesStatus!=1){
           $hasPaidSchoolBoltCharges = true;
        }else{
            // Check if the student has paid the schoolBoltCharges
            $paymentCheckQuery = mysqli_query($conn, "SELECT paymentId FROM PAYMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND studentId='$studentId'  AND statusId=5 AND paymentMethodId IN ('PM001','PM002') LIMIT 1") or die (mysqli_error($conn));
            $hasPaidSchoolBoltCharges = mysqli_num_rows($paymentCheckQuery) > 0;
        } 
        
        if($hasPaidSchoolBoltCharges){
          $response['studentData'][] = $fetch;
        }
    }


    //// delete assessment update from BRANCH_ASSESSMENT_NEW_UPDATE_ALERT_TAB
    $deleteUpdateAlertQuery = "DELETE FROM BRANCH_ASSESSMENT_NEW_UPDATE_ALERT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId'";
    mysqli_query($conn, $deleteUpdateAlertQuery) or die(mysqli_error($conn));

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>