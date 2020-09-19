<?php

/**
 * Responsible for creating Custom Post Type
 *
 * @author IdeaBox
 * @package EasyDoc
 */

class Easy_Doc_CPT {

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
}

// $easyDocCPT = new Easy_Doc_CPT();
