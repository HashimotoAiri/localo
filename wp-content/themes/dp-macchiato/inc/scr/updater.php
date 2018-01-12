<?php
define('DP_THEME_STORE_URL', 'http://digipress.digi-state.com/');
define('DP_THEME_LICENSE_NAME', 'Macchiato');
define('DP_THEME_LICENSE_PHRASE', 'Highly Flexible WordPress Theme');
define('DP_THEME_LICENSE_KEY_PHRASE', 'dp_macchiato_license_key');
define('DP_THEME_LICENSE_OPT_UNIQUE_ID', 'digipress-theme-license');
define('DP_THEME_FOOTER_ELEM', '.ft_copyright .inner');

/***********************************************
* This is our updater
***********************************************/

if ( !class_exists( 'DP_Theme_updater' ) ) {
	// Load our custom theme updater
	include( dirname( __FILE__ ) . '/DP_Theme_updater.php' );
}

function dp_theme_init_theme_updater() {

	$test_license = trim( get_option( DP_THEME_LICENSE_KEY_PHRASE ) );

	$dp_theme_updater = new DP_Theme_updater( array(
			'remote_api_url' 	=> DP_THEME_STORE_URL,
			'version' 			=> DP_OPTION_SPT_VERSION, 
			'license' 			=> $test_license, 
			'item_name' 		=> DP_THEME_LICENSE_NAME,
			'author'			=> 'digistate co.,ltd.'
		)
	);
}
add_action( 'admin_init', 'dp_theme_init_theme_updater' );


/***********************************************
* Add our menu item
***********************************************/

function dp_theme_license_menu() {
	add_theme_page( 'Theme License', __('Theme License','DigiPress'), 'manage_options', DP_THEME_LICENSE_OPT_UNIQUE_ID, 'dp_theme_license_page' );
}
add_action('admin_menu', 'dp_theme_license_menu');


/***********************************************
* Settings page
***********************************************/

function dp_theme_license_page() {
	$license 	= get_option( DP_THEME_LICENSE_KEY_PHRASE );
	$status 	= get_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' );
	$payment_id = get_option( DP_THEME_LICENSE_KEY_PHRASE.'_payment_id', $license_data->payment_id );
	$customer_name = get_option( DP_THEME_LICENSE_KEY_PHRASE.'_customer_name', $license_data->customer_name );
	?>
	<div class="wrap">
		<h2><?php _e('Theme License Options', 'DigiPress'); ?></h2>
		<form method="post" action="options.php">
			<?php settings_fields('dp_theme_license'); ?>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key', 'DigiPress'); ?>
						</th>
						<td>
							<input id="<?php echo DP_THEME_LICENSE_KEY_PHRASE; ?>" name="<?php echo DP_THEME_LICENSE_KEY_PHRASE; ?>" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
							<label class="description" for="<?php echo DP_THEME_LICENSE_KEY_PHRASE; ?>"><?php _e('Enter your license key', 'DigiPress'); ?></label>
							<div style="font-size:12px;"><?php _e('* If you cange the license key, please save the key before activate.', 'DigiPress'); ?></div>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License', 'DigiPress'); ?>
							</th>
							<td>
								<?php
								if( $status !== false && $status == 'valid' ) { ?>
									<input type="submit" class="button-secondary" style="vertical-align: middle;" name="dp_theme_license_deactivate" value="<?php _e('Deactivate This License', 'DigiPress'); ?>"/>
									<?php wp_nonce_field( 'dp_theme_nonce', 'dp_theme_nonce' ); ?>
									<span style="color:green;padding-right:8px;"><?php _e('active', 'DigiPress'); ?></span>
								<?php
								} else {
									wp_nonce_field( 'dp_theme_nonce', 'dp_theme_nonce' );?>
									<input type="submit" class="button-secondary" style="vertical-align: middle;" name="dp_theme_license_activate" value="<?php _e('Activate This License', 'DigiPress'); ?>"/>
									<?php 
									if( $status ) {
									 ?>
										<span style="color:red;padding-right:8px;"><?php _e($status, 'DigiPress'); ?></span>
									<?php
									} else { 
									?>
										<span style="color:red;padding-right:8px;"><?php _e('inactive', 'DigiPress'); ?></span>
									<?php
									}
								} ?>
							</td>
						</tr>
						<?php if( $status !== false && $status == 'valid' ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Licensed Info', 'DigiPress'); ?>
							</th>
							<td>
								<p><?php echo __('Payment ID : ', 'DigiPress').'#'.$payment_id; ?></p>
								<p><?php echo __('Licensed User : ', 'DigiPress').$customer_name; ?></p>
							</td>
						</tr>
						<?php } ?>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>
		</form>
	<?php
}


