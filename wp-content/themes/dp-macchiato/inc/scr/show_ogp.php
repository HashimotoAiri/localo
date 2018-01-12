<?php
// ********************
// OGP & Twitter card
// ********************
function dp_show_ogp() {
	global $options;
	if ((bool)$options['disable_auto_ogp'] || class_exists('All_in_One_SEO_Pack')) return;

	$ogp_code 	= '';
	$title 		= '';
	$desc 		= '';
	$url 		= '';
	$img_url	= '';
	$type		= 'article';

	if (is_single() || is_page()) {
		$title 	 = the_title_attribute(array('before'	=> '', 
											 'after' 	=> '', 
											 'echo' 	=> false));
		$url 	 	= get_permalink();
		$arg 		= array("width"=>1200, "height"=>630, "if_img_tag"=> false);
		$img_url 	= show_post_thumbnail($arg);

	} else {
		$title 	= dp_site_title('', '', false);
		$url 	= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$img_url = $options['meta_ogp_img_url'];

		if (is_home() && is_front_page()) {
			$type		= 'website';
		}
	}
	// desc
	$desc = create_meta_desc_tag();

	// OGP tag
	$ogp_code = 
'<meta property="og:title" content="' . $title . '" /><meta property="og:type" content="' . $type . '" /><meta property="og:url" content="' . $url .'" /><meta property="og:image" content="' . $img_url . '" /><meta property="og:description" content="' . $desc . '" />';
	
	// twitter card tag
	if ( !empty($options['twitter_card_user_id']) ) {
		$twitter_card_code = '<meta name="twitter:card" content="summary_large_image" /><meta name="twitter:site" content="@'.$options['twitter_card_user_id'].'" />';
	}

	echo $ogp_code.$twitter_card_code;
}
?>