<?php
/*******************************************************
* title tag
*******************************************************/
/** ===================================================
* Create site title tag.
*
* @param	string $before_tag 	before title
* @param	string $end_tag 	after title
* @return	none
*/
function dp_site_title($before_tag="", $end_tag="", $if_echo = true) {
	global $options;

	$sitename = get_bloginfo('name');
	$separate = " | ";

	if ($options['enable_title_site_name'] == true ) {
		if (is_home()) {
			$sitename = $options['title_site_name_top'];
		} else {
			$sitename = $options['title_site_name'];
		}
		$separate = $options['title_site_name_separate'];
	}

	if ($if_echo) {
		echo dp_create_title($sitename, $separate, $before_tag, $end_tag);
	} else {
		return dp_create_title($sitename, $separate, $before_tag, $end_tag);
	}
}

/*******************************************************
* h2 tag
*******************************************************/
/** ===================================================
* Create h2 title tag.
*
* @param	none
* @return	none
*/
function dp_h2_title($before = '<h2>', $after = '</h2>') {
	global $options;

	$caption = get_bloginfo('name');

	if ($options['enable_h2_title']) {
		$caption = htmlspecialchars_decode($options['h2_title']);
	}
	if (!empty($caption)) {
		$caption = $before . $caption . $after;
	} else {
		$caption = '';
	}
	return $caption;
}

/*******************************************************
* create title
*******************************************************/
/** ===================================================
* Create site title tag.
*
* @param	string $before_tag 	before title
* @param	string $end_tag 	after title
* @return	string $return_code HTML tag
*/
function dp_create_title($sitename, $separate, $before_tag="", $end_tag="") {
	$return_code = '';
	$title = '';

	if (is_home()) {
		if (is_paged()) {
			$title = $sitename . $separate
				. 'Page ' .  intval(get_query_var('paged'));
			$sitename = '';
		}
	} else if (is_category()) {
		if (is_paged()) {
			$title = wp_title('', false, 'right') 
				. '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = wp_title($separate, false, 'right');
		}
	} else if (is_year()) {
		if (is_paged()) {
			$title =  __('Archive of the year ', 'DigiPress') 
				. get_the_time(__('Y', 'DigiPress')) 
				.'( ' .  intval(get_query_var('paged')) . ' )' 
				. $separate;
		} else {
			$title = __('Archive of the year ', 'DigiPress') 
				. get_the_time(__('Y', 'DigiPress'))
				. $separate;
		}
	} else if (is_month()) {
		if (is_paged()) {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n', 'DigiPress'))
				. '( ' . intval(get_query_var('paged')) . ' )' 
				. $separate;
		} else {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n', 'DigiPress')) 
				. $separate;
		}
	} else if (is_day()) {
		if (is_paged()) {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n/j', 'DigiPress')) 
				. '( ' . intval(get_query_var('paged')) . ' )'
				. $separate;
		} else {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n/j', 'DigiPress'))
				. $separate;
		}
	} else if (is_time()) {
		if (is_paged()) {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n/j', 'DigiPress'))
				. '( ' . intval(get_query_var('paged')) . ' )'
				. $separate;
		} else {
			$title = __('Archive of the ', 'DigiPress') 
				. get_the_time(__('Y/n/j', 'DigiPress'))
				. $separate;
		}
	} else if (is_tag()) {
		if (is_paged()) {
			$title = wp_title(__(' Tagged posts:', 'DigiPress'), false, 'right') 
				. '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = wp_title(__(' Tagged posts:', 'DigiPress'), false, 'right') 
				. $separate;
		}
	} else if (is_search()) {
		if (is_paged()) {
			$title = wp_title('', false, 'right') 
				. '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = wp_title($separate, false, 'right');
		}
	} else if (is_author()) {
		if (is_paged()) {
			$title = get_the_author_meta('display_name') . __('\'s articles', 'DigiPress') . '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = get_the_author_meta('display_name') . __('\'s articles', 'DigiPress') . $separate;
		}
	} else if (is_singular()) {
		if (is_paged()) {
			$title = wp_title('', false, 'right') 
				. '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = wp_title($separate, false, 'right');
		}
	} else if (is_404()) {
		$title = __("Not Found.", 'DigiPress') . $separate;
	} else {
		if (is_paged()) {
			$title = wp_title('', false, 'right') 
				. '( ' . intval(get_query_var('paged')) . ' )' . $separate;
		} else {
			$title = wp_title($separate, false, 'right');
		}
	}

	//title HTML tag
	$return_code =  $before_tag . $title . $sitename . $end_tag;
	return $return_code;
}

// *******************************************************
// * Current page title
// *******************************************************/
function dp_current_page_title() {
	$title 	= '';
	$desc	= '';

	if (is_category()){
		$title = wp_title('', false);
		$desc = category_description();
		if (empty($desc)) {
			$desc = 'Category';
		}
	} else if (is_date()) {
		$desc = 'Date';
		if (is_year()) {
			$title = get_post_time('Y');
			$desc = 'Year';
		} else if (is_month()) {
			$title = get_post_time('F, Y');
			$desc = 'Month';
		} else if (is_day()) {
			$title = get_post_time('j M, Y');
			$desc = 'Day';
		} else if (is_time()) {
			$title = get_post_time('j M, Y');
			$desc = 'Day';
		} else {
			$title = get_post_time();
		}
	} else if (is_search()) {
		global $wp_query;
		$word = isset( $_REQUEST['q']) ? $_GET['q'] : get_search_query();
		$title = '<i class="icon-search"></i>'.$word;
		if ($wp_query->found_posts !== 0) {
			$desc = $wp_query->found_posts . __(' posts has found.', 'DigiPress');
		} else {
			$title = __('Nothing Found.','DigiPress');
			$desc = 'Search Result';
		}
	} else if (is_author()) {
		$title = get_the_author_meta('display_name') . __('\'s articles', 'DigiPress');
	} else if (is_tag()) {
		$title = wp_title('', false);
		$desc = tag_description();
		if (empty($desc)) {
			$desc = 'Tagged';
		}
	} else if (is_single()) {
		$cats = get_the_category();
		if ($cats) {
			$title = $cats[0]->name;
			$desc = '<i class="icon-down-open"></i>';
		}
	} else if (is_404()) {
		$title = '<i class="icon-404"></i>';
		$desc = 'Not Found';
	} else {
		$title = wp_title('', false);
	}

	// Paged page
	if (is_paged()) {
		if (is_home()){
			$title =  'Page '.intval(get_query_var('paged'));
		} else {
			$title .=  ' ( '.intval(get_query_var('paged')).' )';
		}
	}

	return array('title' => $title, 'desc' => $desc);
}
?>