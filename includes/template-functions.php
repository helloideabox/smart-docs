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
	<main class="sd-wrap">
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

function smartdocs_categories_grid_layout( $term ) {
	?>
	<div class="smartdocs-category layout-grid">
		<a href="<?php echo esc_html( get_term_link( $term ) ); ?>" class="sd-sub-archive-categories-post">
			<h4 class="sd-archive-cat-title">
				<?php echo esc_html( $term->name ); ?>
			</h4>
			<p class="sd-archive-post-count">
				<?php
				// Checking if the Article is greter than 0 or 1.
				if ( 0 === $term->count ) {
					echo esc_html( $term->count ) . ' Article';
				} else {
					/* translators: %s: search term */
					$article = sprintf( _n( '%d Article', '%d Articles', wp_get_postcount( $term->term_id, $term->taxonomy ), 'smart-docs' ), number_format_i18n( wp_get_postcount( $term->term_id, $term->taxonomy ) ) );
					echo esc_html( $article );
				}
				?>
			</p>
		</a>
	</div>
	<?php
}

function smartdocs_categories_list_layout( $term ) {
	?>
	<div class="smartdocs-category layout-list">
		<div class="category-title">
			<a href="<?php echo esc_html( get_term_link( $term ) ); ?>" class="sd-sub-archive-categories-post">
				<h4 class="sd-archive-cat-title">
					<?php echo esc_html( $term->name ); ?>
				</h4>
			</a>
		</div>
		<div class="category-count">
			<p class="sd-archive-post-count">
				<?php
				// Checking if the Article is greter than 0 or 1.
				if ( 0 === $term->count ) {
					echo esc_html( $term->count ) . ' Article';
				} else {
					/* translators: %s: search term */
					$article = sprintf( _n( '%d Article', '%d Articles', wp_get_postcount( $term->term_id, $term->taxonomy ), 'smart-docs' ), number_format_i18n( wp_get_postcount( $term->term_id, $term->taxonomy ) ) );
					echo esc_html( $article );
				}
				?>
			</p>
		</div>
	</div>
<?php } ?>
