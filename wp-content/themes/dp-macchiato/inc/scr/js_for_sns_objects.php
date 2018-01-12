<?php
function js_for_sns_objects() {
	global $options, $FB_APP_ID, $EXIST_FB_LIKE_BOX;

	$post_type = '';
	$fb_app_id = '';
	if (is_single() || is_page()) {
		$hide_sns_icon_flag = (bool)get_post_meta(get_the_ID(), 'hide_sns_icon', true);
		$hide_fbcomment_flag = (bool)get_post_meta(get_the_ID(), 'dp_hide_fb_comment', true);
		$post_type = get_post_type();
	}

	//For SNS Buttons
	if ( is_single() || is_page() ) {
		if ($options['sns_button_under_title'] || $options['sns_button_on_meta']) {
			if (!$hide_sns_icon_flag ) {
				// Google+
				if ($options['show_google_button']) {
					echo '<script src="https://apis.google.com/js/plusone.js">{lang: "ja"}</script>';
				}
				// Hatebu
				if ($options['show_hatena_button']) {
					echo '<script src="//b.hatena.ne.jp/js/bookmark_button.js" charset="utf-8" async="async"></script>';
				}
				// mixi
				if ($options['show_mixi_button'] && $options['mixi_accept_key']) {
					echo '<script type="text/javascript">(function(d) {var s = d.createElement(\'script\'); s.type = \'text/javascript\'; s.async = true;s.src = \'//static.mixi.jp/js/plugins.js#lang=ja\';d.getElementsByTagName(\'head\')[0].appendChild(s);})(document);</script>';
				}
				// Evernote
				if ($options['show_evernote_button']) {
					echo '<script src="//static.evernote.com/noteit.js"></script>';
				}
				// Tumblr
				if ($options['show_tumblr_button']) {
					echo '<script src="//platform.tumblr.com/v1/share.js"></script>';
				}
				// Pocket
				if ($options['show_pocket_button']) {
					echo '<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>';
				}
				// Twitter
				if ($options['show_twitter_button']) {
					echo '<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
				}
				// *** Facebook js trigger
				if ($options['show_facebook_button']) {
					// Change the flag
					$EXIST_FB_LIKE_BOX = true;
				}
			}
		}

		// *** Facebook js trigger
		if ( ((bool)$options['facebookcomment'] || (bool)$options['facebookcomment_page']) && !$hide_fbcomment_flag ) {
			// Change the flag
			$EXIST_FB_LIKE_BOX = true;
		}
	}

	// *** JS for facebook
	if ( $EXIST_FB_LIKE_BOX ) {
		$fb_app_id =  $options['fb_app_id'] ? '&appId='.$options['fb_app_id'] : '';
		if (!$fb_app_id) {
			$fb_app_id = $FB_APP_ID ? '&appId='.$FB_APP_ID : '';
		}
		echo '<div id="fb-root"></div><script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js=d.createElement(s);js.id=id;js.src="//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.3' . $fb_app_id . '";fjs.parentNode.insertBefore(js,fjs);}(document, \'script\', \'facebook-jssdk\'));</script>';
	}
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?php 
}	// end of function
?>