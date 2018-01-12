<header id="header_container" class="header_container pc">
<div class="header_content clearfix">
<div class="h_group">
<?php
// Get WP theme customizer objects(no use)
$custom_header 		= get_custom_header();
$custom_header_image = get_header_image();

// wow.js
$wow_title_css = '';
$wow_desc_css = '';
$attr_delay = '';
$attr_delay_r = ' data-wow-delay="0.3s"';
if (!(bool)$options['disable_wow_js']) {
	$wow_title_css = ' wow fadeInDown';
	$wow_desc_css = ' wow fadeInUp';
	if (is_front_page() && !is_paged()) {
		$attr_delay = ' data-wow-delay="1.6s"';
		$attr_delay_r = ' data-wow-delay="2s"';
	}
}

// **********************************
// Header main title
// **********************************
$site_title = '';
$caption = dp_h2_title('<h2 class="caption'.$wow_desc_css.'"'.$attr_delay.'>', '</h2>');
$cap_flag = empty($caption) ? ' no-cap' : '';
if (!empty($custom_header_image)) {
	$site_title = '<h1 class="hd_title img'.$cap_flag.$wow_title_css.'"'.$attr_delay.'><a href="'.home_url().'/" title="'.get_bloginfo('name').'"><img src="'.$custom_header_image.'" height="'.$custom_header->height.'" width="'.$custom_header->width.'" alt="'.dp_h1_title().'" /></a></h1>';
} else {
	if ($options_visual['h1title_as_what'] !== 'image') {
		$site_title = '<h1 class="hd_title txt'.$cap_flag.$wow_title_css.'"'.$attr_delay.'><a href="'.home_url().'/" title="'.get_bloginfo('name').'">'.dp_h1_title().'</a></h1>';
	} else {
		$logo_img_url = is_ssl() ? str_replace('http:', 'https:', $options_visual['dp_title_img']) : $options_visual['dp_title_img'];
		$site_title = '<h1 class="hd_title img'.$cap_flag.$wow_title_css.'"'.$attr_delay.'><a href="'.home_url().'/" title="'.get_bloginfo('name').'"><img src="'.$logo_img_url.'" alt="'.dp_h1_title().'" /></a></h1>';
	}	
}
echo $site_title.$caption;
?>
</div>
<?php
// **********************************
// Global Menu
// **********************************
include (TEMPLATEPATH . "/global-menu.php");
?>
</div><?php // End of .header_content ?>
</header>