<?php
/** ===================================================
* Echo slider Javascript
*
* @return strings
*/
function make_slider_js() {
	if ( !(is_home() && !is_paged()) ) return;
	
	global $options_visual, $IS_MOBILE_DP;

	$js_code 		= "";
	$suffix_class 	= "";
	if ($IS_MOBILE_DP && is_front_page() && !is_paged()) {
		$suffix_class = '_mobile';
	}
	if (is_archive() || is_search()) {
		$suffix_class = '_archive';
	}

	$target = $options_visual['dp_header_content_type'.$suffix_class];

	if ($target !== "2") return;

	// Javascript
	$transition_time 	= (int)$options_visual['dp_slideshow_transition_time'.$suffix_class];
	$interval 	= (int)$options_visual['dp_slideshow_speed'.$suffix_class] + $transition_time;
	$mode 		= $options_visual['dp_slideshow_effect'.$suffix_class];
	$mode 		= 'mode:"'.$mode.'",';
	// $random		= $options_visual['dp_slideshow_order'.$suffix_class] === 'rand' ? 'randomStart:true,' : '';
	$next_prev  = empty($options_visual['dp_slideshow_nav_button']) || (bool)$IS_MOBILE_DP ? 'controls:false,' : "nextText:'<i class=\"icon-right-light\"></i>',prevText:'<i class=\"icon-left-light\"></i>',";
	$pager  	= empty($options_visual['dp_slideshow_control_button']) || (bool)$IS_MOBILE_DP ? 'pager:false,' : '';

	// Callbacks
	$on_load_fn = '';
	$on_before_fn = '';
	if ((bool)$IS_MOBILE_DP) {
		$on_load_fn = 
",onSliderLoad:function(){
	j$('#hd_slideshow_mb').css('opacity',1);
}";
	} else {
		if ((bool)$options_visual['dp_slideshow_easing_fx']) {
			$on_load_fn		= 
",onSliderLoad:function(sl){
	var fs=j$(sl.children[0]).find('.sl-img');
	var ch=j$(sl.children).find('.sl-img');
	ch.css('transition','all ".($interval / 1000)."s ease-in-out');
	fs.addClass('scale_1_25');
}";
			$on_before_fn	= 
",onSlideBefore:function(ele,oi,ni){
	var fx=~~(Math.random()*5+1),
		old=ele.children(oi);
	ele.children(ni).removeClass('scale_1_25 mg_l mg_r mg_t mg_b');
	clearTimeout(sl_timer);
	switch (fx) {
		case 1:
			sl_timer = setTimeout(function(){
				old.addClass('scale_1_25');
			}, 5);
			break;
		case 2:
			old.addClass('scale_1_25');
			sl_timer = setTimeout(function(){
				old.addClass('mg_l');
			}, 5);
			break;
		case 3:
			old.addClass('scale_1_25');
			sl_timer = setTimeout(function(){
				old.addClass('mg_r');
			}, 5);
			break;
		case 4:
			old.addClass('scale_1_25');
			sl_timer = setTimeout(function(){
				old.addClass('mg_t');
			}, 5);
			break;
		case 5:
			old.addClass('scale_1_25');
			sl_timer = setTimeout(function(){
				old.addClass('mg_b');
			}, 5);
			break;
	}
}";
		}
	}

	// Js
	$js_code = 
"<script>
var j$=jQuery;
var hd_slider,sl_timer;
j$(function(){
	hd_slider = j$('#header-banner-inner .loop-slider').bxSlider({
		".$mode."
		speed:".$transition_time.",
		pause:".$interval.","
		.$pager.$next_prev.
		"video:true,
		auto:true,
		autoHover:false,
		adaptiveHeight:true".$on_load_fn.$on_before_fn."
	});
});</script>";

	$js_code = str_replace(array("\r\n","\r","\n","\t"), '', $js_code);
	return $js_code;
}


/************************************
 * Fullscreen background video js
 ************************************/
