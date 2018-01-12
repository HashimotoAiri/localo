</div><?php // end of .content-wap ?>-->
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
if (is_active_sidebar('widget-container-bottom') && !is_404()) :
?>
<div id="widget-container-bottom" class="widget-container bottom clearfix">
<?php dynamic_sidebar( 'widget-container-bottom' ); ?>
</div>
<?php
endif;	// is_active_sidebar('widget-container-bottom')

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
<span id="gotop-ft">TOP</span>
<div class="copyright"><div class="inner">&copy; <?php 
if ($options['blog_start_year'] !== '') {
	echo $options['blog_start_year'] . ' - ' . date('Y');
} else {
	echo date('Y');
} ?> <a href="<?php echo home_url(); ?>/"><small><?php echo dp_h1_title(); ?></small></a>
</div></div>
</div>
</footer>
</div><?php // end of .container ?>
<i id="gotop" class="icon-arrow-up-pop"></i>
<?php
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