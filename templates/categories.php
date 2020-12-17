<?php
/**
 * The Template for displaying categories.
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<div class="smartdocs-categories <?php echo $columns_class; ?>">
	<?php foreach ( $terms as $term ) : ?>
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
				</div>
				<div class="smartdocs-posts-info">
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="smartdocs-posts-count">
						<span class="smartdocs-posts-count"><?php echo esc_html( $term->count ); ?></span>
						<span class="smartdocs-posts-count-text"><?php echo esc_html( _n( 'Article', 'Articles', $term->count, 'smart-docs' ) ); ?></span>
					</a>
					<a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="smartdocs-category-view-all">
						<span><?php echo __( 'View All', 'smart-docs' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
