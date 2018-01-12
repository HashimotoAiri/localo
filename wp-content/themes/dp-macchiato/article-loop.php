<?php 
// ***********************************
// Get archive style (/inc/scr/get_archive_style.php)
// return {$top_or_archive, $arhive_type, $layout}
//params before extraction
$top_or_archive = '';
extract($ARCHIVE_STYLE);

// Articles
if (is_home() && !(bool)$options['show_'.$top_or_archive.'_under_content']) return;

// Counter
$i = 0;

// Params
$html_code 		= '';
$loop_code 		= '';
$cat_name 		= '';
$more_url 		= '';
$page_desc		= '';
$mobile_class 	= '';
$suffix_mb 		= '';
$pattern_class 	= '';
$masonry_lines	= '';
$masony_gutter 	= '<div class="gutter_size"></div>';

// Column
$col_class = ' two-col';
if ($COLUMN_NUM == 1 ) {
	$col_class = ' one-col';
} else if ($COLUMN_NUM == 3) {
	$col_class = ' three-col';
}

// Mobile 
if ($IS_MOBILE_DP){
	$mobile_class 	= ' mobile';
	$suffix_mb	 	= '_mb';
	$col_class 		= '';
	$masonry_lines	= ' one_line';
	if (strpos($layout, 'portfolio') !== false) {
		$layout = 'portfolio mobile';
	} else if (strpos($layout, 'magazine') !== false) {
		$layout = 'normal';
	}
} else {
	if ($COLUMN_NUM !== 1 && $options[$top_or_archive.'_masonry_lines'] === 'four_lines') {
		$masonry_lines		= ' three_lines';
	} else {
		$masonry_lines		= ' '.$options[$top_or_archive.'_masonry_lines'];
	}
}

// wow.js
$wow_title_css 			= '';
$wow_article_css 		= '';
if (!(bool)$options['disable_wow_js'.$suffix_mb]){
	$wow_title_css 		= ' wow fadeInLeft';
	$wow_article_css 	= ' wow fadeInUp';
}

// Description
$arr_title = dp_current_page_title();
if (!empty($arr_title['desc'])) {
	$page_desc = '<div class="title-desc">'.$arr_title['desc'].'</div>';
}

// Flip mode
$flip_mode_class	= (bool)$options[$top_or_archive.'_show_flip_on_hover'] ? ' flip_hover' : '';
// Excerpt length
$excerpt_length		= $options[$top_or_archive.'_normal_excerpt_length'];
// Autopager flag
$autopager_class	= (bool)$options['autopager'.$suffix_mb] ? ' autopager' : '';
// No padding class
$no_padding_class = '';
if ((bool)$options[$top_or_archive.'_masonry_no_padding']){
	$no_padding_class = ' no-padding';
}


// Params
$args = array(
		'number' 	=> $options['number_posts_index'],
		'pub_date'	=> $options[$top_or_archive.'_archive_list_date'],
		'show_cat'	=> $options[$top_or_archive.'_archive_list_cat'],
		'views'		=> $options[$top_or_archive.'_archive_list_views'],
		'author'	=> $options[$top_or_archive.'_archive_list_author'],
		'hatebu_num'	=> $options['hatebu_number_after_title_'.$top_or_archive],
		'tweets_num'	=> $options['tweet_number_after_title_'.$top_or_archive],
		'likes_num'		=> $options['likes_number_after_title_'.$top_or_archive],
		'masonry_lines'	=> $masonry_lines,
		'post_type'	=> get_post_type(),
		'col_class' => $col_class,
		'type'		=> '',
		'more_text'	=> '',
		'voted_icon' => '',
		'voted_count' => false,
		'layout'	=> $layout,
		'excerpt_length' => $excerpt_length,
		'color_layer'	=> $options[$top_or_archive.'_cat_color_layer'],
		'wow_article_css'	=> $wow_article_css
		);

/**
 * Show post list
 *
 * Call the function written in "listing_post_styles.php"
 */
