<?php

namespace EasyDocs;

class Templates {

	public function __construct() {

		// For overriding templates.
		$this->callback_init();

		// Filter to rewrite the default archive theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'archive_template' ) );

	}

	/**
	 * Callback function for overide templates.
	 *
	 * @category InitCallBack
	 * @return void
	 */
	public function callback_init() {

		$is_single_template_on      = get_option( 'ed_enable_single_template' );
		$is_cat_and_tag_template_on = get_option( 'ed_enable_category_and_tag_template' );

		if ( '1' == $is_single_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default single theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'single_template' ) );
			add_filter( 'body_class', array( $this, 'body_single_class' ) );
		}

		if ( '1' == $is_cat_and_tag_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default taxonomy(easydoc_category) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'category_template' ) );

			// Filter to rewrite the default taxonomy(easydoc_tag) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'tag_template' ) );
			add_filter( 'body_class', array( $this, 'body_tax_class' ) );
			add_filter( 'body_class', array( $this, 'body_sidebar_class' ) );
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

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'easydoc_category' ) || is_tax( 'easydoc_tag' ) && is_array( $classes ) ) {
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

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'easydoc_category' ) || is_tax( 'easydoc_tag' ) && is_array( $classes ) ) {

			if ( is_active_sidebar( 'easy-doc-sidebar-1' ) ) {
				// Add clss to body.
				$cls = array_merge( $classes, array( 'easy-doc-sidebar-1' ) );
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
			$theme_files     = array( 'easy-doc-archive-template.php', '../templates/easy-doc-archive-template.php' );
			$exists_in_theme = locate_template( $theme_files, false );

			if ( '' !== $exists_in_theme ) {
				return $exists_in_theme;
			} else {
				return EASY_DOCS_PATH . 'templates/easy-doc-archive-template.php';
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
		if ( is_tax( 'easydoc_category' ) ) {
			return EASY_DOCS_PATH . 'templates/taxonomy-easy-doc-cat.php';
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
		if ( is_tax( 'easydoc_tag' ) ) {
			return EASY_DOCS_PATH . 'templates/taxonomy-easy-doc-tag.php';
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
		// Checking if the page is single and post type is of custom cpt(easy-doc).
		if ( is_singular( $this->cpt_name ) ) {
			return EASY_DOCS_PATH . 'templates/easy-doc-single-template.php';
		}
		return $template;
	}
}
