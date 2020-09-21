<?php
/**
 * Plugin Name: Easy Docs
 * Plugin URI: https://ideabox.io/
 * Author: IdeaBox
 * Author URI: https://ideabox.io
 * Version: 1.0.0
 * Description: Simple Documentation plugin for WordPress.
 * Text Domain: easy-docs
 *
 * @package EasyDocs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EASY_DOCS_VERSION', '1.0.0' );

define( 'EASY_DOC_FILE', __FILE__ );
define( 'EASY_DOCS_PATH', plugin_dir_path( __FILE__ ) );
define( 'EASY_DOCS_URL', plugin_dir_url( __FILE__ ) );

/**
 * Check for the Compatibility.
 */

if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	add_action( 'admin_notices', 'notice_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
	add_action( 'admin_notices', 'notice_wp_version' );
} else {

	/**
	 * Autoloading classes using Composer's Autoloader
	 */

	if ( EASY_DOCS_PATH . '/vendor/autoload.php' ) {
		require_once EASY_DOCS_PATH . '/vendor/autoload.php';
	}

	require EASY_DOCS_PATH . '/includes/plugin.php';

	//require_once EASY_DOCS_PATH . '/classes/class-easy-doc-loader.php';
}

/**
 * Shows Admin Notice for PHP compatibility.
 *
 * Function is used when the installed PHP is incompatible with the plugin to
 * show an Admin Notice informing the user that the PHP version is incompatible
 * with the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */

function notice_php_version() {

	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'EasyDocs requires PHP version %s+, plugin is currently NOT RUNNING.', 'easy-docs' ), '5.6' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );

}

/**
 * Shows admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.0.0
 *
 * @return void
 */
function notice_wp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( 'EasyDocs requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'easy-docs' ), '5.0' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}
