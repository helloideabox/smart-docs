<?php

namespace SmartDocs;

/**
 * Ajax Class.
 *
 * Ajax class is responsible for handling the XHR events and responses.
 * 
 * @package SmartDocs
 * @since 1.0.0
 */

class Ajax {

	public function __construct() {
		add_action( 'wp_ajax_smartdocs_on_settings_save', array( $this, 'on_settings_save' ) );
		// To load search results from ajax request.
		add_action( 'wp_ajax_smartdocs_search_results', array( $this, 'get_search_results' ) );
		add_action( 'wp_ajax_nopriv_smartdocs_search_results', array( $this, 'get_search_results' ) );

		// Doc feedback.
		add_action( 'wp_ajax_smartdocs_doc_feedback', array( $this, 'handle_doc_feedback' ) );
		add_action( 'wp_ajax_nopriv_smartdocs_doc_feedback', array( $this, 'handle_doc_feedback' ) );
	}

	public function on_settings_save() {
		flush_rewrite_rules();
		wp_send_json_success();
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

	public function handle_doc_feedback() {
		// Check for the post ID first.
		$post_id = isset( $_POST['post_id'] ) ? absint( wp_unslash( $_POST['post_id'] ) ) : 0;

		// Check for the security to determine we get the request from the correct page.
		if ( ! $post_id || ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['nonce'] ), "smartdocs_feedback_{$post_id}" ) ) {
			wp_send_json_error();
		}

		// Check whether we got valid feedback type or not.
		if ( ! isset( $_POST['type'] ) || ! in_array( $_POST['type'], array( 'upvote', 'downvote' ) ) ) {
			wp_send_json_error();
		}

		$type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
		$user_feedbacks = isset( $_COOKIE['smartdocs_feedback'] ) ? explode( ',', $_COOKIE['smartdocs_feedback'] ) : array();

		// Check if the user has already voted.
		if ( in_array( $post_id, $user_feedbacks ) ) {
			wp_send_json_error( esc_html__( 'Sorry, you\'ve already voted.', 'smart-docs' ) );
		}

		// Update the vote count in post meta accordingly.
		$meta_key = "_smartdocs_{$type}s";
		$count = (int) get_post_meta( $post_id, $meta_key, true );
		update_post_meta( $post_id, $meta_key, $count + 1 );

		// Set the cookie for new feedback.
		$user_feedbacks[] = $post_id;
		$new_feedback = implode( ',', $user_feedbacks );
		$cookie = setcookie( 'smartdocs_feedback', $new_feedback, time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );

		wp_send_json_success( esc_html__( 'Thanks for the vote!', 'smart-docs' ) );
	}

}
