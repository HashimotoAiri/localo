<?php
/**
Name		: DigiPress Theme Option Function
Description	: Customize various visual settings and select theme type for DigiPress theme. Do not use this for any commercial purpose.
Version		: 1.0.1.6
Author		: digistate co., ltd.
Author URI	: http://www.digistate.co.jp/
Last Update	: 2015/12/3

@package WordPress
@subpackage DigiPress
*/
$dp_theme_upload_dir = wp_upload_dir();
$upload_url = is_ssl() ? str_replace('http:', 'https:', $dp_theme_upload_dir['baseurl']) : $dp_theme_upload_dir['baseurl'];
$theme_url = is_ssl() ? str_replace('http:', 'https:', get_template_directory_uri()) : get_template_directory_uri();

//Version
define ('DP_OPTION_SPT_VERSION', '1.0.1.6');
//Base theme name
define('DP_THEME_NAME', "Macchiato");
//Base theme key
define('DP_THEME_KEY', "macchiato");
//Theme ID
define('DP_THEME_ID', "DigiPress");
//Theme URI
define('DIGIPRESS_URI', "http://digipress.digi-state.com/");
//Author URI
define('DP_AUTHOR_URI', "http://www.digistate.co.jp/");
//Theme Directory
define('DP_THEME_DIR', dirname(__FILE__));
//Theme Directory
define('DP_THEME_URI', $theme_url);
//Theme Directory for mobile
define('DP_MOBILE_THEME_DIR', 'mobile');
//Column Type(1, 2)
define('DP_COLUMN', '2');
// Theme Type
define('DP_BUTTON_STYLE', 'flat6');
//Original upload dir
define('DP_UPLOAD_DIR', $dp_theme_upload_dir['basedir'].'/digipress/'.DP_THEME_KEY);
//Original upload path
define('DP_UPLOAD_URI', $upload_url.'/digipress/'.DP_THEME_KEY);


//Load Theme Domain
load_theme_textdomain('DigiPress', get_template_directory().'/languages/');

/****************************************************************
* Load theme options/global
****************************************************************/
$options 			= get_option('dp_options');
$options_visual 	= get_option('dp_options_visual');

/****************************************************************
* Include Main Class
****************************************************************/
require_once(ABSPATH . 'wp-admin/includes/file.php');
include_once(DP_THEME_DIR . "/inc/scr/theme_main_class.php");

/****************************************************************
* Updater
****************************************************************/
include_once(DP_THEME_DIR . "/inc/scr/updater.php");

/****************************************************************
* Include Function
****************************************************************/
include_once(ABSPATH . "/wp-admin/includes/template.php");
if (is_admin()) {
	include_once(DP_THEME_DIR . "/inc/scr/permission_check.php");
	include_once(DP_THEME_DIR . "/inc/admin/visual_params.php");
	include_once(DP_THEME_DIR . "/inc/admin/control_params.php");
	include_once(DP_THEME_DIR . "/inc/scr/create_css.php");
}
include_once(DP_THEME_DIR . "/inc/scr/get_uploaded_images.php");
include_once(DP_THEME_DIR . "/inc/scr/admin_menu_control.php");
include_once(DP_THEME_DIR . "/inc/scr/create_title_h1.php");
include_once(DP_THEME_DIR . "/inc/scr/create_title_desc.php");
include_once(DP_THEME_DIR . "/inc/scr/create_meta.php");
include_once(DP_THEME_DIR . "/inc/scr/count_sns.php");
include_once(DP_THEME_DIR . "/inc/scr/show_banner_contents.php");
include_once(DP_THEME_DIR . '/inc/scr/show_post_thumbnail.php');
include_once(DP_THEME_DIR . "/inc/scr/show_sns_icon.php");
include_once(DP_THEME_DIR . "/inc/scr/is_mobile_dp.php");
include_once(DP_THEME_DIR . "/inc/scr/breadcrumb.php");
include_once(DP_THEME_DIR . "/inc/scr/listing_post_styles.php");
include_once(DP_THEME_DIR . "/inc/scr/autopager.php");
include_once(DP_THEME_DIR . "/inc/scr/meta_info.php");
include_once(DP_THEME_DIR . "/inc/scr/widgets.php");
include_once(DP_THEME_DIR . "/inc/scr/widget_parallax.php");
include_once(DP_THEME_DIR . "/inc/scr/widget_for_archive.php");
include_once(DP_THEME_DIR . "/inc/scr/custom_field.php");
include_once(DP_THEME_DIR . "/inc/scr/custom_menu.php");
include_once(DP_THEME_DIR . "/inc/scr/get_column_num.php");
include_once(DP_THEME_DIR . "/inc/scr/get_archive_style.php");
include_once(DP_THEME_DIR . "/inc/scr/placeholder.php");
include_once(DP_THEME_DIR . "/inc/scr/shortcodes.php");
include_once(DP_THEME_DIR . "/inc/scr/pagination.php");
include_once(DP_THEME_DIR . "/inc/scr/custom_post_type.php");
include_once(DP_THEME_DIR . "/inc/scr/show_ogp.php");
include_once(DP_THEME_DIR . "/inc/scr/disable_auto_format.php");
include_once(DP_THEME_DIR . "/inc/scr/js_for_sns_objects.php");
include_once(DP_THEME_DIR . "/inc/scr/footer_widgets.php");
include_once(DP_THEME_DIR . "/inc/scr/post_views.php");
include_once(DP_THEME_DIR . "/inc/scr/related_posts.php");
include_once(DP_THEME_DIR . "/inc/scr/widget_categories.php");
include_once(DP_THEME_DIR . "/inc/scr/date_lang.php");


