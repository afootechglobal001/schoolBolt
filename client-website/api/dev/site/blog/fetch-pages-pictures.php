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

    $publish_id=$_POST['publish_id'];

    $getPictures = mysqli_query($conn, "SELECT 
    sn, publish_id, pictures
    FROM pages_pictures_tab
    WHERE publish_id = '$publish_id'
    ") or die(mysqli_error($conn));

    $array = $callclass->_get_publish_detail($conn, $publish_id);
    $pix_array = json_decode($array, true);
    $reg_pix = $pix_array[0]['reg_pix'];

    $all_record_count = mysqli_num_rows($getPictures);

    if($all_record_count==0){
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> 'No Image Available!!!'
        ];  
        goto end;
    }

    $response = [
        'response' => 200,
        'success' => true,
        'gallery' => array()
    ];
    
    while ($fetch_query = mysqli_fetch_assoc($getPictures)) {
        $fetch_query['documentStoragePath'] = "$documentStoragePath/page-pictures/";
        $response['gallery'][] =$fetch_query;        
    }

        
end:
echo json_encode($response);
?>