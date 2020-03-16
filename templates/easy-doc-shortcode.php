<?php
/**
 * Functions related to shortcode for live search
 *
 * @package EasyDoc/Shortcode
 * @author IdeaBox
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// To render the search box of WordPress.
add_shortcode( 'easy_doc_wp_live_search', 'easy_doc_render_search_box' );

/**
 * For rendering the search box.
 *
 * @param int $atts    Get attributes for the search field.
 * @param int $content Get content to search from.
 */
function easy_doc_render_search_box( $atts, $content = null ) {
	ob_start();
	?>
	<div class="ed-live-search">
		<div class="ed-search-form-container">
			<form role="search" method="post" class="ed-search-form" action="">
				<input id="ed-sq" type="search" class="ed-search-field" placeholder="<?php echo esc_attr_x( 'Search for answers…', 'placeholder', 'easydoc' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search', 'label', 'easydoc' ); ?>" autocomplete="off" autocorrect="off" />

				<div class="ed-spinner live-search-loading">
					<img src="<?php echo esc_url( plugins_url( '../assets/images/ring.gif', __FILE__ ) ); ?>" >
				</div>
			</form>
		</div>
	</div>
	<?php
	// Returning the html document.
	return ob_get_clean();
}