/****************************************************************
* GLOBALS
****************************************************************/
$EXIST_FB_LIKE_BOX 	= false;
$FB_APP_ID 			= '';
$COLUMN_NUM 		= '';
$SIDEBAR_FLOAT 		= '';
$SIDEBAR2_FLOAT 	= '';
$IS_MOBILE_DP 		= false;
$ARCHIVE_STYLE 		= array();


/****************************************************************
* Set globals before the site is about to showing.
****************************************************************/
add_action('after_setup_theme', 'is_mobile_dp');
add_action('wp', 'get_column_num');
add_action('wp', 'dp_get_archive_style');


/****************************************************************
* Add Theme Option into wp admin interfaces.
****************************************************************/
//Insert script to the header of post/edit page.
function dp_js_load_admin(){
	wp_enqueue_script('post_new_edit', DP_THEME_URI.'/inc/js/post_new_edit.js', array('jquery'));
}
add_action('admin_print_scripts-post.php', 'dp_js_load_admin');
add_action('admin_print_scripts-post-new.php', 'dp_js_load_admin');

//Add option menu into admin panel header and insert CSS and scripts to DigiPress panel.
add_action('admin_menu', array('digipress_options', 'add_menu'));
add_action('admin_menu', array('digipress_options', 'update'));
add_action('admin_menu', array('digipress_options', 'update_visual'));
add_action('admin_menu', array('digipress_options', 'dp_run_upload_file'));
add_action('admin_menu', array('digipress_options', 'dp_delete_upload_file'));
add_action('admin_menu', array('digipress_options', 'edit_images'));
add_action('admin_menu', array('digipress_options', 'reset_theme_options'));


/****************************************************************
* Insert custom field to editing post window.
* from custom_field.php
****************************************************************/
// Add custom fields
add_action('admin_menu', 'add_custom_field');
add_action('save_post', 'save_custom_field');
/* Add CSS into admin panel */
function add_css_for_admin() {
   echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/inc/css/dp-admin.css">';
}
add_action('admin_head-post.php' , 'add_css_for_admin');
add_action('admin_head-post-new.php' , 'add_css_for_admin');



/****************************************************************
* Enable only WP2.9/3.0 over.
****************************************************************/
//Add post thumbnail interface.
if ( function_exists('add_theme_support') ) {
	add_theme_support('post-thumbnails');

	//Enable navigation menus(WP3.0 over)
	if ( function_exists('register_nav_menus') ) {
		add_theme_support('menus');
	}
}


/****************************************************************
* Admin function
****************************************************************/
/* Disable admin bar */
add_filter('show_admin_bar', '__return_false');
/* Disable admin notice for editors */
if (!current_user_can('edit_users')) {
	function dp_wphidenag() {
		remove_action( 'admin_notices', 'update_nag');
	}
	add_action('admin_menu','dp_wphidenag');
}


