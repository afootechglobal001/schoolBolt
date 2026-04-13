<?php require_once '../../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){
	$response = [
        'response'=> 98,
        'success'=> false,
        'message'=> 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
    ]; 
	goto end;
} 

	///////////////////////geting sequence//////////////////////////
	$sequence=$callclass->_get_sequence_count($conn, 'PS');
	$array = json_decode($sequence, true);
	$no= $array[0]['no'];
	$response['page_session']='PS'.$no.date('Ymdhis');
	
end:
echo json_encode($response);
?>