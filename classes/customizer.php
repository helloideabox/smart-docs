<?php
/**
 * Plugin Customizer Settings.
 *
 * Responsible for registering sections and controls in Customizer.
 * Responsible for enqueuing relevant scripts into Customizer.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

use SmartDocs\Customizer_Control;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Class.
 */
class Customizer {
	/**
	 * A flag to check whether we're in a Customizer
	 * preview or not.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var bool $_is_preview
	 */
	private $_is_preview = false;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'add_sections' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customizer_controls' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_preview_script' ) );
		add_action( 'customize_controls_print_styles', array( $this, 'sync_customizer_breakpoints' ) );
		add_action( 'template_redirect', array( $this, 'perform_template_actions' ) );
	}

	/**
	 * Add panels and sections into Customizer.
	 *
	 * @since 1.0.0
	 * @param object $wp_customize WP Customizer class object.
	 */
	public function add_sections( $wp_customize ) {
		// Create custom panels.
		$wp_customize->add_panel(
			'smartdocs_style_options',
			array(
				'priority'       => 30,
				'theme_supports' => '',
				'title'          => __( 'Smart Docs', 'smart-docs' ),
				'description'    => __( 'Controls the layout and elements of SmartDocs frontend.', 'smart-docs' ),
			)
		);

		require SMART_DOCS_PATH . 'classes/customizer/sections/layout.php';
		require SMART_DOCS_PATH . 'classes/customizer/sections/hero-section.php';
		require SMART_DOCS_PATH . 'classes/customizer/sections/archive.php';
		require SMART_DOCS_PATH . 'classes/customizer/sections/single.php';
		require SMART_DOCS_PATH . 'classes/customizer/sections/breadcrumbs.php';
		require SMART_DOCS_PATH . 'classes/customizer/sections/breakpoints.php';
	}

	/**
	 * Enqueue customizer preview scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_customizer_preview_script() {
		wp_enqueue_script(
			'smartdocs-customizer-preview',
			SMART_DOCS_URL . 'assets/js/customizer/preview.js',
			array( 'customize-preview' ),
			SMART_DOCS_VERSION,
			true
		);

		$this->_is_preview = true;
	}

	/**
	 * Enqueue customizer controls scripts.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_customizer_controls() {
		// Enqueue styles.
		wp_enqueue_style( 'smartdocs-customizer', SMART_DOCS_URL . 'assets/css/customizer.css', array(), SMART_DOCS_VERSION );

		// Enqueue scripts.
		wp_register_script(
			'smartdocs-wp-color-picker-alpha',
			SMART_DOCS_URL . 'assets/js/customizer/wp-color-picker-alpha.js',
			array( 'wp-color-picker' ),
			SMART_DOCS_VERSION,
			true
		);

		wp_enqueue_script(
			'smartdocs-customizer',
			SMART_DOCS_URL . 'assets/js/customizer/customizer.js',
			array( 'jquery', 'smartdocs-wp-color-picker-alpha' ),
			SMART_DOCS_VERSION,
			true
		);

		$single_post = get_posts( array(
			'post_type' => Plugin::instance()->cpt->post_type,
			'numberposts' => 1,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'ASC',
		) );

		$single_doc_url = '';

		if ( is_array( $single_post ) && ! empty( $single_post ) && is_a( $single_post[0], 'WP_Post' ) ) {
			$single_doc_url = get_permalink( $single_post[0] );
		}

		wp_localize_script( 'smartdocs-customizer', 'smartdocs_customizer', array(
			'cpt_slug' => Plugin::instance()->cpt->get_cpt_rewrite_slug(),
			'single_doc_url' => $single_doc_url,
		) );

		wp_enqueue_script(
			'smartdocs-customizer-controls',
			SMART_DOCS_URL . 'assets/js/customizer/control.js',
			array( 'customize-controls', 'smartdocs-customizer' ),
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
	 * @param array  $shadow Array of box shadow properties.
	 * @param string $color Box shadow color string.
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
	 * @param mixed $val Value.
	 * @return int
	 */
	public static function sanitize_number( $val ) {
		return is_numeric( $val ) ? $val : 0;
	}

	/**
	 * Sanitize callback for integer value.
	 *
	 * @since 1.0.0
	 * @param mixed $val Value.
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
	 * @param string $hex Color in hex.
	 * @param int 	 $opacity Optional. Color opacity.
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

	/**
	 * Sync Customizer responsive preview dimensions with
	 * custom breakpoints.
	 *
	 * @since 1.0.0
	 */
	public function sync_customizer_breakpoints() {
		$tablet_width = (int) get_theme_mod( 'smartdocs_breakpoint_medium' );
		$mobile_width = (int) get_theme_mod( 'smartdocs_breakpoint_small' );
		?>
		<style>
			<?php if ( ! empty( $tablet_width ) ) { ?>
			.wp-customizer .preview-tablet .wp-full-overlay-main {
				width: <?php echo esc_attr( $tablet_width ); ?>px;
				margin-left: -<?php echo esc_attr( $tablet_width ) / 2; ?>px;
			}
			<?php } ?>
			<?php if ( ! empty( $mobile_width ) ) { ?>
			.wp-customizer .preview-mobile .wp-full-overlay-main {
				width: <?php echo esc_attr( $mobile_width ); ?>px;
				margin-left: -<?php echo esc_attr( $mobile_width ) / 2; ?>px;
			}
			<?php } ?>
		</style>
		<?php
	}

	/**
	 * Add or remove elements based on Customizer setting.
	 *
	 * @since 1.0.0
	 */
	public function perform_template_actions() {
		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_display_breadcrumbs' ) ) {
			if ( is_singular( Plugin::instance()->cpt->post_type ) ) {
				remove_action( 'smartdocs_primary_content_area', 'smartdocs_breadcrumb', 20 );
			}
		}

		if ( 'no' === get_theme_mod( 'smartdocs_taxonomy_archives_display_breadcrumbs' ) ) {
			if ( is_tax( 'smartdocs_category' ) ) {
				remove_action( 'smartdocs_primary_content_area', 'smartdocs_breadcrumb', 20 );
			}
		}

		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_display_action_section' ) ) {
			remove_action( 'smartdocs_after_single_doc', 'smartdocs_doc_actions', 5 );
		}

		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_display_print_button' ) ) {
			remove_action( 'smartdocs_after_single_doc_title', 'smartdocs_print_button', 5 );
		}

		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_display_feedback_section' ) ) {
			remove_action( 'smartdocs_after_single_doc', 'smartdocs_doc_feedback', 6 );
		}			
		
		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_navigation_links' ) ) {
			remove_action( 'smartdocs_after_single_doc', 'smartdocs_navigation_links', 7 );
		}

		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_related_articles' ) ) {
			remove_action( 'smartdocs_after_single_doc', 'smartdocs_related_articles', 8 );
		}

		if ( 'no' === get_theme_mod( 'smartdocs_single_doc_toc' ) ) {
			remove_action( 'smartdocs_before_single_doc_content', 'smartdocs_render_toc', 5 );
		}

		if ( 'none' === get_theme_mod( 'smartdocs_single_doc_sidebar' ) ) {
			remove_action( 'smartdocs_sidebar', 'smartdocs_get_sidebar', 10 );
		}

		$entry_meta = get_theme_mod( 'smartdocs_single_doc_display_meta' );

		if ( 'after_content' === $entry_meta ) {
			if ( has_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta' ) ) {
				remove_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta', 5 );
			}
			if ( ! has_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta' ) ) {
				add_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta', 5 );
			}
		} elseif ( 'after_title' === $entry_meta ) {
			if ( has_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta' ) ) {
				remove_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta', 5 );
			}
			if ( ! has_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta' ) ) {
				add_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta', 5 );
			}
		} elseif ( 'hide' === $entry_meta ) {
			if ( has_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta' ) ) {
				remove_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta', 5 );
			}
			if ( has_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta' ) ) {
				remove_action( 'smartdocs_after_single_doc_title', 'smartdocs_entry_meta', 5 );
			}
		}
	}
}
