<?php
/*******************************************************
* Sidebar widget
*******************************************************/
global $options, $options_visual;

$wow_title_css 	= '';
$wow_ft_title_css	= '';
$mb_suffix			= '';
if ((bool)is_mobile_dp()) {
	$mb_suffix = '_mb';
}
if (!(bool)$options['disable_wow_js'.$mb_suffix]){
	$wow_title_css 		= ' wow fadeInLeft';
	$wow_ft_title_css	= ' wow fadeInDown';
}

$slider_css = $options['disable_cat_slider'] ? '' : ' slider_fx';

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
			'name'		=> __('Sidebar', 'DigiPress'),
			'id'		=> 'sidebar',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1 class="wd-title"><span>',
			'after_title'	=> '</span></h1>'));

	// Sidebar 2
	if ($options_visual['dp_column'] == 3) {
		register_sidebar(array(
				'name'		=> __('Sidebar2', 'DigiPress'),
				'id'		=> 'sidebar2',
				'description'	=> __('Second sidebar for 3column.', 'DigiPress'),
				'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h1 class="wd-title"><span>',
				'after_title'	=> '</span></h1>'));
	}

	// Header banner
	register_sidebar(array(
			'name'		=> __('Top background image', 'DigiPress'),
			'id'		=> 'widget-on-top-banner',
			'description'	=> __('Widget area on background screen of front page.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title"><span>',
			'after_title'	=> '</span></h3>'));

	// Top page container
	register_sidebar(array(
			'name'		=> __('Container top area', 'DigiPress'),
			'id'		=> 'widget-container-top',
			'description'	=> __('Between under header area and main content.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Top page content area
	register_sidebar(array(
			'name'		=> __('Content top area', 'DigiPress'),
			'id'		=> 'widget-content-top',
			'description'	=> __('Top area in main content.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Under post title
	register_sidebar(array(
			'name'		=> __('Under the post title', 'DigiPress'),
			'id'		=> 'widget-post-top',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Last article content
	register_sidebar(array(
			'name'		=> __('Bottom of the post', 'DigiPress'),
			'id'		=> 'widget-post-bottom',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Top page content botom area
	register_sidebar(array(
			'name'		=> __('Content bottom area', 'DigiPress'),
			'id'		=> 'widget-content-bottom',
			'description'	=> __('Last area in main content.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Top page container botom area
	register_sidebar(array(
			'name'		=> __('Container footer area', 'DigiPress'),
			'id'		=> 'widget-container-bottom',
			'description'	=> __('Between under main content and footer area.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	register_sidebar(array(
			'name'		=> __('Footer Widget1', 'DigiPress'),
			'id'		=> 'footer-widget1',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1 class="wd-title'.$wow_ft_title_css.'"><span>',
			'after_title'	=> '</span></h1>'));

if ($options_visual['footer_col_number'] != '1') {
	register_sidebar(array(
			'name'		=> __('Footer Widget2', 'DigiPress'),
			'id'		=> 'footer-widget2',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1 class="wd-title'.$wow_ft_title_css.'"><span>',
			'after_title'	=> '</span></h1>'));
}

if (($options_visual['footer_col_number'] == '4') || ($options_visual['footer_col_number'] == '3')) {
	register_sidebar(array(
			'name'		=> __('Footer Widget3', 'DigiPress'),
			'id'		=> 'footer-widget3',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1 class="wd-title'.$wow_ft_title_css.'"><span>',
			'after_title'	=> '</span></h1>'));
}

if ($options_visual['footer_col_number'] == '4') {
	register_sidebar(array(
			'name'		=> __('Footer Widget4', 'DigiPress'),
			'id'		=> 'footer-widget4',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h1 class="wd-title'.$wow_ft_title_css.'"><span>',
			'after_title'	=> '</span></h1>'));
}
	// Top page container for mobile
	register_sidebar(array(
			'name'		=> __('Container top area(mobile)', 'DigiPress'),
			'id'		=> 'widget-container-top-mb',
			'description'	=> __('Between under header area and main content.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Under the post title space for mobile
	register_sidebar(array(
			'name'		=> __('Under the post title(mobile)', 'DigiPress'),
			'id'		=> 'widget-post-top-mb',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Last post content for mobile
	register_sidebar(array(
			'name'		=> __('Bottom of the post(mobile)', 'DigiPress'),
			'id'		=> 'widget-post-bottom-mb',
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Container footer widget for mobile
	register_sidebar(array(
			'name'		=> __('Container bottom(mobile)', 'DigiPress'),
			'id'		=> 'widget-container-bottom-mb',
			'description'	=> __('After main content area for mobile.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_title_css.'"><span>',
			'after_title'	=> '</span></h3>'));

	// Site footer widget for mobile
	register_sidebar(array(
			'name'		=> __('Footer Widget(mobile)', 'DigiPress'),
			'id'		=> 'widget-footer-mb',
			'description'	=> __('Footer widget for mobile.', 'DigiPress'),
			'before_widget'	=> '<div id="%1$s" class="widget-box %2$s'.$slider_css.'">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3 class="inside-title'.$wow_ft_title_css.'"><span>',
			'after_title'	=> '</span></h1>'));
}


/*******************************************************
* Get posts by get_posts Query
*******************************************************/
function DP_GET_POSTS_BY_QUERY($args = array(
									'number' 	=> 5,
									'thumbnail'	=> true,
									'views'		=> false,
									'comment'	=> false,
									'order_by'	=> 'post_date',
									'order'		=> 'DESC',
									'hatebuNumber'	=> false,
									'tweetsNumber'	=> false,
									'likesNumber'	=> false,
									'cat_id'	=> '',
									'meta_key'	=> '',
									'meta_value' => '',
									'post_type'	=> 'post',
									'year'		=> '',
									'month'		=> '',
									'pub_date'	=> false,
									'type'		=> '',
									'more_text'	=> 'More',
									'voted_icon' => '',
									'voted_count' => false,
									'return'	=> false
									)
) {
	global $options, $post, $IS_MOBILE_DP;
	extract($args);

	// Params
	$number 		= !is_null($number) ? $number : 5;
	$thumbnail 		= (bool)$thumbnail ? true : false;
	$views 			= (bool)$views ? true : false;
	$comment 		= (bool)$comment ? true : false;
	$order_by		= !empty($order_by) ? $order_by : 'post_date';
	$order			= !empty($order) ? $order : 'DESC';
	$hatebuNumber 	= (bool)$hatebuNumber ? true : false;
	$tweetsNumber 	= (bool)$tweetsNumber ? true : false;
	$likesNumber 	= (bool)$likesNumber ? true : false;
	$cat_id 		= !empty($cat_id) ? $cat_id : '';
	$meta_key		= !empty($meta_key) ? $meta_key : '';
	$meta_value		= !empty($meta_value) ? $meta_value : '';
	$post_type 		= !empty($post_type) ? $post_type : 'post';
	$year			= !empty($year) ? $year : '';
	$month			= !empty($month) ? $month : '';
	$pub_date 		= (bool)$pub_date ? true : false;
	$type 			= !empty($type) ? $type : '';
	$more_text 		= !empty($more_text) ? $more_text : '';
	$voted_count 	= (bool)$voted_count ? true : false;	
	$return 		= (bool)$return ? true : false;	

	$return_code 	= '';
	$unique_id 		= '';
	$counter 		= 0;
	$views_code 	= '';
	$more_url 		= '';
	$thumb_class 	= '';
	$title_length 	= 35;

	// *********************
	// Category ID
	// *********************
	if ( $post_type !== 'post' && $post_type !== 'page') {
		$cat_id = null;
	// } else if ( is_category() && !$args['cat_id'] ) {
	// 	$cat_id = get_query_var('cat');
	}

	// *********************
	// More link
	// *********************
	if (!empty($more_text)) {
		if ( ($type == 'recent' || $type == 'custom')  && $order_by != 'rand') {
			if ($post_type == 'post') {
				if ($cat_id) {
					$arr_cat_id 	= explode(",", $cat_id);
					$more_url = get_category_link($arr_cat_id[0]);
				} else {
					if (is_home()) {
						$more_url = esc_url(get_pagenum_link(2));
					} else {
						// All posts and not home
						$more_url = home_url('/');
					}
				}
			} else {
				$more_url = get_post_type_archive_link($post_type);
			}

			if ( $more_url ) {
				$more_url = '<div class="more-entry-link"><a href="'.$more_url.'"><span>'.$more_text.'</span></a></div>';
			}
		}
	}

	// *********************
	// Main Query
	// *********************
	$posts = get_posts(  array(
							'numberposts'	=> $number,
							'category'		=> $cat_id,
							'post_type'		=> $post_type,
							'meta_key'		=> $meta_key,
							'meta_value'	=> $meta_value,
							'orderby'		=> $order_by, // or rand
							'year'			=> $year,
							'month'			=> $month,
							'order'			=> $order
							)
	);

	$mobile_class = $IS_MOBILE_DP ? ' mobile': '';

	// Thumb check
	if ((bool)$thumbnail) {
		$width = 400;
		$height = 280;
		$thumb_class = ' thumb';
	}
	// *****************
	// Display
	foreach( $posts as $post ) : setup_postdata($post);
		// reset
		$comment_code 		= '';
		$thumb_code 		= '';
		$hatebuNumberCode 	= '';
		$tweetCountCode		= '';
		$fbLikeCountCode 	= '';
		$listStartCode 		= '';
		$js_code 			= '';
		$ranking_code 		= '';
		$date_code 			= '';
		$sns_share_code 	= '';
		$item_list_code 	= '';
		$widget_meta_code 	= '';
		$voted_code 		= '';
		$voted_icon_class 	= '';
		$rank_label_class 	= '';

		// Get Unique ID
		$unique_id 			= 'wlp-'.dp_rand().'-'.get_the_ID();

		// Ranking tag
		if (strpos($meta_key, 'post_views_count') !== false || $voted_count) {
			$counter++;
			if ($thumbnail) {
				$ranking_code = '<span class="rank_label thumb">'.$counter.'</span>';
			} else {
				$ranking_code = '<span class="rank_label no-thumb">'.$counter.'</span>';
			}
			$rank_label_class = ' has_rank';
		}

		// Voted count
		if ( $voted_count ) {
			$voted_icon = !empty($voted_icon) ? $voted_icon : 'icon-heart';
			$voted_code = get_post_meta(get_the_ID(), 'dp_ex_sr_votes_like_count', true);
			$voted_code = '<div class="voted"><i class="'.$voted_icon.'"></i><span class="share-num">'.$voted_code.'</span></div>';
		}


		// Post title
		$post_title =  the_title('', '', false) ? the_title('', '', false) : __('No Title', 'DigiPress');
		$post_title = (mb_strlen($post_title, 'utf-8') > $title_length) ? mb_substr($post_title, 0, $title_length, 'utf-8') . '...' : $post_title;
		$post_title = '<h4 class="excerpt_title_wid"><a href="'.get_permalink().'" rel="bookmark" title="'.the_title_attribute('before=&after=&echo=0').'" class="item-link">'.$post_title.'</a></h4>';

		// Publish date
		if ( (bool)$pub_date && !get_post_meta(get_the_ID(), 'dp_hide_date', true) ) {
			if ((bool)$options['date_eng_mode']) {
				$date_code = '<time datetime="'.get_the_date('c').'" class="widget-time">'.get_post_time('j').' '.get_post_time('M').', '.get_post_time('Y').'</time>';
			} else {
				$date_code = '<time datetime="' . get_the_date('c') . '" class="widget-time">' . get_the_date() . '</time>';
			}
		}

		// Thumbnail 
		if ($thumbnail) {
			$arg = array("width"=>$width, "height"=>$height);
			$thumb_code = '<div class="widget-post-thumb thumb">'.show_post_thumbnail($arg).'</div>';
		}

		// Views
		if ( (bool)$views && function_exists('dp_get_post_views')) {
			$views_code = '<div class="meta-views widget-views">'.dp_get_post_views(get_the_ID(), $meta_key). ' views</div>';
		}
		
		// SNS share count
		if ($post_type === 'post') {
			// ************* SNS sahre number + comment *****************
			// hatebu
			if ((bool)$hatebuNumber) {
				$hatebuNumberCode = '<div class="bg-hatebu"><i class="icon-hatebu"></i><span class="share-num"></span></div>';
			}
				
			// Count tweets
			// if ((bool)$tweetsNumber) {
			// 	$tweetCountCode = '<div class="bg-tweets"><i class="icon-twitter"></i><span class="share-num"></span></div>';
			// }

			// Count Facebook Like 
			if ((bool)$likesNumber) {
				$fbLikeCountCode = '<div class="bg-likes"><i class="icon-facebook"></i><span class="share-num"></span></div>';
			}
			// Comments
			if ( ($post_type === 'post') && $comment && comments_open() ) {
				$comment_code = '<div class="meta-comment"><i class="icon-comment"></i><span class="share-num">'. get_comments_popup_link(
									'0', '1', '%').'</span></div>';
			}

			if ((bool)$hatebuNumber || (bool)$tweetsNumber || (bool)$likesNumber || $voted_count) {
				$sns_share_code = '<div class="loop-share-num">'.$fbLikeCountCode.$hatebuNumberCode.$tweetCountCode.$comment_code.$voted_code.'</div>';
				$js_code = '<script>j$(function() {get_sns_share_count("'.get_permalink().'", "'.$unique_id.'");});</script>';
			}
			// ************* SNS sahre number *****************
		}

		// ***********************
		// Display
		// ***********************
		if ($unique_id) {
			$item_list_code = '<li id="'.$unique_id.'" class="clearfix'.$rank_label_class.'">';
			$js_code 		= '<script>j$(function() {get_sns_share_count("'.get_permalink().'", "'.$unique_id.'");});</script>';
		} else {
			$item_list_code = '<li class="clearfix'.$rank_label_class.'">';
			$js_code 		= '';
		}

		// Combine
		$item_list_code .=  $thumb_code.'<div class="excerpt_div clearfix">'.$date_code.$post_title.$views_code.'</div>'.$sns_share_code.$ranking_code.$js_code.'</li>';

		$return_code .= $item_list_code;
	endforeach;
	// Reset Query
	wp_reset_postdata();

	// Code
	$return_code = '<ul class="recent_entries'.$thumb_class.$mobile_class.'">'.$return_code.'</ul>'.$more_url;

	if ((bool)$return) {
		return $return_code;
	} else {
		echo $return_code;
	}
}


/*******************************************************
* Search form widget
*******************************************************/
class DP_Widget_Search extends WP_Widget {
	function DP_Widget_Search() {
		// widget actual processes
		$widget_ops = array(
						'classname' => 'dp_search_form',
						'description' => __( "A search form for your site.", 'DigiPress') );
		$this->__construct('DPWidgetSearch', __('Search Box for DigiPress', 'DigiPress'), $widget_ops);
	}
	
	function form($instance) {
		// outputs the options form on admin
		$instance	= wp_parse_args( (array) $instance, array(
									 'title'	=> '',
									 'mode'		=> 'default'));
		$title		= $instance['title'];
		$mode		= $instance['mode'];
		$titleName	= $this->get_field_name('title');
		$titleId	= $this->get_field_id('title');
		$modeName	= $this->get_field_name('mode');
		$modeId		= $this->get_field_id('mode');
		
		$modeCheck = ($mode === 'gcs') ? 'checked' : '';

		echo '<p><label for="'.$titleId.'">'.__('Title:', 'DigiPress').'</label>';
		echo '<input class="widefat" id="'.$titleId.'" name="'.$titleName.'" type="text" value="'.esc_attr($title).'" /></p>';
		echo '<p><input name="' . $modeName. '" id="'.$modeId.'" type="checkbox" value="gcs" '.$modeCheck.' /> <label for="'.$modeId.'">'.__('Use Google Custom Search', 'DigiPress').'</label></p><a href="admin.php?page=digipress_control">'.__('Set the Search Engine ID', 'DigiPress').'</a><br />DigiPress詳細設定<br />　┗サイト一般動作設定<br />　　┗Google カスタム検索設定';
	}

	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		
		$instance['mode']	= $new_instance['mode'];
		$instance['title']	= strip_tags($new_instance['title']);
		return $instance;
	}
	
	function widget($args, $instance) {
		// outputs the content of the widget
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' => '',
														  'mode' => ''));

		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;

		if ($instance['mode'] == 'gcs') {
			echo "<gcse:searchbox-only></gcse:searchbox-only>";
		} else {
			get_search_form();
		}
		
		echo $after_widget;
	}
}
// register DP_Widget_Search widget
add_action('widgets_init', create_function('', 'return register_widget("DP_Widget_Search");'));


/*******************************************************
* Recent Posts widget
*******************************************************/
class DP_RecentPosts_Widget extends WP_Widget {
	function DP_RecentPosts_Widget() {
		$widget_opts = array('classname' => 'dp_recent_posts_widget', 
							 'description' => __('Enhanced Recent Posts widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPRecentPostsWidget', __('Custom Recent Posts', 'DigiPress'), $widget_opts, $control_opts);
	}

	// Input widget form in Admin panel.
	function form($instance) {
		// default value
		$instance = wp_parse_args((array)$instance, array('title' => __('Recent Posts','DigiPress'), 
														  'number' => 5,
														  'cat'		=> null,
														  'thumbnail' => true,
														  'comment'	=> false,
														  'views'	=> false,
														  'random'		=> false,
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false,
														  'more_text'	=> 'More'));

		// get values
		$title		= strip_tags($instance['title']);
		$number		= $instance['number'];	
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$cat		= $instance['cat'];
		$random		= $instance['random'];
		$pub_date 	= $instance['pub_date'];
		$more_text 	= $instance['more_text'];

		$titlename	= $this->get_field_name('title');
		$titleid	= $this->get_field_id('title');
		$numbername	= $this->get_field_name('number');
		$numberid	= $this->get_field_id('number');
		$thumbnailname	= $this->get_field_name('thumbnail');
		$thumbnailid	= $this->get_field_id('thumbnail');
		$commentName	= $this->get_field_name('comment');
		$commentId		= $this->get_field_id('comment');
		$viewsName		= $this->get_field_name('views');
		$viewsId		= $this->get_field_id('views');
		$catName		= $this->get_field_name('cat');
		$catId			= $this->get_field_id('cat');
		$hatebuNumberName	= $this->get_field_name('hatebuNumber');
		$tweetsNumberName	= $this->get_field_name('tweetsNumber');
		$likesNumberName	= $this->get_field_name('likesNumber');
		$hatebuNumberId = $this->get_field_id('hatebuNumber');
		$tweetsNumberId = $this->get_field_id('tweetsNumber');
		$likesNumberId = $this->get_field_id('likesNumber');
		$randomName		= $this->get_field_name('random');
		$randomId		= $this->get_field_id('random');
		$pub_date_name	= $this->get_field_name('pub_date');
		$pub_date_id	= $this->get_field_id('pub_date');
		$more_text_name	= $this->get_field_name('more_text');
		$more_text_id	= $this->get_field_id('more_text');


		$thumbeCheck;
		if ($thumbnail) $thumbeCheck = 'checked';
		
		$commentCheck;
		if ($comment) $commentCheck = 'checked';
		
		$viewsCheck;
		if ($views) $viewsCheck = 'checked';
		
		$hatebuNumberCheck;
		if ($hatebuNumber) $hatebuNumberCheck = 'checked';

		$tweetsNumberCheck;
		if ($tweetsNumber) $tweetsNumberCheck = 'checked';

		$likesNumberCheck;
		if ($likesNumber) $likesNumberCheck = 'checked';

		$randomCheck;
		if ($random) $randomCheck = 'checked';

		$pub_dateCheck;
		if ($pub_date === 'show') $pub_dateCheck = 'checked';

		// Show form
		echo '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		echo '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';
		echo '<p><label for="'.$numberid.'">'.__('Number to display','DigiPress').':</label>
			 <input type="text" name="'.$numbername.'" id="'.$numberid.'" value="'.$number.'" style="width:60px;" /></p>';
		echo '<p><input name="'.$thumbnailname.'" id="'.$thumbnailid.'" type="checkbox" value="on" '.$thumbeCheck.' />
			 <label for="'.$thumbnailid.'">'.__('Show Thumbnail','DigiPress').'</label></p>';
		echo '<p><input name="'.$pub_date_name.'" id="'.$pub_date_id.'" type="checkbox" value="show" '.$pub_dateCheck.' />
			 <label for="'.$pub_date_id.'">'.__('Show date','DigiPress').'</label></p>';
		echo '<p><input name="'.$commentName.'" id="'.$commentId.'" type="checkbox" value="on" '.$commentCheck.' />
			 <label for="'.$commentId.'">'.__('Show the number of comment(s).', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$viewsName.'" id="'.$viewsId.'" type="checkbox" value="on" '.$viewsCheck.' />
			 <label for="'.$viewsId.'">'.__('Show views.', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$hatebuNumberName.'" id="'.$hatebuNumberId.'" type="checkbox" value="on" '.$hatebuNumberCheck.' />
			 <label for="'.$hatebuNumberId.'">'.__('Show Hatebu bookmarked number.', 'DigiPress').'</label></p>';
		// echo '<p><input name="'.$tweetsNumberName.'" id="'.$tweetsNumberId.'" type="checkbox" value="on" '.$tweetsNumberCheck.' />
		// 	 <label for="'.$tweetsNumberId.'">'.__('Show tweets number.', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$likesNumberName.'" id="'.$likesNumberId.'" type="checkbox" value="on" '.$likesNumberCheck.' />
			 <label for="'.$likesNumberId.'">'.__('Show Facebook likes number.', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$randomName.'" id="'.$randomId.'" type="checkbox" value="on" '.$randomCheck.' />
			 <label for="'.$randomId.'">'.__('Random','DigiPress').'</label></p>';
		echo '<p><label for="'.$more_text_id.'">'.__('More label','DigiPress').':</label><br /><input type="text" name="'.$more_text_name.'" id="'.$more_text_id.'" value="'.$more_text.'" style="width:100%;" /></p>';
		echo '<p><label for="'.$catId.'">'.__('Target Category(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$catName.'" id="'.$catId.'" value="'.$cat.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Note: Multiple categories are available.(ex. 2,4,12)', 'DigiPress').'</span></p>';
	}

	// Save Function
	// $new_instance : Input value
	// $old_instance : Exist value
	// Return : New values
	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['number']		= $new_instance['number'];
		$instance['thumbnail']	= $new_instance['thumbnail'];
		$instance['comment']	= $new_instance['comment'];
		$instance['views']		= $new_instance['views'];
		$instance['cat']		= $new_instance['cat'];
		$instance['hatebuNumber']	= $new_instance['hatebuNumber'];
		$instance['tweetsNumber']	= $new_instance['tweetsNumber'];
		$instance['likesNumber']	= $new_instance['likesNumber'];
		$instance['random']		= $new_instance['random'];
		$instance['pub_date']	= $new_instance['pub_date'];
		$instance['more_text']	= $new_instance['more_text'];

		// Check errors
		if (!$instance['title']) {
			$before_title 	= '';
			$after_title	= '';
			/*$instance['title'] = strip_tags($old_instance['title']);
			$this->m_error = '<span style="color:#ff0000;">'.__('The title is blank. It will be reset to old value.', 'DigiPress').'</span>';*/
		}
		return $instance;
	}

	// Display to theme
	// $args : output array
	// $instance : exist array
	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' => '',
														  'number' => 5, 
														  'thumbnail' => true,
														  'comment'	=> false,
														  'views'	=> false,
														  'cat'		=> null,
														  'random'		=> false,
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false,
														  'more_text'	=> 'More'));
		
		$title = $instance['title'];
		$title = apply_filters('widget_title', $title);
		$number = $instance['number'];
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$cat		= $instance['cat'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$order_by	= $instance['random'] ? 'rand': 'post_date';
		$pub_date 	= $instance['pub_date'];
		$more_text 	= $instance['more_text'];

		// Display widget
		echo $before_widget;
		if ($instance['title']) {
			echo $before_title.$title.$after_title;
		}
		
		DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'comment'	=> $comment,
					'views' 	=> $views,
					'thumbnail'	=> $thumbnail,
					'cat_id'	=> str_replace("\s", "", $cat),
					'hatebuNumber'	=> $hatebuNumber,
					'tweetsNumber'	=> $tweetsNumber,
					'likesNumber'	=> $likesNumber,
					'order_by'	=> $order_by,
					'pub_date'	=> $pub_date,
					'more_text'	=> $more_text,
					'type'		=> 'recent'
					)
		);
		echo $after_widget;
	}
}
// widgets_init
add_action('widgets_init', create_function('', 'return register_widget("DP_RecentPosts_Widget");'));


/*******************************************************
* Recent Custom Post Type's post widget
*******************************************************/
class DP_RecentCustomPosts_Widget extends WP_Widget {
	function DP_RecentCustomPosts_Widget() {
		$widget_opts = array('classname' => 'dp_recent_custom_posts_widget', 
							 'description' => __('Recent Posts in specific Custom Post Type widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPRecentCustomPostsWidget', __('Recent post in Custom Post Type', 'DigiPress'), $widget_opts, $control_opts);
	}

	// Input widget form in Admin panel.
	function form($instance) {
		// default value
		$instance = wp_parse_args((array)$instance, array('title'		=> __('News','DigiPress'), 
														  'target'		=> '',
														  'number'		=> 5,
														  'random'		=> false,
														  'views'		=> false,
														  'pub_date'	=> 'show',
														  'thumbnail'	=> true,
														  'meta_key' 	=> 'post_views_count',
														  'ranking'		=> false,
														  'more_text'	=> 'More'));
		$term_code = '';
		$form_post_type_code = '';
		$form_code = '';

		// get values
		$title		= strip_tags($instance['title']);
		$target		= $instance['target'];	
		$number		= $instance['number'];
		$pub_date	= $instance['pub_date'];	
		$thumbnail	= $instance['thumbnail'];
		$random		= $instance['random'];
		$more_text 	= $instance['more_text'];
		$views 		= $instance['views'];
		$meta_key 	= $instance['meta_key'];
		$ranking 	= $instance['ranking'];

		$titlename			= $this->get_field_name('title');
		$titleid			= $this->get_field_id('title');
		$target_name		= $this->get_field_name('target');
		$target_id			= $this->get_field_id('target');
		$numbername			= $this->get_field_name('number');
		$numberid			= $this->get_field_id('number');
		$pub_date_name		= $this->get_field_name('pub_date');
		$pub_date_id		= $this->get_field_id('pub_date');
		$thumbnailname		= $this->get_field_name('thumbnail');
		$thumbnailid		= $this->get_field_id('thumbnail');
		$randomName			= $this->get_field_name('random');
		$randomId			= $this->get_field_id('random');
		$more_text_name		= $this->get_field_name('more_text');
		$more_text_td		= $this->get_field_id('more_text');
		$views_name			= $this->get_field_name('views');
		$views_id			= $this->get_field_id('views');
		$meta_key_name		= $this->get_field_name('meta_key');
		$meta_key_td		= $this->get_field_id('meta_key');
		$ranking_name		= $this->get_field_name('ranking');
		$ranking_id			= $this->get_field_id('ranking');

		$pub_dateCheck;
		if ($pub_date === 'show') $pub_dateCheck = 'checked';
		$thumbeCheck;
		if ($thumbnail) $thumbeCheck = 'checked';
		$randomCheck;
		if ($random) $randomCheck = 'checked';
		$views_check;
		if ($views) $views_check = 'checked';

		// Post type
		$post_types = get_post_types(
								array(
									'public'	=> true,
									'_builtin'	=> false),
									'objects'
									);
		foreach ($post_types as $post_type ) {
			if ($target === $post_type->name) {
				$form_post_type_code .= '<option value="' . $post_type->name . '" selected="selected">' . $post_type->label . '</option>';
			} else {
				$form_post_type_code .= '<option value="' . $post_type->name . '">' . $post_type->label . '</option>';
			}
		}
		$form_post_type_code = '<select name="'.$target_name.'" id="'.$target_id.'">'.$form_post_type_code.'</select>';


		// Show form
		$form_code = '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		$form_code .= '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';

		$form_code .= '<div style="margin-bottom:8px;"><div style="padding-bottom:6px;">'.__('Target Custom Post Type:', 'DigiPress') . '</div>'.$form_post_type_code.'</div>';

		// Do the custom function
		$term_code = apply_filters( 'dp_custom_post_widget_form', 
			array(
				'custom',
				$meta_key, 
				$meta_key_name, 
				$meta_key_id,
				$ranking,
				$ranking_name,
				$ranking_id)
			);
		if (is_string($term_code)) {
			$form_code .= $term_code;
		}

		$form_code .= '<p><label for="'.$numberid.'">'.__('Number to display','DigiPress').':</label>
			 <input type="text" name="'.$numbername.'" id="'.$numberid.'" value="'.$number.'" style="width:60px;" /></p>';
		$form_code .= '<p><input name="'.$pub_date_name.'" id="'.$pub_date_id.'" type="checkbox" value="show" '.$pub_dateCheck.' /> <label for="'.$pub_date_id.'">'.__('Show date','DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$thumbnailname.'" id="'.$thumbnailid.'" type="checkbox" value="on" '.$thumbeCheck.' /> <label for="'.$thumbnailid.'">'.__('Show Thumbnail','DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$views_name.'" id="'.$views_id.'" type="checkbox" value="on" '.$views_check.' /> <label for="'.$views_id.'">'.__('Show views.', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$randomName.'" id="'.$randomId.'" type="checkbox" value="on" '.$randomCheck.' /> <label for="'.$randomId.'">'.__('Random','DigiPress').'</label></p>';
		$form_code .= '<p><label for="'.$more_text_id.'">'.__('More label','DigiPress').':</label><br /><input type="text" name="'.$more_text_name.'" id="'.$more_text_id.'" value="'.$more_text.'" style="width:100%;" /></p>';
		// Display
		echo $form_code;
	}

	// Save Function
	// $new_instance : Input value
	// $old_instance : Exist value
	// Return : New values
	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['target']		= $new_instance['target'];
		$instance['number']		= $new_instance['number'];
		$instance['pub_date']	= $new_instance['pub_date'];
		$instance['thumbnail']	= $new_instance['thumbnail'];
		$instance['random']		= $new_instance['random'];
		$instance['more_text']	= $new_instance['more_text'];
		$instance['views']		= $new_instance['views'];
		$instance['meta_key']	= $new_instance['meta_key'];
		$instance['ranking']	= $new_instance['ranking'];

		// Check errors
		if (!$instance['title']) {
			$before_title 	= '';
			$after_title	= '';
			/*$instance['title'] = strip_tags($old_instance['title']);
			$this->m_error = '<span style="color:#ff0000;">'.__('The title is blank. It will be reset to old value.', 'DigiPress').'</span>';*/
		}
		return $instance;
	}

	// Display to theme
	// $args : output array
	// $instance : exist array
	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' 		=> '',
														  'target'		=> '',
														  'number' 		=> 5,
														  'meta_key' 	=> 'post_views_count',
														  'pub_date'	=> 'show',
														  'thumbnail' 	=> true,
														  'views'		=> false,
														  'random'		=> false,
														  'ranking'		=> false,
														  'more_text'	=> 'More'));
		
		$title = $instance['title'];
		$title = apply_filters('widget_title', $title);
		$target = $instance['target'];
		$number = $instance['number'];
		$pub_date 	= $instance['pub_date'];
		$thumbnail	= $instance['thumbnail'];
		$random		= $instance['random'];
		$more_text	= $instance['more_text'];
		$views		= $instance['views'];
		$meta_key	= $instance['meta_key'];
		$ranking	= $instance['ranking'];

		// Sort order
		$order_by = '';
		if ((bool)$instance['random']) {
			$order_by = 'rand';
			$meta_key = null;
		} else {
			if ((bool)$ranking) {
				$order_by = 'meta_value_num';
			} else{
				$ordder_by = '';
				$meta_key = null;
			}
		}

		// Display widget
		echo $before_widget;
		if ($instance['title']) {
			echo $before_title.$title.$after_title;
		}

		DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'thumbnail'	=> $thumbnail,
					'post_type'	=> $target,
					'pub_date'	=> $pub_date,
					'order_by'	=> $order_by,
					'views' 	=> $views,
					'more_text'	=> $more_text,
					'meta_key'	=> $meta_key,
					'type'		=> 'custom'
					)
		);
		echo $after_widget;
	}
}
// widgets_init
add_action('widgets_init', create_function('', 'return register_widget("DP_RecentCustomPosts_Widget");'));




/*******************************************************
* Most Views Posts widget
*******************************************************/
class DP_Most_Viewed_Posts_Widget extends WP_Widget {
	function DP_Most_Viewed_Posts_Widget() {
		$widget_opts = array('classname' => 'dp_recent_posts_widget', 
							 'description' => __('Most Viewed Posts widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPMostViewedPostsWidget', __('Most Viewed Posts Widget', 'DigiPress'), $widget_opts, $control_opts);
	}

	// Input widget form in Admin panel.
	function form($instance) {
		// default value
		$instance = wp_parse_args((array)$instance, array('title' => __('Most Viewed Posts','DigiPress'), 
														  'number' => 5,
														  'meta_key' => 'post_views_count',
														  'thumbnail' => true,
														  'comment'	=> false,
														  'views'	=> true,
														  'year'	=> '',
														  'month'	=> '',
														  'cat'		=> '',
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false));
		$form_code = '';
		$term_code = '';

		// get values
		$title		= strip_tags($instance['title']);
		$number		= $instance['number'];	
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$year		= $instance['year'];
		$month		= $instance['month'];
		$cat		= $instance['cat'];
		$pub_date	= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$meta_key 	= $instance['meta_key'];
		$reset_weekday 	= $instance['reset_weekday'];

		$titlename	= $this->get_field_name('title');
		$titleid	= $this->get_field_id('title');
		$numbername	= $this->get_field_name('number');
		$numberid	= $this->get_field_id('number');
		$thumbnailname	= $this->get_field_name('thumbnail');
		$thumbnailid	= $this->get_field_id('thumbnail');
		$commentName	= $this->get_field_name('comment');
		$commentId		= $this->get_field_id('comment');
		$viewsName		= $this->get_field_name('views');
		$viewsId		= $this->get_field_id('views');
		$yearName		= $this->get_field_name('year');
		$yearId			= $this->get_field_id('year');
		$monthName		= $this->get_field_name('month');
		$monthId		= $this->get_field_id('month');
		$catName		= $this->get_field_name('cat');
		$catId			= $this->get_field_id('cat');
		$pub_date_name	= $this->get_field_name('pub_date');
		$pub_date_id	= $this->get_field_id('pub_date');
		$hatebuNumberName	= $this->get_field_name('hatebuNumber');
		$tweetsNumberName	= $this->get_field_name('tweetsNumber');
		$likesNumberName	= $this->get_field_name('likesNumber');
		$hatebuNumberId = $this->get_field_id('hatebuNumber');
		$tweetsNumberId = $this->get_field_id('tweetsNumber');
		$likesNumberId = $this->get_field_id('likesNumber');
		$meta_key_name	= $this->get_field_name('meta_key');
		$meta_key_id		= $this->get_field_id('meta_key');


		$thumbeCheck;
		if ($thumbnail) $thumbeCheck = 'checked';
		
		$commentCheck;
		if ($comment) $commentCheck = 'checked';
		
		$viewsCheck;
		if ($views) $viewsCheck = 'checked';
		
		$pub_dateCheck;
		if ($pub_date === 'show') $pub_dateCheck = 'checked';

		$hatebuNumberCheck;
		if ($hatebuNumber) $hatebuNumberCheck = 'checked';

		$tweetsNumberCheck;
		if ($tweetsNumber) $tweetsNumberCheck = 'checked';

		$likesNumberCheck;
		if ($likesNumber) $likesNumberCheck = 'checked';

		// Show form
		$form_code = '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		$form_code .= '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';
		
		// Do the custom function
		$term_code = apply_filters( 'dp_most_viewed_widget_form', 
			array(
				'post',
				$meta_key, 
				$meta_key_name, 
				$meta_key_id)
			);
		if (is_string($term_code)) {
			$form_code .= $term_code;
		}

		$form_code .= '<p><label for="'.$numberid.'">'.__('Number to display','DigiPress').':</label>
			 <input type="text" name="'.$numbername.'" id="'.$numberid.'" value="'.$number.'" style="width:60px;" /></p>';
		$form_code .= '<p><input name="'.$pub_date_name.'" id="'.$pub_date_id.'" type="checkbox" value="show" '.$pub_dateCheck.' />
			 <label for="'.$pub_date_id.'">'.__('Show date','DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$thumbnailname.'" id="'.$thumbnailid.'" type="checkbox" value="on" '.$thumbeCheck.' />
			 <label for="'.$thumbnailid.'">'.__('Show Thumbnail','DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$commentName.'" id="'.$commentId.'" type="checkbox" value="on" '.$commentCheck.' />
			 <label for="'.$commentId.'">'.__('Show the number of comment(s).', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$viewsName.'" id="'.$viewsId.'" type="checkbox" value="on" '.$viewsCheck.' />
			 <label for="'.$viewsId.'">'.__('Show views.', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$hatebuNumberName.'" id="'.$hatebuNumberId.'" type="checkbox" value="on" '.$hatebuNumberCheck.' />
			 <label for="'.$hatebuNumberId.'">'.__('Show Hatebu bookmarked number.', 'DigiPress').'</label></p>';
		// $form_code .= '<p><input name="'.$tweetsNumberName.'" id="'.$tweetsNumberId.'" type="checkbox" value="on" '.$tweetsNumberCheck.' />
		// 	 <label for="'.$tweetsNumberId.'">'.__('Show tweets number.', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$likesNumberName.'" id="'.$likesNumberId.'" type="checkbox" value="on" '.$likesNumberCheck.' />
			 <label for="'.$likesNumberId.'">'.__('Show Facebook likes number.', 'DigiPress').'</label></p>';
		$form_code .= '<p><label for="'.$yearId.'">'.__('Target Year(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$yearName.'" id="'.$yearId.'" value="'.$year.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Ex: 2013', 'DigiPress').'</span></p>';
		$form_code .= '<p><label for="'.$monthId.'">'.__('Target Month(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$monthName.'" id="'.$monthId.'" value="'.$month.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Note: Insert 1 to 12.', 'DigiPress').'</span></p>';
		$form_code .= '<p><label for="'.$catId.'">'.__('Target Category(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$catName.'" id="'.$catId.'" value="'.$cat.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Note: Multiple categories are available.(ex. 2,4,12)', 'DigiPress').'</span></p>';

		// Display
		echo $form_code;
	}


	// Save Function
	// $new_instance : Input value
	// $old_instance : Exist value
	// Return : New values
	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['number']		= $new_instance['number'];
		$instance['thumbnail']	= $new_instance['thumbnail'];
		$instance['comment']	= $new_instance['comment'];
		$instance['views']		= $new_instance['views'];
		$instance['year']		= $new_instance['year'];
		$instance['month']		= $new_instance['month'];
		$instance['cat']		= $new_instance['cat'];
		$instance['pub_date']	= $new_instance['pub_date'];
		$instance['hatebuNumber']	= $new_instance['hatebuNumber'];
		$instance['tweetsNumber']	= $new_instance['tweetsNumber'];
		$instance['likesNumber']	= $new_instance['likesNumber'];
		$instance['meta_key']	= $new_instance['meta_key'];

		// Check errors
		if (!$instance['title']) {
			$before_title 	= '';
			$after_title	= '';
			/*$instance['title'] = strip_tags($old_instance['title']);
			$this->m_error = '<span style="color:#ff0000;">'.__('The title is blank. It will be reset to old value.', 'DigiPress').'</span>';*/
		}
		return $instance;
	}

	// Display to theme
	// $args : output array
	// $instance : exist array
	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' => '',
														  'number' => 5,
														  'meta_key' => 'post_views_count',
														  'thumbnail' => true,
														  'comment'	=> false,
														  'views'	=> true,
														  'year'	=> '',
														  'month'	=> '',
														  'cat'		=> '',
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false));
		
		$title = $instance['title'];
		$title = apply_filters('widget_title', $title);
		$number = $instance['number'];
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$year		= $instance['year'];
		$month		= $instance['month'];
		$cat		= $instance['cat'];
		$pub_date	= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$meta_key 	= $instance['meta_key'] ? $instance['meta_key'] : 'post_views_count';

		// Display
		echo $before_widget;
		if ($instance['title']) {
			echo $before_title.$title.$after_title;
		}

		DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'comment'	=> $comment,
					'views' 	=> $views,
					'thumbnail'	=> $thumbnail,
					'hatebuNumber'	=> $hatebuNumber,
					'tweetsNumber'	=> $tweetsNumber,
					'likesNumber'	=> $likesNumber,
					'cat_id'	=> str_replace("\s", "", $cat),
					'year'		=> $year,
					'month'		=> $month,
					'pub_date'	=> $pub_date,
					'meta_key'	=> $meta_key,
					'order_by'	=> 'meta_value_num'
					)
		);
		echo $after_widget;
	}
}
// widgets_init
add_action('widgets_init', create_function('', 'return register_widget("DP_Most_Viewed_Posts_Widget");'));



/*******************************************************
* Most Commented Posts widget
*******************************************************/
class DP_MostCommentedPosts_Widget extends WP_Widget {
	function DP_MostCommentedPosts_Widget() {
		$widget_opts = array('classname' => 'dp_recent_posts_widget', 
							 'description' => __('Most Commented Posts widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPMostCommentedPostsWidget', __('Most Commented Posts Widget', 'DigiPress'), $widget_opts, $control_opts);
	}

	// Input widget form in Admin panel.
	function form($instance) {
		// default value
		$instance = wp_parse_args((array)$instance, array('title' => __('Most Commented Posts','DigiPress'), 
														  'number' => 5,
														  'thumbnail' => true,
														  'comment'	=> true,
														  'views'	=> false,
														  'year'	=> '',
														  'month'	=> '',
														  'cat'		=> '',
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false));

		// get values
		$title		= strip_tags($instance['title']);
		$number		= $instance['number'];	
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$year		= $instance['year'];
		$month		= $instance['month'];
		$cat		= $instance['cat'];
		$pub_date		= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];


		$titlename	= $this->get_field_name('title');
		$titleid	= $this->get_field_id('title');
		$numbername	= $this->get_field_name('number');
		$numberid	= $this->get_field_id('number');
		$thumbnailname	= $this->get_field_name('thumbnail');
		$thumbnailid	= $this->get_field_id('thumbnail');
		$commentName	= $this->get_field_name('comment');
		$commentId		= $this->get_field_id('comment');
		$viewsName		= $this->get_field_name('views');
		$viewsId		= $this->get_field_id('views');
		$yearName		= $this->get_field_name('year');
		$yearId			= $this->get_field_id('year');
		$monthName		= $this->get_field_name('month');
		$monthId		= $this->get_field_id('month');
		$catName		= $this->get_field_name('cat');
		$catId			= $this->get_field_id('cat');
		$pub_date_name	= $this->get_field_name('pub_date');
		$pub_date_id	= $this->get_field_id('pub_date');
		$hatebuNumberName	= $this->get_field_name('hatebuNumber');
		$tweetsNumberName	= $this->get_field_name('tweetsNumber');
		$likesNumberName	= $this->get_field_name('likesNumber');
		$hatebuNumberId = $this->get_field_id('hatebuNumber');
		$tweetsNumberId = $this->get_field_id('tweetsNumber');
		$likesNumberId = $this->get_field_id('likesNumber');

		$thumbeCheck;
		if ($thumbnail) $thumbeCheck = 'checked';
		
		$commentCheck;
		if ($comment) $commentCheck = 'checked';
		
		$viewsCheck;
		if ($views) $viewsCheck = 'checked';

		$pub_dateCheck;
		if ($pub_date === 'show') $pub_dateCheck = 'checked';
		
		$hatebuNumberCheck;
		if ($hatebuNumber) $hatebuNumberCheck = 'checked';

		$tweetsNumberCheck;
		if ($tweetsNumber) $tweetsNumberCheck = 'checked';

		$likesNumberCheck;
		if ($likesNumber) $likesNumberCheck = 'checked';

		// Show form
		echo '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		echo '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';
		echo '<p><label for="'.$numberid.'">'.__('Number to display','DigiPress').':</label>
			 <input type="text" name="'.$numbername.'" id="'.$numberid.'" value="'.$number.'" style="width:60px;" /></p>';
		echo '<p><input name="'.$pub_date_name.'" id="'.$pub_date_id.'" type="checkbox" value="show" '.$pub_dateCheck.' />
			 <label for="'.$pub_date_id.'">'.__('Show date','DigiPress').'</label></p>';
		echo '<p><input name="'.$thumbnailname.'" id="'.$thumbnailid.'" type="checkbox" value="on" '.$thumbeCheck.' />
			 <label for="'.$thumbnailid.'">'.__('Show Thumbnail','DigiPress').'</label></p>';
		echo '<p><input name="'.$commentName.'" id="'.$commentId.'" type="checkbox" value="on" '.$commentCheck.' />
			 <label for="'.$commentId.'">'.__('Show the number of comment(s).', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$viewsName.'" id="'.$viewsId.'" type="checkbox" value="on" '.$viewsCheck.' />
			 <label for="'.$viewsId.'">'.__('Show views.', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$hatebuNumberName.'" id="'.$hatebuNumberId.'" type="checkbox" value="on" '.$hatebuNumberCheck.' />
			 <label for="'.$hatebuNumberId.'">'.__('Show Hatebu bookmarked number.', 'DigiPress').'</label></p>';
		// echo '<p><input name="'.$tweetsNumberName.'" id="'.$tweetsNumberId.'" type="checkbox" value="on" '.$tweetsNumberCheck.' />
		// 	 <label for="'.$tweetsNumberId.'">'.__('Show tweets number.', 'DigiPress').'</label></p>';
		echo '<p><input name="'.$likesNumberName.'" id="'.$likesNumberId.'" type="checkbox" value="on" '.$likesNumberCheck.' />
			 <label for="'.$likesNumberId.'">'.__('Show Facebook likes number.', 'DigiPress').'</label></p>';
		echo '<p><label for="'.$yearId.'">'.__('Target Year(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$yearName.'" id="'.$yearId.'" value="'.$year.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Ex: 2013', 'DigiPress').'</span></p>';
		echo '<p><label for="'.$monthId.'">'.__('Target Month(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$monthName.'" id="'.$monthId.'" value="'.$month.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Note: Insert 1 to 12.', 'DigiPress').'</span></p>';
		echo '<p><label for="'.$catId.'">'.__('Target Category(Optional)','DigiPress').':</label><br />
			 <input type="text" name="'.$catName.'" id="'.$catId.'" value="'.$cat.'" style="width:100%;" /><br />
			 <span style="font-size:11px;">'.__('*Note: Multiple categories are available.(ex. 2,4,12)', 'DigiPress').'</span></p>';
	}

	// Save Function
	// $new_instance : Input value
	// $old_instance : Exist value
	// Return : New values
	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['number']		= $new_instance['number'];
		$instance['thumbnail']	= $new_instance['thumbnail'];
		$instance['comment']	= $new_instance['comment'];
		$instance['views']		= $new_instance['views'];
		$instance['year']		= $new_instance['year'];
		$instance['month']		= $new_instance['month'];
		$instance['cat']		= $new_instance['cat'];
		$instance['pub_date']	= $new_instance['pub_date'];
		$instance['hatebuNumber']	= $new_instance['hatebuNumber'];
		$instance['tweetsNumber']	= $new_instance['tweetsNumber'];
		$instance['likesNumber']	= $new_instance['likesNumber'];

		// Check errors
		if (!$instance['title']) {
			$before_title 	= '';
			$after_title	= '';
			/*$instance['title'] = strip_tags($old_instance['title']);
			$this->m_error = '<span style="color:#ff0000;">'.__('The title is blank. It will be reset to old value.', 'DigiPress').'</span>';*/
		}
		return $instance;
	}

	// Display to theme
	// $args : output array
	// $instance : exist array
	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' => '',
														  'number' => 5, 
														  'thumbnail' => true,
														  'comment'	=> true,
														  'views'	=> false,
														  'year'	=> '',
														  'month'	=> '',
														  'cat'		=> '',
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false));
		
		$title = $instance['title'];
		$title = apply_filters('widget_title', $title);
		$number = $instance['number'];
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$year		= $instance['year'];
		$month		= $instance['month'];
		$cat		= $instance['cat'];
		$pub_date	= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		
		echo $before_widget;
		if ($instance['title']) {
			echo $before_title.$title.$after_title;
		}

		DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'comment'	=> $comment,
					'views' 	=> $views,
					'thumbnail'	=> $thumbnail,
					'cat_id'	=> str_replace("\s", "", $cat),
					'year'		=> $year,
					'month'		=> $month,
					'pub_date'	=> $pub_date,
					'order_by'	=> 'comment_count',
					'hatebuNumber' 	=> $hatebuNumber,
					'tweetsNumber' 	=> $tweetsNumber,
					'likesNumber' 	=> $likesNumber
					)
		);
		echo $after_widget;
	}
}
// widgets_init
add_action('widgets_init', create_function('', 'return register_widget("DP_MostCommentedPosts_Widget");'));


