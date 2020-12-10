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

<div class="smartdocs-categories">
	<?php foreach ( $terms as $term ) : ?>
		<div class="smartdocs-category">
			<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
				<div class="smartdocs-category-info">
						<?php
							$cat_thumb = smartdocs_get_category_thumbnail_url( $term->term_id );

						if ( is_array( $cat_thumb ) && ! empty( $cat_thumb ) ) :
							?>
							<img src="<?php echo $cat_thumb[0]; ?>" alt="<?php echo $term->name; ?>" width="100px" />

						<?php endif; ?>
						<div class="smartdocs-category-text">
							<<?php echo esc_html( $args['title_tag'] ); ?> class="smartdocs-category-title"><?php echo esc_html( $term->name ); ?></<?php echo esc_html( $args['title_tag'] ); ?>>
							<?php if ( ! empty( $term->description ) ) : ?>
								<span class="smartdocs-category-description">
									<?php echo esc_html( $term->description ); ?>
								</span>
							<?php endif; ?>
						</div>
				</div>
				<div class="smartdocs-posts-info">
					<div class="smartdocs-posts-count">
						<span class="smartdocs-posts-count"><?php echo esc_html( $term->count ); ?></span>
						<span class="smartdocs-posts-count-text"><?php echo esc_html( _n( 'Article', 'Articles', $term->count, 'smart-docs' ) ); ?></span>
					</div>
					<div class="smartdocs-category-view-all">
						<span><?php echo __( 'View All', 'smart-docs' ); ?></span>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach; ?>
</div>
