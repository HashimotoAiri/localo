<section id="comments_area">
<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

        if (post_password_required() && !empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
				// and it doesn't match the cookie
				return;
			}
		}

global $options, $options_visual, $IS_MOBILE_DP;

$mb_suffix	= '';
if ((bool)$IS_MOBILE_DP) {
	$mb_suffix = '_mb';
}
// wow.js
$wow_title_css 			= '';
if (!(bool)$options['disable_wow_js'.$mb_suffix]){
	$wow_title_css		= ' wow fadeInLeft';
}

/*********************************************************
* Custom comment html format (called back)
*********************************************************/
function dp_comment_source ($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   $args['reply_text'] = 'Reply'; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<div id="comment-<?php comment_ID(); ?>">
<div class="comment-author vcard clearfix">
<div class="comment-avatar"><?php echo get_avatar($comment,$size=100); ?></div>
<?php printf('<cite class="comment_author_name">%s</cite>', get_comment_author_link()) ?>
<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'DigiPress'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link('(Edit)','  ','') ?><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</div>
</div>
<?php if ($comment->comment_approved == '0') : ?>
<p><?php _e('Your comment is awaiting moderation.', 'DigiPress') ?></p>
<?php endif; ?>
<?php comment_text() ?>
</div>
<?php 
}	// End of function dp_comment_source()
/*********************************************************
* Custom trackback html format (called back)
*********************************************************/
function dp_trackback_source ($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<div id="comment-<?php comment_ID(); ?>">
<div class="comment-author vcard clearfix">
<?php printf('<cite class="comment_author_name icon-home">%s</cite>', get_comment_author_link()) ?>
<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'DigiPress'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link('(Edit)','  ','') ?></div>
</div>
<?php if ($comment->comment_approved == '0') : ?>
<p><?php _e('Your trackback is awaiting moderation.', 'DigiPress') ?></p>
<?php endif; ?>
<div><?php comment_text() ?></div>
</div>
<?php
}	// End of function dp_trackback_source()
/*********************************************************
* Show Comments
*********************************************************/
if ( have_comments() ) : 
	$comments_data = get_comments('status=approve&post_id='.$post->ID);
	// Get comments
	@$comments_by_type = &separate_comments($comments_data);
?>
<div id="comment_section">
<h3 id="comments" class="inside-title<?php echo $wow_title_css; ?>"><span class="title">
<?php 
if (!empty($options['comments_main_title'])) :
	echo htmlspecialchars_decode($options['comments_main_title']);
else :
	_e('COMMENTS &amp; TRACKBACKS', 'DigiPress');
endif;
?>
</span></h3>
<div id="com_trb_whole">
<ul id="switch_comment_type" class="clearfix">
<li id="commentlist_div" class="active_tab">Comments ( <?php echo count($comments_by_type['comment']); ?> )</li>
<li id="trackbacks_div" class="inactive_tab">Trackbacks ( <?php echo count($comments_by_type['pings']); ?> )</li>
</ul>
<div id="com_trb_div">
<div class="commentlist_div">
<?php 
	// *********
	// If comments exist
	// *********
	if ( ! empty($comments_by_type['comment']) ) : 
?>
<ol class="commentlist">
<?php 
	$args = array(
		'type'			=> 'comment',
		'avatar_size'	=> 60,
		'callback'		=> 'dp_comment_source'
		);
	wp_list_comments($args); 
?>
</ol>
<?php
	// Comment navigation to paged
?>
<nav class="navigation clearfix">
<div class="navialignleft"><?php previous_comments_link('<span class="nav-arrow icon-left-open"><span>OLDER</span></span>') ?></div>
<div class="navialignright"><?php next_comments_link('<span class="nav-arrow icon-right-open"><span>NEWER</span></span>') ?></div>
</nav>
<?php 
	else : // No comment yet 
?>
<p><?php _e('No commented yet.', 'DigiPress') ?></p>
<?php 
	endif; // End of comments 
?>
</div><?php // end of .commentlist_div ?>
<div class="trackbacks_div">
<?php 
	// **********
	// If pings and trackback exist
	// **********
	if ( ! empty($comments_by_type['pings']) ) :
?>
<ol class="commentlist">
<?php 
		$args = array(
			'type'		=> 'pings',
			'callback'	=> 'dp_trackback_source'
			);
		wp_list_comments($args); 
?>
</ol>
<nav class="navigation clearfix">
<div class="navialignleft"><?php previous_comments_link('<span class="nav-arrow icon-left-open"><span>Older Comments</span></span>') ?></div>
<div class="navialignright"><?php next_comments_link('<span class="nav-arrow icon-right-open"><span>Newer Comments</span></span>') ?></div>
<?php 
	endif; //End of trackback & pings 
