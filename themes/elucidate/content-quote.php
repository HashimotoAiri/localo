<?php
/**
 * @package Elucidate
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_sticky() ) { ?>
			<div class="sticky_post">
				<?php _e( 'Sticky Post', 'elucidate' ); ?>
			</div>
		<?php } ?>
		<?php elucidate_time(); ?>

		<?php if ( get_the_author_meta( 'display_name' ) && is_multi_author() ) { ?>
			<div class="byline">
				<?php elucidate_byline(); ?>
			</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
			<p class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</p>
		<?php } ?>
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'elucidate' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'elucidate' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php elucidate_meta(); ?>

		<?php edit_post_link( __( 'Edit', 'elucidate' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
