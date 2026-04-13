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

        if(empty($publish_id)){ 
            $response = [
                'response'=> 99,
                'success'=> false,
                'message'=> 'PUBLISH ID REQUIRED! Check Publish ID and try Again.'
            ];  
            goto end;
        }

        if(isset($_FILES["pictures"]["name"])){
          $totalFiles = count($_FILES["pictures"]["name"]);
          $filesArray = array();

            for ($i = 0; $i < $totalFiles; $i++){
                $imageName = $_FILES["pictures"]["name"][$i];
                $tmpName = $_FILES["pictures"]["tmp_name"][$i];

                $imageExtension = explode('.', $imageName);

                $name = $imageExtension[0];
                $imageExtension = strtolower(end($imageExtension));

                $newImageName = $publish_id."-".$i.uniqid();
                $newImageName .= ".".$imageExtension;

                $uploadPath = $publishPicturesPath . $newImageName;
                
                move_uploaded_file($tmpName, $uploadPath);
                mysqli_query($conn,"INSERT INTO `pages_pictures_tab`
                (`publish_id`, `pictures`) VALUES
                ('$publish_id', '$newImageName')");
            }
        }
    
            $response = [
                'response'=> 200,
                'success'=> true,
                'message'=> "SUCCESS! Pictures Uploaded Successful!"         
            ]; 

            /////////// get alert//////////////////////////////////
            $alert_detail="Success Alert: Page Pictures was uploaded successfully by $login_staff_fullname. DETAILS: ID: $publish_id";
            $callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
       
end:
echo json_encode($response);
?>