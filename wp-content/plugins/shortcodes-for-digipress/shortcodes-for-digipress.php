<?php
/*
Plugin Name: Shortcodes for DigiPress
Plugin URI: http://digipress.digi-state.com/
Description: Additional shortcodes for DigiPress.
Version: 1.1.2.1
Author: digistate co.,ltd.
Author URI: http://www.digistate.co.jp/
Last Update	: 2015/11/22
*/
define('DP_SC_PLUGIN_NAME', 'Shortcodes for DigiPress'); 
define('DP_SC_PLUGIN_AUTHOR', 'digistate'); 
define('DP_SC_PLUGIN_AUTHOR_URL', 'https://digipress.digi-state.com/'); 
define('DP_SC_PLUGIN_VERSION', '1.1.2.1');
define('DP_SC_PLUGIN_STORE_URL', 'https://digipress.digi-state.com/'); 
define('DP_SC_PLUGIN_LICENSE_KEY_PHRASE', 'dp_sc_plugin_license_key');
define('DP_SC_PLUGIN_LICENSE_OPT_UNIQUE_ID', 'dp-sc-plugin-license');
define('DP_SC_PLUGIN_TEXT_DOMAIN', 'dp_sc');


if ( !class_exists( 'DP_SC_PLUGIN' ) ) :

	final class DP_SC_PLUGIN {
		/**
		 * Holds the instance
		 *
		 * @var object
		 */
		private static $instance;

		/**
		 * Main Instance
		 *
		 * Ensures that only one instance exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 *
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof DP_SC_PLUGIN ) ) {
				self::$instance = new DP_SC_PLUGIN;
				self::$instance->setup_globals();
				self::$instance->includes();
				self::$instance->licensing();
				self::$instance->requires();
				self::$instance->hooks();
			}

			return self::$instance;
		}

		/**
		 * Constructor Function
		 *
		 * @access private
		 */
		private function __construct() {
			self::$instance = $this;
			add_action( 'init', array( $this, 'init' ) );
			if (function_exists('register_deactivation_hook')) {
				register_deactivation_hook(__FILE__, array($this, 'dp_sc_plugin_deactivation'));
			}
		}

		/**
		 * Reset the instance of the class
		 *
		 * @access public
		 * @static
		 */
		public static function reset() {
			self::$instance = null;
		}

		/**
		 * Globals
		 *
		 * @return void
		 */
		private function setup_globals() {
			$this->version 		= DP_SC_PLUGIN_VERSION;
			$this->title 		= DP_SC_PLUGIN_NAME;
			// paths
			$this->file         = __FILE__;
			$this->basename     = apply_filters( 'dp_sc_plugin_plugin_basenname', plugin_basename( $this->file ) );
			$this->plugin_dir   = apply_filters( 'dp_sc_plugin_plugin_dir_path',  plugin_dir_path( $this->file ) );
			$this->plugin_url   = apply_filters( 'dp_sc_plugin_plugin_dir_url',   plugin_dir_url ( $this->file ) );
		}

		/**
		 * Function fired on init
		 *
		 * This function is called on WordPress 'init'. It's triggered from the
		 * constructor function.
		 *
		 * @access public
		 *
		 * @uses DP_SC_PLUGIN::load_textdomain()
		 *
		 * @return void
		 */
		public function init() {
			load_theme_textdomain(DP_SC_PLUGIN_TEXT_DOMAIN, dirname(__FILE__ ).'/languages/');
			// $this->load_textdomain();
		}


		/**
		 * Includes
		 *
		 * @access private
		 * @return void
		 */
		private function includes() {
			if( ! class_exists( 'DP_EX_Plugin_Updater' ) ) {
				include( dirname( __FILE__ ) . '/inc/scr/DP_EX_Plugin_Updater.php' );
			}
			include( dirname( $this->file ) . '/inc/scr/updater.php' );
			include( dirname( $this->file ) . '/inc/scr/control.php' );
		}
		
		/**
		 * Requres
		 *
		 * @access private
		 * @return void
		 */
		private function requires() {
			// Shortcodes
			require_once( dirname( $this->file ) . '/inc/scr/shortcodes.php' );
		}

		/**
		 * Licensing
		 *
		 */
		private function licensing() {
			$transient = get_site_transient(DP_SC_PLUGIN_LICENSE_KEY_PHRASE);
			if (!$transient) {
				if ( class_exists( 'DP_EX_Plugin_Updater' ) ) {
					// retrieve our license key from the DB
					$license_key = trim( get_option( DP_SC_PLUGIN_LICENSE_KEY_PHRASE ) );
					// setup the updater
					$dp_plugin_updater = new DP_EX_Plugin_Updater( DP_SC_PLUGIN_STORE_URL, __FILE__, array( 
							'version' 	=> DP_SC_PLUGIN_VERSION,
							'license' 	=> $license_key,
							'item_name' => DP_SC_PLUGIN_NAME, 
							'author' 	=> 'digistate co.,ltd.' 
						)
					);
					set_site_transient( DP_SC_PLUGIN_LICENSE_KEY_PHRASE, $license_key, 3600*24*30);
				} else {
					delete_site_transient(DP_SC_PLUGIN_LICENSE_KEY_PHRASE);
				}
			}
		}
			
		/**
		 * Setup the default hooks and actions
		 *
		 * @return void
		 */
		private function hooks() {
			add_action('wp_enqueue_scripts', array($this, 'insert_js_css'));
		}

		/****************************************************************
		* Insert javascript into html header in widget.php
		****************************************************************/
		public function insert_js_css() {
			if (is_admin()) return;

			// CSS
			wp_enqueue_style( 'dp-shortcodes', $this->plugin_url . 'css/style.css', array('digipress') );

			// Javascript ( load from footer)
			wp_enqueue_script('dp_sc_bjqs', $this->plugin_url . 'inc/js/jquery/bjqs.min.js', array('jquery'));
			wp_enqueue_script('dp_sc_tablesorter', $this->plugin_url . 'inc/js/jquery/jquery.tablesorter.min.js', array('jquery'));
			wp_enqueue_script('dp_sc_plugin_js', $this->plugin_url . 'inc/js/script.min.js', array('jquery', 'dp_sc_bjqs', 'dp_sc_tablesorter'), null, true);
		}


		/**
		 * Do something when this plugin is about to be deactivated 
		*/
		function dp_sc_plugin_deactivation() {
			// Uninstall data and clear settings
		}
	}
	// Start count
	// $dp_SC_PLUGIN = new DP_SC_PLUGIN();

	/**
	 * Loads a single instance of this plugin
	 *
	 * This follows the PHP singleton design pattern.
	 */
	function dp_sc_plugin() {
		return DP_SC_PLUGIN::get_instance();
	}
	/**
	 * Loads plugin after all the others have loaded and have registered their hooks and filters
	*/
	add_action( 'plugins_loaded', 'dp_sc_plugin', apply_filters( 'dp_sc_plugin_action_priority', 10, 2 ) );
endif;

?>