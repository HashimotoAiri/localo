<?php
/*******************************************************
* Create Style Sheet
*******************************************************/
/** ===================================================
* Create main CSS file.
*
* @param	string	$color
* @param	string	$sidebar
* @return	none
*/
function dp_css_create() {
	$options 		= get_option('dp_options');
	$options_visual = get_option('dp_options_visual');
	
	//Custom CSS file
	$file_path	=  DP_UPLOAD_DIR . "/css/visual-custom.css";
	//Get theme settings
	$originalCSS	= $options_visual['original_css'];

	// Create CSS
	$str_css = dp_custom_design_css(
					$options,
					$options_visual
				);

	// Strip blank, tags
	$str_css = str_replace(array("\r\n","\r","\n","\t"), '', $str_css);

	// Rewrite CSS for custom design
	dp_export_file($file_path, $str_css);
	// gzip compress
	dp_export_gzip($file_path, $str_css);
	
	return true;
}


/**  ===================================================
* Create css for custom design hack.
*
* @param	string	$headerImage	Custom header image.
* @param	string	$imgRepeat	Method image repeat.
* @param	string	$blindTitle	Whether site title is blind.
* @param	string	$blindDesc	Whether site description is blind.
* @return	none
*/
function dp_custom_design_css($options, $options_visual) {
	extract($options);
	extract($options_visual);

	$original_font_size_px				= 14;
	$original_font_size_em				= 1.1;

	// For CS
	$body_css 						= '';
	$site_bg_img_css				= '';
	$base_font_size_css				= '';
	$header_slideshow_css 			= '';
	$global_menu_css 				= '';
	$bx_slider_css 					= '';
	$container_css 					= '';
	$entry_css 						= '';
	$sidebar_css					= '';
	$list_hover_css 				= '';
	$meta_area_css 					= '';
	$base_link_color_css 			= '';
	$base_link_hover_color_css 		= '';
	$navigation_link_color_css 		= '';
	$link_filled_color_css 			= '';
	$header_filter_css 				= '';
	$entry_link_css 				= '';
	$border_color_css 				= '';
	$bordered_obj_css 				= '';
	$common_bg_color_css 			= '';
	$quote_css 						= '';
	$comment_box_css 				= '';
	$tooltip_css 					= '';
	$search_form_css 				= '';
	$footer_widget_css 				= '';
	$footer_css						= '';
	$form_css 						= '';
	$ranking_css 					= '';
	$cat_colos_css 					= '';
	$btn_label_css 					= '';


	// *************************************************
	// layout CSS
	// *************************************************
	// Footer Column number
	switch ($footer_col_number) {
		case 1:
			$footer_widget_css = <<<_EOD_
.ft-widget-content .widget-area {
	width:100%;
}
_EOD_;
			break;
		case 2:
			$footer_widget_css = <<<_EOD_
.ft-widget-content .widget-area {
	width:47.8%;
}
.ft-widget-content .widget-area.one{
	margin:0 3.8% 0 0;
}
_EOD_;
			break;
		case 3:
			$footer_widget_css = <<<_EOD_
.ft-widget-content .widget-area {
	width:30.8%;
}
.ft-widget-content .widget-area.two{
	margin:0 3.8%;
}
_EOD_;
			break;
		case 4:
			$footer_widget_css = <<<_EOD_
.ft-widget-content .widget-area {
	width:22.6%;
	margin:0 3.2% 0 0;
}
.ft-widget-content .widget-area.four{
	margin:0;
}
_EOD_;
			break;
		default:
			$footer_widget_css = "";
			break;
	}


	// RGB
	$rgb_header_banner_txt_shadow = hexToRgb($header_banner_text_shadow_color);
	$rgb_header_banner_txt = hexToRgb($header_banner_font_color);
	$rgb_container_bg = hexToRgb($container_bg_color);
	$rgb_base_font = hexToRgb($base_font_color);
	$rgb_base_link = hexToRgb($base_link_color);
	$rgb_hd_menu_bg = hexToRgb($header_menu_bgcolor);
	$rgb_hd_menu_link = hexToRgb($header_menu_link_color);
	$rgb_footer_text_color = hexToRgb($footer_text_color);


	// *************************************************
	// Body CSS
	// *************************************************
	// Body CSS
	$body_css = 
"body{
	background-color:$container_bg_color;
}";

	// *************************************************
	// Background image
	// *************************************************
	//Background image
	if ( $dp_background_img == "none" || !$dp_background_img ) {
		$site_bg_img_css ='';
	} else {
		$dp_background_img = is_ssl() ? str_replace('http:', 'https:', $dp_background_img) : $dp_background_img;
		$site_bg_img_css ="background-image:url(".$dp_background_img.");background-repeat:".$dp_background_repeat.";background-position:left top;";
	}
	

	// *************************************************
	// Container CSS
	// *************************************************
	$container_css = 
