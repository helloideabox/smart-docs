<?php
/**
 * Plugin loader class
 *
 * Loads the plugin and all the required classes and functions when the
 * plugin is activate.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

use SmartDocs\Cpt;
use SmartDocs\Admin;
use SmartDocs\Widget;
use SmartDocs\Cat_Widget;
use SmartDocs\Templates;
use SmartDocs\Search;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SmartDocs Plugin.
 *
 * Main plugin class responsible for initiazling SmartDocs Plugin. The class
 * registers all the components required to run the plugin.
 *
 * @package SmartDocs
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
	 * Instance.
	 *
	 * Holds the CPT Manager's instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var CPT
	 */

	public $cpt = null;

	/**
	 * Instance.
	 *
	 * Holds the Admin class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var admin
	 */

	public $admin = null;

	/**
	 * Instance.
	 *
	 * Holds the Shortcode class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var shortcode
	 */

	public $shortcode = null;

	/**
	 * Instance.
	 *
	 * Holds the Doc Widget class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var doc_widget
	 */

	public $doc_widget = null;

	/**
	 * Instance.
	 *
	 * Holds the Doc Cat Widget class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var doc_cat_widget
	 */

	public $doc_cat_widget = null;

	/**
	 * Instance.
	 *
	 * Holds the Template class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var templates
	 */

	public $templates = null;

	/**
	 * Instance.
	 *
	 * Holds the Search Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var search
	 */

	public $search = null;

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
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'smart-docs' ), '1.0.0' );
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
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Something went wrong.', 'smart-docs' ), '1.0.0' );
	}

	/**
	 * Plugin constructor.
	 *
	 * Initializing smart-docst plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __construct() {
		$this->register_autoloader();

		register_activation_hook( SMART_DOCS_FILE, array( $this, 'plugin_activation' ) );

		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Init.
	 *
	 * Initialize SmartDocsPlugin.
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
	 * Initialize SmartDocscomponents. Register actions, run setting manager,
	 * initialize all the components that run plugin, and if in admin page
	 * initialize admin components.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_components() {

		$this->cpt       = new Cpt();
		$this->admin     = new Admin();
		$this->templates = new Templates();
		$this->search    = new Search();

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Load widgets.
		$this->doc_widget     = new Widget();
		$this->doc_cat_widget = new Cat_Widget();

		// Load Utilities.
		include_once SMART_DOCS_PATH . '/includes/utils.php';

		// Load shortcode.

		include_once SMART_DOCS_PATH . 'templates/smart-docs-shortcode.php';

	}

	/**
	 * Register autoloader.
	 *
	 * SmartDocs autoloader loads all the classes needed to run the plugin.
	 *
	 * @since 1.6.0
	 * @access private
	 */
	private function register_autoloader() {
		require SMART_DOCS_PATH . '/classes/autoloader.php';

		Autoloader::run();
	}

	/**
	 * Plugin Activation.
	 *
	 * SmartDocson plugin activation.
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

	/**
	 * Function to enque scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		global $post_type;
	}
}

Plugin::instance();
