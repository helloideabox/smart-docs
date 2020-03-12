<?php
/**
 * The template for archive docs page
 *
 * @author Ideabox
 * @package Documentation/ArchiveTemplate
 */

get_header();


// display live search box.
echo do_shortcode( '[easy_doc_wp_live_search]' );


// Post condition and loop for displaying post.
if ( have_posts() ) {
	$args = array(
		'hide_empty' => false,
	);

	$terms = get_terms( 'easydoc_category', $args );
	?>

	<main class="wrap ed-archive-post-container">
			<?php
			// For selecting the dynamic title for db.
			$doc_title = get_option( 'ed_archive_page_title' );

			// Checking for empty doc title.
			if ( '' !== $doc_title ) {
				?>
				<h1 class="ed-archive-post-head"><?php echo esc_attr( $doc_title ); ?></h1>

			<?php } ?>
	<?php if ( $terms ) : ?>
	<div class="ed-archive-categories-wrap">
		<?php
		// Looping through all the terms.
		foreach ( $terms as $t ) {
			// Checking if they have parent or not.
			if ( 0 === $t->parent ) :
				?>

			<div class="ed-archive-post">
				<a href="<?php echo esc_html( get_term_link( $t ) ); ?>" class="ed-sub-archive-categories-post">
					<h4 class="ed-archive-cat-title">
						<?php echo esc_html( $t->name ); ?>
					</h4>
					<p class="ed-archive-post-count">
						<?php
						// Checking if the Article is greter than 0 or 1.
						if ( 0 === $t->count ) {
							echo esc_html( $t->count ) . ' Article';
						} else {
							/* translators: %s: search term */
							$article = sprintf( _n( '%d Article', '%d Articles', $t->count, 'easydoc' ), number_format_i18n( $t->count ) );
							echo esc_html( $article );
						}
						?>
					</p>
				</a>
			</div>

				<?php
			endif;
		}
		?>
	</div>
	<?php endif ?> 
	</main>

	<?php
} else {
	// internationalization.
	esc_html_e( 'Not yet started.', 'easydoc' );
}

get_footer();
