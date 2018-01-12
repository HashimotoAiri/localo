<?php
function post_format_icon($format) {
	$titleIconClass = '';
	switch  ($format) {
		case 'aside':
			$titleIconClass = ' icon-pencil';
			break;
		case 'gallery':
			$titleIconClass = ' icon-pictures';
			break;
		case 'image':
			$titleIconClass = ' icon-picture';
			break;
		case 'quote':
			$titleIconClass = ' icon-quote-left';
			break;
		case 'status':
			$titleIconClass = ' icon-comment';
			break;
		case 'video':
			$titleIconClass = ' icon-video-play';
			break;
		case 'audio':
			$titleIconClass = ' icon-music';
			break;
		case 'chat':
			$titleIconClass = ' icon-comment';
			break;
		case 'link':
			$titleIconClass = ' icon-link';
			break;
		default:
			$titleIconClass = '';
			break;
	}

	return $titleIconClass;
}

/*******************************************************
* Published time diff
*******************************************************/
function published_diff(){
	$from 	= get_post_time('U',true); 	// Published datetime
	$to 	= time(); 				// Current time
	$diff 	= $to - $from; 			// Diff
	$code 	= '';
	if ( $diff < 0 ) {
		$code = human_time_diff( $from, $to ) . __(' ago','DigiPress');
	} elseif ( abs($diff) <= 86400 ) {
		// Posted in less than 24 hours
		// $code = '<span><time datetime="'.get_the_date('c').'">'.__('This article was posted in less than 24 hours.','DigiPress').'</time></span>';
		$code = human_time_diff( $from, $to ) . __(' ago','DigiPress');
	} else {
		$code = human_time_diff( $from, $to ) . __(' ago','DigiPress');
	}
	return $code;
}


