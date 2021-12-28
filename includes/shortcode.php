<?php
/**
 * Functions related to shortcode for live search
 *
 * @package SmartDocs\Functions
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Renders SmartDocs search form.
 *
 * @param array $atts Array of shortcode arguments.
 */
function smartdocs_render_search_box( $args = array() ) {
	$args = array_merge(
		array(
			'class' 		=> '',
			'placeholder' 	=> esc_attr_x( 'Search for answers..', 'placeholder', 'smart-docs' ),
			'value' 		=> get_search_query(),
			'name' 			=> 's',
			'title' 		=> esc_attr_x( 'Search', 'text for input title attribute', 'smart-docs' ),
			'autocomplete' 	=> 'off',
			'autocapitalize' => 'off',
			'autocorrect' 	=> 'off',
		),
		(array) $args
	);

	$args['class'] = trim( sanitize_html_class( $args['class'] ) . ' smartdocs-search-input' );

	/**
	 * Filter to modify/add attributes for search input.
	 *
	 * @param array $args Attributes for search input.
	 */
	$args = (array) apply_filters( 'smartdocs_search_input_attrs', $args );

	$args['type'] = 'text';

	$attrs = '';

	if ( ! empty( $args ) ) {
		foreach ( $args as $key => $value ) {
			$attrs .= ' ' . $key . '="' . $value . '"';
		}
	}

	ob_start();

	smartdocs_get_template( 'search-form', array(
		'attributes' => $attrs,
	) );

	return ob_get_clean();
}
add_shortcode( 'smartdocs_search', 'smartdocs_render_search_box' );

/**
 * Renders a grid of SmartDocs categories.
 *
 * @param array $args Array of shortcode arguments.
 * @return string
 */
function smartdocs_render_categories( $args = array() ) {
	$args = shortcode_atts(
		array(
			'show_count' => 'yes',
			'columns'    => '3,2,1',
			'hide_empty' => 'yes',
			'title_tag'  => 'h5',
			'include'	 => 'all', 	// Comma separated term IDs. Example: "4,9,13".
			'exclude'	 => 'all', 	// Comma separated term IDs. Example: "4,9,13".
			'orderby'	 => 'none', // @see https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
			'order'		 => 'ASC', 	// @see https://developer.wordpress.org/reference/classes/wp_term_query/__construct/
			'show_articles' => 'yes',
			'show_children' => 'no',
		),
		$args
	);

	$terms_args = array(
		'hide_empty' => 'no' === $args['hide_empty'] ? false : true,
		'pad_counts' => 1,
		'include'	 => $args['include'],
		'exclude'	 => $args['exclude'],
		'orderby'	 => $args['orderby'],
		'order'	 	 => $args['order'],
	);

	/**
	 * Filter term query args.
	 *
	 * @param array $term_args Term arguments.
	 */
	$terms_args = (array) apply_filters( 'smartdocs_categories_query_args', $terms_args );

	$terms_args['taxonomy'] = 'smartdocs_category';

	if ( is_tax( 'smartdocs_category' ) ) {
		// Query only child terms if we are on taxonomy archive.
		$term_children = get_term_children( get_queried_object()->term_id , 'smartdocs_category' );
		if ( ! is_wp_error( $term_children ) && is_array( $term_children ) && ! empty( $term_children ) ) {
			foreach ( $term_children as $term_child ) {
				$terms[] = get_term( $term_child );
			}
		}

		$args['is_smartdocs_category'] = true;
	} else {
		$terms = get_terms( $terms_args );
	}

	if ( ! isset( $terms ) || is_wp_error( $terms ) || empty( $terms ) ) {
		return '';
	}

	$columns    = explode( ',', $args['columns'] );
	$columns_lg = trim( $columns[0] );
	$columns_lg = empty( absint( $columns_lg ) ) ? '3' : $columns_lg; // In case user entered string instead of number.
	$columns_md = isset( $columns[1] ) && ! empty( trim( $columns[1] ) ) ? trim( $columns[1] ) : $columns_lg;
	$columns_sm = isset( $columns[2] ) && ! empty( trim( $columns[2] ) ) ? trim( $columns[2] ) : $columns_md;

	$columns_class = "col-lg--$columns_lg col-md--$columns_md col-sm--$columns_sm";

	ob_start();
	smartdocs_get_template(
		'categories',
		array(
			'terms' => $terms,
			'args'	=> $args,
			'columns_class' => $columns_class,
		)
	);

	return ob_get_clean();
}
add_shortcode( 'smartdocs_categories', 'smartdocs_render_categories' );
