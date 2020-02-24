<?php
/**
 * Responsible for setting up constants, classes and includes.
 *
 * @author  IdeaBox
 * @package Documentation/Loader
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

		// Action to include script.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt_doc_type' ) );

		// Filter to rewrite the default archive theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'custom_post_type_archive_template' ) );

		// Filter to rewrite the default taxonomy(easydoc_category) theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'custom_category_template' ) );

		// Filter to rewrite the default single theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'custom_single_template' ) );

		// Filter to rewrite the default taxonomy(easydoc_tag) theme template for particular cpt.
		add_filter( 'template_include', array( $this, 'custom_tag_template' ) );
	}

	/**
	 * Function to enque scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'ed-style', plugins_url( '../assets/css/style.css', __FILE__ ), array(), '1.0.0', false );

		wp_enqueue_script( 'ed-script', plugins_url( '../assets/js/script.js', __FILE__ ), array(), '1.0.0', true );

		wp_enqueue_script( 'ed-searchbox-script', plugins_url( '../assets/js/search-script.js', __FILE__ ), array(), '1.0.0', true );

		wp_localize_script(
			'ed-searchbox-script',
			'ed_ajax_url',
			array(
				'url'        => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'docs_search' ),
			)
		);
	}



	/**
	 * Function to create custom post type (easy-doc).
	 */
	public function register_cpt_doc_type() {

		// Registering Custom post type(easy doc).
		$labels = array(
			'name'               => _x( 'Docs', 'Post type general name', 'easydoc' ),
			'singular_name'      => _x( 'Doc', 'Post type singular name', 'easydoc' ),
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
		);

		register_taxonomy( 'easydoc_tag', $this->cpt_name, $tag_args );
	}



	/**
	 * Function for custom template for custom post type.
	 *
	 * @param mixed $template rewriting template archive post.
	 */
	public function custom_post_type_archive_template( $template ) {
		if ( is_post_type_archive( $this->cpt_name ) ) {
			$theme_files     = array( 'easy-doc-archive-template.php', '../includes/easy-doc-archive-template.php' );
			$exists_in_theme = locate_template( $theme_files, false );

			if ( '' !== $exists_in_theme ) {
				return $exists_in_theme;
			} else {
				return plugin_dir_path( __FILE__ ) . '../includes/easy-doc-archive-template.php';
			}
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 */
	public function custom_category_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'easydoc_category' ) ) {
			return plugin_dir_path( __FILE__ ) . '../includes/taxonomy-easy-doc-cat.php';
		}
		return $template;
	}

	/**
	 * Taxonomy Callback Function.
	 *
	 * @param array $template Overide taxonomy template.
	 */
	public function custom_tag_template( $template ) {
		// Checking for particular taxonomy.
		if ( is_tax( 'easydoc_tag' ) ) {
			return plugin_dir_path( __FILE__ ) . '../includes/taxonomy-easy-doc-tag.php';
		}
		return $template;
	}


	/**
	 * Single post Callback Function.
	 *
	 * @param array $template Overide single template.
	 */
	public function custom_single_template( $template ) {
		// Checking if the page is single and post type is of custom cpt(easy-doc).
		if ( is_single() && 'easy-doc' === get_post_type() ) {
			return plugin_dir_path( __FILE__ ) . '../includes/easy-doc-single-template.php';
		}
		return $template;
	}


	/**
	 * Loads classes and includes.
	 *
	 * @since  1.0
	 * @return void
	 */
	private function load_files() {

		include_once plugin_dir_path( __FILE__ ) . '../includes/easy-doc-shortcode.php';
		include_once plugin_dir_path( __FILE__ ) . 'class-easy-doc-widget.php';
		include_once plugin_dir_path( __FILE__ ) . 'class-easy-doc-cat-widget.php';
	}
}

$easydoc = new Easy_Doc_Loader();
