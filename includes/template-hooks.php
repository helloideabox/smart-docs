<?php
/**
 * Template Hooks.
 *
 * Hooking of all the template functions to their respective hooks.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

 /**
  * Hooked on Category Archive Page.
  */
add_action( 'smartdocs_archive_description', 'smartdocs_archive_description', 10 );

add_action( 'smartdocs_archive_before_header_end', 'smartdocs_search_form', 10 );

//add_filter( 'the_content', 'smartdocs_output_page_wrap' );

add_action( 'smartdocs_archive_content', 'smartdocs_archive_content', 10 );


add_action( 'smartdocs_before_main_content', 'smartdocs_output_header', 5 );
add_action( 'smartdocs_before_main_content', 'smartdocs_output_content_wrapper_start', 10 );

add_action( 'smartdocs_after_main_content', 'smartdocs_output_content_wrapper_end', 10 );

add_action( 'smartdocs_before_archive_content', 'smartdocs_output_content_area_wrapper_start', 10 );
add_action( 'smartdocs_after_archive_content', 'smartdocs_output_content_area_wrapper_end', 10 );

add_action( 'smartdocs_sidebar', 'smartdocs_get_sidebar', 10 );

//add_action( 'smartdocs_single_doc_last_updated_on', 'smartdocs_single_doc_last_updated_on', 10 );

//add_action( 'smartdocs_single_doc_terms', 'smartdocs_single_doc_terms', 10 );

//add_action( 'smartdocs_before_single', 'smartdocs_single_doc_hero_content', 5 );

//add_action( 'smartdocs_single_doc_hero_content', 'smartdocs_search_form', 10 );

add_action( 'smartdocs_before_single_doc', 'smartdocs_output_content_area_wrapper_start', 10 );
add_action( 'smartdocs_after_single_doc', 'smartdocs_output_content_area_wrapper_end', 10 );

add_action( 'smartdocs_before_single_doc_content', 'smartdocs_single_doc_header', 5 );
add_action( 'smartdocs_single_doc_content', 'smartdocs_single_doc_content', 10 );

/**
 * Breadcrumbs.
 *
 * @see smartdocs_breadcrumb()
 */
add_action( 'smartdocs_primary_content_area', 'smartdocs_breadcrumb', 20, 0 );

add_action( 'smartdocs_primary_content_area', 'smartdocs_category_title', 30 );

add_action( 'smartdocs_after_single_doc', 'smartdocs_doc_actions', 5 );