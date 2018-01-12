<?php 
/**
 * Listing article styles for the widgets in container in archive page
 */
/**
 * Params
 */
function dp_post_list_get_elements($args) {

	global $post, $IS_MOBILE_DP;

	/**
	 * Init params
	 */
	// For 'extract($args)' params
	$meta_key 			= '';
	$voted_count 		= '';
	// Title
	$post_title 		= '';
	// Share number
	$hatebuNumberCode 	= '';
	$tweetCountCode		= '';
	$fbLikeCountCode	= '';
	$sns_insert_content = '';
	$sns_share_code 	= '';

	// Thumbnail
	$thumbnail_code	= '';
	//For thumbnail size
	$width = 800;
	$height = 800;

	// Viewed rank counter
	$counter 		= 0;

	// For Meta
	$footer_code 	= '';
	$meta_code 		= '';
	$desc 			= '';
	$ranking_code 	= '';
	$vimeo_hash 	= '';
	$embed_code 	= '';
	$arr_meta 		= array();

	// Return elements
	$arr_post_ele 	= array();

	// Extract params
	extract($args);

	// Post format
	$post_format = get_post_format($post->ID);
	// Post type
	$post_type = get_post_type();
	// Tag of the post
	$post_label = get_post_meta(get_the_ID(), 'dp_post_tag', true);
	// Tag color of the post
	$label_color = get_post_meta(get_the_ID(), 'dp_post_tag_color', true);
	// Video ID(YouTube only)
	$videoID = get_post_meta($post->ID, 'item_video_id', true);
	// Target video service
	$video_service = get_post_meta($post->ID, 'video_service', true);
	// Get icon class each post format
	$titleIconClass = !$post_format ? 'icon-link' : post_format_icon($post_format);
	// For media icon
	// $media_icon_code = '<div class="loop-media-icon"><span class="'.$titleIconClass.'"></span></div>';


	// Get post meta codes (Call this function written in "meta_info.php")
	$arr_meta = get_post_meta_for_listing_post_styles($args);

	// Ranking tag
	if (strpos($meta_key, 'post_views_count') !== false ) {
		$counter++;
		$ranking_code = '<span class="rank_label">'.$counter.'</span>';
	}

	// ************* SNS sahre number *****************
	// hatebu
	if ((bool)$hatebu_num) {
		$hatebuNumberCode = '<div class="bg-hatebu"><i class="icon-hatebu"></i><span class="share-num"></span></div>';
	}	
	// Count tweets
	// if ((bool)$tweets_num) {
	// 	$tweetCountCode = '<div class="bg-tweets"><i class="icon-twitter"></i><span class="share-num"></span></div>';
	// }
	// Count Facebook Like 
	if ((bool)$likes_num) {
		$fbLikeCountCode = '<div class="bg-likes"><i class="icon-facebook"></i><span class="share-num"></span></div>';
	}
	/***
	 * Filter hook
	 */
	$sns_insert_content = apply_filters( 'dp_top_insert_sns_content', get_the_ID() );
	if ($sns_insert_content == get_the_ID() || !is_string($sns_insert_content)) {
		$sns_insert_content = '';
	}

	// Whole share code
	$sns_share_code = ($hatebu_num || $tweets_num || $likes_num || !empty($sns_insert_content)) ? '<div class="loop-share-num">'.$fbLikeCountCode.$tweetCountCode.$hatebuNumberCode.$arr_meta['comments'].$sns_insert_content.'</div>' : '';
	

	// Post title
	$post_title =  the_title('', '', false) ? the_title('', '', false) : 'No Title'; //__('No Title', 'DigiPress');
	// Title
	$post_title = (mb_strlen($post_title, 'utf-8') > $title_length) ? mb_substr($post_title, 0, $title_length, 'utf-8') . '...' : $post_title;

	//Post excerpt
	if ((int)$excerpt_length !== 0) {
		$desc = strip_tags(get_the_excerpt());
		$desc = (mb_strlen($desc,'utf-8') > $excerpt_length) ? mb_substr($desc, 0, $excerpt_length,'utf-8').'...' : $desc;
		$desc = !empty($desc) ? '<div class="loop-excerpt entry-summary">'.$desc.'</div>' : '';
	}

	// Post tag(custom field)
	if ( !empty($post_label) ) {
		if ( !empty($label_color) ) {
			$label_color = ' style="background-color:'.$label_color.';"';
		} else {
			$label_color = '';
		}
		$post_label = '<div class="label_ft"'.$label_color.'>'.$post_label.'</div>';
	}

	// Ranking tag
	if (strpos($meta_key, 'post_views_count') !== false || !empty($voted_count) ) {
		$ranking_code = '<div class="rank_label thumb">'.$i.'</div>';
	}

	// Thumbail
	if (empty($videoID)) {
		$thumbnail_code = show_post_thumbnail(array("width"=>$width, "height"=>$height));
	} else {
		switch ($video_service) {
			case 'Vimeo':
				if ( WP_Filesystem() ) {
					global $wp_filesystem;
					$vimeo_hash = unserialize($wp_filesystem->get_contents("http://vimeo.com/api/v2/video/".$videoID.".php"));
					$thumbnail_code = $vimeo_hash[0]['thumbnail_large'];
					$thumbnail_code = '<img src="'.$thumbnail_code.'" class="wp-post-image" />';
					$embed_code = '<iframe src="//player.vimeo.com/video/'.$videoID.'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" class="emb"></iframe>';

				}
				break;
			case 'YouTube':
			default:
				$thumbnail_code = '<img src="//img.youtube.com/vi/'.$videoID.'/0.jpg" class="wp-post-image" />';
				$embed_code 	= '<iframe class="emb" src="//www.youtube.com/embed/'.$videoID.'/?wmode=transparent&hd=1&autohide=1&rel=0" frameborder="0" allowfullscreen></iframe>';
				break;
		}
	}

	// Return
	$arr_post_ele = array(
		'thumbnail_code'=> $thumbnail_code,
		'embed_code'	=> $embed_code,
		// 'media_icon_code' 	=> $media_icon_code,
		'post_title'	=> $post_title,
		'post_label'	=> $post_label,
		'ranking_code'	=> $ranking_code,
		'desc'			=> $desc,
		'meta_code'		=> $meta_code,
		'sns_share_code'	=> $sns_share_code,
		'arr_meta'		=> $arr_meta
		);

	return $arr_post_ele;
}
/*******************************************************
* Normal style
*******************************************************/
function dp_show_post_list_for_archive_normal($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post, $IS_MOBILE_DP;

	// init
	$desc 			= '';
	$title_line		= '';
	$meta_code1 	= '';
	$meta_code2		= '';
	$views_code 	= '';
	$sns_share_code = '';
	$more_code		= '';
	$js_code 		= '';
	$loop_code 		= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= $arr_meta['cat_color_class'];
	$views_code = $arr_meta['views'];
	$eyecatch_code = (!empty($embed_code) && !$IS_MOBILE_DP) ? $embed_code : '<a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'" class="thumb-link">'.$thumbnail_code.'</a>';
	$more_code = '<div class="more-link"><a href="'.$post_url.'" title="'.$esc_title.'"><span>Read More</span></a></div>';
	$js_code = '<script>j$(function(){get_sns_share_count("'.$post_url.'", "post-'.get_the_ID().'");});</script>';


	/**
	 * Article Source
	 */
	if ((bool)$IS_MOBILE_DP) {
		// Title
		$title_line = '<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>';
		// Date
		if (!empty($arr_meta['date'])) {
			if ((bool)$options['date_eng_mode']) {
				$date_code = '<div class="loop-date icon-clock"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].' '.$arr_meta['month_en'].', '.$arr_meta['year'].'</time></div>';
			} else {
				$date_code = $arr_meta['date'];
			}
		} else {
			$date_code = '';
		}

		if (!empty($date_code) || !empty($arr_meta['author']) || !empty($views_code)) {
			$meta_code1 = '<div class="loop-meta clearfix">'.$date_code.$arr_meta['author'].$views_code.'</div>';
		}
		$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$wow_article_css.'"><div class="loop-col one"><div class="loop-post-thumb '.$layout.'">'.$eyecatch_code.$post_label.'</div><div class="loop-article-content">'.$title_line.$arr_meta['cats'].'</div></div><div class="loop-col two">'.$meta_code1.$sns_share_code.'</div>'.$js_code.'</article>';

	} else {
		// Date + title
		if (!empty($arr_meta['date'])) {
			$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
			$title_line = '<div class="title-line">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1></div>';
		} else {
			$date_code = '';
			$title_line = '<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>';
		}

		// meta
		if (!empty($arr_meta['author']) || !empty($views_code) || !empty($arr_meta['cats'])) {
			$meta_code1 = '<div class="loop-meta clearfix">'.$arr_meta['author'].$arr_meta['cats'].$views_code.'</div>';
		}
		$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$wow_article_css.'"><div class="loop-col one"><div class="loop-post-thumb '.$layout.'">'.$eyecatch_code.$post_label.'</div></div><div class="loop-col two"><div class="loop-article-content">'.$title_line.$meta_code1.$desc.$sns_share_code.$more_code.'</div></div>'.$js_code.'</article>';
	}
	
	return $loop_code;
}

