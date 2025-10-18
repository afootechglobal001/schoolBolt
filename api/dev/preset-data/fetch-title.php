<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}

    $select="SELECT  * FROM SETUP_TITLE_TAB";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));

    $response['response']=200; 
    $response['success']=true;
    $response['message']="COUNTRY FETCH SUCCESFFULY!";
    $response['data'] = array(); // Initialize the data array
    
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>