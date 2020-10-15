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
			'edit.php?post_type=smart-doc', // Parent slug.
			__( 'Settings', 'smart-docs' ), // Page title.
			__( 'Settings', 'smart-docs' ), // Menu title.
			'manage_options', // Capability.
			'smart_doc_settings', // Menu slug.
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
		echo '<div id="sd-setting-root"></div>';
			echo '<div class="loader">
			<div class="sd-settings-pre-loader">
				<div class="sd-loader-header mx-auto flex justify-center justify-items-center p-10 mb-8 bg-white">
					<div class="header-loader"></div>
				</div>
				<div class="sd-loader-body container mx-auto grid grid-cols-3 grid-rows-2 w-full">
					<div class="sd-loader-panel m-5 col-span-2 row-span-2 p-5 bg-white">
						<div class="panel-loader"></div>
					</div>
					<div class="sd-loader-side-panel m-5 col-span-1">
						<div class="side-panel-loader"></div>
					</div>
				</div>
			</div>
		</div>
		';
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
			'sd_archive_page_title',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'Docs',
			)
		);

		/**
		 * Register setting for documentation root slug.
		 *
		 * When set the documentation archive page will be accessible at
		 * https://example.com/smart-docs/.
		 */

		register_setting(
			'smart-docs-settings-group',
			'sd_archive_page_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'smart-docs',
			)
		);

		/**
		 * Register documentation category slug.
		 */

		register_setting(
			'smart-docs-settings-group',
			'sd_category_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'smartdocs_category',
			)
		);

		/**
		 * Register documentation tag slug
		 */

		register_setting(
			'smart-docs-settings-group',
			'sd_tag_slug',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'smartdocs_tag',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'sd_enable_single_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'sd_enable_category_and_tag_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'sd_turnoff_doc_comment',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => false,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'sd_enable_live_search',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'sd_show_last_update_time',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
		$this->register_doc_homepage_settings();

		$this->register_single_page_layout_settings();

		$this->register_archive_page_layout_settings();

		$this->register_search_page_layout_settings();
	}

	/**
	 * Documentation Home Page Settings.*/
	protected function register_doc_homepage_settings() {

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_layout',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'list',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_count',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_authors',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_search',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		$this->register_doc_homepage_list_layout_settings();
		$this->register_doc_homepage_grid_layout_settings();
	}

	/**
	 * Documentation Home Page List Layout Settings.
	 * */
	protected function register_doc_homepage_list_layout_settings() {
		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_list_layout_columns',
			array(
				'type'         => 'number',
				'show_in_rest' => true,
				'default'      => '1',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_list_layout_icon',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
	}

	/**
	 * Documentation Home Page Grid Layout Settings.*/
	protected function register_doc_homepage_grid_layout_settings() {
		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_grid_layout_columns',
			array(
				'type'         => 'number',
				'show_in_rest' => true,
				'default'      => '1',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_doc_page_grid_layout_icon',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
	}

	/**
	 * Single Page Layout Settings.*/
	protected function register_single_page_layout_settings() {

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_page_sidebar',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_page_permalink',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_page_sidebar',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_page_breadcrumbs',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_page_comments',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_social_share_options',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_single_ratings',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
	}

	/**
	 * Archive Page Layout Settings.*/
	protected function register_archive_page_layout_settings() {

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_archive_sidebar',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_archive_layout',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'list',
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_archive_search',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_archive_suggested',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
	}

	/**
	 * Search Tab Layout Settings.*/
	protected function register_search_page_layout_settings() {

		register_setting(
			'smart-docs-settings-group',
			'ibx_sd_search_post_types',
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
				'default'      => array( 'smart-doc' ),
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
		if ( 'smart-doc_page_smart_doc_settings' !== $hook ) {
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
			'sd-settings',
			SMART_DOCS_URL . $index_js,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		$editor_css = 'assets/admin/index.css';

		wp_enqueue_style(
			'sd-settings-style',
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
			'sd-settings',
			'sd_vars',
			array(
				'url'        => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'docs_option' ),
				'post_types' => $types,
				'version'    => '1.0.0',
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

		$docs_slug = get_option( 'sd_archive_page_slug' );

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
