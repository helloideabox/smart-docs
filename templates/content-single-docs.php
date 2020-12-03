<?php
/**
 * The template for displaying single doc content in the single-smart-docs.php template.
 *
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: smartdocs_before_single_doc
 */
do_action( 'smartdocs_before_single_doc' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<article class="entry smartdocs-entry">
	<?php do_action( 'smartdocs_before_single_doc_content' ); ?>	

	<div class="entry-content smartdocs-entry-content">
		<?php do_action( 'smartdocs_single_doc_content' ); ?>
	</div>
	
	<?php do_action( 'smartdocs_after_single_doc_content' ); ?>
</article>

<?php
/**
 * Hook: smartdocs_after_single_doc
 */
do_action( 'smartdocs_after_single_doc' );
?>
