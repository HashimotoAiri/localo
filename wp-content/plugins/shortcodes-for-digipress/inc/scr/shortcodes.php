<?php
/****************************************************************
* Font 
****************************************************************/
function dp_sc_pi_font($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;
	
	extract(shortcode_atts(array(
		'size' 		=> 14,
		'bold'		=> false,
		'color'		=> '',
		'bgcolor'	=> '',
		'italic'	=> false,
		'class'		=> ''
	), $atts));

	$code 	= $content;
	$style 	= '';

	$bold 	= !empty($bold) ? ' b' : '';
	$italic = !empty($italic) ? ' i' : '';

	if (!$bold && !$italic && !$class) {
		if ($bgcolor) {
			$class 	= ' class="pd5px"';
		} else {
			$class 	= '';
		}
	} else {
		if ($bgcolor) {
			$class 	= ' class="'.$class.$bold.$italic.' pd5px"';
		} else {
			$class 	= ' class="'.$class.$bold.$italic.'"';
		}
	}
	
	$color 		= !empty($color) ? 'color:'.$color.';' : '';
	$bgcolor 	= !empty($bgcolor) ? 'background-color:'.$bgcolor.';' : '';
	$size = $size ? $size : 14;
	$size = mb_convert_kana($size);
	if (is_numeric($size)) {
		$size = 'font-size:'.$size.'px;';
	} else {
		$size = 'font-size:'.$size.';';
	}
	$style = ' style="'.$color.$bgcolor.$size.'"';

	$code = <<<_EOD_
<span$style$class>$content</span>
_EOD_;

	return $code;
}


/****************************************************************
* Button
****************************************************************/
function dp_sc_pi_button($atts) {
	if (is_admin()) return;

	extract(shortcode_atts(array(
		'url' 		=> '',
		'title'		=> '',
		'color'		=> '',
		'icon'		=> '',
		'rel' 		=> '',
		'newwindow'	=> false,
		'class'		=> '',
		'size'		=> ''	// big, small
	), $atts));

	if (empty($url)) return;

	// Params
	$rgb = '';
	$hex = '';
	$box_shadow = '';
	$hover = '';
	$btn_id = '';
	$btn_id2 = '';
	$btn_css = '';

	$button_style = defined('DP_BUTTON_STYLE') ? DP_BUTTON_STYLE : 'rich';

	if ($button_style === 'flat') {
		// For FLAT BUTTONS
		$rgb 		= dp_sc_pi_darkenColor($color, 30);
		$hex 		= dp_sc_pi_rgbToHex($rgb);
		$box_shadow = 'box-shadow:0 5px '.$hex.';-moz-box-shadow:0 5px '.$hex.';';
		$hover		= ' onmouseover="this.style.boxShadow=\'0 3px '.$hex.'\'" onmouseout="this.style.boxShadow=\'0 5px '.$hex.'\'"';
	}

	if ($button_style === 'flat5' || $button_style === 'flat6') {
		$btn_id = 'btn'.dp_sc_rand(5);
		$btn_id2 = ' id="'.$btn_id.'"';
		if ($button_style === 'flat5') {
			$btn_css = '<style>#'.$btn_id.'{border-color:'.$color.';}#'.$btn_id.':after{background-color:'.$color.';}#'.$btn_id.':hover{color:'.$color.'!important;}</style>';
		} else {
			$btn_css = '<style>#'.$btn_id.'{border-color:'.$color.';}#'.$btn_id.':after{background-color:'.$color.';}#'.$btn_id.'{color:'.$color.'!important;}#'.$btn_id.':hover{color:#fff!important;}</style>';
		}
		
		$color = '';
	}

	$newwindow 	= !empty($newwindow) ? ' target="_blank"' : '' ;
	$class 		= !empty($class) ? ' '.$class : '' ;
	$icon 		= !empty($icon) ? ' '.$icon : '' ;
	$color 		= !empty($color) ? ' style="background-color:'.$color.';'.$box_shadow.'"' : '';
	$rel 		= !empty($rel) ? ' rel="'.$rel.'"' : '' ;

	if ($size === 'big') {
		$size = ' ft20px';
	} elseif ($size === 'small') {
		$size = ' ft10px';
	} else {
		$size = ' '.$size;
	}

	$code = <<<_EOD_
<a href="$url"$btn_id2 class="btn$class$icon$size"$color$newwindow$rel$hover>$title</a>$btn_css
_EOD_;

	return $code;
}



/****************************************************************
* Labels
****************************************************************/
function dp_sc_pi_label($atts) {
	if (is_admin()) return;

	extract(shortcode_atts(array(
		'color'		=> '',
		'title'		=> '',
		'text'		=> '',
		'icon'		=> '',
		'class'		=> '',
		'size'		=> ''
	), $atts));

	$title 		= !empty($title) ? '<span>'.$title.'</span>' : '' ;
	$text 		= !empty($text) ? '<span>'.$text.'</span>' : '' ;
	$icon 		= !empty($icon) ? ' '.$icon : '';
	$class 		= !empty($class) ? ' '.$class : '' ;
	$color 		= !empty($color) ? ' style="background-color:'.$color.';"' : '' ;

	if ($size === 'big') {
		$size = ' ft18px';
	} elseif ($size === 'small') {
		$size = ' ft10px';
	}

	$code = <<<_EOD_
<span class="label$icon$class$size"$color>$title</span>$text
_EOD_;

	return $code;
}



/****************************************************************
* Table display
****************************************************************/
function dp_sc_pi_table($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class' 	=> '',
		'style'		=> '',
		'width'		=> '100%',
		'highlight' => false,
		'hoverrowbgcolor' => '',
		'hoverrowfontcolor' => '',
		'hovercellbgcolor' => '',
		'hovercellfontcolor' => '',
		'sort' 		=> false
	), $atts));

	$content 	= do_shortcode($content);

	$table_id 	= 'dp_sc_table_'.dp_sc_rand(4);
	
	$inline_css = '';
	$js 		= '';
	$js_css 	= '';

	$style 		.= !empty($width) ? 'width:'.$width.';' : '';
	$style 		= ' style="'.$style.'"';
	$highlight 	= !empty($highlight) ? ' highlight' : '';

	// Highlight color
	if ( !empty($hoverrowbgcolor) ) {
		if ( !empty($hoverrowfontcolor)) {
			$inline_css = 'table#'.$table_id.'.highlight tbody tr:hover{color:'.$hoverrowfontcolor.';background-color:'.$hoverrowbgcolor.';}';
		} else {
			$inline_css = 'table'.$table_id.'.highlight tbody tr:hover{background-color:'.$hoverrowbgcolor.';}';
		}
	}

	if ( !empty($hovercellbgcolor) ) {
		if ( !empty($hovercellfontcolor)) {
			$inline_css .= 'table#'.$table_id.'.highlight tbody td:hover{color:'.$hovercellfontcolor.';background-color:'.$hovercellbgcolor.';}';
		} else {
			$inline_css .= 'table#'.$table_id.'.highlight tbody td:hover{background-color:'.$hovercellbgcolor.';}';
		}
	}

	if ( !empty($inline_css) ) {
		$inline_css = '<style type="text/css">'.$inline_css.'</style>';
	}

	if ((bool)$sort) {
		$js_css = ' sortable';
		$js = <<<_EOD_
<div><script>
j$(document).ready(
	function(){
		j$(".dp_sc_table").tablesorter();
	}
);
</script></div>
_EOD_;
	}

	// CSS
	$class 		= $class ? ' class="dp_sc_table '.$class.$highlight.$js_css.'"' : ' class="dp_sc_table'.$highlight.$js_css.'"';

	$code = <<<_EOD_
