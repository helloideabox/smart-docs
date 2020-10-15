<?php
/**
 * The template for category docs page
 *
 * @author Ideabox
 * @package SmartDocs/ArchiveTemplate category
 * @version 1.0.0
 */

get_header();


// Gettings category details.
$cat_details = get_queried_object();

$current_category_name = $cat_details->name;
$current_category_id   = $cat_details->term_id;
$current_category_type = $cat_details->taxonomy;

// display live search box.
echo do_shortcode( '[smart_doc_wp_live_search]' );

?>

<div class="sd-wrap sd-taxonomy-container">
	<div class="sd-category-content-area">
		<div class="sd-category-header">
			<h1 class="sd-title"><?php single_cat_title(); ?></h1>
			<?php the_archive_description( '<div class="sd-taxonomy-description">', '</div>' ); ?>
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				echo '<div class="sd-tax-breadcrumb">' . do_shortcode( '[wpseo_breadcrumb]' ) . '</div>';
			}
			?>
		</div>



		<?php
		// This is to check for any term children.
		$args = array(
			'hide_empty' => false,
			'parent'     => $current_category_id,
		);

		$terms_children = get_terms( 'smartdocs_category', $args );
		?>

		<div class="sd-archive-post-container">

			<?php if ( $terms_children ) : ?>
			<div class="sd-categories-wrap">
				<?php
				// Looping through all the terms.
				foreach ( $terms_children as $t ) {
					?>

					<div class="sd-categories-post">
						<a href="<?php echo esc_html( get_term_link( $t ) ); ?>" class="sd-sub-archive-post">
							<h4 class="sd-archive-cat-title">
								<?php echo esc_html( $t->name ); ?>
							</h4>
							<p class="sd-archive-post-count">
								<?php
								// Checking if the Article is greter than 0 or 1.
								if ( 0 === $t->count ) {
									echo esc_html( $t->count ) . ' Article';
								} else {
									/* translators: %s: search term */
									$article = sprintf( _n( '%d Article', '%d Articles', $t->count, 'smart-docs' ), number_format_i18n( $t->count ) );
									echo esc_html( $article );
								}
								?>
							</p>
						</a>
					</div>

					<?php
				}
				?>
			</div>
			<?php endif; ?>
		</div>



		<?php
		// This post to check for actual post.
		if ( have_posts() ) :

			$query_args = array(
				'post_type'     => 'smart-doc',
				'post_status'   => 'publish',
				'post_per_page' => '-1',
				'tax_query'     => array(
					array(
						'taxonomy'         => $current_category_type,
						'field'            => 'term_id',
						'terms'            => $current_category_id,
						'include_children' => false,
					),
				),
			);

			$query = new WP_Query( $query_args );
			?>
			<div class="sd-post-container">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				?>
				<article id="post-<?php the_ID(); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 30 30" width="25px" height="100%">
						<path d="M24.707,8.793l-6.5-6.5C18.019,2.105,17.765,2,17.5,2H7C5.895,2,5,2.895,5,4v22c0,1.105,0.895,2,2,2h16c1.105,0,2-0.895,2-2 V9.5C25,9.235,24.895,8.981,24.707,8.793z M18,21h-8c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h8c0.552,0,1,0.448,1,1 C19,20.552,18.552,21,18,21z M20,17H10c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h10c0.552,0,1,0.448,1,1C21,16.552,20.552,17,20,17 z M18,10c-0.552,0-1-0.448-1-1V3.904L23.096,10H18z"/>
					</svg>
					<h3 class="sd-entry-title">
						<a rel="bookmark" href="<?php echo esc_url( the_permalink() ); ?>">	
							<?php the_title(); ?>
						</a>
					</h3>
				</article>
				<?php
			endwhile;
			?>
			</div>
			<?php
		endif;
		?>
	</div>

	<?php
	// Widget Area.
	if ( is_active_sidebar( 'smart-docs-sidebar-1' ) ) {
		?>

	<div class="sd-custom-widget-area">
		<div class="sd-sidebar-main-content-area">
			<?php dynamic_sidebar( 'smart-docs-sidebar-1' ); ?>
		</div>
	</div>

	<?php } ?>
</div>

<?php get_footer(); ?>