".dp-container,
.mm-page{
	color:".$base_font_color.";
	background-color:".$container_bg_color.";".$site_bg_img_css."
}
.dp-container a,
.dp-container a:hover,
.dp-container a:visited,
.main-wrap a,
.main-wrap a:visited,
.mm-page a,
.mm-page a:visited{
	color:".$base_font_color.";
}
.content-wrap{
	background-color:".$container_bg_color.";
}
.pace{
	background-color:".$container_bg_color.";
	border-color:".$accent_color.";
}
.pace .pace-progress{
	background-color:".$accent_color.";
}
.pace .pace-progress:after{
	color:rgba(".$rgb_base_font[0].",".$rgb_base_font[1].",".$rgb_base_font[2].",.68);
}";



	// *************************************************
	// entry CSS
	// *************************************************
	// Font size
	if (!$base_font_size || ($base_font_size == '')) {
		if ( !$base_font_size_unit || $base_font_size_unit == '' ) {
			$base_font_size_css = 
".entry,
.widget-box{
	font-size:".$original_font_size_px."px;
}";
		} else {
			$base_font_size_css = 
".entry,
.widget-box{
	font-size:".$original_font_size_em."em".$options_visual['base_font_size_unit'].";
}";
		}
	} else {
		if ( !$base_font_size_unit || $base_font_size_unit == '' ) {
			$base_font_size_css = 
".entry,
.widget-box{
	font-size:".$base_font_size."px;
}";
		} else {
			$base_font_size_css = 
".entry,
.widget-box{
	font-size:".$base_font_size.$base_font_size_unit.";
}";
		}
	}
	// For mobile
	if (!$base_font_size_mb || ($base_font_size_mb == '')) {
		if ( !$base_font_size_mb_unit || $base_font_size_mb_unit == '' ) {
			$base_font_size_css .= 
".mb-theme .entry,
.mb-theme .widget-box{
	font-size:".$original_font_size_px."px;
}";
		} else {
			$base_font_size_css .= 
".mb-theme .entry,
.mb-theme .widget-box{
	font-size:".$original_font_size_em."em".$options_visual['base_font_size_mb_unit'].";
}";
		}
	} else {
		if ( !$base_font_size_mb_unit || $base_font_size_mb_unit == '' ) {
			$base_font_size_css .= 
".mb-theme .entry,
.mb-theme .widget-box{
	font-size:".$base_font_size_mb."px;
}";
		} else {
			$base_font_size_css .= 
".mb-theme .entry,
.mb-theme .widget-box{
	font-size:".$base_font_size_mb.$base_font_size_mb_unit.";
}";
		}
	}

	//Link Style
	if ($base_link_underline == 1 || $base_link_underline == null) {
		if ($base_link_bold) {
			$entry_link_css	= 
".dp-container .entry a{
	font-weight:bold;text-decoration:none;
}
.dp-container .entry a:hover{
	text-decoration:underline;
}";
		} else {
			$entry_link_css	= 
".dp-container .entry a{
	font-weight:normal;
	text-decoration:none;
}
.dp-container .entry a:hover{
	text-decoration:underline;
}";
		}
	} else {
		if ($base_link_bold) {
			$entry_link_css	= 
".dp-container .entry a{
	font-weight:bold;
	text-decoration:underline;
}
.dp-container .entry a:hover{
	text-decoration:none;
}";
		} else {
			$entry_link_css	= 
".dp-container .entry a{
	font-weight:normal;
	text-decoration:underline;
}
.dp-container .entry a:hover{
	text-decoration:none;
}";
		}
	}



	// *************************************************
	// anchor text link CSS
	// *************************************************
	$base_link_color_css = 
".dp-container .entry a,
.dp-container .entry a:visited,
.dp-container .dp_text_widget a,
.dp-container .dp_text_widget a:visited,
.dp-container .textwidget a,
.dp-container .textwidget a:visited,
#comment_section .commentlist a:hover{
	color:" . $base_link_color . ";
}";

	$link_filled_color_css 			= 
".single-date-top,
.content pre,
.entry input[type=\"submit\"],
.plane-label,
input#submit{
	color:". $container_bg_color.";
	background-color:" . $base_link_color . ";
}";


	//Base hovering anchor text color
	$base_link_hover_color_css	= 
".dp-container .entry a:hover,
.dp-container .dp_text_widget a:hover,
.dp-container .textwidget a:hover,
.fake-hover:hover{
	color:".$base_link_hover_color.";
}";


	// ***********************************
	// navigation color CSS
	// ***********************************
	$navigation_link_color_css = 