function make_fullscreen_video_js() {
	if ( !(is_home() && !is_paged()) ) return;

	global $options_visual, $IS_MOBILE_DP;

	if ((bool)$IS_MOBILE_DP) return;

	$video_id 	= "";
	$js_code 	= "";

	$target = $options_visual['dp_header_content_type'];

	switch ($target) {
		case 3:
			$video_id = $options_visual['fullscreen_video_url'];
			break;
		default:
			$video_id = "";
			break;
	}
	if (empty($video_id)) return;

	// Load DPVideo module.
	wp_enqueue_script('dpvideo', DP_THEME_URI . '/inc/js/jquery/jquery.dpvideo.min.js', array('jquery'));

	// Start
	$start = !empty($options_visual['fullscreen_video_start']) ? ',start:'.$options_visual['fullscreen_video_start'] : '';

	// Finish
	$js_code =
"<script>
var j$=jQuery;
j$(function(){
	j$.dpvideo({
		video:'".$video_id."'".$start."
	});
});</script>";

	$js_code = str_replace(array("\r\n","\r","\n","\t"), '', $js_code);
	return $js_code;
}


/** ===================================================
* Create slideshow source
*
*/
function dp_slideshow_source( $params = array(
								'width' 	=> 1680, 
								'height' 	=> 1200,
								'navigation_class'	=> 'hd-slide-nav',
								'control_class' 	=> 'hd-slide-control' )) {

	global $options, $options_visual, $IS_MOBILE_DP;

	extract($params);

	$slider_id = 'hd_slideshow';

	$suffix_class = (bool)$IS_MOBILE_DP && is_front_page() && !is_paged() ? '_mobile' : '';

	if (is_archive() || is_search()) {
		$suffix_class = '_archive';
		$target = 'header_img';
	} else {
		$target 	= $options_visual['dp_slideshow_target'.$suffix_class];
		$orderby 	= $options_visual['dp_slideshow_order'.$suffix_class];
	}
	$num 		= $options_visual['dp_number_of_slideshow'.$suffix_class];
	$mode 		= $options_visual['dp_slideshow_effect'.$suffix_class];
	$upload_dir = 'header';

	// Thumbnail size
	if ((bool)$IS_MOBILE_DP) {
		$width 	= 818;
		$height = 680;
		$upload_dir = 'header/mobile';
		$slider_id = 'hd_slideshow_mb';
	}

	$slideshow_code 	= '<ul id="'.$slider_id.'" class="loop-slider '.$mode.'">';

	switch ($target) {
		case 'header_img':	// Slideshow with Heade image
			$arrImages = array();
			// Get images
			$images = dp_get_uploaded_images($upload_dir);
			$images = $images[0];
			$cnt = count($images);

			// Move image to the array
			if (0 < $cnt && $cnt <= $num) {
				$arrImages = $images;
			} else if ($cnt > $num) {
				for ($i=0; $i < $num; $i++) {
					if (!empty($images[$i])) {
						array_push($arrImages, $images[$i]);
					}
				}
			}
			// Loop each images
			foreach ($arrImages as $image) {
				// Slideshow code
				$slideshow_code .= '<li class="slide"><img src="'.$image.'" class="sl-img" alt="slide image" /></li>';
			}
			break;

		case 'post':	// Slideshow with articles
		case 'page':
			global $post;
			// Query
			$posts = get_posts( array(
									'numberposts'	=> $num,
									'post_type'		=> $target,
									'meta_key'		=> 'is_slideshow',
									'meta_value'	=> array("true", true),
									'orderby'		=> $orderby // or rand
									)
			);

			// Loop query posts
			foreach( $posts as $post ) : setup_postdata($post);
				// Reset
				$lp_class		= '';
				$slide_image 	= '';
				$date_code 		= '';
				$meta_code 		= '';
				$cats 			= '';
				$cats_code 		= '';
				$cat_class 		= '';
				$p_id 			= get_the_ID();
				$post_url 		= get_permalink();
				$title 			= get_the_title();
				$title 			= (mb_strlen($title, 'utf-8') > 30) ? mb_substr($title, 0, 30, 'utf-8') . '...' : $title;
				// Video ID(YouTube only)
				$videoID		= get_post_meta($p_id, 'item_video_id', true);
				// Target video service
				$video_service	= get_post_meta($p_id, 'video_service', true);
					
				// Date
				if (!(bool)get_post_meta($p_id, 'dp_hide_date', true) && ($target === 'post' && (bool)$options['show_pubdate_on_meta'])) {
					if ((bool)$options['date_eng_mode']) {
						$date_code 	= '<div class="sl-date"><span class="date_day">'.get_post_time('j').'</span> <span class="date_month_en">'.get_post_time('F').'</span>, <span class="date_year">'.get_post_time('Y').'</span></div>';
					} else {
						$date_code = '<div class="sl-date">'.get_the_date().'</div>';
					}
				}

				// // Author
				// if (!(bool)get_post_meta($p_id, 'dp_hide_author', true) && (bool)$options['show_author_on_meta']) {
				// 	$author_code = '<div class="loop-author author-info vcard"><div class="author-avatar"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" rel="author" title="'.__('Show articles of this user.', 'DigiPress').'">'.get_avatar( $post->post_author, 90 ).'</a></div><div class="author-name"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'" rel="author" title="'.__('Show articles of this user.', 'DigiPress').'" class="fn">'.get_the_author_meta('display_name').'</a></div></div>';
				// }

				// Category
				if ( !(bool)get_post_meta($p_id, 'dp_hide_cat', true) ) {
					$cats = get_the_category();
					if ($cats) {
						$cats = $cats[0];
						$cat_class = " cat-color".$cats->cat_ID;
						$cats_code = '<div class="loop-cat"><a href="'.get_category_link($cats->cat_ID).'" rel="tag" class="'.$cat_class.'"><span>' .$cats->cat_name.'</span></a></div>';
					}
				}

				// Get post image
				$slide_image 	= get_post_meta($p_id, 'slideshow_image_url', true);

				if (!empty($slide_image)) {
					// If HTTPS
					$slide_image 	= is_ssl() ? str_replace('http:', 'https:', $slide_image) : $slide_image;
				} else {
					if( has_post_thumbnail() ) {
						$image_id 	= get_post_thumbnail_id();
						$image_data = wp_get_attachment_image_src($image_id, array($width, $height), true); 
						$image_url 	= is_ssl() ? str_replace('http:', 'https:', $image_data[0]) : $image_data[0];
						// For centering image class
						// $image_w	= $image_data[1];
						// $image_h	= $image_data[2];
						// $lp_class 	= ' centered';
						// if ($image_w > $image_h) {
						// 	$lp_class .= ' landscape';
						// } else {
						// 	$lp_class .= ' portrait';
						// }
						$slide_image 	= $image_url;
						
					} else {
						preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"]/i', get_post($p_id)->post_content, $got_image);
						if ( $got_image[1][0] ) {
							// Add image
							$slide_image = is_ssl() ? str_replace('http:', 'https:', $got_image[1][0]) : $got_image[1][0];
							
						} else {
							$strPattern	=	'/(\.gif|\.jpg|\.jpeg|\.png)$/';
							
							if ($handle = opendir(DP_THEME_DIR . '/img/slideshow')) {
								$def_image;
								$cnt = 0;
								while (false !== ($file = readdir($handle))) {
									if ($file != "." && $file != "..") {
										//Image file only
										if (preg_match($strPattern, $file)) {
											$def_image[$cnt] = DP_THEME_URI . '/img/slideshow/'.$file;
											//count
											$cnt ++;
										}
									}
								}
								closedir($handle);
							}
							if ($cnt > 0) {
								$randInt = rand(0, $cnt - 1);
								// Add image
								$slide_image = is_ssl() ? str_replace('http:', 'https:', $def_image[$randInt]) : $def_image[$randInt];
							}
						}
					}
				}

				// Slideshow code
				$slideshow_code .= '<li class="slide"><img src="'.$slide_image.'" class="sl-img" alt="eyecatch" /><div class="loop-meta"><div class="loop-title">'.$date_code.'<a href="'.$post_url.'" class="sl-title" title="'.$title.'">'.$title.'</a></div>'.$cats_code.'</div></li>';
			endforeach;
			// Reset Query
			wp_reset_postdata();
			break;
	}
	// Close ul
	$slideshow_code .= '</ul>';
	// Display
	return $slideshow_code;
}


