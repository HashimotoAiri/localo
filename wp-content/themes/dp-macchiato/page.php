<?php 
// **********************************
// Header (main-wrap > container > content)
// **********************************
get_header();

//For thumbnail size
$width = 1680;
$height = 1200;

// Static page class
$page_class = is_page() ? '_page' : '';

// Col class
$col_class = ' two-col';
if ( $COLUMN_NUM === 1 ) {
	$col_class = ' one-col';
}

// wow.js
$wow_title_css 		= '';
$wow_eyecatch_css 	= '';
if (!(bool)$options['disable_wow_js']){
	$wow_title_css		= ' wow fadeInLeft';
	$wow_eyecatch_css 	= ' wow fadeInUp';
}

// **********************************
// Params
// **********************************
// Common Parameters
$show_eyecatch_first 	= $options['show_eyecatch_first'];
$next_prev_in_same_cat 	= $options['next_prev_in_same_cat'];

// Base settings
$show_pubdate_on_meta 	= $options['show_pubdate_on_meta'.$page_class];
$show_author_on_meta	= $options['show_author_on_meta'.$page_class];

// Meta under the title
$show_date_under_post_title = $options['show_date_under_post_title'];
$show_views_under_post_title = $options['show_views_under_post_title'];
$show_author_under_post_title = $options['show_author_under_post_title'];
$show_cat_under_post_title 	= $options['show_cat_under_post_title'];
$sns_button_under_title 	= $options['sns_button_under_title'];

// Meta bottom
$show_date_on_post_meta 	= $options['show_date_on_post_meta'];
$show_views_on_post_meta 	= $options['show_views_on_post_meta'];
$show_author_on_post_meta 	= $options['show_author_on_post_meta'];
$show_cat_on_post_meta 		= $options['show_cat_on_post_meta'];
$sns_button_on_meta 		= $options['sns_button_on_meta'];


// **********************************
// show posts
// **********************************
if (have_posts()) :
	// Count Post View
	if (function_exists('dp_count_post_views')) {
		dp_count_post_views(get_the_ID(), true);
	}

	// get post type
	$post_type 			= get_post_type();
	// Post format
	$post_format 		= get_post_format();
	// Title
	$post_title 		=  the_title('', '', false) ? the_title('', '', false) : __('No Title', 'DigiPress');
	// Hide title flag
	$hide_title 		= get_post_meta(get_the_ID(), 'dp_hide_title', true);
	// Show eyecatch on top 
	$show_eyecatch_force 	= get_post_meta(get_the_ID(), 'dp_show_eyecatch_force', true);
	// Show eyecatch upper the title
	$eyecatch_on_container 	= get_post_meta(get_the_ID(), 'dp_eyecatch_on_container', true);
	// Hide author name
	$hide_author 		= get_post_meta(get_the_ID(), 'dp_hide_author', true);
	// Hide data flag
	$dp_hide_date 			= get_post_meta(get_the_ID(), 'dp_hide_date', true);
	$show_pubdate_on_meta 	= $options['show_pubdate_on_meta'];

	// **********************************
	// Get post meta codes (Call this function written in "meta_info.php")
	// **********************************
	$date_code		= '';
	$first_row		= '';
	$second_row		= '';
	$sns_code 		= '';
	$meta_code_top 	= '';
	$meta_code_end 	= '';

	// **********************************
	//  Create meta data
	// **********************************
	if (!(bool)post_password_required()) {
		$arr_meta = get_post_meta_for_single_page();
		// **********************************
		//  Meta No.1
		// **********************************
		// Date
		if ((bool)$show_date_under_post_title && !empty($arr_meta['date'])) {
			$date_code = '<div class="meta meta-date'.$wow_title_css.'"><time datetime="'.get_the_date('c').'" class="updated">'.$arr_meta['day_double'].$arr_meta['month_en'].'</time></div>';
		}
		// Author
		if ((bool)$show_author_under_post_title ) {
			$first_row = $arr_meta['author'];
		}
		// edit link
		$first_row .= $arr_meta['edit_link'];
		// First row
		if (!empty($first_row)) {
			$first_row = '<div class="first_row clearfix">'.$first_row.'</div>';
		}
		//*** filter hook
		if ( $post_type === 'page' ) {
			$filter_top_first = apply_filters('dp_single_meta_top_first', get_the_ID());
			if (!empty($filter_top_first) && $filter_top_first != get_the_ID()) {
				$first_row .= $filter_top_first;
			}
		}
		
		// SNS buttons
		if ((bool)$sns_button_under_title) {
			$sns_code = $arr_meta['sns_btn'];
		}
		//*** filter hook
		if ( $post_type === 'page' ) {
			$filter_top_end = apply_filters('dp_single_meta_top_end', get_the_ID());
			if (!empty($filter_top_end) && $filter_top_end != get_the_ID()) {
				$first_row .= $filter_top_end;
			}
		}
		// meta on top
		if (!empty($first_row) || !empty($sns_code)) {
			$meta_code_top = '<div class="single_post_meta icon-dot">'.$first_row.$sns_code.'</div>';
		}

		// **********************************
		//  Meta No.2
		// **********************************
		// Reset params
		$first_row		= '';
		$second_row 	= '';
		$sns_code 		= '';
		//*** filter hook
		if ( $post_type === 'page' ) {
			$filter_bottom_first = apply_filters('dp_single_meta_bottom_first', get_the_ID());
			if (!empty($filter_bottom_first) && $filter_bottom_first != get_the_ID()) {
				$first_row = $filter_bottom_first;
			}
		}
		// Third row
		if (!empty($first_row)) {
			$first_row = '<div class="first_row">'.$first_row.'</div>';
		}

		// Date
		if ((bool)$show_date_on_post_meta && !empty($arr_meta['date'])) {
			$second_row = '<div class="meta meta-date">'.$arr_meta['date'].$arr_meta['last_update'].'</div>';
		}
		// Author
		if ((bool)$show_author_on_post_meta ) {
			$second_row .= $arr_meta['author'];
		}
		// edit link
		$second_row .= $arr_meta['edit_link'];
		// First row
		if (!empty($second_row)) {
			$second_row = '<div class="second_row">'.$second_row.'</div>';
		}

		//*** filter hook
		if ( $post_type === 'page' ) {
			$filter_bottom_end = apply_filters('dp_single_meta_bottom_end', get_the_ID());
			if (!empty($filter_bottom_end) && $filter_bottom_end != get_the_ID()) {
				$second_row .= $filter_bottom_end;
			}
		}
		// SNS buttons
		if ((bool)$sns_button_on_meta) {
			$sns_code = $arr_meta['sns_btn'];
		}
		// meta on bottom
		if (!empty($sns_code) || !empty($first_row) || !empty($second_row) ) {
			$meta_code_end = '<footer class="single_post_meta bottom icon-dot">'.$sns_code.$first_row.$second_row.'</footer>';
		}
	}

	// ***********************************
	// Article area start
	// ***********************************
	while (have_posts()) : the_post(); 
