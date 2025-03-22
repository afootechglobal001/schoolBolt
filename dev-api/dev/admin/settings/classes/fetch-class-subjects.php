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
    $classId = $_GET['classId'];

    if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    
    $select = "SELECT * FROM SUBJECT_STRUCTURE_TAB WHERE $clientIds AND classId= '$classId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $subjectIds .= $fetchQuery['subjectId'] . ",";
    }
    $subjectArray = !empty($subjectIds) ? explode(',', rtrim($subjectIds, ',')) : [];
   

    $select = "SELECT className FROM CLASSES_TAB WHERE $clientIds AND classId= '$classId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $fetchQuery = mysqli_fetch_assoc($query);
    $className=$fetchQuery['className'];



    $select="SELECT subjectId, subjectName FROM SUBJECTS_TAB WHERE $clientIds";
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
    $response['message']="CLASS SUBJECTS FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['classId']=$classId;
    $response['className']=$className;
    $response['data'] = array(); // Initialize the data array
    $noOfClasses=0;
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $subjectId=$fetchQuery['subjectId'];
        $fetchQuery['checked'] = in_array($subjectId, $subjectArray);
        $noOfsubjects +=$fetchQuery['checked'] ? 1 : 0;
        $response['data'][] = $fetchQuery;
    }
    $response['noOfsubjects']=$noOfsubjects;
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>