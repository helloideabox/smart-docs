<?php

namespace SmartDocs;

/**
 * Search Class.
 *
 * Search class is responsible for handling the search of the documents and
 * other post types when selected in settings and return a feature rich results.
 * 
 * @package SmartDocs
 * @since 1.0.0
 */

class Search {

	public function __construct() {
		// To load search results from ajax request.
		add_action( 'wp_ajax_sd_load_search_results', array( $this, 'sd_load_search_results' ) );
		add_action( 'wp_ajax_nopriv_sd_load_search_results', array( $this, 'sd_load_search_results' ) );
	}


	/**
	 * For render the search result.
	 */
	public function sd_load_search_results() {
		// Checking for correct ajax request.
		if ( check_ajax_referer( 'docs_search', 'security' ) ) {
			if ( isset( $_POST['query'] ) && ! empty( $_POST['query'] ) ) {
				$query = sanitize_text_field( wp_unslash( $_POST['query'] ) );
			} else {
				$query = esc_html__( 'No docs found', 'smart-docs' );
			}
		} else {
			esc_attr_e( 'Nonce is invalid', 'smart-docs' );
		}

		// To show which post to show.
		$selectsd_post_types = get_option( 'sd_post_type_selected' );
		$selectsd_post_types = ! $selectsd_post_types ? array( 'post', 'page' ) : $selectsd_post_types;

		// WordPress Query arguments.
		$query_args = array(
			'post_type'   => $selectsd_post_types,
			'post_status' => 'publish',
			's'           => $query,
		);

		$search_results = new WP_Query( $query_args );

		ob_start();
		?>

		<ul class="sd-search-result">

			<?php
			if ( $search_results->have_posts() ) :
				while ( $search_results->have_posts() ) :
					$search_results->the_post();
					?>
					<li class="sd-search-list">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
					<?php
				endwhile;
			else :
				esc_attr_e( 'No Doc was found', 'smart-docs' );
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

}
