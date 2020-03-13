<?php
/**
 * Register and load the widget.
 *
 * @package EasyDoc/Widgets
 * @author Ideabox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creating widget for recent post.
 */
class  Easy_Doc_Widget extends WP_Widget {

	/**
	 * Constructor calling the docs widgets
	 */
	public function __construct() {

		add_action( 'widgets_init', array( $this, 'easy_doc_widgets_area' ) );

		$widget_ops = array(
			'description' => __( 'Widget for recent Docs', 'easydoc' ),
		);

		parent::__construct(
			// Base ID of the widget.
			'easy_doc_widget',
			// Widget name will appear in UI.
			__( 'Easy Doc Widget', 'easydoc' ),
			// Passing widget options array.
			$widget_ops
		);
	}


	/**
	 * Creating widget front-end.
	 * The name of the function is compulsory as it is for widget front-end.
	 *
	 * @param int $args     Get the before and after widget arguments.
	 * @param int $instance Get the title of the widget title.
	 */
	public function widget( $args, $instance ) {

		// Title of the recent doc widget.
		$title = esc_html( $instance['title'] );

		// Before and after widget are defined by themes.
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			// Before and after widget title are defined by themes.
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<ul>
			<?php
				// Passing the arguments for getting recent post.
				$recent_posts_args = array(
					'post_type'   => 'easy-doc',
					'post_status' => 'publish',
					'numberposts' => 5,
				);

				// Getting the recent post.
				$recent_posts = wp_get_recent_posts( $recent_posts_args );

				foreach ( $recent_posts as $recent_post ) {
					?>

					<li>
						<a href="<?php echo esc_url( the_permalink() ); ?>">
							<?php echo esc_html( $recent_post['post_title'] ); ?>
						</a>
					</li>

					<?php
				}
				?>
		</ul>

		<?php
		echo $args['after_widget'];
	}



	/**
	 * Widget Backend.
	 * The name of the function is compulsory as it is for widget backend.
	 *
	 * @param int $instance Get the titles for the recent docs in widget area.
	 */
	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = __( 'Recent Docs', 'easydoc' );
		}

		// Widget admin form.
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'easydoc' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"  value="<?php echo esc_attr( $title ); ?>" type="text">
		</p>

		<?php
	}



	/**
	 * Updating widget replacing old instances with new.
	 * The name of the function is compulsory as it is for widget input field update.
	 *
	 * @param int $new_instance Returns the new instance.
	 * @param int $old_instance Returns the old instance.
	 */
	public function update( $new_instance, $old_instance ) {
		// Making instance array.
		$instance = array();

		// Checking for new instance title set or not.
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';

		return $instance;
	}



	/**
	 * Function to create custom widget (easy-doc-widget) and register sidebar.
	 */
	public function easy_doc_widgets_area() {
		// Register Widget with the same ID as parent construct ID given to widget.
		register_widget( 'easy_doc_widget' );

		$sidebar_args = array(
			'name'          => __( 'Easy Doc Sidebar', 'easydoc' ),
			'id'            => 'easy-doc-sidebar-1',
			'description'   => __( 'Widgets in this area will be shown on all docs single posts and category.', 'easydoc' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="docs-widget-title">',
			'after_title'   => '</h2>',
		);
		register_sidebar( $sidebar_args );
	}
}

$easydoc_widget = new Easy_Doc_Widget();
