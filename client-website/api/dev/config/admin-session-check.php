<?php
$headers = getallheaders();
$access_key = isset($headers['Authorization']) ? trim(str_replace('Bearer ', '', $headers['Authorization'])) : null;
///////////auth/////////////////////////////////////////
$fetch=$callclass->_admin_accesskey_validation($conn,$access_key);
$array = json_decode($fetch, true);
$check=$array[0]['check'];
$login_staff_id=$array[0]['staff_id'];
$login_staff_fullname=$array[0]['fullname'];
$login_role_id=$array[0]['role_id'];
?>