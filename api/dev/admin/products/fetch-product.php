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
    $q = $_GET['q'];
    $productId = $_GET['productId'];
    $statusId = $_GET['statusId'];

    if (!empty($productId)) {
        $productIds = "AND productId ='$productId'";
    }
    if (!empty($statusId)) {
        $statusIds = "AND statusId IN ($statusId)";
    }
    // Securely escape $q
    $q = mysqli_real_escape_string($conn, $q);
    $select = "SELECT * FROM PRODUCTS_TAB WHERE (productTags LIKE '%$q%') $productIds  $statusIds AND productLevel=2";

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    $allRecordCount=mysqli_num_rows($query);
    if($allRecordCount==0){///start if 1
        $response['response']=200;
        $response['success']=false;
        $response['message']="No Record found";
        goto end;
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="PRODUCT CATEGORY FETCHED SUCCESFFULY!";
    $response['data'] = array(); // Initialize the data array

    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $productId=$fetchQuery['productId'];
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