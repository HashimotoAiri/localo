<?php
/**
 * Add-ons Page
 *
 * Renders the add-ons page content.
 *
 * @return void
 */
function dp_add_ons_page() {
	ob_start();
?>
<div class="wrap" id="dp-add-ons">
	<h2 class="dp_h2 icon-powercord"><?php _e('Add-Ons for DigiPress', 'DigiPress'); ?></h2>
	<p><?php _e('Manage your licenses of DigiPress add-ons.', 'DigiPress'); ?>
	<a href="http://digipress.digi-state.com/extensions/?utm_source=plugin-addons-page&utm_medium=plugin" class="button-primary" title="<?php _e( 'Check other add-ons', 'DigiPress' ); ?>" target="_blank"><?php _e( 'Check other add-ons', 'DigiPress' ); ?></a></p>
<?php 
	// Licenses
	do_action( 'dp_admin_add_ons_panel' );

	// Get feed and show add-ons
	// echo dp_add_ons_get_feed(); 
?>
</div>
<?php
	echo ob_get_clean();
}

/**
 * Add-ons Get Feed
 *
 * Gets the add-ons page feed.
 *
 * @return void
 */
function dp_add_ons_get_feed() {
	if ( false === ( $cache = get_transient( 'digipress_add_ons_feed' ) ) ) {
		$feed = wp_remote_get( 'https://digipress.digi-state.com/?feed=addons', array( 'sslverify' => false ) );
		if ( ! is_wp_error( $feed ) ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( 'digipress_add_ons_feed', $cache, 3600 );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the extensions list from the server. Please try again later.', 'DigiPress' ) . '</div>';
		}
	}
	return $cache;
}

// Show
dp_add_ons_page();
?>