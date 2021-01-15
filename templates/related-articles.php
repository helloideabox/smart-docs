<?php
/**
 * The template for displaying related articles on single doc page.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/related-articles.php.
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

<div class="smartdocs-related-articles">
	<h4 class="related-articles-heading"><?php _e( 'Related Articles', 'smart-docs' ); ?></h4>
	<ul class="related-articles">
	<?php
	foreach( $articles as $article ) {
		?>
		<li class="related-article doc-<?php echo esc_html( $article->ID ); ?>">
			<a href="<?php echo esc_url( get_post_permalink( $article->ID ) );?>" rel="bookmark">
				<?php echo esc_attr( $article->post_title ); ?>
			</a>
		</li>
		<?php
	}
	?>
	</ul>
</div>
