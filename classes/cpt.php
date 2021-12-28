<?php
/**
 * Cpt Manager Class.
 *
 * Responsible for creating Custom Post Type.
 *
 * @package SmartDocs\Classes
 * @since 1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Cpt class.
 */
class Cpt {
	/**
	 * Docs post type.
	 *
	 * @var string $post_type
	 */
	public $post_type = 'smart-docs';

	/**
	 * Docs taxonomy.
	 *
	 * @var string $taxonomy
	 */
	public $taxonomy = 'smartdocs_category';
	public $taxonomy_thumb = true;

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->taxonomy_thumb = apply_filters( 'smartdocs_enable_category_thumbnail', true );

		// Action to register custom post type.
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_action( 'admin_head', array( $this, 'print_admin_menu_style' ) );
		add_action( 'admin_print_scripts', array( $this, 'taxonomy_admin_scripts' ) );

		add_filter( 'rewrite_rules_array', array( $this, 'fix_rewrite_rules' ) );
		add_filter( 'post_type_link', array( $this, 'filter_post_type_link' ), 10, 2 );

		add_filter( 'manage_' . $this->post_type . '_posts_columns', array( $this, 'cpt_columns' ) );
		add_action( 'manage_' . $this->post_type . '_posts_custom_column', array( $this, 'cpt_columns_data' ), 10, 2 );

		add_filter( 'manage_' . $this->taxonomy . '_custom_column', array( $this, 'manage_taxonomy_custom_column' ), 15, 3 );
		add_filter( 'manage_edit-' . $this->taxonomy . '_columns', array( $this, 'manage_taxonomy_columns' ) );

		add_action( 'pre_get_posts', array( $this, 'posts_per_page' ) );

