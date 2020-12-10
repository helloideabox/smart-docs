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
	smartdocs_get_template_part( 'content', 'docs-header' );
}

// function smartdocs_output_page_wrap( $content ) {
// 	global $post;
// 	if ( 318 == $post->ID ) {
// 		return '<div class="smartdocs">' . $content . '</div>';
// 	}

// 	return $content;
// }

function smartdocs_archive_content() {
	if ( ! is_tax( 'smartdocs_category' ) || apply_filters( 'smartdocs_tax_render_categories', false ) ) {
		// TODO: Provide arguments from customizer
		$args = array();
		smartdocs_render_categories( $args );
	}

	if ( is_tax( 'smartdocs_category' ) ) {
		smartdocs_categorized_articles();
	}
}

function smartdocs_get_category_thumbnail_url( $term_id ) {

	$smartdocs_category_thumb_id     = get_term_meta( $term_id, 'thumbnail_id', true );
	$smartdocs_taxonomy_thumbnail_id = get_term_meta( $term_id, 'taxonomy_thumbnail_id', true );

	if ( empty( $smartdocs_category_thumb_id ) ) {
		$smartdocs_category_thumb_id = $smartdocs_taxonomy_thumbnail_id;
	}

	$smartdocs_category_image = wp_get_attachment_image_src( $smartdocs_category_thumb_id, 'thumbnail' );

	return $smartdocs_category_image;
}

function smartdocs_get_sidebar() {

	if ( is_active_sidebar( 'smart-docs-sidebar' ) && ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) :
		?>

		<div class="widget-area sidebar smartdocs-sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
			<div class="sidebar-main content-area">
				<?php dynamic_sidebar( 'smart-docs-sidebar' ); ?>
			</div>
		</div>

		<?php
	endif;

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

function smartdocs_single_doc_header() {
	?>
	<header class="entry-header smartdocs-entry-header">
		<?php do_action( 'smartdocs_before_single_doc_title' ); ?>
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

function smartdocs_categorized_articles() {
	while ( have_posts() ) :
		the_post();
		smartdocs_get_template_part( 'content', 'smartdocs-category' );
	endwhile;
}
<<<<<<< HEAD
=======

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
	<h1 class="smartdocs-category-title"><?php echo $current_term->name; ?></h1>
	<?php
}
>>>>>>> master
