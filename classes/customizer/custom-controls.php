<?php
/**
 * SmartDocs Customizer Custom Controls.
 *
 * Style Custom Controls are designed for quickly creating and using
 * basic custom controls in the customizer. The API currently supports
 * following controls.
 *
 *  - Line Divider
 *  - Range Slider
 *  - 4-Box Dimension Control
 *  - Color Picker with Alpha Channel and Palettes
 *  - Section Title
 *
 * @author Achal Jain <achal@ideaboxcreations.com>
 *
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @package SmartDocs/Customizer
 */

namespace SmartDocs;

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Custom Customizer controls.
	 *
	 * @since 1.0.0
	 */
	final class Customizer_Control extends \WP_Customize_Control {

		/**
		 * Used to connect controls to each other.
		 *
		 * @since 1.0.0
		 * @var bool $connect
		 */
		public $connect = false;

		/**
		 * If true, the preview button for a control will be rendered.
		 *
		 * @since 1.0.0
		 * @var bool $preview_button
		 */
		public $preview_button = false;

		/**
		 * Reference to the class `$args` parameter.
		 *
		 * @since 1.0.0
		 * @var array
		 */
		public $args = array();

		/**
		 * Constructor.
		 *
		 * @param object  $manager Customizer manager.
		 * @param integer $id Control ID.
		 * @param array   $args Control args.
		 *
		 * @since 1.0.0
		 */
		public function __construct( $manager, $id, $args = array() ) {
			$this->args = $args;
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.7
		 * @return void
		 */
		protected function render() {
			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control smart-docs customize-control-' . $this->type;

			if ( isset( $this->args['classes'] ) ) {
				$class .= ' ' . implode( ' ', $this->args['classes'] );
			}

			printf( '<li id="%s" class="%s">', esc_attr( $id ), esc_attr( $class ) );
			$this->render_content();
			echo '</li>';
		}

		/**
		 * Renders the content for a control based on the type
		 * of control specified when this class is initialized.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_content() {
			switch ( $this->type ) {

				case 'smartdocs-line':
					$this->render_line();
					break;

				case 'smartdocs-slider':
					$this->render_slider();
					break;

				case 'smartdocs-slider-responsive':
					$this->render_responsive_slider();
					break;

				case 'smartdocs-dimension':
					$this->render_dimension();
					break;

				case 'smartdocs-color':
					$this->render_color_picker();
					break;

				case 'smartdocs-section':
					$this->render_section();
					break;

				case 'smartdocs-sub-section':
					$this->render_sub_section();
					break;
			}
		}

		/**
		 * Renders the title and description for a control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_content_title() {
			if ( ! empty( $this->label ) ) {
				echo '<span class="customize-control-title">' . esc_html( $this->label );
				
				if ( isset( $this->args['classes'] ) && in_array( 'smartdocs-responsive-customize-control', $this->args['classes'], true ) ) {
					$icon = end( $this->args['classes'] );
	
					if ( 'medium' === $icon ) {
						$icon = 'tablet';
					} elseif ( 'mobile' === $icon ) {
						$icon = 'smartphone';
					}
	
					echo '<i class="smartdocs-responsive-control-toggle dashicons dashicons-' . $icon . '"></i>';
				}
				
				echo '</span>';
			}
			if ( ! empty( $this->description ) ) {
				echo '<span class="description customize-control-description">' . $this->description . '</span>';
			}
		}

		/**
		 * Renders the connect attribute for a connected control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_connect_attribute() {
			if ( $this->connect ) {
				echo ' data-connected-control="' . $this->connect . '"';
			}
		}

		/**
		 * Renders a line break control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_line() {
			echo '<hr />';
		}

		/**
		 * Renders the slider control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_slider() {
			$this->choices['min']  = ( isset( $this->choices['min'] ) ) ? $this->choices['min'] : '0';
			$this->choices['max']  = ( isset( $this->choices['max'] ) ) ? $this->choices['max'] : '100';
			$this->choices['step'] = ( isset( $this->choices['step'] ) ) ? $this->choices['step'] : '1';

			echo '<label>';
			$this->render_content_title();
			echo '<div class="wrapper">';
			echo '<input class="smartdocs-range-input" type="range" min="' . $this->choices['min'] . '" max="' . $this->choices['max'] . '" step="' . $this->choices['step'] . '" value="' . $this->value() . '"';
			echo 'data-original="' . $this->settings['default']->default . '">';
			echo '<div class="smartdocs-range-value">';
			echo '<input type="number" class="smartdocs-range-value-input" value="' . $this->value() . '"';
			$this->link();
			echo '>';
			echo '</div>';
			echo '<div class="smartdocs-slider-reset">';
			echo '<span class="dashicons dashicons-image-rotate"></span>';
			echo '</div>';
			echo '</div>';
			echo '</label>';
		}

		/**
		 * Renders the slider control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_responsive_slider() {
			$this->choices['min']  = ( isset( $this->choices['min'] ) ) ? $this->choices['min'] : '0';
			$this->choices['max']  = ( isset( $this->choices['max'] ) ) ? $this->choices['max'] : '100';
			$this->choices['step'] = ( isset( $this->choices['step'] ) ) ? $this->choices['step'] : '1';

			$value       = is_array( $this->value() ) ? wp_json_encode( $this->value() ) : json_decode( $this->value(), true );
			$value       = is_array( $value ) ? wp_json_encode( $value ) : $value;
			$field_value = is_array( $this->value() ) ? $this->value() : json_decode( $this->value(), true );

			echo '<label>';
			$this->render_content_title();
			foreach ( array( 'desktop', 'tablet', 'mobile' ) as $mode ) : ?>

				<div class="wrapper-<?php echo $mode; ?>" >
					<div class="sub-settings-wrapper">
						<span class="responsive-toggle">Responsive Icons</span>
					</div>

					<input class="smartdocs-range-input smartdocs-range-input-<?php echo $mode; ?>" type="range" min="<?php echo $this->choices['min']; ?>" max="<?php echo $this->choices['max']; ?>" step="<?php echo $this->choices['step']; ?>" value="<?php echo $this->value()[ $mode ]['value']; ?>" data-original="<?php echo $this->settings['default']->default[ $mode ]['value']; ?>">
					<div class="smartdocs-range-value smartdocs-range-value-<?php echo $mode; ?>">
						<input type="number" id="smartdocs-range-value-input-<?php echo $mode; ?>" value="<?php absint( $this->value()[ $mode ]['value'] ); ?>">
					</div>
					<div class="smartdocs-slider-reset smartdocs-slider-reset-<?php echo $mode; ?>">
						<span class="dashicons dashicons-image-rotate"></span>
					</div>
				</div>
				<?php
			endforeach;

			echo '<input type="hidden" class="smartdocs-dimension-value" value="' . $value . '" data-value="' . $value . '" ' . $this->get_link() . '/>';

			echo '</label>'; // closing tab.
		}

		/**
		 * Renders the dimension control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_dimension() {
			$value       = is_array( $this->value() ) ? wp_json_encode( $this->value() ) : json_decode( $this->value(), true );
			$value       = is_array( $value ) ? wp_json_encode( $value ) : $value;
			$field_value = is_array( $this->value() ) ? $this->value() : json_decode( $this->value(), true );
			?>
			<label>
				<?php $this->render_content_title(); ?>
				<div class="wrapper">
					<?php foreach ( $this->choices as $key => $label ) { ?>
						<div class="smartdocs-field">
							<span class="smartdocs-field-label"><?php echo $label; ?></span>
							<input type="number" data-key="<?php echo $key; ?>" value="<?php echo isset( $field_value[ $key ] ) ? $field_value[ $key ] : ''; ?>" />
						</div>
					<?php } ?>
					<input type="hidden" class="smartdocs-dimension-value" value='<?php echo $value; ?>' data-value='<?php echo $value; ?>' <?php echo $this->get_link(); ?> />
				</div>
			</label>
			<?php
		}

		/**
		 * Renders the color picker control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_color_picker() {
			$attrs = '';

			$is_alpha = ( isset( $this->choices['alpha'] ) && $this->choices['alpha'] );
			$palette  = ( isset( $this->choices['palette'] ) ) ? $this->choices['palette'] : false;
			$default  = ( isset( $this->choices['default'] ) ) ? $this->choices['default'] : false;

			$attrs .= $is_alpha ? ' data-alpha-enabled="true"' : '';
			$attrs .= $palette ? ' data-palette="' . $palette . '"' : '';
			$attrs .= $default ? ' data-default-color="' . $default . '"' : '';

			?>
			<label><?php $this->render_content_title(); ?></label>
			<input type="text" class="color-picker smartdocs-color-control" placeholder="#RRGGBB" value="<?php echo $this->value(); ?>"<?php echo $attrs; ?>/>
			<?php
		}

		/**
		 * Renders the section control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_section() {
			?>
			<div class="smartdocs-section-title"><?php $this->render_content_title(); ?></div>
			<?php
		}

		/**
		 * Renders the sub-section control.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 */
		protected function render_sub_section() {
			?>
			<div class="smartdocs-sub-section-title"><?php $this->render_content_title(); ?></div>
			<?php
		}

		/**
		 * Renders the responsive control and settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 * @return void
		 *
		 * @param object $customizer WP_Cusomizer_Control object.
		 * @param string $key Control Key.
		 * @param array  $args Control arguments.
		 */
		public function render_responsive_control( $customizer, $key, $args ) {

			/***
				$args = array(
				'settings' => array(
					'default' => 'default_value',
					'key' => '',
				),
				'control' => array(
					'label' => 'Control Label',
					'description' => 'This is control description',
					'section' => 'section control is linked appears in',
					'setting' => 'setting control is linked to',
					'classes' => 'additional classes to be added to the contorl',
					'priority' => '10',
				),
			)
			*/

			$label      = $args['control']['label'];
			$priority   = $args['control']['priority'];
			$responsive = array( 'desktop', 'tablet', 'mobile' );

		}
	}
}
