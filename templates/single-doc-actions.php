<?php
/**
 * The template for displaying action content in single-smart-docs.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-actions.php.
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

<div class="smartdocs-doc-actions">
	<h5><?php _e( 'Not the solution you are looking for?', 'smart-docs' ); ?></h5>
	<p>
	<?php
		echo sprintf(
			// translators: %1$s denotes docs page link and %2$s denotes support page link.
			__( 'Please check other <a href="%1$s">articles</a> or open a <a href="%2$s">support ticket</a>.', 'smart-docs' ),
			smartdocs_get_docs_page_link(),
			smartdocs_get_support_page_link()
		);
	?>
	</p>
</div>
