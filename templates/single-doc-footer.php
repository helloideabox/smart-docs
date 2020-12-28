<?php
/**
 * The template for displaying footer content in single-smart-docs.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-footer.php.
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

<footer class="entry-footer smartdocs-entry-footer">
	<?php
		/**
		 * Hook: smartdocs_single_doc_footer.
		 *
		 * @hooked smartdocs_entry_meta - 5
		 */
		do_action( 'smartdocs_single_doc_footer' );
	?>
</footer>
