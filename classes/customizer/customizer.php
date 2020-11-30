<?php
/**
 * Plugin Customizer Settings
 *
 * Responsible for registering style settings in Customizer.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

use SmartDocs\Styler_Customizer_Control;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Customizer Class.
 *
 * @since 1.0.0
 */
class Customizer {


	/**
	 * A flag for whether we're in a Customizer
	 * preview or not.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var bool $_in_customizer_preview
	 */
	private $_is_preview = false;

	/**
	 * Construction fuction for class Customizer
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'customize_register', array( $this, 'add_sections' ) );

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customizer_controls' ) );

		add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_preview_script' ) );

		add_action( 'customize_controls_print_styles', 'sync_customizer_breakpoints' );

	}

	public function add_sections( $wp_customize ) {
		 // Create custom panels
		$wp_customize->add_panel(
			'smartdocs_style_options',
			array(
				'priority'       => 30,
				'theme_supports' => '',
				'title'          => __( 'SmartDocs', 'smart-docs' ),
				'description'    => __( 'Controls the design settings for the SmartDocs plugin.', 'smart-docs' ),
			)
		);

		require SMART_DOCS_PATH . '\classes\customizer\sections\test-section.php';
		require SMART_DOCS_PATH . '\classes\customizer\sections\homepage-section.php';
		require SMART_DOCS_PATH . '\classes\customizer\sections\search-section.php';
		require SMART_DOCS_PATH . '\classes\customizer\sections\single-doc-section.php';
		require SMART_DOCS_PATH . '\classes\customizer\sections\breakpoints.php';
	}

	/**
	 * Docs Homepage Section.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer Object.
	 * @return void
	 */
	public function add_docs_homepage_section( $wp_customize ) {

		// Docs page Settings

		$wp_customize->add_section(
			'smartdocs_homepage_settings',
			array(
				'title'    => __( 'Docs Home Page', 'smart-docs' ),
				'priority' => 100,
			)
		);

		// Set Title Color

		$wp_customize->add_setting(
			'smartdocs_homepage_title_color',
			array(
				'default'    => '#000000',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Color_Control(
				$wp_customize,
				'docs_title_color',
				array(
					'label'    => \__( 'Title Color', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_homepage_title_color',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_homepage_grid_items',
			array(
				'default'    => '#000000',
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'docs_section_divider',
				array(
					'label'    => \__( 'Grid Items', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_homepage_grid_items',
					'type'     => 'styler-section',
				)
			)
		);

		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'docs_category_font_size',
				array(
					'label'    => \__( 'Category Title Font Size', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_homepage_grid_items',
					'type'     => 'number',
					'default'  => '16',
				)
			)
		);

		$wp_customize->add_setting(
			'smartdocs_homepage_test_control',
			array(
				'default'    => 0,
				'capability' => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'test_two_control',
				array(
					'label'    => __( 'Test Control', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'smartdocs_homepage_test_control',
					'type'     => 'styler-slider',
				)
			)
		);

		$wp_customize->add_setting(
			'dimension_control',
			array(
				'default'    => array(
					'top'    => 0,
					'bottom' => 10,
					'left'   => 20,
					'right'  => 50,
				),
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'dimension_1_control',
				array(
					'label'    => __( 'Test Control', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'dimension_control',
					'type'     => 'styler-dimension',
					'choices'  => array(
						'top'    => 'Top',
						'right'  => 'Right',
						'bottom' => 'Bottom',
						'left'   => 'Left',
					),
				)
			)
		);

		$wp_customize->add_setting(
			'color_control',
			array(
				'default'    => '#ffffff',
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'styler_color_control',
				array(
					'label'    => __( 'Color Control', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'color_control',
					'type'     => 'styler-color',
					'choices'  => array( 'alpha' => true ),
				),
			)
		);

		$wp_customize->add_setting(
			'section_control',
			array(
				'default'    => 'Section Control',
				'capability' => 'edit_theme_options',
			),
		);

		$wp_customize->add_control(
			new Styler_Customizer_Control(
				$wp_customize,
				'styler_section_control',
				array(
					'label'    => __( 'Section Control', 'smart-docs' ),
					'section'  => 'smartdocs_homepage_settings',
					'settings' => 'section_control',
					'type'     => 'styler-section',
				),
			)
		);

		/**
		 * Register Sections.
		 */
		$wp_customize->get_section( 'smartdocs_homepage_settings' )->panel = 'smartdocs_style_options';
	}

	/**
	 * Function to enque admin side script(Settings page).
	 *
	 * @throws Error Warn user regarding a process that is mandatory.
	 * @return void
	 */
	public function enqueue_customizer_preview_script() {

		$dir = SMART_DOCS_PATH;

		$script_asset_path = "$dir/assets/customizer/preview/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new \Error(
				'You need to run `npm start` or `npm run build` for the "create-block/docs2" block first.'
			);
		}

		$index_js     = 'assets/customizer/preview/index.js';
		$script_asset = require $script_asset_path;
		$index_js_src = 'src/customizer/preview/index.js';

		wp_enqueue_script(
			'smartdocs-customizer-preview',
			SMART_DOCS_URL . $index_js_src,
			array_push( $script_asset['dependencies'], 'customize-preview' ),
			$script_asset['version'],
			true
		);

		$this->_is_preview = true;

		/*
		$editor_css = 'assets/customizer/index.css';

		wp_enqueue_style(
		'smartdocs-settings-style',
		SMART_DOCS_URL . $editor_css,
		array( 'wp-components' ),
		filemtime( "$dir/$editor_css" )
		); */

	}

	public function enqueue_customizer_controls() {

		$dir = SMART_DOCS_PATH;

		$script_asset_path = "$dir/assets/customizer/controls/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new \Error(
				'You need to run `npm start` or `npm run build` for the "create-block/docs2" block first.'
			);
		}

		$index_js     = 'assets/customizer/controls/index.js';
		$index_js_src = 'src/customizer/controls/index.js';
		$script_asset = require $script_asset_path;

		wp_enqueue_script(
			'smartdocs-customizer-controls',
			SMART_DOCS_URL . $index_js_src,
			array_push( $script_asset['dependencies'], 'customize-controls' ),
			$script_asset['version'],
			true
		);

		// Enqueue styles.
		wp_enqueue_style( 'styler-customizer', SMART_DOCS_URL . 'assets/css/customizer.css', array(), SMART_DOCS_VERSION );

		// Enqueue scripts.
		wp_enqueue_script(
			'wp-color-picker-alpha',
			SMART_DOCS_URL . 'assets/js/customizer/wp-color-picker-alpha.js',
			array( 'wp-color-picker' ),
			SMART_DOCS_VERSION,
			true
		);

		wp_enqueue_script(
			'styler-customizer',
			SMART_DOCS_URL . 'assets/js/customizer/customizer.js',
			array( 'jquery', 'wp-color-picker-alpha' ),
			SMART_DOCS_VERSION,
			true
		);
	}



	/**
	 * Checks to see if this is a Customizer preview or not.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	public static function is_customizer_preview() {
		return self::$_is_preview;
	}

	/**
	 * Helper function to generate box-shadow CSS.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $shadow
	 * @param string $color
	 *
	 * @return string
	 */
	public static function box_shadow_css( $shadow = array(), $color = '' ) {
		if ( empty( $shadow ) || empty( $color ) ) {
			return;
		}

		$box_shadow = 'box-shadow: ';

		if ( isset( $shadow['horizontal'] ) && ! empty( $shadow['horizontal'] ) ) {
			$box_shadow .= $shadow['horizontal'] . 'px ';
		} else {
			$box_shadow .= '0px ';
		}

		if ( isset( $shadow['vertical'] ) && ! empty( $shadow['vertical'] ) ) {
			$box_shadow .= $shadow['vertical'] . 'px ';
		} else {
			$box_shadow .= '0px ';
		}

		if ( isset( $shadow['blur'] ) && ! empty( $shadow['blur'] ) ) {
			$box_shadow .= $shadow['blur'] . 'px ';
		} else {
			$box_shadow .= '0px ';
		}

		if ( isset( $shadow['spread'] ) && ! empty( $shadow['spread'] ) ) {
			$box_shadow .= $shadow['spread'] . 'px ';
		} else {
			$box_shadow .= '0px ';
		}

		$box_shadow .= $color;

		return $box_shadow;
	}

	/**
	 * Sanitize callback for Customizer number field.
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	public static function sanitize_number( $val ) {
		return is_numeric( $val ) ? $val : 0;
	}

	/**
	 * Sanitize callback for integer value.
	 *
	 * @since 1.0.0
	 *
	 * @return int
	 */
	public static function sanitize_integer( $val ) {
		if ( empty( $val ) ) {
			return $val;
		}
		if ( is_numeric( $val ) ) {
			return intval( $val );
		}

		return 0;
	}

	/**
	 * Converts hex color to rgba.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function hex2rgba( $hex, $opacity = 1 ) {
		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}

		$rgba = array( $r, $g, $b, $opacity );

		return 'rgba(' . implode( ',', $rgba ) . ')';
	}

	function sync_customizer_breakpoints() {
		?>
		<style>
			.preview-tablet .wp-full-overlay-main {
				width: 1024px;
			}
	
			.preview-mobile .wp-full-overlay-main {
				width: 720px;
			}
		</style>
		<?php
	}
}