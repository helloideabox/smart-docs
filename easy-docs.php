<?php
/**
 * Plugin Name: Easy Docs
 * Plugin URI: https://ideabox.io/
 * Author: IdeaBox
 * Author URI: https://ideabox.io
 * Version: 1.0.0
 * Description: Simple Documentation plugin for WordPress.
 * Text Domain: easydoc
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EASY_DOC_PATH', plugin_dir_path( __FILE__ ) );
define( 'EASY_DOC_URL', plugin_dir_url( __FILE__ ) );

// Including class doc loader.
require_once 'classes/class-easy-doc-loader.php';
