<?php

class SiteGuard_Menu_Disable_Pingback extends SiteGuard_Base {
	function __construct( ) {
		$this->render_page( );
	}
	function render_page( ) {
		global $config;

		$opt_name_feature = 'disable_pingback_enable';
		$opt_val_feature  = $config->get( $opt_name_feature );
		if ( isset( $_POST['update'] ) && check_admin_referer( 'siteguard-menu-disable-pingback-submit' ) ) {
			$error = false;
			if ( false == $this->is_switch_value( $_POST[ $opt_name_feature ] ) ) {
				echo '<div class="error settings-error"><p><strong>';
				esc_html_e( 'ERROR: Invalid input value.', 'siteguard' );
				echo '</strong></p></div>';
				$error = true;
			}
			if ( false == $error ) {
				$opt_val_feature = $_POST[ $opt_name_feature ];
				$config->set( $opt_name_feature, $opt_val_feature );
				$config->update( );
				?>
				<div class="updated"><p><strong><?php esc_html_e( 'Options saved.', 'siteguard' ); ?></strong></p></div>
				<?php
			}
		}

		echo '<div class="wrap">';
		echo '<img src="' . SITEGUARD_URL_PATH . 'images/sg_wp_plugin_logo_40.png" alt="SiteGuard Logo" />';
		echo '<h2>' . esc_html__( 'Disable Pingback', 'siteguard' ) . '</h2>';
		?>
		<form name="form1" method="post" action="">

		<table class="form-table">
		<tr>
		<th scope="row"><?php esc_html_e( 'Enable/Disable', 'siteguard' ) ?></th>
		<td>
			<ul class="siteguard-radios">
			<li>
			<input type="radio" name="<?php echo $opt_name_feature ?>" id="<?php echo $opt_name_feature.'_on' ?>" value="1" <?php echo ( '1' == $opt_val_feature ? 'checked' : '') ?> >
			<label for="<?php echo $opt_name_feature.'_on' ?>"><?php echo esc_html_e( 'ON', 'siteguard' ) ?></label>
			</li><li>
			<input type="radio" name="<?php echo $opt_name_feature ?>" id="<?php echo $opt_name_feature.'_off' ?>" value="0" <?php echo ( '0' == $opt_val_feature ? 'checked' : '') ?> >
			<label for="<?php echo $opt_name_feature.'_off' ?>"><?php echo esc_html_e( 'OFF', 'siteguard' ) ?></label>
			</li>
			</ul>
		</td>
		</tr>
		</table>
		<input type="hidden" name="update" value="Y">
		<div class="siteguard-description">
		<?php esc_html_e( 'The pingback function is disabled and its abuse is prevented.', 'siteguard' ) ?>
		</div>
		<hr />
		<?php
		wp_nonce_field( 'siteguard-menu-disable-pingback-submit' );
		submit_button( );
		?>
		</form>
		</div>
		<?php
	}
}

?>