function dp_theme_register_option() {
	// creates our settings in the options table
	register_setting('dp_theme_license', DP_THEME_LICENSE_KEY_PHRASE, 'dp_theme_sanitize_license' );
}
add_action('admin_init', 'dp_theme_register_option');


/***********************************************
* Gets rid of the local license status option
* when adding a new one
***********************************************/

function dp_theme_sanitize_license( $new ) {
	$old = get_option( DP_THEME_LICENSE_KEY_PHRASE );
	if( $old && $old != $new ) {
		delete_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

/***********************************************
* Illustrates how to activate a license key.
***********************************************/

function dp_theme_activate_license() {

	if( isset( $_POST['dp_theme_license_activate'] ) && isset( $_POST[DP_THEME_LICENSE_KEY_PHRASE] ) ) {
	 	if( ! check_admin_referer( 'dp_theme_nonce', 'dp_theme_nonce' ) )
			return; // get out if we didn't click the Activate button

		global $wp_version;

		// $license = trim( get_option( DP_THEME_LICENSE_KEY_PHRASE ) );
		$license = trim( $_POST[DP_THEME_LICENSE_KEY_PHRASE]  );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( DP_THEME_LICENSE_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, DP_THEME_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( DP_THEME_LICENSE_KEY_PHRASE.'_status', $license_data->license );
		update_option( DP_THEME_LICENSE_KEY_PHRASE.'_payment_id', $license_data->payment_id );
		update_option( DP_THEME_LICENSE_KEY_PHRASE.'_customer_name', $license_data->customer_name );
	}
}
add_action('admin_init', 'dp_theme_activate_license');

/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function dp_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['dp_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'dp_theme_nonce', 'dp_theme_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}

		// retrieve the license from the database
		$license = trim( get_option( DP_THEME_LICENSE_KEY_PHRASE ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( DP_THEME_LICENSE_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, DP_THEME_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		delete_option( 'dp_options' );
		delete_option( 'dp_options_visual' );
		delete_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' );
		delete_option( DP_THEME_LICENSE_KEY_PHRASE.'_payment_id', $license_data->payment_id );
		delete_option( DP_THEME_LICENSE_KEY_PHRASE.'_customer_name', $license_data->customer_name );
		
		// $license_data->license will be either "deactivated" or "failed"
		// if( $license_data->license == 'deactivated' || $license_data->license == 'inactive' ) {
		// 	delete_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' );
		// }
	}
}
add_action('admin_init', 'dp_theme_deactivate_license');



/***********************************************
* Illustrates how to check if a license is valid
***********************************************/

function dp_theme_check_license() {
	global $wp_version;
	$license = trim( get_option( DP_THEME_LICENSE_KEY_PHRASE ) );
	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( DP_THEME_LICENSE_NAME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, DP_THEME_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );


	if( $license_data->license == 'valid' ) {
		return true;
		// this license is still valid
	} else {
		return false;
		// this license is no longer valid
	}
}

/***********************************************
* no activate user
***********************************************/
function dp_theme_noactivate_copyright() {
	$status 	= get_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' );
	$copyrhight_js = '<script>function dp_theme_noactivate_copyright(){return;}</script>';
	if ( $status != 'valid' ) {
		$auhor_url = DIGIPRESS_URI;
		$phrase = DP_THEME_LICENSE_PHRASE;
		$footer_ele = DP_THEME_FOOTER_ELEM;
		$copyrhight_js = <<<_EOD_
<script>function dp_theme_noactivate_copyright() {j$("$footer_ele").append("<div class=\"ft13px\">$phrase : <a href=\"$auhor_url\" title=\"$phrase\">DigiPress</a></div>");
}</script>
_EOD_;
	}
	echo $copyrhight_js;
}
add_action('wp_footer', 'dp_theme_noactivate_copyright', 100);


/***********************************************
* Admin message
***********************************************/
function dp_theme_noactivate_message() {
	$status 	= get_option( DP_THEME_LICENSE_KEY_PHRASE.'_status' );
	if ( $status != 'valid' ) {
		echo '<div id="message" class="error"><p>'.__('Your theme license is invalid or inactive. Please', 'DigiPress').' <input type="button" class="button" onclick="document.location.href=\'themes.php?page='.DP_THEME_LICENSE_OPT_UNIQUE_ID.'\';" value="'.__('Activate your license.','DigiPress').'" /></p></div>';
	}
}
add_action('admin_notices', 'dp_theme_noactivate_message');
?>