".tagcloud a,
#comment_section .comment-meta .comment-reply-link,
.entry>p>a.more-link,
.dp-container .entry .dp-pagenavi a,
.dp-container .entry .dp-pagenavi a:visited,
.dp-pagenavi a,
.dp-pagenavi a:visited,
.dp-pagenavi .page-numbers:not(.dots),
.navigation a,
.navigation a:visited{
	color:".$base_font_color.";
}
#commentform input[type=\"submit\"]{
	color:".$accent_color.";
}
#commentform input[type=\"submit\"]:hover{
	color:".$container_bg_color.";
	background-color:".$accent_color.";
	border-color:".$accent_color.";
}
.single_post_meta .meta-cat a:hover,
.dp_related_posts.horizontal .meta-cat a:hover,
.tagcloud a:hover,
.dp-container .more-entry-link a:hover,
#comment_section .comment-meta .comment-reply-link:hover,
.entry>p>a.more-link:hover,
.navialignleft a:hover,
.navialignright a:hover,
.dp-container .entry .dp-pagenavi a:hover,
.dp-container .entry .dp-pagenavi a:before,
.dp-pagenavi a:hover,
.dp-pagenavi a:before,
.dp-pagenavi .page-numbers.current,
.dp-pagenavi .page-numbers:hover{
	color:".$container_bg_color.";
	background-color:".$base_font_color.";
	border-color:".$base_font_color.";
}
.nav_to_paged a:before,
.nav_to_paged a:after,
.loop-section .more-link a:before,
.loop-section .more-link a:after,
.loop-section.magazine .loop-article:before{
	background-color:".$base_font_color.";
}
.dp-container .more-entry-link a{
	background-color:rgba(".$rgb_base_font[0].",".$rgb_base_font[1].",".$rgb_base_font[2].",0.18);
}";


	// ***********************************
	// Post meta info CSS
	// ***********************************
	$darken_accent_color = darkenColor($accent_color);
	$meta_area_css = 
".loop-section.normal:not(.mobile) .loop-date,
.loop-section.portfolio.pt2 .loop-date,
.loop-section.magazine.pt1 .loop-date,
.loop-section.portfolio.mobile .loop-date,
.single-article header .meta-date,
#gotop{
	background-color:".$accent_color.";
	color:".$container_bg_color.";
}
.loop-section.normal:not(.mobile) .loop-date:before,
.loop-section.portfolio.pt2 .loop-date:before,
.loop-section.magazine.pt1 .loop-date:before,
.loop-section.portfolio.mobile .loop-date:before,
.single-article header .meta-date:before{
	border-color:rgba(".$darken_accent_color[0].",".$darken_accent_color[1].",".$darken_accent_color[2].",1) transparent transparent rgba(".$darken_accent_color[0].",".$darken_accent_color[1].",".$darken_accent_color[2].",1);
	background-color:".$container_bg_color.";
}
.single-article .single_post_meta .loop-share-num a,
.loop-section.portfolio.pattern2 .loop-title a,
.loop-section.normal .loop-share-num a,
.loop-section.magazine .loop-share-num a,
.loop-section.mobile .loop-share-num a,
.loop-section .loop-title a,
.loop-section .meta-author a{
	color:".$base_font_color.";
}
.loop-section.normal .loop-share-num i:after,
.loop-section.magazine .loop-share-num i:after,
.loop-section.mobile .loop-share-num i:after{
	border-color:transparent transparent transparent rgba(".$rgb_base_font[0].",".$rgb_base_font[1].",".$rgb_base_font[2].",0.1);
}
.loop-section.normal .loop-share-num i,
.loop-section.magazine .loop-share-num i,
.loop-section.mobile .loop-share-num i,
.single-article .single_post_meta .loop-share-num i,
.dp_feed_widget li a{
	color:".$base_font_color.";
	background-color:rgba(".$rgb_base_font[0].",".$rgb_base_font[1].",".$rgb_base_font[2].",0.1);
}
.dp_feed_widget li a:hover{
	color:".$container_bg_color.";
}
.dp_feed_widget li a:hover:before{
	background-color:".$base_font_color.";
}
.loop-excerpt{
	color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.74);
}";


	// *************************************************
	// Border CSS
	// *************************************************
	$border_color_css = 