/** ===================================================
* Show the Banner Contents
*
* @return	none
*/
function dp_banner_contents() {
	if ( !(is_home() && !is_paged()) ) return;

	global $options,$options_visual,$IS_MOBILE_DP;

	$has_widget_class 	= '';
	$prefix_code 		= '';
	$banner_contents 	= '';
	$title_position_class = 'pos-c';
	$header_title_code 	= '';
	$header_id 			= '';
	$header_class 		= '';
	$upload_dir 		= 'header';
	$single_img 		= '';
	$hdbar_fixed 		= '';

	$suffix_class = (bool)$IS_MOBILE_DP && is_front_page() && !is_paged() ? '_mobile' : '';
	if (is_archive() || is_search()) {
		$suffix_class = '_archive';
	}

	//Get options
	$type		= $options_visual['dp_header_content_type'.$suffix_class];
	$header_img = $options_visual['dp_header_img'.$suffix_class];

	if ($type === 'none') return;

	// For Mobile
	if ($IS_MOBILE_DP) {
		$upload_dir = 'header/mobile';
		// Fixed class
		if ($options['fixed_mb_header_bar']) {
			$hdbar_fixed = ' fixed';
		}
	}

	// Has widget?
	if (is_active_sidebar('widget-on-top-banner') && !$IS_MOBILE_DP ) {
		$has_widget_class = ' has_widget';
	} else {
		$has_widget_class = ' no_widget';
	}

	// Top page
	switch ($type) {
		case 1:	// Header image
			if ($header_img === 'random') {
				// Get images
				$images = dp_get_uploaded_images($upload_dir);
				$images = $images[0];
				$cnt = count($images);

				if ($cnt > 0) {
					//show image
					$rnd = rand(0, $cnt - 1);
					$banner_contents = '<img src="'.$images[$rnd].'" class="static_img" />';
				} else {
					$banner_contents = '<img src="'.DP_THEME_URI.'/img/sample/header/header1.jpg" class="static_img" />';
				}
			} else {
				if ($header_img === 'none' || !$options_visual['dp_header_img'.$suffix_class]) {
					$banner_contents = '<img src="'.DP_THEME_URI.'/img/sample/header/header1.jpg" class="static_img" />';
				} else {
					$banner_contents = '<img src="'.$options_visual['dp_header_img'.$suffix_class].'" class="static_img" />';
				}
			}
			$header_class	= ' hd_img';
			break;

		case 2:	// Slideshow
			// bxSlider
			wp_enqueue_script('dp-bxslider', DP_THEME_URI . '/inc/js/jquery/jquery.bxslider.min.js', array('jquery','fitvids','imagesloaded'));
			// Get slideshow source
			$banner_contents = dp_slideshow_source();
			$header_class = ' hd_slideshow';
			break;

		case 3:	// Fullscreen bg movie
			$banner_contents = '';
			break;

		case 'single':
			$banner_contents = $single_img;
			break;
	}

	// **********************************
	// Prefix Code
	// **********************************
	$prefix_code = '<section id="header-banner-outer" class="header-banner-outer'.$hdbar_fixed.'"><div id="header-banner-inner" class="header-banner-inner'.$header_class.$has_widget_class.'">';
	// **********************************
	// Display 
	// ********************************** 
	echo $prefix_code.$banner_contents;

	// Title & caption
	if (is_front_page() && !is_paged()) {
		if ( $type === "1" || $type === "3" || ($type === "2" && ($options_visual['dp_slideshow_target'.$suffix_class] !== 'post' && $options_visual['dp_slideshow_target'.$suffix_class] !== 'page' ) ) ) {
			/* ******************
			 * if title shows on header
			 * *****************/
			$wait_time = $IS_MOBILE_DP ? ' move 20px' : ' wait 2.0s';
			// Title
			if (!empty($options['header_img_h2'])) {
				$header_title_code = '<h2 id="banner_title" data-sr="enter top over 0.6s'.$wait_time.'">'.htmlspecialchars_decode($options['header_img_h2']).'</h2>';
			}
			// H3 title
			if (!empty($options['header_img_h3'])) {
				$header_title_code .= '<div id="banner_caption"><span data-sr="enter bottom over 1.4s'.$wait_time.'">'.htmlspecialchars_decode($options['header_img_h3']).'</span></div>';
			}
			if (!empty($header_title_code)) {
				$header_title_code = '<header class="'.$title_position_class.'">'.$header_title_code.'</header>';
			}
			// Remove "has_title" class
			$no_title_class = '';
			// *********** Display header ************
			$header_title_code = '<div class="header-banner-container'.$hdbar_fixed.'"><div class="header-banner-content clearfix">' . $header_title_code;

			// **********************************
			// Display title
			// **********************************
			echo $header_title_code;

			// **********************************
			// Header widget
			// **********************************
			if (is_active_sidebar('widget-on-top-banner') && !$IS_MOBILE_DP ) {
				echo '<div class="widget-on-top-banner'.$no_title_class.'" data-sr="enter bottom over 1.2s wait 2.8s">';
				dynamic_sidebar( 'widget-on-top-banner' );
				echo '</div>';
			}
			echo '</div></div>';	//  Close ".header-banner-container" and ".header-banner-content"
		}
	}

	echo '</div></section>';	//  Close ".header-banner-inner" and ".header-banner-outer"
}
?>