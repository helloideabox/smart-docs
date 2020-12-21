<?php
/**
 * Template functions.
 *
 * @package SmartDocs
 * @since 1.0.0
 */

/**
 * Function: smartdocs_hero_title.
 *
 * Output title for the archive page.
 *
 * @return string $title Title of the archive page.
 *
 * @since 1.0.0
 */
function smartdocs_hero_title() {
	$title = get_option( 'smartdocs_archive_page_title' );
	if ( empty( $title ) ) {
		$title = __( 'Documentation', 'smart-docs' );
	}

	return $title;
}

function smartdocs_archive_description() {
	$desc = get_option( 'smartdocs_archive_description' );

	if ( ! empty( $desc ) ) {
		echo wpautop( $desc );
	}
}

function smartdocs_search_form() {
	echo do_shortcode( '[smartdocs_search]' );
}

function smartdocs_output_content_wrapper_start() {
	?>
	<div class="smartdocs-content">
		<div class="smartdocs-inner">
	<?php
}

function smartdocs_output_content_wrapper_end() {
	?>
		</div>
	</div>
	<?php
}

function smartdocs_output_header() {
	smartdocs_get_template( 'header' );
}

function smartdocs_archive_content() {
	if ( ! is_tax( 'smartdocs_category' ) || apply_filters( 'smartdocs_tax_render_categories', false ) ) {
		$columns        = get_theme_mod( 'smartdocs_archive_columns', 3 );
		$columns_tablet = get_theme_mod( 'smartdocs_archive_columns_tablet', 2 );
		$columns_mobile = get_theme_mod( 'smartdocs_archive_columns_mobile', 1 );

		// TODO: Provide arguments from customizer
		$args = array(
			'columns' => "$columns,$columns_tablet,$columns_mobile",
			'title_tag' => get_theme_mod( 'smartdocs_archive_category_title_tag' )
		);

		echo smartdocs_render_categories( $args );
	}

	if ( is_tax( 'smartdocs_category' ) ) {
		smartdocs_categorized_articles();
	}
}

function smartdocs_get_sidebar() {
	if ( is_active_sidebar( 'smart-docs-sidebar' ) && ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
		smartdocs_get_template( 'sidebar' );
	}
}

function smartdocs_single_doc_terms() {
	// To get the related tags of that post.
	the_terms( get_the_ID(), 'smartdocs_tag', '<ul class="smart-docs-tag"><span class="smart-docs-tag-label">Tagged Under: </span><li>', ',</li><li>', '</li></ul>' );

}

function smartdocs_output_content_area_wrapper_start() {
	if ( ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
		?>
		<div id="primary" class="content-area">
			<?php
			/**
			 * Hook: smartdocs_primary_content_area
			 *
			 * @hooked smartdocs_breadcrumb - 20
			 */
			do_action( 'smartdocs_primary_content_area' );
			?>
		<?php
	}
}

function smartdocs_output_content_area_wrapper_end() {
	if ( ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
		?>
		</div>
		<?php
	}
}

function smartdocs_entry_header() {
	smartdocs_get_template( 'single-doc-header' );
}

function smartdocs_entry_footer() {
	smartdocs_get_template( 'single-doc-footer' );
}

function smartdocs_entry_content() {
	the_content();
}

function smartdocs_categorized_articles() {
	while ( have_posts() ) :
		the_post();
		smartdocs_get_template_part( 'content', 'smartdocs-category' );
	endwhile;
}

/**
 * Output the SmartDocs Breadcrumb.
 *
 * @param array $args Arguments.
 */
function smartdocs_breadcrumb( $args = array() ) {
	$args = wp_parse_args(
		$args,
		apply_filters(
			'smartdocs_breadcrumb_defaults',
			array(
				'delimiter'   => '&nbsp;&#187;&nbsp;',
				'wrap_before' => '<nav class="smartdocs-breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
			)
		)
	);

	$breadcrumbs = new SmartDocs\Breadcrumb();

	$args['breadcrumb'] = $breadcrumbs->generate();

	do_action( 'smartdocs_breadcrumb', $breadcrumbs, $args );

	smartdocs_get_template( 'breadcrumb', $args );
}

function smartdocs_category_title() {
	if ( ! is_smartdocs_category() ) {
		return;
	}

	$current_term = $GLOBALS['wp_query']->get_queried_object();
	?>
	<h1 class="smartdocs-category-title" itemprop="headline"><?php echo $current_term->name; ?></h1>
	<?php
}

function smartdocs_doc_actions() {
	smartdocs_get_template( 'single-doc-actions' );
}

function smartdocs_doc_feedback() {
	smartdocs_get_template( 'single-doc-feedback' );
}
