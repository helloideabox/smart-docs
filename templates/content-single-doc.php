<?php
/**
 * The template for displaying single doc content in the smart-docs-single-template.php template.
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

<div class="smardocs-single-doc-content-wrap">
	
	<?php require_once SMART_DOCS_PATH . '\templates\parts\single-doc-header.php'; ?>

	<?php require_once SMART_DOCS_PATH . '\templates\parts\single-doc-content.php'; ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		$is_comment_template_on = get_option( 'sd_turnoff_doc_comment' );
		if ( ! ( '1' === $is_comment_template_on ) ) {

			/**
			 * Hook: smartdocs_single_doc_comments
			 * 
			 * @hooked smartdocs_single_doc_comments - 10
			 */
			do_action( 'smartdocs_single_doc_comments' );
		}
	?>
</div>
