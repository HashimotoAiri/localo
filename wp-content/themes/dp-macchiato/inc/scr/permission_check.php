<?php
/*******************************************************
* Check and create Upload directory 
*******************************************************/
function dp_permission_check() {
	if ( phpversion() < 5 ) {
		echo '<div class="error"><p>PHP ver. ' . phpversion() . __(' : WordPress and DigiPress couldn\'t run as normal on this PHP version. Please update php ASAP!', 'DigiPress').'</p></div>';
		return;
	}

	$css_dir			= DP_UPLOAD_DIR . "/css";
	$header_img_dir		= DP_UPLOAD_DIR . "/header";
	$mb_header_img_dir	= DP_UPLOAD_DIR . "/header/mobile";
	$bg_img_dir			= DP_UPLOAD_DIR . "/background";
	$title_img_dir		= DP_UPLOAD_DIR . "/title";

	$arr_uoload_dir = array($css_dir, $header_img_dir, $mb_header_img_dir, $bg_img_dir, $title_img_dir);

	$err_msg = '';

	// Check and create upload dir
	foreach ($arr_uoload_dir as $current_dir) {
		if ( !file_exists($current_dir) ) {
			if ( !mkdir($current_dir, 0777, true) ) {
				$err_msg .= '<li>' . $current_dir . __(' directory couldn\'t be created.' ,'DigiPress').'</li>';
			}
		}
		if ( !is_writable( $current_dir ) ) {
			$err_msg .= '<li>' . $current_dir . __(' : Please change the permission of this directory to 777 or 757.', 'DigiPress').'</li>';
		}
	}
	if (!empty($err_msg)) {
		echo '<div class="error"><ul>'.$err_msg.'</ul></div>';
	}

	//If PHP is safe mode...
	if (ini_get('safe_mode')) echo '<div class="updated ft12px"><p>'.__('PHP is Safe mode.', 'DigiPress').'</p></div>';
}
?>