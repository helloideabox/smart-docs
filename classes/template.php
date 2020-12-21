<?php
/**
 * Templates class to manage overriding of default theme templates.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

/**
 * Templates.
 *
 * Core class used to override default templates when required.
 *
 * @package SmartDocs
 * @since 1.0.0
 */
class Template {

	/**
	 * Default CPT Name
	 *
	 * @since 1.0.0
	 * @var string $post_type
	 */
	public $post_type = null;

	public $override_single = false;

	public $override_tax_archive = false;

	protected $has_docs_template = false;

	/**
	 * Class constructor.
	 *
	 * Responsible for loading all the required methods and action in the class
	 * when it is instantiated.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$override_single      = get_option( 'smartdocs_enable_single_template', '1' );
		$override_tax_archive = get_option( 'smartdocs_enable_category_and_tag_template', '1' );

		if ( '1' == $override_single ) {
			$this->override_single = true;
		}
		if ( '1' == $override_tax_archive ) {
			$this->override_tax_archive = true;
		}

		$this->post_type = Plugin::instance()->cpt->post_type;

		// Filter to rewrite the default archive theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'template_loader' ) );

		add_filter( 'body_class', array( $this, 'body_class' ) );
	}

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
		if ( is_tax( 'smartdocs_tag' ) && $this->override_tax_archive ) {
			$template_file = 'taxonomy-smartdocs-tag.php';
		}

		if ( ! empty( $template_file ) ) {
			$this->has_docs_template = true;

			$exists_in_theme = locate_template(
				array(
					$template_file,
					$this->get_template_path( $template_file )
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

	public function get_template_path( $filename = '' ) {
		return SMART_DOCS_PATH . 'templates/' . $filename;
	}

	public function body_class( $classes ) {
		if ( $this->has_docs_template ) {
			$classes[] = 'smartdocs-template';
		}

		if ( is_active_sidebar( 'smart-docs-sidebar' ) && ! is_post_type_archive( Plugin::instance()->cpt->post_type ) ) {
			$classes[] = 'smartdocs-has-sidebar';
		}

		return $classes;
	}
}
