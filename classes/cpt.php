<?php
namespace SmartDocs;

/**
 * Cpt Manager Class.
 *
 * Responsible for creating Custom Post Type.
 *
 * @since 1.0.0
 * @package SmartDocs
 */

class Cpt {

	/**
	 * Custom post type variable for registering taxonomy.

	 * @var post_type
	 */
	public $cpt_name = 'smart-doc';

	public function __construct() {
		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt_doc_type' ) );
	}

	public function register_cpt_doc_type() {

		// Post Type Name

		// Registering Custom post type(SmartDocs).
		$labels = array(
			'name'               => _x( 'Smart Docs', 'Post type general name', 'smart-docs' ),
			'singular_name'      => _x( 'Smart Doc', 'Post type singular name', 'smart-docs' ),
			'menu_name'          => _x( 'Smart Docs', 'Admin Menu text', 'smart-docs' ),
			'name_admin_bar'     => _x( 'Doc', 'Admin Menu Toolbar text', 'smart-docs' ),
			'add_new'            => __( 'Add New', 'smart-docs' ),
			'add_new_item'       => __( 'Add New Doc', 'smart-docs' ),
			'new_item'           => __( 'Add New Doc', 'smart-docs' ),
			'view_item'          => __( 'View Doc', 'smart-docs' ),
			'edit_item'          => __( 'Edit Doc', 'smart-docs' ),
			'all_items'          => __( 'All Docs', 'smart-docs' ),
			'search_items'       => __( 'Search Docs', 'smart-docs' ),
			'parent_item_colon'  => __( 'Parent Docs', 'smart-docs' ),
			'not_found'          => __( 'No Docs found.', 'smart-docs' ),
			'not_found_in_trash' => __( 'No Docs found in Trash.', 'smart-docs' ),
			'item_published'     => __( 'New Doc Published.', 'smart-docs' ),
			'item_updated'       => __( 'Doc post updated.', 'smart-docs' ),
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

		$post_slug = get_option( 'ibx_sd_archive_page_slug' );

		if ( empty( $post_slug ) ) {
			$post_slug = 'smart-docs';
		}

		$args['rewrite'] = apply_filters( 'smartdocs_cpt_rewrite_slug', array( 'slug' => $post_slug ) );

		register_post_type( $this->cpt_name, $args );

		// Resgistering Custom Category's taxonomy.

		$category_labels = array(
			'name'              => esc_html__( 'Docs Categories', 'smart-docs' ),
			'singular_name'     => esc_html__( 'Doc Category', 'smart-docs' ),
			'all_items'         => esc_html__( 'Docs Categories', 'smart-docs' ),
			'parent_item'       => esc_html__( 'Parent category', 'smart-docs' ),
			'parent_item_colon' => esc_html__( 'Parent category', 'smart-docs' ),
			'edit_item'         => esc_html__( 'Edit Category', 'smart-docs' ),
			'update_item'       => esc_html__( 'Update Category', 'smart-docs' ),
			'add_new_item'      => esc_html__( 'Add New Docs Category', 'smart-docs' ),
			'new_item_name'     => esc_html__( 'New Docs Name', 'smart-docs' ),
			'menu_name'         => esc_html__( 'Categories', 'smart-docs' ),
			'search_items'      => esc_html__( 'Search Categories', 'smart-docs' ),
		);

		$category_args = array(
			'hierarchical'      => true,
			'public'            => true,
			'labels'            => $category_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
		);

		$category_slug = get_option( 'ibx_sd_category_slug' );

		if ( empty( $category_slug ) ) {
			$category_slug = 'smartdocs_category';
		}

		$category_args['rewrite'] = apply_filters( 'smartdocs_category_rewrite_slug', array( 'slug' => $category_slug ) );

		register_taxonomy( 'smartdocs_category', $this->cpt_name, $category_args );

		// Resgistering Custom tag taxonomy.
		$tag_labels = array(
			'name'                       => __( 'Docs tags', 'smart-docs' ),
			'singular_name'              => __( 'Doc Tag', 'smart-docs' ),
			'menu_name'                  => _x( 'Tags', 'Admin menu name', 'smart-docs' ),
			'search_items'               => __( 'Search tags', 'smart-docs' ),
			'all_items'                  => __( 'All tags', 'smart-docs' ),
			'edit_item'                  => __( 'Edit tag', 'smart-docs' ),
			'update_item'                => __( 'Update tag', 'smart-docs' ),
			'add_new_item'               => __( 'Add new tag', 'smart-docs' ),
			'new_item_name'              => __( 'New tag name', 'smart-docs' ),
			'popular_items'              => __( 'Popular tags', 'smart-docs' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'smart-docs' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'smart-docs' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'smart-docs' ),
			'not_found'                  => __( 'No tags found', 'smart-docs' ),
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

		$tag_slug = get_option( 'ibx_sd_tag_slug' );

		if ( empty( $tag_slug ) ) {
			$tag_slug = 'smartdocs_tag';
		}

		$tag_args['rewrite'] = apply_filters( 'smartdocs_tag_rewrite_slug', array( 'slug' => $tag_slug ) );

		register_taxonomy( 'smartdocs_tag', $this->cpt_name, $tag_args );

		flush_rewrite_rules();
	}
}
