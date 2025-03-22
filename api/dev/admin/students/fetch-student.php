<?php require_once '../../config/connection.php';?>
<?php require_once '../../config/staff-session-check.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}
if(!$checkSession){
	$response['response']=99;
	$response['success']=false;
	$response['message']="SESSION EXPIRED! Please LogIn Again.";
	goto end;
}
    //////////////////declaration of variables//////////////////////////////////////
    $q = $_GET['q'];
    $branchId = $_GET['branchId'];
    $studentId = $_GET['studentId'];
    $statusId = $_GET['statusId'];

    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $armId = $_GET['armId'];

  
    if (!empty($studentId)) {
        $studentIds = "AND a.studentId ='$studentId'";
    }
    if (!empty($statusId)) {
        $statusIds = "AND a.statusId IN ($statusId)";
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
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select="SELECT a.*, b.surName, b.firstName FROM STUDENTS_CLASS_TAB a, STUDENTS_TAB b WHERE a.clientId=b.clientId AND a.branchId=b.branchId AND a.studentId=b.studentId  AND  a.clientId='$clientId' AND a.branchId = '$branchId' AND a.session='$session' AND a.termId='$termId' AND a.departmentId='$departmentId' AND a.classId='$classId' AND a.armId='$armId' AND (b.surName LIKE '%$q%' OR b.firstName LIKE '%$q%') $studentIds  $statusIds ORDER BY b.surName ASC";

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
    $response['message']="STUDENT FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
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
        while ($studentDatafetch = mysqli_fetch_assoc($studentDataQuery)) {
            $studentData[] = $studentDatafetch;
        }
        $fetchQuery['studentData'] = $studentData;

         /////////////////// for  $departmentId
         $departmentData=array();
         $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
         while ($departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery)) {
             $departmentData[] = $departmentDataFetch;
         }
         $fetchQuery['departmentData']= $departmentData;
 
         /////////////////// for  $classId
         $classData=array();
         $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
         while ($classDataFetch = mysqli_fetch_assoc($classDataQuery)) {
             $classData[] = $classDataFetch;
         }
         $fetchQuery['classData']= $classData;

         /////////////////// for  $armId
         $armData=array();
         $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
         while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
             $armData[] = $armDataFetch;
         }
         $fetchQuery['armData']= $armData;

         /////////////////// for  $accommodationId
         $accommodationData=array();
         $accommodationDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_ACCOMMODATION_TAB WHERE accommodationId='$accommodationId'");
         while ($accommodationDataFetch = mysqli_fetch_assoc($accommodationDataQuery)) {
             $accommodationData[] = $accommodationDataFetch;
         }
         $fetchQuery['accommodationData']= $accommodationData;

        /////////////////// for  $createdBy
        $createdByData=array();
        $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
        while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
            $createdByData[] = $getCreatedByfetch;
        }
        $fetchQuery['createdBy']= $createdByData;

        /////////////////// for  $updatedBy
        $updatedByData=array();
        $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
        while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
            $updatedByData[] = $getUpdatedByfetch;
        }
        $fetchQuery['updatedBy']= $updatedByData;


        /////////////////// for father
        $fatherData=array();
        $fatherDataQuery = mysqli_query($conn, "SELECT * FROM PARENT_VIEW WHERE $clientIds AND studentId='$studentId' AND recordFor='father'");
        while ($fatherDatafetch = mysqli_fetch_assoc($fatherDataQuery)) {
            $fatherData[] = $fatherDatafetch;
        }
        $fetchQuery['fatherData'] = $fatherData;

        /////////////////// for mother
        $motherData=array();
        $motherDataQuery = mysqli_query($conn, "SELECT * FROM PARENT_VIEW WHERE $clientIds AND studentId='$studentId' AND recordFor='mother'");
        while ($motherDatafetch = mysqli_fetch_assoc($motherDataQuery)) {
            $motherData[] = $motherDatafetch;
        }
        $fetchQuery['motherData'] = $motherData;
        
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>