<?php
/**
 * Plugin Name: Smart Docs
 * Plugin URI: https://wpsmartdocs.com/
 * Description: Knowledge Base and Documentation plugin for WordPress.
 * Author: IdeaBox Creations
 * Author URI: https://ideabox.io/
 * Version: 1.0.2
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: smart-docs
 *
 * @package SmartDocs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SMART_DOCS_VERSION', '1.0.2' );
define( 'SMART_DOCS_PATH', plugin_dir_path( __FILE__ ) );
define( 'SMART_DOCS_URL', plugin_dir_url( __FILE__ ) );
define( 'SMART_DOCS_FILE', __FILE__ );

add_action( 'plugins_loaded', 'smartdocs_load_plugin_textdomain' );

/**
 * Check for the Compatibility.
 */
if ( ! version_compare( PHP_VERSION, '7.3', '>=' ) ) {
	/**
	 * Display admin notice for PHP version less than 7.3.
	 *
	 * @since 1.0.0
	 */
	add_action( 'admin_notices', 'smartdocs_notice_php_version' );

} elseif ( ! version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
	/**
	 * Display admin notice for WordPress version less than 5.0
	 *
	 * @since 1.0.0
	 */
	add_action( 'admin_notices', 'smartdocs_notice_wp_version' );

} else {
	/**
	 * Load the plugin.php file to run the plugin.
	 *
	 * @since 1.0.0
	 */
	require SMART_DOCS_PATH . 'classes/plugin.php';
}

/**
 * Load SmartDocs textdomain.
 *
 * Load gettext translate for SmartDocs text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */
function smartdocs_load_plugin_textdomain() {
	load_plugin_textdomain( 'smart-docs', false, basename( dirname( __FILE__ ) ) . '/languages/' );
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
function smartdocs_notice_php_version() {
	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'SmartDocs requires PHP version %s+, plugin is currently NOT RUNNING.', 'smart-docs' ), '7.3' );
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
function smartdocs_notice_wp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( 'SmartDocs requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'smart-docs' ), '5.0' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}
