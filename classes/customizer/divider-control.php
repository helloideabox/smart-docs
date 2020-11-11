<?php
/**
 * Custom control for divider.
 *
 * Used for creating section divider.
 *
 * @version 1.0.0
 * @package SmartDocs
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SD_Divider_Control class.
 */
class SD_Divider_Control extends \WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @var string
	 */
	public $type = 'sd-divider';

	/**
	 * Render control.
	 */
	public function render_content() {
		?>

		<span class="customize-control-title sd-divider" style="padding: 10px; background: #fff; width: 100%; margin: 0; left: -10px; position: relative">
			<?php echo esc_html( $this->label ); ?>
		</span>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description sd-divider-description"><?php echo esc_html( $this->description ); ?></span>
		<?php endif; ?>
		<?php
	}
}
