<?php require_once '../config/connection.php';?>
<?php
if (!$checkBasicSecurity){/// start if 1
    goto end;
}

    //////////////////declaration of variables//////////////////////////////////////
    $stateId = $_GET['stateId'];
    if (empty($stateId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STATE REQUIRED! Select a state and try again",
        ]; 
        goto end;
	}
    
    $select="SELECT  * FROM SETUP_STATE_LGA_TAB WHERE stateId='$stateId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));

    $response['response']=200; 
    $response['success']=true;
    $response['message']="STATE LGAs FETCH SUCCESFFULY!";
    $response['data'] = array(); // Initialize the data array
    
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $response['data'][] = $fetchQuery;
    }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>