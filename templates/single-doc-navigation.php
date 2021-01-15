<?php
/**
 * The template for displaying navigation links in single-doc-footer.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-navigation.php.
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
	exit; // Exit if accessed directly.
}
?>

<div class="smartdocs-navigation-links">
	<div class="smartdocs-link smartdocs-link-previous">
		<?php if ( ! is_rtl() ) { ?>
			<span><?php previous_post_link( '← %link', '%title' ); ?></span>
		<?php } else { ?>
			<span><?php previous_post_link( '→ %link', '%title' ); ?></span>
		<?php } ?>
	</div>
	<div class="smartdocs-link smartdocs-link-next">
		<?php if ( ! is_rtl() ) { ?>
			<span><?php next_post_link( '%link →', '%title' ); ?></span>
		<?php } else { ?>
			<span><?php next_post_link( '%link ←', '%title' ); ?></span>
		<?php } ?>
	</div>
</div>
