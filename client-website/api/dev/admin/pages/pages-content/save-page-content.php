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
        $publish_id = trim(strtoupper($_POST['publish_id']));
        $page_url = $_POST['page_url'];
        $page_title = str_replace("'", "\'", $_POST['page_title']);
        $seo_keywords = str_replace("'", "\'", $_POST['seo_keywords']);
        $seo_description =str_replace("'", "\'", $_POST['seo_description']);
        $seo_flyer = $_FILES['seo_flyer']['name'];
        $page_content =str_replace("'", "\'", $_POST['page_content']);
        
        if (empty($publish_id)){
			$response = [
				'response'=> 100,
				'success'=> false,
				'message'=> 'PUBLISH ID REQUIRED! Check Publish ID and try again.'
			];
			goto end;
		}

        if (empty($page_url)){
			$response = [
				'response'=> 101,
				'success'=> false,
				'message'=> 'PAGE URL REQUIRED! Check Page Url and try again.'
			];
			goto end;
		}

        if (empty($page_title)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> 'PAGE TITLE REQUIRED! Check Page Title and try again.'
			];
			goto end;
		}

        if (empty($seo_keywords)){
			$response = [
				'response'=> 103,
				'success'=> false,
				'message'=> 'SEO KEYWORDS REQUIRED! Check Seo Keywords and try again.'
			];
			goto end;
		}

        if (empty($seo_description)){
			$response = [
				'response'=> 104,
				'success'=> false,
				'message'=> 'SEO DESCRIPTION REQUIRED! Check Seo Description and try again.'
			];
			goto end;
		}

        if (empty($page_content)){
			$response = [
				'response'=> 106,
				'success'=> false,
				'message'=> 'PAGE CONTENT REQUIRED! Check Page Content and try again.'
			];
			goto end;
		}

            $publish_id_check = mysqli_query($conn, "SELECT publish_id FROM publish_tab WHERE publish_id='$publish_id'");
			$publish_id_count = mysqli_num_rows($publish_id_check);
			
			if ($publish_id_count == 0) {
				$response = [
					'response' => 107,
					'success' => false,
					'message' => "NO RECORD MATCH FOR THE PUBLISH ID! $publish_id doesn't exist"
				];
				goto end;
			}
                
                $query=mysqli_query($conn,"SELECT * FROM pages_tab WHERE publish_id='$publish_id'");
                $count_pages=mysqli_num_rows($query);

                if ($count_pages>0){

                    if ($seo_flyer!=''){    

                        $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
                        $extension = pathinfo($_FILES['seo_flyer']['name'], PATHINFO_EXTENSION);

                        if (!in_array($extension, $allowedExts)) {
                            $response = [
                                'response' => 108,
                                'success' => false,
                                'message' => 'INVALID PICTURE FORMAT! Check the picture format and try again.'
                            ];  
                            goto end; 
                        }

                            ////// GET CURRENT SEO FLYER FROM DATABASE //////////////////////
                            $query=mysqli_query($conn,"SELECT * FROM pages_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
                            $fetch=mysqli_fetch_array($query);
                            $db_seo_flyer=$fetch['seo_flyer'];
                
                            unlink($seoflyerPixPath . $db_seo_flyer);
                        
                            $datetime = date("Ymdhi");
                            $seo_flyer = $publish_id . '_' . $datetime . '_' . $_FILES['seo_flyer']['name']; // Use original file name
                            $uploadPath = $seoflyerPixPath . $seo_flyer;
                        
                            if (!move_uploaded_file($_FILES["seo_flyer"]["tmp_name"], $uploadPath)) {
                                $response = [
                                    'response' => 109,
                                    'success' => false,
                                    'message' => 'PICTURE UPLOAD ERROR! Contact your Engineer For Help'
                                ];  
                                goto end; 
                            }

                            mysqli_query($conn,"UPDATE pages_tab SET seo_flyer='$seo_flyer' WHERE publish_id='$publish_id'")or die (mysqli_error($conn));  
                    }

                        ////// GET CURRENT URL FROM DATABASE //////////////////////
                        $query=mysqli_query($conn,"SELECT * FROM pages_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
                        $fetch=mysqli_fetch_array($query);
                        $db_page_url=$fetch['page_url'];
                        $db_seo_flyer=$fetch['seo_flyer'];

                        mysqli_query($conn,"UPDATE pages_tab SET page_url='$page_url', page_title='$page_title', seo_keywords='$seo_keywords', seo_description='$seo_description', page_content='$page_content', modified_by='$login_staff_id', updated_date=NOW() WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
                        
                        $query = mysqli_query($conn, "SELECT page_category_id FROM publish_tab WHERE publish_id='$publish_id'");
                        $fetch=mysqli_fetch_array($query);
                        $page_category_id=$fetch['page_category_id'];

                        $response = [
                            'response'=> 200,
                            'success'=> true,
                            'message'=> "SUCCESS! Page Updated Successful!",
                            'page_category_id'=> $page_category_id,
                            'publish_id'=> $publish_id,
                            'page_url'=> $page_url,
                            'db_page_url'=> $db_page_url,
                            'page_title'=> $page_title,
                            'db_seo_flyer'=> $db_seo_flyer,
                            'seo_flyer'=> $seo_flyer,
                            'seo_keywords'=> $seo_keywords,
                            'seo_description'=> $seo_description
                        ]; 

                        $alert_detail="Success Alert: A page was created successfully by  $login_staff_fullname. DETAILS: Title: $page_title | URL: $page_url";	
                        $callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);

                } else {

                    $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png","PNG","GIF","webp","WEBP");
                    $extension = pathinfo($_FILES['seo_flyer']['name'], PATHINFO_EXTENSION);
        
                    if (!in_array(($extension), $allowedExts)) {
                        $response = [
                            'response' => 110,
                            'success' => false,
                            'message' => 'INVALID PICTURE FORMAT! Check the picture format and try again.'
                        ];  
                        goto end;
                    }

                        $datetime = date("Ymdhi");
                        $seo_flyer = $publish_id . '_' . $datetime . '_' . $_FILES['seo_flyer']['name']; // Use original file name
                        $uploadPath = $seoflyerPixPath . $seo_flyer;
                
                        if (!move_uploaded_file($_FILES["seo_flyer"]["tmp_name"], $uploadPath)) {
                            $response = [
                                'response' => 111,
                                'success' => false,
                                'message' => 'PICTURE UPLOAD ERROR! Contact your Engineer For Help'
                            ];  
                            goto end;
                        }

                            $query = mysqli_query($conn, "SELECT page_category_id FROM publish_tab WHERE publish_id='$publish_id'");
                            $fetch=mysqli_fetch_array($query);
                            $page_category_id=$fetch['page_category_id'];

                            mysqli_query($conn,"INSERT INTO `pages_tab`
                            (`publish_id`, `page_url`, `page_title`, `seo_keywords`, `seo_description`, `seo_flyer`, `page_content`, `modified_by`, `updated_date`) VALUES
                            ('$publish_id', '$page_url','$page_title', '$seo_keywords', '$seo_description', '$seo_flyer', '$page_content', '$login_staff_id', NOW())")or die (mysqli_error($conn));
                            
                            $response = [
                                'response'=> 200,
                                'success'=> true,
                                'message'=> "SUCCESS! Page Registered Successful!",
                                'page_category_id'=> $page_category_id,
                                'publish_id'=> $publish_id,
                                'page_url'=> $page_url,
                                'db_page_url'=> $db_page_url,
                                'page_title'=> $page_title,
                                'db_seo_flyer'=> $db_seo_flyer,
                                'seo_flyer'=> $seo_flyer,
                                'seo_keywords'=> $seo_keywords,
                                'seo_description'=> $seo_description
                            ]; 
                            /////////// get alert//////////////////////////////////
                            $alert_detail="Success Alert: A page was created successfully by  $login_staff_fullname. DETAILS: Title: $page_title | URL: $page_url";
                            $callclass->_alert_sequence_and_update($conn,$login_staff_id,$login_staff_fullname,$login_role_id,$alert_detail,$ip_address,$system_name);
                } 



















end:
echo json_encode($response);
?>