"hr{
	border-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.4);
}
address,
#switch_comment_type li.active_tab,
#comment_section li.comment:hover,
#comment_section li.trackback:hover,
#comment_section li.pingback:hover{
	border-color:".$accent_color.";
}
.loop-section.normal .loop-article,
.loop-section.news .loop-article,
.widget_pages li a,
.widget_nav_menu li a,
.widget_categories li a,
.widget_mycategoryorder li a,
.recent_entries li,
.dp_related_posts.vertical li,
.mb-theme .dp_related_posts li,
.content table th,
.content table td,
.content dl,
.content dt,
.content dd,
.entrylist-date,
#switch_comment_type li.inactive_tab,
div#comment-author,
div#comment-email,
div#comment-url,
div#comment-comment,
#comment_section li.comment,
#comment_section li.trackback,
#comment_section li.pingback {
	border-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.16);
}
#comment_section ul.children{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.06);
}
#comment_section ul.children:before{
	border-color:transparent transparent rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.06) transparent;
}
.widget_pages li a:after,
.widget_nav_menu li a:after,
.widget_nav_menu li.current-menu-item a:after,
.widget_categories li a:after,
.widget_categories li.current-cat a:after,
.widget_mycategoryorder li a:after{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.54);
}";

	

	// *************************************************
	// Comon background color CSS
	// *************************************************
	$common_bg_color_css = 
".dp-container dt,
.dp-container table th,
.entry .wp-caption,
#wp-calendar caption,
#wp-calendar th, 
#wp-calendar td{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.04);
}
.mb-theme .single-nav li{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.06);
}
#wp-calendar tbody td#today{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.2);
}";

	
	// *************************************************
	// Bordered object css
	// *************************************************
	$bordered_obj_css = 
".entry ul li:before, 
.dp_text_widget ul li:before,
.textwidget ul li:before{
	background-color:".$accent_color.";
}
.single-article header:before,
.single-article .single_post_meta,
.single-article .single_post_meta .loop-share-num div[class^=\"bg-\"],
.dp_related_posts.news li,
.entry .wp-caption,
#searchform,
table.gsc-search-box{
	border-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.4);
}
.single-article .single_post_meta:before{
	background-color:".$container_bg_color.";
	color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.4);
}
.inside-title,
#reply-title{
	color:".$base_font_color.";
}
.inside-title:before,
#reply-title:before{
	box-shadow:0 3px 0 rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.4);
}
.inside-title:before,
.wd-title:before,
#reply-title:before,
.dp_tab_widget_ul li:before,
.dp_related_posts.horizontal .meta-cat:before{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.4);
}
.inside-title span,
#reply-title span,
.dp_tab_widget_ul li span,
.dp_related_posts.horizontal .meta-cat span,
.wd-title span{
	background-color:".$container_bg_color.";
}
.dp_tab_widget_ul li:hover:before,
.dp_tab_widget_ul li.active_tab:before{
	background-color:".$accent_color.";
}
.dp_tab_widget_ul{
	border-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.6);
}
.cat-item .count{
	color:".$container_bg_color.";
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.5);
}";



	// List item hover color
	$list_hover_css = 
"span.v_sub_menu_btn{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.04);
}
.dp_related_posts li:hover,
.recent_entries li:hover{
	border-color:".$base_font_color.";
}";


	// *************************************************
	// Global menu CSS
	// *************************************************
	 $split_header_menu_bgcolor = str_replace('#', '', $header_menu_bgcolor);
	 $global_menu_css = 
