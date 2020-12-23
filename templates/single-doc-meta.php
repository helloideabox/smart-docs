<?php
/**
 * The template for displaying entry meta in single-doc-footer.php or single-doc-header.php template.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/single-doc-meta.php.
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
	exit;
}

$modified_time_string = sprintf( __( 'Updated on %s', 'smart-docs' ), get_the_modified_date( 'F j, Y' ) );
?>

<div class="entry-meta">
	<div class="entry-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
		<meta itemprop="name" content="<?php echo get_the_author(); ?>" />
		<meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
	</div>
	<div class="entry-time">
		<meta itemprop="datePublished" content="<?php echo get_the_date( 'c' ); ?>">
		<time itemprop="dateModified" datetime="<?php echo get_the_modified_date( 'c' ); ?>"><?php echo esc_html( $modified_time_string ); ?></time>
	</div>
</div>
