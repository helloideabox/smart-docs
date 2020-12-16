<?php
/**
 * The template for displaying single doc content in the single-smart-docs.php template.
 *
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}

/**
 * Hook: smartdocs_before_single_doc
 */
do_action( 'smartdocs_before_single_doc' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

	<article class="<?php smartdocs_post_class( 'entry smartdocs-entry' ); ?>" itemscope itemtype="http://schema.org/Article">
		<?php do_action( 'smartdocs_before_single_doc_content' ); ?>	

		<div class="entry-content smartdocs-entry-content" itemprop="articleBody">
			<?php do_action( 'smartdocs_single_doc_content' ); ?>
		</div>
		
		<?php do_action( 'smartdocs_after_single_doc_content' ); ?>
	</article>

<?php
/**
 * Hook: smartdocs_after_single_doc
 */
do_action( 'smartdocs_after_single_doc' );
