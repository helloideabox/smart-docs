<?php
/**
 * The template for category docs page
 *
 * @author IdeaBox
 * @package SmartDocs/ArchiveTemplate single post
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}

get_header();

get_style_depends( 'smartdocs-single-doc', 'single-doc' );

/**
 * Hook: smartdocs_before_main_content_single_post
 *
 * @hooked smartdocs_output_content_wrapper - 10
 */
do_action( 'smartdocs_before_main_content_single_doc' );

if ( have_posts() ) :
	?>

<div class="smartdocs-single-doc-wrap">
	
	<?php while ( have_posts() ) : ?>

		<?php the_post(); ?>

		<?php require_once SMART_DOCS_PATH . '\templates\content-single-doc.php'; ?>

	<?php endwhile; // End of the loop ?>

	<?php 

	/**
	 * Hook: smartdocs_sidebar
	 * 
	 * @hooked smartdocs_get_sidebar - 10
	 */
	do_action( 'smartdocs_sidebar' );

	?>

</div> <!-- End of smartdocs-single-doc-wrap -->

	<?php
endif;
?>

<?php

/**
 * Hook: smartdocs_after_main_content_single_post
 *
 * @hooked smartdocs_output_content_wrapper_end - 10
 */
do_action( 'smartdocs_after_main_content_single_doc' );

get_footer();

?>
