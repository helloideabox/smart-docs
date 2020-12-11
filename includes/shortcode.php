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
function smartdocs_render_search_box( $args = array() ) {
	$args = shortcode_atts(
		array(),
		$args
	);

	$args = apply_filters( 'smartdocs_search_input_args', $args );

	smartdocs_get_template( 'search', $args );
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

	$args = shortcode_atts(
		array(
			'show_count' => true,
			'columns'    => '3,2,1',
			'hide_empty' => false,
			'children'	 => false,
			'title_tag'  => 'h4',
		),
		$args
	);

	$terms_args = array(
		'hide_empty' => apply_filters( 'smartdocs_hide_empty_categories', $args['hide_empty'] ),
	);

	if ( ! $args['children'] ) {
		$terms_args['parent'] = 0;
	}

	$terms_args = apply_filters( 'smartdocs_categories_query_args', $terms_args );

	if ( is_tax( 'smartdocs_category' ) ) {
		// Query only child terms if we are on taxonomy archive.
		$term_children = get_term_children( get_queried_object()->term_id , 'smartdocs_category' );
		if ( is_array( $term_children ) && ! empty( $term_children ) ) {
			foreach ( $term_children as $term_child ) {
				$terms[] = get_term( $term_child );
			}
		}
	} else {
		$terms = get_terms( 'smartdocs_category', $terms_args );
	}

	if ( ! isset( $terms ) || is_wp_error( $terms ) || empty( $terms ) ) {
		return '';
	}

	$columns    = explode( ',', $args['columns'] );
	$columns_lg = trim( $columns[0] );
	$columns_lg = empty( absint( $columns_lg ) ) ? '3' : $columns_lg; // In case user entered string instead of number.
	$columns_md = isset( $columns[1] ) && ! empty( trim( $columns[1] ) ) ? trim( $columns[1] ) : $columns_lg;
	$columns_sm = isset( $columns[2] ) && ! empty( trim( $columns[2] ) ) ? trim( $columns[2] ) : $columns_md;

	$columns_class = "col-lg-$columns_lg col-md-$columns_md col-sm-$columns_sm";

	smartdocs_get_template(
		'categories',
		array(
			'terms' => $terms,
			'args'	=> $args,
			'columns_class' => $columns_class,
		)
	);
}
