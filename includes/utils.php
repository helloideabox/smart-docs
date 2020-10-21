<?php
/**
 * Includes all essential functions required for common tasks.
 *
 * @package SmartDocs
 */

/**
 * Add script to the page.
 *
 * @param string $script_name Name of the script's handle.
 * @param string $file_name Name of the file as in folder.
 * @param array  $script_dependencies An array of dependencies for the enqueued script. Default is an empty array.
 */
function get_script_depends( $script_name, $file_name, $script_dependencies = array() ) {

	wp_enqueue_script(
		$script_name,
		SMART_DOCS_URL . 'assets/js/' . $file_name . '.js',
		$script_dependencies,
		'1.0.0',
		true
	);
}

/**
 * Add script to the page.
 *
 * @param string $style_name Name of the style handle.
 * @param string $file_name Name of the file in the folder.
 * @param array  $style_dependencies An array of all the dependencies required for the style.
 */
function get_style_depends( $style_name, $file_name, $style_dependencies = array() ) {

	wp_enqueue_style(
		$style_name,
		SMART_DOCS_URL . 'assets/css/' . $file_name . '.css',
		$style_dependencies,
		'1.0.0',
		false
	);
}

/**
 * Get Post Count of a Category.
 *
 * Includes Post Count of category children as well.
 *
 * @since 1.0.0
 *
 * @param integer $id Category ID.
 * @param string  $taxonomy_type Taxonomy Type of the Category.
 */
function wp_get_postcount( $id, $taxonomy_type ) {

	$cat      = get_term( $id, $taxonomy_type );
	$count    = (int) $cat->count;
	$taxonomy = $taxonomy_type;

	$args      = array(
		'child_of' => $id,
	);
	$tax_terms = get_terms( $taxonomy, $args );

	foreach ( $tax_terms as $tax_term ) {
		$count += $tax_term->count;
	}
	return $count;
}

/**
 * Get Settings.
 *
 * Fetch requested settings or return their default values if not found.
 *
 * @param string $setting_key Unique key of the setting.
 */