/*******************************************************
* Portfolio style part 1
*******************************************************/
function dp_show_post_list_for_archive_portfolio1($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post, $IS_MOBILE_DP;

	// init
	$color_layer		= false;
	$date_code			= '';
	$post_label 		= '';
	$views_code 		= '';
	$sns_share_code 	= '';
	$loop_code 			= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= (bool)$color_layer ? $arr_meta['cat_color_class'] : ' no-cat-color';
	$no_cat_flag = empty($arr_meta['cats']) ? ' no-cat' : '';
	$js_code 	= '<script>j$(function(){get_sns_share_count("'.$post_url.'", "post-'.get_the_ID().'");});</script>';
	$h1_fix_class = '';
	
	// Date
	if (!empty($arr_meta['date'])) {
		$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].'<div class="date-my">'.$arr_meta['month_en'].$arr_meta['year'].'</div></time></div>';
	}

	// For fix centering class
	if (!empty($arr_meta['author'])) {
		$h1_fix_class = ' fix-v';
	}

	/**
	 * Article Source
	 */
	$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$no_cat_flag.$masonry_lines.$wow_article_css.'"><div class="loop-post-thumb '.$layout.'"><a href="'.$post_url.'" rel="bookmark" class="thumb-link">'.$thumbnail_code.'</a><div class="loop-post-thumb-flip'.$cat_class.'"></div><div class="loop-article-content"><div class="loop-table"><div class="loop-header"><h1 class="entry-title loop-title '.$layout.$h1_fix_class.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>'.$arr_meta['cats'].$arr_meta['author'].'</div></div>'.$date_code.$post_label.$arr_meta['views'].$sns_share_code.'</div></div>'.$js_code.'</article>';

	return $loop_code;
}

