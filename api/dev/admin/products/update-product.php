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
    $productId = $_GET['productId'];
    $parentId=trim(($_POST['productCategoryId']));
	$productName=trim(strtoupper($_POST['productName']));
    $productTags =trim(strtoupper(str_replace("'", "\'", $_POST['productTags'])));
    $productPixCount =  $_FILES["productPix"]["name"] ? count($_FILES["productPix"]["name"]) : 0;
    $statusId=trim($_POST['statusId']);
	////////////////////////////////////////////////////////////////////////////////
    if (empty($productId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PRODUCT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if (empty($parentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PRODUCT CATEGORY ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

	if (empty($productName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PRODUCT NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($productTags)){
        $response = [
            'response'=> 102,
            'success'=> false,
            'message'=> "PRODUCT TAGS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
    if(empty($statusId)){
        $response = [
            'response'=> 104,
            'success'=> false,
            'message'=> "PRODUCT STATUS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
   
			$query=mysqli_query($conn,"SELECT * FROM PRODUCTS_TAB WHERE productLevel=2 AND  productName='$productName' AND productId!='$productId'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 105,
                    'success'=> false,
                    'message'=> "PRODUCT EXIST! Product already exist by name. Check and try again.",
                ];
                goto end;
            }

        

            mysqli_query($conn,"UPDATE `PRODUCTS_TAB` SET
            `parentId`='$parentId', `productName`='$productName', `productTags`='$productTags', `statusId`='$statusId', `updatedBy`='$loginStaffId', 
            `updatedTime`=NOW() WHERE productId='$productId'")or die (mysqli_error($conn));

                $oldProductPixNames='';
                $newProductPixNames='';
                if($productPixCount>0){
                    $query=mysqli_query($conn,"SELECT * FROM PRODUCT_PIX_TAB WHERE productId='$productId'")or die (mysqli_error($conn));
                    while($fetch=mysqli_fetch_array($query)){
                        $oldProductPixNames .=$fetch['productPix'].',';
                    }
                    mysqli_query($conn,"DELETE FROM PRODUCT_PIX_TAB WHERE productId='$productId'")or die (mysqli_error($conn));
            
                    $totalFiles = count($_FILES["productPix"]["name"]);
                    $filesArray = array();
                    for ($i = 0; $i < $totalFiles; $i++){
                        $imageName = $_FILES["productPix"]["name"][$i];					   
                        $imageExtension = end(explode('.', $imageName));
                        $newImageName = $productId."_".$i.uniqid().".".$imageExtension; /////generate new image name

                        mysqli_query($conn,"INSERT INTO `PRODUCT_PIX_TAB`
                        (`productId`, `productPix`, `createdTime`) VALUES 
                        ('$productId', '$newImageName', NOW())");

                        $newProductPixNames .= "$newImageName,";
                    }

                }

            $response['response']=200; 
            $response['success']=true;
            $response['message']="PRODUCT CATEGORY UPDATED SUCCESFFULY!";
            $response['oldProductPixNames']=$oldProductPixNames;
            $response['newProductPixNames']=$newProductPixNames;
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM PRODUCTS_TAB WHERE productId = '$productId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $statusId=$fetchQuery['statusId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
                $parentId=$fetchQuery['parentId'];

                /////////////////// for  $parentId
                $getParentProductQuery = mysqli_query($conn, "SELECT * FROM PRODUCTS_TAB WHERE productId='$parentId'");
                $parentProductData=array();
                while ($getParentProductfetch = mysqli_fetch_assoc($getParentProductQuery)) {
                    $parentProductData[] = $getParentProductfetch;
                }
                $fetchQuery['parentProductData']= $parentProductData;

                /////////////////// for  $productPix
                $getPixQuery = mysqli_query($conn, "SELECT * FROM PRODUCT_PIX_TAB WHERE productId='$productId'");
                $picturesData=array();
                while ($getPixfetch = mysqli_fetch_assoc($getPixQuery)) {
                    $picturesData[] = $getPixfetch;
                }
                $fetchQuery['picturesData']= $picturesData;

                /////////////////// for  $statusId
                $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId='$statusId'");
                $statusData=array();
                while ($getStatusfetch = mysqli_fetch_assoc($getStatusQuery)) {
                    $statusData[] = $getStatusfetch;
                }
                $fetchQuery['statusData']= $statusData;

                /////////////////// for  $createdBy
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$createdBy'");
                $createdByData=array();
                while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
                    $createdByData[] = $getCreatedByfetch;
                }
                $fetchQuery['createdBy']= $createdByData;

                /////////////////// for  $updatedBy
                $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE staffId='$updatedBy'");
                $updatedByData=array();
                while ($getUpdatedByfetch = mysqli_fetch_assoc($getUpdatedByQuery)) {
                    $updatedByData[] = $getUpdatedByfetch;
                }
                $fetchQuery['updatedBy']= $updatedByData;

                 
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>