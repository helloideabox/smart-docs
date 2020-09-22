<?php
namespace EasyDocs;

/**
 * Cpt Manager Class.
 * 
 * Responsible for creating Custom Post Type.
 *
 * @since 1.0.0
 * @package EasyDocs
 */

class Cpt {

	/**
	 * Custom post type variable for registering taxonomy.

	 * @var post_type
	 */
	public $cpt_name = 'easy-doc';

	public function __construct() {
		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt_doc_type' ) );
	}

	public function register_cpt_doc_type() {

		// Registering Custom post type(easy doc).
		$labels = array(
			'name'               => _x( 'Easy Docs', 'Post type general name', 'easy-docs' ),
			'singular_name'      => _x( 'Easy Doc', 'Post type singular name', 'easy-docs' ),
			'menu_name'          => _x( 'Easy Docs', 'Admin Menu text', 'easy-docs' ),
			'name_admin_bar'     => _x( 'Doc', 'Admin Menu Toolbar text', 'easy-docs' ),
			'add_new'            => __( 'Add New', 'easy-docs' ),
			'add_new_item'       => __( 'Add New Doc', 'easy-docs' ),
			'new_item'           => __( 'Add New Doc', 'easy-docs' ),
			'view_item'          => __( 'View Doc', 'easy-docs' ),
			'edit_item'          => __( 'Edit Doc', 'easy-docs' ),
			'all_items'          => __( 'All Docs', 'easy-docs' ),
			'search_items'       => __( 'Search Docs', 'easy-docs' ),
			'parent_item_colon'  => __( 'Parent Docs', 'easy-docs' ),
			'not_found'          => __( 'No Docs found.', 'easy-docs' ),
			'not_found_in_trash' => __( 'No Docs found in Trash.', 'easy-docs' ),
			'item_published'     => __( 'New Doc Published.', 'easy-docs' ),
			'item_updated'       => __( 'Doc post updated.', 'easy-docs' ),
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
			'name'              => esc_html__( 'Docs Categories', 'easy-docs' ),
			'singular_name'     => esc_html__( 'Doc Category', 'easy-docs' ),
			'all_items'         => esc_html__( 'Docs Categories', 'easy-docs' ),
			'parent_item'       => esc_html__( 'Parent category', 'easy-docs' ),
			'parent_item_colon' => esc_html__( 'Parent category', 'easy-docs' ),
			'edit_item'         => esc_html__( 'Edit Category', 'easy-docs' ),
			'update_item'       => esc_html__( 'Update Category', 'easy-docs' ),
			'add_new_item'      => esc_html__( 'Add New Docs Category', 'easy-docs' ),
			'new_item_name'     => esc_html__( 'New Docs Name', 'easy-docs' ),
			'menu_name'         => esc_html__( 'Categories', 'easy-docs' ),
			'search_items'      => esc_html__( 'Search Categories', 'easy-docs' ),
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
			'name'                       => __( 'Docs tags', 'easy-docs' ),
			'singular_name'              => __( 'Doc Tag', 'easy-docs' ),
			'menu_name'                  => _x( 'Tags', 'Admin menu name', 'easy-docs' ),
			'search_items'               => __( 'Search tags', 'easy-docs' ),
			'all_items'                  => __( 'All tags', 'easy-docs' ),
			'edit_item'                  => __( 'Edit tag', 'easy-docs' ),
			'update_item'                => __( 'Update tag', 'easy-docs' ),
			'add_new_item'               => __( 'Add new tag', 'easy-docs' ),
			'new_item_name'              => __( 'New tag name', 'easy-docs' ),
			'popular_items'              => __( 'Popular tags', 'easy-docs' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'easy-docs' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'easy-docs' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'easy-docs' ),
			'not_found'                  => __( 'No tags found', 'easy-docs' ),
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
}

// $easyDocCPT = new Easy_Doc_CPT();
