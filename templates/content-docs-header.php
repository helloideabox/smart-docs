<?php
/**
 * The template for header.
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<div class="smartdocs-header">
	<div class="smartdocs-inner">
		<?php if ( apply_filters( 'smartdocs_show_hero_title', true ) ) : ?>
			<h1 class="smartdocs-hero-title"><?php echo esc_html( smartdocs_hero_title() ); ?></h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: smartdocs_archive_description.
		 *
		 * @hooked smartdocs_archive_description - 10
		 */
		do_action( 'smartdocs_archive_description' );
		?>

		<?php
		/**
		 * Hook: smartdocs_archive_before_header_end.
		 *
		 * @hooked smartdocs_search_form - 10
		 */
		do_action( 'smartdocs_archive_before_header_end' );
		?>
	</div>
</div>