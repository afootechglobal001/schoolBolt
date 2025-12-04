<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}

    //////////////////declaration of variables//////////////////////////////////////
    $branchId = $_GET['branchId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];
    $subjectId = $_GET['subjectId'];

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    validateEmptyField($armId, 'ARM');
    validateEmptyField($subjectId, 'SUBJECT');


    $select = "SELECT `session`, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId= '$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $session=$fetchQuery['session'];
  
    /////////////////// for  $branchId
    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, cummulativeMarkBookHeader, watermark  FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    /////////////////// for  $departmentId
    $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
    $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
    /////////////////// for  $classId
    $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
    $classDataFetch = mysqli_fetch_assoc($classDataQuery);
    /////////////////// for  $armId
    $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
    $armDataFetch = mysqli_fetch_assoc($armDataQuery);
    /////////////////// for  $subjectId
    $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
    $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);


    $select = "SELECT 
    DISTINCT studentId AS studentId
    FROM
    BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB a
    WHERE $clientIds
    AND branchId='$branchId'
    AND session='$session'
    AND departmentId='$departmentId'
    AND classId='$classId'
    AND armId='$armId'
    AND subjectId='$subjectId'";
    
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
      if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }


    $response['response']=200; 
    $response['success']=true;
    $response['message']="SCORE SHEET FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['branchData'] = $branchDataFetch;
    $response['session'] = $session;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['subjectData'] = $subjectDataFetch;
    /////////////////// clear previous data //////////////////////
    mysqli_query($conn,"DELETE FROM BRANCH_CONTEMPORARY_MARK_BOOK_FOR_EACH_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId'")or die (mysqli_error($conn));

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $studentId=$fetchQuery['studentId'];
        //// get first term scores
        $firstTermScoresQuery = mysqli_query($conn, "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId=1 AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND studentId='$studentId'");
        $firstTermScoresFetch = mysqli_fetch_assoc($firstTermScoresQuery);
        $firstTermScores = $firstTermScoresFetch ? $firstTermScoresFetch['allAssessmentTotalMark'] : null;
        $firstTermSitting = $firstTermScoresFetch ?  1 : 0;

        //// get second term scores
        $secondTermScoresQuery = mysqli_query($conn, "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId=2 AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND studentId='$studentId'");
        $secondTermScoresFetch = mysqli_fetch_assoc($secondTermScoresQuery);
        $secondTermScores = $secondTermScoresFetch ? $secondTermScoresFetch['allAssessmentTotalMark'] : null;
        $secondTermSitting = $secondTermScoresFetch ?  1 : 0;

        /// get third term scores
        $thirdTermScoresQuery = mysqli_query($conn, "SELECT allAssessmentTotalMark FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId=3 AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND studentId='$studentId'");
        $thirdTermScoresFetch = mysqli_fetch_assoc($thirdTermScoresQuery);
        $thirdTermScores = $thirdTermScoresFetch ? $thirdTermScoresFetch['allAssessmentTotalMark'] : null;
        $thirdTermSitting = $thirdTermScoresFetch ?  1 : 0;

        $sittings= $firstTermSitting + $secondTermSitting + $thirdTermSitting;
        /// get average score
        $averageSciore= ROUND(((($firstTermScoresFetch ? $firstTermScores : 0) + ($secondTermScoresFetch ? $secondTermScores : 0) + ($thirdTermScoresFetch ? $thirdTermScores : 0)) / $sittings),2);
        $grade = getGrade($averageSciore);
        $remark = getRemark($averageSciore);

        mysqli_query($conn,"INSERT INTO `BRANCH_CONTEMPORARY_MARK_BOOK_FOR_EACH_SUBJECT_TAB`
        (`clientId`, `branchId`, `session`, `departmentId`, `classId`, `armId`, `subjectId`, `studentId`, `firstTermScore`, `secondTermScore`, `thirdTermScore`, `average`, `grade`, `remark`, `createdTime`) VALUES 
        ('$clientId', '$branchId', '$session', '$departmentId', '$classId', '$armId', '$subjectId', '$studentId', '$firstTermScores', '$secondTermScores', '$thirdTermScores', '$averageSciore', '$grade', '$remark', NOW())")or die (mysqli_error($conn));
       
    }

    ///calculate position
    $select="SELECT studentId, average FROM BRANCH_CONTEMPORARY_MARK_BOOK_FOR_EACH_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' ORDER BY average DESC";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));

    $markChecker=0;
    $count=0;
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $count++;
        $studentId=$fetchQuery['studentId'];
        $average=$fetchQuery['average'];

       if($markChecker!=$average){
            $markChecker=$average;
            $position=$count . getOrdinalSuffix($count);
       }
       mysqli_query($conn,"UPDATE BRANCH_CONTEMPORARY_MARK_BOOK_FOR_EACH_SUBJECT_TAB  SET overallPosition='$position' WHERE $clientIds AND branchId='$branchId' AND session='$session' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND studentId='$studentId'")or die (mysqli_error($conn));
    }


 /////// get table header data based on termId /////
    $response['subjectAssessmentData'] = array();
    
    /// get all tableTitles
    $tableTitles="SN, FULLNAME";
    $termCount=1;
    while($termCount<=3){
        $assessmentSelect="SELECT assessmentId, assessmentName, assessmentTotalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0";
        $assessmentQuery=mysqli_query($conn,$assessmentSelect)or die (mysqli_error($conn));
        while ( $assessmentFetch = mysqli_fetch_assoc($assessmentQuery)){
            $assessmentName=$assessmentFetch['assessmentName'];
            $assessmentTotalScore=$assessmentFetch['assessmentTotalScore'];
            $tableTitles .= ", $assessmentName ($assessmentTotalScore)";
            if ($termCount == 1) {
                $response['subjectAssessmentData'][] = $assessmentFetch;
            }
        }
        $tableTitles .= ", TOTAL, POST.IN CLASS";
        $termCount++;
    }

   
    $tableTitles .= ", FIRST TERM SCORE, SECOND TERM SCORE, THIRD TERM SCORE, AVERAGE, GRADE, REMARK, OVERALL POSITION";
    $response['tableTitles'] = $tableTitles;
