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
use SmartDocs\Templates;
use SmartDocs\Search;
use SmartDocs\Structured_Data;

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
	 *
	 * @var object $cpt
	 */
	public $cpt = null;

	/**
	 * Instance.
	 *
	 * Holds the Admin class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $admin
	 */
	public $admin = null;

	/**
	 * Instance.
	 *
	 * Holds the Shortcode class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $shortcode
	 */
	public $shortcode = null;

	/**
	 * Instance.
	 *
	 * Holds the Template class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $template
	 */
	public $template = null;

	/**
	 * Instance.
	 *
	 * Holds the Search Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $search
	 */
	public $search = null;

	/**
	 * Instance.
	 *
	 * Holds the Widget Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var object $widget
	 */
	public $widget = null;

	/**
	 * Instance.
	 *
	 * Holds the Structured_Data Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var object $structured_data
	 */
	public $structured_data = null;

	/**
	 * Instance.
	 *
	 * Holds the Customizer Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $customizer
	 */
	public $customizer = null;

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

		add_action( 'admin_init', array( $this, 'admin_init' ), 0 );
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
	 * Admin Init.
	 *
	 * Initialize SmartDocsPlugin Admin Components.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_init() {
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

		$this->cpt        = new Cpt();
		$this->admin      = new Admin();
		$this->template   = new Template();
		$this->search     = new Search();
		$this->customizer = new Customizer();
		$this->widget 	  = new Widget();
		$this->structured_data  = new Structured_Data();

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Load Utilities.
		include_once SMART_DOCS_PATH . 'includes/utils.php';

		// Load template functions.
		if ( ! is_admin() ) {
			include_once SMART_DOCS_PATH . 'includes/template-functions.php';
			include_once SMART_DOCS_PATH . 'includes/template-hooks.php';
		}

		// Load shortcode.
		include_once SMART_DOCS_PATH . 'includes/shortcode.php';

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
	 * Enqueue scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts( $hook ) {
		global $post;

		$post_type = $this->cpt->post_type;
		$should_enqueue = false;

		wp_register_style( 'smartdocs-frontend', SMART_DOCS_URL . 'assets/css/frontend.css', array(), SMART_DOCS_VERSION );
		wp_register_script( 'smartdocs-frontend', SMART_DOCS_URL . 'assets/js/frontend.js', array( 'jquery' ), SMART_DOCS_VERSION, true );
		wp_localize_script( 'smartdocs-frontend', 'smartdocs', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );

		if ( is_post_type_archive( $post_type ) || is_singular( $post_type ) || is_tax( 'smartdocs_category' ) || is_tax( 'smartdocs_tag' ) ) {
			$should_enqueue = true;
		} elseif ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->content,  'smartdocs-search' ) ) {
			$should_enqueue = true;
		}

		if ( $should_enqueue ) {
			wp_enqueue_style( 'smartdocs-frontend' );
			wp_enqueue_script( 'smartdocs-frontend' );
		}
	}
}

Plugin::instance();