$inline_css
<table id="$table_id"$class$style>$content</table>
_EOD_;
	
	$code = str_replace(array("\r\n","\r","\n","\t"), '', $code.$js);

	return $code;
}
	function dp_sc_pi_table_head($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'title' 	=> '',
			'icon'		=> '',
			'caption'	=> '',
			'class'		=> '',
			'align'		=> 'center',
			'style'		=> '',
			'width'		=> '',
			'bgcolor'	=> ''
		), $atts));

		if (!$title) return;

		$content = do_shortcode($content);

		if ($align === 'center') {
			$align = ' al-c'; 
		} else if ($align === 'right') {
			$align = ' al-r';
		} else {
			$align = ' al-l';
		}

		if ($class || $align) {
			$class 	= $class.$align;
		} else {
			$class = '';
		}
		$style 	.= !empty($bgcolor) ? 'background-color:'.$bgcolor.';' : '';
		$style 	.= !empty($width) ? 'width:'.$width.';' : '';
		$style 	= !empty($style) ? ' style="'.$style.'"' : '';

		$caption = $caption ? '<caption><span class="dp_sc_table_cap icon-th">'.$caption.'</span><span class="dp_sc_table_cap_back icon-cross-circled">'.__('Close', DP_SC_PLUGIN_TEXT_DOMAIN).'</span></caption>' : '<caption><span class="dp_sc_table_cap icon-th">'.__('Tap this to show the table', DP_SC_PLUGIN_TEXT_DOMAIN).'</span><span class="dp_sc_table_cap_back icon-cross-circled">Close</span></caption>';

		// Split return
		$arrTitle 	= explode( ',', $title );
		$arrIcon 	= explode( ',', $icon );
		$codeTitle 	= '';

		foreach ($arrTitle as $key => $val) {
			if (!empty($arrIcon[$key])) {
				$iconclass = $arrIcon[$key] ? ' '.$arrIcon[$key] : '';
			} else {
				$iconclass = '';
			}
			$codeTitle .= '<th class="'.$class.$iconclass.'"'.$style.'>'.$val.'</th>';
		}
		$codeTitle = '<thead>'.$codeTitle.'</thead>';
		$code = $caption.$codeTitle.'<tbody class="dp_sc_table_body">'.$content.'</tbody>';
		return $code;
	}

	function dp_sc_pi_table_row($atts, $content = null) {

		if (!$content) return;

		extract(shortcode_atts(array(
			'title' 	=> '',
			'icon'		=> '',
			'class'		=> '',
			'align'		=> 'center',
			'style'		=> '',
			'width'		=> '',
			'bgcolor'	=> ''
		), $atts));

		$content = do_shortcode($content);

		$icon = !empty($icon) ? ' '.$icon : '';

		if ($align === 'center') {
			$align = ' al-c'; 
		} else if ($align === 'right') {
			$align = ' al-r';
		} else {
			$align = ' al-l';
		}

		if ($class || $align || $icon) {
			$class 	= ' class="'.$class.$align.$icon.'"';
		} else {
			$class = '';
		}
		$style 	.= !empty($bgcolor) ? 'background-color:'.$bgcolor.';' : '';
		$style 	.= !empty($width) ? 'width:'.$width.';' : '';
		$style 	= !empty($style) ? ' style="'.$style.'"' : '';

		$title = $title ? '<th'.$class.$style.'>'.$title.'</th>' : '';

		$code = <<<_EOD_
<tr>$title$content</tr>
_EOD_;
		return $code;
	}
	function dp_sc_pi_table_cell($atts, $content = null) {

		extract(shortcode_atts(array(
			'class' 	=> '',
			'align'		=> 'center',
			'bgcolor' 	=> '',
			'width'		=> '',
			'style'		=> ''
		), $atts));

		if ($align === 'center') {
			$align = ' al-c';
		} else if ($align === 'right') {
			$align = ' al-r';
		} else {
			$align = ' al-l';
		}

		if ($class || $align) {
			$class 	= ' class="'.$class.$align.'"';
		} else {
			$class = '';
		}
		$style 	.= !empty($bgcolor) ? 'background-color:'.$bgcolor.';' : '';
		$style 	.= !empty($width) ? 'width:'.$width.';' : '';
		$style 	= !empty($style) ? ' style="'.$style.'"' : '';

		$code = <<<_EOD_
<td$class$style>$content</td>
_EOD_;
		return $code;
	}



/****************************************************************
* Accordions
****************************************************************/
function dp_sc_pi_accordions($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class'		=> '',
		'style'		=> '',
		'type'		=> 'accordion'
	), $atts));

	$content = do_shortcode($content);

	$type 	= $type === 'accordion' ? 'accordion dp_accordion' : 'accordion dp_toggle'; 
	$class 	= !empty($class) ? ' '. $class : '';
	$style 	= !empty($style) ? ' style="'. $style . '"' : '';

	$code = <<<_EOD_
<dl class="$type$class"$style>$content</dl>
_EOD_;

	return $code;
}
	function dp_sc_pi_accordion($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'title' 	=> '',
			'class'		=> '',
			'style'		=> ''
		), $atts));

		if (!$title) return;
		$content = do_shortcode($content);

		$class = !empty($class) ? ' class="ft15px ' . $class . '"' : ' class="ft15px"';
		$style = !empty($style) ? ' style="' . $style . '"' : '';

		$code = <<<_EOD_
<dt$class$style>$title</dt><dd>$content</dd>
_EOD_;

		return $code;
	}


/****************************************************************
* Toggles
****************************************************************/
function dp_sc_pi_toggles($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class'		=> '',
		'style'		=> ''
	), $atts));

	$content = do_shortcode($content);

	$type 	= 'accordion dp_toggle'; 
	$class 	= !empty($class) ? ' '. $class : '';
	$style 	= !empty($style) ? ' style="'. $style . '"' : '';

	$code = <<<_EOD_
<dl class="$type$class"$style>$content</dl>
_EOD_;

	return $code;
}
	function dp_sc_pi_toggle($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'title' 	=> '',
			'class'		=> '',
			'style'		=> ''
		), $atts));

		if (!$title) return;

		$content = do_shortcode($content);

		$class = !empty($class) ? ' class="ft15px ' . $class . '"' : ' class="ft15px"';
		$style = !empty($style) ? ' style="' . $style . '"' : '';

		$code = <<<_EOD_
<dt$class$style>$title</dt><dd>$content</dd>
_EOD_;
		return $code;
	}


/****************************************************************
* Tabs
****************************************************************/
function dp_sc_pi_tabs($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class'		=> ''
	), $atts));

	$delim 		= '[//+++//]';

	$class 		= !empty($class) ? ' class="'. $class . '"' : '';
	$content 	= do_shortcode($content);

	// Split return
	$arrContent = explode( $delim, $content );
	$arrContent = explode( $delim, $content);
	$arrContent = array_filter($arrContent, create_function('$item', 'return !preg_match("/^(\r|\n)+$/",$item);'));
	// $arrContent = array_values(array_filter($arrContent));
	// Separate every 4 elements.
	$arrContent = array_chunk($arrContent, 4);

	$codeTitle 		= '';
	$codeContent	= '';

	foreach ($arrContent as $key => $val) {

		$title 	= str_replace(array("\r\n","\r","\n"), '', $val[0]);
		$class 	= $val[1] ? $val[1] : '';
		$class 	= $val[2] ? $class . ' ' . $val[2] : $class;
		$class 	= $class ? ' class="' . $class . '"' : '';
		$codeTitle 		.= '<li id="tab'.$key.'"><span'.$class.'>' . $title . '</span></li>';
		$codeContent 	.= '<div id="tab_div'.$key.'" class="tab_content">' . $val[3] . '</div>';
	}

	$code = '<div class="dp_sc_tab"><ul class="dp_sc_tab_ul clearfix">'.$codeTitle.'</ul><div class="tab_contents">'.$codeContent.'</div></div>';

	return $code;
}
	function dp_sc_pi_tab($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' 	=> __('No Title', 'DigiPress'),
			'icon'		=> '',
			'class'		=> ''
		), $atts));

		$delim 		= '[//+++//]';
		$title 		= !empty($title) ? $title : __('No Title', 'DigiPress');
		$content = do_shortcode($content);

		$return = $title .$delim. $class .$delim. $icon .$delim. $content .$delim;
		return $return;
	}



