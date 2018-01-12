<?php
function getExt($fn) {
  list(,,$type,) = getimagesize($fn);
  switch($type) {
    case 1: $ext = 'gif'; break;
    case 2: $ext = 'jpg'; break;
    case 3: $ext = 'png'; break;
    case 4: $ext = 'swf'; break;
    case 5: $ext = 'psd'; break;
    case 6: $ext = 'bmp'; break;
    case 7:
    case 8: $ext = 'tiff'; break;
    case 9: $ext = 'jpc'; break;
    case 10: $ext = 'jp2'; break;
    case 11: $ext = 'jpx'; break;
    case 12: $ext = 'jb2'; break;
    case 13: $ext = 'swc'; break;
    case 14: $ext = 'iff'; break;
    case 15: $ext = 'wbmp'; break;
    case 16: $ext = 'xbm'; break;
  }
  return $ext;
}

header("Content-type: text/plain; charset=UTF-8");
if (isset($_POST['img'])) {
	require_once $_POST['template_dir'] . '/inc/scr/class.image.php';
	
	$img_class;
	$list_class;
	$input_id;
	
	switch ($_POST['target']) {
		case 'title':
			$list_class = 'list_title_img';
			$img_class = 'thumbTitleImg_crop';
			$input_id = 'target_crop_title_img';
			break;
		case 'banner':
			$list_class = 'list_header_img';
			$img_class = 'thumbBannerImg_crop';
			$input_id = 'target_crop_banner_img';
			break;
	}
	
	$outer_image_url 	= $_POST['image_url'] . '/';
	$server_path 		= $_POST['image_dir'] . '/';
	$new_file_name 		= 'edited_' . $_POST['file_name'];
	
	$thumb = new Image($_POST['img']);
	$thumb->dir($server_path);
	$thumb->name($new_file_name);
	
	// Trim or resize
	switch ($_POST['edit_type']) {
		case 'trim':
			$thumb->width($_POST['width']);
			$thumb->height($_POST['height']);
			$thumb->crop($_POST['x1'], $_POST['y1']);
			break;
		case 'resize':
			if ($_POST['resize_mode'] == 'pixel') {
				$thumb->width($_POST['resize_value']);
			} else {
				$thumb->resize($_POST['resize_value']);
			}
			break;
	}
	// Save image
	$thumb->save();

	$num = '_crop' . rand(100, 500);
	
	$appendStr = '<li class="'.$list_class.'"><div class="clearfix pd8px-btm">
					<img src="' . $outer_image_url . $new_file_name . '"  class="'.$img_class.'" />
					<img src="' . $outer_image_url . $new_file_name .  '" class="hiddenImg" /></div>
					<div class="pd10px-btm"><input name="'.$input_id.'" id="' . $input_id . $num . '" type="radio" value="' . $outer_image_url . $new_file_name . '" />
					<label for="' . $input_id . $num . '">' . $new_file_name .'</label></div></li>';
	
	echo $appendStr;
}else {
	echo '<li>The parameter of "img" is not found.</li>';
}
?>