/*******************************************************
* Original Custom Text widget
*******************************************************/
class DP_Custom_Text_Widget extends WP_Widget {
	function DP_Custom_Text_Widget() {
		$widget_opts = array('classname' => 'dp_custom_text_widget', 
							 'description' => __('Enhanced Custom Text Widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 400, 'height' => 350);
		$this->__construct('DPCustomTextWidget', __('Custom Text Widget','DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('title' => '', 
														  'contents' => '',
														  'scrollFix' => false));

		$title		= strip_tags($instance['title']);
		$contents	= stripslashes($instance['contents']);
		$scrollFix	= $instance['scrollFix'];

		$titlename	= $this->get_field_name('title');
		$titleid	= $this->get_field_id('title');
		$contentsname	= $this->get_field_name('contents');
		$contentsid	= $this->get_field_id('contents');
		$scrollFixname	= $this->get_field_name('scrollFix');
		$scrollFixid	= $this->get_field_id('scrollFix');

		$scrollFixcheck;
		if ($scrollFix) $scrollFixcheck = 'checked';

		echo '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		echo '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';
		echo '<div><textarea name="'.$contentsname.'" cols="20" rows="16" style="width:100%;">'.$contents.'</textarea></div>';
		echo '<p><input name="'.$scrollFixname.'" id="'.$scrollFixid.'" type="checkbox" value="on" '.$scrollFixcheck.' />
			 <label for="'.$scrollFixid.'">'.__('Fix position when sidebar is blank by scrolling','DigiPress').'</label><br /><span style="font-size:11px;color:red;">'.__('*Note : This option is available at only one widget.','DigiPress').'</span></p>';
	}

	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['contents']	= $new_instance['contents'];
		$instance['scrollFix']	= $new_instance['scrollFix'];

		if (!$instance['contents']) {
			$instance['contents'] = stripslashes($old_instance['contents']);
			$this->m_error = '<span style="color:#ff0000;">'.__('The title is blank. It will be reset to old value.', 'DigiPress').'</span>';
		}
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title' => '', 
														  'contents' => '',
														  'scrollFix' => false));

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title);
		// Source
		$contents = stripslashes($instance['contents']);
		$scrollFix	= $instance['scrollFix'];
		
		$myDiv = $scrollFix ? '<div id="dp_fix_widget" class="dp_text_widget">' : '<div class="dp_text_widget">';

		echo $before_widget;
		
		if ($instance['title']) {
			echo $before_title.$title.$after_title;
		}

		// Filter hook
		$contents = apply_filters( 'dp_widget_text', empty( $instance['contents'] ) ? '' : $instance['contents'], $instance );

		echo $myDiv.$contents."</div>";
		echo $after_widget;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Custom_Text_Widget");'));


