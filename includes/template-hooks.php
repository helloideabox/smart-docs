<?php
/**
 * SmartDocs Template Hooks.
 *
 * Action/filter hooks used for SmartDocs functions/templates.
 *
 * @package SmartDocs\Templates
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Header.
 *
 * @see smartdocs_header()
 */
add_action( 'smartdocs_before_main_content', 'smartdocs_header', 5 );

/**
 * Main Content wrappers.
 *
 * @see smartdocs_output_content_wrapper_start()
 * @see smartdocs_output_content_wrapper_end()
 */
add_action( 'smartdocs_before_main_content', 'smartdocs_output_content_wrapper_start', 10 );
add_action( 'smartdocs_after_main_content', 'smartdocs_output_content_wrapper_end', 10 );

/**
 * Header elements.
 *
 * @see smartdocs_hero_description()
 * @see smartdocs_search_form()
 */
add_action( 'smartdocs_header_content', 'smartdocs_hero_description', 5 );
add_action( 'smartdocs_header_content', 'smartdocs_search_form', 10 );

/**
 * Archive content.
 *
 * @see smartdocs_archive_content()
 */
add_action( 'smartdocs_archive_content', 'smartdocs_archive_content', 10 );

/**
 * Content wrappers for doc archive.
 *
 * @see smartdocs_output_content_area_wrapper_start()
 * @see smartdocs_output_content_area_wrapper_end()
 */
add_action( 'smartdocs_before_archive_content', 'smartdocs_output_content_area_wrapper_start', 10 );
add_action( 'smartdocs_after_archive_content', 'smartdocs_output_content_area_wrapper_end', 10 );

/**
 * Content wrappers for single doc.
 *
 * @see smartdocs_output_content_area_wrapper_start()
 * @see smartdocs_output_content_area_wrapper_end()
 */
add_action( 'smartdocs_before_single_doc', 'smartdocs_output_content_area_wrapper_start', 10 );
add_action( 'smartdocs_after_single_doc', 'smartdocs_output_content_area_wrapper_end', 10 );

/**
 * Entry header for single doc.
 *
 * @see smartdocs_entry_header()
 */
add_action( 'smartdocs_before_single_doc_content', 'smartdocs_entry_header', 5 );

/**
 * Entry content for single doc.
 *
 * @see smartdocs_entry_content()
 */
add_action( 'smartdocs_single_doc_content', 'smartdocs_entry_content', 10 );

/**
 * Entry footer for single doc.
 *
 * @see smartdocs_entry_footer()
 */
add_action( 'smartdocs_after_single_doc_content', 'smartdocs_entry_footer', 10 );

/**
 * Entry meta for single doc.
 *
 * @see smartdocs_entry_meta()
 */
add_action( 'smartdocs_single_doc_footer', 'smartdocs_entry_meta', 5 );

/**
 * Action content for single doc.
 *
 * @see smartdocs_doc_actions()
 */
add_action( 'smartdocs_after_single_doc', 'smartdocs_doc_actions', 5 );

/**
 * Feedback content for single doc.
 *
 * @see smartdocs_doc_feedback()
 */
add_action( 'smartdocs_after_single_doc', 'smartdocs_doc_feedback', 6 );

/**
 * Related Articles.
 *
 * @see smartdocs_related_articles()
 */
add_action( 'smartdocs_after_single_doc', 'smartdocs_related_articles', 7 );

/**
 * Breadcrumbs.
 *
 * @see smartdocs_breadcrumb()
 */
add_action( 'smartdocs_primary_content_area', 'smartdocs_breadcrumb', 20, 0 );

/**
 * Category title.
 *
 * @see smartdocs_category_title()
 */
add_action( 'smartdocs_primary_content_area', 'smartdocs_category_title', 30 );

/**
 * Sidebar.
 *
 * @see smartdocs_get_sidebar()
 */
add_action( 'smartdocs_sidebar', 'smartdocs_get_sidebar', 10 );
