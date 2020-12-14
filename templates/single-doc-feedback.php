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

global $post;

$upvotes = (int) get_post_meta( $post->ID, '_smartdocs_upvotes', true );
$downvotes = (int) get_post_meta( $post->ID, '_smartdocs_downvotes', true );

$upvote_title = ! $upvotes ? __( 'No votes yet', 'smart-docs' ) : sprintf( _n( '%d person found this useful', '%d persons found this useful', $upvotes ), number_format_i18n( $upvotes ) );
$downvote_title = ! $upvotes ? __( 'No votes yet', 'smart-docs' ) : sprintf( _n( '%d person found this not useful', '%d persons found this not useful', $downvotes ), number_format_i18n( $downvotes ) );
?>
<div class="smartdocs-doc-feedback">
	<p><?php esc_html_e( 'Was this article helpful to you?', 'smart-docs' ); ?></p>
	<div class="doc-vote-links">
		<a href="#" class="doc-upvote" data-id="<?php echo $post->ID; ?>" title="<?php echo $upvote_title; ?>">
			<span class="vote-text"><?php _e( 'Yes', 'smart-docs' ); ?></span>
			<?php if ( $upvotes ) { ?>
			<span class="vote-count"><?php echo number_format_i18n( $upvotes ); ?></span>
			<?php } ?>
		</a>
		<a href="#" class="doc-downvote" data-id="<?php echo $post->ID; ?>" title="<?php echo $downvote_title; ?>">
			<span class="vote-text"><?php _e( 'No', 'smart-docs' ); ?></span>
			<?php if ( $downvotes ) { ?>
			<span class="vote-count"><?php echo number_format_i18n( $downvotes ); ?></span>
			<?php } ?>
		</a>
	</div>
</div>