/*******************************************************
* Custom Social widget
*******************************************************/
class DP_Custom_Social_Widget extends WP_Widget {
	function DP_Custom_Social_Widget() {
		$widget_opts = array('classname' => 'dp_cusotom_social_widget', 
							 'description' => __('Site feed and SNS link widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPCustomSocialWidget', __('Custom Subscribe Link', 'DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('title' => 'Subscribe / Share', 
														  'rss' => true,
														  'to_feedly' => true,
														  'twitter' => '',
														  'facebook' => '',
														  'gplus'	=> '',
														  'instagram' => '',
														  'pinterest' => '',
														  'youtube'	=> ''));

		$title		= strip_tags($instance['title']);
		$rss		= $instance['rss'];
		$to_feedly	= $instance['to_feedly'];
		$twitter	= strip_tags($instance['twitter']);
		$facebook	= strip_tags($instance['facebook']);
		$gplus		= strip_tags($instance['gplus']);
		$instagram	= strip_tags($instance['instagram']);
		$youtube	= strip_tags($instance['youtube']);
		$pinterest	= strip_tags($instance['pinterest']);

		$titlename		= $this->get_field_name('title');
		$titleid		= $this->get_field_id('title');
		$rssname		= $this->get_field_name('rss');
		$rssid			= $this->get_field_id('rss');
		$to_feedly_name	= $this->get_field_name('to_feedly');
		$to_feedly_id	= $this->get_field_id('to_feedly');
		$twittername	= $this->get_field_name('twitter');
		$twitterid		= $this->get_field_id('twitter');
		$facebookname	= $this->get_field_name('facebook');
		$facebookid		= $this->get_field_id('facebook');
		$gplusname		= $this->get_field_name('gplus');
		$gplusid		= $this->get_field_id('gplus');
		$instagramname	= $this->get_field_name('instagram');
		$instagramid	= $this->get_field_id('instagram');
		$youtubename	= $this->get_field_name('youtube');
		$youtubeid		= $this->get_field_id('youtube');
		$pinterestname	= $this->get_field_name('pinterest');
		$pinterestid	= $this->get_field_id('pinterest');

		$rsscheck;
		if ($rss) $rsscheck = 'checked';
		$to_feedly_check;
		if ($to_feedly) $to_feedly_check = 'checked';

		$code = '';

		$code = '<p><label for="'.$titleid.'">'.__('Title','DigiPress').':</label><br />';
		$code .= '<input type="text" name="'.$titlename.'" id="'.$titleid.'" value="'.$title.'" style="width:100%;" /></p>';
		$code .= '<p><span style="margin-left:4px;"><input name="'.$rssname.'" id="'.$rssid.'" type="checkbox" value="on" '.$rsscheck.' style="padding-bottom:12px;" />
			 <label for="'.$rssid.'">'.__('Show RSS Icon','DigiPress').'</label></span><br />';
		$code .= '<span style="margin-left:12px;">└ <input name="'.$to_feedly_name.'" id="'.$to_feedly_id.'" type="checkbox" value="true" '.$to_feedly_check.' />
			 <label for="'.$to_feedly_id.'">'.__('Redirect to feedly','DigiPress').'</label></span></p>';

		$code .= '<p><label for="'.$twitterid.'">'.__('Twitter URL','DigiPress').' :</label><br /><input type="text" name="'.$twittername.'" id="'.$twitterid.'" value="'.$twitter.'" style="width:100%;" /></p>';
		$code .= '<p><label for="'.$facebookid.'">'.__('Facebook URL','DigiPress').' :</label><br /><input type="text" name="'.$facebookname.'" id="'.$facebookid.'" value="'.$facebook.'" style="width:100%;" /></p>';
		$code .= '<p><label for="'.$gplusid.'">'.__('Google+ URL','DigiPress').' :</label><br /><input type="text" name="'.$gplusname.'" id="'.$gplusid.'" value="'.$gplus.'" style="width:100%;" /></p>';
		$code .= '<p><label for="'.$instagramid.'">'.__('Instagram URL','DigiPress').' :</label><br /><input type="text" name="'.$instagramname.'" id="'.$instagramid.'" value="'.$instagram.'" style="width:100%;" /></p>';
		$code .= '<p><label for="'.$youtubeid.'">'.__('YouTube URL','DigiPress').' :</label><br /><input type="text" name="'.$youtubename.'" id="'.$youtubeid.'" value="'.$youtube.'" style="width:100%;" /></p>';
		$code .= '<p><label for="'.$pinterestid.'">'.__('Pinterest URL','DigiPress').' :</label><br /><input type="text" name="'.$pinterestname.'" id="'.$pinterestid.'" value="'.$pinterest.'" style="width:100%;" /></p>';

		echo $code;
	}

	function update($new_instance, $old_instance) {
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['rss']		= $new_instance['rss'];
		$instance['to_feedly']	= $new_instance['to_feedly'];
		$instance['twitter']	= $new_instance['twitter'];
		$instance['facebook']	= $new_instance['facebook'];
		$instance['gplus']		= $new_instance['gplus'];
		$instance['instagram']	= $new_instance['instagram'];
		$instance['youtube']	= $new_instance['youtube'];
		$instance['pinterest']	= $new_instance['pinterest'];
		
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, 
									array(
										'title'		=> '', 
										'rss'		=> true, 
										'to_feedly' => true,
										'twitter'	=> '', 
										'facebook'	=> '',
										'gplus'		=> '',
										'instagram' => '',
										'youtube'	=> '',
										'pinterest'	=> '')
									);

		$title		= strip_tags($instance['title']);
		$title		= apply_filters('widget_title', $title);

		$code = '';

		$rss = '';
		if ($instance['rss']) {
			if ($instance['to_feedly']) {
				$rss = '<li><a href="//cloud.feedly.com/#subscription%2Ffeed%2F'.urlencode(get_feed_link()).'" target="blank" title="Follow on feedly"><i class="icon-feedly"></i></a></li>';
			} else {
				$rss = '<li><a href="'
					.get_bloginfo('rss2_url')
					.'" title="'.__('Subscribe feed', 'DigiPress')
					.'" target="_blank"><i class="icon-rss"></i></a></li>';
			}
		}

		$gplus = '';
		if ($instance['gplus']) {
			$gplus = '<li><a href="'
						.$instance['gplus']
						.'" title="Follow on Google+" target="_blank"><i class="icon-gplus"></i></a></li>';
		}

		$twitter = '';
		if ($instance['twitter']) {
			$twitter = '<li><a href="'
						.$instance['twitter']
						.'" title="Follow on Twitter" target="_blank"><i class="icon-twitter"></i></a></li>';
		}
		
		$facebook = '';
		if ($instance['facebook']) {
			$facebook = '<li><a href="'
						.$instance['facebook']
						.'" title="Follow on Facebook" target="_blank"><i class="icon-facebook"></i></a></li>';
		}

		$instagram = '';
		if ($instance['instagram']) {
			$instagram = '<li><a href="'
						.$instance['instagram']
						.'" title="Follow on Instagram" target="_blank"><i class="icon-instagram"></i></a></li>';
		}

		$youtube = '';
		if ($instance['youtube']) {
			$youtube = '<li><a href="'
						.$instance['youtube']
						.'" title="Follow on YouTube" target="_blank"><i class="icon-youtube"></i></a></li>';
		}
		$pinterest = '';
		if ($instance['pinterest']) {
			$pinterest = '<li><a href="'
						.$instance['pinterest']
						.'" title="Follow on Pinterest" target="_blank"><i class="icon-pinterest"></i></a></li>';
		}
		
		// show widget
		$code = $before_widget;
		$code .= $before_title.$title.$after_title;
		$code .= '<ul class="dp_feed_widget clearfix">'.$facebook.$twitter.$gplus.$youtube.$instagram.$pinterest.$rss.'</ul>';
		$code .= $after_widget;

		echo $code;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Custom_Social_Widget");'));


/*******************************************************
* Twitter Follow widget
*******************************************************/
class DP_Twitter_Follow_Widget extends WP_Widget {
	function DP_Twitter_Follow_Widget() {
		$widget_opts = array('classname' => 'dp_twitter_follow_widget', 
							 'description' => __('Twitter follow button widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPTwitterFollowWidget', __('Twitter Follow Button', 'DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('user' => '',
														  'size' => 'normal'));

		$user	= $instance['user'];
		$size		= $instance['size'];

		$user_name		= $this->get_field_name('user');
		$user_id		= $this->get_field_id('user');
		$size_name		= $this->get_field_name('size');
		$size_id		= $this->get_field_id('size');
		
		$size_check;
		if ($size === 'large') $size_check = 'checked';

		echo '<p><label for="'.$user_id.'">'.__('User ID', 'DigiPress').':</label><br />';
		echo '<input type="text" name="'.$user_name.'" id="'.$user_id.'" value="'.$user.'" style="width:100%;" /><br />' . __('*Note : Specify your twitter user_id(not user _name) that is excluded @(at) mark.', 'DigiPress') . '</p>';
		echo '<p><input name="'.$size_name.'" id="'.$size_id.'" type="checkbox" value="large" '.$size_check.' />
			 <label for="'.$size_id.'">'.__('Large button', 'DigiPress').'</label></p>';
	}

	function update($new_instance, $old_instance) {
		$instance['user']		= $new_instance['user'];
		$instance['size']		= $new_instance['size'];
		
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('user' => '', 'size' => 'normal'));
		
		$code = '';
		if ($instance['user']) {
			 if ($instance['size'] == 'large') {
				$code = $before_widget	. '<a href="https://twitter.com/' . $instance['user'] . '" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @' . $instance['user'] . '</a>' . $after_widget;
			 } else {
			 	$code = $before_widget	. '<a href="https://twitter.com/' . $instance['user'] . '" class="twitter-follow-button" data-show-count="false">Follow @' . $instance['user'] . '</a>' . $after_widget;
			 }
			// show widget
			echo $code;
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Twitter_Follow_Widget");'));



/*******************************************************
* Feedly widget
*******************************************************/
class DP_Feedly_Widget extends WP_Widget {
	function DP_Feedly_Widget() {
		$widget_opts = array('classname' => 'dp_feedly_widget', 
							 'description' => __('Follow on feedly widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPFeedlyWidget', __('Follow on feedly widget', 'DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('type' => 'rectangle-flat-big'));

		$type		= $instance['type'];
		$type_name	= $this->get_field_name('type');
		$type_id	= $this->get_field_id('type');

		switch ($type) {
			case 'rectangle-volume-big':
				$chk1 = 'checked';
				break;
			case 'rectangle-flat-big':
				$chk2 = 'checked';
				break;
			case 'rectangle-volume-medium':
				$chk3 = 'checked';
				break;
			case 'rectangle-flat-medium':
				$chk4 = 'checked';
				break;
			case 'rectangle-volume-small':
				$chk5 = 'checked';
				break;
			case 'rectangle-flat-small':
				$chk6 = 'checked';
				break;
			case 'square-volume':
				$chk7 = 'checked';
				break;
			case 'square-flat-green':
				$chk8 = 'checked';
				break;
			case 'circle-flat-green':
				$chk9 = 'checked';
				break;
			case 'logo-green':
				$chk10 = 'checked';
				break;
			case 'square-flat-black':
				$chk11 = 'checked';
				break;
			case 'circle-flat-black':
				$chk12 = 'checked';
				break;
			case 'logo-black':
				$chk13 = 'checked';
				break;
		}

		echo '<p>'.__('Button design:', 'DigiPress').'</p>';

		echo '<input type="radio" name="'.$type_name.'" value="rectangle-volume-big" id="'.$type_id.'_1" style="position:relative;bottom:24px;" '.$chk1.' /> <label for="'.$type_id.'_1"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-big_2x.png" width="131" height="56" /></label><br />';
		echo '<input type="radio" name="'.$type_name.'" id="'.$type_id.'_2" value="rectangle-flat-big" style="position:relative;bottom:24px;" '.$chk2.' /> <label for="'.$type_id.'_2"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-big_2x.png" width="131" height="56" /></label><br />';
		echo '<span style="margin-right:12px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_3" value="rectangle-volume-medium" style="position:relative;bottom:10px;" '.$chk3.' /> <label for="'.$type_id.'_3"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-medium_2x.png" width="71" height="28" /></label></span>';
		echo '<input type="radio" name="'.$type_name.'" id="'.$type_id.'_4" value="rectangle-flat-medium" style="position:relative;bottom:10px;" '.$chk4.' /> <label for="'.$type_id.'_4"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-medium_2x.png" width="71" height="28" /></label><br />';
		echo '<span style="margin-right:17px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_5" value="rectangle-volume-small" style="position:relative;bottom:6px;" '.$chk5.' /> <label for="'.$type_id.'_5"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-small_2x.png" width="66" height="20" /></label></span>';
		echo '<input type="radio" name="'.$type_name.'" id="'.$type_id.'_6" value="rectangle-flat-small" style="position:relative;bottom:6px;" '.$chk6.' /> <label for="'.$type_id.'_6"><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-small_2x.png" width="66" height="20" /></label><br />';

		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_7" value="square-volume" style="position:relative;bottom:10px;" '.$chk7.' /> <label for="'.$type_id.'_7"><img src="//s3.feedly.com/img/follows/feedly-follow-square-volume_2x.png" width="28" height="28" /></label></span>';
		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_8" value="square-flat-green" style="position:relative;bottom:10px;" '.$chk8.' /> <label for="'.$type_id.'_8"><img src="//s3.feedly.com/img/follows/feedly-follow-square-flat-green_2x.png" width="28" height="28" /></label></span>';
		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_9" value="circle-flat-green" style="position:relative;bottom:10px;" '.$chk9.' /> <label for="'.$type_id.'_9"><img src="//s3.feedly.com/img/follows/feedly-follow-circle-flat-green_2x.png" width="28" height="28" /></label></span>';
		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_10" value="logo-green" style="position:relative;bottom:10px;" '.$chk10.' /> <label for="'.$type_id.'_10"><img src="//s3.feedly.com/img/follows/feedly-follow-logo-green_2x.png" width="28" height="28" /></label></span>';

		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_11" value="square-flat-black" style="position:relative;bottom:10px;" '.$chk11.' /> <label for="'.$type_id.'_11"><img src="//s3.feedly.com/img/follows/feedly-follow-square-flat-black_2x.png" width="28" height="28" /></label></span>';
		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_12" value="circle-flat-black" style="position:relative;bottom:10px;" '.$chk12.' /> <label for="'.$type_id.'_12"><img src="//s3.feedly.com/img/follows/feedly-follow-circle-flat-black_2x.png" width="28" height="28" /></label></span>';
		echo '<span style="margin-right:10px;"><input type="radio" name="'.$type_name.'" id="'.$type_id.'_13" value="logo-black" style="position:relative;bottom:10px;" '.$chk13.' /> <label for="'.$type_id.'_13"><img src="//s3.feedly.com/img/follows/feedly-follow-logo-black_2x.png" width="28" height="28" /></label></span>';
	}

	function update($new_instance, $old_instance) {
		$instance['type']		= $new_instance['type'];
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('type' => ''));
		
		$imgUrl = '';
		if ($instance['type']) {
			switch ($instance['type']) {
				case 'rectangle-volume-big':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-big_2x.png" alt="follow us in feedly" width="131" height="56" />';
					break;
				case 'rectangle-volume-medium':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-medium_2x.png" alt="follow us in feedly" width="71" height="28" />';
					break;
				case 'rectangle-volume-small':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-volume-small_2x.png" alt="follow us in feedly" width="66" height="20" />';
					break;
				case 'square-volume':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-square-volume_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'square-flat-green':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-square-flat-green_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'circle-flat-green':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-circle-flat-green_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'logo-green':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-logo-green_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'square-flat-black':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-square-flat-black_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'circle-flat-black':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-circle-flat-black_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'logo-black':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-logo-black_2x.png" alt="follow us in feedly" width="28" height="28" />';
					break;
				case 'rectangle-flat-big':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-big_2x.png" alt="follow us in feedly" width="131" height="56" />';
					break;
				case 'rectangle-flat-medium':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-medium_2x.png" alt="follow us in feedly" width="71" height="28" />';
					break;
				case 'rectangle-flat-small':
					$imgUrl = '<img id="feedlyFollow" src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-small_2x.png" alt="follow us in feedly" width="66" height="20" />';
					break;
			}

			$code = $before_widget . '<a href="//cloud.feedly.com/#subscription%2Ffeed%2F'.urlencode(get_feed_link()).'" target="blank" title="Follow on feedly">'.$imgUrl.'</a>'. $after_widget;

			// show widget
			echo $code;
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Feedly_Widget");'));



/*******************************************************
* Facebook Like box widget
*******************************************************/
class DP_Facebook_Like_Box_Widget extends WP_Widget {
	function DP_Facebook_Like_Box_Widget() {
		$widget_opts = array('classname' => 'dp_facebook_like_box_widget', 
							 'description' => __('Facebook Page Plugin provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPFacebookLikeBoxWidget', __('DP - Facebook Page Plugin', 'DigiPress'), $widget_opts, $control_opts);
		add_action('wp_enqueue_scripts', array(&$this, 'fbLikeBoxCheck'));
	}

	function fbLikeBoxCheck() {
		global $EXIST_FB_LIKE_BOX;
		if ( is_active_widget(false, false, $this->id_base, true) ) {
			$EXIST_FB_LIKE_BOX = true;
			
		} else {
			$EXIST_FB_LIKE_BOX = false;

		}
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('app_id'		=> '',
														  'url'			=> '',
														  'width' 		=> '',
														  'height' 		=> '',
														  'show_faces' 	=> true,
														  'show_strm'	=> false,
														  'hide_cover'	=> false));

		$app_id		= $instance['app_id'];
		$url		= $instance['url'];
		$width		= $instance['width'];
		$height		= $instance['height'];
		$show_faces	= $instance['show_faces'];
		$show_strm	= $instance['show_strm'];
		$hide_cover = $instance['hide_cover'];
		
		$app_id_name		= $this->get_field_name('app_id');
		$app_id_id			= $this->get_field_id('app_id');
		$url_name			= $this->get_field_name('url');
		$url_id				= $this->get_field_id('url');
		$width_name			= $this->get_field_name('width');
		$width_id			= $this->get_field_id('width');
		$height_name		= $this->get_field_name('height');
		$height_id			= $this->get_field_id('height');
		$show_faces_name	= $this->get_field_name('show_faces');
		$show_faces_id		= $this->get_field_id('show_faces');
		$show_strm_name		= $this->get_field_name('show_strm');
		$show_strm_id		= $this->get_field_id('show_strm');
		$hide_cover_name	= $this->get_field_name('hide_cover');
		$hide_cover_id		= $this->get_field_id('hide_cover');
		
		// Check box
		$show_faces_check = ($show_faces) ? 'checked' : '';
		$show_strm_check = ($show_strm) ? 'checked' : '';
		$hide_cover_check = ($hide_cover) ? 'checked' : '';

		$strTag = '<p><label for="'.$app_id_id.'">'.__('App ID', 'DigiPress').'(*):</label><br />' . 
				  '<input type="text" name="'.$app_id_name.'" id="'.$app_id_id.'" value="'.$app_id.'" style="width:100%;" /><br /><span style="font-size:11px;">' . __('*Note : You need to register as a <a href="https://developers.facebook.com/apps/" target="_blank">Facebook developer</a> bedore you show this widget.', 'DigiPress') . '</span></p>' .
				  '<p><label for="'.$url_id.'">'.__('Facebook Page URL', 'DigiPress').'(*):</label><br />' . 
				  '<input type="text" name="'.$url_name.'" id="'.$url_id.'" value="'.$url.'" style="width:100%;" /></p>' .
				  '<p><label for="'.$width_id.'">'.__('Width', 'DigiPress').':</label><br />' . 
				  '<input type="text" name="'.$width_name.'" id="'.$width_id.'" value="'.$width.'" style="width:60%;" />px<br /><span style="font-size:11px;">'.__('*Note: Default:340px, Range:280px-500px','DigiPress').'</span></p>' .
				  '<p><label for="'.$height_id.'">'.__('Max Height', 'DigiPress').':</label><br />' . 
				  '<input type="text" name="'.$height_name.'" id="'.$height_id.'" value="'.$height.'" style="width:60%;" />px<br /><span style="font-size:11px;">'.__('*Note: Default:500px, Min:130px','DigiPress').'</span></p>' .
				  '<p><input name="'.$show_faces_name.'" id="'.$show_faces_id.'" type="checkbox" value="large" '.$show_faces_check.' /><label for="'.$show_faces_id.'">'.__('Show Face Piles', 'DigiPress').'</label></p>'. 
			 	  '<p><input name="'.$show_strm_name.'" id="'.$show_strm_id.'" type="checkbox" value="large" '.$show_strm_check.' /><label for="'.$show_strm_id.'">'.__('Show Posts from the Page\'s timeline', 'DigiPress').'</label></p>'.
			 	  '<p><input name="'.$hide_cover_name.'" id="'.$hide_cover_id.'" type="checkbox" value="large" '.$hide_cover_check.' /><label for="'.$hide_cover_id.'">'.__('Hide Cover Photo', 'DigiPress').'</label></p>';

		echo $strTag;
	}

	function update($new_instance, $old_instance) {
		$instance['app_id']		= $new_instance['app_id'];
		$instance['url']		= $new_instance['url'];
		$instance['width']		= $new_instance['width'];
		$instance['height']		= $new_instance['height'];
		$instance['show_faces']	= $new_instance['show_faces'];
		$instance['show_strm']	= $new_instance['show_strm'];
		$instance['hide_cover']= $new_instance['hide_cover'];

		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('app_id'		=> '',
														  'url'			=> '',
														  'width' 		=> '',
														  'height' 		=> '',
														  'show_faces' 	=> true,
														  'show_strm'	=> false,
														  'hide_cover'	=> false));
		
		global $FB_APP_ID;
		$code = '';

		if ($instance['app_id'] != '' && $instance['url'] != '') {
			$FB_APP_ID		= $instance['app_id'];
			$url			= $instance['url'];
			$tagWidth 		= ($instance['width'] != '') ? ' data-width="' . $instance['width'] . '"' : '';
			$tagHeight		= ($instance['height'] != '') ? ' data-height="' . $instance['height'] . '"' : '';
			$tagFaces		= ($instance['show_faces']) ? ' data-show-facepile="true"' : ' data-show-facepile="false"';
			$tagStream		= ($instance['show_strm']) ? ' data-show-posts="true"' : ' data-show-posts="false"';
			$tagHideCover		= ($instance['hide_cover']) ? ' data-hide-cover="true"' : ' data-hide-cover="false"';
			
			$code = '<div class="fb-page" data-href="'.$url.'"'.$tagWidth.$tagHeight.$tagFaces.$tagStream.$tagHideCover.'><div class="fb-xfbml-parse-ignore"><blockquote cite="'.$url.'"><a href="'.$url.'">'.get_bloginfo('name').'</a></blockquote></div></div>';
			// show widget
			echo $code;
		}
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Facebook_Like_Box_Widget");'));


/*******************************************************
* Hatena Bookmark popular posts widget
*******************************************************/
class DP_Hatebu_Popular_Posts_Widget extends WP_Widget {
	function DP_Hatebu_Popular_Posts_Widget() {
		$widget_opts = array('classname' => 'dp_hatebu_popular_posts_widget', 
							 'description' => __('Show the lists of opular posts in Hatena bookmark widget provided by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPHatebuPopularPostsWidget', __('Popular posts in Hatena bookmark', 'DigiPress'), $widget_opts, $control_opts);
	}

	function form($instance) {
		$instance = wp_parse_args((array)$instance, array('title'	=> __('Bookmarked Entry', 'DigiPress'),
														  'type'	=> 'count',
														  'width' 	=> '300',
														  'number' 	=> '5',
														  'theme'	=> 'default'));

		$title		= $instance['title'];
		$type		= $instance['type'];
		$width		= $instance['width'];
		$number		= $instance['number'];
		$theme		= $instance['theme'];
		
		$title_name		= $this->get_field_name('title');
		$title_id		= $this->get_field_id('title');
		$type_name		= $this->get_field_name('type');
		$type_id		= $this->get_field_id('type');
		$width_name		= $this->get_field_name('width');
		$width_id		= $this->get_field_id('width');
		$number_name	= $this->get_field_name('number');
		$number_id		= $this->get_field_id('number');
		$theme_name		= $this->get_field_name('theme');
		$theme_id		= $this->get_field_id('theme');
		?>
		
		<p><label for="<?php echo $title_id; ?>"><?php _e('Title', 'DigiPress'); ?>:</label><br />
		<input type="text" name="<?php echo $title_name; ?>" id="<?php echo $title_id; ?>" value="<?php echo $title; ?>" style="width:100%;" /></p>
		<p><label for="<?php echo $type_name; ?>" style="padding-bottom:4px;"><?php _e('Type', 'DigiPress'); ?>:</label><br />
		<input type="radio" name="<?php echo $type_name; ?>" id="<?php echo $type_id; ?>1" value="hot" <?php if ($type == 'hot') echo 'checked'; ?> /><label for="<?php echo $type_id; ?>1" style="margin-right:12px;"> <?php _e('Recent Posts', 'DigiPress'); ?></label>
		<input type="radio" name="<?php echo $type_name; ?>" id="<?php echo $type_id; ?>2" value="count" <?php if($type == 'count') echo 'checked'; ?> /><label for="<?php echo $type_id; ?>2"> <?php _e('Popular Posts', 'DigiPress'); ?></label></p>
		<p><label for="<?php echo $width_id; ?>"><?php _e('Width (pixel)', 'DigiPress'); ?>:</label><br />
		<input type="text" name="<?php echo $width_name; ?>" id="<?php echo $width_id; ?>" value="<?php echo $width; ?>" style="width:100%;" /><br /><span style="font-size:11px;"><?php _e('*Note: Only digit(pixel).', 'DigiPress'); ?></span></p>
		<p><label for="<?php echo $number_name; ?>"><?php _e('Number of posts', 'DigiPress'); ?>:</label><br />
		<select name="<?php echo $number_name; ?>" size="1" style="width:100%;">
			<option value="1" <?php if ($number == 1) echo 'selected' ; ?>>1</option>
			<option value="2" <?php if ($number == 2) echo 'selected' ; ?>>2</option>
			<option value="3" <?php if ($number == 3) echo 'selected' ; ?>>3</option>
			<option value="4" <?php if ($number == 4) echo 'selected' ; ?>>4</option>
			<option value="5" <?php if ($number == 5) echo 'selected' ; ?>>5</option>
			<option value="6" <?php if ($number == 6) echo 'selected' ; ?>>6</option>
			<option value="7" <?php if ($number == 7) echo 'selected' ; ?>>7</option>
			<option value="8" <?php if ($number == 8) echo 'selected' ; ?>>8</option>
			<option value="9" <?php if ($number == 9) echo 'selected' ; ?>>9</option>
			<option value="10" <?php if ($number == 10) echo 'selected' ; ?>>10</option>
		</select></p>
		<p><label for="'.$theme_name.'"><?php _e('Theme', 'DigiPress'); ?>:</label><br />
		<select name="<?php echo $theme_name; ?>" size="1" style="width:100%;">
			<option value="default" <?php if ($theme == 'default') echo 'selected' ; ?>><?php _e('Default', 'DigiPress'); ?></option>
			<option value="mytheme" <?php if ($theme == 'mytheme') echo 'selected' ; ?>><?php _e('Suitable for this theme', 'DigiPress'); ?></option>
			<option value="notheme" <?php if ($theme == 'notheme') echo 'selected' ; ?>><?php _e('None', 'DigiPress'); ?></option>
		</select></p>
<?php }		// End of form function.

	function update($new_instance, $old_instance) {
		$instance['title']	= strip_tags($new_instance['title']);
		$instance['type']	= $new_instance['type'];
		$instance['width']	= $new_instance['width'];
		$instance['number']	= $new_instance['number'];
		$instance['theme']	= $new_instance['theme'];

		return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array('title'	=> __('Bookmarked Entry', 'DigiPress'),
														  'type'	=> 'count',
														  'width' 	=> '300',
														  'number' 	=> '5',
														  'theme'	=> 'default'));
		
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$theme = $instance['theme'];
		
		// CSS
		$css = '';
		if ($instance['theme'] == 'mytheme') {
			$theme = 'notheme';
			$css = 
'<style type="text/css">
.hatena-bookmark-widget-title {
	display:none;
}
.hatena-bookmark-widget-body li {
	padding:6px 0 6px 0;
	border-bottom:1px dotted #bbb;
}
.hatena-bookmark-entrytitle {
	font-size:12px;
	line-height:148%;
}
.hatena-bookmark-count,
.hatena-bookmark-widget-footer {
	display:block;
	margin:0 0 0 auto;
	text-align:right;
}
.hatena-bookmark-count a{
	color:#ff0000;
	background-color:#ffd5d5;
	font-size:10px;
	font-weight:bold;
	text-decoration:underline;
	height:16px;
}
</style>';
		}
		$css = str_replace(array("\r\n","\r","\n", "\t"), '', $css);

$code = '<div class="shadow-none">'.$css.'<script language="javascript" type="text/javascript" src="//b.hatena.ne.jp/js/widget.js" charset="utf-8"></script><script language="javascript" type="text/javascript">Hatena.BookmarkWidget.url   = "'.home_url().'";Hatena.BookmarkWidget.title = "";Hatena.BookmarkWidget.sort  = "'.$instance['type'].'";Hatena.BookmarkWidget.width = "'.$instance['width'].'";Hatena.BookmarkWidget.num   = "'.$instance['number'].'";Hatena.BookmarkWidget.theme = "'.$theme.'";Hatena.BookmarkWidget.load();</script></div>';
		
		// show
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		echo $code . $after_widget;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("DP_Hatebu_Popular_Posts_Widget");'));


/*******************************************************
* Tab widget
*******************************************************/
class DP_Tab_Widget extends WP_Widget {
	function DP_Tab_Widget() {
		$widget_opts = array('classname' => 'dp_tab_widget', 
							 'description' => __('Multi tab widget by DigiPress', 'DigiPress') );
		$control_opts = array('width' => 200, 'height' => 300);
		$this->__construct('DPTabWidget', __('Tab Widget', 'DigiPress'), $widget_opts, $control_opts);
	}

	// Input widget form in Admin panel.
	function form($instance) {
		// default value
		$instance = wp_parse_args((array)$instance, array('title_newPost' 		=> __('Recent Posts','DigiPress'), 
														  'title_most_viewed' 	=> __('Popular Posts','DigiPress'),
														  'title_random' 		=> __('Random Posts','DigiPress'),
														  'title_most_commented'=> __('Most Commented Posts','DigiPress'), 
														  'title_category' 		=> __('Category','DigiPress'), 
														  'title_tagCloud' 		=> __('Tag Cloud','DigiPress'),
														  'title_recentComment' => __('Recent Comment','DigiPress'),
														  'title_archive' 		=> __('Archive','DigiPress'),
														  'wd_newPost'		=> true,
														  'wd_category'		=> true,
														  'wd_tagCloud'		=> true,
														  'wd_recentComment'=> false,
														  'wd_archive'		=> false,
														  'wd_most_viewed'	=> false,
														  'wd_most_commented'	=> false,
														  'wd_random'	=> false,
														  'ins_category_count'	=> 0,
														  'ins_archive_count'	=> 0,
														  'number' 		=> 5,
														  'target' 		=> 'post_views_count',
														  'thumbnail' 	=> true,
														  'comment'		=> false,
														  'views'		=> false,
														  'pub_date'	=> 'show',
														  'hatebuNumber' => false,
														  'tweetsNumber' => false,
														  'likesNumber' => false));
		
		$form_code = '';
		$term_code = '';


		// get values
		$title_newPost		= strip_tags($instance['title_newPost']);
		$title_category		= strip_tags($instance['title_category']);
		$title_tagCloud		= strip_tags($instance['title_tagCloud']);
		$title_most_viewed	= strip_tags($instance['title_most_viewed']);
		$title_recentComment	= strip_tags($instance['title_recentComment']);
		$title_most_commented	= strip_tags($instance['title_most_commented']);
		$title_random		= strip_tags($instance['title_random']);
		$title_archive		= strip_tags($instance['title_archive']);

		$wd_newPost			= $instance['wd_newPost'];
		$wd_category		= $instance['wd_category'];
		$wd_tagCloud		= $instance['wd_tagCloud'];
		$wd_most_viewed		= $instance['wd_most_viewed'];
		$wd_recentComment	= $instance['wd_recentComment'];
		$wd_most_commented		= $instance['wd_most_commented'];
		$wd_random			= $instance['wd_random'];
		$wd_archive			= $instance['wd_archive'];

		$number		= $instance['number'];
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$pub_date 	= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$target 	 = $instance['target'];
		$reset_weekday 	 = $instance['reset_weekday'];

		// instance
		$ins_category_count		= $instance['ins_category_count'];
		$ins_archive_count		= $instance['ins_archive_count'];

		// Get fields name and id
		$wd_newPost_name		= $this->get_field_name('wd_newPost');
		$wd_newPost_id			= $this->get_field_id('wd_newPost');
		$wd_category_name		= $this->get_field_name('wd_category');
		$wd_category_id			= $this->get_field_id('wd_category');
		$wd_tagCloud_name		= $this->get_field_name('wd_tagCloud');
		$wd_tagCloud_id			= $this->get_field_id('wd_tagCloud');
		$wd_most_viewed_name	= $this->get_field_name('wd_most_viewed');
		$wd_most_viewed_id		= $this->get_field_id('wd_most_viewed');
		$wd_most_commented_name	= $this->get_field_name('wd_most_commented');
		$wd_most_commented_id	= $this->get_field_id('wd_most_commented');
		$wd_random_name			= $this->get_field_name('wd_random');
		$wd_random_id			= $this->get_field_id('wd_random');
		$wd_recentComment_name	= $this->get_field_name('wd_recentComment');
		$wd_recentComment_id	= $this->get_field_id('wd_recentComment');
		$wd_archive_name		= $this->get_field_name('wd_archive');
		$wd_archive_id			= $this->get_field_id('wd_archive');

		$title_newPost_name		= $this->get_field_name('title_newPost');
		$title_newPost_id		= $this->get_field_id('title_newPost');
		$title_category_name	= $this->get_field_name('title_category');
		$title_category_id		= $this->get_field_id('title_category');
		$title_tagCloud_name	= $this->get_field_name('title_tagCloud');
		$title_tagCloud_id		= $this->get_field_id('title_tagCloud');
		$title_most_viewed_name	= $this->get_field_name('title_most_viewed');
		$title_most_viewed_id	= $this->get_field_id('title_most_viewed');
		$title_most_commented_name	= $this->get_field_name('title_most_commented');
		$title_most_commented_id	= $this->get_field_id('title_most_commented');
		$title_random_name		= $this->get_field_name('title_random');
		$title_random_id		= $this->get_field_id('title_random');
		$title_recentComment_name	= $this->get_field_name('title_recentComment');
		$title_recentComment_id		= $this->get_field_id('title_recentComment');
		$title_archive_name		= $this->get_field_name('title_archive');
		$title_archive_id		= $this->get_field_id('title_archive');

		$ins_category_count_name	= $this->get_field_name('ins_category_count');
		$ins_category_count_id		= $this->get_field_id('ins_category_count');
		$ins_archive_count_name		= $this->get_field_name('ins_archive_count');
		$ins_archive_count_id		= $this->get_field_id('ins_archive_count');

		$numbername	= $this->get_field_name('number');
		$numberid	= $this->get_field_id('number');
		$thumbnailname	= $this->get_field_name('thumbnail');
		$thumbnailid	= $this->get_field_id('thumbnail');
		$commentName	= $this->get_field_name('comment');
		$commentId		= $this->get_field_id('comment');
		$viewsName		= $this->get_field_name('views');
		$viewsId		= $this->get_field_id('views');
		$pub_date_name	= $this->get_field_name('pub_date');
		$pub_date_id	= $this->get_field_id('pub_date');
		$hatebuNumberName	= $this->get_field_name('hatebuNumber');
		$tweetsNumberName	= $this->get_field_name('tweetsNumber');
		$likesNumberName	= $this->get_field_name('likesNumber');
		$hatebuNumberId = $this->get_field_id('hatebuNumber');
		$tweetsNumberId = $this->get_field_id('tweetsNumber');
		$likesNumberId = $this->get_field_id('likesNumber');
		$target_name	= $this->get_field_name('target');
		$target_id		= $this->get_field_id('target');

		$wd_newPostCheck;
		if ($wd_newPost) $wd_newPostCheck = 'checked';
		$wd_categoryCheck;
		if ($wd_category) $wd_categoryCheck = 'checked';
		$wd_tagCloudCheck;
		if ($wd_tagCloud) $wd_tagCloudCheck = 'checked';
		$wd_most_viewedCheck;
		if ($wd_most_viewed) $wd_most_viewedCheck = 'checked';
		$wd_most_commentedCheck;
		if ($wd_most_commented) $wd_most_commentedCheck = 'checked';
		$wd_randomCheck;
		if ($wd_random) $wd_randomCheck = 'checked';
		$wd_recentCommentCheck;
		if ($wd_recentComment) $wd_recentCommentCheck = 'checked';
		$wd_archiveCheck;
		if ($wd_archive) $wd_archiveCheck = 'checked';
		$ins_category_countCheck;
		if ($ins_category_count == 1) $ins_category_countCheck = 'checked';
		$ins_archive_countCheck;
		if ($ins_archive_count == 1) $ins_archive_countCheck = 'checked';

		$thumbeCheck;
		if ($thumbnail) $thumbeCheck = 'checked';
		$commentCheck;
		if ($comment) $commentCheck = 'checked';
		$viewsCheck;
		if ($views) $viewsCheck = 'checked';
		$pub_date_check;
		if ($pub_date) $pub_date_check = 'checked';
		$hatebuNumberCheck;
		if ($hatebuNumber) $hatebuNumberCheck = 'checked';

		$tweetsNumberCheck;
		if ($tweetsNumber) $tweetsNumberCheck = 'checked';

		$likesNumberCheck;
		if ($likesNumber) $likesNumberCheck = 'checked';

		// Show form
		$form_code = '<div style="padding-bottom:20px;">';
		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_newPost_name.'" id="'.$wd_newPost_id.'" type="checkbox" value="show" '.$wd_newPostCheck.' />
			 <label for="'.$wd_newPost_id.'" style="font-weight:bold;">'.__('Show recent posts.', 'DigiPress').'</label>';
		$form_code .= '<div style="margin:6px 0 0 15px;">
			 <label for="'.$title_newPost_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_newPost_name.'" id="'.$title_newPost_id.'" value="'.$title_newPost.'" style="width:100%;" />
			 </div></div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_most_viewed_name.'" id="'.$wd_most_viewed_id.'" type="checkbox" value="show" '.$wd_most_viewedCheck.' />
			 <label for="'.$wd_most_viewed_id.'" style="font-weight:bold;">'.__('Show most viewed posts.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;">
			 <label for="'.$title_most_viewed_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_most_viewed_name.'" id="'.$title_most_viewed_id.'" value="'.$title_most_viewed.'" style="width:100%;" />
			 </div>';

		// Do the custom function
		$term_code = apply_filters( 'dp_tab_widget_most_viewed_form', 
			array(
				'post',
				$target, 
				$target_name, 
				$target_id)
			);
		if (is_string($term_code)) {
			$form_code .= '<div style="margin-left:15px;">'.$term_code.'</div>';
		}

		$form_code .= '</div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_recentComment_name.'" id="'.$wd_recentComment_id.'" type="checkbox" value="show" '.$wd_recentCommentCheck.' />
			 <label for="'.$wd_recentComment_id.'" style="font-weight:bold;">'.__('Show recent comments.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;">
			 <label for="'.$title_recentComment_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_recentComment_name.'" id="'.$title_recentComment_id.'" value="'.$title_recentComment.'" style="width:100%;" />
			 </div></div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_most_commented_name.'" id="'.$wd_most_commented_id.'" type="checkbox" value="show" '.$wd_most_commentedCheck.' />
			 <label for="'.$wd_most_commented_id.'" style="font-weight:bold;">'.__('Show most commented posts.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;">
			 <label for="'.$title_most_commented_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_most_commented_name.'" id="'.$title_most_commented_id.'" value="'.$title_most_commented.'" style="width:100%;" />
			 </div></div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_random_name.'" id="'.$wd_random_id.'" type="checkbox" value="show" '.$wd_randomCheck.' />
			 <label for="'.$wd_random_id.'" style="font-weight:bold;">'.__('Show random posts.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;">
			 <label for="'.$title_random_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_random_name.'" id="'.$title_random_id.'" value="'.$title_random.'" style="width:100%;" />
			 </div></div>';

		$form_code .= '<div style="border:1px solid #ddd;margin:2px 0 2px 15px;padding:4px;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;"><p style="font-weight:bold;">'.__('Display Option:', 'DigiPress').'</p>';
		$form_code .= '<p><label for="'.$numberid.'">'.__('Number to display','DigiPress').':</label>
			 <input type="text" name="'.$numbername.'" id="'.$numberid.'" value="'.$number.'" style="width:60px;" /></p>';
		$form_code .=  '<p><input name="'.$pub_date_name.'" id="'.$pub_date_id.'" type="checkbox" value="on" '.$pub_date_check.' />
			 <label for="'.$pub_date_id.'">'.__('Show date','DigiPress').'</label></p>';
		$form_code .=  '<p><input name="'.$thumbnailname.'" id="'.$thumbnailid.'" type="checkbox" value="on" '.$thumbeCheck.' />
			 <label for="'.$thumbnailid.'">'.__('Show Thumbnail','DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$commentName.'" id="'.$commentId.'" type="checkbox" value="on" '.$commentCheck.' />
			 <label for="'.$commentId.'">'.__('Show the number of comment(s).', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$viewsName.'" id="'.$viewsId.'" type="checkbox" value="on" '.$viewsCheck.' />
			 <label for="'.$viewsId.'">'.__('Show views.', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$hatebuNumberName.'" id="'.$hatebuNumberId.'" type="checkbox" value="on" '.$hatebuNumberCheck.' />
			 <label for="'.$hatebuNumberId.'">'.__('Show Hatebu bookmarked number.', 'DigiPress').'</label></p>';
		// $form_code .= '<p><input name="'.$tweetsNumberName.'" id="'.$tweetsNumberId.'" type="checkbox" value="on" '.$tweetsNumberCheck.' />
		// 	 <label for="'.$tweetsNumberId.'">'.__('Show tweets number.', 'DigiPress').'</label></p>';
		$form_code .= '<p><input name="'.$likesNumberName.'" id="'.$likesNumberId.'" type="checkbox" value="on" '.$likesNumberCheck.' />
			 <label for="'.$likesNumberId.'">'.__('Show Facebook likes number.', 'DigiPress').'</label></p>';
		$form_code .= '</div></div>';


		$form_code .= '<div style="margin-bottom:26px;"><input name="'.$wd_category_name.'" id="'.$wd_category_id.'" type="checkbox" value="show" '.$wd_categoryCheck.' />
			 <label for="'.$wd_category_id.'" style="font-weight:bold;">'.__('Show category.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;"><label for="'.$title_category_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_category_name.'" id="'.$title_category_id.'" value="'.$title_category.'" style="width:100%;" />';
		$form_code .= '<p style="padding-top:6px;"><input name="'.$ins_category_count_name.'" id="'.$ins_category_count_id.'" type="checkbox" value=1 '.$ins_category_countCheck.' />
			 <label for="'.$ins_category_count_id.'">'.__('Show counts.', 'DigiPress').'</label></p></div></div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_tagCloud_name.'" id="'.$wd_tagCloud_id.'" type="checkbox" value="show" '.$wd_tagCloudCheck.' />
			 <label for="'.$wd_tagCloud_id.'" style="font-weight:bold;">'.__('Show tag cloud.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;"><label for="'.$title_tagCloud_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_tagCloud_name.'" id="'.$title_tagCloud_id.'" value="'.$title_tagCloud.'" style="width:100%;" /></div></div>';

		$form_code .= '<div style="margin-bottom:20px;"><input name="'.$wd_archive_name.'" id="'.$wd_archive_id.'" type="checkbox" value="show" '.$wd_archiveCheck.' />
			 <label for="'.$wd_archive_id.'" style="font-weight:bold;">'.__('Show monthly archives.', 'DigiPress').'</label>
			 <div style="margin:6px 0 6px 15px;"><label for="'.$title_archive_id.'">'.__('Title','DigiPress').':</label><br /><input type="text" name="'.$title_archive_name.'" id="'.$title_archive_id.'" value="'.$title_archive.'" style="width:100%;" />';
		$form_code .= '<p style="padding-top:6px;"><input name="'.$ins_archive_count_name.'" id="'.$ins_archive_count_id.'" type="checkbox" value=1 '.$ins_archive_countCheck.' />
			 <label for="'.$ins_archive_count_id.'">'.__('Show counts.', 'DigiPress').'</label></p></div></div>';

		// Display
		echo $form_code;
	}

	// Save Function
	// $new_instance : Input value
	// $old_instance : Exist value
	// Return : New values
	function update($new_instance, $old_instance) {
		$instance['title_newPost']		= strip_tags($new_instance['title_newPost']);
		$instance['title_category']		= strip_tags($new_instance['title_category']);
		$instance['title_tagCloud']		= strip_tags($new_instance['title_tagCloud']);
		$instance['title_recentComment']= strip_tags($new_instance['title_recentComment']);
		$instance['title_archive']		= strip_tags($new_instance['title_archive']);
		$instance['title_most_viewed']		= strip_tags($new_instance['title_most_viewed']);
		$instance['title_most_commented']	= strip_tags($new_instance['title_most_commented']);
		$instance['title_random']			= strip_tags($new_instance['title_random']);
		$instance['wd_newPost']			= $new_instance['wd_newPost'];
		$instance['wd_category']		= $new_instance['wd_category'];
		$instance['wd_tagCloud']		= $new_instance['wd_tagCloud'];
		$instance['wd_recentComment']	= $new_instance['wd_recentComment'];
		$instance['wd_archive']			= $new_instance['wd_archive'];
		$instance['wd_most_viewed']		= $new_instance['wd_most_viewed'];
		$instance['wd_most_commented']	= $new_instance['wd_most_commented'];
		$instance['wd_random']			= $new_instance['wd_random'];
		$instance['ins_category_count']		= $new_instance['ins_category_count'];
		$instance['ins_archive_count']		= $new_instance['ins_archive_count'];
		$instance['number']		= $new_instance['number'];
		$instance['thumbnail']	= $new_instance['thumbnail'];
		$instance['comment']	= $new_instance['comment'];
		$instance['views']		= $new_instance['views'];
		$instance['pub_date']		= $new_instance['pub_date'];
		$instance['hatebuNumber']	= $new_instance['hatebuNumber'];
		$instance['tweetsNumber']	= $new_instance['tweetsNumber'];
		$instance['likesNumber']	= $new_instance['likesNumber'];
		$instance['target']			= $new_instance['target'];

		return $instance;
	}

	// Display to theme
	// $args : output array
	// $instance : exist array
	function widget($args, $instance) {
		extract($args);
		$instance = wp_parse_args((array)$instance, array(
														  'title_newPost' 		=> __('Recent Posts', 'DigiPress'),
														  'title_category' 		=> __('Category', 'DigiPress'),
														  'title_tagCloud' 		=> __('Tag Cloud', 'DigiPress'),
														  'title_recentComment' => __('Recent Comments', 'DigiPress'),
														  'title_archive' 		=> __('Archive', 'DigiPress'),
														  'title_most_viewed' 	=> __('Popular Posts','DigiPress'),
														  'title_random' 		=> __('Random Posts','DigiPress'),
														  'title_most_commented'=> __('Most Commented Posts','DigiPress'), 
														  'wd_newPost'		=> true,
														  'wd_category'		=> true,
														  'wd_tagCloud'		=> true,
														  'wd_recentComment'=> false,
														  'wd_archive'		=> false,
														  'wd_most_viewed'	=> false,
														  'wd_most_commented'	=> false,
														  'wd_random'	=> false,
														  'ins_category_count'	=> 0,
														  'ins_archive_count'	=> 0,
														  'number' => 5,
														  'target' => 'post_views_count',
														  'thumbnail' => true,
														  'comment'	=> false,
														  'views'	=> false,
														  'pub_date'	=> false,
														  'hatebuNumber' => false,
														  'tweetsNumber' => true,
														  'likesNumber' => true));
		
		$title_newPost = $instance['title_newPost'];
		$title_newPost = apply_filters('title_newPost', $title_newPost);
		$title_category = $instance['title_category'];
		$title_category = apply_filters('title_category', $title_category);
		$title_tagCloud = $instance['title_tagCloud'];
		$title_tagCloud = apply_filters('title_tagCloud', $title_tagCloud);
		$title_recentComment = $instance['title_recentComment'];
		$title_recentComment = apply_filters('title_recentComment', $title_recentComment);
		$title_archive = $instance['title_archive'];
		$title_archive = apply_filters('title_archive', $title_archive);
		$title_most_viewed = $instance['title_most_viewed'];
		$title_most_viewed = apply_filters('title_most_viewed', $title_most_viewed);
		$title_most_commented = $instance['title_most_commented'];
		$title_most_commented = apply_filters('title_most_commented', $title_most_commented);
		$title_random = $instance['title_random'];
		$title_random = apply_filters('title_random', $title_random);
		$wd_newPost 		= $instance['wd_newPost'];
		$wd_category 		= $instance['wd_category'];
		$wd_tagCloud 		= $instance['wd_tagCloud'];
		$wd_recentComment 	= $instance['wd_recentComment'];
		$wd_archive 		= $instance['wd_archive'];
		$wd_most_viewed 		= $instance['wd_most_viewed'];
		$wd_most_commented 		= $instance['wd_most_commented'];
		$wd_random 		= $instance['wd_random'];
		$ins_category_count		= $instance['ins_category_count'];
		$ins_archive_count		= $instance['ins_archive_count'];
		$number = $instance['number'];
		$thumbnail	= $instance['thumbnail'];
		$comment	= $instance['comment'];
		$views		= $instance['views'];
		$pub_date	= $instance['pub_date'];
		$hatebuNumber = $instance['hatebuNumber'];
		$tweetsNumber = $instance['tweetsNumber'];
		$likesNumber = $instance['likesNumber'];
		$target 	= $instance['target'] ? $instance['target'] : 'post_views_count';

		// Tab state
		$flag_first_tab 	= true;
		$tab_state_class	= 'active_tab';
		$first_tab			= 1;

		// Widget params
		$ins_category_count = ($ins_category_count == 1) ? 1 : 0;
		$ins_archive_count = ($ins_archive_count == 1) ? 1 : 0; 
		
		$args = array(
			'before_title'	=> '',
			'after_title'	=> ''
			);
		$instanceCategory = array(
			'title'			=> ' ',
			'count'			=> $ins_category_count,
			'hierarchical'	=> 1,
			'dropdown'		=> 0
			);
		$instanceRecentComment = array(
			'title' 		=> ' ',
			'number' 		=> $number
			);
		$instanceTagCloud = array(
			'title'			=> ' '
			);
		$instanceArchive = array(
			'title'			=> ' ',
			'count'			=> $ins_archive_count,
			'dropdown'		=> 1
			);

		echo $before_widget.'<div class="dp_tab_widget">';

		// Tab list
		echo '<ul class="dp_tab_widget_ul clearfix">';
		if ($wd_newPost) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 1;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_newPost']) {
				echo '<li id="tab_newPost" class="'.$tab_state_class.'">'.$title_newPost.'</li>';
			} else {
				echo '<li id="tab_newPost" class="'.$tab_state_class.'">Recent Posts</li>';
			}
		}
		if ($wd_most_viewed) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 2;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_most_viewed']) {
				echo '<li id="tab_most_viewed" class="'.$tab_state_class.'">'.$title_most_viewed.'</li>';
			} else {
				echo '<li id="tab_most_viewed" class="'.$tab_state_class.'">Popular Posts</li>';
			}
		}
		if ($wd_recentComment) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 3;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_recentComment']) {
				echo '<li id="tab_recentComment" class="'.$tab_state_class.'">'.$title_recentComment.'</li>';
			} else {
				echo '<li id="tab_recentComment" class="'.$tab_state_class.'">Recent Comment</li>';
			}
		}
		if ($wd_most_commented) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 4;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_most_commented']) {
				echo '<li id="tab_most_commented" class="'.$tab_state_class.'">'.$title_most_commented.'</li>';
			} else {
				echo '<li id="tab_most_commented" class="'.$tab_state_class.'">Most Commented</li>';
			}
		}
		if ($wd_random) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 5;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_random']) {
				echo '<li id="tab_random" class="'.$tab_state_class.'">'.$title_random.'</li>';
			} else {
				echo '<li id="tab_random" class="'.$tab_state_class.'">Pickup</li>';
			}
		}
		if ($wd_category) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 6;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_category']) {
				echo '<li id="tab_category" class="'.$tab_state_class.'">'.$title_category.'</li>';
			} else {
				echo '<li id="tab_category" class="'.$tab_state_class.'">Category</li>';
			}
		}
		if ($wd_tagCloud) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 7;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_tagCloud']) {
				echo '<li id="tab_tagCloud" class="'.$tab_state_class.'">'.$title_tagCloud.'</li>';
			} else {
				echo '<li id="tab_tagCloud" class="'.$tab_state_class.'">Tag Cloud</li>';
			}
		}
		if ($wd_archive) {
			if ($flag_first_tab) {
				$flag_first_tab = false;
				$tab_state_class = 'dp_tab_title active_tab';
				$first_tab = 8;
			} else {
				$tab_state_class = 'dp_tab_title inactive_tab';
			}

			if ($instance['title_archive']) {
				echo '<li id="tab_archive" class="'.$tab_state_class.'">'.$title_archive.'</li>';
			} else {
				echo '<li id="tab_archive" class="'.$tab_state_class.'">Archive</li>';
			}
		}
		echo '</ul>';

