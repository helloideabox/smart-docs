<?php
/**
 * The template for sidebar.
 *
 * @author IdeaBox
 * @package SmartDocs\Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direcly
}
?>

<div class="widget-area sidebar smartdocs-sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
	<div class="sidebar-main content-area">
		<?php dynamic_sidebar( 'smart-docs-sidebar' ); ?>
	</div>
</div>