?>
<article id="<?php echo $post_type.'-'.get_the_ID(); ?>" <?php post_class('single-article'); ?>>
<?php 
		if ( !(empty($date_code) && empty($meta_code_top)) ) :
?>
<header class="sb-<?php echo $SIDEBAR_FLOAT.$col_class; ?>">
<?php 	
		// Date
		echo $date_code; 
		// ***********************************
		// Post meta info
		// ***********************************
		echo $meta_code_top;
?>
</header>
<?php 
		endif;	// !(empty($date_code) && empty($meta_code_top))
		// ***********************************
		// Single header widget
		// ***********************************
		if (($post_type === 'page') && is_active_sidebar('widget-post-top') && !post_password_required()) : 
?>
<div class="widget-content single clearfix"><?php dynamic_sidebar( 'widget-post-top' ); ?></div>
<?php 
		endif;	// End of widget

		// ***********************************
		// Main entry
		// *********************************** ?>
<div class="entry entry-content">
<?php
		// ***********************************
		// Show eyecatch image
		// ***********************************
		$flag_eyecatch_first = false;
		if ( has_post_thumbnail() && $post_type === 'page' ) {
			 if ( $show_eyecatch_first ) {
			 	if ( !($show_eyecatch_force && $eyecatch_on_container) ) {
			 		$flag_eyecatch_first = true;
				}
			 } else {
				if ( $show_eyecatch_force && !$eyecatch_on_container ) {
					$flag_eyecatch_first = true;
				}
			 }
		}

		if ( $flag_eyecatch_first ) {
			if ( $COLUMN_NUM == 1 ) {
				$width 	= 1680;
				$height	= 1200;
			}
			$image_id	= get_post_thumbnail_id();
			$image_data	= wp_get_attachment_image_src($image_id, array($width, $height), true);
			$image_url 	= is_ssl() ? str_replace('http:', 'https:', $image_data[0]) : $image_data[0];
			$img_tag	= '<img src="'.$image_url.'" class="wp-post-image aligncenter" alt="'.strip_tags(get_the_title()).'"  />';
			echo '<div class="eyecatch-under-title'.$wow_eyecatch_css.'">' . $img_tag . '</div>';
		}

		// Content
		the_content();

		// ***********************************
		// Paged navigation
		// ***********************************
		$link_pages = wp_link_pages(array(
										'before' => '', 
										'after' => '', 
										'next_or_number' => 'number', 
										'echo' => '0'));
		if ( $link_pages != '' ) {
			echo '<nav class="navigation"><div class="dp-pagenavi clearfix">';
			if ( preg_match_all("/(<a [^>]*>[\d]+<\/a>|[\d]+)/i", $link_pages, $matched, PREG_SET_ORDER) ) {
				foreach ($matched as $link) {
					if (preg_match("/<a ([^>]*)>([\d]+)<\/a>/i", $link[0], $link_matched)) {
						echo "<a class=\"page-numbers\" {$link_matched[1]}><span>{$link_matched[2]}</span></a>";
					} else {
						echo "<span class=\"page-numbers current\">{$link[0]}</span>";
					}
				}
			}
			echo '</div></nav>';
		}
?>
</div><?php 	// End of class="entry"

		// ***********************************
		// Single footer widget
		// ***********************************
		if ( $post_type === 'page' && is_active_sidebar('widget-post-bottom') && !post_password_required()) : 
?>
<div class="widget-content single clearfix"><?php dynamic_sidebar( 'widget-post-bottom' ); ?></div>
<?php
		endif;

		// **********************************
		// Meta
		// **********************************
		echo $meta_code_end;
?>
</article>
<?php 
		// ***********************************
		// Comments
		// ***********************************
		comments_template();
	endwhile;	// End of (have_posts())

	// ***********************************
	// Content bottom widget
	// ***********************************
	if (is_active_sidebar('widget-content-bottom')) : 
?>
<div class="widget-content bottom clearfix">
<?php dynamic_sidebar( 'widget-content-bottom' ); ?>
</div>
<?php 
	endif;
else :	// have_posts()
	// Not found...
	include_once(TEMPLATEPATH .'/not-found.php');
endif;	// End of have_posts()
?>
</div><?php // end of .content
// **********************************
// Sidebar
// **********************************
if ( $COLUMN_NUM === 2 ) get_sidebar();
// **********************************
// Footer
// **********************************
get_footer();
?>