/****************************************************************
* Image filter
****************************************************************/
function dp_sc_img_filter($atts) {
	if (is_admin()) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;
	
	extract(shortcode_atts(array(
		'url' 			=> '',
		'grayscale'		=> false,
		'grayscaleval'	=> '100%',
		'saturate'		=> false,
		'saturateval'	=> '0%',
		'sepia'			=> false,
		'sepiaval'		=> '100%',
		'brightness'	=> false,
		'brightnessval'	=> '80%',
		'contrast' 		=> false,
		'contrastval'	=> '80%',
		'blur' 			=> false,
		'blurval'		=> '4px',
		'opacity'		=> false,
		'opacityval'	=> '80%',
		'invert'		=> false,
		'invertval'		=> '100%',
		'hue'			=> false,
		'hueval'		=> '180deg',
		'class'			=> '',
		'width'			=> '',
		'height'		=> '',
		'alt'			=> ''
	), $atts));

	if (!$url) return;

	// Inline CS
	$inline_css = '';

	$blur_param = '';

	// For FireFox (SVG)
	$sepia_style 		= '';
	$contrast_style 	= '';
	$brightness_style 	= '';
	$grayscale_style 	= '';
	$saturate_style 	= '';
	$hue_style 			= '';
	$blur_style 		= '';
	$opacity_style 		= '';
	$invert_style 		= '';

	// IE 
	$filter_ie 			= '';
	$grayscale_ie 		= '';
	$blur_ie			= '';
	$opacity_ie 		= '';

	// Unique key
	$class_id = uniqid('filter');

	// Sepia
	if ($sepia) {
		$sepiaval 			= str_replace('%', '', $sepiaval);
		$sepiaval 			= is_numeric($sepiaval) ? $sepiaval.'%' : '100%' ;
		$sepia 				= ' sepia('.$sepiaval.')';
		$sepia_style 		= "<feColorMatrix type='matrix' values='.8 .8 .8 0 0 .6 .6 .6 0 0 .3 .3 .3 0 0 0 0 0 1 0'/>";
	} else {
		$sepia = '';
	}

	// Brightness
	if ($brightness) {
		$brightnessval 	= str_replace('%', '', $brightnessval);
		$brightnessval 	= is_numeric($brightnessval) ? ($brightnessval/100) : 0.2;
		$brightness 		= ' brightness('.$brightnessval.')';
		$brightness_style 	= "<feColorMatrix type='matrix' values='".$brightnessval." 0 0 0 0 0 ".$brightnessval." 0 0 0 0 0 ".$brightnessval." 0 0 0 0 0 1 0'/>";
	} else {
		$brightness = '';
	}

	// Contrast
	if ($contrast) {
		$contrastval_int 	= str_replace('%', '', $contrastval);
		$contrastval 		= is_numeric($contrastval_int) ? $contrastval_int.'%' : '80%' ;
		$contrastval_int 	= is_numeric($contrastval_int) ? $contrastval_int/100 : 0.8;
		$contrast 			= ' contrast('.$contrastval.')';
		$contrast_style 	= "<feColorMatrix type='matrix' values='".$contrastval_int." 0 0 0 .06 0 ".$contrastval_int." 0 0 .06 0 0 ".$contrastval_int." 0 .06 0 0 0 1 0'/>";
	} else {
		$contrast = '';
	}

	// Opacity
	if ($opacity) {
		$opacityval_int 	= str_replace('%', '', $opacityval);
		$opacityval 		= is_numeric($opacityval_int) ? $opacityval_int.'%' : '80%' ;
		$opacity 			= ' opacity('.$opacityval.')';
		$opacity_ie 		= ' alpha(opacity='.$opacityval_int.')';
		$opacity_style 		= "<feGaussianBlur in='SourceGraphic' stdDeviation='0' />";
	} else {
		$opacity = '';
	}

	// invert
	if ($invert) {
		$invertval_int 		= str_replace('%', '', $invertval);
		$invertval 			= is_numeric($invertval_int) ? $invertval_int.'%' : '100%' ;
		$invertval_int 		= is_numeric($invertval_int) ? -1*($invertval_int/100) : -1;
		$invert 			= ' invert('.$invertval.')';
		$invert_style 		= "<feColorMatrix type='matrix' values='".$invertval_int." 0 0 0 1 0 ".$invertval_int." 0 0 1 0 0 ".$invertval_int." 0 1 0 0 0 1 0'/>";
	} else {
		$invert = '';
	}

	// Grayscale
	if ($grayscale) {
		$grayscaleval_int 	= str_replace('%', '', $grayscaleval);
		$grayscaleval 		= is_numeric($grayscaleval_int) ? $grayscaleval_int.'%' : '100%' ;
		$grayscaleval_int 	= is_numeric($grayscaleval_int) ? (100-$grayscaleval_int)/100 : 0;
		$grayscale 			= 'grayscale('.$grayscaleval.')';
		$grayscale_ie 		= ' gray';
		$grayscale_style 	= "<feColorMatrix type='saturate' values='".$grayscaleval_int."' result='A' />";
	} else {
		$grayscale = '';
	}

	// Blur
	if ($blur) {
		$blurval_int 		= str_replace('px', '', $blurval);
		$blurval 			= is_numeric($blurval_int) ? $blurval_int.'px' : '4px' ;
		$blur 				= ' blur('.$blurval.')';
		$blur_ie			= ' progid:DXImageTransform.Microsoft.Blur(PixelRadius='.$blurval_int.');';
		$blur_param 		= " x='-5%' y='-5%' width='110%' height='110%'";
		$blur_style 		= "<feGaussianBlur in='SourceGraphic' stdDeviation='".$blurval_int."' />";
	} else {
		$blur = '';
	}

	// Saturate
	if ($saturate) {
		$saturateval_int 	= str_replace('%', '', $saturateval);
		$saturateval 		= is_numeric($saturateval_int) ? $saturateval_int.'%' : '100%' ;
		$saturateval_int 	= is_numeric($saturateval_int) ? $saturateval_int/100 : 0.5;
		$saturate 			= ' saturate('.$saturateval.')';
		$saturate_style 	= "<feColorMatrix type='saturate' values='".$saturateval_int."' result='A' />";
	} else {
		$saturate = '';
	}

	// Hue rotate
	if ($hue) {
		$hueval_int 		= str_replace('deg', '', $hueval);
		$hueval 			= is_numeric($hueval_int) ? $hueval_int.'deg' : '180deg' ;
		$hue 				= ' hue-rotate('.$hueval.')';
		$hue_style			= "<feColorMatrix type='hueRotate' values='".$hueval_int."' result='A' />";
	} else {
		$hue = '';
	}

	// Filter for IE
	if ($grayscale_ie || $blur_ie || $opacity_ie) {
		$filter_ie = 'filter:'.$grayscale_ie.$blur_ie.$opacity_ie.';';
	}

	//Alt
	$alt = $alt ? ' alt="'.$alt.'"' : '';
	// Class
	$class = $class ? $class_id.' '.$class : $class_id;
	// Size
	$width = $width ? ' width="'.$width.'"' : '';
	$height = $height ? ' height="'.$height.'"' : '';

	// Inline CSS
	$inline_css = <<<_EOD_
<style type="text/css"><!--
.$class_id {
	filter:url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg'><filter id='img_filter'$blur_param>$sepia_style$contrast_style$brightness_style$grayscale_style$saturate_style$hue_style $blur_style$opacity_style$invert_style</filter></svg>#img_filter");
}
--></style>
_EOD_;

	// Image tag
	$code = <<<_EOD_
<img src="$url" style="filter:$grayscale$saturate$sepia$brightness$contrast$blur$opacity$invert$hue;-webkit-filter:$grayscale$saturate$sepia$brightness$contrast$blur$opacity$invert$hue;-moz-filter:$grayscale$saturate$sepia$brightness$contrast$blur$opacity$invert$hue;-ms-filter:$grayscale$saturate$sepia$brightness$contrast$blur$opacity$invert$hue;$filter_ie" class="$class"$width$height$alt />
_EOD_;

	$code = str_replace(array("\r\n","\r","\n","\t"), '', $inline_css.$code);
	return $code;
}



/****************************************************************
* Promotion box
****************************************************************/
function dp_sc_pi_promo_box($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;
	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class' 	=> '',
		'column'	=> '',
		'style'		=> '',
		'plx'		=> ''
	), $atts));

	if (!$column || (5 < (int)$column) || (1 >= (int)$column) || !is_numeric($column)) return ;

	// Target theme
	$dp_theme_key = defined('DP_THEME_KEY') ? ' '.DP_THEME_KEY : '';

	$delim 		= '[//+++//]';
	$codeContent	= '';

	// Get promos
	$content 	= do_shortcode($content);

	// Split the return
	$arrContent = explode( $delim, $content);
	$arrContent = array_filter($arrContent, create_function('$item', 'return !preg_match("/^(\r|\n)+$/",$item);'));
	$arrContent = array_values(array_filter($arrContent));
	$arrNum 	= count($arrContent) - 1;
	$last 		= '';
	$first 		= '';
	$eachPlx 	= '';

	foreach ($arrContent as $key => $val) {
		// init
		$eachPlx = '';
		if ($arrNum === $key) {
			$last = ' last';
		}
		if ($key === 0) {
			$first = ' first';
			// Parallax params for macciato theme
			if (!empty($plx)){
				$eachPlx = ' data-sr="'.$plx.'"';
			}
		} else {
			$first = '';
			// Parallax params for macciato theme
			if (!empty($plx)){
				$eachPlx = ' data-sr="'.$plx.' wait '.(0.3*$key).'s"';
			}
		}
		$codeContent .=  '<div class="promo num'.($key + 1).$first.$last.'"'.$eachPlx.'>'.$val.'</div>';
	}

	$style 	= !empty($style) ? ' style="'.$style.'"' : '';
	$class 	= !empty($class) ? ' class="dp_sc_promobox '.$class.' col'.$column.$dp_theme_key.'"' : ' class="dp_sc_promobox col'.$column.$dp_theme_key.'"' ;
	
	$code = <<<_EOD_
