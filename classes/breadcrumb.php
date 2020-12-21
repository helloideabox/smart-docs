<?php
namespace SmartDocs;

/**
 * Breadcrumb Class.
 *
 * Responsible for creating breadcrumbs.
 *
 * @since 1.0.0
 * @package SmartDocs\Classes
 */

defined( 'ABSPATH' ) || exit;

class Breadcrumb {
	/**
	 * Breadcrumb trail.
	 *
	 * @var array
	 */
	protected $crumbs = array();

	/**
	 * Add a crumb so we don't get lost.
	 *
	 * @param string $name Name.
	 * @param string $link Link.
	 */
	public function add_crumb( $name, $link = '' ) {
		$this->crumbs[] = array(
			wp_strip_all_tags( $name ),
			$link,
		);
	}

	/**
	 * Reset crumbs.
	 */
	public function reset() {
		$this->crumbs = array();
	}

	/**
	 * Get the breadcrumb.
	 *
	 * @return array
	 */
	public function get_breadcrumb() {
		return apply_filters( 'smartdocs_get_breadcrumb', $this->crumbs, $this );
	}

	/**
	 * Generate breadcrumb trail.
	 *
	 * @return array of breadcrumbs
	 */
	public function generate() {
		$conditionals = array(
			'is_smartdocs_single',
			'is_smartdocs_category',
			'is_smartdocs_tag',
		);

		if ( ( ! is_front_page() && ! ( intval( get_option( 'page_on_front' ) ) === get_option( 'smartdocs_custom_doc_page' ) ) ) || is_paged() ) {
			foreach ( $conditionals as $conditional ) {
				if ( call_user_func( $conditional ) ) {
					call_user_func( array( $this, 'add_crumbs_' . substr( $conditional, 3 ) ) );
					break;
				}
			}

			$this->paged_trail();

			return $this->get_breadcrumb();
		}

		return array();
	}

	/**
	 * Prepend the docs page to docs breadcrumbs.
	 */
	protected function prepend_docs_page() {
		$use_doc_archive = get_option( 'smartdocs_use_built_in_doc_archive' );
		$docs_page_id = get_option( 'smartdocs_custom_doc_page' );

		if ( ! $use_doc_archive && ! empty( $docs_page_id ) ) {
			$docs_page    	= get_post( $docs_page_id );
			$docs_title 	= $docs_page ? get_the_title( $docs_page ) : '';
			$permalink 		= $docs_page ? get_permalink( $docs_page ) : '';
		} else {
			$docs_title = get_option( 'smartdocs_archive_page_title' );
		}

		if ( ! isset( $docs_title ) || empty( $docs_title ) ) {
			$docs_title = esc_html__( 'Docs', 'smart-docs' );
		}
		if ( ! isset( $permalink ) || empty( $permalink ) ) {
			$permalink = get_post_type_archive_link( 'smart-docs' );
		}
		
		if ( intval( get_option( 'page_on_front' ) ) !== $docs_page_id ) {
			$this->add_crumb( $docs_title, $permalink );
		}
	}

	/**
	 * Single post trail.
	 *
	 * @param int    $post_id   Post ID.
	 * @param string $permalink Post permalink.
	 */
	protected function add_crumbs_smartdocs_single( $post_id = 0, $permalink = '' ) {
		if ( ! $post_id ) {
			global $post;
		} else {
			$post = get_post( $post_id ); // WPCS: override ok.
		}

		if ( ! $permalink ) {
			$permalink = get_permalink( $post );
		}

		$this->prepend_docs_page();

		$terms = wp_get_post_terms(
			$post->ID,
			'smartdocs_category',
			apply_filters(
				'smartdocs_breadcrumb_terms_args',
				array(
					'orderby' => 'parent',
					'order'   => 'DESC',
				)
			)
		);

		if ( $terms ) {
			$main_term = apply_filters( 'smartdocs_breadcrumb_main_term', $terms[0], $terms );
			$this->term_ancestors( $main_term->term_id, 'smartdocs_category' );
			$this->add_crumb( $main_term->name, get_term_link( $main_term ) );
		}

		$this->add_crumb( get_the_title( $post ), $permalink );
	}

	/**
	 * Docs category trail.
	 */
	protected function add_crumbs_smartdocs_category() {
		$current_term = $GLOBALS['wp_query']->get_queried_object();

		$this->prepend_docs_page();
		$this->term_ancestors( $current_term->term_id, 'smartdocs_category' );
		$this->add_crumb( $current_term->name, get_term_link( $current_term, 'smartdocs_category' ) );
	}

	/**
	 * Docs tag trail.
	 */
	protected function add_crumbs_smartdocs_tag() {
		$current_term = $GLOBALS['wp_query']->get_queried_object();

		$this->prepend_docs_page();

		/* translators: %s: smartdocs tag */
		$this->add_crumb( sprintf( __( 'Docs tagged &ldquo;%s&rdquo;', 'smart-docs' ), $current_term->name ), get_term_link( $current_term, 'smartdocs_tag' ) );
	}

	/**
	 * Add crumbs for a term.
	 *
	 * @param int    $term_id  Term ID.
	 * @param string $taxonomy Taxonomy.
	 */
	protected function term_ancestors( $term_id, $taxonomy ) {
		$ancestors = get_ancestors( $term_id, $taxonomy );
		$ancestors = array_reverse( $ancestors );

		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, $taxonomy );

			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				$this->add_crumb( $ancestor->name, get_term_link( $ancestor ) );
			}
		}
	}

	/**
	 * Add a breadcrumb for pagination.
	 */
	protected function paged_trail() {
		if ( get_query_var( 'paged' ) ) {
			/* translators: %d: page number */
			$this->add_crumb( sprintf( __( 'Page %d', 'smart-docs' ), get_query_var( 'paged' ) ) );
		}
	}
}