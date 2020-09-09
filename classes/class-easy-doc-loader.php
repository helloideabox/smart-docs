<?php
/**
 * Responsible for setting up constants, classes and templates.
 *
 * @author  IdeaBox
 * @package EasyDoc/Loader
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All function loads from this class Easy_Doc_Loader.
 */
class  Easy_Doc_Loader {

	/**
	 * Custom post type variable for registering taxonomy.

	 * @var post_type
	 */
	public $cpt_name = 'easy-doc';

	/**
	 * For automatically loading action and filters.
	 */
	public function __construct() {
		// Calling private load files function.
		$this->load_files();

		// For overriding templates.
		$this->callback_init();

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt_doc_type' ) );

		// Filter to rewrite the default archive theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'archive_template' ) );

		// Action to register settings page menu in cpt(easy-doc).
		add_action( 'admin_menu', array( $this, 'register_options_menu' ) );

		// Action to include script for admin options page.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );

		// Action to register setting for get_option function.
		add_action( 'init', array( $this, 'register_plugin_settings' ) );

		// To load search results from ajax request.
		add_action( 'wp_ajax_ed_load_search_results', array( $this, 'ed_load_search_results' ) );
		add_action( 'wp_ajax_nopriv_ed_load_search_results', array( $this, 'ed_load_search_results' ) );
	}

	/**
	 * Function to enque scripts.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		global $post_type;

		if ( 'easy-doc' === $post_type ) {
			wp_enqueue_style( 'ed-style', EASY_DOC_URL . 'assets/css/style.css', array(), '1.0.0', false );

			// condition to check for live search enabled.
			if ( get_option( 'ed_enable_live_search' ) ) {
				wp_enqueue_script( 'ed-searchbox-script', EASY_DOC_URL . 'assets/js/search-script.js', array(), '1.0.0', true );

				wp_localize_script(
					'ed-searchbox-script',
					'ed_ajax_url',
					array(
						'url'        => admin_url( 'admin-ajax.php' ),
						'ajax_nonce' => wp_create_nonce( 'docs_search' ),
					)
				);
			}
		}
	}

	/**
	 * For render the search result.
	 */
	public function ed_load_search_results() {
		// Checking for correct ajax request.
		if ( check_ajax_referer( 'docs_search', 'security' ) ) {
			if ( isset( $_POST['query'] ) && ! empty( $_POST['query'] ) ) {
				$query = sanitize_text_field( wp_unslash( $_POST['query'] ) );
			} else {
				$query = esc_html__( 'No docs found', 'easydoc' );
			}
		} else {
			esc_attr_e( 'Nonce is invalid', 'easydoc' );
		}

		// To show which post to show.
		$selected_post_types = get_option( 'ed_post_type_selected' );
		$selected_post_types = ! $selected_post_types ? array( 'post', 'page' ) : $selected_post_types;

		// WordPress Query arguments.
		$query_args = array(
			'post_type'   => $selected_post_types,
			'post_status' => 'publish',
			's'           => $query,
		);

		$search_results = new WP_Query( $query_args );

		ob_start();
		?>

		<ul class="ed-search-result">

			<?php
			if ( $search_results->have_posts() ) :
				while ( $search_results->have_posts() ) :
					$search_results->the_post();
					?>
					<li class="ed-search-list">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
					<?php
				endwhile;
			else :
				esc_attr_e( 'No Doc was found', 'easydoc' );
			endif;
			?>

		</ul>
		<?php

		wp_reset_postdata();
		$content = ob_get_clean();

		echo $content;

		// To remove 0 appending at the end of the response.
		wp_die();
	}

