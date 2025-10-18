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
    $departmentId = $_GET['departmentId'];

    if (empty($departmentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "DEPARTMENT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    
    $select = "SELECT * FROM CLASS_STRUCTURE_TAB WHERE $clientIds AND parentId= '$departmentId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $classIds .= $fetchQuery['childId'] . ",";
    }
    $classArray = !empty($classIds) ? explode(',', rtrim($classIds, ',')) : [];
   

    $select = "SELECT departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId= '$departmentId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $departmentName=$fetchQuery['departmentName'];



    $select="SELECT classId, className FROM CLASSES_TAB WHERE $clientIds";
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
    $response['message']="DEPARTMENT CLASSES FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['departmentId']=$departmentId;
    $response['departmentName']=$departmentName;
    $response['data'] = array(); // Initialize the data array
    $noOfClasses=0;
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $classId=$fetchQuery['classId'];
        $fetchQuery['checked'] = in_array($classId, $classArray);
        $noOfClasses +=$fetchQuery['checked'] ? 1 : 0;
        $response['data'][] = $fetchQuery;
    }
    $response['noOfClasses']=$noOfClasses;
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>