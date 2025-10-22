<?php require_once '../../../../config/connection.php';?>
<?php require_once '../../../../config/staff-session-check.php';?>
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
    $branchId = $_GET['branchId'];
    $genderId=$_GET['genderId'];
    $commentId=$_GET['commentId'];
    if(!empty($commentId)){
        $commentIds = "AND commentId='$commentId'";
    }
    if(!empty($genderId)){
        $genderIds = "AND genderId='$genderId'";
    }
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH ID');

			$select="SELECT * FROM BRANCH_TEACHERS_COMMENT_CONFIG_TAB WHERE $clientIds AND branchId = '$branchId'  $genderIds  $commentIds ORDER BY comment ASC";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);
            if ($count==0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "No record found!",
                ];
                goto end;
            }


            $response['response']=200; 
            $response['success']=true;
            $response['message']="COMMENT FETCHED SUCCESSFULLY!"; 
            $response['data'] = array(); // Initialize the data array
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $statusId=$fetchQuery['statusId'];
                $genderId=$fetchQuery['genderId'];
                $createdBy=$fetchQuery['createdBy'];
                /////////////////// for  $createdBy
                $getCreatedByQuery = mysqli_query($conn, "SELECT CONCAT(titleId, ' ', firstName, ' ', lastName) AS fullname, emailAddress FROM STAFF_TAB WHERE $clientIds AND staffId='$createdBy'");
                $getCreatedByfetch = mysqli_fetch_assoc($getCreatedByQuery);
                $fetchQuery['createdBy']= $getCreatedByfetch;
                /////////////////// for  $statusId
                $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId='$statusId'");
                $getStatusfetch = mysqli_fetch_assoc($getStatusQuery);
                $fetchQuery['statusData'] = $getStatusfetch;
                /////////////////// for  $genderId
                $getGenderQuery = mysqli_query($conn, "SELECT * FROM SETUP_GENDER_TAB WHERE genderId='$genderId'");
                $getGenderfetch = mysqli_fetch_assoc($getGenderQuery);
                $fetchQuery['genderData'] = $getGenderfetch;

                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>