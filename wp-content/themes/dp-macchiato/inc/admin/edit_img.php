<?php
$header_img_dir		= DP_UPLOAD_DIR . "/header";
$mb_header_img_dir	= DP_UPLOAD_DIR . "/header/mobile";
$bg_img_dir			= DP_UPLOAD_DIR . "/background";
$title_img_dir		= DP_UPLOAD_DIR . "/title";

$header_img_url		= DP_UPLOAD_URI . "/header";
$mb_header_img_url	= DP_UPLOAD_URI . "/header/mobile";
$bg_img_url			= DP_UPLOAD_URI . "/background";
$title_img_url		= DP_UPLOAD_URI . "/title";

$dp_theme_title_images 		= dp_get_uploaded_images("title");
$dp_theme_header_images 	= dp_get_uploaded_images("header");
$dp_theme_mb_header_images 	= dp_get_uploaded_images("header/mobile");
$dp_theme_bg_images 		= dp_get_uploaded_images("background");

//Preg Match Pattern
$strPattern	=	'/(\.gif|\.jpg|\.jpeg|\.png)$/';


$target_file_name;
$target_crop_img;
$target_crop_img_w;
$target_crop_img_h;
?>
<div class="wrap<?php echo DP_THEME_LICENSE_TRIGGER; ?>">
<div id="dp_custom">
<h2 class="dp_h2"><span class="dp-admin-logo"></span><?php _e('Image editing', 'DigiPress'); ?></h2>
<p class="ft11px"><?php echo DP_THEME_NAME . ' Ver.' . DP_OPTION_SPT_VERSION; ?></p>
<?php dp_permission_check(); ?>
<hr />