	/**
	 * Function to enque admin side script(Settings page).
	 *
	 * @param string $hook To check if the current page is easy doc setting or not.
	 * @return void
	 */
	public function enqueue_admin_script( $hook ) {
		// To check if the current page is easy doc setting or not.
		if ( 'easy-doc_page_easy_doc_settings' !== $hook ) {
			return;
		}

		wp_enqueue_script( 'ed-option-react-script', EASY_DOC_URL . 'build/admin.js', array( 'wp-api', 'wp-element', 'wp-components', 'wp-i18n', 'wp-data', 'wp-core-data' ), '1.0.0', true );
		wp_enqueue_style( 'ed-option-react-style', EASY_DOC_URL . 'build/admin.css', array( 'wp-components' ), '1.0.0' );

		// To get all the registered post types.
		$post_types = get_post_types(
			array(
				'public' => true,
			),
			'objects'
		);

		$types = array();

		foreach ( $post_types as $type ) {
			$types[ $type->name ] = $type->labels->name;
		}

		// Localising the script or creating global variable in script to send the number of post types created through ajax.
		wp_localize_script(
			'ed-option-react-script',
			'ed_vars',
			array(
				'url'        => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'docs_option' ),
				'post_types' => $types,
			)
		);
	}



	/**
	 * Function to create custom post type (easy-doc).
	 *
	 * @return void
	 */
	public function register_cpt_doc_type() {

		// Registering Custom post type(easy doc).
		$labels = array(
			'name'               => _x( 'Easy Docs', 'Post type general name', 'easydoc' ),
			'singular_name'      => _x( 'Easy Doc', 'Post type singular name', 'easydoc' ),
			'menu_name'          => _x( 'Easy Docs', 'Admin Menu text', 'easydoc' ),
			'name_admin_bar'     => _x( 'Doc', 'Admin Menu Toolbar text', 'easydoc' ),
			'add_new'            => __( 'Add New', 'easydoc' ),
			'add_new_item'       => __( 'Add New Doc', 'easydoc' ),
			'new_item'           => __( 'Add New Doc', 'easydoc' ),
			'view_item'          => __( 'View Doc', 'easydoc' ),
			'edit_item'          => __( 'Edit Doc', 'easydoc' ),
			'all_items'          => __( 'All Docs', 'easydoc' ),
			'search_items'       => __( 'Search Docs', 'easydoc' ),
			'parent_item_colon'  => __( 'Parent Docs', 'easydoc' ),
			'not_found'          => __( 'No Docs found.', 'easydoc' ),
			'not_found_in_trash' => __( 'No Docs found in Trash.', 'easydoc' ),
			'item_published'     => __( 'New Doc Published.', 'easydoc' ),
			'item_updated'       => __( 'Doc post updated.', 'easydoc' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'exclude_from_search' => false,
			'has_archive'         => true,
			'menu_position'       => null,
			'show_in_rest'        => true, // For accessing the cpt in wp rest api.
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions', 'custom-fields' ),
		);

		register_post_type( $this->cpt_name, $args );

		// Resgistering Custom categories taxonomy.
		$category_labels = array(
			'name'              => esc_html__( 'Docs Categories', 'easydoc' ),
			'singular_name'     => esc_html__( 'Doc Category', 'easydoc' ),
			'all_items'         => esc_html__( 'Docs Categories', 'easydoc' ),
			'parent_item'       => esc_html__( 'Parent category', 'easydoc' ),
			'parent_item_colon' => esc_html__( 'Parent category', 'easydoc' ),
			'edit_item'         => esc_html__( 'Edit Category', 'easydoc' ),
			'update_item'       => esc_html__( 'Update Category', 'easydoc' ),
			'add_new_item'      => esc_html__( 'Add New Docs Category', 'easydoc' ),
			'new_item_name'     => esc_html__( 'New Docs Name', 'easydoc' ),
			'menu_name'         => esc_html__( 'Categories', 'easydoc' ),
			'search_items'      => esc_html__( 'Search Categories', 'easydoc' ),
		);

		$category_args = array(
			'hierarchical'      => true,
			'public'            => true,
			'labels'            => $category_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'easydoc_category', $this->cpt_name, $category_args );

		// Resgistering Custom tag taxonomy.
		$tag_labels = array(
			'name'                       => __( 'Docs tags', 'easydoc' ),
			'singular_name'              => __( 'Doc Tag', 'easydoc' ),
			'menu_name'                  => _x( 'Tags', 'Admin menu name', 'easydoc' ),
			'search_items'               => __( 'Search tags', 'easydoc' ),
			'all_items'                  => __( 'All tags', 'easydoc' ),
			'edit_item'                  => __( 'Edit tag', 'easydoc' ),
			'update_item'                => __( 'Update tag', 'easydoc' ),
			'add_new_item'               => __( 'Add new tag', 'easydoc' ),
			'new_item_name'              => __( 'New tag name', 'easydoc' ),
			'popular_items'              => __( 'Popular tags', 'easydoc' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'easydoc' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'easydoc' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'easydoc' ),
			'not_found'                  => __( 'No tags found', 'easydoc' ),
		);

		$tag_args = array(
			'hierarchical'      => false,
			'query_var'         => true,
			'public'            => true,
			'labels'            => $tag_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
		);

		register_taxonomy( 'easydoc_tag', $this->cpt_name, $tag_args );
	}



	/**
	 * Registers option menu for easy doc(setting).
	 *
	 * @return void
	 */
	public function register_options_menu() {
		// Adding sub menu to the cpt.
		add_submenu_page(
			'edit.php?post_type=easy-doc', // Parent slug.
			__( 'Settings', 'easydoc' ), // Page title.
			__( 'Settings', 'easydoc' ), // Menu title.
			'manage_options', // Capability.
			'easy_doc_settings', // Menu slug.
			array( $this, 'render_options_page' ) // Callback function.
		);
	}


	/**
	 * Includes options page from react.
	 *
	 * @return void
	 */
	public function render_options_page() {
		echo '<div id="ed-setting-root"></div>';
	}



	/**
	 * For registering settings in rest api(wp.api.model.Settings).
	 *
	 * @return void
	 */
	public function register_plugin_settings() {
		register_setting(
			'easy-doc-settings-group',
			'ed_archive_page_title',
			array(
				'type'         => 'string',
				'show_in_rest' => true,
				'default'      => 'Docs',
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_post_type_selected',
			array(
				'show_in_rest' => array(
					'schema' => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'string',
						),
					),
				),
				'default'      => array( 'easy-doc' ),
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_enable_single_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_enable_category_and_tag_template',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_turnoff_doc_comment',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => false,
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_enable_live_search',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);

		register_setting(
			'easy-doc-settings-group',
			'ed_show_last_update_time',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => true,
			)
		);
	}



	/**
	 * Callback function for overide templates.
	 *
	 * @category InitCallBack
	 * @return void
	 */
	public function callback_init() {

		$is_single_template_on      = get_option( 'ed_enable_single_template' );
		$is_cat_and_tag_template_on = get_option( 'ed_enable_category_and_tag_template' );

		if ( '1' == $is_single_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default single theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'single_template' ) );
			add_filter( 'body_class', array( $this, 'body_single_class' ) );
		}

		if ( '1' == $is_cat_and_tag_template_on ) {// phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison

			// Filter to rewrite the default taxonomy(easydoc_category) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'category_template' ) );

			// Filter to rewrite the default taxonomy(easydoc_tag) theme template for particular cpt.
			add_filter( 'template_include', array( $this, 'tag_template' ) );
			add_filter( 'body_class', array( $this, 'body_tax_class' ) );
			add_filter( 'body_class', array( $this, 'body_sidebar_class' ) );
		}

	}


	/**
	 * Add Custom Class Single if their template is included to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_single_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_singular( $this->cpt_name ) && is_array( $classes ) ) {
			$cls = array_merge( $classes, array( 'docs-single-template-enabled' ) );
			return $cls;
		}
			return $classes;
	}

	/**
	 * Add Custom Class Category and Tag Taxonomy if their template is included to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_tax_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'easydoc_category' ) || is_tax( 'easydoc_tag' ) && is_array( $classes ) ) {
			$cls = array_merge( $classes, array( 'docs-tax-templates-enabled' ) );
			return $cls;
		}
			return $classes;
	}

	/**
	 * Add Custom Class Sidebar to body tag in html.
	 *
	 * @param    array $classes It will add class to the body doc post.
	 * @return   $classes
	 */
	public function body_sidebar_class( $classes ) {

		if ( is_post_type_archive( $this->cpt_name ) || is_tax( 'easydoc_category' ) || is_tax( 'easydoc_tag' ) && is_array( $classes ) ) {

			if ( is_active_sidebar( 'easy-doc-sidebar-1' ) ) {
				// Add clss to body.
				$cls = array_merge( $classes, array( 'easy-doc-sidebar-1' ) );
				return $cls;
			}
		}
			return $classes;
	}





	/**
	 * Function for custom template for custom post type.
	 *
	 * @param mixed $template rewriting template archive post.
	 * @return $template
	 */
	public function archive_template( $template ) {
		if ( is_post_type_archive( $this->cpt_name ) ) {
			$theme_files     = array( 'easy-doc-archive-template.php', '../templates/easy-doc-archive-template.php' );
			$exists_in_theme = locate_template( $theme_files, false );

			if ( '' !== $exists_in_theme ) {
				return $exists_in_theme;
			} else {
				return EASY_DOC_PATH . 'templates/easy-doc-archive-template.php';
			}
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 * @return $template
	 */
	public function category_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'easydoc_category' ) ) {
			return EASY_DOC_PATH . 'templates/taxonomy-easy-doc-cat.php';
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 * @return $template
	 */
	public function tag_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'easydoc_tag' ) ) {
			return EASY_DOC_PATH . 'templates/taxonomy-easy-doc-tag.php';
		}
		return $template;
	}


	/**
	 * Single post Callback Function.
	 *
	 * @param array $template Overide single template.
	 * @return $template
	 */
	public function single_template( $template ) {
		// Checking if the page is single and post type is of custom cpt(easy-doc).
		if ( is_singular( $this->cpt_name ) ) {
			return EASY_DOC_PATH . 'templates/easy-doc-single-template.php';
		}
		return $template;
	}


	/**
	 * Loads classes and templates.
	 *
	 * @since  1.0
	 * @return void
	 */
	private function load_files() {

		include_once EASY_DOC_PATH . 'templates/easy-doc-shortcode.php';
		include_once EASY_DOC_PATH . 'classes/class-easy-doc-widget.php';
		include_once EASY_DOC_PATH . 'classes/class-easy-doc-cat-widget.php';
	}
}

$easydoc = new Easy_Doc_Loader();
