<?php
/****************************************************************
* Disable auto paragraph
****************************************************************/
function dp_remove_wpauto($content) {
	global $post, $options;

	if ($options['disable_auto_format'] || (is_singular() && get_post_meta(get_the_ID(), 'disable_wpautop', true) ) ) {
		remove_filter('the_title', 'wptexturize');
		remove_filter('the_content', 'wptexturize');
		remove_filter('the_excerpt', 'wptexturize');
		remove_filter('the_title', 'wpautop');
		remove_filter('the_content', 'wpautop');
		remove_filter('the_excerpt', 'wpautop');
		remove_filter('the_editor_content', 'wp_richedit_pre');

		if ($options['replace_p_to_br'] || (is_singular() && get_post_meta(get_the_ID(), 'replace_p_to_br', true) )) {
			$content = nl2br($content);
		}
	}
	
	return $content;
}
add_action('the_content', 'dp_remove_wpauto', 7);
// add_action('the_excerpt', 'dp_remove_wpauto', 7);


function dp_tiny_mce_disable_auto_fix_tag($init) {
	global $post, $options;

	if ($options['disable_auto_format'] || (is_singular() && get_post_meta(get_the_ID(), 'disable_wpautop', true) ) ) {
		$init['wpautop'] = false;
		$init['apply_source_formatting'] = ture;
	}
	return $init;
}
add_filter('tiny_mce_before_init', 'dp_tiny_mce_disable_auto_fix_tag');	