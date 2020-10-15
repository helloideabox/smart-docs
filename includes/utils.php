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
