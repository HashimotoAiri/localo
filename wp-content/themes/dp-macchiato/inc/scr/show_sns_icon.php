<?php
/*******************************************************
* SNS connection Buttons
*******************************************************/
/**
* Show SNS buttons in post meta part.
* @param	none
* @return	none
*/
function dp_show_sns_buttons($position = 'top', $echo = true) {
	global $options;

	// **********
	// Main 
	// **********
	if ( !$options['show_twitter_button'] 
		&& !$options['show_facebook_button'] 
		&& !$options['show_mixi_button'] 
		&& !$options['show_hatena_button']
		&& !$options['show_evernote_button']
		&& !$options['show_line_button']
		&& !$options['show_pocket_button']
		&& !$options['show_tumblr_button']
		&& !$options['show_google_button']
		&& !$options['show_feedly_button'] ) return;

	if (get_post_meta(get_the_ID(), 'hide_sns_icon', true)) return;
	
	// Get feedly subscribers
	if ( !$subscribers = get_transient( 'feedly_subscribers' ) ) {
		$feed_url 	= rawurlencode( get_bloginfo( 'rss2_url' ) );
		$subscribers = wp_remote_get( "https://cloud.feedly.com/v3/feeds/feed%2F$feed_url" );
		if(!is_wp_error($subscribers)) {
			$subscribers = json_decode( $subscribers['body'] );
			if (empty($subscribers)) {
				$subscribers = 0;
			} else {
				$subscribers = number_format_i18n( $subscribers->subscribers );
				// Cache for 12 hours
				set_transient( 'feedly_subscribers', $subscribers, 60 * 60 * 12 );
			}
		} else {
			$subscribers = '-';
		}
	}

	$html_code = '';

	//For Status
	$post_title	= urlencode( get_the_title() );
	$page_url	= get_permalink ();
	
	// Button Style
	$btn_style_google = 'medium';
	$btn_style_twitter = 'horizontal';
	$btn_style_hatebu = 'simple-balloon';
	$btn_style_line = 'linebutton_86x20.png';
		$btn_line_w = '86';
		$btn_line_h = '20';
	$btn_style_mixi = 'medium';	// large
	$btn_style_evernote = '//static.evernote.com/article-clipper-jp.png';	// //static.evernote.com/article-clipper-vert.png
	$btn_style_facebook = 'button_count';
	$fb_share 			= $options['show_facebook_button_w_share'] ? 'true' : 'false';
	$btn_style_pocket	= 'horizontal';
	$feedly_standard 	= ' feedly_standard';
	$style = 'sns_btn_div sns_btn_normal';

	// Button Style
	if ($options['sns_button_type'] == 'box') {
		$btn_style_google = 'tall';
		$btn_style_twitter = 'vertical';
		$btn_style_hatebu = 'vertical-balloon';
		$btn_style_line = 'linebutton_36x60.png';
			$btn_line_w = '36';
			$btn_line_h = '60';
		$btn_style_mixi = 'large';
		$btn_style_evernote = '//static.evernote.com/article-clipper-vert.png';
		$btn_style_facebook = 'box_count';
		$btn_style_pocket	= 'vertical';
		$feedly_standard  = '';
		$style = 'sns_btn_div sns_btn_box';
	}

	if ($position == 'top') {
		$html_code = '<div class="post_meta_sns_btn top"><ul class="'.$style.'">';
	} else {
		$html_code = '<div class="post_meta_sns_btn bottom"><ul class="'.$style.'">';
	}

	if ($options['show_google_button']) {
		$html_code .= '<li class="sns_btn_google"><div class="g-plusone" data-size="'.$btn_style_google.'"></div></li>';
	}

	if ($options['show_twitter_button']) {
		$html_code .=  '<li class="sns_btn_twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-url="'.$page_url.'" data-count="'.$btn_style_twitter.'">Tweet</a></li>';
	}

	if ($options['show_facebook_button']) {
		$html_code .=  '<li class="sns_btn_facebook"><div class="fb-like" data-href="' .$page_url. '" data-send="false" data-layout="'.$btn_style_facebook.'" data-show-faces="false" data-share="'.$fb_share.'"></div></li>';
	}

	if ($options['show_pocket_button']) {
		$html_code .=  '<li class="sns_btn_pocket"><a data-pocket-label="pocket" data-pocket-count="'.$btn_style_pocket.'" class="pocket-btn" data-lang="en"></a></li>';
	}

	if ($options['show_feedly_button']) {
		$html_code .= '<li class="sns_btn_feedly"><a href="//cloud.feedly.com/#subscription%2Ffeed%2F'.rawurlencode(get_bloginfo('rss2_url')).'" class="feedly_button" target="_blank" title="Subscribe on feedly"><div class="arrow_box_feedly'.$feedly_standard.'"><span class="feedly_count">'. $subscribers .'</span></div><img src="//s3.feedly.com/img/follows/feedly-follow-rectangle-flat-small_2x.png" alt="follow us in feedly" width="66" height="20"></a></li>';
	}

	if ($options['show_hatena_button'] ) {
		$html_code .=  '<li class="sns_btn_hatena"><a href="http://b.hatena.ne.jp/entry/' .$page_url.'" class="hatena-bookmark-button" data-hatena-bookmark-title="'.$post_title.'" data-hatena-bookmark-layout="'.$btn_style_hatebu.'" title="このエントリーをはてなブックマークに追加"><img src="//b.hatena.ne.jp/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a></li>';
	}

	if ($options['show_mixi_button'] && $options['mixi_accept_key']) {
		$html_code .=  '<li class="sns_btn_mixi"><div data-plugins-type="mixi-favorite" data-service-key="'.$options['mixi_accept_key'].'" data-size="'.$btn_style_mixi.'" data-href="" data-show-faces="false" data-show-count="true" data-show-comment="true" data-width="" ></div></li>';
	}

	if ($options['show_evernote_button']) {
		$html_code .=  '<li class="sns_btn_evernote"><a href="#" onclick="Evernote.doClip({}); return false;"><img src="'.$btn_style_evernote.'" alt="Clip to Evernote" /></a></li>';
	}

	if ($options['show_tumblr_button']) {
		$html_code .=  '<li class="sns_btn_tumblr"><a href="//www.tumblr.com/share" title="Share on Tumblr"><span>Share on Tumblr</span></a></li>';
	}

	if ($options['show_line_button']) {
		$html_code .=  '<li class="sns_btn_line"><a href="line://msg/text/' . get_the_title() . '%0D%0A' . get_permalink() . '" target="_blank" class="mq-show600"><img src="'.DP_THEME_URI . '/img/social/'.$btn_style_line.'" width="'.$btn_line_w.'" height="'.$btn_line_h.'" alt="LINEで送る" /></a></li>';
	}

	$html_code .= '</ul></div>';

	if ($echo) {
		echo $html_code;
	} else {
		return $html_code;
	}
}

