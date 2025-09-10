<?php require_once '../../config/connection.php';?>
<?php

///// check for API security
if ($apiKey!=$expected_api_key){
	$response = [
        'response' => 98,
        'success'=> false,
        'message'=> 'SECURITY ACCESS DENIED! You are not allowed to execute this command due to a security breach.'
    ]; 
	goto end;
}

	//////////////////declaration of variables//////////////////////////////////////
	$username=trim($_POST['username']);
	$p_password=$_POST['password'];
	$password=md5($p_password);
	////////////////////////////////////////////////////////////////////////////////

	if (empty($username)){
		$response = [
			'response'=> 100,
			'success'=> false,
			'message'=> 'USERNAME REQUIRED! Check username field and try again.'
		];
		goto end;
	}

	if (empty($p_password)){
		$response = [
			'response'=> 101,
			'success'=> false,
			'message'=> 'PASSWORD REQUIRED! Check password field and try again.'
		];
		goto end;
	}

		if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
			$response = [
				'response'=> 102,
				'success'=> false,
				'message'=> "INVALID EMAIL ADDRESS! Enter a valid email address and try again."
			]; 
			goto end;	
		}

			$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE email='$username' AND `password`='$password'") or die (mysqli_error($conn));
			$count_user=mysqli_num_rows($query);	
			if ($count_user!=1){
				$response = [
					'response'=> 103,
					'success'=> false,
					'message'=> "INVALID USERNAME OR PASSWORD! Kindly check and try again."
				];
				goto end;
			}

				$fetch_query = mysqli_fetch_array($query);
				$staff_id = $fetch_query['staff_id']; 
				$status_id = $fetch_query['status_id'];

				if($status_id==1){ /// (check if the user is active)
					/// Generate login access key
					$access_key=trim(md5($staff_id.date("Ymdhis")));

					/// update user on staff_tab
					mysqli_query($conn,"UPDATE staff_tab SET access_key='$access_key', last_login_time=NOW() WHERE staff_id='$staff_id'")or die ("cannot update access key - staff_tab");
					$response = [
						'response'=> 200,
						'success'=> true,
						'message'=> 'LOGIN SUCCESSFUL!, REDIRECTING TO PORTAL',
						'staff'=> array() // Initialize the data array
					];
							
					$select="SELECT a.staff_id, a.access_key, a.fullname, a.phone, a.email, a.address, a.profile_pix, a.role_id, a.status_id, a.created_time, a.updated_time, a.last_login_time, b.role_name, c.status_name
					FROM  staff_tab a, setup_role_tab b, setup_status_tab c
					WHERE a.role_id=b.role_id AND a.status_id=c.status_id AND a.staff_id = '$staff_id'";

					$query=mysqli_query($conn,$select)or die (mysqli_error($conn));
					while ($fetch_query = mysqli_fetch_assoc($query)) {
						$fetch_query['documentStoragePath'] = "$documentStoragePath/staff-pix";
						$response['staff'][] = $fetch_query;
					}
				}
				if($status_id==2){ /// (check if the user is inactive)
					$response = [
						'response'=> 102,
						'success'=> false,
						'message'=> 'ACCOUNT SUSPENDED! Contact the administrator for more info.'
					];
					goto end;
				}
end:
echo json_encode($response);
?>