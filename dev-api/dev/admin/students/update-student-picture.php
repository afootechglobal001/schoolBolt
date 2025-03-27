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
    $branchId = $_GET['branchId'];
    $studentId = $_GET['studentId'];
    $passport=trim($_POST['passport']);
	
	////////////////////////////////////////////////////////////////////////////////

    if (empty($branchId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "BRANCH ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}
    if (empty($studentId)){/// start if 2
        $response = [
            'response'=> 100,
            'success'=> false,
            'message'=> "STUDENT ID REQUIRED! Check the fields and try again",
        ]; 
        goto end;
	}

    $oldPassportNameQuery = mysqli_query($conn, "SELECT passport FROM STUDENTS_TAB WHERE $clientIds AND studentId='$studentId'");
    $oldPassportNamefetch = mysqli_fetch_assoc($oldPassportNameQuery);
    $oldPassportName = $oldPassportNamefetch['passport'];

    $passportName=$studentId.uniqid().'.jpg';
    mysqli_query($conn,"UPDATE `STUDENTS_TAB` SET passport='$passportName' WHERE studentId='$studentId'")or die (mysqli_error($conn));



            $response['response']=200; 
            $response['success']=true;
            $response['message']="STUDENT UPDATED SUCCESFFULY!"; 
            $response['data'] = array(); // Initialize the data array

            $select="SELECT * FROM STUDENTS_CLASS_TAB WHERE $clientIds AND branchId = '$branchId' AND studentId = '$studentId'";
            $query=mysqli_query($conn,$select)or die (mysqli_error($conn));
            while ($fetchQuery = mysqli_fetch_assoc($query)) {
                $branchId=$fetchQuery['branchId'];
                $studentId=$fetchQuery['studentId'];
                $departmentId=$fetchQuery['departmentId'];
                $classId=$fetchQuery['classId'];
                $armId=$fetchQuery['armId'];
                $accommodationId=$fetchQuery['accommodationId'];
                $statusId=$fetchQuery['statusId'];
                $createdBy=$fetchQuery['createdBy'];
                $updatedBy=$fetchQuery['updatedBy'];
                $fetchQuery['oldPassportName']= $oldPassportName;

                /////////////////// for  $studentId
                $studentData=array();
                $studentDataQuery = mysqli_query($conn, "SELECT * FROM STUDENT_VIEW WHERE $clientIds AND studentId='$studentId'");
                while ($studentDatafetch = mysqli_fetch_assoc($studentDataQuery)) {
                    $studentData[] = $studentDatafetch;
                }
                $fetchQuery['studentData']= $studentData;

                 /////////////////// for  $departmentId
                 $departmentData=array();
                 $departmentDataQuery = mysqli_query($conn, "SELECT departmentId, departmentName FROM DEPARTMENTS_TAB WHERE $clientIds AND departmentId='$departmentId'");
                 while ($departmentDataFetch = mysqli_fetch_assoc($departmentDataQuery)) {
                     $departmentData[] = $departmentDataFetch;
                 }
                 $fetchQuery['departmentData']= $departmentData;
         
                 /////////////////// for  $classId
                 $classData=array();
                 $classDataQuery = mysqli_query($conn, "SELECT classId, className FROM CLASSES_TAB WHERE $clientIds AND classId='$classId'");
                 while ($classDataFetch = mysqli_fetch_assoc($classDataQuery)) {
                     $classData[] = $classDataFetch;
                 }
                 $fetchQuery['classData']= $classData;

                 /////////////////// for  $armId
                 $armData=array();
                 $armDataQuery = mysqli_query($conn, "SELECT armId, armName FROM ARMS_TAB WHERE $clientIds AND armId='$armId'");
                 while ($armDataFetch = mysqli_fetch_assoc($armDataQuery)) {
                     $armData[] = $armDataFetch;
                 }
                 $fetchQuery['armData']= $armData;

                 /////////////////// for  $accommodationId
                 $accommodationData=array();
                 $accommodationDataQuery = mysqli_query($conn, "SELECT * FROM SETUP_ACCOMMODATION_TAB WHERE accommodationId='$accommodationId'");
                 while ($accommodationDataFetch = mysqli_fetch_assoc($accommodationDataQuery)) {
                     $accommodationData[] = $accommodationDataFetch;
                 }
                 $fetchQuery['accommodationData']= $accommodationData;
        
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