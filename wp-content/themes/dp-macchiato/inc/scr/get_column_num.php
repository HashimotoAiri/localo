<?php
// ************************************************
// Count current column 
// 
// @return column number
// ************************************************
function get_column_num(){
	if (is_admin()) return;
	global $COLUMN_NUM, $SIDEBAR_FLOAT, $SIDEBAR2_FLOAT, $options, $options_visual;

	$dp_column = $options_visual['dp_column'];
	$arr_one_col_cat = $options['one_col_category'];
	$num = 0;

	// Sidebar
	$SIDEBAR_FLOAT = $options_visual['dp_theme_sidebar'];
	$SIDEBAR2_FLOAT = $options_visual['dp_theme_sidebar2'];

	// Column
	if ( is_home() ) {
		if (is_paged()) {
			// Paged at top page
			if ( $dp_column == 1 ) {
				$num = 1;
				$SIDEBAR_FLOAT = '';
				$SIDEBAR2_FLOAT = '';
			} else {
				if ($options_visual['dp_1column_only_top'] && ($options['autopager'] || $options['autopager_mb'])) {
					$num = 1;
					$SIDEBAR_FLOAT = '';
				} else {
					if ( $dp_column == 3 ) {
						$num = 3;
					} else {
						$num = 2;
					}
				}
			}
		} else {
			// Top page
			if ( $dp_column == 1 || $options_visual['dp_1column_only_top'] ) {
				$num = 1;
				$SIDEBAR_FLOAT = '';
				$SIDEBAR2_FLOAT = '';
			} else {
				if ( $dp_column == 3 ) {
					$num = 3;
				} else {
					$num = 2;
				}
			}
		}
	} else if (is_singular()) {
		if ( $dp_column == 1 || get_post_meta(get_the_ID(), 'disable_sidebar', true) ) {
			$num = 1;
			$SIDEBAR_FLOAT = '';
			$SIDEBAR2_FLOAT = '';
		} else {
			if ( $dp_column == 3 ) {
				$num = 3;
			} else {
				$num = 2;
			}
		}
	} else {
		if ( $dp_column == 1 ) {
			$num = 1;
			$SIDEBAR_FLOAT = '';
			$SIDEBAR2_FLOAT = '';
		} else {
			if ( is_category() && !empty($arr_one_col_cat) ) {
				$arr_one_col_cat = explode(",", $arr_one_col_cat);
				if (is_category($arr_one_col_cat)) {
					$num = 1;
					$SIDEBAR_FLOAT = '';
					$SIDEBAR2_FLOAT = '';
				} else {
					if ( $dp_column == 3 ) {
						$num = 3;
					} else {
						$num = 2;
					}
				}
 			} else {
				if ( $dp_column == 3 ) {
					$num = 3;
				} else {
					$num = 2;
				}
			}
		}
	}
	$COLUMN_NUM = $num;
	return $num;
}
?>