".header_container.pc,
.header_container.mb.fixed{
	color:".$header_menu_link_color.";
	background-color:".$header_menu_bgcolor.";
	background:linear-gradient(to bottom, rgba(".$rgb_hd_menu_bg[0].",".$rgb_hd_menu_bg[1].",".$rgb_hd_menu_bg[2].",0.58) 0%,rgba(".$rgb_hd_menu_bg[0].",".$rgb_hd_menu_bg[1].",".$rgb_hd_menu_bg[2].",0) 100%);
	filter:progid:DXImageTransform.Microsoft.gradient( startColorstr='#34'".$split_header_menu_bgcolor.", endColorstr='#14'".$split_header_menu_bgcolor.",GradientType=0 );
}
.header_container.mb{
	border-color:".$accent_color.";
	color:".$header_menu_link_color.";
	background-color:".$header_menu_bgcolor.";
}
.header_container.pc:hover,
.header_container.pc.scroll {
	background-color:rgba(".$rgb_hd_menu_bg[0].",".$rgb_hd_menu_bg[1].",".$rgb_hd_menu_bg[2].",0.72);
}
.header_container a,
.header_container a:visited,
#hd_tel a,
.mm-page .header_container a,
.mm-page .header_container a:visited,
#global_menu_ul a.menu-link:hover{
	color:".$header_menu_link_color.";
}
.header_container a:hover,
.mm-page .header_container a:hover{
	color:".$header_menu_link_hover_color.";
}
.hd_sns_links ul li a:before{
	background-color:".$header_menu_link_color.";
}
#global_menu_ul .sub-menu {
	background-color:rgba(".$rgb_hd_menu_bg[0].",".$rgb_hd_menu_bg[1].",".$rgb_hd_menu_bg[2].",0.72);
	box-shadow:0 1px 4px rgba(".$rgb_hd_menu_link[0].",".$rgb_hd_menu_link[1].",".$rgb_hd_menu_link[2].", 0.7);
}
#global_menu_ul a.menu-link,
.hd_sns_links ul li a{
	color:rgba(".$rgb_hd_menu_link[0].",".$rgb_hd_menu_link[1].",".$rgb_hd_menu_link[2].", 0.7);
}
#global_menu_ul a.menu-link:after{
	background-color:".$accent_color.";
}
.hd_sns_links ul li a:hover{
	color:".$header_menu_bgcolor.";
}
#global_menu_nav.mq-mode{
	color:".$header_menu_link_color.";
	background-color:".$header_menu_bgcolor.";
}
#global_menu_nav.mq-mode .mq_sub_li{
	color:".$header_menu_bgcolor.";
	background-color:".$header_menu_link_color.";
}
.mm-menu {
	background-color:".$header_menu_bgcolor.";
}
.mm-menu,
.mm-listview li a{
	color:".$header_menu_link_color.";	
}
.mm-menu .mm-navbar>a {	
	color:rgba(". $rgb_hd_menu_link[0] . ", " . $rgb_hd_menu_link[1] . "," . $rgb_hd_menu_link[2] . ", 0.6);
}
#global_menu_nav.mq-mode,
#global_menu_nav.mq-mode .menu-link,
.mm-menu .mm-navbar,
.mm-menu .mm-listview > li:after,
.mm-menu .mm-listview>li>a.mm-prev:after,
.mm-menu .mm-listview>li>a.mm-next:before{
	border-color:rgba(". $rgb_hd_menu_link[0] . ", " . $rgb_hd_menu_link[1] . "," . $rgb_hd_menu_link[2] . ", 0.22);	
}
.mm-menu .mm-navbar .mm-btn:before, 
.mm-menu .mm-navbar .mm-btn:after,
.mm-menu .mm-listview>li>a.mm-prev:before, 
.mm-menu .mm-listview>li>a.mm-next:after {
	border-color:rgba(". $rgb_hd_menu_link[0] . ", " . $rgb_hd_menu_link[1] . "," . $rgb_hd_menu_link[2] . ", 0.36);
}
.mm-menu .mm-listview li.current-menu-item:after,
.mm-menu .mm-listview li.current_page_item:after {
	border-color:".$header_menu_link_hover_color.";
}
.mm-menu .mm-listview > li.mm-selected > a:not(.mm-subopen),
.mm-menu .mm-listview > li.mm-selected > span{
	background-color:rgba(". $rgb_hd_menu_link[0] . ", " . $rgb_hd_menu_link[1] . "," . $rgb_hd_menu_link[2] . ", 0.8);
}";

	
	// *************************************************
	// Header Slideshow CSS 
	// *************************************************
	$txt_shadow = (bool)$header_banner_text_shadow_enable ? "text-shadow:0 0 30px rgba(".$rgb_header_banner_txt_shadow[0].",".$rgb_header_banner_txt_shadow[1].",".$rgb_header_banner_txt_shadow[2].",0.38);" : "";
	$txt_shadow_mb = (bool)$header_banner_text_shadow_enable ? "text-shadow:0 0 15px rgba(".$rgb_header_banner_txt_shadow[0].",".$rgb_header_banner_txt_shadow[1].",".$rgb_header_banner_txt_shadow[2].",0.72);" : "";

	$header_slideshow_css = 
".hd_slideshow .bx-wrapper .bx-pager .bx-pager-item a{
	background-color:".$header_banner_font_color.";
	".$txt_shadow."
}
.hd_slideshow .bx-controls-direction a{
	color:".$header_banner_font_color.";
}
.header-banner-inner,
.header-banner-inner a, 
.header-banner-inner a:hover,
.header-banner-inner a:visited{
	color:".$header_banner_font_color.";
	".$txt_shadow."
}
.mb-theme .header-banner-inner,
.mb-theme .header-banner-inner a, 
.mb-theme .header-banner-inner a:hover,
.mb-theme .header-banner-inner a:visited{
	color:".$header_banner_font_color.";
	".$txt_shadow_mb."
}
#banner_caption:before,
#banner_caption:after,
.header-banner-inner .bx-viewport .slide .loop-cat:before,
.header-banner-inner .bx-viewport .slide .loop-cat:after{
	background-color:".$header_banner_font_color.";
}";

	// *************************************************
	// Bx Slider object CSS 
	// *************************************************
	$bx_slider_css =
