<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/admin-session-check.php';?>
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

	if($check==0){ 
		$response = [
			'response'=> 99,
			'success'=> false,
			'message'=> 'SESSION EXPIRED! Please LogIn Again.'
		];  
		goto end;
	}
        $publish_id=$_POST['publish_id'];

        $getPictures = mysqli_query($conn, "SELECT 
        sn, publish_id, pictures 
        FROM pages_pictures_tab 
        WHERE publish_id = '$publish_id'") or die(mysqli_error($conn));
    
        $all_record_count = mysqli_num_rows($getPictures);
 
        if($all_record_count==0){
            $response = [
                'response'=> 200,
                'success'=> true,
                'message'=> 'No Record found!!!'
            ];  
            goto end;
        }

        $response = [
            'response' => 200,
            'success' => true,
            'picture_details' => array()
        ];
        
        while ($fetch_query = mysqli_fetch_assoc($getPictures)) {
            $fetch_query['documentStoragePath'] = "$documentStoragePath/page-pictures/";
            $response['picture_details'][] = $fetch_query;
        }

        
end:
echo json_encode($response);
?>