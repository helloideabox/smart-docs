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

add_action( 'smartdocs_before_main_content', 'smartdocs_output_content_wrapper', 10 );

add_action( 'smartdocs_after_main_content', 'smartdocs_output_content_wrapper_end', 10 );

add_filter( 'the_content', 'smartdocs_output_page_wrap' );

add_action( 'smartdocs_archive_content', 'smartdocs_archive_content', 10);

/**
 * Hooked on Single Doc Page
 */
add_action( 'smartdocs_before_main_content_single_doc', 'smartdocs_output_content_wrapper', 10);
add_action( 'smartdocs_after_main_content_single_doc', 'smartdocs_output_content_wrapper_end', 10);