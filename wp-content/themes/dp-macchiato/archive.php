<?php 
// **********************************
// Header (main-wrap > container > content)
// **********************************
get_header();
// **********************************
// show posts
// **********************************
if (have_posts()) :
	include (TEMPLATEPATH . "/article-loop.php");
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
else :
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