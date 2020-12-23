<?php
/**
 * The template for displaying doc content in the single-smart-docs.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/content-single-docs.php.
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
	exit;
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