/****************************************************************
* Replace upload content url in SSL
****************************************************************/
function dp_replace_ssl_content($content){
	if (is_ssl()){
		$upload_dir = wp_upload_dir();
		$upload_dir_url = $upload_dir['baseurl'];
		$upload_dir_ssl_url = str_replace('http:', 'https:', $upload_dir_url);
		$content = str_replace($upload_dir_url, $upload_dir_ssl_url, $content);
	}
	return $content;
}
add_filter('the_content', 'dp_replace_ssl_content');


/****************************************************************
* Avoid SSL at home url
****************************************************************/
function dp_ssl_home_url($url, $path = '', $orig_scheme = 'http'){
	if(is_ssl() && strpos($path, 'wp-content') === false){
		$url = str_replace('https:', 'http:', $url);
	}
	return $url;
}
// add_filter('home_url', 'dp_ssl_home_url');



/****************************************************************
* Disable self pinback
****************************************************************/
function dp_no_self_ping( &$links ) {
	$home = home_url();
	foreach ( $links as $l => $link )
	if ( 0 === strpos( $link, $home ) )
		unset($links[$l]);
}
add_action( 'pre_ping', 'dp_no_self_ping' );

/* Enable excerpt for single page */
add_post_type_support( 'page', 'excerpt' );


/****************************************************************
* Upload image width
****************************************************************/
if ( !isset( $content_width ) ) $content_width = 900;


/****************************************************************
* For check the order of curret post
****************************************************************/
function dp_is_first(){
	global $wp_query;
	return (intval($wp_query->current_post) === 0) ? true : false;
}
function dp_is_last(){
	global $wp_query;
	return (intval($wp_query->current_post + 1) === $wp_query->post_count) ? true : false;;
}
function dp_is_odd(){
	global $wp_query;
	return (intval((($wp_query->current_post+1) % 2)) === 1) ? true : false;;
}
function dp_is_even(){
	global $wp_query;
	return (intval((($wp_query->current_post+1) % 2)) === 0) ? true : false;;
}
function is_multiple3(){
    global $wp_query;
    return ((($wp_query->current_post+1) % 3) === 0);
}
function is_multiple4(){
    global $wp_query;
    return ((($wp_query->current_post+1) % 4) === 0);
}


/****************************************************************
* Support post formats
****************************************************************/
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio', 'chat' ) );

/****************************************************************
* Use mobile theme when user agent is mobile.
****************************************************************/
function dp_mobile_template_include( $template ) {
	global $options, $IS_MOBILE_DP;
	if ($options['disable_mobile_fast']) return;

	// Mobile theme directory name
	if ( $IS_MOBILE_DP ) {
		$template_file = basename($template);
		$template_mb = str_replace( $template_file, DP_MOBILE_THEME_DIR.'/'.$template_file, $template );
		// If exist the mobile template, replace them.
		if ( file_exists( $template_mb ) )
			$template = $template_mb;
	}
	return $template;
}
add_filter( 'template_include', 'dp_mobile_template_include' );

/****************************************************************
* After setup theme
****************************************************************/
function dp_password_form() {
	$custom_phrase =
'<p class="need-pass-title label label-orange icon-lock">'.__('Protected','DigiPress').'</p>'.__('Please type the password to read this page.', 'DigiPress').'
<div id="protectedForm"><form action="' . esc_url(site_url()) . '/wp-login.php?action=postpass" method="post"><input name="post_password" type="password" size="24" /><input type="submit" name="Submit" value="' . esc_attr__("Submit") . '" />
</form></div>';

return $custom_phrase;
}
function dp_after_setup_theme() {
	global $wp_version;
	// ***
	// * Add theme support
	// **
	// Post thumbnail
	add_theme_support('post-thumbnails');
	// Custom menu
	add_theme_support('menus');
	// Feed links
	add_theme_support( 'automatic-feed-links' );
	// Auto title tag (WP4.1 over)
    if ( version_compare( $wp_version, '4.1', '>=' ) ) {
        // add_theme_support('title-tag');
    }

	// Password form
	remove_filter( 'the_password_form', 'custom_password_form' );
	add_filter('the_password_form', 'dp_password_form');

	// Theme customizer
	add_theme_support('custom-background');
	add_theme_support('custom-header');
}
add_action( 'after_setup_theme', 'dp_after_setup_theme' );


