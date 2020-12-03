<?php
/**
 * Widget Manager
 * 
 * Responsible for loading and running Category Widget.
 * 
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

/**
 * Register and load the widget.
 *
 * @package SmartDocs/Widgets
 * @author IdeaBox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Creating the widget for categories.
 */
class Cat_Widget extends \WP_Widget {

	/**
	 * Constructor calling the doc widget.
	 */
	public function __construct() {

		add_action( 'widgets_init', array( $this, 'smart_doc_widgets_area' ) );

		// Widget args.
		$widget_args = array(
			'description' => __( 'Widget for List of Categories', 'smart-docs' ),
		);

		// Calling the parent constructor(WP_Widget).
		parent::__construct(
			// Setting the ID.
			'smart_doc_cat_widget',
			// Widget name appear in UI.
			'Smart Doc Category Widget',
			// Arguments passing.
			$widget_args
		);
	}



	/**
	 * Overriidung widget function of the parent.
	 *
	 * @param array $args      Getting before and after of the widget.
	 * @param array $instance  Getting title and other attributes of instance param.
	 */
	public function widget( $args, $instance ) {

		// Title of the recent doc widget.
		$title        = esc_html( $instance['title'] );
		$dropdown     = ! empty( $instance['dropdown'] ) ? '1' : '0';
		$count        = ! empty( $instance['count'] ) ? '1' : '0';
		$hierarchical = ! empty( $instance['hierarchical'] ) ? '1' : '0';

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			// Before and after widget title are defined by themes.
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $count,
			'hierarchical' => $hierarchical,
			'taxonomy'     => 'smartdocs_category',
			'title_li'     => '',
			'hide_empty'   => 0,
			'pad_counts'   => 0,
		);

		if ( $dropdown ) {
			// Dropdown category id.
			$dropdown_id = 'smartdocs_category';

			// Adding some category args for wp_dropdown_categories.
			$cat_args['show_option_none'] = __( 'Select Category', 'smart-docs' ); // If none of the options are selected then defaults to select category.
			$cat_args['id']               = $dropdown_id; // Gives id attribute to the select html tag.
			$cat_args['value_field']      = 'slug'; // Gives value attribute name of the category slug.

			/**
			 * Filters the arguments for the Categories widget drop-down.
			*
			* @since 2.8.0
			* @since 4.9.0 Added the `$instance` parameter.
			*
			* @see wp_dropdown_categories()
			*
			* @param array $cat_args An array of Categories widget drop-down arguments.
			* @param array $instance Array of settings for the current widget.
			*/
			wp_dropdown_categories( $cat_args );
			?>
			<?php // Script to add event listener for the select option. ?>
			<script type="text/javascript">
				var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
				dropdown.addEventListener( 'change', function(){
					location.href = "<?php echo esc_html( home_url() ); ?>/smartdocs_category/" + dropdown.value;
				} )
			</script>

		<?php } else { ?>

		<ul>
			<?php wp_list_categories( $cat_args ); // Returns categories list in html form according to the argument passed. ?>
		</ul>

			<?php
		}
		echo $args['after_widget'];
	}


	/**
	 * Overriding form function of the parent.
	 *
	 * @param array $instance Getting title and other attributes of instance param.
	 */
	public function form( $instance ) {
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = 'Categories';
		}

		$dropdown     = (bool) $instance['dropdown'];
		$count        = (bool) $instance['count'];
		$hierarchical = (bool) $instance['hierarchical'];
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); // Get field id helps in generating the unque id of the field with required string(title). ?>">
				<?php esc_attr_e( 'Title:', 'smart-docs' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" type="text">
		</p>

		<p>
			<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>" type="checkbox" <?php checked( $dropdown ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"><?php esc_attr_e( 'Display as dropdown', 'smart-docs' ); ?></label>
			<br>

			<input class="checkbox" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" <?php checked( $count ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Show post count', 'smart-docs' ); ?></label>
			<br>

			<input class="checkbox" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>" <?php checked( $hierarchical ); ?>>
			<label for="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>"><?php esc_attr_e( 'Show hierarchy', 'smart-docs' ); ?></label>
		</p>

		<?php
	}


	/**
	 * Overriding update function of the parent.
	 *
	 * @param array $new_instance Getting the new instance after file updating.
	 * @param array $old_instance Getting the old intance before file updation.
	 */
	public function update( $new_instance, $old_instance ) {
		// Initializing the instance array.
		$instance = array();

		// Storing the input value to instance title key.
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['dropdown']     = ! empty( $new_instance['dropdown'] ) ? '1' : '0';
		$instance['count']        = ! empty( $new_instance['count'] ) ? '1' : '0';
		$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? '1' : '0';
		return $instance;
	}

	/**
	 * Registering the custom Widget(smart_doc_cat_widget).
	 */
	public function smart_doc_widgets_area() {
		register_widget( 'SmartDocs\Cat_Widget' );
	}

	public function enqueue_styles() {
		get_style_depends('category-widget-css', 'category-widget');
	}
}
