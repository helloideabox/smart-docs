<?php

namespace EasyDocs;

class Search {

	public function __construct() {
		// To load search results from ajax request.
		add_action( 'wp_ajax_ed_load_search_results', array( $this, 'ed_load_search_results' ) );
		add_action( 'wp_ajax_nopriv_ed_load_search_results', array( $this, 'ed_load_search_results' ) );
	}


	/**
	 * For render the search result.
	 */
	public function ed_load_search_results() {
		// Checking for correct ajax request.
		if ( check_ajax_referer( 'docs_search', 'security' ) ) {
			if ( isset( $_POST['query'] ) && ! empty( $_POST['query'] ) ) {
				$query = sanitize_text_field( wp_unslash( $_POST['query'] ) );
			} else {
				$query = esc_html__( 'No docs found', 'easydoc' );
			}
		} else {
			esc_attr_e( 'Nonce is invalid', 'easydoc' );
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
				esc_attr_e( 'No Doc was found', 'easydoc' );
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
