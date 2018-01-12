<?php
function show_post_thumbnail($args){
	// Default
	$width 		= 800;
	$height		= 640; 
	$post_id	= null;
	$if_img_tag = true;
	$no_img_replace = false;
	
	// Params
	extract($args);

	$post_id = empty($post_id) ? get_the_ID() : $post_id;
	$lp_class	= "";
	$image_url	= "";
	$image_data	= "";
	$img_tag	= "";
	
	if (has_post_thumbnail($post_id)) {
		$image_id 	= get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, array($width, $height), true); 
		$image_url 	= is_ssl() ? str_replace('http:', 'https:', $image_data[0]) : $image_data[0];
		$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		$alt = empty($alt) ? get_the_title() : $alt;

		// $image_w	= $image_data[1];
		// $image_h	= $image_data[2];
		// $lp_class 	= ' centered';
		// if ($image_w > $image_h) {
		// 	$lp_class .= ' landscape';
		// } else {
		// 	$lp_class .= ' portrait';
		// }

		if ($if_img_tag) {
			// $img_tag = get_the_post_thumbnail($post_id, array($width, $height));
			$img_tag = '<img src="'.$image_url.'" width="'.$width.'" class="wp-post-image'.$lp_class.'" alt="'.$alt.'" />';
		} else {
			$img_tag 	= $image_url;
		}
		
	} else {
		if ((bool)$no_img_replace) {
			$img_tag = false;
		} else {
			// Video ID(YouTube only)
			$videoID = get_post_meta($post_id, 'item_video_id', true);
			// Target video service
			$video_service = get_post_meta($post_id, 'video_service', true);
			// Image code
			if (!empty($videoID)) {
				if ( WP_Filesystem() ) {
				 	global $wp_filesystem;
				 	switch ($video_service) {
						case 'Vimeo':
							$vimeo_hash = unserialize($wp_filesystem->get_contents("http://vimeo.com/api/v2/video/".$videoID.".php"));
							$image_url = $vimeo_hash[0]['thumbnail_large'];
							break;
						case 'YouTube':
						default:
							$image_url = "//img.youtube.com/vi/'.$videoID.'/0.jpg";
							break;
					}
				}
				if ($if_img_tag) {
					$img_tag = '<img src="'.$image_url.'" class="wp-post-image" alt="'.get_the_title().'" />';
				} else {
					$img_tag = $image_url;
				}
			} else {
				preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"]/i', get_post($post_id)->post_content, $imgurl);
				if (isset($imgurl[1][0])) {
					$image_url = is_ssl() ? str_replace('http:', 'https:', $imgurl[1][0]) : $imgurl[1][0];
					if ($if_img_tag) {
						$img_tag = '<img src="'.$image_url.'" width="'.$width.'" class="wp-post-image" alt="'.get_the_title().'" />';
					} else {
						$img_tag = $image_url;
					}
					
				} else {
					$strPattern	=	'/(\.gif|\.jpg|\.jpeg|\.png|\.svg)$/';
					if ($handle = opendir(DP_THEME_DIR . '/img/post_thumbnail')) {
						$image = '';
						$cnt = 0;
						while (false !== ($file = readdir($handle))) {
							if ($file != "." && $file != "..") {
								//Image file only
								if (preg_match($strPattern, $file)) {
									$image[$cnt] = DP_THEME_URI . '/img/post_thumbnail/'.$file;
									//count
									$cnt ++;
								}
							}
						}
						closedir($handle);
					}
					if ($cnt > 0) {
						$randInt = rand(0, $cnt - 1);
						$image_url = is_ssl() ? str_replace('http:', 'https:', $image[$randInt]) : $image[$randInt];
						if ($if_img_tag) {
							$img_tag = '<img src="'.$image_url.'" width="'.$width.'" class="wp-post-image noimage" alt="'.get_the_title().'" />';
						} else {
							$img_tag = $image_url;
						}
					}
				}
			}
		}
	}
	
	return $img_tag;
}
?>