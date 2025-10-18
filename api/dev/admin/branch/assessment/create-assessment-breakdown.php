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
	$assessmentName=trim(strtoupper($data['assessmentName']));
	$assessmentTotalScore=trim($data['assessmentTotalScore']);
	////////////////////////////////////////////////////////////////////////////////
    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH REQUIRED! Check the fields and try again",
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
	if (empty($assessmentName)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "ASSESSMENT NAME REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    if(empty($assessmentTotalScore)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ASSESSMENT TOTAL SCORE REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if(!is_numeric($assessmentTotalScore)){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ASSESSMENT TOTAL SCORE MUST BE A NUMBER! Check the fields and try again",
        ];
        goto end;
	}
    if($assessmentTotalScore<=0){
        $response = [
            'response'=> 101,
            'success'=> false,
            'message'=> "ASSESSMENT TOTAL SCORE MUST BE A POSITIVE NUMBER! Check the fields and try again",
        ];
        goto end;
	}

			$query=mysqli_query($conn,"SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId='$branchId' AND parentId='$parentId' AND assessmentName='$assessmentName'") or die (mysqli_error($conn));
			$count=mysqli_num_rows($query);

            if ($count>0){ /// start if 4
                $response = [
                    'response'=> 103,
                    'success'=> false,
                    'message'=> "ASSESSMENT ALREADY EXIST! Assessment already exist by name. Check and try again.",
                ];
                goto end;
            }


            $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND assessmentId='$parentId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            $fetchQuery = mysqli_fetch_assoc($query);
            $mainScore = $fetchQuery['assessmentTotalScore'];

            ////// get sum total score of all assessments in the branch
            $sumQuery = mysqli_query($conn, "SELECT SUM(assessmentTotalScore) AS totalScore FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId='$branchId' AND parentId='$parentId'") or die (mysqli_error($conn));
            $sumFetch = mysqli_fetch_assoc($sumQuery);
            $totalScore = $sumFetch['totalScore'];
            $newTotalScore = $totalScore + $assessmentTotalScore;
            if ($newTotalScore > $mainScore) { /// start if 5
                $response = [
                    'response'=> 104,
                    'success'=> false,
                    'message'=> "ASSESSMENT TOTAL SCORE EXCEEDS $mainScore! The total score of all assessments in the branch cannot exceed 100. Check and try again.",
                ];
                goto end;
            }
            ///////////////////////geting sequence//////////////////////////
            $countId='ASSESSMENT';
            $sequence=$callclass->_get_sequence_count($conn, $countId);
            $array = json_decode($sequence, true);
            $no= $array[0]['no'];
            $assessmentId=$countId.$no.date("Ymdhis");


            mysqli_query($conn,"INSERT INTO `BRANCH_ASSESSMENT_SETUP_TAB`
            (`clientId`, `branchId`,  `parentId`, `assessmentId`, `assessmentName`, `assessmentTotalScore`, `createdBy`, `createdTime`) VALUES
            ('$clientId', '$branchId', '$parentId', '$assessmentId', '$assessmentName', '$assessmentTotalScore', '$loginStaffId', NOW())")or die (mysqli_error($conn));
           

            $select="SELECT * FROM BRANCH_ASSESSMENT_SETUP_TAB WHERE $clientIds AND branchId = '$branchId' AND parentId='$parentId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            $allRecordCount=mysqli_num_rows($query);
            
            $response['response']=200; 
            $response['success']=true;
            $response['message']="ASSESSMENT CREATED SUCCESFFULY!";
            $response['allRecordCount']=$allRecordCount;
            $response['data'] = array(); // Initialize the data array

           
            while ( $fetchQuery = mysqli_fetch_assoc($query)){
                $response['data'][] = $fetchQuery;
            }
            
            
//////////////////////////////////////////////////////////////////////////////////////////////
end:
echo json_encode($response);
?>