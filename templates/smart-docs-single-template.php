<?php
/**
 * The template for category docs page
 *
 * @author IdeaBox
 * @package SmartDocs/ArchiveTemplate single post
 * @version 1.0.0
 */

get_header();

get_style_depends('smartdocs-single-doc', 'single-doc');

/**
 * Hook: smartdocs_before_main_content_single_post
 */
do_action( 'smartdocs_before_main_content_single_doc' );

if ( have_posts() ) :
	?>

<div class="smartdocs-single-doc-wrap">
	<div class="smartdocs-single-doc-content-wrap">
		<?php
		while ( have_posts() ) :
			the_post();
			?>	
				<header class="smartdocs-single-doc-header">
					<h1 class="smartdocs-single-doc-title"><?php the_title(); ?></h1>
					<?php
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
					}
					?>
				</header>

				<article class="smartdocs-single-doc-content">
					<?php the_post_thumbnail(); ?>
					<?php the_content(); ?>
					<?php
					// If post last updated time is on.
					$is_last_updatsd_time_on = get_option( 'sd_show_last_update_time' );
					if ( '1' === $is_last_updatsd_time_on ) {
						?>

						<div class="smartdocs-single-post-last-update-time"><?php esc_attr_e( 'Updated on ' . get_the_date( 'F j, Y' ), 'smart-docs' ); ?></div>

					<?php } ?>
					<?php
					// To get the related tags of that post.
					the_terms( get_the_ID(), 'smartdocs_tag', '<ul class="smart-docs-tag"><span class="smart-docs-tag-label">Tagged Under: </span><li>', ',</li><li>', '</li></ul>' );
					?>
				</article>

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				$is_comment_template_on = get_option( 'sd_turnoff_doc_comment' );
				if ( ! ( '1' === $is_comment_template_on ) ) {
					comments_template();
				}
				?>
		<?php endwhile; ?>
	</div>

	<?php
	// Widget Area.
	if ( is_active_sidebar( 'smart-docs-sidebar-1' ) ) {
		?>

	<div class="smartdocs-custom-widget-area">
		<div class="smartdocs-sidebar-main-content-area">
			<?php dynamic_sidebar( 'smart-docs-sidebar-1' ); ?>
		</div>
	</div>

	<?php } ?>
</div>

	<?php
endif;
?>



<?php

/**
 * Hook: smartdocs_after_main_content_single_post
 */
do_action( 'smartdocs_after_main_content_single_doc' );

	get_footer();

?>