/*******************************************************
* Portfolio style part 2
*******************************************************/
function dp_show_post_list_for_archive_portfolio2($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post;

	// init
	$color_layer		= false;
	$date_code 			= '';
	$post_label 		= '';
	$views_code 		= '';
	$sns_share_code 	= '';
	$loop_code 			= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= (bool)$color_layer ? $arr_meta['cat_color_class'] : '';
	$cat_code 	= $arr_meta['cats'];
	$no_cat_flag = empty($arr_meta['cats']) ? ' no-cat' : '';
	$js_code 	= '<script>j$(function(){get_sns_share_count("'.$post_url.'", "post-'.get_the_ID().'");});</script>';
	
	// Date
	if (!empty($arr_meta['date'])) {
		$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
	}

	// For fix centering class
	if (!empty($arr_meta['author'])) {
		$cat_code = '<div class="fix-v">'.$cat_code.'</div>';
	}

	/**
	 * Article Source
	 */
	$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$no_cat_flag.$masonry_lines.$wow_article_css.'"><div class="loop-post-thumb '.$layout.'"><a href="'.$post_url.'" rel="bookmark" class="thumb-link">'.$thumbnail_code.'</a><div class="loop-post-thumb-flip'.$cat_class.'"></div><div class="loop-article-content"><div class="loop-table"><div class="loop-header">'.$cat_code.$sns_share_code.$arr_meta['author'].'</div></div>'.$post_label.$arr_meta['views'].'</div></div><div class="outer-thumb">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1></div>'.$js_code.'</article>';

	return $loop_code;
}

