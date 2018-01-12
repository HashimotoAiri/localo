<?php
/*******************************************************
* Replace text from the content in single page
*******************************************************/
/** ===================================================
* @param	content
* @return	replace content
*/
function new_content($content) {
	$pattern1 = '\[slide\]';
	$pattern2 = '\[\/slide\]';
	
	if (!preg_match_all('/'.$pattern1.'/', $content, $rep_content1) || !preg_match_all('/'.$pattern2.'/', $content, $rep_content2)) 
	return $content;
	
	$replace_text = '<div class="dp-slide">';
	
	for($i=0; $i<count($rep_content1[0]); $i++) {
		$content = str_replace($rep_content1[0][$i], $replace_text, $content);
	}
	
	for($i=0; $i<count($rep_content2[0]); $i++) {
		$content = str_replace($rep_content2[0][$i], '</div>', $content);
	}
	
	return $content;
}
add_filter('the_content', 'new_content');
?>