/****************************************************************
* Replace gallery shortcode
****************************************************************/
// Remove gallery shortcode
// remove_shortcode('gallery', 'gallery_shortcode');
// Add original gallery shortcode
// add_shortcode('gallery', 'dp_gallery_shortcode');


/****************************************************************
* Fix original "the_excerpt" function.
****************************************************************/
remove_filter('the_excerpt', 'wpautop');
function dp_del_from_excerpt($str){
	$str = preg_replace("/(\r|\n|\r\n)/m", " ", $str);
	$str = preg_replace("/　/", "", $str); //del multibyte space
	$str = preg_replace("/\t/", "", $str); //del tab
	$str = preg_replace("/(<br>)+/", " ", $str);
	$str = preg_replace("/^(<br \/>)/", "", $str);
	return '<p>' . $str . '</p>';
}
add_filter('the_excerpt', 'dp_del_from_excerpt');


/****************************************************************
* Replace "more [...]" strings.
****************************************************************/
//WordPress version as integer.
function dp_new_excerpt_more($more) {
	return '...';
}
//Replace "more" strings.
add_filter('excerpt_more', 'dp_new_excerpt_more');


/****************************************************************
* Change excerpt length.
****************************************************************/
function dp_new_excerpt_mblength($length) {
	return 220;
}
add_filter('excerpt_mblength', 'dp_new_excerpt_mblength');


/****************************************************************
* Remove more "#" link string.
****************************************************************/
function dp_custom_content_more_link( $output ) {
	$output = preg_replace('/#more-[\d]+/i', '', $output );
	return $output;
}
add_filter( 'the_content_more_link', 'dp_custom_content_more_link' );


/****************************************************************
* Disable font-sizeing in tag cloud
****************************************************************/
function theme_new_tag_cloud($args) {
	$myargs = array(
		'smallest'	=> 11,
		'largest'	=> 11,
		'unit'		=> 'px',
		'number' 	=> 45,
		'orderby'	=> 'count',
		'order' 	=> 'DESC'
		);
	return $myargs;
}
add_filter('widget_tag_cloud_args', 'theme_new_tag_cloud');


/****************************************************************
* Disable comment form at static page
****************************************************************/
function close_page_comment($open, $post_id) {
	$post = get_post($post_id);
	if ($post && $post->post_type == 'page') {
		return false;
	}
	return $open;
}
add_filter('comments_open', 'close_page_comment', 10, 2);


/****************************************************************
* Disable wp emoji
****************************************************************/
function dp_disable_emoji() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
if ((bool)$options['disable_emoji'] ) add_action('init', 'dp_disable_emoji');


/****************************************************************
* Enable PHP in widgets
****************************************************************/
function dp_execute_php_in_widget($html){
	global $options;
	if(strpos($html,"<"."?php")!==false && $options['execute_php_in_widget'] ){
		ob_start();
		eval("?".">".$html);
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}
add_filter('widget_text','dp_execute_php_in_widget',100);
add_filter('dp_widget_text','dp_execute_php_in_widget',100);

/****************************************************************
* Enable shortcode in text widget.
****************************************************************/
add_filter('widget_text', 'do_shortcode');
add_filter('dp_widget_text', 'do_shortcode');


/****************************************************************
* Add title attribute in next post link
****************************************************************/
/*function add_title_to_next_post_link($link) {
	global $post;
	$post = get_post($post_id);
	$next_post = get_next_post();
	$title = $next_post->post_title;
	$link = str_replace("rel=", " title='".$title."' rel", $link);
	return $link;
}
add_filter('next_post_link','add_title_to_next_post_link');*/


/****************************************************************
* Add title attribute in previous post link
****************************************************************/
/*function add_title_to_previous_post_link($link) {
	global $post;
	$post = get_post($post_id);
	$previous_post = get_previous_post();
	$title = $previous_post->post_title;
	$link = str_replace("rel=", " title='".$title."' rel", $link);
	return $link;
}
add_filter('previous_post_link','add_title_to_previous_post_link');*/


/****************************************************************
* Remopve protection text and custome protected form
****************************************************************/
function remove_private($s) {
	return '%s';
}
add_filter('protected_title_format', 'remove_private');


/****************************************************************
* Insert post thumbnail in Feeds.
****************************************************************/
function post_thumbnail_in_feeds($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<div>' . get_the_post_thumbnail($post->ID) . '</div>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'post_thumbnail_in_feeds');
add_filter('the_content_feed', 'post_thumbnail_in_feeds');


/****************************************************************
* Replace post slug when unexpected character.
****************************************************************/
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
	global $options;
	if (!(bool)$options['disable_fix_post_slug']) {
		if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
			$slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
		}
	}
	return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );


