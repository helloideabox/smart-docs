<?php
/**
 * The template for displaying search form.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/search-form.php.
 *
 * HOWEVER, on occasion SmartDocs will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package     SmartDocs\Templates
 * @version     1.0.0		
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
