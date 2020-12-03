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


	<?php //require_once SMART_DOCS_PATH . '\templates\parts\single-doc-header.php'; ?>

	<?php require_once SMART_DOCS_PATH . '\templates\parts\single-doc-content.php'; ?>