/****************************************************************
* Use search.php if the search word is not set.
****************************************************************/
function enable_empty_query( $search, $query ) {
	if (is_admin()) return;

	global $wpdb;

	if ($query->is_main_query()) {
		// "q" is for Google Custom Search
		if ( (isset( $_REQUEST['s'] ) && empty( $_REQUEST['s'])) || isset( $_REQUEST['q']) ) {
			$term = $_REQUEST['s'];
			$query->is_search = true;
			if ( $term === '' ) {
				$search = ' AND 0';
			} else {
				$search = " AND ( ( $wpdb->posts.post_title LIKE '%{$term}%' ) OR ( $wpdb->posts.post_content LIKE '%{$term}%' ) )";
			}
		}
	}
	return $search;
}
if (!is_admin()) {
	add_action( 'posts_search', 'enable_empty_query', 10, 2);
}
/****************************************************************
* Disable hentry class
****************************************************************/
function dp_remove_hentry( $classes ) {
	$classes = array_diff($classes, array('hentry'));
	return $classes;
}
add_filter('post_class', 'dp_remove_hentry');


/****************************************************************
 * Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
 ***************************************************************/
function get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;

    $id = get_the_ID();

    if ( false === $zero ) $zero = __( 'No Comments','DigiPress' );
    if ( false === $one ) $one = __( 'Comment(1)','DigiPress' );
    if ( false === $more ) $more = __( 'Comments(%)','DigiPress' );
    if ( false === $none ) $none = __( 'Comments Off','DigiPress' );

    $number = get_comments_number( $id );

    $str = '';

    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }

    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','DigiPress');
        return $str;
    }

    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }

    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );

    $str .= apply_filters( 'comments_popup_link_attributes', '' );

    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','DigiPress'), $title ) ) . '">';
    $str .= get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';

    return $str;
}
/**
 * Modifies WordPress's built-in comments_number() function to return string instead of echo
 */
function get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );

    $number = get_comments_number();

    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('Comments(%)', 'DigiPress') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments', 'DigiPress') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('Comment(1)', 'DigiPress') : $one;

    return apply_filters('comments_number', $output, $number);
}



/****************************************************************
* Number of post at each archive.
****************************************************************/
function dp_number_posts_per_archive( $query ) {
	if (is_admin()) return;
	global $options, $IS_MOBILE_DP;

	$suffix = '';

	if ( $query->is_main_query() ) {
		// Suffix
		$suffix = $IS_MOBILE_DP ? '_mobile' : '';

		// Get posts
		if ($query->is_home() && $options['number_posts_index'.$suffix]) {
			if ($options['show_specific_cat_index'] === 'cat') {
				$query->set( 'posts_per_page', $options['number_posts_index'.$suffix] );

				// Show specific category's posts
				if ($options['index_bottom_except_cat']) {
					// Add nimus each category id
					$cat_ids = preg_replace('/(\d+)/', '-${1}', $options['index_bottom_except_cat_id']);

					$query->set( 'cat', $cat_ids );

				} else {
					$query->set( 'cat', $options['specific_cat_index'] );
				}

			} else if ($options['show_specific_cat_index'] === 'custom') {
				// Show specific custom post type
				$query->set( 'posts_per_page', $options['number_posts_index'.$suffix] );
				$query->set( 'post_type', $options['specific_post_type_index'] );

			} else {
				$query->set( 'posts_per_page', $options['number_posts_index'.$suffix] );
			}
		}
		else if ($query->is_category() && $options['number_posts_category'.$suffix] ) {
			$query->set( 'posts_per_page', $options['number_posts_category'.$suffix] );
		}
		else if ($query->is_search() && $options['number_posts_search'.$suffix] ) {
			$query->set( 'posts_per_page', $options['number_posts_search'.$suffix] );
		}
		else if ($query->is_tag() && $options['number_posts_tag'.$suffix] ) {
			$query->set( 'posts_per_page', $options['number_posts_tag'.$suffix] );
		}
		else if ($query->is_date() && $options['number_posts_date'.$suffix] ) {
			$query->set( 'posts_per_page', $options['number_posts_date'.$suffix] );
		}
		else if ($query->is_author() && $options['number_posts_author'.$suffix] ) {
			$query->set( 'posts_per_page', $options['number_posts_author'.$suffix] );
		}
	}
}
add_action( 'pre_get_posts', 'dp_number_posts_per_archive' );


