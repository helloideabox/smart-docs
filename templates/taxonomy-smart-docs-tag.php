<?php
/**
 * The template for category docs page.
 *
 * @author Ideabox
 * @package SmartDocs/ArchiveTemplate category
 * @version 1.0.0
 */

get_header();


// Gettings category details.
$tag_details = get_querisd_object();

$current_tag_name = $tag_details->name;
$current_tag_id   = $tag_details->term_id;
$current_tag_type = $tag_details->taxonomy;

// display live search box.
echo do_shortcode( '[smart_doc_wp_live_search]' );
?>

<div class="sd-wrap sd-taxonomy-container">
	<div class="sd-tag-content-area">
		<div class="sd-tag-header">
			<h1 class="sd-title"><?php single_tag_title(); ?></h1>
			<?php the_archive_description( '<div class="sd-taxonomy-description">', '</div>' ); ?>
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				echo '<div class="sd-tax-breadcrumb">' . do_shortcode( '[wpseo_breadcrumb]' ) . '</div>';
			}
			?>
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
						'taxonomy' => $current_tag_type,
						'field'    => 'term_id',
						'terms'    => $current_tag_id,
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
				<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?>" >
					<svg xmlns="http://www.w3.org/2000/svg" fill="#000000" viewBox="0 0 30 30" width="25px" height="100%">
						<path d="M24.707,8.793l-6.5-6.5C18.019,2.105,17.765,2,17.5,2H7C5.895,2,5,2.895,5,4v22c0,1.105,0.895,2,2,2h16c1.105,0,2-0.895,2-2 V9.5C25,9.235,24.895,8.981,24.707,8.793z M18,21h-8c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h8c0.552,0,1,0.448,1,1 C19,20.552,18.552,21,18,21z M20,17H10c-0.552,0-1-0.448-1-1c0-0.552,0.448-1,1-1h10c0.552,0,1,0.448,1,1C21,16.552,20.552,17,20,17 z M18,10c-0.552,0-1-0.448-1-1V3.904L23.096,10H18z"/>
					</svg>

					<h3 class="sd-entry-title">
						<a rel="bookmark" href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?>
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
