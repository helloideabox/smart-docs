<?php
/**
 * Register and load the widget.
 *
 * @package SmartDocs/Widgets
 * @author Ideabox
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Widget class.
 */
class Widget {
	/**
	 * Constructor calling the docs widgets
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'register_sidebar' ) );
	}

	/**
	 * Register sidebar for widget area.
	 */
	public function register_sidebar() {
		$args = array(
			'name'          => __( 'Smart Docs Sidebar', 'smart-docs' ),
			'id'            => 'smart-docs-sidebar',
			'description'   => __( 'Widgets in this area will be shown on all single docs and category pages.', 'smart-docs' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		);

		register_sidebar( $args );

		$this->register_wp_widgets();
	}

	/**
	 * Register widgets.
	 */
	private function register_wp_widgets() {
		register_widget( 'SmartDocs\Widgets\Category_Widget' );
	}
}