<div$class$style>$codeContent</div>
_EOD_;

	return $code;
}
	function dp_sc_pi_promo($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'icon'			=> '',
			'iconstyle'		=> '',	// circle, square, round
			'iconsize'		=> '', 	// Numeric or small, big
			'iconcolor'		=> '',
			'iconhovercolor'=> '',
			'iconbgcolor'	=> '#ebebeb',
			'iconbdwidth'	=> '',
			'iconbdcolor' 	=> '',
			'iconalign'		=> '', // top, right, left
			'imgurl'		=> '',
			'url'			=> '',
			'target'		=> '',
			'iconscale'		=> false,
			'iconrotate'	=> 0,	
			'title'			=> '',
			'titlecolor'	=> '',
			'titlehovercolor' => '',
			'titlesize'		=> 16,
			'titlebold'		=> true,
			'bgcolor'		=> '',
			'bghovercolor'	=> ''
		), $atts));

		// Delimiter
		$delim 			= '[//+++//]';
		
		// Params
		$iconbdcss = '';
		$iconcolorcopy	= '';
		$iconbgcolorcopy = '';
		$iconsizecopy 	= 0;
		$defaulticoonsize = 38;
		$defaultimgsize = 72;
		$iconboxsize 	= '';
		$anchorcode  	= '';
		$anchoriconcode = '';
		$imgcode 		= '';
		$blockalign		= '';
		$alignflag 		= true;
		$alignmargin	= '';
		$titlecolorcopy = '';
		$titlepaddinigclass = '';

		// icon color
		if (!empty($iconcolor)) {
			$iconcolorcopy 	= $iconcolor;
			$iconcolor 		= 'color:'.$iconcolor.';';
		}
		$iconhovercolor = !empty($iconhovercolor) ? $iconhovercolor : $iconcolorcopy;

		// Title color
		if (!empty($titlecolor)) {
			$titlecolorcopy 	= $titlecolor;
			$titlecolor 		= 'color:'.$titlecolor.';';
		}
		$titlehovercolor = !empty($titlehovercolor) ? $titlehovercolor : $titlecolorcopy;

		// Border
		$iconbdwidth 	= str_replace('px', '', $iconbdwidth);
		$iconbdwidth 	= !empty($iconbdwidth) ? $iconbdwidth.'px' : '';
		$iconbdcolor 	= !empty($iconbdcolor) ? $iconbdcolor : '#222';
		if (!empty($iconbdwidth)) {
			$iconbdcss = 'border:'.$iconbdwidth.' solid '.$iconbdcolor.';';
		}
			

		// Filled style
		switch ($iconstyle) {
			case 'circle':
				$iconstyle = 'border-radius:50%;-o-border-radius:50%;-moz-border-radius:50%;-webkit-border-radius:50%;';
				$iconbgcolor = !empty($iconbgcolor) ? 'background-color:'.$iconbgcolor.';' : '';
				break;
			case 'round':
				$iconstyle = 'border-radius:8px;-o-border-radius:8px;-moz-border-radius:8px;-webkit-border-radius:8px;';
				$iconbgcolor = !empty($iconbgcolor) ? 'background-color:'.$iconbgcolor.';' : '';
				break;
			case 'square':
				$iconbgcolor = !empty($iconbgcolor) ? 'background-color:'.$iconbgcolor.';' : '';
				break;
			default:
				$iconstyle = '';
				$iconboxsize = '';
				$iconbgcolor = '';
				break;
		}

		// Icon size
		switch ($iconsize) {
			case 'small':
				if (!empty($imgurl)) {
					$iconsize 		= 60;
					$iconsizecopy	= $iconsize;
					$iconboxsize 	= 'width:60px;height:60px;';
				} else {
					if (!empty($iconstyle)) {
						$iconsize 		= 'font-size:26px;';
					} else {
						$iconsize 		= 'font-size:34px;';
					}
					$iconboxsize 	= 'width:52px;height:52px;';
				}
				break;
			case 'big':
				if (!empty($imgurl)) {
					$iconsize 		= 100;
					$iconsizecopy	= $iconsize;
					$iconboxsize 	= 'width:100px;height:100px;';
				} else {
					if (!empty($iconstyle)) {
						$iconsize 		= 'font-size:54px;';
					} else {
						$iconsize 		= 'font-size:60px;';
					}
					$iconboxsize 		= 'width:108px;height:108px;';
				}
				break;
			default:
				$iconsize 	= str_replace('px', '', $iconsize);

				if (!empty($imgurl)) {
					$iconsize 		= is_numeric($iconsize) ? $iconsize : $defaultimgsize;
					$iconsizecopy	= $iconsize;
					$iconboxsize 	= 'width:'.$iconsize.'px;height:'.$iconsize.'px;';
				} else {
					$iconsize 	= is_numeric($iconsize) ? $iconsize : $defaulticoonsize;
					$iconsizecopy	= $iconsize + $iconsize * 0.8;
					$iconboxsize = 'width:'.$iconsizecopy.'px;height:'.$iconsizecopy.'px;';
					if (!empty($iconstyle)) {
						$iconsize 	= !empty($iconsize) ? 'font-size:'.($iconsize - 6).'px;' : 'font-size:30px;';
					} else {
						$iconsize 	= !empty($iconsize) ? 'font-size:'.$iconsize.'px;' : 'font-size:34px;';
					}
				}
				break;
		}

		$iconsizecopy += 15;

		// Icon alignment
		switch ($iconalign) {
			case 'left':
				$iconalign	=  'float:left;margin-right:15px;'; //' fl-l mg15px-r';
				$alignmargin = ' style="margin-left:'.$iconsizecopy.'px;"';
				$titlepaddinigclass = ' t_float';
				break;
			case 'right':
				$iconalign 	= 'float:right;margin-left:15px;'; //' fl-r mg15px-l';
				$alignmargin = ' style="margin-right:'.$iconsizecopy.'px;"';
				$titlepaddinigclass = ' t_float';
				break;
			default:
				$iconalign	= 'margin:0 auto;text-align:center;'; // ' aligncenter';
				$blockalign = 'text-align:center;';
				$alignflag 	= false;
				break;
		}

		// Icon rotate class
		switch ($iconrotate) {
			case 1:
				$iconrotate = ' rotate15-r';
				break;
			case 2:
				$iconrotate = ' rotate45-r';
				break;
			case 3:
				$iconrotate = ' rotate-r';
				break;
			case 4:
				$iconrotate = ' rotate15-l';
				break;
			case 5:
				$iconrotate = ' rotate45-l';
				break;
			case 6:
				$iconrotate = ' rotate-l';
				break;
			default:
				$iconrotate = '';
				break;
		}
		//icon scaling
		$iconscale = !empty($iconscale) ? ' scaling' : '';

		// Target
		$target = !empty($target) ? ' target="_blank"' : '' ;

		// Title bold
		$titlebold = !empty($titlebold) ? 'font-weight:bold;' : '';

		// Title font size
		$titlesize 	= str_replace('px', '', $titlesize);
		if (is_numeric($titlesize)) {
			$titlesize 	= !empty($titlesize) ? 'font-size:'.$titlesize.'px;' : 'font-size:16px;';
		} else {
			$titlesize 	= 'font-size:16px;';
		}
		
		// Title and anchor text
		if (!empty($url)) {
			if (!empty($titlebold)) {
				$anchorcode 	= '<a href="'.$url.'"'.$target.' class="b" style="'.$titlecolor.$titlesize.'" onmouseover="this.style.color=\''.$titlehovercolor.'\'" onmouseout="this.style.color=\''.$titlecolorcopy.'\'">';
			} else {
				$anchorcode 	= '<a href="'.$url.'"'.$target.' style="'.$titlecolor.$titlesize.'" onmouseover="this.style.color=\''.$titlehovercolor.'\'" onmouseout="this.style.color=\''.$titlecolorcopy.'\'">';
			}
			if (!empty($imgurl)) {
				$anchoriconcode = '<a href="'.$url.'"'.$target.' class="picon">';
			} else {
				$anchoriconcode = '<a href="'.$url.'"'.$target.'  class="picon" style="'.$iconcolor.'" onmouseover="this.style.color=\''.$iconhovercolor.'\'" onmouseout="this.style.color=\''.$iconcolorcopy.'\'">';
			}

			$title 		= !empty($title) ? '<p class="promo_title'.$titlepaddinigclass.'" style="'.$titlebold.$blockalign.'">'.$anchorcode.$title.'</a></p>' : '';
		} else {
			$title 		= !empty($title) ? '<p class="promo_title'.$titlepaddinigclass.'" style="'.$titlecolor.$titlesize.$titlebold.$blockalign.'">'.$title.'</p>' : '';
		}

		// Image or icon
		if (!empty($imgurl)) {
			if (!empty($url)) {
				$icon = $anchoriconcode.'<img src="'.$imgurl.'" width="'.$iconsize.'px" class="promo_img bd-none bg-none" alt="icon" /></a>';
			} else {
				$icon = '<img src="'.$imgurl.'" width="'.$iconsize.'px" class="promo_img bd-none bg-none" alt="icon" />';
			}
		} else {
			if (!empty($icon)) {
				if (!empty($url)) {
					$icon = $anchoriconcode.'<span class="promo_icon '.$icon.'" style="'.$iconsize.'text-align:center;"></span></a>';
				} else {
					$icon = '<span class="promo_icon '.$icon.'" style="'.$iconsize.$iconcolor.'text-align:center;"></span>';
				}
			} else {
				$alignmargin = '';
			}
		}

		// Source code
		if (!empty($icon)) {
			if (!empty($alignflag)) {
				$code = <<<_EOD_
<div class="promo_icon_div$iconrotate$iconscale" style="$iconalign$iconbgcolor$iconbdcss$iconboxsize$iconstyle">$icon</div><div$alignmargin class="promo_text_div">$title<div class="promo_text" style="font-size:12px;$blockalign">$content</div></div>
_EOD_;
			} else {
				$code = <<<_EOD_
<div class="promo_icon_div$iconrotate$iconscale" style="$iconalign$iconbgcolor$iconbdcss$iconboxsize$iconstyle">$icon</div>$title<div class="promo_text" style="font-size:12px;$blockalign">$content</div>
_EOD_;
			}
		} else {
			if (!empty($alignflag)) {
				$code = <<<_EOD_
<div$alignmargin class="promo_text_div">$title<div class="promo_text" style="font-size:12px;$blockalign">$content</div></div>
_EOD_;
			} else {
				$code = <<<_EOD_
$title<div class="promo_text" style="font-size:12px;$blockalign">$content</div>
_EOD_;
			}
		}

		// bg color
		if (!empty($bgcolor) && empty($bghovercolor)) {
			$code = '<div class="promo_inner" style="background-color:'.$bgcolor.';">'.$code.'</div>';
		}
		else if (empty($bgcolor) && !empty($bghovercolor)) {
			$code = '<div class="promo_inner"  onmouseover="this.style.background=\''.$bghovercolor.'\'" onmouseout="this.style.background=\'transparent\'">'.$code.'</div>';
		}else if (!empty($bgcolor) && !empty($bghovercolor)) {
			$code = '<div class="promo_inner" style="background-color:'.$bgcolor.';" onmouseover="this.style.background=\''.$bghovercolor.'\'" onmouseout="this.style.background=\''.$bgcolor.'\'">'.$code.'</div>';
		}

		// Set delimiter
		$code .= $delim;

		return $code;
	}


