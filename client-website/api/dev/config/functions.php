<?php
class allClass{
/////////////////////////////////////////
/////////////////////////////////////////
function _get_setup_backend_settings_detail($conn, $backend_setting_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_backend_settings_tab WHERE backend_setting_id='$backend_setting_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$smtp_host=$fetch['smtp_host'];
		$smtp_username=$fetch['smtp_username'];
		$smtp_password=$fetch['smtp_password'];
		$smtp_port=$fetch['smtp_port'];
		$sender_name=$fetch['sender_name'];
		$support_email=$fetch['support_email'];
		$paystack_payment_key=$fetch['paystack_payment_key'];
		return '[{"smtp_host":"'.$smtp_host.'","smtp_username":"'.$smtp_username.'","smtp_password":"'.$smtp_password.'",
		"smtp_port":"'.$smtp_port.'","sender_name":"'.$sender_name.'","support_email":"'.$support_email.'",
		"paystack_payment_key":"'.$paystack_payment_key.'"}]';
}
/////////////////////////////////////////
function _get_sequence_count($conn, $counter_id){
	$count=mysqli_fetch_array(mysqli_query($conn,"SELECT counter_value FROM setup_counter_tab WHERE counter_id = '$counter_id' FOR UPDATE"));
	 $num=$count[0]+1;
	 mysqli_query($conn,"UPDATE `setup_counter_tab` SET `counter_value` = '$num' WHERE counter_id = '$counter_id'")or die (mysqli_error($conn));
	 if ($num<10){$no='00'.$num;}elseif($num>=10 && $num<100){$no='0'.$num;}else{$no=$num;}
	 return '[{"no":"'.$no.'"}]';
}
/////////////////////////////////////////
function _alert_sequence_and_update($conn,$user_id,$user_name,$role_id,$alert_detail,$ip_address,$system_name){
	$sequence=$this->_get_sequence_count($conn, 'ALT');
	$array = json_decode($sequence, true);
	$no= $array[0]['no'];
	//$num= $array[0]['num'];
	$alert_id='ALT'.$no.date("Ymdhis");
	
	mysqli_query($conn,"INSERT INTO `0_alert_tab`
	(`alert_id`, `user_id`, `user_name`, `role_id`, `alert_detail`, `seen_status`, `ip_address`, `system_name`) VALUES
	('$alert_id', '$user_id', '$user_name', $role_id, '$alert_detail', 0, '$ip_address', '$system_name')")or die (mysqli_error($conn));
}

function _get_alert_details($conn,$alert_id){
	$query=mysqli_query($conn,"SELECT * FROM 0_alert_tab WHERE alert_id='$alert_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$seen_status=$fetch_query['seen_status'];
		return '[{"seen_status":"'.$seen_status.'"}]';
}

/////////////////////////////////////////
function _admin_accesskey_validation($conn,$access_key){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE access_key='$access_key' AND status_id=1 AND access_key!=''")or die (mysqli_error($conn));
	$count = mysqli_num_rows($query);
		if ($count>0){
			$fetch_query=mysqli_fetch_array($query);
			$staff_id=$fetch_query['staff_id'];
			$fullname=$fetch_query['fullname'];
			$role_id=$fetch_query['role_id'];
			$check=1; 
		}else{
			$check=0;
		}
		return '[{"check":"'.$check.'","staff_id":"'.$staff_id.'","fullname":"'.$fullname.'","role_id":"'.$role_id.'"}]';
}

function _get_staff_details($conn,$staff_id){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE staff_id='$staff_id'")or die (mysqli_error($conn));
	$fetch_query=mysqli_fetch_array($query);
		$staff_id=$fetch_query['staff_id'];
		$fullname=$fetch_query['fullname'];
		$profile_pix=$fetch_query['profile_pix'];
		$role_id=$fetch_query['role_id'];
		return '[{"staff_id":"'.$staff_id.'","fullname":"'.$fullname.'","profile_pix":"'.$profile_pix.'","role_id":"'.$role_id.'"}]';
}


/////////////////////////////////////////
function _get_setup_page_category_detail($conn, $page_category_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_page_categories_tab WHERE page_category_id='$page_category_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$page_category_id=$fetch['page_category_id'];
		$page_category_name=$fetch['page_category_name'];
	return '[{"page_category_id":"'.$page_category_id.'","page_category_name":"'.$page_category_name.'"}]';
}


/////////////////////////////////////////
function _get_publish_detail($conn, $publish_id){
	$query=mysqli_query($conn,"SELECT * FROM publish_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$page_category_id=$fetch['page_category_id'];
		$publish_id=$fetch['publish_id'];
		$reg_title=$fetch['reg_title'];
		$sermon_speaker=$fetch['sermon_speaker'];
		$reg_pix=$fetch['reg_pix'];
		$status_id=$fetch['status_id'];
		$login_staff_id=$fetch['modified_by'];
		$created_time=$fetch['created_time'];
		$updated_time=$fetch['updated_time'];
		$blog_cat_id=$fetch['blog_cat_id'];
		$blog_view=$fetch['blog_view'];
		$faq_cat_id=$fetch['faq_cat_id'];
		
	return '[{"page_category_id":"'.$page_category_id.'","publish_id":"'.$publish_id.'","reg_title":"'.$reg_title.'",
	"sermon_speaker":"'.$sermon_speaker.'","reg_pix":"'.$reg_pix.'","status_id":"'.$status_id.'",
	"login_staff_id":"'.$login_staff_id.'","created_time":"'.$created_time.'","updated_time":"'.$updated_time.'",
	"blog_cat_id":"'.$blog_cat_id.'","blog_view":"'.$blog_view.'","faq_cat_id":"'.$faq_cat_id.'"}]';
}	


/////////////////////////////////////////
function _getPagesDetails($conn, $publish_id){
	$query=mysqli_query($conn,"SELECT * FROM pages_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$page_url=$fetch['page_url'];
		$page_title=$fetch['page_title'];
		$seo_keywords=$fetch['seo_keywords'];
		$seo_description=$fetch['seo_description'];
		$seo_flyer=$fetch['seo_flyer'];
		$page_content=$fetch['page_content'];
		$modified_by=$fetch['modified_by'];
		$updated_date=$fetch['updated_date'];
		return '[{"page_url":"'.$page_url.'","page_title":"'.$page_title.'","seo_keywords":"'.$seo_keywords.'",
		"seo_description":"'.$seo_description.'","seo_flyer":"'.$seo_flyer.'","page_content":"'.$page_content.'",
		"modified_by":"'.$modified_by.'","updated_date":"'.$updated_date.'"}]';
}

