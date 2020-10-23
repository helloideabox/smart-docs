<?php
/**
 * Adds settings to the permalinks admin settings page
 *
 * @class       SmartDocs_Permalink_Settings
 * @category    Admin
 * @package     SmartDocs\Admin
 * @version     1.0.0
 */

namespace SmartDocs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Permalinks {

	/**
	 * Permalink settings.
	 */
	private $permalinks = array();

	/**
	 * Constructor function.
	 */
	public function __construct() {
		$this->settings_init();
		// $this->settings_save();
	}

	/**
	 * Init Permalinks Settings
	 */
	public function settings_init() {
		\add_settings_section( 'smartdocs-permalink', __( 'SmartDocs Permalinks', 'smart-docs' ), array( $this, 'settings' ), 'permalink' );
	}

	/**
	 * Show the settings.
	 */
	public function settings() {
		/* translators: %s: Home URL */
		echo wp_kses_post( wpautop( sprintf( __( 'If you like, you may enter custom structures for your docs URLs here. For example, using <code>docs</code> would make your docs links like <code>%sdocs/sample-product/</code>. This setting affects product URLs only, not things such as product categories.', 'woocommerce' ), esc_url( home_url( '/' ) ) ) ) );

		$doc_homepage_page_id = wc_get_page_id( 'smart-docs' );
		$base_slug    = urldecode( ( $shop_page_id > 0 && get_post( $shop_page_id ) ) ? get_page_uri( $shop_page_id ) : _x( 'shop', 'default-slug', 'woocommerce' ) );
		$product_base = _x( 'product', 'default-slug', 'woocommerce' );

		$structures = array(
			0 => '',
			1 => '/' . trailingslashit( $base_slug ),
			2 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%product_cat%' ),
		);
		?>
		<table class="form-table wc-permalink-structure">
			<tbody>
				<tr>
					<th><label><input name="product_permalink" type="radio" value="<?php echo esc_attr( $structures[0] ); ?>" class="wctog" <?php checked( $structures[0], $this->permalinks['product_base'] ); ?> /> <?php esc_html_e( 'Default', 'woocommerce' ); ?></label></th>
					<td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?product=sample-product</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $product_base ); ?>/sample-product/</code></td>
				</tr>
				<?php if ( $shop_page_id ) : ?>
					<tr>
						<th><label><input name="product_permalink" type="radio" value="<?php echo esc_attr( $structures[1] ); ?>" class="wctog" <?php checked( $structures[1], $this->permalinks['product_base'] ); ?> /> <?php esc_html_e( 'Shop base', 'woocommerce' ); ?></label></th>
						<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/sample-product/</code></td>
					</tr>
					<tr>
						<th><label><input name="product_permalink" type="radio" value="<?php echo esc_attr( $structures[2] ); ?>" class="wctog" <?php checked( $structures[2], $this->permalinks['product_base'] ); ?> /> <?php esc_html_e( 'Shop base with category', 'woocommerce' ); ?></label></th>
						<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/product-category/sample-product/</code></td>
					</tr>
				<?php endif; ?>
				<tr>
					<th><label><input name="product_permalink" id="woocommerce_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $this->permalinks['product_base'], $structures, true ), false ); ?> />
						<?php esc_html_e( 'Custom base', 'woocommerce' ); ?></label></th>
					<td>
						<input name="product_permalink_structure" id="woocommerce_permalink_structure" type="text" value="<?php echo esc_attr( $this->permalinks['product_base'] ? trailingslashit( $this->permalinks['product_base'] ) : '' ); ?>" class="regular-text code"> <span class="description"><?php esc_html_e( 'Enter a custom base to use. A base must be set or WordPress will use default instead.', 'woocommerce' ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'wc-permalinks', 'wc-permalinks-nonce' ); ?>
		<script type="text/javascript">
			jQuery( function() {
				jQuery('input.wctog').change(function() {
					jQuery('#woocommerce_permalink_structure').val( jQuery( this ).val() );
				});
				jQuery('.permalink-structure input').change(function() {
					jQuery('.wc-permalink-structure').find('code.non-default-example, code.default-example').hide();
					if ( jQuery(this).val() ) {
						jQuery('.wc-permalink-structure code.non-default-example').show();
						jQuery('.wc-permalink-structure input').removeAttr('disabled');
					} else {
						jQuery('.wc-permalink-structure code.default-example').show();
						jQuery('.wc-permalink-structure input:eq(0)').click();
						jQuery('.wc-permalink-structure input').attr('disabled', 'disabled');
					}
				});
				jQuery('.permalink-structure input:checked').change();
				jQuery('#woocommerce_permalink_structure').focus( function(){
					jQuery('#woocommerce_custom_selection').click();
				} );
			} );
		</script>
		<?php
	}

}