/****************************************************************
* Highlight content
****************************************************************/
function dp_sc_highlighter($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;
	

	extract(shortcode_atts(array(
		'class'		=> '',
		'style'		=> '',
		'type'		=> false, // 0 or 1 /  highlight or slideshow
		'fx'		=> 'fade',
		'time'		=> 3000,
		'fadetime'	=> 2000,
		'pause'		=> false,
		'loop'		=> 1
	), $atts));

	$delim 		= '[//+++//]';
	$unique_id = 'dp-hl-'.dp_sc_rand(5);
	$codeContent	= '';

	$content = do_shortcode($content);

	// Get slides
	$arrContent = explode( $delim, $content );
	$arrContent = array_filter($arrContent, create_function('$item', 'return !preg_match("/^(\r|\n)+$/",$item);'));
	// $arrContent = array_values(array_filter($arrContent));
	// Separate every 3 elements (Remove unnecessary last item).
	$arrContent = array_chunk($arrContent, 3);

	// Each slide
	foreach ($arrContent as $key => $val) {
		$hl_content = str_replace(array("\r\n","\r","\n"), '', $val[0]);
		$fl_class 	= $val[1] ? ' class="dp_sc_highlight hl-target'.$val[1].'"' : ' class="dp_sc_highlight hl-target"';
		$fl_style 	= $val[2];
		
		$codeContent .= '<div'.$fl_class.$fl_style.'>'.$hl_content.'</div>';
	}

	// Pause on hover (2014.5.2 this is further function)
	if ($pause) {
		$pause = 1;
	} else {
		$pause = 0;
	}

	// Type
	if ($type == 1 || $type == 'slideshow') {
		$type = 'slideshow';
	} else {
		$type = 'default';
	}
 
	// Loop (2014.5.2 this is further function)
	if ($loop == 0 || $loop == 'false') {
		$loop = 0;
	} else {
		$loop = 1;
	}

	// effect (2014.5.2 this is further function)
	switch ($fx) {
		case 'slide':
			$fx = 'slide';
			break;
		default:
			$fx = 'fade';
			break;
	}

	$class 	= !empty($class) ? 'dp_sc_highlighter '.$class : 'dp_sc_highlighter';
	$style 	= !empty($style) ? ' style="'. $style . '"' : '';
	
	$js = <<<_EOD_
<div class="dp_sc_hl_js">
<script>
j$(window).load(function() {
	j$("#$unique_id").dp_sc_highlighter({
		time:$time,
		fadetime:$fadetime,
		type:"$type",
		fx:"$fx",
		loop:$loop
	});
});
</script>
</div>
_EOD_;

	$code = <<<_EOD_
<div id="$unique_id" class="$class $type clearfix"$style>$codeContent$js</div>
_EOD_;

	$code = str_replace(array("\r\n","\r","\n","\t"), '', $code);
	return $code;
}
	function dp_sc_highlight($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'class'		=> '',
			'style'		=> ''
		), $atts));

		$delim 		= '[//+++//]';

		$content = do_shortcode($content);
		$class = !empty($class) ? ' '.$class : '';
		$style = !empty($style) ? ' style="' . $style . '"' : '';

		$code = $content . $delim . $class . $delim . $style . $delim;
		return $code;
	}



