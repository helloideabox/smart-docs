<?php
/**
 * The template for category docs page
 *
 * @author Ideabox
 * @package Documentation/ArchiveTemplate category
 */

get_header();


// Gettings category details.
$tag_details = get_queried_object();

$current_tag_name = $tag_details->name;
$current_tag_id   = $tag_details->term_id;
$current_tag_type = $tag_details->taxonomy;

// display live search box.
echo do_shortcode( '[easy_doc_wp_live_search]' );
?>

<div class="wrap ed-taxonomy-container">
	<div class="ed-tag-content-area">
		<div class="ed-tag-header">
			<h1 class="ed-title"><?php single_tag_title(); ?></h1>
			<?php the_archive_description( '<div class="ed-taxonomy-description">', '</div>' ); ?>
			<?php
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				echo '<div class="ed-tax-breadcrumb">' . do_shortcode( '[wpseo_breadcrumb]' ) . '</div>';
			}
			?>
		</div>

		<?php
		// This post to check for actual post.
		if ( have_posts() ) :

			$query_args = array(
				'post_type'     => 'easy-doc',
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
			<div class="ed-post-container">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				?>
				<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?>" >
					<h3 class="ed-entry-title">
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
	if ( is_active_sidebar( 'easy-doc-sidebar-1' ) ) {
		?>

	<div class="ed-custom-widget-area">
		<div class="ed-sidebar-main-content-area">
			<?php dynamic_sidebar( 'easy-doc-sidebar-1' ); ?>
		</div>
	</div>

	<?php } ?>
</div>

<?php get_footer(); ?>
