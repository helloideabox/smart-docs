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
<header class="entry-header smartdocs-entry-header">
	<?php do_action(  'smartdocs_before_single_doc_title' ); ?>
	<h1 class="smartdocs-entry-title" itemprop="headline"><?php the_title(); ?></h1>
	<?php do_action( 'smartdocs_after_single_doc_title' ); ?>
</header>
