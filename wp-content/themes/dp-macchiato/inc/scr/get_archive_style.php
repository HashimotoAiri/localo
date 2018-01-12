<?php
function dp_get_archive_style(){
	global $options, $ARCHIVE_STYLE, $IS_MOBILE_DP;

	// Archive flag
	$top_or_archive 	= is_home() ? 'top' : 'archive';
	// Params to return
	$layout 		= $options[$top_or_archive.'_post_show_type'];

	// Archive type
	$arhive_type	= esc_html(get_post_type_object(get_post_type())->name);
	if ($arhive_type === 'news' || $arhive_type == $options['news_cpt_slug_id'] ) {
		$arhive_type = 'news';
		$layout = $arhive_type;
	}

	// Check the category display style
	if (is_category()) {
		// Only category page
		if ($options['show_type_cat_normal'] && is_category(explode(',', $options['show_type_cat_normal']))) {
			$layout = 'normal';
		} else if ($options['show_type_cat_portfolio1'] && is_category(explode(',', $options['show_type_cat_portfolio1']))) {
			$layout = 'portfolio one';
		} else if ($options['show_type_cat_portfolio2'] && is_category(explode(',', $options['show_type_cat_portfolio2']))) {
			$layout = 'portfolio two';
		} else if ($options['show_type_cat_portfolio3'] && is_category(explode(',', $options['show_type_cat_portfolio3']))) {
			$layout = 'portfolio three';
		} else if ($options['show_type_cat_portfolio4'] && is_category(explode(',', $options['show_type_cat_portfolio4']))) {
			$layout = 'portfolio four';
		} else if ($options['show_type_cat_magazine1'] && is_category(explode(',', $options['show_type_cat_magazine1']))) {
			$layout = 'magazine one';
		} else if ($options['show_type_cat_magazine2'] && is_category(explode(',', $options['show_type_cat_magazine2']))) {
			$layout = 'magazine two';
		} else if ($options['show_type_cat_magazine3'] && is_category(explode(',', $options['show_type_cat_magazine3']))) {
			$layout = 'magazine three';
		}
	}
	
	$ARCHIVE_STYLE = array(
		'top_or_archive' 	=> $top_or_archive,
		'arhive_type'		=> $arhive_type,
		'layout'			=> $layout);
}
?>