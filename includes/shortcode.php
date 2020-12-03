<?php
/**
 * Functions related to shortcode for live search
 *
 * @package SmartDocs/Shortcode
 * @author IdeaBox
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// To render the search box of WordPress.
add_shortcode( 'smartdocs_search', 'smartdocs_render_search_box' );



/**
 * For rendering the search box.
 *
 * @param int $atts    Get attributes for the search field.
 * @param int $content Get content to search from.
 */
function smartdocs_render_search_box( $atts, $content = null ) {
	ob_start();
	/**
	 * Load required script dependents.
	 */

	get_script_depends( 'smartdocs-searchbox-script', 'search-script', array( 'jquery' ) );
	wp_localize_script(
		'smartdocs-searchbox-script',
		'sd_ajax_url',
		array(
			'url'        => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'docs_search' ),
		)
	);
	get_style_depends( 'smartdocs-style', 'style' );
	?>
	<div class="smartdocs-search">
		<div class="smartdocs-search-inner">
			<form role="search" method="post" class="smartdocs-search-form" action="">
				<input id="smartdocs-search-input" type="search" class="smartdocs-search-input" placeholder="<?php echo esc_attr_x( 'Search for answers…', 'placeholder', 'smart-docs' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search', 'label', 'smart-docs' ); ?>" autocomplete="off" autocorrect="off" />

				<div class="smartdocs-spinner live-search-loading">
					<img src="<?php echo esc_url( plugins_url( '../assets/images/ring.gif', __FILE__ ) ); ?>" >
				</div>
			</form>
		</div>
	</div>
	<?php
	// Returning the html document.
	return ob_get_clean();
}


// To render the search box of WordPress.
add_shortcode( 'smartdocs_categories', 'smartdocs_render_categories' );

/**
 * Render category list for smartdocs categories.
 *
 * @param [array] $args Array of shortcode arguments.
 * @return html
 */
function smartdocs_render_categories( $args = array() ) {

	if ( is_post_type_archive( 'smart-doc' ) ) {
		include_once SMART_DOCS_PATH . 'classes/customizer/customizer-css.php';
	}

	$args = shortcode_atts(
		array(
			'show_count' => true,
			'columns'    => '3,2,1',
			'hide_empty' => false,
			'layout'     => 'grid',
			'title_tag'  => 'h4',
		),
		$args
	);

	$terms_args = array(
		'hide_empty' => apply_filters( 'smartdocs_hide_empty_categories', $args['hide_empty'] ),
	);

	$terms = get_terms( 'smartdocs_category', $terms_args );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return '';
	}

	$columns    = explode( ',', $args['columns'] );
	$columns_lg = trim( $columns[0] );
	$columns_lg = empty( absint( $columns_lg ) ) ? '3' : $columns_lg; // In case user entered string instead of number.
	$columns_md = isset( $columns[1] ) && ! empty( trim( $columns[1] ) ) ? trim( $columns[1] ) : $columns_lg;
	$columns_sm = isset( $columns[2] ) && ! empty( trim( $columns[2] ) ) ? trim( $columns[2] ) : $columns_md;

	/**
	 * Get settings
	 */

	$layout = get_theme_mod( 'smartdocs_archive_layout_setting', 'list' );

	ob_start();
	?>
	<div class="smartdocs-categories smartdocs-categories-list smartdocs-archive-layout-<?php echo $layout; ?>">
		<?php foreach ( $terms as $term ) : ?>
			<div class="smartdocs-category">
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
					<div class="smartdocs-category-info-wrapper">
							<?php
								$smartdocs_category_image = smartdocs_get_category_thumbnail_url( $term->term_id );

							if ( is_array( $smartdocs_category_image ) && ! empty( $smartdocs_category_image ) ) :
								?>
								<img src="<?php echo $smartdocs_category_image[0]; ?>" alt="<?php echo $term->name; ?>" width="100px">

							<?php endif; ?>
							<div class="smartdocs-category-title-description-wrapper">
								<<?php echo esc_html( $args['title_tag'] ); ?> class="smartdocs-category-title"><?php echo esc_html( $term->name ); ?></<?php echo esc_html( $args['title_tag'] ); ?>>
								<?php if ( ! empty( $term->description ) ) : ?>
									<span class="smartdocs-category-description">
										<?php echo esc_html( $term->description ); ?>
									</span>
								<?php endif; ?>
							</div>
					</div>
					<div class="smartdocs-posts-info">
						<div class="smartdocs-category-posts-count">
							<span class="smartdocs-posts-count"><?php echo esc_html( $term->count ); ?></span>
							<span class="smartdocs-posts-count-text"><?php echo esc_html( _n( 'Article', 'Articles', $term->count, 'smart-docs' ) ); ?></span>
						</div>
						<div class="smartdocs-category-view-all">
							<span><?php echo __( 'View All', 'smart-docs' ); ?></span>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
