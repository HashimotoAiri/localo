<?php
global $options, $options_visual;
// **********************************
// Breadcrumb
// **********************************
dp_breadcrumb();
// ************
// Params
// ************
$show_header_class = '';
if (is_front_page() && !is_paged() &&  !isset( $_REQUEST['q']) ) {
	if ($options_visual['dp_header_content_type'] !== 'none'){
		$show_header_class = ' show-header';
	}
} 
// **********************************
// Container botom widget
// **********************************
if (is_active_sidebar('widget-container-bottom-mb') && !is_404()) :
?>
<div class="widget-container bottom clearfix">
<?php dynamic_sidebar( 'widget-container-bottom-mb' ); ?>
</div>
<?php
endif;	// is_active_sidebar('widget-container-bottom-mb')
?>
</div><?php // end of .dp-container ?>
<?php
// **********************************
// Footer
// **********************************
?>
<footer id="footer" class="clearfix<?php echo $show_header_class; ?>">
<div class="ft-container">
<?php 
// **********************************
// show footer widgets and menu (footer_widgets.php)
// **********************************
dp_get_footer();
// **********************************
// Copyright
// **********************************
?>
</div>
<span id="gotop-ft">TOP</span>
<div class="copyright"><div class="inner">&copy; <?php 
if ($options['blog_start_year'] !== '') {
	echo $options['blog_start_year'] . ' - ' . date('Y');
} else {
	echo date('Y');
} ?> <a href="<?php echo home_url(); ?>/"><small><?php echo dp_h1_title(); ?></small></a>
</div></div>
</footer>
<i id="gotop" class="icon-arrow-up-pop"></i>
</div><?php // end of .main-wrap ?>
<?php
// **********************
// Global Menu(mmenu)
// **********************
include (TEMPLATEPATH . "/".DP_MOBILE_THEME_DIR."/global-menu.php");
// **********************************
// WordPress Footer
// **********************************
wp_footer();
// **********************************
// Javascript for sns
// **********************************
js_for_sns_objects();
?>
</body>
</html>