<?php

/**
 * Add script to the page.
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
