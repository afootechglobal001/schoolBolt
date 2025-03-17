<?php require_once '../../../config/connection.php';?>
<?php require_once '../../../config/staff-session-check.php';?>
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
    $classId = $_GET['classId'];
	//////////////////declaration of variables//////////////////////////////////////
	$className=trim(strtoupper($data['className']));
    $statusId=trim(($data['statusId']));
    
	////////////////////////////////////////////////////////////////////////////////

	if (empty($classId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($className)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "CLASS NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($statusId)){/// start if 2
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "CLASS STATUS REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}


   
			$query=mysqli_query($conn,"SELECT * FROM CLASSES_TAB WHERE className='$className' AND classId!='$classId'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "CLASS EXIST! Class already exist by name. Check and try again.",
                ];
                goto end;
            }
            
            mysqli_query($conn,"UPDATE `CLASSES_TAB` SET 
            className='$className', statusId='$statusId', updatedBy='$loginStaffId'
            WHERE classId = '$classId'")or die (mysqli_error($conn));

            $response['response']=200; 
            $response['success']=true;
            $response['message']="CLASS UPDATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM CLASSES_TAB WHERE classId = '$classId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $statusId=$fetchQuery['statusId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
        
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
        
                    /////////////////// for  $rolePermissionIds
                    $statusData=array();
                    $getStatusQuery = mysqli_query($conn, "SELECT * FROM SETUP_STATUS_TAB WHERE statusId ='$statusId'");
                    while ($geStatusFetch = mysqli_fetch_assoc($getStatusQuery)) {
                        $statusData[] = $geStatusFetch;
                    }
                    $fetchQuery['statusData']= $statusData;
        
                    
                $response['data'][] = $fetchQuery;
            }
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>