<?php
/**
 * Widget Manager
 * 
 * Responsible for loading and running Category Widget.
 * 
 * @since 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs\Widgets;

use SmartDocs\Plugin;

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
class Category_Widget extends \WP_Widget {

	public function __construct() {
		parent::__construct(
			'smartdocs-categories-widget',
			esc_html__( 'Smart Docs Categories', 'smart-docs' ),
			array(
				'description' => __( 'Widget to display list of docs categories.', 'smart-docs' ),
			)
		);
	}

	/**
	 * Overriding widget method of the parent.
	 *
	 * @param array $args      Getting before and after of the widget.
	 * @param array $instance  Getting title and other attributes of instance param.
	 */
	public function widget( $args, $instance ) {
		// Title of the recent doc widget.
		$title        	= esc_html( $instance['title'] );
		$dropdown     	= ! empty( $instance['dropdown'] ) ? true : false;
		$count        	= ! empty( $instance['count'] ) ? true : false;
		$empty 		 	= ! empty( $instance['empty'] ) ? false : true;
		$hierarchical 	= ! empty( $instance['hierarchical'] ) ? true : false;

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
			'hide_empty'   => $empty,
			'pad_counts'   => 0,
		);

		if ( $dropdown ) {
			// Dropdown category id.
			$dropdown_id = 'smartdocs_category';

			// Adding some category args for wp_dropdown_categories.
			$cat_args['show_option_none'] = __( 'Select Category', 'smart-docs' );
			$cat_args['id']               = $dropdown_id; // Gives id attribute to the select html tag.
			$cat_args['class']            = 'smartdocs-category-select'; // Gives id attribute to the select html tag.
			$cat_args['value_field']      = 'slug'; // Gives value attribute name of the category slug.

			wp_dropdown_categories( $cat_args );

			$rewrite_slug = Plugin::instance()->cpt->get_category_rewrite_slug();
			?>

			<script type="text/javascript">
				var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
				dropdown.addEventListener( 'change', function() {
					location.href = "<?php echo esc_html( home_url() ); ?>/<?php echo $rewrite_slug; ?>/" + dropdown.value;
				} );
			</script>

		<?php
		} else {
			$cat_args['depth'] = 2;

			smartdocs_list_categories( $cat_args, $count );
			?>

			<!--<ul>-->
				<?php //wp_list_categories( $cat_args ); // Returns categories list in html form according to the argument passed. ?>
			<!--</ul>-->

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
		$default = array(
			'title'		=> esc_html__( 'Categories', 'smart-docs' ),
			'dropdown' 	=> '0',
			'count' 	=> '1',
			'empty' 	=> '0',
			'hierarchical' => '1'
		);

		$instance = array_merge( $default, $instance );

		$title 			= $instance['title'];
		$dropdown     = (bool) $instance['dropdown'];
		$count        = (bool) $instance['count'];
		$empty        = (bool) $instance['empty'];
		$hierarchical = (bool) $instance['hierarchical'];
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); // Get field id helps in generating the unque id of the field with required string(title). ?>">
				<?php esc_attr_e( 'Title:', 'smart-docs' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" type="text" />
		</p>

		<p>
			<input class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>" type="checkbox" <?php checked( $dropdown ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"><?php esc_attr_e( 'Display as dropdown', 'smart-docs' ); ?></label>
			<br>

			<input class="checkbox" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" <?php checked( $count ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_attr_e( 'Show post count', 'smart-docs' ); ?></label>
			<br>

			<input class="checkbox" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'empty' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'empty' ) ); ?>" <?php checked( $empty ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'empty' ) ); ?>"><?php esc_attr_e( 'Show empty categories', 'smart-docs' ); ?></label>
			<br>

			<input class="checkbox" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>" <?php checked( $hierarchical ); ?> />
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
		$instance['empty']        = ! empty( $new_instance['empty'] ) ? '1' : '0';
		$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? '1' : '0';

		return $instance;
	}
}
