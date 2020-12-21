<?php
/**
 * Plugin Settings Manager
 *
 * Responsible for registering plugin settings, rendering admin menu, etc.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

/**
 * Admin Class.
 *
 * @since 1.0.0
 */
class Admin {
	/**
	 * Construction fuction for class Admin
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Action to register setting for get_option function.
		add_action( 'init', array( $this, 'register_plugin_settings' ) );

		// Action to register settings page menu in cpt(smart-doc).
		add_action( 'admin_menu', array( $this, 'register_options_menu' ) );

		// Add admin bar menu.
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_menu' ), 50 );

		// Action to include script for admin options page.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );

		// Remove all Admin Notices.
		remove_all_actions( 'admin_notices' );
	}

	/**
	 * Registers option menu for SmartDocs Settings.
	 *
	 * @return void
	 */
	public function register_options_menu() {

		// Adding sub menu to the cpt.
		add_submenu_page(
			'edit.php?post_type=smart-docs', // Parent slug.
			__( 'Settings', 'smart-docs' ), // Page title.
			__( 'Settings', 'smart-docs' ), // Menu title.
			'manage_options', // Capability.
			'smart_docs_settings', // Menu slug.
			array( $this, 'render_options_page' ) // Callback function.
		);
	}

	/**
	 * Includes options page from react.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function render_options_page() {
		echo '<div id="smartdocs-setting-root"></div>';
	}

	/**
	 * For registering settings in rest api(wp.api.model.Settings).
	 *
	 * @return void
	 */
	public function register_plugin_settings() {
		/**
		 * Register settings for documentation archive/home page title
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_use_built_in_doc_archive',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		/**
		 * Register settings for documentation archive/home page title
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_custom_doc_page',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'		=> ''
			)
		);

		/**
		 * Register settings for documentation archive page title
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_archive_page_title',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => esc_html__( 'Documentation', 'smart-docs' ),
			)
		);

		/**
		 * Register settings for documentation archive page slug.
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_archive_page_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'docs',
			)
		);

		/**
		 * Register documentation category slug.
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_category_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'docs-category',
			)
		);

		/**
		 * Register documentation tag slug.
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_tag_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'docs-tag',
			)
		);

		/**
		 * Enable custom template for single doc page.
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_enable_single_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		/**
		 * Enable custom template for categories and tags archive page.
		 */
		register_setting(
			'smart-docs-settings-group',
			'smartdocs_enable_category_and_tag_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
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
	 * Function to enque admin side script(Settings page).
	 *
	 * @param string $hook To check if the current page is SmartDocs setting or not.
	 * @throws Error Warn user regarding a process that is mandatory.
	 * @return void
	 */
	public function enqueue_admin_script( $hook ) {
		// To check if the current page is SmartDocs setting or not.
		if ( 'smart-docs_page_smart_docs_settings' !== $hook ) {
			return;
		}

		$dir = SMART_DOCS_PATH;

		$script_asset_path = "$dir/assets/admin/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				'You need to run `npm start` or `npm run build` for the "create-block/docs2" block first.'
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

		$exclude_post_types = array( 'attachment', 'elementor_library' );

		// To get all the registered post types.
		$post_types = get_post_types(
			array(
				'public'             => true,
				'publicly_queryable' => true,
			),
			'objects'
		);

		$types = array();

		foreach ( $post_types as $type ) {

			if ( true === in_array( $type->name, $exclude_post_types, true ) ) {
				continue;
			}

			$types[ $type->name ] = $type->labels->name;
		}

		// Localising the script or creating global variable in script to send the number of post types created through ajax.
		wp_localize_script(
			'smartdocs-settings',
			'smartdocs_admin',
			array(
				'ajaxurl'    => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'docs_option' ),
				'post_types' => $types,
				'version'    => SMART_DOCS_VERSION,
			)
		);
	}

	/**
	 * Add Visit Documentation to Admin Bar Menu.
	 *
	 * @since 1.0.0
	 *
	 * @param Object $admin_bar Global variable.
	 */
	public function admin_bar_menu( $admin_bar ) {

		/**
		 * Return if user is not an Admin or  Admin Bar is not visible.
		 */

		if ( ! is_admin() || ! is_admin_bar_showing() ) {
			return;
		}

		/**
		 * Return if user is not a member of the site and is not a Super Admin.
		 */
		if ( ! is_user_member_of_blog() && ! is_super_admin() ) {
			return;
		}

		$docs_slug = get_option( 'smartdocs_archive_page_slug' );

		if ( empty( $docs_slug ) ) {
			$docs_slug = 'smart-docs';
		}

		$docs_home_url = home_url( $docs_slug );

		$admin_bar->add_node(
			array(
				'parent' => 'site-name',
				'id'     => 'view-smartdocs',
				'title'  => __( 'Visit Documentation (SmartDocs)', 'smart-docs' ),
				'href'   => $docs_home_url,
			)
		);

	}
}