/****************************************************************
* Add functions into outer html for theme.
****************************************************************/
//Remove meta of CMS Version
remove_action('wp_head', 'wp_generator');


/****************************************************************
* Create Uinique ID
****************************************************************/
function dp_rand($sha1 = false) {
	$str_rand = (bool)$sha1 ? sha1(uniqid(mt_rand())) : uniqid(mt_rand(100,500));
	return $str_rand;
}
/**************************
 * HEX to RGB
 ***************************/
function dp_hexToRgb($color) {
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$rgb[] = hexdec($hex);
	}
	return $rgb;
}

/******************************************************
 For url cache control
******************************************************/
function echo_filedate($filename) {
    if (file_exists($filename)) {
        return date('YmdHis', filemtime($filename));
    } else {
    	return date('Ymd');
    }
}
/****************************************************************
* Load css and js
*  -- disable WP default jquery, load Google API minimized script
****************************************************************/
function dp_load_css_scripts() {
	if (is_admin()) return;

	global $options, $options_visual, $IS_MOBILE_DP;

	$mb_sufix = '';

	// Default CSS
	$css_name = "style.css";
	if ($options['decoration_type'] === 'bootstrap' || $options['decoration_type'] === 'none') {
		$css_name = "style-bs.css";
	}
	// Bootstrap
	if ($options['decoration_type'] === 'bootstrap'){
		wp_enqueue_style('bootstrap',DP_THEME_URI.'/css/bootstrap.css');
		wp_enqueue_script('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js');
	}
	// wow.js
	if ($IS_MOBILE_DP) {
		$mb_sufix = '_mb';
	}
	if (!(bool)$options['disable_wow_js'.$mb_sufix]){
		wp_enqueue_style('wow',DP_THEME_URI.'/css/animate.css');
		wp_enqueue_script('wow',DP_THEME_URI.'/inc/js/wow.min.js');
	}

	$css_pc = DP_THEME_URI.'/css/'.$css_name;
	$css_mb = DP_THEME_URI.'/'.DP_MOBILE_THEME_DIR.'/css/'.$css_name;
	$css_custom = '/css/visual-custom.css';

    if ( $IS_MOBILE_DP ) {
        wp_enqueue_style( 'digipress', $css_mb, null, echo_filedate($css_mb) );
    } else {
        wp_enqueue_style( 'digipress', $css_pc, null, echo_filedate($css_pc) );
    }
    // Custom CSS
    if ( file_exists( DP_UPLOAD_DIR.'/css/visual-custom.css') ) {
        wp_enqueue_style( 'dp-visual', DP_UPLOAD_URI.$css_custom, array('digipress'), echo_filedate(DP_UPLOAD_URI.$css_custom) );
    } else {
        wp_enqueue_style( 'dp-visual', DP_THEME_URI.$css_custom, array('digipress'), echo_filedate(DP_THEME_URI.$css_custom) );
    }

	// jQuery
	if ($options['use_google_jquery']) {
		// Disable default jQuery
		wp_deregister_script('jquery');
		// Replace to Google API jQuery
		wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	} else {
		wp_enqueue_script('jquery');
	}

	// jQuery easing
	wp_enqueue_script('easing', DP_THEME_URI . '/inc/js/jquery/jquery.easing.min.js', array('jquery'));
	// Masonry
	wp_enqueue_script('dp-masonry', DP_THEME_URI . '/inc/js/jquery/jquery.masonry.min.js', array('jquery', 'imagesloaded'));
	// imagesload
	wp_enqueue_script('imagesloaded', DP_THEME_URI . '/inc/js/jquery/jquery.imagesloaded.min.js', array('jquery'));
	// For throw Cross Domain Error
    wp_enqueue_script('xdomainajax', DP_THEME_URI . '/inc/js/jquery/jquery.xdomainajax.min.js', array('jquery'));
	// fitVids
	wp_enqueue_script('fitvids', DP_THEME_URI . '/inc/js/jquery/jquery.fitvids.min.js', array('jquery'));
	// scrollReveal js
	wp_enqueue_script('scrollReveal', DP_THEME_URI . '/inc/js/scrollReveal.min.js', array('jquery'));

	// Mobile or PC
	if ( $IS_MOBILE_DP ) {
		wp_enqueue_script('mmenu', DP_THEME_URI . '/inc/js/jquery/jquery.mmenu.min.js', array('jquery'));
		if ($options['autopager_mb'] && !is_singular()) {
			wp_enqueue_script('autopager', DP_THEME_URI . '/inc/js/jquery/jquery.autopager.min.js', array('jquery'));
		}
		// Main theme js
		wp_enqueue_script('digipress', DP_THEME_URI . '/inc/js/mb-theme-import.min.js', array('jquery','easing'), echo_filedate(DP_THEME_DIR . '/inc/js/mb-theme-import.min.js'), true);

	} else {
		// Progress bar
		if (is_front_page() && !is_paged()){
			wp_enqueue_script('pace', DP_THEME_URI . '/inc/js/pace.min.js', array('jquery'), null, true);
		}
		if ($options['autopager'] && !is_singular()) {
			wp_enqueue_script('autopager', DP_THEME_URI . '/inc/js/jquery/jquery.autopager.min.js', array('jquery', 'imagesloaded'));
		}
		// Main theme js
		wp_enqueue_script('digipress', DP_THEME_URI . '/inc/js/theme-import.min.js', array('jquery','easing','dp-masonry'), echo_filedate(DP_THEME_DIR . '/inc/js/theme-import.min.js'), true);
	}

	// for comment form
	if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'dp_load_css_scripts', 1);