".bx-wrapper .bx-pager .bx-pager-item a{
	background-color:".$base_font_color.";
}
.bx-controls-direction a{
	color:".$container_bg_color.";
}";

	
	// *************************************************
	// Search form CSS
	// *************************************************
	$search_form_css = 
"#searchform input#searchtext {
	color:".$base_font_color.";
}
#searchform:before{
	color:".$base_font_color.";
}
#searchform input:focus {
	background-color:".$container_bg_color.";
}
#hd_searchform #searchform input#searchtext,
#hd_searchform #searchform:hover input#searchtext::-webkit-input-placeholder,
#hd_searchform #searchform input#searchtext:focus::-webkit-input-placeholder {
	color:".$header_menu_link_color.";
}
#hd_searchform #searchform,
#hd_searchform #searchform:before{
	color:rgba(".$rgb_hd_menu_link[0].",".$rgb_hd_menu_link[1].",".$rgb_hd_menu_link[2].",0.7);
}
#hd_searchform.mb #searchform{
	border-color:rgba(".$rgb_hd_menu_link[0].",".$rgb_hd_menu_link[1].",".$rgb_hd_menu_link[2].",0.22);
}
#hd_searchform td.gsc-search-button,
#hd_searchform td.gsc-search-button:before{
	color:rgba(".$rgb_hd_menu_link[0].",".$rgb_hd_menu_link[1].",".$rgb_hd_menu_link[2].",0.22)!important;
}
#hd_searchform:hover #searchform input#searchtext{
	color:".$header_menu_bgcolor.";
	background-color:".$header_menu_link_color.";
}
#hd_searchform:hover #searchform:before{
	color:".$header_menu_bgcolor.";
}
#hd_searchform:hover td.gsc-search-button:before{
	color:".$header_menu_bgcolor."!important;	
}
#hd_searchform.mb-theme .searchtext_div,
#hd_searchform.mb-theme #searchform span.searchsubmit{
	color:".$header_menu_link_color.";
	background-color:".$header_menu_bgcolor.";
}
table.gsc-search-box{
	background-color:".$container_bg_color."!important;
}
td.gsc-search-button{
	color:".$base_font_color."!important;
	background-color:".$container_bg_color."!important;
}";


	// *************************************************
	// Blockquote CSS
	// *************************************************
	//Quotes tag
	$quote_css = 
".content blockquote,
.content q,
.content code{
	background-color:rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.04);
	border:1px solid rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.08);
}
.content blockquote:before,
.content blockquote:after{
	color:".$accent_color.";
}";

	
	// *************************************************
	// Comment area CSS
	// *************************************************
	$comment_box_css = 
"#comment_section li.comment:hover,
#comment_section li..trackback:hover,
#comment_section li..pingback:hover {
	border-color:".$base_link_color.";
}";


	// *************************************************
	// Form CSS
	// *************************************************
	$form_css = 
"input[type=\"checkbox\"]:checked,
input[type=\"radio\"]:checked {
	background-color:".$base_link_color.";
}
select {
	border:1px solid rgba(". $rgb_base_font[0] . ", " . $rgb_base_font[1] . "," . $rgb_base_font[2] . ", 0.14);
}";

	// *************************************************
	// Sidebar CSS
	// *************************************************
	$sidebar_css = "";
	
	// *************************************************
	// Ranking CSS
	// *************************************************
	$ranking_css = 
".rank_label.thumb {
	color:".$container_bg_color.";
}
.rank_label.thumb:before {
	background-color:".$accent_color.";
}
.rank_label.no-thumb {
	color:rgba(".$rgb_base_font[0].",".$rgb_base_font[1].",".$rgb_base_font[2].",0.1);
}";

	// *************************************************
	// category colors CSS
	// *************************************************
	$cat_colos_css = 
".ct-hd{
	background-color:".$accent_color.";
}
.meta-cat a{
	color:".$base_font_color.";
}
.magazine.one .loop-article .meta-cat a:hover{
	color:".$container_bg_color.";
	background-color:".$base_font_color.";
	border-color:".$base_font_color.";
}";
	foreach ($cat_ids as $key => $cat_id) {
		$rgb = '';
		if (!empty($cat_colors[$key])) {
			$rgb = hexToRgb($cat_colors[$key]);
			$cat_colos_css .= 
".loop-post-thumb-flip.cat-color".$cat_id.",
.ct-hd.cat-color".$cat_id."{
	background-color:".$cat_colors[$key].";
}
.meta-cat a.cat-color".$cat_id."{
	color:".$cat_colors[$key].";
}
.single_post_meta .meta-cat a.cat-color".$cat_id.":hover,
.dp_related_posts.horizontal .meta-cat a.cat-color".$cat_id.":hover,
.magazine.one .loop-article .meta-cat a.cat-color".$cat_id.":hover{
	color:".$container_bg_color.";
	border-color:".$cat_colors[$key].";
	background-color:".$cat_colors[$key].";
}";
		}
	}
	

	// *************************************************
	// Tooltip CSS
	// *************************************************
	$tooltip_css = 
