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
	$productName=trim(strtoupper($_POST['productName']));
    $productTags =trim(strtoupper(str_replace("'", "\'", $_POST['productTags'])));
    $productPixCount =  $_FILES["productPix"]["name"] ? count($_FILES["productPix"]["name"]) : 0;
    $statusId=trim($_POST['statusId']);
	////////////////////////////////////////////////////////////////////////////////

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
    if($productPixCount==0){
        $response = [
            'response'=> 103,
            'success'=> false,
            'message'=> "PRODUCT PICTURES REQUIRED! Check the fields and try again",
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
   
			$query=mysqli_query($conn,"SELECT * FROM PRODUCTS_TAB WHERE productLevel=1 AND  productName='$productName'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 105,
                    'success'=> false,
                    'message'=> "PRODUCT EXIST! Product already exist by name. Check and try again.",
                ];
                goto end;
            }

            ///////////////////////geting sequence//////////////////////////
            $sequence=$callclass->_get_sequence_count($conn, 'GFSP');
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $productId='GFSP'.$no.date("Ymdhis");

            mysqli_query($conn,"INSERT INTO `PRODUCTS_TAB`
            (`productLevel`, `productId`, `productName`, `productTags`, `statusId`, `createdBy`, `createdTime`) VALUES
            (1,'$productId','$productName', '$productTags',  '$statusId', '$loginStaffId', NOW())")or die (mysqli_error($conn));

                $oldProductPixNames='';
                $newProductPixNames='';

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


            $response['response']=200; 
            $response['success']=true;
            $response['message']="PRODUCT CATEGORY CREATED SUCCESFFULY!";
            $response['oldProductPixNames']=$oldProductPixNames;
            $response['newProductPixNames']=$newProductPixNames;
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM PRODUCTS_TAB WHERE productId = '$productId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $statusId=$fetchQuery['statusId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];

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