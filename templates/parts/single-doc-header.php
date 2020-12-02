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
</header>

<?php
	/**
	 * Hook: smartdocs_after_single_doc_header
	 */
	do_action( 'smartdocs_after_single_doc_header' );
?>