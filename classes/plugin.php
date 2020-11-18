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
use SmartDocs\Permalinks;

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
	 * Instance.
	 *
	 * Holds the Permalinks Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var permalinks
	 */

	public $permalinks = null;

	/**
	 * Instance.
	 *
	 * Holds the Customizer Class instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var customizer
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

		add_action( 'wp_head', array( $this, 'render_frontend_styles' ) );
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
		$this->permalinks = new Permalinks();
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
		$this->templates  = new Templates();
		$this->search     = new Search();
		$this->customizer = new Customizer();

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Load widgets.
		$this->doc_widget     = new Widget();
		$this->doc_cat_widget = new Cat_Widget();

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
	 * Function to enque scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		global $post_type;
	}

	/**
	 * Render Frontend Styles
	 *
	 * @return void
	 */
	public function render_frontend_styles() {
		$archive_title_color                = get_theme_mod( 'smartdocs_archive_title_color' );
		$archive_item_list_title_color      = get_theme_mod( 'smartdocs_archive_list_item_title_color' );
		$archive_item_list_post_count_color = get_theme_mod( 'smartdocs_archive_list_item_post_count_color' );
		$archive_list_item_bg_color         = get_theme_mod( 'smartdocs_archive_list_item_bg_color' );

		/**
		 * Header Styles.
		 */
		$background_type  = get_theme_mod( 'smartdocs_archive_hero_bg_type' );
		$background_color = get_theme_mod( 'smartdocs_archive_hero_background_color' );
		$background_image = get_theme_mod( 'smartdocs_archive_hero_bg_image' );

		/**
		 * Grid Layout
		 */
		$grid_columns        = get_theme_mod( 'smartdocs_archive_columns' );
		$grid_columns_tablet = get_theme_mod( 'smartdocs_archive_columns_tablet' );
		$grid_columns_mobile = get_theme_mod( 'smartdocs_archive_columns_mobile' );

		$grid_gap = get_theme_mod( 'smartdocs_archive_columns_gap' );
		?>
		<style type="text/css">
			/**
			 * Header style.
			 */
			header .smartdocs-inner {
				<?php if ( 'color' === $background_type ) : ?>
					background-color: <?php echo esc_attr( $background_color ); ?>;
				<?php elseif ( 'image' === $background_type ) : ?>
					background-image: url('<?php echo esc_html( $background_image ); ?>');
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
				<?php endif; ?>
					padding: 20px;
			}
			.smartdocs-docs-archive-title {
				<?php if ( ! empty( $archive_title_color ) ) { ?>
					color: <?php echo esc_attr( $archive_title_color ); ?>;
				<?php } ?>
					display: flex;
					align-items: center;
					justify-content: center;
					padding-top: 25px;
					padding-bottom: 25px;
			}
			.sd-archive-cat-title {
				<?php if ( ! empty( $archive_item_list_title_color ) ) { ?>
					color: <?php echo esc_attr( $archive_item_list_title_color ); ?>;
				<?php } ?>
			}
			.sd-archive-post-count {
				<?php if ( ! empty( $archive_item_list_post_count_color ) ) { ?>
					color: <?php echo esc_attr( $archive_item_list_post_count_color ); ?>;
				<?php } ?>
			}
			a.sd-sub-archive-categories-post {
				<?php if ( ! empty( $archive_list_item_bg_color ) ) { ?>
					background-color: <?php echo esc_attr( $archive_list_item_bg_color ); ?>;
				<?php } ?>
			}

			/**
			 * Grid Styles
			 */
			.sd-archive-categories-wrap .smartdocs-cat-grid-layout .smartdocs-archive-categories {
				display: grid;
				grid-template-columns: repeat(<?php echo empty( $grid_columns ) ? 3 : $grid_columns; ?>, 1fr);
				gap: <?php echo empty( $grid_gap ) ? '20px' : ($grid_gap . 'px') ?>;
			}

			/**
			 * Search styles
			 */
			.smartdocs-spinner {
				display: none;
			}
			.smartdocs-search-input {
				border: 1px solid #c0c0c0 !important;
					height: 3em !important;
			}
			.smartdocs-search {
				border: 1px solid blue;
				margin-top: 50px;
				margin-bottom: 50px;
			}
		</style>
		<?php
	}
}

Plugin::instance();