/****************************************************************
* Profile
****************************************************************/
function dp_sc_profile($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;
	extract(shortcode_atts(array(
		'name' 		=> '',
		'namesize'	=> 18,
		'namebold'	=> true,
		'nameitalic'=> false,
		'hoverfx'	=> false,
		'authorurl'	=> get_home_url(),
		'namecolor'	=> '#333333',
		'desccolor' => '#888888',
		'descfontsize' => 12,
		'profimgurl'=> '',
		'profshape' => 'circle', // circle, round, square
		'profbdwidth' => 5,
		'profsize' 	=> 100,
		'topbgimgurl'	=> '',
		'topbgcolor'	=> '#dddddd',
		'bgcolor'	=> '#ffffff',
		'border'	=> false,
		'bdcolor'	=> '#dddddd',
		'twitterurl' 	=> '',
		'facebookurl' 	=> '',
		'googleplusurl' => '',
		'youtubeurl'	=> '',
		'pinteresturl'	=> '',
		'instagramurl'	=> '',
		'width' 		=> '100%',
		'class'			=> '',
		'plx'			=> ''
	), $atts));

	if (!$name) return;

	$style 	= '';
	$border_class = '';

	$namebold 	= (bool)$namebold ? 'font-weight:bold;' : '';
	$nameitalic = (bool)$nameitalic ? 'font-style:italic;' : '';

	$namesize = str_replace('px', '', $namesize);
	$namesize = (bool)$namesize ? $namesize : 18;
	$namesize = mb_convert_kana($namesize);
	$namesize = is_numeric($namesize) ? 'font-size:'.$namesize.'px;' : '';

	$profsize = str_replace('px', '', $profsize);
	$profsize = (bool)$profsize ? $profsize : 100;
	$profsize = mb_convert_kana($profsize);
	$profsize_style = is_numeric($profsize) ? 'width:'.$profsize.'px;height:'.$profsize.'px;' : '';
	
	$descfontsize = str_replace('px', '', $descfontsize);
	$descfontsize = (bool)$descfontsize ? $descfontsize : 12;
	$descfontsize = mb_convert_kana($descfontsize);
	$descfontsize = is_numeric($descfontsize) ? 'font-size:'.$descfontsize.'px;' : '';

	$namecolor 		= (bool)$namecolor ? 'color:'.$namecolor.';' : '';
	$desccolor 		= (bool)$desccolor ? 'color:'.$desccolor.';' : '';
	$profbdwidth 	= (bool)$profbdwidth ? 'border-width:'.str_replace('px', '', $profbdwidth).'px;' : '';

	$profimgurl 	= !empty($profimgurl) ? '<div class="centered"><img src="'.$profimgurl.'" style="max-height:'.intval($profsize + 1).'px;" alt="Profile image" /></div>' : '';
	$topbgimgurl 	= !empty($topbgimgurl) ? '<div class="dp_sc_prof_top_bgimg"><img src="'.$topbgimgurl.'" alt="Profile image" /></div>' : '';

	$topbgcolor_style 	= !empty($topbgcolor) ? 'background-color:'.$topbgcolor.';' : '';
	$bgcolor_style 		= !empty($bgcolor) ? 'background-color:'.$bgcolor.';' : '';

	$twitter_icon 	= '';
	$facebook_icon 	= '';
	$gplus_icon 	= '';
	$youtube_icon 	= '';
	$pinterest_icon = '';

	// Class
	$class = (bool)$class ? ' '.$class : '';

	//border
	if ((bool)$border) {
		$border = 'border:1px solid '.$bdcolor.';';
		$border_class = ' has-bd';
	}

	// Profile shape
	switch ($profshape) {
		case 'round':
			$profshape = ' round';
			$twitter_icon 	= 'icon-twitter-rect';
			$facebook_icon 	= 'icon-facebook-rect';
			$gplus_icon 	= 'icon-gplus-squared';
			$youtube_icon 	= 'icon-youtube-rect';
			$pinterest_icon = 'icon-pinterest-rect';
			$instagram_icon = 'icon-instagram';
			break;
		case 'square':
			$profshape = '';
			$twitter_icon 	= 'icon-twitter';
			$facebook_icon 	= 'icon-facebook';
			$gplus_icon 	= 'icon-gplus';
			$youtube_icon 	= 'icon-youtube';
			$pinterest_icon = 'icon-pinterest';
			$instagram_icon = 'icon-instagram';
			break;
		default:
			$profshape = ' circle';
			$twitter_icon 	= 'icon-twitter-circled';
			$facebook_icon 	= 'icon-facebook-circled';
			$gplus_icon 	= 'icon-gplus-circled';
			$youtube_icon 	= 'icon-youtube';
			$pinterest_icon = 'icon-pinterest-circled';
			$instagram_icon = 'icon-instagram';
			break;
	}

	// Hover effect
	switch ($hoverfx) {
		case 1:
		case 'rotate15':
			$hoverfx = ' rotate15';
			break;

		case 2:
		case 'zoom':
			$hoverfx = ' zoom-up';
			break;

		default:
			$hoverfx = '';
			break;
	}

	// Main width
	$width_style 	= !empty($width) ? 'width:'.$width.';' : 'width:100%;'; 
	
	// CSS
	$name_style 	= ' style="'.$namecolor.$namesize.$namebold.$nameitalic.'"';
	$prof_style 	= ' style="margin-top:-'.intval($profsize/2).'px;border-style:solid;'.'border-color:'.$bgcolor.';background-color:'.$bgcolor.';'.$profbdwidth.$profsize_style.';"';
	$top_style 		= ' style="'.$topbgcolor_style.'"';
	$desc_style 	= ' style="'.$desccolor.$descfontsize.'"';
	$style 			= ' style="'.$width_style.$bgcolor_style.$border.'"';

	
	if (!empty($authorurl)) {
		// Name
		$name_html = '<div class="dp_sc_prof_name"><a href="'.$authorurl.'"'.$name_style.'>'.$name.'</a></div>';
		// Prof
		$prof_html = '<div class="dp_sc_prof_img'.$profshape.$hoverfx.'"'.$prof_style.'><a href="'.$authorurl.'">'.$profimgurl.'</a></div>';
	} else {
		// Name
		$name_html = '<div class="dp_sc_prof_name"><span'.$name_style.'>'.$name.'</span></div>';
		// Prof
		$prof_html = '<div class="dp_sc_prof_img'.$profshape.'"'.$prof_style.'>'.$profimgurl.'</div>';
	}

	// Top area
	$top_html = '<div class="dp_sc_prof_top_area'.$border_class.'"'.$top_style.'>'.$topbgimgurl.'</div>';

	// description
	$desc_html = '<div class="dp_sc_prof_desc"'.$desc_style.'>'.$content.'</div>';
	
	// SNS
	$sns_html = '';
	if ($twitterurl) {
		$twitterurl = '<li><a href="'.$twitterurl.'" class="'.$twitter_icon.'" title="Follow on Twitter" target="_blank" style="'.$namecolor.';"><span>Twitter</span></a></li>';
	}
	if ($facebookurl) {
		$facebookurl = '<li><a href="'.$facebookurl.'" class="'.$facebook_icon.'" title="Like on Facebook" target="_blank" style="'.$namecolor.';"><span>Facebook</span></a></li>';
	}
	if ($googleplusurl) {
		$googleplusurl = '<li><a href="'.$googleplusurl.'" class="'.$gplus_icon.'" title="Share on Google+" target="_blank" style="'.$namecolor.';"><span>Google+</span></a></li>';
	}
	if ($youtubeurl) {
		$youtubeurl = '<li><a href="'.$youtubeurl.'" class="'.$youtube_icon.'" title="Subscribe on YouTube" target="_blank" style="'.$namecolor.';"><span>YouTube</span></a></li>';
	}
	if ($pinteresturl) {
		$pinteresturl = '<li><a href="'.$pinteresturl.'" class="'.$pinterest_icon.'" title="Share on Pinterest" target="_blank" style="'.$namecolor.';"><span>Pinterest</span></a></li>';
	}
	if ($instagramurl) {
		$instagramurl = '<li><a href="'.$instagramurl.'" class="'.$instagram_icon.'" title="Share on Instagram" target="_blank" style="'.$namecolor.';"><span>Instagram</span></a></li>';
	}
	if ($twitterurl || $facebookurl || $googleplusurl || $youtubeurl || $pinteresturl || $instagramurl) {
		$sns_html = '<div class="dp_sc_prof_sns'.$hoverfx.'"><ul>'.$googleplusurl.$twitterurl.$facebookurl.$instagramurl.$pinteresturl.$youtubeurl.'</ul></div>';
	}

	// Parallax params for macciato theme
	if (!empty($plx)){
		$plx = ' data-sr="'.$plx.'"';
	}

	$code = <<<_EOD_
<div class="dp_sc_prof$class"$style$plx>$top_html$prof_html$name_html$desc_html$sns_html</div>
_EOD_;

	return $code;
}



/****************************************************************
* Slideshow content
****************************************************************/
function dp_sc_slideshow($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;

	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class'		=> '',
		'style'		=> '',
		'fx'		=> 'fade', // fade or slide
		'autoplay'	=> 'true', // 0 or 1 /  highlight or slideshow
		'showtime'		=> 3500,
		'transitiontime'=> 1200,
		'hoverpause'=> 'false',
		'showcontrol'	=> 'true',
		'controlpos'=> 'center',	// right, center, left
		'nexttext'	=> 'Next',
		'prevtext'	=> 'Prev',
		'showpagenavi'=> 'true',
		'pagenavipos'=> 'center',	// right, center, left
		'usecaption'=> 'true',
		'random'	=> 'false',
		'responsive'	=> 'true',
		'captionblack' => false
	), $atts));

	$delim 		= '[//+++//]';
	$unique_id = 'dp_sc_slideshow_'.dp_sc_rand(5);
	$codeContent 	= '';
	$centercontrols = '';
	$centermarkers	= '';

	$content = do_shortcode($content);

	// Get slides
	$arrContent = explode( $delim, $content );
	$arrContent = array_filter($arrContent, create_function('$item', 'return !preg_match("/^(\r|\n)+$/",$item);'));
	// $arrContent = array_values(array_filter($arrContent));
	// Separate every 3 elements (Remove unnecessary last item).
	$arrContent = array_chunk($arrContent, 4);

	// Each slides
	foreach ($arrContent as $key => $val) {
		$val[0] = str_replace(array("\r\n","\r","\n"), '', $val[0]);
		if ($val[0] != '[//null//]') {
			$slide_content = '<div class="dp_sc_slideshow_content">'.$val[0].'</div>';
		} else {
			$slide_content = '';
		}
		
		$slide_class 	= $val[1] ? ' class="dp_sc_slideshow_li '.$val[1].'"' : ' class="dp_sc_slideshow_li"';
		$slide_style 	= $val[2];
		$slide_image 	= $val[3];
		
		$codeContent .= '<li'.$slide_class.$slide_style.'>'.$slide_image.$slide_content.'</li>';
	}

	if (!$fx || $fx !== 'slide') {
		$fx = 'fade';
	}

	if (!$autoplay) {
		$autoplay = 'true';
	}

	$showtime = mb_convert_kana($showtime);
	if (!is_numeric($showtime)) {
		$showtime = 3500;
	}

	$transitiontime = mb_convert_kana($transitiontime);
	if (!is_numeric($transitiontime)) {
		$transitiontime = 1200;
	}

	if (!$hoverpause) {
		$hoverpause = 'false';
	}

	if (!$showcontrol) {
		$showcontrol = 'true';
	}

	switch ($controlpos) {
		case 'right':
			$controlpos = ' control-r';
			$centercontrols = 'false';
			break;
		case 'left':
			$controlpos = '';
			$centercontrols = 'false';
			break;
		default:
			$controlpos = '';
			$centercontrols = 'true';
			break;
	}

	switch ($pagenavipos) {
		case 'right':
			$pagenavipos = ' pagenavi-r';
			$centermarkers = 'false';
			break;
		case 'left':
			$pagenavipos = '';
			$centermarkers = 'false';
			break;
		default:
			$pagenavipos = '';
			$centermarkers = 'true';
			break;
	}

	if ($random != 'true') {
		$random = 'false';
	}

	if ((bool)$captionblack) {
		$captionblack = ' cpt-blk';
	}


	$class 	= !empty($class) ? 'dp_sc_slideshow loading'.$class : 'dp_sc_slideshow loading';
	$style 	= !empty($style) ? ' style="'. $style . '"' : '';
	
	$js = <<<_EOD_