		add_action( 'get_terms_defaults', array( $this, 'get_terms_defaults' ), 10, 2 );
		add_action( 'pre_get_terms', array( $this, 'pre_get_terms' ) );
		add_action( 'terms_clauses', array( $this, 'terms_clauses' ), 99, 3 );
	}

	/**
	 * Register custom post type and taxonomies.
	 *
	 * @since 1.0.0
	 * @see "init"
	 */
	public function register_cpt() {
		if ( ! is_blog_installed() || post_type_exists( $this->post_type ) ) {
			return;
		}

		$rewrite_slug = $this->get_cpt_rewrite_slug();

		// Registering post type.
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
			'has_archive'         => $rewrite_slug,
			'menu_position'       => null,
			'menu_icon'			  => $this->get_post_type_icon(),
			'show_in_rest'        => true, // For accessing the cpt in wp rest api.
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'author', 'revisions', 'custom-fields' ),
		);

		$args['rewrite'] = apply_filters(
			'smartdocs_cpt_rewrite_slug',
			array(
				'slug'       => $rewrite_slug . '/%smartdocs_category%',
				'with_front' => false,
				'feeds'      => true,
			)
		);

		register_post_type( $this->post_type, $args );

		remove_post_type_support( $this->post_type, 'comments' );

		// Resgistering taxonomy.
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

		$category_args['rewrite'] = apply_filters(
			'smartdocs_category_rewrite_slug',
			array(
				'slug' => $this->get_category_rewrite_slug(),
				'with_front' => false,
				'hierarchical' => true,
			)
		);

		register_taxonomy( $this->taxonomy, $this->post_type, $category_args );

		$this->enable_category_thumbnail();

		if ( ! get_option( 'smartdocs_rewrite_rules_flushed' ) ) {
			flush_rewrite_rules();
			update_option( 'smartdocs_rewrite_rules_flushed', 1 );
		}
	}

	/**
	 * SmartDocs rewrite rule fixes.
	 *
	 * @since 1.0.0
	 * @param array $rules Rules.
	 * @see "rewrite_rules_array"
	 * @return array
	 */
	public function fix_rewrite_rules( $rules ) {
		global $wp_rewrite;

		$rewrite_slug = $this->get_cpt_rewrite_slug();

		$slug = '/' . $rewrite_slug . '/%smartdocs_category%';

		// Fix the rewrite rules when the smart-docs permalink have %smartdocs_category% flag.
		if ( preg_match( '`/(.+)(/%smartdocs_category%)`', $slug, $matches ) ) {
			foreach ( $rules as $rule => $rewrite ) {
				if ( preg_match( '`^' . preg_quote( $matches[1], '`' ) . '/\(`', $rule ) && preg_match( '/^(index\.php\?smartdocs_category)(?!(.*smart-docs))/', $rewrite ) ) {
					unset( $rules[ $rule ] );
				}
			}
		}

		return $rules;
	}

	/**
	 * Filter to allow smartdocs_category in the permalinks for products.
	 *
	 * @since 1.0.0
	 * @param  string  $permalink The existing permalink URL.
	 * @param  WP_Post $post WP_Post object.
	 * @see "post_type_link"
	 * @return string
	 */
	public function filter_post_type_link( $permalink, $post ) {
		// Abort if post is not a smart-doc.
		if ( $this->post_type !== $post->post_type ) {
			return $permalink;
		}

		// Abort early if the placeholder rewrite tag isn't in the generated URL.
		if ( false === strpos( $permalink, '%' ) ) {
			return $permalink;
		}

		// Get the custom taxonomy terms in use by this post.
		$terms = get_the_terms( $post->ID, $this->taxonomy );

		if ( ! empty( $terms ) ) {
			$terms           = wp_list_sort(
				$terms,
				array(
					'parent'  => 'DESC',
					'term_id' => 'ASC',
				)
			);
			$category_object = $terms[0];
			$category_slug   = $category_object->slug;

			if ( $category_object->parent ) {
				$ancestors = get_ancestors( $category_object->term_id, $this->taxonomy );
				foreach ( $ancestors as $ancestor ) {
					$ancestor_object = get_term( $ancestor, $this->taxonomy );
					if ( apply_filters( 'smartdocs_post_type_link_parent_category_only', false ) ) {
						$category_slug = $ancestor_object->slug;
					} else {
						$category_slug = $ancestor_object->slug . '/' . $category_slug;
					}
				}
			}
		} else {
			// If no terms are assigned to this post, use a string instead (can't leave the placeholder there).
			$category_slug = _x( 'uncategorized', 'slug', 'smart-docs' );
		}

		$permalink = str_replace( '%smartdocs_category%', $category_slug, $permalink );

		return $permalink;
	}

	/**
	 * Base64 encoded svg icon.
	 *
	 * @since 1.0.0
	 *
	 * @return string Base64-encoded SVG icon.
	 */
	protected function get_post_type_icon() {
		return 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxOS43NCIgaGVpZ2h0PSIxOS43NCIgdmlld0JveD0iMCAwIDE5Ljc0IDE5Ljc0Ij48cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTkuODcsMGE5Ljg3LDkuODcsMCwxLDAsOS44Nyw5Ljg3QTkuODcsOS44NywwLDAsMCw5Ljg3LDBabTUuMDcsMTQuODJhMS4zNiwxLjM2LDAsMCwxLTEuMzUsMS4zNkg2LjQzYTEuMzYsMS4zNiwwLDAsMS0xLjM2LTEuMzZWNC43QTEuMzYsMS4zNiwwLDAsMSw2LjQzLDMuMzRoNS42NGEuNy43LDAsMCwxLC4xNCwwVjYuMDhoMi43YS43LjcsMCwwLDEsMCwuMTRaTTYuNDQsOS4zNFY5YS40Mi40MiwwLDAsMSwuNDItLjQyaDYuNGEuNDIuNDIsMCwwLDEsLjQyLjQydi4zNmEuNDIuNDIsMCwwLDEtLjQyLjQySDYuODZBLjQyLjQyLDAsMCwxLDYuNDQsOS4zNFptMCwxLjkzVjEwLjlhLjQxLjQxLDAsMCwxLC40Mi0uNDFIMTJhLjQxLjQxLDAsMCwxLC40Mi40MXYuMzdhLjQyLjQyLDAsMCwxLS40Mi40Mkg2Ljg2QS40Mi40MiwwLDAsMSw2LjQ0LDExLjI3Wm03LjM0LDEuNTZ2LjM3YS40Mi40MiwwLDAsMS0uNDIuNDJIN2EuNDIuNDIsMCwwLDEtLjQyLS40MnYtLjM3QS40Mi40MiwwLDAsMSw3LDEyLjQxaDYuNEEuNDIuNDIsMCwwLDEsMTMuNzgsMTIuODNaIiBmaWxsPSIjQTlBREIyIi8+PC9zdmc+';
	}

	/**
	 * CPT Columns
	 *
	 * Displays Feedback column.
	 *
	 * @since 1.0.0
	 * @param int $columns contains the column names.
	 * @return array $columns
	 */
	public function cpt_columns( $columns ) {
		$columns['doc_feedback'] = __( 'Feedback', 'smart-docs' );

		if ( isset( $columns['taxonomy-smartdocs_category'] ) ) {
			$columns['taxonomy-smartdocs_category'] = __( 'Categories', 'smart-docs' );
		}

		return $columns;
	}

	/**
	 * CPT Columns data
	 *
	 * Data to render in feedback column.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param string $column contains the column names.
	 * @param int    $post_id contains the post id.
	 */
	public function cpt_columns_data( $column, $post_id ) {

		switch ( $column ) {

			case 'doc_feedback':
				$upvotes = (int) get_post_meta( $post_id, '_smartdocs_upvotes', true );
				$downvotes = (int) get_post_meta( $post_id, '_smartdocs_downvotes', true );
				?>
				<div class="doc-feedback" style="display: flex;">
					<div class="doc-upvotes" title="<?php esc_html_e( 'Upvotes', 'smart-docs' ); ?>" style="margin-right: 10px;">
						<span class="dashicons dashicons-thumbs-up" style="margin-right: 5px; color: #3fab3e;"></span><?php echo esc_html( $upvotes ); ?>
					</div>
					<div class="doc-downvotes" title="<?php esc_html_e( 'Downvotes', 'smart-docs' ); ?>">
						<span class="dashicons dashicons-thumbs-down" style="margin-right: 5px; color: #f35c51;"></span><?php echo esc_html( $downvotes ); ?>
					</div>
				</div>
				<?php
				break;
		}
	}

	/**
	 * Get CPT rewrite slug.
	 *
	 * Get the rewrite slug for doc post type from SmartDocs settings.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_cpt_rewrite_slug() {
		$rewrite_slug = get_option( 'smartdocs_archive_page_slug' );

		if ( empty( $rewrite_slug ) ) {
			$rewrite_slug = 'docs';
		}

		return $rewrite_slug;
	}

	/**
	 * Get category rewrite slug.
	 *
	 * Get the rewrite slug for doc category from SmartDocs settings.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_category_rewrite_slug() {
		$rewrite_slug = get_option( 'smartdocs_category_slug' );

		if ( empty( $rewrite_slug ) ) {
			$rewrite_slug = 'docs-category';
		}

		return $rewrite_slug;
	}

	/**
	 * Print admin menu style.
	 *
	 * Renders necessary CSS to fix admin menu icon.
	 *
	 * @since 1.0.0
	 * @see "admin_head"
	 */
	public function print_admin_menu_style() {
		?>
		<style type="text/css">
		#menu-posts-smart-docs .wp-menu-image img { padding-top: 6px; }
		</style>
		<?php
	}

	/**
	 * Taxonomy admin scripts.
	 *
	 * Enqueue docs taxonomy thumbnail related scripts.
	 *
	 * @since 1.0.0
	 * @see "admin_print_scripts"
	 */
	public function taxonomy_admin_scripts() {
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
		wp_enqueue_script( 'smartdocs-taxonomy-thumbnail-upload', SMART_DOCS_URL . '/assets/js/admin/taxonomy-thumbnail.js', array( 'jquery' ), null, false );
	}

	/**
	 * Enable category thumbnail.
	 *
	 * Enable the image interface for SmartDocs taxonomy terms.
	 *
	 * @since 1.0.0
	 */
	public function enable_category_thumbnail() {
		if ( $this->taxonomy_thumb ) {
			add_action( $this->taxonomy . '_edit_form_fields', array( $this, 'taxonomy_thumbnail_edit_tag_form' ), 10, 2 );
			add_action( $this->taxonomy . '_add_form_fields', array( $this, 'taxonomy_thumbnail_add_tag_form' ), 10 );
			add_action( 'edit_term', array( $this, 'taxonomy_thumbnail_save_term' ), 10, 3 );
			add_action( 'create_term', array( $this, 'taxonomy_thumbnail_save_term' ), 10, 3 );
		}
	}

	/**
	 * Save Edited Term.
	 *
	 * @since 1.0.0
	 * @param int 	 $term_id 	Term ID.
	 * @param int 	 $tt_id 		Term Taxonomy ID.
	 * @param string $taxonomy 	Taxonomy slug.
	 */
	public function taxonomy_thumbnail_save_term( $term_id, $tt_id, $taxonomy ) {
		if ( isset( $_POST['taxonomy_thumbnail_id'] ) ) {
			update_term_meta( $term_id, 'taxonomy_thumbnail_id', absint( wp_unslash( $_POST['taxonomy_thumbnail_id'] ) ) );
		}
	}

	/**
	 * Edit Term Columns.
	 *
	 * Insert a new column on wp-admin/edit-tags.php.
	 *
	 * @since 1.0.0
	 * @param array $columns A list of columns.
	 * @return array List of columns with "Images" inserted after the checkbox.
	 */
	public function manage_taxonomy_columns( $columns ) {
		if ( $this->taxonomy_thumb ) {
			$new_columns = array();

			if ( isset( $columns['cb'] ) ) {
				$new_columns['cb'] = $columns['cb'];
				unset( $columns['cb'] );
			}

			$new_columns['taxonomy_thumbnail'] = __( 'Image', 'smart-docs' );

			$columns = array_merge( $new_columns, $columns );
		}

		$columns['handle'] = '';

		return $columns;
	}

	/**
	 * Edit Term Rows.
	 *
	 * Create image control for each term row of wp-admin/edit-tags.php.
	 *
	 * @since 1.0.0
	 * @param string $columns Column HTML output.
	 * @param string $column_name Name of the current column.
	 * @param int 	 $term_id Term ID.
	 * @return string
	 */
	public function manage_taxonomy_custom_column( $columns, $column_name, $term_id ) {
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
			return $columns . $html;
		}

		if ( 'handle' === $column_name ) {
			$columns .= '<input type="hidden" name="term_id" value="' . esc_attr( $term_id ) . '" />';
		}

		return $columns;
	}

	/**
	 * Edit Term Control.
	 *
	 * Edit image control for wp-admin/edit-tag-form.php.
	 * Hooked into the $taxonomy . '_edit_form_fields' action.
	 *
	 * @since 1.0.0
	 * @param object $term Term object.
	 * @param string $taxonomy Taxonomy slug.
	 */
	public function taxonomy_thumbnail_edit_tag_form( $term, $taxonomy ) {
		$taxonomy = get_taxonomy( $taxonomy );
		$name     = __( 'term', 'smart-docs' );
		if ( isset( $taxonomy->labels->singular_name ) ) {
			$name = strtolower( $taxonomy->labels->singular_name );
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php print esc_html__( 'Featured Image', 'smart-docs' ); ?></label></th>
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
						<img id="taxonomy_thumbnail_preview_img" width="150" height="150" src="<?php echo esc_url( $taxonomy_thumbnail_img_url ); ?>" ><br>
						<?php
					}
				}
				?>
				</div>
				<input id="taxonomy_thumbnail_id" type="hidden" name="taxonomy_thumbnail_id" value="<?php echo absint( $taxonomy_thumbnail_id ); ?>" />
				<input id="upload_taxonomy_thumbnail_button" type="button" class="button button-primary" value="<?php echo esc_html__( 'Upload', 'smart-docs' ); ?>" />
				<?php
				$delete_button_inline_css = 'display:none';
				if ( '' !== $taxonomy_thumbnail_id ) {
					$delete_button_inline_css = '';
				}
				?>
				<input style="<?php echo esc_attr( $delete_button_inline_css ); ?>" id="delete_taxonomy_thumbnail_button" type="button" class="button button-danger" value="<?php echo esc_html__( 'Delete', 'smart-docs' ); ?>" />
				<div class="clear"></div>
				<p class="description">
					<?php
					// translators: %1$s for label.
					printf( esc_html__( 'Add an image from media library to this %1$s. Recommended maximum image size is 150x150 pixels.', 'smart-docs' ), esc_html( $name ) );
					?>
				</p>
			</td>
		</tr>
		<?php
	}

	/**
	 * Add Term Control.
	 *
	 * Create image control for wp-admin/edit-tag-form.php.
	 * Hooked into the $taxonomy . '_add_form_fields' action.
	 *
	 * @since 1.0.0
	 * @param string $taxonomy Taxonomy slug.
	 */
	public function taxonomy_thumbnail_add_tag_form( $taxonomy ) {
		$taxonomy = get_taxonomy( $taxonomy );
		$name     = __( 'term', 'smart-docs' );
		if ( isset( $taxonomy->labels->singular_name ) ) {
			$name = strtolower( $taxonomy->labels->singular_name );
		}
		?>
		<div class="form-field term-thumbnail-wrap">
			<label for="description"><?php print esc_html__( 'Featured Image', 'smart-docs' ); ?></label>
			<div id="taxonomy_thumbnail_preview">
			</div>
			<input id="taxonomy_thumbnail_id" type="hidden" name="taxonomy_thumbnail_id" value="" />
			<input id="upload_taxonomy_thumbnail_button" type="button" class="button button-primary" value="<?php echo esc_html__( 'Upload', 'smart-docs' ); ?>" />
			<?php
				$delete_button_inline_css = 'display:none';
			?>
			<input style="<?php echo esc_attr( $delete_button_inline_css ); ?>" id="delete_taxonomy_thumbnail_button" type="button" class="button button-danger" value="<?php echo esc_html__( 'Delete', 'smart-docs' ); ?>" />
			<div class="clear"></div>
			<p class="description">
				<?php
				// translators: %1$s for label.
				printf( esc_html__( 'Add an image from media library to this %1$s. Recommended maximum image size is 150x150 pixels.', 'smart-docs' ), esc_html( $name ) );
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Posts Per Page.
	 *
	 * Set posts_per_page for smartdocs_category archive page.
	 * Hooked into the pre_get_posts.
	 *
	 * @since 1.0.0
	 * @param object $query WP_Query Object.
	 */
	public function posts_per_page( $query ) {
		if ( ! is_admin() && $query->is_main_query() && is_smartdocs_category() ) {
			$query->set( 'posts_per_page', '-1' );
		}
	}

	/**
	 * Change get_terms order by defaults to menu_order for sortable taxonomies.
	 *
	 * @since 1.1.0
	 *
	 * @param array $defaults   An array of default get_terms() arguments.
	 * @param array $taxonomies An array of taxonomies.
	 * @return array
	 */
	public function get_terms_defaults( $defaults, $taxonomies ) {
		if ( is_array( $taxonomies ) && 1 < count( $taxonomies ) ) {
			return $defaults;
		}

		$taxonomy = is_array( $taxonomies ) ? (string) current( $taxonomies ) : $taxonomies;
	
		if ( $taxonomy === $this->taxonomy ) {
			$orderby = 'menu_order';
			$defaults['orderby'] = $orderby;
		}
	
		return $defaults;
	}

	/**
	 * Adds support to get_terms for menu_order argument.
	 *
	 * @since 1.1.0
	 * @param WP_Term_Query $terms_query Instance of WP_Term_Query.
	 */
	public function pre_get_terms( $terms_query ) {
		$args = &$terms_query->query_vars;

		// Put back valid orderby values.
		if ( 'menu_order' === $args['orderby'] ) {
			$args['orderby']               = 'name';
			$args['force_menu_order_sort'] = true;
		}

		// When COUNTING, disable custom sorting.
		if ( 'count' === $args['fields'] ) {
			return;
		}
	
		// Support menu_order arg.
		if ( ! empty( $args['menu_order'] ) ) {
			$args['order']                 = 'DESC' === strtoupper( $args['menu_order'] ) ? 'DESC' : 'ASC';
			$args['force_menu_order_sort'] = true;
		}
	
		if ( ! empty( $args['force_menu_order_sort'] ) ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = 'order'; // phpcs:ignore
			$terms_query->meta_query->parse_query_vars( $args );
		}
	}

	/**
	 * Adjust term query to handle custom sorting parameters.
	 *
	 * @param array $clauses    Clauses.
	 * @param array $taxonomies Taxonomies.
	 * @param array $args       Arguments.
	 * @return array
	 */
	function terms_clauses( $clauses, $taxonomies, $args ) {
		global $wpdb;

		// No need to filter when counting.
		if ( strpos( $clauses['fields'], 'COUNT(*)' ) !== false ) {
			return $clauses;
		}

		// For sorting, force left join in case order meta is missing.
		if ( ! empty( $args['force_menu_order_sort'] ) ) {
			$clauses['join']    = str_replace( "INNER JOIN {$wpdb->termmeta} ON ( t.term_id = {$wpdb->termmeta}.term_id )", "LEFT JOIN {$wpdb->termmeta} ON ( t.term_id = {$wpdb->termmeta}.term_id AND {$wpdb->termmeta}.meta_key='order')", $clauses['join'] );
			$clauses['where']   = str_replace( "{$wpdb->termmeta}.meta_key = 'order'", "( {$wpdb->termmeta}.meta_key = 'order' OR {$wpdb->termmeta}.meta_key IS NULL )", $clauses['where'] );
			$clauses['orderby'] = 'DESC' === $args['order'] ? str_replace( 'meta_value+0', 'meta_value+0 DESC, t.name', $clauses['orderby'] ) : str_replace( 'meta_value+0', 'meta_value+0 ASC, t.name', $clauses['orderby'] );
		}

		return $clauses;
	}
}
