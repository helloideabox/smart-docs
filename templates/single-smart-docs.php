<?php
/**
 * The template for single docs page
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
 * Hook: smartdocs_before_main_content_single_post
 *
 * @hooked smartdocs_output_content_wrapper - 10
 */
do_action( 'smartdocs_before_main_content' );

	if ( have_posts() ) :
				
		while ( have_posts() ) :

			the_post();

			smartdocs_get_template_part( 'content', 'single-docs' );

		endwhile; // End of the loop.

	endif;

	/**
	 * Hook: smartdocs_sidebar
	 * 
	 * @hooked smartdocs_get_sidebar - 10
	 */
	do_action( 'smartdocs_sidebar' );

/**
 * Hook: smartdocs_after_main_content_single_post
 *
 * @hooked smartdocs_output_content_wrapper_end - 10
 */
do_action( 'smartdocs_after_main_content' );

get_footer();
