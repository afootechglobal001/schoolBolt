<?php
class allClass{
    function _get_setup_backend_settings_detail_for_branch($conn, $clientId, $branchId){
	$query=mysqli_query($conn,"SELECT * FROM BRANCHES_TAB WHERE clientId='$clientId' AND branchId='$branchId'")or die (mysqli_error($conn));
	$fetchQuery=mysqli_fetch_array($query);
         $response = [
            "senderName" => $fetchQuery['name'],
            "smtpHost" => $fetchQuery['smtpHost'],
            "smtpUsername" => $fetchQuery['smtpUsername'],
            "smtpPassword" => $fetchQuery['smtpPassword'],
            "smtpPort" => $fetchQuery['smtpPort'],
            "supportEmail" => $fetchQuery['supportEmail'],
        ];
		return json_encode([$response]);
}
/////////////////////////////////////////
function _staff_accesskey_validation($conn, $accessKey) {
    $query = mysqli_query($conn, "SELECT * FROM STAFF_VIEW WHERE accessKey='$accessKey' AND statusId=1 AND accessKey!=''") or die(mysqli_error($conn));
    $count = mysqli_num_rows($query);
    $response = ["checkSession" => false];
    if ($count > 0) {
        $fetchQuery = mysqli_fetch_assoc($query);
		$firstName=$fetchQuery['firstName'];
		$lastName=$fetchQuery['lastName'];
        $response = [
            "checkSession" => true,
            "loginStaffId" => $fetchQuery['staffId'],
            "loginFullname" => "$firstName $lastName",
            "loginRoleid" => $fetchQuery['roleId']
        ];
    }
    return json_encode([$response]);
}
/////////////////////////////////////////
function _get_sequence_count($conn, $counterId){
	$count=mysqli_fetch_array(mysqli_query($conn,"SELECT counterValue FROM SETUP_COUNTER_TAB WHERE counterId = '$counterId' FOR UPDATE"));
	 $num=$count[0]+1;
	 mysqli_query($conn,"UPDATE `SETUP_COUNTER_TAB` SET `counterValue` = '$num' WHERE counterId = '$counterId'")or die (mysqli_error($conn));
	 if ($num<10){$no='00'.$num;}elseif($num>=10 && $num<100){$no='0'.$num;}else{$no=$num;}
	 $response = ["no" => $no];
	 return json_encode([$response]);
}

}//end of class
$callclass=new allClass();


// Helper function for field validation
function validateEmptyField($field, $fieldName) {
    if (empty($field)) {
        echo json_encode([
            'response' => 100,
            'success' => false,
            'message' => "$fieldName REQUIRED! Check the fields and try again",
        ]);
        exit;
    }
}
function getGrade($percentage) {
    if ($percentage <= 39.9) {
        return "F9";
    } elseif ($percentage <= 45.9) {
        return "E8";
    } elseif ($percentage <= 49.9) {
        return "D7";
    } elseif ($percentage <= 54.9) {
        return "C6";
    } elseif ($percentage <= 59.9) {
        return "C5";
    } elseif ($percentage <= 64.9) {
        return "C4";
    } elseif ($percentage <= 69.9) {
        return "B3";
    } elseif ($percentage <= 74.9) {
        return "B2";
    } else {
        return "A1";
    }
}
function getRemark($percentage) {
    if ($percentage >= 75) {
        return 'EXCELLENT';
    } elseif ($percentage >= 70) {
        return 'VERY GOOD';
    } elseif ($percentage >= 60) {
        return 'GOOD';
    } elseif ($percentage >= 50) {
        return 'FAIRLY GOOD';
    } elseif ($percentage >= 45) {
        return 'FAIR';
    } elseif ($percentage >= 40) {
        return 'BELOW AVERAGE';
    } else {
        return 'WEAK RESULT';
    }
}
function getOrdinalSuffix($number) {
    $lastTwoDigits = $number % 100;
    $lastDigit = $number % 10;

    if ($lastTwoDigits >= 11 && $lastTwoDigits <= 13) {
        return 'TH';
    }

    switch ($lastDigit) {
        case 1:
            return 'ST';
        case 2:
            return 'ND';
        case 3:
            return 'RD';
        default:
            return 'TH';
    }
}
?>