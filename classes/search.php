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
		add_action( 'wp_ajax_smartdocs_search_results', array( $this, 'get_search_results' ) );
		add_action( 'wp_ajax_nopriv_smartdocs_search_results', array( $this, 'get_search_results' ) );
	}


	/**
	 * For render the search result.
	 */
	public function get_search_results() {
		$query = sanitize_text_field( wp_unslash( $_POST['query'] ) );

		// To show which post to show.
		$post_types = get_option( 'sd_post_type_selected' );
		$post_types = ! $post_types ? array( Plugin::instance()->cpt->post_type ) : $post_types;

		// WordPress Query arguments.
		$query_args = array(
			'post_type'   => $post_types,
			'post_status' => 'publish',
			'posts_per_page' => '-1',
			's'           => $query,
		);

		$search_results = new \WP_Query( $query_args );

		ob_start();
		?>

		<ul class="smartdocs-search-result">

			<?php
			if ( $search_results->have_posts() ) :
				while ( $search_results->have_posts() ) :
					$search_results->the_post();
					?>
					<li>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</li>
					<?php
				endwhile;
			else :
				echo '<li class="not-found">' . esc_attr__( 'No documentation found.', 'smart-docs' ) . '</li>';
			endif;
			?>

		</ul>
		<?php

		wp_reset_postdata();
		$content = ob_get_clean();

		wp_send_json_success( $content );
	}

}