".tooltip-arrow{
	border-color:transparent transparent " . $base_font_color . " transparent;
}
.tooltip-msg {
	color:". $container_bg_color .";
	background-color:" . $base_font_color . ";
}";


	// *************************************************
	// Default Button label color
	// *************************************************
	if ($options['decoration_type'] !== 'bootstrap'){
		$btn_label_css = 
".btn{
	border-color:".$accent_color.";
	color:".$accent_color."!important;
}
.label,
.btn:after{
	background-color:".$accent_color."
}
.label:after{
	background-color:".$container_bg_color.";
}
#footer .label:after{
	background-color:".$footer_bgcolor.";
}";
	}


	// *************************************************
	// Footer area CSS
	// *************************************************
	$footer_css = 
"#footer{
	background-color:".$footer_bgcolor.";
	color:".$footer_text_color.";
}
#footer a,
#footer a:visited{
	color:".$footer_link_color.";
}
#footer a:hover{
	color:".$footer_link_hover_color.";
}
#footer .inside-title{
	color:".$footer_text_color.";
}
#footer .inside-title:before{
	box-shadow:0 3px 0 rgba(". $rgb_footer_text_color[0] . ", " . $rgb_footer_text_color[1] . "," . $rgb_footer_text_color[2] . ", 0.4);
}
#footer .inside-title:before,
#footer .dp_tab_widget_ul li:before,
#footer .wd-title:before{
	background-color:rgba(". $rgb_footer_text_color[0] . ", " . $rgb_footer_text_color[1] . "," . $rgb_footer_text_color[2] . ", 0.4);
}
#footer .inside-title span,
#footer .dp_tab_widget_ul li span,
#footer .wd-title span{
	background-color:".$footer_bgcolor.";
}
#footer .dp_tab_widget_ul{
	border-color:rgba(". $rgb_footer_text_color[0] . ", " . $rgb_footer_text_color[1] . "," . $rgb_footer_text_color[2] . ", 0.6);
}
#footer .dp_tab_widget_ul li:hover:before,
#footer .dp_tab_widget_ul li.active_tab:before{
	background-color:".$accent_color.";
}
#footer .tagcloud a:hover,
#footer .more-entry-link a:hover{
	color:".$footer_bgcolor.";
	background-color:".$footer_text_color.";
	border-color:".$footer_text_color.";
}
#footer .cat-item .count{
	color:".$footer_bgcolor.";
	background-color:rgba(". $rgb_footer_text_color[0] . ", " . $rgb_footer_text_color[1] . "," . $rgb_footer_text_color[2] . ", 0.5);
}
#footer .dp_feed_widget li a{
	color:".$footer_text_color.";
	background-color:rgba(".$rgb_footer_text_color[0].",".$rgb_footer_text_color[1].",".$rgb_footer_text_color[2].",0.1);
}
#footer .dp_feed_widget li a:hover{
	color:".$footer_bgcolor.";
}
#footer .dp_feed_widget li a:hover:before{
	background-color:".$footer_text_color.";
}
#footer_menu_ul,
.mb-theme #footer_menu_ul .menu-item{
	border-color:rgba(".$rgb_footer_text_color[0].",".$rgb_footer_text_color[1].",".$rgb_footer_text_color[2].",0.2);
}
#footer_menu_ul .menu-item:after{
	color:rgba(".$rgb_footer_text_color[0].",".$rgb_footer_text_color[1].",".$rgb_footer_text_color[2].",0.6);
}
#footer .loop-section.portfolio .loop-article-content a, 
#footer .loop-section.portfolio .loop-article-content a:visited
#footer .loop-section.portfolio .meta-cat a{
	color:#fff;
}";


	$result = <<<_EOD_
@charset "utf-8";
$body_css
$base_font_size_css
$base_link_color_css
$base_link_hover_color_css
$link_filled_color_css
$header_slideshow_css
$global_menu_css
$container_css
$footer_widget_css
$entry_link_css
$meta_area_css
$cat_colos_css
$bx_slider_css
$form_css
$search_form_css
$ranking_css
$common_bg_color_css
$border_color_css
$bordered_obj_css
$navigation_link_color_css
$list_hover_css
$tooltip_css
$quote_css
$comment_box_css
$sidebar_css
$footer_css
$btn_label_css
$original_css
_EOD_;

	return $result;
}

/****************************
 * Gradient SVG for IE9
 ***************************/
