<?php
/**
 * Template functions.
 *
 * Functions for the templating system.
 *
 * @package SmartDocs\Functions
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Global.
 */

if ( ! function_exists( 'smartdocs_header' ) ) {
	/**
	 * Hero section.
	 */
	function smartdocs_header() {
		smartdocs_get_template( 'header' );
	}
}

if ( ! function_exists( 'smartdocs_hero_title' ) ) {
	/**
	 * Hero title.
	 *
	 * @return string
	 */
	function smartdocs_hero_title() {
		$title = get_option( 'smartdocs_hero_title' );
		if ( empty( $title ) ) {
			$title = __( 'Documentation', 'smart-docs' );
		}

		return $title;
	}
}

if ( ! function_exists( 'smartdocs_hero_description' ) ) {
	/**
	 * Hero description.
	 */
	function smartdocs_hero_description() {
		$desc = get_option( 'smartdocs_hero_description' );
		if ( ! empty( $desc ) ) {
			echo '<div class="smartdocs-hero-description">' . wpautop( wptexturize( $desc ) ) . '</div>'; // WPCS: XSS ok.
		}
	}
}

if ( ! function_exists( 'smartdocs_search_form' ) ) {
	/**
	 * Output Search form using shortcode.
	 */
	function smartdocs_search_form() {
		echo do_shortcode( '[smartdocs_search]' );
	}
}

if ( ! function_exists( 'smartdocs_output_content_wrapper_start' ) ) {
	/**
	 * Content wrappers start.
	 */
	function smartdocs_output_content_wrapper_start() {
		?>
		<div class="smartdocs-content">
			<div class="smartdocs-inner">
		<?php
	}
}

if ( ! function_exists( 'smartdocs_output_content_wrapper_end' ) ) {
	/**
	 * Content wrappers end.
	 */
	function smartdocs_output_content_wrapper_end() {
		?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'smartdocs_archive_content' ) ) {
	/**
	 * Archive page content.
	 *
	 * @see smartdocs_categorized_articles()
	 */
	function smartdocs_archive_content() {
		if ( ! is_tax( 'smartdocs_category' ) || apply_filters( 'smartdocs_tax_render_categories', false ) ) {
			$columns        = get_theme_mod( 'smartdocs_archive_columns', 3 );
			$columns_tablet = get_theme_mod( 'smartdocs_archive_columns_tablet', 2 );
			$columns_mobile = get_theme_mod( 'smartdocs_archive_columns_mobile', 1 );

			$args = array(
				'columns'   => "$columns,$columns_tablet,$columns_mobile",
				'title_tag' => get_theme_mod( 'smartdocs_archive_category_title_tag', 'h5' ),
			);

			echo smartdocs_render_categories( $args ); // WPCS: XSS ok.
		}

		if ( is_tax( 'smartdocs_category' ) ) {
			smartdocs_categorized_articles();
		}
	}
}

if ( ! function_exists( 'smartdocs_get_sidebar' ) ) {
	/**
	 * Get sidebar for single doc and category pages.
	 */
	function smartdocs_get_sidebar() {
		if ( ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
			smartdocs_get_template( 'sidebar' );
		}
	}
}

if ( ! function_exists( 'smartdocs_output_content_area_wrapper_start' ) ) {
	/**
	 * Content area wrappers start.
	 */
	function smartdocs_output_content_area_wrapper_start() {
		if ( ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
			?>
			<div id="primary">
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
}

if ( ! function_exists( 'smartdocs_output_content_area_wrapper_end' ) ) {
	/**
	 * Content area wrappers end.
	 */
	function smartdocs_output_content_area_wrapper_end() {
		if ( ! is_post_type_archive( SmartDocs\Plugin::instance()->cpt->post_type ) ) {
			?>
			</div>
			<?php
		}
	}
}

/**
 * Single doc page.
 */

if ( ! function_exists( 'smartdocs_entry_header' ) ) {
	/**
	 * Single doc entry header.
	 */
	function smartdocs_entry_header() {
		smartdocs_get_template( 'single-doc-header' );
	}
}

if ( ! function_exists( 'smartdocs_entry_footer' ) ) {
	/**
	 * Single doc entry footer.
	 */
	function smartdocs_entry_footer() {
		smartdocs_get_template( 'single-doc-footer' );
	}
}

if ( ! function_exists( 'smartdocs_entry_content' ) ) {
	/**
	 * Single doc entry content.
	 */
	function smartdocs_entry_content() {
		the_content();
	}
}

if ( ! function_exists( 'smartdocs_entry_meta' ) ) {
	/**
	 * Single doc entry meta.
	 */
	function smartdocs_entry_meta() {
		smartdocs_get_template( 'single-doc-meta' );
	}
}

if ( ! function_exists( 'smartdocs_doc_actions' ) ) {
	/**
	 * Single doc actions.
	 */
	function smartdocs_doc_actions() {
		smartdocs_get_template( 'single-doc-actions' );
	}
}

if ( ! function_exists( 'smartdocs_doc_feedback' ) ) {
	/**
	 * Single doc feedback - upvotes/downvotes.
	 */
	function smartdocs_doc_feedback() {
		smartdocs_get_template( 'single-doc-feedback' );
	}
}

/**
 * Category archive.
 */

if ( ! function_exists( 'smartdocs_categorized_articles' ) ) {
	/**
	 * Show articles on category archive.
	 */
	function smartdocs_categorized_articles() {
		while ( have_posts() ) :
			the_post();
			smartdocs_get_template_part( 'content', 'smartdocs-category' );
		endwhile;
	}
}

if ( ! function_exists( 'smartdocs_category_title' ) ) {
	/**
	 * Category archive title.
	 */
	function smartdocs_category_title() {
		if ( ! is_smartdocs_category() ) {
			return;
		}

		$current_term = $GLOBALS['wp_query']->get_queried_object();
		?>
		<h1 class="smartdocs-category-title" itemprop="headline"><?php echo esc_html( $current_term->name ); ?></h1>
		<?php
	}
}

if ( ! function_exists( 'smartdocs_breadcrumb' ) ) {
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
}

if ( ! function_exists( 'smartdocs_print_button' ) ) {
	/**
	 * Output Print this Page button on Single Docs.
	 * */
	function smartdocs_print_button() {
		?>
		<button class="smartdocs-print-button" onclick="window.print();" > <span class="dashicons dashicons-printer"></span> </button>
		<?php
	}
}
