<?php
	/**
	 * Hook: smartdocs_before_single_doc
	 */
	do_action( 'smartdocs_before_single_doc' );
?>

<div id="doc-<?php echo get_the_ID(); ?>" class="single-doc-content">
	<?php do_action( 'smartdocs_before_single_doc_summary' ); ?>	

	<div class="summary entry-summary">
		<?php do_action( 'smartdocs_single_doc_summary' ); ?>
	</div>
	
	<?php do_action( 'smartdocs_after_single_doc_summary' ); ?>
</div>

<?php
	/**
	 * Hook: smartdocs_after_single_doc
	 */
	do_action( 'smartdocs_after_single_doc' );
?>
