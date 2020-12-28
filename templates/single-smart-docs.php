<?php
/**
 * The template for displaying all single docs.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-smart-docs.php.
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
	exit; // Exit if accessed directly.
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

		endwhile;

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
