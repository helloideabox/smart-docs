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
	public $post_type = 'smart-doc';

	public function __construct() {
		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt_doc_type' ) );
		add_action( 'init', array( $this, 'taxonomy_thumbnail_hooks' ) );

		add_action( 'admin_init', array( $this, 'taxonomy_thumbnail_hooks' ) );
		add_action( 'admin_print_scripts', array( $this, 'taxonomy_admin_scripts' ) );
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

		register_post_type( $this->post_type, $args );

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

		register_taxonomy( 'smartdocs_category', $this->post_type, $category_args );

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

		register_taxonomy( 'smartdocs_tag', $this->post_type, $tag_args );

		flush_rewrite_rules();
	}

	public function taxonomy_admin_scripts() {
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		wp_enqueue_script( 'smartdocs-taxonomy-thumbnail-upload', SMART_DOCS_URL . '/assets/js/admin/taxonomy-thumbnail.js', array( 'jquery' ), null, false );
	}

	public function taxonomy_admin_styles() {
		?>
		<style>
			.column-taxonomy_thumbnail {
				width: 80px;
			}
		</style>
		<?php
	}

	/**
	 * Dynamically create hooks for each taxonomy for edit page.
	 *
	 * Adds hooks for each taxonomy that the user has selected
	 * via settings page. These hooks
	 * enable the image interface on wp-admin/edit-tags.php.
	 *
	 * @since 1.4.13
	 */
	public function taxonomy_thumbnail_hooks() {

		$taxonomy_thumbnail_enable = 'enabled';
		$taxonomy                  = 'smartdocs_category';

		if ( 'enabled' === $taxonomy_thumbnail_enable ) {
				add_filter( 'manage_' . $taxonomy . '_custom_column', array( $this, 'taxonomy_thumbnail_taxonomy_rows' ), 15, 3 );
				add_filter( 'manage_edit-' . $taxonomy . '_columns', array( $this, 'taxonomy_thumbnail_taxonomy_columns' ) );
				add_action( $taxonomy . '_edit_form_fields', array( $this, 'taxonomy_thumbnail_edit_tag_form' ), 10, 2 );
				add_action( $taxonomy . '_add_form_fields', array( $this, 'taxonomy_thumbnail_add_tag_form' ), 10 );
				add_action( 'edit_term', array( $this, 'taxonomy_thumbnail_save_term' ), 10, 3 );
				add_action( 'create_term', array( $this, 'taxonomy_thumbnail_save_term' ), 10, 3 );
		}
	}

	/**
	 * Save Edited Term.
	 *
	 * @see taxonomy_thumbnail_hooks()
	 *
	 * @param array A list of columns.
	 * @return array List of columns with "Images" inserted after the checked.
	 * @since 1.0.0
	 */
	public function taxonomy_thumbnail_save_term( $term_id, $tt_id, $taxonomy ) {
		if ( isset( $_POST['taxonomy_thumbnail_id'] ) ) {
			update_term_meta( $term_id, 'taxonomy_thumbnail_id', sanitize_text_field( $_POST['taxonomy_thumbnail_id'] ) );
		}
	}

	/**
	 * Edit Term Columns.
	 *
	 * Insert a new column on wp-admin/edit-tags.php.
	 *
	 * @see taxonomy_thumbnail_hooks()
	 *
	 * @param array A list of columns.
	 * @return array List of columns with "Images" inserted after the checked.
	 * @since 1.0.0
	 */
	public function taxonomy_thumbnail_taxonomy_columns( $original_columns ) {
		$new_columns = $original_columns;
		array_splice( $new_columns, 1 );
		$new_columns['taxonomy_thumbnail'] = esc_html__( 'Image', 'smart-docs' );
		return array_merge( $new_columns, $original_columns );
	}

	/**
	 * Edit Term Rows.
	 *
	 * Create image control for each term row of wp-admin/edit-tags.php.
	 *
	 * @see taxonomy_thumbnail_hooks()
	 *
	 * @param string    Row.
	 * @param string    Name of the current column.
	 * @param int   Term ID.
	 * @return    string    @see taxonomy_thumbnail_control_image()
	 * @since 1.4.13
	 */
	public function taxonomy_thumbnail_taxonomy_rows( $row, $column_name, $term_id ) {
		if ( 'taxonomy_thumbnail' === $column_name ) {
			$html                  = '<div id="taxonomy_thumbnail_preview">';
			$taxonomy_thumbnail_id = '';
			$taxonomy_thumbnail_id = get_term_meta( $term_id, 'taxonomy_thumbnail_id', true );
			if ( '' !== $taxonomy_thumbnail_id ) {
				$obj_taxonomy_thumbnail = wp_get_attachment_image_src( $taxonomy_thumbnail_id, 'thumbnail' );
				if ( ! empty( $obj_taxonomy_thumbnail ) ) {
					$taxonomy_thumbnail_img_url = $obj_taxonomy_thumbnail[0];

					$html .= '<img id="taxonomy_thumbnail_preview_img" width="50" height="50" src="' . $taxonomy_thumbnail_img_url . '" >';
				}
			}
			$html .= '</div>';
			return $row . $html;
		}
		return $row;
	}

	/**
	 * Edit Term Control.
	 *
	 * Create image control for wp-admin/edit-tag-form.php.
	 * Hooked into the $taxonomy. '_edit_form_fields' action.
	 *
	 * @param stdClass  Term object.
	 * @param string    Taxonomy slug.
	 * @since 1.4.13
	 */
	public function taxonomy_thumbnail_edit_tag_form( $term, $taxonomy ) {
		$taxonomy = get_taxonomy( $taxonomy );
		$name     = __( 'term', 'powerpack' );
		if ( isset( $taxonomy->labels->singular_name ) ) {
			$name = strtolower( $taxonomy->labels->singular_name );
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php print esc_html__( 'Featured Image', 'powerpack' ); ?></label></th>
			<td>
				<div id="taxonomy_thumbnail_preview">
				<?php
				$taxonomy_thumbnail_id = '';
				$taxonomy_thumbnail_id = get_term_meta( $term->term_id, 'taxonomy_thumbnail_id', true );
				if ( '' !== $taxonomy_thumbnail_id ) {
					$obj_taxonomy_thumbnail = wp_get_attachment_image_src( $taxonomy_thumbnail_id, 'thumbnail' );
					if ( ! empty( $obj_taxonomy_thumbnail ) ) {
						$taxonomy_thumbnail_img_url = $obj_taxonomy_thumbnail[0];
						?>
						<img id="taxonomy_thumbnail_preview_img" width="150" height="150" src="<?php echo $taxonomy_thumbnail_img_url; ?>" ><br>
						<?php
					}
				}
				?>
				</div>
				<input id="taxonomy_thumbnail_id" type="hidden" name="taxonomy_thumbnail_id" value="<?php echo $taxonomy_thumbnail_id; ?>" />
				<input id="upload_taxonomy_thumbnail_button" type="button" class="button button-primary" value="<?php echo esc_html__( 'Upload', 'powerpack' ); ?>" />
				<?php
				$delete_button_inline_css = 'display:none';
				if ( '' !== $taxonomy_thumbnail_id ) {
					$delete_button_inline_css = '';
				}
				?>
				<input style="<?php echo $delete_button_inline_css; ?>" id="delete_taxonomy_thumbnail_button" type="button" class="button button-danger" value="<?php echo esc_html__( 'Delete', 'powerpack' ); ?>" />
				<div class="clear"></div>
				<?php
				// translators: %1$s for label.
				?>
				<span class="description"><?php printf( esc_html__( 'Add an image from media library to this %1$s.', 'powerpack' ), esc_html( $name ) ); ?></span>
			</td>
		</tr>
		<?php
	}

	public function taxonomy_thumbnail_add_tag_form( $taxonomy ) {
		$taxonomy = get_taxonomy( $taxonomy );
		$name     = __( 'term', 'powerpack' );
		if ( isset( $taxonomy->labels->singular_name ) ) {
			$name = strtolower( $taxonomy->labels->singular_name );
		}
		?>
		<div class="form-field term-thumbnail-wrap">
			<label for="description"><?php print esc_html__( 'Featured Image', 'powerpack' ); ?></label>
			<div id="taxonomy_thumbnail_preview">
			</div>
			<input id="taxonomy_thumbnail_id" type="hidden" name="taxonomy_thumbnail_id" value="" />
			<input id="upload_taxonomy_thumbnail_button" type="button" class="button button-primary" value="<?php echo esc_html__( 'Upload', 'powerpack' ); ?>" />
			<?php
				$delete_button_inline_css = 'display:none';
			?>
			<input style="<?php echo $delete_button_inline_css; ?>" id="delete_taxonomy_thumbnail_button" type="button" class="button button-danger" value="<?php echo esc_html__( 'Delete', 'powerpack' ); ?>" />
			<div class="clear"></div>
			<?php
				// translators: %1$s for label.
			?>
			<span class="description"><?php printf( esc_html__( 'Add an image from media library to this %1$s.', 'powerpack' ), esc_html( $name ) ); ?></span>
		</div>
		<?php
	}
}
