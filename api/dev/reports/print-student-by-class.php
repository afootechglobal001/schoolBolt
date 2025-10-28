<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
    //////////////////declaration of variables//////////////////////////////////////
    $studentId = $_GET['studentId'];
    $branchId = $_GET['branchId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];

    if (!empty($studentId)) {
        $studentIds = "AND a.studentId ='$studentId'";
    }
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($departmentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "DEPARTMENT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($armId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "ARM REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    $select = "SELECT `session`, termId FROM BRANCHES_TAB WHERE $clientIds AND branchId= '$branchId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $session=$fetchQuery['session'];
    $termId=$fetchQuery['termId'];

    $select="SELECT a.*, b.surName, b.firstName FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND b.statusId=1 $studentIds ORDER BY b.surName ASC";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);

    $branchDataQuery = mysqli_query($conn, "SELECT name AS branchName, schoolLogo, address, supportEmail, mobileNumber, schoolCategoryId, studentListHeader, watermark FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
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
    

    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        $response['branchData'] = $branchDataFetch;
        $response['session'] = $session;
        $response['termData'] = $termDataFetch;
        $response['departmentData'] = $departmentDataFetch;
        $response['classData'] = $classDataFetch;
        $response['armData'] = $armDataFetch;
        goto end;
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="STUDENT FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['branchData'] = $branchDataFetch;
    $response['session'] = $session;
    $response['termData'] = $termDataFetch;
    $response['departmentData'] = $departmentDataFetch;
    $response['classData'] = $classDataFetch;
    $response['armData'] = $armDataFetch;
    $response['data'] = array(); // Initialize the data array

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $branchId=$fetchQuery['branchId'];
        $studentId=$fetchQuery['studentId'];
        $departmentId=$fetchQuery['departmentId'];
        $classId=$fetchQuery['classId'];
        $armId=$fetchQuery['armId'];
        $accommodationId=$fetchQuery['accommodationId'];
        $statusId=$fetchQuery['statusId'];
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];


        /////////////////// for  $studentId
        $studentData=array();
        $studentDataQuery = mysqli_query($conn, "SELECT * FROM STUDENT_VIEW WHERE $clientIds AND studentId='$studentId'");
        $studentDatafetch = mysqli_fetch_assoc($studentDataQuery);
        $fetchQuery['studentData'] = $studentDatafetch;

         /////////////////// for  $departmentId
         $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
         $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
         $fetchQuery['departmentData'] = $departmentDataFetch;
       
 
         /////////////////// for  $classId
         $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
         $classDataFetch = mysqli_fetch_assoc($classDataQuery);
         $fetchQuery['classData'] = $classDataFetch;

         /////////////////// for  $armId
         $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
         $armDataFetch = mysqli_fetch_assoc($armDataQuery);
         $fetchQuery['armData'] = $armDataFetch;

         /////////////////// for  $accommodationId
         $accommodationDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_ACCOMMODATION_TAB WHERE accommodationId='$accommodationId'");
         $accommodationDataFetch = mysqli_fetch_assoc($accommodationDataQuery);
         $fetchQuery['accommodationData'] = $accommodationDataFetch;

        /////////////////// for father
        $fatherDataQuery = mysqli_query($conn, "SELECT * FROM PARENT_VIEW WHERE $clientIds AND studentId='$studentId' AND recordFor='father'");
        $fatherDatafetch = mysqli_fetch_assoc($fatherDataQuery);
        $fetchQuery['fatherData'] = $fatherDatafetch;

        /////////////////// for mother
        $motherDataQuery = mysqli_query($conn, "SELECT * FROM PARENT_VIEW WHERE $clientIds AND studentId='$studentId' AND recordFor='mother'");
        $motherDatafetch = mysqli_fetch_assoc($motherDataQuery);
        $fetchQuery['motherData'] = $motherDatafetch;
        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>