/****************************************************************
* Insert css and Javascript to head
****************************************************************/
// function dp_add_meta_tags() {

// }
// add_action( 'wp_print_scripts', 'dp_add_meta_tags' );


/****************************************************************
* Insert Javascript to the end of html
****************************************************************/
function dp_inline_footer() {
	global $options, $current_user;
	get_currentuserinfo();

	$trace_code = '';

	// User Agent check (IE9 only) DO NOT MOVE THIS TO FOOTER.
	$js_check_ie9 = <<<_EOD_
<!--[if lte IE 9]>
<script type="text/javascript">
j$(function(){
	var ua=window.navigator.userAgent.toLowerCase();
	var av=window.navigator.appVersion.toLowerCase();
	var img=".wp-post-image";
	if (ua.indexOf('msie')!=-1) {
		if (av.indexOf('msie 9.')!=-1) {
			j$(".loop-section .loop-post-thumb").hover(
				function(){
					j$(img,this).css("opacity",0.99);
				},
				function(){
					j$(img,this).css("opacity",1);
				}
			);
		}
	}
});
</script>
<![endif]-->
_EOD_;
	$js_check_ie9 = str_replace(array("\r\n","\r","\n","\t"), '', $js_check_ie9);

	// Access Code
	if ( $options['tracking_code'] ) {
		$trace_code = "<!-- Tracking Code -->" . $options['tracking_code'] . "<!-- /Tracking Code -->";
	}

	//Run only user logged in...
	if ( is_user_logged_in() ) {
		if ( $current_user->user_level == 10 ) {
			if ($options['no_track_admin']) {
				$trace_code = "<!-- You are logged in as Administrator -->";
			}
		}
	}

	echo $js_check_ie9.$trace_code;
}
add_action('wp_footer', 'dp_inline_footer', 100);
?>
