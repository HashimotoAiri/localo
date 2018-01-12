<?php
/*******************************************************
* DigiPress Theme Version Check
* return Array(image path, image names)
*******************************************************/
function dp_get_uploaded_images($target = "header", $replace_to_url = true) {
	$images_url = DP_UPLOAD_URI . "/" . $target;
	$images_dir	= DP_UPLOAD_DIR . "/" . $target;

	if ( defined( 'GLOB_BRACE' ) ) {
		$images = glob($images_dir . "/*.{jpg,jpeg,gif,png,svg}", GLOB_BRACE);
	} else {
		$images = array_merge( glob( $images_dir . "/*.jpg" ), glob( $images_dir . "/*.jpeg" ), glob( $images_dir . "/*.gif" ), glob( $images_dir . "/*.png" ), glob( $images_dir . "/*.svg" ) );
	}

	// default images
	if ( empty($images) ) {
		$images_url = DP_THEME_URI . "/img/sample/" . $target;
		$images_dir	= DP_THEME_DIR . "/img/sample/" . $target;
		if ( defined( 'GLOB_BRACE' ) ) {
			$images = glob($images_dir . "/*.{jpg,jpeg,gif,png,svg}", GLOB_BRACE);
		} else {
			$images = array_merge( glob( $images_dir . "/*.jpg" ), glob( $images_dir . "/*.jpeg" ), glob( $images_dir . "/*.gif" ), glob( $images_dir . "/*.png" ), glob( $images_dir . "/*.svg" ) );
		}
		
	}

	// Replace outer URL
	if ( !empty($images) && $replace_to_url ) {
		$image_names = str_replace($images_dir . "/", "", $images);
		$images = str_replace($images_dir, $images_url, $images);
	}
	return array($images, $image_names);
}
?>