<div><script>
j$(window).load(function() {
	var h=0;
	j$("#$unique_id").bjqs({
		animtype:'$fx',
		animspeed:$showtime,
		animduration:$transitiontime,
		automatic:$autoplay,
		showcontrols:$showcontrol,
		centercontrols:$centercontrols,
		nexttext:"$nexttext",
		prevtext:"$prevtext",
		showmarkers:$showpagenavi,
		centermarkers:$centermarkers,
		hoverpause:$hoverpause,
		usecaptions:$usecaption,
		randomstart:$random,
		responsive:$responsive,
		width:j$("#$unique_id").width(),
		height:'auto'
	});
	j$("#$unique_id ul.bjqs li").each(function(){
		if (j$(this).height() > h) {
			h=j$(this).height();
		}
		j$("#$unique_id ul.bjqs").height(h);
	});
	j$("#$unique_id").removeClass("loading");
});
</script></div>
_EOD_;

	$code = <<<_EOD_
<div id="$unique_id" class="$class$captionblack$controlpos$pagenavipos clearfix"$style>
	<ul class="bjqs">
		$codeContent
	</ul>
</div>
$js
_EOD_;

	$code = str_replace(array("\r\n","\r","\n","\t"), '', $code);
	return $code;
}
	function dp_sc_slide($atts, $content = null) {
		extract(shortcode_atts(array(
			'class'		=> '',
			'style'		=> '',
			'caption'	=> '',
			'imgurl'	=> '',
			'url'		=> '',
			'newwindow'	=> false
		), $atts));

		$delim 		= '[//+++//]';

		$content = str_replace(array("\r\n","\r","\n","\t"), '', $content);

		if (!$content || $content == "") {
			$content = '[//null//]';
		} else {
			$content = do_shortcode($content);
		}

		$caption = !empty($caption) ? ' title="'.$caption.'"': '';
		$img_code = !empty($imgurl) ? '<img src="'.$imgurl.'"'.$caption.' alt="Slide image" />' : '';

		if ($img_code && $url) {
			if ($newwindow) {
				$img_code = '<a href="'.$url.'" target="_blank">'.$img_code.'</a>';
			} else {
				$img_code = '<a href="'.$url.'">'.$img_code.'</a>';
			}
		}

		$class = !empty($class) ? ' '.$class : '';
		$style = !empty($style) ? ' style="' . $style . '"' : '';

		$code = $content . $delim . $class . $delim . $style . $delim . $img_code . $delim;
		return $code;
	}


/****************************************************************
* Flex box
****************************************************************/
function dp_sc_pi_flex_box($atts, $content = null) {
	if (is_admin()) return;
	if (!$content) return;
	if (!class_exists('DP_SC_PLUGIN')) return;
	if (!function_exists('dp_sc_plugin_status')) return;
	// Status check
	$status = dp_sc_plugin_status();
	if (!$status) return;

	extract(shortcode_atts(array(
		'class' 	=> '',
		'direction'	=> '',	// row(1), rowreverse(2), col(3), colreverse(4)
		'wrap' 		=> '',	// nowrap(1), wrap(2), reverse(3)
		'alignh'	=> '',	// left(1), right(2), center(3), between(4), around(5)
		'alignv'	=> '',	// stretch(1), center(2), top(3), bottom(4), between(5), around(6)
		'alignitems'=> '',	// stretch(1), center(2), start(3), end(4), baseline(5)
		'flexchildren'=> false,
		'width'		=> '',
		'height'	=> '',
		'style'		=> ''
	), $atts));

	// Target theme
	$dp_theme_key = defined('DP_THEME_KEY') ? ' '.DP_THEME_KEY : '';

	// Flex direction
	if ( $direction === 'rowreverse' || $direction === '2' ) {
		$direction =' dir_row_rev';
	} 
	else if ( $direction === 'col' || $direction === '3' ) {
		$direction =' dir_col';
	}
	else if ( $direction === 'colreverse' || $direction === '4' ) {
		$direction =' dir_col_rev';
	}

	// Flex wrap
	if ( $wrap === 'wrap' || $wrap === '2' ) {
		$wrap =' wrap';
	} 
	else if ( $wrap === 'reverse' || $wrap === '3' ) {
		$wrap =' wrap_rev';
	}

	// Flex justify ( Horizontal)
	if ( $alignh === 'right' || $alignh === '2' ) {
		$alignh =' justify_end';
	} 
	else if ( $alignh === 'center' || $alignh === '3' ) {
		$alignh =' justify_cen';
	}
	else if ( $alignh === 'between' || $alignh === '4' ) {
		$alignh =' justify_bet';
	}
	else if ( $alignh === 'around' || $alignh === '5' ) {
		$alignh =' justify_aro';
	}

	// Flex align content (Vertical)
	if ( $alignv === 'center' || $alignv === '2' ) {
		$alignv =' al_con_cen';
	}
	else if ( $alignv === 'top' || $alignv === '3' ) {
		$alignv =' al_con_sta';
	}
	if ( $alignv === 'bottom' || $alignv === '4' ) {
		$alignv =' al_con_end';
	}
	else if ( $alignv === 'between' || $alignv === '5' ) {
		$alignv =' al_con_bet';
	}
	else if ( $alignv === 'around' || $alignv === '6' ) {
		$alignv =' al_con_aro';
	}

	// Flex align items
	if ( $alignitems === 'center' || $alignitems === '2' ) {
		$alignitems =' al_item_cen';
	}
	else if ( $alignitems === 'start' || $alignitems === '3' ) {
		$alignitems =' al_item_sta';
	}
	else if ( $alignitems === 'end' || $alignitems === '4' ) {
		$alignitems =' al_item_end';
	}
	else if ( $alignitems === 'baseline' || $alignitems === '5' ) {
		$alignitems =' al_item_bas';
	}

	// Flex children?
	if ((bool)$flexchildren) {
		$flexchildren = ' flex_children';
	}

	// Width
	$width = !empty($width) ? 'width:'.$width.';' : '';
	// height
	$height = str_replace('px', '', $height);
	$height = !empty($height) ? 'height:'.$height.';' : '';

	// Get promos
	$content 	= do_shortcode($content);

	$style 	= !empty($style) || !empty($width) || !empty($height) ? ' style="'.$width.$height.$style.'"' : '';
	$class 	= !empty($class) ? ' '.$class.$dp_theme_key : $dp_theme_key;
	$class 	.= $direction.$wrap.$alignh.$alignitems.$alignv.$flexchildren;
	
	
	$code = '<div class="dp_sc_fl_box'.$class.'"'.$style.'>'.$content.'</div>';

	return $code;
}
	function dp_sc_pi_flex_item($atts, $content = null) {
		if (!$content) return;

		extract(shortcode_atts(array(
			'padding'	=> '',
			'margin'	=> '',
			'width' 	=> '',
			'height'	=> '',
			'flex'		=> '',
			'class'		=> '',
			'style'		=> '',
			'plx'		=> ''
		), $atts));

		$content 	= do_shortcode($content);

		// padding
		$padding = str_replace('px', '', $padding);
		$padding = !empty($padding) ? 'padding:'.$padding.'px;' : '';

		// margin
		$margin = str_replace('px', '', $margin);
		$new_margin = !empty($margin) ? 'margin-left:'.$margin.'px;margin-right:'.$margin.'px;' : '';
		$new_margin = ($margin === '0') ? 'margin-left:0;margin-right:0;' : $new_margin;

		// Width
		$width = !empty($width) ? 'width:'.$width.';' : '';
		// height
		$height = str_replace('px', '', $height);
		$height = !empty($height) ? 'height:'.$height.'px;' : '';

		// Felx paaram
		$flex = !empty($flex) ? 'flex:'.$flex.';-ms-flex:'.$flex.';-webkit-flex:'.$flex.';' : '';

		$class = !empty($class) ? ' '.$class : '';
		$style = (!empty($style) || !empty($padding) || !empty($new_margin
			) || !empty($width) || !empty($height) || !empty($flex)) ? ' style="'.$padding.$new_margin.$width.$height.$flex.$style.'"' : '';

		// Parallax params for macciato theme
		if (!empty($plx)){
			$plx = ' data-sr="'.$plx.'"';
		}

		$content = '<div class="dp_sc_fl_item'.$class.'"'.$style.$plx.'>'.$content.'</div>';
		return $content;
	}


