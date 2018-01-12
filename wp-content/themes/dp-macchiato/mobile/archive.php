<?php 
// **********************************
// Header
// **********************************
include_once(TEMPLATEPATH .'/'.DP_MOBILE_THEME_DIR.'/header.php');
// **********************************
// show posts
// **********************************
if (have_posts()) :
	include (TEMPLATEPATH . "/article-loop.php");
else :
	// Not found...
	include_once(TEMPLATEPATH .'/not-found.php');
endif;	// End of have_posts()
// **********************************
// Footer
// **********************************
include_once(TEMPLATEPATH .'/'.DP_MOBILE_THEME_DIR.'/footer.php');
?>