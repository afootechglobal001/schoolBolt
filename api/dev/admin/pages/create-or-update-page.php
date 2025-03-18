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
    $pageCategory=trim(($_GET['pageCategory']));
    $pageTitle=trim(($_POST['pageTitle']));
    $pageUrl=trim(($_POST['pageUrl']));
    $seoKeywords=trim(($_POST['seoKeywords']));
    $seoDescription =trim((str_replace("'", "\'", $_POST['seoDescription'])));
    $seoFlyerCount =  $_FILES["seoFlyer"]["name"] ? count($_FILES["seoFlyer"]["name"]) : 0;
    $pageContent =trim((str_replace("'", "\'", $_POST['pageContent'])));
	////////////////////////////////////////////////////////////////////////////////

	if (empty($publishId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PUBLISH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($pageUrl)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "PAGE URL REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($pageTitle)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "PAGE TITLE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($seoKeywords)){
        $response = [
            'response'=> 104,
            'success'=> false,
            'message'=> "SEO KEYWORDS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(empty($seoDescription)){
        $response = [
            'response'=> 104,
            'success'=> false,
            'message'=> "SEO DESCRIPTION REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if($seoFlyerCount==0){
        $response = [
            'response'=> 104,
            'success'=> false,
            'message'=> "SEO FLYER REQUIRED! Check the fields and try again",
        ]; 
        goto end;
    }

    if(empty($pageContent)){
        $response = [
            'response'=> 104,
            'success'=> false,
            'message'=> "PAGE CONTENT REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
			$query=mysqli_query($conn,"SELECT * FROM PAGES_TAB WHERE $clientIds AND pageCategory='$pageCategory' AND  pageUrl='$pageUrl' AND publishId!='$publishId'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);
            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 105,
                    'success'=> false,
                    'message'=> "PAGE EXIST! Page already exist by URL. Check and try again.",
                ];
                goto end;
            }

            $query=mysqli_query($conn,"SELECT * FROM PAGES_TAB WHERE $clientIds AND publishId='$publishId'") or die (mysqli_error($conn));
			$pageCount=mysqli_num_rows($query);
            if ($pageCount>0){ /// start if 4
                mysqli_query($conn,"UPDATE `PAGES_TAB` SET
                `pageUrl`='$pageUrl', `pageTitle`='$pageTitle', `seoKeywords`='$seoKeywords', `seoDescription`='$seoDescription', 
                `pageContent`='$pageContent', `updatedTime`=NOW() WHERE $clientIds AND publishId='$publishId'")or die (mysqli_error($conn));

                $response['message']="PAGE UPDATED SUCCESFFULY!";
            }else{
                mysqli_query($conn,"INSERT INTO `PAGES_TAB`
                (`publishId`, `pageCategory`, `pageUrl`, `pageTitle`, `seoKeywords`, `seoDescription`, `pageContent`, `updatedTime`) VALUES
                ('$publishId', '$pageCategory', '$pageUrl', '$pageTitle', '$seoKeywords',  '$seoDescription', '$pageContent', NOW())")or die (mysqli_error($conn));
                
                $response['message']="PAGE CREATED SUCCESFFULY!";
            }

            $totalFiles = count($_FILES["seoFlyer"]["name"]);
            $filesArray = array();
            for ($i = 0; $i < $totalFiles; $i++){
                $imageName = $_FILES["seoFlyer"]["name"][$i];					   
                $imageExtension = end(explode('.', $imageName));
                $newImageName = $publishId."_".$i.uniqid().".".$imageExtension; /////generate new image name
                mysqli_query($conn,"UPDATE `PAGES_TAB` SET `seoFlyer`='$newImageName' WHERE $clientIds AND publishId='$publishId'")or die (mysqli_error($conn));
            }
           
            $response['response']=200; 
            $response['success']=true;
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