<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage DigiPress
 */
function dp_get_footer() {
	global $IS_MOBILE_DP;

	$theme_location = (bool)$IS_MOBILE_DP ? 'footer_menu_mobile' : 'footer_menu_ul';
	$menu_class 	= (bool)$IS_MOBILE_DP ? 'mb-theme' : '';
	$widget_flag 	= true;

	$mb_suffix	= '';

	if ($IS_MOBILE_DP) :
		$mb_suffix = '_mb';
		// Widgets
		if ( is_active_sidebar( 'widget-footer-mb' ) ) :
			dynamic_sidebar( 'widget-footer-mb' );
		endif;
	else :
		// PC
		if (!is_active_sidebar( 'footer-widget1' ) 
			&& !is_active_sidebar( 'footer-widget2' )
			&& !is_active_sidebar( 'footer-widget3' ) 
			&& !is_active_sidebar( 'footer-widget4' ) ) :
				$widget_flag = false;
		endif;
		// Widgets
		if ((bool)$widget_flag) :
?>
<div class="ft-widget-content">
<?php
			// 1st Column
			if ( is_active_sidebar( 'footer-widget1' ) ) :
	?>
<div class="widget-area one clearfix">
<?php dynamic_sidebar( 'footer-widget1' ); ?>
</div>
<?php 
			endif; 
			// 2nd Column
			if ( is_active_sidebar( 'footer-widget2' ) ) :
?>
<div class="widget-area two clearfix">
<?php dynamic_sidebar( 'footer-widget2' ); ?>
</div>
<?php 
			endif;
			// 3rd Column
			if ( is_active_sidebar( 'footer-widget3' ) ) :
?>
<div class="widget-area three clearfix">
<?php dynamic_sidebar( 'footer-widget3' ); ?>
</div>
<?php 
			endif;
			// 4th Column
			if ( is_active_sidebar( 'footer-widget4' ) ) : 
?>
<div class="widget-area four clearfix">
<?php dynamic_sidebar( 'footer-widget4' ); ?>
</div>
<?php 
			endif;
?>
</div><?php // Close <div class="ft-widget-content">
		endif; // End of if ((bool)$widget_flag) 
	endif;	// if ($IS_MOBILE_DP)

	// wow.js
	$wow_menu_css = '';
	if (!(bool)$options['disable_wow_js'.$mb_suffix]){
		$wow_menu_css		= ' wow fadeInDown';
	}

	// *******************************
	// Custom Menu
	// *******************************
	function footer_menu_fallback() {
		return;
	}
	if ( function_exists('wp_nav_menu' )) {
		if (has_nav_menu($theme_location)) {
			wp_nav_menu(array(
				'theme_location'	=> $theme_location,
				'container'			=> 'ul',
				'menu_id'			=> 'footer_menu_ul',
				'menu_class'		=> $menu_class.$wow_menu_css,
				'depth'				=> 1,
				'fallback_cb'		=> 'footer_menu_fallback',
				'walker'			=> new dp_custom_menu_walker()
			));
		}
	}
}	// End of "function dp_get_footer()"