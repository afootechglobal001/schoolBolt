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

    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, principalSignature, address, supportEmail, mobileNumber, timeSchoolOpened, schoolResumptionDate, schoolCategoryId, terminalResultHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
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
    $response['message']="TERMINAL RESULT FETCHED  SUCCESFFULY!";
    $response['clientWebsite'] = $dbClientAddress;
    $response['session'] = $session;
    $response['branchData'] = $branchDataFetch;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;


    /////// get table header data based on termId /////
    $response['subjectAssessmentData'] = array();
    $assessmentSelect="SELECT assessmentId, assessmentName, assessmentTotalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0";
    $assessmentQuery=mysqli_query($conn,$assessmentSelect)or die (mysqli_error($conn));
    /// get all tableTitles
    $tableTitles="SN, SUBJECTS, FIRST TERM SCORE(100), SECOND TERM SCORE (100)";
    while ( $assessmentFetch = mysqli_fetch_assoc($assessmentQuery)){
        $assessmentName=$assessmentFetch['assessmentName'];
        $assessmentTotalScore=$assessmentFetch['assessmentTotalScore'];
        $tableTitles .= ", $assessmentName ($assessmentTotalScore)";
        $response['subjectAssessmentData'][] = $assessmentFetch;
    }
    $tableTitles .=",TOTAL SCORE(100), MIN SCORE, MAX SCORE, AVERAGE SCORE, POSTN. IN CLASS, GRADE, REMARKS";
    $response['tableTitles'] = $tableTitles;



    
    $response['eachStudentResultData'] = array();
    ///get all assessment counts for this branch
    $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0   $assessmentIds";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allAssessmentsCount=mysqli_num_rows($query);
    
      //// get all students as at the time of assessment
    $select="SELECT 
    a.studentId,
    a.totalSubjects,
    a.totalMarkObtainable,
    a.totalMarkObtained,
    a.totalPercentage,
    a.position AS positionInClass,
    a.principalComment,
    a.noOfStudentsInArm,
    a.noOfStudentsInClass
    FROM 
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_TERM_TAB a
    JOIN
    STUDENTS_TAB b  ON a.clientId = b.clientId AND a.studentId = b.studentId
    WHERE 
    a.clientId='$clientId' 
    AND a.branchId = '$branchId' 
    AND a.session = '$session' 
    AND a.termId = '$termId' 
    AND a.departmentId = '$departmentId' 
    AND a.classId = '$classId' 
    AND a.armId = '$armId'
    ORDER BY b.surName ASC";
    $terminalQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($terminalfetch = mysqli_fetch_assoc($terminalQuery)){ 
        $studentId=$terminalfetch['studentId'];
        ////// get student data /////
        $studentDataQuery=mysqli_query($conn,"SELECT studentId, officialStudentId, surName, firstName, otherNames, passport, genderName FROM STUDENT_VIEW WHERE $clientIds AND branchId='$branchId' AND studentId='$studentId'")or die (mysqli_error($conn));
        $studentDataFetch = mysqli_fetch_assoc($studentDataQuery);
        $terminalfetch['studentData'] = $studentDataFetch;
        
        ////// get student subject data /////
        $studentSubjectSelect = "SELECT 
        a.subjectId, 
        b.subjectName,
        a.allAssessmentTotalMark AS totalMark,
        a.grade,
        a.position AS positionInClass,
        a.overallPosition,
        a.remark
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
        AND a.numberOfSittings=$allAssessmentsCount
        ORDER BY b.subjectName";
        $studentSubjectQuery = mysqli_query($conn, $studentSubjectSelect) or die(mysqli_error($conn));
        while ($studentSubjectFetch = mysqli_fetch_assoc($studentSubjectQuery)) {
            $subjectId = $studentSubjectFetch['subjectId'];


            ////// get firstTermScore
            $firstTermScoreSelect="SELECT
            allAssessmentTotalMark AS firstTermScore
            FROM
            BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
            WHERE 
            $clientIds 
            AND branchId='$branchId' 
            AND session='$session' 
            AND termId=1
            AND departmentId='$departmentId' 
            AND classId='$classId' 
            AND armId='$armId'
            AND studentId='$studentId'
            AND numberOfSittings=$allAssessmentsCount";
            $firstTermScoreQuery = mysqli_query($conn, $firstTermScoreSelect) or die(mysqli_error($conn));
            $firstTermScoreFetch = mysqli_fetch_assoc($firstTermScoreQuery);
            $studentSubjectFetch['firstTermScore'] =$firstTermScoreFetch['firstTermScore'];
            
            ////// get secondTermScore
            $secondTermScoreSelect="SELECT
            allAssessmentTotalMark AS secondTermScore
            FROM
            BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
            WHERE 
            $clientIds 
            AND branchId='$branchId' 
            AND session='$session' 
            AND termId=2
            AND departmentId='$departmentId' 
            AND classId='$classId' 
            AND armId='$armId'
            AND studentId='$studentId'
            AND numberOfSittings=$allAssessmentsCount";
            $secondTermScoreQuery = mysqli_query($conn, $secondTermScoreSelect) or die(mysqli_error($conn));
            $secondTermScoreFetch = mysqli_fetch_assoc($secondTermScoreQuery);
            $studentSubjectFetch['secondTermScore'] =$secondTermScoreFetch['secondTermScore'];

            // Get assessments for the subject
            $assessmentSelect = "SELECT assessmentId FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0";
            $assessmentQuery = mysqli_query($conn, $assessmentSelect) or die(mysqli_error($conn));
            while ($assessmentFetch = mysqli_fetch_assoc($assessmentQuery)) {
                $assessmentId = $assessmentFetch['assessmentId'];

                // Get markObtained for each assessment
                $markObtainedSelect = "SELECT markObtained 
                FROM 
                BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a
                JOIN 
                BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b ON a.recordId=b.recordId
                WHERE 
                b.clientId='$clientId' 
                AND b.branchId='$branchId' 
                AND b.session='$session' 
                AND b.termId='$termId' 
                AND b.departmentId='$departmentId' 
                AND b.classId='$classId' 
                AND b.armId='$armId' 
                AND b.subjectId='$subjectId' 
                AND b.assessmentId='$assessmentId'
                AND a.studentId='$studentId'";
                $markObtainedQuery = mysqli_query($conn, $markObtainedSelect) or die(mysqli_error($conn));
                $markObtainedFetch = mysqli_fetch_assoc($markObtainedQuery);
                $studentSubjectFetch[$assessmentId]['markObtained'] = $markObtainedFetch['markObtained'] ? $markObtainedFetch['markObtained'] : '';
            }
            /// get min, max, average score in class for the subject from BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
            $minMaxAvgSelect = "SELECT 
            MIN(allAssessmentTotalMark) AS minScore,
            MAX(allAssessmentTotalMark) AS maxScore,
            AVG(allAssessmentTotalMark) AS averageScore
            FROM 
            BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB
            WHERE 
            clientId='$clientId'
            AND branchId='$branchId'
            AND session='$session'
            AND termId='$termId'
            AND departmentId='$departmentId'
            AND classId='$classId'  
            AND armId='$armId'
            AND subjectId='$subjectId'
            AND numberOfSittings=$allAssessmentsCount";
            $minMaxAvgQuery = mysqli_query($conn, $minMaxAvgSelect) or die(mysqli_error($conn));
            $minMaxAvgFetch = mysqli_fetch_assoc($minMaxAvgQuery);
            $studentSubjectFetch['minScore'] = $minMaxAvgFetch['minScore'] ? $minMaxAvgFetch['minScore'] : '';
            $studentSubjectFetch['maxScore'] = $minMaxAvgFetch['maxScore'] ? $minMaxAvgFetch['maxScore'] : '';
            $studentSubjectFetch['averageScore'] = $minMaxAvgFetch['averageScore'] ? number_format($minMaxAvgFetch['averageScore'], 2, '.', '')  : '';
            $terminalfetch['studentSubjectAssessmentData'][] = $studentSubjectFetch;
        }

        //// get students attendance
        $teacherCommentDataQuery = mysqli_query($conn, "SELECT timeSchoolOpened, numberOfDaysPresents, numberOfDaysAbsents FROM BRANCH_STUDENT_ATTENDANCE_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND studentId='$studentId'");
        $teacherCommentDataFetch = mysqli_fetch_assoc($teacherCommentDataQuery);
        $terminalfetch['attendanceData'] = [
        'timeSchoolOpened'     => $teacherCommentDataFetch['timeSchoolOpened'] ?? 0,
        'numberOfDaysPresents' => $teacherCommentDataFetch['numberOfDaysPresents'] ?? 0,
        'numberOfDaysAbsents'  => $teacherCommentDataFetch['numberOfDaysAbsents'] ?? 0,
        ];

        //////////// get student classTeachersComment
        $classTeachersCommentDataQuery = mysqli_query($conn, "SELECT classTeachersComment FROM BRANCH_TEACHERS_COMMENTS_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$termId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND studentId='$studentId'");
        $classTeachersCommentDataFetch = mysqli_fetch_assoc($classTeachersCommentDataQuery);
        $terminalfetch['classTeachersComment']= $classTeachersCommentDataFetch['classTeachersComment'] ?? '';


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
    }//// end of while loop for all students
     
     
end:
echo json_encode($response);
?>