<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>
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
    $branchId = $_GET['branchId'];
    $departmentId = $_GET['departmentId'];
    $classId = $_GET['classId'];
    $subjectId = $_GET['subjectId'];
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
    
    if (empty($subjectId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "SUBJECT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}


   

    $response['response']=200; 
    $response['success']=true;
    $response['message']="SUBJECT TEACHER UPDATED SUCCESFFULY!";

        /////////////////// for  $branchId
        $branchDataQuery = mysqli_query($conn, "SELECT branchId, name AS branchName FROM BRANCHES_TAB WHERE $clientIds AND branchId='$branchId'");
        $branchDataFetch = mysqli_fetch_assoc($branchDataQuery);
        $response['branchData'] = $branchDataFetch;
        /////////////////// for  $departmentId
        $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
        $departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery);
        $response['departmentData'] = $departmentDataFetch;
    
        /////////////////// for  $classId
        $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
        $classDataFetch = mysqli_fetch_assoc($classDataQuery);
        $response['classData'] = $classDataFetch;
        /////////////////// for  $subjectId
        $subjectDataQuery = mysqli_query($conn, "SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds AND subjectId='$subjectId'");
        $subjectDataFetch = mysqli_fetch_assoc($subjectDataQuery);
        $response['subjectData'] = $subjectDataFetch;
    
    $response['data'] = array(); // Initialize the data array
    $select = "SELECT * FROM CLASS_SUBJECT_ALLOCATION_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND subjectId='$subjectId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $staffId=$fetchQuery['staffId'];
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];
       
        /////////////////// for  $staffId
        $teacherDataQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$staffId'");
        $teacherDataFetch = mysqli_fetch_assoc($teacherDataQuery);
        $fetchQuery['teacherData'] = $teacherDataFetch;

         /////////////////// for  $createdBy
         $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
         $getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery);
         $fetchQuery['createdBy'] = $getCreatedByfetch;

         /////////////////// for  $updatedBy
         $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
         $getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery);
         $fetchQuery['updatedBy']= $getUpdatedByfetch;

        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

