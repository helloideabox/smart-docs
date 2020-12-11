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
<div class="smartdocs-doc-actions">
	<h5><?php _e( 'Not the solution you are looking for?', 'smart-docs' ); ?></h5>
	<p><?php echo sprintf( __( 'Please check other <a href="%1$s">articles</a> or open a <a href="%2$s">support ticket</a>.', 'smart-docs' ), smartdocs_get_docs_page_link(), '#' ); ?></p>
</div>