////////////////////// new get mark book data /////////////////////////////////////////
    $response['markBookData'] = array(); // Initialize the data array
    $select = "SELECT 
    DISTINCT a.*, b.surName, b.firstName, b.otherNames
    FROM
    BRANCH_CONTEMPORARY_MARK_BOOK_FOR_EACH_SUBJECT_TAB a
    JOIN STUDENTS_TAB b ON   a.clientId = b.clientId AND a.branchId = b.branchId AND a.studentId = b.studentId
    WHERE a.clientId = '$clientId'
    AND a.branchId='$branchId'
    AND a.session='$session'
    AND a.departmentId='$departmentId'
    AND a.classId='$classId'
    AND a.armId='$armId'
    AND a.subjectId='$subjectId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $studentId = $fetchQuery['studentId'];
        //// get terminalAssessmentsData for all the terms
        $terminalAssessmentsData=array();
        $term=1;
        while($term<=3){
           $eachTermAssessmentsData = array();
           $assessmentsData = array();  // <<< RESET THIS HERE
            $eachTermAssessmentsDataQuery = mysqli_query($conn, "SELECT assessmentId FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '')  AND assessmentTotalScore>0");
            while ($assessmentFetch = mysqli_fetch_assoc($eachTermAssessmentsDataQuery)) {
                $assessmentId = $assessmentFetch['assessmentId'];
                $studentAssessmentQuery = mysqli_query($conn, "SELECT a.markObtained AS markObtained 
                FROM BRANCH_ASSESSMENT_RECORD_DETAILS_TAB a
                JOIN BRANCH_ASSESSMENT_RECORDS_SUMMARY_TAB b 
                ON a.recordId = b.recordId
                WHERE b.clientId ='$clientId' 
                AND b.branchId='$branchId' 
                AND b.session='$session' 
                AND b.termId='$term' 
                AND b.departmentId='$departmentId' 
                AND b.classId='$classId' 
                AND b.armId='$armId' 
                AND b.subjectId='$subjectId' 
                AND a.studentId='$studentId' 
                AND b.assessmentId='$assessmentId'");
                
                
                $studentAssessmentFetch = mysqli_fetch_assoc($studentAssessmentQuery);
                $markObtained = $studentAssessmentFetch ? $studentAssessmentFetch['markObtained'] : null;
                $assessmentsData[] = array(
                    'assessmentId' => $assessmentId,
                    'markObtained' => $markObtained
                );
            }
                $eachTermAssessmentsData['term'] = $term;
                $eachTermAssessmentsData['assessments'] = $assessmentsData;

                ///// get total mark obtained and position for the term
                $markObtainedQuery = mysqli_query($conn, "SELECT allAssessmentTotalMark, position FROM BRANCH_STUDENT_TOTAL_PERCENTAGE_PER_SUBJECT_TAB WHERE $clientIds AND branchId='$branchId' AND session='$session' AND termId='$term' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND subjectId='$subjectId' AND studentId='$studentId'");
                $markObtainedFetch = mysqli_fetch_assoc($markObtainedQuery);
                $totalMarkObtained = $markObtainedFetch ? $markObtainedFetch['allAssessmentTotalMark'] : null;
                $positionInClass = $markObtainedFetch ? $markObtainedFetch['position'] : null;

                $eachTermAssessmentsData['totalMarkObtained'] = $totalMarkObtained;
                $eachTermAssessmentsData['positionInClass'] = $positionInClass;
            
           
            $terminalAssessmentsData[] = $eachTermAssessmentsData;
            $term++;
        }
        $fetchQuery['terminalAssessments'] = $terminalAssessmentsData;
        
        //// get assessments for second term
        // $secondTermAssessmentsData = array();
        $response['markBookData'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////


//// $response['studentsData'][] = $fetchQuery;
end:
echo json_encode($response);
?>