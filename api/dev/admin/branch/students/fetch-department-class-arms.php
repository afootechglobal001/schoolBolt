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

    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($classId, 'CLASS');
    
$select = "SELECT 
    DISTINCT a.armId AS armId,
    b.armName AS armName
    FROM 
        CLASS_TEACHER_TAB a
    JOIN 
        ARMS_TAB b 
        ON a.clientId = b.clientId AND a.armId = b.armId
    WHERE 
    a.clientId = '$clientId' 
    AND a.branchId = '$branchId' 
    AND a.departmentId = '$departmentId' 
    AND a.classId = '$classId'
    ORDER BY b.armName ASC
";


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
    $response['message']="CLASS ARMS FETCH SUCCESFFULY!";
    $response['allRecordCount']=$allRecordCount;
    $response['armData'] = array(); // Initialize the data array
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $response['armData'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>