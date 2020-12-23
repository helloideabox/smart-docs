<?php
/**
 * The template for Search form.
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<div class="smartdocs-search">
	<form role="search" method="post" class="smartdocs-search-form" action="" aria-label="<?php esc_html_e( 'Search for answers', 'smart-docs' ); ?>">
		<span class="search-icon sd-icon-search" aria-hidden="true"></span>
		<input
			type="text"
			class="smartdocs-search-input"
			placeholder="<?php echo esc_attr_x( 'Search for answers..', 'placeholder', 'smart-docs' ); ?>"
			value="<?php echo get_search_query(); ?>"
			name="s"
			title="<?php echo esc_attr_x( 'Search', 'text for input title attribute', 'smart-docs' ); ?>"
			autocomplete="off"
			autocapitalize="off"
			autocorrect="off"
		/>
		<div class="loading-spinner" aria-hidden="true">
			<img src="<?php echo esc_url( admin_url( 'images/spinner-2x.gif' ) ); ?>" alt="smartdocs-search-loader" />
		</div>
	</form>
</div>
