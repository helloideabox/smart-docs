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
	<main class="smartdocs-wrap">
	<?php
}

function smartdocs_output_content_wrapper_end() {
	?>
	</main>
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
