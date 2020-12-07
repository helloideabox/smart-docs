<?php
namespace SmartDocs\Widgets;

/**
 * Register and load the widget.
 *
 * @package SmartDocs/Widgets
 * @author Ideabox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creating widget for recent post.
 */
class Recent_Docs_Widget extends \WP_Widget {

	/**
	 * Constructor calling the docs widgets
	 */
	public function __construct() {
		parent::__construct(
			'smartdocs-recent-docs-widget',
			esc_html__( 'Recent Docs - SmartDocs', 'smart-docs' ),
			array(
				'description' => __( 'Widget to display list recently published docs.', 'smart-docs' ),
			)
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
					'post_type'   => 'smart-docs',
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

		$default = array(
			'title'		=> esc_html__( 'Recent Docs', 'smart-docs' ),
			'numberposts' 	=> '5',
		);

		$instance = array_merge( $default, $instance );

		$title = $instance['title'];

		// Widget admin form.
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'smart-docs' ); ?>
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
}
