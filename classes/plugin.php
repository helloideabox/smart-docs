<?php
/**
 * Plugin loader class.
 *
 * Loads the plugin and all the required classes and functions when the
 * plugin is activate.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

use SmartDocs\Cpt;
use SmartDocs\Admin;
use SmartDocs\Widget;
use SmartDocs\Template;
use SmartDocs\Customizer;
use SmartDocs\Ajax;
use SmartDocs\Structured_Data;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * SmartDocs Plugin.
 *
 * Main plugin class responsible for initiazling SmartDocs Plugin. The class
 * registers all the components required to run the plugin.
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
	 * Holds the Ajax Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $ajax
	 */
	public $ajax = null;

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
	 * Instance.
	 *
	 * Holds the Dynamic CSS Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @var object $dynamic_css
	 */
	public $dynamic_css = null;

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
	 * Initializing smart-docs plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function __construct() {
		$this->register_autoloader();

		register_activation_hook( SMART_DOCS_FILE, array( $this, 'plugin_activation' ) );
		register_deactivation_hook( SMART_DOCS_FILE, array( $this, 'plugin_deactivation' ) );

		add_action( 'init', array( $this, 'init' ), 0 );

		add_action( 'admin_init', array( $this, 'admin_init' ), 0 );

		add_action( 'wp_head', array( $this, 'handle_customizer_styles' ), 10 );
	}

	/**
	 * Init.
	 *
	 * Initialize plugin components.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		$this->init_components();

		/**
		 * SmartDocs init.
		 *
		 * Fires on SmartDocs init, after SmartDocs has finished loading but
		 * before any headers are sent.
		 *
		 * @since 1.0.0
		 */
		do_action( 'smartdocs_init' );
	}

	/**
	 * Admin Init.
	 *
	 * Initialize admin components.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_init() {
	}

	/**
	 * Init components.
	 *
	 * Initialize SmartDocs components. Register actions, run setting manager,
	 * initialize all the components that run plugin, and if in admin page
	 * initialize admin components.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_components() {

		$this->cpt             = new Cpt();
		$this->admin           = new Admin();
		$this->template        = new Template();
		$this->ajax            = new Ajax();
		$this->customizer      = new Customizer();
		$this->dynamic_css     = new Dynamic_CSS();
		$this->widget          = new Widget();
		$this->structured_data = new Structured_Data();

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
	 * @since 1.0.0
	 * @access private
	 */
	private function register_autoloader() {
		require SMART_DOCS_PATH . 'classes/autoloader.php';

		Autoloader::run();
	}

	/**
	 * Plugin Activation.
	 *
	 * @since 1.0.0
	 */
	public function plugin_activation() {
		flush_rewrite_rules();

		$installed = get_option( 'smartdocs_installed_time' );

		if ( ! $installed ) {
			update_option( 'smartdocs_installed_time', time() );
		}
	}

	/**
	 * Plugin Deactivation.
	 *
	 * @since 1.0.0
	 */
	public function plugin_deactivation() {
		/**
		 * Delete the rewrite rules flag.
		 *
		 * @see SmartDocs\Cpt\register_cpt()
		 */
		delete_option( 'smartdocs_rewrite_rules_flushed' );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		global $post;

		$post_type      = $this->cpt->post_type;
		$should_enqueue = false;
		$localized_vars = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'smartdocs_front' ),
		);

		wp_register_style( 'smartdocs-frontend', SMART_DOCS_URL . 'assets/css/frontend.css', array(), SMART_DOCS_VERSION );
		wp_register_script( 'smartdocs-frontend', SMART_DOCS_URL . 'assets/js/frontend.js', array( 'jquery' ), SMART_DOCS_VERSION, true );

		if ( is_post_type_archive( $post_type ) || is_tax( 'smartdocs_category' ) ) {
			$should_enqueue = true;
		} elseif ( is_a( $post, 'WP_Post' ) ) {
			$localized_vars['feedback_nonce'] = wp_create_nonce( "smartdocs_feedback_{$post->ID}" );
			if (
				is_singular( $post_type ) ||
				has_shortcode( $post->post_content, 'smartdocs_search' ) ||
				has_shortcode( $post->post_content, 'smartdocs_categories' )
			) {
				$should_enqueue = true;
			}
		}

		if ( $should_enqueue ) {
			do_action( 'smartdocs_frontend_before_enqueue_scripts' );

			wp_enqueue_style( 'smartdocs-frontend' );
			wp_enqueue_script( 'smartdocs-frontend' );
			wp_localize_script( 'smartdocs-frontend', 'smartdocs', $localized_vars );

			do_action( 'smartdocs_frontend_after_enqueue_scripts' );
		}
	}

	/**
	 * Handle Customizer Styles.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function handle_customizer_styles() {
		global $post;

		$post_type = $this->cpt->post_type;

		if ( is_post_type_archive( $post_type ) || is_tax( 'smartdocs_category' ) ) {

			$this->dynamic_css->build_hero_section_style();
			$this->dynamic_css->build_categories_grid_style();
			$this->dynamic_css->build_responsive_styles();

		} elseif ( is_singular( $post_type ) ) {

			$this->dynamic_css->build_hero_section_style();
			$this->dynamic_css->build_responsive_styles();

		} elseif ( is_a( $post, 'WP_Post' ) ) {
			if ( has_shortcode( $post->post_content, 'smartdocs_categories' ) ) {
				$this->dynamic_css->build_categories_grid_style();
				$this->dynamic_css->build_responsive_styles();
			}
		}

		$this->dynamic_css->render_styles();
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

			/**
			 * SmartDocs loaded.
			 *
			 * Fires when SmartDocs was fully loaded and instantiated.
			 *
			 * @since 1.0.0
			 */
			do_action( 'smartdocs_loaded' );
		}

		return self::$instance;
	}
}

Plugin::instance();
