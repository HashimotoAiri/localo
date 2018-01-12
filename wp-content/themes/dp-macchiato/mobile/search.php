<?php 
// **********************************
// Header
// **********************************
include_once(TEMPLATEPATH .'/'.DP_MOBILE_THEME_DIR.'/header.php');
// **********************************
// show posts
// **********************************
// Check the query
if (isset( $_REQUEST['q'] )) : 
	// **********************************
	// Google Custom Search
	// **********************************
?>
<gcse:searchresults-only></gcse:searchresults-only>
<?php 
else :
	if (have_posts()) :
		include (TEMPLATEPATH . "/article-loop.php");
	else :
		// Not found...
		include_once(TEMPLATEPATH .'/not-found.php');
	endif;	// End of have_posts()
endif;	// End of isset( $_REQUEST['q'] )
// **********************************
// Footer
// **********************************
include_once(TEMPLATEPATH .'/'.DP_MOBILE_THEME_DIR.'/footer.php');
?>