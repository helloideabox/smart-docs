<?php
/**
 * SmartDocs Admin.
 *
 * Responsible for registering plugin settings, rendering admin menu, etc.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Admin Class.
 */
class Admin {
	/**
	 * Constructor.
	 */
	public function __construct() {
		// Register plugin setting.
		add_action( 'init', array( $this, 'register_plugin_settings' ) );

		// Register settings page menu under custom post type.
		add_action( 'admin_menu', array( $this, 'register_options_menu' ) );

		// Add admin bar menu.
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 50 );

		// Enqueue scripts.
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Remove all Admin Notices from the setting page.
		if ( is_admin() && isset( $_GET['page'] ) && 'smart_docs_settings' === wp_unslash( $_GET['page'] ) ) { // @codingStandardsIgnoreLine.
			add_action( 'in_admin_header', array( $this, 'remove_all_notices' ), PHP_INT_MAX );
		}
	}

	/**
	 * Registers SmartDocs setting menu.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_options_menu() {
		global $submenu;

		// Adding sub menu to the cpt.
		add_submenu_page(
			'edit.php?post_type=smart-docs', // Parent slug.
			__( 'Settings', 'smart-docs' ), // Page title.
			__( 'Settings', 'smart-docs' ), // Menu title.
			'manage_options', // Capability.
			'smart_docs_settings', // Menu slug.
			array( $this, 'render_settings_content' ) // Callback function.
		);

		$submenu['edit.php?post_type=smart-docs'][20] = array(
			__( 'Customize', 'smart-docs' ),
			'customize',
			admin_url( 'customize.php?url=' . smartdocs_get_docs_page_link() . '&autofocus[panel]=smartdocs_style_options' ),
		);
	}

	/**
	 * Renders content for the settings page.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function render_settings_content() {
		echo '<div id="smartdocs-setting-root"></div>';
	}

	/**
	 * Registers plugin settings.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function register_plugin_settings() {
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_hero_title',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => esc_html__( 'Documentation', 'smart-docs' ),
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_hero_description',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => '',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_use_built_in_doc_archive',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_custom_doc_page',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'		=> '',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_archive_page_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'docs',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_category_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'docs-category',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_enable_single_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_enable_taxonomy_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_support_page_url',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => '',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'smartdocs_search_post_types',
			array(
				'type'         => 'array',
				'show_in_rest' => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'string',
						),
					),
				),
				'default'      => array( 'smart-docs' ),
			)
		);
	}

	/**
	 * Enqueue scripts on SmartDocs settings page.
	 *
	 * @since 1.0.0
	 * @param string $hook Current page slug.
	 * @throws Error Warn user regarding a process that is mandatory.
	 * @return void
	 */
	public function admin_enqueue_scripts( $hook ) {
		// To check if the current page is SmartDocs setting or not.
		if ( 'smart-docs_page_smart_docs_settings' !== $hook ) {
			return;
		}

		$dir = SMART_DOCS_PATH;

		$script_asset_path = "$dir/assets/admin/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				__( 'You need to run `npm start` or `npm run build` first.', 'smart-docs' )
			);
		}

		$index_js     = 'assets/admin/index.js';
		$script_asset = require $script_asset_path;

		wp_enqueue_script(
			'smartdocs-settings',
			SMART_DOCS_URL . $index_js,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		$editor_css = 'assets/admin/index.css';

		wp_enqueue_style(
			'smartdocs-settings-style',
			SMART_DOCS_URL . $editor_css,
			array( 'wp-components' ),
			filemtime( "$dir/$editor_css" )
		);

		wp_localize_script(
			'smartdocs-settings',
			'smartdocs_admin',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'docs_option' ),
				'version'    => SMART_DOCS_VERSION,
				'logo_url'	 => SMART_DOCS_URL . 'assets/images/smartdocs-logo.png',
				'customizer_url' => admin_url( 'customize.php?url=' . smartdocs_get_docs_page_link() . '&autofocus[panel]=smartdocs_style_options' )
			)
		);
	}

	/**
	 * Add Visit Documentation to Admin Bar Menu.
	 *
	 * @since 1.0.0
	 * @param Object $admin_bar Global variable.
	 */
	public function admin_bar_menu( $admin_bar ) {

		// Return if user is not an Admin or  Admin Bar is not visible.
		if ( ! is_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		// Return if user is not a member of the site and is not a Super Admin.
		if ( ! is_user_member_of_blog() && ! is_super_admin() ) {
			return;
		}

		$admin_bar->add_node(
			array(
				'parent' => 'site-name',
				'id'     => 'view-smartdocs',
				'title'  => __( 'Visit Documentation (SmartDocs)', 'smart-docs' ),
				'href'   => smartdocs_get_docs_page_link(),
			)
		);

	}

	/**
	 * Remove all notices from the setting page.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function remove_all_notices() {
		remove_all_actions( 'admin_notices' );
		remove_all_actions( 'all_admin_notices' );
	}
}
