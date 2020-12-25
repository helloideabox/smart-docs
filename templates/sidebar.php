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
		<?php
		if ( is_active_sidebar( 'smart-docs-sidebar' ) ) :
			dynamic_sidebar( 'smart-docs-sidebar' );
		else :
			?>
			<div class="smartdocs-no-sidebar">
				<?php echo sprintf( __( 'This is Smart Docs Sidebar. You can add Categories widget or edit the content that appears here by visting <a href="%s">Widgets panel</a>', 'smart-docs' ), admin_url( 'widgets.php' ) ); ?>
			</div>
			<?php
		endif;
		?>
	</div>
</div>