/////////////////////////////////////////
function _get_pages_materials_details($conn, $material_id){
	$query=mysqli_query($conn,"SELECT * FROM pages_material_tab WHERE material_id='$material_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$material_id=$fetch['material_id'];
		$sermon_material=$fetch['sermon_material'];
	return '[{"material_id":"'.$material_id.'","sermon_material":"'.$sermon_material.'"}]';
}

function _get_pages_publish_materials_details($conn, $publish_id){
	$query=mysqli_query($conn,"SELECT * FROM pages_material_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$publish_id=$fetch['publish_id'];
		$material_id=$fetch['material_id'];
		$sermon_material=$fetch['sermon_material'];
		$isUpload=$fetch['isUpload'];
	return '[{"publish_id":"'.$publish_id.'","material_id":"'.$material_id.'","sermon_material":"'.$sermon_material.'","isUpload":"'.$isUpload.'"}]';
}

function _get_pages_audio_details($conn, $audio_id){
	$query=mysqli_query($conn,"SELECT * FROM pages_audio_tab WHERE audio_id='$audio_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$audio_id=$fetch['audio_id'];
		$audio=$fetch['audio'];
	return '[{"audio_id":"'.$audio_id.'","audio":"'.$audio.'"}]';
}

function _get_pages_publish_audio_details($conn, $publish_id){
	$query=mysqli_query($conn,"SELECT * FROM pages_audio_tab WHERE publish_id='$publish_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$publish_id=$fetch['publish_id'];
		$audio_id=$fetch['audio_id'];
		$audio=$fetch['audio'];
		$isUpload=$fetch['isUpload'];
	return '[{"publish_id":"'.$publish_id.'","audio_id":"'.$audio_id.'","audio":"'.$audio.'","isUpload":"'.$isUpload.'"}]';
}



function _check_page_session($conn, $page_category, $publish_id, $page_session){
	$viewcount = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM page_views_tab WHERE page_category='$page_category' AND publish_id='$publish_id' AND page_session='$page_session'"));
	if ($viewcount>0){
		$page_session_check=0;
	}else{
		$ip_address=$_SERVER['REMOTE_ADDR']; //ip used
		$sysname=gethostname();//computer used
		$page_session_check=1;
		mysqli_query($conn,"INSERT INTO `page_views_tab`
		(`page_category`,`publish_id`, `page_session`, `system`, `ip_address`, `date`) VALUES 
		('$page_category','$publish_id','$page_session','$sysname','$ip_address', NOW())")or die (mysqli_error($conn));
	}
	return '[{"page_session_check":"'.$page_session_check.'"}]';
}

}//end of class
$callclass=new allClass();
?>