/*******************************************************
* SNS connection Buttons
*******************************************************/
/**
* Show SNS buttons in post meta part.
* @param	position, echo flag
* @return	string or array
*/
function dp_show_sns_buttons_original($position = 'top', $echo = true) {
	global $options, $IS_MOBILE_DP;

	$html_code 	= '';
	$code1 		= '';
	$code2 		= '';
	$code3 		= '';
	$js_code 	= '';

	$post_type = get_post_type();

	$url = urlencode(get_permalink());
	$title = urlencode(get_the_title().' | '.get_bloginfo('name'));
	$rss_url = urlencode(get_bloginfo('rss2_url'));

	// *** row1
	if ($options['show_facebook_button']) {
		$code1 = '<div class="sitem bg-likes"><a href="https://www.facebook.com/sharer/sharer.php?u='.$url.'&t='.$title.'" target="_blank" rel="nofollow"><i class="icon-facebook"></i><span class="share-num dp_spinner"></span></a></div>';
	}
	if ($options['show_hatena_button'] ) {
		$code1 .= '<div class="sitem bg-hatebu"><a href="http://b.hatena.ne.jp/add?mode=confirm&url='.$url.'&title='.$title.'" target="_blank" rel="nofollow"><i class="icon-hatebu"></i></a><a href="http://b.hatena.ne.jp/entry/'.$url.'" target="_blank" class="share-num dp_spinner" rel="nofollow"></a></div>';
	}
	if ($options['show_twitter_button']) {
		$code1 .= '<div class="sitem bg-tweets"><a href="http://twitter.com/intent/tweet?original_referer='.$url.'&url='.$url.'&text='.$title.'" target="_blank" rel="nofollow"><i class="icon-twitter"></i><a href="https://twitter.com/search?q='.$url.'" target="_blank" class="share-num icon-comments" rel="nofollow"></a></div>';
	}

	// *** row2
	if ($options['show_google_button']) {
		$num = get_gplus_subscribers();
		$code2 = '<div class="sitem bg-gplus"><a href="https://plus.google.com/share?url='.$url.'" target="_blank" rel="nofollow"><i class="icon-gplus"></i><span class="share-num">'.$num.'</span></a></div>';
	}
	if ($options['show_pocket_button']) {
		// $num = get_pocket_subscribers();
		$code2 .= '<div class="sitem bg-pocket"><a href="https://getpocket.com/edit?url='.$url.'" target="_blank"><i class="icon-pocket"></i><span class="share-num dp_spinner"></span></a></div>';
	}
	if ($options['show_feedly_button']) {
		$num = get_feedly_subscribers();
		$code2 .= '<div class="sitem bg-feedly"><a href="http://feedly.com/index.html#subscription%2Ffeed%2F'.$rss_url.'" target="_blank" rel="nofollow"><i class="icon-feedly"></i><span class="share-num">'.$num.'</span></a></div>';
	}
	if ($IS_MOBILE_DP) {
		if ($options['show_line_button']) {
			$code3 = '<div class="sitem bg-line"><a href="line://msg/text/' . $title . '%0D%0A' . $url . '"><span class="share-num">LINE</span></a></div>';
		}
	}
	if (!empty($code1) || !empty($code2) || !empty($code3)) {
		$html_code = '<div class="loop-share-num">'.$code1.$code2.$code3.'</div>';
	}

	// *** javascript
	if (!empty($html_code)) {
		$js_code = '<script>j$(function(){get_sns_share_count("'.get_permalink().'", "'.$post_type.'-'.get_the_ID().'");});</script>';
	}

	if ($echo) {
		echo $html_code.$js_code;
	} else {
		return $html_code.$js_code;
	}
}

