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
    $staffId = $_GET['staffId'];
    $passport=trim($_POST['passport']);
    
	////////////////////////////////////////////////////////////////////////////////
    if (empty($staffId)){
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STAFF ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    $oldPassportNameQuery = mysqli_query($conn, "SELECT profilePix FROM STAFF_TAB WHERE $clientIds AND staffId='$staffId'");
    $oldPassportNamefetch = mysqli_fetch_assoc($oldPassportNameQuery);
    $oldPassportName = $oldPassportNamefetch['profilePix'];
    
    if($passport!='mobile'){
        $passportName=$staffId.uniqid().'.jpg';
        mysqli_query($conn,"UPDATE `STAFF_TAB` SET profilePix='$passportName' WHERE staffId='$staffId'")or die (mysqli_error($conn));
    }

    $response['response']=200; 
    $response['success']=true;
    $response['message']="STAFF UPDATED SUCCESFFULY!"; 
    $response['data'] = array(); // Initialize the data array

    $select="SELECT * FROM STAFF_VIEW WHERE $clientIds AND staffId = '$staffId'";
    $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
    while ($fetchQuery = mysqli_fetch_assoc($query)) {
        $createdBy=$fetchQuery['createdBy'];
        $updatedBy=$fetchQuery['updatedBy'];
        $fetchQuery['oldPassportName']= $oldPassportName;
        /////////////////// for  $createdBy
        $createdByData=array();
        $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
        while ($getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery)) {
            $createdByData[] = $getCreatedByfetch;
        }
        $fetchQuery['createdBy']= $createdByData;

        /////////////////// for  $updatedBy
        $updatedByData=array();
        $getUpdatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$updatedBy'");
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