/****************************************************************
* Register shortcodes
****************************************************************/
add_shortcode('font', 'dp_sc_pi_font');
add_shortcode('button', 'dp_sc_pi_button');
add_shortcode('label', 'dp_sc_pi_label');
add_shortcode('filter', 'dp_sc_img_filter');

// Disable wpautop for shortcodes 
function dp_sc_pi_run_shortcode_before( $content ) {
	if (is_admin()) return;

	global $shortcode_tags;
	// Backup exist shortcode
	// $orig_shortcode_tags = $shortcode_tags;
	// // Delete shortcode temporary
	// remove_all_shortcodes();

	// // Redo exist shortcodes
	// $shortcode_tags = $orig_shortcode_tags;

	// Prefix when conflict name.
	$conflict_prefix = 'dp_';
	
	// Register shortocodes
	if ( shortcode_exists( 'toggles' ) || shortcode_exists( 'toggle' ) ) {
		add_shortcode($conflict_prefix.'toggles', 'dp_sc_pi_toggles');
		add_shortcode($conflict_prefix.'toggle', 'dp_sc_pi_toggle');
	} else {
		add_shortcode('toggles', 'dp_sc_pi_toggles');
		add_shortcode('toggle', 'dp_sc_pi_toggle');
	}

	if ( shortcode_exists( 'accordions' ) || shortcode_exists( 'accordion' ) ) {
		add_shortcode($conflict_prefix.'accordions', 'dp_sc_pi_accordions');
		add_shortcode($conflict_prefix.'accordion', 'dp_sc_pi_accordion');
	} else {
		add_shortcode('accordions', 'dp_sc_pi_accordions');
		add_shortcode('accordion', 'dp_sc_pi_accordion');
	}
	
	if ( shortcode_exists( 'tabs' ) || shortcode_exists( 'tab' )) {
		add_shortcode($conflict_prefix."tabs", "dp_sc_pi_tabs");
		add_shortcode($conflict_prefix.'tab', 'dp_sc_pi_tab');
	} else {
		add_shortcode("tabs", "dp_sc_pi_tabs");
		add_shortcode('tab', 'dp_sc_pi_tab');
	}
	
	if ( shortcode_exists( 'table' ) || shortcode_exists( 'tablehead' ) || shortcode_exists( 'tablerow' ) || shortcode_exists( 'tablecell' ) ) {
		add_shortcode($conflict_prefix.'table', 'dp_sc_pi_table');
		add_shortcode($conflict_prefix.'tablehead', 'dp_sc_pi_table_head');
		add_shortcode($conflict_prefix.'tablerow', 'dp_sc_pi_table_row');
		add_shortcode($conflict_prefix.'tablecell', 'dp_sc_pi_table_cell');
	} else {
		add_shortcode('table', 'dp_sc_pi_table');
		add_shortcode('tablehead', 'dp_sc_pi_table_head');
		add_shortcode('tablerow', 'dp_sc_pi_table_row');
		add_shortcode('tablecell', 'dp_sc_pi_table_cell');
	}
	
	if ( shortcode_exists( 'promobox' ) || shortcode_exists( 'promo' ) ) {
		add_shortcode($conflict_prefix.'promobox', 'dp_sc_pi_promo_box');
		add_shortcode($conflict_prefix.'promo', 'dp_sc_pi_promo');
	} else {
		add_shortcode('promobox', 'dp_sc_pi_promo_box');
		add_shortcode('promo', 'dp_sc_pi_promo');
	}
	
	if ( shortcode_exists( 'highlighter' ) || shortcode_exists( 'highlight' )) {
		add_shortcode($conflict_prefix.'highlighter', 'dp_sc_highlighter');
		add_shortcode($conflict_prefix.'highlight', 'dp_sc_highlight');
	} else {
		add_shortcode('highlighter', 'dp_sc_highlighter');
		add_shortcode('highlight', 'dp_sc_highlight');
	}

	if ( shortcode_exists( 'profile' ) ) {
		add_shortcode($conflict_prefix.'profile', 'dp_sc_profile');
	} else {
		add_shortcode('profile', 'dp_sc_profile');
	}

	if ( shortcode_exists( 'dpslideshow' ) || shortcode_exists( 'dpslideshow' )) {
		add_shortcode($conflict_prefix.'dpslideshow', 'dp_sc_slideshow');
		add_shortcode($conflict_prefix.'dpslide', 'dp_sc_slide');
	} else {
		add_shortcode('dpslideshow', 'dp_sc_slideshow');
		add_shortcode('dpslide', 'dp_sc_slide');
	}

	if ( shortcode_exists( 'flexbox' ) || shortcode_exists( 'flexcol' ) ) {
		add_shortcode($conflict_prefix.'flexbox', 'dp_sc_pi_flex_box');
		add_shortcode($conflict_prefix.'flexitem', 'dp_sc_pi_flex_item');
	} else {
		add_shortcode('flexbox', 'dp_sc_pi_flex_box');
		add_shortcode('flexitem', 'dp_sc_pi_flex_item');
	}
	// Do the original shortcodes
	$content = do_shortcode( $content );
	//Return
	return $content;
}


/****************************************************************
* Enable shortcode in article and text widget.
****************************************************************/
add_filter( 'the_content', 'dp_sc_pi_run_shortcode_before', 7 );
add_filter( 'widget_text', 'dp_sc_pi_run_shortcode_before', 7 );
add_filter( 'dp_widget_text', 'dp_sc_pi_run_shortcode_before', 7 );
add_filter( 'dp_widget_text', 'dp_sc_pi_run_shortcode_before', 7 );
add_filter( 'dp_parallax_widget_description', 'dp_sc_pi_run_shortcode_before', 7 );
add_filter( 'dp_parallax_widget_content', 'dp_sc_pi_run_shortcode_before', 7 );

/****************************************************************
* Make darken or lighten color from hex to rgb
****************************************************************/
function dp_sc_pi_darkenColor($color, $range = 30) {
	if (!is_numeric($range)) $range = 30;
	if ($range > 255 || $range < 0) $range = 30;
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$hex = hexdec($hex);
		$hex = $hex > $range ? $hex - $range : $hex;
		$rgb[] = $hex;
	}
	return $rgb;
}
function dp_sc_pi_lightenColor($color, $range = 30) {
	if (!is_numeric($range)) $range = 30;
	if ($range > 255 || $range < 0) $range = 30;
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$hex = hexdec($hex);
		$hex = $hex + $range <= 255 ? $hex + $range : $hex;
		$rgb[] = $hex;
	}
	return $rgb;
}
/****************************
 * HEX to RGB
 ***************************/
function dp_sc_pi_hexToRgb($color) {
	$color = preg_replace("/^#/", '', $color);
	if (mb_strlen($color) == 3) $color .= $color;
	$rgb = array();
	for($i = 0; $i < 6; $i+=2) {
		$hex = substr($color, $i, 2);
		$rgb[] = hexdec($hex);
	}
	return $rgb;
}
/****************************
// RGB to HEX
 ***************************/
function dp_sc_pi_rgbToHex($rgb) {
	if (count($rgb) !== 3) return;
	$hex = '';
	$current = '';
	foreach ($rgb as $val) {
		$current = dechex($val);
		if (mb_strlen($current) === 1) {
			$hex .= '0'.$current;
		} else {
			$hex .= $current;
		}
	}
	return '#'.$hex;
}

/****************************
 Random strings
 ***************************/
function dp_sc_rand($length = 8) {
	return base_convert(mt_rand(pow(36, $length - 1), pow(36, $length) - 1), 10, 36);
}
?>