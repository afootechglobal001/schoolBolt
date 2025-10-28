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

    
     /// get scoresheet coloumns
    $parentAssessmentSelect="SELECT assessmentId, assessmentName, assessmentTotalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds  AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '') AND assessmentTotalScore>0";
    $parentAssessmentQuery=mysqli_query($conn,$parentAssessmentSelect)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($parentAssessmentQuery);
    if($allRecordCount==0){
        $response['response']=200;
        $response['success']=false;
        $response['message']="Error! Assessment settings NOT done yet. Contact the system administrator for help.";
        goto end;
    }
    $tableTitles="SN, FULL NAME";
    while ($fetchParentAssessmentQuery = mysqli_fetch_assoc($parentAssessmentQuery)) {    
        $parentAssessmentId = $fetchParentAssessmentQuery['assessmentId'];    
        $parentAssessmentName = $fetchParentAssessmentQuery['assessmentName'];
        $parentAssessmentTotalScore= $fetchParentAssessmentQuery['assessmentTotalScore'];

        $select="SELECT assessmentName, assessmentTotalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds  AND branchId = '$branchId' AND parentId='$parentAssessmentId' AND assessmentTotalScore>0";
        $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
        while ($fetch = mysqli_fetch_assoc($query)) {        
            $assessmentName = $fetch['assessmentName'];
            $assessmentTotalScore= $fetch['assessmentTotalScore'];
            $tableTitles .=", $assessmentName ($assessmentTotalScore)";
        }

        $tableTitles .=", $parentAssessmentName ($parentAssessmentTotalScore)";
    }
    $tableTitles .=", REMARKS";




    $select = "SELECT `session`, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId= '$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $session=$fetchQuery['session'];
    $termId=$fetchQuery['termId'];

    $select="SELECT a.studentId, b.surName, b.firstName, b.otherNames, b.passport FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND b.statusId=1 ORDER BY b.surName ASC";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);

    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, scoreSheetHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
    $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
    
    /////////////////// for  $termId
    $termDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_TERM_TAB WHERE termId='$termId'");
    $termDataFetch = mysqli_fetch_assoc($termDataQuery);
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
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['subjectData'] = $subjectDataFetch;
    $response['tableTitles']=$tableTitles;
    $response['studentsData'] = array(); // Initialize the data array

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {        
        $response['studentsData'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>