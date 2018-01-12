<?php
/*******************************************************
* Custom Field Contents
*******************************************************/
// Array for custom field
$dp_cf_arr = array(
	'is_slideshow',
	'slideshow_image_url',
	'slideshow_description',
	'is_headline',
	'hide_sns_icon',
	'dp_hide_title',
	'dp_hide_date',
	'dp_hide_author',
	'dp_hide_cat',
	'dp_hide_tag',
	'dp_hide_views',
	'dp_hide_fb_comment',
	'dp_meta_keyword',
	'dp_meta_desc',
	'dp_hide_time_for_reading',
	'dp_noindex',
	'dp_nofollow',
	'dp_noarchive',
	'item_taxonomy',
	'item_image_url',
	'item_video_id',
	'video_service',
	'disable_sidebar',
	'disable_wpautop',
	'replace_p_to_br',
	'dp_hide_header_menu',
	'dp_hide_footer',
	'dp_star_rating_enable',
	'dp_star_rating',
	'dp_show_eyecatch_force',
	'dp_eyecatch_on_container',
	'dp_post_tag',
	'dp_post_tag_color'
	);

// Add custom fields
function add_custom_field() {

	if ( !function_exists('add_meta_box') ) return;

	global $options;

	// Add to single
	add_meta_box(
		'dp_custom_fields_single', 
		__('Post options','DigiPress'), 
		'html_source_for_custom_box_single', 
		'post', 
		'normal', 
		'high'
		);

	// Add to page
	add_meta_box(
		'dp_custom_fields_page', 
		__('Post options','DigiPress'), 
		'html_source_for_custom_box_page', 
		'page', 
		'normal', 
		'high'
		);

	// Add to custom type
	add_meta_box(
		'dp_custom_fields_page', 
		__('Post options','DigiPress'), 
		'html_source_for_custom_box_page', 
		$options['news_cpt_slug_id'], 
		'normal', 
		'high'
		);
}

// Save custom fields...
function save_custom_field($post_id) {
	// Throw auto save 
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	global $pagenow, $typenow, $post, $dp_cf_arr;

	// Add array from extensions
	$additional_params = apply_filters( 'dp_custom_field_add_params', $post_id );
	if ( $additional_params != $post_id ) {
		array_push($dp_cf_arr, $additional_params);
	}

	// if current saving is under quick edit
	if ( $pagenow === 'admin-ajax.php' || $pagenow === 'wp-cron.php') return;

	if (!isset($post_id)) $post_id = $_REQUEST['post_ID'];

	// Save
	foreach($dp_cf_arr as $dp_cf) {
 		// Get Current item
		$dp_cf_current 	= get_post_meta($post_id, $dp_cf);
		// Get value
		$dp_cf_val 	= $_POST[$dp_cf];
 		
 		// Save, update or delete
		if( $dp_cf_current == "" ) {
			add_post_meta($post_id, $dp_cf, $dp_cf_val, true);
		} elseif ( $dp_cf_current != $dp_cf_val ) {
			update_post_meta($post_id, $dp_cf, $dp_cf_val);
		} elseif ( $dp_cf_val == "" ) {
			delete_post_meta( $post_id, $dp_cf );
		}
	}
}

/*---------------------------------------
 * For Single
 *--------------------------------------*/
