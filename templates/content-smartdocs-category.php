<?php
/**
 * The template for category docs page
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<article class="<?php smartdocs_post_class(); ?>">
	<h2 class="smartdocs-entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
</article>
