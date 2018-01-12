<?php
function dp_get_related_posts() {
	global $post, $options, $options_visual, $COLUMN_NUM, $IS_MOBILE_DP;

	if (post_password_required()) return;

	$post_type 				= get_post_type();
	$related_posts_style 	= $options['related_posts_style'];
	$related_posts_target 	= $options['related_posts_target'];
	// Main title
	$main_title = !empty($options['related_posts_title']) ? $options['related_posts_title'] : __('YOU MIGHT ALSO LIKE','DigiPress');

	$mb_suffix	= '';
	if ((bool)$IS_MOBILE_DP) {
		$mb_suffix = '_mb';
	}
	// wow.js
	$wow_title_css 			= '';
	$wow_article_css 		= '';
	if (!(bool)$options['disable_wow_js'.$mb_suffix]){
		$wow_title_css		= ' wow fadeInLeft';
		$wow_article_css 	= ' wow fadeInUp';
	}

	// Column
	$col_css	= ' two-col';
	if ($COLUMN_NUM === 1 || get_post_meta(get_the_ID(), 'disable_sidebar', true)) {
		$col_css	= ' one-col';
	} else if ($options_visual['dp_column'] == 3) {
		$col_css	= ' three-col';
	}

	$cat_code = '';


	// *****************************
	// Main display
	// *****************************
	if ($post_type !== 'post' && $post_type !== 'page' && $post_type !== 'attachment' && $post_type !== 'revision') : 
		
		// ***********************************
		// Probably Custom post type
		// ***********************************
	 
		// Get title
		$customPostTypeObj 		= get_post_type_object(get_post_type());
		$customPostTypeTitle 	= esc_html($customPostTypeObj->labels->name);
		// More link
		$more_url 				= get_post_type_archive_link($post_type);
		if ( !empty($more_url) ) {
			$more_url = '<div class="more-entry-link"><a href="'.$more_url.'"><span>'.__('See more', 'DigiPress').'</span></a></div>';
		}

		// Get posts
		$latest =  get_posts('numberposts=' . $options['new_post_count'] . '&post_type=' . $post_type . '&exclude=' . $post->ID);
	?>
<aside class="dp_related_posts news<?php echo $col_css; ?>">
<h3 class="inside-title<?php echo $wow_title_css; ?>"><span><?php echo __('Other posts of ', 'DigiPress') . $customPostTypeTitle; ?></span></h3>
<ul>
<?php 
		// Show posts of custom post type
		foreach( $latest as $post ) : setup_postdata($post); 
?>
<li class="clearfix<?php echo $wow_article_css; ?>"><?php echo '<span class="meta-date">'.get_the_date().'</span>'; ?>
<a href="<?php the_permalink(); ?>" class="rel-post-title" title="<?php the_title_attribute(); ?>" class="item-link"><?php the_title(); ?></a></li>
<?php
		endforeach;
		wp_reset_postdata();
?>
</ul>
<?php echo $more_url; ?>
</aside>
<?php
	elseif ((get_post_type() === 'post') && is_single() && $options['show_related_posts']) :
		// ***********************************
		// Probably single post
		// *********************************** 
		// Thumbnail size
		$width			= 800;
		$height			= 420;
		$arg_thumb		= array("width"=>$width, "height"=>$height);
		$thumb_class	= '';
		$title_length 	= 38;

		// Type
		if ($related_posts_style === 'horizon') {
			$type = ' horizontal';
		} else {
			$type = ' vertical';
			$title_length = 52;
		}
?>
<aside class="dp_related_posts clearfix<?php echo $type.$col_css; ?>">
<h3 class="inside-title<?php echo $wow_title_css; ?>"><span><?php echo $main_title; ?></span></h3>
<ul>
<?php
		// Get related posts
		$number_posts	= $options['number_related_posts'];
		// Target
		if ($related_posts_target == 2) {
			$cat = get_the_category();
			$cat = $cat[0];
			$args = array(
				'numberposts'	=> $number_posts,
				'category'		=> $cat->cat_ID,
				'exclude'		=> $post->ID
				);

		} else if ($related_posts_target == 3) {
			$cat = get_the_category();
			$cat = $cat[0];
			$args = array(
				'numberposts'	=> $number_posts,
				'category'		=> $cat->cat_ID,
				'exclude'		=> $post->ID,
				'orderby'		=> 'rand'
				);

		} else {
			$tagIDs		= array();
			$tags		= wp_get_post_tags($post->ID);
			$tagcount 	= count($tags);
			for ($i = 0; $i < $tagcount; $i++) {
				$tagIDs[$i] = $tags[$i]->term_id;
			}
			$args = array(
				'tag__in'			=> $tagIDs,
				'post__not_in'		=> array($post->ID),
				'numberposts'		=> $number_posts,
				'exclude'			=> $post->ID,
				'caller_get_posts'	=> 1
				);
		}

		// Query
		$my_query = get_posts($args);

		// Display
		if ($my_query) :
			foreach ( $my_query as $post ) : setup_postdata( $post );
				// Title
				$title = the_title('', '', false);
?>
<li class="clearfix<?php echo $wow_article_css; ?>">
<?php 
				if ($related_posts_style === 'horizon') {
					if (mb_strlen($title, 'utf-8') > $title_length) $title = mb_substr($title, 0, ($title_length - 1), 'utf-8').'...';
				}

				// Thumbnail
				if ($options['related_posts_thumbnail']) {
					$thumb_class = ' has_thumb';
?>
<div class="widget-post-thumb"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="thumb-link"><?php echo show_post_thumbnail($arg_thumb); ?></a></div>
<?php 
				}

				// Category
				if ($options['related_posts_category']) :
					$cats = get_the_category();
					if ($cats) {
						$cats = $cats[0];
						$cat_color_class = " cat-color".$cats->cat_ID;
						$cats_code = '<a href="'.get_category_link($cats->cat_ID).'" rel="tag" class="'.$cat_color_class.'">' .$cats->cat_name.'</a>';
					}
				endif;
?>
<div class="r-div<?php echo $thumb_class; ?>"><h4><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" class="item-link"><?php echo $title; ?></a></h4><div class="meta-cat"><?php echo $cats_code; ?></div></div>
</li>
<?php
			endforeach; 
			wp_reset_postdata();
		else :
?>
<li><?php _e('No related posts yet.', 'DigiPress'); ?></li>
<?php 
		endif;
?>
</ul>
</aside>
<?php
	endif;	// End of "Main display"
}
?>