/*******************************************************
* SNS connection Links in Top or Footer menu
*******************************************************/
function show_sns_rss_list_in_menu() {
	global $options;
	// SNS links
	if (!$options['show_fixed_menu_sns']) return;

	$facebook_list_code = $options['fixed_menu_fb_url'] ? '<li><a href="' . $options['fixed_menu_fb_url'] . '" title="Share on Facebook" target="_blank" class="icon-facebook"><span>Facebook</span></a></li>' : '';

	$twitter_list_code = $options['fixed_menu_twitter_url'] ? '<li><a href="' . $options['fixed_menu_twitter_url'] . '" title="Follow on Twitter" target="_blank" class="icon-twitter"><span>Twitter</span></a></li>' : '';

	$gplus_list_code = $options['fixed_menu_gplus_url'] ? '<li><a href="' . $options['fixed_menu_gplus_url'] . '" title="Google+" target="_blank" class="icon-gplus"><span>Google+</span></a></li>' : '';

	if ($options['rss_to_feedly']) {
		$rss_list_code = '<li><a href="//cloud.feedly.com/#subscription%2Ffeed%2F'.urlencode(get_feed_link()).'" target="blank" title="Follow on feedly" class="icon-feedly"><span>Follow on feedly</span></a></li>';
	} else {
		$rss_list_code = '<li><a href="'
			.get_feed_link()
			.'" title="'.__('Subscribe feed', 'DigiPress')
			.'" target="_blank" class="icon-rss"><span>RSS</span></a></li>';
	}

	echo '<ul class="clearfix">'.$facebook_list_code.$twitter_list_code.$gplus_list_code.$rss_list_code.'</ul>';
}


/*******************************************************
* SNS Buttons for site header area
*******************************************************/
function show_sns_buttons_in_header() {
	global $options;

	if (!$options['header_fb_like_button'] && 
		!$options['header_twitter_button'] &&
		!$options['header_gplus_button']) return;
?>
<div id="header_sns_buttons"><ul>
<?php
	// Facebook
	if ($options['header_fb_like_button']) {
		echo '<li class="hd_like_btn"><div class="fb-like" data-href="' . home_url() . '" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false"></div></li>';
	} 

	// Twitter
	if ($options['header_twitter_button']) {
		echo '<li class="hd_tweet_btn"><a href="https://twitter.com/share" class="twitter-share-button" data-url="' . home_url() . '" data-lang="ja" data-count="horizontal">Tweet</a></li>';
	}

	// Google plus
	if ($options['header_gplus_button']) {
		echo '<li class="hd_gplus_btn"><div class="g-plusone" data-href="' . home_url() . '" data-size="medium"></div></li>';
	}
?>
</ul></div>
<?php
}	// End of function
?>
