<?php
/*******************************************************
* h1 tag
*******************************************************/
/** ===================================================
* Create h1 title text.
*
* @param	none
* @return	$sitename
*/
function dp_h1_title() {
	global $options;
	$sitename = get_bloginfo('name');
	if ($options['enable_h1_title'] == true ) $sitename = $options['h1_title'];
	return $sitename;
}
?>