<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Elucidate
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
<div style="margin-bottom:20px;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- サイドバー上部 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5596200505807672"
     data-ad-slot="2669293941"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'elucidate' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'elucidate' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
<div style="margin-bottom:20px;">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- サイドバー下部 -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-5596200505807672"
     data-ad-slot="1471762346"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
	</div><!-- #secondary -->