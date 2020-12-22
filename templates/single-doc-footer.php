<?php
/**
 * The template for single docs page
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
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
