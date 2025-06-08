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
    $branchId = $_GET['branchId'];
    $parentId = $_GET['parentId'];
    $assessmentId = $_GET['assessmentId'];
	////////////////////////////////////////////////////////////////////////////////
     if (!empty($assessmentId)) {
        $assessmentIds = "AND assessmentId ='$assessmentId'";
    }
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
 if (empty($parentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "PARENT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}


            $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND (parentId IS NULL OR parentId = '') AND assessmentId='$parentId'";
            $assessmentQuery=mysqli_query($conn,$select)or die (mysqli_error($conn));
            $assessmentFetch = mysqli_fetch_assoc($assessmentQuery);

             
            $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND parentId='$parentId'  $assessmentIds";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            $allRecordCount=mysqli_num_rows($query);
            if($allRecordCount==0){///start if 1
                $response = [
                    'response'=> 200,
                    'success'=> false,
                    'message'=> "No Record found",
                    'assessmentData'=> $assessmentFetch,
                ]; 
                goto end;
             }
            
            $response['response']=200; 
            $response['success']=true;
            $response['message']="ASSESSMENT FETCHED SUCCESFFULY!";
            $response['allRecordCount']= $allRecordCount;
            $response['assessmentData']= $assessmentFetch;
            $response['data'] = array(); // Initialize the data array

           
            while ( $fetchQuery = mysqli_fetch_assoc($query)){
                $response['data'][] = $fetchQuery;
            }
            
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>