/*******************************************************
* Meta content for listing post style
*******************************************************/
function get_post_meta_for_listing_post_styles($args = array()) {
	if (post_password_required()) return;

	// For 'extract($ARCHIVE_STYLE)' params
	$archive_style 	= '';

	global $options, $post, $ARCHIVE_STYLE, $IS_MOBILE_DP;
	
	extract($ARCHIVE_STYLE);

	// Get post type
	$post_type 		= get_post_type();
	$current_archive_flag = '';
	$arr_meta 		= array();
	$prefix_name	= '';
	$avatar_img		= '';
	$date_year 		= '';
	$date_month 	= '';
	$date_month_en 	= '';
	$date_day 		= '';
	$week_day		= '';
	$date_code 		= '';
	$tags_code		= '';
	$cats_code		= '';
	$comment_code 	= '';
	$views_code 	= '';
	$author_code	= '';
	$cat_color_class = '';

	// Post parameters
	$dp_hide_date 			= get_post_meta(get_the_ID(), 'dp_hide_date', true);
	$dp_hide_author 		= get_post_meta(get_the_ID(), 'dp_hide_author', true);
	$dp_hide_cat 			= get_post_meta(get_the_ID(), 'dp_hide_cat', true);
	$dp_hide_tag 			= get_post_meta(get_the_ID(), 'dp_hide_tag', true);
	$dp_hide_views 			= get_post_meta(get_the_ID(), 'dp_hide_views', true);
	$dp_star_rating_enable 	= get_post_meta(get_the_ID(), 'dp_star_rating_enable', true);
	$dp_star_rating 		= get_post_meta(get_the_ID(), 'dp_star_rating', true);

	// Published date
	if ( $args['pub_date'] && !$dp_hide_date) {
		$date_code 	= '<div class="loop-date"><time datetime="'. get_the_date('c').'" class="updated">'.get_the_date().'</time></div>';
		$date_year 		= '<span class="date_year">'.get_post_time('Y').'</span>';
		$date_month 	= '<span class="date_month">'.get_post_time('n').'</span>';
		$date_month_en 	= '<span class="date_month_en">'.get_post_time('M').'</span>';
		$date_month_en_full = '<span class="date_month_en_full">'.get_post_time('F').'</span>';
		$date_day 		= '<span class="date_day">'.get_post_time('j').'</span>';
		$date_day_double = '<span class="date_day_double">'.get_post_time('d').'</span>';
		$week_day 		= '<span class="date_week_day">'.get_post_time('D').'</span>';
	}

	// Category
	if ($post_type === 'post' && $args['show_cat'] && !$dp_hide_cat) {
		$cats = get_the_category();
		if ($cats) {
			$cats = $cats[0];
			$cat_color_class = " cat-color".$cats->cat_ID;
			$cats_code = '<a href="'.get_category_link($cats->cat_ID).'" rel="tag" class="'.$cat_color_class.'">' .$cats->cat_name.'</a>';
		}
		$cats_code = '<div class="meta-cat">' .$cats_code. '</div>';
	}

	// Tags 
	if ( $post_type === 'post' && $options['show_tags'] && !$dp_hide_tag) {
		$count = 0;
		$tags = get_the_tags();

		if ($archive_style === 'normal') {
			if ($tags) {
				foreach ($tags as $tag) {
					$count++;
					if ($count < 4) {
						$tags_code .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag" title="'.$tag->count.__(' topics of this tag.', 'DigiPress').'">'.$tag->name.'</a> ';
					} else {
						break;
					}
				}
			}
		} else {
			if ($tags) {
				foreach ($tags as $tag) {
					$count++;
					if ($count === 1) {
						$tags_code .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag" title="'.$tag->count.__(' topics of this tag.', 'DigiPress').'">'.$tag->name.'</a> ';
						break;
					}
				}
			}
		}
		$tags_code = !empty($tags_code) ? '<div class="meta-cat tag">'.$tags_code.'</div>': '' ;
	}


	// Comments
	if ( $args['comment'] ) {
		$comment_code = '<div class="meta-comment"><i class="icon-comment"></i><span class="share-num">'. get_comments_popup_link(
							'0', '1', '%').'</span></div>';
	}

	// Views 
	if ($args['views'] && function_exists('dp_get_post_views') && !$dp_hide_views) {
		if (!empty($args['meta_key_views_count'])) {
			$views_code = '<div class="meta-views">'.dp_get_post_views(get_the_ID(), $args['meta_key_views_count']).' views</div>';
		} else {
			$views_code = '<div class="meta-views">'.dp_get_post_views(get_the_ID(), null).' views</div>';
		}
	}

	// Author
	if ($args['author'] && !$dp_hide_author ) {
		$this_author = get_userdata($post->post_author);
		if ((bool)$options['show_author_avatar']) {
			$avatar_img = get_avatar( $this_author->ID, 90 );
		} else {
			$prefix_name = '<span class="author-by">By </span>';
		}
		$author_code = '<div class="meta-author vcard">'.$prefix_name.'<a href="'.get_author_posts_url($this_author->ID).'" rel="author" title="'.__('Show articles of this user.', 'DigiPress').'" class="fn">'.$avatar_img.'<span class="name">'.$this_author->display_name.'</span></a></div>';
	}

	$arr_meta = array(
		'date' 	=> $date_code,
		'year' 	=> $date_year,
		'month'	=> $date_month,
		'month_en'	=> $date_month_en,
		'month_en_full'	=> $date_month_en_full,
		'day'	=> $date_day,
		'day_double' => $date_day_double,
		'week_day'	=> $week_day,
		'cats' => $cats_code,
		'tags' => $tags_code,
		'comments' => $comment_code,
		'views' => $views_code,
		'author' => $author_code,
		'cat_color_class'	=> $cat_color_class);

	return $arr_meta;
}


