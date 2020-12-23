<?php
/**
 * Docs Archive
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/archive-smart-docs.php.
 *
 * HOWEVER, on occasion SmartDocs will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     SmartDocs\Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
