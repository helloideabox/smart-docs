<?php
	/**
	 * Hook: smartdocs_before_single_doc_content
	 */
	do_action( 'smartdocs_before_single_doc_header' );
?>

<article class="smartdocs-single-doc-content">
	<div class="smartdocs-single-doc-featured-image">
		<?php the_post_thumbnail(); ?>
	</div>
	<div class="smartdocs-single-doc-content-wrapper">
		<?php the_content(); ?>
	</div>
	<?php
	// If post last updated time is on.
	$is_last_updated_time_on = 1;// get_option( 'sd_show_last_update_time' );
	if ( 1 === $is_last_updated_time_on ) {

		/**
		 * Hook: smartdocs_single_doc_last_update_on
		 *
		 * @hooked smartdocs_single_doc_last_updated_on - 10
		 */
		do_action( 'smartdocs_single_doc_last_updated_on' );

	}

		/**
		 * Hook: smartdocs_single_doc_terms
		 * 
		 * @hooked smartdocs_single_doc_terms - 10
		 */
		do_action( 'smartdocs_single_doc_terms' );

	?>
</article>

<?php
	/**
	 * Hook: smartdocs_after_single_doc_header
	 */
	do_action( 'smartdocs_after_single_doc_header' );
?>
