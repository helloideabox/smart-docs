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
	$args = array(
		'hide_empty' => apply_filters( 'smartdocs_archive_hide_empty_categories', false ),
	);

	/**
	 * Set layout mode
	 */
	$layout = get_theme_mod( 'smartdocs_archive_layout_setting' );

	if ( empty( $layout ) ) {
		$layout = 'list';
	}

	$layoutFunction = 'smartdocs_categories_' . $layout . '_layout';

	$terms = get_terms( 'smartdocs_category', $args );
	?>

		<?php if ( $terms ) : ?>

		<div class="sd-archive-categories-wrap">
			<div class="smartdocs-inner smartdocs-cat-<?php echo esc_html( $layout ); ?>-layout">
				<div class="smartdocs-archive-categories">
			<?php
			// Looping through all the terms.
			foreach ( $terms as $t ) :
				// Checking if they have parent or not.
				if ( 0 === $t->parent ) :
					?>
						<?php $layoutFunction( $t ); ?>

					<?php
				endif;
			endforeach;
			?>
				</div>
			</div>
		</div>
		<?php endif ?> 

	<?php
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