foreach( $posts as $post ) : setup_postdata($post);
	// Check the first or last
	// $first_post_class = $i === 0 ? ' first' : '';
	// $last_post_class = (($i + 1) == $args['number']) ? ' last': '';
	// even of odd
	// $even_odd_class = (++$i % 2 === 0) ? ' evenpost' : ' oddpost';

	// Add current flag class
	// $args['first_post_class'] =  $first_post_class;
	// $args['last_post_class'] =  $last_post_class;
	// $args['even_odd_class'] =  $even_odd_class;

	// Comment opened?
	$args['comment'] = comments_open();

	switch ($layout) {
		case 'normal':
			// Title length
			$args['title_length'] = 100;
			// Get post element (listing_post_styles.php)
			$arr_post_ele = dp_post_list_get_elements($args);
			// Get article html and display (listing_post_styles.php)
			$loop_code .= dp_show_post_list_for_archive_normal($args, $arr_post_ele);
			$masony_gutter = '';	// No masonry
			break;
		case 'portfolio one':
			$pattern_class = ' pt1';
			// Title length
			$args['title_length'] = 48;
			// Get post element (listing_post_styles.php)
			$arr_post_ele = dp_post_list_get_elements($args);
			// Get article html and display (listing_post_styles.php)
			$loop_code .= dp_show_post_list_for_archive_portfolio1($args, $arr_post_ele);
			break;
		case 'portfolio two':
			$pattern_class = ' pt2';
			// Title length
			$args['title_length'] = 72;
			// Get post element (listing_post_styles.php)
			$arr_post_ele = dp_post_list_get_elements($args);
			// Get article html and display (listing_post_styles.php)
			$loop_code .= dp_show_post_list_for_archive_portfolio2($args, $arr_post_ele);
			break;
		case 'portfolio mobile':
			$args['title_length'] = 52;
			$arr_post_ele = dp_post_list_get_elements($args);
			$loop_code .= dp_show_post_list_for_archive_portfolio_mb($args, $arr_post_ele);
			break;
		case 'magazine one':
			$pattern_class = ' pt1';
			// Title length
			$args['title_length'] = 82;
			// Get post element (listing_post_styles.php)
			$arr_post_ele = dp_post_list_get_elements($args);
			// Get article html and display (listing_post_styles.php)
			$loop_code .= dp_show_post_list_for_archive_magazine1($args, $arr_post_ele);
			break;
		case 'news':
			// Title length
			$args['title_length'] = 100;
			// Get post element (listing_post_styles.php)
			$arr_post_ele = dp_post_list_get_elements($args);
			// Get article html and display (listing_post_styles.php)
			$loop_code .= dp_show_post_list_for_archive_news($args, $arr_post_ele);
			break;
		default:
			$args['title_length'] = 100;
			$arr_post_ele = dp_post_list_get_elements($args);
			$loop_code .= dp_show_post_list_for_archive_normal($args, $arr_post_ele);
			break;
	}
endforeach;
// Reset Query
wp_reset_postdata();

/**
 * Artcle list section source
 */
$html_code = '<section class="loop-section '.$layout.$mobile_class.$masonry_lines.$no_padding_class.$flip_mode_class.$pattern_class.' clearfix">';
// ************************
// Main title (Only Top page)
// ************************
if (is_home()) {
	if ($options['top_posts_list_title'] && !is_paged()) {
		$html_code .= '<header class="loop-sec-header"><h1 class="inside-title'.$wow_title_css.'"><span>'.$options['top_posts_list_title'].'</span></h1></header>';
	} else {
		$html_code .= '<header class="loop-sec-header"><h1 class="inside-title'.$wow_title_css.'"><span>'.$arr_title['title'].'</span></h1></header>';
	}
}
// Whole html code
$html_code .= '<div class="loop-div autopager'.$col_class.' clearfix">'.$masony_gutter.$loop_code.'</div></section>';
// Display
echo $html_code;


// ***********************************
// Navigation
// ***********************************
$next_page_link = is_ssl() ? str_replace('http:', 'https:', get_next_posts_link($options['navigation_text_to_2page'])) : get_next_posts_link($options['navigation_text_to_2page']);
if (!empty($next_page_link)) :
	// Front page
	if ( $options['autopager'.$suffix_mb] || ( is_front_page() && !is_paged() ) ) : 
	?>
	<nav class="navigation clearfix"><div class="nav_to_paged"><?php echo $next_page_link; ?></div></nav>
	<?php 
	else: // Paged 
		if (function_exists('wp_pagenavi')) : 
	?>
	<nav class="navigation clearfix"><?php wp_pagenavi(); ?></nav>
	<?php 
		else : 
			if ($options['pagenation']) :
					dp_pagenavi('<nav class="navigation clearfix">', '</nav>');
			else : 
	?>
	<nav class="navigation clearfix">
	<div class="navialignleft"><?php previous_posts_link(__('<span class="nav-arrow icon-left-open"><span>PREV</span></span>', '')) ?></div>
	<div class="navialignright"><?php next_posts_link(__('<span class="nav-arrow icon-right-open"><span>NEXT</span></span>', '')) ?></div>
	</nav>
	<?php 
			endif; 	// end of $options['pagenation']
		endif;	// end of function_exists('wp_pagenavi')
	endif;	// $options['autopager'.$suffix_mb] || (is_front_page() && !is_paged())
endif;	// !empty($next_page_link)