<?php
/**
 * The template for archive docs page
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}

get_header();

/**
 * Hook: smartdocs_before_main_content.
 *
 * @hooked smartdocs_output_content_wrapper - 10
 */
do_action( 'smartdocs_before_main_content' );

	do_action( 'smartdocs_before_archive_content' );

	// Post condition and loop for displaying post.
	if ( have_posts() ) {

		/**
		 * Hook: smartdocs_archive_content.
		 *
		 * @hooked smartdocs_archive_content - 10
		 */
		do_action( 'smartdocs_archive_content' );

	} else {
		esc_html_e( 'Not yet started. Add some categories to see them on the SmartDocs Archive Page.', 'smart-docs' );
	}

	do_action( 'smartdocs_after_archive_content' );

	/**
	 * Hook: smartdocs_sidebar
	 * 
	 * @hooked smartdocs_get_sidebar - 10
	 */
	do_action( 'smartdocs_sidebar' );

/**
 * Hook - smartdocs_after_main_content.
 *
 * @hooked smartdocs_output_content_wrapper_end - 10
 */
do_action( 'smartdocs_after_main_content' );

get_footer();