<!--
========================================
トリミング／リサイズ
========================================
-->
<h3 class="dp_set_title1 icon-bookmark" id="crop_title_top">サイトタイトル画像 : </h3>
	<div class="pd20px-btm mg20px-l">
		<p class="pd10px-top"><a href="?page=digipress#upload" class="button open_upload_menu">画像のアップロード</a></p>
		<p><a href="?page=digipress_delete_file" class="button open_delete_menu">アップロード画像の削除</a></p>
		<form method="post" id="form_trim_title_img" enctype="multipart/form-data">
			<h3 class="dp_set_title2 icon-triangle-right">編集対象画像の選択 : </h3>
			<div class="clearfix mg15px-l">
			トリミングまたはリサイズする画像を選んでください。
			<?php
			if ( !empty($dp_theme_title_images) ) {
				echo '<ul class="clearfix " id="crop_title_img">';
				foreach ($dp_theme_title_images[0] as $key => $current_image) {
					//Image file only
					if (preg_match($strPattern, $current_image)) {
						//Current Image
						if ($options['dp_title_img'] === $current_image) {
							$chk	= " checked";
							$target_file_name = $current_image;
							$target_crop_img = $current_image;
							$imgInfo = getimagesize($target_crop_img);
							if($imgInfo){
							    $target_crop_img_w = $imgInfo[0];  // width
							    $target_crop_img_h = $imgInfo[1];    //height
							}else{
							    echo 'データの取得に失敗しました';
							}
						} else {
							$chk	= "";
						}

						echo '<li class="list_title_img">
							  <div class="clearfix pd8px-btm">
							  <img src="' . $current_image . '"  class="thumbTitleImg_crop" />
							  <img src="' . $current_image . '" class="hiddenImg" />
							  </div>
							  <div class="pd10px-btm"><input name="target_crop_title_img" id="target_crop_title_img'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
							  <label for="target_crop_title_img'.$key.'">' . $dp_theme_title_images[1][$key] . '</label></div></li>';
					}
				}
				echo '</ul>';
			} else {
				echo '<p class="red">アップロードされたイメージはまだありません。</p>';
			}
			?>
			<input type="hidden" name="template_dir" class="template_dir" value="<?php echo DP_THEME_DIR; ?>" />
			<input type="hidden" name="template_url" class="template_url" value="<?php echo get_template_directory_uri(); ?>" />
			<input type="hidden" name="image_dir" class="image_dir" value="<?php echo $title_img_dir; ?>" />
			<input type="hidden" name="image_url" class="image_url" value="<?php echo $title_img_url; ?>" />
			</div>

			<h3 class="dp_set_title2 icon-triangle-right">トリミング／リサイズ : </h3>
			<div class="mg15px-l" id="edit_title_img_box">
					<div class="pd12px-btm"><input type="radio" name="title_img_edit_target" id="title_img_edit_target_trim" value="trim" /><label for="title_img_edit_target_trim" class="mg12px-r">トリミング</label> 
					<input type="radio" name="title_img_edit_target" id="title_img_edit_target_resize" value="resize" /><label for="title_img_edit_target_resize">リサイズ</label>
					</div>
					
					<div id="label_for_title_img">マウスでトリミング範囲を選択してください。</div>
					<div id="trim_title_img_div">
						<img src="<?php echo $target_crop_img; ?>" id="target_title_img" width="<?php echo $target_crop_img_w; ?>" height="<?php echo $target_crop_img_h; ?>" />
						<input type="hidden" name="crop_title_img" value="<?php echo $target_crop_img; ?>" />
						<input type="hidden" name="crop_title_img_file_name" id="crop_title_img_file_name" value="<?php echo $target_file_name; ?>" />
					</div>

					<div id="title_img_trim_params" class="mg10px-top mg20px-btm">
						<div class="mg8px-btm">トリミング起点(x, y) : 
							<input type="text" name="title_x1" id="title_x1" size="5" /> , <input type="text" name="title_y1" id="title_y1" size="5" />	
							<input type="hidden" name="title_x2" id="title_x2" />
							<input type="hidden" name="title_y2" id="title_y2" />
						</div>
						<div>選択範囲(幅 : 高さ) : <input type="text" name="title_crop_width" id="title_crop_width" size="5" /> : <input type="text" name="title_crop_height" id="title_crop_height" size="5" />
						</div>
					</div>

					<div id="title_img_resize_params" class="mg10px-top mg20px-btm">
						<p>リサイズ方法を選んでください。※アスペクト比は保持されます。</p>
						<div class="mg8px-btm"><input type="radio" name="title_img_resize_type" id="title_img_resize_px" value="pixel" /><label for="title_img_resize_px"> リサイズ後の幅(ピクセル)</label> : 
							<input type="text" name="title_resize_val_px" id="title_resize_val_px" size="5" /> px
						</div>
						<div><input type="radio" name="title_img_resize_type" id="title_img_resize_percent" value="percent" /><label for="title_img_resize_percent"> 元画像との比率 : 
							<input type="text" name="title_resize_val_percent" id="title_resize_val_percent" size="5" /> %
						</div>
					</div>
		</div>

		<!-- Trim button -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" id="send_trim_title" type="submit" value="<?php _e('Edit this image', 'DigiPress'); ?>" />
</div>
	</form>
	</div>

<hr />

