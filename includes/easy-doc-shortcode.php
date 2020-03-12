<?php
/**
 * Functions related to shortcode for live search
 *
 * @package Documentation/Shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// To render the search box of WordPress.
add_shortcode( 'easy_doc_wp_live_search', 'easy_doc_render_search_box' );

// To load search results from ajax request.
add_action( 'wp_ajax_ed_load_search_results', 'ed_load_search_results' );
add_action( 'wp_ajax_nopriv_ed_load_search_results', 'ed_load_search_results' );



/**
 * For rendering the search box.
 *
 * @param int $atts    Get attributes for the search field.
 * @param int $content Get content to search from.
 */
function easy_doc_render_search_box( $atts, $content = null ) {
	ob_start();
	?>
	<div class="ed-live-search">
		<div class="ed-search-form-container">
			<form role="search" method="post" class="ed-search-form" action="">
				<input id="ed-sq" type="search" class="ed-search-field" placeholder="<?php echo esc_attr_x( 'Search for answers…', 'placeholder', 'easydoc' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'easydoc' ); ?>" autocomplete="off" autocorrect="off" />

				<div class="ed-spinner live-search-loading">
					<img src="<?php echo esc_url( plugins_url( '../assets/images/ring.gif', __FILE__ ) ); ?>" >
				</div>
			</form>
		</div>
	</div>
	<?php
	// Returning the html document.
	return ob_get_clean();
}


/**
 * For render the search result.
 */
function ed_load_search_results() {
	// Checking for correct ajax request.
	if ( check_ajax_referer( 'docs_search', 'security' ) ) {
		if ( isset( $_POST['query'] ) && ! empty( $_POST['query'] ) ) {
			$query = sanitize_text_field( wp_unslash( $_POST['query'] ) );
		} else {
			$query = 'No docs Found';
		}
	} else {
		echo 'Nonce is invalid';
	}

	// To show which post to show.
	$selected_post_types = get_option( 'ed_post_type_selected' );
	$selected_post_types = ! $selected_post_types ? array( 'post', 'page' ) : $selected_post_types;

	// WordPress Query arguments.
	$query_args = array(
		'post_type'   => $selected_post_types,
		'post_status' => 'publish',
		's'           => $query,
	);

	$search_results = new WP_Query( $query_args );

	ob_start();
	?>

	<ul class="ed-search-result">

		<?php
		if ( $search_results->have_posts() ) :
			while ( $search_results->have_posts() ) :
				$search_results->the_post();
				?>
				<li class="ed-search-list">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
				<?php
			endwhile;
		else :
			echo 'No Doc was Found';
		endif;
		?>

	</ul>
	<?php

	wp_reset_postdata();
	$content = ob_get_clean();

	echo $content;

	// To remove 0 appending at the end of the response.
	wp_die();
}

