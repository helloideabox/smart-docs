<?php
/**
 * Docs categories
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/categories.php.
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
	exit; // Exit if accessed directly.
}
?>

<div class="smartdocs-categories <?php echo $columns_class; ?>">
	<?php
	foreach ( $terms as $term ) :
		if ( $term->parent ) {
			continue;
		}
	?>
		<div class="smartdocs-category">
			<div class="smartdocs-category-inner">
				<div class="smartdocs-category-info">
					<?php
					$cat_thumb = smartdocs_get_category_thumbnail_url( $term->term_id );

					if ( is_array( $cat_thumb ) && ! empty( $cat_thumb ) ) :
					?>
					<div class="smartdocs-category-thumb">
						<img src="<?php echo $cat_thumb[0]; ?>" alt="<?php echo $term->name; ?>" width="100px" />
					</div>
					<?php endif; ?>
					<div class="smartdocs-category-text">
						<<?php echo esc_html( $args['title_tag'] ); ?> class="smartdocs-category-title"><?php echo esc_html( $term->name ); ?></<?php echo esc_html( $args['title_tag'] ); ?>>
						<?php if ( ! empty( $term->description ) ) : ?>
							<div class="smartdocs-category-description">
								<?php echo wpautop( $term->description ); ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
					if ( 'yes' === $show_articles ) {

						smartdocs_category_articles( $term->term_id );
					}
					?>
				</div>
				<div class="smartdocs-posts-info<?php echo 'yes' === $args['show_count'] ? ' with-count' : ''; ?>">
					<?php if ( $args['show_count'] ) { ?>
						<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="smartdocs-posts-count">
							<span class="smartdocs-posts-count"><?php echo esc_html( $term->count ); ?></span>
							<span class="smartdocs-posts-count-text"><?php echo esc_html( _n( 'Article', 'Articles', $term->count, 'smart-docs' ) ); ?></span>
						</a>
					<?php } ?>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="smartdocs-category-view-all">
						<span><?php echo __( 'View All', 'smart-docs' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