function gradientSVGForIE9($color1, $color2) {
	if ($color1 == "") return;
	if ($color2 == "") return;

	$xml = <<<_EOD_
<?xml version="1.0" ?>
<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.0" width="100%" height="100%" xmlns:xlink="http://www.w3.org/1999/xlink">
  <defs>
    <linearGradient id="myLinearGradient1" x1="0%" y1="0%" x2="0%" y2="100%" spreadMethod="pad">
      <stop offset="0%"   stop-color="$color1" stop-opacity="1"/>
      <stop offset="100%" stop-color="$color2" stop-opacity="1"/>
    </linearGradient>
  </defs>
  <rect width="100%" height="100%" style="fill:url(#myLinearGradient1);" />
</svg>
_EOD_;

	return $xml;
}

/*******************************************************
* Write File
*******************************************************/
/** ===================================================
* Write css and svg to the file.
*
* @param	string	$file_path
* @param	string	$string
* @return	true or false
*/
function dp_export_file($file_path, $str) {
	if ( !file_exists($file_path) ) {
		touch( $file_path );
		chmod( $file_path, 0666 );
	}

	if ( WP_Filesystem() && is_writable($file_path) ) {
		define('FS_CHMOD_FILE', (0666 & ~ umask()));
		global $wp_filesystem;
		if ( !$wp_filesystem->put_contents($file_path, $str, FS_CHMOD_FILE)) {
			$err_msg = $file_path . ": " . __('The file may be in use by other program. Please identify the conflict process.','DigiPress');
			$e = new WP_Error();
			$e->add( 'error', $err_msg );
			set_transient( 'dp-admin-option-errors', $e->get_error_messages(), 10 );
			add_action( 'admin_notices', array('digipress_options', 'dp_show_admin_error_message') );
			return false;
  		}
	} else {
		//if only readinig
		$err_msg = $file_path . ": " . __('The file is not rewritable. Please change the permission to 666 or 606.','DigiPress');
		$e = new WP_Error();
		$e->add( 'error', $err_msg );
		set_transient( 'dp-admin-option-errors', $e->get_error_messages(), 10 );
		add_action( 'admin_notices', array('digipress_options', 'dp_show_admin_error_message') );
		return false;
	}
	return true;
}
function dp_export_gzip($file_path, $str) {
	if ( !file_exists($file_path) ) {
		touch( $file_path );
		chmod( $file_path, 0666 );
	}

	//Rewrite CSS for custom design
	if (is_writable( $file_path )){
		//Open
		if(!$fp = gzopen($file_path.'.gz',  'w9') ){
			$err_msg = $file_path . ".gz: " . __('The file can not be opened. Please identify the conflict process.','DigiPress');
			$e = new WP_Error();
			$e->add( 'error', $err_msg );
			set_transient( 'dp-admin-option-errors',
				$e->get_error_messages(), 10 );
			add_action( 'admin_notices', array('digipress_options', 'dp_show_admin_error_message') );
    		return false;
  		}
  		//Write 
  		if(!gzwrite( $fp, $str )){
			$err_msg = $file_path . ".gz: " . __('The file may be in use by other program. Please identify the conflict process.','DigiPress');
			$e = new WP_Error();
			$e->add( 'error', $err_msg );
			set_transient( 'dp-admin-option-errors',
				$e->get_error_messages(), 10 );
			add_action( 'admin_notices', array('digipress_options', 'dp_show_admin_error_message') );
			return false;
		}
		//Close file
		gzclose($fp);
	} else {
		//if only readinig
		$err_msg = $file_path . ".gz: " . __('The file is not rewritable. Please change the permission to 666 or 606.','DigiPress');
		$e = new WP_Error();
		$e->add( 'error', $err_msg );
		set_transient( 'dp-admin-option-errors',
			$e->get_error_messages(), 10 );
		add_action( 'admin_notices', array('digipress_options', 'dp_show_admin_error_message') );
		return false;
	}
	return true;
}


/****************************
 * HEX to RGB
 ***************************/
function hexToRgb($color) {
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$rgb[] = hexdec($hex);
	}
	return $rgb;
}
/****************************************************************
* Make darken or lighten color from hex to rgb
****************************************************************/
function darkenColor($color, $range = 30) {
	if (!is_numeric($range)) $range = 30;
	if ($range > 255 || $range < 0) $range = 30;
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$hex = hexdec($hex);
		$hex = $hex > $range ? $hex - $range : $hex;
		$rgb[] = $hex;
	}
	return $rgb;
}
function lightenColor($color, $range = 30) {
	if (!is_numeric($range)) $range = 30;
	if ($range > 255 || $range < 0) $range = 30;
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$hex = hexdec($hex);
		$hex = $hex + $range <= 255 ? $hex + $range : $hex;
		$rgb[] = $hex;
	}
	return $rgb;
}
?>