/*******************************************************
* Meta content for single page
*******************************************************/
function get_post_meta_for_single_page() { 
	// Exception page
	$post_type_name = esc_html(get_post_type_object(get_post_type())->name);
	if (post_password_required() || $post_type_name == 'topic' || $post_type_name == 'forum' || $post_type_name == 'forums' ) return;

	global $options, $post, $IS_MOBILE_DP;

	$arr_meta = array();
	$prefix_name	= '';
	$avatar_img		= '';
	$date_year 		= '';
	$date_month 	= '';
	$date_month_en 	= '';
	$date_day 		= '';
	$week_day		= '';
	$date_code 		= '';
	$last_update 	= '';
	$tags_code		= '';
	$cats_code		= '';
	$cat_one_code 	= '';
	$comment_code 	= '';
	$post_comment_code = '';
	$time_for_reading_code = '';
	$views_code 	= '';
	$author_code	= '';
	$sns_btn_code 	= '';
	$edit_code 		= '';
	$cat_color_class = '';

	// GET THE POST TYPE
	$post_type = get_post_type();

	// Post parameters
	$dp_hide_date 				= get_post_meta(get_the_ID(), 'dp_hide_date', true);
	$dp_hide_author 			= get_post_meta(get_the_ID(), 'dp_hide_author', true);
	$dp_hide_cat 				= get_post_meta(get_the_ID(), 'dp_hide_cat', true);
	$dp_hide_tag 				= get_post_meta(get_the_ID(), 'dp_hide_tag', true);
	$dp_hide_views 				= get_post_meta(get_the_ID(), 'dp_hide_views', true);
	$dp_hide_fb_comment 		= get_post_meta(get_the_ID(), 'dp_hide_fb_comment', true);
	$dp_star_rating_enable 		= get_post_meta(get_the_ID(), 'dp_star_rating_enable', true);
	$hide_sns_icon 				= get_post_meta(get_the_ID(), 'hide_sns_icon', true);
	$dp_hide_time_for_reading	= get_post_meta(get_the_ID(), 'dp_hide_time_for_reading', true);

	// Common parametaers
	$time_for_reading 			= $options['time_for_reading'];
	$show_pubdate_on_meta 		= $options['show_pubdate_on_meta'];
	$show_pubdate_on_meta_page 	= $options['show_pubdate_on_meta_page'];
	$show_last_update 			= $options['show_last_update'];
	$show_author_on_meta 		= $options['show_author_on_meta'];
	$show_author_on_meta_page 	= $options['show_author_on_meta_page'];
	$show_tags 					= $options['show_tags'];
	$show_views_on_meta 		= $options['show_views_on_meta'];
	$show_cat_on_meta 			= $options['show_cat_on_meta'];


	// Post date
	if ((( is_single() && $show_pubdate_on_meta ) || ( is_page() && $show_pubdate_on_meta_page )) && !$dp_hide_date) {

		$date_year 			= '<span class="date_year">'.get_post_time('Y').'</span>';
		$date_month 		= '<span class="date_month">'.get_post_time('n').'</span>';
		$date_month_en 		= '<span class="date_month_en">'.get_post_time('M').'</span>';
		$date_month_en_full = '<span class="date_month_en_full">'.get_post_time('F').'</span>';
		$date_day 			= '<span class="date_day">'.get_post_time('j').'</span>';
		$date_day_double 	= '<span class="date_day_double">'.get_post_time('d').'</span>';
		$week_day 			= '<span class="date_week_day">'.get_post_time('D').'</span>';

		if ($options['date_reckon_mode']) {
			$date_code = published_diff();
		} else if ((bool)$options['date_eng_mode']) {
			$date_code = $date_day.' '.$date_month_en_full. ', '.$date_year;
		} else {
			$date_code = get_the_date();
		}
		$date_code = '<time datetime="'. get_the_date('c').'" class="updated icon-clock">'.$date_code;
		// Last update
		if ( $show_last_update && ( get_the_modified_date() != get_the_date()) ) {
			$last_update = ' (Last Update:'.get_the_modified_date().')';
		}
		$date_code .= '</time>';
	}

	// Comment
	if ( $post->comment_status == 'open' && !is_page() ) {
		$comment_code = '<div class="meta meta-comment icon-comment">'. get_comments_popup_link(
			'No comment',
			'1 Comment', 
			'% Commentes').'</div>';
		$post_comment_code = '<div class="meta leave-comment icon-edit"><a href="#respond">Leave a comment</a></div>';
	}

	// Views
	if ( $post_type === 'post' && $show_views_on_meta && !$dp_hide_views) {
		$views_code = '<div class="meta meta-views">'.dp_get_post_views(get_the_ID(), null).' views</div>';
	}

	// Author
	if ((( $post_type === 'post' && $show_author_on_meta ) || ( $post_type === 'page' && $show_author_on_meta_page )) && !$dp_hide_author ) {
		$this_author = get_userdata($post->post_author);
		if ((bool)$options['show_author_avatar']) {
			$avatar_img = get_avatar( $this_author->ID, 90 );
		} else {
			$prefix_name = '<span class="author-by">By </span>';
		}
		$author_code = '<div class="meta meta-author vcard">'.$prefix_name.'<a href="'.get_author_posts_url($this_author->ID).'" rel="author" title="'.__('Show articles of this user.', 'DigiPress').'" class="fn">'.$avatar_img.'<span class="name">'.$this_author->display_name.'</span></a></div>';
	}

	// Time for reading
	if ( $post_type === 'post' && $time_for_reading && !$dp_hide_time_for_reading) {
		$minutes = round(mb_strlen(strip_tags(get_the_content())) / 600) + 1;
		$time_for_reading_code = '<div class="meta time_for_reading icon-alarm">' . __('You can read this content about ', 'DigiPress') . $minutes . __(' minute(s)','DigiPress') . '</div>';
	}

	// Edit link
	if (is_user_logged_in() && current_user_can('level_10')) {
		$edit_code = ' | <a href="'.get_edit_post_link().'">Edit</a> | ';
	}
	
	// Category
	if ( $post_type === 'post' && $show_cat_on_meta && !$dp_hide_cat ) { 
		$cats = get_the_category();
		if ($cats) {
			// One category
			$cat_color_class = " cat-color".$cats[0]->cat_ID;
			$cat_one_code = '<div class="meta meta-cat"><a href="'.get_category_link($cats[0]->cat_ID).'" rel="tag" class="'.$cat_color_class.'">' .$cats[0]->cat_name.'</a></div>';
			// Whole categories
			foreach ($cats as $cat) {
				$cat_color_class = " cat-color".$cat->cat_ID;
				$cats_code .= '<a href="'.get_category_link($cat->cat_ID).'" rel="tag" class="'.$cat_color_class.'">' .$cat->cat_name.'</a>';
			}
			$cats_code = '<div class="meta meta-cat">' .$cats_code. '</div>';
		}
	}

	//Show tags
	if ( $show_tags && !$dp_hide_tag ) { 
		$tags = get_the_tags();
		if ($tags) {
			foreach ($tags as $tag) {
				$tags_code .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag" title="'.$tag->count.__(' topics of this tag.', 'DigiPress').'">'.$tag->name.'</a> ';
			}
			$tags_code = '<div class="meta meta-cat tag">'.$tags_code.'</div>';
		}
	}

	// SNS BUttons
	if ( !$hide_sns_icon ) {
		if ( $options['sns_button_type'] === 'original1') {
			$sns_btn_code = dp_show_sns_buttons_original('top', false);
		} else {
			$sns_btn_code = dp_show_sns_buttons('top', false);
		}
	}

	$arr_meta = array(
		'date' 	=> $date_code,
		'year' 	=> $date_year,
		'month'	=> $date_month,
		'month_en'	=> $date_month_en,
		'month_en_full'	=> $date_month_en_full,
		'day'	=> $date_day,
		'day_double' => $date_day_double,
		'week_day'	=> $week_day,
		'last_update' => $last_update,
		'cats' => $cats_code,
		'cat_one' => $cat_one_code,
		'tags' => $tags_code,
		'comments' => $comment_code,
		'post_comment' => $post_comment_code,
		'views' => $views_code,
		'author' => $author_code,
		'edit_link' => $edit_code,
		'time_for_reading' => $time_for_reading_code,
		'sns_btn'	=> $sns_btn_code);

	return $arr_meta;

}	// End function 
?>