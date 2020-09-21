<?php

namespace EasyDocs;

use EasyDocs\Cpt\Actors;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * EasyDocs Plugin.
 *
 * Main plugin class responsible for initiazling EasyDocs Plugin. The class
 * registers all the components required to run the plugin.
 *
 * @since 1.0.0
 */

class Plugin {

	/**
	 * Instance.
	 * 
	 * Holds the plugin instance.
	 * 
	 * @since 1.0.0
	 * @access public
	 * @static
	 * 
	 * @var Plugin
	 */

	public static $instance = null;

	/**
	 * Clone.
	 *
	 * Disable class cloning and throw an error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object. Therefore, we don't want the object to be cloned.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'easydoc' ), '1.0.0' );
	}

	/**
	 * Wakeup.
	 *
	 * Disable unserializing of the class.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'easydoc' ), '1.0.0' );
	}

	/**
	 * Plugin constructor.
	 *
	 * Initializing wp-easy-portfolio plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __construct() {

		$this->register_autoloader();
		
		register_activation_hook( EASY_DOC_FILE, array( __CLASS__, 'plugin_activation' ) );

		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Init.
	 *
	 * Initialize WP Easy Portfolio Plugin.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		$this->init_components();
	}

		/**
	 * Init components.
	 *
	 * Initialize WP Easy Portfolio components. Register actions, run setting manager,
	 * initialize all the components that run plugin, and if in admin page
	 * initialize admin components.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_components() {

		Actors::init();
	}

	/**
	 * Register autoloader.
	 *
	 * Elementor autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	private function register_autoloader() {
		//echo "Loading Autoloader";
		require EASY_DOCS_PATH . '/classes/autoloader.php';

		Autoloader::run();
	}

	/**
	 * Plugin Activation.
	 *
	 * WP Easy Portfolio on plugin activation.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function plugin_activation() {

		flush_rewrite_rules();
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();

