<?php
	/**
	 * Hook: smartdocs_before_single_doc_header
	 */
	do_action( 'smartdocs_before_single_doc_header' );
?>

<header class="smartdocs-single-doc-header">
	<h1 class="smartdocs-single-doc-title"><?php the_title(); ?></h1>
	<?php
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
	}
	?>
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
	?>
</header>

<?php
	/**
	 * Hook: smartdocs_after_single_doc_header
	 */
	do_action( 'smartdocs_after_single_doc_header' );
?>
