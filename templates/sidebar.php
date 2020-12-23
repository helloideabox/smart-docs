<?php
/**
 * The template for displaying sidebar on doc taxonomy archive and single.
 *
 * This template can be overridden by copying it to yourtheme/smart-docs/sidebar.php.
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
?>

<div class="widget-area sidebar smartdocs-sidebar" itemscope="itemscope" itemtype="https://schema.org/WPSideBar">
	<div class="sidebar-main content-area">
		<?php dynamic_sidebar( 'smart-docs-sidebar' ); ?>
	</div>
</div>
