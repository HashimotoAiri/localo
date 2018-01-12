<?php
/*******************************************************
* Extend Custom Menu.
*******************************************************/
class dp_custom_menu_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query, $IS_MOBILE_DP;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title )	? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )		? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )		? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )		? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$description  = ! empty( $item->description ) && ! $IS_MOBILE_DP ? '<span class="menu-caption">'.esc_attr( $item->description ).'</span>' : '';

		$prepend	= '<span class="menu-title">';
		$append		= '</span>';

		if (($depth != 0) || (($depth == 0) && empty($item->description))) $description = $prepend = $append = '';

		// Only parent menu
		if ( $depth == 0 && !empty($args->before_only_parent) ) {
			$before_only_parent = $args->before_only_parent;
		} else {
			$before_only_parent = '';
		}
		if ( $depth == 0 && !empty($args->after_only_parent) ) {
			$after_only_parent = $args->after_only_parent;
		} else {
			$after_only_parent = '';
		}
		if ( $depth == 0 && !empty($args->before_only_parent_link) ) {
			$before_only_parent_link = $args->before_only_parent_link;
		} else {
			$before_only_parent_link = '';
		}
		if ( $depth == 0 && !empty($args->after_only_parent_link) ) {
			$after_only_parent_link = $args->after_only_parent_link;
		} else {
			$after_only_parent_link = '';
		}


		$item_output = $before_only_parent . $args->before;
		$item_output .= '<a'. $attributes .' class="menu-link">' . $before_only_parent_link;
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append .$args->link_after;
		$item_output .= $description;
		$item_output .= $after_only_parent_link . '</a>';
		$item_output .= $after_only_parent . $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/*******************************************************
* Extended Custom Menu.
*******************************************************/
class dp_custom_menu_listing_post_in_category_walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query, $options;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names 		= $value = '';
		$post_codes 		= '';
		$list_post_class 	= '';

		// ****
		// post listing
		if ( $depth == 0 && $item->object === 'category') {
			$list_post_class = ' listing_post';
			$post_codes = DP_LISTING_POST_EACH_STYLES(array(
								'echo' 		=> false,
								'title'		=> $options['global_nemu_cat_posts_meta_title'],
								'number'	=> 9,
								'author'	=> (bool)$options['global_nemu_cat_posts_meta_author'],
								'comment'	=> (bool)$options['global_nemu_cat_posts_meta_comment'],
								'views' 	=> (bool)$options['global_nemu_cat_posts_meta_views'],
								'show_cat'	=> false,
								'cat_id'	=> $item->object_id,
								'hatebu_num'=> (bool)$options['global_nemu_cat_posts_meta_hatebu'],
								'tweets_num'=> (bool)$options['global_nemu_cat_posts_meta_tweets'],
								'likes_num'	=> (bool)$options['global_nemu_cat_posts_meta_likes'],
								'pub_date'	=> (bool)$options['global_nemu_cat_posts_meta_date'],
								'type'		=> 'recent',
								'layout'	=> 'magazine one',
								'excerpt_length' => 120,
								'one_col'	=> true
								)
					);
		}

		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ).$list_post_class;
		$class_names = ' class="'. esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names . '>';

		$attributes  = ! empty( $item->attr_title )	? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )		? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )		? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )		? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$description  = ! empty( $item->description ) ? '<span class="menu-caption">'.esc_attr( $item->description ).'</span>' : '';

		$prepend	= '<span class="menu-title">';
		$append		= '</span>';

		if (($depth != 0) || (($depth == 0) && empty($item->description))) $description = $prepend = $append = '';

		// Only parent menu
		if ( $depth == 0 && !empty($args->before_only_parent) ) {
			$before_only_parent = $args->before_only_parent;
		} else {
			$before_only_parent = '';
		}
		if ( $depth == 0 && !empty($args->after_only_parent) ) {
			$after_only_parent = $args->after_only_parent;
		} else {
			$after_only_parent = '';
		}
		if ( $depth == 0 && !empty($args->before_only_parent_link) ) {
			$before_only_parent_link = $args->before_only_parent_link;
		} else {
			$before_only_parent_link = '';
		}
		if ( $depth == 0 && !empty($args->after_only_parent_link) ) {
			$after_only_parent_link = $args->after_only_parent_link;
		} else {
			$after_only_parent_link = '';
		}

		$item_output = $before_only_parent . $args->before;
		$item_output .= '<a'. $attributes .' class="menu-link">' . $before_only_parent_link;
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append .$args->link_after;
		$item_output .= $description;
		$item_output .= $after_only_parent_link . '</a>';
		$item_output .= $after_only_parent . $args->after;
		// Add listing posts
		$item_output .= $post_codes;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

//Register Custom menu.
register_nav_menus(
	array(
		'global_menu_ul' => (__('Gobal Menu','DigiPress')),
		'footer_menu_ul' => (__('Footer Menu','DigiPress')),
		'top_menu_mobile' => (__('Top Menu (Mobile)','DigiPress')),
		'footer_menu_mobile' => (__('Footer Menu (Mobile)','DigiPress'))
	)
);
?>