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
	$publishId=trim(($_GET['publishId']));
	////////////////////////////////////////////////////////////////////////////////

	if (empty($publishId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PUBLISH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	} 
            $response['response']=200; 
            $response['success']=true;
            $response['message']="PAGE CREATED SUCCESFFULY!";
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM PAGES_TAB WHERE $clientIds AND publishId = '$publishId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>