		// Show Tab content
		echo '<div class="dp_tab_contents">';
		// Recent Posts
		if ($wd_newPost) {
			if ($first_tab === 1) {
				echo '<div id="tab_newPost_content" class="first_tab">';
			} else {
				echo '<div id="tab_newPost_content">';
			}

			$order_by = 'post_date';
			DP_GET_POSTS_BY_QUERY(array(
						'number'	=> $number,
						'comment'	=> $comment,
						'views' 	=> $views,
						'pub_date'	=> $pub_date,
						'thumbnail'	=> $thumbnail,
						'hatebuNumber'	=> $hatebuNumber,
						'tweetsNumber'	=> $tweetsNumber,
						'likesNumber'	=> $likesNumber,
						'order_by'	=> $order_by,
						'type'		=> 'tab'
						)
			);
			echo '</div>';
		}
		// Most viewed Posts
		if ($wd_most_viewed) {
			if ($first_tab === 2) {
				echo '<div id="tab_most_viewed_content" class="first_tab">';
			} else {
				echo '<div id="tab_most_viewed_content">';
			}

			$order_by = 'meta_value_num';
			DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'comment'	=> $comment,
					'views' 	=> $views,
					'pub_date' 	=> $pub_date,
					'thumbnail'	=> $thumbnail,
					'hatebuNumber'	=> $hatebuNumber,
					'tweetsNumber'	=> $tweetsNumber,
					'likesNumber'	=> $likesNumber,
					'meta_key'	=> $target,
					'order_by'	=> $order_by,
					'type'		=> 'tab'
					)
		);
			echo '</div>';
		}
		// Recent comment
		if ($wd_recentComment) {
			if ($first_tab === 3) {
				echo '<div id="tab_recentComment_content" class="first_tab">';
			} else {
				echo '<div id="tab_recentComment_content">';
			}

			the_widget('WP_Widget_Recent_Comments', $instanceRecentComment, $args);
			echo '</div>';
		}
		// Most Commented Posts
		if ($wd_most_commented) {
			if ($first_tab === 4) {
				echo '<div id="tab_most_commented_content" class="first_tab">';
			} else {
				echo '<div id="tab_most_commented_content">';
			}

			$order_by = 'comment_count';
			DP_GET_POSTS_BY_QUERY(array(
					'number'	=> $number,
					'comment'	=> $comment,
					'views' 	=> $views,
					'pub_date' 	=> $pub_date,
					'thumbnail'	=> $thumbnail,
					'hatebuNumber'	=> $hatebuNumber,
					'tweetsNumber'	=> $tweetsNumber,
					'likesNumber'	=> $likesNumber,
					'order_by'	=> $order_by,
					'type'		=> 'tab'
					)
		);
			echo '</div>';
		}
		// Random Posts
		if ($wd_random) {
			if ($first_tab === 5) {
				echo '<div id="tab_random_content" class="first_tab">';
			} else {
				echo '<div id="tab_random_content">';
			}

			$order_by = 'rand';
			DP_GET_POSTS_BY_QUERY(array(
						'number'	=> $number,
						'comment'	=> $comment,
						'views' 	=> $views,
						'pub_date' 	=> $pub_date,
						'thumbnail'	=> $thumbnail,
						'hatebuNumber'	=> $hatebuNumber,
						'tweetsNumber'	=> $tweetsNumber,
						'likesNumber'	=> $likesNumber,
						'order_by'	=> $order_by,
						'type'		=> 'tab'
						)
			);
			echo '</div>';
		}
		if ($wd_category) {
			$cat_has_count = '';
			if ($ins_category_count) {
				$cat_has_count = ' cat-has-num';
			}
			if ($first_tab === 6) {
				echo '<div id="tab_category_content" class="tab_category_content first_tab'.$cat_has_count.'">';
			} else {
				echo '<div id="tab_category_content" class="tab_category_content'.$cat_has_count.'">';
			}
			
			// the_widget('WP_Widget_Categories', $instanceCategory, $args);

			// Use extended original widget categories
			the_widget('DP_Widget_Categories', $instanceCategory, $args);
			echo '</div>';
		}
		
		if ($wd_tagCloud) {
			if ($first_tab === 7) {
				echo '<div id="tab_tagCloud_content" class="first_tab">';
			} else {
				echo '<div id="tab_tagCloud_content">';
			}
			
			the_widget('WP_Widget_Tag_Cloud', $instanceTagCloud, $args);
			echo '</div>';
		}
		if ($wd_archive) {
			if ($first_tab === 8) {
				echo '<div id="tab_archive_content" class="first_tab">';
			} else {
				echo '<div id="tab_archive_content">';
			}
			
			the_widget('WP_Widget_Archives', $instanceArchive, $args);
			echo '</div>';
		}
		echo '</div>';

		echo '</div>'.$after_widget;
	}
}
// widgets_init
add_action('widgets_init', create_function('', 'return register_widget("DP_Tab_Widget");'));
?>