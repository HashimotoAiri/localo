<nav id="global_menu_nav">
<div class="global_menu_div">
<?php
// Default menu
function show_wp_global_menu_list_mb() { 
?>
<ul id="mb-slide-menu" class="mb-theme">
<li class="menu-item"><a href="<?php echo home_url(); ?>" title="HOME" class="icon-home menu-link"><?php _e('HOME','DigiPress'); ?><span class="gnav-bd"></span></a></li>
<li class="menu-item"><a href="<?php echo get_feed_link(); ?>" target="_blank" title="feed" class="icon-rss menu-link">RSS</a></li>
</ul>
<?php
} //End Function

// **** Custom Menu
if (function_exists('wp_nav_menu')) {
	$menu_num_class = '';
	wp_nav_menu(array(
		'theme_location'	=> 'top_menu_mobile',
		'container'			=> '',
		'after_only_parent_link' => "",
		'menu_id'			=> 'mb-slide-menu',
		'menu_class'		=> "mb-theme",
		'fallback_cb'		=> 'show_wp_global_menu_list_mb',
		'walker'			=> new dp_custom_menu_walker()
	));
} else {
	// Fixed Page List
	show_wp_global_menu_list_mb();
}

// **********************************
// SNS icon and search form
// **********************************
if ($options['global_menu_right_content'] !== 'none') :
?>
<div id="hd_misc_div" class="hd_misc_div">
<?php
	if ($options['global_menu_right_content'] === 'sns') {
		$sns_code = '';
		// **********************************
		// SNS icon links
		// **********************************
		if ($options['show_global_menu_sns']) {
			$sns_code = $options['global_menu_fb_url'] ? '<li class="fb"><a href="' . $options['global_menu_fb_url'] . '" title="Share on Facebook" target="_blank"><i class="icon-facebook"></i></a></li>' : '';
			$sns_code .= $options['global_menu_twitter_url'] ? '<li class="tw"><a href="' . $options['global_menu_twitter_url'] . '" title="Follow on Twitter" target="_blank"><i class="icon-twitter"></i></a></li>' : '';
			$sns_code .= $options['global_menu_gplus_url'] ? '<li class="gplus"><a href="' . $options['global_menu_gplus_url'] . '" title="Google+" target="_blank"><i class="icon-gplus"></i></a></li>' : '';
			$sns_code .= $options['global_menu_instagram_url'] ? '<li class="instagram"><a href="' . $options['global_menu_instagram_url'] . '" title="Instagram" target="_blank"><i class="icon-instagram"></i></a></li>' : '';
		}
		// **********************************
		// Feed icon
		// **********************************
		if ($options['show_global_menu_rss']) {
			$sns_code .= $options['rss_to_feedly'] ? '<li class="feedly"><a href="http://cloud.feedly.com/#subscription%2Ffeed%2F'.urlencode(get_feed_link()).'" target="blank" title="Follow on feedly"><i class="icon-feedly"></i></a></li>' : '<li class="rss"><a href="'. get_feed_link() .'" title="Subscribe Feed" target="_blank"><i class="icon-rss"></i></a></li>';
		}
		// Show
		if (!empty($sns_code)) {
			echo '<div class="hd_sns_links"><ul>'.$sns_code.'</ul></div>';
		}
		// **********************************
		// Search form 
		// **********************************
		if ($options['show_global_menu_search']) {
?>
<div id="hd_searchform" class="mb">
<?php
			if ($options['show_floating_gcs']) {
				// Google Custom Search
				echo '<div id="dp_hd_gcs"><gcse:searchbox-only></gcse:searchbox-only></div>';
			} else {
				// Default search form
				get_search_form();
			}
?>
</div>
<?php 
		}	// End of $options['show_global_menu_search']
	} else if ($options['global_menu_right_content'] === 'tel' && !empty($options['global_menu_right_tel'])) {
		echo '<div id="hd_tel"><a href="tel:'.$options['global_menu_right_tel'].'" class="icon-phone">'.$options['global_menu_right_tel'].'</a></div>';
	}
?>
</div><?php // End of .hd_misc_div 
endif;	// End of $options['global_menu_right_content'] !== 'none'
?>
</div>
</nav>