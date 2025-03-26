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
    $armId = $_GET['armId'];
    $staffId=$data['staffId'];
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
    
    if (empty($staffId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    $select = "SELECT * FROM CLASS_TEACHER_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount>0){///start if 1
        /// update CLASS_TEACHER_TAB
        mysqli_query($conn,"UPDATE `CLASS_TEACHER_TAB` 
        SET staffId='$staffId', updatedBy='$loginStaffId' 
        WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId'")or die (mysqli_error($conn));
    }else{
        ///// insert into CLASS_TEACHER_TAB
        mysqli_query($conn,"INSERT INTO `CLASS_TEACHER_TAB`
        (`clientId`, `branchId`, `departmentId`, `classId`, `armId`, `staffId`, `createdBy`, `createdTime`) VALUES 
        ('$clientId', '$branchId', '$departmentId', '$classId', '$armId', '$staffId', '$loginStaffId', NOW())")or die (mysqli_error($conn));
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="CLASS TEACHER UPDATED SUCCESFFULY!";

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
        /////////////////// for  $armId
        $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
        $armDataFetch = mysqli_fetch_assoc($armDataQuery);
        $response['armData'] = $armDataFetch;
    
    $response['data'] = array(); // Initialize the data array
    $select = "SELECT * FROM CLASS_TEACHER_TAB WHERE $clientIds AND branchId='$branchId' AND departmentId='$departmentId' AND classId='$classId' AND armId='$armId' AND staffId='$staffId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];
       
        /////////////////// for  $staffId
        $teacherDataQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$staffId'");
        $teacherDataFetch = mysqli_fetch_assoc($teacherDataQuery);
        $fetchQuery['teacherData'] = $teacherDataFetch;

         /////////////////// for  $createdBy
         $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
         $getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery);
         $fetchQuery['createdBy'] = $getCreatedByfetch;

         /////////////////// for  $updatedBy
         $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
         $getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery);
         $fetchQuery['updatedBy']= $getUpdatedByfetch;

        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>

