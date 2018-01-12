<?php
/******************************************************
 English Calendar
******************************************************/
function eng_calendar($caption){
	$search = array('年','月');
	$caption = str_replace($search,'',$caption);
	$caption = preg_replace("/<caption>(\d{4})([a-zA-Z]*)<\/caption>/","<caption>$2, $1</caption>",$caption);
	return $caption;
}
/******************************************************
 English Archive Widget
******************************************************/
function eng_archive_args($content){
	$search = array('年','月');
	$content = str_replace($search,'',$content);
	$content = preg_replace('/(<a\s.+?>|<option\s.+?>).*?(\d{4})([a-zA-Z]*)(<\/a>|.*?<\/option>)/','$1$3, $2$4',$content);
	return $content;
}
/******************************************************
 Locale
******************************************************/
function eng_locale(){
	global $wp_locale;
	$wp_locale->weekday[0] = 'Sunday';
	$wp_locale->weekday[1] = 'Monday';
	$wp_locale->weekday[2] = 'Tuesday';
	$wp_locale->weekday[3] = 'Wednesday';
	$wp_locale->weekday[4] = 'Thursday';
	$wp_locale->weekday[5] = 'Friday';
	$wp_locale->weekday[6] = 'Saturday';

	$wp_locale->weekday_initial['Sunday'] = 'S';
	$wp_locale->weekday_initial['Monday'] = 'M';
	$wp_locale->weekday_initial['Tuesday'] = 'T';
	$wp_locale->weekday_initial['Wednesday'] = 'W';
	$wp_locale->weekday_initial['Thursday'] = 'T';
	$wp_locale->weekday_initial['Friday'] = 'F';
	$wp_locale->weekday_initial['Saturday'] = 'S';

	$wp_locale->weekday_abbrev['Sunday'] = 'Sun';
	$wp_locale->weekday_abbrev['Monday'] = 'Mon';
	$wp_locale->weekday_abbrev['Tuesday'] = 'Tue';
	$wp_locale->weekday_abbrev['Wednesday'] = 'Wed';
	$wp_locale->weekday_abbrev['Thursday'] = 'Thu';
	$wp_locale->weekday_abbrev['Friday'] = 'Fri';
	$wp_locale->weekday_abbrev['Saturday'] = 'Sat';

	$wp_locale->month['01'] = 'January';
	$wp_locale->month['02'] = 'February';
	$wp_locale->month['03'] = 'March';
	$wp_locale->month['04'] = 'April';
	$wp_locale->month['05'] = 'May';
	$wp_locale->month['06'] = 'June';
	$wp_locale->month['07'] = 'July';
	$wp_locale->month['08'] = 'August';
	$wp_locale->month['09'] = 'September';
	$wp_locale->month['10'] = 'October';
	$wp_locale->month['11'] = 'November';
	$wp_locale->month['12'] = 'December';

	$wp_locale->month_abbrev['January'] = 'Jan';
	$wp_locale->month_abbrev['February'] = 'Feb.';
	$wp_locale->month_abbrev['March'] = 'Mar.';
	$wp_locale->month_abbrev['April'] = 'Apr.';
	$wp_locale->month_abbrev['May'] = 'May';
	$wp_locale->month_abbrev['June'] = 'Jun.';
	$wp_locale->month_abbrev['July'] = 'Jul.';
	$wp_locale->month_abbrev['August'] = 'Aug.';
	$wp_locale->month_abbrev['September'] = 'Sep.';
	$wp_locale->month_abbrev['October'] = 'Oct.';
	$wp_locale->month_abbrev['November'] = 'Nov.';
	$wp_locale->month_abbrev['December'] = 'Dec.';
}

// Hook
if ($options['date_eng_mode']) {
	add_filter('get_calendar','eng_calendar', 10, 4);
	add_filter('get_archives_link', 'eng_archive_args', 10, 4);
	add_action('init', 'eng_locale');
}
?>