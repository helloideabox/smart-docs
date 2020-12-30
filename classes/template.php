<?php
/**
 * Class to override default templates when required.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Template class.
 */
class Template {
	/**
	 * SmartDocs CPT Name.
	 *
	 * @since 1.0.0
	 * @var string $post_type
	 * @access private
	 */
	private $post_type = null;

	/**
	 * Override single.
	 *
	 * @since 1.0.0
	 * @var boolean $override_single
	 * @access private
	 */
	private $override_single = false;

	/**
	 * Override taxonomy archive.
	 *
	 * @since 1.0.0
	 * @var boolean $override_tax_archive
	 * @access private
	 */
	private $override_tax_archive = false;

	/**
	 * Has docs template.
	 *
	 * @since 1.0.0
	 * @var boolean $has_docs_template
	 * @access protected
	 */
	protected $has_docs_template = false;

	/**
	 * Class constructor.
	 *
	 * Responsible for loading all the required methods and actions/filters
	 * in the class when it is instantiated.
	 */
	public function __construct() {
		$override_single      = (int) get_option( 'smartdocs_enable_single_template', '1' );
		$override_tax_archive = (int) get_option( 'smartdocs_enable_taxonomy_template', '1' );

		if ( 1 === $override_single ) {
			$this->override_single = true;
		}
		if ( 1 === $override_tax_archive ) {
			$this->override_tax_archive = true;
		}

		$this->post_type = Plugin::instance()->cpt->post_type;

		// Filter to override the default theme template for smart-docs cpt.
		add_filter( 'template_include', array( $this, 'template_loader' ) );

		// Filter to add generator meta tag for SmartDocs templates.
		add_filter( 'get_the_generator_html', array( $this, 'generator_meta_tag' ), 10, 2 );
		add_filter( 'get_the_generator_xhtml', array( $this, 'generator_meta_tag' ), 10, 2 );

		// Add body classes for SmartDocs templates.
		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

	/**
	 * Load SmartDocs template for CPT.
	 *
	 * @since 1.0.0
	 * @param  string $template Template path.
	 * @return string
	 */
	public function template_loader( $template ) {
		$template_file = '';

		if ( is_singular( $this->post_type ) && $this->override_single ) {
			$template_file = 'single-smart-docs.php';
		}
		if ( is_post_type_archive( $this->post_type ) ) {
			$template_file = 'archive-smart-docs.php';
		}
		if ( is_tax( 'smartdocs_category' ) && $this->override_tax_archive ) {
			$template_file = 'taxonomy-smartdocs-category.php';
		}

		if ( ! empty( $template_file ) ) {
			$this->has_docs_template = true;

			// Theme compatibilities.
			$this->theme_compats();

			$exists_in_theme = locate_template(
				array(
					$template_file,
					$this->get_template_path( $template_file ),
				),
				false
			);

			if ( '' !== $exists_in_theme ) {
				return $exists_in_theme;
			} else {
				return $this->get_template_path( $template_file );
			}
		}

		return $template;
	}

	/**
	 * Retrieves the path of the template file.
	 *
	 * @since 1.0.0
	 * @param string $filename Template filename.
	 * @return string
	 */
	public function get_template_path( $filename = '' ) {
		return SMART_DOCS_PATH . 'templates/' . $filename;
	}

	/**
	 * Output generator tag to aid debugging.
	 *
	 * @since 1.0.0
	 * @param string $gen Generator.
	 * @param string $type Type.
	 * @return string
	 */
	public function generator_meta_tag( $gen, $type ) {
		if ( ! $this->has_docs_template ) {
			return $gen;
		}

		$version = SMART_DOCS_VERSION;

		switch ( $type ) {
			case 'html':
				$gen .= "\n" . '<meta name="generator" content="SmartDocs ' . esc_attr( $version ) . '">';
				break;
			case 'xhtml':
				$gen .= "\n" . '<meta name="generator" content="SmartDocs ' . esc_attr( $version ) . '" />';
				break;
		}

		return $gen;
	}

	/**
	 * Add body classes for SmartDocs pages.
	 *
	 * @since 1.0.0
	 * @param  array $classes Body Classes.
	 * @return array
	 */
	public function body_class( $classes ) {
		if ( $this->has_docs_template ) {
			$classes[] = 'smartdocs-template';
		}

		if ( is_active_sidebar( 'smart-docs-sidebar' ) && ! is_post_type_archive( $this->post_type ) ) {
			$classes[] = 'smartdocs-has-sidebar';
		}

		return $classes;
	}

	/**
	 * Theme compatibilities.
	 *
	 * @since 1.0.0
	 */
	protected function theme_compats() {
		// Remove OceanWP page header.
		remove_action( 'ocean_page_header', 'oceanwp_page_header_template' );
	}
}
