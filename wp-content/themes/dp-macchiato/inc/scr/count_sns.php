<?php
// Count Tweet
// function countTweet($url) {
// 	if (!function_exists('json_decode')) return;

// 	//twitter tweetcount
// 	$tweetcount         = @file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . urlencode($url), true);
// 	$decode_tweetcount  = json_decode($tweetcount, true);
// 	$twitter_tweetcount = (int)$decode_tweetcount['count'];
// 	return $twitter_tweetcount;
// }
// // Count Likes
// function countFacebookLikes($url = null) {
// 	if (!$url) return;
// 	if (!function_exists('json_decode')) return;
// 	$json = @file_get_contents('http://graph.facebook.com/' . urlencode($url), true);
// 	$data = json_decode($json);
// 	if ($data->{'error'}) return;
// 	return ($data->{'shares'}) ? (int)$data->{'shares'} : 0;
// }
// // Count Hatena bookmarks
// function countHatena($url = null) {

// 	if (!$url) return;
// 	if (!function_exists('json_decode')) return;
// 	$response = @file_get_contents('http://api.b.st-hatena.com/entry.count?url=' . urlencode($url));
// 	return ($response) ? (int)$response : 0;
// }
// // Return Hatena bookmarks image
// function countHatenaImage() {
// 	global $post;
// 	$url = get_permalink();

// 	$hatebuImg = '<img src="http://b.hatena.ne.jp/entry/image/' . $url . '" alt="' . __('Bookmark number in hatena', 'DigiPress') . the_title(' - ', '', false) . '" class="hatebunumber" />';
// 	return $hatebuImg;
// }

// Google+ subscribers
function get_gplus_subscribers(){
	// $count = get_transient('gplus_subscribers');
	// if ($count !== false) return $count;

	global $post;
	$res = '0';
	$source_url = rawurlencode( get_permalink() );
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($source_url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	$curl_results = curl_exec ($curl);
	curl_close ($curl);
	$json = json_decode($curl_results, true);
	$res = isset($json[0]['result']['metadata']['globalCounts']['count']) ? $json[0]['result']['metadata']['globalCounts']['count'] : '0';
	return $res;
}

// Pocket subscribers
function get_pocket_subscribers(){
	global $post;
	$url = rawurlencode( get_permalink() );
	$res = '0';
	$count = wp_remote_get( "https://widgets.getpocket.com/v1/button?label=pocket&count=horizontal&v=1&url=".$url );
	if (!is_wp_error( $count ) && $count["response"]["code"] === 200) {
		$doc = new DOMDocument('1.0','UTF-8');
		$doc->preserveWhiteSpace = false;
		$doc->loadHTML($html);
		$xpath = new DOMXPath($doc);
		$count = $xpath->query('//em[@id = "cnt"]')->item(0);
		$count = isset($count->nodeValue) ? $count->nodeValue : '0';
		$res = $count;
	}
	return $res;
}

// Feedly subscribers
function get_feedly_subscribers(){
	$count = get_transient('feedly_subscribers');
	if ($count !== false) return $count;

	$feed_url = rawurlencode( get_bloginfo( 'rss2_url' ) );
	$res = '0';
	$count = wp_remote_get( "http://cloud.feedly.com/v3/feeds/feed%2F".$feed_url );
	if (!is_wp_error( $count ) && $count["response"]["code"] === 200) {
		$count = json_decode( $count['body'] );
		if ( $count ) {
			$count = $count->subscribers;
			set_transient( 'feedly_subscribers', $count, 60 * 60 * 12 );
			$res = ($count ? $count : '0');
		}
	}
	return $res;
}
?>