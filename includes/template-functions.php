<?php
/**
 * Template functions.
 *
 * @package SmartDocs
 * @since 1.0.0
 */

/**
 * Function: smartdocs_archive_title.
 *
 * Output title for the archive page.
 *
 * @return string $title Title of the archive page.
 *
 * @since 1.0.0
 */
function smartdocs_archive_title() {
	$title = get_option( 'ibx_sd_archive_page_title' );
	if ( empty( $title ) ) {
		$title = __( 'Documentation', 'smart-docs' );
	}

	return $title;
}

function smartdocs_archive_description() {
	$desc = get_option( 'ibx_sd_archive_description' );

	if ( ! empty( $desc ) ) {
		echo wpautop( $desc );
	}
}

function smartdocs_search_form() {
	echo do_shortcode( '[smartdocs_search]' );
}

function smartdocs_output_content_wrapper() {
	?>
	<div class="smartdocs-content">
	<?php
}

function smartdocs_output_content_wrapper_end() {
	?>
	</div>
	<?php
}

function smartdocs_output_page_wrap( $content ) {
	global $post;
	if ( 318 == $post->ID ) {
		return '<div class="smartdocs">' . $content . '</div>';
	}

	return $content;
}

function smartdocs_archive_content() {

	echo smartdocs_render_categories( $args );

}

function get_category_thumbnail_image_url( $term_id ) {

	$smartdocs_category_thumb_id     = get_term_meta( $term_id, 'thumbnail_id', true );
	$smartdocs_taxonomy_thumbnail_id = get_term_meta( $term_id, 'taxonomy_thumbnail_id', true );

	if ( empty( $smartdocs_category_thumb_id ) ) {
		$smartdocs_category_thumb_id = $smartdocs_taxonomy_thumbnail_id;
	}

	$smartdocs_category_image = wp_get_attachment_image_src( $smartdocs_category_thumb_id, $settings['cat_thumbnails_size'] );

	return $smartdocs_category_image;
}

function smartdocs_get_sidebar() {

	if ( is_active_sidebar( 'smart-docs-sidebar-1' ) ) :
		?>

		<div class="smartdocs-sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
			<div class="smartdocs-sidebar-widgets">
				<?php dynamic_sidebar( 'smart-docs-sidebar-1' ); ?>
			</div>
		</div>

	<?php endif; ?>
	<?php
}

function smartdocs_single_doc_last_updated_on() {
	?>

	<div class="smartdocs-single-doc-last-update-time"><?php esc_attr_e( 'Updated on ' . get_the_date( 'F j, Y' ), 'smart-docs' ); ?></div>

	<?php
}

function smartdocs_single_doc_terms() {
	// To get the related tags of that post.
	the_terms( get_the_ID(), 'smartdocs_tag', '<ul class="smart-docs-tag"><span class="smart-docs-tag-label">Tagged Under: </span><li>', ',</li><li>', '</li></ul>' );

}

function smartdocs_single_doc_comments() {
	comments_template();
}

function smartdocs_single_doc_hero_content() {
	?>
		<div class="smartdocs-hero">
			<?php do_action( 'smartdocs_single_doc_hero_content' ); ?>
		</div>
	<?php
}

function smartdocs_single_doc_header() {
	?>
	<header class="smartdocs-entry-header">
		<?php do_action(  'smartdocs_before_single_doc_title' ); ?>
		<h1 class="smartdocs-entry-title"><?php the_title(); ?></h1>
		<?php do_action( 'smartdocs_after_single_doc_title' ); ?>
	</header>
	<?php
}

function smartdocs_single_doc_content() {
	?>
	<div class="smartdocs-entry-content">
		<?php the_content(); ?>
	</div>
	<?php
}