/*******************************************************
* Portfolio style for mobile
*******************************************************/
function dp_show_post_list_for_archive_portfolio_mb($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post;

	// init
	$color_layer		= false;
	$date_code 			= '';
	$post_label 		= '';
	$views_code 		= '';
	$sns_share_code 	= '';
	$loop_code 			= '';
	$author_views 		= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= (bool)$color_layer ? $arr_meta['cat_color_class'] : '';
	$cat_code 	= $arr_meta['cats'];
	$no_cat_flag = empty($arr_meta['cats']) ? ' no-cat' : '';
	$js_code 	= '<script>j$(function(){get_sns_share_count("'.$post_url.'", "post-'.get_the_ID().'");});</script>';
	
	// Date
	if (!empty($arr_meta['date'])) {
		$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
	}

	// For fix centering class
	if (!empty($cat_code)) {
		$cat_code = '<div class="loop-table"><div class="loop-header">'.$cat_code.'</div></div>';
	}

	if (!empty($arr_meta['author']) || !empty($arr_meta['views'])) {
		$author_views = '<div class="meta-blk-one">'.$arr_meta['author'].$arr_meta['views'].'</div>';
	}

	/**
	 * Article Source
	 */
	$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$no_cat_flag.$masonry_lines.$wow_article_css.'"><div class="loop-post-thumb '.$layout.'"><a href="'.$post_url.'" rel="bookmark" class="thumb-link">'.$thumbnail_code.'</a><div class="loop-article-content">'.$cat_code.$post_label.'</div></div><div class="outer-thumb">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>'.$author_views.$sns_share_code.'</div>'.$js_code.'</article>';

	return $loop_code;
}

/*******************************************************
* Magazine style part 1
*******************************************************/
function dp_show_post_list_for_archive_magazine1($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post, $IS_MOBILE_DP;

	// init
	$title_line			= '';
	$date_code			= '';
	$post_label 		= '';
	$views_code 		= '';
	$meta_code			= '';
	$sns_share_code 	= '';
	$loop_code 			= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= $arr_meta['cat_color_class'];
	$cat_code 	= $arr_meta['cats'];
	$no_cat_flag = empty($arr_meta['cats']) ? ' no-cat' : '';
	$js_code 	= '<script>j$(function(){get_sns_share_count("'.$post_url.'", "post-'.get_the_ID().'");});</script>';

	$eyecatch_code = !empty($embed_code) ? $embed_code : '<a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'" class="thumb-link">'.$thumbnail_code.'</a>'; 
	
	// Date
	if (!empty($arr_meta['date'])) {
		$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
		$title_line = '<div class="title-line">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1></div>';
	} else {
		$date_code = '';
		$title_line = '<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>';
	}

	// Meta
	if (!empty($arr_meta['author']) || !empty($arr_meta['views'])) {
		$meta_code = '<div class="loop-meta">'.$arr_meta['author'].$arr_meta['views'].'</div>';
	}

	/**
	 * Article Source
	 */
	$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$col_class.$cat_class.$no_cat_flag.$masonry_lines.$wow_article_css.'"><div class="loop-post-thumb '.$layout.'">'.$eyecatch_code.$post_label.'</div><div class="loop-article-content">'.$title_line.$cat_code.'</div>'.$desc.$meta_code.'<div class="more-link"><a href="'.$post_url.'" title="'.$esc_title.'"><span>Read More</span></a></div>'.$sns_share_code.$js_code.'</article>';

	return $loop_code;
}