/* HTML form */
function html_source_for_custom_box_single() {
	
	global $post, $dp_cf_arr;

	$is_slideshow			= get_post_meta( $post->ID, 'is_slideshow');
	$slideshow_image_url	= get_post_meta( $post->ID, 'slideshow_image_url');
	$slideshow_description	= get_post_meta( $post->ID, 'slideshow_description');
	$is_headline			= get_post_meta( $post->ID, 'is_headline');
	$disable_sidebar		= get_post_meta( $post->ID, 'disable_sidebar');
	$hide_sns_icon			= get_post_meta( $post->ID, 'hide_sns_icon');
	$dp_hide_date			= get_post_meta( $post->ID, 'dp_hide_date');
	$dp_hide_author			= get_post_meta( $post->ID, 'dp_hide_author');
	$dp_hide_cat			= get_post_meta( $post->ID, 'dp_hide_cat');
	$dp_hide_tag			= get_post_meta( $post->ID, 'dp_hide_tag');
	$dp_hide_views			= get_post_meta( $post->ID, 'dp_hide_views');
	$dp_hide_fb_comment		= get_post_meta( $post->ID, 'dp_hide_fb_comment');
	$dp_hide_time_for_reading= get_post_meta( $post->ID, 'dp_hide_time_for_reading');
	$dp_meta_keyword		= get_post_meta( $post->ID, 'dp_meta_keyword');
	$dp_noindex				= get_post_meta( $post->ID, 'dp_noindex');
	$dp_nofollow			= get_post_meta( $post->ID, 'dp_nofollow');
	$dp_noarchive			= get_post_meta( $post->ID, 'dp_noarchive');
	$dp_star_rating_enable 	= get_post_meta( $post->ID, 'dp_star_rating_enable');
	$dp_star_rating			= get_post_meta( $post->ID, 'dp_star_rating');
	$item_video_id 			= get_post_meta( $post->ID, 'item_video_id');
	$video_service			= get_post_meta( $post->ID, 'video_service');
	$dp_show_eyecatch_force	= get_post_meta( $post->ID, 'dp_show_eyecatch_force');
	$dp_eyecatch_on_container= get_post_meta( $post->ID, 'dp_eyecatch_on_container');
	$disable_wpautop 		= get_post_meta( $post->ID, 'disable_wpautop');
	$replace_p_to_br 		= get_post_meta( $post->ID, 'replace_p_to_br');
	$dp_post_tag 			= get_post_meta( $post->ID, 'dp_post_tag');
	$dp_post_tag_color		= get_post_meta( $post->ID, 'dp_post_tag_color');
	
	$additional_setting = '';
	$preview_tag = '';
	if ($slideshow_image_url[0]) {
		$preview_tag = '<img src="' . $slideshow_image_url[0] . '" id="exist_slide_image" />';
	}

	// ****************
	// CSS
	$css_code = <<<_EOD_
<style type="text/css"><!--
.dp_cf_item_box {
	border:1px solid #ddd;
	padding:10px;
	margin-bottom:10px;
}
.dp_cf_item_box p {
	margin:6px 0 12px 0;
}
.dp_cf_inner_box {
	margin:10px;
}
--></style>
_EOD_;
	$css_code = str_replace(array("\r\n","\r","\n","\t"), '', $css_code);
	echo $css_code;
	// CSS
	// ****************


	// Rating
	echo '<div class="dp_cf_item_box disp-none">
		<p><input name="dp_star_rating_enable" id="dp_star_rating_enable" value="true" type="checkbox"'.($dp_star_rating_enable[0] ? ' checked' : '').'><label for="dp_star_rating_enable" class="b">'.__('Enable and show star rating.', 'DigiPress').'</label></p>';
	echo '<div class="mg20px-l mg10px-btm">
		 <label for="dp_star_rating" class="b"> '.__("Rate this post : ","DigiPress").'</label>
		 <select name="dp_star_rating" id="dp_star_rating" size=1>
		  <option value="0" ' .(!$dp_star_rating[0] ? ' selected="selected"' : '').'>0</option>
		  <option value="0.5" ' .($dp_star_rating[0] == 0.5 ? ' selected="selected"' : '').'>0.5</option>
		  <option value="1" ' .($dp_star_rating[0] == 1 ? ' selected="selected"' : '').'>1</option>
		  <option value="1.5" ' .($dp_star_rating[0] == 1.5 ? ' selected="selected"' : '').'>1.5</option>
		  <option value="2" ' .($dp_star_rating[0] == 2 ? ' selected="selected"' : '').'>2</option>
		  <option value="2.5" ' .($dp_star_rating[0] == 2.5 ? ' selected="selected"' : '').'>2.5</option>
		  <option value="3" ' .($dp_star_rating[0] == 3 ? ' selected="selected"' : '').'>3</option>
		  <option value="3.5" ' .($dp_star_rating[0] == 3.5 ? ' selected="selected"' : '').'>3.5</option>
		  <option value="4" ' .($dp_star_rating[0] == 4 ? ' selected="selected"' : '').'>4</option>
		  <option value="4.5" ' .($dp_star_rating[0] == 4.5 ? ' selected="selected"' : '').'>4.5</option>
		  <option value="5" ' .($dp_star_rating[0] == 5 ? ' selected="selected"' : '').'>5</option></select>
		  </div>
		  <div class="mg20px-l">'.__('You can select rating of this post(photo or gallery).','DigiPress').'<br />'.__('Sample rating : ','DigiPress').'<div style="font-size:10px!important;">';
		  wp_star_rating(array('rating' => 3.5));
	echo '</div></div></div>';

	// Featured tag
	echo '<div class="dp_cf_item_box">
		 <p class="b">'.__('Featured tag :','DigiPress').'</p>
		 <p>'.__("Enter the label that featured this post. This tag uses as a label in each archive page.", "DigiPress").'</p>
		 <label for="dp_post_tag">'.__('Label strings : ', 'DigiPress').'</label><input name="dp_post_tag" id="dp_post_tag" type="text" size=20 value="'.htmlspecialchars(stripslashes($dp_post_tag[0])).'" /> '.__('Label background color','DigiPress').' : 
		 <input type="text" name="dp_post_tag_color" value="'.$dp_post_tag_color[0].'" class="dp-color-field" /></div>';

	// Video ID
	echo '<div class="dp_cf_item_box">
		<p class="b">'.__('Embed video ID:','DigiPress').'</p>
		 <p>'.__('Enter the video ID to play video in archive page.', 'DigiPress').'</p>
		 <div class="mg10px-btm">
		 <label for="video_service"> '.__("Service : ","DigiPress").'</label>
		 <select name="video_service" id="video_service" size=1 class="mg10px-r">
		  <option value="YouTube" ' .( (!$video_service[0] || $video_service[0]) === 'YouTube' ? ' selected="selected"' : '').'>YouTube</option>
		  <option value="Vimeo" ' .($video_service[0] == 'Vimeo' ? ' selected="selected"' : '').'>Vimeo</option></select> 
		 <label for="item_video_id"> '.__("Video ID : ","DigiPress").'</label>
		 <input type="text" name="item_video_id" id="item_video_id" size="15" value="'.$item_video_id[0].'" /></div></div>';

	// Show eyecatch
	echo '<div class="dp_cf_item_box">
		 <input name="dp_show_eyecatch_force" id="dp_show_eyecatch_force" type="checkbox" value=1';
	if( $dp_show_eyecatch_force[0] ) echo ' checked';
	echo ' /><label for="dp_show_eyecatch_force" class="b"> '.__("Check to show eyecatch image at first","DigiPress").'</label>';
	echo '<div class="mg10px-top mg20px-l mg15px-btm"><input name="dp_eyecatch_on_container" id="dp_eyecatch_on_container" type="checkbox" value=1';
		if( $dp_eyecatch_on_container[0] ) echo ' checked';
	echo ' /><label for="dp_eyecatch_on_container"> '.__("Eyecatch shows on container","DigiPress").'</label></div>';
	echo '<p>'.__('You can show the eyecatch image at first of this post when you check this option.','DigiPress').'</p></div>';

	// Hide date
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_date" id="dp_hide_date" type="checkbox" value=1';
	if( $dp_hide_date[0] ) echo ' checked';
	echo ' /><label for="dp_hide_date" class="b"> '.__("Check to hide published date","DigiPress").'</label>';
	echo '<p>'.__('You can hide the date of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide author
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_author" id="dp_hide_author" type="checkbox" value=1';
	if( $dp_hide_author[0] ) echo ' checked';
	echo ' /><label for="dp_hide_author" class="b"> '.__("Check to hide author","DigiPress").'</label>';
	echo '<p>'.__('You can hide the author of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide category
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_cat" id="dp_hide_cat" type="checkbox" value=1';
	if( $dp_hide_cat[0] ) echo ' checked';
	echo ' /><label for="dp_hide_cat" class="b"> '.__("Check to hide category links","DigiPress").'</label>';
	echo '<p>'.__('You can hide category links of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide tags
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_tag" id="dp_hide_tag" type="checkbox" value=1';
	if( $dp_hide_tag[0] ) echo ' checked';
	echo ' /><label for="dp_hide_tag" class="b"> '.__("Check to hide tag links","DigiPress").'</label>';
	echo '<p>'.__('You can hide tag links of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide views
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_views" id="dp_hide_views" type="checkbox" value=1';
	if( $dp_hide_views[0] ) echo ' checked';
	echo ' /><label for="dp_hide_views" class="b"> '.__("Check to hide views","DigiPress").'</label>';
	echo '<p>'.__('You can hide viewed count of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide time for reading
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_time_for_reading" id="dp_hide_time_for_reading" type="checkbox" value=1';
	if( $dp_hide_time_for_reading[0] ) echo ' checked';
	echo ' /><label for="dp_hide_time_for_reading" class="b"> '.__("Check to hide reading time","DigiPress").'</label>';
	echo '<p>'.__('You can hide the time for readin of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide SNS Icons
	echo '<div class="dp_cf_item_box">
		 <input name="hide_sns_icon" id="hide_sns_icon" type="checkbox" value=1';
	if( $hide_sns_icon[0] ) echo ' checked';
	echo ' /><label for="hide_sns_icon" class="b"> '.__("Check to hide SNS buttons","DigiPress").'</label>';
	echo '<p>'.__('You can hide SNS buttons of this post page when you check this option.','DigiPress').'<br /><a href="'.admin_url().'admin.php?page=digipress_control" target="_blank">'.__('Settings for SNS Buttons','DigiPress').'</a></p></div>';

	// Hide Facebook Comment
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_fb_comment" id="dp_hide_fb_comment" type="checkbox" value=1';
	if( $dp_hide_fb_comment[0] ) echo ' checked';
	echo ' /><label for="dp_hide_fb_comment" class="b"> '.__("Check to hide Facebook comment box","DigiPress").'</label>';
	echo '<p>'.__('You can hide Facebook comment box of this post page when you check this option.','DigiPress').'<br /><a href="'.admin_url().'admin.php?page=digipress_control" target="_blank">'.__('Default setting for Facebook comment box','DigiPress').'</a>.</p></div>';
	
	// hide sidebar
	echo '<div class="dp_cf_item_box">
		 <input name="disable_sidebar" id="disable_sidebar" type="checkbox" value=1';
	if( $disable_sidebar[0] ) echo ' checked';
	echo ' /><label for="disable_sidebar" class="b"> '.__("Check to disable sidebar(1 column)","DigiPress").'</label>';
	echo '<p>'.__('You can hide the sidebar of this post page when you check this option.','DigiPress').'</p></div>';

	// Disable wpautop
	echo '<div class="dp_cf_item_box">
		 <input name="disable_wpautop" id="disable_wpautop_dp" type="checkbox" value=1';
	if( $disable_wpautop[0] ) echo ' checked';
	echo ' /><label for="disable_wpautop_dp" class="b"> '.__("Check to disable auto format of WordPress","DigiPress").'</label><div class="mg15px-l mg8px-top"><input name="replace_p_to_br" id="replace_p_to_br" type="checkbox" value=1';
	if ($replace_p_to_br[0]) echo ' checked'; 
	echo ' ><label for="replace_p_to_br">'.__('Check to replace line breaks to br tag in this post.', 'DigiPress').'</label></div>';
	echo '<p>'.__('Check this option to disable auto format function of WordPress of this post.','DigiPress').'</p></div>';
	
	// Whether include headline 
	echo '<div class="dp_cf_item_box disp-none">
		 <input name="is_headline" id="is_headline_dp" type="checkbox" value=1';
	if( $is_headline[0] ) echo ' checked';
	echo ' /><label for="is_headline_dp" class="b"> '.__("Check to Include Headline Slider","DigiPress").'</label>';
	echo '<p>'.__('You can show this post to the headline in top page when you check this option.','DigiPress').'</p></div>';
	
	// Whether include Slideshow 
	echo '<div class="dp_cf_item_box">
		 <input name="is_slideshow" id="is_slideshow_dp" type="checkbox" value=1';
	if( $is_slideshow[0] ) echo ' checked';
	echo ' /><label for="is_slideshow_dp" class="b"> '.__("Check to Include Slideshow","DigiPress").'</label>';
	echo '<p>'.__('You can show this post to the slideshow of DigiPress header area when you check this option.','DigiPress').'</p></div>';

	// URL
	echo '<div class="dp_cf_item_box">
		<p class="b">'.__('Image URL(Optional):','DigiPress').'</p>
		 <p>'.__('Enter the URL to your slideshow image below, if you want to customize default image of slideshow.', 'DigiPress').'</p>
		 <input type="text" name="slideshow_image_url" id="slideshow_image_url" size="60" style="width:80%;" value="'.$slideshow_image_url[0].'" />
		 <input id="upload_image_button" class="button" type="button" value="'.__('Add / Change','DigiPress').'" /><br />* '
		 .__("When you save as a blank, DigiPress displays the random image to the slideshow.",'DigiPress');
	echo '<p class="pd8px-top b grey">'.__("Current Slideshow image", "DigiPress").':</p><div id="uploadedImageView" class="clearfix">'. $preview_tag.'</div>';
	echo '</div>';

	// Description
	echo '<div class="dp_cf_item_box disp-none">
		 <p class="b">'.__('Description(Optional):','DigiPress').'</p>
		 <p>'.__("Enter your text of description for this slideshow, if you don't use the excerpt of this post.", "DigiPress").'</p>
		 <textarea name="slideshow_description" rows="3" style="width:100%;" />'.$slideshow_description[0].'</textarea>
		 <input type="hidden" name="dp_post_option_update" value="true" />
		 </div>';

	// Meta keyword
	echo '<div class="dp_cf_item_box">
		 <p class="b">'.__('HTML meta keyword (Optional):','DigiPress').'</p>
		 <p>'.__("Enter meta keywords of this post. If you don't specifiy the keyword, post tags are used for meta keywords.", "DigiPress").'</p>
		 <input name="dp_meta_keyword" id="dp_meta_keyword" type="text" style="width:100%;" value="'.$dp_meta_keyword[0].'" />';
	echo '<p>'.__('* Please use comma for separate each keyword.','DigiPress').'</p></div>';


	// No index
	echo '<div class="dp_cf_item_box">
		<p class="b">'.__('HTML meta information settings', 'DigiPress').'</p>
		 <div class="mg8px-btm"><input name="dp_noindex" id="dp_noindex" type="checkbox" value=1';
	if( $dp_noindex[0] ) echo ' checked';
	echo ' /><label for="dp_noindex"> '.__("Check to set meta no index attribute to this page.","DigiPress").'</label></div>';
	// No follow
	echo '<div class="mg8px-btm"><input name="dp_nofollow" id="dp_nofollow" type="checkbox" value=1';
	if( $dp_nofollow[0] ) echo ' checked';
	echo ' /><label for="dp_nofollow"> '.__("Check to set meta no follow attribute to this page.","DigiPress").'</label></div>';
	// No archive
	echo '<div class="mg8px-btm"><input name="dp_noarchive" id="dp_noarchive" type="checkbox" value=1';
	if( $dp_noarchive[0] ) echo ' checked';
	echo ' /><label for="dp_noarchive"> '.__("Check to set meta no archive attribute to this page.","DigiPress").'</label></div></div>';

	// Show additional params from extensions
	$additional_setting = apply_filters('dp_custom_field_single_form', $post->ID);
	if (is_string($additional_setting) && $additional_setting != $post->ID) {
		echo $additional_setting;
	}
}
 
/*---------------------------------------
 * For Page
 *--------------------------------------*/
/* HTML form */
function html_source_for_custom_box_page() {

	global $post, $dp_cf_arr;	

	$is_slideshow			= get_post_meta( $post->ID, 'is_slideshow');
	$slideshow_image_url	= get_post_meta( $post->ID, 'slideshow_image_url');
	$disable_sidebar	= get_post_meta( $post->ID, 'disable_sidebar');
	$hide_sns_icon		= get_post_meta( $post->ID, 'hide_sns_icon');
	$dp_hide_date		= get_post_meta( $post->ID, 'dp_hide_date');
	$dp_hide_author		= get_post_meta( $post->ID, 'dp_hide_author');
	$dp_meta_keyword	= get_post_meta( $post->ID, 'dp_meta_keyword');
	$dp_noindex			= get_post_meta( $post->ID, 'dp_noindex');
	$dp_nofollow		= get_post_meta( $post->ID, 'dp_nofollow');
	$dp_noarchive		= get_post_meta( $post->ID, 'dp_noarchive');
	$dp_hide_header_menu = get_post_meta( $post->ID, 'dp_hide_header_menu');
	$dp_hide_footer		= get_post_meta( $post->ID, 'dp_hide_footer');
	$dp_hide_title		= get_post_meta( $post->ID, 'dp_hide_title');
	$dp_show_eyecatch_force	= get_post_meta( $post->ID, 'dp_show_eyecatch_force');
	$dp_eyecatch_on_container= get_post_meta( $post->ID, 'dp_eyecatch_on_container');
	$disable_wpautop 		= get_post_meta( $post->ID, 'disable_wpautop');
	$replace_p_to_br 		= get_post_meta( $post->ID, 'replace_p_to_br');

	$additional_setting = '';

	// ****************
	// CSS
	$css_code = <<<_EOD_
<style type="text/css"><!--
.dp_cf_item_box {
	border:1px solid #ddd;
	padding:10px;
	margin-bottom:10px;
}
.dp_cf_item_box p {
	margin:6px 0 12px 0;
}
.dp_cf_inner_box {
	margin:10px;
}
--></style>
_EOD_;
	$css_code = str_replace(array("\r\n","\r","\n","\t"), '', $css_code);
	echo $css_code;
	// CSS
	// ****************

	// Show eyecatch
	echo '<div class="dp_cf_item_box">
		 <input name="dp_show_eyecatch_force" id="dp_show_eyecatch_force" type="checkbox" value=1';
	if( $dp_show_eyecatch_force[0] ) echo ' checked';
	echo ' /><label for="dp_show_eyecatch_force" class="b"> '.__("Check to show eyecatch image at first","DigiPress").'</label>';
	echo '<div class="mg10px-top mg20px-l mg15px-btm"><input name="dp_eyecatch_on_container" id="dp_eyecatch_on_container" type="checkbox" value=1';
		if( $dp_eyecatch_on_container[0] ) echo ' checked';
	echo ' /><label for="dp_eyecatch_on_container"> '.__("Eyecatch shows on container","DigiPress").'</label></div>';
	echo '<p>'.__('You can show the eyecatch image at first of this post when you check this option.','DigiPress').'</p></div>';

	// Hide title
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_title" id="dp_hide_title" type="checkbox" value=1';
	if( $dp_hide_title[0] ) echo ' checked';
	echo ' /><label for="dp_hide_title" class="b"> '.__("Check to hide post title","DigiPress").'</label>';
	echo '<p>'.__('You can hide the title of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide date
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_date" id="dp_hide_date" type="checkbox" value=1';
	if( $dp_hide_date[0] ) echo ' checked';
	echo ' /><label for="dp_hide_date" class="b"> '.__("Check to hide published date","DigiPress").'</label>';
	echo '<p>'.__('You can hide the date of this post page when you check this option.','DigiPress').'</p></div>';

	// Hide author
	echo '<div class="dp_cf_item_box">
		 <input name="dp_hide_author" id="dp_hide_author" type="checkbox" value=1';
	if( $dp_hide_author[0] ) echo ' checked';
	echo ' /><label for="dp_hide_author" class="b"> '.__("Check to hide author","DigiPress").'</label>';
	echo '<p>'.__('You can hide the author of this post page when you check this option.','DigiPress').'</p></div>';
	
	// Hide SNS Icons
	echo '<div class="dp_cf_item_box">
		 <input name="hide_sns_icon" id="hide_sns_icon" type="checkbox" value=1';
	if( $hide_sns_icon[0] ) echo ' checked';
	echo ' /><input type="hidden" name="dp_post_option_update" value="true" /><label for="hide_sns_icon" class="b"> '.__("Check to hide SNS buttons","DigiPress").'</label>';
	echo '<p>'.__('You can hide SNS buttons of this post page when you check this option.','DigiPress').'<br /><a href="'.admin_url().'admin.php?page=digipress_control" target="_blank">'.__('Settings for SNS Buttons','DigiPress').'</a></p></div>';
	
	// enable sidebar
	echo '<div class="dp_cf_item_box">
		 <input name="disable_sidebar" id="disable_sidebar" type="checkbox" value=1';
	if( $disable_sidebar[0] ) echo ' checked';
	echo ' /><label for="disable_sidebar" class="b"> '.__("Check to disable sidebar(1 column)","DigiPress").'</label>';
	echo '<p>'.__('You can hide the sidebar of this post page when you check this option.','DigiPress').'</p>';
	echo '</div>';

	// Disable wpautop
	echo '<div class="dp_cf_item_box">
		 <input name="disable_wpautop" id="disable_wpautop_dp" type="checkbox" value=1';
	if( $disable_wpautop[0] ) echo ' checked';
	echo ' /><label for="disable_wpautop_dp" class="b"> '.__("Check to disable auto format of WordPress","DigiPress").'</label><div class="mg15px-l mg8px-top"><input name="replace_p_to_br" id="replace_p_to_br" type="checkbox" value=1';
	if ($replace_p_to_br[0]) echo ' checked'; 
	echo ' ><label for="replace_p_to_br">'.__('Check to replace line breaks to br tag in this post.', 'DigiPress').'</label></div>';
	echo '<p>'.__('Check this option to disable auto format function of WordPress of this post.','DigiPress').'</p></div>';

	// Whether include Slideshow 
	echo '<div class="dp_cf_item_box">
		 <input name="is_slideshow" id="is_slideshow_dp" type="checkbox" value=1';
	if( $is_slideshow[0] ) echo ' checked';
	echo ' /><label for="is_slideshow_dp" class="b"> '.__("Check to Include Slideshow","DigiPress").'</label>';
	echo '<p>'.__('You can show this post to the slideshow of DigiPress header area when you check this option.','DigiPress').'</p></div>';

	// URL
	echo '<div class="dp_cf_item_box">
		<p class="b">'.__('Image URL(Optional):','DigiPress').'</p>
		 <p>'.__('Enter the URL to your slideshow image below, if you want to customize default image of slideshow.', 'DigiPress').'</p>
		 <input type="text" name="slideshow_image_url" id="slideshow_image_url" size="60" style="width:80%;" value="'.$slideshow_image_url[0].'" />
		 <input id="upload_image_button" class="button" type="button" value="'.__('Add / Change','DigiPress').'" /><br />* '
		 .__("When you save as a blank, DigiPress displays the random image to the slideshow.",'DigiPress');
	echo '<p class="pd8px-top b grey">'.__("Current Slideshow image", "DigiPress").':</p><div id="uploadedImageView" class="clearfix">'. $preview_tag.'</div>';
	echo '</div>';

	// No index
	echo '<div class="dp_cf_item_box">
		<p class="b">'.__('HTML meta information settings', 'DigiPress').'</p>
		 <div class="mg8px-btm"><input name="dp_noindex" id="dp_noindex" type="checkbox" value=1';
	if( $dp_noindex[0] ) echo ' checked';
	echo ' /><label for="dp_noindex"> '.__("Check to set meta no index attribute to this page.","DigiPress").'</label></div>';
	// No follow
	echo '<div class="mg8px-btm"><input name="dp_nofollow" id="dp_nofollow" type="checkbox" value=1';
	if( $dp_nofollow[0] ) echo ' checked';
	echo ' /><label for="dp_nofollow"> '.__("Check to set meta no follow attribute to this page.","DigiPress").'</label></div>';
	// No archive
	echo '<div class="mg8px-btm"><input name="dp_noarchive" id="dp_noarchive" type="checkbox" value=1';
	if( $dp_noarchive[0] ) echo ' checked';
	echo ' /><label for="dp_noarchive"> '.__("Check to set meta no archive attribute to this page.","DigiPress").'</label></div></div>';


	// Meta keyword
	echo '<div class="dp_cf_item_box">
		 <p class="b">'.__('HTML meta keyword (Optional):','DigiPress').'</p>
		 <p>'.__("Enter meta keywords of this post. If you don't specifiy the keyword, post tags are used for meta keywords.", "DigiPress").'</p>
		 <input name="dp_meta_keyword" id="dp_meta_keyword" type="text" style="width:100%;" value="'.$dp_meta_keyword[0].'" />';
	echo '<p>'.__('* Please use comma for separate each keyword.','DigiPress').'</p></div>';

	// Show additional params from extensions
	$additional_setting = apply_filters('dp_custom_field_page_form', $post->ID);
	if (is_string($additional_setting) && $additional_setting != $post->ID) {
		echo $additional_setting;
	}
}
?>