?>
</div><?php // end of .trackbacks_div ?>
</div><?php // end of #com_trb_div ?>
</div><?php // end of #com_trb_whole ?>
</div><?php // end of #comment_section ?>
<?php 
endif;
/*********************************************************
* Comment Form
*********************************************************/
//Comment is accepted
if ( comments_open() ) : 
	$commenter = wp_get_current_commenter();
	$aria_req = true;

 // If "comment_form" function is exists
 if ( function_exists('comment_form') ) : 
 	$title_reply = !empty($options['comment_form_title']) ? htmlspecialchars_decode($options['comment_form_title']) : __('LEAVE A REPLY', 'DigiPress');
 
	$fields =  array(
		'author' => '<div class="user">' . '<label for="author">Name</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            '<div id="comment-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		'email'  => '<div class="mail"><label for="email">' . __( 'E-mail', 'DigiPress' ) . '</label> ' . ( $req ? '<span class="required">*</span> '. __('(will not be published.)', 'DigiPress') : '' ) .
		            '<div id="comment-email"><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		'url'    => '<div class="globe"><label for="url">URL</label>' .
		            '<div id="comment-url"><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
	);

	$args = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="pencil"><label for="comment">Comment</label> <span class="required">*</span><div id="comment-comment"><textarea id="comment" name="comment" aria-required="true"></textarea></div></div>',
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'DigiPress' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'DigiPress' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => '<span>'.$title_reply.'</span>',
		'title_reply_to'       => __( '<span>LEAVE A REPLY TO %s</span>', 'DigiPress' ),
		'cancel_reply_link'    => __( '<span>CANCEL REPLY</span>', 'DigiPress' ),
		'label_submit'         => __( 'SEND', 'DigiPress' )
	);

	comment_form( $args, $post->ID );
 	else : ?>
	<section>
	<h3 class="comment_hd_title inside-title<?php echo $wow_title_css; ?>"><span><?php _e('LEAVE A REPLY', 'DigiPress'); ?></span></h3>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="nocomment">
		<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'DigiPress'), wp_login_url( get_permalink() )); ?></p>
		</div>
	<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php if ( is_user_logged_in() ) : ?>
		<p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'DigiPress'), get_option('siteurl') . '/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'DigiPress'); ?>"><?php _e('Log out &raquo;', 'DigiPress'); ?></a></p>
	<?php else : ?>
		<div class="icon-user"><label for="author"><?php _e('Name','DigiPress'); ?> <?php if ($req) echo _e('(required)', 'DigiPress'); ?></label>
		<div id="comment-author"><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></div></div>
		<div class="icon-mail"><label for="email"><?php _e('Mail (will not be published.)', 'DigiPress'); ?> <?php if ($req) echo _e('(required)', 'DigiPress'); echo _e( 'Your email address will not be published.', 'DigiPress' ); ?></label>
		<div id="comment-email"><input type="email" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></div></div>

		<div class="icon-globe"><label for="url"><?php _e('Website', 'DigiPress'); ?></label>
		<div id="comment-url"><input type="url" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></div></div>
	<?php endif; ?>
	<div class="pencil"><label for="comment"><?php _e('Comment', 'DigiPress'); ?></label>
	<div id="comment-comment"><textarea name="comment" id="comment"  tabindex="4"></textarea></div></div>
	<div>
	<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'DigiPress'); ?>" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	<?php comment_id_fields(); ?>
	</div>
	<?php do_action('comment_form', $post->ID); ?>
	</form>
	</section>

 <?php
endif; // End of "comment_form" function check 
endif; // If registration required and not logged in 
endif; // if you delete this the sky will fall on your head

/*********************************************************
* Show facebook comments
*********************************************************/
function dp_facebook_comment_box() {
	global $options, $options_visual,$IS_MOBILE_DP;
	$mb_suffix	= '';
	if ((bool)$IS_MOBILE_DP) {
		$mb_suffix = '_mb';
	}						
	// wow.js
	$wow_title_css 			= '';
	if (!(bool)$options['disable_wow_js'.$mb_suffix]){
		$wow_title_css		= ' wow fadeInLeft';
	}
	// Facebook comment
	if ( get_post_meta(get_the_ID(), 'dp_hide_fb_comment', true) ) return;

	if ( ($options['facebookcomment'] && get_post_type() === 'post') || ($options['facebookcomment_page'] && is_page()) ) {
		// Main title
		$fb_comment_title = !empty($options['fb_comments_title']) ? htmlspecialchars_decode($options['fb_comments_title']) : __('COMMENT ON FACEBOOK', 'DigiPress');

		echo '<div class="dp_fb_comments_div"><h3 class="inside-title'.$wow_title_css.'"><span class="title">'.$fb_comment_title.'</span></h3><div class="fb-comments" data-href="'.get_permalink ().'" data-num-posts="'.$options['number_fb_comment'].'" data-width="100%"></div></div>';
	}
}
// Show facebook comment box
dp_facebook_comment_box();
?>
</section>