/*******************************************************
* Slider style
*******************************************************/
function dp_show_post_list_for_archive_slider($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post, $IS_MOBILE_DP;

	// init
	$post_label 		= '';
	$sns_share_code 	= '';
	$date_code 			= '';
	$loop_code 			= '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');
	$cat_class	= $arr_meta['cat_color_class'];
	$no_cat_flag = empty($arr_meta['cats']) ? ' no-cat' : '';
	$js_code 	= '<script>j$(function(){get_sns_share_count("'.get_permalink().'", "post-'.get_the_ID().'");});</script>';


	// For fix centering class
	if (!empty($arr_meta['author'])) {
		$h1_fix_class = ' fix-v';
	}

	/**
	 * Article Source
	 */
	if ($IS_MOBILE_DP) {
		// date
		if (!empty($arr_meta['date'])) {
			$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
		}
		$loop_code .= 
'<li id="post-'.get_the_ID().'" class="slide loop-article'.$col_class.$cat_class.'"><div class="loop-post-thumb '.$layout.'"><a href="'.$post_url.'" rel="bookmark" class="thumb-link">'.$thumbnail_code.'</a><div class="loop-article-content"><div class="loop-table"><div class="loop-header">'.$arr_meta['cats'].$arr_meta['views'].$post_label.'</div></div></div></div><div class="loop-meta">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>'.$arr_meta['author'].$sns_share_code.'</div>'.$js_code.'</li>';
	} else {
		// Date
		if (!empty($arr_meta['date'])) {
			$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].'<div class="date-my">'.$arr_meta['month_en'].$arr_meta['year'].'</div></time></div>';
		}

		$loop_code .= 
'<li id="post-'.get_the_ID().'" class="slide loop-article'.$col_class.$cat_class.'"><div class="loop-post-thumb '.$layout.'"><a href="'.$post_url.'" rel="bookmark" class="thumb-link">'.$thumbnail_code.'</a><div class="loop-post-thumb-flip'.$cat_class.'"></div><div class="loop-article-content"><div class="loop-table"><div class="loop-header"><h1 class="entry-title loop-title '.$layout.$h1_fix_class.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>'.$arr_meta['cats'].$arr_meta['author'].'</div></div>'.$date_code.$arr_meta['views'].$post_label.$sns_share_code.'</div></div>'.$js_code.'</li>';
	}
	
	return $loop_code;
}
/*******************************************************
* News style
*******************************************************/
function dp_show_post_list_for_archive_news($args = array(), $arr_post_ele = array()) {
	if (empty($args) && empty($arr_post_ele)) return;
	global $options, $post, $IS_MOBILE_DP;

	// init
	$loop_code = '';

	extract($args);
	extract($arr_post_ele);	// Including $arr_meta

	$post_url	= get_permalink();
	$esc_title	= the_title_attribute('before=&after=&echo=0');

	// Date
	if (!empty($arr_meta['date'])) {
		if ((bool)$options['date_eng_mode']) {
			$date_code = '<div class="loop-date"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].' '.$arr_meta['month_en'].', '.$arr_meta['year'].'</time></div>';
		} else {
			$date_code = $arr_meta['date'];
		}
	} else {
		$date_code = '';
	}

	/**
	 * Article Source
	 */
	$loop_code .= 
'<article id="post-'.get_the_ID().'" class="loop-article'.$wow_article_css.'">'.$date_code.'<h1 class="entry-title loop-title '.$layout.'"><a href="'.$post_url.'" rel="bookmark" title="'.$esc_title.'">'.$post_title.'</a></h1>'.$arr_meta['author'].'</article>';

	return $loop_code;
}
?>