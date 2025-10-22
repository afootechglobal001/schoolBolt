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
    $commentId = $_GET['commentId'];
    $branchId = $_GET['branchId'];
	$genderId=trim(strtoupper($data['genderId'])); //// can be M or F
    $comment=trim(strtoupper(str_replace("'", "\'", $data['comment'])));
    $statusId=trim(strtoupper($data['statusId']));
	////////////////////////////////////////////////////////////////////////////////
    validateEmptyField($branchId, 'BRANCH ID');
    validateEmptyField($genderId, 'GENDER ID');
    validateEmptyField($comment, 'COMMENT');
    validateEmptyField($statusId, 'STATUS');

			$query=mysqli_query($conn,"SELECT * FROM BRANCH_TEACHERS_COMMENT_CONFIG_TAB WHERE $clientIds AND branchId='$branchId' AND genderId='$genderId' AND comment='$comment' AND commentId!='$commentId'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "COMMENT ALREADY EXIST! Comment already exist. Check and try again.",
                ];
                goto end;
            }

            ///////////////////////geting sequence//////////////////////////
            
            mysqli_query($conn,"UPDATE `BRANCH_TEACHERS_COMMENT_CONFIG_TAB` SET
            `genderId`='$genderId',
            `comment`='$comment',
            `statusId`='$statusId',
            `createdBy`='$loginStaffId'
             WHERE `commentId`='$commentId'")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="COMMENT UPDATED SUCCESSFULLY!";
             $select="SELECT * FROM BRANCH_TEACHERS_COMMENT_CONFIG_TAB WHERE $clientIds AND branchId = '$branchId' AND commentId='$commentId'";
           $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
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

                $response['commentData'] = $fetchQuery;
            }
///////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>