<h3 class="mg15px-top dp_set_title1 icon-bookmark" id="crop_banner_top">フルスクリーン背景画像 : </h3>
	<div class="pd30px-btm mg20px-l">
		<p class="pd10px-top"><a href="?page=digipress#upload" class="button open_upload_menu">画像のアップロード</a></p>
		<p><a href="?page=digipress_delete_file" class="button open_delete_menu">アップロード画像の削除</a></p>
		<form method="post" id="form_trim_header_img" enctype="multipart/form-data">
			<h3 class="dp_set_title2 icon-triangle-right">編集対象画像の選択 : </h3>
			<div class="clearfix mg15px-l">
			トリミングまたはリサイズする画像を選んでください。
			<?php
			if ( !empty($dp_theme_header_images) ) {
				echo '<ul class="clearfix" id="crop_header_img">';
				foreach ($dp_theme_header_images[0] as $key => $current_image) {
					//Image file only
					if (preg_match($strPattern, $current_image)) {
						//Current Image
						if ($options['dp_header_img'] === $current_image) {
							$chk	= " checked";
							$target_file_name = $current_image;
							$target_crop_img = $current_image;
							$imgInfo = getimagesize($target_crop_img);
							if($imgInfo){
							    $target_crop_img_w = $imgInfo[0];  // width
							    $target_crop_img_h = $imgInfo[1];    //height
							}else{
							    echo 'データの取得に失敗しました';
							}
						} else {
							$chk	= "";
						}

						echo '<li class="list_header_img">
							  <div class="clearfix pd8px-btm">
							  <img src="' . $current_image . '"  class="thumbBannerImg_crop" />
							  <img src="' . $current_image . '" class="hiddenImg" />
							  </div>
							  <div class="pd10px-btm"><input name="target_crop_banner_img" id="target_crop_banner_img'.$key.'" type="radio" value="' . $current_image . '"' . $chk . ' />
							  <label for="target_crop_banner_img'.$key.'">' . $dp_theme_header_images[1][$key] . '</label></div></li>';
					}
				}
				echo '</ul>';
			} else {
				echo '<p class="red">アップロードされたイメージはまだありません。</p>';
			}
			?>
			<input type="hidden" name="template_dir" class="template_dir" value="<?php echo DP_THEME_DIR; ?>" />
			<input type="hidden" name="template_url" class="template_url" value="<?php echo get_template_directory_uri(); ?>" />
			<input type="hidden" name="image_dir" class="image_dir" value="<?php echo $header_img_dir; ?>" />
			<input type="hidden" name="image_url" class="image_url" value="<?php echo $header_img_url; ?>" />
			</div>

			<h3 class="dp_set_title2 icon-triangle-right">トリミング／リサイズ : </h3>
			<div class="mg15px-l">
				<div class="pd12px-btm"><input type="radio" name="header_img_edit_target" id="header_img_edit_target_trim" value="trim" /><label for="header_img_edit_target_trim" class="mg12px-r">トリミング</label> 
					<input type="radio" name="header_img_edit_target" id="header_img_edit_target_resize" value="resize" /><label for="header_img_edit_target_resize">リサイズ</label>
					</div>
					<p id="label_for_header_img">マウスでトリミング範囲を選択してください。</p>
				<div id="trim_banner_img_div">
					<img src="<?php echo $target_crop_img; ?>" id="target_banner_img" width="<?php echo $target_crop_img_w; ?>" height="<?php echo $target_crop_img_h; ?>" />
					<input type="hidden" name="crop_banner_img" id="crop_banner_img" value="<?php echo $target_crop_img; ?>" />
					<input type="hidden" name="crop_banner_img_file_name" id="crop_banner_img_file_name" value="<?php echo $target_file_name; ?>" />
				</div>
	
				<div id="header_img_trim_params" class="mg10px-top mg20px-btm">
					<div class="mg8px-btm">トリミング起点(x, y) : 
						<input type="text" name="header_x1" id="header_x1" size="5" /> , <input type="text" name="header_y1" id="header_y1" size="5" />	
						<input type="hidden" name="header_x2" id="header_x2" />
						<input type="hidden" name="header_y2" id="header_y2" />
					</div>
					<div>選択範囲(幅 : 高さ) :  <input type="text" name="header_crop_width" id="header_crop_width" size="5" /> : <input type="text" name="header_crop_height" id="header_crop_height" size="5" />
					</div>
				</div>
				
				<div id="header_img_resize_params" class="mg10px-top mg20px-btm">
					<p>リサイズ方法を選んでください。※アスペクト比は保持されます。</p>
					<div class="mg8px-btm"><input type="radio" name="header_img_resize_type" id="header_img_resize_px" value="pixel" /><label for="header_img_resize_px"> リサイズ後の幅(ピクセル)</label> : 
						<input type="text" name="header_resize_val_px" id="header_resize_val_px" size="5" /> px
					</div>
					<div><input type="radio" name="header_img_resize_type" id="header_img_resize_percent" value="percent" /><label for="header_img_resize_percent"> 元画像との比率 : 
						<input type="text" name="header_resize_val_percent" id="header_resize_val_percent" size="5" /> %
					</div>
				</div>
		</div>

		<!-- trim button -->
<div class="mg20px-l mg20px-btm">
<input class="button button-primary" id="send_trim_banner" type="submit" value="<?php _e('Edit this image', 'DigiPress'); ?>" />
</div>
	</form>
	</div>

</div>
</div>
