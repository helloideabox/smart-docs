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
class Templates {

	/**
	 * Default CPT Name
	 *
	 * @since 1.0.0
	 * @var string $cpt_name
	 */
	public $cpt_name = 'smart-doc';

	/**
	 * Class constructor.
	 *
	 * Responsible for loading all the required methods and action in the class
	 * when it is instantiated.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// For overriding templates.
		$this->callback_init();

		// Filter to rewrite the default archive theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'archive_template' ) );

	}

	/**
	 * Callback function for overiding templates.
	 *
	 * @category InitCallBack
	 * @return void
	 */
	public function callback_init() {

		$is_single_template_on      = get_option( 'ibx_sd_enable_single_template' );
		$is_cat_and_tag_template_on = get_option( 'ibx_sd_enable_category_and_tag_template' );

		if ( '1' == $is_single_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default single theme template for particular cpt.

			/** This filter is documented in wp-includes/template-loader.php */
			add_filter( 'template_include', array( $this, 'single_template' ) );

			add_filter( 'body_class', array( $this, 'body_single_class' ) );
		}

		if ( '1' == $is_cat_and_tag_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default taxonomy(smartdocs_category) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'category_template' ) );

			// Filter to rewrite the default taxonomy(smartdocs_tag) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'tag_template' ) );
			add_filter( 'body_class', array( $this, 'body_tax_class' ) );
			add_filter( 'body_class', array( $this, 'body_sidebar_class' ) );

			//add_action( 'init', array( $this, 'rewrite_rules' ) );

		}

	}

	/**
	 * Add Custom Class Single if their template is included to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_single_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_singular( $this->cpt_name ) && is_array( $classes ) ) {
			$cls = array_merge( $classes, array( 'docs-single-template-enabled' ) );
			return $cls;
		}
			return $classes;
	}

	/**
	 * Add Custom Class Category and Tag Taxonomy if their template is included to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_tax_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'smartdocs_category' ) || is_tax( 'smartdocs_tag' ) && is_array( $classes ) ) {
			$cls = array_merge( $classes, array( 'docs-tax-templates-enabled' ) );
			return $cls;
		}
			return $classes;
	}

	/**
	 * Add Custom Class Sidebar to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_sidebar_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'smartdocs_category' ) || is_tax( 'smartdocs_tag' ) && is_array( $classes ) ) {

			if ( is_active_sidebar( 'smart-docs-sidebar-1' ) ) {
				// Add clss to body.
				$cls = array_merge( $classes, array( 'smart-docs-sidebar-1' ) );
				return $cls;
			}
		}
			return $classes;
	}

	/**
	 * Function for custom template for custom post type.
	 *
	 * @param mixed $template rewriting template archive post.
	 * @return $template
	 */
	public function archive_template( $template ) {
		if ( is_post_type_archive( $this->cpt_name ) ) {
			$theme_files     = array( 'smart-docs-archive-template.php', '../templates/smart-docs-archive-template.php' );
			$exists_in_theme = locate_template( $theme_files, false );

			if ( '' !== $exists_in_theme ) {
				return $exists_in_theme;
			} else {
				return SMART_DOCS_PATH . 'templates/smart-docs-archive-template.php';
			}
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 * @return $template
	 */
	public function category_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'smartdocs_category' ) ) {
			return SMART_DOCS_PATH . 'templates/taxonomy-smart-docs-cat.php';
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 * @return $template
	 */
	public function tag_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'smartdocs_tag' ) ) {
			return SMART_DOCS_PATH . 'templates/taxonomy-smart-docs-tag.php';
		}
		return $template;
	}


	/**
	 * Single post Callback Function.
	 *
	 * @param array $template Overide single template.
	 * @return $template
	 */
	public function single_template( $template ) {
		// Checking if the page is single and post type is of custom cpt(smart-doc).
		if ( is_singular( $this->cpt_name ) ) {
			return SMART_DOCS_PATH . 'templates/smart-docs-single-template.php';
		}
		return $template;
	}

	function rewrite_rules() {

		// Get details about the post_type

		$args = array(
			'post_type'      => 'smart-doc',
			'posts_per_page' => -1,
		);

		$posts = get_posts( $args );

		foreach ( $posts as $post ) {
			$cat       = get_the_terms( $post, 'smartdocs_category' );
			$cat_slug  = $cat[0]->slug;
			$post_slug = $post->post_name;
			add_rewrite_rule( '^' . $cat_slug . '/' . $post_slug . '?/', 'index.php/property/' . $cat_slug . '/' . $post_slug . '/', 'top' );
		}

		add_rewrite_rule( '^smartdocs-category\/([a-z]+)\/?', 'index.php?page_id=$matches[1]', 'top' );

	}
}
