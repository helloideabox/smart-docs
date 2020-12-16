<?php
/**
 * The template for single docs page
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<?php
	$modified_time_string = sprintf( __( 'Updated on %s', 'smart-docs' ), get_the_modified_date( 'F j, Y' ) );
?>
<footer class="entry-footer smartdocs-entry-footer">
	<div class="entry-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
		<meta itemprop="name" content="<?php echo get_the_author(); ?>" />
		<meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
	</div>
	<div class="entry-time">
		<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
		<time itemprop="dateModified" datetime="<?php echo get_the_modified_date( 'c' ); ?>"><?php echo esc_html( $modified_time_string ); ?></time>
	</div>
</footer>
