<?php
/**
 * The template for category docs page
 *
 * @author Ideabox
 * @package Documentation/ArchiveTemplate single post
 */

get_header();

// display live search box.
echo do_shortcode( '[easy_doc_wp_live_search]' );

if ( have_posts() ) :
	?>

<div class="wrap ed-single-post-container">
	<div class="ed-main-single-post-container">
		<div class="ed-single-post-sub-container">
		<?php
		// Start of the looop.
		while ( have_posts() ) :
			the_post();
			?>

			<div class="ed-single-post-header">
				<h1 class="ed-title"><?php the_title(); ?></h1>
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
				}
				?>
			</div>

			<div class="ed-post-content">
				<?php the_post_thumbnail(); ?>
				<?php the_content(); ?>
				<?php
				// To get the related tags of that post.
				the_terms( get_the_ID(), 'easydoc_tag', '<ul class="easy-doc-tag"><span class="bsf-docs-tag-label">Tagged Under: </span><li>', '</li><li>', '</li></ul>' );
				?>
			</div>

			<?php
		endwhile;
		?>
		</div>
	</div>

	<?php // Widget Area. ?>
	<div class="ed-custom-widget-area">
		<div class="ed-sidebar-main-content-area">
			<?php dynamic_sidebar( 'easy-doc-sidebar-1' ); ?>
		</div>
	</div>
</div>

	<?php
endif;
?>

<?php get_footer(); ?>
