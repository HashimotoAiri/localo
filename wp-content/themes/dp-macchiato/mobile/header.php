<?php
global $options, $options_visual, $IS_MOBILE_DP, $COLUMN_NUM, $SIDEBAR_FLOAT;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<?php if ( is_singular() ) : ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<?php else: ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# blog: http://ogp.me/ns/website#">
<?php endif; ?>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<?php
if ( (is_front_page() || is_archive()) && is_paged()) : 
?>
<meta name="robots" content="noindex,follow" />
<?php
elseif ( is_singular() ) :
	if (get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="noindex,nofollow,noarchive" />
<?php
	elseif (get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		!get_post_meta(get_the_ID(), 'dp_noarchive', true)) : 
?>
<meta name="robots" content="noindex,nofollow" />
<?php
	elseif (get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		!get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		!get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="noindex" />
<?php
	elseif (!get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="nofollow,noarchive" />
<?php
	elseif (!get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		!get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="noarchive" />
<?php
	elseif (!get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		!get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="nofollow" />
<?php
	elseif (get_post_meta(get_the_ID(), 'dp_noindex', true) && 
		!get_post_meta(get_the_ID(), 'dp_nofollow', true) && 
		get_post_meta(get_the_ID(), 'dp_noarchive', true)) :
?>
<meta name="robots" content="noindex,noarchive" />
<?php
	endif;
endif;

// **********************************
// Meta title, keyword, desc, etc
// **********************************
// if ( version_compare( $wp_version, '4.1', '<' ) ) {
// 	dp_site_title("<title>", "</title>") ;
// }
dp_site_title("<title>", "</title>") ;
// show keyword and description
dp_meta_kw_desc();
// show OGP
dp_show_ogp();
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
// **********************************
// WordPress header
// **********************************
wp_head();
// **********************************
// Custom header
// **********************************
echo $options['custom_head_content'];
// ***********************
// Slide menu JS
// ***********************
$position 	= 'position:"'.$options['mb_slide_menu_position'].'",';
$zposition 	= 'zposition:"'.$options['mb_slide_menu_zposition'].'"';
$mmenu_js = <<<_EOD_
j$(function(){
	j$("#global_menu_nav").mmenu({
		offCanvas:{
			$position
			$zposition
		}
	});
});
_EOD_;
$mmenu_js = str_replace(array("\r\n","\r","\n","\t"), '', $mmenu_js);
// **********************************
// wow.js
// **********************************
$wow_js = '';
if (!(bool)$options['disable_wow_js_mb']){
	 $wow_js = 'new WOW().init();';
}
// **********************************
// JS for Parallax Scrolling
// **********************************
$plx_each = (bool)$options['parallax_each_time'] ? 'true' : 'false';
$plx_mobile = (bool)$options['parallax_disable_mobile'] ? 'false' : 'true'; 
$plx_js = "j$(document).ready(function(){var plxcnf={reset:$plx_each,over:'0.8s',move:'80px',easing:'ease-out',mobile:$plx_mobile};window.sr=new scrollReveal(plxcnf);});";
// **********************************
// mmenu js + wow js + parallax js
// **********************************
echo '<script>var j$=jQuery;'.$mmenu_js.$wow_js.$plx_js.'</script>';
// **********************************
// js for slideshow
// **********************************
echo make_slider_js();
// **********************************
// Autopager JS
// **********************************
showScriptForAutopager($wp_query->max_num_pages);
// **********************************
// Google Custom Search
// **********************************
if (!empty($options['gcs_id'])) :  ?>
<script>(function(){var cx='<?php echo $options['gcs_id']; ?>';var gcse=document.createElement('script');gcse.type='text/javascript';gcse.async=true;gcse.src=(document.location.protocol=='https:'?'https:':'http:')+'//cse.google.com/cse.js?cx='+cx;var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(gcse,s);})();</script>
<?php 
endif;
?>
</head>
<?php
// **********************************
// Main Body
// **********************************
// @ params
// class for body tag 
$body_class = 'mb-theme';
// Pace.js class
if (is_front_page() && !is_paged()) {
	$body_class .= ' use-pace';
}
// Header flag
$has_header_class = '';
if ( is_front_page() && !is_paged() ) {
	if ($options_visual['dp_header_content_type_mobile'] !== "none" ) {
		$has_header_class = ' has-header';
	}
}
?>
<body <?php body_class($body_class); ?>>
<div id="main-wrap" class="main-wrap<?php echo $has_header_class; ?>">
<?php 
// **********************************
// Site header
// **********************************
include_once(TEMPLATEPATH."/".DP_MOBILE_THEME_DIR."/site-header.php");
// **********************************
// Full screen site banner
// **********************************
dp_banner_contents();
// **********************************
// Site container
// **********************************
$cur_page_class = "";
$show_header_class = '';
// Fixed class
$hdbar_fixed	= '';
if ($IS_MOBILE_DP) {
	if ($options['fixed_mb_header_bar']) {
		$hdbar_fixed = ' fixed';
	}
}
// Front page
if (is_front_page() && !is_paged() && !isset( $_REQUEST['q']) ) :
	if ( $options_visual['dp_header_content_type_mobile'] !== 'none' ) :
		$show_header_class =  ' show-header';
	else :
		$show_header_class =  ' no-header';
	endif;
	$cur_page_class = ' home';
elseif (is_singular()) :
	$cur_page_class = ' singular';
else :
	$cur_page_class = ' not-home';
endif;
?>
<div id="container" class="dp-container content clearfix<?php echo $cur_page_class.$show_header_class.$hdbar_fixed; ?>">
<?php
// **********************************
// Show eyecatch on container 
// **********************************
$plx_bg_code 	= '';
$image_css 		= '';
$image_url_f 	= '';
if (is_single() || is_page()) {
	// get post type
	$post_type 			= get_post_type();
	// Show eyecatch on top 
	$show_eyecatch_force 	= get_post_meta(get_the_ID(), 'dp_show_eyecatch_force', true);
	// Show eyecatch upper the title
	$eyecatch_on_container 	= get_post_meta(get_the_ID(), 'dp_eyecatch_on_container', true);
	if( has_post_thumbnail() && $show_eyecatch_force && $eyecatch_on_container ) {
		$width_f 	= 1200;
		$height_f	= 1000;
		
		$image_id_f		= get_post_thumbnail_id();
		$image_data_f	= wp_get_attachment_image_src($image_id_f, array($width_f, $height_f), true);
		$image_url_f 	= is_ssl() ? str_replace('http:', 'https:', $image_data_f[0]) : $image_data_f[0];
		list($img_w, $img_h, $img_type, $img_attr) = getimagesize($image_url_f);
		$image_css 		= ' style="background-image:url('.$image_url_f.')" data-img-w="'.$img_w.'" data-img-h="'.$img_h.'"';
		$plx_bg_code	= '<div class="plx_bg pl_img"'.$image_css.'></div>';
	}
}
// ************************
// Main title (Except top page)
// ************************
$hd_title_show 	= true;
$hd_title_code 	= '';
$hd_title_data	= '';
$hd_desc_data	= '';
$hd_plx_class	= '';
$cat_color 		= '';
$page_class		= '';
// Get title and description
$arr_title = dp_current_page_title();
if (!(bool)$options['parallax_disable_mobile']) {
	$hd_title_data = ' data-sr="enter top move 20px reset"';
	$hd_desc_data = ' data-sr="enter bottom move 15px wait 0.2s reset"';
	$hd_plx_class = ' plx';
}
$hd_title_code = '<h1 class="hd-title'.$hd_plx_class.'"'.$hd_title_data.'><span>'.$arr_title['title'].'</span></h1>';
if (!empty($arr_title['desc'])) {
	$page_desc = '<div class="title-desc'.$hd_plx_class.'"'.$hd_desc_data.'>'.$arr_title['desc'].'</div>';
}

if (!is_home()) :
	if (is_category()) :
		global $cat;
		$cat_color = " cat-color".$cat;
	elseif (is_page()) :
		$page_class = ' page';
		$hide_title_flag = get_post_meta(get_the_ID(), 'dp_hide_title', true);
		$eyecatch_flag = get_post_meta(get_the_ID(),'dp_eyecatch_on_container',true );
		if ((bool)$hide_title_flag) :
			$hd_title_code = '';
			if (!$eyecatch_flag) :
				$hd_title_show = false;
			endif;
		endif;
	elseif (is_single()) :	// When hide the category in single page
		$dp_hide_cat = get_post_meta(get_the_ID(), 'dp_hide_cat', true);
		$eyecatch_flag = get_post_meta(get_the_ID(),'dp_eyecatch_on_container',true );
		if (!$options['show_cat_on_meta'] || $dp_hide_cat) :
			$hd_title_code = '';
			if (!$eyecatch_flag) :
				$hd_title_show = false;
			endif;
		else :
			$cats = get_the_category();
			if ($cats) {
				// One category
				$cat_color = " cat-color".$cats[0]->cat_ID;
			}
		endif;
	endif;
	// Display
	if ((bool)$hd_title_show) {
		echo '<section class="ct-hd'.$cat_color.$page_class.$hdbar_fixed.'">'.$plx_bg_code.$hd_title_code.$page_desc.'</section>';
	}
endif;
// **********************************
// Container widget
// **********************************
if (!is_404() && is_active_sidebar('widget-container-top-mb')) : ?>
<div class="widget-container top clearfix<?php echo $cur_page_class; ?>">
<?php dynamic_sidebar( 'widget-container-top-mb' ); ?>
</div>
<?php 
endif;
