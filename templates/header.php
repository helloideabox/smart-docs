<?php
/**
 * The template for displaying hero section on doc archive and single.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/header.php.
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

<div class="smartdocs-header">
	<div class="smartdocs-inner">
		<?php if ( apply_filters( 'smartdocs_show_hero_title', true ) ) : ?>
			<h2 class="smartdocs-hero-title"><?php echo esc_html( smartdocs_hero_title() ); ?></h2>
		<?php endif; ?>

		<?php
		/**
		 * Hook: smartdocs_header_content.
		 *
		 * @hooked smartdocs_search_form - 10
		 */
		do_action( 'smartdocs_header_content' );
		?>
	</div>
</div>
