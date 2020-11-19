<?php
/**
 * The template for archive docs page
 *
 * @author IdeaBox
 * @package SmartDocs/ArchiveTemplate
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_style_depends( 'smartdocs-archive', 'archive' );

/**
 * Hook: smartdocs_before_main_content.
 *
 * @hooked smartdocs_output_content_wrapper - 10
 */
do_action( 'smartdocs_before_main_content' );

?>

<header class="smartdocs-archive-header">
	<div class="smartdocs-inner">
		<?php if ( apply_filters( 'smartdocs_show_archive_title', true ) ) : ?>
			<h1 class="smartdocs-docs-archive-title"><?php echo esc_html( smartdocs_archive_title() ); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: smartdocs_archive_description.
		 *
		 * @hooked smartdocs_archive_description - 10
		 */
		do_action( 'smartdocs_archive_description' );
		?>

		<?php
		/**
		 * Hook: smartdocs_archive_before_header_end.
		 *
		 * @hooked smartdocs_search_form - 10
		 */
		do_action( 'smartdocs_archive_before_header_end' );
		?>
	</div>
</header>

<?php


// Post condition and loop for displaying post.
if ( have_posts() ) {

	/**
	 * Hook: smartdocs_archive_content.
	 *
	 * @hooked smartdocs_archive_content - 10
	 */
	do_action( 'smartdocs_archive_content' );

} else {
	esc_html_e( 'Not yet started. Add some categories to see them on the SmartDocs Archive Page. ', 'smart-docs' );
}

	/**
	 * Hook - smartdocs_after_main_content.
	 *
	 * @hooked smartdocs_output_content_wrapper_end - 10
	 */
	do_action( 'smartdocs_after_main_content' );

	get_footer();
