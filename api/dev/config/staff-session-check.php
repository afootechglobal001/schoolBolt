<?php
$headers = getallheaders();
$accessKey = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;
///////////auth/////////////////////////////////////////
$fetch = $callclass->_staff_accesskey_validation($conn, $accessKey);
$array = json_decode($fetch, true);
$checkSession = $array[0]['checkSession'];
$loginStaffId = $array[0]['loginStaffId']; // Correct key name
$loginStaffFullname = $array[0]['loginFullname'];
$loginRoleId = $array[0]['loginRoleid']; // Correct key name
?>