<?php require_once '../config/connection.php';?>
<?php require_once '../config/staff-session-check.php';?>
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
    validateEmptyField($branchId, 'BRANCH');
    
    $response['response']=200; 
    $response['success']=true;
    $response['message']="DEPARTMENT CLASSES FETCH SUCCESFFULY!";
    $response['data'] = array(); // Initialize the data array

    $select = "SELECT 
        a.departmentId, 
        b.departmentName 
    FROM BRANCH_DEPARTMENTS_TAB a 
    JOIN DEPARTMENTS_TAB b 
        ON a.clientId=b.clientId 
        AND a.departmentId = b.departmentId 
    WHERE 
        a.clientId ='$clientId' 
        AND a.branchId= '$branchId'
    ";

    $query = mysqli_query($conn, $select) or die(mysqli_error($conn));

    $response['data'] = array();

    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        
        $departmentId = $fetchQuery['departmentId'];
        $fetchQuery['classesData'] = array();

        // GET CLASSES
        $classDataQuery = mysqli_query($conn, " SELECT 
            DISTINCT 
                a.classId,
                b.className
            FROM CLASS_TEACHER_TAB a
            JOIN CLASSES_TAB b 
                ON a.clientId = b.clientId
                AND a.classId = b.classId 
            WHERE 
                a.clientId = '$clientId'
                AND a.branchId = '$branchId'
                AND a.departmentId = '$departmentId'
        ");

        while ($classDataFetch = mysqli_fetch_assoc($classDataQuery)) {

            $classId = $classDataFetch['classId'];
            $classDataFetch['armData'] = array();

            // GET ARMS
            $armDataQuery = mysqli_query($conn, " SELECT 
                DISTINCT 
                    a.armId,
                    b.armName
                FROM CLASS_TEACHER_TAB a
                JOIN ARMS_TAB b 
                    ON a.clientId = b.clientId
                    AND a.armId = b.armId 
                WHERE 
                    a.clientId = '$clientId'
                    AND a.branchId = '$branchId'
                    AND a.departmentId = '$departmentId'
                    AND a.classId = '$classId'
            ");

            while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
                $classDataFetch['armData'][] = $armDataFetch;
            }

            $fetchQuery['classesData'][] = $classDataFetch;
        }

        // 👉 Now we add department data inside the loop
        $response['data'][] = $fetchQuery;
    }

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>