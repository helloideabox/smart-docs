<?php
/**
 * The template for displaying header content in single-smart-docs.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-header.php.
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

<header class="entry-header smartdocs-entry-header">
	<?php
		/**
		 * Hook: smartdocs_before_single_doc_title
		 */
		do_action(  'smartdocs_before_single_doc_title' );
	?>

	<h1 class="smartdocs-entry-title" itemprop="headline"><?php the_title(); ?></h1>

	<?php
		/**
		 * Hook: smartdocs_after_single_doc_title
		 */
		do_action( 'smartdocs_after_single_doc_title' );
	?>
</header>
